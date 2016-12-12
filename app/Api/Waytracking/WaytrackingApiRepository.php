<?php
namespace App\Api\Waytracking;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\Waytracking\Waytracking;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 11/10/2016
 * Time: 01:20 PM
 */
class WaytrackingApiRepository implements WaytrackingApiRepositoryInterface
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
            $paramObj->save();
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
        try{
            $tempLogArr     = array();

            foreach($data as $row){
                $id                          = $row->id;
                $user_id                     = $row->user_id;

                //Check update or create for log date
                $findObj    = Waytracking::find($id);

                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                DB::table('way_tracking')->where('id','=',$id)->where('user_id','=',$user_id)->delete();

                $paramObj                           = new Waytracking();
                $paramObj->id                       = $row->id;
                $paramObj->user_id                  = $row->user_id;
                $paramObj->date                     = $row->date;
                $paramObj->departure_time           = $row->departure_time;
                $paramObj->arrival_time             = $row->arrival_time;
                $paramObj->created_by               = $row->created_by;
                $paramObj->updated_by               = $row->updated_by;
                $paramObj->deleted_by               = $row->deleted_by;
                $paramObj->created_at               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->create($paramObj);

                if($result['aceplusStatusCode'] == ReturnMessage::OK){
                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' way_tracking_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);

                    continue;
                }
                else{
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            $returnedObj['data'] ="SUCCESS";

            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }

    }
}