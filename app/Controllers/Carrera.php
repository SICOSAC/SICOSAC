<?php

namespace App\Controllers;

use App\Models\Carrera_model;

class Carrera extends BaseController{
    
    public function __construct()
    {
        helper('url');
        helper('session');
        helper('post');
        $this->session = session();
    }
    
    public function dropCarreras(){
        $modeloCarrera=new \App\Models\carrera_model();
        $data['listaCarreras']=$modeloCarrera->cargarDropCarreras();
        $drop="";
        foreach($data['listaCarreras'] as $carrera){
            $nombreCarrera=$carrera['nombre_carrera'];
            $drop.='<option value="'.$nombreCarrera.'">'.$nombreCarrera.'</option>';
        };
        return $drop;
    }

    
    public function insertarCarrera(){
        $modeloCarrera = new \App\Models\carrera_model();
        $respuesta="";
        if($this->request->getMethod()=="post"){
            $Carrera=$this->request->getPost("Carrera");
            $respuesta=$modeloCarrera->insertarCarrera($Carrera);
        }
        return $respuesta;
    }

    public function cargarTablaCarrera(){
        $modeloCarrera=new \App\Models\carrera_model();
        return $modeloCarrera->cargarTablaCarrera();
    }

}