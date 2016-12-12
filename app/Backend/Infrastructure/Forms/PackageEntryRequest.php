<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class PackageEntryRequest extends Request
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
            "services" =>"required",
            "price" =>"required|numeric",
            "schedule_no" =>"required|numeric",
            "expiry_date" =>"required|numeric"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Package Name is required",
            "services.required" => "Services are required",
            "price.required" => "Package Price is required",
            "price.numeric" => "Package Price must be numeric",
            "schedule_no.required" => "No of Schedule is required",
            "expiry_date.required" => "Expiry Date is required",
            "expiry_date.numeric" => "Expiry Date must be numeric"
        ];
    }
}
