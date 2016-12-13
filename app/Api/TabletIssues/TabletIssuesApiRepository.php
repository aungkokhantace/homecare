<?php
namespace App\Api\TabletIssues;
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
class TabletIssuesApiRepository implements TabletIssuesApiRepositoryInterface
{
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

    public function createMultipleRows($data,$tablet_id,$user_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr     = array();
            foreach($data as $row){
                $tempArr['date'] = $row->date;
                $create = "created";
                $paramObj                           = new TabletIssues();
//                $paramObj->id                       = $row->id;
                $paramObj->user_id                  = $user_id;
                $paramObj->tablet_id                = $tablet_id;
                $paramObj->exception                = $row->exception;
                $paramObj->date                     = $row->date;
                $paramObj->created_by               = (isset($user_id) && $user_id != "") ? $user_id:null;
                $paramObj->updated_by               = (isset($row->updated_by) && $row->updated_by != "") ? $row->updated_by:null;
                $paramObj->deleted_by               = (isset($row->deleted_by) && $row->deleted_by != "") ? $row->deleted_by:null;
                $paramObj->created_at               = (isset($row->date) && $row->date != "") ? $row->date:null;
                $paramObj->updated_at               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->create($paramObj);
                if($result['aceplusStatusCode'] == ReturnMessage::OK){
                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' tablet_error_log_id = '.$paramObj->id;
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