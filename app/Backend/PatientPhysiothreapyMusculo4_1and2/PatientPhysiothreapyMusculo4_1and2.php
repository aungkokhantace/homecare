<?php

namespace App\Backend\PatientPhysiothreapyMusculo4_1and2;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiothreapyMusculo4_1and2 extends Model
{
    protected $table = "patient_physiotherapy_musculo_4_1and2";

    protected $fillable = [
        'patient_id',
        'slr_plus',
        'slr_minus',
        'ehl_plus',
        'ehl_minus',
        'femoral_nerve_plus',
        'femoral_nerve_minus',
        'empty_can_test_plus',
        'empty_can_test_minus',
        'neer_test_plus',
        'neer_test_minus',
        'hawkin_test_plus',
        'hawkin_test_minus',
        'gerber_life_off_test_plus',
        'gerber_life_off_test_minus',
        'drop_arm_test_plus',
        'drop_arm_test_minus',
        'crank_test_plus',
        'crank_test_minus',
        'apprehension_test_plus',
        'apprehension_test_minus',
        'yergason_test_plus',
        'yergason_test_minus',
        'anterior_drawer_test_plus',
        'anterior_drawer_test_minus',
        'posterior_drawer_test_plus',
        'posterior_drawer_test_minus',
        'varus_stress_test_plus',
        'varus_stress_test_minus',
        'valgus_stress_test_plus',
        'valgus_stress_test_minus',
        'mc_murray_test_plus',
        'mc_murray_test_minus',
        'flexion',
        'extension',
        'abduction',
        'adduction',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
