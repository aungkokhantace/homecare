<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTreatmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_treatment_histories', function (Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->string('product_id');
            $table->string('other_product',45)->nullable();
            $table->integer('total_dosage');
            $table->string('frequency',45);
            $table->string('days',45);
            $table->text('remark')->nullable();
            $table->string('schedule_id');
            $table->integer('sold_dosage');
            $table->integer('unsold_dosage');
            $table->string('time',45);

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
//
//            $table->foreign('product_id')
//                ->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_treatment_histories');
    }
}
