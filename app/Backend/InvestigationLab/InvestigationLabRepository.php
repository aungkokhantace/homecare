<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/25/2016
 * Time: 5:28 PM
 */

namespace App\Backend\InvestigationLab;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
class InvestigationLabRepository implements InvestigationLabRepositoryInterface
{
    public function getObjs()
    {
        $objs = InvestigationLab::all();
        return $objs;
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

    public function update($paramObj,$old_price)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            if($tempObj->price !== $old_price){
                //save price tracking
                //parameters ($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at)
                Utility::savePriceTracking('investigation_labs',$tempObj->id,'integer','update',$old_price,$tempObj->price,$currentUser,$tempObj->updated_at);
            }

            //update info log
            $date = $tempObj->updated_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated investigation_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated investigation_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $tempObj = InvestigationLab::find($id);
        $tempObj = Utility::addDeletedBy($tempObj);
        $tempObj->deleted_at = date('Y-m-d H:m:i');
        $tempObj->save();
    }

    public function getObjByID($id){
        $role = InvestigationLab::find($id);
        return $role;
    }
}
