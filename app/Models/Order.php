<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    const TYPE_PURCHASE = 1;
    const TYPE_SALE = 2;
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

    protected $attributes = [
        'status' => 1,
    ];

    protected $casts = [
        'type' => 'integer',
        'status' => 'integer',
        'sub_total' => 'float',
        'item_discount' => 'float',
        'tax' => 'float',
        'shipping' => 'float',
        'total' => 'float',
        'promo' => 'float',
        'promo_discount' => 'float',
        'grand_total' => 'float',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    /*
     * Relationships
     */

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function calculate(Collection $items)
    {
        $this->sub_total = $items->reduce(function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity_received']);
        }, 0);
        $this->item_discount = $items->reduce(function ($carry, $item) {
            return $carry + ($item['discount'] * $item['quantity_received']);
        }, 0);
        $this->total = $this->sub_total - $this->item_discount;
        $this->grand_total = $this->total + $this->tax + $this->shipping;
    }
}
