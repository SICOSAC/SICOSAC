<?php
$session = session();
helper('html');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/SICOSAC/css/bulma.min.css" />
    <link rel="stylesheet" href="http://localhost/SICOSAC/css/tabla.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var nombreModulo="";
            $("a").click(function() {
                $("a").removeClass('is-active');
                $(this).addClass("is-active");
                //Obtenemos el nombre del módulo al que intenta accesar el Usuario
                nombreModulo = $(this).attr('name');
                //codigo para cargar cada una de las páginas a según la opción del menú a la que se hace click
                cargarModulo(nombreModulo);
            });
        });

        //Función para llamar el módulo clientes, recibe una variable de tipo String
        //donde viene indicada si se busca algún valor en específico
        function cargarModulo(nombreModulo) {
            $.ajax({
                url: "<?php $nombreModulo=""; echo site_url("Sistema/cargarModulo"); ?>",
                method: "POST",
                data: {nombreModulo:nombreModulo},
                success: function(result) {
                    $("#celdaFormulario").html(result);
                },
                error: function(result) {
                    $("#celdaFormulario").html(result.responseText);
                },
                fail: (function(status) {
                    $("#celdaFormulario").html("Fail");
                })

            });
        }
    </script>
    <title>SICOSAC Docentes</title>
</head>

<body style="height:100%;">

    <table class="table" style="width:100%; height:100%;">
        <tr>
            <td style="background-color:lavender; width:10%; height:100%;">
                <aside id="menu" class="menu">
                    <ul class="menu-list">
                        <p class="menu-label" style="font-size:18px; margin:3px;">
                            Actividades Complementarias
                        </p>
                        <li><a name="convocatorias">Convocatorias</a></li>
                        <li><a name="solicitudes">Solicitudes</a></li>
                        <li><a name="actividades">Actividades</a></li>
                    </ul>
                    <?php if ($session->userdata['nivelDocente'] === 'ADMINISTRATIVO') : ?>
                        <ul class="menu-list">
                            <p class="menu-label" style="font-size:18px; margin:3px">
                                Administrador
                            </p>
                            <li><a name="estudiantes">Estudiantes</a></li>
                            <li><a name="docentes">Docentes</a></li>
                            <li><a name="carreras">Carreras</a></li>
                            <li><a name="departamentos">Departamentos</a></li>
                            <li><a name="tiposdeactividades">Tipos de Actividades</a></li>
                        </ul>
                    <?php endif; ?>
                    <ul class="menu-list">
                        <p class="menu-label" style="font-size:18px; margin:3px">
                            Salir
                        </p>
                        <li><a href="<?php echo site_url('login/logout'); ?>" name="logout">Cerrar Sesión</a></li>
                    </ul>
                </aside>
            </td>
            <td name="modulo" id="modulo" style="width:90%; padding:0;">
                <table style="width:100%; height:100%">
                    <tr>
                        <td name="celdaFormulario" id="celdaFormulario"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>