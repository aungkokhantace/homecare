<?php

namespace App\Backend\PatientPhysiothreapyMusculo3Standing;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiothreapyMusculo3Standing extends Model
{
    protected $table = "patient_physiotherapy_musculo_3_standing";

    protected $fillable = [
        'patient_id',
        'joint',
        'flexion_normal',
        'flexion_minimum',
        'flexion_moderate',
        'flexion_maximum',
        'extension_normal',
        'extension_minimum',
        'extension_moderate',
        'extension_maximum',
        'abduction_normal',
        'abduction_minimum',
        'abduction_moderate',
        'abduction_maximum',
        'adduction_normal',
        'adduction_minimum',
        'adduction_moderate',
        'adduction_maximum',
        'medical_rotation_normal',
        'medical_rotation_minimum',
        'medical_rotation_moderate',
        'medical_rotation_maximum',
        'lateral_rotation_normal',
        'lateral_rotation_minimum',
        'lateral_rotation_moderate',
        'lateral_rotation_maximum',
        'side_flexion_normal',
        'side_flexion_minimum',
        'side_flexion_moderate',
        'side_flexion_maximum',
        'rotation_to_right_normal',
        'rotation_to_right_minimum',
        'rotation_to_right_moderate',
        'rotation_to_right_maximum',
        'rotation_to_left_normal',
        'rotation_to_left_minimum',
        'rotation_to_left_moderate',
        'rotation_to_left_maximum',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
