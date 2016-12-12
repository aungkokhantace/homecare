<?php

namespace App\Backend\Packagedetail;

use Illuminate\Database\Eloquent\Model;

class Packagedetail extends Model
{
    protected $table = 'package_detail';

    protected $fillable = [
        'id',
        'package_id',
        'service_id','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function service()
    {
        return $this->belongsTo('App\Backend\Service\Service','service_id','id');
    }
}
