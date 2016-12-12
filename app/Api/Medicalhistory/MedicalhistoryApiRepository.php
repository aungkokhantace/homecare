<?php
namespace App\Api\Medicalhistory;
use App\Backend\Medicalhistory\Medicalhistory;
use App\Core\ReturnMessage;
use App\Core\Utility;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 3:06 PM
 */
class MedicalhistoryApiRepository implements MedicalhistoryApiRepositoryInterface
{
    public function getObjById($medicalHistoryId)
    {
        $medicalHistory     = Medicalhistory::find($medicalHistoryId);

        return $medicalHistory;
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
}