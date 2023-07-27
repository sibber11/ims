<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'last_login',
        'intro',
        'profile',
    ];

    protected $casts = [
        'last_login' => 'datetime',
    ];
}
