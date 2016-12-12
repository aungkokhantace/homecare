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
            "name" =>"required",
            "group_name" =>"required",
            "price" =>"required|numeric"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Investigation Name is required",
            "group_name.required" => "Group Name is required",
            "price.required" => "Investigation Price is required",
            "price.numeric" => "Investigation Price must be numeric"
        ];
    }
}
