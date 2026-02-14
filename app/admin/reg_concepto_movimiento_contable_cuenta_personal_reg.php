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
$pagina_else                        = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['nombre_tipo_puc']) <> '') { $nombre_tipo_puc = addslashes($_POST['nombre_tipo_puc']); } else { $nombre_tipo_puc = ''; }
	if (isset($_POST['nombre_concepto_movimiento_caja']) <> '') { $nombre_concepto_movimiento_caja = addslashes($_POST['nombre_concepto_movimiento_caja']); } else { $nombre_concepto_movimiento_caja = ''; }
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	if ($nombre_tipo_puc == 'INGRESOS') {
		$simbolo_tipo_operacion                = '+';
		$tipo_puc                              = 'ACTIVO';
	} elseif ($nombre_tipo_puc == 'EGRESOS') {
		$simbolo_tipo_operacion                = '-';
		$tipo_puc                              = 'GASTOS';
	} elseif ($nombre_tipo_puc == 'PASIVOS') {
		$simbolo_tipo_operacion                = '';
		$tipo_puc                              = 'PASIVOS';
	} else {
		$simbolo_tipo_operacion                = '';
		$tipo_puc                              = '';
	}
	$cod_estado = 1;

	$agreg_mov_credito_reg = "INSERT INTO tbl15_concepto_movimiento_caja (nombre_tipo_puc, nombre_concepto_movimiento_caja, simbolo_tipo_operacion, tipo_puc, cod_estado)
	VALUES ('$nombre_tipo_puc', '$nombre_concepto_movimiento_caja', '$simbolo_tipo_operacion', '$tipo_puc', '$cod_estado')";
	$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_movimiento_contable_cuenta_personal.php">
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