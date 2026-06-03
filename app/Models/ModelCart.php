<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCart extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'cover_image', 'description', 'status', 'user_id'];
}
