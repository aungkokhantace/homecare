<?php
namespace App\Api\Schedule;
use App\Backend\ScheduleInvestigation\ScheduleInvestigation;
use App\Backend\Schedulepatientchiefcomplaint\Schedulepatientchiefcomplaint;
use App\Backend\Schedulepatientvital\Schedulepatientvital;
use App\Backend\Schedulephysicalabdomenextreneuro\Schedulephysicalabdomenextreneuro;
use App\Backend\Schedulephysicalexamsgeneralpupilshead\Schedulephysicalexamsgeneralpupilshead;
use App\Backend\Schedulephysicalexamsheartlungs\Schedulephysicalexamsheartlungs;
use App\Backend\SchedulePhysiotherapyMusculo\SchedulePhysiotherapyMusculo;
use App\Backend\SchedulePhysiotherapyNeuro\SchedulePhysiotherapyNeuro;
use App\Backend\Scheduleprovisionaldiagnosis\Scheduleprovisionaldiagnosis;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\ScheduleTreatmentHistory\ScheduleTreatmentHistory;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;
use App\Backend\Service\ServiceRepository;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Enquiry\Enquiry;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 13/10/2016
 * Time: 10:44 AM
 */
class ScheduleApiV2Repository implements ScheduleApiV2RepositoryInterface
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
            $returnedObj['aceplusStatusMessage'] = "Insertion successful...";
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function schedule($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            $tempLogArr = array();
            foreach($data as $row) {
                $id = $row->id;
//                $enquiry_id = $row->enquiry_id;
//                $patient_id = $row->patient_id;

                //Check update or create for log date
                $findObj    = Schedule::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //start clearing all existing data relating to input data
                //delete existing schedule_detail data which is the same as input data
                DB::table('schedule_detail')
                    ->where('schedule_id', '=', $id)
                    ->delete();


                //delete existing schedules data which is the same as input data
                DB::table('schedules')
                    ->where('id', '=', $id)
                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule object
                $paramObj                        = new Schedule();
                $paramObj->id                    = $row->id;
                $paramObj->enquiry_id            = $row->enquiry_id;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->patient_package_id    = (isset($row->patient_package_id) && $row->patient_package_id != 0)?$row->patient_package_id:"";
                $paramObj->date                  = $row->date;
                $paramObj->time                  = $row->time;
                $paramObj->phone_no              = $row->phone_no;
                $paramObj->township_id           = $row->township_id;
                $paramObj->zone_id               = $row->zone_id;
                $paramObj->car_type              = $row->car_type;
                $paramObj->car_type_setup_id     = $row->car_type_setup_id;
                $paramObj->status                = strtolower($row->status);
                $paramObj->remark                = isset($row->remark)?$row->remark:"";
                $paramObj->leader_id             = $row->leader_id;
                $paramObj->doctor_comments       = isset($row->doctor_comments)?$row->doctor_comments:"";

                if($row->car_type != 3) {
                    $paramObj->car_type_id       = 0;
                }
                else{
                    $paramObj->car_type_id       = $row->car_type_id;
                }

                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule obj
                $result = $this->createSingleRow($paramObj);
                
                //check whether schedule insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if schedule insertion was successful, continue to child objects and do next loop
                    //start insertion of schedule_detail
                    if (isset($row->schedule_detail) && count($row->schedule_detail) > 0) {
                        foreach($row->schedule_detail as $detail){
                            DB::table('schedule_detail')->insert([
                                ['schedule_id' => $detail->schedule_id,
                                    'package_id' => $detail->package_id,
                                    'service_id' => $detail->service_id,
                                    'user_id' => $detail->user_id,
                                    'type' => $detail->type
                                ]
                            ]);
                        }
                    }
                    //end insertion of schedule_detail
                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule data)

                } else {
                    //if schedule insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Schedule successfully inserted";
            $returnedObj['log']                  = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function schedulePatientVitals($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id = $row->patient_id;
                $schedule_id = $row->schedule_id;

                //delete existing schedules_patient_vitals data which is the same as input data
                DB::table('schedule_patient_vitals')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id = $row->id;
                $patient_id = $row->patient_id;
                $schedule_id = $row->schedule_id;

                //Check update or create for log date
                $findObj    = Schedulepatientvital::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedules_patient_vitals data which is the same as input data
//                DB::table('schedule_patient_vitals')
////                    ->where('id', '=', $id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_patient_vitals object
                $paramObj = new Schedulepatientvital();

                $paramObj->id                           = $row->id;
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->date                         = $row->date;
                $paramObj->time                         = $row->time;
                $paramObj->blood_pressure_sbp           = $row->blood_pressure_sbp;
                $paramObj->blood_pressure_dbp           = $row->blood_pressure_dbp;
                $paramObj->blood_pressure_map           = $row->blood_pressure_map;
                $paramObj->spo2                         = $row->spo2;
                $paramObj->pulse_rate                   = $row->pulse_rate;
                $paramObj->body_temperature_farenheit   = $row->body_temperature_farenheit;
                $paramObj->body_temperature_celsius     = $row->body_temperature_celsius;
                $paramObj->weight_pound                 = $row->weight_pound;
                $paramObj->weight_kg                    = $row->weight_kg;
                $paramObj->height_feet                  = $row->height_feet;
                $paramObj->height_inches                = $row->height_inches;
                $paramObj->height_cm                    = $row->height_cm;
                $paramObj->blood_sugar                  = $row->blood_sugar;
                $paramObj->spo2_comment                 = $row->spo2_comment;
                $paramObj->pulse_rate_comment           = isset($row->pulse_rate_comment)?$row->pulse_rate_comment:"";
                $paramObj->blood_sugar_comment          = isset($row->blood_sugar_comment)?$row->blood_sugar_comment:"";
                $paramObj->bmi                          = $row->bmi;
                $paramObj->remark                       = isset($row->remark)?$row->remark:"";
                $paramObj->resp_rate                    = $row->resp_rate;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_patient_vitals obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_patient_vitals insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_patient_vitals_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_patient_vitals data)
                } else {
                    //if schedule_patient_vitals insertion was not successful
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

    public function schedulePatientChiefComplaint($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $schedule_id = $row->schedule_id;
                $patient_id = $row->patient_id;

                //delete existing schedule_patient_chief_complaint data which is the same as input data
                DB::table('schedule_patient_chief_complaint')
                    ->where('schedule_id', '=', $schedule_id)
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
            }

            $tempLogArr = array();
            foreach($data as $row) {
                $id = $row->id;
                $schedule_id = $row->schedule_id;
                $patient_id = $row->patient_id;
                $chief_complaint_comment = $row->chief_complaint_comment;

                //Check update or create for log date
                $findObj    = Schedulepatientchiefcomplaint::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_patient_chief_complaint data which is the same as input data
//                DB::table('schedule_patient_chief_complaint')
////                    ->where('id', '=', $id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('chief_complaint_comment', '=', $chief_complaint_comment)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_patient_chief_complaint object
                $paramObj = new Schedulepatientchiefcomplaint();

                $paramObj->id                           = $row->id;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->chief_complaint_comment      = isset($row->chief_complaint_comment)?$row->chief_complaint_comment:"";
                $paramObj->duration_days                = $row->duration_days;
                $paramObj->duration_months              = $row->duration_months;
                $paramObj->hopi                         = $row->hopi;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_patient_chief_complaint obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_patient_chief_complaint insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_patient_chief_complaint_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_patient_chief_complaint data)
                } else {
                    //if schedule_patient_chief_complaint insertion was not successful
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

    public function scheduleTreatmentHistory($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //delete existing schedule_treatment_histories data which is the same as input data
                DB::table('schedule_treatment_histories')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr         = array();
            foreach($data as $row) {
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $product_id     = $row->product_id;
                $schedule_id    = $row->schedule_id;
                //Check update or create for log date
                $findObj    = ScheduleTreatmentHistory::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //start clearing all existing data relating to input data
//                //delete existing schedule_treatment_histories data which is the same as input data
//                DB::table('schedule_treatment_histories')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
////                    ->where('product_id', '=', $product_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_treatment_histories object
                $paramObj = new ScheduleTreatmentHistory();
                $paramObj->id                           = $row->id;
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->product_id                   = $row->product_id;
                $paramObj->other_product                = $row->other_product;
                $paramObj->total_dosage                 = $row->total_dosage;
                $paramObj->frequency                    = $row->frequency;
                $paramObj->days                         = $row->days;
                $paramObj->remark                       = isset($row->remark)?$row->remark:"";
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->sold_dosage                  = $row->sold_dosage;
                $paramObj->unsold_dosage                = $row->unsold_dosage;
                $paramObj->time                         = $row->time;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_treatment_histories obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_treatment_histories insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_treatment_histories_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_treatment_histories data)
                } else {
                    //if schedule_treatment_histories insertion was not successful
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

    public function scheduleProvisionalDiagnosis($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //delete existing schedule_provisional_diagnosis data which is the same as input data
                DB::table('schedule_provisional_diagnosis')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $provisional_id = $row->provisional_id;
                $schedule_id    = $row->schedule_id;

                //Check update or create for log date
                $findObj    = Scheduleprovisionaldiagnosis::where('patient_id','=',$row->patient_id)
                                                            ->where('provisional_id','=',$provisional_id)
                                                            ->where('schedule_id','=',$schedule_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
                //start clearing all existing data relating to input data
//                //delete existing schedule_provisional_diagnosis data which is the same as input data
//                DB::table('schedule_provisional_diagnosis')
//                    ->where('patient_id', '=', $patient_id)
////                    ->where('provisional_id', '=', $provisional_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_provisional_diagnosis object
                $paramObj = new Scheduleprovisionaldiagnosis();

                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->provisional_id               = $row->provisional_id;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->remark                       = isset($row->remark)?$row->remark:"";
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_provisional_diagnosis obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_provisional_diagnosis insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_provisional_diagnosis for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_provisional_diagnosis data)
                } else {
                    //if schedule_provisional_diagnosis insertion was not successful
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

    public function schedulePhysiotherapyMusculo($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedules_id;

                //delete existing schedule_physiotherapy_musculo data which is the same as input data
                DB::table('schedule_physiotherapy_musculo')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedules_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedules_id;

                //Check update or create for log date
                $findObj    = SchedulePhysiotherapyMusculo::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_physiotherapy_musculo data which is the same as input data
//                DB::table('schedule_physiotherapy_musculo')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedules_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_physiotherapy_musculo object
                $paramObj = new SchedulePhysiotherapyMusculo();
                $paramObj->id                           =$row->id;
                $paramObj->patient_id                   =$row->patient_id;
                $paramObj->schedules_id                 =$row->schedules_id;
                $paramObj->ultrasound                   =$row->ultrasound;
                $paramObj->hot_manager                  =$row->hot_manager;
                $paramObj->traction                     =$row->traction;
                $paramObj->electrical_stimulation       =$row->electrical_stimulation;
                $paramObj->infra_red                    =$row->infra_red;
                $paramObj->laser                        =$row->laser;
                $paramObj->exercise_therapy             =$row->exercise_therapy;
                $paramObj->health_education             =$row->health_education;
                $paramObj->others                       =$row->others;
                $paramObj->signature_of_physiotherapist =$row->signature_of_physiotherapist;
                $paramObj->diagnosis                    =$row->diagnosis;
                $paramObj->progress_note                =$row->progress_note;
                $paramObj->created_by                   =$row->created_by;
                $paramObj->updated_by                   =$row->updated_by;
                $paramObj->deleted_by                   =$row->deleted_by;
                $paramObj->created_at                   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;


                //saving schedule_physiotherapy_musculo obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_physiotherapy_musculo insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_physiotherapy_musculo_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_physiotherapy_musculo data)
                } else {
                    //if schedule_physiotherapy_musculo insertion was not successful
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

    public function schedulePhysiotherapyNeuro($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedules_id;
                //delete existing schedule_physiotherapy_neuro data which is the same as input data
                DB::table('schedule_physiotherapy_neuro')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedules_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedules_id;

                //Check update or create for log date
                $findObj    = SchedulePhysiotherapyNeuro::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_physiotherapy_neuro data which is the same as input data
//                DB::table('schedule_physiotherapy_neuro')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedules_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_physiotherapy_neuro object
                $paramObj                                   = new SchedulePhysiotherapyNeuro();
                $paramObj->id 								= $row->id;
                $paramObj->patient_id 						= $row->patient_id;
                $paramObj->schedules_id 					= $row->schedules_id;
                $paramObj->diagnosis 						= $row->diagnosis;
                $paramObj->resting_bp 						= $row->resting_bp;
                $paramObj->resting_hr 						= $row->resting_hr;
                $paramObj->resting_spo2 					= $row->resting_spo2;
                $paramObj->passive_rom_exercise 			= $row->passive_rom_exercise;
                $paramObj->visual_exercise 					= $row->visual_exercise;
                $paramObj->oral_motor_exercise 				= $row->oral_motor_exercise;
                $paramObj->active_assisted_rom_exercise 	= $row->active_assisted_rom_exercise;
                $paramObj->bridging_inner_range 			= $row->bridging_inner_range;
                $paramObj->transfer_bed 					= $row->transfer_bed;
                $paramObj->sitting_balance 					= $row->sitting_balance;
                $paramObj->sit_to_stand 					= $row->sit_to_stand;
                $paramObj->standing_balance 				= $row->standing_balance;
                $paramObj->stepping 						= $row->stepping;
                $paramObj->single_leg_balance 				= $row->single_leg_balance;
                $paramObj->march_on_spot 					= $row->march_on_spot;
                $paramObj->ambulation_parallel_bar 			= $row->ambulation_parallel_bar;
                $paramObj->ambulation_walk 					= $row->ambulation_walk;
                $paramObj->ambulation_outdoor 				= $row->ambulation_outdoor;
                $paramObj->ambulation_tandem_walk 			= $row->ambulation_tandem_walk;
                $paramObj->stair 							= $row->stair;
                $paramObj->arm_pedal 						= $row->arm_pedal;
                $paramObj->treadmill 						= $row->treadmill;
                $paramObj->hand_exercise 					= $row->hand_exercise;
                $paramObj->writing_assisted_exercise 		= $row->writing_assisted_exercise;
                $paramObj->signature_of_physiotherapist 	= $row->signature_of_physiotherapist;
                $paramObj->remark 							= isset($row->remark)?$row->remark:"";
                $paramObj->created_by 						= $row->created_by;
                $paramObj->updated_by 						= $row->updated_by;
                $paramObj->deleted_by 						= $row->deleted_by;
                $paramObj->created_at                       = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                       = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                       = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_physiotherapy_neuro obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_physiotherapy_neuro insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_physiotherapy_neuro_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_physiotherapy_neuro data)
                } else {
                    //if schedule_physiotherapy_neuro insertion was not successful
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

    public function scheduleTrackings($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $schedule_id    = $row->schedule_id;

                //delete existing schedule_trackings data which is the same as input data
                DB::table('schedule_trackings')
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id             = $row->id;
                $enquiry_id     = $row->enquiry_id;
                $schedule_id    = $row->schedule_id;

                //Check update or create for log date
                $findObj    = Scheduletracking::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }
                //start clearing all existing data relating to input data
//                //delete existing schedule_trackings data which is the same as input data
//                DB::table('schedule_trackings')
////                    ->where('id','=',$id)
////                    ->where('enquiry_id', '=', $enquiry_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_trackings object
                $paramObj                           = new Scheduletracking();
                $paramObj->id                       =$row->id;
                $paramObj->preparation_start_time   =$row->preparation_start_time;
                $paramObj->preparation_end_time     =$row->preparation_end_time;
                $paramObj->schedule_id              =$row->schedule_id;
                $paramObj->enquiry_id               =$row->enquiry_id;
                $paramObj->arrived_to_patient_time  =$row->arrived_to_patient_time;
                $paramObj->leave_from_patient_time  =$row->leave_from_patient_time;
                $paramObj->created_by               =$row->created_by;
                $paramObj->updated_by               =$row->updated_by;
                $paramObj->deleted_by               =$row->deleted_by;
                $paramObj->created_at               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_trackings obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_trackings insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_trackings_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_trackings data)
                } else {
                    //if schedule_trackings insertion was not successful
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

    public function schedulePhysicalExamsGeneralPupilsHead($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //delete existing schedule_physical_exams_general_pupils_head data which is the same as input data
                DB::table('schedule_physical_exams_general_pupils_head')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr  = array();
            foreach($data as $row) {
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //Check update or create for log date
                $findObj    = Schedulephysicalexamsgeneralpupilshead::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_physical_exams_general_pupils_head data which is the same as input data
//                DB::table('schedule_physical_exams_general_pupils_head')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_physical_exams_general_pupils_head object
                $paramObj = new Schedulephysicalexamsgeneralpupilshead();
                $paramObj->id                       =$row->id;
                $paramObj->patient_id               =$row->patient_id;
                $paramObj->schedule_id              =$row->schedule_id;
                $paramObj->alert                    =$row->alert;
                $paramObj->unconscious              =$row->unconscious;
                $paramObj->semiconscious            =$row->semiconscious;
                $paramObj->drowsy                   =$row->drowsy;
                $paramObj->general_remark           =isset($row->general_remark)?$row->general_remark:"";
                $paramObj->drowsy                   =$row->drowsy;
                $paramObj->pupils_normal            =$row->pupils_normal;
                $paramObj->pupils_abnormal          =$row->pupils_abnormal;
                $paramObj->pupils_left_pinpoint_pupil=$row->pupils_left_pinpoint_pupil;
                $paramObj->pupils_left_reactive     =$row->pupils_left_reactive;
                $paramObj->pupils_left_not_reactive =$row->pupils_left_not_reactive;
                $paramObj->pupils_right_pinpoint_pupil=$row->pupils_right_pinpoint_pupil;
                $paramObj->pupils_right_reactive    =$row->pupils_right_reactive;
                $paramObj->pupils_right_not_reactive=$row->pupils_right_not_reactive;
                $paramObj->pupils_remark            =isset($row->pupils_remark)?$row->pupils_remark:"";
                $paramObj->head_normal              =$row->head_normal;
                $paramObj->head_abnormal            =$row->head_abnormal;
                $paramObj->head_JVD                 =$row->head_JVD;
                $paramObj->head_Goiter              =$row->head_Goiter;
                $paramObj->head_Lympha              =$row->head_Lympha;
                $paramObj->head_remark              =isset($row->head_remark)?$row->head_remark:"";
                $paramObj->created_by               =$row->created_by;
                $paramObj->updated_by               =$row->updated_by;
                $paramObj->deleted_by               =$row->deleted_by;
                $paramObj->created_at               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;
                //saving schedule_physical_exams_general_pupils_head obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_physical_exams_general_pupils_head insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_physical_exams_general_pupils_head_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_physical_exams_general_pupils_head data)
                } else {
                    //if schedule_physical_exams_general_pupils_head insertion was not successful
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

    public function schedulePhysicalExamsHeartLungs($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id    = $row->patient_id;
                $schedule_id    = $row->schedule_id;

//                delete existing schedule_physical_exams_heart_lungs data which is the same as input data
                DB::table('schedule_physical_exams_heart_lungs')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id             = $row->id;
                $patient_id    = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //Check update or create for log date
                $findObj    = Schedulephysicalexamsheartlungs::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_physical_exams_heart_lungs data which is the same as input data
//                DB::table('schedule_physical_exams_heart_lungs')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_physical_exams_heart_lungs object
                $paramObj                           = new Schedulephysicalexamsheartlungs();
                $paramObj->id                       = $row->id;
                $paramObj->patient_id               = $row->patient_id;
                $paramObj->schedule_id              = $row->schedule_id;
                $paramObj->heart_normal             = $row->heart_normal;
                $paramObj->heart_abnormal           = $row->heart_abnormal;
                $paramObj->heart_rate_normal        = $row->heart_rate_normal;
                $paramObj->heart_rate_brady         = $row->heart_rate_brady;
                $paramObj->heart_rate_tachy         = $row->heart_rate_tachy;
                $paramObj->heart_rhythm_regular     = $row->heart_rhythm_regular;
                $paramObj->heart_rhythm_irregular   = $row->heart_rhythm_irregular;
                $paramObj->heart_sound_s1           = $row->heart_sound_s1;
                $paramObj->heart_sound_s2           = $row->heart_sound_s2;
                $paramObj->heart_sound_systolic     = $row->heart_sound_systolic;
                $paramObj->heart_sound_diastolic    = $row->heart_sound_diastolic;
                $paramObj->heart_remark             = isset($row->heart_remark)?$row->heart_remark:"";
                $paramObj->lungs_normal             = $row->lungs_normal;
                $paramObj->lungs_abnormal           = $row->lungs_abnormal;
                $paramObj->lungs_left_chest         = $row->lungs_left_chest;
                $paramObj->lungs_left_dullness      = $row->lungs_left_dullness;
                $paramObj->lungs_left_reduced       = $row->lungs_left_reduced;
                $paramObj->lungs_left_absent        = $row->lungs_left_absent;
                $paramObj->lungs_left_crepitations  = $row->lungs_left_crepitations;
                $paramObj->lungs_left_wheezing      = $row->lungs_left_wheezing;
                $paramObj->lungs_right_chest        = $row->lungs_right_chest;
                $paramObj->lungs_right_dullness     = $row->lungs_right_dullness;
                $paramObj->lungs_right_reduced      = $row->lungs_right_reduced;
                $paramObj->lungs_right_absent       = $row->lungs_right_absent;
                $paramObj->lungs_right_crepitations = $row->lungs_right_crepitations;
                $paramObj->lungs_right_wheezing     = $row->lungs_right_wheezing;
                $paramObj->lungs_remark             = isset($row->lungs_remark)?$row->lungs_remark:"";
                $paramObj->created_by               = $row->created_by;
                $paramObj->updated_by               = $row->updated_by;
                $paramObj->deleted_by               = $row->deleted_by;
                $paramObj->created_at               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_physical_exams_heart_lungs obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_physical_exams_heart_lungs insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_physical_exams_heart_lungs_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_physical_exams_heart_lungs data)
                } else {
                    //if schedule_physical_exams_heart_lungs insertion was not successful
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

    public function schedulePhysicalExamsAbdomenExtreNeuro($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $schedule_id    = $row->schedule_id;
                $patient_id    = $row->patient_id;

                //delete existing schedule_physical_exams_abdomen_extre_neuro data which is the same as input data
                DB::table('schedule_physical_exams_abdomen_extre_neuro')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row) {
                $id             = $row->id;
                $schedule_id    = $row->schedule_id;
                $patient_id    = $row->patient_id;

                //Check update or create for log date
                $findObj    = Schedulephysicalabdomenextreneuro::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //start clearing all existing data relating to input data
//                //delete existing schedule_physical_exams_abdomen_extre_neuro data which is the same as input data
//                DB::table('schedule_physical_exams_abdomen_extre_neuro')
////                    ->where('id','=',$id)
//                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedule_id', '=', $schedule_id)
//                    ->delete();
//                //end clearing all existing data relating to input data

                //creating schedule_physical_exams_abdomen_extre_neuro object
                $paramObj = new Schedulephysicalabdomenextreneuro();
                $paramObj->id                       = $row->id;
                $paramObj->patient_id               = $row->patient_id;
                $paramObj->schedule_id              = $row->schedule_id;
                $paramObj->abdomen_normal           = $row->abdomen_normal;
                $paramObj->abdomen_abnormal         = $row->abdomen_abnormal;
                $paramObj->abdomen_tenderness       = $row->abdomen_tenderness;
                $paramObj->abdomen_distension       = $row->abdomen_distension;
                $paramObj->abdomen_mass             = $row->abdomen_mass;
                $paramObj->abdomen_hernia           = $row->abdomen_hernia;
                $paramObj->abdomen_bowel_sound      = $row->abdomen_bowel_sound;
                $paramObj->abdomen_remark           = isset($row->abdomen_remark)?$row->abdomen_remark:"";
                $paramObj->extre_normal             = $row->extre_normal;
                $paramObj->extre_abnormal           = $row->extre_abnormal;
                $paramObj->extre_edema              = $row->extre_edema;
                $paramObj->extre_varicose           = $row->extre_varicose;
                $paramObj->extre_ulcer              = $row->extre_ulcer;
                $paramObj->extre_gangrene           = $row->extre_gangrene;
                $paramObj->extre_calf_tenderness    = $row->extre_calf_tenderness;
                $paramObj->extre_ampulation         = $row->extre_ampulation;
                $paramObj->extre_remark             = isset($row->extre_remark)?$row->extre_remark:"";
                $paramObj->neuro_normal             = $row->neuro_normal;
                $paramObj->neuro_abnormal           = $row->neuro_abnormal;
                $paramObj->neuro_motor_weakness     = $row->neuro_motor_weakness;
                $paramObj->neuro_sensory_loss       = $row->neuro_sensory_loss;
                $paramObj->neuro_abnormal_movement  = $row->neuro_abnormal_movement;
                $paramObj->neuro_remark             = isset($row->neuro_remark)?$row->neuro_remark:"";
                $paramObj->created_by               = $row->created_by;
                $paramObj->updated_by               = $row->updated_by;
                $paramObj->deleted_by               = $row->deleted_by;
                $paramObj->created_at               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_physical_exams_abdomen_extre_neuro obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_physical_exams_abdomen_extre_neuro insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_physical_exams_abdomen_extre_neuro_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule_physical_exams_abdomen_extre_neuro data)
                } else {
                    //if schedule_physical_exams_abdomen_extre_neuro insertion was not successful
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

    public function scheduleInvestigation($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr = array();
            $tempArr    = array();
            $temp       = array();
            $tempCP     = array();

            foreach($data as $row){
                //Check update or create for log date
                $findObj    = ScheduleInvestigation::where('patient_id','=',$row->patient_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $temp['date']               = $row->updated_at;
                    $temp['create']             = "updated";
                    $temp['patient_id']         = $row->patient_id;
                }
                else{
                    $temp['date']               = $row->created_at;
                    $temp['create']             = "created";
                    $temp['patient_id']         = $row->patient_id;
                }
                array_push($tempCP,$temp);
            }
            foreach($data as $row) {
                $patient_id = $row->patient_id;
                $schedule_id = $row->schedule_id;
                //start clearing all existing data relating to input data

                //delete existing schedule_investigations data which is the same as input data
                DB::table('schedule_investigations')
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
                //end clearing all existing data relating to input data
            }
            foreach($data as $row) {
                //creating schedule_investigations object
                $paramObj                                   = new ScheduleInvestigation();
                $paramObj->patient_id 						= $row->patient_id;
                $paramObj->schedule_id 						= $row->schedule_id;
                $paramObj->investigation_id 				= $row->investigation_id;
                $paramObj->investigation_lab_remark 		= isset($row->investigation_lab_remark)?$row->investigation_lab_remark:"";
                $paramObj->investigation_imaging_xray_id 	= $row->investigation_imaging_xray_id;
                $paramObj->investigation_imaging_usg_id 	= $row->investigation_imaging_usg_id;
                $paramObj->investigation_imaging_ct_id 		= $row->investigation_imaging_ct_id;
                $paramObj->investigation_imaging_mri_id 	= $row->investigation_imaging_mri_id;
                $paramObj->investigation_imaging_other_id 	= $row->investigation_imaging_other_id;
                $paramObj->investigation_imaging_remark 	= isset($row->investigation_imaging_remark)?$row->investigation_imaging_remark:"";
                $paramObj->investigation_ecg_remark 		= isset($row->investigation_ecg_remark)?$row->investigation_ecg_remark:"";
                $paramObj->investigation_other_remark 		= isset($row->investigation_other_remark)?$row->investigation_other_remark:"";
                $paramObj->investigation_labs_price 		= $row->investigation_labs_price;
                $paramObj->investigation_labs_type 		    = $row->investigation_labs_type;
                $paramObj->created_by 						= $row->created_by;
                $paramObj->updated_by 						= $row->updated_by;
                $paramObj->deleted_by 						= $row->deleted_by;
                $paramObj->created_at                       = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                       = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                       = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //saving schedule_investigations obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_investigations insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    continue;       //continue to next loop(i.e. next row of schedule_investigations data)
                } else {
                    //if schedule_investigations insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            //if insertion was successful, then create date and message for log
            foreach($tempCP as $cp){
                $tempArr['date']    = $cp['date'];
                $tempArr['message'] = $cp['create'].' schedule_investigations for patient_id = '.$cp['patient_id'];
                array_push($tempLogArr,$tempArr);
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

    public function getScheduleArray($idArr){
        $arr  = implode("','",$idArr);

//        $scheduleArr     = DB::select("SELECT * from `schedules` WHERE `deleted_at` is null AND `patient_id` IN ('$arr') AND `status` NOT IN ('complete','cancel') AND `date` >= CURDATE()");
//        $scheduleArr     = DB::select("SELECT * from `schedules` WHERE `deleted_at` is null AND `patient_id` IN ('$arr') AND `status` NOT IN ('cancel') AND `date` >= CURDATE()");
        $scheduleArr     = DB::select("SELECT * from `schedules` WHERE `deleted_at` is null AND `patient_id` IN ('$arr') AND `status` NOT IN ('cancel') AND `date` >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)");
        $schedule_detailArr = DB::select("SELECT * FROM schedule_detail");
        if(isset($scheduleArr) && count($scheduleArr) > 0){
            foreach ($scheduleArr as $rawKey=>$rawValue) {

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
                if(isset($schedule_detailArr) && count($schedule_detailArr) > 0){
                    foreach($schedule_detailArr as $detail){
                        if($detail->schedule_id == $rawValue->id){
                            array_push($tempArray,$detail);
                        }
                    }
                }

                $scheduleArr[$rawKey]->schedule_detail = $tempArray;

            }
        }
        return $scheduleArr;
    }

    public function getScheduleTreatmentArray($idArr){
        $arr  = implode("','",$idArr);

        $schedule_treatmentArr     = DB::select("SELECT * from `schedule_treatment_histories` WHERE `deleted_at` is null AND `patient_id` IN ('$arr')");
        if(isset($schedule_treatmentArr) && count($schedule_treatmentArr) > 0){
            foreach ($schedule_treatmentArr as $rawKey=>$rawValue) {

                if($rawValue->created_at == null){
                    $rawValue->created_at = "";
                }
                if($rawValue->updated_at == null){
                    $rawValue->updated_at = "";
                }
                if($rawValue->deleted_at == null){
                    $rawValue->deleted_at = "";
                }
            }
        }

        return $schedule_treatmentArr;
    }

    public function uploadScheduleStatus($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            $tempLogArr = array();
            foreach($data as $row) {
                $id = $row->id;

                //Check update or create for log date
                $findObj    = Schedule::find($id);
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                }
                else{
                    $tempArr['date'] = date("Y-m-d H:i:s");
                }
                $create = "updated";

                $findObj->status        = $row->status;
                $findObj->updated_at    = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;

                //saving schedule obj
                $result = $this->createSingleRow($findObj);

                //check whether schedule insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' schedule_id = '.$findObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of schedule data)

                } else {
                    //if schedule insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Schedule status successfully updated";
            $returnedObj['log']                  = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }
}