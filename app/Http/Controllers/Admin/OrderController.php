<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf; // Importar la fachada


class OrderController extends Controller
{
    public function index()
    {
        // Cargamos las órdenes con sus ítems, ordenadas por la más reciente
        $ordenes = Order::with('orderItems')->orderBy('id', 'desc')->get();
        return view('admin.ordenes.index', compact('ordenes'));
    }

    public function transacciones($id)
    {
        // Cargamos las órdenes con sus ítems, ordenadas por la más reciente
        $transacciones = Order::latest()->get();
        return view('admin.transacciones.index', compact('transacciones'));
    }


    public function show($id)
    {
        // Buscamos la orden con sus productos o lanzamos 404 si no existe
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.ordenes.show', compact('order'));
    }

    public function generatePDF($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        // Cargamos una vista específica para el PDF
        $pdf = Pdf::loadView('admin.ordenes.pdf', compact('order'));

        // Retorna el PDF para descargar o ver en el navegador
        return $pdf->download('Guia-Despacho-' . $order->order_number . '.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,canceled',
            'tracking_number' => 'nullable|string|max:100' // Validamos el tracking
        ]);

        $order = Order::findOrFail($id);
        $data = ['order_status' => $request->order_status];
        // Si se envía un número de seguimiento, lo agregamos al update
        if ($request->has('tracking_number')) {
            $data['tracking_number'] = $request->tracking_number;
        }
        $order->update($data);
        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}
