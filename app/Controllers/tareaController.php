<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Subtarea;  

class tareaController extends BaseController{
    
    
    public function mostrarDetalles(){
        $modeloTarea = new Tarea();
        $modeloSubTarea = new Subtarea();
        $idTarea = $this->request->getPost('tarea_id');
        $data['tarea'] = $modeloTarea->obtenerTarea($idTarea);
        $data['subTareas'] = $modeloSubTarea->obtenerSubTareas($idTarea);
        return view('tareaView', $data);
    }

    
}
