<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                               = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                      = $_SESSION['usuario'];
$cod_administrador_sesion                    = $_SESSION['cod_administrador'];
$tipo_ajax                                   = addslashes($_POST['tipo_ajax']);
$campo                                       = addslashes($_POST['campo']);
$cod_gasto_inmueble_detalle_venta_temporal   = addslashes($_POST['id']);

if (isset($_POST['filtro'])) { $filtro_incluido = ""; } else { $filtro_incluido = "AND (cod_tipo_estado_incluido = '0')"; }
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
// ------------------------------------------------------------------------------------------------- //
$datos_info = "SELECT * FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
$sql_productos = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
$cod_factura                                        = $datos_producto['cod_factura'];
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_anyo') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$fecha_anyo                                 = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta      = intval($_POST['id']);
$fecha_anyo_seg                             = strtotime($fecha_anyo);
$fecha_dia                                  = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                                  = date("m-Y", $fecha_anyo_seg);
$anyo                                       = date("Y", $fecha_anyo_seg);
$fecha_ymd_gasto_inmueble_detalle_venta     = $fecha_anyo;
$fecha_mes_gasto_inmueble_detalle_venta     = $fecha_mes;
$fecha_anyo_gasto_inmueble_detalle_venta    = $anyo;
$fecha_seg_gasto_inmueble_detalle_venta     = $fecha_anyo_seg;

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET fecha_ymd_gasto_inmueble_detalle_venta = '$fecha_ymd_gasto_inmueble_detalle_venta', fecha_mes_gasto_inmueble_detalle_venta = '$fecha_mes_gasto_inmueble_detalle_venta', 
fecha_anyo_gasto_inmueble_detalle_venta = '$fecha_anyo_gasto_inmueble_detalle_venta', fecha_seg_gasto_inmueble_detalle_venta = '$fecha_seg_gasto_inmueble_detalle_venta' 
WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET fecha_anyo = '$fecha_anyo', fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo' 
WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_entrega') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$fecha_entrega                = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta       = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET fecha_entrega = '$fecha_entrega' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_pago') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$fecha_pago                = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta       = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET fecha_pago = '$fecha_pago' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre1_tercero') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre1_tercero               = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta        = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre1_tercero = UPPER('$nombre1_tercero') WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_moneda           = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_factura         = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_forma_pago         = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_forma_pago = '$nombre_tipo_forma_pago' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_inventario') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_tipo_inventario                = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_tipo_inventario = '$cod_tipo_inventario' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_tipo_forma_pago                = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_pago') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_tipo_pago         = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_tipo_pago = '$cod_tipo_pago' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tercero') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_tercero                        = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$datos_data_info_factura = "SELECT observacion_tercero FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_info_gasto_inmueble_detalle_venta DESC";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$observacion_tercero      = $data_info_factura['observacion_tercero'];

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_tercero = '$cod_tercero' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_tercero = '$cod_tercero', observacion_tercero = '$observacion_tercero' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo trim($observacion_tercero); } else { echo ""; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_factura') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_factura                                       = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$datos_data_info_factura = "SELECT observacion_tercero FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta') ORDER BY cod_info_gasto_inmueble_detalle_venta DESC";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$observacion_tercero      = $data_info_factura['observacion_tercero'];

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_factura = '$cod_factura' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_factura = '$cod_factura', observacion_tercero = '$observacion_tercero' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_base_caja') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_base_caja                      = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$datos_mesa_ocupada = "SELECT cuenta FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (cod_base_caja = '$cod_base_caja') AND (nombre_estado_factura = 'ABIERTA')";
$consulta_mesa_ocupada = mysqli_query($conectar, $datos_mesa_ocupada);
$mesa_ocupada = mysqli_num_rows($consulta_mesa_ocupada);
$data_mesa_ocupada = mysqli_fetch_assoc($consulta_mesa_ocupada);

$cuenta                         = $data_mesa_ocupada['cuenta'];

if ($mesa_ocupada == '0') {
$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_base_caja = '$cod_base_caja' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_base_caja = '$cod_base_caja' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
//if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} else {
echo "OCUPADA POR <br>".$cuenta;
}

}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_prioridad') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_prioridad                      = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_prioridad = '$cod_prioridad' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_prioridad = '$cod_prioridad' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo trim($observacion_tercero); } else { echo ""; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_metodo_envio') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_tipo_metodo_envio              = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_tipo_metodo_envio = '$cod_tipo_metodo_envio' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_administrador') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_administrador                  = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$datos_data_info_factura = "SELECT cuenta FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

