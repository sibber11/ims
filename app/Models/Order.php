<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'type',
        'status',
        'sub_total',
        'item_discount',
        'tax',
        'shipping',
        'total',
        'promo',
        'promo_discount',
        'grand_total',
        'content',
    ];
}
