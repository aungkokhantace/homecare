<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 1:08 PM
 */
namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class CityEntryRequest extends Request
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
            "name.required" => "City Name is required"

        ];
    }
}