$cuenta      = $data_info_factura['cuenta'];

if ($cod_administrador_sesion <> $cod_administrador) {
$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_gasto_inmueble_detalle_venta_temporal";
$resultado_animal = mysqli_query($conectar, $sql_animal);
$info_animal = mysqli_fetch_assoc($resultado_animal);

$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_administrador = '$cod_administrador', cuenta = '$cuenta', cod_caja_virtual = '$cod_caja_virtual' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_administrador = '$cod_administrador', cuenta = '$cuenta', cod_caja_virtual = '$cod_caja_virtual' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
} else {
$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_administrador = '$cod_administrador', cuenta = '$cuenta' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_administrador = '$cod_administrador', cuenta = '$cuenta' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}

}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_moneda                 = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_factura                = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='observacion_tercero') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$observacion_tercero                   = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta       = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET observacion_tercero = '$observacion_tercero' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_cliente') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_cliente                  = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_cliente = '$cod_cliente' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_empresa') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_empresa                  = intval($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$obtener_empresa = "SELECT nombre_empresa, razonsocial_empresa FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$resultado_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$matriz_empresa = mysqli_fetch_assoc($resultado_empresa);

$nombre_empresa                = $matriz_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_empresa['razonsocial_empresa'];

$obtener_cliente = "SELECT cod_cliente FROM tbl15_cliente WHERE cod_empresa = '$cod_empresa'";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cod_cliente                   = $matriz_cliente['cod_cliente'];

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_empresa = '$cod_empresa', cod_cliente = '$cod_cliente', nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa' 
	WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
?>
        <select name="cod_cliente" id="cod_cliente" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_cliente)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_cliente, nombres, nombre_raza FROM tbl15_cliente WHERE (cod_empresa = '$cod_empresa') ORDER BY nombres ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_cliente) AND $cod_cliente == $datos2['cod_cliente']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_cliente'];
            $nombre = $datos2['nombres'].' | '.$datos2['nombre_raza'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
<?php
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_producto') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$nombre_tipo_producto         = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_producto_barra = '$cod_producto_barra' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET nombre_producto = '$nombre_producto' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='comentario_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$comentario_producto           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET comentario_producto = '$comentario_producto' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='descripcion_gasto_inmueble_detalle') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$descripcion_gasto_inmueble_detalle           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET descripcion_gasto_inmueble_detalle = '$descripcion_gasto_inmueble_detalle' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
	header('Content-Type: application/json');
	$respuesta_ajax                             = array();
	
	$precio_venta_producto                      = intval($_POST['valor']);
	$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);
	$total_venta_producto                       = $precio_venta_producto;

	$sql_productos = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
	$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
	$cod_factura                                        = $datos_producto['cod_factura'];
	$precio_compra_producto                             = $datos_producto['precio_compra_producto'];
	$ganancia                                           = $precio_venta_producto - $precio_compra_producto;

	$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto' 
	WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_productos = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_factura = '$cod_factura') $filtro_incluido";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['emisor']                          = 'precio_venta_producto';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_compra_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
	header('Content-Type: application/json');
	$respuesta_ajax                             = array();

	$precio_compra_producto                     = intval($_POST['valor']);
	$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);
	$total_compra_producto                      = $precio_compra_producto;

	$sql_productos = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$nombre_gasto_inmueble_detalle                      = $datos_producto['nombre_gasto_inmueble_detalle'];
	$cod_cuentas_cobrar_alerta                          = $datos_producto['cod_cuentas_cobrar_alerta'];
	$cod_factura                                        = $datos_producto['cod_factura'];
	$precio_venta_producto                              = $datos_producto['precio_venta_producto'];
	$ganancia                                           = $precio_venta_producto - $precio_compra_producto;

	$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto' 
	WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_productos = "SELECT SUM(precio_compra_producto) AS total_precio_compra, SUM(precio_venta_producto) AS total_precio_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_factura = '$cod_factura') $filtro_incluido";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$total_precio_compra                               = $datos_producto['total_precio_compra'];
	$total_precio_venta                                = $datos_producto['total_precio_venta'];
	$total_gasto                                       = $total_precio_venta;
	$total_gasto_compra                                = $total_precio_compra;
	$total_gasto_venta                                 = $total_precio_venta;
	$total_gasto_ganancia                              = $total_gasto_venta - $total_gasto_compra;

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['total_gasto']                     = $total_gasto;
	$respuesta_ajax['total_gasto_format']              = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['total_gasto_compra_format']       = number_format($total_gasto_compra, 0, ",", ".");
	$respuesta_ajax['total_gasto_venta_format']        = number_format($total_gasto_venta, 0, ",", ".");
	$respuesta_ajax['total_gasto_ganancia_format']     = number_format($total_gasto_ganancia, 0, ",", ".");
	$respuesta_ajax['emisor']                          = 'precio_compra_producto';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='url_img1') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
	header('Content-Type: application/json');
	$respuesta_ajax                             = array();

	$url_img1                                   = addslashes($_POST['valor']);
	$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

	$time                                       = time();
	$fecha_ymdHis                               = date("YmdHis");
	$formato                                    = 'jpg';
	$fecha_hora                                 = date("H:i:s");
	$fecha_ymd                                  = date("Y-m-d");

	$ruta_firma_miniatura                       = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                        = '../archivador/foto/miniatura/';
	$ruta_firma_orig                            = '../archivador/firma/original/';
	$ruta_foto_orig                             = '../archivador/documentos/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
	$formato_img2                               = explode(".", $url_img1);
	$formato_img2                               = end($formato_img2);
	$nombre_normal2                             = $fecha_ymdHis.'_'.$cod_gasto_inmueble_detalle_venta_temporal.'.'.$formato_img2;
	$url_img_orig_producto                      = $ruta_foto_orig.$nombre_normal2;
	$url_img_min_producto                       = $ruta_foto_orig.$nombre_normal2;
	} else { 
	$formato_img2                               = "";
	$formato_img2                               = "";
	$nombre_normal2                             = "";
	$url_img_orig_producto                      = "";
	$url_img_min_producto                       = "";
	}

	$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto'
	WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$total_gasto                                = 0;
	$respuesta_ajax['afectado']                 = $afectado;
	$respuesta_ajax['total_gasto']              = $total_gasto;
	$respuesta_ajax['total_gasto_format']       = number_format($total_gasto, 0, ",", ".");
	$respuesta_ajax['emisor']                   = 'precio_compra_producto';
	$respuesta_ajax['mensaje']                  = 'Datos cargados correctamente.';

	if ($url_img1 <> '') { copy($_FILES['valor']['tmp_name'], $url_img_orig_producto); }
	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_gasto_inmueble_detalle') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_gasto_inmueble_detalle               = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$fecha                                      = $fecha_gasto_inmueble_detalle;
