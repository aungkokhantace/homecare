<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/29/2016
 * Time: 2:47 PM
 */

namespace App\Backend\Patientsurgeryhistory;

use Illuminate\Database\Eloquent\Model;

class Patientsurgeryhistory extends Model
{
    protected $table = 'patient_surgery_history';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'description',
        'patient_id',
        'schedule_id'
        ,'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}

