<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/9/2016
 * Time: 4:46 PM
 */

namespace App\Http\Controllers\Backend;

use App\Backend\Cartypesetup\Cartypesetup;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Packagesale\PackageSaleRepository;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ScheduleEntryRequest;
use App\Backend\Infrastructure\Forms\ScheduleEditRequest;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Backend\Schedule\Schedule;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;
use App\Backend\Township\TownshipRepository;
use App\Backend\Service\ServiceRepository;
use App\Backend\Allergy\AllergyRepository;
use App\Core\User\UserRepository;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Enquiry\EnquiryRepository;
use App\User;
use App\Backend\Enquiry\Enquiry;
use App\Backend\Package\Package;

class ScheduleController extends Controller
{
    private $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index()
    {
        try{
            if (Auth::guard('User')->check()) {

                $schedule_status = 'all';
                $from_date = null;
                $to_date = null;

                $patientTypes   = Utility::getSettingsByType("PATIENT_TYPE");
                $userRepo = new UserRepository();
                $usersRaw       = $userRepo->getArrays();
                $users          = array();
                foreach($usersRaw as $key=>$user) {
                    $users[$user->id] = $user;
                }

                $patientRepo = new PatientRepository();
                $patientsRaw       = $patientRepo->getArrays();
                $patients          = array();
                foreach($patientsRaw as $key=>$patient) {
                    $patients[$patient->user_id] = $patient;
                }

                $servicesArray = array();
                $serviceRepo = new ServiceRepository();
                $servicesRaw = $serviceRepo->getArrays();
                foreach($servicesRaw as $key=>$service) {
                    $servicesArray[$service->id] = $service;
                }

                $schedules      = $this->scheduleRepository->getArrays($schedule_status , $from_date , $to_date );
                
                if(isset($schedules) && count($schedules)>0) {
                    foreach ($schedules as $key => $schedule) {
                        $tempPatientId = $schedule->patient_id;
                        $patientTypeId = $patients[$tempPatientId]->patient_type_id;
                        
                        $patientName = $patients[$tempPatientId]->name;
                        $schedules[$key]->patient_type = $patientTypes[$patientTypeId];
                        $schedules[$key]->patient_name = $patientName;

                        //get leader id
                        $leader_id = $schedule->leader_id;
                        $schedules[$key]->leader = $users[$leader_id]->name;

                         //get service from schedule_detail
                         $schedule_id = $schedule->id;
                         $type = "service";
                         
                        //  $schedule_details = $this->scheduleRepository->getScheduleDetailService($schedule_id,$type);
                         $schedule_details = $this->scheduleRepository->getScheduleDetailServices($schedule_id,$type);
                        if(isset($schedule_details) && count($schedule_details)>0){
                            foreach($schedule_details as $detail){
                                $service_id = $detail->service_id;
                                if(array_key_exists('services',$schedules[$key])){
                                    $schedules[$key]->services  .= ','.$servicesArray[$service_id]->name;    
                                }
                                else{
                                    $schedules[$key]->services  = $servicesArray[$service_id]->name;    
                                }                        
                            }
                        }
                        else{
                            $schedules[$key]->services  = "";    
                        }                         
                    }
                }
                
                return view('backend.schedule.index')
                    ->with('schedules', $schedules)
                    ->with('schedule_status', $schedule_status)
                    ->with('from_date', $from_date)
                    ->with('to_date', $to_date);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/schedule');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {

            $inputAll = Input::all();
            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");
            $enquiryRepo = new EnquiryRepository();
            $patient = array();
            $enquiry = array();
            $patient_package = array();
            $patient_package_info = array();
            $servicesArray = array();
            $patient_package_schedule_no = "";
            $is_new_patient = 0;
            $patient_id = 0;

            $is_new = 0;
            $is_edit = 0;
            $is_enquiry_confirm = 0;
            $is_schedule_package = 0;

            // come from enquiry case
            $enquiry_confirm_id = (Input::has('enquiry_confirm_id')) ? Input::get('enquiry_confirm_id') : 0;
            $new_schedule = (Input::has('enquiry_confirm_id')) ? 1 : 0;

            if(Input::has('enquiry_confirm_id')){
                $enquiry      = $enquiryRepo->getArrayByID($enquiry_confirm_id);

                if(isset($enquiry) && count($enquiry)>0){
                    $patient = $enquiry->patient;
                    $patient_id = $enquiry->patient_id;
                    $is_new_patient = $enquiry->is_new_patient;
                }

                $is_enquiry_confirm = 1;
            }
            else{
                $is_new = 1;
            }

            if($is_new_patient != 0) {
                $patientRepo        = new PatientRepository();
                $patient            = $patientRepo->getObjByID($patient_id);
            }

            // come from the patient package case
            $patient_package_id = (Input::has('patient_package_id')) ? Input::get('patient_package_id') : "";
            if(Input::has('patient_package_id')){

                $is_schedule_package = 1;
                $packageSaleRepo = new PackageSaleRepository();
                $patient_package = $packageSaleRepo->getObjByID($patient_package_id);

                if(isset($patient_package) && count($patient_package)>0){

                    $patientPackgeDetails = $packageSaleRepo->getDetails($patient_package->id);

                    foreach($patientPackgeDetails as $details){
                        $serviceRepo = new ServiceRepository();
                        $serviceName = $serviceRepo->getServiceName($details->service_id);
                        $servicesArray[$details->service_id] = $serviceName;
                    }

                    $package_usage_count = $patient_package->package_usage_count;
                    $package_used_count = $patient_package->package_used_count;

                    if($package_usage_count == $package_used_count) {
                        //return Patient Package's schedule count is complete !
                        return redirect('/packagesale/schedule/' . $patient_package_id)
                            ->withMessage(FormatGenerator::message('Fail', 'This schedule has already created all schedules !'));
                    }
                    else{

                        $patient_id     = $patient_package->patient_id;
                        $patientRepo    = new PatientRepository();
                        $result         = $patientRepo->getObjByID($patient_id);
                        $patient        = $result['result'];
                        $is_new_patient = 0;
                        $patient_package_schedule_no = $package_used_count + 1;
                        $patient_package_info = Package::find($patient_package->package_id);
                    }

                }
                else{
                    //return Invalid patient package message
                    return redirect('/packagesale')
                        ->withMessage(FormatGenerator::message('Fail', 'Invalid package sales !'));
                }
            }
            else{
                $is_new = 1;
            }

            $townshipRepo       = new TownshipRepository();
            $townshipsRaws      = $townshipRepo->getArrays();
            $townships          = array();

            if(isset($townshipsRaws) && count($townshipsRaws)>0) {
                foreach($townshipsRaws as $townshipsRaw){
                    $townships[$townshipsRaw->id] = $townshipsRaw->name;
                }
            }

            $serviceRepo            = new ServiceRepository();
            $services               = $serviceRepo->getObjs();

            $allergyRepo            = new AllergyRepository();
            $allergyFood            = $allergyRepo->getArraysByType('food');
            $allergyDrug            = $allergyRepo->getArraysByType('drug');
            $allergyEnvironment     = $allergyRepo->getArraysByType('environment');
            $allergies              = array();
            $allergies['food']      = $allergyFood;
            $allergies['drug']      = $allergyDrug;
            $allergies['environment']      = $allergyEnvironment;

            $carTypes               = array();
            $car_type_setup_arr     = Cartypesetup::select('car_type_id')->distinct()->whereNull('deleted_at')->get();
            if(isset($car_type_setup_arr) && count($car_type_setup_arr) > 0){
                foreach($car_type_setup_arr as $car_type_setup){
                    $carTypes[$car_type_setup->car_type_id] = $car_type_setup->car_type->name;
                }
            }

            $hhcsPersonals = $this->scheduleRepository->getHHCSPersonal();
            $patientRepo = new PatientRepository();
            $patients = $patientRepo->getArrays();

            $currentUserID = Utility::getCurrentUserID();
            
            return view('backend.schedule.schedule')
                ->with('enquiry_confirm_id', $enquiry_confirm_id)
                ->with('new_schedule', $new_schedule)
                ->with('is_new_patient', $is_new_patient)
                ->with('patient_id', $patient_id)
                ->with('patientTypes', $patientTypes)
                ->with('services', $services)
                ->with('patient', $patient)
                ->with('patients', $patients)
                ->with('enquiry', $enquiry)
                ->with('townships', $townships)
                ->with('carTypes', $carTypes)
                ->with('hhcsPersonals', $hhcsPersonals)
                ->with('allergies', $allergies)
                ->with('is_new', $is_new)
                ->with('is_edit', $is_edit)
                ->with('is_schedule_package', $is_schedule_package)
                ->with('is_enquiry_confirm', $is_enquiry_confirm)
                ->with('patient_package', $patient_package)
                ->with('patient_package_id', $patient_package_id)
                ->with('patient_package_info', $patient_package_info)
                ->with('patient_package_schedule_no', $patient_package_schedule_no)
                ->with('servicesArray', $servicesArray)
                ->with('currentUserID', $currentUserID);
        }
        return redirect('/');
    }

    public function store(ScheduleEntryRequest $request)
    {
        $request->validate();
        $inputAll                   = Input::all();
        $is_new_patient             = (Input::has('is_new_patient')) ? Input::get('is_new_patient') : 0;
        $enquiry_confirm_id         = (Input::has('enquiry_id')) ? Input::get('enquiry_id') : 0;
        $patient_id                 = (Input::has('patient_id')) ? Input::get('patient_id') : 0;
        $date                       = (Input::has('date')) ? Input::get('date') : "";
        $time                       = (Input::has('time')) ? Input::get('time') : "";
        $phone_no                   = (Input::has('phone_no')) ? Input::get('phone_no') : "";
        $township_id                = (Input::has('township_id')) ? Input::get('township_id') : "";
//        $zone_id                    = (Input::has('zone_id')) ? Input::get('zone_id') : "";
        $remark                     = (Input::has('remark')) ? Input::get('remark') : "";
        $patient_package_id         = (Input::has('patient_package_id')) ? Input::get('patient_package_id') : "";
        $leader_id                  = (Input::has('leader_id')) ? Input::get('leader_id') : 0;
        $address                    = (Input::has('address')) ? Input::get('address') : "";
        $car_type                   = Input::get('car_type');
        if($car_type != 3) {
            $car_type_id            = 0;
        }
        else{
            $car_type_id            = Input::get('car_type_id');
        }
        $services                   = Input::get('services');
        $hhcsPersonnels             = Input::get('hhcs_personnel');

        $enquiry_id                 = (isset($enquiry_confirm_id) && $enquiry_confirm_id != "0")?$enquiry_confirm_id:"";

        //Get zone_id
        if($enquiry_confirm_id == "0"){
            $patient = Patient::find($patient_id);
            $zone_id = $patient->zone_id;
        }
        else{
            $enquiry = Enquiry::find($enquiry_id);
            $zone_id = $enquiry->zone_id;
        }

        $car_type_setup_id = 0;
        if($car_type == 3 && isset($zone_id) && $car_type_id != 0){
            $car_type_setup = Cartypesetup::where('car_type_id',$car_type_id)->where('zone_id',$zone_id)->first();
            if(isset($car_type_setup) && count($car_type_setup)){
                $car_type_setup_id = $car_type_setup->id;
            }
        }

        $paramObj                   = new Schedule();
        $paramObj->enquiry_id       = $enquiry_id;
        $paramObj->patient_id       = $patient_id;
        $paramObj->township_id      = $township_id;
        $paramObj->car_type         = $car_type;
        $paramObj->car_type_id      = $car_type_id;
        $paramObj->car_type_setup_id= $car_type_setup_id;
        $paramObj->date             = date("Y-m-d", strtotime($date));
        $paramObj->time             = $time;
        $paramObj->phone_no         = $phone_no;
        $paramObj->zone_id          = $zone_id;
        $paramObj->remark           = $remark;
        $paramObj->patient_package_id = $patient_package_id;
        $paramObj->leader_id        = $leader_id;
        $paramObj->status           = "new";

        try {
            DB::beginTransaction();
            if($is_new_patient == 1) { // Schedule Saving with creating new patient case // New Patient Case

                $enquiry = Enquiry::find($enquiry_id);
                $userObj = new User();
                $patientObj = new Patient();

                $userObj->name = $enquiry->name;
                $userObj->phone = $phone_no;
                $userObj->email = "";
                $userObj->role_id = 5;
                $userObj->address = $address;

                $patientObj->name = $enquiry->name;
                $patientObj->nrc_no = $enquiry->nrc_no;
                $patientObj->email = "";
                $patientObj->patient_type_id = $enquiry->patient_type_id;
                $patientObj->gender = $enquiry->gender;
                $patientObj->phone_no = $enquiry->phone_no;
                $patientObj->address = $enquiry->address;
                $patientObj->township_id = $enquiry->township_id;
                $patientObj->zone_id = $enquiry->zone_id;
                $patientObj->dob = $enquiry->dob;
                $patientObj->having_allergy = $enquiry->having_allergy;
                $patientAllergy = array();
                if($enquiry->having_allergy == 1) {
                    //getting all allergies for enquiry
                    $enquiryRepo = new EnquiryRepository();
                    $allAllergies = $enquiryRepo->getEnquiryDetail($enquiry_id, 'allergy');
                    if(isset($allAllergies) && count($allAllergies)>0) {
                        foreach ($allAllergies as $allergy) {
                            array_push($patientAllergy, $allergy->allergy_id);
                        }
                    }
                }

                $patientRepo = new PatientRepository();
                $logObj = new LogPatientCaseSummary();

                //Saving user obj and patient obj
                $resultPatient = $patientRepo->create(0,$userObj,$patientObj,$patientAllergy,$logObj);
                if($resultPatient['aceplusStatusCode'] ==  ReturnMessage::OK){

                    $createdPatient         = $resultPatient['patient'];
                    $paramObj->patient_id   = $createdPatient->user_id;

                    // Saving Schedule
                    $result = $this->scheduleRepository->create($paramObj,$services,$hhcsPersonnels);

                    if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

                        // Updating the enquiry status to confirm
                        if(isset($enquiry) && count($enquiry)>0){
                            $enquiry->status = "confirm";
                            $enquiry->patient_id = $createdPatient->user_id;
                            $enquiry->save();
                        }

                        DB::commit();
                        return redirect()->action('Backend\ScheduleController@index')
                            ->withMessage(FormatGenerator::message('Success', 'Schedule created ...'));
                    }
                    else{
                        DB::rollBack();
                        return redirect()->action('Backend\ScheduleController@index')
                            ->withMessage(FormatGenerator::message('Fail', 'Schedule did not create ...'));
                    }
                }
                else{
                    DB::rollBack();
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Fail', 'Schedule did not create ...'));
                }
            }
            else{
                // Schedule Saving without creating new patient case
                $result = $this->scheduleRepository->create($paramObj,$services,$hhcsPersonnels);
                if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

                    // Updating the enquiry status to confirm
                    if($enquiry_id !== ""){
                        $enquiry = Enquiry::find($enquiry_id);
                        $enquiry->status = "confirm";
                        $enquiry->save();
                    }
                    if($patient_package_id != "") {
                        // Updating the Package Schedule Used Count
                        $packageSaleRepo = new PackageSaleRepository();
                        $resultPackageScheduleCreate = $packageSaleRepo->createSchedule($patient_package_id);

                        if($resultPackageScheduleCreate['aceplusStatusCode'] ==  ReturnMessage::OK){

                            DB::commit();
                            return redirect()->action('Backend\ScheduleController@index')
                                ->withMessage(FormatGenerator::message('Success', 'Schedule created ...'));
                        }
                        else{
                            DB::rollBack();
                            return redirect()->action('Backend\ScheduleController@index')
                                ->withMessage(FormatGenerator::message('Fail', 'Schedule did not create ...'));
                        }
                    }
                    DB::commit();
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Success', 'Schedule created ...'));
                }
                else{
                    DB::rollBack();
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Fail', 'Schedule did not create ...'));
                }
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->action('Backend\ScheduleController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Schedule did not create ...' . ' Error is - ' . $e->getMessage()));
        }
    }

    public function edit($id){

        if (Auth::guard('User')->check()) {

            $inputAll                       = Input::all();
            $result                         = $this->scheduleRepository->getObjByID($id);
            $patient_package_schedule_no    = "";

            if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

                $schedule           = $result['result'];
                $enquiry_confirm_id = (Input::has('enquiry_confirm_id')) ? Input::get('enquiry_confirm_id') : 0;
                $new_schedule       = (Input::has('enquiry_confirm_id')) ? 1 : 0;
                $patientTypes       = Utility::getSettingsByType("PATIENT_TYPE");

                $enquiryRepo        = new EnquiryRepository();
                $patient            = array();
                $enquiry            = array();

                if(isset($schedule->enquiry_id) && $schedule->enquiry_id != ""){
                    $enquiry        = $enquiryRepo->getArrayByID($schedule->enquiry_id);
                }

                $is_new_patient     = 0;

                $patient_package_info       = array();
                $patient_package_id         = $schedule->patient_package_id;

                if($patient_package_id != "") {
                    $is_schedule_package    = 1;

                    $packageSaleRepo        = new PackageSaleRepository();
                    $patient_package        = $packageSaleRepo->getObjByID($patient_package_id);
                    $patient_package_info   = Package::find($patient_package->package_id);
                }
                else{
                    $is_schedule_package    = 0;
                }

                $patient_id         = $schedule->patient_id;
                $patientRepo        = new PatientRepository();
                $patientRaw         = $patientRepo->getObjByID($patient_id);

                $patient            = $patientRaw['result'];

                $is_new             = 0;
                $is_edit            = 1;
                $is_enquiry_confirm = 0;

                $townshipRepo       = new TownshipRepository();
                $townshipsRaws      = $townshipRepo->getArrays();
                $townships          = array();

                if(isset($townshipsRaws) && count($townshipsRaws)>0) {
                    foreach($townshipsRaws as $townshipsRaw){
                        $townships[$townshipsRaw->id] = $townshipsRaw->name;
                    }
                }

                $serviceRepo        = new ServiceRepository();
                $services           = $serviceRepo->getObjs();

                $allergyRepo        = new AllergyRepository();
                $allergyFood        = $allergyRepo->getArraysByType('food');
                $allergyDrug        = $allergyRepo->getArraysByType('drug');
                $allergies          = array();
                $allergies['food']  = $allergyFood;
                $allergies['drug']  = $allergyDrug;

                $carTypeRepo        = new CartypeRepository();
                $carTypesRaws       = $carTypeRepo->getArrays();
                $carTypes           = array();

                if(isset($carTypesRaws) && count($carTypesRaws)>0) {
                    foreach($carTypesRaws as $carTypesRaw){
                        $carTypes[$carTypesRaw->id] = $carTypesRaw->name;
                    }
                }

                $hhcsPersonals = $this->scheduleRepository->getHHCSPersonal();
                $patientRepo = new PatientRepository();
                $patients = $patientRepo->getArrays();

                return view('backend.schedule.schedule')
                    ->with('enquiry_confirm_id', $enquiry_confirm_id)
                    ->with('new_schedule', $new_schedule)
                    ->with('is_new_patient', $is_new_patient)
                    ->with('patient_id', $patient_id)
                    ->with('patientTypes', $patientTypes)
                    ->with('services', $services)
                    ->with('patient', $patient)
                    ->with('patients', $patients)
                    ->with('enquiry', $enquiry)
                    ->with('townships', $townships)
                    ->with('carTypes', $carTypes)
                    ->with('hhcsPersonals', $hhcsPersonals)
                    ->with('allergies', $allergies)
                    ->with('is_new', $is_new)
                    ->with('is_edit', $is_edit)
                    ->with('schedule', $schedule)
                    ->with('schedule_id', $id)
                    ->with('is_enquiry_confirm', $is_enquiry_confirm)
                    ->with('patient_package_info', $patient_package_info)
                    ->with('patient_package_id', $patient_package_id)
                    ->with('patient_package_schedule_no', $patient_package_schedule_no)
                    ->with('is_schedule_package', $is_schedule_package);
                }
                else{
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Fail', 'Error in loading the schedule to edit !!! '));
                }
        }
        return redirect('/');
    }

    public function update(ScheduleEditRequest $request){
        $inputAll = Input::all();

        $request->validate();
        $id                         = Input::get('id');
        $patient_id                 = Input::get('patient_id');
        $date                       = Input::get('date');
        $time                       = Input::get('time');
        $car_type                   = Input::get('car_type');
        $hhcsPersonnels             = Input::get('hhcs_personnel');
        $leader_id                  = Input::get('leader_id');
        //Get zone_id
        $schedule                   = Schedule::find($id);
        $zone_id                    = $schedule->zone_id;
        if($car_type != 3) {
            $car_type_id            = 0;
        }
        else{
            $car_type_id            = Input::get('car_type_id');
        }

        $car_type_setup_id = 0;
        if($car_type == 3 && isset($zone_id) && $car_type_id != 0){
            $car_type_setup = Cartypesetup::where('car_type_id',$car_type_id)->where('zone_id',$zone_id)->first();
            if(isset($car_type_setup) && count($car_type_setup)){
                $car_type_setup_id = $car_type_setup->id;
            }
        }

        $services                   = Input::get('services');
        $remark                     = Input::get('remark');

        $paramObj                   = Schedule::where('id',$id)->first();
        $paramObj->patient_id       = $patient_id;
        $paramObj->car_type         = $car_type;
        $paramObj->car_type_id      = $car_type_id;
        $paramObj->car_type_setup_id= $car_type_setup_id;
        $paramObj->date             = date("Y-m-d", strtotime($date));
        $paramObj->time             = $time;
        $paramObj->remark           = $remark;
        $paramObj->leader_id        = $leader_id;
        $paramObj->status           = "new";

        $result = $this->scheduleRepository->update($id,$paramObj,$services,$hhcsPersonnels);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ScheduleController@index')
                ->withMessage(FormatGenerator::message('Success', 'Schedule updated ...'));
        }
        else{
            return redirect()->action('Backend\ScheduleController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Schedule did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->scheduleRepository->delete($id);
        }
        return redirect()->action('Backend\ScheduleController@index')
            ->withMessage(FormatGenerator::message('Success', 'Schedule deleted ...'));

    }

    public function cancel()
    {
        if (Auth::guard('User')->check()) {

            $id = Input::get('schedule_cancel_id');
            $paramObj = Schedule::find($id);

            if(isset($paramObj) && count($paramObj)>0) {
                $paramObj->status = 'cancel';

                $result = $this->scheduleRepository->cancel($paramObj);

                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Success', 'Schedule canceled ...'));
                } else {
                    return redirect()->action('Backend\ScheduleController@index')
                        ->withMessage(FormatGenerator::message('Fail', 'Schedule did not cancel ...'));
                }
            }
            else{
                return redirect()->action('Backend\ScheduleController@index')
                    ->withMessage(FormatGenerator::message('Error', 'Invalid Schedule ...'));
            }
        }
        return redirect('/');
    }

    public function search($schedule_status = null, $from_date = null, $to_date = null)
    {
        if (Auth::guard('User')->check()) {

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");
            $userRepo = new UserRepository();
            $usersRaw       = $userRepo->getArrays();
            $users          = array();
            foreach($usersRaw as $key=>$user) {
                $users[$user->id] = $user;
            }

            $patientRepo = new PatientRepository();
            $patientsRaw       = $patientRepo->getArrays();
            $patients          = array();
            foreach($patientsRaw as $key=>$patient) {
                $patients[$patient->user_id] = $patient;
            }

            $schedules      = $this->scheduleRepository->getObjs($schedule_status, $from_date, $to_date);
            if(isset($schedules) && count($schedules)>0) {
                foreach($schedules as $key=>$schedule){

                    $patientId = $schedule->patient_id;
                    $tempPatient = $patients[$patientId];

                    $schedules[$key]->patient_type = $patientTypes[$tempPatient->patient_type_id];
                    $schedules[$key]->received_by  = $users[$schedule->created_by]->name;
                    $schedules[$key]->patient_name = $tempPatient->name;
                }
            }

            return view('backend.schedule.index')
                ->with('schedules', $schedules)
                ->with('schedule_status', $schedule_status)
                ->with('from_date', $from_date)
                ->with('to_date', $to_date);
        }
        return redirect('/');
    }

}
