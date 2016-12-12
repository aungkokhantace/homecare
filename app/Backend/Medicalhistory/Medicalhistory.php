<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:02 PM
 */

namespace App\Backend\Medicalhistory;

use Illuminate\Database\Eloquent\Model;

class Medicalhistory extends Model
{
    protected $table = 'medical_history';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

}
