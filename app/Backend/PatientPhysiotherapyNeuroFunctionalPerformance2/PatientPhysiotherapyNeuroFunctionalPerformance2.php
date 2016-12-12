<?php

namespace App\Backend\PatientPhysiotherapyNeuroFunctionalPerformance2;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiotherapyNeuroFunctionalPerformance2 extends Model
{
    protected $table = "patient_physiotherapy_neuro_functional_performance2";

    protected $fillable = [
        'patient_id',
        'walking_aid',
        'ws',
        'qs',
        'wf',
        'handroid',
        'reciprocal_yes',
        'reciprocal_no',
        'rail_nil',
        'rail_1',
        'rail_2',
        'writing_i',
        'writing_s',
        'writing_min',
        'writing_mod',
        'writing_max',
        'writing_u',
        'writing_nt',
        'writing_comment',
        'holding_i',
        'holding_s',
        'holding_min',
        'holding_mod',
        'holding_max',
        'holding_u',
        'holding_nt',
        'holding_comment',
        'picking_up_i',
        'picing_up_s',
        'picking_up_min',
        'picking_up_mod',
        'picking_up_max',
        'picking_up_u',
        'picking_up_nt',
        'picking_up_comment',
        'reaching_i',
        'reaching_s',
        'reaching_min',
        'reaching_mod',
        'reaching_max',
        'reaching_u',
        'reaching_nt',
        'reaching_comment',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'

    ];
}
