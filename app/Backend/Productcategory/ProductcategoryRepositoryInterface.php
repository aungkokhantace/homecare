<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/21/2016
 * Time: 2:56 PM
 */

namespace App\Backend\Productcategory;


interface ProductcategoryRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function checkToDelete($id);
}