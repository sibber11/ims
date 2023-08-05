<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'meta_title' => ['nullable'],
            'content' => ['nullable'],
            'slug' => ['nullable'],
            'parent_id' => ['nullable', 'exists:'.Category::class]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
