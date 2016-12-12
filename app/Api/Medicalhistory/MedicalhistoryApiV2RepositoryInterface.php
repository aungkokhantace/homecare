<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/13/2016
 * Time: 4:48 PM
 */

namespace App\Api\Medicalhistory;


interface MedicalhistoryApiV2RepositoryInterface
{
    public function createMedicalHistory($data);
    public function getMedicalHistoryArray();
}