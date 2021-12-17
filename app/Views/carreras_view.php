<script>

    $(document).ready(function(){
        cargarCarreras();
    });

    function mostrarVentanaNuevo(){
        $("#mCarreraNuevo").addClass("is-active");
    }
    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

    function cargarCarreras(){
        $.ajax({
            url: "<?php echo site_url('Carrera/cargarTablaCarrera'); ?>",
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
    
    function insertarCarrera(){
        var carrera=document.getElementById('carreraNuevoNombre').value.toUpperCase();
        var Carrera={
            nombre_carrera:carrera           
        };
        $.ajax({
            url: "<?php echo site_url('Carrera/insertarCarrera'); ?>",
            method: "POST",
            data: {
                Carrera: Carrera
            },
            success: function() {
                alert("Carrera Registrada");
                cargarCarreras();
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
                <button onclick="mostrarVentanaNuevo()" style="font-size:24px; width:48%;" class="modal-button" name="carreraNuevo" id="carreraNuevo" type="button">Nueva Carrera</button>
                <button onclick="mostrarVentanaImportar()" style="font-size:24px; width:48%;" class="modal-button" name="carrerasImportar" id="carrerasImportar" type="button">Importar Carreras</button>
            </td>
        </tr>
        <tr>
            <td id="tablaDatos">
            </td>
        </tr>
    </table>
</body>

<div class="modal" id="mCarreraNuevo">
    <div class="modal-background"></div>
    <div class="modal-card" style="position:absolute; top:50px;">
        <header class="modal-card-head" style="background-color: #1b396a;">
            <p class="modal-card-title" style=" color: white;">Nuevo Carrera</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
        <form action="#" onsubmit="insertarCarrera(); return false;">
            <section class="modal-card-body">
                <div>
                    <label for="carreraNuevoNombre">Nombre de la Carrera:</label>
                    <input class="input is-rounded is-primary" type="text" style="width:100%;  border-color:#1b396a; text-transform: uppercase;" id="carreraNuevoNombre" placeholder="Nombre..." required>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button type="submit" class="button is-success modal-button">Guardar</button>
                <button onclick="cerrarModal()" style="background-color:#4E232E;" class="button is-delete modal-button">Cancelar</button>
            </footer>
        </form>
    </div>
</div>
