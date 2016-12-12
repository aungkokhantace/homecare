<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: October 13,2016
 * Time: 3:45 PM
 */

namespace App\Backend\Schedulephysicalexamsheartlungs;

use Illuminate\Database\Eloquent\Model;

class Schedulephysicalexamsheartlungs extends Model
{
    protected $table = 'schedule_physical_exams_heart_lungs';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'patient_id',
        'schedule_id',
        'date',
        'time',
        'blood_pressure_sbp',
        'blood_pressure_dbp',
        'blood_pressure_map',
        'spo2',
        'pulse_rate',
        'body_temperature_farenheit',
        'body_temperature_celsius',
        'weight_pound',
        'weight_kg',
        'height_feet',
        'height_inches',
        'height_cm',
        'blood_sugar',
        'spo2_comment',
        'pulse_rate_comment',
        'blood_sugar_comment',
        'bmi',
        'remark','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];
}
