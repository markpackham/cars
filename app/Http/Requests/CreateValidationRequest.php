<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationRequest extends FormRequest
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
        // max size for the image is in kilobytes
        return [
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'name' => 'required',
            'founded' => 'required|integer|min:0|max:2022',
            'description' => 'required',
        ];
    }
}
