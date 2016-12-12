<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:13 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class PatientmedicalhistoryEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "patient_id" =>"required",
            "medical_history_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "patient_id.required" => "Patient Name is required",
            "medical_history_id.required" => "Medical History Name is required"
        ];
    }
}
