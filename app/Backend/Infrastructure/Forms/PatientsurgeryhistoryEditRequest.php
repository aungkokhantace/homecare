<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:22 AM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class PatientsurgeryhistoryEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "description" =>"required",
            "patient_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "description.required" => "Surgery Description is required",
            "patient_id.required" => "Patient is required"
        ];
    }
}
