<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/13/2016
 * Time: 3:18 PM
 */

namespace App\Api\Patient;


use App\Backend\Familymember\Familymember;
use App\Backend\Packagesale\Packagesale;
use App\Backend\Patientfamilyhistory\Patientfamilyhistory;
use App\Backend\Patientmedicalhistory\Patientmedicalhistory;
use App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance1\PatientPhysiotherapyNeuroFunctionalPerformance1;
use App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance2\PatientPhysiotherapyNeuroFunctionalPerformance2;
use App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance3\PatientPhysiotherapyNeuroFunctionalPerformance3;
use App\Backend\PatientPhysiotherapyNeuroGeneral\PatientPhysiotherapyNeuroGeneral;
use App\Backend\PatientPhysiotherapyNeuroLimb\PatientPhysiotherapyNeuroLimb;
use App\Backend\PatientPhysiothreapyMuscul3Sitting\PatientPhysiothreapyMusculo3Sitting;
use App\Backend\PatientPhysiothreapyMusculo1and2\PatientPhysiothreapyMusculo1and2;
use App\Backend\PatientPhysiothreapyMusculo3Standing\PatientPhysiothreapyMusculo3Standing;
use App\Backend\PatientPhysiothreapyMusculo4_1and2\PatientPhysiothreapyMusculo4_1and2;
use App\Backend\PatientPhysiothreapyMusculo4_3\PatientPhysiothreapyMusculo4_3;
use App\Backend\PatientPhysiothreapyMusculo4_4and5\PatientPhysiothreapyMusculo4_4and5;
use App\Backend\Patientsurgeryhistory\Patientsurgeryhistory;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

