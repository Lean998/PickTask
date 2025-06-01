<?php

namespace App\Controllers;

use App\Models\Colaboracion;
use App\Models\Subtarea;
use App\Models\Tarea;
use CodeIgniter\I18n\Time;

class subTareaController extends BaseController
{
    public function quitarResponsable()
{
    if ($this->request->isAJAX()) {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $tarea_id = $this->request->getPost('tarea_id');

        if (empty($subtarea_id) || empty($usuario_id) || empty($tarea_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Los campos subtarea_id, usuario_id y tarea_id son requeridos.'
            ]);
        }

        $model = new \App\Models\Subtarea();
        
        try {
            $result = $model->quitarResponsable($subtarea_id, $usuario_id);
            
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Responsable eliminado correctamente',
                    'tarea_id' => $tarea_id 
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se pudo eliminar el responsable.',
                    'errors' => $model->errors() ?? 'Error desconocido'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al eliminar el responsable: ' . $e->getMessage()
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false, 
        'message' => 'Petición no válida.'
    ]);
}

    public function agregarResponsable()
{
    if ($this->request->isAJAX()) {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $tarea_id = $this->request->getPost('tarea_id');

        if (empty($subtarea_id) || empty($usuario_id) || empty($tarea_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Todos los campos (subtarea_id, usuario_id, tarea_id) son requeridos.'
            ]);
        }

        $model = new \App\Models\Subtarea();
        
        try {
            $resultado = $model->asignarResponsable($subtarea_id, $usuario_id);
            
            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Responsable asignado correctamente.',
                    'tarea_id' => $tarea_id
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se pudo asignar el responsable.',
                    'errors' => $model->errors() ?? 'Error desconocido'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al asignar responsable: ' . $e->getMessage()
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false, 
        'message' => 'Petición no válida.'
    ]);
}
    public function guardarAsignacion()
    {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $correo = $this->request->getPost('correo');
        $model = new Subtarea();
        $model->asignarResponsable($subtarea_id, $usuario_id, $correo);
        return redirect()->to('/tareas/detalles/' . $subtarea_id)->with('mensaje', 'Responsable asignado');
    }

    public function guardar()
{
    $modeloSubtarea = new Subtarea();
    $modeloMiembroSubtarea = new Colaboracion();

    $data = [
        'tarea_id' => $this->request->getPost('tarea_id'),
        'titulo' => $this->request->getPost('titulo'),
        'descripcion' => $this->request->getPost('descripcion'),
        'estado' => $this->request->getPost('estado')
    ];

    if ($modeloSubtarea->insert($data)) {
        $subtarea_id = $modeloSubtarea->insertID();

        $responsable_id = $this->request->getPost('responsable');
        if (!empty($responsable_id)) {
            $modeloMiembroSubtarea->insert([
                'subtarea_id' => $subtarea_id,
                'usuario_id' => $responsable_id
            ]);
        }

        session()->setFlashdata('tarea_id', $data['tarea_id']);
        return redirect()->to('/tarea/detalles')->with('mensaje', 'Subtarea creada con éxito');
    } else {
        return redirect()->back()->withInput()->with('error', 'Error al crear la subtarea');
    }
}

