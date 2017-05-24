<?php
namespace App\Api\Schedule;
use App\Backend\Schedulepatientchiefcomplaint\Schedulepatientchiefcomplaint;
use App\Backend\Schedulepatientvital\Schedulepatientvital;
use App\Backend\Scheduleprovisionaldiagnosis\Scheduleprovisionaldiagnosis;
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
class ScheduleApiV3Repository implements ScheduleApiV3RepositoryInterface
{
    public function getScheduleData($user_id){
        $tempObj = DB::select("SELECT schedules.* FROM schedules
                              LEFT JOIN schedule_detail ON schedules.id = schedule_detail.schedule_id
                              WHERE schedules.deleted_at is null
                              AND date >= CURDATE()
                              AND schedules.status >= 'new'
                              OR schedules.status >= 'processing'
                              AND schedule_detail.user_id = '$user_id'");
        return $tempObj;
    }

    public function getScheduleHeader($user_id){
        $tempObj = DB::select("SELECT schedules.* FROM schedules
                              WHERE schedules.deleted_at is null
                              AND date >= CURDATE()
                              AND schedules.leader_id = '$user_id'
                              AND (schedules.status = 'new'
                              OR schedules.status = 'processing' OR schedules.status = 'complete')");
        return $tempObj;
    }

    public function getScheduleDetails($id){
        $tempObj = DB::select("SELECT * FROM schedule_detail
                              WHERE schedule_detail.schedule_id = '$id'");
        return $tempObj;
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

    public function schedule($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            foreach($data as $row) {
                $id = $row->id;
                $enquiry_id = $row->enquiry_id;
                $patient_id = $row->patient_id;

                //start clearing all existing data relating to input data
                //delete existing schedule_detail data which is the same as input data
                if (isset($row->schedule_detail) && count($row->schedule_detail) > 0) {
                    DB::table('schedule_detail')
                        ->where('schedule_id', '=', $id)
                        ->delete();
                }

                //delete existing schedules data which is the same as input data
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

                    continue;       //continue to next loop(i.e. next row of schedule data)

                } else {
                    //if schedule insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule insertion!";
                    return $returnedObj;
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

    public function schedulePatientVitals($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $id = $row->id;
                $patient_id = $row->patient_id;
                $schedule_id = $row->schedule_id;

                //start clearing all existing data relating to input data

                //delete existing schedules_patient_vitals data which is the same as input data
                DB::table('schedule_patient_vitals')
                    ->where('id', '=', $id)
                    ->where('patient_id', '=', $patient_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
                //end clearing all existing data relating to input data

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
                $paramObj->pulse_rate_comment           = $row->pulse_rate_comment;
                $paramObj->blood_sugar_comment          = $row->blood_sugar_comment;
                $paramObj->bmi                          = $row->bmi;
                $paramObj->remark                       = $row->remark;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = $row->created_at;
                $paramObj->updated_at                   = $row->updated_at;
                $paramObj->deleted_at                   = $row->deleted_at;

                //saving schedule_patient_vitals obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_patient_vitals insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if schedule_patient_vitals insertion was successful, continue to child objects and do next loop
                    continue;       //continue to next loop(i.e. next row of schedule_patient_vitals data)
                } else {
                    //if schedule_patient_vitals insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule_patient_vitals insertion!";
                    return $returnedObj;
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

    public function schedulePatientChiefComplaint($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $id = $row->id;
                $schedule_id = $row->schedule_id;
                $patient_id = $row->patient_id;
                //start clearing all existing data relating to input data

                //delete existing schedule_patient_chief_complaint data which is the same as input data
                DB::table('schedule_patient_chief_complaint')
                    ->where('id', '=', $id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->where('patient_id', '=', $patient_id)
                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_patient_chief_complaint object
                $paramObj = new Schedulepatientchiefcomplaint();

                $paramObj->id                           = $row->id;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->chief_complaint_comment      = $row->chief_complaint_comment;
                $paramObj->duration_days                = $row->duration_days;
                $paramObj->duration_months              = $row->duration_months;
                $paramObj->hopi                         = $row->hopi;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = $row->created_at;
                $paramObj->updated_at                   = $row->updated_at;
                $paramObj->deleted_at                   = $row->deleted_at;

                //saving schedule_patient_chief_complaint obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_patient_chief_complaint insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if schedule_patient_chief_complaint insertion was successful, continue to child objects and do next loop
                    continue;       //continue to next loop(i.e. next row of schedule_patient_chief_complaint data)
                } else {
                    //if schedule_patient_chief_complaint insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule_patient_chief_complaint insertion!";
                    return $returnedObj;
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

    public function scheduleTreatmentHistory($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id = $row->patient_id;
                $product_id = $row->product_id;
                $schedule_id = $row->schedule_id;
                //start clearing all existing data relating to input data

                //delete existing schedule_treatment_histories data which is the same as input data
                DB::table('schedule_treatment_histories')
                    ->where('patient_id', '=', $patient_id)
                    ->where('product_id', '=', $product_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_treatment_histories object
                $paramObj = new ScheduleTreatmentHistory();

                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->product_id                   = $row->product_id;
                $paramObj->other_product                = $row->other_product;
                $paramObj->total_dosage                 = $row->total_dosage;
                $paramObj->frequency                    = $row->frequency;
                $paramObj->days                         = $row->days;
                $paramObj->remark                       = $row->remark;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->sold_dosage                  = $row->sold_dosage;
                $paramObj->unsold_dosage                = $row->unsold_dosage;
                $paramObj->time                         = $row->time;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = $row->created_at;
                $paramObj->updated_at                   = $row->updated_at;
                $paramObj->deleted_at                   = $row->deleted_at;

                //saving schedule_treatment_histories obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_treatment_histories insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if schedule_treatment_histories insertion was successful, continue to child objects and do next loop
                    continue;       //continue to next loop(i.e. next row of schedule_treatment_histories data)
                } else {
                    //if schedule_treatment_histories insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule_treatment_histories insertion!";
                    return $returnedObj;
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

    public function scheduleProvisionalDiagnosis($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row) {
                $patient_id     = $row->patient_id;
                $provisional_id = $row->provisional_id;
                $schedule_id    = $row->schedule_id;
                //start clearing all existing data relating to input data

                //delete existing schedule_provisional_diagnosis data which is the same as input data
                DB::table('schedule_provisional_diagnosis')
                    ->where('patient_id', '=', $patient_id)
                    ->where('provisional_id', '=', $provisional_id)
                    ->where('schedule_id', '=', $schedule_id)
                    ->delete();
                //end clearing all existing data relating to input data

                //creating schedule_provisional_diagnosis object
                $paramObj = new Scheduleprovisionaldiagnosis();

                $paramObj->patient_id                   = $row->patient_id;
                $paramObj->provisional_id               = $row->provisional_id;
                $paramObj->schedule_id                  = $row->schedule_id;
                $paramObj->remark                       = $row->remark;
                $paramObj->created_by                   = $row->created_by;
                $paramObj->updated_by                   = $row->updated_by;
                $paramObj->deleted_by                   = $row->deleted_by;
                $paramObj->created_at                   = $row->created_at;
                $paramObj->updated_at                   = $row->updated_at;
                $paramObj->deleted_at                   = $row->deleted_at;

                //saving schedule_provisional_diagnosis obj
                $result = $this->createSingleRow($paramObj);

                //check whether schedule_provisional_diagnosis insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if schedule_provisional_diagnosis insertion was successful, continue to child objects and do next loop
                    continue;       //continue to next loop(i.e. next row of schedule_provisional_diagnosis data)
                } else {
                    //if schedule_provisional_diagnosis insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = "Error in schedule_provisional_diagnosis insertion!";
                    return $returnedObj;
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

    public function getScheduleDetailData($schedule_id)
    {
        $tempObj = DB::select("SELECT * FROM schedule_detail WHERE schedule_id = '$schedule_id'");
        return $tempObj;
    }
}