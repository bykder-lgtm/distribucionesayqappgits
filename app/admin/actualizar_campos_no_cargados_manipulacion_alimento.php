<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
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

<div class="breadcrumbs"><a href="#"><h4>ACTUALIZANDO</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//$fecha_hoy = date("Y/m/d");
$pagina                       = addslashes($_GET['pagina']);
$cod_historia_clinica         = intval($_GET['cod_historia_clinica']);
$cod_manipulacion_alimento    = intval($_GET['cod_manipulacion_alimento']);
$cod_cliente                  = intval($_GET['cod_cliente']);

$pagina_redirec = $pagina.'?cod_manipulacion_alimento='.$cod_manipulacion_alimento.'&cod_cliente='.$cod_cliente.'&cod_historia_clinica='.$cod_historia_clinica.'&pagina='.$pagina;

if (isset($_GET['cod_manipulacion_alimento'])) {

$obtener_estructura_hist_clinica = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica, 
nombre_empresa, cargo_empresa, area_empresa
FROM tbl15_historia_clinica WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_estructura_hist_clinica = mysqli_query($conectar, $obtener_estructura_hist_clinica) or die(mysqli_error($conectar));
$info_estructura_hist_clinica= mysqli_fetch_assoc($consultar_estructura_hist_clinica);

$nombre_empresa                    = $info_estructura_hist_clinica['nombre_empresa'];
$cargo_empresa                     = $info_estructura_hist_clinica['cargo_empresa'];
$area_empresa                      = $info_estructura_hist_clinica['area_empresa'];

$obtener_empresa= "SELECT razonsocial_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '".($nombre_empresa)."'";
$consultar_empresa= mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$tbl15_info_empresa= mysqli_fetch_assoc($consultar_empresa);

$razonsocial_empresa                 = $tbl15_info_empresa['razonsocial_empresa'];
$direccion_empresa                   = $tbl15_info_empresa['direccion_empresa'];
$telefono_empresa                    = $tbl15_info_empresa['telefono_empresa'];
$nit_empresa                         = $tbl15_info_empresa['nit_empresa'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$actualizar_info_trabaltura= "UPDATE tbl15_manipulacion_alimento SET nombre_empresa = '$nombre_empresa', 
cargo_empresa = '$cargo_empresa', area_empresa = '$area_empresa' WHERE cod_manipulacion_alimento = '$cod_manipulacion_alimento'";
$resultado_info_trabaltura = mysqli_query($conectar, $actualizar_info_trabaltura) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
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
</body>
</html>