$fecha_mes 	                                = date("Y-m", strtotime($fecha_gasto_inmueble_detalle));
$anyo 	 	                                = date("Y", strtotime($fecha_gasto_inmueble_detalle));
$fecha_invert 	                            = $fecha_gasto_inmueble_detalle;
$fecha_seg                                  = strtotime($fecha_gasto_inmueble_detalle);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_gasto_inmueble_detalle = '$fecha_gasto_inmueble_detalle',
fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', fecha_seg = '$fecha_seg' 
WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_origen_produccion') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$cod_origen_produccion        = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_origen_produccion = '$cod_origen_produccion' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='peso_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$peso_producto           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET peso_producto = '$peso_producto' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='unidad_medida_peso') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$unidad_medida_peso           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET unidad_medida_peso = '$unidad_medida_peso' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='descripcion_tipo_forma_pago') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$descripcion_tipo_forma_pago         = addslashes(($_POST['valor']));
$cod_info_gasto_inmueble_detalle_venta              = intval($_POST['nombre_campo_incre']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}



// ------------------------------------------------------------------------------------------------- //
if (($campo=='placa_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$placa_producto           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET placa_producto = UPPER('$placa_producto') WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_ymd_parqueo_ini') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_ymd_parqueo_ini           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$sql_venta_temporal = "SELECT fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
$info_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

$fecha_hora_parqueo_ini          = $info_venta_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin           = $info_venta_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin          = $info_venta_temporal['fecha_hora_parqueo_fin'];
$fecha_ymd_hora_parqueo_ini      = $fecha_ymd_parqueo_ini.' '.$fecha_hora_parqueo_ini;
$fecha_ymd_hora_parqueo_fin      = $fecha_ymd_parqueo_fin.' '.$fecha_hora_parqueo_fin;
$und_venta                       = floor(abs((strtotime($fecha_ymd_hora_parqueo_ini)-strtotime($fecha_ymd_hora_parqueo_fin)) / 60));

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_ymd_parqueo_ini = '$fecha_ymd_parqueo_ini' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_hora_parqueo_ini') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_hora_parqueo_ini           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$sql_venta_temporal = "SELECT fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
$info_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

$fecha_ymd_parqueo_ini           = $info_venta_temporal['fecha_ymd_parqueo_ini'];
$fecha_ymd_parqueo_fin           = $info_venta_temporal['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin          = $info_venta_temporal['fecha_hora_parqueo_fin'];
$fecha_ymd_hora_parqueo_ini      = $fecha_ymd_parqueo_ini.' '.$fecha_hora_parqueo_ini;
$fecha_ymd_hora_parqueo_fin      = $fecha_ymd_parqueo_fin.' '.$fecha_hora_parqueo_fin;
$und_venta                       = floor(abs((strtotime($fecha_ymd_hora_parqueo_ini)-strtotime($fecha_ymd_hora_parqueo_fin)) / 60));

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_hora_parqueo_ini = '$fecha_hora_parqueo_ini' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_ymd_parqueo_fin') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_ymd_parqueo_fin           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$sql_venta_temporal = "SELECT fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
$info_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

$fecha_ymd_parqueo_ini           = $info_venta_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini          = $info_venta_temporal['fecha_hora_parqueo_ini'];
$fecha_hora_parqueo_fin          = $info_venta_temporal['fecha_hora_parqueo_fin'];
$fecha_ymd_hora_parqueo_ini      = $fecha_ymd_parqueo_ini.' '.$fecha_hora_parqueo_ini;
$fecha_ymd_hora_parqueo_fin      = $fecha_ymd_parqueo_fin.' '.$fecha_hora_parqueo_fin;
$und_venta                       = floor(abs((strtotime($fecha_ymd_hora_parqueo_ini)-strtotime($fecha_ymd_hora_parqueo_fin)) / 60));

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_ymd_parqueo_fin = '$fecha_ymd_parqueo_fin' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_hora_parqueo_fin') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_hora_parqueo_fin           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$sql_venta_temporal = "SELECT fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
$info_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

$fecha_ymd_parqueo_ini           = $info_venta_temporal['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini          = $info_venta_temporal['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin           = $info_venta_temporal['fecha_ymd_parqueo_fin'];
$fecha_ymd_hora_parqueo_ini      = $fecha_ymd_parqueo_ini.' '.$fecha_hora_parqueo_ini;
$fecha_ymd_hora_parqueo_fin      = $fecha_ymd_parqueo_fin.' '.$fecha_hora_parqueo_fin;
$und_venta                       = floor(abs((strtotime($fecha_ymd_hora_parqueo_ini)-strtotime($fecha_ymd_hora_parqueo_fin)) / 60));

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_hora_parqueo_fin = '$fecha_hora_parqueo_fin' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_frec_duracion') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$nombre_frec_duracion         = addslashes(strtoupper($_POST['valor']));
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$und_venta                        = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal      = intval($_POST['id']);
$nombre_campo_incre               = addslashes($_POST['nombre_campo_incre']);

if ($und_venta == '' || $und_venta == '0'|| $und_venta == '0.00') { $und_venta = '1'; } else { $und_venta  = $und_venta; }
if ($cod_estado_modificar_und_venta_una_sola_vez_global == '1') { $cod_estado_componente_und_venta  = "1"; } else { $cod_estado_componente_und_venta  = "0"; }

$datos_info_temporal = "SELECT precio_compra_producto, precio_gasto_inmueble_detalle_venta, cod_caja_virtual FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_compra_producto        = $info_temporal['precio_compra_producto'] * $und_venta;
$total_costo_producto         = $info_temporal['precio_compra_producto'] * $und_venta;
$total_gasto_inmueble_detalle_venta         = $info_temporal['precio_gasto_inmueble_detalle_venta'] * $und_venta;
$cod_caja_virtual             = $info_temporal['cod_caja_virtual'];

if ($total_compra_producto > $total_gasto_inmueble_detalle_venta) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET und_venta = '$und_venta', total_compra_producto = '$total_compra_producto', 
total_costo_producto = '$total_costo_producto', total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta', 
cod_estado_permitir_venta = '$cod_estado_permitir_venta', cod_estado_componente_und_venta = '$cod_estado_componente_und_venta' 
WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ($cod_estado_bascula_balanza_electronica_pesar_producto_global == '1') { header('Content-Type: application/json'); $datos_array['ok_ajax'] = 'REFRESCAR_BASCULA'; echo json_encode($datos_array); } else { if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; } }

$sql_base_iva = "SELECT Sum((total_gasto_inmueble_detalle_venta)/((iva_ptj/100)+(100/100))) As subtotal_base_iva, cod_info_gasto_inmueble_detalle_venta
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];
$cod_info_gasto_inmueble_detalle_venta       = $matriz_base_iva['cod_info_gasto_inmueble_detalle_venta'];

if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
	if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }
	$sql_data = sprintf("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}

}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_caja_sobre') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$und_caja_sobre                   = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal      = intval($_POST['id']);
$nombre_campo_incre               = addslashes($_POST['nombre_campo_incre']);
$frag_incre                       = explode("und_caja_sobre", $nombre_campo_incre);
$incre                            = $frag_incre[1];

