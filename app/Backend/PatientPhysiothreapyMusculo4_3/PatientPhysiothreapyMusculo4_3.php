<?php

namespace App\Backend\PatientPhysiothreapyMusculo4_3;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiothreapyMusculo4_3 extends Model
{
    protected $table = "patient_physiotherapy_musculo_4_3";

    protected $fillable = [
        'patient_id',
        'ms_acting_on_joint',
        'flexors_0',
        'flexors_1',
        'flexors_2',
        'flexors_3',
        'flexors_4',
        'flexors_5',
        'extensors_0',
        'extensors_1',
        'extensors_2',
        'extensors_3',
        'extensors_4',
        'extensors_5',
        'abductors_0',
        'abductors_1',
        'abductors_2',
        'abductors_3',
        'abductors_4',
        'abductors_5',
        'adductors_0',
        'adductors_1',
        'adductors_2',
        'adductors_3',
        'adductors_4',
        'adductors_5',
        'medial_rotators_0',
        'medial_rotators_1',
        'medial_rotators_2',
        'medial_rotators_3',
        'medial_rotators_4',
        'medial_rotators_5',
        'lateral_rotators_0',
        'lateral_rotators_1',
        'lateral_rotators_2',
        'lateral_rotators_3',
        'lateral_rotators_4',
        'lateral_rotators_5',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
