<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:02 PM
 */

namespace App\Backend\Schedulephysicalexamsgeneralpupilshead;

use Illuminate\Database\Eloquent\Model;

class Schedulephysicalexamsgeneralpupilshead extends Model
{
    protected $table = 'schedule_physical_exams_general_pupils_head';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'patient_id',
        'schedule_id',
        'alert',
        'unconscious',
        'semiconscious',
        'drowsy',
        'general_remark',
        'pupils_normal',
        'pupils_abnormal',
        'pupils_left_pinpoint_pupil',
        'pupils_left_reactive',
        'pupils_left_not_reactive',
        'pupils_right_pinpoint_pupil',
        'pupils_right_reactive',
        'pupils_right_not_reactive',
        'pupils_remark',
        'head_normal',
        'head_abnormal',
        'head_JVD',
        'head_Goiter',
        'head_Lympha',
        'head_remark','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];

}
