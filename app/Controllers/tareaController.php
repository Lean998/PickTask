<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Subtarea;
use App\Models\MiembroSubtarea;
use App\Models\Colaboracion;


class TareaController extends BaseController{
    
    
    public function mostrarDetalles(){
        $modeloTarea = new Tarea();
        $modeloSubTarea = new Subtarea();
        $modeloMiembroSubtarea = new MiembroSubtarea();
        $modeloColaboracion = new Colaboracion();
        if (isset($this->request) && $this->request->getPost('tarea_id') !== null) {
    $idTarea = $this->request->getPost('tarea_id');
    } else {
         return redirect()->to('/');
    }
        $subTareas = $modeloSubTarea->obtenerSubTareas($idTarea);
        $data['tarea'] = $modeloTarea->obtenerTarea($idTarea);
        $data['subTareas'] = $subTareas;
        $data['subtareas'] = [];
        foreach ($subTareas as $subtarea) {
            $responsables = $modeloMiembroSubtarea
        ->select('usuario.*')
        ->join('usuario', 'usuario.id = miembro_subtarea.usuario_id')
        ->where('miembro_subtarea.subtarea_id', $subtarea['id']) 
        ->findAll();
    $subtarea['responsables'] = $responsables;
    $data['subtareas'][] = $subtarea;
}
$colaboradores = $modeloColaboracion
            ->select('usuario.*')
            ->join('usuario', 'usuario.id = colaboracion.usuario_id')
            ->where('colaboracion.tarea_id', $idTarea)
            ->findAll();
        $asignados = $modeloMiembroSubtarea
            ->select('usuario_id')
            ->join('subtarea', 'subtarea.id = miembro_subtarea.subtarea_id')
            ->where('subtarea.tarea_id', $idTarea)
            ->findColumn('usuario_id');
        $colaboradoresDisponibles = array_filter($colaboradores, function ($usuario) use ($asignados) {
            return !in_array($usuario['id'], $asignados ?? []);
        });

        $data['obtenerColoresTarea'] = function($colorNombre) {
        switch (strtolower($colorNombre)) {
            case 'rojo': return ['#FF6B6B', '#FFECEC'];
            case 'azul': return ['#1E90FF', '#E6F0FF'];
            case 'verde': return ['#28A745', '#E9F7EF'];
            case 'naranja': return ['#FFA600', '#FFF3E0'];
            case 'celeste': return ['#00C1FF', '#E0F7FF'];
            case 'gris': return ['#6C757D', '#F0F0F0'];
            case 'violeta': return ['#8A2BE2', '#F3E8FF'];
            default: return ['#CCCCCC', '#F9F9F9'];
        }
    };

        $data['colaboradores_disponibles'] = $colaboradoresDisponibles;
        return view('tareaView', $data);
    }

    public function crear()
    {
        return view('crearTareaView');
    }

    public function guardar()
    {
        if (isset($this->request) && $this->request->getPost('tarea_id') !== null) {
    $idTarea = $this->request->getPost('tarea_id');
    } else {
        $idTarea = session()->getFlashdata('tarea_id');
    }

        $modeloTarea = new Tarea();
        $data = [
            'usuario_id' => session('id_usuario') ?? 1, 
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => 'definida',
            'prioridad' => $this->request->getPost('prioridad'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color'),
            'archivada' => 0
        ];
        if ($modeloTarea->insert($data)) {
            return redirect()->to('/')->with('mensaje', 'Tarea creada con éxito');
        } else {
            dd($modeloTarea->errors());
        }
    }
    

    public function editar()
    {
        $id = $this->request->getPost('id_tarea');
        $modeloTarea = new Tarea();
        $data['tarea'] = $modeloTarea->find($id);

        $modeloTarea->actualizarEstadoPorSubtareas($id);
        return view('editarTareaView', $data);
    }

    public function actualizar()
    {
        $modeloTarea = new Tarea();
        $id = $this->request->getPost('id');
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => 'definida',
            'prioridad' => $this->request->getPost('prioridad'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color')
        ];
        $modeloTarea->update($id, $data);
        $modeloTarea->actualizarEstadoPorSubtareas($id);
        return redirect()->to('/')->with('mensaje', 'Tarea actualizada con éxito');
    }

    // En vez de borrar, se archiva
    public function baja()
    {
        $id = $this->request->getPost('id_tarea');
        if ($id) {
            $tareaModel = new Tarea();
            $tareaModel->update($id, ['archivada' => 1]); // Baja lógica
            return redirect()->to('/')->with('mensaje', 'Tarea archivada correctamente');
        }
        return redirect()->to('/')->with('error', 'No se pudo archivar la tarea');
    }

    public function archivar($id)
    {
        $modeloTarea = new Tarea();
        $modeloTarea->update($id, ['archivada' => 1]);
        return redirect()->to('/')->with('mensaje', 'Tarea archivada correctamente.');
    }

    public function historial()
    {
        $modeloTarea = new Tarea();
        $usuarioId = session('id_usuario') ?? 1;
        $data['tareasArchivadas'] = $modeloTarea->obtenerTareasArchivadas($usuarioId);
        $data['tareasActivas'] = $modeloTarea->obtenerTareasNoArchivadas($usuarioId);
        return view('historialView', $data);
    }

    public function verColaboraciones()
    {
        $usuario_id = session()->get('id_usuario'); 
        $tareaModel = new Tarea(); 
        $data['tareas_colaborativas'] = $tareaModel->obtenerTareasColaborativas($usuario_id); 
        return view('inicioView', $data); 
    }

}
