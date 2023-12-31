<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicareAssistanceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
             'name' => 'required|max:255|unique_custom:medicare_assistances,name,medicare_assistance_type,'.request()->medicare_assistance_type,
            'medicare_assistance_type' => 'required',
        ];
    }
}
