<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Colaboracion;  

class ColaboracionController extends BaseController{
    
    public function mostrarDetalles(){
        $modeloTarea = new Tarea();
        $modeloSubTarea = new Colaboracion();

        //Importante cambiar el usuario fijo de prueba
        $id_user = 3;
        //cambiar por usuario de session

        $idTarea = $this->request->getPost('tarea_id');
        $data['tarea'] = $modeloTarea->obtenerTarea($idTarea);
        $data['subTareas'] = $modeloSubTarea->obtenerSubTareas($idTarea);
        return view('tareaView', $data);
    }

    
}
