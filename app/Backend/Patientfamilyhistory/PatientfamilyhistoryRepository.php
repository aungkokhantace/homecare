<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/30/2016
 * Time: 10:13 AM
 */


namespace App\Backend\Patientfamilyhistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;

class PatientfamilyhistoryRepository implements PatientfamilyhistoryRepositoryInterface
{
    public function getObjs()
    {
        $objs = Patientfamilyhistory::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Patientfamilyhistory())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            $patientId          = $paramObj->patient_id;
            $family_history_id  = $paramObj->family_history_id;
            $family_member_id   = $paramObj->family_member_id;

            $tbName = (new Patientfamilyhistory())->getTable();
            $existArr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL AND patient_id = '$patientId' AND family_history_id = '$family_history_id' AND family_member_id = '$family_member_id'");

            if(isset($existArr) && count($existArr)>0) {

                $returnedObj['aceplusStatusCode'] = ReturnMessage::NOT_IMPLEMENTED;
                $returnedObj['aceplusStatusMessage'] = "Existing Family History for this patient !";
                return $returnedObj;
            }

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

    public function updateByParam($paramObj){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $patient_id = $paramObj->patient_id;
            $family_history_id = $paramObj->family_history_id;
            $family_member_id = $paramObj->family_member_id;
            $remark = $paramObj->remark;

            $updateUserId = Utility::getCurrentLoginUserId();
            $updateDate = date('Y-m-d H:m:i');
            $result = Patientfamilyhistory::where('patient_id', $patient_id)
                ->where('family_history_id', $family_history_id)
                ->where('family_member_id', $family_member_id)
                ->update(['remark'=> $remark, 'updated_by' => $updateUserId,'updated_at' => $updateDate]);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function getObjByParam($patient_id,$family_history_id,$family_member_id){
        $result = Patientfamilyhistory::where('patient_id', $patient_id)
            ->where('family_history_id', $family_history_id)
            ->where('family_member_id', $family_member_id)
            ->first();
        return $result;
    }

    public function getObjByID($id){
        $role = Patientfamilyhistory::find($id);
        return $role;
    }

    public function getObjByPatientID($id)
    {
        $tbName = (new Patientfamilyhistory())->getTable();
        $result = DB::table($tbName)->whereNull('deleted_at')->where('patient_id', '=', $id)->get();
        return $result;
    }

    public function getArraysByType($type)
    {
        $tbName = (new Patientfamilyhistory())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE type = '$type' AND deleted_at IS NULL");
        return $arr;
    }

    public function delete($id)
    {
        $tempObj = Patientfamilyhistory::find($id);
        $tempObj = Utility::addDeletedBy($tempObj);
        $tempObj->deleted_at = date('Y-m-d H:m:i');
        $tempObj->save();
    }

    public function deleteByParam($patient_id,$family_history_id,$family_member_id)
    {
        $updateUserId = Utility::getCurrentLoginUserId();
        $deleteDate = date('Y-m-d H:m:i');
        $result = Patientfamilyhistory::where('patient_id', $patient_id)
            ->where('family_history_id', $family_history_id)
            ->where('family_member_id', $family_member_id)
            ->update(['deleted_by' => $updateUserId,'deleted_at' => $deleteDate]);
    }

}