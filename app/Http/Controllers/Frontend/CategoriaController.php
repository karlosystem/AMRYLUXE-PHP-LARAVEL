<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Pagina;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function index(){
        $data = Pagina::where('slug', 'categorias')->first();
        $categorias = Categoria::all();
        return view('front.pages.categorias', compact('categorias', 'data'));
    }
}
