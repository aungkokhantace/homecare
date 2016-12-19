<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class InvestigationImagingEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "service_name" =>"required",
            "group_name" =>"required",
            "service_charges" =>"required|numeric"
        ];
    }

    public function messages(){
        return [
            "service_name.required" => "Service Name is required",
            "group_name.required" => "Group Name is required",
            "service_charges.required" => "Service Charges is required",
            "service_charges.numeric" => "Service Charges must be numeric"
        ];
    }
}
