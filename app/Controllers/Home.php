<?php

namespace App\Controllers;

use App\Models\Tarea;

class Home extends BaseController
{
    public function inicio()
    {
        $modeloTarea = new Tarea();
        $data['tareas'] = $modeloTarea->obtenerTareas();
        return view('inicioView', $data);
    }
}
