<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_promotions', function (Blueprint $table) {
            $table->string('id');
            $table->string('promotion_code');
            $table->string('reference_type');
            $table->string('reference_id');
            $table->integer('package_id');
            $table->tinyInteger('used');
            $table->string('promo_group_code');
            $table->integer('promo_group_code_order');
            $table->string('remark');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_promotions');
    }
}
