<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:06 PM
 */

namespace App\Backend\Patientmedicalhistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;

class PatientmedicalhistoryRepository implements PatientmedicalhistoryRepositoryInterface
{
    public function getObjs()
    {
        $objs = Patientmedicalhistory::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Patientmedicalhistory())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            $patientId          = $paramObj->patient_id;
            $medical_history_id = $paramObj->medical_history_id;

            $tbName = (new Patientmedicalhistory())->getTable();

            $existArr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL AND patient_id = '$patientId' AND medical_history_id = '$medical_history_id'");

            if(isset($existArr) && count($existArr)>0) {

                $returnedObj['aceplusStatusCode'] = ReturnMessage::NOT_IMPLEMENTED;
                $returnedObj['aceplusStatusMessage'] = "Existing Medical History for this patient !";
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
            $medical_history_id = $paramObj->medical_history_id;
            $date = $paramObj->date;

            $updateUserId = Utility::getCurrentLoginUserId();
            $updateDate = date('Y-m-d H:m:i');
            $result = Patientmedicalhistory::where('patient_id', $patient_id)
                ->where('medical_history_id', $medical_history_id)
                ->update(['date'=> $date, 'updated_by' => $updateUserId,'updated_at' => $updateDate]);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $tempObj = Patientmedicalhistory::find($id);
        $tempObj = Utility::addDeletedBy($tempObj);
        $tempObj->deleted_at = date('Y-m-d H:m:i');
        $tempObj->save();
    }

    public function deleteByParam($patient_id,$medical_history_id)
    {
        $updateUserId = Utility::getCurrentLoginUserId();
        $deleteDate = date('Y-m-d H:m:i');
        $result = Patientmedicalhistory::where('patient_id', $patient_id)
                    ->where('medical_history_id', $medical_history_id)
                    ->update(['deleted_by' => $updateUserId,'deleted_at' => $deleteDate]);
    }

    public function getObjByID($id){
        $role = Patientmedicalhistory::find($id);
        return $role;
    }

    public function getObjByParam($patient_id,$medical_history_id){
        $result = Patientmedicalhistory::where('patient_id', $patient_id)
                    ->where('medical_history_id', $medical_history_id)
                    ->first();
        return $result;
    }

    public function getObjByPatientID($id)
    {
        $tbName = (new Patientmedicalhistory())->getTable();
        $result = DB::table($tbName)->whereNull('deleted_at')->where('patient_id', '=', $id)->get();
        return $result;
    }

    public function getArraysByType($type)
    {
        $tbName = (new Patientmedicalhistory())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE type = '$type' AND deleted_at IS NULL");
        return $arr;
    }

}