<?php

namespace App\Backend\Investigation;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $table = 'investigations';

    protected $fillable = [
        'id',
        'name',
        'description',
        'group_name',
        'price',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
