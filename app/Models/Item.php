<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected $attributes = [
        'retail_price' => 0,
        'discount' => 0,
        'price' => 0,
        'quantity_received' => 0,
        'sold' => 0,
        'available' => 0,
        'defective' => 0,
    ];
    protected static function boot()
    {
        parent::boot();

        // skip event when seeding
        if (app()->runningInConsole())
            return;

        static::creating(function (self $item) {
            $item->created_by = auth()->user()->id;
            $item->updated_by = auth()->user()->id;
            $item->stock = $item->quantity_received;
            $item->available = $item->quantity_received;
        });

        static ::updating(function ($item) {
            $item->updated_by = auth()->user()->id;
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by','id');
    }
}
