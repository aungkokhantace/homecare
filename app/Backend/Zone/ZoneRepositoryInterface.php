<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:49 PM
 */

namespace App\Backend\Zone;

interface ZoneRepositoryInterface
{
    public function getObjs();
    public function create($paramObj,$childArray);
    public function update($paramObj,$childArray);
    public function getObjByID($id);
    public function getObjByIDForEdit($id);
    public function delete($id);
    public function getZoneId($townships); //to retrieve zone_id from township_id in patient set-up
    public function getZonePrice($zone_id);
    public function getUsedTownships();
    public function getUsedTownshipsInOtherZones($zone_id);
}
