<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/21/2016
 * Time: 5:33 PM
 */

namespace App\Backend\Cartypesetup;

interface CartypesetupRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj,$old_price);
    public function getObjByID($id);
    public function delete($id);
    public function getCarType($car_type_setup_id);
}
