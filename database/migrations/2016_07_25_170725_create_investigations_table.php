<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('group_name');
            $table->decimal('price',10,2)->nullable();
            $table->string('description')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('investigations_imaging', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->string('group_name');
            $table->string('service_name');
            $table->decimal('service_charges',10,2)->nullable();
            $table->decimal('urgent_fees',10,2)->nullable();
            $table->decimal('refer_fees',10,2)->nullable();
            $table->decimal('reading_fees',10,2)->nullable();

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
        Schema::drop('investigations');
        Schema::drop('investigations_imaging');
    }
}
