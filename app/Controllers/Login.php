<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(){
        //inicializamos la ventana de Login
        //Al ser este controlador (Login.php) el controlarod inicial de la webapp, la función index
        //se ejecuta en automatico al ingersar
        return view('login_view');
    }

    public function authDocente(){

      //validamos que la petición llegue como POST
      if ($this->request->getMethod()=='post'){
        //obtenemos el usuario docente y lo almacenamos en una variable
        $usuario=$this->request->getPost("usuarioDocente");
        //obtenemos la contraseña y la almacenamos encriptada en MD5 (misma encriptación que
        //en la base de datos)
        $password=md5($this->request->getPost("passwordDocente"));
      }
      //Recibimos mediante POST las variables para el usuario y la contraseña
      $usuario = $this->input->post('usuario',TRUE);
      $password = md5($this->input->post('password',TRUE));
      //Mediante el Model de Login validamos el usuario y la contraseña
      $validarUsuario = $this->validarUsuario($usuario,$password);
      //Si obtenemos valores de regreso (es decir, si la validación fue exitosa)
      if($validarUsuario->num_rows() > 0){
        $datosUsuario = $validarUsuario->row_array();
        $usuarioNombre= $datosUsuario['vUsuarioNombre'];
        $usuarioEmpleado = $datosUsuario['vUsuarioEmpleado'];
        $usuarioNivel = $datosUsuario['vUsuarioNivel'];
        $datosSesion = array(
          'usuario' => $usuarioNombre,
          'empleado' => $usuarioEmpleado,
          'nivel' => $usuarioNivel,
          'logged' => TRUE
        );
        $this->session->set_userdata($datosSesion);
        var_dump($this->session->userdata());
        if($this->session->userdata('nivel') === 'ADMINISTRADOR'){
          redirect('sistema/administrador');

        }elseif($usuarioNivel === 'VENDEDOR'){
          redirect('sistema/vendedor');
        }else{
          echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
          redirect('login');
        }
      }else{
        echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
        redirect('login');
      }
    }

    public function authAlumno(){
      //Recibimos mediante POST las variables para el usuario y la contraseña
      $usuario = $this->input->post('usuarioDocente',TRUE);
      $password = md5($this->input->post('password',TRUE));
      //Mediante el Model de Login validamos el usuario y la contraseña
      $validarUsuario = $this->validarUsuario($usuario,$password);
      //Si obtenemos valores de regreso (es decir, si la validación fue exitosa)
      if($validarUsuario->num_rows() > 0){
        $datosUsuario = $validarUsuario->row_array();
        $usuarioNombre= $datosUsuario['vUsuarioNombre'];
        $usuarioEmpleado = $datosUsuario['vUsuarioEmpleado'];
        $usuarioNivel = $datosUsuario['vUsuarioNivel'];
        $datosSesion = array(
          'usuario' => $usuarioNombre,
          'empleado' => $usuarioEmpleado,
          'nivel' => $usuarioNivel,
          'logged' => TRUE
        );
        $this->session->set_userdata($datosSesion);
        var_dump($this->session->userdata());
        if($this->session->userdata('nivel') === 'ADMINISTRADOR'){
          redirect('sistema/administrador');

        }elseif($usuarioNivel === 'VENDEDOR'){
          redirect('sistema/vendedor');
        }else{
          echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
          redirect('login');
        }
      }else{
        echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
        redirect('login');
      }
    }

    //Función para verificar Usuario y Contraseña
  function validarUsuario($usuario,$password){
    //Buscamos la fila donde el nombre de usuario sea igual con el encontrado
    $this->db->where('vUsuarioNombre',$usuario);
    //Enviamos la contraseña con hash en md5 para comprarar la almacenada con la ingresada
    $this->db->where('vUsuarioPassword', $password);
    //Almacenamos los resultados de la consulta (indicando la tabla en la que buscaremos)
    $result = $this->db->get('tUsuario',1);
    //Devolvemos el resultado
    return $result;
  }
}
