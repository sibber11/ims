<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Collection;

class ItemService
{
    public static function create(Order $order, array $data): void
    {
        $item = Item::make($data);
        $item->order()->associate($order);
        $item->product()->associate($data['product_id']);
        $item->brand()->associate($data['brand_id']);
        $item->supplier()->associate($data['supplier_id']);
        $item->save();
    }

    public static function createMany(Order $order, Collection $items): void
    {
        $items->each(function ($item) use ($order) {
            self::create($order, $item);
        });
//        Item::createMany($items);
    }
}
