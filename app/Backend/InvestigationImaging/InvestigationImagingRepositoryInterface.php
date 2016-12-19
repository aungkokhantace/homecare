<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/25/2016
 * Time: 5:28 PM
 */

namespace App\Backend\InvestigationImaging;


interface InvestigationImagingRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj,$old_price);
    public function getObjByID($id);
    public function delete($id);
}