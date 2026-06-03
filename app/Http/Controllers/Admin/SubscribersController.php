<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    // Show all
    public function index()
    {
        $subscribers = DB::table('subscribers')->latest()->get();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        DB::table('subscribers')->where('id', $id)->delete();
        return redirect()->route('admin.subscribers.index')->with('success', 'Subscribers eliminado con exito');
    }

}