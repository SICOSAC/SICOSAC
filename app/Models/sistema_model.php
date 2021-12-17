<?php

namespace App\Models;

use CodeIgniter\Model;

class Sistema_model extends Model{

    function numeroTecnologico(){
        $this->table="tTecnologico";
        $result=$this->find();
        return $result;
    }

}