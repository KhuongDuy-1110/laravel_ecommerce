<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:15|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'A name is required for this category',
            'name.max' => 'Name of your category too long',
            'name.string' => 'Name of your category must be string',
        ];
    }
}
