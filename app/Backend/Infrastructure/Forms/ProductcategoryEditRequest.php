<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class ProductcategoryEditRequest extends Request
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


    public function rules()
    {
        return [
            "name" =>"required"
        ];
    }
    public function messages(){
        return [
            "name.required" => "Medication Category Name is required"
        ];
    }
}
