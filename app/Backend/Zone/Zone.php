<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:46 PM
 */

namespace App\Backend\Zone;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = 'zones';

    protected $fillable = [
        'id',
        'price',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function patient()
    {
        return $this->hasMany('App\Backend\Patient\Patient');
    }

}
