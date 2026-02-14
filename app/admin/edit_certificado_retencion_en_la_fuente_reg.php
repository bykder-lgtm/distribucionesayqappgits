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
$cod_administrador                  = ($_SESSION['cod_administrador']);

if (isset($_POST["cod_tercero"])) {

    $cod_tercero                                          = intval($_POST['cod_tercero']);
    $fecha_ini_certificado_retefuente                     = addslashes($_POST['fecha_ini_certificado_retefuente']);
    $fecha_fin_certificado_retefuente                     = addslashes($_POST['fecha_fin_certificado_retefuente']);
    $nombre_rete_fuente_ptj                               = addslashes($_POST['nombre_rete_fuente_ptj']);
    $subtotal_base_retencion                              = addslashes($_POST['subtotal_base_retencion']);
    $total_retefuente_valor_retenido                      = addslashes($_POST['total_retefuente_valor_retenido']);

	$sql_data = sprintf("UPDATE tbl15_certificado_retefuente SET cod_tercero = '$cod_tercero', fecha_ini_certificado_retefuente = '$fecha_ini_certificado_retefuente', 
	fecha_fin_certificado_retefuente = '$fecha_fin_certificado_retefuente', nombre_rete_fuente_ptj = '$nombre_rete_fuente_ptj', 
	subtotal_base_retencion = '$subtotal_base_retencion', total_retefuente_valor_retenido = '$total_retefuente_valor_retenido' 
	WHERE cod_tercero = '$cod_tercero'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_certificado_retencion_en_la_fuente.php">
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