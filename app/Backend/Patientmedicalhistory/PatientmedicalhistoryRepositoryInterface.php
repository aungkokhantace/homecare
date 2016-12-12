<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:08 PM
 */

namespace App\Backend\Patientmedicalhistory;

interface PatientmedicalhistoryRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function updateByParam($paramObj);
    public function getObjByID($id);
    public function getObjByParam($patient_id,$medical_history_id);
    public function getObjByPatientID($id);
    public function delete($id);
    public function deleteByParam($patient_id,$medical_history_id);
    public function getArrays();
    public function getArraysByType($type);
}
