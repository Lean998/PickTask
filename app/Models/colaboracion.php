<?php

namespace App\Models;

use CodeIgniter\Model;

class Colaboracion extends Model
{
    protected $table = 'colaboracion';
    protected $primaryKey = false;
    protected $allowedFields = ['tarea_id', 'usuario_id', 'rol'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;
}
