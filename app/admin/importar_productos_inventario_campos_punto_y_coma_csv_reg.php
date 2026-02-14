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
if (isset($_POST['pagina'])) {

	$pagina                                 = addslashes($_POST['pagina']);
	$longitudDeLinea                        = 1000;
	$delimitador                            = ";"; # Separador de columnas
	$caracterCircundante                    = '"'; # A veces los valores son encerrados entre comillas
	//--------------------------------------------------------------------//
	$datos_archivo_plano_intern             = array();
	//--------------------------------------------------------------------//
	$archivo_plano_csv                      = $_FILES['csv']['tmp_name'];
	$abrir_archivo_plano_csv                = fopen($archivo_plano_csv,"r");
	do {
		if ($datos_archivo_plano_intern[0]) {

			$cod_producto                           = trim($datos_archivo_plano_intern[0]);
			$cod_producto_barra                     = trim($datos_archivo_plano_intern[1]);

			$sql_producto = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
			$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
			$existe_producto = mysqli_num_rows($consulta_producto);
			$datos_producto = mysqli_fetch_assoc($consulta_producto);

			$nombre_producto                        = trim($datos_archivo_plano_intern[2]);
			$und_producto                           = trim($datos_archivo_plano_intern[3]);
			$und_producto_bodega                    = trim($datos_archivo_plano_intern[4]);
			$und_producto_bodega2                   = trim($datos_archivo_plano_intern[5]);
			$precio_compra_producto                 = trim($datos_archivo_plano_intern[6]);
			$precio_venta_producto                  = trim($datos_archivo_plano_intern[7]);
			$precio_venta_producto2                 = trim($datos_archivo_plano_intern[8]);
			$precio_venta_producto3                 = trim($datos_archivo_plano_intern[9]);
			$precio_venta_producto4                 = trim($datos_archivo_plano_intern[10]);
			$precio_venta_producto5                 = trim($datos_archivo_plano_intern[11]);
			$nombre_tipo_unidad_medida              = trim($datos_archivo_plano_intern[12]);
			$peso_producto                          = trim($datos_archivo_plano_intern[13]);
			$iva_ptj                                = trim($datos_archivo_plano_intern[14]);
			$nombre_tipo_producto                   = trim($datos_archivo_plano_intern[15]);
			$cod_marca                              = trim($datos_archivo_plano_intern[16]);
			$cod_dependencia                        = trim($datos_archivo_plano_intern[17]);
			$cod_dependencia_sub                    = trim($datos_archivo_plano_intern[18]);
			$nombre_tipo_precio_venta               = trim($datos_archivo_plano_intern[19]);
			$url_img_orig_producto                  = trim($datos_archivo_plano_intern[20]);
			$url_img_min_producto                   = trim($datos_archivo_plano_intern[21]);
			$comision_ptj                           = trim($datos_archivo_plano_intern[22]);
			$und_unidades                           = trim($datos_archivo_plano_intern[23]);
			$und_caja                               = trim($datos_archivo_plano_intern[24]);
			$nombre_estado                          = trim($datos_archivo_plano_intern[25]);
			$cod_categoria                          = trim($datos_archivo_plano_intern[26]);
			$cod_categoria_sub                      = trim($datos_archivo_plano_intern[27]);
			//--------------------------------------------------------------------//
			if ($existe_producto == '1') {
			$und_productos                           = $datos_producto['und_producto'] + $und_producto;

				$sql_data = sprintf("UPDATE tbl15_producto SET und_producto = '$und_productos' WHERE cod_producto_barra = '$cod_producto_barra'");
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
			} else {
				$sql_data = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, 
				precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
				precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
				nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
				comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub) 
				VALUES ('$cod_producto_barra', '$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', 
				'$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
				'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
				'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
				'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub')";
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
			}
		//--------------------------------------------------------------------//
		}
	} while ($datos_archivo_plano_intern = fgetcsv($abrir_archivo_plano_csv, $longitudDeLinea, $delimitador, $caracterCircundante));

	fclose($abrir_archivo_plano_csv);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
//header("Location: $pagina?cod_info_factura_compra=$cod_info_factura_compra&cod_caja_virtual=$cod_caja_virtual&cuenta=$cuenta");
}
?>
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
