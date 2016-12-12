<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 5:32 PM
 */

namespace App\Backend\Test;


interface TestRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
}