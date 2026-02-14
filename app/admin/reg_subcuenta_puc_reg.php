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

	if (isset($_POST['cod_puc']) <> '') { $cod_puc = intval($_POST['cod_puc']); } else { $cod_puc = ''; }
	if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
	if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
	if (isset($_POST['saldo_inicial_puc']) <> '') { $saldo_inicial_puc = mysqli_real_escape_string($conectar, ($_POST['saldo_inicial_puc'])); } else { $saldo_inicial_puc = ''; }
	if (isset($_POST['saldo_actual_puc']) <> '') { $saldo_actual_puc = mysqli_real_escape_string($conectar, ($_POST['saldo_actual_puc'])); } else { $saldo_actual_puc = ''; }
	$fecha_creacion = date("Y-m-d H:i:s");

	$sql_info_factura = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

	$tipo_puc                            = $info_info_factura['tipo_puc'];
	$cod_estado                          = 1;

	$agreg_reg = "INSERT INTO tbl15_puc (codigo_puc, nombre_puc, tipo_puc, saldo_inicial_puc, saldo_actual_puc, fecha_creacion, cod_estado)
	VALUES ('$codigo_puc', '$nombre_puc', '$tipo_puc', '$saldo_inicial_puc', '$saldo_actual_puc', '$fecha_creacion', '$cod_estado')";
	$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_puc.php?codigo_puc=<?php echo $codigo_puc?>">
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