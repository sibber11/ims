<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'summary' => ['required'],
            'content' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
