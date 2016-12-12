<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/12/2016
 * Time: 4:42 PM
 */

namespace App\Backend\Provisionaldiagnosis;


interface ProvisionaldiagnosisRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function getArrays();
    public function getArrayById($id);
}