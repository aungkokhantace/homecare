<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:03 PM
 */

namespace App\Backend\Patientmedicalhistory;

use Illuminate\Database\Eloquent\Model;

class Patientmedicalhistory extends Model
{
    protected $table = 'patient_medical_history';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'patient_id',
        'medical_history_id',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by',
    ];

}
