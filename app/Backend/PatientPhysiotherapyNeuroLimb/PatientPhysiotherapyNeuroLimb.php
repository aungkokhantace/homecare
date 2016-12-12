<?php

namespace App\Backend\PatientPhysiotherapyNeuroLimb;

use Illuminate\Database\Eloquent\Model;

class PatientPhysiotherapyNeuroLimb extends Model
{
    protected $table = "patient_physiotherapy_neuro_limb";

    protected $fillable = [
        'patients_id',
        'shoulder_flexor_right',
        'shoulder_flexor_left',
        'shoulder_extensor_left',
        'shoulder_extensor_right',
        'shoulder_abductor_left',
        'shoulder_abductor_right',
        'elbow_flexor_left',
        'elbow_flexor_right',
        'elbow_extensor_left',
        'elbow_extensor_right',
        'gripping_left',
        'gripping_right',
        'hip_flexor_left',
        'hip_flexor_right',
        'hip_extensor_left',
        'hip_extensor_right',
        'hip_abductor_left',
        'hip_abductor_right',
        'knee_flexion_left',
        'knee_flexion_right',
        'knee_extension_left',
        'knee_extension_right',
        'ankle_dorsiflexion_left',
        'ankle_dorsiflexion_right',
        'ankle_plantarflexion_left',
        'ankle_plantarflexion_right',
        'rom',
        'tone',
        'sensation',
        'joint_position_sense',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
