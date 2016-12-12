<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:06 AM
 */

namespace App\Backend\Familyhistory;

use Illuminate\Database\Eloquent\Model;

class Familyhistory extends Model
{
    protected $table = 'family_histories';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'

    ];

}

