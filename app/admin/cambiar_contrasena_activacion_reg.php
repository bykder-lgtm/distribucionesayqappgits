<?php 
// Página de registro de cambio de contraseña para usuarios en espera de activación
session_set_cookie_params(60*60*24*2);
session_start();

// Verificar que el usuario tenga sesión iniciada
if (!isset($_SESSION['cod_administrador'])) {
	header("Location:../admin/entrar_escoger_intern.php");
	exit;
}
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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	$cod_administrador = intval($_POST['cod_administrador']);
	$contrasena = addslashes($_POST['contrasena']);

	// Actualizar contraseña
	$sql_data = sprintf("UPDATE tbl15_administrador SET contrasena = '$contrasena' WHERE cod_administrador = '$cod_administrador'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	// Actualizar estado de activación a ACTIVO (cod_estado_activacion_usuario = 1)
	$sql_activar = sprintf("UPDATE tbl15_administrador SET cod_estado_activacion_usuario = '1' WHERE cod_administrador = '$cod_administrador'");
	$exec_activar = mysqli_query($conectar, $sql_activar) or die(mysqli_error($conectar));

	// Actualizar la sesión para reflejar que ya no requiere cambio de contraseña
	$_SESSION['requiere_cambio_contrasena'] = false;
	$_SESSION['cod_estado_activacion_usuario'] = 1;

	// Redirigir a la página de bienvenida
	$pag_redirec = "../admin/bienvenida_animacion_flexitech_movil.php";
?>
<div class="ibody">
<div class="jumbotron"><h1>¡Cuenta Activada!</h1></div>
	<div class="fcontacto">
		<div class="alert alert-success">
			<strong>¡Cuenta activada exitosamente!</strong><br>
			Su contraseña ha sido actualizada y su cuenta está ahora activa.<br>
			Será redirigido automáticamente en unos segundos...
		</div>
	</div>
</div>
<META HTTP-EQUIV="REFRESH" CONTENT="2; <?php echo $pag_redirec?>">
<?php } else { ?>
<div class="ibody">
<div class="jumbotron"><h1>Error</h1></div>
	<div class="fcontacto">
		<div class="alert alert-danger">
			<strong>Error:</strong> No se pudo procesar la solicitud. Por favor intente nuevamente.
		</div>
		<a href="../admin/cambiar_contrasena_activacion.php" class="btn btn-primary btn-lg btn-block">Volver a intentar</a>
	</div>
</div>
<META HTTP-EQUIV="REFRESH" CONTENT="3; ../admin/cambiar_contrasena_activacion.php">
<?php } ?>
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
</body>
</html>