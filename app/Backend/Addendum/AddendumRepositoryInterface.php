<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:39 AM
 */

namespace App\Backend\Addendum;

interface AddendumRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function checkToDelete($id);
    public function getObjsByPatientID($patient_id);
}
