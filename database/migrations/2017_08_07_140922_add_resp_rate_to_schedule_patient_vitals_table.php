<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRespRateToSchedulePatientVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_patient_vitals', function (Blueprint $table) {
            $table->integer('resp_rate')->after('remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_patient_vitals', function (Blueprint $table) {
            $table->dropColumn('resp_rate');
        });
    }
}
