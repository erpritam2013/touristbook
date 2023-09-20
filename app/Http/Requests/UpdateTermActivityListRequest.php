<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTermActivityListRequest extends FormRequest
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
            'name' => 'required|max:255|unique_custom:term_activity_lists,name,id,'.request()->id,
            //   'name' => 'required|max:255|unique_custom:term_activity_lists,name,term_activity_list_type,'.request()->term_activity_list_type.',id,'.request()->id,
            // 'term_activity_list_type' => 'required',
        ];
    }
}
