<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class BookingEntryRequest extends Request
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
            "date" =>"required",
            "time" =>"required",
        ];
    }

    public function messages(){
        return [
            "date.required" => "Date is required",
            "time.required" => "Time is required",
        ];
    }
}
