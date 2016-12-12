<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:50 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class ZoneEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name"      =>"required",
            "townships" =>"required"
        ];
    }
    public function messages(){
        return [
            "name.required"      => "Zone Name is required",
            "townships.required" => "Townships are required"
        ];
    }
}
