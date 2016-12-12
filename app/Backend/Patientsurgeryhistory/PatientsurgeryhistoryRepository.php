<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/29/2016
 * Time: 2:50 PM
 */

namespace App\Backend\Patientsurgeryhistory;

use App\Backend\Allergy\Allergy;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Service\ServiceRepository;
use App\Backend\Zone\ZoneRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Patientsurgeryhistory\Patientsurgeryhistory;
//use Illuminate\Console\Scheduling\Schedule;

class PatientsurgeryhistoryRepository implements PatientsurgeryhistoryRepositoryInterface
{
    public function getObjs()
    {
        $objs = Patientsurgeryhistory::whereNull('deleted_at')->get();
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

    public function delete($id)
    {
        //find and delete patient obj
        $tempObj = Patientsurgeryhistory::find($id);
        $tempObj = Utility::addDeletedBy($tempObj);
        $tempObj->deleted_at = date('Y-m-d H:m:i');
        $tempObj->save();
    }

    public function getObjByPatientID($id)
    {
        $result = DB::table('patient_surgery_history')->whereNull('deleted_at')->where('patient_id', '=', $id)->get();
        return $result;
    }

    public function getArrays()
    {
        $tempObj = DB::select("SELECT * FROM patients WHERE deleted_at is null");
        return $tempObj;
    }

    public function getObjByID($id){
        $role = Patientsurgeryhistory::find($id);
        return $role;
    }
}