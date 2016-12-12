<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/29/2016
 * Time: 2:52 PM
 */

namespace App\Backend\Patientsurgeryhistory;


interface PatientsurgeryhistoryRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByPatientID($id);
    public function getObjByID($id);
    public function delete($id);
    public function getArrays();
}