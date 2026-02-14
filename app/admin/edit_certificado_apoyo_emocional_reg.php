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
if (isset($_POST["cod_certificado_apoyo_emocional"])) {

	if (isset($_POST['cod_certificado_apoyo_emocional']) <> '') { $cod_certificado_apoyo_emocional = intval($_POST['cod_certificado_apoyo_emocional']); } else { $cod_certificado_apoyo_emocional = ''; }
	if (isset($_POST['estructura_todo_certificado_apoyo_emocional_esp']) <> '') { $estructura_todo_certificado_apoyo_emocional_esp = addslashes($_POST['estructura_todo_certificado_apoyo_emocional_esp']); } else { $estructura_todo_certificado_apoyo_emocional_esp = ''; }
	if (isset($_POST['estructura_todo_certificado_apoyo_emocional_eng']) <> '') { $estructura_todo_certificado_apoyo_emocional_eng = addslashes($_POST['estructura_todo_certificado_apoyo_emocional_eng']); } else { $estructura_todo_certificado_apoyo_emocional_eng = ''; }
	if (isset($_POST['nombre_propietario_mascota']) <> '') { $nombre_propietario_mascota = addslashes($_POST['nombre_propietario_mascota']); } else { $nombre_propietario_mascota = ''; }
	if (isset($_POST['documento_propietario_mascota']) <> '') { $documento_propietario_mascota = addslashes($_POST['documento_propietario_mascota']); } else { $documento_propietario_mascota = ''; }
	if (isset($_POST['direccion_propietario_mascota']) <> '') { $direccion_propietario_mascota = addslashes($_POST['direccion_propietario_mascota']); } else { $direccion_propietario_mascota = ''; }
	if (isset($_POST['correo_propietario_mascota']) <> '') { $correo_propietario_mascota = addslashes($_POST['correo_propietario_mascota']); } else { $correo_propietario_mascota = ''; }
	if (isset($_POST['nombre_mascota']) <> '') { $nombre_mascota = addslashes($_POST['nombre_mascota']); } else { $nombre_mascota = ''; }
	if (isset($_POST['edad_mascota']) <> '') { $edad_mascota = addslashes($_POST['edad_mascota']); } else { $edad_mascota = ''; }
	if (isset($_POST['nombre_raza_mascota']) <> '') { $nombre_raza_mascota = addslashes($_POST['nombre_raza_mascota']); } else { $nombre_raza_mascota = ''; }
	if (isset($_POST['color_mascota']) <> '') { $color_mascota = addslashes($_POST['color_mascota']); } else { $color_mascota = ''; }
	if (isset($_POST['peso_mascota']) <> '') { $peso_mascota = addslashes($_POST['peso_mascota']); } else { $peso_mascota = ''; }
	if (isset($_POST['talla_mascota']) <> '') { $talla_mascota = addslashes($_POST['talla_mascota']); } else { $talla_mascota = ''; }
	if (isset($_POST['fecha_certificado_apoyo_emocional']) <> '') { $fecha_certificado_apoyo_emocional = addslashes($_POST['fecha_certificado_apoyo_emocional']); } else { $fecha_certificado_apoyo_emocional = ''; }
	$cuenta                                                            = $cuenta_actual;
	$cod_administrador                                                 = $cod_administrador;
	$cod_estado                                                        = 1;
    $cod_certificado_apoyo_emocional_codif                             = DAXCODIFCRYPTOR::encodifdax($cod_certificado_apoyo_emocional);
    $cod_certificado_apoyo_emocional_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($cod_certificado_apoyo_emocional_codif);

	$sql_data = ('UPDATE tbl15_certificado_apoyo_emocional SET 
	estructura_todo_certificado_apoyo_emocional_esp ="'.$estructura_todo_certificado_apoyo_emocional_esp.'", 
	estructura_todo_certificado_apoyo_emocional_eng ="'.$estructura_todo_certificado_apoyo_emocional_eng.'", 
	nombre_propietario_mascota ="'.$nombre_propietario_mascota.'", 
	documento_propietario_mascota ="'.$documento_propietario_mascota.'", 
	direccion_propietario_mascota ="'.$direccion_propietario_mascota.'", 
	correo_propietario_mascota ="'.$correo_propietario_mascota.'", 
	nombre_mascota ="'.$nombre_mascota.'", 
	edad_mascota ="'.$edad_mascota.'", 
	nombre_raza_mascota ="'.$nombre_raza_mascota.'", 
	color_mascota ="'.$color_mascota.'", 
	peso_mascota ="'.$peso_mascota.'", 
	talla_mascota ="'.$talla_mascota.'", 
	fecha_certificado_apoyo_emocional ="'.$fecha_certificado_apoyo_emocional.'", 
	cuenta ="'.$cuenta.'", 
	cod_administrador ="'.$cod_administrador.'", 
	cod_estado ="'.$cod_estado.'"
	WHERE cod_certificado_apoyo_emocional = "'.$cod_certificado_apoyo_emocional.'"');
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$pagina                       = '../admin/lista_certificado_apoyo_emocional.php'."?cod_certificado_apoyo_emocional=".$cod_certificado_apoyo_emocional."&cod_certificado_apoyo_emocional_codifcryp=".$cod_certificado_apoyo_emocional_codifcryp;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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