class PatientApiV2Repository implements PatientApiV2RepositoryInterface
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

    public function createPatientMedicalHistory($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                $patient_id = $row->patient_id;
                //clear all existing data in patient_medical_history relating to input
                DB::table('patient_medical_history')
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
            }

            $tempLogArr  = array();

            foreach($data as $row){
                $id         = $row->id;
                $patient_id = $row->patient_id;
                $medical_history_id = $row->medical_history_id;
                //Check update or create for log date
                $findObj    = Patientmedicalhistory::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
//                //clear all existing data in patient_medical_history relating to input
//                DB::table('patient_medical_history')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('medical_history_id','=',$medical_history_id)
//                    ->delete();

                //creating patient_medical_history object
                $paramObj                        = new Patientmedicalhistory();
                $paramObj->id                    = $row->id;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->medical_history_id    = $row->medical_history_id;
                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;


                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_medical_history_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input invoice)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientSurgeryHistory($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                $patient_id     = $row->patient_id;
                //clear all existing data in patient_surgery_history relating to input
                DB::table('patient_surgery_history')
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
            }

            $tempLogArr = array();

            foreach($data as $row){
                $id             = $row->id;
                $patient_id     = $row->patient_id;

                //Check update or create for log date
                $findObj    = Patientsurgeryhistory::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_surgery_history relating to input
//                DB::table('patient_surgery_history')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('description', '=', $row->description)
//                    ->delete();

                //creating patient_surgery_history object
                $paramObj                        = new Patientsurgeryhistory();
                $paramObj->id                    = $row->id;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->description           = $row->description;
                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;


                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_surgery_history_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_surgery_history)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientFamilyHistory($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                $patient_id         = $row->patient_id;

                //clear all existing data in patient_family_history relating to input
                DB::table('patient_family_history')
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
            }

            $tempLogArr = array();

            foreach($data as $row){
                $id                 = $row->id;
                $patient_id         = $row->patient_id;
                $family_history_id  = $row->family_history_id;
                $family_member_id   = $row->family_member_id;
                //Check update or create for log date
                $findObj    = Patientfamilyhistory::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
//                //clear all existing data in patient_family_history relating to input
//                DB::table('patient_family_history')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('family_history_id','=',$family_history_id)
//                    ->where('family_member_id','=',$family_member_id)
//                    ->delete();

                //creating patient_family_history object
                $paramObj                        = new Patientfamilyhistory();
                $paramObj->id                    = $row->id;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->family_history_id     = $row->family_history_id;
                $paramObj->family_member_id      = $row->family_member_id;
                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;


                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_family_history_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_family_history)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){

                if(isset($row->patient_physiothreapy_musculo_1_and_2) && count($row->patient_physiothreapy_musculo_1_and_2)>0){
                    $musculo1and2 = $row->patient_physiothreapy_musculo_1_and_2;

                    $result = $this->createPatientPhysiothreapyMusculo1and2($musculo1and2);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_musculo_3_sitting) && count($row->patient_physiotherapy_musculo_3_sitting)>0){
                    $musculo3stitting = $row->patient_physiotherapy_musculo_3_sitting;

                    $result = $this->createPatientPhysiothreapyMusculo3sitting($musculo3stitting);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_musculo_3_standing) && count($row->patient_physiotherapy_musculo_3_standing)>0){
                    $musculo3standing = $row->patient_physiotherapy_musculo_3_standing;

                    $result = $this->createPatientPhysiothreapyMusculo3standing($musculo3standing);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_musculo_4_1and2) && count($row->patient_physiotherapy_musculo_4_1and2)>0){
                    $musculo4_1and2 = $row->patient_physiotherapy_musculo_4_1and2;

                    $result = $this->createPatientPhysiothreapyMusculo4_1and2($musculo4_1and2);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_musculo_4_3) && count($row->patient_physiotherapy_musculo_4_3)>0){
                    $musculo4_3 = $row->patient_physiotherapy_musculo_4_3;

                    $result = $this->createPatientPhysiothreapyMusculo4_3($musculo4_3);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_musculo_4_4and5) && count($row->patient_physiotherapy_musculo_4_4and5)>0){
                    $musculo4_4and5 = $row->patient_physiotherapy_musculo_4_4and5;

                    $result = $this->createPatientPhysiothreapyMusculo4_4and5($musculo4_4and5);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }


            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo1and2($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $tempLogArr = array();

            foreach($data as $musculo1and2) {
                //clear all existing data in patient_physiothreapy_musculo_1_and_2 relating to input
                DB::table('patient_physiothreapy_musculo_1_and_2')
                    ->where('patients_id', '=', $musculo1and2->patients_id)
                    ->delete();
            }

            foreach($data as $musculo1and2) {

                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo1and2::where('patients_id','=',$musculo1and2->patients_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $musculo1and2->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $musculo1and2->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiothreapy_musculo_1_and_2 relating to input
//                DB::table('patient_physiothreapy_musculo_1_and_2')
//                    ->where('patients_id', '=', $musculo1and2->patients_id)
//                    ->delete();
                //creating patient_physiothreapy_musculo_1_and_2 object
                $paramObj = new PatientPhysiothreapyMusculo1and2();
                $paramObj->cheif_comlaint_sensation_others          = $musculo1and2->cheif_comlaint_sensation_others;
                $paramObj->chief_complaint_aggravating_factors      = $musculo1and2->chief_complaint_aggravating_factors;
                $paramObj->chief_complaint_alternating_factors      = $musculo1and2->chief_complaint_alternating_factors;
                $paramObj->chief_complaint_constant                 = $musculo1and2->chief_complaint_constant;
                $paramObj->chief_complaint_dull_ache                = $musculo1and2->chief_complaint_dull_ache;
                $paramObj->chief_complaint_duration                 = $musculo1and2->chief_complaint_duration;
                $paramObj->chief_complaint_giving_way               = $musculo1and2->chief_complaint_giving_way;
                $paramObj->chief_complaint_intermittent             = $musculo1and2->chief_complaint_intermittent;
                $paramObj->chief_complaint_locking                  = $musculo1and2->chief_complaint_locking;
                $paramObj->chief_complaint_night_pain               = $musculo1and2->chief_complaint_night_pain;
                $paramObj->chief_complaint_numbness                 = $musculo1and2->chief_complaint_numbness;
                $paramObj->chief_complaint_onset                    = $musculo1and2->chief_complaint_onset;
                $paramObj->chief_complaint_others                   = $musculo1and2->chief_complaint_others;
                $paramObj->chief_complaint_pain_grade               = $musculo1and2->chief_complaint_pain_grade;
                $paramObj->chief_complaint_pin_and_needles          = $musculo1and2->chief_complaint_pin_and_needles;
                $paramObj->chief_complaint_popping                  = $musculo1and2->chief_complaint_popping;
                $paramObj->chief_complaint_sharp                    = $musculo1and2->chief_complaint_sharp;
                $paramObj->chief_complaint_site_and_spread_of_pain  = $musculo1and2->chief_complaint_site_and_spread_of_pain;
                $paramObj->chief_complaint_thorbbing                = $musculo1and2->chief_complaint_thorbbing;
                $paramObj->chief_complaint_tingling                 = $musculo1and2->chief_complaint_tingling;
                $paramObj->created_at                               = (isset($musculo1and2->created_at) && $musculo1and2->created_at != "") ? $musculo1and2->created_at:null;
                $paramObj->created_by                               = $musculo1and2->created_by;
                $paramObj->deleted_at                               = (isset($musculo1and2->deleted_at) && $musculo1and2->deleted_at != "") ? $musculo1and2->deleted_at:null;
                $paramObj->deleted_by                               = $musculo1and2->deleted_by;
                $paramObj->diagnosis                                = $musculo1and2->diagnosis;
                $paramObj->observation_deformity                    = $musculo1and2->observation_deformity;
                $paramObj->observation_gait                         = $musculo1and2->observation_gait;
                $paramObj->observation_heat                         = $musculo1and2->observation_heat;
                $paramObj->observation_loss_of_function             = $musculo1and2->observation_loss_of_function;
                $paramObj->observation_muscule_spasm                = $musculo1and2->observation_muscule_spasm;
                $paramObj->observation_posture                      = $musculo1and2->observation_posture;
                $paramObj->observation_swelling                     = $musculo1and2->observation_swelling;
                $paramObj->observation_tendemess                    = $musculo1and2->observation_tendemess;
                $paramObj->patients_id                              = $musculo1and2->patients_id;
                $paramObj->previous_medical_history                 = $musculo1and2->previous_medical_history;
                $paramObj->referred_by                              = $musculo1and2->referred_by;
                $paramObj->updated_at                               = (isset($musculo1and2->updated_at) && $musculo1and2->updated_at != "") ? $musculo1and2->updated_at:null;
                $paramObj->updated_by                               = $musculo1and2->updated_by;


                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiothreapy_musculo_1_and_2 for patient_id = '.$paramObj->patients_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input products)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo3sitting($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_musculo_3_sitting relating to input
                DB::table('patient_physiotherapy_musculo_3_sitting')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr         = array();
            foreach($data as $row){

                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo3Sitting::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_musculo_3_sitting relating to input
//                DB::table('patient_physiotherapy_musculo_3_sitting')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();
                //creating patient_physiotherapy_musculo_3_sitting object
                $paramObj                                           = new PatientPhysiothreapyMusculo3Sitting();
                $paramObj->patient_id                               = $row->patient_id;
                $paramObj->joint                                    = $row->joint;
                $paramObj->flexion_normal                           = $row->flexion_normal;
                $paramObj->flexion_minimum                          = $row->flexion_minimum;
                $paramObj->flexion_moderate                         = $row->flexion_moderate;
                $paramObj->flexion_maximum                          = $row->flexion_maximum;
                $paramObj->extension_normal                         = $row->extension_normal;
                $paramObj->extension_minimum                        = $row->extension_minimum;
                $paramObj->extension_moderate                       = $row->extension_moderate;
                $paramObj->extension_maximum                        = $row->extension_maximum;
                $paramObj->abduction_normal                         = $row->abduction_normal;
                $paramObj->abduction_minimum                        = $row->abduction_minimum;
                $paramObj->abduction_moderate                       = $row->abduction_moderate;
                $paramObj->abduction_maximum                        = $row->abduction_maximum;
                $paramObj->adduction_normal                         = $row->adduction_normal;
                $paramObj->adduction_minimum                        = $row->adduction_minimum;
                $paramObj->adduction_moderate                       = $row->adduction_moderate;
                $paramObj->adduction_maximum                        = $row->adduction_maximum;
                $paramObj->medical_rotation_normal                  = $row->medical_rotation_normal;
                $paramObj->medical_rotation_minimum                 = $row->medical_rotation_minimum;
                $paramObj->medical_rotation_moderate                = $row->medical_rotation_moderate;
                $paramObj->medical_rotation_maximum                 = $row->medical_rotation_maximum;
                $paramObj->lateral_rotation_normal                  = $row->lateral_rotation_normal;
                $paramObj->lateral_rotation_minimum                 = $row->lateral_rotation_minimum;
                $paramObj->lateral_rotation_moderate                = $row->lateral_rotation_moderate;
                $paramObj->lateral_rotation_maximum                 = $row->lateral_rotation_maximum;
                $paramObj->side_flexion_normal                      = $row->side_flexion_normal;
                $paramObj->side_flexion_minimum                     = $row->side_flexion_minimum;
                $paramObj->side_flexion_moderate                    = $row->side_flexion_moderate;
                $paramObj->side_flexion_maximum                     = $row->side_flexion_maximum;
                $paramObj->rotation_to_right_normal                 = $row->rotation_to_right_normal;
                $paramObj->rotation_to_right_minimum                = $row->rotation_to_right_minimum;
                $paramObj->rotation_to_right_moderate               = $row->rotation_to_right_moderate;
                $paramObj->rotation_to_right_maximum                = $row->rotation_to_right_maximum;
                $paramObj->rotation_to_left_normal                  = $row->rotation_to_left_normal;
                $paramObj->rotation_to_left_minimum                 = $row->rotation_to_left_minimum;
                $paramObj->rotation_to_left_moderate                = $row->rotation_to_left_moderate;
                $paramObj->rotation_to_left_maximum                 = $row->rotation_to_left_maximum;
                $paramObj->created_by                               = $row->created_by;
                $paramObj->updated_by                               = $row->updated_by;
                $paramObj->deleted_by                               = $row->deleted_by;
                $paramObj->created_at                               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_musculo_3_sitting for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_musculo_3_sitting)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log'] = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo3standing($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_musculo_3_standing relating to input
                DB::table('patient_physiotherapy_musculo_3_standing')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr = array();
            foreach($data as $row){

                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo3Standing::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_musculo_3_standing relating to input
//                DB::table('patient_physiotherapy_musculo_3_standing')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();
                //creating patient_physiotherapy_musculo_3_standing object
                $paramObj                                           = new PatientPhysiothreapyMusculo3Standing();
                $paramObj->patient_id                               = $row->patient_id;
                $paramObj->joint                                    = $row->joint;
                $paramObj->flexion_normal                           = $row->flexion_normal;
                $paramObj->flexion_minimum                          = $row->flexion_minimum;
                $paramObj->flexion_moderate                         = $row->flexion_moderate;
                $paramObj->flexion_maximum                          = $row->flexion_maximum;
                $paramObj->extension_normal                         = $row->extension_normal;
                $paramObj->extension_minimum                        = $row->extension_minimum;
                $paramObj->extension_moderate                       = $row->extension_moderate;
                $paramObj->extension_maximum                        = $row->extension_maximum;
                $paramObj->abduction_normal                         = $row->abduction_normal;
                $paramObj->abduction_minimum                        = $row->abduction_minimum;
                $paramObj->abduction_moderate                       = $row->abduction_moderate;
                $paramObj->abduction_maximum                        = $row->abduction_maximum;
                $paramObj->adduction_normal                         = $row->adduction_normal;
                $paramObj->adduction_minimum                        = $row->adduction_minimum;
                $paramObj->adduction_moderate                       = $row->adduction_moderate;
                $paramObj->adduction_maximum                        = $row->adduction_maximum;
                $paramObj->medical_rotation_normal                  = $row->medical_rotation_normal;
                $paramObj->medical_rotation_minimum                 = $row->medical_rotation_minimum;
                $paramObj->medical_rotation_moderate                = $row->medical_rotation_moderate;
                $paramObj->medical_rotation_maximum                 = $row->medical_rotation_maximum;
                $paramObj->lateral_rotation_normal                  = $row->lateral_rotation_normal;
                $paramObj->lateral_rotation_minimum                 = $row->lateral_rotation_minimum;
                $paramObj->lateral_rotation_moderate                = $row->lateral_rotation_moderate;
                $paramObj->lateral_rotation_maximum                 = $row->lateral_rotation_maximum;
                $paramObj->side_flexion_normal                      = $row->side_flexion_normal;
                $paramObj->side_flexion_minimum                     = $row->side_flexion_minimum;
                $paramObj->side_flexion_moderate                    = $row->side_flexion_moderate;
                $paramObj->side_flexion_maximum                     = $row->side_flexion_maximum;
                $paramObj->rotation_to_right_normal                 = $row->rotation_to_right_normal;
                $paramObj->rotation_to_right_minimum                = $row->rotation_to_right_minimum;
                $paramObj->rotation_to_right_moderate               = $row->rotation_to_right_moderate;
                $paramObj->rotation_to_right_maximum                = $row->rotation_to_right_maximum;
                $paramObj->rotation_to_left_normal                  = $row->rotation_to_left_normal;
                $paramObj->rotation_to_left_minimum                 = $row->rotation_to_left_minimum;
                $paramObj->rotation_to_left_moderate                = $row->rotation_to_left_moderate;
                $paramObj->rotation_to_left_maximum                 = $row->rotation_to_left_maximum;
                $paramObj->created_by                               = $row->created_by;
                $paramObj->updated_by                               = $row->updated_by;
                $paramObj->deleted_by                               = $row->deleted_by;
                $paramObj->created_at                               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_musculo_3_standing for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_musculo_3_standing)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log'] = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo4_1and2($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_musculo_4_1and2 relating to input
                DB::table('patient_physiotherapy_musculo_4_1and2')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo4_1and2::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
//
//                //clear all existing data in patient_physiotherapy_musculo_4_1and2 relating to input
//                DB::table('patient_physiotherapy_musculo_4_1and2')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();
                //creating patient_physiotherapy_musculo_4_1and2 object
                $paramObj                               =  new PatientPhysiothreapyMusculo4_1and2();
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->slr_plus                     = $row->slr_plus;
                $paramObj->slr_minus                    = $row->slr_minus;
                $paramObj->ehl_plus                     = $row->ehl_plus;
                $paramObj->ehl_minus                    = $row->ehl_minus;
                $paramObj->femoral_nerve_plus           = $row->femoral_nerve_plus;
                $paramObj->femoral_nerve_minus          = $row->femoral_nerve_minus;
                $paramObj->empty_can_test_plus          = $row->empty_can_test_plus;
                $paramObj->empty_can_test_minus         = $row->empty_can_test_minus;
                $paramObj->neer_test_plus               = $row->neer_test_plus;
                $paramObj->neer_test_minus              = $row->neer_test_minus;
                $paramObj->hawkin_test_plus             = $row->hawkin_test_plus;
                $paramObj->hawkin_test_minus            = $row->hawkin_test_minus;
                $paramObj->gerber_life_off_test_plus    = $row->gerber_life_off_test_plus;
                $paramObj->gerber_life_off_test_minus   = $row->gerber_life_off_test_minus;
                $paramObj->drop_arm_test_plus           = $row->drop_arm_test_plus;
                $paramObj->drop_arm_test_minus          = $row->drop_arm_test_minus;
                $paramObj->crank_test_plus              = $row->crank_test_plus;
                $paramObj->crank_test_minus             = $row->crank_test_minus;
                $paramObj->apprehension_test_plus       = $row->apprehension_test_plus;
                $paramObj->apprehension_test_minus      = $row->apprehension_test_minus;
                $paramObj->yergason_test_plus           = $row->yergason_test_plus;
                $paramObj->yergason_test_minus          = $row->yergason_test_minus;
                $paramObj->anterior_drawer_test_plus    = $row->anterior_drawer_test_plus;
                $paramObj->anterior_drawer_test_minus   = $row->anterior_drawer_test_minus;
                $paramObj->posterior_drawer_test_plus   = $row->posterior_drawer_test_plus;
                $paramObj->posterior_drawer_test_minus  = $row->posterior_drawer_test_minus;
                $paramObj->varus_stress_test_plus       = $row->varus_stress_test_plus;
                $paramObj->varus_stress_test_minus      = $row->varus_stress_test_minus;
                $paramObj->valgus_stress_test_plus      = $row->valgus_stress_test_plus;
                $paramObj->valgus_stress_test_minus     = $row->valgus_stress_test_minus;
                $paramObj->mc_murray_test_plus          = $row->mc_murray_test_plus;
                $paramObj->mc_murray_test_minus         = $row->mc_murray_test_minus;
                $paramObj->flexion                      = $row->flexion;
                $paramObj->extension                    = $row->extension;
                $paramObj->abduction                    = $row->abduction;
                $paramObj->adduction                    = $row->adduction;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_musculo_4_1and2 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_musculo_4_1and2)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo4_3($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_musculo_4_3 relating to input
                DB::table('patient_physiotherapy_musculo_4_3')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr = array();
            foreach($data as $row){

                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo4_3::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_musculo_4_3 relating to input
//                DB::table('patient_physiotherapy_musculo_4_3')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();
                //creating patient_physiotherapy_musculo_4_3 object
                $paramObj                               = new PatientPhysiothreapyMusculo4_3();
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->ms_acting_on_joint           = $row->ms_acting_on_joint;
                $paramObj->flexors_0                    = $row->flexors_0;
                $paramObj->flexors_1                    = $row->flexors_1;
                $paramObj->flexors_2                    = $row->flexors_2;
                $paramObj->flexors_3                    = $row->flexors_3;
                $paramObj->flexors_4                    = $row->flexors_4;
                $paramObj->flexors_5                    = $row->flexors_5;
                $paramObj->extensors_0                  = $row->extensors_0;
                $paramObj->extensors_1                  = $row->extensors_1;
                $paramObj->extensors_2                  = $row->extensors_2;
                $paramObj->extensors_3                  = $row->extensors_3;
                $paramObj->extensors_4                  = $row->extensors_4;
                $paramObj->extensors_5                  = $row->extensors_5;
                $paramObj->abductors_0                  = $row->abductors_0;
                $paramObj->abductors_1                  = $row->abductors_1;
                $paramObj->abductors_2                  = $row->abductors_2;
                $paramObj->abductors_3                  = $row->abductors_3;
                $paramObj->abductors_4                  = $row->abductors_4;
                $paramObj->abductors_5                  = $row->abductors_5;
                $paramObj->adductors_0                  = $row->adductors_0;
                $paramObj->adductors_1                  = $row->adductors_1;
                $paramObj->adductors_2                  = $row->adductors_2;
                $paramObj->adductors_3                  = $row->adductors_3;
                $paramObj->adductors_4                  = $row->adductors_4;
                $paramObj->adductors_5                  = $row->adductors_5;
                $paramObj->medial_rotators_0            = $row->medial_rotators_0;
                $paramObj->medial_rotators_1            = $row->medial_rotators_1;
                $paramObj->medial_rotators_2            = $row->medial_rotators_2;
                $paramObj->medial_rotators_3            = $row->medial_rotators_3;
                $paramObj->medial_rotators_4            = $row->medial_rotators_4;
                $paramObj->medial_rotators_5            = $row->medial_rotators_5;
                $paramObj->lateral_rotators_0           = $row->lateral_rotators_0;
                $paramObj->lateral_rotators_1           = $row->lateral_rotators_1;
                $paramObj->lateral_rotators_2           = $row->lateral_rotators_2;
                $paramObj->lateral_rotators_3           = $row->lateral_rotators_3;
                $paramObj->lateral_rotators_4           = $row->lateral_rotators_4;
                $paramObj->lateral_rotators_5           = $row->lateral_rotators_5;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_musculo_4_3 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_musculo_4_3)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyMusculo4_4and5($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_musculo_4_4and5 relating to input
                DB::table('patient_physiotherapy_musculo_4_4and5')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){

                //Check update or create for log date
                $findObj    = PatientPhysiothreapyMusculo4_4and5::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_musculo_4_4and5 relating to input
//                DB::table('patient_physiotherapy_musculo_4_4and5')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();
                //creating patient_physiotherapy_musculo_4_4and5 object
                $paramObj                               = new PatientPhysiothreapyMusculo4_4and5();
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->muscle_tone                  = $row->muscle_tone;
                $paramObj->other_investigation          = $row->other_investigation;
                $paramObj->skin_conditions              = $row->skin_conditions;
                $paramObj->heart_disease                = $row->heart_disease;
                $paramObj->diabetes                     = $row->diabetes;
                $paramObj->osteoporosis                 = $row->osteoporosis;
                $paramObj->joint_replacements           = $row->joint_replacements;
                $paramObj->pregnancy                    = $row->pregnancy;
                $paramObj->pacemaker                    = $row->pacemaker;
                $paramObj->stroke                       = $row->stroke;
                $paramObj->rapid_weight_loss            = $row->rapid_weight_loss;
                $paramObj->bowelbladder_problems        = $row->bowelbladder_problems;
                $paramObj->malignancy                   = $row->malignancy;
                $paramObj->arthritis                    = $row->arthritis;
                $paramObj->numbness                     = $row->numbness;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_musculo_4_4and5 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_musculo_4_4and5)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuro($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){

                if(isset($row->patient_physiotherapy_neuro_general) && count($row->patient_physiotherapy_neuro_general)>0){
                    $general = $row->patient_physiotherapy_neuro_general;

                    $result = $this->createPatientPhysiothreapyNeuroGeneral($general);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_neuro_limb) && count($row->patient_physiotherapy_neuro_limb)>0){
                    $limb = $row->patient_physiotherapy_neuro_limb;

                    $result = $this->createPatientPhysiothreapyNeuroLimb($limb);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_neuro_functional_performance1) && count($row->patient_physiotherapy_neuro_functional_performance1) > 0){
                    $performance1 = $row->patient_physiotherapy_neuro_functional_performance1;

                    $result = $this->createPatientPhysiothreapyNeuroFunctionalPerformance1($performance1);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_neuro_functional_performance2) && count($row->patient_physiotherapy_neuro_functional_performance2)>0){
                    $performance2 = $row->patient_physiotherapy_neuro_functional_performance2;

                    $result = $this->createPatientPhysiothreapyNeuroFunctionalPerformance2($performance2);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

                if(isset($row->patient_physiotherapy_neuro_functional_performance3) && count($row->patient_physiotherapy_neuro_functional_performance3)>0){
                    $performance3 = $row->patient_physiotherapy_neuro_functional_performance3;

                    $result = $this->createPatientPhysiothreapyNeuroFunctionalPerformance3($performance3);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        return $result;
                    }
                }

            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuroGeneral($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_neuro_general relating to input
                DB::table('patient_physiotherapy_neuro_general')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiotherapyNeuroGeneral::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_neuro_general relating to input
//                DB::table('patient_physiotherapy_neuro_general')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();

                //creating patient_physiotherapy_neuro_general object
                $paramObj                                       = new PatientPhysiotherapyNeuroGeneral();
                $paramObj->patient_id                           = $row->patient_id;
                $paramObj->diagnosis                            = $row->diagnosis;
                $paramObj->relevant                             = $row->relevant;
                $paramObj->history                              = $row->history;
                $paramObj->pre_mobid_status_community           = $row->pre_mobid_status_community;
                $paramObj->pre_mobid_status_home_bound          = $row->pre_mobid_status_home_bound;
                $paramObj->pre_mobid_status_wheel_chair_bound   = $row->pre_mobid_status_wheel_chair_bound;
                $paramObj->pre_mobid_status_bed_bound           = $row->pre_mobid_status_bed_bound;
                $paramObj->smoking_history_start                = $row->smoking_history_start;
                $paramObj->smoking_history_stop                 = $row->smoking_history_stop;
                $paramObj->smoking_history_status               = $row->smoking_history_status;
                $paramObj->mental_status                        = $row->mental_status;
                $paramObj->vision                               = $row->vision;
                $paramObj->hearing                              = $row->hearing;
                $paramObj->speech_swallowing                    = $row->speech_swallowing;
                $paramObj->orientation_time                     = $row->orientation_time;
                $paramObj->orientation_place                    = $row->orientation_place;
                $paramObj->orientation_person                   = $row->orientation_person;
                $paramObj->orientation_remark                   = $row->orientation_remark;
                $paramObj->obey_ommands                         = $row->obey_ommands;
                $paramObj->follow_gestures                      = $row->follow_gestures;
                $paramObj->created_by                           = $row->created_by;
                $paramObj->updated_by                           = $row->updated_by;
                $paramObj->deleted_by                           = $row->deleted_by;
                $paramObj->created_at                           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_neuro_general for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_neuro_general)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuroLimb($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_neuro_limb relating to input
                DB::table('patient_physiotherapy_neuro_limb')
                    ->where('patients_id', '=', $row->patients_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiotherapyNeuroLimb::where('patients_id','=',$row->patients_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_neuro_limb relating to input
//                DB::table('patient_physiotherapy_neuro_limb')
//                    ->where('patients_id', '=', $row->patients_id)
//                    ->delete();

                //creating patient_physiotherapy_neuro_limb object
                $paramObj                                       = new PatientPhysiotherapyNeuroLimb();
                $paramObj->patients_id                          = $row->patients_id;
                $paramObj->shoulder_flexor_right                = $row->shoulder_flexor_right;
                $paramObj->shoulder_flexor_left                 = $row->shoulder_flexor_left;
                $paramObj->shoulder_extensor_left               = $row->shoulder_extensor_left;
                $paramObj->shoulder_extensor_right              = $row->shoulder_extensor_right;
                $paramObj->shoulder_abductor_left               = $row->shoulder_abductor_left;
                $paramObj->shoulder_abductor_right              = $row->shoulder_abductor_right;
                $paramObj->elbow_flexor_left                    = $row->elbow_flexor_left;
                $paramObj->elbow_flexor_right                   = $row->elbow_flexor_right;
                $paramObj->elbow_extensor_left                  = $row->elbow_extensor_left;
                $paramObj->elbow_extensor_right                 = $row->elbow_extensor_right;
                $paramObj->gripping_left                        = $row->gripping_left;
                $paramObj->gripping_right                       = $row->gripping_right;
                $paramObj->hip_flexor_left                      = $row->hip_flexor_left;
                $paramObj->hip_flexor_right                     = $row->hip_flexor_right;
                $paramObj->hip_extensor_left                    = $row->hip_extensor_left;
                $paramObj->hip_extensor_right                   = $row->hip_extensor_right;
                $paramObj->hip_abductor_left                    = $row->hip_abductor_left;
                $paramObj->hip_abductor_right                   = $row->hip_abductor_right;
                $paramObj->knee_flexion_left                    = $row->knee_flexion_left;
                $paramObj->knee_flexion_right                   = $row->knee_flexion_right;
                $paramObj->knee_extension_left                  = $row->knee_extension_left;
                $paramObj->knee_extension_right                 = $row->knee_extension_right;
                $paramObj->ankle_dorsiflexion_left              = $row->ankle_dorsiflexion_left;
                $paramObj->ankle_dorsiflexion_right             = $row->ankle_dorsiflexion_right;
                $paramObj->ankle_plantarflexion_left            = $row->ankle_plantarflexion_left;
                $paramObj->ankle_plantarflexion_right           = $row->ankle_plantarflexion_right;
                $paramObj->rom                                  = $row->rom;
                $paramObj->tone                                 = $row->tone;
                $paramObj->sensation                            = $row->sensation;
                $paramObj->joint_position_sense                 = $row->joint_position_sense;
                $paramObj->created_by                           = $row->created_by;
                $paramObj->updated_by                           = $row->updated_by;
                $paramObj->deleted_by                           = $row->deleted_by;
                $paramObj->created_at                           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_neuro_limb for patients_id = '.$paramObj->patients_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_neuro_limb)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }


            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuroFunctionalPerformance1($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_neuro_functional_performance1 relating to input
                DB::table('patient_physiotherapy_neuro_functional_performance1')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiotherapyNeuroFunctionalPerformance1::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_neuro_functional_performance1 relating to input
//                DB::table('patient_physiotherapy_neuro_functional_performance1')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();

                //creating patient_physiotherapy_neuro_functional_performance1 object
                $paramObj                                       = new PatientPhysiotherapyNeuroFunctionalPerformance1();
                $paramObj->patient_id                           = $row->patient_id;
                $paramObj->rolling_i                            = $row->rolling_i;
                $paramObj->rolling_s                            = $row->rolling_s;
                $paramObj->rolling_min                          = $row->rolling_min;
                $paramObj->rolling_mod                          = $row->rolling_mod;
                $paramObj->rolling_max                          = $row->rolling_max;
                $paramObj->rolling_u                            = $row->rolling_u;
                $paramObj->rolling_nt                           = $row->rolling_nt;
                $paramObj->supine_lying_sitting_i               = $row->supine_lying_sitting_i;
                $paramObj->supine_lying_sitting_s               = $row->supine_lying_sitting_s;
                $paramObj->supine_lying_sitting_min             = $row->supine_lying_sitting_min;
                $paramObj->supine_lying_sitting_mod             = $row->supine_lying_sitting_mod;
                $paramObj->supine_lying_sitting_max             = $row->supine_lying_sitting_max;
                $paramObj->supine_lying_sitting_u               = $row->supine_lying_sitting_u;
                $paramObj->supine_lying_sitting_nt              = $row->supine_lying_sitting_nt;
                $paramObj->transfer_bed_chair_i                 = $row->transfer_bed_chair_i;
                $paramObj->transfer_bed_chair_s                 = $row->transfer_bed_chair_s;
                $paramObj->transfer_bed_chair_min               = $row->transfer_bed_chair_min;
                $paramObj->transfer_bed_chair_mod               = $row->transfer_bed_chair_mod;
                $paramObj->transfer_bed_chair_max               = $row->transfer_bed_chair_max;
                $paramObj->transfer_bed_chair_u                 = $row->transfer_bed_chair_u;
                $paramObj->transfer_bed_chair_nt                = $row->transfer_bed_chair_nt;
                $paramObj->sit_stand_i                          = $row->sit_stand_i;
                $paramObj->sit_stand_s                          = $row->sit_stand_s;
                $paramObj->sit_stand_min                        = $row->sit_stand_min;
                $paramObj->sit_stand_mod                        = $row->sit_stand_mod;
                $paramObj->sit_stand_max                        = $row->sit_stand_max;
                $paramObj->sit_stand_u                          = $row->sit_stand_u;
                $paramObj->sit_stand_nt                         = $row->sit_stand_nt;
                $paramObj->ambulation_i                         = $row->ambulation_i;
                $paramObj->ambulation_s                         = $row->ambulation_s;
                $paramObj->ambulation_min                       = $row->ambulation_min;
                $paramObj->ambulation_mod                       = $row->ambulation_mod;
                $paramObj->ambulation_max                       = $row->ambulation_max;
                $paramObj->ambulation_u                         = $row->ambulation_u;
                $paramObj->ambulation_nt                        = $row->ambulation_nt;
                $paramObj->rolling_comment                      = $row->rolling_comment;
                $paramObj->spine_lying_sitting_comment          = $row->spine_lying_sitting_comment;
                $paramObj->transfer_bed_chair_comment           = $row->transfer_bed_chair_comment;
                $paramObj->sit_stand_comment                    = $row->sit_stand_comment;
                $paramObj->ambulation_comment                   = $row->ambulation_comment;
                $paramObj->created_by                           = $row->created_by;
                $paramObj->updated_by                           = $row->updated_by;
                $paramObj->deleted_by                           = $row->deleted_by;
                $paramObj->created_at                           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_neuro_functional_performance1 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_neuro_functional_performance1)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuroFunctionalPerformance2($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_neuro_functional_performance2 relating to input
                DB::table('patient_physiotherapy_neuro_functional_performance2')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiotherapyNeuroFunctionalPerformance2::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
                //clear all existing data in patient_physiotherapy_neuro_functional_performance2 relating to input
                DB::table('patient_physiotherapy_neuro_functional_performance2')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();

                //creating patient_physiotherapy_neuro_functional_performance2 object
                $paramObj                                   = new PatientPhysiotherapyNeuroFunctionalPerformance2();
                $paramObj->patient_id                       = $row->patient_id;
                $paramObj->walking_aid                      = $row->walking_aid;
                $paramObj->ws                               = $row->ws;
                $paramObj->qs                               = $row->qs;
                $paramObj->wf                               = $row->wf;
                $paramObj->handroid                         = $row->handroid;
                $paramObj->reciprocal_yes                   = $row->reciprocal_yes;
                $paramObj->reciprocal_no                    = $row->reciprocal_no;
                $paramObj->rail_nil                         = $row->rail_nil;
                $paramObj->rail_1                           = $row->rail_1;
                $paramObj->rail_2                           = $row->rail_2;
                $paramObj->writing_i                        = $row->writing_i;
                $paramObj->writing_s                        = $row->writing_s;
                $paramObj->writing_min                      = $row->writing_min;
                $paramObj->writing_mod                      = $row->writing_mod;
                $paramObj->writing_max                      = $row->writing_max;
                $paramObj->writing_u                        = $row->writing_u;
                $paramObj->writing_nt                       = $row->writing_nt;
                $paramObj->writing_comment                  = $row->writing_comment;
                $paramObj->holding_i                        = $row->holding_i;
                $paramObj->holding_s                        = $row->holding_s;
                $paramObj->holding_min                      = $row->holding_min;
                $paramObj->holding_mod                      = $row->holding_mod;
                $paramObj->holding_max                      = $row->holding_max;
                $paramObj->holding_u                        = $row->holding_u;
                $paramObj->holding_nt                       = $row->holding_nt;
                $paramObj->holding_comment                  = $row->holding_comment;
                $paramObj->picking_up_i                     = $row->picking_up_i;
                $paramObj->picing_up_s                      = $row->picing_up_s;
                $paramObj->picking_up_min                   = $row->picking_up_min;
                $paramObj->picking_up_mod                   = $row->picking_up_mod;
                $paramObj->picking_up_max                   = $row->picking_up_max;
                $paramObj->picking_up_u                     = $row->picking_up_u;
                $paramObj->picking_up_nt                    = $row->picking_up_nt;
                $paramObj->picking_up_comment               = $row->picking_up_comment;
                $paramObj->reaching_i                       = $row->reaching_i;
                $paramObj->reaching_s                       = $row->reaching_s;
                $paramObj->reaching_min                     = $row->reaching_min;
                $paramObj->reaching_mod                     = $row->reaching_mod;
                $paramObj->reaching_max                     = $row->reaching_max;
                $paramObj->reaching_u                       = $row->reaching_u;
                $paramObj->reaching_nt                      = $row->reaching_nt;
                $paramObj->reaching_comment                 = $row->reaching_comment;
                $paramObj->created_by                       = $row->created_by;
                $paramObj->updated_by                       = $row->updated_by;
                $paramObj->deleted_by                       = $row->deleted_by;
                $paramObj->created_at                       = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                       = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                       = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_neuro_functional_performance2 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_neuro_functional_performance2)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPhysiothreapyNeuroFunctionalPerformance3($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                //clear all existing data in patient_physiotherapy_neuro_functional_performance3 relating to input
                DB::table('patient_physiotherapy_neuro_functional_performance3')
                    ->where('patient_id', '=', $row->patient_id)
                    ->delete();
            }

            $tempLogArr = array();
            foreach($data as $row){
                //Check update or create for log date
                $findObj    = PatientPhysiotherapyNeuroFunctionalPerformance3::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in patient_physiotherapy_neuro_functional_performance3 relating to input
//                DB::table('patient_physiotherapy_neuro_functional_performance3')
//                    ->where('patient_id', '=', $row->patient_id)
//                    ->delete();

                //creating patient_physiotherapy_neuro_functional_performance3 object
                $paramObj                               = new PatientPhysiotherapyNeuroFunctionalPerformance3();
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->static_sitting_good          = $row->static_sitting_good;
                $paramObj->static_sitting_fair          = $row->static_sitting_fair;
                $paramObj->static_sitting_poor          = $row->static_sitting_poor;
                $paramObj->static_sitting_nt            = $row->static_sitting_nt;
                $paramObj->static_sitting_comment       = isset($row->static_sitting_comment)?$row->static_sitting_comment:"";
                $paramObj->dynamic_sitting_good         = $row->dynamic_sitting_good;
                $paramObj->dynamic_sitting_fair         = $row->dynamic_sitting_fair;
                $paramObj->dynamic_sitting_poor         = $row->dynamic_sitting_poor;
                $paramObj->dynamic_sitting_nt           = $row->dynamic_sitting_nt;
                $paramObj->dynamic_sitting_comment      = isset($row->dynamic_sitting_comment)?$row->dynamic_sitting_comment:"";
                $paramObj->static_standing_good         = $row->static_standing_good;
                $paramObj->static_standing_fair         = $row->static_standing_fair;
                $paramObj->static_standing_poor         = $row->static_standing_poor;
                $paramObj->static_standing_nt           = $row->static_standing_nt;
                $paramObj->static_standing_comment      = isset($row->static_standing_comment)?$row->static_standing_comment:"";
                $paramObj->dynamic_standing_good        = $row->dynamic_standing_good;
                $paramObj->dynamic_standing_fair        = $row->dynamic_standing_fair;
                $paramObj->dynamic_standing_poor        = $row->dynamic_standing_poor;
                $paramObj->dynamic_standing_nt          = $row->dynamic_standing_nt;
                $paramObj->dynamic_standing_comment     = isset($row->dynamic_standing_comment)?$row->dynamic_standing_comment:"";
                $paramObj->activity_tolerance_good      = $row->activity_tolerance_good;
                $paramObj->activity_tolerance_fair      = $row->activity_tolerance_fair;
                $paramObj->activity_tolerance_poor      = $row->activity_tolerance_poor;
                $paramObj->activity_tolerance_nt        = $row->activity_tolerance_nt;
                $paramObj->activity_tolerance_comment   = isset($row->activity_tolerance_comment)?$row->activity_tolerance_comment:"";
                $paramObj->short_term_goal              = $row->short_term_goal;
                $paramObj->long_term_goal               = $row->long_term_goal;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_physiotherapy_neuro_functional_performance3 for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_physiotherapy_neuro_functional_performance3)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatientPackage($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            $tempLogArr     = array();
            foreach($data as $row){
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $package_id     = $row->package_id;

                //Check update or create for log date
                $findObj    = Packagesale::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in patient_package_detail relating to input
                DB::table('patient_package_detail')
                    ->where('patient_package_id', '=', $id)
                    ->where('package_id','=',$package_id)
                    ->delete();



                //clear all existing data in patient_package relating to input
                DB::table('patient_package')
                    ->where('id', '=', $id)
                    ->where('patient_id', '=', $patient_id)
                    ->where('package_id','=',$package_id)
                    ->delete();

                //creating patient_package object
                $paramObj = new Packagesale();
                $paramObj->id 					= $row->id;
                $paramObj->patient_id			= $row->patient_id;
                $paramObj->package_id 			= $row->package_id;
                $paramObj->package_price 		= $row->package_price;
                $paramObj->transportation_price = $row->transportation_price;
                $paramObj->package_usage_count 	= $row->package_usage_count;
                $paramObj->package_used_count 	= $row->package_used_count;
                $paramObj->sold_date 			= $row->sold_date;
                $paramObj->expired_date 		= $row->expired_date;
                $paramObj->remark 				= $row->remark;
                $paramObj->created_by 			= $row->created_by;
                $paramObj->updated_by 			= $row->updated_by;
                $paramObj->deleted_by 			= $row->deleted_by;
                $paramObj->created_at           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, continue to child tables and do next loop

                    //start insertion of patient_package_detail
                    if (isset($row->patient_package_detail) && count($row->patient_package_detail) > 0) {
                        foreach ($row->patient_package_detail as $detail) {
                            DB::table('patient_package_detail')->insert([
                                [
                                    'patient_package_id' => $detail->patient_package_id,
                                    'package_id' => $detail->package_id,
                                    'service_id' => $detail->service_id
                                ]
                            ]);
                        }
                    }
                    //end insertion of patient_package_detail

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' patient_package_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_package)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }
    public function createPatientFamilyMember($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr = array();

            foreach($data as $row){

                $id = $row->id;
                //Check update or create for log date
                $findObj    = Familymember::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in patient_family_member relating to input
                DB::table('patient_family_member')
                    ->where('id', '=', $row->id)
                    ->where('name', '=', $row->name)
                    ->delete();

                //creating patient_family_member object
                $paramObj                        = new Familymember();
                $paramObj->id 			         = $row->id;
                $paramObj->name 		         = $row->name;
                $paramObj->description 	         = $row->description;
                $paramObj->created_by 	         = $row->created_by;
                $paramObj->updated_by 	         = $row->updated_by;
                $paramObj->deleted_by 	         = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log

                    $tempArr['message'] = $create.' patient_family_member_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input patient_family_member)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function getPatientData($patientIdArray){
        $returnArray = array();
        $arr  = implode("','",$patientIdArray);
        $tempPatientArr = DB::select("SELECT * from patients WHERE deleted_at is null AND user_id IN ('$arr')");

        $count = 0;

        if(isset($tempPatientArr) && count($tempPatientArr)>0){
            foreach($tempPatientArr as $patient){
                if($patient->created_at == null){
                    $patient->created_at = "";
                }
                if($patient->updated_at == null){
                    $patient->updated_at = "";
                }
                if($patient->deleted_at == null){
                    $patient->deleted_at = "";
                }

                $returnArray[$count] = $patient;

                if(isset($patient->user_id)){
                    //get patient_allergy data
                    $details = DB::select("SELECT * from patient_allergy WHERE patient_id = '$patient->user_id'");
                    $returnArray[$count]->patient_allergy = $details;
                }
                /*
                if(isset($patient->user_id)){
                    //get log patient data
                    $logs = DB::select("SELECT * from log_patient_case_summary WHERE patient_id = '$patient->user_id'");

                    if(isset($logs) && count($logs)>0){
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
                        $returnArray[$count]->log_patient_case_summary = $logs;
                    }
                }*/

                if(isset($patient->user_id)){
                    //get log patient data
                    $logs = DB::select("SELECT * from log_patient_case_summary WHERE patient_id = '$patient->user_id'");

                    if(isset($logs) && count($logs)>0){
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
                        $returnArray[$count]->log_patient_case_summary = $logs;
                    }
                }

                if(isset($patient->user_id)){
                    //get log patient data
                    $users = DB::select("SELECT * from core_users WHERE id = '$patient->user_id' LIMIT 1");

                    if(isset($users) && count($users)>0){
                        foreach($users as $user){
                            if($user->created_at == null){
                                $user->created_at = "";
                            }
                            if($user->updated_at == null){
                                $user->updated_at = "";
                            }
                            if($user->deleted_at == null){
                                $user->deleted_at = "";
                            }
                        }
                        $returnArray[$count]->core_users = $users[0];
                    }
                }

                $count++;
            }
        }
        else{
//            $returnArray[$count] = new \stdClass();
//            $returnArray[$count]->patient_allergy = [];
//            $returnArray[$count]->core_users = new \stdClass();

            $returnArray = [];
        }
        return $returnArray;
    }

    public function getPatientMedicalHistoryData($patientIdArray){
        $returnArray = array();
        $arr  = implode("','",$patientIdArray);
        $tempPatientMedicalHistoryArr = DB::select("SELECT * from patient_medical_history WHERE deleted_at is null AND patient_id IN ('$arr')");

        $count = 0;

        if(isset($tempPatientMedicalHistoryArr) && count($tempPatientMedicalHistoryArr)>0){
            foreach($tempPatientMedicalHistoryArr as $patientMedicalHistory){
                if($patientMedicalHistory->created_at == null){
                    $patientMedicalHistory->created_at = "";
                }
                if($patientMedicalHistory->updated_at == null){
                    $patientMedicalHistory->updated_at = "";
                }
                if($patientMedicalHistory->deleted_at == null){
                    $patientMedicalHistory->deleted_at = "";
                }
                $returnArray[$count] = $patientMedicalHistory;

                $count++;
            }
        }
        else{
            $returnArray = [];
        }
        return $returnArray;
    }

    public function getPatientFamilyHistoryData($patientIdArray){
        $returnArray = array();
        $arr  = implode("','",$patientIdArray);
        $tempPatientFamilyHistoryArr = DB::select("SELECT * from patient_family_history WHERE deleted_at is null AND patient_id IN ('$arr')");

        $count = 0;

        if(isset($tempPatientFamilyHistoryArr) && count($tempPatientFamilyHistoryArr)>0){
            foreach($tempPatientFamilyHistoryArr as $patientFamilyHistory){
                if($patientFamilyHistory->created_at == null){
                    $patientFamilyHistory->created_at = "";
                }
                if($patientFamilyHistory->updated_at == null){
                    $patientFamilyHistory->updated_at = "";
                }
                if($patientFamilyHistory->deleted_at == null){
                    $patientFamilyHistory->deleted_at = "";
                }
                $returnArray[$count] = $patientFamilyHistory;

                $count++;
            }
        }
        else{
            $returnArray = [];
        }
        return $returnArray;
    }

    public function getPatientSurgeryHistoryData($patientIdArray){
        $returnArray = array();
        $arr  = implode("','",$patientIdArray);
        $tempPatientSurgeryHistoryArr = DB::select("SELECT * from patient_surgery_history WHERE deleted_at is null AND patient_id IN ('$arr')");

        $count = 0;

        if(isset($tempPatientSurgeryHistoryArr) && count($tempPatientSurgeryHistoryArr)>0){
            foreach($tempPatientSurgeryHistoryArr as $patientSurgeryHistory){
                if($patientSurgeryHistory->created_at == null){
                    $patientSurgeryHistory->created_at = "";
                }
                if($patientSurgeryHistory->updated_at == null){
                    $patientSurgeryHistory->updated_at = "";
                }
                if($patientSurgeryHistory->deleted_at == null){
                    $patientSurgeryHistory->deleted_at = "";
                }
                $returnArray[$count] = $patientSurgeryHistory;

                $count++;
            }
        }
        else{
            $returnArray = [];
        }
        return $returnArray;
    }

    public function getPatientFamilyMemberData(){
        $returnArray = array();
        $tempPatientFamilyMemberArr = DB::select("SELECT * from patient_family_member WHERE deleted_at is null");

        $count = 0;

        if(isset($tempPatientFamilyMemberArr) && count($tempPatientFamilyMemberArr)>0){
            foreach($tempPatientFamilyMemberArr as $patientFamilyMember){
                if($patientFamilyMember->created_at == null){
                    $patientFamilyMember->created_at = "";
                }
                if($patientFamilyMember->updated_at == null){
                    $patientFamilyMember->updated_at = "";
                }
                if($patientFamilyMember->deleted_at == null){
                    $patientFamilyMember->deleted_at = "";
                }
                $returnArray[$count] = $patientFamilyMember;

                $count++;
            }
        }
        else{
            $returnArray = [];
        }
        return $returnArray;
    }

    public function getPatientPackageArray(){
        $patient_packageArr    = DB::select("SELECT * FROM patient_package WHERE deleted_at is null");
        $patient_package_detailArr = DB::select("SELECT * FROM patient_package_detail");

        if(isset($patient_packageArr) && count($patient_packageArr) > 0 ){
            foreach ($patient_packageArr as $rawKey=>$rawValue) {

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
                if(isset($patient_package_detailArr) && count($patient_package_detailArr) > 0){
                    foreach($patient_package_detailArr as $detail){
                        if($detail->patient_package_id == $rawValue->id){
                            array_push($tempArray,$detail);
                        }
                    }
                }

                $patient_packageArr[$rawKey]->patient_package_detail = $tempArray;

            }
        }

        return $patient_packageArr;
    }
}
