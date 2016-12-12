<?php
namespace App\Api\Scheduletracking;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 6/10/2016
 * Time: 01:20 PM
 */
class ScheduletrackingApiRepository implements ScheduletrackingApiRepositoryInterface
{
    public function getObjByIds($id, $schedule_id, $enquiry_id)
    {
        $result     = Scheduletracking::
                        where('id',$id)
                        ->where('schedule_id', $schedule_id)
                        ->where('enquiry_id', $enquiry_id)
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

    public function createMultipleRows($data,$tablet_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        DB::beginTransaction();
        foreach($data as $row){
            $id                          = $row->id;
            $schedule_id                 = $row->schedule_id;
            $enquiry_id                  = $row->enquiry_id;

            $status                     = $this->delete($schedule_id, $enquiry_id);
            if($status['aceplusStatusCode'] == ReturnMessage::OK){
                $paramObj                           = new Scheduletracking();
                $paramObj->id                       = $row->id;
                $paramObj->preparation_start_time   = $row->preparation_start_time;
                $paramObj->preparation_end_time     = $row->preparation_end_time;
                $paramObj->schedule_id              = $row->schedule_id;
                $paramObj->enquiry_id               = $row->enquiry_id;
                $paramObj->arrived_to_patient_time  = $row->arrived_to_patient_time;
                $paramObj->leave_from_patient_time  = $row->leave_from_patient_time;
                $paramObj->created_by               = $row->created_by;
                $paramObj->updated_by               = $row->updated_by;
                $paramObj->deleted_by               = $row->deleted_by;
                $paramObj->created_at               = $row->created_at;
                $paramObj->updated_at               = $row->updated_at;
                $paramObj->deleted_at               = $row->deleted_at;

                $result = $this->create($paramObj);

                if($result['aceplusStatusCode'] == ReturnMessage::OK){
                    continue;
                }
                else{
                    DB::rollBack();
                    return $returnedObj;
                }
            }
            else{
                DB::rollBack();
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = "Request Fail !";
                $returnedObj['tabletId']                = $tablet_id;

                return \Response::json($returnedObj);
            }
        }

        DB::commit();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
        return $returnedObj;
    }
    
    public function delete($schedule_id, $enquiry_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try {
            DB::delete("DELETE FROM schedule_trackings WHERE schedule_id = '$schedule_id' AND enquiry_id = '$enquiry_id'");
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

}