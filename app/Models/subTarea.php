<?php

namespace App\Models;

use CodeIgniter\Model;

class Subtarea extends Model
{
    protected $table = 'subtarea';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tarea_id', 'titulo', 'descripcion', 'estado',
        'prioridad', 'fecha_vencimiento', 'fecha_recordatorio', 'color'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function obtenerSubTareas($id_Tarea)
{
    return $this->where('tarea_id', $id_Tarea)->findAll();
}


    public function obtenerSubTarea($id_SubTarea){
        return $this->findAll($id_SubTarea);
    }
}
