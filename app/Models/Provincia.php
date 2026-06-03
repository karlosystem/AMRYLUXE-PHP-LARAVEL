<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    // Vinculamos con la tabla 'provinces'
    protected $table = 'provinces';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'department_id',
        'name',
        'status',
        'shipping_charge',
    ];

    /**
     * Casts de tipos de datos.
     * Importante: 'shipping_charge' como decimal para cálculos de envío exactos.
     */
    protected $casts = [
        'shipping_charge' => 'decimal:2',
        'status' => 'integer',
        'department_id' => 'integer',
    ];

    /**
     * Relación: Una Provincia pertenece a un Departamento.
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'department_id');
    }

    /**
     * Relación: Una Provincia tiene muchos Distritos.
     * (Preparado para cuando crees el modelo Distrito)
     */
    public function distritos()
    {
        return $this->hasMany(Distrito::class, 'province_id');
    }
}