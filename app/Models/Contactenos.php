<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactenos extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'contactenos';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'mensaje',
    ];

    /**
     * Indicamos que use los timestamps automáticos de Laravel.
     * @var bool
     */
    public $timestamps = true;

    /**
     * Opcional: Si quieres realizar alguna limpieza de datos antes de guardar
     * (por ejemplo, poner los nombres en mayúsculas).
     */
    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = mb_strtoupper($value);
    }
}