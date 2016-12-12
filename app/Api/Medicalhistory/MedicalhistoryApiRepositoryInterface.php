<?php
namespace App\Api\Medicalhistory;
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 3:05 PM
 */
interface MedicalhistoryApiRepositoryInterface
{
    public function getObjById($medicalHistoryId);
    public function create($paramObj);
    public function update($paramObj);
}