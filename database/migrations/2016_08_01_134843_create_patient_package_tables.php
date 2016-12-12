<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPackageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_package', function (Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->integer('package_id');
            $table->decimal('package_price',10,2)->nullable();
            $table->integer('package_usage_count');
            $table->integer('package_used_count');
            $table->date('sold_date');
            $table->date('expired_date');
            $table->text('remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_package_detail', function (Blueprint $table) {
            $table->string('patient_package_id');
            $table->integer('package_id');
            $table->integer('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_package_detail');
        Schema::drop('patient_package');
    }
}
