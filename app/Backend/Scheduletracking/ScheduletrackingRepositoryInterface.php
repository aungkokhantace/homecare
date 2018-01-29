<?php
/**
 * Author: Aung Ko Khant
 * Date: 2018-01-25
 * Time: 03:36 PM
 */

namespace App\Backend\Scheduletracking;

interface ScheduleTrackingRepositoryInterface
{
  public function getscheduleTrackings($type,$from_date,$to_date);
  public function getObjByID($id);
}
