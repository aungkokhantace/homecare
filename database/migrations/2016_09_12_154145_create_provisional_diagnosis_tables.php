<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionalDiagnosisTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisional_diagnosis', function (Blueprint $table) {
            $table->string('id',100);
            $table->string('name');
            $table->text('description')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('schedule_provisional_diagnosis', function (Blueprint $table) {

            $table->string('patient_id');
            $table->string('provisional_id');
            $table->string('schedule_id');
            $table->string('remark');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provisional_diagnosis');
        Schema::drop('schedule_provisional_diagnosis');
    }
}
