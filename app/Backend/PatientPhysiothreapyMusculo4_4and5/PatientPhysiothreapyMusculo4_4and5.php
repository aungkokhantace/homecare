<?php

namespace App\Backend\PatientPhysiothreapyMusculo4_4and5;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiothreapyMusculo4_4and5 extends Model
{
    protected $table = "patient_physiotherapy_musculo_4_4and5";
    protected $fillable = [
        'patient_id',
        'muscle_tone',
        'other_investigation',
        'skin_conditions',
        'heart_disease',
        'diabetes',
        'osteoporosis',
        'joint_replacements',
        'pregnancy',
        'pacemaker',
        'stroke',
        'rapid_weight_loss',
        'bowelbladder_problems',
        'malignancy',
        'arthritis',
        'numbness',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
