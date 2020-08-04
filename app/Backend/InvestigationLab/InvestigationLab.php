<?php

namespace App\Backend\InvestigationLab;

use Illuminate\Database\Eloquent\Model;

class InvestigationLab extends Model
{
    protected $table = 'investigation_labs';

    protected $fillable = [
        'id',
        'service_name',
        'routine_request',
        'urgent_request',
        'description',
        'routine_price',
        'urgent_price',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
