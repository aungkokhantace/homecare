<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:18 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class CartypeEntryRequest extends Request
{

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
            "name.required" => "Car Type Name is required"

        ];
    }
}
