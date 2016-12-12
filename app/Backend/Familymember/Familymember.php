<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/30/2016
 * Time: 10:08 AM
 */

namespace App\Backend\Familymember;

use Illuminate\Database\Eloquent\Model;

class Familymember extends Model
{
    protected $table = 'patient_family_member';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

}