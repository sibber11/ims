<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'type',
        'content',
    ];

    public function availableItem(){
        return $this->hasOne(Item::class)->where('available', '>', 0)->oldestOfMany();
    }

    function items() {
        return $this->hasMany(Item::class);
    }
}
