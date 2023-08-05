<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Category */
class CategoryResourceIndex extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'label' => $this->title,
            'meta_title' => $this->meta_title,
            'content' => $this->content,
            'slug' => $this->slug
        ];
    }
}
