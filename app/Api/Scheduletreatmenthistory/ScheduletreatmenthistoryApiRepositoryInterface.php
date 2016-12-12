<?php
namespace App\Api\Scheduletreatmenthistory;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 5/10/2016
 * Time: 03:02 PM
 */
interface ScheduletreatmenthistoryApiRepositoryInterface
{
    public function getObjByIds($patient_id, $schedule_id);
    public function create($paramObj);
    public function update($paramObj);
    public function delete($patient_id,$schedule_id);
}