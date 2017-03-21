<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 4:14 PM
 */

namespace App\Backend\Package;


interface PackageRepositoryInterface
{
    public function getObjs();
    public function create($paramObj,$childArray);
    public function update($paramObj,$childArray,$old_price);
    public function getObjByID($id);
    public function delete($id);
    public function getPackageByPatientId($id);
    public function getPackagePrice($package);
    public function getScheduleNo($package);
    public function getPackageName($package_id);
    public function getPackageDetails($package_id);
    public function getPromotions($package_id);
    public function getPromotionPrice($package_id, $promotion_order);
}