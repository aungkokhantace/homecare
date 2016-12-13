<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:42 AM
 */

namespace App\Log\TabletIssues;

interface TabletIssuesRepositoryInterface
{
    public function getTabletIssues($type);
}
