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

if (isset($_POST["cod_info_factura_venta"])) {
    $cod_info_factura_venta                               = intval($_POST['cod_info_factura_venta']);
    $retefuente_ptj                                       = addslashes($_POST['retefuente_ptj']);
    $cod_tipo_pago                                        = intval($_POST['cod_tipo_pago']);
    $total_precio_venta                                   = addslashes($_POST['total_precio_venta']);
    $vlr_cancelado                                        = addslashes($_POST['vlr_cancelado']);
    $cuenta                                               = addslashes($_POST['cuenta']);
    $cod_caja_virtual                                     = intval($_POST['cod_caja_virtual']);
    $modo_venta_por_defecto                               = addslashes($_POST['modo_venta_por_defecto']);
    $pagina                                               = addslashes($_POST['pagina']);
    $paginar_edirect                                      = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_venta='.$cod_info_factura_venta.'&modo_venta_por_defecto='.$modo_venta_por_defecto;

	$cod_servicio_propina                                 = '22222222';
	$cod_servicio_cava                                    = '55555555';
	$cod_servicio_domicilio                               = '44444444';
	$cod_servicio_descuento_punto_redimible               = '11112222';
	$cod_servicio_descuento                               = '33333333';
	$cod_servicio_imp_bolsa                               = '11111111';
	$cod_servicio_retefuente                              = '11113333';

	$sql_info_factura_venta = "SELECT cod_caja_virtual FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$resultado_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
	$info_info_factura_venta = mysqli_fetch_assoc($resultado_info_factura_venta);

	$cod_caja_virtual                                      = $info_info_factura_venta['cod_caja_virtual'];

	$sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base 
	FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente')";
	$resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
	$info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

    $subtotal_base                                        = $info_retefuente_en_factura['subtotal_base'] * ($retefuente_ptj/100);

	$sql_producto_auxiliar = "SELECT * FROM tbl15_producto_auxiliar WHERE (cod_producto_barra = '$cod_servicio_retefuente')";
	$resultado_producto_auxiliar = mysqli_query($conectar, $sql_producto_auxiliar);
	$info_producto_auxiliar = mysqli_fetch_assoc($resultado_producto_auxiliar);

	$nombre_producto                                      = $info_producto_auxiliar['nombre_producto'];
	$nombre_tipo_producto                                 = $info_producto_auxiliar['nombre_tipo_producto'];
	$nombre_tipo_unidad_medida                            = $info_producto_auxiliar['nombre_tipo_unidad_medida'];
	$nombre_tipo_precio_venta                             = $info_producto_auxiliar['nombre_tipo_precio_venta'];
	$cod_dependencia                                      = $info_producto_auxiliar['cod_dependencia'];
	$und_venta                                            = '1';
	$precio_venta_producto                                = $subtotal_base * -1;
	$total_venta_producto                                 = $subtotal_base * -1;
	$cod_tipo_cobrar                                      = '1';
	$cuenta                                               = $cuenta;
	$total_retefuente                                     = $subtotal_base;

	$agreg = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_caja_virtual, cod_producto_barra, nombre_producto, und_venta, 
	precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_precio_venta, cod_tipo_cobrar, cuenta) 
	VALUES ('$cod_info_factura_venta', '$cod_caja_virtual', '$cod_servicio_retefuente', '$nombre_producto', '$und_venta', 
	'$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', '$cod_tipo_cobrar', '$cuenta')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	$data_sql = ("UPDATE tbl15_info_factura_venta SET retefuente_ptj = '$retefuente_ptj', total_retefuente = '$total_retefuente' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $paginar_edirect;?>">
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