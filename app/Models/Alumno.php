<?php

namespace App\Models;

use CodeIgniter\Model;

class Alumno extends Model
{
   // protected $DBGroup          = 'default';
    protected $table            = 'alumnos';
    protected $primaryKey       = 'no_control';
    //protected $useAutoIncrement = true;
    //protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $allowedFields    = ['no_control','carrera','nip','nombre_alumno', 'apellido_paterno','apellido_materno'];
   

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
