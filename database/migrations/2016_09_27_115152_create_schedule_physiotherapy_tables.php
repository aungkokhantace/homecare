<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulePhysiotherapyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_physiotherapy_musculo', function (Blueprint $table) {
            $table->string('id',100);
            $table->string('patient_id');
            $table->string('schedules_id');
            $table->boolean('ultrasound');
            $table->boolean('hot_manager');
            $table->boolean('traction');
            $table->boolean('electrical_stimulation');
            $table->boolean('infra_red');
            $table->boolean('laser');
            $table->text('exercise_therapy');
            $table->string('health_education');
            $table->text('others');
            $table->string('signature_of_physiotherapist');
            $table->string('diagnosis');
            $table->text('progress_note');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });

        Schema::create('schedule_physiotherapy_neuro', function (Blueprint $table) {
            $table->string('id',100);
            $table->string('patient_id');
            $table->string('schedules_id');
            $table->string('diagnosis');
            $table->string('resting_bp');
            $table->string('resting_hr');
            $table->string('resting_spo2');
            $table->boolean('passive_rom_exercise');
            $table->boolean('visual_exercise');
            $table->boolean('oral_motor_exercise');
            $table->boolean('active_assisted_rom_exercise');
            $table->boolean('bridging_inner_range');
            $table->boolean('transfer_bed');
            $table->boolean('sitting_balance');
            $table->boolean('sit_to_stand');
            $table->boolean('standing_balance');
            $table->boolean('stepping');
            $table->boolean('single_leg_balance');
            $table->boolean('march_on_spot');
            $table->boolean('ambulation_parallel_bar');
            $table->boolean('ambulation_walk');
            $table->boolean('ambulation_outdoor');
            $table->boolean('ambulation_tandem_walk');
            $table->boolean('stair');
            $table->boolean('arm_pedal');
            $table->boolean('treadmill');
            $table->boolean('hand_exercise');
            $table->boolean('writing_assisted_exercise');
            $table->boolean('signature_of_physiotherapist');
            $table->text('remark')->nullable();

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
        Schema::drop('schedule_physiotherapy_musculo');
        Schema::drop('schedule_physiotherapy_neuro');
    }
}
