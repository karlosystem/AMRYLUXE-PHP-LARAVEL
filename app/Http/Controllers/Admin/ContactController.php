<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show all contact records
    public function index()
    {
        $contacts = DB::table('contactenos')->latest()->get();
        return view('admin.contactenos.index', compact('contacts'));
    }

    // Show single contact detail
    public function show($id)
    {
        $contact = DB::table('contactenos')->where('id', $id)->first();

        if (!$contact) {
            return redirect()->route('admin.contactenos.index')->with('error', 'Contact not found.');
        }

        return view('admin.contactenos.show', compact('contact'));
    }

    // Delete a contact
    public function destroy($id)
    {
        DB::table('contactenos')->where('id', $id)->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contacto eliminado con exito');
    }

}
