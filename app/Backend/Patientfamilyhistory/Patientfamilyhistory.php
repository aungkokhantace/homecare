<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:03 AM
 */

namespace App\Backend\Patientfamilyhistory;

use Illuminate\Database\Eloquent\Model;

class Patientfamilyhistory extends Model
{
    protected $table = 'patient_family_history';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'patient_id',
        'family_history_id',
        'family_member_id',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'

    ];

}

