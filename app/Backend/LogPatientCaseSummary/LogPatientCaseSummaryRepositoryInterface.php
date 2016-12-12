<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 9/19/2016
 * Time: 10:02 PM
 */

namespace App\Backend\LogPatientCaseSummary;


interface LogPatientCaseSummaryRepositoryInterface
{
    public function getLogPatientCaseSummaryObj();
    public function getPatientID();
    public function getLogObj($id);
}