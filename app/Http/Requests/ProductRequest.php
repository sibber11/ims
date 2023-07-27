<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'summary' => ['required'],
            'type' => ['required', 'integer'],
            'content' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
