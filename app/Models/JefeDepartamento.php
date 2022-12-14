<?php

namespace App\Models;

use CodeIgniter\Model;

class JefeDepartamento extends Model
{
    //protected $DBGroup          = 'default';
    protected $table            = 'jdepto';
    protected $primaryKey       = 'rfc';
    protected $returnType       = 'array';
    protected $allowedFields    = ['rfc','nombre', 'apellidos', 'clave','fecha_ingreso', 'fecha_termina', 'status', 'departamento'];

    // Dates
    /*protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    */
    // Validation
    protected $validationRules      = [
        'rfc' => 'required|is_unique[jdepto.rfc]',
        'nombre'=>'required'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Callbacks
    /*protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];*/
}
