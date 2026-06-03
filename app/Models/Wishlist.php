<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = ['producto_id', 'user_id'];

    public function product(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}


