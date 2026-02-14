<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);


$valor_intro             = addslashes($_GET['valor']);
$campo                   = addslashes($_GET['campo']);
$cod_producto            = addslashes($_GET['id']);

$sql_productos = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$cod_producto_barra = $datos_producto['cod_producto_barra'];

if ($campo == 'nombre_producto') {

				$nombre_producto1                 = str_replace("'", " PULG ", $nombre_producto0);
				$nombre_producto2                 = str_replace(",", ".", $nombre_producto1);
				$nombre_producto3                 = str_replace("#", " NO ", $nombre_producto2);
				$nombre_producto4                 = str_replace("%", " PTJ ", $nombre_producto3);
				$nombre_producto                  = trim(str_replace('"', " PULG ", $nombre_producto4));

$nombre_productos0 = mysqli_real_escape_string($conectar, ($valor_intro)); 
$nombre_productos1 = preg_replace("/,/", '.', $nombre_productos0);
$nombre_productos2 = preg_replace("/'/", '.', $nombre_productos1);
$nombre_productos3 = preg_replace("/;/", ' :', $nombre_productos2);
$nombre_productos4 = preg_replace("/#/", ' NO ', $nombre_productos3);
$nombre_productos5 = preg_replace("/%/", ' PTJ ', $nombre_productos4);
$nombre_producto = trim(preg_replace('/"/', '.', $nombre_productos5));

$data_sql = ("UPDATE tbl15_producto SET nombre_producto = UPPER('$nombre_producto') WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'cod_producto_barra') {

$cod_producto_barra = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_producto_barra = '$cod_producto_barra' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'detalles') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$detalles = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET detalles = '$detalles' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'und_producto') {

$und_producto = addslashes($valor_intro);

$origen_operacion             = 'inventario';
$fecha_devolucion             = date("Y-m-d");
$hora_devolucion              = date("H:i:s");
$fecha_time                   = time();
$fecha_anyo                   = $fecha_devolucion;
$fecha_hora                   = $hora_devolucion;
$fecha_orig                   = $fecha_devolucion;
$comentario                   = 'inventario ajax';

$sql_datos_producto = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

$und_producto_inv             = $info_datos_producto['und_producto']; 
$devoluciones                 = $und_producto - $und_producto_inv;
$und_inventario               = $und_producto_inv;
$und_nuevas                   = $devoluciones;
$cod_producto_barra           = $info_datos_producto['cod_producto_barra']; 
$nombre_producto              = $info_datos_producto['nombre_producto']; 
$precio_compra_producto       = $info_datos_producto['precio_compra_producto']; 
$precio_costo_producto        = $info_datos_producto['precio_costo_producto']; 
$precio_venta_producto        = $info_datos_producto['precio_venta_producto']; 
$vlr_total_compra             = $info_datos_producto['total_precio_costo_producto']; 
$vlr_total_venta              = $info_datos_producto['total_precio_venta_producto']; 
$cod_tercero                  = $info_datos_producto['cod_tercero']; 
$iva_ptj                      = $info_datos_producto['iva_ptj']; 
$unidades_vendidas            = $und_producto;
$und_vend_orig                = $und_producto_inv;
$vendedor                     = $cuenta_actual;
$cuenta                       = $cuenta_actual;
$unidades_faltantes           = $und_producto;
$fecha                        = $fecha_time;
$fecha_mes                    = date("Y-m");

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'und_producto_bodega') {

$und_producto_bodega = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET und_producto_bodega = '$und_producto_bodega' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_costo_producto') {

$precio_costo_producto = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_costo_producto = '$precio_costo_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_compra_producto') {

$precio_compra_producto = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_compra_producto = '$precio_compra_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_venta_producto') {

$precio_venta_producto = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_venta_producto = '$precio_venta_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_venta_producto2') {

$precio_venta_producto2 = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_venta_producto2 = '$precio_venta_producto2' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_venta_producto3') {

$precio_venta_producto3 = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_venta_producto3 = '$precio_venta_producto3' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_venta_producto4') {

$precio_venta_producto4 = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_venta_producto4 = '$precio_venta_producto4' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'precio_venta_producto5') {

$precio_venta_producto5 = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET precio_venta_producto5 = '$precio_venta_producto5' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'fecha_vencimiento') {

$fecha_vencimiento    = addslashes($valor_intro);
$fecha_vencimiento1   = $fecha_vencimiento;

$data_sql = ("UPDATE tbl15_producto SET fecha_vencimiento = '$fecha_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_vencimiento) VALUES ('$cod_producto_barra', '$fecha_vencimiento')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
//$sql_histo_vencimiento = "SELECT MAX(cod_historial_fecha_vencimiento) AS cod_historial_fecha_vencimiento FROM tbl15_historial_fecha_vencimiento WHERE cod_producto_barra = '$cod_producto_barra'";
//$consulta_histo_vencimiento = mysqli_query($conectar, $sql_histo_vencimiento) or die(mysqli_error($conectar));
//$datos_histo_vencimiento = mysqli_fetch_assoc($consulta_histo_vencimiento);

//$cod_historial_fecha_vencimiento = $datos_histo_vencimiento['cod_historial_fecha_vencimiento'];

//$data_sql = ("UPDATE tbl15_historial_fecha_vencimiento SET fecha_vencimiento = '$fecha_vencimiento' WHERE cod_historial_fecha_vencimiento = '$cod_historial_fecha_vencimiento'");
//$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'fecha_vencimiento1') {

$fecha_vencimiento    = addslashes($valor_intro);
$fecha_vencimiento1   = $fecha_vencimiento;

$data_sql = ("UPDATE tbl15_producto SET fecha_vencimiento = '$fecha_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_vencimiento) VALUES ('$cod_producto_barra', '$fecha_vencimiento')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'lote_vencimiento') {

$lote_vencimiento     = addslashes($valor_intro);
$vencimiento_lote1    = addslashes($lote_vencimiento);

$data_sql = ("UPDATE tbl15_producto SET lote_vencimiento = '$lote_vencimiento', vencimiento_lote1 = '$vencimiento_lote1' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'vencimiento_lote1') {

$lote_vencimiento     = addslashes($valor_intro);
$vencimiento_lote1    = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET lote_vencimiento = '$lote_vencimiento', vencimiento_lote1 = '$vencimiento_lote1' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_vencimiento) VALUES ('$cod_producto_barra', '$fecha_vencimiento1')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'iva_ptj') {

$iva_ptj = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET iva_ptj = '$iva_ptj' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'comision_ptj') {

$comision_ptj = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET comision_ptj = '$comision_ptj' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'nombre_tipo_producto') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$nombre_tipo_producto = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'nombre_tipo_unidad_medida') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$nombre_tipo_unidad_medida = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'unidad_medida_peso') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$unidad_medida_peso = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET unidad_medida_peso = '$unidad_medida_peso' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'nombre_estado') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$nombre_estado = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET nombre_estado = '$nombre_estado' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_origen_produccion') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_origen_produccion = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_origen_produccion = '$cod_origen_produccion' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_promocion') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_promocion = intval($valor_intro);

