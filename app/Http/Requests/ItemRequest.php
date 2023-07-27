<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'stock' => ['required'],
            'retail_price' => ['required'],
            'discount' => ['required'],
            'price' => ['required'],
            'quantity_received' => ['required'],
            'sold' => ['required'],
            'available' => ['required'],
            'defective' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
