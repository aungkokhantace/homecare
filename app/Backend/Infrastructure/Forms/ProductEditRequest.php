<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class ProductEditRequest extends Request
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
            "product_category_id" =>"required",
            "price" =>"required|numeric"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Medication Name is required",
            "product_category_id.required" => "Medication Category is required",
            "price.required" => "Medication Price is required",
            "price.numeric" => "Medication Price must be numeric"
        ];
    }
}