$sql_datos_promocion = "SELECT nombre_promocion, nombre_promocion_ing FROM tbl15_promocion WHERE (cod_promocion = '$cod_promocion')";
$resultado_datos_promocion = mysqli_query($conectar, $sql_datos_promocion);
$info_datos_promocion = mysqli_fetch_assoc($resultado_datos_promocion);

$nombre_promocion             = $info_datos_promocion['nombre_promocion']; 
$nombre_promocion_ing         = $info_datos_promocion['nombre_promocion_ing']; 

$data_sql = ("UPDATE tbl15_producto SET nombre_promocion = '$nombre_promocion', nombre_promocion_ing = '$nombre_promocion_ing' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_dependencia') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_dependencia = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_dependencia = '$cod_dependencia' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_origen_produccion') {

	$cod_productos_frag = explode('-', $_GET['id']);
	$cod_producto = $cod_productos_frag[1];

	$cod_origen_produccion = intval($valor_intro);

	$data_sql = ("UPDATE tbl15_producto SET cod_origen_produccion = '$cod_origen_produccion' WHERE cod_producto = '$cod_producto'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_dependencia_sub') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_dependencia_sub = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_dependencia_sub = '$cod_dependencia_sub' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_categoria') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_categoria = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_categoria = '$cod_categoria' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_marca') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_marca = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_marca = '$cod_marca' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_estado_peso') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_estado_peso = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_estado_peso = '$cod_estado_peso' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_tipo_producto_cocina') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_tipo_producto_cocina = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_tipo_producto_cocina = '$cod_tipo_producto_cocina' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'cod_opcion_descontable_inv') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$cod_opcion_descontable_inv = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET cod_opcion_descontable_inv = '$cod_opcion_descontable_inv' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'nombre_tipo_precio_venta') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$nombre_tipo_precio_venta = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'nombre_tipo_producto') {

$cod_productos_frag = explode('-', $_GET['id']);
$cod_producto = $cod_productos_frag[1];

$nombre_tipo_producto = intval($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

elseif ($campo == 'fecha_mantenimiento') {

$fecha_mantenimiento = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET fecha_mantenimiento = '$fecha_mantenimiento' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$agreg = "INSERT INTO tbl15_historial_fecha_mantenimiento (cod_producto_barra, fecha_mantenimiento) VALUES ('$cod_producto_barra', '$fecha_mantenimiento')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

//$sql_histo_mantemimiento = "SELECT MAX(cod_historial_fecha_mantenimiento) AS cod_historial_fecha_mantenimiento FROM tbl15_historial_fecha_mantenimiento WHERE cod_producto_barra = '$cod_producto_barra'";
//$consulta_histo_mantemimiento = mysqli_query($conectar, $sql_histo_mantemimiento) or die(mysqli_error($conectar));
//$datos_histo_mantemimiento = mysqli_fetch_assoc($consulta_histo_mantemimiento);

//$cod_historial_fecha_mantenimiento = $datos_histo_mantemimiento['cod_historial_fecha_mantenimiento'];

//$data_sql = ("UPDATE tbl15_historial_fecha_mantenimiento SET fecha_mantenimiento = '$fecha_mantenimiento' WHERE cod_historial_fecha_mantenimiento = '$cod_historial_fecha_mantenimiento'");
//$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

else {

$$valor_intro     = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_producto SET $campo = '$valor_intro' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>