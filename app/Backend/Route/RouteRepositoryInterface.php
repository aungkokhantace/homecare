<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/6/2016
 * Time: 5:47 PM
 */

namespace App\Backend\Route;


interface RouteRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
}