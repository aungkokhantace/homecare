<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:02 PM
 */

namespace App\Backend\Waytracking;

use Illuminate\Database\Eloquent\Model;

class Waytracking extends Model
{
    protected $table = 'way_tracking';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'date',
        'departure_time',
        'arrival_time','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

}
