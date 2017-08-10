<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/26/2016
 * Time: 4:50 PM
 */
namespace App\Http\Controllers\Backend;

use App\Backend\Addendum\Addendum;
use App\Backend\Addendum\AddendumRepository;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Cartype\Cartype;
use App\Backend\Investigation\Investigation;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Patient\PatientRepository;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Scheduledetail\Scheduledetail;
use App\Backend\Service\Service;
use App\Backend\Township\TownshipRepository;
use App\Backend\Zone\ZoneRepository;
use App\Core\User\UserRepositoryInterface;
use App\Core\Utility;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepositoryInterface;
use App\Backend\Infrastructure\Forms\PatientEntryRequest;
use App\Backend\Infrastructure\Forms\PatientEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use InterventionImage;
use App\Backend\Township\Township;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Patientsurgeryhistory\PatientsurgeryhistoryRepository;
use App\Backend\Patientfamilyhistory\PatientfamilyhistoryRepository;
use App\Backend\Familyhistory\FamilyhistoryRepository;
use App\Backend\Familymember\FamilymemberRepository;
use App\Backend\Medicalhistory\MedicalhistoryRepository;
use App\Backend\Patientmedicalhistory\PatientmedicalhistoryRepository;

class PatientController extends Controller
{
    private $repo;

