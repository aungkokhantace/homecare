<?php
namespace App\Api\Waytracking;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 5/10/2016
 * Time: 03:02 PM
 */
interface WaytrackingApiRepositoryInterface
{
    public function getObjByIds($id, $schedule_id, $enquiry_id);
    public function create($paramObj);
    public function createMultipleRows($data,$tablet_id);
}