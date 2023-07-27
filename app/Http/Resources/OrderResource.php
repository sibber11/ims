<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'sub_total' => $this->sub_total,
            'item_discount' => $this->item_discount,
            'tax' => $this->tax,
            'shipping' => $this->shipping,
            'total' => $this->total,
            'promo' => $this->promo,
            'promo_discount' => $this->promo_discount,
            'grand_total' => $this->grand_total,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
