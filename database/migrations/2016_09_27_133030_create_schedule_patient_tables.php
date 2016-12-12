<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulePatientTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_patient_chief_complaint', function(Blueprint $table) {
            $table->string('id');
            $table->string('schedule_id');
            $table->string('patient_id');
            $table->text('chief_complaint_comment')->nullable();
            $table->string('duration_days');
            $table->string('duration_months');
            $table->string('hopi');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });

        Schema::create('schedule_patient_vitals', function(Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->string('date');
            $table->string('time');
            $table->double('blood_pressure_sbp');
            $table->double('blood_pressure_dbp');
            $table->double('blood_pressure_map');
            $table->double('spo2');
            $table->double('pulse_rate');
            $table->double('body_temperature_farenheit');
            $table->float('body_temperature_celsius');
            $table->double('weight_pound');
            $table->double('weight_kg');
            $table->double('height_feet');
            $table->double('height_inches');
            $table->double('height_cm');
            $table->string('blood_sugar');
            $table->text('spo2_comment')->nullable();
            $table->text('pulse_rate_comment')->nullable();
            $table->text('blood_sugar_comment')->nullable();
            $table->double('bmi');
            $table->text('remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });

        Schema::create('schedule_patient_vitals_remark', function(Blueprint $table) {
            $table->string('id');
            $table->text('remark');
            $table->string('schedule_id');
            $table->string('patient_id');

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
        Schema::drop('schedule_patient_chief_complaint');
        Schema::drop('schedule_patient_vitals');
        Schema::drop('schedule_patient_vitals_remark');
    }
}
