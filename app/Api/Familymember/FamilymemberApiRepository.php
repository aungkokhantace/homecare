<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/21/2016
 * Time: 3:20 PM
 */
namespace App\Api\Familymember;
use App\Backend\Familymember\Familymember;
use App\Core\ReturnMessage;
use App\Core\Utility;

class FamilymemberApiRepository implements FamilymemberApiRepositoryInterface
{
    public function getObjById($familyMemberId)
    {
        $familyMember  = Familymember::find($familyMemberId);

        return $familyMember;
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