if ($cod_estado_modificar_und_venta_una_sola_vez_global == '1') { $cod_estado_componente_und_venta  = "1"; } else { $cod_estado_componente_und_venta  = "0"; }

$datos_info_temporal = "SELECT precio_compra_producto, precio_gasto_inmueble_detalle_venta, cajas_sobre, und_sobre, nombre_tipo_und_caja_sobre, und_venta, cod_info_gasto_inmueble_detalle_venta  
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_gasto_inmueble_detalle_venta       = $info_temporal['cod_info_gasto_inmueble_detalle_venta'];
$cajas_sobre                  = $info_temporal['cajas_sobre'];
$und_sobre                    = $info_temporal['und_sobre'];
$nombre_tipo_und_caja_sobre   = $info_temporal['nombre_tipo_und_caja_sobre'];

if ($nombre_tipo_und_caja_sobre == 'CAJA') {
$und_caja_sobre_total         = $cajas_sobre;
$und_venta                    = $und_caja_sobre * $und_caja_sobre_total;
} elseif ($nombre_tipo_und_caja_sobre == 'SOBRE') {
$und_caja_sobre_total         = $und_sobre;
$und_venta                    = $und_caja_sobre * $und_caja_sobre_total;
} else {
$und_venta                    = $info_temporal['und_venta'];
}

