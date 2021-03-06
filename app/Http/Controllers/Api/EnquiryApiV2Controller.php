<?php

namespace App\Http\Controllers\Api;

use App\Api\Enquiry\EnquiryApiRepository;
use App\Api\Enquiry\EnquiryApiV2Repository;
use App\Api\Patient\PatientApiRepository;
use App\Api\User\UserApiRepository;
use App\Backend\Patient\Patient;
use App\Core\Check;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EnquiryApiV2Controller extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function upload(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $enquiryV2Repo      = new EnquiryApiV2Repository();
            $params             = $checkServerStatusArray['data'][0];

            if(isset($params->enquiries) && count($params->enquiries)>0) {
                $result         = $enquiryV2Repo->enquiry($params->enquiries);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "enquiries key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){

                $data = $enquiryV2Repo->getEnquiryData();

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data']                    = $data;

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

    public function uploadEnquiry(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);
        $prefix                 = "";
        $user_id                = $inputAll->user_id;

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK) {
            $prefix             = $checkServerStatusArray['tablet_id'];

            $enquiryV2Repo = new EnquiryApiV2Repository();
            $params = $checkServerStatusArray['data'][0];

            $tablet_id          = $checkServerStatusArray['tablet_id'];

            $returnedObj = array();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

            $logArr                 = array();

            try {
                DB::beginTransaction();

                if (isset($params->enquiries) && count($params->enquiries) > 0) {

                    foreach($params->enquiries as $enquiry){
                        $enqArray = array();
                        $enqArray[0] = $enquiry;

                        $result = $enquiryV2Repo->createEnquiry($enqArray);

                        if($result['aceplusStatusCode'] != ReturnMessage::OK) {
                            DB::rollback();
                            $result['tablet_id'] = $tablet_id;
                            return \Response::json($result);
                        }

                        if(isset($result['log']) && count($result['log']) > 0){
                            array_push($logArr,$result['log']);
                        }

                        if(isset($enquiry->core_users) && count($enquiry->core_users) > 0){

                            $core_user = $enquiry->core_users;

                            if(array_key_exists('id',$core_user)) {

                                if($core_user->id != null || $core_user->id != ""){
                                $core_users = array();
                                $core_users[0] = $core_user;
                                $userRepo      = new UserApiRepository();
                                $userResult    = $userRepo->createSingleUser($core_users);

                                //if user insertion was successful
                                if($userResult['aceplusStatusCode'] == ReturnMessage::OK){
                                    if(isset($userResult['log']) && count($userResult['log']) > 0){
                                        array_push($logArr,$userResult['log']);
                                    }

                                    if(isset($enquiry->patients) && count($enquiry->patients) > 0){
                                        $patient = $enquiry->patients;

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
                                                    $returnedObj['aceplusStatusMessage'] = $patientResult['aceplusStatusMessage'];
                                                    return \Response::json($returnedObj);
                                                }
                                            }
                                        }
                                    }
                                    //patient is not set, continue to next loop
                                    continue;

                                }
                                    else{
                                        DB::rollback();
                                        $returnedObj['aceplusStatusMessage'] = $userResult['aceplusStatusMessage'];
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

                $enquiryData = $enquiryV2Repo->getEnquiryData();

                if(isset($enquiryData)){
                    foreach($enquiryData as $enqData){
                        if(isset($enqData)){
                            if($enqData->created_at == null){
                                $enqData->created_at = "";
                            }
                            if($enqData->updated_at == null){
                                $enqData->updated_at = "";
                            }
                            if($enqData->deleted_at == null){
                                $enqData->deleted_at = "";
                            }
                        }

                        $data[0]['enquiries'][$count] = $enqData;
                        if(isset($enqData->id)){
                            $details = $enquiryV2Repo->getEnquiryDetail($enqData->id);
                            $data[0]['enquiries'][$count]->enquiry_detail = $details;
                        }

                        if(isset($enqData->patient_id) && $enqData->patient_id != null){
                            $patient = $patientApiRepo->getPatientForEnquiry($enqData->patient_id);

                            if(isset($patient)){
                                if($patient->created_at == null){
                                    $patient->created_at = "";
                                }
                                if($patient->updated_at == null){
                                    $patient->updated_at = "";
                                }
                                if($patient->deleted_at == null){
                                    $patient->deleted_at = "";
                                }
                                $data[0]['enquiries'][$count]->patients = $patient;
                                $patientAllergy = $patientApiRepo->getPatientAllergy($enqData->patient_id);
                                if(isset($patientAllergy) && $patientAllergy!= ""){
                                    $data[0]['enquiries'][$count]->patients->patient_allergy = $patientAllergy;
                                }

                            }
                            else{
                                $data[0]['enquiries'][$count]->patients = new \stdClass();
                                $data[0]['enquiries'][$count]->patients->patient_allergy = [];
                            }
                        }
                        else{
                            $data[0]['enquiries'][$count]->patients = new \stdClass();
                            $data[0]['enquiries'][$count]->patients->patient_allergy = [];
                        }

                        if(isset($enqData->patient_id) && $enqData->patient_id != null){
                            $user = $userApiRepo->getUserForEnquiry($enqData->patient_id);

                            if(isset($user)){
                                if($user->created_at == null){
                                    $user->created_at = "";
                                }
                                if($user->updated_at == null){
                                    $user->updated_at = "";
                                }
                                if($user->deleted_at == null){
                                    $user->deleted_at = "";
                                }
                                if($user->mobile_image == null){
                                    $user->mobile_image = "";
                                }
                                $data[0]['enquiries'][$count]->core_users = $user;
                            }
                            else{
                                $data[0]['enquiries'][$count]->core_users = new \stdClass();
                            }
                        }
                        else{
                            $data[0]['enquiries'][$count]->core_users = new \stdClass();
                        }

                        $count++;
                    }
                }
                else{
                    $data['enquiries'][$count] = new \stdClass();
                }

                $maxEnquiry  = Utility::getMaxKey($prefix,'enquiries','id');
                $maxPatient  = Utility::getMaxKey($prefix,'patients','user_id');
                $maxCoreUser = Utility::getMaxKey($prefix,'core_users','id');

                $maxKey = array();

                $maxKey[0]['table_name'] = "enquiries";
                $maxKey[0]['max_key_id'] = $maxEnquiry;
                $maxKey[1]['table_name'] = "patients";
                $maxKey[1]['max_key_id'] = $maxPatient;
                $maxKey[2]['table_name'] = "core_users";
                $maxKey[2]['max_key_id'] = $maxCoreUser;

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $tablet_id;
                $returnedObj['user_id']                 = $user_id;
                $returnedObj['max_key']                 = $maxKey;
                $returnedObj['data']                    = $data;

                return \Response::json($returnedObj);
            }
            catch (\Exception $e) {
                DB::rollback();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
}
