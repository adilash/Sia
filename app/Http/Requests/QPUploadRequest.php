<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QPUploadRequest extends FormRequest
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
            'Department' => 'required',
            'Course' => 'required',
            'Programme' => 'required',
            'TType' => 'required',
            'year' => 'required',
            'file' => 'required',
            'email' => 'required'
            //
        ];
    }
}
