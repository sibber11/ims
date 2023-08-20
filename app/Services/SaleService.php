<?php

namespace App\Services;

use App\Models\ItemSale;
use App\Models\Sale;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleService
{
    static function create($item){
        DB::beginTransaction();
        $sale = new Sale();
        $sale->notes = $item['notes'];
        // get the id of the payment method
        $payment_method =  array_search($item['payment_method'], Sale::PAYMENT_METHODS);
        if (!$payment_method) {
            throw new Exception('Payment method not found. Add the method to Sale::PAYMENT_METHODS');
        }
        $sale->payment_method = $payment_method;
        $sale->payment_status = 0;
        $sale->change_given = 0;
        $sale->seller()->associate(Auth::id());
        $sale->save();
        $items = collect();
        foreach ($item['items'] as $value) {
            $saleItem = ItemSale::make($value);
            $saleItem->product()->associate($value['product']['id']);
            $saleItem->sale()->associate($sale);
            $saleItem->item()->associate(ItemService::getItemProduct($saleItem));
            $items->add($saleItem);
        }
        $sale->items()->saveMany($items);
        $sale->calc();
        $sale->save();
        DB::commit();
        return $sale;
    }
}
