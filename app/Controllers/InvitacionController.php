<?php

namespace App\Controllers;

use App\Models\Invitacion;

class invitacionController extends BaseController
{
    public function enviarCorreo()
{
    $correo = $this->request->getPost('correo');
    $tarea_id = $this->request->getPost('tarea_id');
    $usuarioId = session()->get('id_usuario');
    $modeloInvitacion = new Invitacion();
    $codigo = $modeloInvitacion->obtenerCodigo($correo, $tarea_id);
    $tareaCtrl = new \App\Controllers\tareaController();
    session()->setFlashdata('tarea_id', $tarea_id);

    $email = \Config\Services::email();

    $email->setTo($correo);
    $email->setSubject('📩 Invitación para colaborar en una tarea de MiTareas');
    $email->setMailType('html'); 

$email->setMessage("
    <h2 style='color:#FFA600;'>¡Has recibido una invitación!</h2>
    <p>Hola,</p>
    <p>Te han invitado a colaborar en una tarea dentro de la plataforma <strong>PickTask</strong>. Para unirte, simplemente ingresa el siguiente código en la sección <em>“Colaborar”</em>:</p>
    
    <div style='padding: 10px; background-color: #f4f4f4; border-left: 5px solid #FFA600; margin: 20px 0; font-size: 1.3em;'>
        <strong>Código de invitación:</strong> <span style='color:#333;'>$codigo</span>
    </div>

    <p>Este código es único y tiene validez por tiempo limitado.</p>
    <p style='margin-top: 20px;'>¡Esperamos contar contigo!</p>
    <hr>
    <p style='font-size: 0.9em; color: #888;'>Este correo fue generado automáticamente por el sistema MiTareas. Por favor, no respondas a este mensaje.</p>
");


    if ($email->send()) {
            echo "<script>alert('✅ Correo enviado correctamente');</script>";
        } else {
            echo "<script>alert('❌ Error al enviar el correo');</script>";
        }
        return $tareaCtrl->mostrarDetalles();
}

public function IniciarColaboracion()
{
    $codigo = $this->request->getPost('codigo');

    if (!$codigo) {
        return redirect()->back()->with('error', 'Código no enviado.');
    }

    $modeloInvitacion = new \App\Models\Invitacion();
    $modeloColaboracion = new \App\Models\Colaboracion();

    $invitacion = $modeloInvitacion->obtenerPorCodigo($codigo);

    if (!$invitacion) {
        return redirect()->back()->with('error', 'Código inválido.');
    }

    if ($invitacion['estado'] !== 'pendiente') {
        return redirect()->back()->with('error', 'Esta invitación ya fue usada o cancelada.');
    }

    // Verifica sesión activa
    $usuarioId = session()->get('id_usuario');
    $correoSesion = session()->get('correo');

    if (!$usuarioId || !$correoSesion) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para colaborar.');
    }

    if (strtolower($correoSesion) !== strtolower($invitacion['correo'])) {
        return redirect()->back()->with('error', 'Este código no corresponde a tu correo.');
    }

    $modeloColaboracion->agregarColaboracion($invitacion['tarea_id'], $usuarioId);

    $modeloInvitacion->marcarComoAceptada($codigo);

    session()->setFlashdata('tarea_id', $invitacion['tarea_id']);
    return redirect()->to('/')->with('success', '¡Te uniste correctamente a la tarea!');
}

}





