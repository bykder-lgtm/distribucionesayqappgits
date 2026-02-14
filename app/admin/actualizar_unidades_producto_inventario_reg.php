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
if (isset($_POST["cod_producto_barra"])) {

$cod_producto_barra           = mysqli_real_escape_string($conectar, ($_POST['cod_producto_barra'])); 
$und_producto_nueva           = mysqli_real_escape_string($conectar, ($_POST['und_producto_nueva']));
$comentario                   = mysqli_real_escape_string($conectar, ($_POST['comentario']));
$pagina                       = addslashes($_POST['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$info_datos_producto = mysqli_fetch_assoc($consulta);

$und_producto_inv             = $info_datos_producto['und_producto']; 
$devoluciones                 = $und_producto_inv + $und_producto_nueva;
$und_producto                 = $devoluciones;
$und_inventario               = $und_producto_inv;
$und_nuevas                   = $und_producto_nueva;
$nombre_producto              = $info_datos_producto['nombre_producto']; 
$precio_compra_producto       = $info_datos_producto['precio_compra_producto']; 
$precio_costo_producto        = $info_datos_producto['precio_costo_producto']; 
$precio_venta_producto        = $info_datos_producto['precio_venta_producto']; 
$vlr_total_compra             = $info_datos_producto['total_precio_costo_producto']; 
$vlr_total_venta              = $info_datos_producto['total_precio_venta_producto']; 
$cod_tercero                  = $info_datos_producto['cod_tercero']; 
$iva_ptj                      = $info_datos_producto['iva_ptj']; 
$unidades_vendidas            = $und_producto_nueva;
$und_vend_orig                = $und_producto_inv;
$vendedor                     = $cuenta_actual;
$cuenta                       = $cuenta_actual;
$unidades_faltantes           = $devoluciones;

$origen_operacion             = 'inventario';
$fecha_devolucion             = date("Y-m-d");
$hora_devolucion              = date("H:i:s");
$fecha_time                   = time();
$fecha_anyo                   = $fecha_devolucion;
$fecha_hora                   = $hora_devolucion;
$fecha_orig                   = $fecha_devolucion;
$fecha                        = $fecha_time;
$fecha_mes                    = date("Y-m");

$sql_data = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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