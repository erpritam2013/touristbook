<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOtherPackageRequest extends FormRequest
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
               'name' => 'required|max:255|unique_custom:other_packages,name,other_package_type,'.request()->other_package_type.',id,'.request()->id,
            'other_package_type' => 'required',
        ];
    }
}
