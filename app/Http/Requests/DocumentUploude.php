<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUploude extends FormRequest
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
          'id_front' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
          'id_back' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
          'certificate' => 'required|mimes:doc,docx,pdf,txt',

        ];
    }
}
