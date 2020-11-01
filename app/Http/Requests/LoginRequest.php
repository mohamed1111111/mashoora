<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            // 'email' => 'required_without:phone_number|string|email|max:255',
            // 'phone_number'=> 'required_without:email|regex:/(01)[0-9]{9}/',
            // 'password' => 'min:6|required',

        ];
    }
}
