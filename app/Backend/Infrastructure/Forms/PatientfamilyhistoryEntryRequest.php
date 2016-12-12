<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:22 AM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class PatientFamilyhistoryEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "patient_id" =>"required",
            "family_history_id" =>"required",
            "family_member_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "patient_id.required" => "Patient Name is required",
            "family_history_id.required" => "Family History Name is required",
            "family_member_id.required" => "Family Member is required"
        ];
    }
}
