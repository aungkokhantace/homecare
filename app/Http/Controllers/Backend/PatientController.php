<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/26/2016
 * Time: 4:50 PM
 */
namespace App\Http\Controllers\Backend;

use App\Backend\Allergy\AllergyRepository;
use App\Backend\Cartype\Cartype;
use App\Backend\Investigation\Investigation;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
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
use App\Backend\Medicalhistory\MedicalHistoryRepository;
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
            $townships      = $townshipRepo->getObjs();

            $allergyRepo    = new AllergyRepository();
            $allergyFood      = $allergyRepo->getArraysByType('food');
            $allergyDrug      = $allergyRepo->getArraysByType('drug');
            $allergies      = array();
            $allergies['food']      = $allergyFood;
            $allergies['drug']      = $allergyDrug;

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

        //create log patient case summery
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
                $allergies      = array();
                $allergies['food']      = $allergyFood;
                $allergies['drug']      = $allergyDrug;

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
                $schedulesRaw = $this->repo->getPatientSchedule($id);

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
        $schedule                   = Schedule::whereNull('deleted_at')->where('id','=',$id)->first();
        $patient                    = Patient::whereNull('deleted_at')->where('user_id','=',$schedule->patient_id)->first();
        $valid                      = 0;
        if(isset($patient) && count($patient) >0){
            $valid = 1;
        }
        if($valid == 1){
            $vitals =$chief_complaints  = $gph = $hl = $aen = $investigations = $provisional_diagnosis = $treatments = null;
            $neurological = $musculo_intercention = $investigation_imaging = $investigation_ecg = $investigation_other= $nutritions =null ;
            if(isset($schedule) && count($schedule)>0){
                $latest_schedule_id     = $schedule->id;
                $patient_id             = $schedule->patient_id;
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
                $investigation_labs     = $schedule->getInvestigations($investigation_id);
                $investigations         = array();
                if(isset($group_name) && count($group_name)>0){
                    foreach($group_name as $group){
                        foreach($investigation_labs as $lab){
                            if($group->group_name == $lab->group_name){
                                if($lab->group_name == 'Haematology1' || $lab->group_name == 'Haematology2'){
                                    $investigations['Haematology'][] = $lab->name;
                                }
                                else{
                                    $investigations[$group->group_name][] = $lab->name;
                                }
                            }
                        }
                    }
                }

                $provisional_id         = $schedule->getScheduleProvisionalDiagnosis($latest_schedule_id);
                $provisional_diagnosis  = $schedule->getProvisionalDiagnosis($provisional_id);

                $treatments             = $schedule->getScheduleTreatment($latest_schedule_id);

                $neurological           = $schedule->getNeurologicalRecords($latest_schedule_id);

                $musculo_intercention   = $schedule->getMusculoIntercentionRecords($latest_schedule_id);

                $nutritions             = $schedule->getNutrition($latest_schedule_id,$patient_id);

                $schedule_investigation = $schedule->getScheduleInvestigation($latest_schedule_id);
                $investigation_imaging_id = array();
                foreach($schedule_investigation as $investigation){
                    if($investigation->investigation_id == '' && $investigation->investigation_ecg_remark == '' && $investigation->investigation_other_remark == ''){
                        $investigation_imaging_id['xray']   = $investigation->investigation_imaging_xray_id;
                        $investigation_imaging_id['usg']    = $investigation->investigation_imaging_usg_id;
                        $investigation_imaging_id['ct']     = $investigation->investigation_imaging_ct_id;
                        $investigation_imaging_id['mri']    = $investigation->investigation_imaging_mri_id;
                        $investigation_imaging_id['other']  = $investigation->investigation_imaging_other_id;
                    }
                    if($investigation->investigation_ecg_remark != ''){
                        $investigation_ecg  = $investigation->investigation_ecg_remark;
                    }
                    if($investigation->investigation_other_remark != ''){
                        $investigation_other = $investigation->investigation_other_remark;
                    }
                }

                $investigation_imagings     = DB::table('investigations_imaging')->whereIn('id',$investigation_imaging_id)->get();
                $investigation_imaging      = array();

                foreach($investigation_imagings as $imaging){
                    if($imaging->id ==  $investigation_imaging_id['xray']){
                        $investigation_imaging['X-RAY'] = $imaging->service_name;
                    }
                    elseif($imaging->id == $investigation_imaging_id['usg']){
                        $investigation_imaging['USG'] = $imaging->service_name;
                    }
                    elseif($imaging->id == $investigation_imaging_id['ct']){
                        $investigation_imaging['CT'] = $imaging->service_name;
                    }
                    elseif($imaging->id == $investigation_imaging_id['mri']){
                        $investigation_imaging['MRI'] = $imaging->service_name;
                    }
                    else{
                        $investigation_imaging['Others'] = $imaging->service_name;
                    }
                }

            }

            return view('backend.patient.detailvisit')->with('patient',$patient)
                ->with('schedules',$schedule)
                ->with('vitals',$vitals)
                ->with('chief_complaints',$chief_complaints)
                ->with('gph',$gph)->with('hl',$hl)->with('aen',$aen)
                ->with('investigations',$investigations)
                ->with('provisional_diagnosis',$provisional_diagnosis)
                ->with('treatments',$treatments)->with('neurological',$neurological)
                ->with('musculo_intercention',$musculo_intercention)
                ->with('nutritions',$nutritions)
                ->with('investigation_imaging',$investigation_imaging)
                ->with('investigation_ecg',$investigation_ecg)
                ->with('investigation_other',$investigation_other)
                ->with('service_type',$service_type);
        }
        else{
            return view('backend.patient.invalidpatient');
        }

    }
}
