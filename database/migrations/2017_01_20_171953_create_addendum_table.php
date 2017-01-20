<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddendumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addendum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schedule_id');
            $table->string('patient_id');
            $table->text('addendum_text');

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
        Schema::drop('addendum');
    }
}
