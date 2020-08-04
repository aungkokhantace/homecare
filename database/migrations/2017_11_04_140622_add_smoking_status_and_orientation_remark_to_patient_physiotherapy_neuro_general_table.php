<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSmokingStatusAndOrientationRemarkToPatientPhysiotherapyNeuroGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_physiotherapy_neuro_general', function (Blueprint $table) {
            $table->tinyInteger('smoking_history_status')->after('smoking_history_stop')->default(0);
            $table->text('orientation_remark')->after('orientation_person')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_physiotherapy_neuro_general', function (Blueprint $table) {
            $table->dropColumn('smoking_history_status');
            $table->dropColumn('orientation_remark');
        });
    }
}
