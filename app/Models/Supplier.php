<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     * (Opcional si tu tabla se llama 'suppliers')
     */
    protected $table = 'suppliers';

    /**
     * Los atributos que se pueden asignar masivamente.
     * Basado en la captura SQL: name, email, phone, address.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Relación: Un proveedor tiene muchas compras.
     * Vincula este modelo con la tabla 'purchases'.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'id');
    }
}