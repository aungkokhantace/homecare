<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: October 13,2016
 * Time: 3:45 PM
 */

namespace App\Backend\Scheduleprovisionaldiagnosis;

use Illuminate\Database\Eloquent\Model;

class Scheduleprovisionaldiagnosis extends Model
{
    protected $table = 'schedule_provisional_diagnosis';

    public $incrementing = false;

    protected $fillable = [
        'patient_id',
        'provisional_id',
        'schedule_id',
        'remark','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];
}
