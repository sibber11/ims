<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'line_1',
        'line_2',
        'city',
        'province',
        'country',
    ];
}
