<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 9:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\EnquiryEntryRequest;
use App\Backend\Infrastructure\Forms\EnquiryEditRequest;
use App\Backend\Enquiry\EnquiryRepositoryInterface;
use App\Backend\Enquiry\Enquiry;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;
use App\Backend\Township\TownshipRepository;
use App\Backend\Service\ServiceRepository;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Cartype\CartypeRepository;
use App\Core\User;
use Mockery\CountValidator\Exception;

class EnquiryController extends Controller
{
    private $enquiryRepository;

    public function __construct(EnquiryRepositoryInterface $enquiryRepository)
    {
        $this->enquiryRepository = $enquiryRepository;
    }

    public function index()
    {
        try{
            if (Auth::guard('User')->check()) {

                $enquiry_status = 'all';
                $enquiry_case_type = 'all';
                $from_date = null;
                $to_date = null;

                $patientTypes   = Utility::getSettingsByType("PATIENT_TYPE");
                $userRepo = new User\UserRepository();
                $usersRaw       = $userRepo->getArrays();
                $users          = array();

                foreach($usersRaw as $key=>$user) {
                    $users[$user->id] = $user;
                }

                $servicesArray = array();
                $serviceRepo = new ServiceRepository();
                $servicesRaw = $serviceRepo->getArrays();
                foreach($servicesRaw as $key=>$service) {
                    $servicesArray[$service->id] = $service;
                }

                //$enquiries      = $this->enquiryRepository->getObjs($enquiry_status, $enquiry_case_type, $from_date, $to_date);
                $enquiries      = $this->enquiryRepository->getArrays($enquiry_status, $enquiry_case_type, $from_date, $to_date);
                if(isset($enquiries) && count($enquiries)>0) {
                    foreach($enquiries as $key=>$enquiry){
                        $enquiries[$key]->patient_type = $patientTypes[$enquiry->patient_type_id];
                        $enquiries[$key]->received_by  = $users[$enquiry->created_by]->name;

                        //get service from enquiry_detail
                        $enquiry_id = $enquiry->id;
                        $type = "service";

                        $enquiry_details = $this->enquiryRepository->getEnquiryDetail($enquiry_id,$type);
                        foreach($enquiry_details as $detail){
                            $service_id = $detail->service_id;
                            if(array_key_exists('services',$enquiries[$key])){
                                $enquiries[$key]->services  .= ','.$servicesArray[$service_id]->name;
                            }
                            else{
                                $enquiries[$key]->services  = $servicesArray[$service_id]->name;
                            }
                        }
                    }
                }

                return view('backend.enquiry.index')
                    ->with('enquiries', $enquiries)
                    ->with('enquiry_status', $enquiry_status)
                    ->with('enquiry_case_type', $enquiry_case_type)
                    ->with('from_date', $from_date)
                    ->with('to_date', $to_date);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/enquiry');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

            $townshipRepo   = new TownshipRepository();
            $townships      = $townshipRepo->getTownshipsFromZone();

            $serviceRepo = new ServiceRepository();
            $services      = $serviceRepo->getObjs();

            $allergyRepo    = new AllergyRepository();
            $allergyFood      = $allergyRepo->getArraysByType('food');
            $allergyDrug      = $allergyRepo->getArraysByType('drug');
            $allergyEnvironment = $allergyRepo->getArraysByType('environment');
            $allergies      = array();
            $allergies['food']      = $allergyFood;
            $allergies['drug']      = $allergyDrug;
            $allergies['environment']      = $allergyEnvironment;

            $carTypeRepo        = new CartypeRepository();
            $carTypesRaws        = $carTypeRepo->getArrays();
            $carTypes           = array();

            if(isset($carTypesRaws) && count($carTypesRaws)>0) {
                foreach($carTypesRaws as $carTypesRaw){
                    $carTypes[$carTypesRaw->id] = $carTypesRaw->name;
                }
            }

            return view('backend.enquiry.enquiry')
                ->with('patientTypes', $patientTypes)
                ->with('services', $services)
                ->with('townships', $townships)
                ->with('carTypes', $carTypes)
                ->with('allergies', $allergies);
        }
        return redirect('/');
    }

    public function store(EnquiryEntryRequest $request)
    {
        $request->validate();
        $is_new_patient             = Input::get('is_new_patient');
        $name                       = Input::get('name');
        $uppercase_name             = strtoupper($name);

        $patient_id                 = (Input::has('patient_id')) ? Input::get('patient_id') : "";

        $nrc_no                     = Input::get('nrc_no');
        $township_id                = Input::get('township_id');
        $patient_type_id            = Input::get('patient_type_id');
        $address                    = Input::get('address');
        $gender                     = Input::get('gender');
        $case_type                  = (Input::has('case_type')) ? 1 : 0;
        $car_type                   = Input::get('car_type');

        if($car_type != 3) {
            $car_type_id            = 0;
        }
        else{
            $car_type_id            = Input::get('car_type_id');
        }

        $services                   = Input::get('services');
        $having_allergy             = Input::get('having_allergy');
        $allergies                  = Input::get('allergies');
        $date                       = Input::get('date');
        $time                       = Input::get('time');
        $phone_no                   = Input::get('phone_no');
        $dob                        = Input::get('dob');
        $enquiry1                   = (Input::has('enquiry1')) ? 1 : 0;
        $enquiry2                   = (Input::has('enquiry2')) ? 1 : 0;
        $enquiry3                   = (Input::has('enquiry3')) ? 1 : 0;
        $enquiry4                   = (Input::has('enquiry4')) ? 1 : 0;
        $remark                     = Input::get('remark');
        $current                    = Carbon::now();
        $current_date               = Carbon::parse($current)->format('Y-m-d');
        $current_time               = Carbon::parse($current)->format('H:i:s');
        $paramObj                   = new Enquiry();
//        $paramObj->name             = $name;
        $paramObj->name             = $uppercase_name;
        $paramObj->is_new_patient   = $is_new_patient;
        $paramObj->patient_id       = $patient_id;
        $paramObj->nrc_no           = $nrc_no;
        $paramObj->township_id      = $township_id;
        $paramObj->patient_type_id  = $patient_type_id;
        $paramObj->address          = $address;
        $paramObj->gender           = $gender;
        $paramObj->case_type        = $case_type;
        $paramObj->car_type         = $car_type;
        $paramObj->car_type_id      = $car_type_id;
        $paramObj->having_allergy   = $having_allergy;
        $paramObj->date             = $current_date;
        $paramObj->time             = $current_time;
        $paramObj->phone_no         = $phone_no;
        $paramObj->dob              = date("Y-m-d", strtotime($dob));
        $paramObj->enquiry1         = $enquiry1;
        $paramObj->enquiry2         = $enquiry2;
        $paramObj->enquiry3         = $enquiry3;
        $paramObj->enquiry4         = $enquiry4;
        $paramObj->remark           = $remark;
        $paramObj->status           = "new";
        $result = $this->enquiryRepository->create($paramObj,$services,$allergies);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\EnquiryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Enquiry created ...'));
        }
        else{
            return redirect()->action('Backend\EnquiryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Enquiry did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {

            $enquiry            = $this->enquiryRepository->getObjByID($id);

            //calculate age
            $dob = $enquiry->dob;
            // $dob = Carbon::parse($enquiry->dob)->format('d-m-Y');

            if($dob == "30-11--0001" || $dob == "0000-00-00" || $dob == "00-00-0000"){
                $dob = "01-01-1970";
                $enquiry->dob = "01-01-1970";
            }


            $age = Utility::calculateAge($dob);

            $patientTypes       = Utility::getSettingsByType("PATIENT_TYPE");

            $townshipRepo       = new TownshipRepository();
            $townships          = $townshipRepo->getObjs();

            $carTypeRepo        = new CartypeRepository();
            $carTypesRaws       = $carTypeRepo->getArrays();
            $carTypes           = array();

            if(isset($carTypesRaws) && count($carTypesRaws)>0) {
                foreach($carTypesRaws as $carTypesRaw){
                    $carTypes[$carTypesRaw->id] = $carTypesRaw->name;
                }
            }

            return view('backend.enquiry.enquiry')
                ->with('patientTypes', $patientTypes)
                ->with('townships', $townships)
                ->with('carTypes', $carTypes)
                ->with('enquiry', $enquiry)
                ->with('enquiry_id', $id)
                ->with('age',$age);
        }
        return redirect('/');
    }

    public function update(EnquiryEditRequest $request){

        $request->validate();
        $id                         = Input::get('id');
        $is_new_patient             = Input::get('is_new_patient');
        $name                       = Input::get('name');
        $uppercase_name             = strtoupper($name);

        $patient_id                 = Input::get('patient_id');
        $nrc_no                     = Input::get('nrc_no');
        $township_id                = Input::get('township_id');
        $patient_type_id            = Input::get('patient_type_id');
        $address                    = Input::get('address');
        $gender                     = Input::get('gender');
        $case_type                   = (Input::has('case_type')) ? 1 : 0;
        $car_type                   = Input::get('car_type');

        if($car_type != 3) {
            $car_type_id            = 0;
        }
        else{
            $car_type_id            = Input::get('car_type_id');
        }

        $services                   = Input::get('services');
        $having_allergy             = Input::get('having_allergy');
        $allergies                  = Input::get('allergies');
        $date                       = Input::get('date');
        $time                       = Input::get('time');
        $phone_no                   = Input::get('phone_no');
        $dob                        = Input::get('dob');
        $enquiry1                   = (Input::has('enquiry1')) ? 1 : 0;
        $enquiry2                   = (Input::has('enquiry2')) ? 1 : 0;
        $enquiry3                   = (Input::has('enquiry3')) ? 1 : 0;
        $enquiry4                   = (Input::has('enquiry4')) ? 1 : 0;
        $remark                     = Input::get('remark');

        $paramObj                   = Enquiry::where('id',$id)->first();
//        $paramObj->name             = $name;
        $paramObj->name             = $uppercase_name;
        $paramObj->is_new_patient   = $is_new_patient;
        $paramObj->patient_id       = $patient_id;
        $paramObj->nrc_no           = $nrc_no;
        $paramObj->township_id      = $township_id;
        $paramObj->patient_type_id  = $patient_type_id;
        $paramObj->address          = $address;
        $paramObj->gender           = $gender;
        $paramObj->case_type        = $case_type;
        $paramObj->car_type         = $car_type;
        $paramObj->car_type_id      = $car_type_id;
        $paramObj->having_allergy   = $having_allergy;
        $paramObj->date             = date("Y-m-d", strtotime($date));
        $paramObj->time             = $time;
        $paramObj->phone_no         = $phone_no;
        $paramObj->dob              = date("Y-m-d", strtotime($dob));
        $paramObj->enquiry1         = $enquiry1;
        $paramObj->enquiry2         = $enquiry2;
        $paramObj->enquiry3         = $enquiry3;
        $paramObj->enquiry4         = $enquiry4;
        $paramObj->remark           = $remark;

        if($paramObj->status == "cancel"){
            $paramObj->status           = "new";
        }

        $result = $this->enquiryRepository->update($id,$paramObj,$services,$allergies);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\EnquiryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Enquiry updated ...'));
        }
        else{
            return redirect()->action('Backend\EnquiryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Enquiry did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->enquiryRepository->delete($id);
        }
        return redirect()->action('Backend\EnquiryController@index')
            ->withMessage(FormatGenerator::message('Success', 'Enquiry deleted ...'));

    }

    public function confirm()
    {
        if (Auth::guard('User')->check()) {

            return view('backend.schedule.schedule')
                ->with('id', 1);
//            return redirect()->action('Backend\ScheduleController@create')
//                ->with('id', 1)
//                ->withMessage(FormatGenerator::message('Success', 'Enquiry confirmed ...'));
        }
        return redirect('/');
    }

    public function cancel()
    {
        if (Auth::guard('User')->check()) {

            $id = Input::get('enquiry_cancel_id');
            $paramObj = Enquiry::find($id);
            $paramObj->status = 'cancel';

            $result = $this->enquiryRepository->cancel($paramObj);

            if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
                return redirect()->action('Backend\EnquiryController@index')
                    ->withMessage(FormatGenerator::message('Success', 'Enquiry canceled ...'));
            }
            else{
                return redirect()->action('Backend\EnquiryController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Enquiry did not cancel ...'));
            }
        }
        return redirect('/');
    }

    public function search($enquiry_status = null, $enquiry_case_type = null, $from_date = null, $to_date = null)
    {
        if (Auth::guard('User')->check()) {

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");
            $userRepo = new User\UserRepository();
            $usersRaw       = $userRepo->getArrays();
            $users          = array();
            foreach($usersRaw as $key=>$user) {
                $users[$user->id] = $user;
            }


            $servicesArray = array();
            $serviceRepo = new ServiceRepository();
            $servicesRaw = $serviceRepo->getArrays();
            foreach($servicesRaw as $key=>$service) {
                $servicesArray[$service->id] = $service;
            }

            //$enquiries      = $this->enquiryRepository->getArrays($enquiry_status, $enquiry_case_type, $from_date, $to_date);
            $enquiries      = $this->enquiryRepository->getObjs($enquiry_status, $enquiry_case_type, $from_date, $to_date);

            if(isset($enquiries) && count($enquiries)>0) {
                foreach($enquiries as $key=>$enquiry){
                    $enquiries[$key]->patient_type = $patientTypes[$enquiry->patient_type_id];
                    $enquiries[$key]->received_by  = $users[$enquiry->created_by]->name;

                    //get service from enquiry_detail
                    $enquiry_id = $enquiry->id;
                    $type = "service";

                    $enquiry_details = $this->enquiryRepository->getEnquiryDetail($enquiry_id,$type);
                    foreach($enquiry_details as $detail){
                        $service_id = $detail->service_id;
                        if(array_key_exists('services',$enquiries[$key])){
                            $enquiries[$key]->services  .= ','.$servicesArray[$service_id]->name;
                        }
                        else{
                            $enquiries[$key]->services  = $servicesArray[$service_id]->name;
                        }
                    }
                }
            }
            
            return view('backend.enquiry.index')
                ->with('enquiries', $enquiries)
                ->with('enquiry_status', $enquiry_status)
                ->with('enquiry_case_type', $enquiry_case_type)
                ->with('from_date', $from_date)
                ->with('to_date', $to_date);
        }
        return redirect('/');
    }

}
