<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function login()
    {
        helper(['form']);
        return view('iniciarSesionView');
    }

    public function editarView()
    {
        $session = session();
        $usuarioId = $session->get('id_usuario');

        $modelo = new Usuario();
        $usuario = $modelo->find($usuarioId);

        return view('editar', ['usuario' => $usuario]);
    }

    public function editarGuardar()
{
    $session = session();
    $usuarioId = $session->get('id_usuario');

    $modelo = new Usuario();

    $modelo->update($usuarioId, [
        'nombre' => $this->request->getPost('nombre'),
        'correo' => $this->request->getPost('correo'),
        'contrasenia' => hash('sha256', $this->request->getPost('contrasenia')),
    ]);

    return redirect()->to('/')->with('mensaje', 'Perfil actualizado con éxito.');
}

    public function autenticar()
    {
        $correo = $this->request->getPost('correo'); 
        $clave = $this->request->getPost('clave'); 

        $model = new Usuario();
        $usuario = $model->where('correo', $correo)->first();

        $hashedPassword = hash('sha256', $clave);

        if ($usuario && $hashedPassword === $usuario['contrasenia']) {
            session()->set([
                'id_usuario' => $usuario['id'],
                'nombre'     => $usuario['nombre'],
                'correo'     => $usuario['correo'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Correo o contraseña incorrectos');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function registrarse()
    {
        helper(['form']);
        return view('registro');
    }

    public function guardarRegistro()
    {
        helper(['form']);

        $data = [
            'nombre'     => $this->request->getPost('nombre'),
            'correo'     => $this->request->getPost('correo'),
            'contrasenia' => hash('sha256', $this->request->getPost('clave'))
        ];

        $model = new Usuario();
        $model->insert($data);

        return redirect()->to('/login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
