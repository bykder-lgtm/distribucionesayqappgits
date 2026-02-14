<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['nombre_correo_smtp']) <> '') { $nombre_correo_smtp = addslashes($_POST['nombre_correo_smtp']); } else { $nombre_correo_smtp = ''; }
	if (isset($_POST['nombre_alterno_correo_smtp']) <> '') { $nombre_alterno_correo_smtp = addslashes($_POST['nombre_alterno_correo_smtp']); } else { $nombre_alterno_correo_smtp = ''; }
	if (isset($_POST['contrasena_correo_smtp']) <> '') { $contrasena_correo_smtp = addslashes($_POST['contrasena_correo_smtp']); } else { $contrasena_correo_smtp = ''; }
	if (isset($_POST['contrasena_encrip_correo_smtp']) <> '') { $contrasena_encrip_correo_smtp = addslashes($_POST['contrasena_encrip_correo_smtp']); } else { $contrasena_encrip_correo_smtp = ''; }
	if (isset($_POST['contrasena_app_correo_smtp']) <> '') { $contrasena_app_correo_smtp = addslashes($_POST['contrasena_app_correo_smtp']); } else { $contrasena_app_correo_smtp = ''; }
	if (isset($_POST['host_correo_smtp']) <> '') { $host_correo_smtp = addslashes($_POST['host_correo_smtp']); } else { $host_correo_smtp = ''; }
	if (isset($_POST['auth_correo_smtp']) <> '') { $auth_correo_smtp = addslashes($_POST['auth_correo_smtp']); } else { $auth_correo_smtp = ''; }
	if (isset($_POST['secure_correo_smtp']) <> '') { $secure_correo_smtp = addslashes($_POST['secure_correo_smtp']); } else { $secure_correo_smtp = ''; }
	if (isset($_POST['port_correo_smtp']) <> '') { $port_correo_smtp = addslashes($_POST['port_correo_smtp']); } else { $port_correo_smtp = ''; }
	if (isset($_POST['cod_estado_correo_predeterminado']) <> '') { $cod_estado_correo_predeterminado = addslashes($_POST['cod_estado_correo_predeterminado']); } else { $cod_estado_correo_predeterminado = '1'; }
	if (isset($_POST['cod_estado']) <> '') { $cod_estado = addslashes($_POST['cod_estado']); } else { $cod_estado = '1'; }

	$agreg = "INSERT INTO tbl15_correo_smtp (nombre_correo_smtp, nombre_alterno_correo_smtp, contrasena_correo_smtp, contrasena_encrip_correo_smtp, contrasena_app_correo_smtp, 
	host_correo_smtp, auth_correo_smtp, secure_correo_smtp, port_correo_smtp, cod_estado_correo_predeterminado, cod_estado) 
	VALUES ('$nombre_correo_smtp', '$nombre_alterno_correo_smtp', '$contrasena_correo_smtp', '$contrasena_encrip_correo_smtp', '$contrasena_app_correo_smtp', 
	'$host_correo_smtp', '$auth_correo_smtp', '$secure_correo_smtp', '$port_correo_smtp', '$cod_estado_correo_predeterminado', '$cod_estado')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_correo_smtp.php">
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>