    public function __construct(PatientRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        try{
            if (Auth::guard('User')->check()) {
                $patient      = $this->repo->getPatientWithUser();

                foreach($patient as $value){
                    $value->dob = Carbon::parse($value->dob)->format('d-m-Y');
                }

                $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

                return view('backend.patient.index')
                    ->with('patient', $patient)
                    ->with('patientTypes', $patientTypes);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/patient');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

            $townshipRepo = new TownshipRepository();
//            $townships      = $townshipRepo->getObjs();
            $townships      = $townshipRepo->getTownshipsFromZone();

            $allergyRepo    = new AllergyRepository();
            $allergyFood      = $allergyRepo->getArraysByType('food');
            $allergyDrug      = $allergyRepo->getArraysByType('drug');
            $allergyEnvironment = $allergyRepo->getArraysByType('environment');
            $allergies      = array();
            $allergies['food']      = $allergyFood;
            $allergies['drug']      = $allergyDrug;
            $allergies['environment'] = $allergyEnvironment;

            $zoneRepo = new zoneRepository();
            $zones      = $zoneRepo->getObjs();
            return view('backend.patient.patient')
                ->with('patientTypes', $patientTypes)
                ->with('townships', $townships)
                ->with('zones', $zones)
                ->with('allergies', $allergies);
        }
        return redirect('/');
    }

    public function store(PatientEntryRequest $request)
    {
        $request->validate();

        $name               = (Input::has('name')) ? Input::get('name') : "";
        $password           = (Input::has('password')) ? Input::get('password') : "";
        $patient_type_id    = (Input::has('patient_type_id')) ? Input::get('patient_type_id') : "";
        $nrc_no             = (Input::has('nrc_no')) ? Input::get('nrc_no') : "";
        $dob                = (Input::has('dob')) ? Carbon::parse(Input::get('dob'))->format('Y-m-d') : "";
        $townships          = (Input::has('townships')) ? Input::get('townships') : "";
        $address            = (Input::has('address')) ? Input::get('address') : "";
        $having_allergy     = (Input::has('having_allergy')) ? Input::get('having_allergy') : 0;

        if(isset($having_allergy) && $having_allergy == 1){
             $allergies   = Input::get('allergies');
        }
        else{
            $allergies = null;
        }

        $active             = (Input::has('active')) ? 1 : 0;
        $phone_no           = (Input::has('phone_no')) ? Input::get('phone_no') : "";
        $gender             = (Input::has('gender')) ? Input::get('gender') : "male";
        $email              = (Input::has('email')) ? Input::get('email') : "";

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/users/';

        if(Input::hasFile('photo'))
        {
            $photo        = Input::file('photo');

            //$photo_name   = Utility::saveImage($photo,$path);
            $photo_name_original    = Utility::getImage($photo);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name = "";
        }

        if($removeImageFlag == 1){
            $photo_name = "";
        }
        //End Saving Image

        $case_scenario   = (Input::has('case_scenario')) ? Input::get('case_scenario') : "";
        $remark          = (Input::has('remark')) ? Input::get('remark') : "";

        //create user object
        $userObj = new User();
        $userObj->name              = $name;
        $userObj->password          = $password;
        $userObj->phone             = $phone_no;
        $userObj->email             = $email;
        if(isset($photo)){
            $userObj->display_image = $photo_name;
            $userObj->mobile_image  = base64_encode($image->encoded);
        }
        $userObj->role_id           = 5;
        $userObj->address           = $address;
        $userObj->active            = $active;

        //create patient object
        $paramObj                       = new Patient();
        $paramObj->name                 = $name;
        $paramObj->patient_type_id      = $patient_type_id;
        $paramObj->nrc_no               = $nrc_no;
        $paramObj->dob                  = $dob;
        $paramObj->township_id          = $townships;
        $paramObj->address              = $address;
        $paramObj->having_allergy       = $having_allergy;
        $paramObj->phone_no             = $phone_no;
        $paramObj->gender               = $gender;
        $paramObj->email                = $email;
        $paramObj->case_scenario        = $case_scenario;
        $paramObj->remark               = $remark;

        //create log patient case summary
        $prefix = Utility::getTerminalId();
        $table = (new LogPatientCaseSummary())->getTable();
        $col = "id";
        $offset = 1;
        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);
        $logObj                         = new LogPatientCaseSummary();
        $logObj->id                     = $generatedId;
        $logObj->case_summary           = $case_scenario;
        
        //save user obj and patient obj
        $result = $this->repo->create($flag = 1, $userObj,$paramObj,$allergies,$logObj); //$flag=1 is for including DB::beginTransaction() and 0 is not

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            $created_id = $result['patient']->user_id;
            alert()->success('Patient successfully created with ID '.$created_id)->persistent('OK');
            return redirect()->action('Backend\PatientController@index');
        }
        else{
            return redirect()->action('Backend\PatientController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Patient did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {

            $result = $this->repo->getObjByID($id);
            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $patient = $result['result'];

                $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');                //change the date-format from DB

                if($patientDob == "30-11--0001"){
                    $patientDob = "01-01-1970";
                }

                $patientAge = Utility::calculateAge($patientDob);

                $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

                $user = DB::table('core_users')->where('id', $id)->first();

                $townshipRepo = new TownshipRepository();
                $townships = $townshipRepo->getObjs();

                $allergyRepo    = new AllergyRepository();
                $allergyFood      = $allergyRepo->getArraysByType('food');
                $allergyDrug      = $allergyRepo->getArraysByType('drug');
                $allergyEnvironment = $allergyRepo->getArraysByType('environment');
                $allergies      = array();
                $allergies['food']      = $allergyFood;
                $allergies['drug']      = $allergyDrug;
                $allergies['environment']      = $allergyEnvironment;

                $zoneRepo = new zoneRepository();
                $zones = $zoneRepo->getObjs();

                if($user->display_image == "" || is_null($user->display_image) ){
                    $user->display_image = "user.jpg";
                }

                return view('backend.patient.patient')
                    ->with('patient', $patient)
                    ->with('user', $user)
                    ->with('patientTypes', $patientTypes)
                    ->with('townships', $townships)
                    ->with('zones', $zones)
                    ->with('allergies', $allergies)
                    ->with('patientDob', $patientDob)
                    ->with('patientAge', $patientAge);
            }
            else{
                return redirect()->action('Backend\PatientController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the patient to edit !!! '));
            }

        }
        return redirect('/');
    }

    public function update(PatientEditRequest $request){
        $request->validate();

        $id = Input::get('id');

        $name               = (Input::has('name')) ? Input::get('name') : "";
        $patient_type_id    = (Input::has('patient_type_id')) ? Input::get('patient_type_id') : "";
        $nrc_no             = (Input::has('nrc_no')) ? Input::get('nrc_no') : "";
        $dob                = (Input::has('dob')) ? Carbon::parse(Input::get('dob'))->format('Y-m-d') : "";
        $townships          = (Input::has('townships')) ? Input::get('townships') : "";
        $address            = (Input::has('address')) ? Input::get('address') : "";
        $having_allergy     = (Input::has('having_allergy')) ? Input::get('having_allergy') : 0;

        if(isset($having_allergy) && $having_allergy == 1){
            $allergies   = Input::get('allergies');
        }
        else{
            $allergies = null;
        }

        $active             = (Input::has('active')) ? 1 : 0;
        $phone_no           = (Input::has('phone_no')) ? Input::get('phone_no') : "";
        $gender             = (Input::has('gender')) ? Input::get('gender') : "male";
        $email              = (Input::has('email')) ? Input::get('email') : "";

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/users/';

        if(Input::hasFile('photo'))
        {
            $photo        = Input::file('photo');
            //$photo_name_original   = Utility::saveImage($photo,$path);
            $photo_name_original   = Utility::getImage($photo);
            $photo_ext   = Utility::getImageExt($photo);
            $photo_name = uniqid() . "." . $photo_ext;
            $image        = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name = "";
        }

        if($removeImageFlag == 1){
            $photo_name="";
        }
        //End Saving Image

        $case_scenario   = (Input::has('case_scenario')) ? Input::get('case_scenario') : "";
        $remark          = (Input::has('remark')) ? Input::get('remark') : "";

        //find patient object
        $paramObj = Patient::find($id);

        //bind params to patient obj
        $paramObj->name             = $name;
        $paramObj->patient_type_id  = $patient_type_id;
        $paramObj->nrc_no           = $nrc_no;
        $paramObj->dob              = $dob;
        $paramObj->township_id      = $townships;
        $paramObj->address          = $address;
        $paramObj->having_allergy   = $having_allergy;
        $paramObj->phone_no         = $phone_no;
        $paramObj->gender           = $gender;
        $paramObj->email            = $email;
        $paramObj->case_scenario    = $case_scenario;
        $paramObj->remark           = $remark;

        //  find user object
        $userObj = User::find($paramObj->user_id);
        //bind params to user obj
        $userObj->name              = $name;
        $userObj->phone             = $phone_no;
        $userObj->email             = $email;

        $existingUserImage = $userObj->display_image;

        if(isset($photo)){
             $userObj->display_image = $photo_name;
             $userObj->mobile_image = base64_encode($image->encoded);
        }

        //without this condition, when image is removed in update, it won't be removed in DB
        if($removeImageFlag == 1){
            $userObj->display_image     = "";
            $userObj->mobile_image = null;
        }

        $userObj->role_id           = 5;
        $userObj->address           = $address;
        $userObj->active            = $active;

        //create log patient case summery
        $prefix                 = Utility::getTerminalId();
        $table                  = (new LogPatientCaseSummary())->getTable();
        $col                    = "id";
        $offset                 = 1;
        $generatedId            = Utility::generatedId($prefix,$table,$col,$offset);
        $logObj                 = new LogPatientCaseSummary();
        $logObj->id             = $generatedId;
        $logObj->case_summary   = $case_scenario;

        //  update patient obj and user obj
        $result = $this->repo->update($userObj,$paramObj,$allergies,$logObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

            if($removeImageFlag == 1){
                Utility::deleteImage($path . $existingUserImage);
            }

            if(isset($photo)){
                Utility::deleteImage($path . $existingUserImage);
            }

            return redirect()->action('Backend\PatientController@index')
                ->withMessage(FormatGenerator::message('Success', 'Patient updated ...'));
        }
        else{
            return redirect()->action('Backend\PatientController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Patient did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $logObj               = new LogPatientCaseSummary();
            $logObj->case_summary ="DELETE";

            $this->repo->delete($id,$logObj);
        }
        return redirect()->action('Backend\PatientController@index')
            ->withMessage(FormatGenerator::message('Success', 'Patient deleted ...'));
    }

    public function checkZone($id){
        $zone_id = DB::table('zone_detail')->where('township_id', $id)->value('zone_id');
        $zone = DB::table('zones')->where('id', $zone_id)->value('name');
        return \Response::json($zone);
    }

    public function profile($id){
        $result = $this->repo->getObjByID($id);
        $tempObj = $result['result'];
        if(isset($tempObj) && count($tempObj)>0 ){
            $township_id = $tempObj->township_id;
            $township = Township::find($township_id);
            $tempObj->township = $township;
        }

        return \Response::json($tempObj);
    }

    public function detail($id){
        if (Auth::guard('User')->check()) {

            $result = $this->repo->getObjByID($id);

            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $patient = $result['result'];

                $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');                //change the date-format from DB

                $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

                $users = DB::table('core_users')->where('id', $id)->first();

                $townshipRepo = new TownshipRepository();
                $townships = $townshipRepo->getObjs();

                $allergyRepo = new AllergyRepository();
                $allergies = $allergyRepo->getObjs();

                $zoneRepo = new zoneRepository();
                $zones = $zoneRepo->getObjs();

                $cartypeRepo = new CartypeRepository();
                $carTypes = $cartypeRepo->getArraysByOrder();

                $medicalhistoryRepo = new MedicalhistoryRepository();
                $medicalhistories =   $medicalhistoryRepo->getArraysByOrder();

                $patientmedicalhistoryRepo = new PatientmedicalhistoryRepository();
                $patientmedicalhistories =   $patientmedicalhistoryRepo->getObjByPatientID($id);
                foreach($patientmedicalhistories as $keyMed => $patientmedicalhistory){
                    $patientmedicalhistories[$keyMed]->medicalHistory = $medicalhistories[$patientmedicalhistory->medical_history_id]->name;
                }

                $familymemberRepo = new FamilymemberRepository();
                $familymembers = $familymemberRepo->getArraysByOrder();

                $familyhistoryRepo = new FamilyhistoryRepository();
                $familyhistories = $familyhistoryRepo->getArraysByOrder();

                $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

                $patientfamilyhistoryRepo = new PatientfamilyhistoryRepository();
                $patientfamilyhistories = $patientfamilyhistoryRepo->getObjByPatientID($id);

                foreach($patientfamilyhistories as $keyFam => $patientfamilyhistory){
                    $patientfamilyhistories[$keyFam]->familyMember = $familymembers[$patientfamilyhistory->family_member_id]->name;
                    $patientfamilyhistories[$keyFam]->familyHistory = $familyhistories[$patientfamilyhistory->family_history_id]->name;
                }

                $surgeryRepo = new PatientsurgeryhistoryRepository();
                $patientsurgeryhsitory = $surgeryRepo->getObjByPatientID($id);

                //getting patient's schedules
//                $schedulesRaw = $this->repo->getPatientSchedule($id);
                $schedulesRaw = $this->repo->getPatientScheduleWithInvoice($id); //to get total_payable_amt from invoices table

                $schedules = array();

                foreach($schedulesRaw  as $keySch => $valueSch){
                    // calculation for the enquiry id is zero or not
                    $enquiryId = $valueSch->enquiry_id;
                    if($enquiryId == 0){
                        $schedulesRaw[$keySch]->enquiry_id = "";
                    }
                    // calculation for the car type
                    $cartypeId = $valueSch->car_type;

                    if($cartypeId == 1){
                        $schedulesRaw[$keySch]->car_type_name = "Patient Owned Vehicle";
                    }
                    if($cartypeId == 2){
                        $schedulesRaw[$keySch]->car_type_name = "Rental Vehicle";
                    }
                    if($cartypeId == 3){
                        $schedulesRaw[$keySch]->car_type_name = $carTypes[$valueSch->car_type_id]->name;
                    }
                }
                
                $schedules = $schedulesRaw;

                $img = $users->display_image;

                //Neuro Assessment
                $neuro  = array();
                $neuro_general  = DB::table('patient_physiotherapy_neuro_general')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($neuro_general) && count($neuro_general) > 0){
                    foreach($neuro_general as $general){
                        $neuro['general'][] = $general;
                    }
                }

                $neuro_limb     = DB::table('patient_physiotherapy_neuro_limb')->whereNull('deleted_at')->where('patients_id','=',$id)->get();
                if(isset($neuro_limb) && count($neuro_limb) > 0){
                    foreach($neuro_limb as $limb){
                        $neuro['limb'][]  = $limb;
                    }
                }

                $neuro_functional1 = DB::table('patient_physiotherapy_neuro_functional_performance1')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($neuro_functional1) && count($neuro_functional1) > 0){
                    foreach($neuro_functional1 as $functional1){
                        $neuro['functional1'][] = $functional1;
                    }
                }

                $neuro_functional2 = DB::table('patient_physiotherapy_neuro_functional_performance2')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($neuro_functional2) && count($neuro_functional2) > 0){
                    foreach($neuro_functional2 as $functional2){
                        $neuro['functional2'][] = $functional2;
                    }
                }

                $neuro_functional3 = DB::table('patient_physiotherapy_neuro_functional_performance3')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($neuro_functional3) && count($neuro_functional3)>0){
                    foreach($neuro_functional3 as $functional3){
                        $neuro['functional3'][] = $functional3;
                    }
                }

                //Musculo
                $musculo    = array();
                $patient_musculo_1_2 = DB::table('patient_physiothreapy_musculo_1_and_2')->whereNull('deleted_at')->where('patients_id','=',$id)->get();
                if(isset($patient_musculo_1_2) && count($patient_musculo_1_2)>0){
                    foreach($patient_musculo_1_2 as $musculo_1_2){
                        $musculo['musculo_1_2'][] = $musculo_1_2;
                    }
                }

                $patient_musculo_3_sitting  = DB::table('patient_physiotherapy_musculo_3_sitting')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($patient_musculo_3_sitting) && count($patient_musculo_3_sitting)>0){
                    foreach($patient_musculo_3_sitting as $sitting){
                        $musculo['musculo_3_sitting'][] = $sitting;
                    }
                }

                $patient_musculo_3_standing = DB::table('patient_physiotherapy_musculo_3_standing')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($patient_musculo_3_standing) && count($patient_musculo_3_standing) > 0){
                    foreach($patient_musculo_3_standing as $standing){
                        $musculo['musculo_3_standing'][] = $standing;
                    }
                }

                $patient_musculo_4_1_2 = DB::table('patient_physiotherapy_musculo_4_1and2')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($patient_musculo_4_1_2) && count($patient_musculo_4_1_2)>0){
                    foreach($patient_musculo_4_1_2 as $musculo4) {
                        $musculo['musculo_4_1_2'][] = $musculo4;
                    }
                }

                $patient_musculo_4_3 = DB::table('patient_physiotherapy_musculo_4_3')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($patient_musculo_4_3) && count($patient_musculo_4_3)>0){
                    foreach($patient_musculo_4_3 as $musculo_4_3){
                        $musculo['musculo_4_3'][] = $musculo_4_3;
                    }
                }

                $patient_musculo_4_4_5 = DB::table('patient_physiotherapy_musculo_4_4and5')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
                if(isset($patient_musculo_4_4_5) && count($patient_musculo_4_4_5)>0){
                    foreach($patient_musculo_4_4_5 as $musculo_4_4_5){
                        $musculo['musculo_4_4_5'][] = $musculo_4_4_5;
                    }
                }
                
                return view('backend.patient.detail')
                    ->with('patient', $patient)
                    ->with('users', $users)
                    ->with('img', $img)
                    ->with('patientTypes', $patientTypes)
                    ->with('townships', $townships)
                    ->with('zones', $zones)
                    ->with('allergies', $allergies)
                    ->with('patientDob', $patientDob)
                    ->with('carTypes', $carTypes)
                    ->with('patientmedicalhistories', $patientmedicalhistories)
                    ->with('patientfamilyhistories', $patientfamilyhistories)
                    ->with('patientsurgeryhsitory', $patientsurgeryhsitory)
                    ->with('schedules', $schedules)
                    ->with('patientTypes', $patientTypes)
                    ->with('neuro',$neuro)
                    ->with('musculo',$musculo);

            }
            else{
                return redirect()->action('Backend\PatientController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the patient to edit !!! '));
            }

        }
        return redirect('/');
    }

    public function patientSchedules($id){
        $schedules          = Schedule::whereNull('deleted_at')->where('patient_id',$id)->get();
        $schedule_id_arr    = array();

        foreach($schedules as $sch){
            array_push($schedule_id_arr,$sch->id);
        }
        $schedule_detail    = Scheduledetail::whereIn('schedule_id',$schedule_id_arr)->where('type','=','service')->get();

        $users              = User::whereNull('deleted_at')->get();
        $car_types          = Cartype::whereNull('deleted_at')->get();
        $services           = Service::whereNull('deleted_at')->get();
        $patientSchedules   = array();
        $patient_schedules  = array();
        foreach($schedules as $schedule){
            $patient_schedules['id']   = $schedule->id;
            $patient_schedules['date'] = $schedule->date;
            $patient_schedules['time'] = $schedule->time;
            if($schedule->car_type == 1) $patient_schedules['car_type'] = "Patient Own Vehicle";
            if($schedule->car_type == 2) $patient_schedules['car_type'] = "Rental Vehicle";
            if($schedule->car_type == 3){
                foreach($car_types as $car){
                    if($car->id == $schedule->car_type_id){
                        $patient_schedules['car_type'] = "HHCS Vehicle - ".$car->name;
                    }
                }
            }
            foreach($users as $leader){
                if($leader->id == $schedule->leader_id){
                    $patient_schedules['leader'] = $leader->name;
                }
            }

            foreach($schedule_detail as $detail){
                if($schedule->id == $detail->schedule_id){
                    $patient_schedules['service']=$detail->service->name;
                }
            }
            array_push($patientSchedules,$patient_schedules);
        }
    
        return view('backend.patient.schedules')->with('patientSchedules',$patientSchedules);
    }

    public function detailvisit($id){
        $scheduleRaw                   = Schedule::whereNull('deleted_at')->where('id','=',$id)->first();
        $patient                    = Patient::whereNull('deleted_at')->where('user_id','=',$scheduleRaw->patient_id)->first();
        $valid                      = 0;
        if(isset($patient) && count($patient) >0){
            $valid = 1;
        }
        if($valid == 1){
            $vitals =$chief_complaints  = $gph = $hl = $aen = $investigations = $provisional_diagnosis = $treatments = $other_services = null;
            $neurological = $musculo_intercention = $investigation_imaging = $investigation_ecg = $investigation_other= $nutritions =null ;
            $provisional_diagnosis_remark = "";
            $investigation_lab_remark = "";
            if(isset($scheduleRaw) && count($scheduleRaw)>0){
                $latest_schedule_id     = $scheduleRaw->id;
                $patient_id             = $scheduleRaw->patient_id;
                $schedule_detail        = DB::table('schedule_detail')->where('schedule_id',$latest_schedule_id)->get();
                foreach($schedule_detail as $detail){
                    if($detail->type == 'service'){
                        $service_type = $detail->service_id;
                    }
                }

                $schedule               = new ScheduleRepository();
                $vitals                 = $schedule->getScheduleVitals($latest_schedule_id);
                $chief_complaints       = $schedule->getChiefComplaint($latest_schedule_id);
                $gph                    = $schedule->getGeneralPupilHead($latest_schedule_id);

                $hl                     = $schedule->getHeartLung($latest_schedule_id);
                $aen                    = $schedule->getAbdomenExtreNeuro($latest_schedule_id);
                $investigation_id       = $schedule->getInvestigationId($latest_schedule_id);
                $group_name             = $schedule->getInvestigationGroupName($investigation_id);

//                $investigation_labs     = $schedule->getInvestigations($investigation_id);
                $investigation_labs     = $schedule->getInvestigationLabs($investigation_id);
                $investigations         = array();

//                if(isset($group_name) && count($group_name)>0){
//                    foreach($group_name as $group){
                        foreach($investigation_labs as $lab){

//                            if($group->group_name == $lab->group_name){
//                                if($lab->group_name == 'Haematology1' || $lab->group_name == 'Haematology2'){
//                                    $investigations['Haematology'][] = $lab->name;
//                                }
//                                else{
//                                    $investigations[$group->group_name][] = $lab->name;
//                                }
                                array_push($investigations,$lab->service_name);
//                            }
                        }
//                    }
//                }

                $provisional_id         = $schedule->getScheduleProvisionalDiagnosis($latest_schedule_id);

                //get provisional_diagnosis_remark
                if(isset($provisional_id) && count($provisional_id)>0){
                    $provisional_diagnosis_remark_raw = $schedule->getScheduleProvisionalDiagnosisRemark($latest_schedule_id,$provisional_id[0]['provisional_id']);
                    $provisional_diagnosis_remark     = $provisional_diagnosis_remark_raw["remark"][0];
                }
                else{
                    $provisional_diagnosis_remark     = "";
                }

                $provisional_diagnosis  = $schedule->getProvisionalDiagnosis($provisional_id);

                $treatments             = $schedule->getScheduleTreatment($latest_schedule_id);

                $other_services         = $schedule->getScheduleOtherServices($latest_schedule_id, $patient_id);

                $neurological           = $schedule->getNeurologicalRecords($latest_schedule_id);

                $musculo_intercention   = $schedule->getMusculoIntercentionRecords($latest_schedule_id);

                $nutritions             = $schedule->getNutrition($latest_schedule_id,$patient_id);

                $schedule_investigation = $schedule->getScheduleInvestigation($latest_schedule_id);

                $investigation_imaging_id = array();

                $xray_id_count = $usg_id_count = $ct_id_count = $mri_id_count = $other_id_count = 0;

                $investigation_ecg = $investigation_other = $investigation_imaging_remark = '';

                foreach($schedule_investigation as $investigation){
//                    if($investigation->investigation_id == '' && $investigation->investigation_ecg_remark == '' && $investigation->investigation_other_remark == ''){
                    if($investigation->investigation_id == 0 && $investigation->investigation_ecg_remark == '' && $investigation->investigation_other_remark == ''){
                        if($investigation->investigation_imaging_xray_id != 0){
                            $investigation_imaging_id['xray'][$xray_id_count]   = $investigation->investigation_imaging_xray_id;
                            $xray_id_count++;
                        }
                        if($investigation->investigation_imaging_usg_id != 0){
                            $investigation_imaging_id['usg'][$usg_id_count]   = $investigation->investigation_imaging_usg_id;
                            $usg_id_count++;
                        }
                        if($investigation->investigation_imaging_ct_id != 0){
                            $investigation_imaging_id['ct'][$ct_id_count]   = $investigation->investigation_imaging_ct_id;
                            $ct_id_count++;
                        }
                        if($investigation->investigation_imaging_mri_id != 0){
                            $investigation_imaging_id['mri'][$mri_id_count]   = $investigation->investigation_imaging_mri_id;
                            $mri_id_count++;
                        }
                        if($investigation->investigation_imaging_other_id != 0){
                            $investigation_imaging_id['other'][$other_id_count]   = $investigation->investigation_imaging_other_id;
                            $other_id_count++;
                        }
                    }

                    if($investigation->investigation_ecg_remark != ''){
                        $investigation_ecg  = $investigation->investigation_ecg_remark;
                    }

                    if($investigation->investigation_other_remark != ''){
                        $investigation_other = $investigation->investigation_other_remark;
                    }

                    if($investigation->investigation_imaging_remark != ''){
                        $investigation_imaging_remark = $investigation->investigation_imaging_remark;
                    }
                    //get investigation labs remark
                    if($investigation->investigation_lab_remark != ''){
                        $investigation_lab_remark = $investigation->investigation_lab_remark;
                    }
                }

//                $investigation_imagings     = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id)->get();
                if(isset($investigation_imaging_id) && count($investigation_imaging_id)>0){
                    if(isset($investigation_imaging_id['xray'])){
                        $investigation_imagings['xray']      = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['xray'])->get();
                    }
                    else{
                        $investigation_imagings['xray']      = [];
                    }

                    if(isset($investigation_imaging_id['usg'])){
                        $investigation_imagings['usg']      = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['usg'])->get();
                    }
                    else{
                        $investigation_imagings['usg']      = [];
                    }

                    if(isset($investigation_imaging_id['ct'])){
                        $investigation_imagings['ct']      = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['ct'])->get();
                    }
                    else{
                        $investigation_imagings['ct']      = [];
                    }

                    if(isset($investigation_imaging_id['mri'])){
                        $investigation_imagings['mri']      = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['mri'])->get();
                    }
                    else{
                        $investigation_imagings['mri']      = [];
                    }

                    if(isset($investigation_imaging_id['other'])){
                        $investigation_imagings['other']      = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['other'])->get();
                    }
                    else{
                        $investigation_imagings['other']      = [];
                    }

