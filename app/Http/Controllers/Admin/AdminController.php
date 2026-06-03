<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validación
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'   => 'required|integer'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        // 2. Procesar Imagen en la ruta específica
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'admin-' . time() . '.' . $file->getClientOriginalExtension();

            // Ruta: public/front/assets/images/admin
            $destinationPath = 'front/assets/images/admin';
            $file->move(public_path($destinationPath), $filename);

            // Guardamos la ruta en la BD para que asset() la encuentre
            $data['image'] = $destinationPath . '/' . $filename;
        } else {
            // Imagen por defecto si no sube una
            $data['image'] = 'backend/image/default-user.png';
        }

        // 3. Crear el registro
        // Nota: Asegúrate de que el ID no sea manual si es autoincremental en tu BD
        Admin::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Administrador creado correctamente.');
    }


    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // 1. Validación (ignorando el email del usuario actual)
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'   => 'required|integer'
        ]);

        $data = $request->except(['password', 'image']);

        // 2. Lógica de Contraseña
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // 3. Lógica de Imagen
        if ($request->hasFile('image')) {
            // Borrar imagen anterior si existe y no es la default
            $oldImagePath = public_path($admin->image);
            if (File::exists($oldImagePath) && $admin->image != 'backend/image/default-user.png') {
                File::delete($oldImagePath);
            }

            $file = $request->file('image');
            $filename = 'admin-' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'front/assets/images/admin';
            $file->move(public_path($destinationPath), $filename);

            $data['image'] = $destinationPath . '/' . $filename;
        }

        $admin->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Administrador actualizado con éxito.');
    }

    public function destroy($id)
    {
        // 1. Verificar que no se esté eliminando a sí mismo
        if (auth()->guard('admin')->user()->id == $id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        $admin = Admin::findOrFail($id);

        // 2. Ruta de la imagen (basada en tu ruta específica)
        // Nota: Guardamos en public/front/assets/images/admin
        $imagePath = public_path($admin->image);

        // 3. Eliminar la imagen física si existe y no es la default
        if (File::exists($imagePath) && $admin->image != 'backend/image/default-user.png') {
            File::delete($imagePath);
        }

        // 4. Eliminar el registro de la base de datos
        $admin->delete();

        return redirect()->route('admin.users.index')->with('success', 'El administrador ha sido eliminado correctamente.');
    }
}
