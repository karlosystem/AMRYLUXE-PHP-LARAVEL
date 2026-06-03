<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Producto;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $table = 'purchase_items';

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'purchase_price',
        'subtotal',
    ];

    /**
     * Casteo de atributos para asegurar precisión numérica.
     */
    protected $casts = [
        'quantity' => 'integer',
        'purchase_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relación: Un ítem de compra pertenece a una compra (Cabecera).
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    /**
     * Relación: Un ítem de compra pertenece a un producto.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }
}