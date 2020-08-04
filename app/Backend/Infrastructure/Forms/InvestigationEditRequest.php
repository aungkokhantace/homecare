<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class InvestigationEditRequest extends Request
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
            "routine_request" =>"required|numeric",
            "urgent_request" =>"required|numeric",
            "routine_price" =>"required|numeric",
            "urgent_price" =>"required|numeric",
            "description" =>"required",
        ];
    }

    public function messages(){
        return [
            "service_name.required" => "Service Name is required",
            "routine_request.required" => "Routine Request is required",
            "routine_request.numeric" => "Routine Request must be numeric",
            "urgent_request.required" => "Urgent Request is required",
            "urgent_request.numeric" => "Urgent Request must be numeric",
            "routine_price.required" => "Routine Price is required",
            "routine_price.numeric" => "Routine Price must be numeric",
            "urgent_price.required" => "Urgent Price is required",
            "urgent_price.numeric" => "Urgent Price must be numeric",

        ];
    }
}
