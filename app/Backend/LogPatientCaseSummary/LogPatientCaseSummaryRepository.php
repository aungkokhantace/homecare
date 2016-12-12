<?php
/**
 * Created by PhpStorm.
 * Author: Soe Thandar Aung
 * Date: 9/19/2016
 * Time: 10:02 PM
 */

namespace App\Backend\LogPatientCaseSummary;
use App\Backend\Patient\Patient;

class LogPatientCaseSummaryRepository implements LogPatientCaseSummaryRepositoryInterface
{
    public function getLogPatientCaseSummaryObj()
    {
        $objs = LogPatientCaseSummary::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getPatientID()
    {
    	$objs = Patient::whereNull('deleted_at')->get();
    	return $objs;
    }

    public function getLogObj($id)
    {
    	$objs = LogPatientCaseSummary::where('patient_id',$id)->get();
    	return $objs;
    }
   
}