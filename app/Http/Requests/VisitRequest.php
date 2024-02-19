<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "vistorname" => 'required',
            'nbvisitors' => 'required|integer|min:1',
            "tel" => 'required|min:8|max:12',
            "emp_id" => ['required',Rules::exist('employees','id')]
        ];
    }
}
