<?php

namespace App\Backend\Nutrition;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    protected $table = "nutrition";

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'enquiry_id',
        'about_acceptable_weight',
        'uti',
        'htn_stroke_chf_cvd',
        'belowaceptable_weight',
        'poor_intake',
        'wieght_loss',
        'difficulty_swallowing',
        'no_poordentition',
        'clear_full_liquid',
        'skin_breakthrough',
        'recent_fracture_trauma',
        'recent_surgery',
        'edema',
        'diabetes',
        'rental_dieases_dialysis',
        'drug_nutinteraction',
        'dx_hol_nutrition',
        'dx_ho_cancer',
        'dx_hodehydration',
        'dx_ho_dementia',
        'dx_ho_mentaldx',
        'other',
        'male_nutrition_field1',
        'male_nutrition_field2',
        'male_nutrition_field3',
        'male_nutrition_age',
        'male_nutrition_field8',
        'male_nutrition_field5',
        'male_nutrition_field6',
        'male_nutrition_field7',
        'female_nutrition_field1',
        'female_nutrition_field2',
        'female_nutrition_field3',
        'female_nutrition_age',
        'female_nutrition_field8',
        'female_nutrition_field5',
        'female_nutrition_field6',
        'female_nutrition_field7',
        'protient_field1',
        'protient_field2',
        'protient_field3',
        'fluid_field1',
        'fluid_field2',
        'fluid_field3',
        'fluid_field4',
        'fluid_field5',
        'evaluation',
        'plan_of_action_or_recommendation_for_care_plan',
        'remark'
    ];
}
