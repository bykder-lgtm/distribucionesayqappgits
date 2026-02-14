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
if (isset($_GET["cod_producto"])) {

	$cod_producto                                                        = intval($_GET['cod_producto']);
	$foco                                                                = addslashes($_GET['foco']);
	$pagina                                                              = addslashes($_GET['pagina']);
	$pagina_local                                                        = addslashes($_GET['pagina_local']);
	$pagina_redirect                                                     = $pagina_local.'?cod_producto='.$cod_producto.'&foco='.$foco.'&pagina='.$pagina;

	$mostrar_datos_sql = "SELECT cod_producto_barra, nombre_producto, precio_venta_producto FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_producto_barra                                                  = $matriz_consulta['cod_producto_barra'];
	$nombre_producto                                                     = $matriz_consulta['nombre_producto'];
	$precio_venta_producto                                               = $matriz_consulta['precio_venta_producto'];
	$precio_cuenta_servicio                                              = $precio_venta_producto;
	$und_producto                                                        = 1;
	$cod_estado                                                          = 1;                

	$agreg = "INSERT INTO tbl15_producto_sub (cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, precio_cuenta_servicio, und_producto, cod_estado) 
	VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_producto', '$precio_venta_producto', '$precio_cuenta_servicio', '$und_producto', '$cod_estado')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	$sql_subproducto_habilitado = "SELECT * FROM tbl15_producto_sub WHERE (cod_producto = '$cod_producto') AND (cod_estado = '1')";
	$modificar_subproducto_habilitado = mysqli_query($conectar, $sql_subproducto_habilitado) or die(mysqli_error($conectar));
	$datos_subproducto_habilitado = mysqli_fetch_assoc($modificar_subproducto_habilitado);
	$total_datos = mysqli_num_rows($modificar_subproducto_habilitado);
	$und_producto = $total_datos;

	$data_sql = ("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto = '$cod_producto'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
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