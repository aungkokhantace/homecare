<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/12/2016
 * Time: 11:43 AM
 */

namespace App\Api\Enquiry;

use App\Api\Patient\PatientApiRepository;
use App\Api\User\UserApiRepository;
use App\Backend\Enquiry\Enquiry;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Zone\ZoneRepository;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;


class EnquiryApiV2Repository implements EnquiryApiV2RepositoryInterface
{
    public function createSingleRow($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['id'] = $tempObj->id;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function enquiry($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr = array();

            DB::beginTransaction();
            foreach($data as $row){
                $id = $row->id;
                $patient_id = $row->patient_id;

                //Check update or create for log date
                $findObj    = Enquiry::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in enquiry_detail relating to input
                if (isset($row->enquiry_detail) && count($row->enquiry_detail) > 0) {
                    DB::table('enquiry_detail')
                        ->where('enquiry_id', '=', $id)
                        ->delete();

                }

                //clear all existing data in enquiries relating to input
                DB::table('enquiries')
                    ->where('id', '=', $id)
//                    ->where('patient_id', '=', $patient_id)
                    ->delete();

                //creating enquiry object
                $paramObj = new Enquiry();
                $paramObj->id                    = $row->id;
                $paramObj->name                  = $row->name;
                $paramObj->nrc_no                = $row->nrc_no;
                $paramObj->is_new_patient        = $row->is_new_patient;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->patient_type_id       = $row->patient_type_id;
                $paramObj->date                  = $row->date;
                $paramObj->time                  = $row->time;
                $paramObj->gender                = $row->gender;
                $paramObj->dob                   = $row->dob;
                $paramObj->phone_no              = $row->phone_no;
                $paramObj->address               = $row->address;
                $paramObj->township_id           = $row->township_id;
                $paramObj->zone_id               = $row->zone_id;
                $paramObj->case_type             = $row->case_type;
                $paramObj->car_type              = $row->car_type;
                $paramObj->car_type_id           = $row->car_type_id;
                $paramObj->enquiry1              = $row->enquiry1;
                $paramObj->enquiry2              = $row->enquiry2;
                $paramObj->enquiry3              = $row->enquiry3;
                $paramObj->enquiry4              = $row->enquiry4;
                $paramObj->having_allergy        = $row->having_allergy;
                $paramObj->status                = $row->status;
                $paramObj->remark                = $row->remark;
                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $enquiryResult = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($enquiryResult['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, continue to child tables and do next loop

                    //start insertion of enquiry_detail
                    if (isset($row->enquiry_detail) && count($row->enquiry_detail) > 0) {
                        foreach ($row->enquiry_detail as $detail) {
                            DB::table('enquiry_detail')->insert([
                                ['enquiry_id' => $detail->enquiry_id,
                                    'package_id' => $detail->package_id,
                                    'service_id' => $detail->service_id,
                                    'allergy_id' => $detail->allergy_id,
                                    'type' => $detail->type
                                ]
                            ]);
                        }
                    }
                    //end insertion of enquiry_detail

                    //if insertion was successful, then create date and message for enquiry log
                    $tempArr['message'] = $create.' enquiry_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);

                    //start insertion of core_users
                    if (isset($row->core_users) && count($row->core_users) > 0) {
                        $user_id = $row->core_users->id;
                        $user_email = $row->core_users->email;

                        $patient_id = $row->patients->user_id;
                        $patient_email = $row->patients->email;

                        //clear patients data relating to input
                        DB::table('patients')
                            ->where('user_id', '=', $patient_id)
                            ->where('email', '=', $patient_email)
                            ->delete();

                        //clear core_users data relating to input
                        DB::table('core_users')
                            ->where('id', '=', $user_id)
                            ->where('email', '=', $user_email)
                            ->delete();

                        $core_users = array();
                        $core_users[0]      = $row->core_users;
                        $userRepo           = new UserApiRepository();
                        $userResult         = $userRepo->createSingleUser($core_users);
                        //end insertion of core_users

                        //if core_user insertion was successful
                        if($userResult['aceplusStatusCode'] == ReturnMessage::OK){
                            //start insertion of patients
                            if (isset($row->patients) && count($row->patients) > 0) {
                                $patients = array();
                                $patients[0] = $row->patients;
                                $patientRepo                = new PatientApiRepository();
                                $patientResult       = $patientRepo->createSinglePatient($patients);

                                //if patient insertion was successful
                                if($patientResult['aceplusStatusCode'] == ReturnMessage::OK){
                                    if (isset($row->patients->log_patient_case_summary) && count($row->patients->log_patient_case_summary) > 0) {
                                        $log = $row->patients->log_patient_case_summary;

                                        //create log obj
                                        $logObj = new LogPatientCaseSummary();
                                        $logObj->id = $log->id;
                                        $logObj->patient_id = $log->patient_id;
                                        $logObj->case_summary = $log->case_summary;
                                        $logObj->created_by = $log->created_by;
                                        $logObj->updated_by = $log->updated_by;
                                        $logObj->deleted_by = $log->deleted_by;
                                        $logObj->created_at = $log->created_at;
                                        $logObj->updated_at = $log->updated_at;
                                        $logObj->deleted_at = $log->deleted_at;

                                        //save log_patient_case_summary
                                        $tempLogObj     = Utility::addCreatedBy($logObj);
                                        if($tempLogObj->save()){
                                            continue;           //continue to next loop
                                        }
                                        else{
                                            DB::rollback();
                                            $returnedObj['aceplusStatusMessage'] = "Error in patient log insertion!";
                                            return $returnedObj;
                                        }
                                    }
                                }
                                else{  //if patient insertion was not successful
                                    DB::rollback();
                                    $returnedObj['aceplusStatusMessage'] = "Error in patient insertion!";
                                    return $returnedObj;
                                }
                            }
                            //end insertion of patients
                        }
                        else{
                            DB::rollback();
                            $returnedObj['aceplusStatusMessage'] = "Error in core_user insertion!";
                            return $returnedObj;
                        }
                    }
                    /////////////////////////////////////////////////////

                    continue; //continue to next loop(next row of input enquiry)
                }
                else {
                    //if enquiries insertion is not successful
                    DB::rollback();
                    $returnedObj['aceplusStatusMessage'] = $enquiryResult['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            //all insertions were successful
            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollback();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function getEnquiryData(){
        $tempObj = DB::select("SELECT * FROM enquiries
                              WHERE deleted_at is null
                              AND created_at >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
                              AND status = 'new'");
        return $tempObj;
    }

    public function getEnquiryDetail($id){
        $tempObj = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id'");
        return $tempObj;
    }

    public function createEnquiry($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr     = array();

            foreach($data as $row){
                $id = $row->id;
                $patient_id = $row->patient_id;

                //Check update or create for log date
                $findObj    = Enquiry::find($id);

                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in enquiry_detail relating to input
                DB::table('enquiry_detail')
                    ->where('enquiry_id', '=', $id)
                    ->delete();


                //clear all existing data in enquiries relating to input
                DB::table('enquiries')
                    ->where('id', '=', $id)
//                    ->where('patient_id', '=', $patient_id)
                    ->delete();

                //creating enquiry object
                $paramObj = new Enquiry();
                $paramObj->id                    = $row->id;
                $paramObj->name                  = $row->name;
                $paramObj->nrc_no                = $row->nrc_no;
                $paramObj->is_new_patient        = $row->is_new_patient;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->patient_type_id       = $row->patient_type_id;
                $paramObj->date                  = $row->date;
                $paramObj->time                  = $row->time;
                $paramObj->gender                = $row->gender;
                $paramObj->dob                   = $row->dob;
                $paramObj->phone_no              = $row->phone_no;
                $paramObj->address               = $row->address;
                $paramObj->township_id           = $row->township_id;
                $paramObj->zone_id               = $row->zone_id;
                $paramObj->case_type             = $row->case_type;
                $paramObj->car_type              = $row->car_type;
                $paramObj->car_type_id           = $row->car_type_id;
                $paramObj->enquiry1              = $row->enquiry1;
                $paramObj->enquiry2              = $row->enquiry2;
                $paramObj->enquiry3              = $row->enquiry3;
                $paramObj->enquiry4              = $row->enquiry4;
                $paramObj->having_allergy        = $row->having_allergy;
                $lowerCaseStatus                 = strtolower($row->status);
                $paramObj->status                = $lowerCaseStatus;
                $paramObj->remark                = isset($row->remark)?$row->remark:"";
                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $enquiryResult = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($enquiryResult['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, continue to child tables and do next loop

                    //start insertion of enquiry_detail
                    if (isset($row->enquiry_detail) && count($row->enquiry_detail) > 0) {
                        foreach ($row->enquiry_detail as $detail) {
                            DB::table('enquiry_detail')->insert([
                                ['enquiry_id' => $detail->enquiry_id,
                                    'package_id' => $detail->package_id,
                                    'service_id' => $detail->service_id,
                                    'allergy_id' => $detail->allergy_id,
                                    'type' => $detail->type
                                ]
                            ]);
                        }
                    }
                    //end insertion of enquiry_detail

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' enquiry_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);

                    continue; //continue to next loop of enquiry data
                }
                else {
                    //if enquiries insertion is not successful
                    $returnedObj['aceplusStatusMessage'] = $enquiryResult['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            //all insertions were successful
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function getEnquiryArray($idArr){

        $arr  = implode("','",$idArr);

        $enquiryArr     = DB::select("SELECT * from `enquiries` WHERE `deleted_at` is null AND `patient_id` IN ('$arr')");
        $enquiry_detailArr = DB::select("SELECT * FROM enquiry_detail");
        if(isset($enquiryArr) && count($enquiryArr) > 0){
            foreach ($enquiryArr as $rawKey=>$rawValue) {

                if($rawValue->created_at == null){
                    $rawValue->created_at = "";
                }
                if($rawValue->updated_at == null){
                    $rawValue->updated_at = "";
                }
                if($rawValue->deleted_at == null){
                    $rawValue->deleted_at = "";
                }

                $tempArray  = array();
                if(isset($enquiry_detailArr) && count($enquiry_detailArr) > 0){
                    foreach($enquiry_detailArr as $detail){
                        if($detail->enquiry_id == $rawValue->id){
                            array_push($tempArray,$detail);
                        }
                    }
                }

                $enquiryArr[$rawKey]->enquiry_detail = $tempArray;

            }
        }

        return $enquiryArr;

    }

    public function getNewEnquiryArray(){
        $newEnquiryArr = DB::select("SELECT * FROM enquiries
                              WHERE deleted_at is null
                              AND created_at >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
                              AND status = 'new'");
        $enquiry_detailArr = DB::select("SELECT * FROM enquiry_detail");
        if(isset($newEnquiryArr) && count($newEnquiryArr) > 0){
            foreach ($newEnquiryArr as $rawKey=>$rawValue) {

                if($rawValue->created_at == null){
                    $rawValue->created_at = "";
                }
                if($rawValue->updated_at == null){
                    $rawValue->updated_at = "";
                }
                if($rawValue->deleted_at == null){
                    $rawValue->deleted_at = "";
                }

                $tempArray  = array();
                if(isset($enquiry_detailArr) && count($enquiry_detailArr) > 0){
                    foreach($enquiry_detailArr as $detail){
                        if($detail->enquiry_id == $rawValue->id){
                            array_push($tempArray,$detail);
                        }
                    }
                }

                $newEnquiryArr[$rawKey]->enquiry_detail = $tempArray;

            }
        }

        return $newEnquiryArr;
    }
}