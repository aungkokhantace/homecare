<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function(Blueprint $table) {
            $table->string('id');
            $table->string('enquiry_id');
            $table->string('patient_id');
            $table->string('patient_package_id');
            $table->date('date');
            $table->string('time');
            $table->string('phone_no');
            $table->unsignedInteger('township_id');
            $table->integer('zone_id');
            $table->integer('car_type');
            $table->unsignedInteger('car_type_id');
            $table->unsignedInteger('car_type_setup_id');
            $table->string('status');
            $table->text('remark')->nullable();
            $table->string('leader_id');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

            $table->foreign('township_id')
                ->references('id')->on('townships');

        });

        Schema::create('schedule_detail', function(Blueprint $table) {
            $table->string('schedule_id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('service_id');
            $table->string('user_id');
            $table->string('type');

//            $table->foreign('schedule_id')
//                ->references('id')->on('schedules');
        });

        Schema::create('schedule_investigations', function(Blueprint $table) {
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->integer('investigation_id');
            $table->text('investigation_lab_remark');
            $table->integer('investigation_imaging_xray_id');
            $table->integer('investigation_imaging_usg_id');
            $table->integer('investigation_imaging_ct_id');
            $table->integer('investigation_imaging_mri_id');
            $table->integer('investigation_imaging_other_id');
            $table->text('investigation_imaging_remark');
            $table->text('investigation_ecg_remark');
            $table->text('investigation_other_remark');

           // Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

//        Schema::create('schedule_medical_history', function(Blueprint $table) {
//            $table->increments('id');
//            $table->text('remark')->nullable();
//            $table->string('medical_history_id');
//            $table->string('patients_id');
//            $table->date('happened_date');
//
//            //Common to all table ----------------------------------------------
//            $table->string('created_by',100)->default('');
//            $table->string('updated_by',100)->default('');
//            $table->string('deleted_by',100)->nullable('');
//            $table->timestamps();
//            $table->softDeletes();
//
//        });

        Schema::create('schedule_trackings', function(Blueprint $table) {
            $table->string('id');
            $table->time('preparation_start_time');
            $table->time('preparation_end_time');
            $table->string('schedule_id');
            $table->string('enquiry_id');
            $table->time('arrived_to_patient_time');
            $table->time('leave_from_patient_time');


            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_detail');
        Schema::drop('schedules');
        Schema::drop('schedule_investigations');
        //Schema::drop('schedule_medical_history');
        Schema::drop('schedule_trackings');
    }
}
