<?php
require_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {

$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = addslashes($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_compra                      = addslashes($_GET['nombre_tipo_compra']);

$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_factura_compra_producto.cod_administrador = '$cod_administrador')";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
$filtro_consulta_tercero_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
}
if ($cod_tipo_pago==0) {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
} else {
$filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
$filtro_consulta_tipo_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_pago = '$cod_tipo_pago')";
}
if ($cod_tipo_forma_pago==0) {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
} else {
$filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}
if ($cod_dependencia==0) {
$filtro_consulta_dependencia = "";
$filtro_consulta_dependencia_rel = "";
} else {
$filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
$filtro_consulta_dependencia_rel = "AND (tbl15_factura_compra_producto.cod_dependencia = '$cod_dependencia')";
}
if ($nombre_tipo_compra=='0') {
$filtro_consulta_nombre_tipo_compra = "";
$filtro_consulta_nombre_tipo_compra_rel = "";
} else {
$filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
$filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_factura_compra_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$nombre                      = "COMPRAS_GENERALES_POS_DEL_".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora.'.xls';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$nombre");
echo "<table border=1>";
echo "<tr>";
echo "<td>TIPO_FACTURA</td>";
echo "<td>FACTURA</td>";
echo "<td>C&Oacute;DIGO</td>";
echo "<td>PRODUCTO</td>";
echo "<td>UND</td>";
echo "<td>P.COMPRA</td>";
echo "<td>TOTAL COMPRA</td>";
echo "<td>IVA%</td>";
echo "<td>IVA$</td>";
echo "<td>TIPO_PAGO</td>";
echo "<td>VENDEDOR</td>";
echo "<td>FECHA_VENTA</td>";
echo "<td>PROVEEDOR</td>";
echo "<td>COD_PROVEEDOR</td>";
echo "</tr>";

$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_compra_producto, 
tbl15_factura_compra_producto.total_compra_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.cod_administrador, tbl15_factura_compra_producto.iva_ptj, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.cod_tipo_pago, 
tbl15_factura_compra_producto.cod_tipo_forma_pago, tbl15_factura_compra_producto.cod_dependencia, 
tbl15_factura_compra_producto.nombre_tipo_compra, tbl15_factura_compra_producto.und_producto, tbl15_factura_compra_producto.cod_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_compra_rel
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_compra                    = $info_cliente['und_compra'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$und_producto                  = $info_cliente['und_producto'];
$cod_tercero                   = $info_cliente['cod_tercero'];

$total_comision                = ($total_compra_producto * ($comision_ptj/100));
$iva_valor                     = round(($precio_compra_producto * ($iva_ptj/100)), 2);

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

echo "<tr>";
echo "<td>".$nombre_tipo_compra."</td>";
echo "<td>".$cod_factura."</td>";
echo "<td>".$cod_producto_barra."</td>";
echo "<td>".$nombre_producto."</td>";
echo "<td>".$und_compra."</td>";
echo "<td>".intval($precio_compra_producto)."</td>";
echo "<td>".intval($total_compra_producto)."</td>";
echo "<td>".intval($iva_ptj)."</td>";
echo "<td>".$iva_valor."</td>";
echo "<td>".$nombre_tipo_pago."</td>";
echo "<td>".$cuenta."</td>";
echo "<td>".$fecha_ymd_venta_producto."</td>";
echo "<td>".$nombre_propietario."</td>";
echo "<td>".$cod_tercero."</td>";
echo "</tr>";
}
echo "</table>";
}
?>