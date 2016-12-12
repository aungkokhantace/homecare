<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/13/2016
 * Time: 5:18 PM
 */

namespace App\Api\Familyhistory;


interface FamilyhistoryApiV2RepositoryInterface
{
    public function createFamilyHistories($data);
    public function getFamilyHistoryArray();
}