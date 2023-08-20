<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes, HasFactory;

    const PAYMENT_METHODS = [
        1 => 'Cash',
//        2 => 'Credit Card',
//        3 => 'Debit Card',
//        4 => 'Paypal',
//        5 => 'Stripe',
//        6 => 'Google Pay',
//        7 => 'Apple Pay',
        9 => 'BKash',
        10 => 'Nagad',
        11 => 'Rocket',
        8 => 'Other',

    ];

    static function getPaymentMethods(){
        return collect(self::PAYMENT_METHODS)->map(function ($item, $key) {
            return ['id' => $key, 'label' => $item];
        })->values()->toArray();
    }

    protected $fillable = [
        'total_amount',
        'sub_total',
        'payment_method',
        'payment_status',
        'change_given',
        'notes',
    ];

    protected $attributes = [
        'sub_total' => 0,
        'total_amount' => 0
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    function calc() {
        $total = $this->items->reduce(function($total, $item){
            $total += $item->price;

            return $total;
        }, 0);
        $this->total_amount = $total;
        $this->sub_total = 90;
    }

    public function items(){
        return $this->hasMany(ItemSale::class);
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }
}
