<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/21/2016
 * Time: 5:19 PM
 */
namespace App\Backend\Cartypesetup;

use Illuminate\Database\Eloquent\Model;

class Cartypesetup extends Model
{
    protected $table = 'car_type_setup';

    protected $fillable = [
        'id',
        'car_type_id',
        'patient_type_id',
        'zone_id',
        'price',
        'remark','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function car_type()
    {
        return $this->belongsTo('App\Backend\Cartype\Cartype','car_type_id','id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Backend\Zone\Zone','zone_id','id');
    }


}
