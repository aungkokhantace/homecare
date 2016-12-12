<?php
namespace App\Api\User;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 14/10/2016
 * Time: 02:20 PM
 */
interface UserApiRepositoryInterface
{
    public function getObjByIds($id, $schedule_id, $enquiry_id);
    public function create($paramObj);
    public function createSingleUser($data);
    public function createMultipleRows($data,$tablet_id);
    public function getUserForEnquiry($patient_id);
}