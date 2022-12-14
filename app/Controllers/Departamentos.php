<?php
namespace App\Controllers;
use App\Models\Departamento;
use CodeIgniter\RESTful\ResourceController;

class Departamentos extends ResourceController
{
    public function __construct() { 
        $this->model = new Departamento();
    }
    
    public function index()
    {
        try {
            $deptos = $this->model->findAll();
            return $this->respuesta($deptos,'',200);
        } catch (\Exception $e){
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

  
    public function show($id = null)
    {
        try {
            if($id == null){
                return $this->respuesta([],'No se ha especificado el Id',400);
            }else{
                $depto = $this->model->find($id);
                if($depto == null){
                    return $this->respuesta([],'No se ha encontrado el Departamento',404);
                }else{
                    return $this->respuesta($depto, '', 200);
                }
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    
    public function create()
    {
        try {
            $depto = $this->request->getJSON();
            $data =[
                'nombre' => $depto->nombre,
            ];
            if($this->model->insert($data)):
                $depto->id = $this->model->insertID();
                return $this->respuesta('Operacion Exitosa!','',200);
               // return $this->respondCreated($rol);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);  
    }
}

   
    public function update($id = null)
    {
        try {
            if($id == null){
                return $this->respuesta([],'No se ha pasado un Id valido',400);
            }else{
                $departamentoVerificado = $this->model->find($id);
                if($departamentoVerificado == null){
                    return $this->respuesta([],'No se ha encontrado un departamento con el id: '.$id,404);
                }   
                $depto = $this->request->getJSON();
                $data =[
                    'nombre' => $depto->nombre,
                ];
                if($this->model->update($id, $data)):
                    $depto->id = $id;
                    return $this->respuesta('Operacion Actualizada','',200);
                else:
                    return $this->failValidationErrors($this->model->validation->listErrors());
                endif;
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    
    public function delete($id = null){
     /*   try {
            if($id == null)
                return $this->respuesta([],'No se ha pasado un Id valido',400);
            $departamentoVerificado = $this->model->find($id);
            if($departamentoVerificado == null){
                return $this->respuesta([],'No se ha encontrado el departamento con el id: ' . $id,404);
            }
            if($this->model->delete($id)):
                return $this->respuesta('Se ha eliminado Correctamente!','',200);
            else:
                return $this->respuesta([],'No se ha podido eliminar el registro',404);
            endif;

        } catch (\Exception $e) { 
            return $this->respuesta([],$e->getMessage(),500);
        } */
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

