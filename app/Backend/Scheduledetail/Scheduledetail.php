<?php

/**
 * Created by PhpStorm.
 * Author: Wai Yan Auung
 * Date: 8/9/2016
 * Time: 4:48 PM
 */

namespace App\Backend\Scheduledetail;

use Illuminate\Database\Eloquent\Model;

class Scheduledetail extends Model
{
    protected $table = 'schedule_detail';

    protected $fillable = [
        'schedule_id',
        'package_id',
        'service_id',
        'user_id',
        'type',
    ];

    public function schedule()
    {
        return $this->belongsTo('App\Backend\Schedule\Schedule','schedule_id','id');
    }

    public function service()
    {
        return $this->belongsTo('App\Backend\Service\Service','service_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
