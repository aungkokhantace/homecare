<?php

namespace App\Backend\SchedulePhysiotherapyNeuro;

use Illuminate\Database\Eloquent\Model;

class SchedulePhysiotherapyNeuro extends Model
{
    protected $table = "schedule_physiotherapy_neuro";

    protected $fillable = [
        'id',
        'patient_id',
        'schedules_id',
        'diagnosis',
        'resting_bp',
        'resting_hr',
        'resting_spo2',
        'passive_rom_exercise',
        'visual_exercise',
        'oral_motor_exercise',
        'active_assisted_rom_exercise',
        'bridging_inner_range',
        'transfer_bed',
        'sitting_balance',
        'sit_to_stand',
        'standing_balance',
        'stepping',
        'single_leg_balance',
        'march_on_spot',
        'ambulation_parallel_bar',
        'ambulation_walk',
        'ambulation_outdoor',
        'ambulation_tandem_walk',
        'stair',
        'arm_pedal',
        'treadmill',
        'hand_exercise',
        'writing_assisted_exercise',
        'signature_of_physiotherapist',
        'remark',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
