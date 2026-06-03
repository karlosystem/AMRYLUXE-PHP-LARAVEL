<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     * @var string
     */
    protected $table = 'gateways';

    /**
     * Los atributos que son asignables masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'credentials',
        'status',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * Esto permite manejar el campo JSON como un array de PHP automáticamente.
     * @var array
     */
    protected $casts = [
        'credentials' => 'array',
        'status' => 'integer',
    ];
}