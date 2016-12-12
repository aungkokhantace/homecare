<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/29/2016
 * Time: 5:41 PM
 */
namespace App\Backend\Presentmedication;

class PresentmedicationRepository implements PresentmedicationRepositoryInterface
{
    public function getObjs()
    {
        $objs = Presentmedication::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Presentmedication())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function getPresentMedications($id)
    {
        $result = Presentmedication::
        leftjoin('schedules', 'schedule_treatment_histories.schedule_id', '=', 'schedules.id')
            ->select('schedule_treatment_histories.*')
            ->where('schedules.patient_id','=',$id)
            ->where('schedules.deleted_at','=',null)
            ->get();
        return $result;
    }
}