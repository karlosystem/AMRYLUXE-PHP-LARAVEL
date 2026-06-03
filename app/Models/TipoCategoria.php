<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCategoria extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'tipo_categorias';

    // Definir la llave primaria personalizada
    protected $primaryKey = 'p_cat_id';

    protected $fillable = [
        'p_cat_id', 
        'p_cat_name', 
        'p_cat_slug', 
        'p_cat_image', 
        'p_cat_order', 
        'p_cat_description', 
        'p_cat_status'
    ];

    // Si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = false;

}