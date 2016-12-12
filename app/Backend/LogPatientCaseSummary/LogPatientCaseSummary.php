<?php

namespace App\Backend\LogPatientCaseSummary;

use Illuminate\Database\Eloquent\Model;

class LogPatientCaseSummary extends Model
{
    protected $table = 'log_patient_case_summary';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'patient_id',
        'case_summary','created_date','edited_by','edited_date','updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function patient(){
    	return $this->belongsTo('App\Backend\Patient\Patient');
    }
}
