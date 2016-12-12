<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:44 AM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class AllergyEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" =>"required",
            "type" =>"required"
        ];
    }
    public function messages(){
        return [
            "name.required" => "Allergy Name is required",
            "type.required" => "Allergy Type is required"
        ];
    }
}
