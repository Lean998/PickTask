<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'correo', 'contrasenia'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function verificarCredenciales($usuario, $clave)
    {
        return $this->where([
            'nombre_usuario' => $usuario,
            'contrasena'     => $clave
        ])->first();
    }
}
