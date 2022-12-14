<?php

namespace App\Controllers;

use App\Models\JefeDepartamento;
use CodeIgniter\RESTful\ResourceController;

class JefesDepartamento extends ResourceController
{
    //protected $format = 'json';
    public function __construct() { 
        $this->model = new JefeDepartamento();
    }
    public function index() 
    {
        try {
            $jefes = $this->model->findAll();
            return $this->respuesta($jefes,'',200);
        } catch (\Exception $e){
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($rfc = null)
    {
        try {
            if($rfc == null){
                return $this->respuesta([],'No se ha especificado el RFC',400);
            }else{
                $jefe = $this->model->find($rfc);
                if($jefe == null){
                    return $this->respuesta([],'No se ha encontrado el RFC',404);
                }else{
                    return $this->respuesta($jefe, '', 200);
                }      
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        try {            

            //$request = \Config\Services::request();
            //$validation = \Config\Services::validation();
            $jefe = $this->request->getJSON();
            $data =[
                'rfc'=>$jefe->rfc,
                'nombre'=>$jefe->nombre,
                'apellidos'=>$jefe->apellidos,
                'clave'=>$jefe->clave,
                'fecha_ingreso'=>$jefe->fecha_ingreso,
                'fecha_termina'=>$jefe->fecha_ingreso,
                'status'=>$jefe->status,
                'departamento'=>$jefe->departamento,
            ];
            if($this->validate('jefes')){//$this->model->insert($jefe)
                $this->model->insert($data);
                return $this->respuesta('Operacion Exitosa!','',200);
            }else if($this->model->insert($data)){
                return $this->respuesta('','Error',400);
                
            }
            else{return $this->failValidationErrors($this->model->validation->listErrors());}
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        try {
            if($id == null){
                return $this->respuesta([],'No se ha pasado un Id valido',400);
            }else{
                $jefeVerificado = $this->model->find($id);
                if($jefeVerificado == null){
                    return $this->respuesta([],'No se ha encontrado un Jefe con el rfc: '.$id,404);
                }   
                $jefe = $this->request->getJSON();
                $data =[
                    'nombre'=>$jefe->nombre,
                    'apellidos'=>$jefe->apellidos,
                    'clave'=>$jefe->clave,
                    'fecha_ingreso'=>$jefe->fecha_ingreso,
                    'fecha_termina'=>$jefe->fecha_ingreso,
                    'status'=>$jefe->status,
                    'departamento'=>$jefe->departamento,
                ];
                if($this->model->update($id, $data)):
                    $solicitud->id = $id;
                    return $this->respuesta('Operacion Actualizada','',200);
                else:
                    return $this->failValidationErrors($this->model->validation->listErrors());
                endif;
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
    public function respuesta($data, $mensaje, $codigo) {
        if ($codigo==200) {
            return $this->respond(array(
                "status" => $codigo,
                "data" => $data
            ));
        }else{
            return $this->respond(array(
                "status" => $codigo,
                "data" => $mensaje
            ));
        }
    }
}
