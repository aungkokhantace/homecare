<?php

namespace App\CSVImport\Form;

use App\Http\Requests\Request;

class CSVImportRequest extends Request
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
            "table_name" => "required",
            "csv_file" => "required",
        ];
    }

    public function messages()
    {
        return [
            "table_name.required" => "Table Name is required!",
            "csv_file.required" => "CSV file is required!",
        ];
    }
}
