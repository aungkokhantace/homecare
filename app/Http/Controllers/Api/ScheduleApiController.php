<?php

namespace App\Http\Controllers\Api;

use App\Api\Schedule\ScheduleApiRepository;
use App\Api\Schedule\ScheduleApiRepositoryInterface;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Backend\Schedule\Schedule;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/10/2016
 * Time: 11:20 AM
 */
class ScheduleApiController extends Controller
{
    public function __construct(ScheduleApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function down()
    {
        $inputAll                   = Input::All();
        $checkServerStatusArray     = Check::checkSiteActivationCode($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $scheduleApiRepo            = new ScheduleApiRepository();
            if (array_key_exists("status",$inputAll)){
                $status                 = strtolower($inputAll['status']);
                $rawSchedules           = $scheduleApiRepo->getArraysWithStatus($status);
            }
            else{
                $rawSchedules           = $scheduleApiRepo->getArrays();
            }

            $rawIdArr               = array();
            foreach($rawSchedules as $raw){
                array_push($rawIdArr,$raw->id);
            }

            $scheduleDetail         = $scheduleApiRepo->getScheduleDetailWithPara($rawIdArr);

            if(isset($rawSchedules) && count($rawSchedules)>0){

                foreach ($rawSchedules as $rawKey=>$rawValue) {

                    $tempArray  = array();

                    foreach($scheduleDetail as $detail){

                        if($detail->schedule_id == $rawValue->id){

                            array_push($tempArray,$detail);
                        }
                    }

                    $rawSchedules[$rawKey]->schedule_detail = $tempArray;
                }

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['data']                    = $rawSchedules;
                return \Response::json($returnedObj);
            }

            $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage']    = "There is no schedule to down!";
            $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
            $returnedObj['data']                    = "";
            return \Response::json($returnedObj);
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

    public function upload(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $result = $this->repo->createMultipleRows($checkServerStatusArray['data'],$checkServerStatusArray['tablet_id']);

            if($result['aceplusStatusCode'] == ReturnMessage::OK){
                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] ="SUCCESS";
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
