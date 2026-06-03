<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamaciones extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla (opcional si coincide con el plural del modelo)
    protected $table = 'reclamaciones';

    // Laravel por defecto usa 'id' como llave primaria, pero especificamos si es necesario
    protected $primaryKey = 'id';

    /**
     * Los atributos que se pueden asignar de manera masiva (Mass Assignment).
     * He incluido todos los campos de tu SQL más los timestamps.
     */
    protected $fillable = [
        'ingreso',
        'estado',
        'nombres',
        'apellidos',
        'email',
        'tipo_documento',
        'nro_documento',
        'telefono',
        'departamento',
        'provincia',
        'distrito',
        'tipo_reclamo',
        'calle',
        'menor_edad',
        'bien_contratado',
        'monto',
        'descripcion_producto',
        'fecha_problema',
        'detalle_problema',
        'pedido_vendedor',
        // Campos de fecha solicitados:
        'created_at',
        'updated_at'
    ];

    /**
     * Habilitamos los timestamps automáticos de Laravel.
     * Esto gestionará automáticamente created_at y updated_at.
     */
    public $timestamps = true;

    /**
     * Si deseas que el campo 'ingreso' se trate como una instancia de Carbon (fecha)
     */
    protected $casts = [
        'ingreso' => 'datetime',
        'estado' => 'integer',
    ];
}