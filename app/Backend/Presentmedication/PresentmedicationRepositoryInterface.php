<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/29/2016
 * Time: 5:40 PM
 */
namespace App\Backend\Presentmedication;


interface PresentmedicationRepositoryInterface
{
    public function getObjs();
    public function getArrays();
    public function getPresentMedications($id);
}