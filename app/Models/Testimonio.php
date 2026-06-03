<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'testimonios';

    // Definir la llave primaria personalizada
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'cargo', 
        'imagen', 
        'comentario', 
        'status'
    ];

    // Si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = true;

}