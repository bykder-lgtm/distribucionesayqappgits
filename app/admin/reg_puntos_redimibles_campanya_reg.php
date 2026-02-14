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

	if (isset($_POST['nombre_puntos_redimibles_campanya']) <> '') { $nombre_puntos_redimibles_campanya = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_puntos_redimibles_campanya'])); } else { $nombre_puntos_redimibles_campanya = ''; }
	if (isset($_POST['valor_puntos_redimibles_campanya']) <> '') { $valor_puntos_redimibles_campanya = intval($_POST['valor_puntos_redimibles_campanya']); } else { $valor_puntos_redimibles_campanya = '0'; }
	if (isset($_POST['cantidad_puntos_x_valor_redimibles_campanya']) <> '') { $cantidad_puntos_x_valor_redimibles_campanya = intval($_POST['cantidad_puntos_x_valor_redimibles_campanya']); } else { $cantidad_puntos_x_valor_redimibles_campanya = '0'; }
	if (isset($_POST['equivalencia_en_pesos_de_un_punto']) <> '') { $equivalencia_en_pesos_de_un_punto = intval($_POST['equivalencia_en_pesos_de_un_punto']); } else { $equivalencia_en_pesos_de_un_punto = '0'; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_creacion                                     = date("Y-m-d H.i:s");
	$cod_estado                                         = "1";
/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_puntos_redimibles_campanya (nombre_puntos_redimibles_campanya, valor_puntos_redimibles_campanya, cantidad_puntos_x_valor_redimibles_campanya, equivalencia_en_pesos_de_un_punto, 
	fecha_creacion, cod_estado) 
	VALUES (UPPER('$nombre_puntos_redimibles_campanya'), '$valor_puntos_redimibles_campanya', '$cantidad_puntos_x_valor_redimibles_campanya', '$equivalencia_en_pesos_de_un_punto', 
	'$fecha_creacion', '$cod_estado')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_puntos_redimibles_campanya.php">
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