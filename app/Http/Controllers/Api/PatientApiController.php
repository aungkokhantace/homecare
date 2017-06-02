<?php

namespace App\Http\Controllers\Api;

use App\Api\Patient\PatientApiRepository;
use App\Api\User\UserApiRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Log\LogCustom;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Auth;
use App\Core\Check;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

use App\Core\Role\Role;
use App\Core\Permission\Permission;
use App\Core\Utility;
use App\Session;
use App\User;
use App\Core\User\UserRepositoryInterface;
use Carbon\Carbon;
use App\Backend\Patient\Patient;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Api\Patient\PatientApiRepositoryInterface;
use App\Backend\Patientfamilyhistory\Patientfamilyhistory;
use App\Backend\Patientmedicalhistory\Patientmedicalhistory;
use App\Backend\Patientsurgeryhistory\Patientsurgeryhistory;
class PatientApiController extends Controller
{
    private $repo;

    public function __construct(PatientApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage'] = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function down()
    {
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);

        $checkServerStatusArray = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $rawPatientTables = $this->repo->getArrays();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Request success !";
            $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
            $returnedObj['data'] = $rawPatientTables;
            return \Response::json($returnedObj);
           
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
    /*
    public function upload()
    {
        $inputAll               = Input::All();
        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);
        $result                 = array();
        
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $user_id                       = $checkServerStatusArray['data']['user_id'];

            $patient                       = Patient::where('user_id',$user_id)->get();

            foreach($patient as $p)
            {
                
                if($user_id == $p->user_id){

                $paramObj                   = Patient::find($user_id);
                
                $paramObj->name             = $checkServerStatusArray['data']['name'];
                $paramObj->nrc_no           = $checkServerStatusArray['data']['nrc_no'];
                $paramObj->staff_id         = $checkServerStatusArray['data']['staff_id'];
                $paramObj->email            = $checkServerStatusArray['data']['email'];
                $paramObj->patient_type_id  = $checkServerStatusArray['data']['patient_type_id'];
                $paramObj->gender           = $checkServerStatusArray['data']['gender'];
                $paramObj->phone_no         = $checkServerStatusArray['data']['phone_no'];
                $paramObj->address          = $checkServerStatusArray['data']['address'];
                $paramObj->township_id      = $checkServerStatusArray['data']['township_id'];
                $paramObj->zone_id          = $checkServerStatusArray['data']['zone_id'];
                $paramObj->dob              = $checkServerStatusArray['data']['dob'];
                $paramObj->remark           = $checkServerStatusArray['data']['remark'];
                $paramObj->active           = $checkServerStatusArray['data']['active'];
                $paramObj->case_scenario    = $checkServerStatusArray['data']['case_scenario'];
              
                $userObj                    = User::find($user_id);
                $userObj->name         = $checkServerStatusArray['data']['name'];
                
                $userObj->role_id           = 5;
                $userObj->address           = $checkServerStatusArray['data']['address'];
                $userObj->active            = $checkServerStatusArray['data']['active'];
                
                if($checkServerStatusArray['data']['photo'])
                {
                    $decode_image = $checkServerStatusArray['data']['photo'];
                    $img            = str_replace('data:image/png;base64,', '', $decode_image);
                    $img            = str_replace(' ', '+', $img);
                    $data           = base64_decode($img);
                    $display_image  = 'UPLOAD'.uniqid().'.png';
                    
                    $file = base_path() . "/public/images/users/" . $display_image;
                    
                    $success = file_put_contents($file, $data);
            
                    $userObj->display_image = $display_image;
                    $userObj->mobile_image  = $decode_image;
                }else{
                    $display_image = "";
                }
               
                $logObj                         = new LogPatientCaseSummary();
                $logObj->case_summary           = $checkServerStatusArray['data']['case_scenario'];

                DB::table('patient_family_history')->where('patient_id', '=', $user_id)->delete();
                $familyObj                      = new Patientfamilyhistory();
                $familyObj->patient_id          = $user_id;
                $familyObj->family_history_id   = $checkServerStatusArray['data']['family_history_id'];
                $familyObj->family_member_id    = $checkServerStatusArray['data']['family_member_id'];
                $familyObj->remark              = $checkServerStatusArray['data']['remark'];
                
                DB::table('patient_medical_history')->where('patient_id','=',$user_id)->delete();
                $medicalObj                     = new Patientmedicalhistory();
                $medicalObj->patient_id         = $user_id;
                $medicalObj->medical_history_id = $checkServerStatusArray['data']['medical_history_id'];
                $medicalObj->date               = $checkServerStatusArray['data']['medical_history_date'];

                DB::table('patient_surgery_history')->where('patient_id','=',$user_id)->delete();
                $surgeryObj                     = new Patientsurgeryhistory();
                $surgeryObj->patient_id         = $user_id;
                $surgeryObj->id                 = $checkServerStatusArray['data']['sugery_id'];
                $surgeryObj->description        = $checkServerStatusArray['data']['sugery_description'];

                if(isset($checkServerStatusArray['data']['having_allergy']) ){
                    $allergies   = $checkServerStatusArray['data']['having_allergy'];
                }
                else{
                    $allergies = null;
                }

                if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

                    $rawPatientTables = $this->repo->update( $userObj,$paramObj,$allergies,$logObj,$familyObj,$medicalObj,$surgeryObj);

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    $returnedObj['aceplusStatusMessage'] = "Request success !";
                    $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                    $returnedObj['data'] ="SUCCESS";
                    return \Response::json($returnedObj);
           
                }else{
                return \Response::json($checkServerStatusArray);
                }


            }else{

                $userObj                = new User();
                $userObj->name     = $checkServerStatusArray['data']['name'];
                $userObj->password      = $checkServerStatusArray['data']['password'];
                $userObj->email         = $checkServerStatusArray['data']['email'];
                $userObj->role_id       = 5;
                $userObj->address       = $checkServerStatusArray['data']['address'];
                $userObj->active        = $checkServerStatusArray['data']['active'];

                if($checkServerStatusArray['data']['photo'])
                {
                    $decode_image = $checkServerStatusArray['data']['photo'];
                    $img            = str_replace('data:image/png;base64,', '', $decode_image);
                    $img            = str_replace(' ', '+', $img);
                    $data           = base64_decode($img);
                    $display_image  = 'UPLOAD'.uniqid().'.png';
                    
                    $file = base_path() . "/public/images/users/" . $display_image;
                    
                    $success = file_put_contents($file, $data);
            
                    $userObj->display_image = $display_image;
                    $userObj->mobile_image  = $decode_image;
                }else{
                    $display_image = "";
                }

                if(isset($checkServerStatusArray['data']['having_allergy']) ){
                    $allergies   = $checkServerStatusArray['data']['having_allergy'];
                }
                else{
                    $allergies = null;
                }
           
                $paramObj                       = new Patient();
                $paramObj->name                 = $checkServerStatusArray['data']['name'];
                $paramObj->nrc_no               = $checkServerStatusArray['data']['nrc_no'];
                $paramObj->staff_id             = $checkServerStatusArray['data']['staff_id'];
                $paramObj->email                = $checkServerStatusArray['data']['email'];
                $paramObj->patient_type_id      = $checkServerStatusArray['data']['patient_type_id'];
                $paramObj->gender               = $checkServerStatusArray['data']['gender'];
                $paramObj->phone_no             = $checkServerStatusArray['data']['phone_no'];
                $paramObj->address              = $checkServerStatusArray['data']['address'];
                $paramObj->township_id          = $checkServerStatusArray['data']['township_id'];
                $paramObj->zone_id              = $checkServerStatusArray['data']['zone_id'];
                $paramObj->dob                  = $checkServerStatusArray['data']['dob'];
                $paramObj->remark               = $checkServerStatusArray['data']['remark'];
                $paramObj->active               = $checkServerStatusArray['data']['active'];
                $paramObj->case_scenario        = $checkServerStatusArray['data']['case_scenario'];
                
                $logObj                         = new LogPatientCaseSummary();
                $logObj->case_summary           = $checkServerStatusArray['data']['case_scenario'];

                $familyObj                      = new Patientfamilyhistory();
                $familyObj->family_history_id   = $checkServerStatusArray['data']['family_history_id'];
                $familyObj->family_member_id    = $checkServerStatusArray['data']['family_member_id'];
                $familyObj->remark              = $checkServerStatusArray['data']['remark'];

                $medicalObj                     = new Patientmedicalhistory();
                $medicalObj->medical_history_id = $checkServerStatusArray['data']['medical_history_id'];
                $medicalObj->date               = $checkServerStatusArray['data']['medical_history_date'];

                $surgeryObj                     = new Patientsurgeryhistory();
                $surgeryObj->id                 = $checkServerStatusArray['data']['sugery_id'];
                $surgeryObj->description        = $checkServerStatusArray['data']['sugery_description'];

                if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

                    $rawPatientTables = $this->repo->create($flag = 1, $userObj,$paramObj,$allergies,$logObj,$familyObj,$medicalObj,$surgeryObj);

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    $returnedObj['aceplusStatusMessage'] = "Request success !";
                    $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                    $returnedObj['data'] ="SUCCESS";
                    return \Response::json($returnedObj);
           
                }else{
                return \Response::json($checkServerStatusArray);
                }
            }
        }    
        }
        
    }*/

    //core user is under patient  //all are done in controller
    public function upload(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $user_id                = $inputAll->user_id;
        $prefix                 = "";
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $prefix                     = $checkServerStatusArray['tablet_id'];
            $patient_prefix             = Utility::generatePatientPrefix($prefix);

            $params                     = $checkServerStatusArray['data'][0];
            $tablet_id                  = $checkServerStatusArray['tablet_id'];
            $logArr                     = array();

            try{
                DB::beginTransaction();

                if(isset($params->patients) && count($params->patients)>0) {
                    foreach ($params->patients as $patient) {
                        if (isset($patient->core_users) && count($patient->core_users) > 0) {
                            $core_users = $patient->core_users;

                            if(array_key_exists('id',$core_users)) {
                                if ($core_users->id != null && $core_users->id != ""){
                                    $userArr = array();
                                    $userArr[0] = $core_users;

                                    $userRepo = new UserApiRepository();
                                    $userResult = $userRepo->createSingleUser($userArr);
                                    //if user insertion was successful
                                    if($userResult['aceplusStatusCode'] == ReturnMessage::OK){
                                        if(isset($userResult['log']) && count($userResult['log']) > 0){
                                            array_push($logArr,$userResult['log']);
                                        }
                                        if(array_key_exists('user_id',$patient)) {
                                            if ($patient->user_id != null && $patient->user_id != ""){
                                                $patientArr = array();
                                                $patientArr[0] = $patient;
                                                $patientRepo = new PatientApiRepository();
                                                $patientResult = $patientRepo->createSinglePatient($patientArr);

                                                if ($patientResult['aceplusStatusCode'] == ReturnMessage::OK) {

                                                    if(isset($patientResult['log']) && count($patientResult['log']) > 0){
                                                        array_push($logArr,$patientResult['log']);
                                                    }
                                                    continue;       //continue to next loop
                                                } else {
                                                    DB::rollback();
                                                    $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                                                    $returnedObj['aceplusStatusMessage'] = $patientResult['aceplusStatusMessage'];
                                                    $returnedObj['data'] = (object) array();
                                                    return \Response::json($returnedObj);
                                                }
                                            }
                                        }
                                    //continue to next loop
                                    continue;
                                    }
                                    else{
                                        DB::rollback();
                                        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                                        $returnedObj['aceplusStatusMessage'] = $userResult['aceplusStatusMessage'];
                                        $returnedObj['data'] = (object) array();
                                        return \Response::json($returnedObj);
                                    }
                                }
                            }
                        }
                    }
                }

                //all insertions were successful
                DB::commit();

                //create custom log file with created_at or updated_at
                foreach($logArr as $logKey=>$logValue){
                    foreach($logValue as $value){
                        $date = $value['date'];
                        $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                        LogCustom::create($date,$message);
                    }
                }

                $data        = array();
                $count = 0;

                $patientApiRepo = new PatientApiRepository();
                $userApiRepo = new UserApiRepository();

                $patients = $patientApiRepo->getPatientData();
                if(isset($patients) && count($patients) > 0) {
                    foreach ($patients as $patient) {
                        $allergies = $patientApiRepo->getPatientAllergy($patient->user_id);
                        $core_user = $patientApiRepo->getCoreUser($patient->user_id);
                        $logs       = $patientApiRepo->getLog($patient->user_id);

                        if($patient->created_at == null){
                            $patient->created_at = "";
                        }
                        if($patient->updated_at == null){
                            $patient->updated_at = "";
                        }
                        if($patient->deleted_at == null){
                            $patient->deleted_at = "";
                        }

                        $data[$count] = $patient;

                        if (isset($allergies) && count($allergies) > 0) {
                            $data[$count]->patient_allergy = $allergies;
                        } else {
                            $data[$count]->patient_allergy = [];
                        }

                        if (isset($core_user) && count($core_user) > 0) {
                            if($core_user->created_at == null){
                                $core_user->created_at = "";
                            }
                            if($core_user->updated_at == null){
                                $core_user->updated_at = "";
                            }
                            if($core_user->deleted_at == null){
                                $core_user->deleted_at = "";
                            }

                            $data[$count]->core_user = $core_user;
                        } else {
                            $data[$count]->core_user = new \stdClass();
                        }

                        if (isset($logs) && count($logs) > 0) {
                            foreach($logs as $log){
                                if($log->created_at == null){
                                    $log->created_at = "";
                                }
                                if($log->updated_at == null){
                                    $log->updated_at = "";
                                }
                                if($log->deleted_at == null){
                                    $log->deleted_at = "";
                                }
                            }
                            $data[$count]->log_patient_case_summary = $logs;
                        } else {
                            $data[$count]->log = [];
                        }

                        $count++;
                    }
                }
                else{
                    $data = [];
                }

                $maxPatient  = Utility::getMaxKey($patient_prefix,'patients','user_id');
                $maxCoreUser = Utility::getMaxKey($patient_prefix,'core_users','id');
                $maxLog      = Utility::getMaxKey($prefix,'log_patient_case_summary','id');

                $maxKey = array();

                $maxKey[0]['table_name'] = "patients";
                $maxKey[0]['max_key_id'] = $maxPatient;
                $maxKey[1]['table_name'] = "core_users";
                $maxKey[1]['max_key_id'] = $maxCoreUser;
                $maxKey[2]['table_name'] = "log_patient_case_summary";
                $maxKey[2]['max_key_id'] = $maxLog;

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $tablet_id;
                $returnedObj['max_key']                 = $maxKey;
                $returnedObj['data']                    = $data;

                return \Response::json($returnedObj);
            }
            catch (\Exception $e) {
                DB::rollback();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] = (object) array();
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

    //patient and core_user comes in the same level(for whole enquiry api case)
    public function uploadSinglePatient(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);

        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiRepository();
            $params                     = $checkServerStatusArray['data'][0];

            $result                     = $patientRepo->createSinglePatient($params->patients);

            if($result['aceplusStatusCode'] == ReturnMessage::OK){

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                return \Response::json($returnedObj);

            }
            else{
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = $result['aceplusStatusMessage'];
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
}
