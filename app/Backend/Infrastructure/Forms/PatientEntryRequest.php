<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class PatientEntryRequest extends Request
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
            "password" =>"required|confirmed|min:8",
            "patient_type_id" =>"required",
            "townships" =>"required",
            "address" =>"required",
            "phone_no" =>"required",
            "email" =>"email|unique:core_users",
        ];
    }
    public function messages(){
        return [
            "name.required" => "Patient Name is required",
            "password.required" => "Password is required",
            "password.confirmed" => "Password and Confirm Password do not match",
            "password.min" => "Password must be at least :min characters",
            "patient_type_id.required" => "Patient Type is required",
            "townships.required" => "Township is required",
            "address.required" => "Detail Address is required",
            "phone_no.required" => "Phone Number is required",
            "email.email" => "Email is not valid",
            "email.unique" => "Email is already occupied",
        ];
    }
}
