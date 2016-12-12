<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:10 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class MedicalhistoryEditRequest extends Request
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
            "name.required" => "Medical History Name is required"
        ];
    }
}
