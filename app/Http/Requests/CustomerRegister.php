<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegister extends FormRequest
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
            'name' => 'required',
            'email' => 'required_without:phone_number|string|email|max:255|unique:users',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
            'gender'=> 'required',
            'social_states'=> 'required',
            'phone_number'=> 'required_without:email|regex:/(01)[0-9]{9}/|unique:users',
            'date_of_birth' => 'required|before:today',
        ];
    }
}
