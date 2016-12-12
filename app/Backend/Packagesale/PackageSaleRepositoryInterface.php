<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/11/2016
 * Time: 10:52 AM
 */

namespace App\Backend\Packagesale;

interface PackageSaleRepositoryInterface
{
    public function getArrays();
    public function getObjs();
    public function create($paramObj, $invoiceObj);
    public function getObjByID($id);
    public function createSchedule($id);
    public function getObjByPatientId($id);
    public function getDetails($patient_package_id);
}