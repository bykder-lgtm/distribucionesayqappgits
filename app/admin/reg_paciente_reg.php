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
//$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['nombres']) <> '') { $nombres = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombres']))); } else { $nombres = ''; }
if (isset($_POST['nombre_especie']) <> '') { $nombre_especie = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_especie']))); } else { $nombre_especie = ''; }
if (isset($_POST['nombre_raza']) <> '') { $nombre_raza = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_raza']))); } else { $nombre_raza = ''; }
if (isset($_POST['nombre_color']) <> '') { $nombre_color = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_color']))); } else { $nombre_color = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_sexo']))); } else { $nombre_sexo = ''; }
if (isset($_POST['fecha_nac_ymd']) <> '') { $fecha_nac_ymd = mysqli_real_escape_string($conectar,(($_POST['fecha_nac_ymd']))); } else { $fecha_nac_ymd = ''; }
if (isset($_POST['edad_anyo']) <> '') { $edad_anyo = mysqli_real_escape_string($conectar,(($_POST['edad_anyo']))); } else { $edad_anyo = ''; }
if (isset($_POST['edad_mes']) <> '') { $edad_mes = mysqli_real_escape_string($conectar,(($_POST['edad_mes']))); } else { $edad_mes = ''; }
if (isset($_POST['senas_particulares']) <> '') { $senas_particulares = mysqli_real_escape_string($conectar,(($_POST['senas_particulares']))); } else { $senas_particulares = ''; }
if (isset($_POST['nombre_procedencia']) <> '') { $nombre_procedencia = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_procedencia']))); } else { $nombre_procedencia = ''; }
if (isset($_POST['nombre_contacto1']) <> '') { $nombre_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_contacto1']))); } else { $nombre_contacto1 = ''; }
if (isset($_POST['identificacion_contacto1']) <> '') { $identificacion_contacto1 = mysqli_real_escape_string($conectar,(($_POST['identificacion_contacto1']))); } else { $identificacion_contacto1 = ''; }
if (isset($_POST['direccion_contacto1']) <> '') { $direccion_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['direccion_contacto1']))); } else { $direccion_contacto1 = ''; }
if (isset($_POST['estrato_contacto1']) <> '') { $estrato_contacto1 = intval($_POST['estrato_contacto1']); } else { $estrato_contacto1 = ''; }
if (isset($_POST['municipio_contacto1']) <> '') { $municipio_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['municipio_contacto1']))); } else { $municipio_contacto1 = ''; }
if (isset($_POST['tel_contacto1']) <> '') { $tel_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['tel_contacto1']))); } else { $tel_contacto1 = ''; }
if (isset($_POST['ocupacion_contacto1']) <> '') { $ocupacion_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['ocupacion_contacto1']))); } else { $ocupacion_contacto1 = ''; }
if (isset($_POST['correo_contacto1']) <> '') { $correo_contacto1 = mysqli_real_escape_string($conectar,(($_POST['correo_contacto1']))); } else { $correo_contacto1 = ''; }
if (isset($_POST['cod_empresa']) <> '') { $cod_empresa = intval($_POST['cod_empresa']); } else { $cod_empresa = ''; }

$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cliente'";
$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
$cod_cliente = $datos_autoincremento_sesion['AUTO_INCREMENT'];

$sql_autoincremento_empresa = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_empresa'";
$exec_autoincremento_empresa = mysqli_query($conectar, $sql_autoincremento_empresa) or die(mysqli_error($conectar));
$datos_autoincremento_empresa = mysqli_fetch_assoc($exec_autoincremento_empresa);

$fecha_nac_time                    = strtotime($fecha_nac_ymd);
$fecha_time                        = time();
$cedula                            = $cod_cliente;
$nombre_tipo_tercero               = 'CLIENTE';

$sql_empresa = "SELECT cod_empresa FROM tbl15_empresa WHERE nit_empresa = '$identificacion_contacto1'";
$consulta_empresa = mysqli_query($conectar, $sql_empresa) or die(mysqli_error($conectar));
$datos_empresa = mysqli_fetch_assoc($consulta_empresa);
$existe_empresa = mysqli_num_rows($consulta_empresa);
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////// */

if ($existe_empresa == '0') {
$cod_empresa                       = $datos_autoincremento_empresa['AUTO_INCREMENT'];

$sql_data = "INSERT INTO tbl15_empresa (nombre_empresa, nit_empresa, direccion_empresa, estrato_empresa, municipio_empresa, telefono_empresa, correo_empresa, ocupacion_empresa, nombre_tipo_tercero) 
VALUES ('$nombre_contacto1', '$identificacion_contacto1', '$direccion_contacto1', '$estrato_contacto1', '$municipio_contacto1', '$tel_contacto1', '$correo_contacto1', '$ocupacion_contacto1', '$nombre_tipo_tercero')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "INSERT INTO tbl15_cliente (cedula, nombres, nombre_especie, nombre_raza, nombre_color, nombre_sexo, 
fecha_nac_ymd, edad_anyo, edad_mes, senas_particulares, nombre_procedencia, nombre_contacto1, 
identificacion_contacto1, direccion_contacto1, correo_contacto1, estrato_contacto1, municipio_contacto1, tel_contacto1, 
ocupacion_contacto1, fecha_nac_time, fecha_time, cod_empresa) 
VALUES ('$cedula', '$nombres', '$nombre_especie', '$nombre_raza', '$nombre_color', '$nombre_sexo', 
'$fecha_nac_ymd', '$edad_anyo', '$edad_mes', '$senas_particulares', '$nombre_procedencia', '$nombre_contacto1', 
'$identificacion_contacto1', '$direccion_contacto1', '$correo_contacto1', '$estrato_contacto1', '$municipio_contacto1', '$tel_contacto1', 
'$ocupacion_contacto1', '$fecha_nac_time', '$fecha_time', '$cod_empresa')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} else {
$cod_empresa                       = $datos_empresa['cod_empresa'];

$sql_data = "INSERT INTO tbl15_cliente (cedula, nombres, nombre_especie, nombre_raza, nombre_color, nombre_sexo, 
fecha_nac_ymd, edad_anyo, edad_mes, senas_particulares, nombre_procedencia, nombre_contacto1, 
identificacion_contacto1, direccion_contacto1, correo_contacto1, estrato_contacto1, municipio_contacto1, tel_contacto1, 
ocupacion_contacto1, fecha_nac_time, fecha_time, cod_empresa) 
VALUES ('$cedula', '$nombres', '$nombre_especie', '$nombre_raza', '$nombre_color', '$nombre_sexo', 
'$fecha_nac_ymd', '$edad_anyo', '$edad_mes', '$senas_particulares', '$nombre_procedencia', '$nombre_contacto1', 
'$identificacion_contacto1', '$direccion_contacto1', '$correo_contacto1', '$estrato_contacto1', '$municipio_contacto1', '$tel_contacto1', 
'$ocupacion_contacto1', '$fecha_nac_time', '$fecha_time', '$cod_empresa')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_crear_cita_foto_paciente.php?">
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