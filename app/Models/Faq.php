<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'preguntas';
    protected $fillable = ['id','pregunta', 'respuesta', 'status', 'created_at', 'updated_at'];
}
