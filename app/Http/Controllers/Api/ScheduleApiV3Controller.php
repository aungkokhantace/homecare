<?php

namespace App\Http\Controllers\Api;

use App\Api\Enquiry\EnquiryApiV2Repository;
use App\Api\Patient\PatientApiRepository;
use App\Api\Schedule\ScheduleApiRepository;
use App\Api\Schedule\ScheduleApiRepositoryInterface;
use App\Api\Schedule\ScheduleApiV2Repository;
use App\Api\Schedule\ScheduleApiV3Repository;
use App\Api\User\UserApiRepository;
use App\Backend\Test\TestRepository;
use App\Core\Check;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Backend\Schedule\Schedule;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 13/10/2016
 * Time: 10:42 AM
 */
class ScheduleApiV3Controller extends Controller
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

    public function uploadScheduleGroup(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);
        $prefix                 = "";
        $user_id                = $inputAll->user_id;

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK) {
            $prefix             = $checkServerStatusArray['tablet_id'];
            $patient_prefix     = Utility::generatePatientPrefix($prefix);

            $enquiryV2Repo      = new EnquiryApiV2Repository();
            $params             = $checkServerStatusArray['data'][0];
            $tablet_id          = $checkServerStatusArray['tablet_id'];
            $logArr             = array();

            try {
                DB::beginTransaction();

                if (isset($params->schedules) && count($params->schedules) > 0) {
                    $scheduleRepo = new ScheduleApiV2Repository();
                    $scheduleResult = $scheduleRepo->schedule($params->schedules);

                    if($scheduleResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $scheduleResult['tablet_id'] = $tablet_id;
//                        $scheduleResult['aceplusStatusMessage'] = $scheduleResult['aceplusStatusMessage'] ;
                        $scheduleResult['data'] = (object) array();
                        return \Response::json($scheduleResult);
                    }

                    if(isset($scheduleResult['log']) && count($scheduleResult['log']) > 0){
                        array_push($logArr,$scheduleResult['log']);
                    }
                }

                if (isset($params->enquiries) && count($params->enquiries) > 0) {
                    $enquiryRepo = new EnquiryApiV2Repository();

                    $enquiryResult = $enquiryRepo->enquiry($params->enquiries);

                    if($enquiryResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $enquiryResult['tablet_id'] = $tablet_id;
                        $enquiryResult['data'] = (object) array();
                        return \Response::json($enquiryResult);
                    }
                    if(isset($enquiryResult['log']) && count($enquiryResult['log']) > 0){
                        array_push($logArr,$enquiryResult['log']);
                    }
                }

                if (isset($params->patients) && count($params->patients) > 0) {
                    $patientRepo = new PatientApiRepository();

                    $patientResult = $patientRepo->createPatient($params->patients);

                    if($patientResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $patientResult['tablet_id'] = $tablet_id;
                        $patientResult['data'] = (object) array();
                        return \Response::json($patientResult);
                    }
                    if(isset($patientResult['log']) && count($patientResult['log']) > 0){
                        array_push($logArr,$patientResult['log']);
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
                $scheduleCount = 0;
                $enquiryCount = 0;
                $patientCount = 0;

                $scheduleApiRepo = new ScheduleApiV3Repository();
                $scheduleHeaders = $scheduleApiRepo->getScheduleHeader($user_id);

                if(isset($scheduleHeaders) && $scheduleHeaders != null) {
                    $data[0]['schedules'][$scheduleCount] = $scheduleHeaders;
                    foreach ($scheduleHeaders as $scheduleRow) {
                        if($scheduleRow->created_at == null){
                            $scheduleRow->created_at = "";
                        }
                        if($scheduleRow->updated_at == null){
                            $scheduleRow->updated_at = "";
                        }
                        if($scheduleRow->deleted_at == null){
                            $scheduleRow->deleted_at = "";
                        }
                        $data[0]['schedules'][$scheduleCount] = $scheduleRow;

                        $data[0]['schedules'][$scheduleCount] = $scheduleRow;
                        $scheduleDetailData = $scheduleApiRepo->getScheduleDetailData($scheduleRow->id);
                        $data[0]['schedules'][$scheduleCount]->schedule_detail = $scheduleDetailData;

                        $scheduleCount++;
                    }
                }
                else{
//                    $data[0]['schedules'][$scheduleCount] = [];
                    $data[0]['schedules'] = [];
//                    $data[0]['schedules'][$scheduleCount] = new \stdClass();
//                    $data[0]['schedules'][$scheduleCount]->schedule_detail = [];
                }

                $enquiryData = $enquiryV2Repo->getEnquiryData();
                if(isset($enquiryData) && $enquiryData != null) {
                    foreach ($enquiryData as $enquiryRow) {
                        if($enquiryRow->created_at == null){
                            $enquiryRow->created_at = "";
                        }
                        if($enquiryRow->updated_at == null){
                            $enquiryRow->updated_at = "";
                        }
                        if($enquiryRow->deleted_at == null){
                            $enquiryRow->deleted_at = "";
                        }

                        $data[0]['enquiries'][$enquiryCount] = $enquiryRow;
                        $enquiryDetailData = $enquiryV2Repo->getEnquiryDetail($enquiryRow->id);
                        $data[0]['enquiries'][$enquiryCount]->enquiry_detail = $enquiryDetailData;

                        $enquiryCount++;
                    }
                }
                else{
//                    $data[0]['enquiries'][$enquiryCount] = [];
                    $data[0]['enquiries'] = [];
//                    $data[0]['enquiries'][$enquiryCount] = new \stdClass();
//                    $data[0]['enquiries'][$enquiryCount]->enquiry_detail = [];
                }

                $patientApiRepo = new PatientApiRepository();
                $patientData = $patientApiRepo->getPatientData();
                if(isset($patientData) && $patientData != null) {
                    $data[0]['patients'][$patientCount] = $patientData;
                    foreach ($patientData as $patientRow) {
                        if($patientRow->created_at == null){
                            $patientRow->created_at = "";
                        }
                        if($patientRow->updated_at == null){
                            $patientRow->updated_at = "";
                        }
                        if($patientRow->deleted_at == null){
                            $patientRow->deleted_at = "";
                        }

                        $data[0]['patients'][$patientCount] = $patientRow;
                        $patientAllergyData = $patientApiRepo->getPatientAllergy($patientRow->user_id);
                        $data[0]['patients'][$patientCount]->patient_allergy = $patientAllergyData;

                        $coreUserData = $patientApiRepo->getCoreUser($patientRow->user_id);
                        if($coreUserData->created_at == null){
                            $coreUserData->created_at = "";
                        }
                        if($coreUserData->updated_at == null){
                            $coreUserData->updated_at = "";
                        }
                        if($coreUserData->deleted_at == null){
                            $coreUserData->deleted_at = "";
                        }
                        $data[0]['patients'][$patientCount]->core_users = $coreUserData;

                        $logData = $patientApiRepo->getLog($patientRow->user_id);
                        foreach($logData as $logRow){
                            if($logRow->created_at == null){
                                $logRow->created_at = "";
                            }
                            if($logRow->updated_at == null){
                                $logRow->updated_at = "";
                            }
                            if($logRow->deleted_at == null){
                                $logRow->deleted_at = "";
                            }
                        }
                        $data[0]['patients'][$patientCount]->log_patient_case_summary = $logData;

                        $patientCount++;
                    }
                }
                else{
//                    $data[0]['patients'][$patientCount] = \stdClass();
                    $data[0]['patients'] = [];
//                    $data[0]['patients'][$patientCount]->patient_allergy = [];
//                    $data[0]['patients'][$patientCount]->core_users = new \stdClass();
//                    $data[0]['patients'][$patientCount]->log_patient_case_summary = [];
                }

                $maxSchedule = Utility::getMaxKey($prefix,'schedules','id');
                $maxEnquery  = Utility::getMaxKey($prefix,'enquiries','id');
//                $maxPatient  = Utility::getMaxKey($prefix,'patients','user_id');
                $maxPatient  = Utility::getMaxKey($patient_prefix,'patients','user_id');
//                $maxCoreUser = Utility::getMaxKey($prefix,'core_users','id');
                $maxCoreUser = Utility::getMaxKey($patient_prefix,'core_users','id');

                $maxKey = array();

                $maxKey[0]['table_name'] = "schedules";
                $maxKey[0]['max_key_id'] = $maxSchedule;
                $maxKey[1]['table_name'] = "enquiries";
                $maxKey[1]['max_key_id'] = $maxEnquery;
                $maxKey[2]['table_name'] = "patients";
                $maxKey[2]['max_key_id'] = $maxPatient;
                $maxKey[3]['table_name'] = "core_users";
                $maxKey[3]['max_key_id'] = $maxCoreUser;

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

    public function uploadScheduleStatus(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);
        $prefix                 = "";
        $user_id                = $inputAll->user_id;

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK) {
            $prefix             = $checkServerStatusArray['tablet_id'];
            $enquiryV2Repo      = new EnquiryApiV2Repository();
            $params             = $checkServerStatusArray['data'][0];
            $tablet_id          = $checkServerStatusArray['tablet_id'];
            $logArr             = array();

            try {
                DB::beginTransaction();

                if (isset($params->schedules) && count($params->schedules) > 0) {
                    $scheduleRepo = new ScheduleApiV2Repository();

                    $scheduleResult = $scheduleRepo->uploadScheduleStatus($params->schedules);
                    if($scheduleResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $scheduleResult['tablet_id'] = $tablet_id;
                        $scheduleResult['data'] = (object) array();
                        return \Response::json($scheduleResult);
                    }

                    if(isset($scheduleResult['log']) && count($scheduleResult['log']) > 0){
                        array_push($logArr,$scheduleResult['log']);
                    }
                }

                //all operations were successful
                DB::commit();

                //create custom log file with created_at or updated_at
                foreach($logArr as $logKey=>$logValue){
                    foreach($logValue as $value){
                        $date = $value['date'];
                        $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                        LogCustom::create($date,$message);
                    }
                }

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $tablet_id;

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
}
