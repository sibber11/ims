<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductMetaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => ['required', 'integer'],
            'key' => ['required'],
            'content' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
