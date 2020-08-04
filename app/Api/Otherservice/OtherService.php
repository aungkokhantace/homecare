<?php

namespace App\Api\Otherservice;

use Illuminate\Database\Eloquent\Model;

class OtherService extends Model
{
    protected $table = "other_services";

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
