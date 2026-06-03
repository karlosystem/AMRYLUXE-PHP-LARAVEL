<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Producto;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'color',
        'thumb',
        'size',
        'quantity',
        'price',
        'total',
    ];  

    /**
     * Relación con Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    /**
     * Relación con Product
     */
    public function product()
    {
        return $this->belongsTo(Producto::class);
    }


}
