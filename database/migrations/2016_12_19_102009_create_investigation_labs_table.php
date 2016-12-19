<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigationLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigation_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name');
            $table->double('routine_request');
            $table->double('urgent_request');
            $table->text('description');
            $table->double('routine_price');
            $table->double('urgent_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('investigation_labs');
    }
}
