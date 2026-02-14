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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_tercero                   = intval($_POST['cod_tercero']);
if (isset($_POST['nombre_tipo_tercero']) <> '') { $nombre_tipo_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_tercero'])); } else { $nombre_tipo_tercero = ''; }
if (isset($_POST['nombre_tipo_identificacion']) <> '') { $nombre_tipo_identificacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_identificacion'])); } else { $nombre_tipo_identificacion = ''; }
if (isset($_POST['identificacion_tercero']) <> '') { $identificacion_tercero = mysqli_real_escape_string($conectar, ($_POST['identificacion_tercero'])); } else { $identificacion_tercero = ''; }
if (isset($_POST['digito_tercero']) <> '') { $digito_tercero = mysqli_real_escape_string($conectar, ($_POST['digito_tercero'])); } else { $digito_tercero = ''; }
if (isset($_POST['nombre1_tercero']) <> '') { $nombre1_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
if (isset($_POST['nombre2_tercero']) <> '') { $nombre2_tercero = mysqli_real_escape_string($conectar, ($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
if (isset($_POST['apellido1_tercero']) <> '') { $apellido1_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
if (isset($_POST['apellido2_tercero']) <> '') { $apellido2_tercero = mysqli_real_escape_string($conectar, ($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
if (isset($_POST['direccion_tercero']) <> '') { $direccion_tercero = mysqli_real_escape_string($conectar, ($_POST['direccion_tercero'])); } else { $direccion_tercero = ''; }
if (isset($_POST['telefono1_tercero']) <> '') { $telefono1_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono1_tercero'])); } else { $telefono1_tercero = ''; }
if (isset($_POST['telefono2_tercero']) <> '') { $telefono2_tercero = mysqli_real_escape_string($conectar, ($_POST['telefono2_tercero'])); } else { $telefono2_tercero = ''; }
if (isset($_POST['correo_tercero']) <> '') { $correo_tercero = addslashes($_POST['correo_tercero']); } else { $correo_tercero = ''; }
if (isset($_POST['nombre_pais']) <> '') { $nombre_pais = mysqli_real_escape_string($conectar, ($_POST['nombre_pais'])); } else { $nombre_pais = ''; }
if (isset($_POST['nombre_departamento']) <> '') { $nombre_departamento = mysqli_real_escape_string($conectar, ($_POST['nombre_departamento'])); } else { $nombre_departamento = ''; }
if (isset($_POST['nombre_ciudad']) <> '') { $nombre_ciudad = mysqli_real_escape_string($conectar, ($_POST['nombre_ciudad'])); } else { $nombre_ciudad = ''; }
if (isset($_POST['nombre_tipo_cliente']) <> '') { $nombre_tipo_cliente = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cliente'])); } else { $nombre_tipo_cliente = ''; }
if (isset($_POST['nombre_tipo_regimen']) <> '') { $nombre_tipo_regimen = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_regimen'])); } else { $nombre_tipo_regimen = ''; }
if (isset($_POST['nombre_tipo_impuesto']) <> '') { $nombre_tipo_impuesto = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_impuesto'])); } else { $nombre_tipo_impuesto = ''; }
if (isset($_POST['contacto_tercero']) <> '') { $contacto_tercero = mysqli_real_escape_string($conectar, ($_POST['contacto_tercero'])); } else { $contacto_tercero = ''; }
if (isset($_POST['fax_tercero']) <> '') { $fax_tercero = mysqli_real_escape_string($conectar, ($_POST['fax_tercero'])); } else { $fax_tercero = ''; }
if (isset($_POST['fecha_nac_tercero']) <> '') { $fecha_nac_tercero = mysqli_real_escape_string($conectar, ($_POST['fecha_nac_tercero'])); } else { $fecha_nac_tercero = ''; }
if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = ''; }
if (isset($_POST['cod_estado']) <> '') { $cod_estado = intval($_POST['cod_estado']); } else { $cod_estado = ''; }

if (isset($_POST['cod_solicitud_arriendo']) <> '') { $cod_solicitud_arriendo = intval($_POST['cod_solicitud_arriendo']); } else { $cod_solicitud_arriendo = ''; }
if (isset($_POST['tiempo_contrato_solicitud_arriendo']) <> '') { $tiempo_contrato_solicitud_arriendo = intval($_POST['tiempo_contrato_solicitud_arriendo']); } else { $tiempo_contrato_solicitud_arriendo = ''; }
if (isset($_POST['valor_solicitud_arriendo']) <> '') { $valor_solicitud_arriendo = intval($_POST['valor_solicitud_arriendo']); } else { $valor_solicitud_arriendo = ''; }
if (isset($_POST['fecha_solicitud_arriendo']) <> '') { $fecha_solicitud_arriendo = addslashes($_POST['fecha_solicitud_arriendo']); } else { $fecha_solicitud_arriendo = ''; }
if (isset($_POST['nombre_estado_solicitud_arriendo']) <> '') { $nombre_estado_solicitud_arriendo = addslashes($_POST['nombre_estado_solicitud_arriendo']); } else { $nombre_estado_solicitud_arriendo = ''; }
if (isset($_POST['nombre_tipo_solicitud']) <> '') { $nombre_tipo_solicitud = addslashes($_POST['nombre_tipo_solicitud']); } else { $nombre_tipo_solicitud = ''; }

if (isset($_POST['valor_solicitud_arriendo_hidden']) <> '') { $valor_solicitud_arriendo = intval($_POST['valor_solicitud_arriendo_hidden']); } else { $valor_solicitud_arriendo = ''; }
if (isset($_POST['nombre_tipo_producto']) <> '') { $nombre_tipo_producto = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_producto'])); } else { $nombre_tipo_producto = ''; }


$sql_data = sprintf("UPDATE tbl15_tercero SET nombre_tipo_tercero = '$nombre_tipo_tercero', nombre_tipo_identificacion = '$nombre_tipo_identificacion', 
identificacion_tercero = '$identificacion_tercero', digito_tercero = '$digito_tercero', nombre1_tercero = '$nombre1_tercero', 
nombre2_tercero = '$nombre2_tercero', apellido1_tercero = '$apellido1_tercero', apellido2_tercero = '$apellido2_tercero', 
direccion_tercero = '$direccion_tercero', telefono1_tercero = '$telefono1_tercero', telefono2_tercero = '$telefono2_tercero', 
nombre_pais = '$nombre_pais', nombre_departamento = '$nombre_departamento', nombre_ciudad = '$nombre_ciudad', nombre_tipo_cliente = '$nombre_tipo_cliente', 
nombre_tipo_regimen = '$nombre_tipo_regimen', nombre_tipo_impuesto = '$nombre_tipo_impuesto', contacto_tercero = '$contacto_tercero', fax_tercero = '$fax_tercero', 
fecha_nac_tercero = '$fecha_nac_tercero', correo_tercero = '$correo_tercero', cod_administrador = '$cod_administrador', cod_estado = '$cod_estado', 
cod_solicitud_arriendo = '$cod_solicitud_arriendo', tiempo_contrato_solicitud_arriendo = '$tiempo_contrato_solicitud_arriendo', 
valor_solicitud_arriendo = '$valor_solicitud_arriendo', fecha_solicitud_arriendo = '$fecha_solicitud_arriendo', 
nombre_estado_solicitud_arriendo = '$nombre_estado_solicitud_arriendo', nombre_tipo_solicitud = '$nombre_tipo_solicitud', nombre_tipo_producto = '$nombre_tipo_producto'
WHERE cod_tercero = '$cod_tercero'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$pagina                       = addslashes($_POST['pagina']);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_solicitud_arriendo_inquilino.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_solicitud_arriendo_inquilino.php">
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