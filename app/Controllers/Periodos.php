<?php
namespace App\Controllers;
use App\Models\Periodo;
use CodeIgniter\RESTful\ResourceController; 

class Periodos extends ResourceController
{
    public function __construct() { 
        //$this->model = new Periodo();
      $this->model = $this->setModel(new Periodo());
    }
    public function index()
    {
        try {
            $periodos = $this->model->findAll();
            
        return $this->respuesta($periodos,'',200);
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
                $periodos = $this->model->find($id);
                if($periodos == null){
                    return $this->respuesta([],'No se ha encontrado el periodo',404);
                }else{
                    return $this->respuesta($periodos, '', 200);
                }      
            }
        } catch (\Exception $e) {
            return $this->respuesta([],$e->getMessage(),500);
        }
    }

    public function create()
    {
        try {
            $periodos = $this->request->getJSON();
            $data =[
                'mes_ini' => $periodos->mes_ini,
                'mes_fin' => $periodos->mes_fin,
                'anio' => $periodos->anio,
                'status' => $periodos->status,
            ];
            if($this->model->insert($data)):
                $periodos->id = $this->model->insertID();
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
                $periodoVerificado = $this->model->find($id);
                if($periodoVerificado == null){
                    return $this->respuesta([],'No se ha encontrado un departamento con el id: '.$id,404);
                }   
                $periodos = $this->request->getJSON();
                $data =[
                    'mes_ini' => $periodos->mes_ini,
                'mes_fin' => $periodos->mes_fin,
                'anio' => $periodos->anio,
                'status' => $periodos->status,
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