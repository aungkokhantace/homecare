<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 5:18 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class ServiceEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" =>"required",
            "price" =>"required|numeric"
        ];
    }
    public function messages(){
        return [
            "name.required" => "Service Name is required",
            "price.required" => "Service Price is required"
        ];
    }
}
