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
	if (isset($_POST['tipo_puc']) <> '') { $tipo_puc = mysqli_real_escape_string($conectar, ($_POST['tipo_puc'])); } else { $tipo_puc = ''; }
	if (isset($_POST['saldo_inicial_puc']) <> '') { $saldo_inicial_puc = mysqli_real_escape_string($conectar, ($_POST['saldo_inicial_puc'])); } else { $saldo_inicial_puc = ''; }
	if (isset($_POST['saldo_actual_puc']) <> '') { $saldo_actual_puc = mysqli_real_escape_string($conectar, ($_POST['saldo_actual_puc'])); } else { $saldo_actual_puc = ''; }
	if (isset($_POST['cod_estado']) <> '') { $cod_estado = intval($_POST['cod_estado']); } else { $cod_estado = ''; }
	$fecha_creacion = date("Y-m-d H:i:s");

	$actualizar_sql = "UPDATE tbl15_puc SET codigo_puc = '$codigo_puc', nombre_puc = '$nombre_puc', tipo_puc = '$tipo_puc', saldo_inicial_puc = '$saldo_inicial_puc', 
	saldo_actual_puc = '$saldo_actual_puc', fecha_creacion = '$fecha_creacion', cod_estado = '$cod_estado'
	WHERE cod_puc = '$cod_puc'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_puc.php">
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