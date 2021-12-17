<?php

namespace App\Controllers;

class Estudiante extends BaseController
{

    public function __construct()
    {
        helper('url');
        helper('session');
        helper('post');
        $this->session = session();
    }

    public function insertarEstudiante()
    {
        $modeloEstudiante = new \App\Models\estudiante_model();
        $respuesta = "";
        if ($this->request->getMethod() == "post") {
            $estudiante = $this->request->getPost("estudiante");
            $respuesta = $modeloEstudiante->insertarEstudiante($estudiante);
        }
        return $respuesta;
    }

    public function importarCsv()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);

        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
        } else {

            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/" . $newName, "r");
                    $i = 0;
                    $numberOfFields = 10;

                    $csvArr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        if ($i > 0 && $num == $numberOfFields) {
                            $csvArr[$i]['numero_control'] = $filedata[0];
                            $csvArr[$i]['clave_alumno'] = $filedata[1];
                            $csvArr[$i]['paterno_alumno'] = $filedata[2];
                            $csvArr[$i]['materno_alumno'] = $filedata[3];
                            $csvArr[$i]['nombre_alumno'] = $filedata[4];
                            $csvArr[$i]['carrera_alumno'] = $filedata[5];
                            $csvArr[$i]['semestre_ingreso'] = $filedata[6];
                            $csvArr[$i]['semestre_en_curso'] = $filedata[7];
                            $csvArr[$i]['estado_alumno'] = $filedata[8];
                            $csvArr[$i]['creditos_acumulados'] = $filedata[9];
                        }
                        $i++;
                    }
                    fclose($file);

                    $count = 0;
                    foreach ($csvArr as $userdata) {

                        $modeloEstudiante = new \App\Models\estudiante_model();

                        $findRecord = $modeloEstudiante->where('numero_control', $userdata['numero_control'])->countAllResults();

                        if ($findRecord == 0) {
                            if ($modeloEstudiante->insert($userdata)) {
                                $count++;
                            }
                        }
                    }
                    session()->setFlashdata('message', $count . ' estudiantes registrados.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashdata('message', 'No se pudo importar el archivo csv.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            } else {
                session()->setFlashdata('message', 'No se pudo importar el archivo csv.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }

        return redirect()->route('/');
    }

    public function cargarTablaEstudiante()
    {
        $modeloEstudiante = new \App\Models\estudiante_model();
        return $modeloEstudiante->cargarTablaEstudiante();
    }
}
