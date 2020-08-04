<?php

namespace App\Backend\Patient;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'nrc_no',
        'staff_id',
        'email',
        'patient_type_id',
        'gender',
        'phone_no',
        'address',
        'township_id',
        'zone_id',
        'dob',
        'remark',
        'case_scenario',
        'having_allergy','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function township()
    {
        return $this->belongsTo('App\Backend\Township\Township','township_id','id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Backend\Zone\Zone','zone_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
