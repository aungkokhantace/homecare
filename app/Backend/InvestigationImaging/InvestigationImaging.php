<?php

namespace App\Backend\InvestigationImaging;

use Illuminate\Database\Eloquent\Model;

class InvestigationImaging extends Model
{
    protected $table = 'investigations_imaging';

    protected $fillable = [
        'id',
        'service_id',
        'group_name',
        'service_name',
        'service_charges',
        'urgent_fees',
        'refer_fees',
        'reading_fees',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
