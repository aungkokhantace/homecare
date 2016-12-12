<?php
namespace App\Api\Scheduletreatmenthistory;
use App\Api\Scheduletreatmenthistory\ScheduletreatmenthistoryApiRepositoryInterface;
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
 * Date: 05/10/2016
 * Time: 11:20 AM
 */
class ScheduletreatmenthistoryApiRepository implements ScheduletreatmenthistoryApiRepositoryInterface
{
    public function getObjByIds($patient_id, $schedule_id)
    {
        $result     = ScheduleTreatmentHistory::
                                where('patient_id', $patient_id)
                                ->where('schedule_id', $schedule_id)
                                ->get();
        return $result;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($patient_id,$schedule_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try {
            DB::delete("DELETE FROM schedule_treatment_histories WHERE patient_id = '$patient_id' AND schedule_id = '$schedule_id'");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

}