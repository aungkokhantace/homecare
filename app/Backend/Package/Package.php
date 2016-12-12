<?php

namespace App\Backend\Package;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'id',
        'package_name',
        'price',
        'description',
        'schedule_no',
        'expiry_date','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
