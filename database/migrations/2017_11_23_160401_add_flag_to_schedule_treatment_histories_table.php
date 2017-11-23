<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagToScheduleTreatmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('schedule_treatment_histories', function (Blueprint $table) {
          $table->integer('flag')->after('time');
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
          $table->dropColumn('flag');
      });
    }
}
