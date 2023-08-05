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

    protected $with = [
        'creator',
        'updater'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'id');
    }

    public function updater() {
        return $this->belongsTo(User::class, 'id');
    }
}