$total_compra_producto        = $info_temporal['precio_compra_producto'] * $und_venta;
$total_costo_producto         = $info_temporal['precio_compra_producto'] * $und_venta;
$total_gasto_inmueble_detalle_venta         = $info_temporal['precio_gasto_inmueble_detalle_venta'] * $und_venta;


if ($total_costo_producto > $total_gasto_inmueble_detalle_venta) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET und_caja_sobre = '$und_caja_sobre', und_venta = '$und_venta', total_compra_producto = '$total_compra_producto', 
total_costo_producto = '$total_costo_producto', total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta', cod_estado_permitir_venta = '$cod_estado_permitir_venta', 
cod_estado_componente_und_venta = '$cod_estado_componente_und_venta' 
WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$datos_info_total = "SELECT SUM(total_gasto_inmueble_detalle_venta) AS total_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')";
$consulta_info_total = mysqli_query($conectar, $datos_info_total) or die(mysqli_error($conectar));
$info_total = mysqli_fetch_assoc($consulta_info_total);

$total_venta                   = $info_total['total_venta'];

header('Content-Type: application/json'); 
$datos_array['und_venta'] = "".$und_venta;
$datos_array['total_venta'] = number_format($total_venta, 0, ",", ".");
$datos_array['incre'] = $incre;
$datos_array['div_und_caja_sobre'] = 'und_caja_sobre'.$incre;
$datos_array['total_gasto_inmueble_detalle_venta'] = number_format($total_gasto_inmueble_detalle_venta, 0, ",", ".");
$datos_array['ok_ajax'] = '';

