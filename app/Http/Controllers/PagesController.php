<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;
use App\Models\Contactenos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PagesController extends Controller
{
    public function terminosCondiciones()
    {
        $data = Pagina::where('slug', 'terminos-y-condiciones')->first();
        //dd($data);
        return view('front.pages.terms-conditions', compact('data'));
    }

    public function politicasPrivacidad()
    {
        $data = Pagina::where('slug', 'politicas-de-privacidad')->first();
        return view('front.pages.privacy-policy', compact('data'));
    }

    public function acercaDe()
    {
        $data = Pagina::where('slug', 'acerca-de')->first();
        return view('front.pages.about-us', compact('data'));
    }

    public function historia()
    {
        $data = Pagina::where('slug', 'historia')->first();
        return view('front.pages.historia', compact('data'));
    }

    public function tienda()
    {
        $data = Pagina::where('slug', 'tienda')->first();
        return view('front.pages.tienda', compact('data'));
    }

    public function liquidacion()
    {
        $liquidacion = DB::table('productos')->where('status', 1)->where('liquidacion', 1)->get();
        $data = Pagina::where('slug', 'liquidacion-carteras-bolsos')->first();
        return view('front.pages.liquidacion', compact('liquidacion', 'data'));
    }

    public function eventos()
    {
        $data = Pagina::where('slug', 'eventos')->first();
        return view('front.pages.eventos', compact('data'));
    }

    public function clientes()
    {
        $data = Pagina::where('slug', 'clientes')->first();
        return view('front.pages.clientes', compact('data'));
    }

    public function preguntas()
    {
        $preguntas = DB::table('preguntas')->get();
        $data = Pagina::where('slug', 'preguntas')->first();
        return view('front.pages.faq', compact('preguntas', 'data'));
    }



    public function contactenos()
    {
        $data = Pagina::where('slug', 'contactenos')->first();
        return view('front.pages.contact-us', compact('data'));
    }

    public function storeContactenos(Request $request)
    {
        // 1. Validación
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:160',
            'email' => 'required|email|max:100',
            'telefono' => 'required|string|max:15',
            'mensaje' => 'required|string',
        ]);

        // 2. Grabar en Base de Datos
        DB::table('contactenos')->insert([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
            'created_at' => now(),
        ]);

        // 3. Enviar Correo con PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del Servidor
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port       = env('MAIL_PORT');
            $mail->CharSet    = 'UTF-8';

            // Destinatarios
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress(env('MAIL_FROM_ADDRESS')); // Recibes tú el correo
            $mail->addReplyTo($request->email, $request->nombres); // Para responderle al cliente

            // Contenido del Correo
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo Mensaje de Contacto - ' . $request->nombres;

            // Diseño del mensaje (puedes usar HTML/CSS aquí)
            $logoUrl = 'https://www.amryluxe.com/public/front/assets/images/logo.png'; // Ajusta la ruta a tu logo real

            $mail->Body = "
                    <div style='background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif;'>
                        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                            
                            <div style='background-color: #ccc; padding: 30px; text-align: center;'>
                                <img src='{$logoUrl}' alt='Amry Luxe' style='max-width: 180px; height: auto;'>
                                <h2 style='color: #000; margin-top: 15px; font-weight: 300; letter-spacing: 2px;'>NUEVA CONSULTA</h2>
                            </div>

                            <div style='padding: 30px; line-height: 1.6; color: #333333;'>
                                <p style='font-size: 16px;'>Has recibido un nuevo mensaje a través del formulario de contacto de tu sitio web.</p>
                                
                                <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>
                                    <tr>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee; font-weight: bold; width: 30%;'>Cliente:</td>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee;'>{$request->nombres} {$request->apellidos}</td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee; font-weight: bold;'>Email:</td>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee;'><a href='mailto:{$request->email}' style='color: #ea5455; text-decoration: none;'>{$request->email}</a></td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee; font-weight: bold;'>Teléfono:</td>
                                        <td style='padding: 10px; border-bottom: 1px solid #eeeeee;'>{$request->telefono}</td>
                                    </tr>
                                </table>

                                <div style='background-color: #f9f9f9; padding: 20px; border-radius: 5px; border-left: 4px solid #1a202c;'>
                                    <strong style='display: block; margin-bottom: 10px;'>Mensaje del cliente:</strong>
                                    <p style='margin: 0; font-style: italic;'>\"{$request->mensaje}\"</p>
                                </div>
                                
                                <div style='margin-top: 30px; text-align: center;'>
                                    <a href='mailto:{$request->email}' style='background-color: #ea5455; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>RESPONDER AHORA</a>
                                </div>
                            </div>

                            <div style='background-color: #f1f1f1; padding: 20px; text-align: center; font-size: 12px; color: #777777;'>
                                <p style='margin: 0;'>Este es un mensaje automático generado por el sistema de Amry Luxe.<br>
                                © 2026 Amry Luxe - Especialistas en Carteras y Bolsos de Cuero.</p>
                            </div>
                        </div>
                    </div>
                    ";

            $mail->send();

            return redirect()->back()->with('success', 'Mensaje enviado y registrado con éxito.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => "El mensaje se guardó pero no se pudo enviar el correo. Error: {$mail->ErrorInfo}"]);
        }
    }
}
