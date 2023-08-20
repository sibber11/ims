<?php

namespace App\Services;

use App\Models\Item;
use App\Models\ItemSale;
use App\Models\Order;
use Illuminate\Support\Collection;

class ItemService
{
    static function create(Order $order, array $data): void
    {
        $item = Item::make($data);
        $item->order()->associate($order);
        $item->product()->associate($data['product']['id']);
        $item->brand()->associate($data['brand']['id']);
        $item->supplier()->associate($data['supplier']['id']);
        $item->save();
    }

    static function createMany(Order $order, Collection $items): void
    {
        $items->each(function ($item) use ($order) {
            self::create($order, $item);
        });
//        Item::createMany($items);
    }

    static function getItemProduct(ItemSale $itemSale){
        return Item::whereId($itemSale->product_id)->where('available', '>', 0)->first();
    }
}
