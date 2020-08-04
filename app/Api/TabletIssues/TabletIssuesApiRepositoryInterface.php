<?php
namespace App\Api\TabletIssues;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 5/10/2016
 * Time: 03:02 PM
 */
interface TabletIssuesApiRepositoryInterface
{
    public function create($paramObj);
    public function createMultipleRows($data,$tablet_id,$user_id);
}