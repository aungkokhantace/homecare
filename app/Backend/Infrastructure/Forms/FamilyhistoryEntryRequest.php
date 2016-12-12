<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 10:22 AM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class FamilyhistoryEntryRequest extends Request
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
            "name.required" => "Family History Name is required"
        ];
    }
}
