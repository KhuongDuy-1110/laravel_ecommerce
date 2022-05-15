<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'price' =>  'required',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }
    
}
