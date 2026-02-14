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

	if (isset($_POST['und_producto'])) { $cod_estado_und_producto = 1; } else { $cod_estado_und_producto = 0; }
	if (isset($_POST['nombre_producto'])) { $cod_estado_nombre_producto = 1; } else { $cod_estado_nombre_producto = 0; }
	if (isset($_POST['precio_compra_producto'])) { $cod_estado_precio_compra_producto = 1; } else { $cod_estado_precio_compra_producto = 0; }
	if (isset($_POST['precio_venta_producto'])) { $cod_estado_precio_venta_producto = 1; } else { $cod_estado_precio_venta_producto = 0; }
	if (isset($_POST['precio_venta_producto2'])) { $cod_estado_precio_venta_producto2 = 1; } else { $cod_estado_precio_venta_producto2 = 0; }
	if (isset($_POST['precio_venta_producto3'])) { $cod_estado_precio_venta_producto3 = 1; } else { $cod_estado_precio_venta_producto3 = 0; }
	if (isset($_POST['precio_venta_producto4'])) { $cod_estado_precio_venta_producto4 = 1; } else { $cod_estado_precio_venta_producto4 = 0; }
	if (isset($_POST['precio_venta_producto5'])) { $cod_estado_precio_venta_producto5 = 1; } else { $cod_estado_precio_venta_producto5 = 0; }
	if (isset($_POST['iva_ptj'])) { $cod_estado_iva_ptj = 1; } else { $cod_estado_iva_ptj = 0; }
	if (isset($_POST['comision_ptj'])) { $cod_estado_comision_ptj = 1; } else { $cod_estado_comision_ptj = 0; }
	if (isset($_POST['cod_dependencia'])) { $cod_estado_cod_dependencia = 1; } else { $cod_estado_cod_dependencia = 0; }
	if (isset($_POST['cajas_sobre'])) { $cod_estado_cajas_sobre = 1; } else { $cod_estado_cajas_sobre = 0; }
	if (isset($_POST['und_sobre'])) { $cod_estado_und_sobre = 1; } else { $cod_estado_und_sobre = 0; }

	$sql_autoincremento_info_reg_actualizacion_tabla_sistema = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_reg_actualizacion_tabla_sistema'";
	$exec_autoincremento_info_reg_actualizacion_tabla_sistema = mysqli_query($conectar, $sql_autoincremento_info_reg_actualizacion_tabla_sistema) or die(mysqli_error($conectar));
	$datos_autoincremento_info_reg_actualizacion_tabla_sistema = mysqli_fetch_assoc($exec_autoincremento_info_reg_actualizacion_tabla_sistema);
	$cod_info_reg_actualizacion_tabla_sistema = $datos_autoincremento_info_reg_actualizacion_tabla_sistema['AUTO_INCREMENT'];

	$pagina                                      = addslashes($_POST['pagina']).'?cod_info_reg_actualizacion_tabla_sistema='.$cod_info_reg_actualizacion_tabla_sistema;
	$longitudDeLinea                             = 1000;
	$delimitador                                 = ";"; # Separador de columnas
	$caracterCircundante                         = '"'; # A veces los valores son encerrados entre comillas
	$cuenta                                      = $cuenta_actual;
	$cod_administrador                           = $cod_administrador;
	$fecha_reg                                   = date("Y-m-d");
	$hora_reg                                    = date("H:i:s");
	$fecha_creacion                              = date("Y-m-d H:i:s");
	$total_reg_insertado                         = 0;
	$total_reg_actualizado                       = 0;
	//--------------------------------------------------------------------//
	$datos_archivo_plano_intern                  = array();
	//--------------------------------------------------------------------//
	$archivo_plano_csv                           = $_FILES['csv']['tmp_name'];
	$abrir_archivo_plano_csv                     = fopen($archivo_plano_csv,"r");
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
			$cajas_sobre                            = trim($datos_archivo_plano_intern[28]);
			$und_sobre                              = trim($datos_archivo_plano_intern[29]);

			if ($cod_estado_und_producto == '1') { $und_producto_actualizar = "und_producto = '$und_producto',"; } else { $und_producto_actualizar = ""; }
			if ($cod_estado_nombre_producto == '1') { $nombre_producto_actualizar = "nombre_producto = '$nombre_producto',"; } else { $nombre_producto_actualizar = ""; }
			if ($cod_estado_precio_compra_producto == '1') { $precio_compra_producto_actualizar = "precio_compra_producto = '$precio_compra_producto',"; } else { $precio_compra_producto_actualizar = ""; }
			if ($cod_estado_precio_venta_producto == '1') { $precio_venta_producto_actualizar = "precio_venta_producto = '$precio_venta_producto',"; } else { $precio_venta_producto_actualizar = ""; }
			if ($cod_estado_precio_venta_producto2 == '1') { $precio_venta_producto2_actualizar = "precio_venta_producto2 = '$precio_venta_producto2',"; } else { $precio_venta_producto2_actualizar = ""; }
			if ($cod_estado_precio_venta_producto3 == '1') { $precio_venta_producto3_actualizar = "precio_venta_producto3 = '$precio_venta_producto3',"; } else { $precio_venta_producto3_actualizar = ""; }
			if ($cod_estado_precio_venta_producto4 == '1') { $precio_venta_producto4_actualizar = "precio_venta_producto4 = '$precio_venta_producto4',"; } else { $precio_venta_producto4_actualizar = ""; }
			if ($cod_estado_precio_venta_producto5 == '1') { $precio_venta_producto5_actualizar = "precio_venta_producto5 = '$precio_venta_producto5',"; } else { $precio_venta_producto5_actualizar = ""; }
			if ($cod_estado_iva_ptj == '1') { $iva_ptj_actualizar = "iva_ptj = '$iva_ptj',"; } else { $iva_ptj_actualizar = ""; }
			if ($cod_estado_comision_ptj == '1') { $comision_ptj_actualizar = "comision_ptj = '$comision_ptj',"; } else { $comision_ptj_actualizar = ""; }
			if ($cod_estado_cod_dependencia == '1') { $cod_dependencia_actualizar = "cod_dependencia = '$cod_dependencia',"; } else { $cod_dependencia_actualizar = ""; }
			if ($cod_estado_cajas_sobre == '1') { $cajas_sobre_actualizar = "cajas_sobre = '$cajas_sobre',"; } else { $cajas_sobre_actualizar = ""; }
			if ($cod_estado_und_sobre == '1') { $und_sobre_actualizar = "und_sobre = '$und_sobre',"; } else { $und_sobre_actualizar = ""; }
		//--------------------------------------------------------------------//
			if ($existe_producto == '1') {
				$und_productos                           = $und_producto;
				$nombre_tipo_actualizacion_tabla_sistema = "ACTUALIZADO";
				$total_reg_actualizado++;

				$sql_data = sprintf("UPDATE tbl15_producto SET $und_producto_actualizar $nombre_producto_actualizar $precio_compra_producto_actualizar $precio_venta_producto_actualizar 
				$precio_venta_producto2_actualizar $precio_venta_producto3_actualizar $precio_venta_producto4_actualizar $precio_venta_producto5_actualizar $iva_ptj_actualizar 
				$comision_ptj_actualizar $cod_dependencia_actualizar $cajas_sobre_actualizar $und_sobre_actualizar cod_info_reg_actualizacion_tabla_sistema = '$cod_info_reg_actualizacion_tabla_sistema' 
				WHERE cod_producto_barra = '$cod_producto_barra'");
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

				$sql_data = "INSERT INTO tbl15_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, cod_producto_barra, 
				nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
				precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
				nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
				comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion) 
				VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$cod_producto_barra', 
				'$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', '$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
				'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
				'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
				'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion')";
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
			} else {
				$total_reg_insertado++;
				$nombre_tipo_actualizacion_tabla_sistema = "REGISTRADO";

				$sql_data = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, 
				precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
				precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
				nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
				comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion, cod_info_reg_actualizacion_tabla_sistema) 
				VALUES ('$cod_producto_barra', '$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', 
				'$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
				'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
				'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
				'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion', '$cod_info_reg_actualizacion_tabla_sistema')";
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

				$sql_data = "INSERT INTO tbl15_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, cod_producto_barra, 
				nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
				precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
				nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
				comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion) 
				VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$cod_producto_barra', 
				'$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', '$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
				'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
				'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
				'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion')";
				$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
			}
		}
	} while ($datos_archivo_plano_intern = fgetcsv($abrir_archivo_plano_csv, $longitudDeLinea, $delimitador, $caracterCircundante));

	fclose($abrir_archivo_plano_csv);

	$nombre_tipo_actualizacion_tabla_sistema     = "ACTUALIZACION_POR_ARCHIVO_PLANO";

	$sql_data = "INSERT INTO tbl15_info_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, total_reg_insertado, total_reg_actualizado, 
	cod_estado_und_producto, cod_estado_nombre_producto, cod_estado_precio_compra_producto, 
	cod_estado_precio_venta_producto, cod_estado_precio_venta_producto2, cod_estado_precio_venta_producto3, cod_estado_precio_venta_producto4, 
	cod_estado_precio_venta_producto5, cod_estado_iva_ptj, cod_estado_comision_ptj, cod_estado_cod_dependencia, cod_estado_cajas_sobre, 
	cod_estado_und_sobre, cod_administrador, cuenta, fecha_reg, hora_reg) 
	VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$total_reg_insertado', '$total_reg_actualizado', 
	'$cod_estado_und_producto', '$cod_estado_nombre_producto', '$cod_estado_precio_compra_producto', 
	'$cod_estado_precio_venta_producto', '$cod_estado_precio_venta_producto2', '$cod_estado_precio_venta_producto3', '$cod_estado_precio_venta_producto4', 
	'$cod_estado_precio_venta_producto5', '$cod_estado_iva_ptj', '$cod_estado_comision_ptj', '$cod_estado_cod_dependencia', '$cod_estado_cajas_sobre', 
	'$cod_estado_und_sobre', '$cod_administrador', '$cuenta', '$fecha_reg', '$hora_reg')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
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
