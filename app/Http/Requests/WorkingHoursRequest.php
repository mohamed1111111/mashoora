<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkingHoursRequest extends FormRequest
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
          'day' => 'required|string|max:25',
          'from' => 'required|string|max:25',
          'to' => 'required|string|max:25',
        ];
    }
}
