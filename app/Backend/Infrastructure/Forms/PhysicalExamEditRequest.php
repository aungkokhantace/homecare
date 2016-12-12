<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class PhysicalExamEditRequest extends Request
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
            "type" =>"required"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Physical Examination Name is required",
            "type.required" => "Physical Examination Type is required",
        ];
    }
}
