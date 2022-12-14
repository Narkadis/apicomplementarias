<?php

namespace App\Controllers;
use App\Models\Alumno;
use CodeIgniter\RESTful\ResourceController;

class Alumnos extends ResourceController
{
    public function __construct() {
      //  $this->model = $this->setModel(new Alumno());
        $this->model = new Alumno();
    }
  
    public function index()
    {
        try {
            $alumnos = $this->model->findAll();
            return $this->respuesta($alumnos,'',200);
        } catch (\Exception $e){
             return $this->respuesta([],$e->getMessage(),500);
        }
    }


    
    public function show($no_control = null)
    {
        try {
            if($no_control == null){
                return $this->respuesta([],'No se ha especificado el numero de control',400);
            }else{
                $alumno = $this->model->find($no_control);
                if($alumno == null){
                    return $this->respuesta([],'No se ha encontrado el numero de control',404);
                }else{
                    return $this->respuesta($alumno, '', 200);
                }      
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        } 
    }


   
    public function create()
    {
        try {            
            $alumno = $this->request->getJSON();
            $data =[
                'no_control'=>$alumno->no_control,
                'carrera'=>$alumno->carrera,
                'nip'=>$alumno->nip,
                'nombre_alumno'=>$alumno->nombre_alumno,
                'apellido_paterno'=>$alumno->apellido_paterno,
                'apellido_materno'=>$alumno->apellido_materno,
        
                
            ];
            if($this->validate('alumnos')){//$this->model->insert($alumnos)
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

   
    
    public function update($id = null)
    {
        try {
            if($id == null){
                return $this->respuesta([],'No se ha pasado un Id valido',400);
            }else{
                $alumnoVerificado = $this->model->find($id);
                if($alumnoVerificado == null){
                    return $this->respuesta([],'No se ha encontrado un alumno con el id: '.$id,404);
                }   
                $alumno = $this->request->getJSON();
                $data =[
                'carrera'=>$alumno->carrera,
                'nip'=>$alumno->nip,
                'nombre_alumno'=>$alumno->nombre_alumno,
                'apellido_paterno'=>$alumno->apellido_paterno,
                'apellido_materno'=>$alumno->apellido_materno,
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
