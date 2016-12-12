<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 10:03 AM
 */

namespace App\Backend\Product;


interface ProductRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj,$old_price);
    public function getObjByID($id);
    public function delete($id);
}