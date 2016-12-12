<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulePhysicalExamsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_physical_exams_abdomen_extre_neuro', function(Blueprint $table) {

            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->boolean('abdomen_normal');
            $table->boolean('abdomen_abnormal');
            $table->boolean('abdomen_tenderness');
            $table->boolean('abdomen_distension');
            $table->boolean('abdomen_mass');
            $table->boolean('abdomen_hernia');
            $table->boolean('abdomen_bowel_sound');
            $table->text('abdomen_remark')->nullable();
            $table->boolean('extre_normal');
            $table->boolean('extre_abnormal');
            $table->boolean('extre_edema');
            $table->boolean('extre_varicose');
            $table->boolean('extre_ulcer');
            $table->boolean('extre_gangrene');
            $table->boolean('extre_calf_tenderness');
            $table->boolean('extre_ampulation');
            $table->text('extre_remark')->nullable();
            $table->boolean('neuro_normal');
            $table->boolean('neuro_abnormal');
            $table->boolean('neuro_motor_weakness');
            $table->boolean('neuro_sensory_loss');
            $table->boolean('neuro_abnormal_movement');
            $table->text('neuro_remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });

        Schema::create('schedule_physical_exams_general_pupils_head', function(Blueprint $table) {

            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->boolean('alert');
            $table->boolean('unconscious');
            $table->boolean('semiconscious');
            $table->boolean('drowsy');
            $table->text('general_remark')->nullable();
            $table->boolean('pupils_normal');
            $table->boolean('pupils_abnormal');
            $table->boolean('pupils_left_pinpoint_pupil');
            $table->boolean('pupils_left_reactive');
            $table->boolean('pupils_left_not_reactive');
            $table->boolean('pupils_right_pinpoint_pupil');
            $table->boolean('pupils_right_reactive');
            $table->boolean('pupils_right_not_reactive');
            $table->text('pupils_remark')->nullable();
            $table->boolean('head_normal');
            $table->boolean('head_abnormal');
            $table->boolean('head_JVD');
            $table->boolean('head_Goiter');
            $table->boolean('head_Lympha');
            $table->text('head_remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });

        Schema::create('schedule_physical_exams_heart_lungs', function(Blueprint $table) {

            $table->string('id');
            $table->string('patient_id');
            $table->string('schedule_id');
            $table->boolean('heart_normal');
            $table->boolean('heart_abnormal');
            $table->boolean('heart_rate_normal');
            $table->boolean('heart_rate_brady');
            $table->boolean('heart_rate_tachy');
            $table->boolean('heart_rhythm_regular');
            $table->boolean('heart_rhythm_irregular');
            $table->boolean('heart_sound_s1');
            $table->boolean('heart_sound_s2');
            $table->boolean('heart_sound_systolic');
            $table->boolean('heart_sound_diastolic');
            $table->text('heart_remark')->nullable();
            $table->boolean('lungs_normal');
            $table->boolean('lungs_abnormal');
            $table->boolean('lungs_left_chest');
            $table->boolean('lungs_left_dullness');
            $table->boolean('lungs_left_reduced');
            $table->boolean('lungs_left_absent');
            $table->boolean('lungs_left_crepitations');
            $table->boolean('lungs_left_wheezing');
            $table->boolean('lungs_right_chest');
            $table->boolean('lungs_right_dullness');
            $table->boolean('lungs_right_reduced');
            $table->boolean('lungs_right_absent');
            $table->boolean('lungs_right_crepitations');
            $table->boolean('lungs_right_wheezing');
            $table->text('lungs_remark')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedule_physical_exams_abdomen_extre_neuro');
        Schema::drop('schedule_physical_exams_general_pupils_head');
        Schema::drop('schedule_physical_exams_heart_lungs');
    }
}
