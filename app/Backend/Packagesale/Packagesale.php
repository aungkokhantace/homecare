<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 8/11/2016
 * Time: 10:52 AM
 */

namespace App\Backend\Packagesale;

use Illuminate\Database\Eloquent\Model;

class Packagesale extends Model
{
    protected $table = 'patient_package';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'patient_id',
        'package_id',
        'package_price',
        'package_usage_count',
        'package_used_count',
        'date',
        'remark','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function package()
    {
        return $this->belongsTo('App\Backend\Package\Package','package_id','id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Backend\Patient\Patient','patient_id','user_id');
    }

    public function invoice()
    {
        return $this->hasOne('App\Backend\Invoice\Invoice');
    }
}
