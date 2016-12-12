<?php

namespace App\Backend\Presentmedication;

use Illuminate\Database\Eloquent\Model;

class Presentmedication extends Model
{
    protected $table = 'schedule_treatment_histories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'other_product',
        'total_dosage',
        'frequency',
        'days',
        'remark',
        'schedule_id',
        'sold_dosage',
        'unsold_dosage',
        'route','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function product()
    {
        return $this->belongsTo('App\Backend\Product\Product','product_id','id');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Backend\Schedule\Schedule','schedule_id','id');
    }
}
