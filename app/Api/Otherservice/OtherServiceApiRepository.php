<?php
namespace App\Api\Otherservice;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/18/2016
 * Time: 2:59 PM
 */
class OtherServiceApiRepository implements OtherServiceApiRepositoryInterface
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

    public function otherservice($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr     = array();
            foreach($data as $row){
                $id             = $row->id;
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //Check update or create for log date
                $findObj    = OtherService::where('patient_id','=',$row->patient_id)
                                        ->where('schedule_id',$schedule_id)
                                        ->get();

                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in products relating to input
                DB::table('other_services')
                    ->where('id','=',$id)
                    ->where('patient_id','=',$patient_id)
                    ->where('schedule_id','=',$schedule_id)
                    ->delete();

                //creating other service object
                $paramObj = new OtherService();

                $paramObj->id 								        = $row->id;
                $paramObj->patient_id 								= $row->patient_id;
                $paramObj->schedule_id 								= $row->schedule_id;

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
                    $tempArr['message'] = $create.' other service for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);

                    //start insertion of other_service_detail
                    if (isset($row->other_services_detail) && count($row->other_services_detail) > 0) {
                        foreach($row->other_services_detail as $detail){
                            DB::table('other_services_detail')->insert([
                                [
                                    'other_services_id' => $detail->other_services_id,
                                    'name' => $detail->name,
                                    'price' => $detail->price,
                                    'remark' => $detail->remark
                                ]
                            ]);
                        }
                    }
                    //end insertion of other_service_detail

                    continue; //continue to next loop(next row of input other service)
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
}