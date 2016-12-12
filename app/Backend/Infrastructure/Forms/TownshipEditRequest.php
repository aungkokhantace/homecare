<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 2:40 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class TownshipEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" =>"required",
            "city_id" =>"required"
        ];
    }
    public function messages(){
        return [
            "name.required" => "Township Name is required",
            "city_id.required" => "Township City is required"
        ];
    }
}
