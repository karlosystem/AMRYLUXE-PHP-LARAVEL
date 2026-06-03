<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DrewM\MailChimp\MailChimp;

class SubscribersController extends Controller
{

    public function store(Request $request)
    {
        // 1. Validación inicial (Evita duplicados antes de tocar la base de datos)
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ], [
            'email.unique' => 'Este correo ya se encuentra suscrito a nuestro boletín.'
        ]);

        try {
            // 2. Intentar registro en Base de Datos Local
            $subscriber = Subscriber::create([
                'email' => $request->email,
            ]);

            // 3. Intento de suscripción a Mailchimp
            $apiKey = env('MAILCHIMP_API_KEY');
            $listId = env('MAILCHIMP_LIST_ID');

            // Validamos que existan las credenciales para evitar excepciones innecesarias
            if ($apiKey && $listId) {
                $mailchimp = new MailChimp($apiKey);

                $result = $mailchimp->post("lists/$listId/members", [
                    'email_address' => $request->email,
                    'status'        => 'pending',
                ]);

                // Si Mailchimp falla (por ejemplo, el correo estaba en la papelera de Mailchimp)
                if (!$mailchimp->success()) {
                    Log::warning("Mailchimp Error: " . $mailchimp->getLastError());
                    // No retornamos error al usuario porque ya se guardó en nuestra DB local
                }
            }

            return redirect()->back()->with('success', '¡Excelente! Te has suscrito correctamente a Amry Luxe.');
        } catch (\Exception $e) {
            // 4. Captura de errores críticos (DB caída, error de servidor, etc.)
            Log::error("Error en suscripción: " . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Lo sentimos, hubo un problema técnico. Inténtalo más tarde.']);
        }
    }
}
