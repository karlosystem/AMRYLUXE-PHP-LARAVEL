<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\File;

class FaqController extends Controller
{
    // Show all
    public function index()
    {
        $faqs = DB::table('preguntas')->latest()->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario
        $request->validate([
            'pregunta'       => 'required|string|max:255',
            'respuesta'    => 'required|string|max:255',
        ]);

      
        // 3. Creamos el registro en la base de datos usando el modelo Slider
        Faq::create([
            'pregunta'       => $request->pregunta,
            'respuesta'    => $request->respuesta
        ]);

        // Redireccionamos con un mensaje de éxito
        return redirect()->route('admin.faq.index')->with('success', 'F.A.Q. creado correctamente.');
    }

     public function edit($id)
    {
        // Buscamos el banner por ID o fallamos si no existe
        $faq = Faq::findOrFail($id);
        // Retornamos la vista con los datos del banner
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        // 1. Validamos los datos. La imagen es 'nullable' porque puede no cambiarse
        $request->validate([
            'pregunta'      => 'required|string|max:255',
            'respuesta'   => 'required|string|max:255'
        ]);

        // 4. Actualizamos el modelo con los nuevos datos
        $faq->update([
            'pregunta'      => $request->pregunta,
            'respuesta'   => $request->respuesta,
        ]);

        // 5. Redirección con mensaje de éxito
        return redirect()->route('admin.faq.index')->with('success', 'F.A.Q. actualizado correctamente.');
    }


    public function destroy($id)
    {
        // 1. Buscamos el banner por su ID
        $faq = Faq::findOrFail($id);

        // 4. Eliminamos el registro de la base de datos
        $faq->delete();

        // 5. Redireccionamos con mensaje de éxito
        return redirect()->route('admin.faq.index')->with('success', 'F.A.Q. eliminado con éxito.');
    }

}