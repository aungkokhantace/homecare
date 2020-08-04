<?php
namespace App\Api\Nutrition;
use App\Backend\Nutrition\Nutrition;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/18/2016
 * Time: 2:59 PM
 */
class NutritionApiRepository implements NutritionApiRepositoryInterface
{
    public function createSingleRow($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['id'] = $tempObj->id;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function nutrition($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            foreach($data as $row){
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;

                //clear all existing data in products relating to input
                DB::table('nutrition')
                    ->where('patient_id','=',$patient_id)
                    ->where('schedule_id','=',$schedule_id)
                    ->delete();
            }

            $tempLogArr     = array();
            foreach($data as $row){
                $patient_id     = $row->patient_id;
                $schedule_id    = $row->schedule_id;
                $enquiry_id     = $row->enquiry_id;

                //Check update or create for log date
                $findObj    = Nutrition::where('patient_id','=',$row->patient_id)
                                        ->where('schedule_id',$schedule_id)
                                        ->where('enquiry_id',$enquiry_id)->get();
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

//                //clear all existing data in products relating to input
//                DB::table('nutrition')
//                    ->where('patient_id','=',$patient_id)
//                    ->where('schedule_id','=',$schedule_id)
//                    ->where('enquiry_id','=',$enquiry_id)
//                    ->delete();

                //creating nutrition object
                $paramObj = new Nutrition();
                $paramObj->patient_id 								= $row->patient_id;
                $paramObj->schedule_id 								= $row->schedule_id;
                $paramObj->enquiry_id 								= $row->enquiry_id;
                $paramObj->about_acceptable_weight 					= $row->about_acceptable_weight;
                $paramObj->uti 										= $row->uti;
                $paramObj->htn_stroke_chf_cvd 						= $row->htn_stroke_chf_cvd;
                $paramObj->belowaceptable_weight 					= $row->belowaceptable_weight;
                $paramObj->poor_intake 								= $row->poor_intake;
                $paramObj->wieght_loss 								= $row->wieght_loss;
                $paramObj->difficulty_swallowing 					= $row->difficulty_swallowing;
                $paramObj->no_poordentition 						= $row->no_poordentition;
                $paramObj->clear_full_liquid 						= $row->clear_full_liquid;
                $paramObj->skin_breakthrough 						= $row->skin_breakthrough;
                $paramObj->recent_fracture_trauma 					= $row->recent_fracture_trauma;
                $paramObj->recent_surgery 							= $row->recent_surgery;
                $paramObj->edema 									= $row->edema;
                $paramObj->diabetes 								= $row->diabetes;
                $paramObj->rental_dieases_dialysis 					= $row->rental_dieases_dialysis;
                $paramObj->drug_nutinteraction 						= $row->drug_nutinteraction;
                $paramObj->dx_hol_nutrition 						= $row->dx_hol_nutrition;
                $paramObj->dx_ho_cancer 							= $row->dx_ho_cancer;
                $paramObj->dx_hodehydration 						= $row->dx_hodehydration;
                $paramObj->dx_ho_dementia 							= $row->dx_ho_dementia;
                $paramObj->dx_ho_mentaldx 							= $row->dx_ho_mentaldx;
                $paramObj->other 									= $row->other;
                $paramObj->male_nutrition_field1 					= $row->male_nutrition_field1;
                $paramObj->male_nutrition_field2 					= $row->male_nutrition_field2;
                $paramObj->male_nutrition_field3 					= $row->male_nutrition_field3;
                $paramObj->male_nutrition_age 						= $row->male_nutrition_age;
                $paramObj->male_nutrition_field8 					= $row->male_nutrition_field8;
                $paramObj->male_nutrition_field5 					= $row->male_nutrition_field5;
                $paramObj->male_nutrition_field6 					= $row->male_nutrition_field6;
                $paramObj->male_nutrition_field7 					= $row->male_nutrition_field7;
                $paramObj->female_nutrition_field1 					= $row->female_nutrition_field1;
                $paramObj->female_nutrition_field2 					= $row->female_nutrition_field2;
                $paramObj->female_nutrition_field3 					= $row->female_nutrition_field3;
                $paramObj->female_nutrition_age 					= $row->female_nutrition_age;
                $paramObj->female_nutrition_field8 					= $row->female_nutrition_field8;
                $paramObj->female_nutrition_field5 					= $row->female_nutrition_field5;
                $paramObj->female_nutrition_field6 					= $row->female_nutrition_field6;
                $paramObj->female_nutrition_field7 					= $row->female_nutrition_field7;
                $paramObj->protient_field1 							= $row->protient_field1;
                $paramObj->protient_field2 							= $row->protient_field2;
                $paramObj->protient_field3 							= $row->protient_field3;
                $paramObj->fluid_field1 							= $row->fluid_field1;
                $paramObj->fluid_field2 							= $row->fluid_field2;
                $paramObj->fluid_field3 							= $row->fluid_field3;
                $paramObj->fluid_field4 							= $row->fluid_field4;
                $paramObj->fluid_field5 							= $row->fluid_field5;
                $paramObj->evaluation 								= $row->evaluation;
                $paramObj->plan_of_action_or_recommendation_for_care_plan = $row->plan_of_action_or_recommendation_for_care_plan;
                $paramObj->remark 									= $row->remark;
                //start newly added columns
                $paramObj->gender 									= $row->gender;
                $paramObj->weight 									= $row->weight;
                $paramObj->height 									= $row->height;
                $paramObj->age 									    = $row->age;
                $paramObj->calorie 									= $row->calorie;
                $paramObj->activity_factor 							= $row->activity_factor;
                $paramObj->totalCalorie 							= $row->totalCalorie;
                $paramObj->protein_kg 								= $row->protein_kg;
                $paramObj->protein_gm 								= $row->protein_gm;
                $paramObj->protein_result 							= $row->protein_result;
                $paramObj->fluid_kg 								= $row->fluid_kg;
                $paramObj->fluid_cm 								= $row->fluid_cm;
                $paramObj->fluid_result 							= $row->fluid_result;
                $paramObj->dehydration 								= $row->dehydration;
                $paramObj->total_fluid 								= $row->total_fluid;
                //end newly added columns
                $paramObj->created_by                               = $row->created_by;
                $paramObj->updated_by                               = $row->updated_by;
                $paramObj->deleted_by                               = $row->deleted_by;
                $paramObj->created_at                               = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                               = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                               = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' nutrition for patient_id = '.$paramObj->patient_id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input nutrition)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }
}