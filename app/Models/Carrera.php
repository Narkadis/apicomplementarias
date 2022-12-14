<?php

namespace App\Models;

use CodeIgniter\Model;

class Carrera extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'carreras';//nombre de la table
    protected $primaryKey       = 'id';//llave primaria
    protected $useAutoIncrement = true;//autoincrementable
    protected $insertID         = 0;
    protected $returnType       = 'array';//tipo de dato que devuelve
    protected $useSoftDeletes   = false;//desabilita el delete_at en la base de datos, por lo regular se le entiende como una papelera de reciclaje
    protected $protectFields    = true;//activa la proteccion solo funciona en migraciones o pruebas o tambien los seeds 
    protected $allowedFields    = ['nombre','nombre_corto', 'jdepto'];

    // Dates
    //protected $useTimestamps = false;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks--eventos y filtros
    protected $allowCallbacks = true;//habilita los callbacks
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
