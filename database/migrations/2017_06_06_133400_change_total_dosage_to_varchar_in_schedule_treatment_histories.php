<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTotalDosageToVarcharInScheduleTreatmentHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_treatment_histories', function (Blueprint $table) {
            $table->string('total_dosage')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_treatment_histories', function (Blueprint $table) {
            //
        });
    }
}
