<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required','string', 'max:255'],
            'summary' => ['required','string', 'max:255'],
            'type' => ['required', 'integer'],
            'content' => ['required','string', 'max:255'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