echo json_encode($datos_array); 
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_gasto_inmueble_detalle_venta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$precio_gasto_inmueble_detalle_venta        = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta, precio_costo_producto, cod_producto_barra, cod_info_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $info_temporal['und_venta'];
$cod_producto_barra           = $info_temporal['cod_producto_barra'];
$cod_info_gasto_inmueble_detalle_venta       = $info_temporal['cod_info_gasto_inmueble_detalle_venta'];



$sql_prod_depend = "SELECT cod_dependencia, comision_ptj FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_prod_depend = mysqli_query($conectar, $sql_prod_depend) or die(mysqli_error($conectar));
$suma_prod_depend = mysqli_fetch_assoc($consulta_prod_depend);

$cod_dependencia               = $suma_prod_depend['cod_dependencia'];
$comision_ptj                  = $suma_prod_depend['comision_ptj'];

$sql_depend = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_depend = mysqli_query($conectar, $sql_depend) or die(mysqli_error($conectar));
$suma_depend = mysqli_fetch_assoc($consulta_depend);

$nombre_dependencia               = $suma_depend['nombre_dependencia'];

echo "<br>nombre_dependencia = ".$nombre_dependencia;

if ($nombre_dependencia == 'RECARGA') {
	$base_precio_compra = ($precio_gasto_inmueble_detalle_venta * ($comision_ptj/100));
	$precio_compra_producto = $precio_gasto_inmueble_detalle_venta - $base_precio_compra;
	$total_compra_producto = $precio_compra_producto * $info_temporal['und_venta'];

	$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto' 
	WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}

if ($cod_producto_barra == '33333333') {
if ($precio_gasto_inmueble_detalle_venta > 0) { $precio_gasto_inmueble_detalle_venta = $precio_gasto_inmueble_detalle_venta * -1; }

$suma_temporal = "SELECT Sum(total_gasto_inmueble_detalle_venta) As total_venta 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_sin_descuento    = ($suma['total_venta']);
$total_gasto_inmueble_detalle_venta         = ($precio_gasto_inmueble_detalle_venta * $info_temporal['und_venta']);
$total_venta_neta             = ($total_venta_sin_descuento - $precio_gasto_inmueble_detalle_venta);
$total_descuento_venta        = ($total_venta_sin_descuento - $total_venta_neta);
$descuento_ptj_dif            = ($total_descuento_venta / $total_venta_sin_descuento) * 100;
$nombre_tipo_precio           = abs($descuento_ptj_dif);
} else {
$total_gasto_inmueble_detalle_venta         = $precio_gasto_inmueble_detalle_venta * $info_temporal['und_venta'];
$nombre_tipo_precio           = 0;
}

if ($total_costo_producto > $total_gasto_inmueble_detalle_venta) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET precio_gasto_inmueble_detalle_venta = '$precio_gasto_inmueble_detalle_venta', total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta',
cod_estado_permitir_venta = '$cod_estado_permitir_venta', nombre_tipo_precio = '$nombre_tipo_precio' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$nombre_cliente              = addslashes(strtoupper($_POST['valor']));
$cod_gasto_inmueble_detalle_venta_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET nombre_cliente = '$nombre_cliente' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_cobrar') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$cod_tipo_cobrar             = addslashes(($_POST['valor']));
$id                          = addslashes($_POST['id']);
$frag                        = explode("__", $id);
$cod_gasto_inmueble_detalle_venta_temporal = $frag[1];

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET cod_tipo_cobrar = '$cod_tipo_cobrar' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_gasto_inmueble_detalle_venta_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta_temporal SET fecha_alerta = '$fecha_alerta' WHERE cod_gasto_inmueble_detalle_venta_temporal = '$cod_gasto_inmueble_detalle_venta_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='observacion_tercero') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$observacion_tercero                   = addslashes($_POST['valor']);
$cod_info_gasto_inmueble_detalle_venta       = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET observacion_tercero = '$observacion_tercero' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='identificacion_tercero') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta_temporal')) {
$identificacion_tercero           = addslashes($_POST['valor']);

