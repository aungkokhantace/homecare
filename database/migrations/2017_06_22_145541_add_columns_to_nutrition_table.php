<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nutrition', function (Blueprint $table) {
            $table->string('gender')->after('remark');
            $table->double('weight')->after('gender');
            $table->double('height')->after('weight');
            $table->integer('age')->after('height');
            $table->double('calorie')->after('age');
            $table->double('activity_factor')->after('calorie');
            $table->double('totalCalorie')->after('activity_factor');
            $table->integer('protein_kg')->after('totalCalorie');
            $table->integer('protein_gm')->after('protein_kg');
            $table->integer('protein_result')->after('protein_gm');
            $table->integer('fluid_kg')->after('protein_result');
            $table->integer('fluid_cm')->after('fluid_kg');
            $table->integer('fluid_result')->after('fluid_cm');
            $table->integer('dehydration')->after('fluid_result');
            $table->integer('total_fluid')->after('dehydration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nutrition', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('weight');
            $table->dropColumn('height');
            $table->dropColumn('age');
            $table->dropColumn('calorie');
            $table->dropColumn('activity_factor');
            $table->dropColumn('totalCalorie');
            $table->dropColumn('protein_kg');
            $table->dropColumn('protein_gm');
            $table->dropColumn('protein_result');
            $table->dropColumn('fluid_kg');
            $table->dropColumn('fluid_cm');
            $table->dropColumn('fluid_result');
            $table->dropColumn('dehydration');
            $table->dropColumn('total_fluid');
        });
    }
}
