<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'stock',
        'retail_price',
        'discount',
        'price',
        'quantity_received',
        'sold',
        'available',
        'defective',
    ];
}
