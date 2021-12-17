<?php

namespace App\Controllers;

class Sistema extends BaseController
{

    public $session;
    protected $usuarioDocente;
    protected $nombreDocente;
    protected $nivelDocente;

    protected $usuarioAlumno;
    protected $nombreAlumno;

    public function __construct()
    {
        helper('url');
        helper('session');
        helper('post');
        $this->session = session();
    }

    /**
     * En caso de iniciar sesión como docente/administrativo
     * Almacenamos las variables en local en protegido, para evitar su modificación fuera de este archivo
     * Se almacenan para compararse con sus homónimos en Session
     * En caso de darse un cambio en Session, esta se cierra
     */
    public function sesionDocente()
    {
        if(isset($this->session->userdata['usuarioDocente'])){
            $this->usuarioDocente = $this->session->userdata['usuarioDocente'];
            $this->nombreDocente = $this->session->userdata['docenteNombre'];
            $this->nivelDocente = $this->session->userdata['nivelDocente'];
            return view('sistema_view');
        }else{            
            return redirect()->to('login/index');
        }
    }
    /**
     * En caso de iniciar sesión como alumno
     * Almacenamos las variables en local en protegido, para evitar su modificación fuera de este archivo
     * se almacenan para compararse con sus homónimos en Session
     * En caso de darse un cambio, la sesion se cierra
     */
    public function sesionAlumno()
    {
        $this->usuarioAlumno = $this->session->userdata['usuarioAlumno'];
        $this->nombreAlumno = $this->session->userdata['nombreAlumno'];
        return view('alumno_view');
    }

    public function numeroTecnologico(){
        $sistemaModel = new \App\Models\sistema_model();
        $numeroTecnologico=$sistemaModel->numeroTecnologico();
        return $numeroTecnologico;
    }

    /**
     * Carga de Modulos para Docentes
     */
    public function cargarModulo()
    {
        $nombreModulo=$this->request->getPost("nombreModulo");
        if (isset($this->session->userdata['usuarioDocente'])) {
            switch ($nombreModulo) {
                case "convocatorias":
                    return view('convocatorias_view');
                    break;
                case "solicitudes":
                    return view('solicitudes_view');
                    break;
                case "actividades":
                    return view('actividades_view');
                    break;
                case "estudiantes":
                    return view('estudiantes_view');
                    break;
                case "docentes":
                    return view('docentes_view');
                    break;
                case "carreras":
                    return view('carreras_view');
                    break;
                case "departamentos":
                    return view('departamentos_view');
                    break;
                case "tiposdeactividades":
                    return view('tiposdeactividades_view');
                    break;
                case "periodos":
                    return view('periodos_view');
                    break;
                case "ajustes":
                    return view('ajustes_view');
                    break;
            }
        }
    }
}
