<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'username'     => 'required',
            'universityId' => 'required|numeric|exists:universities,id',
            'speciality'   => 'required',
            'fullname'     => 'required|min:5',
            'sex'          => 'required',
            'phone-number' => 'required|numeric',
            'birthday'     => 'required|date|date_format:Y-m-d',
//            'avatar'       => 'mimes:jpeg,jpg,png'
        ];
    }
}
