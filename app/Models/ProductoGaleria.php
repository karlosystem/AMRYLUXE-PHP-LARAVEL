<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoGaleria extends Model
{
    protected $table = 'productos_galeria';
    protected $fillable = ['producto_id', 'imagen', 'orden'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}