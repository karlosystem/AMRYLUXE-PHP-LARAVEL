<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_id', 'nombre', 'nombre_seo', 'slug', 'orden', 'imagen', 'descripcion', 'adicional', 'meta_title', 'meta_description', 'meta_keywords', 'count_prod', 'status', 'destacado'];

    public function productos() {
        return $this->hasMany(Producto::class, 'categoria_id');
    }

    // app/Models/Categoria.php
    public function tipo()
    {
        // tipo_id en 'categorias' apunta a p_cat_id en 'tipo_categorias'
        return $this->belongsTo(TipoCategoria::class, 'tipo_id', 'p_cat_id');
    }

    // Asegúrate de que esto NO esté en false
    public $timestamps = true;

}
