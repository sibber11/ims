<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use SoftDeletes, HasFactory, NodeTrait;

    protected $fillable = [
        'title',
        'meta_title',
        'content',
        'slug',
    ];
}
