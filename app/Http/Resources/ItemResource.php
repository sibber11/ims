<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Item */
class ItemResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'stock' => $this->stock,
            'retail_price' => $this->retail_price,
            'discount' => $this->discount,
            'price' => $this->price,
            'quantity_recieved' => $this->quantity_recieved,
            'sold' => $this->sold,
            'available' => $this->available,
            'defective' => $this->defective,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
