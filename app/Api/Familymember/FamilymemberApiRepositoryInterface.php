<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/21/2016
 * Time: 3:19 PM
 */
namespace App\Api\Familymember;

interface FamilymemberApiRepositoryInterface
{
    public function getObjById($familyMemberId);
    public function create($paramObj);
    public function update($paramObj);
}