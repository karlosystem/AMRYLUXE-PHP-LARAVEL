<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'configuracion';

    // Definir la llave primaria personalizada
    protected $primaryKey = 'id';

    // Campos habilitados para asignación masiva
    protected $fillable = [
        'nombre_web',
        'logo',
        'logofooter',
        'favicon',
        'direccion',
        'telefono',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'tiktok',
        'wasap',
        'instagram',
        'copyright',
        'mapa_iframe',
        'meta_title',
        'meta_descripcion',
        'meta_keywords',
        'og_imagen'
    ];

    // Laravel gestionará automáticamente created_at y updated_at
    public $timestamps = true;
}