//                    $investigation_imagings['xray']    = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['xray'])->get();
//                    $investigation_imagings['']     = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['usg'])->get();

//                    $investigation_imagings['']     = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['mri'])->get();
//                    $investigation_imagings['']   = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id['other'])->get();

                $investigation_imaging      = array();

                $xray_service_name = $usg_service_name = $ct_service_name = $mri_service_name = $other_service_name = "";

                foreach($investigation_imagings['xray'] as $imaging_xray){
                    $xray_service_name .= $imaging_xray->service_name .", ";
                }
                foreach($investigation_imagings['usg'] as $imaging_usg){
                    $usg_service_name .= $imaging_usg->service_name .", ";
                }
                foreach($investigation_imagings['ct'] as $imaging_ct){
                    $ct_service_name .= $imaging_ct->service_name .", ";
                }
                foreach($investigation_imagings['mri'] as $imaging_mri){
                    $mri_service_name .= $imaging_mri->service_name .", ";
                }
                foreach($investigation_imagings['other'] as $imaging_other){
                    $other_service_name .= $imaging_other->service_name .", ";
                }

                $xray_service_name = rtrim($xray_service_name,', ');
                $usg_service_name = rtrim($usg_service_name,', ');
                $ct_service_name = rtrim($ct_service_name,', ');
                $mri_service_name = rtrim($mri_service_name,', ');
                $other_service_name = rtrim($other_service_name,', ');

                $investigation_imaging['X-RAY'] = $xray_service_name;
                $investigation_imaging['USG'] = $usg_service_name;
                $investigation_imaging['CT'] = $ct_service_name;
                $investigation_imaging['MRI'] = $mri_service_name;
                $investigation_imaging['Others'] = $other_service_name;
                }

                //start blood drawing
                $blood_drawings             = $schedule->getBloodDrawing($latest_schedule_id,$patient_id);
                $blood_drawings_remark      = $schedule->getBloodDrawingRemark($latest_schedule_id,$patient_id);
                //end blood drawing
                
                if(isset($investigation_imaging) && count($investigation_imaging)>0){
                    if (!array_key_exists("X-RAY",$investigation_imaging)){
                        $investigation_imaging['X-RAY'] = "";
                    }
                    if (!array_key_exists("USG",$investigation_imaging)){
                        $investigation_imaging['USG'] = "";
                    }
                    if (!array_key_exists("CT",$investigation_imaging)){
                        $investigation_imaging['CT'] = "";
                    }
                    if (!array_key_exists("MRI",$investigation_imaging)){
                        $investigation_imaging['MRI'] = "";
                    }
                    if (!array_key_exists("Others",$investigation_imaging)){
                        $investigation_imaging['Others'] = "";
                    }
                }
            }

            //start addendum
            $addendumRepo = new AddendumRepository();
            $addendums    = $addendumRepo->getObjs();
            //end addendum
            
            return view('backend.patient.detailvisit')->with('patient',$patient)
                ->with('schedules',$schedule)
                ->with('vitals',$vitals)
                ->with('chief_complaints',$chief_complaints)
                ->with('gph',$gph)->with('hl',$hl)->with('aen',$aen)
                ->with('investigations',$investigations)
                ->with('investigation_lab_remark',$investigation_lab_remark)
                ->with('provisional_diagnosis',$provisional_diagnosis)
                ->with('provisional_diagnosis_remark',$provisional_diagnosis_remark)
                ->with('treatments',$treatments)->with('neurological',$neurological)
                ->with('musculo_intercention',$musculo_intercention)
                ->with('nutritions',$nutritions)
                ->with('investigation_imaging',$investigation_imaging)
                ->with('investigation_imaging_remark',$investigation_imaging_remark)
                ->with('investigation_ecg',$investigation_ecg)
                ->with('investigation_other',$investigation_other)
                ->with('blood_drawings',$blood_drawings)
                ->with('blood_drawings_remark',$blood_drawings_remark)
                ->with('service_type',$service_type)
                ->with('schedule_id',$latest_schedule_id)
                ->with('other_services',$other_services)
                ->with('addendums',$addendums)
                ->with('scheduleRaw',$scheduleRaw);
        }
        else{
            return view('backend.patient.invalidpatient');
        }

    }

    public function addAddendum(Request $request){
        $schedule_id            = (Input::has('schedule_id')) ? Input::get('schedule_id') : "";
        $patient_id             = (Input::has('patient_id')) ? Input::get('patient_id') : "";
        $addendum_text          = (Input::has('addendum')) ? Input::get('addendum') : "";

        //create patient object
        $paramObj                       = new Addendum();
        $paramObj->schedule_id          = $schedule_id;
        $paramObj->patient_id           = $patient_id;
        $paramObj->addendum_text        = $addendum_text;

        $addendumRepo = new AddendumRepository();
        $result = $addendumRepo->create($paramObj);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\PatientController@detailvisit', ['id' => $schedule_id])
                ->withMessage(FormatGenerator::message('Success', 'Addendum added ...'));
        }
        else{
            return redirect()->action('Backend\PatientController@detailvisit', ['id' => $schedule_id])
                ->withMessage(FormatGenerator::message('Fail', 'Addendum did not add ...'));
        }
    }

    public function patientDetail($id)
    {
        //start patient info
        $patientRepo  = new PatientRepository();
        $patientTemp  = $patientRepo->getObjByID($id);
        $patient      = $patientTemp["result"];
        $valid = 0; //whether patient is valid or not

        if(isset($patient) && count($patient) >0){
            $valid = 1;
        }
        if($valid == 1){
            //calculate patient age and bind to patient obj
            $age = Utility::calculateAge($patient->dob);
            $patient->age = $age;

            //get patient type by value
            $patient_type = Utility::getPatientTypeByValue($patient->patient_type_id);
            $patient->patient_type = $patient_type;
            //end patient info

            //start patient medical histories
            $medicalhistoryRepo = new MedicalhistoryRepository();
            $medicalhistories =   $medicalhistoryRepo->getArraysByOrder();

            $patientmedicalhistoryRepo = new PatientmedicalhistoryRepository();
            $patientmedicalhistories =   $patientmedicalhistoryRepo->getObjByPatientID($id);
            foreach($patientmedicalhistories as $keyMed => $patientmedicalhistory){
                $patientmedicalhistories[$keyMed]->medicalHistory = $medicalhistories[$patientmedicalhistory->medical_history_id]->name;
            }
            //end patient medical histories

            //start patient surgery histories
            $surgeryRepo = new PatientsurgeryhistoryRepository();
            $patientsurgeryhistories = $surgeryRepo->getObjByPatientID($id);
            //end patient surgery histories

            //start patient family histories
            $patientfamilyhistoryRepo = new PatientfamilyhistoryRepository();
            $patientfamilyhistories = $patientfamilyhistoryRepo->getObjByPatientID($id);

            $familymemberRepo = new FamilymemberRepository();
            $familymembers = $familymemberRepo->getArraysByOrder();

            $familyhistoryRepo = new FamilyhistoryRepository();
            $familyhistories = $familyhistoryRepo->getArraysByOrder();

            foreach($patientfamilyhistories as $keyFam => $patientfamilyhistory){
                $patientfamilyhistories[$keyFam]->familyMember = $familymembers[$patientfamilyhistory->family_member_id]->name;
                $patientfamilyhistories[$keyFam]->familyHistory = $familyhistories[$patientfamilyhistory->family_history_id]->name;
            }
            //end patient family histories

            //start Neuro Accessment
            $neuro  = array();
            $neuro_general  = DB::table('patient_physiotherapy_neuro_general')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($neuro_general) && count($neuro_general) > 0){
                foreach($neuro_general as $general){
                    $neuro['general'][] = $general;
                }
            }

            $neuro_limb     = DB::table('patient_physiotherapy_neuro_limb')->whereNull('deleted_at')->where('patients_id','=',$id)->get();
            if(isset($neuro_limb) && count($neuro_limb) > 0){
                foreach($neuro_limb as $limb){
                    $neuro['limb'][]  = $limb;
                }
            }

            $neuro_functional1 = DB::table('patient_physiotherapy_neuro_functional_performance1')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($neuro_functional1) && count($neuro_functional1) > 0){
                foreach($neuro_functional1 as $functional1){
                    $neuro['functional1'][] = $functional1;
                }
            }

            $neuro_functional2 = DB::table('patient_physiotherapy_neuro_functional_performance2')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($neuro_functional2) && count($neuro_functional2) > 0){
                foreach($neuro_functional2 as $functional2){
                    $neuro['functional2'][] = $functional2;
                }
            }

            $neuro_functional3 = DB::table('patient_physiotherapy_neuro_functional_performance3')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($neuro_functional3) && count($neuro_functional3)>0){
                foreach($neuro_functional3 as $functional3){
                    $neuro['functional3'][] = $functional3;
                }
            }
            //end Neuro Accessment

            //start Musculo Accessment
            $musculo    = array();
            $patient_musculo_1_2 = DB::table('patient_physiothreapy_musculo_1_and_2')->whereNull('deleted_at')->where('patients_id','=',$id)->get();
            if(isset($patient_musculo_1_2) && count($patient_musculo_1_2)>0){
                foreach($patient_musculo_1_2 as $musculo_1_2){
                    $musculo['musculo_1_2'][] = $musculo_1_2;
                }
            }

            $patient_musculo_3_sitting  = DB::table('patient_physiotherapy_musculo_3_sitting')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($patient_musculo_3_sitting) && count($patient_musculo_3_sitting)>0){
                foreach($patient_musculo_3_sitting as $sitting){
                    $musculo['musculo_3_sitting'][] = $sitting;
                }
            }

            $patient_musculo_3_standing = DB::table('patient_physiotherapy_musculo_3_standing')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($patient_musculo_3_standing) && count($patient_musculo_3_standing) > 0){
                foreach($patient_musculo_3_standing as $standing){
                    $musculo['musculo_3_standing'][] = $standing;
                }
            }

            $patient_musculo_4_1_2 = DB::table('patient_physiotherapy_musculo_4_1and2')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($patient_musculo_4_1_2) && count($patient_musculo_4_1_2)>0){
                foreach($patient_musculo_4_1_2 as $musculo4) {
                    $musculo['musculo_4_1_2'][] = $musculo4;
                }
            }

            $patient_musculo_4_3 = DB::table('patient_physiotherapy_musculo_4_3')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($patient_musculo_4_3) && count($patient_musculo_4_3)>0){
                foreach($patient_musculo_4_3 as $musculo_4_3){
                    $musculo['musculo_4_3'][] = $musculo_4_3;
                }
            }

            $patient_musculo_4_4_5 = DB::table('patient_physiotherapy_musculo_4_4and5')->whereNull('deleted_at')->where('patient_id','=',$id)->get();
            if(isset($patient_musculo_4_4_5) && count($patient_musculo_4_4_5)>0){
                foreach($patient_musculo_4_4_5 as $musculo_4_4_5){
                    $musculo['musculo_4_4_5'][] = $musculo_4_4_5;
                }
            }
            //end Musculo Accessment


            //start patient visit records
            $schedules          = Schedule::whereNull('deleted_at')->where('patient_id',$id)->get();
            $schedule_id_arr    = array();

            foreach($schedules as $sch){
                array_push($schedule_id_arr,$sch->id);
            }
            $schedule_detail    = Scheduledetail::whereIn('schedule_id',$schedule_id_arr)->where('type','=','service')->get();

            $users              = User::whereNull('deleted_at')->get();
            $car_types          = Cartype::whereNull('deleted_at')->get();
            $services           = Service::whereNull('deleted_at')->get();
            $patientSchedules   = array();
            $patient_schedules  = array();
            foreach($schedules as $schedule){
                $patient_schedules['id']   = $schedule->id;
                $patient_schedules['date'] = $schedule->date;
                $patient_schedules['time'] = $schedule->time;
                if($schedule->car_type == 1) $patient_schedules['car_type'] = "Patient Own Vehicle";
                if($schedule->car_type == 2) $patient_schedules['car_type'] = "Rental Vehicle";
                if($schedule->car_type == 3){
                    foreach($car_types as $car){
                        if($car->id == $schedule->car_type_id){
                            $patient_schedules['car_type'] = "HHCS Vehicle - ".$car->name;
                        }
                    }
                }
                foreach($users as $leader){
                    if($leader->id == $schedule->leader_id){
                        $patient_schedules['leader'] = $leader->name;
                    }
                }

                foreach($schedule_detail as $detail){
                    if($schedule->id == $detail->schedule_id){
                        $patient_schedules['service']=$detail->service->name;
                    }
                }

                //start invoice id
                $invoiceRepo = new InvoiceRepository();
                $invoice = $invoiceRepo->getInvoiceByScheduleID($schedule->id);
                $invoice_id = $invoice->id;
                $patient_schedules['invoice_id'] = $invoice_id;
                //end invoice id

                array_push($patientSchedules,$patient_schedules);
            }
            //end patient visit records
            
            return view('backend.patient.patientdetail')
                ->with('patient',$patient)
                ->with('patientmedicalhistories',$patientmedicalhistories)
                ->with('patientsurgeryhistories',$patientsurgeryhistories)
                ->with('patientfamilyhistories',$patientfamilyhistories)
                ->with('musculo',$musculo)
                ->with('neuro',$neuro)
                ->with('patientSchedules',$patientSchedules);
        }
        else{
            return view('backend.patient.invalidpatient');
        }
    }
}
