<?php

namespace App\Models;

use CodeIgniter\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id', 'titulo', 'descripcion', 'estado',
        'prioridad', 'fecha_vencimiento', 'fecha_recordatorio', 'color'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function obtenerTareas(){
        return $this->findAll();
    }

    public function obtenerTarea($id){
        return $this->find($id);
    }
}
