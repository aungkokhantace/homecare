<?php

namespace App\Backend\PatientPhysiotherapyNeuroGeneral;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiotherapyNeuroGeneral extends Model
{
    protected $table = "patient_physiotherapy_neuro_general";

    protected $fillable = [
        'patient_id',
        'diagnosis',
        'relevant',
        'history',
        'pre_mobid_status_community',
        'pre_mobid_status_home_bound',
        'pre_mobid_status_wheel_chair_bound',
        'pre_mobid_status_bed_bound',
        'smoking_history_start',
        'smoking_history_stop',
        'mental_status',
        'vision',
        'hearing',
        'speech_swallowing',
        'orientation_time',
        'orientation_place',
        'orientation_person',
        'obey_ommands',
        'follow_gestures',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
