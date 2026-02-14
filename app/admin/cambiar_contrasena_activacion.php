<?php 
// Página de cambio de contraseña para usuarios en espera de activación
// No requiere verificación de seguridad estándar ya que el usuario está en proceso de activación
session_set_cookie_params(60*60*24*2);
session_start();

// Verificar que el usuario tenga sesión iniciada y que requiera cambio de contraseña
if (!isset($_SESSION['cod_administrador']) || !isset($_SESSION['requiere_cambio_contrasena']) || $_SESSION['requiere_cambio_contrasena'] !== true) {
	// Si no tiene sesión o no requiere cambio de contraseña, redirigir al login
	header("Location:../admin/entrar_escoger_intern.php");
	exit;
}

$cod_administrador = intval($_SESSION['cod_administrador']);
?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_libre.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/fondo_dasboard_login.css" rel="stylesheet">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../menu/03_menu_navegacion_libre_entrar.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div class="imagen_fondo_login"></div>
<div class="container-fluid h-100 content">
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ($cod_administrador == 0) {
	echo '<div class="alert alert-danger">Error: No se pudo obtener la información del usuario. Por favor inicie sesión nuevamente.</div>';
	echo '<a href="../admin/entrar_escoger_intern.php" class="btn btn-primary">Volver a iniciar sesión</a>';
	exit;
}

$mostrar_datos_sql = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombres = $matriz_consulta['nombres'];
$apellidos = $matriz_consulta['apellidos'];
$cuenta = $matriz_consulta['cuenta'];
?>

<div class="ibody">
<div class="jumbotron"><h1>Activación de Cuenta</h1></div>
	<div class="fcontacto">

		<div class="alert alert-warning">
			<strong>¡Importante!</strong> Su cuenta está en espera de activación. 
			Por favor, cambie su contraseña para activar su cuenta y poder acceder normalmente al sistema.
		</div>
		
		<div class="alert alert-info">
			<strong>Usuario:</strong> <?php echo $cuenta; ?><br>
			<strong>Nombre:</strong> <?php echo $nombres.' '.$apellidos; ?>
		</div>

		<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/cambiar_contrasena_activacion_reg.php">
			<input type="password" class="form-control" name="contrasena" id="pass" placeholder="Nueva Contraseña" required=""/>
			<input type="password" class="form-control" name="contrasena_confirmar" id="pass_confirmar" placeholder="Confirmar Contraseña" required=""/>
			<br><br>
			<input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>"/>
			<input type="hidden" name="ins_edit" value="formulario_insert_edit">
			<button class="btn btn-lg btn-success btn-block" type="submit" id="submitButton" onclick="return validarYCifrar();">Activar Cuenta y Cambiar Contraseña</button>
		</form>
	</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<br><br><br><br><br><br><br><br><br><br>
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

<script src="js/sha1.js"></script>
<script>
function validarYCifrar(){
	var pass1 = document.getElementById("pass").value;
	var pass2 = document.getElementById("pass_confirmar").value;
	
	if (pass1 !== pass2) {
		alert("Las contraseñas no coinciden. Por favor, verifique.");
		return false;
	}
	
	if (pass1.length < 4) {
		alert("La contraseña debe tener al menos 4 caracteres.");
		return false;
	}
	
	document.getElementById("pass").value = sha1(pass1);
	document.getElementById("pass_confirmar").value = sha1(pass2);
	return true;
}
</script>
</body>
</html>