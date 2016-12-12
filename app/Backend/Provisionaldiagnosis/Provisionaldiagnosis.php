<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/12/2016
 * Time: 4:36 PM
 */

namespace App\Backend\Provisionaldiagnosis;
use Illuminate\Database\Eloquent\Model;

class Provisionaldiagnosis extends Model
{
    protected $table = 'provisional_diagnosis';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
