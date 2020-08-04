<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDoctorLincenseNumberToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_users', function (Blueprint $table) {
            $table->string('doctor_license_number')->after('fees')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_users', function (Blueprint $table) {
              $table->dropColumn('doctor_license_number');
        });
    }
}
