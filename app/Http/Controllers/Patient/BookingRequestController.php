<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/25/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Enquiry\Enquiry;
use App\Backend\Enquiry\EnquiryRepositoryInterface;
use App\Backend\Infrastructure\Forms\BookingEntryRequest;
use App\Backend\Infrastructure\Forms\EnquiryEntryRequest;
use App\Backend\Package\PackageRepository;
use App\Backend\Packagesale\PackageSaleRepository;
use App\Backend\Patient\PatientRepository;
use App\Backend\Service\ServiceRepository;
use App\Backend\Township\TownshipRepository;
use App\Backend\Zone\ZoneRepository;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BookingRequestController extends Controller
{
    private $repo;

    public function __construct(EnquiryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;

            $patientRepo = new PatientRepository();
            $result      = $patientRepo->getObjByID($id);
            $patient    = $result['result'];

            $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');                //change the date-format from DB

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");
            $patientType = "LOCAL";             //set default value
            foreach($patientTypes as $key=>$value){
                if($key == $patient->patient_type_id){
                    $patientType = $value;
                }
            }
            $carTypeRepo        = new CartypeRepository();
            $carTypesRaws        = $carTypeRepo->getArrays();
            $carTypes           = array();

            if(isset($carTypesRaws) && count($carTypesRaws)>0) {
                foreach($carTypesRaws as $carTypesRaw){
                    $carTypes[$carTypesRaw->id] = $carTypesRaw->name;
                }
            }

            $allergyRepo    = new AllergyRepository();
            $allergyFood      = $allergyRepo->getArraysByType('food');
            $allergyDrug      = $allergyRepo->getArraysByType('drug');
            $allergies      = array();
            $allergies['food']      = $allergyFood;
            $allergies['drug']      = $allergyDrug;

            $serviceRepo = new ServiceRepository();
            $services      = $serviceRepo->getObjs();

            $townshipRepo   = new TownshipRepository();
            $townships      = $townshipRepo->getObjs();

            $packageNamesArray = array();
            $count = 0;

            $packageSaleRepo = new PackageSaleRepository();
            $packages       = $packageSaleRepo->getObjByPatientId($id);

            $packageRepo = new PackageRepository();

            foreach($packages as $package){
                $packageNamesArray[$count] = $packageRepo->getPackageName($package->package_id);
                $count++;
            }

            return view('patient.bookingrequest.bookingrequest')
                ->with('patient',$patient)
                ->with('patientDob',$patientDob)
                ->with('patientTypes',$patientTypes)
                ->with('patientType',$patientType)
                ->with('carTypes',$carTypes)
                ->with('services',$services)
                ->with('townships',$townships)
                ->with('allergies',$allergies)
                ->with('packageNamesArray',$packageNamesArray);
        }
        return redirect('/');
    }

    public function store(BookingEntryRequest $request)
    {
        $request->validate();
        $user_id                    = Input::get('user_id');
        $is_new_patient             = 0;
        $name                       = Input::get('patient_name');
        $patient_id                 = Input::get('lbl_staff_id');
        $nrc_no                     = Input::get('nrc_no');
        $township_id                = Input::get('township_id');

        $patient_type_id            = Input::get('patient_type_id');
        $address                    = Input::get('patient_address');
        $gender                     = Input::get('gender');
        $case_type                  = 0;
        $car_type                   = Input::get('car_type');

        if($car_type != 3) {
            $car_type_id            = 0;
        }
        else{
            $car_type_id            = Input::get('car_type_id');
        }

        $services                   = Input::get('services');
        $having_allergy             = Input::get('having_allergy');

        $patientRepo                = new PatientRepository();
        $result                     = $patientRepo->getObjByID($user_id);
        $patient                    = $result['result'];

        $allergyArray               = array();
        $allergiesObj               = $patient->allergies;
        $foodAllergyCount           = 0;
        $drugAllergyCount           = 0;
        $count                      = 0;
        foreach($allergiesObj['food'] as $allergy){
            if($allergy->selected == 1){
                $allergyArray[$count] = $allergy->id;
                $count++;
            }
        }

        foreach($allergiesObj['drug'] as $allergy){
            if($allergy->selected == 1){
                $allergyArray[$count] = $allergy->id;
                $count++;
            }
        }
        $allergies                  = $allergyArray;

        $date                       = Input::get('date');
        $time                       = Input::get('time');
        $phone_no                   = Input::get('phone_no');
        $dob                        = Input::get('dob');
        $remark                     = Input::get('remark');

        $paramObj                   = new Enquiry();
        $paramObj->name             = $name;
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

        $paramObj->remark           = $remark;
        $paramObj->status           = "new";

        $result = $this->repo->create($paramObj,$services,$allergies);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Patient\BookingRequestController@create')
                ->withMessage(FormatGenerator::message('Success', 'Booking Request created ...'));
        }
        else{
            return redirect()->action('Patient\BookingRequestController@create')
                ->withMessage(FormatGenerator::message('Fail', 'Booking Request did not create ...'));
        }
    }
}
