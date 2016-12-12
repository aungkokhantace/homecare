<?php

namespace App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance1;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiotherapyNeuroFunctionalPerformance1 extends Model
{
    protected $table = "patient_physiotherapy_neuro_functional_performance1";

    protected $fillable = [
        'patient_id',
        'rolling_i',
        'rolling_s',
        'rolling_min',
        'rolling_mod',
        'rolling_max',
        'rolling_u',
        'rolling_nt',
        'supine_lying_sitting_i',
        'supine_lying_sitting_s',
        'supine_lying_sitting_min',
        'supine_lying_sitting_mod',
        'supine_lying_sitting_max',
        'supine_lying_sitting_u',
        'supine_lying_sitting_nt',
        'transfer_bed_chair_i',
        'transfer_bed_chair_s',
        'transfer_bed_chair_min',
        'transfer_bed_chair_mod',
        'transfer_bed_chair_max',
        'transfer_bed_chair_u',
        'transfer_bed_chair_nt',
        'sit_stand_i',
        'sit_stand_s',
        'sit_stand_min',
        'sit_stand_mod',
        'sit_stand_max',
        'sit_stand_u',
        'sit_stand_nt',
        'ambulation_i',
        'ambulation_s',
        'ambulation_min',
        'ambulation_mod',
        'ambulation_max',
        'ambulation_u',
        'ambulation_nt',
        'rolling_comment',
        'spine_lying_sitting_comment',
        'transfer_bed_chair_comment',
        'sit_stand_comment',
        'ambulation_comment',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'

    ];
}
