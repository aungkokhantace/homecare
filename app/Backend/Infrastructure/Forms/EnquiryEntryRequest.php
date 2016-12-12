<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 10:12 AM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class EnquiryEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" =>"required",
            "gender" =>"required",
            "dob" =>"required",
            "phone_no" =>"required",
            "address" =>"required",
            "township_id" =>"required",
        ];
    }
    public function messages(){
        return [
            "name.required" => "Enquiry Name is required",
            "gender.required" => "Enquiry Gender is required",
            "dob.required" => "Enquiry DoB is required",
            "phone_no.required" => "Enquiry Phone No is required",
            "address.required" => "Enquiry Address is required",
            "township_id.required" => "Enquiry Township is required"

        ];
    }
}
