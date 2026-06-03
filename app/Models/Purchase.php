<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'invoice_number',
        'supplier_id',
        'total_amount',
        'purchase_date',
        'notes',
    ];

    /**
     * Casteo de atributos.
     * Esto asegura que 'purchase_date' se trate como un objeto Carbon/Date.
     */
    protected $casts = [
        'purchase_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Relación: Una compra pertenece a un proveedor.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Relación: Una compra tiene muchos artículos (detalles).
     */
    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }
}