<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:37 AM
 */

namespace App\Backend\Addendum;

use Illuminate\Database\Eloquent\Model;

class Addendum extends Model
{
    protected $table = 'addendum';

    protected $fillable = [
        'id',
        'schedule_id',
        'patient_id',
        'addendum_text',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
}
