<?php
namespace App\Api\Schedule;
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
 * Date: 7/10/2016
 * Time: 11:20 AM
 */
class ScheduleApiRepository implements ScheduleApiRepositoryInterface
{
    public function getArraysWithStatus($status)
    {
        $query = '';
        if(isset($status) && $status != 'all'){
            $query  = "AND status = '".$status."'";
        }

        $schedules  = DB::select("SELECT * FROM schedules WHERE deleted_at is null $query");

        return $schedules;

    }

    public function getArrays()
    {
        $schedules  = DB::select("SELECT * FROM schedules WHERE deleted_at is null");

        return $schedules;
    }

    public function getScheduleDetail()
    {
        $details  = DB::select("SELECT * FROM schedule_detail");

        return $details;

    }

    public function getScheduleDetailWithPara($rawIdArr)
    {
        $arr  = implode("','",$rawIdArr);
        $details = DB::select("SELECT * from schedule_detail Where schedule_id IN ('$arr')");

        return $details;
    }

    public function create($paramObj,$services,$hhcsPersonnels)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);
            $scheduleId = Utility::generateScheduleId();
            $tempObj->id = $scheduleId;

            if($tempObj->save()){

                // Saving the Schedule Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $scheduleId, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                if(isset($hhcsPersonnels) && count($hhcsPersonnels)>0){
                    foreach($hhcsPersonnels as $user_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $scheduleId, 'user_id' => $user_id, 'type' => 'user']
                        ]);
                    }
                }

                // Updating the enquiry status to "confirm"
                $enquiryId = $tempObj->enquiry_id;
                if($enquiryId != 0){
                    $enquiryRepo = new EnquiryRepository();
                    $enquiryRepo->confirm($enquiryId);
                }
                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

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
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function createMultipleRows($data,$tablet_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            DB::beginTransaction();
            foreach($data as $row) {
                $id = $row->id;
                $enquiry_id = $row->enquiry_id;
                $patient_id = $row->patient_id;

                //start clearing all existing data relating to input data
                if (isset($row->schedule_detail) && count($row->schedule_detail) > 0) {
                    DB::table('schedule_detail')
                        ->where('schedule_id', '=', $id)
                        ->delete();
                }
                if (isset($row->schedule_investigations) && count($row->schedule_investigations) > 0) {
                    DB::table('schedule_investigations')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_patient_chief_complaint) && count($row->schedule_patient_chief_complaint) > 0) {
                    DB::table('schedule_patient_chief_complaint')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_patient_vitals) && count($row->schedule_patient_vitals) > 0) {
                    DB::table('schedule_patient_vitals')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_patient_vitals_remark) && count($row->schedule_patient_vitals_remark) > 0) {
                    DB::table('schedule_patient_vitals_remark')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_physical_exams_abdomen_extre_neuro) && count($row->schedule_physical_exams_abdomen_extre_neuro) > 0) {
                    DB::table('schedule_physical_exams_abdomen_extre_neuro')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_physical_exams_general_pupils_head) && count($row->schedule_physical_exams_general_pupils_head) > 0) {
                    DB::table('schedule_physical_exams_general_pupils_head')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_physical_exams_heart_lungs) && count($row->schedule_physical_exams_heart_lungs) > 0) {
                    DB::table('schedule_physical_exams_heart_lungs')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_physiotherapy_musculo) && count($row->schedule_physiotherapy_musculo) > 0) {
                    DB::table('schedule_physiotherapy_musculo')
                        ->where('schedules_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_physiotherapy_neuro) && count($row->schedule_physiotherapy_neuro) > 0) {
                    DB::table('schedule_physiotherapy_neuro')
                        ->where('schedules_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_provisional_diagnosis) && count($row->schedule_provisional_diagnosis) > 0) {
                    DB::table('schedule_provisional_diagnosis')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }
                if (isset($row->schedule_trackings) && count($row->schedule_trackings) > 0) {
                    DB::table('schedule_trackings')
                        ->where('schedule_id', '=', $id)
                        ->where('enquiry_id', '=', $enquiry_id)
                        ->delete();
                }
                if (isset($row->schedule_treatment_histories) && count($row->schedule_treatment_histories) > 0) {
                    DB::table('schedule_treatment_histories')
                        ->where('schedule_id', '=', $id)
                        ->where('patient_id', '=', $patient_id)
                        ->delete();
                }

                //delete existing schedule data
                DB::table('schedules')
                    ->where('id', '=', $id)
                    ->where('enquiry_id', '=', $enquiry_id)
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule object
                $paramObj = new Schedule();
                $paramObj->id                    = $row->id;
                $paramObj->enquiry_id            = $row->enquiry_id;
                $paramObj->patient_id            = $row->patient_id;
                $paramObj->patient_package_id    = $row->patient_package_id;
                $paramObj->date                  = $row->date;
                $paramObj->time                  = $row->time;
                $paramObj->phone_no              = $row->phone_no;
                $paramObj->township_id           = $row->township_id;
                $paramObj->zone_id               = $row->zone_id;
                $paramObj->car_type              = $row->car_type;
                $paramObj->car_type_setup_id     = $row->car_type_setup_id;
                $paramObj->status                = $row->status;
                $paramObj->remark                = $row->remark;
                $paramObj->leader_id             = $row->leader_id;
                $paramObj->car_type              = $row->car_type;

                if($row->car_type != 3) {
                    $paramObj->car_type_id       = 0;
                }
                else{
                    $paramObj->car_type_id       = $row->car_type_id;
                }

                $paramObj->created_by            = $row->created_by;
                $paramObj->updated_by            = $row->updated_by;
                $paramObj->deleted_by            = $row->deleted_by;
                $paramObj->created_at            = $row->created_at;
                $paramObj->updated_at            = $row->updated_at;
                $paramObj->deleted_at            = $row->deleted_at;
                //saving schedule obj

                $result = $this->createSingleRow($paramObj);
                
                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, continue to child objects and do next loop

                    //start insertion of schedule_detail
                    if (isset($row->schedule_detail) && count($row->schedule_detail) > 0) {
                        foreach($row->schedule_detail as $detail){
                            DB::table('schedule_detail')->insert([
//                                ['schedule_id' => $result['id'],
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

                    //start insertion of schedule_investigations
                    if (isset($row->schedule_investigations) && count($row->schedule_investigations) > 0) {
                        foreach($row->schedule_investigations as $investigation){
                            DB::table('schedule_investigations')->insert([
                                ['patient_id' => $investigation->patient_id,
                                    'schedule_id' => $investigation->schedule_id,
                                    'investigation_id' => $investigation->investigation_id
                                ]
                            ]);
                        }
                    }
                    //end insertion of schedule_investigations

                    //start insertion of schedule_patient_chief_complaint
                    if (isset($row->schedule_patient_chief_complaint) && count($row->schedule_patient_chief_complaint) > 0) {
                        foreach($row->schedule_patient_chief_complaint as $patient_chief_complaint){
                            DB::table('schedule_patient_chief_complaint')->insert([
                                ['id' => $patient_chief_complaint->id,
                                    'schedule_id' => $patient_chief_complaint->schedule_id,
                                    'patient_id' => $patient_chief_complaint->patient_id,
                                    'chief_complaint_comment' => $patient_chief_complaint->chief_complaint_comment,
                                    'duration_days' => $patient_chief_complaint->duration_days,
                                    'duration_months' => $patient_chief_complaint->duration_months,
                                    'hopi' => $patient_chief_complaint->hopi,
                                    'created_by' => $patient_chief_complaint->created_by,
                                    'updated_by' => $patient_chief_complaint->updated_by,
                                    'deleted_by' => $patient_chief_complaint->deleted_by,
                                    'created_at' => $patient_chief_complaint->created_at,
                                    'updated_at' => $patient_chief_complaint->updated_at,
                                    'deleted_at' => $patient_chief_complaint->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_patient_chief_complaint

                    //start insertion of schedule_patient_vitals
                    if (isset($row->schedule_patient_vitals) && count($row->schedule_patient_vitals) > 0) {
                        foreach ($row->schedule_patient_vitals as $patient_vitals) {
                            DB::table('schedule_patient_vitals')->insert([
                                ['id' => $patient_vitals->id,
                                    'patient_id' => $patient_vitals->patient_id,
                                    'schedule_id' => $patient_vitals->schedule_id,
                                    'date' => $patient_vitals->date,
                                    'time' => $patient_vitals->time,
                                    'blood_pressure_sbp' => $patient_vitals->blood_pressure_sbp,
                                    'blood_pressure_dbp' => $patient_vitals->blood_pressure_dbp,
                                    'blood_pressure_map' => $patient_vitals->blood_pressure_map,
                                    'spo2' => $patient_vitals->spo2,
                                    'pulse_rate' => $patient_vitals->pulse_rate,
                                    'body_temperature_farenheit' => $patient_vitals->body_temperature_farenheit,
                                    'body_temperature_celsius' => $patient_vitals->body_temperature_celsius,
                                    'weight_pound' => $patient_vitals->weight_pound,
                                    'weight_kg' => $patient_vitals->weight_kg,
                                    'height_feet' => $patient_vitals->height_feet,
                                    'height_inches' => $patient_vitals->height_inches,
                                    'height_cm' => $patient_vitals->height_cm,
                                    'blood_sugar' => $patient_vitals->blood_sugar,
                                    'spo2_comment' => $patient_vitals->spo2_comment,
                                    'pulse_rate_comment' => $patient_vitals->pulse_rate_comment,
                                    'blood_sugar_comment' => $patient_vitals->blood_sugar_comment,
                                    'bmi' => $patient_vitals->bmi,
                                    'remark' => $patient_vitals->remark,
                                    'created_by' => $patient_vitals->created_by,
                                    'updated_by' => $patient_vitals->updated_by,
                                    'deleted_by' => $patient_vitals->deleted_by,
                                    'created_at' => $patient_vitals->created_at,
                                    'updated_at' => $patient_vitals->updated_at,
                                    'deleted_at' => $patient_vitals->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_patient_vitals


                    //start insertion of schedule_patient_vitals_remark
                    if (isset($row->schedule_patient_vitals_remark) && count($row->schedule_patient_vitals_remark) > 0) {
                        foreach ($row->schedule_patient_vitals_remark as $patient_vitals_remark) {
                            DB::table('schedule_patient_vitals_remark')->insert([
                                ['id' => $patient_vitals_remark->id,
                                    'remark' => $patient_vitals_remark->remark,
                                    'schedule_id' => $patient_vitals_remark->schedule_id,
                                    'patient_id' => $patient_vitals_remark->patient_id,
                                    'created_by' => $patient_vitals_remark->created_by,
                                    'updated_by' => $patient_vitals_remark->updated_by,
                                    'deleted_by' => $patient_vitals_remark->deleted_by,
                                    'created_at' => $patient_vitals_remark->created_at,
                                    'updated_at' => $patient_vitals_remark->updated_at,
                                    'deleted_at' => $patient_vitals_remark->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_patient_vitals_remark

                    //start insertion of schedule_physical_exams_abdomen_extre_neuro
                    if (isset($row->schedule_physical_exams_abdomen_extre_neuro) && count($row->schedule_physical_exams_abdomen_extre_neuro) > 0) {
                        foreach ($row->schedule_physical_exams_abdomen_extre_neuro as $physical_exams_abdomen_extre_neuro) {
                            DB::table('schedule_physical_exams_abdomen_extre_neuro')->insert([
                                ['id' => $physical_exams_abdomen_extre_neuro->id,
                                    'patient_id' => $physical_exams_abdomen_extre_neuro->patient_id,
                                    'schedule_id' => $physical_exams_abdomen_extre_neuro->schedule_id,
                                    'abdomen_normal' => $physical_exams_abdomen_extre_neuro->abdomen_normal,
                                    'abdomen_abnormal' => $physical_exams_abdomen_extre_neuro->abdomen_abnormal,
                                    'abdomen_tenderness' => $physical_exams_abdomen_extre_neuro->abdomen_tenderness,
                                    'abdomen_distension' => $physical_exams_abdomen_extre_neuro->abdomen_distension,
                                    'abdomen_mass' => $physical_exams_abdomen_extre_neuro->abdomen_mass,
                                    'abdomen_hernia' => $physical_exams_abdomen_extre_neuro->abdomen_hernia,
                                    'abdomen_bowel_sound' => $physical_exams_abdomen_extre_neuro->abdomen_bowel_sound,
                                    'abdomen_remark' => $physical_exams_abdomen_extre_neuro->abdomen_remark,
                                    'extre_normal' => $physical_exams_abdomen_extre_neuro->extre_normal,
                                    'extre_abnormal' => $physical_exams_abdomen_extre_neuro->extre_abnormal,
                                    'extre_edema' => $physical_exams_abdomen_extre_neuro->extre_edema,
                                    'extre_varicose' => $physical_exams_abdomen_extre_neuro->extre_varicose,
                                    'extre_ulcer' => $physical_exams_abdomen_extre_neuro->extre_ulcer,
                                    'extre_gangrene' => $physical_exams_abdomen_extre_neuro->extre_gangrene,
                                    'extre_calf_tenderness' => $physical_exams_abdomen_extre_neuro->extre_calf_tenderness,
                                    'extre_ampulation' => $physical_exams_abdomen_extre_neuro->extre_ampulation,
                                    'extre_remark' => $physical_exams_abdomen_extre_neuro->extre_remark,
                                    'neuro_normal' => $physical_exams_abdomen_extre_neuro->neuro_normal,
                                    'neuro_abnormal' => $physical_exams_abdomen_extre_neuro->neuro_abnormal,
                                    'neuro_motor_weakness' => $physical_exams_abdomen_extre_neuro->neuro_motor_weakness,
                                    'neuro_sensory_loss' => $physical_exams_abdomen_extre_neuro->neuro_sensory_loss,
                                    'neuro_abnormal_movement' => $physical_exams_abdomen_extre_neuro->neuro_abnormal_movement,
                                    'neuro_remark' => $physical_exams_abdomen_extre_neuro->neuro_remark,
                                    'created_by' => $physical_exams_abdomen_extre_neuro->created_by,
                                    'updated_by' => $physical_exams_abdomen_extre_neuro->updated_by,
                                    'deleted_by' => $physical_exams_abdomen_extre_neuro->deleted_by,
                                    'created_at' => $physical_exams_abdomen_extre_neuro->created_at,
                                    'updated_at' => $physical_exams_abdomen_extre_neuro->updated_at,
                                    'deleted_at' => $physical_exams_abdomen_extre_neuro->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_physical_exams_abdomen_extre_neuro

                    //start insertion of schedule_physical_exams_general_pupils_head
                    if (isset($row->schedule_physical_exams_general_pupils_head) && count($row->schedule_physical_exams_general_pupils_head) > 0) {
                        foreach ($row->schedule_physical_exams_general_pupils_head as $physical_exams_general_pupils_head) {
                            DB::table('schedule_physical_exams_general_pupils_head')->insert([
                                ['id' => $physical_exams_general_pupils_head->id,
                                    'patient_id' => $physical_exams_general_pupils_head->patient_id,
                                    'schedule_id' => $physical_exams_general_pupils_head->schedule_id,
                                    'alert' => $physical_exams_general_pupils_head->alert,
                                    'unconscious' => $physical_exams_general_pupils_head->unconscious,
                                    'semiconscious' => $physical_exams_general_pupils_head->semiconscious,
                                    'drowsy' => $physical_exams_general_pupils_head->drowsy,
                                    'general_remark' => $physical_exams_general_pupils_head->general_remark,
                                    'pupils_normal' => $physical_exams_general_pupils_head->pupils_normal,
                                    'pupils_abnormal' => $physical_exams_general_pupils_head->pupils_abnormal,
                                    'pupils_left_pinpoint_pupil' => $physical_exams_general_pupils_head->pupils_left_pinpoint_pupil,
                                    'pupils_left_reactive' => $physical_exams_general_pupils_head->pupils_left_reactive,
                                    'pupils_left_not_reactive' => $physical_exams_general_pupils_head->pupils_left_not_reactive,
                                    'pupils_right_pinpoint_pupil' => $physical_exams_general_pupils_head->pupils_right_pinpoint_pupil,
                                    'pupils_right_reactive' => $physical_exams_general_pupils_head->pupils_right_reactive,
                                    'pupils_right_not_reactive' => $physical_exams_general_pupils_head->pupils_right_not_reactive,
                                    'pupils_remark' => $physical_exams_general_pupils_head->pupils_remark,
                                    'head_normal' => $physical_exams_general_pupils_head->head_normal,
                                    'head_abnormal' => $physical_exams_general_pupils_head->head_abnormal,
                                    'head_JVD' => $physical_exams_general_pupils_head->head_JVD,
                                    'head_Goiter' => $physical_exams_general_pupils_head->head_Goiter,
                                    'head_Lympha' => $physical_exams_general_pupils_head->head_Lympha,
                                    'head_remark' => $physical_exams_general_pupils_head->head_remark,
                                    'created_by' => $physical_exams_general_pupils_head->created_by,
                                    'updated_by' => $physical_exams_general_pupils_head->updated_by,
                                    'deleted_by' => $physical_exams_general_pupils_head->deleted_by,
                                    'created_at' => $physical_exams_general_pupils_head->created_at,
                                    'updated_at' => $physical_exams_general_pupils_head->updated_at,
                                    'deleted_at' => $physical_exams_general_pupils_head->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_physical_exams_general_pupils_head

                    //start insertion of schedule_physical_exams_heart_lungs
                    if (isset($row->schedule_physical_exams_heart_lungs) && count($row->schedule_physical_exams_heart_lungs) > 0) {
                        foreach ($row->schedule_physical_exams_heart_lungs as $physical_exams_heart_lungs) {
                            DB::table('schedule_physical_exams_heart_lungs')->insert([
                                ['id' => $physical_exams_heart_lungs->id,
                                    'patient_id' => $physical_exams_heart_lungs->patient_id,
                                    'schedule_id' => $physical_exams_heart_lungs->schedule_id,
                                    'heart_normal' => $physical_exams_heart_lungs->heart_normal,
                                    'heart_abnormal' => $physical_exams_heart_lungs->heart_abnormal,
                                    'heart_rate_normal' => $physical_exams_heart_lungs->heart_rate_normal,
                                    'heart_rate_brady' => $physical_exams_heart_lungs->heart_rate_brady,
                                    'heart_rate_tachy' => $physical_exams_heart_lungs->heart_rate_tachy,
                                    'heart_rhythm_regular' => $physical_exams_heart_lungs->heart_rhythm_regular,
                                    'heart_rhythm_irregular' => $physical_exams_heart_lungs->heart_rhythm_irregular,
                                    'heart_sound_s1' => $physical_exams_heart_lungs->heart_sound_s1,
                                    'heart_sound_s2' => $physical_exams_heart_lungs->heart_sound_s2,
                                    'heart_sound_systolic' => $physical_exams_heart_lungs->heart_sound_systolic,
                                    'heart_sound_diastolic' => $physical_exams_heart_lungs->heart_sound_diastolic,
                                    'heart_remark' => $physical_exams_heart_lungs->heart_remark,
                                    'lungs_normal' => $physical_exams_heart_lungs->lungs_normal,
                                    'lungs_abnormal' => $physical_exams_heart_lungs->lungs_abnormal,
                                    'lungs_left_chest' => $physical_exams_heart_lungs->lungs_left_chest,
                                    'lungs_left_dullness' => $physical_exams_heart_lungs->lungs_left_dullness,
                                    'lungs_left_reduced' => $physical_exams_heart_lungs->lungs_left_reduced,
                                    'lungs_left_absent' => $physical_exams_heart_lungs->lungs_left_absent,
                                    'lungs_left_crepitations' => $physical_exams_heart_lungs->lungs_left_crepitations,
                                    'lungs_left_wheezing' => $physical_exams_heart_lungs->lungs_left_wheezing,
                                    'lungs_right_chest' => $physical_exams_heart_lungs->lungs_right_chest,
                                    'lungs_right_dullness' => $physical_exams_heart_lungs->lungs_right_dullness,
                                    'lungs_right_reduced' => $physical_exams_heart_lungs->lungs_right_reduced,
                                    'lungs_right_absent' => $physical_exams_heart_lungs->lungs_right_absent,
                                    'lungs_right_crepitations' => $physical_exams_heart_lungs->lungs_right_crepitations,
                                    'lungs_right_wheezing' => $physical_exams_heart_lungs->lungs_right_wheezing,
                                    'lungs_remark' => $physical_exams_heart_lungs->lungs_remark,
                                    'created_by' => $physical_exams_heart_lungs->created_by,
                                    'updated_by' => $physical_exams_heart_lungs->updated_by,
                                    'deleted_by' => $physical_exams_heart_lungs->deleted_by,
                                    'created_at' => $physical_exams_heart_lungs->created_at,
                                    'updated_at' => $physical_exams_heart_lungs->updated_at,
                                    'deleted_at' => $physical_exams_heart_lungs->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_physical_exams_heart_lungs

                    //start insertion of schedule_physiotherapy_musculo
                    if (isset($row->schedule_physiotherapy_musculo) && count($row->schedule_physiotherapy_musculo) > 0) {
                        foreach ($row->schedule_physiotherapy_musculo as $physiotherapy_musculo) {
                            DB::table('schedule_physiotherapy_musculo')->insert([
                                ['id' => $physiotherapy_musculo->id,
                                    'patient_id' => $physiotherapy_musculo->patient_id,
                                    'schedules_id' => $physiotherapy_musculo->schedules_id,
                                    'ultrasound' => $physiotherapy_musculo->ultrasound,
                                    'hot_manager' => $physiotherapy_musculo->hot_manager,
                                    'traction' => $physiotherapy_musculo->traction,
                                    'electrical_stimulation' => $physiotherapy_musculo->electrical_stimulation,
                                    'infra_red' => $physiotherapy_musculo->infra_red,
                                    'laser' => $physiotherapy_musculo->laser,
                                    'exercise_therapy' => $physiotherapy_musculo->exercise_therapy,
                                    'health_education' => $physiotherapy_musculo->health_education,
                                    'others' => $physiotherapy_musculo->others,
                                    'signature_of_physiotherapist' => $physiotherapy_musculo->signature_of_physiotherapist,
                                    'diagnosis' => $physiotherapy_musculo->diagnosis,
                                    'progress_note' => $physiotherapy_musculo->progress_note,
                                    'created_by' => $physiotherapy_musculo->created_by,
                                    'updated_by' => $physiotherapy_musculo->updated_by,
                                    'deleted_by' => $physiotherapy_musculo->deleted_by,
                                    'created_at' => $physiotherapy_musculo->created_at,
                                    'updated_at' => $physiotherapy_musculo->updated_at,
                                    'deleted_at' => $physiotherapy_musculo->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_physiotherapy_musculo

                    //start insertion of schedule_physiotherapy_neuro
                    if (isset($row->schedule_physiotherapy_neuro) && count($row->schedule_physiotherapy_neuro) > 0) {
                        foreach ($row->schedule_physiotherapy_neuro as $physiotherapy_neuro) {
                            DB::table('schedule_physiotherapy_neuro')->insert([
                                ['id' => $physiotherapy_neuro->id,
                                    'patient_id' => $physiotherapy_neuro->patient_id,
                                    'schedules_id' => $physiotherapy_neuro->schedules_id,
                                    'diagnosis' => $physiotherapy_neuro->diagnosis,
                                    'resting_bp' => $physiotherapy_neuro->resting_bp,
                                    'resting_hr' => $physiotherapy_neuro->resting_hr,
                                    'resting_spo2' => $physiotherapy_neuro->resting_spo2,
                                    'passive_rom_exercise' => $physiotherapy_neuro->passive_rom_exercise,
                                    'visual_exercise' => $physiotherapy_neuro->visual_exercise,
                                    'oral_motor_exercise' => $physiotherapy_neuro->oral_motor_exercise,
                                    'active_assisted_rom_exercise' => $physiotherapy_neuro->active_assisted_rom_exercise,
                                    'bridging_inner_range' => $physiotherapy_neuro->bridging_inner_range,
                                    'transfer_bed' => $physiotherapy_neuro->transfer_bed,
                                    'sitting_balance' => $physiotherapy_neuro->sitting_balance,
                                    'sit_to_stand' => $physiotherapy_neuro->sit_to_stand,
                                    'standing_balance' => $physiotherapy_neuro->standing_balance,
                                    'stepping' => $physiotherapy_neuro->stepping,
                                    'single_leg_balance' => $physiotherapy_neuro->single_leg_balance,
                                    'march_on_spot' => $physiotherapy_neuro->march_on_spot,
                                    'ambulation_parallel_bar' => $physiotherapy_neuro->ambulation_parallel_bar,
                                    'ambulation_walk' => $physiotherapy_neuro->ambulation_walk,
                                    'ambulation_outdoor' => $physiotherapy_neuro->ambulation_outdoor,
                                    'ambulation_tandem_walk' => $physiotherapy_neuro->ambulation_tandem_walk,
                                    'stair' => $physiotherapy_neuro->stair,
                                    'arm_pedal' => $physiotherapy_neuro->arm_pedal,
                                    'treadmill' => $physiotherapy_neuro->treadmill,
                                    'hand_exercise' => $physiotherapy_neuro->hand_exercise,
                                    'writing_assisted_exercise' => $physiotherapy_neuro->writing_assisted_exercise,
                                    'signature_of_physiotherapist' => $physiotherapy_neuro->signature_of_physiotherapist,
                                    'remark' => $physiotherapy_neuro->remark,
                                    'created_by' => $physiotherapy_neuro->created_by,
                                    'updated_by' => $physiotherapy_neuro->updated_by,
                                    'deleted_by' => $physiotherapy_neuro->deleted_by,
                                    'created_at' => $physiotherapy_neuro->created_at,
                                    'updated_at' => $physiotherapy_neuro->updated_at,
                                    'deleted_at' => $physiotherapy_neuro->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_physiotherapy_neuro

                    //start insertion of schedule_provisional_diagnosis
                    if (isset($row->schedule_provisional_diagnosis) && count($row->schedule_provisional_diagnosis) > 0) {
                        foreach ($row->schedule_provisional_diagnosis as $provisional_diagnosis) {
                            DB::table('schedule_provisional_diagnosis')->insert([
                                ['patient_id' => $provisional_diagnosis->patient_id,
                                    'provisional_id' => $provisional_diagnosis->provisional_id,
                                    'schedule_id' => $provisional_diagnosis->schedule_id,
                                    'remark' => $provisional_diagnosis->remark,
                                    'created_by' => $provisional_diagnosis->created_by,
                                    'updated_by' => $provisional_diagnosis->updated_by,
                                    'deleted_by' => $provisional_diagnosis->deleted_by,
                                    'created_at' => $provisional_diagnosis->created_at,
                                    'updated_at' => $provisional_diagnosis->updated_at,
                                    'deleted_at' => $provisional_diagnosis->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_provisional_diagnosis

                    //end insertion of schedule_trackings
                    if (isset($row->schedule_trackings) && count($row->schedule_trackings) > 0) {
                        foreach ($row->schedule_trackings as $schedule_trackings) {
                            DB::table('schedule_trackings')->insert([
                                ['id' => $schedule_trackings->id,
                                    'preparation_start_time' => $schedule_trackings->preparation_start_time,
                                    'preparation_end_time' => $schedule_trackings->preparation_end_time,
                                    'schedule_id' => $schedule_trackings->schedule_id,
                                    'enquiry_id' => $schedule_trackings->enquiry_id,
                                    'arrived_to_patient_time' => $schedule_trackings->arrived_to_patient_time,
                                    'leave_from_patient_time' => $schedule_trackings->leave_from_patient_time,
                                    'created_by' => $schedule_trackings->created_by,
                                    'updated_by' => $schedule_trackings->updated_by,
                                    'deleted_by' => $schedule_trackings->deleted_by,
                                    'created_at' => $schedule_trackings->created_at,
                                    'updated_at' => $schedule_trackings->updated_at,
                                    'deleted_at' => $schedule_trackings->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_trackings

                    //end insertion of schedule_treatment_histories
                    if (isset($row->schedule_treatment_histories) && count($row->schedule_treatment_histories) > 0) {
                        foreach ($row->schedule_treatment_histories as $treatment_histories) {
                            DB::table('schedule_treatment_histories')->insert([
                                ['patient_id' => $treatment_histories->patient_id,
                                    'product_id' => $treatment_histories->product_id,
                                    'other_product' => $treatment_histories->other_product,
                                    'total_dosage' => $treatment_histories->total_dosage,
                                    'frequency' => $treatment_histories->frequency,
                                    'days' => $treatment_histories->days,
                                    'remark' => $treatment_histories->remark,
                                    'schedule_id' => $treatment_histories->schedule_id,
                                    'sold_dosage' => $treatment_histories->sold_dosage,
                                    'unsold_dosage' => $treatment_histories->unsold_dosage,
                                    'time' => $treatment_histories->time,
                                    'created_by' => $treatment_histories->created_by,
                                    'updated_by' => $treatment_histories->updated_by,
                                    'deleted_by' => $treatment_histories->deleted_by,
                                    'created_at' => $treatment_histories->created_at,
                                    'updated_at' => $treatment_histories->updated_at,
                                    'deleted_at' => $treatment_histories->deleted_at]
                            ]);
                        }
                    }
                    //end insertion of schedule_treatment_histories

                    continue;

                } else {
                    //if schedule insertion is not successful, roll back
                    DB::rollBack();
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule insertion!";
                    return $returnedObj;
                }
            }

            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }

    }

    public function update($id,$paramObj,$services,$hhcsPersonnels)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $schedule_id = $id;
        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                // Cleaning all service, allergy and related thing about the selected enquiry
                DB::table('schedule_detail')->where('schedule_id', '=', $schedule_id)->delete();

                // Saving the Schedule Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $schedule_id, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                if(isset($hhcsPersonnels) && count($hhcsPersonnels)>0){
                    foreach($hhcsPersonnels as $user_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $schedule_id, 'user_id' => $user_id, 'type' => 'user']
                        ]);
                    }
                }

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function deleteSchedule($id, $enquiry_id, $patient_id)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try {
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }
}