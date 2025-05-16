<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController extends BaseController{
    
    public function iniciarSession()
    {
        return view('iniciarSesionView');
    }
    
    public function autenticar()
{
    $usuario = $this->request->getPost('usuario');
    $clave   = hash('sha256', $this->request->getPost('clave'));

    $modeloUsuario = new Usuario();
    $datosUsuario = $modeloUsuario->verificarCredenciales($usuario, $clave);

    if ($datosUsuario) {
        session()->set([
            'usuario_id'      => $datosUsuario['id'],
            'nombre_usuario'  => $datosUsuario['nombre_usuario'],
            'logueado'        => true
        ]);
        return redirect()->to('/');
    } else {
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Usuario o contraseña incorrectos');
    }
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    
}
