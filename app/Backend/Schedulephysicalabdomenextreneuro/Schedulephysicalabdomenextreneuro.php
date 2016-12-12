<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: October 13,2016
 * Time: 3:45 PM
 */

namespace App\Backend\Schedulephysicalabdomenextreneuro;

use Illuminate\Database\Eloquent\Model;

class Schedulephysicalabdomenextreneuro extends Model
{
    protected $table = 'schedule_physical_exams_abdomen_extre_neuro';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'patient_id',
        'schedule_id',
        'abdomen_normal',
        'abdomen_abnormal',
        'abdomen_tenderness',
        'abdomen_distension',
        'abdomen_mass',
        'abdomen_hernia',
        'abdomen_bowel_sound',
        'abdomen_remark',
        'extre_normal',
        'extre_abnormal',
        'extre_edema',
        'extre_varicose',
        'extre_ulcer',
        'extre_gangrene',
        'extre_calf_tenderness',
        'extre_ampulation',
        'extre_remark',
        'neuro_normal',
        'neuro_abnormal',
        'neuro_motor_weakness',
        'neuro_sensory_loss',
        'neuro_abnormal_movement',
        'neuro_remark',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
