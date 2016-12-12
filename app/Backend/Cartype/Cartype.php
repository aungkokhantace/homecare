<?php
/**
 * Created by PhpStorm.
 * Autholr: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:05 PM
 */

namespace App\Backend\Cartype;

use Illuminate\Database\Eloquent\Model;

class Cartype extends Model
{
    protected $table = 'car_types';

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

}
