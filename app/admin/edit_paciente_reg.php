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
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////// */
$cod_cliente                   = intval($_POST['cod_cliente']);
if (isset($_POST['nombres']) <> '') { $nombres = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombres']))); } else { $nombres = ''; }
if (isset($_POST['nombre_especie']) <> '') { $nombre_especie = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_especie']))); } else { $nombre_especie = ''; }
if (isset($_POST['nombre_raza']) <> '') { $nombre_raza = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_raza']))); } else { $nombre_raza = ''; }
if (isset($_POST['nombre_color']) <> '') { $nombre_color = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_color']))); } else { $nombre_color = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_sexo']))); } else { $nombre_sexo = ''; }
if (isset($_POST['fecha_nac_ymd']) <> '') { $fecha_nac_ymd = mysqli_real_escape_string($conectar,(($_POST['fecha_nac_ymd']))); } else { $fecha_nac_ymd = ''; }
if (isset($_POST['edad_anyo']) <> '') { $edad_anyo = mysqli_real_escape_string($conectar,(strtoupper($_POST['edad_anyo']))); } else { $edad_anyo = ''; }
if (isset($_POST['senas_particulares']) <> '') { $senas_particulares = mysqli_real_escape_string($conectar,(($_POST['senas_particulares']))); } else { $senas_particulares = ''; }
if (isset($_POST['nombre_procedencia']) <> '') { $nombre_procedencia = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_procedencia']))); } else { $nombre_procedencia = ''; }
if (isset($_POST['cod_empresa']) <> '') { $cod_empresa = intval($_POST['cod_empresa']); } else { $cod_empresa = ''; }
$fecha_nac_time                = strtotime($fecha_nac_ymd);
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////// */
$sql_empresa = "SELECT * FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$consulta_empresa = mysqli_query($conectar, $sql_empresa) or die(mysqli_error($conectar));
$total = mysqli_num_rows($consulta_empresa);
$matriz_empresa = mysqli_fetch_assoc($consulta_empresa);

$nombre_contacto1              = $matriz_empresa['nombre_empresa'];
$identificacion_contacto1      = $matriz_empresa['nit_empresa'];
$direccion_contacto1           = $matriz_empresa['direccion_empresa'];
$estrato_contacto1             = $matriz_empresa['nit_empresa'];
$municipio_contacto1           = $matriz_empresa['estrato_empresa'];
$tel_contacto1                 = $matriz_empresa['municipio_empresa'];
$ocupacion_contacto1           = $matriz_empresa['ocupacion_empresa'];
$correo_contacto1              = $matriz_empresa['correo_empresa'];
/* //////////////////////////////////////////////////////////////////////////////////////////////////////////// */
$actualizar_historia_clinica = "UPDATE tbl15_cliente SET nombres = '$nombres', nombre_especie = '$nombre_especie', nombre_raza = '$nombre_raza', 
nombre_color = '$nombre_color', nombre_sexo = '$nombre_sexo', fecha_nac_ymd = '$fecha_nac_ymd', edad_anyo = '$edad_anyo', senas_particulares = '$senas_particulares', 
nombre_procedencia = '$nombre_procedencia', nombre_contacto1 = '$nombre_contacto1', identificacion_contacto1 = '$identificacion_contacto1', 
direccion_contacto1 = '$direccion_contacto1', estrato_contacto1 = '$estrato_contacto1', municipio_contacto1 = '$municipio_contacto1', 
tel_contacto1 = '$tel_contacto1', correo_contacto1 = '$correo_contacto1', ocupacion_contacto1 = '$ocupacion_contacto1', cod_empresa = '$cod_empresa'
WHERE cod_cliente = '$cod_cliente'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_paciente.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_paciente.php">
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