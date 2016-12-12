<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:39 AM
 */
namespace App\Backend\Allergy;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $table = 'allergies';

    protected $fillable = [
        'id',
        'name',
        'type',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

}
