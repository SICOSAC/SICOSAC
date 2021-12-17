<?php

namespace App\Models;

use CodeIgniter\Model;

class Carrera_model extends Model
{
    protected $table="tcarrera";

    function cargarDropCarreras(){
        return $this->find();
    }

    function insertarCarrera($Carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('tcarrera');
        $builder->insert($Carrera);
    }

    function modificarCarrera($Carrera){
        $db = \Config\Database::connect();
        $builder = $db->table('tcarrera');

    }

    function cargarTablaCarrera(){
        $table = new \CodeIgniter\View\Table();        
        $table->setHeading('Carrera');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT nombre_carrera FROM tcarrera');
        echo $table->generate($query);
    }

}