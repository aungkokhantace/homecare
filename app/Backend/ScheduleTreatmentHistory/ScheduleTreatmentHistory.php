<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:02 PM
 */

namespace App\Backend\ScheduleTreatmentHistory;

use Illuminate\Database\Eloquent\Model;

class ScheduleTreatmentHistory extends Model
{
    protected $table = 'schedule_treatment_histories';

    public $incrementing = false;

    protected $fillable = [
        'patient_id',
        'product_id',
        'other_product',
        'total_dosage',
        'frequency',
        'days',
        'remark',
        'schedule_id',
        'sold_dosage',
        'unsold_dosage',
        'time','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function product()
    {
        return $this->belongsTo('App\Backend\Product\Product','product_id','id');
    }

}
