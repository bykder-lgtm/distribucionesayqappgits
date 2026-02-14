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
$fecha_hora                                   = date("H:i:s");
$fecha_actual_hoy                             = date("Y-m-d");
$origen_operacion                             = 'inventario';
$fecha_devolucion                             = date("Y-m-d");
$hora_devolucion                              = date("H:i:s");
$fecha_time                                   = time();
$fecha_anyo                                   = $fecha_devolucion;
$fecha_hora                                   = $hora_devolucion;
$fecha_orig                                   = $fecha_devolucion;
$vendedor                                     = $cod_administrador;
$cuenta                                       = $cod_administrador;
$comentario                                   = '';
$descripcion                                  = $comentario;
$cod_estado                                   = 1;
$fecha_creacion                               = date("Y-m-d H:i:s");
$nombre_estado                                = "CERRADO";
$fecha_actualizacion                          = date("Y-m-d");

if (isset($_POST["cod_info_producto_copia_inventario"])) {

	$cod_info_producto_copia_inventario       = intval($_POST['cod_info_producto_copia_inventario']);
	$nombre_promocion                         = addslashes($_POST['nombre_promocion']);

    $sql_producto_con_existencia_no_cargado = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') ORDER BY cod_producto_copia_inventario DESC";
    $resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_producto_con_existencia_no_cargado) or die(mysqli_error($conectar));
    $total_producto_con_existencia_no_cargado = mysqlI_num_rows($resultado_producto_con_existencia_no_cargado);
    while ($info_producto_con_existencia_no_cargado = mysqli_fetch_assoc($resultado_producto_con_existencia_no_cargado)) {

        $cod_producto_copia_inventario          = $info_producto_con_existencia_no_cargado['cod_producto_copia_inventario'];
        $cod_producto_barra                     = $info_producto_con_existencia_no_cargado['cod_producto_barra'];
        $nombre_producto                        = $info_producto_con_existencia_no_cargado['nombre_producto'];
        $und_producto_nuevo                     = $info_producto_con_existencia_no_cargado['und_producto_nuevo'];
        $und_producto_viejo                     = $info_producto_con_existencia_no_cargado['und_producto_viejo'];
        $precio_compra_producto                 = $info_producto_con_existencia_no_cargado['precio_compra_producto'];
        $precio_venta_producto                  = $info_producto_con_existencia_no_cargado['precio_venta_producto'];
        $comentario_copia_inventario            = $info_producto_con_existencia_no_cargado['comentario_copia_inventario'];
        $cod_administrador                      = $info_producto_con_existencia_no_cargado['cuenta'];

		$sql_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
		$info_producto = mysqli_fetch_assoc($consulta_producto);

		$und_inventario_propio                       = $info_producto['und_producto'];
		$unidades_vendidas                           = $und_inventario_propio;
		$und_producto_inv                            = $und_inventario_propio; 
		$und_vend_orig                               = $und_producto_inv;
		$devoluciones                                = $und_producto_nuevo - $und_producto_inv;
		$und_inventario                              = $und_inventario_propio;
		$und_nuevas                                  = $und_producto_nuevo - $und_inventario_propio;
		$unidades_faltantes                          = $und_producto_nuevo;

		$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
		und_vend_orig, devoluciones, precio_compra_producto, precio_venta_producto, 
		fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
		fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario) 
		VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
		'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_venta_producto', 
		'$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
		'$fecha_hora', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario')";
		$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
		//------------------------------------------------------------------------------------------------------------------------------------//
		//------------------------------------------------------------------------------------------------------------------------------------//
		$sql_data = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto_nuevo' WHERE cod_producto_barra = '$cod_producto_barra'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = sprintf("UPDATE tbl15_producto_copia_inventario SET cod_estado = '$cod_estado', fecha_creacion = '$fecha_creacion', fecha_actualizacion = '$fecha_actualizacion' WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	$sql_data = sprintf("UPDATE tbl15_info_producto_copia_inventario SET nombre_promocion = '$nombre_promocion', cod_estado = '$cod_estado', nombre_estado = '$nombre_estado', fecha_creacion = '$fecha_creacion' 
	WHERE cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_producto_copia_inventario.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario?>">
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