<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class PackagesaleEntryRequest extends Request
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
            "package" =>"required"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Patient Name is required",
            "package.required" => "Package is required"
        ];
    }
}
