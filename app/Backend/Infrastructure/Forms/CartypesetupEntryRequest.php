<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/21/2016
 * Time: 5:46 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class CartypesetupEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "price" =>"required|numeric",
            "car_type_id" =>"required",
            "patient_type_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "price.required" => "Car Type Price is required",
            "car_type_id.required" => "Car Type is required",
            "patient_type_id.required" => "Patient Type is required"

        ];
    }
}
