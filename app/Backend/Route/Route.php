<?php

namespace App\Backend\Route;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'route';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
