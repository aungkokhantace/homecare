<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 5:32 PM
 */

namespace App\Backend\Service;


interface ServiceRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj,$old_price);
    public function getObjByID($id);
    public function delete($id);
    public function getServiceName($id);
}