<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/26/2016
 * Time: 10:14 AM
 */

namespace App\Backend\Physicalexam;


interface PhysicalexamRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
}