<?php
require_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {

$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);

if (isset($_GET['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); } else { $nombre_tipo_compra = "0"; }
if (isset($_GET['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_GET['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = "0"; }

$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "VENTAS_GENERALES_DEL_".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
    if ($cod_administrador == "0") {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
    }
    if ($cod_tercero == "0") {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }
    if ($cod_tipo_pago == "0") {
        $filtro_consulta_tipo_pago = "";
        $filtro_consulta_tipo_pago_rel = "";
    } else {
        $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
    }
    if ($cod_tipo_forma_pago == "0") {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }
    if ($cod_dependencia == "0") {
        $filtro_consulta_dependencia = "";
        $filtro_consulta_dependencia_rel = "";
    } else {
        $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
    }
    if ($nombre_tipo_factura =='0') {
        $filtro_consulta_nombre_tipo_factura = "";
        $filtro_consulta_nombre_tipo_factura_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
    }
    if ($nombre_tipo_compra =='0') {
        $filtro_consulta_nombre_tipo_compra = "";
        $filtro_consulta_nombre_tipo_compra_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
    }

    if ($cod_tipo_metodo_envio == "0") {
        $filtro_consulta_tipo_metodo_envio = "";
        $filtro_consulta_tipo_metodo_envio_rel = "";
    } else {
        $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$nombre_archivo                          = "VENTAS_GENERALES_DEL_".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora.'.xls';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$nombre_archivo");

echo "<table border=1>";
echo "<tr>";
echo "<td>TIPO_FACTURA</td>";
echo "<td>FACTURA</td>";
echo "<td>C&Oacute;DIGO</td>";
echo "<td>PRODUCTO</td>";
echo "<td>UND</td>";
echo "<td>T.P</td>";
echo "<td>P.VENTA</td>";
echo "<td>TOTAL</td>";
echo "<td>IVA%</td>";
echo "<td>IVA$</td>";
echo "<td>FORMA_PAGO</td>";
echo "<td>TIPO_PAGO</td>";
echo "<td>DEPENDENCIA</td>";
echo "<td>VENDEDOR</td>";
echo "<td>FECHA_VENTA</td>";
echo "<td>HORA</td>";
echo "<td>ID</td>";
echo "</tr>";

$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, 
tbl15_venta_producto.precio_venta_producto, tbl15_venta_producto.iva_ptj, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.cod_resolucion_facturacion, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto, 
tbl15_venta_producto.nombre_tipo_compra, tbl15_venta_producto.cod_tipo_metodo_envio, tbl15_venta_producto.nombre_tipo_cobro, tbl15_venta_producto.nombre_tipo_precio_venta
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
$filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_venta_producto            = $info_cliente['cod_venta_producto'];
    $cod_producto                  = $info_cliente['cod_producto'];
    $cod_producto_barra            = $info_cliente['cod_producto_barra'];
    $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
    $cod_factura                   = $info_cliente['cod_factura'];
    $cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
    $nombre_producto               = $info_cliente['nombre_producto'];
    $und_venta                     = $info_cliente['und_venta'];
    $precio_compra_producto        = $info_cliente['precio_compra_producto'];
    $precio_costo_producto         = $info_cliente['precio_costo_producto'];
    $total_compra_producto         = $info_cliente['total_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
    $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
    $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
    $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
    $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
    //$cuenta                        = $info_cliente['cuenta'];
    $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
    $cod_administrador_db          = $info_cliente['cod_administrador'];
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $iva_ptj                       = $info_cliente['iva_ptj'];
    $descuento_ptj                 = $info_cliente['descuento_ptj'];
    $cod_resolucion_facturacion    = $info_cliente['cod_resolucion_facturacion'];
    $nombre_tipo_precio_venta      = $info_cliente['nombre_tipo_precio_venta'];

    $total_iva_por_producto_venta  = ((($total_venta_producto - (($descuento_ptj/100)*$total_venta_producto))/(($iva_ptj/100)+(100/100)))*($iva_ptj/100));

    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum     += $total_ganancia_venta;

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

    $sql_resolucion = "SELECT prefijo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion = mysqli_query($conectar, $sql_resolucion) or die(mysqli_error($conectar));
    $datos_resolucion = mysqli_fetch_assoc($consulta_resolucion);

    $prefijo_resolucion_facturacion    = $datos_resolucion['prefijo_resolucion_facturacion'];

    $sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio'";
    $consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio) or die(mysqli_error($conectar));
    $datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio      = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];
    $total_total_venta_producto   += $total_venta_producto;

echo "<tr>";
echo "<td>".$nombre_tipo_factura."</td>";
echo "<td>".$prefijo_resolucion_facturacion.' '.$cod_factura."</td>";
echo "<td>".$cod_producto_barra."</td>";
echo "<td>".$nombre_producto."</td>";
echo "<td>".$und_venta."</td>";
echo "<td>".$nombre_tipo_precio_venta."</td>";
echo "<td>".($precio_venta_producto)."</td>";
echo "<td>".($total_venta_producto)."</td>";
echo "<td>".intval($iva_ptj)."</td>";
echo "<td>".round($total_iva_por_producto_venta, 2)."</td>";
echo "<td>".$nombre_tipo_forma_pago."</td>";
echo "<td>".$nombre_tipo_pago."</td>";
echo "<td>".$nombre_dependencia."</td>";
echo "<td>".$cuenta."</td>";
echo "<td>".$fecha_ymd_venta_producto."</td>";
echo "<td>".$fecha_hora_venta_producto."</td>";
echo "<td>".$cod_venta_producto."</td>";
echo "</tr>";
}
echo "</table>";
}
?>