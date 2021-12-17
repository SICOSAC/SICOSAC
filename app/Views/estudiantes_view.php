<script>

    $(document).ready(function(){
        cargarEstudiantes();
    });

    function mostrarVentanaNuevo(){
        cargarDropCarreras();
        $("#mEstudianteNuevo").addClass("is-active");
    }
    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

    function cargarDropCarreras() {
        $.ajax({
            url: "<?php echo site_url('Carrera/dropCarreras'); ?>",
            success: function(data) {
                $("#estudianteNuevoCarrera").html(data);
            },
            error: function(result) {
                $("#estudianteNuevoCarrera").html(result.responseText);
            },
            fail: (function(status) {
                $("#estudianteNuevoCarrera").html("Fail");
            })

        });
    }

    function cargarEstudiantes(){
        $.ajax({
            url: "<?php echo site_url('Estudiante/cargarTablaEstudiante'); ?>",
            success: function(data) {
                $("#tablaDatos").html(data);
            },
            error: function(result) {
                $("#tablaDatos").html(result.responseText);
            },
            fail: (function(status) {
                $("#tablaDatos").html("Fail");
            })

        });
    }
    
    function insertarEstudiante(){
        var fecha=new Date();
        var anioLargo=fecha.getFullYear();
        var anio=anioLargo.toString().substr(-2);
        var control=document.getElementById('estudianteNuevoControl').value.toUpperCase();
        var estudiante={
            numero_control:control,
            clave_alumno:"Clave_"+control,
            paterno_alumno:document.getElementById('estudianteNuevoPaterno').value.toUpperCase(),
            materno_alumno:document.getElementById('estudianteNuevoMaterno').value.toUpperCase(),
            nombre_alumno:document.getElementById('estudianteNuevoNombre').value.toUpperCase(),
            carrera_alumno:document.getElementById('estudianteNuevoCarrera').value.toUpperCase(),
            semestre_ingreso:anio+"-"+document.getElementById('estudianteNuevoIngreso').value.toUpperCase(),
            semestre_en_curso:"1",
            estado_alumno:"ACTIVO",
            creditos_acumulados:"0"            
        };
        $.ajax({
            url: "<?php echo site_url('Estudiante/insertarEstudiante'); ?>",
            method: "POST",
            data: {
                estudiante: estudiante
            },
            success: function() {
                alert("Estudiante Registrado");
                cargarEstudiantes();
                $(".modal").removeClass("is-active");
            },
            error: function(jqHZR, exception) {
                alert(exception.toString());
            },
            fail: (function(status) {
                alert("wut?");
            })
        });
    }


</script>
<?php
    $anio=date("y");
    $numeroTecnologico="41";
?>
<body>
<table style="width:100%;">
        <tr>
            <td>
                <button onclick="mostrarVentanaNuevo()" style="font-size:24px; width:48%;" class="modal-button" name="estudianteNuevo" id="estudianteNuevo" type="button">Nuevo Estudiante</button>
                <button onclick="mostrarVentanaImportar()" style="font-size:24px; width:48%;" class="modal-button" name="estudiantesImportar" id="estudiantesImportar" type="button">Importar Estudiantes</button>
            </td>
        </tr>
        <tr>
            <td>
                <input onkeyup="buscarEstudiante(this)" id="buscadorEstudiantes" style="width:100%; font-size:24px;" type="text" placeholder="Buscar Estudiante..." />
            </td>
        </tr>
        <tr>
            <td id="tablaDatos">
            </td>
        </tr>
    </table>
</body>

<div class="modal" id="mEstudianteNuevo">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #1b396a;">
            <p class="modal-card-title" style=" color: white;">Nuevo Estudiante</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="insertarEstudiante(); return false;">
            <section class="modal-card-body">
                <div>
                    <label for="estudianteNuevoControl">Número de Control:</label>
                    <input value="<?php echo $anio.$numeroTecnologico; ?>" class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#1b396a; text-transform: uppercase;" id="estudianteNuevoControl" placeholder="N° de Control..." required>
                </div>
                <div>
                    <label for="estudianteNuevoPaterno">Apellido Paterno:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#1b396a; text-transform: uppercase;" id="estudianteNuevoPaterno" placeholder="Apellido Paterno..." required>
                </div>
                <div>
                    <label for="estudianteNuevoMaterno">Apellido Materno:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#1b396a; text-transform: uppercase;" id="estudianteNuevoMaterno" placeholder="Apellido Materno..." required>
                </div>
                <div>
                    <label for="estudianteNuevoNombre">Nombre(s):</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%; border-color:#1b396a; text-transform: uppercase;" id="estudianteNuevoNombre" placeholder="Nombres..." required>
                </div>
                <div>
                    <label for="dropCarrera">Carrera:</label>
                    <br>
                    <div style="width:100%; " id="dropCarrera" class="select">
                        <select style="width:100%; border-color:#1b396a;" id="estudianteNuevoCarrera">
                        </select>
                    </div>
                </div>
                <div>
                    <label for="dropIngreso">Semestre Ingreso:</label>
                    <br>
                    <div style="width:100%; " id="dropIngreso" class="select">
                        <select style="width:100%; border-color:#1b396a;" id="estudianteNuevoIngreso">
                            <option value="1">Enero-Junio</option>
                            <option value="2">Agosto-Diciembre</option>
                        </select>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button type="submit" class="button is-success modal-button">Guardar</button>
                <button onclick="cerrarModal()" style="background-color:#4E232E;" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>
