<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_services', function(Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });

        Schema::create('other_services_detail', function(Blueprint $table) {
            $table->string('other_services_id');
            $table->string('name');
            $table->double('price');
            $table->text('remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('other_services_detail');
        Schema::drop('other_services');
    }
}
