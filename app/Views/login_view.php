<script>
	
	$session=session();

    function cerrarModal(){
        $(".modal").removeClass("is-active");
    }

	
    function mostrarLoginDocente(){
        $("#loginDocente").addClass("is-active");
    }

	function mostrarLoginAlumno(){
		$("#loginAlumno").addClass("is-active");
	}

</script>
<?php
	$session=session();
	//verificamos si la llegada del usuario es por un error al intentar iniciar sesión
	if(isset($_SESSION['flashdata']['errorLogin'])){
		//mostramos un mensaje de error
        echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos');</script>";
    }
	//independientemente del motivo, al llegar a esta página se vacía la sesión
	session_unset();
?>
<!DOCTYPE html>
<html>

<head>
	<!--Fuente de texto-->
	<script src="https://use.fontawesome.com/4a3b3d9687.js"></script>
	<!--Javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
	<link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\SICOSAC\css\login.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SICOSAC - Iniciar Sesión</title>
</head>
<body>
	<section class="hero is-success is-fullheight" style="background-color:silver;">
		<div class="hero-body" style="height:100%;">
			<div class="container has-text-centered" style="height:100%;">
				<div class="column is-6 is-offset-3" style="height:100%;">
					<figure class="avatar">
						<img src="https://i.ibb.co/x8L8Cc0/SICOSAC.png" alt="SICOSAC" border="0">
					</figure>
					<hr class="login-hr">
					<p class="subtitle has-text-black">Iniciar Sesión.</p>
					<div class="box" style="height:80%;width:auto; background-color:white">
						<table style="width:100%;">
							<tr>
								<td style="width:45%;">
									<button onclick="mostrarLoginDocente()" class="button is-rounded is-large " style="width:100%; background-color:#1B396A;color:white;">Docente</button>
								</td>
								<td style="width:10%;"></td>
								<td style="width:45%;">
									<button onclick="mostrarLoginAlumno()" class="button is-rounded is-large " style="width:100%; background-color:#1B396A;color:white;">Alumno</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

<div class="modal" id="loginDocente">
	<div class="modal-background"></div>
	<div class="modal-card" >
        <header class="modal-card-head" style="background-color: #1B396A;">
            <p class="modal-card-title" style=" color: white;">Docentes/Administrativos</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
	<section class="hero is-success"  style="background-color:silver;">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-10 is-offset-1">
					<div class="box">
						<form action="<?php echo site_url('login/authDocente');?>" method="post">
							<div class="field">
								<div class="control">
									<input name="usuarioDocente" class="input is-large" type="email" placeholder="Correo Electrónico" autofocus="">
								</div>
							</div>

							<div class="field">
								<div class="control">
									<input name="passwordDocente" class="input is-large" type="password" placeholder="Contraseña">
								</div>
							</div>
							<button style="background-color:#1B396A;" class="button is-block is-info is-large is-fullwidth">Acceder <i class="fa fa-sign-in" aria-hidden="true"></i></button>
						</form>
					</div>
					<p class="has-text-grey">
						<a style="color:black;" href="../">Reestablecer Contraseña</a> &nbsp;·&nbsp;
					</p>
				</div>
			</div>
		</div>
	</section>
    </div>
</div>

<div class="modal" id="loginAlumno">
	<div class="modal-background"></div>
	<div class="modal-card" >
        <header class="modal-card-head" style="background-color: #1B396A;">
            <p class="modal-card-title" style=" color: white;">Alumnos</p>
            <button onclick="cerrarModal()" class="delete" aria-label="close"></button>
        </header>
	<section class="hero is-success"  style="background-color:silver;">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-10 is-offset-1">
					<div class="box">
						<form action="<?php echo site_url('login/authAlumno');?>" method="post">
							<div class="field">
								<div class="control">
									<input class="input is-large" type="text" placeholder="N° de Control" autofocus="">
								</div>
							</div>

							<div class="field">
								<div class="control">
									<input class="input is-large" type="password" placeholder="Contraseña">
								</div>
							</div>
							<button style="background-color:#1B396A;" class="button is-block is-info is-large is-fullwidth">Acceder <i class="fa fa-sign-in" aria-hidden="true"></i></button>
						</form>
					</div>
					<p class="has-text-grey">
						<a style="color:black;" href="../">Reestablecer Contraseña</a> &nbsp;·&nbsp;
					</p>
				</div>
			</div>
		</div>
	</section>
    </div>
</div>

</html>