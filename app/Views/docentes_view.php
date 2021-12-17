<script>

    $(document).ready(function(){
        cargarDocentes();
    });

    function mostrarVentanaNuevo(){
        $("#mDocenteNuevo").addClass("is-active");
    }
    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

    function cargarDocentes(){
        $.ajax({
            url: "<?php echo site_url('Docente/cargarTablaDocente'); ?>",
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
    
    function insertarDocente(){
        var Docente=document.getElementById('docenteNuevoNombre').value.toUpperCase();
        var Docente={
            nombre_Docente:Docente           
        };
        $.ajax({
            url: "<?php echo site_url('docente/insertarDocente'); ?>",
            method: "POST",
            data: {
                Docente: Docente
            },
            success: function() {
                alert("Docente Registrado");
                cargarDocentes();
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
<body>
<table style="width:100%;">
        <tr>
            <td>
                <button onclick="mostrarVentanaNuevo()" style="font-size:24px; width:48%;" class="modal-button" name="DocenteNuevo" id="DocenteNuevo" type="button">Nuevo Docente</button>
                <button onclick="mostrarVentanaImportar()" style="font-size:24px; width:48%;" class="modal-button" name="DocentesImportar" id="DocentesImportar" type="button">Importar Docentes</button>
            </td>
        </tr>
        <tr>
            <td id="tablaDatos">
            </td>
        </tr>
    </table>
</body>

<div class="modal" id="mDocenteNuevo">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #1b396a;">
            <p class="modal-card-title" style=" color: white;">Nuevo Docente</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="insertarDocente(); return false;">
            <section class="modal-card-body">
                <div>
                    <label for="DocenteNuevoNombre">Nombre de la Docente:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#1b396a; text-transform: uppercase;" id="DocenteNuevoNombre" placeholder="Nombre..." required>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button type="submit" class="button is-success modal-button">Guardar</button>
                <button onclick="cerrarModal()" style="background-color:#4E232E;" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>
