<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_id');
            $table->decimal('price',10,2)->nullable();
            $table->integer('promotion_order')->default(1);

            //Common to all table ----------------------------------------------
//            $table->string('created_by',100)->nullable();
//            $table->string('updated_by',100)->nullable();
//            $table->string('deleted_by',100)->nullable();
//            $table->timestamps();
//            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('package_promotions');
    }
}
