<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarTypeSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_type_setup', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('car_type_id');
            $table->decimal('price',10,2)->nullable();
            $table->integer('patient_type_id')->nullable();
            $table->integer('zone_id');
            $table->string('remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('car_type_id')
                ->references('id')->on('car_types')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('car_type_setup');
    }
}
