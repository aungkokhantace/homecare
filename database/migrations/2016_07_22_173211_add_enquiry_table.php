<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function(Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('nrc_no');
            $table->boolean('is_new_patient');
            $table->string('patient_id');
            $table->integer('patient_type_id');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->string('phone_no');
            $table->text('address');
            $table->unsignedInteger('township_id');
            $table->integer('zone_id');
            $table->integer('case_type');
            $table->integer('car_type');
            $table->unsignedInteger('car_type_id');
            $table->boolean('enquiry1');
            $table->boolean('enquiry2');
            $table->boolean('enquiry3');
            $table->boolean('enquiry4');
            $table->tinyInteger('having_allergy');
            $table->string('status');
            $table->text('remark')->nullable();

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

        Schema::create('enquiry_detail', function(Blueprint $table) {
            $table->string('enquiry_id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('allergy_id');
            $table->string('type');

            $table->foreign('enquiry_id')
                ->references('id')->on('enquiries');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        chema::drop('enquiry_detail');
        chema::drop('patients');
    }
}
