<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function(Blueprint $table) {
            $table->string('user_id');
            $table->string('name',45);
            $table->string('nrc_no',45);
            $table->string('email',45)->nullable();
            $table->integer('patient_type_id');
            $table->string('gender',45);
            $table->string('phone_no',45);
            $table->text('address');
            $table->unsignedInteger('township_id');
            $table->integer('zone_id');
            $table->date('dob');

            $table->text('remark');
            $table->text('case_scenario')->nullable();
            $table->tinyInteger('having_allergy')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('core_users')
                ->onDelete('restrict');

            $table->foreign('township_id')
                ->references('id')->on('townships');

        });

        Schema::create('patient_allergy', function(Blueprint $table) {
            $table->string('patient_id');
            $table->unsignedInteger('allergy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_allergy');
        Schema::drop('patients');
    }

}
