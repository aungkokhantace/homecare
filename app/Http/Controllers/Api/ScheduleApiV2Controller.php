<?php

namespace App\Http\Controllers\Api;

use App\Api\Schedule\ScheduleApiRepository;
use App\Api\Schedule\ScheduleApiRepositoryInterface;
use App\Api\Schedule\ScheduleApiV2Repository;
use App\Core\Check;
use App\Core\ReturnMessage;
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
class ScheduleApiV2Controller extends Controller
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

    public function down()
    {
        $inputAll                   = Input::All();
        $checkServerStatusArray     = Check::checkSiteActivationCode($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $scheduleApiRepo            = new ScheduleApiRepository();
            if (array_key_exists("status",$inputAll)){
                $status                 = strtolower($inputAll['status']);
                $rawSchedules           = $scheduleApiRepo->getArraysWithStatus($status);
            }
            else{
                $rawSchedules           = $scheduleApiRepo->getArrays();
            }

            $rawIdArr               = array();
            foreach($rawSchedules as $raw){
                array_push($rawIdArr,$raw->id);
            }

            $scheduleDetail         = $scheduleApiRepo->getScheduleDetailWithPara($rawIdArr);

            if(isset($rawSchedules) && count($rawSchedules)>0){

                foreach ($rawSchedules as $rawKey=>$rawValue) {

                    $tempArray  = array();

                    foreach($scheduleDetail as $detail){

                        if($detail->schedule_id == $rawValue->id){

                            array_push($tempArray,$detail);
                        }
                    }

                    $rawSchedules[$rawKey]->schedule_detail = $tempArray;
                }

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['data']                    = $rawSchedules;
                return \Response::json($returnedObj);
            }

            $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage']    = "There is no schedule to down!";
            $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
            $returnedObj['data']                    = "";
            return \Response::json($returnedObj);
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

    public function uploadSchedule(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedules) && count($params->schedules)>0) {
                $result = $scheduleV2Repo->schedule($params->schedules);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedules key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePatientVitals(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];

            if(isset($params->schedule_patient_vitals) && count($params->schedule_patient_vitals)>0) {
                $result = $scheduleV2Repo->schedulePatientVitals($params->schedule_patient_vitals);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_patient_vitals key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePatientChiefComplaint(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_patient_chief_complaint) && count($params->schedule_patient_chief_complaint)>0) {
                $result = $scheduleV2Repo->schedulePatientChiefComplaint($params->schedule_patient_chief_complaint);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_patient_chief_complaint key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadScheduleTreatmentHistory(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_treatment_histories) && count($params->schedule_treatment_histories)>0) {
                $result = $scheduleV2Repo->scheduleTreatmentHistory($params->schedule_treatment_histories);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_patient_chief_complaint key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadScheduleProvisionalDiagnosis(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_provisional_diagnosis) && count($params->schedule_provisional_diagnosis)>0) {
                $result = $scheduleV2Repo->scheduleProvisionalDiagnosis($params->schedule_provisional_diagnosis);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_provisional_diagnosis key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePhysiotherapyMusculo(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_physiotherapy_musculo) && count($params->schedule_physiotherapy_musculo)>0) {
                $result = $scheduleV2Repo->schedulePhysiotherapyMusculo($params->schedule_physiotherapy_musculo);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_physiotherapy_musculo key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePhysiotherapyNeuro(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_physiotherapy_neuro) && count($params->schedule_physiotherapy_neuro)>0) {
                $result = $scheduleV2Repo->schedulePhysiotherapyNeuro($params->schedule_physiotherapy_neuro);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_physiotherapy_neuro key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadScheduleTracking(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_trackings) && count($params->schedule_trackings)>0) {
                $result = $scheduleV2Repo->scheduleTrackings($params->schedule_trackings);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_trackings key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadschedulePhysicalExamsGeneralPupilsHead(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_physical_exams_general_pupils_head) && count($params->schedule_physical_exams_general_pupils_head)>0) {
                $result = $scheduleV2Repo->schedulePhysicalExamsGeneralPupilsHead($params->schedule_physical_exams_general_pupils_head);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_physical_exams_general_pupils_head key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePhysicalExamsHeartLungs(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_physical_exams_heart_lungs) && count($params->schedule_physical_exams_heart_lungs)>0) {
                $result = $scheduleV2Repo->schedulePhysicalExamsHeartLungs($params->schedule_physical_exams_heart_lungs);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_physical_exams_heart_lungs key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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

    public function uploadSchedulePhysicalExamsAbdomenExtreNeuro(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $scheduleV2Repo             = new ScheduleApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->schedule_physical_exams_abdomen_extre_neuro) && count($params->schedule_physical_exams_abdomen_extre_neuro)>0) {
                $result = $scheduleV2Repo->schedulePhysicalExamsAbdomenExtreNeuro($params->schedule_physical_exams_abdomen_extre_neuro);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "schedule_physical_exams_abdomen_extre_neuro key is required in input JSON";
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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
