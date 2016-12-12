<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/12/2016
 * Time: 4:50 PM
 */

namespace App\Backend\Infrastructure\Forms;
use App\Http\Requests\Request;

class ProvisionaldiagnosisEditRequest extends Request
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
            "name" =>"required",
        ];
    }

    public function messages(){
        return [
            "name.required" => "Provisional Diagnosis Name is required",
        ];
    }
}
