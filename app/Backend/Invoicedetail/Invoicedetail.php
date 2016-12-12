<?php

namespace App\Backend\Invoicedetail;

use Illuminate\Database\Eloquent\Model;

class Invoicedetail extends Model
{
    protected $table = 'invoice_detail';

    public $incrementing = false;

    protected $fillable = [
        'invoice_id',
        'type',
        'product_id',
        'product_qty',
        'product_price',
        'product_amount',
        'service_type_id',
        'consultant_id',
        'consultant_fee',
        'consultant_discount_percentage',
        'consultant_discount_amount',
        'car_type_setup_id',
        'car_type_price',
        'other_service',
        'other_service_price',
        'other_service_remark'
    ];

    public function product()
    {
        return $this->belongsTo('App\Backend\Product\Product','product_id','id');
    }

    public function scheduleInvestigation()
    {
        return $this->belongsTo('App\Backend\ScheduleInvestigation\ScheduleInvestigation','product_id','id');
    }
}
