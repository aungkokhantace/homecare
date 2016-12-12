<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:02 PM
 */

namespace App\Backend\Scheduletracking;

use Illuminate\Database\Eloquent\Model;

class Scheduletracking extends Model
{
    protected $table = 'schedule_trackings';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'preparation_start_time',
        'preparation_end_time',
        'schedule_id',
        'enquiry_id',
        'arrived_to_patient_time',
        'leave_from_patient_time','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

}
