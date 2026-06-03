<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
     use HasFactory;

    // Vinculamos con la tabla 'districts'
    protected $table = 'districts';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'department_id',
        'province_id',
        'name',
        'status',
    ];

    /**
     * Casts de tipos de datos.
     */
    protected $casts = [
        'status' => 'integer',
        'department_id' => 'integer',
        'province_id' => 'integer',
    ];

    /**
     * Relación: Un Distrito pertenece a una Provincia.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'province_id');
    }

    /**
     * Relación: Un Distrito también pertenece a un Departamento.
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'department_id');
    }
}