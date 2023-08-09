<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdLabelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd($this->title);
        return [
            'id' => $this->id,
            'label' => $this->title ?? $this->username ?? $this->name ?? $this->email ?? $this->label ?? $this->id,
        ];
    }
}
