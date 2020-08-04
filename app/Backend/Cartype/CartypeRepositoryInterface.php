<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:07 PM
 */
namespace App\Backend\Cartype;

interface CartypeRepositoryInterface
{
    public function getObjs();
    public function getArrays();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function getArraysByOrder();
    public function getCarTypeName($car_type_id);
    public function checkToDelete($id);
}
