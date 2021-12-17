<?php

namespace App\Controllers;

class Login extends BaseController
{
  //creamos una sesión para loguear
  public $session;

  public function __construct(){
    //cargamos 'helpers' para distintas funciones
    //helper de arreglos
    helper('array');
    //helper de direcciones (elimina las extensiones en la barra de navegador)
    helper('url');
    //helper de alertas, para mostrar mensajes
    helper('alerts');
    //inicializamos la sesión
    $this->session = session();
  }

  public function index(){
      //inicializamos la ventana de Login
      //Al ser este controlador (Login.php) el controlarod inicial de la webapp, la función index
      //se ejecuta en automatico al ingersar
      return view('login_view');
  }

  public function authDocente(){
    
    //definimos el "Model" donde se encuentran las funciones de acceso a la BD y lo almacenamos
    $modeloLogin = new \App\Models\login_model();

    //validamos que la petición llegue como POST
    if ($this->request->getMethod()=='post'){
      //obtenemos el usuario docente y lo almacenamos en una variable
      $usuario=$this->request->getPost("usuarioDocente");
      //obtenemos la contraseña y la almacenamos encriptada en MD5 (misma encriptación que
      //en la base de datos)
      $password=md5($this->request->getPost("passwordDocente"));
      //enviamos el usuario y la contraseña encriptadas al modelo para validarlos
      $usuarioValidado=$modeloLogin->validarUsuario($usuario,$password,"tDocenteAdministrativo");
      //verificamos si lo que obtuvimos es una fila, de ser el caso avanzamos
      if(isset($usuarioValidado[0])){
        $datosUsuario=$usuarioValidado[0];
        //Almacenamos únicamente la información pertinente del docente en un arreglo
        $usuarioDocente=dot_array_search("correo_docente_administrativo",$datosUsuario);
        $docentePaterno=dot_array_search("paterno_docente_administrativo",$datosUsuario);
        $docenteMaterno=dot_array_search("materno_docente_administrativo",$datosUsuario);
        $docenteNombre=dot_array_search("nombre_docente_administrativo",$datosUsuario);
        $nivelDocente=dot_array_search("nivel_cuenta",$datosUsuario);
        $datosSesion=array(
          'usuarioDocente'=>$usuarioDocente,
          'docenteNombre'=>$docentePaterno . " " . $docenteMaterno . " " . $docenteNombre,
          'nivelDocente'=>$nivelDocente,
          'loggedDocente'=>TRUE
        );
        //limpiamos la variable con todos los datos del docente
        unset($datosUsuario);
        //Asignamos el arreglo a una sesión para utilizar los valores a según sea necesario
        $this->session->set("userdata",$datosSesion);
        //cargamos la función de redirección
        return redirect()->to('sistema/sesionDocente');
        //Si no obtuvimos una fila es porque usuario/contraseña son incorrectos
        //o el usuario no se encuentra activo, en cualquier caso retornamos al login
      }else{
        $datosSistema=array('errorLogin'=>"Usuario o Contraseña Incorrectos");
        $this->session->set("flashdata",$datosSistema);
        return redirect()->to('login/index');
      }
    }
  }

  public function authAlumno(){
      
    //definimos el "Model" donde se encuentran las funciones de acceso a la BD y lo almacenamos
    $modeloLogin = new \App\Models\login_model();

    //validamos que la petición llegue como POST
    if ($this->request->getMethod()=='post'){
      //obtenemos el usuario alumno y lo almacenamos en una variable
      $usuario=$this->request->getPost("usuarioAlumno");
      //obtenemos la contraseña y la almacenamos encriptada en MD5 (misma encriptación que
      //en la base de datos)
      $password=md5($this->request->getPost("passwordAlumno"));
      //enviamos el usuario y la contraseña encriptadas al modelo para validarlos
      $usuarioValidado=$modeloLogin->validarUsuario($usuario,$password,"tAlumno");
      //verificamos si lo que obtuvimos es una fila, de ser el caso avanzamos
      if(isset($usuarioValidado)){
        $datosUsuario=$usuarioValidado[0];
        //Almacenamos únicamente la información pertinente del docente en un arreglo
        $usuarioDocente=dot_array_search("correo_docente_administrativo",$datosUsuario);
        $docentePaterno=dot_array_search("paterno_docente_administrativo",$datosUsuario);
        $docenteMaterno=dot_array_search("materno_docente_administrativo",$datosUsuario);
        $docenteNombre=dot_array_search("nombre_docente_administrativo",$datosUsuario);
        $nivelDocente=dot_array_search("nivel_cuenta",$datosUsuario);
        $datosSesion=array(
          'usuarioDocente'=>$usuarioDocente,
          'docenteNombre'=>$docentePaterno . " " . $docenteMaterno . " " . $docenteNombre,
          'nivelDocente'=>$nivelDocente,
          'loggedDocente'=>TRUE
        );
        //limpiamos la variable con todos los datos del docente
        unset($datosUsuario);
        //Cargamos la sesión
        $session = session();
        //Asignamos el arreglo a una sesión para utilizar los valores a según sea necesario
        $session->set("userdata",$datosSesion);
        //cargamos la función de redirección
        return redirect()->to('sistema/sesionDocente');
        //Si no obtuvimos una fila es porque usuario/contraseña son incorrectos
        //o el usuario no se encuentra activo, en cualquier caso retornamos al login
      }else{
        echo $this->session->set_flashdata('msg','Usuario o Contraseña Incorrectos');
        redirect('login');
      }
    }
  }

  public function logout(){
    session_destroy();
    return redirect()->to('login/index');
  }
}
