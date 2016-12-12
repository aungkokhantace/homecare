<?php

namespace App\Backend\Physicalexam;

use Illuminate\Database\Eloquent\Model;

class Physicalexam extends Model
{
    protected $table = 'physical_exams';

    protected $fillable = [
        'id',
        'name',
        'type',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