$sql_datos = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '$identificacion_tercero'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$existe_reg = mysqli_num_rows($resultado_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$nombre1_tercero                = $info_datos['nombre1_tercero'];
$nombre2_tercero                = $info_datos['nombre2_tercero'];
$apellido1_tercero              = $info_datos['apellido1_tercero'];
$apellido2_tercero              = $info_datos['apellido2_tercero'];

$nombre_tercero                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

if ($existe_reg <> 0) { 
echo "<img src='../imagenes/advertencia1.gif'>Error: el documento ".$identificacion_tercero." ya existe para: ".$nombre_tercero.'. Intente con otro numero de documento '."<img src='../imagenes/advertencia1.gif'>"; 
} else { echo ""; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_gasto_inmueble_detalle_venta')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET cod_producto_barra = '$cod_producto_barra' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET nombre_producto = '$nombre_producto' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$und_venta                    = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);
$origen_operacion             = 'ventas';
$fecha_devolucion             = date("Y-m-d");
$hora_devolucion              = date("H:i:s");
$fecha_time                   = time();

$sql_datos = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero, precio_compra_producto, precio_costo_producto, precio_gasto_inmueble_detalle_venta, 
cod_tipo_pago, cod_info_gasto_inmueble_detalle_venta, cod_factura, precio_costo_producto, precio_gasto_inmueble_detalle_venta, und_venta, iva_ptj, fecha_ymd_gasto_inmueble_detalle_venta, fecha_hora_gasto_inmueble_detalle_venta, cuenta 
FROM tbl15_gasto_inmueble_detalle_venta WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

//$und_venta                      = $info_datos['und_venta']; 
$cod_producto                   = $info_datos['cod_producto'];
$cod_producto_barra             = $info_datos['cod_producto_barra'];
$nombre_producto                = $info_datos['nombre_producto'];
$cod_tercero                    = $info_datos['cod_tercero'];
$precio_compra_producto         = $info_datos['precio_compra_producto'];
$precio_costo_producto          = $info_datos['precio_costo_producto'];
$precio_gasto_inmueble_detalle_venta          = $info_datos['precio_gasto_inmueble_detalle_venta'];
$iva_ptj                        = $info_datos['iva_ptj'];
$fecha_ymd_gasto_inmueble_detalle_venta       = $info_datos['fecha_ymd_gasto_inmueble_detalle_venta'];
$fecha_hora_gasto_inmueble_detalle_venta      = $info_datos['fecha_hora_gasto_inmueble_detalle_venta'];
$vendedor                       = $info_datos['cuenta'];
$cod_tipo_pago                  = $info_datos['cod_tipo_pago'];
$cod_info_gasto_inmueble_detalle_venta         = $info_datos['cod_info_gasto_inmueble_detalle_venta'];
$cod_factura                    = $info_datos['cod_factura'];
$total_costo_producto           = $info_datos['precio_costo_producto'] * $und_venta;
$total_compra_producto          = $info_datos['precio_compra_producto'] * $und_venta;
$total_gasto_inmueble_detalle_venta           = $info_datos['precio_gasto_inmueble_detalle_venta'] * $und_venta;
$unidades_vendidas              = $und_venta;
$und_vend_orig                  = $und_venta;
$vlr_total_venta                = $precio_gasto_inmueble_detalle_venta * $und_venta;
$vlr_total_compra               = $precio_compra_producto * $und_venta;
$devoluciones                   = $und_vend_orig - $und_venta;
$comentario                     = 'devolucion venta input ajax';
$fecha                          = $fecha_time;
$fecha_mes                      = date("Y-m");

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_compra_producto = '$total_compra_producto' , total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta'
WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_gasto_inmueble_detalle_venta * und_venta) AS total_precio_venta 
FROM tbl15_gasto_inmueble_detalle_venta WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'";
$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

$total_precio_compra      = $info_datos_venta_sum['total_precio_compra']; 
$total_precio_venta       = $info_datos_venta_sum['total_precio_venta']; 

$agregar_regis = sprintf("UPDATE tbl15_info_gasto_inmueble_detalle_venta SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
total_datos_data = '$total_datos_data' WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'");

$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

$und_producto_inv      = $info_datos_producto['und_producto']; 
$und_producto          = $und_producto_inv + $und_venta;
$und_inventario        = $und_producto_inv;
$und_nuevas            = $und_venta;

$data_sql = ("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_gasto_inmueble_detalle_venta, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_gasto_inmueble_detalle_venta, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_gasto_inmueble_detalle_venta', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_gasto_inmueble_detalle_venta', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_gasto_inmueble_detalle_venta', '$fecha_ymd_gasto_inmueble_detalle_venta', 
'$fecha_hora_gasto_inmueble_detalle_venta', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

if ($cod_tipo_pago == '2') {
$sql_total_deuda_credito = "SELECT SUM(total_gasto_inmueble_detalle_venta) AS monto_deuda FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')";
$consulta_total_deuda_credito = mysqli_query($conectar, $sql_total_deuda_credito) or die(mysqli_error($conectar));
$info_total_deuda_credito = mysqli_fetch_assoc($consulta_total_deuda_credito);

$monto_deuda                  = $info_total_deuda_credito['monto_deuda'];

$sql_total_abonado_credito = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_factura = '$cod_factura')";
$consulta_total_abonado_credito = mysqli_query($conectar, $sql_total_abonado_credito) or die(mysqli_error($conectar));
$info_total_abonado_credito = mysqli_fetch_assoc($consulta_total_abonado_credito);

$abonado                      = $info_total_abonado_credito['abonado'];
$subtotal                     = $monto_deuda - $abonado;

$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal', abonado = '$abonado' WHERE cod_factura = '$cod_factura'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_gasto_inmueble_detalle_venta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$precio_gasto_inmueble_detalle_venta        = addslashes($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_gasto_inmueble_detalle_venta           = $precio_gasto_inmueble_detalle_venta * $info_temporal['und_venta'];
//$total_venta_audiometria        = $precio_gasto_inmueble_detalle_venta * $info_temporal['und_audiometria'];
//$total_venta_optometria         = $precio_gasto_inmueble_detalle_venta * $info_temporal['und_optometria'];
//$total_venta_electrocardiograma = $precio_gasto_inmueble_detalle_venta * $info_temporal['und_electrocardiograma'];

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET precio_gasto_inmueble_detalle_venta = '$precio_gasto_inmueble_detalle_venta', total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta'
WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$und_audiometria              = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_gasto_inmueble_detalle_venta        = $info_temporal['precio_gasto_inmueble_detalle_venta'];
$total_venta_audiometria      = $precio_gasto_inmueble_detalle_venta * $und_audiometria;
$total_gasto_inmueble_detalle_venta         = $precio_gasto_inmueble_detalle_venta * $und_audiometria;

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$und_audiometria               = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_gasto_inmueble_detalle_venta        = $info_temporal['precio_gasto_inmueble_detalle_venta'];
$total_venta_audiometria      = $precio_gasto_inmueble_detalle_venta * $und_audiometria;
$total_gasto_inmueble_detalle_venta         = $precio_gasto_inmueble_detalle_venta * $und_audiometria;

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_optometria') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$und_optometria               = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_gasto_inmueble_detalle_venta        = $info_temporal['precio_gasto_inmueble_detalle_venta'];
$total_venta_optometria       = $precio_gasto_inmueble_detalle_venta * $und_optometria;
$total_gasto_inmueble_detalle_venta         = $precio_gasto_inmueble_detalle_venta * $und_optometria;

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET und_optometria = '$und_optometria', total_venta_optometria = '$total_venta_optometria',  
total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_electrocardiograma') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$und_electrocardiograma       = intval($_POST['valor']);
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta WHERE (cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_gasto_inmueble_detalle_venta            = $info_temporal['precio_gasto_inmueble_detalle_venta'];
$total_venta_electrocardiograma   = $precio_gasto_inmueble_detalle_venta * $und_electrocardiograma;
$total_gasto_inmueble_detalle_venta             = $precio_gasto_inmueble_detalle_venta * $und_electrocardiograma;

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET und_electrocardiograma = '$und_electrocardiograma', total_venta_electrocardiograma = '$total_venta_electrocardiograma',  
total_gasto_inmueble_detalle_venta = '$total_gasto_inmueble_detalle_venta' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$nombre_cliente               = addslashes(strtoupper($_POST['valor']));
$cod_gasto_inmueble_detalle_venta           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET nombre_cliente = '$nombre_cliente' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_gasto_inmueble_detalle_venta')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_gasto_inmueble_detalle_venta_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_gasto_inmueble_detalle_venta SET fecha_alerta = '$fecha_alerta' WHERE cod_gasto_inmueble_detalle_venta = '$cod_gasto_inmueble_detalle_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>