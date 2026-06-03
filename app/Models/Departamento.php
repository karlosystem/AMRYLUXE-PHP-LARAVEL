<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    // Especificamos el nombre de la tabla ya que no sigue el plural estándar de Laravel (departamentos)
    protected $table = 'departments';

    // Campos que se pueden llenar mediante asignación masiva (Mass Assignment)
    protected $fillable = [
        'name',
        'code',
        'status',
        'tax_rate',
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     * Esto asegura que 'tax_rate' sea siempre un número decimal y 'status' un entero.
     */
    protected $casts = [
        'tax_rate' => 'decimal:2',
        'status' => 'integer',
    ];

    /**
     * Relación: Un departamento tiene muchas provincias.
     * (Asumiendo que crearás el modelo Provincia después)
     */
    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'department_id');
    }
}