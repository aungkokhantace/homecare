<?php

namespace App\Http\Controllers\Api;

use App\Api\Patient\PatientApiV2Repository;
use App\Api\Patient\PatientmedicalhistoryApiRepository;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PatientApiV2Controller extends Controller
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

    public function uploadPatientMedicalHistory(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->patient_medical_history) && count($params->patient_medical_history) > 0){
                $result                     = $patientRepo->createPatientMedicalHistory($params->patient_medical_history);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "patient_medical_history key is required in input JSON";
            }

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

    public function uploadPatientSurgeryHistory(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->patient_surgery_history) && count($params->patient_surgery_history) > 0){
                $result                     = $patientRepo->createPatientSurgeryHistory($params->patient_surgery_history);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "patient_medical_history key is required in input JSON";
            }

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

    public function uploadPatientFamilyHistory(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->patient_family_history) && count($params->patient_family_history) > 0){
                $result                     = $patientRepo->createPatientFamilyHistory($params->patient_family_history);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "patient_family_history key is required in input JSON";
            }

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

    public function uploadPatientPhysiothreapyMusculo(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];

            if(isset($params->musculo) && count($params->musculo) > 0){
                $result                 = $patientRepo->createPatientPhysiothreapyMusculo($params->musculo);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "musculo key is required in input JSON";
            }

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

    public function uploadPatientPhysiothreapyNeuro(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];

            if(isset($params->neuro) && count($params->neuro) > 0){
                $result                 = $patientRepo->createPatientPhysiothreapyNeuro($params->neuro);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "musculo key is required in input JSON";
            }

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

    public function uploadPatientPackage(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];

            if(isset($params->patient_package) && count($params->patient_package) > 0){
                $result                 = $patientRepo->createPatientPackage($params->patient_package);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "musculo key is required in input JSON";
            }

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

    public function uploadPaitentFamilyMember(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $patientRepo                = new PatientApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];

            if(isset($params->patient_family_member) && count($params->patient_family_member) > 0){
                $result                 = $patientRepo->createPatientFamilyMember($params->patient_package);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "patient_family_member key is required in input JSON";
            }

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
