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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_producto_copia_inventario                   = intval($_POST['cod_producto_copia_inventario']);

if (isset($_POST['cod_info_producto_copia_inventario']) <> '') { $cod_info_producto_copia_inventario = mysqli_real_escape_string($conectar, ($_POST['cod_info_producto_copia_inventario'])); } else { $cod_info_producto_copia_inventario = ''; }
if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar, ($_POST['cod_producto_barra'])); } else { $cod_producto_barra = ''; }
if (isset($_POST['buscar_por']) <> '') { $buscar_por = mysqli_real_escape_string($conectar, ($_POST['buscar_por'])); } else { $buscar_por = ''; }
if (isset($_POST['nombre_tipo_cargue_factura']) <> '') { $nombre_tipo_cargue_factura = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cargue_factura'])); } else { $nombre_tipo_cargue_factura = ''; }
if (isset($_POST['nombre_tipo_moneda']) <> '') { $nombre_tipo_moneda = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_moneda'])); } else { $nombre_tipo_moneda = ''; }
if (isset($_POST['nombre_tipo_factura']) <> '') { $nombre_tipo_factura = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_factura'])); } else { $nombre_tipo_factura = ''; }
if (isset($_POST['foco']) <> '') { $foco = mysqli_real_escape_string($conectar, ($_POST['foco'])); } else { $foco = ''; }
if (isset($_POST['cod_estado_vacuna']) <> '') { $cod_estado_vacuna = mysqli_real_escape_string($conectar, ($_POST['cod_estado_vacuna'])); } else { $cod_estado_vacuna = ''; }
if (isset($_POST['pagina']) <> '') { $pagina = mysqli_real_escape_string($conectar, ($_POST['pagina'])); } else { $pagina = ''; }
if (isset($_POST['und_producto_nuevo']) <> '') { $und_producto_nuevo = mysqli_real_escape_string($conectar, ($_POST['und_producto_nuevo'])); } else { $und_producto_nuevo = ''; }

$pagina_redirect = $pagina."?cod_info_producto_copia_inventario=".$cod_info_producto_copia_inventario."&buscar_por=".$buscar_por."&foco=".$foco."&pagina=".$pagina;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$fecha_hora                                   = date("H:i:s");
$fecha_actual_hoy                             = date("Y-m-d");
$origen_operacion                             = 'inventario';
$fecha_devolucion                             = date("Y-m-d");
$hora_devolucion                              = date("H:i:s");
$fecha_time                                   = time();
$fecha_anyo                                   = $fecha_devolucion;
$fecha_hora                                   = $hora_devolucion;
$fecha_orig                                   = $fecha_devolucion;
$comentario_copia_inventario                  = '';
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_cliente = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_producto_copia_inventario = '$cod_producto_copia_inventario')";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$resultado = mysqli_num_rows($consulta_cliente);
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$cod_producto_barra                          = $info_cliente['cod_producto_barra'];
$nombre_producto                             = $info_cliente['nombre_producto'];
$precio_compra_producto                      = $info_cliente['precio_compra_producto'];
$precio_costo_producto                       = $info_cliente['precio_costo_producto'];
$precio_venta_producto                       = $info_cliente['precio_venta_producto'];
$und_producto_viejo                          = $info_cliente['und_producto_viejo'];
$fecha_actualizacion                         = $info_cliente['fecha_actualizacion'];
$unidades_faltantes_inv_viejo                = $und_producto_viejo;
$und_producto_nuevo_db                       = $info_cliente['und_producto_nuevo'];


$und_orig                                    = $und_producto_nuevo_db;
$vendedor                                    = $cod_administrador;
$cuenta                                      = $cod_administrador;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$info_producto = mysqli_fetch_assoc($consulta_producto);

$und_inventario_propio                       = $info_producto['und_producto'];
$unidades_vendidas                           = $und_inventario_propio;
$und_producto_inv                            = $und_inventario_propio; 
$und_vend_orig                               = $und_producto_inv;
$devoluciones                                = $und_producto_nuevo - $und_producto_inv;
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$fecha_actualizaciondb                         = $fecha_actualizacion;

if ($fecha_actualizaciondb <> "") { 
$und_total_inventario_nuevo                    = $und_inventario_propio + $und_producto_nuevo; 
$und_total_inventario_nuevo_copia              = $und_orig + $und_producto_nuevo;
$unidades_faltantes_inv_viejo_modif            = $unidades_faltantes_inv_viejo;
} 
else { 
$und_total_inventario_nuevo                    = $und_producto_nuevo; 
$und_total_inventario_nuevo_copia              = $und_producto_nuevo;
$unidades_faltantes_inv_viejo_modif            = ($unidades_faltantes_inv_viejo + $und_inventario_propio);
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
if ($resultado <> 0) {
//------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------//
$comentario                                    = '';
$descripcion                                   = $comentario;
$unidades_faltantes2                           = $und_orig + $und_producto_nuevo;

if ($und_producto_nuevo == $unidades_faltantes_inv_viejo) {
$und_inventario                                = $und_inventario_propio;
$und_nuevas                                    = $und_producto_nuevo - $und_inventario_propio;
$unidades_faltantes                            = $und_producto_nuevo;
} else {
$und_inventario                                = $und_inventario_propio;
$und_nuevas                                    = $und_producto_nuevo - $und_inventario_propio;
$unidades_faltantes                            = $und_producto_nuevo;
}
$fecha_actualizacion                           = date("Y-m-d");
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = sprintf("UPDATE tbl15_producto SET und_producto = '$und_total_inventario_nuevo' WHERE cod_producto_barra = '$cod_producto_barra'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = sprintf("UPDATE tbl15_producto_copia_inventario SET und_producto_nuevo = '$und_total_inventario_nuevo_copia', fecha_actualizacion = '$fecha_actualizacion' 
WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } ?>
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