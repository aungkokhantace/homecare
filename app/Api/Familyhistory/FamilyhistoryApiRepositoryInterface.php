<?php
namespace App\Api\Familyhistory;
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 1:55 PM
 */
interface FamilyhistoryApiRepositoryInterface
{
    public function getObjById($familyHistoryId);
    public function create($paramObj);
    public function update($paramObj);
}