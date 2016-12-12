<?php

namespace App\Backend\PatientPhysiothreapyMusculo1and2;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiothreapyMusculo1and2 extends Model
{
    protected $table = "patient_physiothreapy_musculo_1_and_2";

    protected $fillable = [
        'cheif_comlaint_sensation_others',
        'chief_complaint_aggravating_factors',
        'chief_complaint_alternating_factors',
        'chief_complaint_constant',
        'chief_complaint_dull_ache',
        'chief_complaint_duration',
        'chief_complaint_giving_way',
        'chief_complaint_intermittent',
        'chief_complaint_locking',
        'chief_complaint_night_pain',
        'chief_complaint_numbness',
        'chief_complaint_onset',
        'chief_complaint_others',
        'chief_complaint_pain_grade',
        'chief_complaint_pin_and_needles',
        'chief_complaint_popping',
        'chief_complaint_sharp',
        'chief_complaint_site_and_spread_of_pain',
        'chief_complaint_thorbbing',
        'chief_complaint_tingling',
        'created_at',
        'created_by',
        'deleted_at',
        'deleted_by',
        'diagnosis',
        'observation_deformity',
        'observation_gait',
        'observation_heat',
        'observation_loss_of_function',
        'observation_muscule_spasm',
        'observation_posture',
        'observation_swelling',
        'observation_tendemess',
        'patients_id',
        'previous_medical_history',
        'referred_by',
        'updated_at',
        'updated_by'
    ];
}
