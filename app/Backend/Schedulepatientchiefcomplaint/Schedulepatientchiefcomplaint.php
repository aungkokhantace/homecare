<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: October 13,2016
 * Time: 4:45 PM
 */

namespace App\Backend\Schedulepatientchiefcomplaint;

use Illuminate\Database\Eloquent\Model;

class Schedulepatientchiefcomplaint extends Model
{
    protected $table = 'schedule_patient_chief_complaint';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'schedule_id',
        'patient_id',
        'chief_complaint_comment',
        'duration_days',
        'duration_months',
        'hopi',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
