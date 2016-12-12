<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:17 AM
 */

namespace App\Backend\Patientfamilyhistory;

interface PatientfamilyhistoryRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function updateByParam($paramObj);
    public function getObjByID($id);
    public function getObjByPatientID($id);
    public function getObjByParam($patient_id,$family_history_id,$family_member_id);
    public function delete($id);
    public function deleteByParam($patient_id,$family_history_id,$family_member_id);
    public function getArrays();
    public function getArraysByType($type);
}