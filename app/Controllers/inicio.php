<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\MiembroSubtarea;
use App\Models\Colaboracion;
use CodeIgniter\I18n\Time;

class inicio extends BaseController
{
    public function inicio()
{
    $session = session();
    $usuarioId = $session->get('id_usuario');

    if (!$usuarioId) {
        return redirect()->to('/login');
    }

    $modeloTarea = new Tarea();
    $modeloMiembroSub = new MiembroSubtarea();
    $modeloColaboracion = new Colaboracion();

    $tareasResponsable = [];
    $subTareasResponsable = [];
    $usuariosResponsablesSub = [];

    $TodosUsuariosSubTarea = $modeloMiembroSub->obtenerMiembrosSubTarea();
    $usuariosResponsables = $modeloColaboracion->obtenerColaboradores($usuarioId);

    foreach ($TodosUsuariosSubTarea as $usSubTarea) {
        if ($usuarioId == $usSubTarea['usuario_id']) {
            $subUsuarios = $modeloMiembroSub->obtenerUsuariosConDatosPorSubtarea($usSubTarea['subtarea_id']);
            foreach ($subUsuarios as $usResponsable) {
                if ($usuarioId == $usResponsable['usuario_id']) {
                    $subTareasResponsable[] = $usResponsable['subtarea_id'];
                }
                $usuariosResponsablesSub[] = $usResponsable;
            }
        }
    }

    foreach ($usuariosResponsables as $usResponsable) {
        if ($usuarioId == $usResponsable['usuario_id']) {
            $tareasResponsable[] = $usResponsable['tarea_id'];
        }
    }


    $tareasPropias = $modeloTarea->obtenerTareasNoArchivadas($usuarioId);
    $tareasColaborativas = $modeloTarea->obtenerTareasColaborativas($usuarioId);

    $hoy = Time::now()->toDateString(); 
    $recordatorios = [];

    $todasLasTareas = array_merge($tareasPropias, $tareasColaborativas);

    foreach ($todasLasTareas as $tarea) {
        if (!empty($tarea['fecha_recordatorio'])) {
            $fechaRecordatorio = Time::parse($tarea['fecha_recordatorio'])->toDateString();
            if ($fechaRecordatorio == $hoy) {
                $recordatorios[] = "📌 Tenés un recordatorio pendiente para la tarea: <strong>{$tarea['titulo']}</strong>";
            }
        }
    }

    $data['RecordatorioAlerta'] = $recordatorios;
    $data['tareas_propias'] = $tareasPropias;
    $data['tareas_colaborativas'] = $tareasColaborativas;

    return view('inicioView', $data);
}

}
