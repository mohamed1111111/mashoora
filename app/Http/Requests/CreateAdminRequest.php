<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
          'email' => 'required|string|email|max:255|unique:users',
          'phone_number' => 'required_without:email|regex:/(01)[0-9]{9}/|unique:users',

          'password' => 'min:6|required|same:confirm_password',
          'confirm_password' => 'required|min:6',
        ];
    }
}
