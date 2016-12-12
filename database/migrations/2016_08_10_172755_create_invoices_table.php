<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id')->nullable();
            $table->integer('zone_id');
            $table->integer('township_id');
            $table->decimal('total_car_amount',10,2);
            $table->decimal('total_medication_amount',10,2);
            $table->decimal('total_investigation_amount',10,2);
            $table->decimal('total_service_amount',10,2);
            $table->decimal('total_other_service_amount',10,2);
            $table->decimal('total_consultant_fee',10,2);
            $table->decimal('total_consultant_discount_amount',10,2);
            $table->decimal('total_nett_amt_wo_disc',10,2);
            $table->decimal('total_disc_amt',10,2);
            $table->decimal('total_disc_percent',10,2);
            $table->decimal('total_nett_amt_w_disc',10,2);
            $table->decimal('tax_rate',10,2);
            $table->decimal('total_tax_amt',10,2);
            $table->decimal('total_payable_amt',10,2);
            $table->string('status',45);
            $table->string('accepted_by',45);
            $table->dateTime('schedule_start_time');
            $table->dateTime('schedule_end_time');
            $table->string('patient_package_id',45);
            $table->integer('package_id');
            $table->decimal('package_price',10,2);
            $table->string('type',20)->default('');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->string('invoice_id');
            $table->string('type',45);
            $table->string('product_id');
            $table->integer('product_qty');
            $table->decimal('product_price',10,2);
            $table->decimal('product_amount',10,2);
            $table->integer('service_type_id');
            $table->decimal('service_price',10,2);
            $table->integer('consultant_id');
            $table->string('consultant_fee',45);
            $table->string('consultant_discount_percentage',45);
            $table->decimal('consultant_discount_amount',10,2);
            $table->integer('car_type');
            $table->integer('car_type_setup_id');
            $table->decimal('car_type_price',10,2);
            $table->string('other_service',45);
            $table->decimal('other_service_price',10,2);
            $table->text('other_service_remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoices');
        Schema::drop('invoice_detail');
    }
}
