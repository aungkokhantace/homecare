<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 9:48 AM
 */

namespace App\Backend\Enquiry;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'description','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function township()
    {
        return $this->belongsTo('App\Backend\Township\Township','township_id','id');
    }

}
