<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:37 AM
 */

namespace App\Backend\Test;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'id',
        'name',
        'price',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

}
