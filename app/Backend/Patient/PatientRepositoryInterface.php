<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/26/2016
 * Time: 4:51 PM
 */

namespace App\Backend\Patient;


interface PatientRepositoryInterface
{
    public function getObjs();
    public function create($flag,$userObj,$paramObj,$childArray,$logObj);
    public function update($userObj,$paramObj,$childArray,$logObj);
    public function getObjByID($id);
    public function delete($id,$logObj);
    public function getPatientWithUser();
    public function getZoneId($patient_id);
    public function getTownshipId($patient_id);
    public function getArrays();
    public function getPatientSchedule($id);
}