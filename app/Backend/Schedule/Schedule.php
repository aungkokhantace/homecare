<?php

/**
 * Created by PhpStorm.
 * Author: Wai Yan Auung
 * Date: 8/9/2016
 * Time: 4:48 PM
 */

namespace App\Backend\Schedule;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'enquiry_id',
        'patient_id',
        'phone_no',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function patient()
    {
        return $this->belongsTo('App\Backend\Patient\Patient','patient_id','user_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Backend\Zone\Zone','zone_id','id');
    }

    public function leader()
    {
        return $this->belongsTo('App\Core\User\User','leader_id','id');
    }

    public function township()
    {
        return $this->belongsTo('App\Backend\Township\Township','township_id','id');
    }

    public function cartype()
    {
        return $this->belongsTo('App\Backend\Cartype\Cartype','car_type_id','id');
    }

    public function scheduledetail(){
        return $this->hasMany('App\Backend\Scheduledetail\Scheduledetail');
    }
}
