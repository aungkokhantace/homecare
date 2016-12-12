<?php

namespace App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance3;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiotherapyNeuroFunctionalPerformance3 extends Model
{
    protected $table = "patient_physiotherapy_neuro_functional_performance3";

    protected $fillable = [
        'patient_id',
        'static_sitting_good',
        'static_sitting_fair',
        'static_sitting_poor',
        'static_sitting_nt',
        'static_sitting_comment',
        'dynamic_sitting_good',
        'dynamic_sitting_fair',
        'dynamic_sitting_poor',
        'dynamic_sitting_nt',
        'dynamic_sitting_comment',
        'static_standing_good',
        'static_standing_fair',
        'static_standing_poor',
        'static_standing_nt',
        'static_standing_comment',
        'dynamic_standing_good',
        'dynamic_standing_fair',
        'dynamic_standing_poor',
        'dynamic_standing_nt',
        'dynamic_standing_comment',
        'activity_tolerance_good',
        'activity_tolerance_fair',
        'activity_tolerance_poor',
        'activity_tolerance_nt',
        'activity_tolerance_comment',
        'short_term_goal',
        'long_term_goal',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'

    ];
}
