<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPatientCaseSummaryTable extends Migration
{
    
    public function up()
    {
        Schema::create('log_patient_case_summary', function (Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->string('case_summary');
               
            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

           
        });
    }

    
    public function down()
    {
       Schema::drop('log_patient_case_summary');
    }
}
