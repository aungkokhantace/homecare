<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:16 AM
 */

namespace App\Backend\Familymember;

interface FamilymemberRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function getArrays();
    public function getArraysByType($type);
    public function getArraysByOrder();
}