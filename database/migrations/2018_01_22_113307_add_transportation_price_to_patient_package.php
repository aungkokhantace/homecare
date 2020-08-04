<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransportationPriceToPatientPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_package', function (Blueprint $table) {
            $table->decimal('transportation_price',10,2)->after('package_price')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_package', function (Blueprint $table) {
            $table->dropColumn('transportation_price');
        });
    }
}
