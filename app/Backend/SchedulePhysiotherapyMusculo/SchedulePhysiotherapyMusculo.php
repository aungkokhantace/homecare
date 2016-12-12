<?php

namespace App\Backend\SchedulePhysiotherapyMusculo;

use Illuminate\Database\Eloquent\Model;

class SchedulePhysiotherapyMusculo extends Model
{
    protected $table = "schedule_physiotherapy_musculo";
    protected $fillable = [
        'id',
        'patient_id',
        'schedules_id',
        'ultrasound',
        'hot_manager',
        'traction',
        'electrical_stimulation',
        'infra_red',
        'laser',
        'exercise_therapy',
        'health_education',
        'others',
        'signature_of_physiotherapist',
        'diagnosis',
        'progress_note',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