public function crear()
{
    if ($this->request->isAJAX()) {
    
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $this->request->getPost('estado'),
            'tarea_id' => $this->request->getPost('tarea_id'),
            'prioridad' => $this->request->getPost('prioridad'),
            'color' => $this->request->getPost('color'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio')
        ];

      
        if (empty($data['titulo']) || empty($data['tarea_id'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El título y la tarea asociada son requeridos.'
            ]);
        }

     
        $validarFecha = function($fecha) {
            if (empty($fecha)) {
                return null;
            }
            
        
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                $partes = explode('-', $fecha);
                if (checkdate($partes[1], $partes[2], $partes[0])) {
                    return $fecha;
                }
            }
            
            return false;
        };

 
        if (!empty($data['fecha_vencimiento'])) {
            $fechaValida = $validarFecha($data['fecha_vencimiento']);
            if ($fechaValida === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Formato de fecha de vencimiento no válido. Use YYYY-MM-DD.'
                ]);
            }
            $data['fecha_vencimiento'] = $fechaValida;
        } else {
            $data['fecha_vencimiento'] = null;
        }

    
        if (!empty($data['fecha_recordatorio'])) {
            $fechaValida = $validarFecha($data['fecha_recordatorio']);
            if ($fechaValida === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Formato de fecha de recordatorio no válido. Use YYYY-MM-DD.'
                ]);
            }
            $data['fecha_recordatorio'] = $fechaValida;
        } else {
            $data['fecha_recordatorio'] = null;
        }

  
        $estadosValidos = ['creada', 'en_proceso', 'completada'];
        if (!empty($data['estado']) && !in_array($data['estado'], $estadosValidos)) {
            $data['estado'] = 'creada';
        } else if (empty($data['estado'])) {
            $data['estado'] = 'creada'; 
        }

      
        $prioridadesValidas = ['baja', 'normal', 'alta'];
        if (!empty($data['prioridad']) && !in_array($data['prioridad'], $prioridadesValidas)) {
            $data['prioridad'] = 'normal'; 
        } else if (empty($data['prioridad'])) {
            $data['prioridad'] = 'normal'; 
        }

        $model = new \App\Models\Subtarea();
        
        try {
            $insert = $model->insert($data);
            
            if ($insert) {
                return $this->response->setJSON([
                    'success' => true,
                    'id' => $model->getInsertID() 
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se pudo guardar la subtarea.',
                    'errors' => $model->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al guardar la subtarea: ' . $e->getMessage()
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false, 
        'message' => 'Petición no válida.'
    ]);
}

public function eliminar($id)
{
    if ($this->request->isAJAX()) {
        $modelo = new \App\Models\Subtarea();
        $tarea_id = $this->request->getPost('tarea_id');
        
        try {
            if ($modelo->delete($id)) {
                $modeloTarea = new \App\Models\Tarea();
                $modeloTarea->actualizarEstadoPorSubtareas($tarea_id);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Subtarea eliminada correctamente',
                    'tarea_id' => $tarea_id
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se pudo eliminar la subtarea'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al eliminar la subtarea: ' . $e->getMessage()
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false, 
        'message' => 'Petición no válida.'
    ]);
}

public function editar($id)
{
    if ($this->request->isAJAX()) {
        $modelo = new \App\Models\Subtarea();
        
        $subtarea = $modelo->find($id);
        if (!$subtarea) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Subtarea no encontrada.'
            ]);
        }

        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $this->request->getPost('estado'),
            'prioridad' => $this->request->getPost('prioridad'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color'),
            'tarea_id' => $this->request->getPost('tarea_id')
        ];

        if (empty($data['titulo']) || empty($data['tarea_id'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El título y la tarea asociada son requeridos.'
            ]);
        }

        $validarFecha = function($fecha) {
            if (empty($fecha)) {
                return null;
            }
            
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                $partes = explode('-', $fecha);
                if (checkdate($partes[1], $partes[2], $partes[0])) {
                    return $fecha;
                }
            }
            
            return false;
        };

        if (!empty($data['fecha_vencimiento'])) {
            $fechaValida = $validarFecha($data['fecha_vencimiento']);
            if ($fechaValida === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Formato de fecha de vencimiento no válido. Use YYYY-MM-DD.'
                ]);
            }
            $data['fecha_vencimiento'] = $fechaValida;
        } else {
            $data['fecha_vencimiento'] = null;
        }

        if (!empty($data['fecha_recordatorio'])) {
            $fechaValida = $validarFecha($data['fecha_recordatorio']);
            if ($fechaValida === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Formato de fecha de recordatorio no válido. Use YYYY-MM-DD.'
                ]);
            }
            $data['fecha_recordatorio'] = $fechaValida;
        } else {
            $data['fecha_recordatorio'] = null;
        }

        $estadosValidos = ['creada', 'en_proceso', 'completada'];
        if (!empty($data['estado']) && !in_array($data['estado'], $estadosValidos)) {
            $data['estado'] = 'creada';
        } else if (empty($data['estado'])) {
            $data['estado'] = 'creada';
        }

        $prioridadesValidas = ['baja', 'normal', 'alta'];
        if (!empty($data['prioridad']) && !in_array($data['prioridad'], $prioridadesValidas)) {
            $data['prioridad'] = 'normal';
        } else if (empty($data['prioridad'])) {
            $data['prioridad'] = 'normal';
        }

        try {
            if ($modelo->update($id, $data)) {
                $modeloTarea = new \App\Models\Tarea();
                $modeloTarea->actualizarEstadoPorSubtareas($data['tarea_id']);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Subtarea actualizada con éxito'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se pudo actualizar la subtarea.',
                    'errors' => $modelo->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al actualizar la subtarea: ' . $e->getMessage()
            ]);
        }
    }

    return $this->response->setJSON([
        'success' => false,
        'message' => 'Petición no válida.'
    ]);
}



    public function cambiarEstado()
    {
        $id = $this->request->getPost('subtarea_id');
        $estado = $this->request->getPost('estado');
        $tarea_id = $this->request->getPost('tarea_id');

        $modelo = new Subtarea();
        $modeloTarea = new Tarea();
        $modelo->cambiarEstado($id, $estado);
        $modeloTarea->actualizarEstadoPorSubtareas($tarea_id);

        

    return redirect()->to('/')->with('mensaje', 'Cambio de estado actualizado con éxito.');
    }

}





