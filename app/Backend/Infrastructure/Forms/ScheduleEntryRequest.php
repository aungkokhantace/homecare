<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/9/2016
 * Time: 4:53 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class ScheduleEntryRequest extends Request
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
            "name.required" => "Patient Name is required",
            "date.required" => "Schedule Date is required"

        ];
    }
}
