<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPhysiotherapyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_physiotherapy_musculo_3_sitting', function (Blueprint $table) {
            $table->string('patient_id');
            $table->string('joint');
            $table->boolean('flexion_normal');
            $table->boolean('flexion_minimum');
            $table->boolean('flexion_moderate');
            $table->boolean('flexion_maximum');
            $table->boolean('extension_normal');
            $table->boolean('extension_minimum');
            $table->boolean('extension_moderate');
            $table->boolean('extension_maximum');
            $table->boolean('abduction_normal');
            $table->boolean('abduction_minimum');
            $table->boolean('abduction_moderate');
            $table->boolean('abduction_maximum');
            $table->boolean('adduction_normal');
            $table->boolean('adduction_minimum');
            $table->boolean('adduction_moderate');
            $table->boolean('adduction_maximum');
            $table->boolean('medical_rotation_normal');
            $table->boolean('medical_rotation_minimum');
            $table->boolean('medical_rotation_moderate');
            $table->boolean('medical_rotation_maximum');
            $table->boolean('lateral_rotation_normal');
            $table->boolean('lateral_rotation_minimum');
            $table->boolean('lateral_rotation_moderate');
            $table->boolean('lateral_rotation_maximum');
            $table->boolean('side_flexion_normal');
            $table->boolean('side_flexion_minimum');
            $table->boolean('side_flexion_moderate');
            $table->boolean('side_flexion_maximum');
            $table->boolean('rotation_to_right_normal');
            $table->boolean('rotation_to_right_minimum');
            $table->boolean('rotation_to_right_moderate');
            $table->boolean('rotation_to_right_maximum');
            $table->boolean('rotation_to_left_normal');
            $table->boolean('rotation_to_left_minimum');
            $table->boolean('rotation_to_left_moderate');
            $table->boolean('rotation_to_left_maximum');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_musculo_3_standing', function (Blueprint $table) {
            $table->string('patient_id');
            $table->string('joint');
            $table->boolean('flexion_normal');
            $table->boolean('flexion_minimum');
            $table->boolean('flexion_moderate');
            $table->boolean('flexion_maximum');
            $table->boolean('extension_normal');
            $table->boolean('extension_minimum');
            $table->boolean('extension_moderate');
            $table->boolean('extension_maximum');
            $table->boolean('abduction_normal');
            $table->boolean('abduction_minimum');
            $table->boolean('abduction_moderate');
            $table->boolean('abduction_maximum');
            $table->boolean('adduction_normal');
            $table->boolean('adduction_minimum');
            $table->boolean('adduction_moderate');
            $table->boolean('adduction_maximum');
            $table->boolean('medical_rotation_normal');
            $table->boolean('medical_rotation_minimum');
            $table->boolean('medical_rotation_moderate');
            $table->boolean('medical_rotation_maximum');
            $table->boolean('lateral_rotation_normal');
            $table->boolean('lateral_rotation_minimum');
            $table->boolean('lateral_rotation_moderate');
            $table->boolean('lateral_rotation_maximum');
            $table->boolean('side_flexion_normal');
            $table->boolean('side_flexion_minimum');
            $table->boolean('side_flexion_moderate');
            $table->boolean('side_flexion_maximum');
            $table->boolean('rotation_to_right_normal');
            $table->boolean('rotation_to_right_minimum');
            $table->boolean('rotation_to_right_moderate');
            $table->boolean('rotation_to_right_maximum');
            $table->boolean('rotation_to_left_normal');
            $table->boolean('rotation_to_left_minimum');
            $table->boolean('rotation_to_left_moderate');
            $table->boolean('rotation_to_left_maximum');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_musculo_4_1and2', function (Blueprint $table) {
            $table->string('patient_id');
            $table->boolean('slr_plus');
            $table->boolean('slr_minus');
            $table->boolean('ehl_plus');
            $table->boolean('ehl_minus');
            $table->boolean('femoral_nerve_plus');
            $table->boolean('femoral_nerve_minus');
            $table->boolean('empty_can_test_plus');
            $table->boolean('empty_can_test_minus');
            $table->boolean('neer_test_plus');
            $table->boolean('neer_test_minus');
            $table->boolean('hawkin_test_plus');
            $table->boolean('hawkin_test_minus');
            $table->boolean('gerber_life_off_test_plus');
            $table->boolean('gerber_life_off_test_minus');
            $table->boolean('drop_arm_test_plus');
            $table->boolean('drop_arm_test_minus');
            $table->boolean('crank_test_plus');
            $table->boolean('crank_test_minus');
            $table->boolean('apprehension_test_plus');
            $table->boolean('apprehension_test_minus');
            $table->boolean('yergason_test_plus');
            $table->boolean('yergason_test_minus');
            $table->boolean('anterior_drawer_test_plus');
            $table->boolean('anterior_drawer_test_minus');
            $table->boolean('posterior_drawer_test_plus');
            $table->boolean('posterior_drawer_test_minus');
            $table->boolean('varus_stress_test_plus');
            $table->boolean('varus_stress_test_minus');
            $table->boolean('valgus_stress_test_plus');
            $table->boolean('valgus_stress_test_minus');
            $table->boolean('mc_murray_test_plus');
            $table->boolean('mc_murray_test_minus');
            $table->string('flexion');
            $table->string('extension');
            $table->string('abduction');
            $table->string('adduction');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_musculo_4_3', function (Blueprint $table) {
            $table->string('patient_id');
            $table->string('ms_acting_on_joint');
            $table->boolean('flexors_0');
            $table->boolean('flexors_1');
            $table->boolean('flexors_2');
            $table->boolean('flexors_3');
            $table->boolean('flexors_4');
            $table->boolean('flexors_5');
            $table->boolean('extensors_0');
            $table->boolean('extensors_1');
            $table->boolean('extensors_2');
            $table->boolean('extensors_3');
            $table->boolean('extensors_4');
            $table->boolean('extensors_5');
            $table->boolean('abductors_0');
            $table->boolean('abductors_1');
            $table->boolean('abductors_2');
            $table->boolean('abductors_3');
            $table->boolean('abductors_4');
            $table->boolean('abductors_5');
            $table->boolean('adductors_0');
            $table->boolean('adductors_1');
            $table->boolean('adductors_2');
            $table->boolean('adductors_3');
            $table->boolean('adductors_4');
            $table->boolean('adductors_5');
            $table->boolean('medial_rotators_0');
            $table->boolean('medial_rotators_1');
            $table->boolean('medial_rotators_2');
            $table->boolean('medial_rotators_3');
            $table->boolean('medial_rotators_4');
            $table->boolean('medial_rotators_5');
            $table->boolean('lateral_rotators_0');
            $table->boolean('lateral_rotators_1');
            $table->boolean('lateral_rotators_2');
            $table->boolean('lateral_rotators_3');
            $table->boolean('lateral_rotators_4');
            $table->boolean('lateral_rotators_5');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_musculo_4_4and5', function (Blueprint $table) {
            $table->string('patient_id');
            $table->string('muscle_tone');
            $table->string('other_investigation');
            $table->boolean('skin_conditions');
            $table->boolean('heart_disease');
            $table->boolean('diabetes');
            $table->boolean('osteoporosis');
            $table->boolean('joint_replacements');
            $table->boolean('pregnancy');
            $table->boolean('pacemaker');
            $table->boolean('stroke');
            $table->boolean('rapid_weight_loss');
            $table->boolean('bowelbladder_problems');
            $table->boolean('malignancy');
            $table->boolean('arthritis');
            $table->boolean('numbness');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_neuro_functional_performance1', function (Blueprint $table) {
            $table->string('patient_id');
            $table->boolean('rolling_i');
            $table->boolean('rolling_s');
            $table->boolean('rolling_min');
            $table->boolean('rolling_mod');
            $table->boolean('rolling_max');
            $table->boolean('rolling_u');
            $table->boolean('rolling_nt');
            $table->boolean('supine_lying_sitting_i');
            $table->boolean('supine_lying_sitting_s');
            $table->boolean('supine_lying_sitting_min');
            $table->boolean('supine_lying_sitting_mod');
            $table->boolean('supine_lying_sitting_max');
            $table->boolean('supine_lying_sitting_u');
            $table->boolean('supine_lying_sitting_nt');
            $table->boolean('transfer_bed_chair_i');
            $table->boolean('transfer_bed_chair_s');
            $table->boolean('transfer_bed_chair_min');
            $table->boolean('transfer_bed_chair_mod');
            $table->boolean('transfer_bed_chair_max');
            $table->boolean('transfer_bed_chair_u');
            $table->boolean('transfer_bed_chair_nt');
            $table->boolean('sit_stand_i');
            $table->boolean('sit_stand_s');
            $table->boolean('sit_stand_min');
            $table->boolean('sit_stand_mod');
            $table->boolean('sit_stand_max');
            $table->boolean('sit_stand_u');
            $table->boolean('sit_stand_nt');
            $table->boolean('ambulation_i');
            $table->boolean('ambulation_s');
            $table->boolean('ambulation_min');
            $table->boolean('ambulation_mod');
            $table->boolean('ambulation_max');
            $table->boolean('ambulation_u');
            $table->boolean('ambulation_nt');
            $table->text('rolling_comment')->nullable();
            $table->text('spine_lying_sitting_comment')->nullable();
            $table->text('transfer_bed_chair_comment')->nullable();
            $table->text('sit_stand_comment')->nullable();
            $table->text('ambulation_comment')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_neuro_functional_performance2', function (Blueprint $table) {
            $table->string('patient_id');
            $table->boolean('walking_aid');
            $table->boolean('ws');
            $table->boolean('qs');
            $table->boolean('wf');
            $table->boolean('handroid');
            $table->boolean('reciprocal_yes');
            $table->boolean('reciprocal_no');
            $table->boolean('rail_nil');
            $table->boolean('rail_1');
            $table->boolean('rail_2');
            $table->boolean('writing_i');
            $table->boolean('writing_s');
            $table->boolean('writing_min');
            $table->boolean('writing_mod');
            $table->boolean('writing_max');
            $table->boolean('writing_u');
            $table->boolean('writing_nt');
            $table->text('writing_comment')->nullable();
            $table->boolean('holding_i');
            $table->boolean('holding_s');
            $table->boolean('holding_min');
            $table->boolean('holding_mod');
            $table->boolean('holding_max');
            $table->boolean('holding_u');
            $table->boolean('holding_nt');
            $table->text('holding_comment')->nullable();
            $table->boolean('picking_up_i');
            $table->boolean('picing_up_s');
            $table->boolean('picking_up_min');
            $table->boolean('picking_up_mod');
            $table->boolean('picking_up_max');
            $table->boolean('picking_up_u');
            $table->boolean('picking_up_nt');
            $table->text('picking_up_comment')->nullable();
            $table->boolean('reaching_i');
            $table->boolean('reaching_s');
            $table->boolean('reaching_min');
            $table->boolean('reaching_mod');
            $table->boolean('reaching_max');
            $table->boolean('reaching_u');
            $table->boolean('reaching_nt');
            $table->text('reaching_comment')->nullable();

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_neuro_functional_performance3', function (Blueprint $table) {
            $table->string('patient_id');
            $table->boolean('static_sitting_good');
            $table->boolean('static_sitting_fair');
            $table->boolean('static_sitting_poor');
            $table->boolean('static_sitting_nt');
            $table->text('static_sitting_comment')->nullable();
            $table->boolean('dynamic_sitting_good');
            $table->boolean('dynamic_sitting_fair');
            $table->boolean('dynamic_sitting_poor');
            $table->boolean('dynamic_sitting_nt');
            $table->text('dynamic_sitting_comment')->nullable();
            $table->boolean('static_standing_good');
            $table->boolean('static_standing_fair');
            $table->boolean('static_standing_poor');
            $table->boolean('static_standing_nt');
            $table->text('static_standing_comment')->nullable();
            $table->boolean('dynamic_standing_good');
            $table->boolean('dynamic_standing_fair');
            $table->boolean('dynamic_standing_poor');
            $table->boolean('dynamic_standing_nt');
            $table->text('dynamic_standing_comment')->nullable();
            $table->boolean('activity_tolerance_good');
            $table->boolean('activity_tolerance_fair');
            $table->boolean('activity_tolerance_poor');
            $table->boolean('activity_tolerance_nt');
            $table->text('activity_tolerance_comment')->nullable();
            $table->text('short_term_goal');
            $table->text('long_term_goal');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_neuro_general', function (Blueprint $table) {
            $table->string('patient_id');
            $table->string('diagnosis');
            $table->string('relevant');
            $table->string('history');
            $table->boolean('pre_mobid_status_community');
            $table->boolean('pre_mobid_status_home_bound');
            $table->boolean('pre_mobid_status_wheel_chair_bound');
            $table->boolean('pre_mobid_status_bed_bound');
            $table->text('smoking_history_start');
            $table->text('smoking_history_stop');
            $table->text('mental_status');
            $table->text('vision');
            $table->text('hearing');
            $table->text('speech_swallowing');
            $table->boolean('orientation_time');
            $table->boolean('orientation_place');
            $table->boolean('orientation_person');
            $table->text('obey_ommands');
            $table->text('follow_gestures');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiotherapy_neuro_limb', function (Blueprint $table) {
            $table->string('patients_id');
            $table->string('shoulder_flexor_right');
            $table->string('shoulder_flexor_left');
            $table->string('shoulder_extensor_left');
            $table->string('shoulder_extensor_right');
            $table->string('shoulder_abductor_left');
            $table->string('shoulder_abductor_right');
            $table->string('elbow_flexor_left');
            $table->string('elbow_flexor_right');
            $table->string('elbow_extensor_left');
            $table->string('elbow_extensor_right');
            $table->string('gripping_left');
            $table->string('gripping_right');
            $table->string('hip_flexor_left');
            $table->string('hip_flexor_right');
            $table->string('hip_extensor_left');
            $table->string('hip_extensor_right');
            $table->string('hip_abductor_left');
            $table->string('hip_abductor_right');
            $table->string('knee_flexion_left');
            $table->string('knee_flexion_right');
            $table->string('knee_extension_left');
            $table->string('knee_extension_right');
            $table->string('ankle_dorsiflexion_left');
            $table->string('ankle_dorsiflexion_right');
            $table->string('ankle_plantarflexion_left');
            $table->string('ankle_plantarflexion_right');
            $table->string('rom');
            $table->string('tone');
            $table->string('sensation');
            $table->string('joint_position_sense');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patient_physiothreapy_musculo_1_and_2', function (Blueprint $table) {
            $table->string('patients_id');
            $table->string('diagnosis');
            $table->string('referred_by');
            $table->string('previous_medical_history');
            $table->string('chief_complaint_onset');
            $table->string('chief_complaint_duration');
            $table->string('chief_complaint_site_and_spread_of_pain');
            $table->boolean('chief_complaint_constant');
            $table->boolean('chief_complaint_sharp');
            $table->boolean('chief_complaint_thorbbing');
            $table->text('chief_complaint_others');
            $table->boolean('chief_complaint_intermittent');
            $table->boolean('chief_complaint_dull_ache');
            $table->boolean('chief_complaint_night_pain');
            $table->integer('chief_complaint_pain_grade');
            $table->text('chief_complaint_aggravating_factors');
            $table->text('chief_complaint_alternating_factors');
            $table->boolean('chief_complaint_pin_and_needles');
            $table->boolean('chief_complaint_tingling');
            $table->boolean('chief_complaint_numbness');
            $table->boolean('chief_complaint_locking');
            $table->boolean('chief_complaint_popping');
            $table->boolean('chief_complaint_giving_way');
            $table->text('cheif_comlaint_sensation_others');
            $table->text('observation_posture');
            $table->text('observation_deformity');
            $table->text('observation_gait');
            $table->boolean('observation_swelling');
            $table->boolean('observation_heat');
            $table->boolean('observation_tendemess');
            $table->boolean('observation_loss_of_function');
            $table->boolean('observation_muscule_spasm');

            //Common to all table ----------------------------------------------
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
        Schema::drop('patient_physiotherapy_musculo_3_sitting');
        Schema::drop('patient_physiotherapy_musculo_3_standing');
        Schema::drop('patient_physiotherapy_musculo_4_1and2');
        Schema::drop('patient_physiotherapy_musculo_4_3');
        Schema::drop('patient_physiotherapy_musculo_4_4and5');
        Schema::drop('patient_physiotherapy_neuro_functional_performance1');
        Schema::drop('patient_physiotherapy_neuro_functional_performance2');
        Schema::drop('patient_physiotherapy_neuro_functional_performance3');
        Schema::drop('patient_physiotherapy_neuro_general');
        Schema::drop('patient_physiotherapy_neuro_limb');
        Schema::drop('patient_physiothreapy_musculo_1_and_2');
    }
}
