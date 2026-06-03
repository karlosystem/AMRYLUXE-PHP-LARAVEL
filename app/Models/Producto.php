<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención, pero seguro ponerlo)
    protected $table = 'productos';

    /**
     * The attributes that are mass assignable.
     * Se agregaron todos los campos de tu estructura SQL para evitar el error de "Mass Assignment"
     */
    protected $fillable = [
        'categoria_id',
        'marca_id',
        'nombre',
        'nombre_seo',
        'slug',
        'codigo',
        'imagen',
        'descripcion',
        'detalles',
        'adicional',
        'orden',
        'precio',
        'precio_regular',
        'recienllegado',
        'mejorvendido',
        'enventa',
        'status',
        'destacado',
        'stock',
        'liquidacion',
        'delivery_duration',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    /**
     * Casts para tipos de datos específicos
     * Esto asegura que Laravel trate los precios como flotantes y los estados como enteros/booleanos
     */
    protected $casts = [
        'precio' => 'float',
        'precio_regular' => 'float',
        'status' => 'integer',
        'destacado' => 'integer',
        'stock' => 'integer',
        'recienllegado' => 'integer',
        'mejorvendido' => 'integer',
        'enventa' => 'integer',
        'liquidacion' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_producto', 'producto_id');
    }

    public function tamanos()
    {
        // Nota: Verifica si la tabla pivote es 'tamano_producto' y la llave foránea es 'tamanos_id'
        return $this->belongsToMany(Tamano::class, 'tamano_producto', 'producto_id', 'tamanos_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    // Relación indirecta con el Tipo (Opcional, pero útil)
    public function tipo()
    {
        return $this->categoria->tipo();
    }


    public function tipoCategoria()
    {
        // Usamos 'categoria_id' porque en tu tabla 'productos' 
        // parece ser la que almacena el ID del tipo (Mujer, Hombre, etc.)
        return $this->belongsTo(TipoCategoria::class, 'categoria_id', 'p_cat_id');
    }


    public function imagenes()
    {
        // Retorna todas las imágenes relacionadas, ordenadas
        return $this->hasMany(ProductoGaleria::class, 'producto_id')->orderBy('orden', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes / Helpers (Opcionales para un código más "Luxe")
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}