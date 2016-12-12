<?php
namespace App\Api\Scheduletracking;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 5/10/2016
 * Time: 03:02 PM
 */
interface ScheduletrackingApiRepositoryInterface
{
    public function getObjByIds($id, $schedule_id, $enquiry_id);
    public function create($paramObj);
    public function delete($schedule_id, $enquiry_id);
    public function createMultipleRows($data,$tablet_id);
}