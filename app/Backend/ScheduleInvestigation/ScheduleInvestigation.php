<?php

namespace App\Backend\ScheduleInvestigation;

use Illuminate\Database\Eloquent\Model;

class ScheduleInvestigation extends Model
{
    protected $table = "schedule_investigations";

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'investigation_id',
        'investigation_lab_remark',
        'investigation_imaging_xray_id',
        'investigation_imaging_usg_id',
        'investigation_imaging_ct_id',
        'investigation_imaging_mri_id',
        'investigation_imaging_other_id',
        'investigation_imaging_remark',
        'investigation_ecg_remark',
        'investigation_other_remark',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function investigation()
    {
        return $this->belongsTo('App\Backend\Investigation\Investigation','product_id','id');
    }
}
