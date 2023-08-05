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
            'quantity_received' => $this->quantity_received,
            'sold' => $this->sold,
            'available' => $this->available,
            'defective' => $this->defective,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product_id' => $this->product_id,
            'brand_id' => $this->brand_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'created_by' => $this->creator->username,
            'updated_by' => $this->updater->username,
        ];
    }
}
