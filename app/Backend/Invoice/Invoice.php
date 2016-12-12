<?php

namespace App\Backend\Invoice;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'date',
        'patient_id',
        'schedule_id',
        'zone_id',
        'zone_price',
        'total_car_amount',
        'total_medication_amount',
        'total_investigation_amount',
        'total_service_amount',
        'total_consultant_fee',
        'total_consultant_discount_amount',
        'total_nett_amt_wo_disc',
        'total_disc_amt',
        'total_disc_percent',
        'total_nett_amt_w_disc',
        'tax_rate',
        'total_tax_amt',
        'total_payable_amt',
        'status',
        'accepted_by',
        'schedule_start_time',
        'schedule_end_time',
        'patient_package_id',
        'package_id',
        'package_price',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Backend\Patient\Patient','patient_id','user_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Backend\Package\Package','package_id','id');
    }

    public function packagesale()
    {
        return $this->belongsTo('App\Backend\Packagesale\Packagesale','patient_package_id','id');
    }
}
