<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/9/2016
 * Time: 4:55 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class ScheduleEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" =>"required",
            "date" =>"required"
        ];
    }
    public function messages(){
        return [
            "name.required" => "Schedule Name is required",
            "date.required" => "Schedule Date is required"

        ];
    }
}
