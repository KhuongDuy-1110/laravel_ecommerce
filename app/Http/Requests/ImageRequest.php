<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|mimes:jpeg,jpg,png|max:5000|dimensions:min_width=1837,min_height=700',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'An image is required !',
            'image.mimes' => 'This extension of image is not supported !',
            'image.max' => "This image's size is too large",
            'image.dimensions' => 'This dimensions is required at least at 1837px.700px !'
        ];
    }
}
