<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function(Blueprint $table) {
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->string('enquiry_id');
            $table->boolean('about_acceptable_weight');
            $table->boolean('uti');
            $table->boolean('htn_stroke_chf_cvd');
            $table->boolean('belowaceptable_weight');
            $table->boolean('poor_intake');
            $table->boolean('wieght_loss');
            $table->boolean('difficulty_swallowing');
            $table->boolean('no_poordentition');
            $table->boolean('clear_full_liquid');
            $table->boolean('skin_breakthrough');
            $table->boolean('recent_fracture_trauma');
            $table->boolean('recent_surgery');
            $table->boolean('edema');
            $table->boolean('diabetes');
            $table->boolean('rental_dieases_dialysis');
            $table->boolean('drug_nutinteraction');
            $table->boolean('dx_hol_nutrition');
            $table->boolean('dx_ho_cancer');
            $table->boolean('dx_hodehydration');
            $table->boolean('dx_ho_dementia');
            $table->boolean('dx_ho_mentaldx');
            $table->text('other');
            $table->string('male_nutrition_field1');
            $table->string('male_nutrition_field2');
            $table->string('male_nutrition_field3')->nullable();
            $table->string('male_nutrition_age');
            $table->string('male_nutrition_field8');
            $table->string('male_nutrition_field5');
            $table->string('male_nutrition_field6');
            $table->string('male_nutrition_field7');
            $table->string('female_nutrition_field1');
            $table->string('female_nutrition_field2');
            $table->string('female_nutrition_field3');
            $table->string('female_nutrition_age');
            $table->string('female_nutrition_field8');
            $table->string('female_nutrition_field5');
            $table->string('female_nutrition_field6');
            $table->string('female_nutrition_field7');
            $table->string('protient_field1');
            $table->string('protient_field2');
            $table->string('protient_field3');
            $table->string('fluid_field1');
            $table->string('fluid_field2');
            $table->string('fluid_field3');
            $table->string('fluid_field4');
            $table->string('fluid_field5');
            $table->text('evaluation');
            $table->text('plan_of_action_or_recommendation_for_care_plan');
            $table->text('remark')->nullable();
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nutrition');
    }
}
