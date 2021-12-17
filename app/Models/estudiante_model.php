<?php

namespace App\Models;

use CodeIgniter\Model;

class Estudiante_model extends Model{

    protected $table="talumno";
    protected $camposPermitidos=[
        'numero_control',
        'clave_alumno',
        'paterno_alumno',
        'materno_alumno',
        'nombre_alumno',
        'carrera_alumno',
        'semestre_ingreso',
        'semestre_en_curso',
        'estado_alumno',
        'creditos_acumulados'
    ];

    function insertarEstudiante($estudiante){
        $db = \Config\Database::connect();
        $builder = $db->table('talumno');
        $builder->insert($estudiante);
    }

    function modificarEstudiante($estudiante){
        $db = \Config\Database::connect();
        $builder = $db->table('talumno');

    }

    function cargarTablaEstudiante(){
        $table = new \CodeIgniter\View\Table();        
        $table->setHeading('Numero de Control', 'Paterno', 'Materno', 'Nombre', 'Carrera');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT numero_control,paterno_alumno,materno_alumno,nombre_alumno,carrera_alumno FROM talumno');
        echo $table->generate($query);
    }

}