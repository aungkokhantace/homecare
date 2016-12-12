<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/6/2016
 * Time: 5:52 PM
 */


namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class RouteEntryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" =>"required"
        ];
    }

    public function messages(){
        return [
            "name.required" => "Route Name is required"
        ];
    }
}
