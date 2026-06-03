<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = ['titulo', 'subtitulo', 'descripcion', 'imagen', 'link', 'status'];
}
