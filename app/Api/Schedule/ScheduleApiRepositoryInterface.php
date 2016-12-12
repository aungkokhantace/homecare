<?php
namespace App\Api\Schedule;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/10/2016
 * Time: 11:20 AM
 */
interface ScheduleApiRepositoryInterface
{
    public function getArraysWithStatus($status);
    public function getArrays();
    public function getScheduleDetail();
    public function getScheduleDetailWithPara($rawIdArr);
    public function create($paramObj,$services,$hhcsPersonnels);
    public function update($id,$paramObj,$services,$hhcsPersonnels);
    public function createMultipleRows($data, $tablet_id);

    public function deleteSchedule($id, $enquiry_id, $patient_id);
}