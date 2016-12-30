<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:39 AM
 */

namespace App\Backend\Township;

interface TownshipRepositoryInterface
{
    public function getObjs();
    public function getArrays();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function getTownshipsForZone($paramArray);
    public function getArraysUnusedTownships($paramArray);
    public function checkToDelete($id);
}
