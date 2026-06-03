<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'id', 
        'name', 
        'email', 
        'password',
        'image',
        'status',
        'email_verified_at'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];
}