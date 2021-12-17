<?php

namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{
    protected $table="";
    function validarUsuario($usuario, $password, $tabla)
    {
        //asignamos la tabla recibida a la tabla que se utiliza en este modelo
        $this->table=$tabla;
        //validamos si la consulta realizada es para un docente/administrativo o para un alumno
        if ($tabla == "tDocenteAdministrativo") {
            $filaUsuario = "correo_docente_administrativo";
            $filaPassword = "clave_docente_administrativo";
            //En consulta a docentes, validamos que el usuario esté activo
            $this->where("estado_cuenta", "ACTIVO");
        } else {
            $filaUsuario = "numero_control";
            $filaPassword = "clave_alumno";
        }
        //Buscamos la fila donde el nombre de usuario sea igual con el encontrado
        $this->where($filaUsuario, $usuario);
        //Enviamos la contraseña con hash en md5 para comprarar la almacenada con la ingresada
        $this->where($filaPassword, $password);
        //Almacenamos los resultados de la consulta (indicando la tabla en la que buscaremos)
        $result = $this->find();
        //Devolvemos el resultado
        return $result;
    }
}
