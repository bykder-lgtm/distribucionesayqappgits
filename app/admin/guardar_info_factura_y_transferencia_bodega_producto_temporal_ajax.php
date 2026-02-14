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
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                       = $_SESSION['usuario'];
$tipo_ajax                    = addslashes($_POST['tipo_ajax']);
$campo                        = addslashes($_POST['campo']);

$datos_info = "SELECT * FROM tbl15_info_factura_transferencia_bodega WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_anyo') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$fecha_anyo                             = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega         = intval($_POST['id']);
$fecha_anyo_seg                         = strtotime($fecha_anyo);
$fecha_dia                              = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                              = date("m-Y", $fecha_anyo_seg);
$anyo                                   = date("Y", $fecha_anyo_seg);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET fecha_anyo = '$fecha_anyo', fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_moneda') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_tipo_moneda           = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_tipo_moneda = '$nombre_tipo_moneda' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_factura') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_tipo_factura         = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_tipo_forma_pago                           = intval($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_tipo_pago         = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_tipo_pago = '$cod_tipo_pago' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_tipo_forma_pago                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_tipo_forma_pago = '$nombre_tipo_forma_pago' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tercero') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_tercero                        = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET cod_tercero = '$cod_tercero' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_tercero = '$cod_tercero' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_tipo_cargue_factura') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_tipo_cargue_factura             = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_factura') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_factura                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_factura = '$cod_factura' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_rete_fuente_ptj') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_rete_fuente_ptj                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva,
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;

$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_rete_fuente_ptj = '$nombre_rete_fuente_ptj', total_rete_fuente = '$total_rete_fuente', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente'
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='ret_ica_ptj') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$ret_ica_ptj                            = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                  = $info_cotizacion_compra['nombre_rete_fuente_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva,
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;

$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET ret_ica_ptj = '$ret_ica_ptj', total_ret_ica = '$total_ret_ica',
total_factura_compra_retefuente = '$total_factura_compra_retefuente'
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_compra') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_compra                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_compra = '$total_compra' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='subtotal') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$subtotal                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='valor_iva') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$valor_iva                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET valor_iva = '$valor_iva' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_descuento') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_descuento                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_descuento = '$total_descuento' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_precio_ipc') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_precio_ipc                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_precio_ipc = '$total_precio_ipc' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_compra_imp') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_compra_imp                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_compra_imp = '$total_compra_imp' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_rete_fuente') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_rete_fuente                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_rete_fuente = '$total_rete_fuente' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_ret_ica') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_ret_ica                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_ret_ica = '$total_ret_ica' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='total_factura_compra_retefuente') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$total_factura_compra_retefuente                 = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega     = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET total_factura_compra_retefuente = '$total_factura_compra_retefuente' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_administrador') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_administrador                  = intval($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_administrador = '$cod_administrador' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_cliente') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_cliente                  = intval($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_cliente = '$cod_cliente' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_empresa') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_empresa                  = intval($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$obtener_empresa = "SELECT nombre_empresa, razonsocial_empresa FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$resultado_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$matriz_empresa = mysqli_fetch_assoc($resultado_empresa);

$nombre_empresa                = $matriz_empresa['nombre_empresa'];
$razonsocial_empresa           = $matriz_empresa['razonsocial_empresa'];

$obtener_cliente = "SELECT cod_cliente FROM tbl15_cliente WHERE cod_empresa = '$cod_empresa'";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cod_cliente                   = $matriz_cliente['cod_cliente'];

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_empresa = '$cod_empresa', cod_cliente = '$cod_cliente', nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa' 
	WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
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
if (($campo=='nombre_tipo_producto') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$nombre_tipo_producto         = addslashes($_POST['valor']);
$cod_info_factura_transferencia_bodega             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET cod_producto_barra = '$cod_producto_barra' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET nombre_producto = '$nombre_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_frec_duracion') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$nombre_frec_duracion         = addslashes(strtoupper($_POST['valor']));
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_unidades') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$und_unidades                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $und_unidades * $und_caja;
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET und_unidades = '$und_unidades', und_compra = '$und_compra', total_compra_producto = '$total_compra_producto', 
precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto', precio_ipc_total = '$precio_ipc_total' 
WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva,
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;

$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp'
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_caja') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$und_caja                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_compra                             = $und_unidades * $und_caja;
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET und_caja = '$und_caja', und_compra = '$und_compra', total_compra_producto = '$total_compra_producto', 
precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto', precio_ipc_total = '$precio_ipc_total' 
WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_compra') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$und_compra                    = addslashes($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET und_compra = '$und_compra', total_compra_producto = '$total_compra_producto', 
precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto', precio_ipc_total = '$precio_ipc_total' 
WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_compra_producto') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_compra_producto                    = addslashes($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $info_temporal['und_compra'];
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto', 
precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='iva_ptj') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$iva_ptj                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc   
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $info_temporal['und_compra'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET iva_ptj = '$iva_ptj', valor_iva = '$valor_iva', precio_costo_producto = '$precio_costo_producto', 
total_costo_producto = '$total_costo_producto', total_compra_producto = '$total_compra_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='dto1') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$dto1                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $info_temporal['und_compra'];
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET dto1 = '$dto1', descuento = '$descuento', total_dto = '$total_dto', precio_costo_producto = '$precio_costo_producto', 
total_costo_producto = '$total_costo_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='dto2') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$dto2                                     = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $info_temporal['und_compra'];
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$precio_ipc                             = $info_temporal['precio_ipc'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET dto2 = '$dto2', descuento = '$descuento', total_dto = '$total_dto', precio_costo_producto = '$precio_costo_producto', 
total_costo_producto = '$total_costo_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS precio_ipc_total, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$precio_ipc_total                       = $suma['precio_ipc_total'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', precio_ipc_total = '$precio_ipc_total',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_ipc') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_ipc                               = addslashes($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_compra, und_unidades, und_caja, precio_costo_producto, precio_compra_producto, dto1, dto2, iva_ptj, cod_info_factura_transferencia_bodega, precio_ipc  
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$cod_info_factura_transferencia_bodega     = $info_temporal['cod_info_factura_transferencia_bodega'];
$und_unidades                           = $info_temporal['und_unidades'];
$und_caja                               = $info_temporal['und_caja'];
$und_compra                             = $info_temporal['und_compra'];
$iva_ptj                                = $info_temporal['iva_ptj'];
$dto1                                   = $info_temporal['dto1'];
$dto2                                   = $info_temporal['dto2'];
$precio_ipc_total                       = $precio_ipc * $und_compra;
$precio_compra_producto                 = $info_temporal['precio_compra_producto'];
$total_compra_producto                  = ($precio_compra_producto * $und_compra) + $precio_ipc_total;

$calc_dto1                              = ($precio_compra_producto) - (($precio_compra_producto) * ($dto1/100));
$calc_precio_compra_descuento           = ($calc_dto1 - ($calc_dto1 * ($dto2/100)));
$precio_costo_producto                  = $calc_precio_compra_descuento - ($calc_precio_compra_descuento - ($calc_precio_compra_descuento/(($iva_ptj/100)+1)));
//$valor_iva                              = ($precio_costo_producto * ($iva_ptj/100));
$descuento                              = ($precio_compra_producto) - $calc_precio_compra_descuento;
$precio_compra_con_descuento            = $precio_compra_producto * $und_compra;
//$precio_costo_producto                  = (($calc_dto1 - ($calc_dto1 * ($dto2/100))));
$total_costo_producto                   = $precio_costo_producto * $und_compra;
$total_dto                              = ($descuento * $und_compra);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_ipc = '$precio_ipc', precio_ipc_total = '$precio_ipc_total', total_compra_producto = '$total_compra_producto' 
WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
// -------------------------------------------------------------------------------------------------------------------------------//
$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_vencimiento') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$fecha_vencimiento            = addslashes(($_POST['valor']));
$cod_transferencia_bodega_producto_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET fecha_vencimiento = '$fecha_vencimiento' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto = '$precio_venta_producto' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto2') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto2                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto2 = '$precio_venta_producto2' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto3') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto3                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto3 = '$precio_venta_producto3' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto4') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto4                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto4 = '$precio_venta_producto4' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto5') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto5                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto5 = '$precio_venta_producto5' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$und_venta                    = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_costo_producto, precio_venta_producto FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $und_venta;
$total_venta_producto         = $info_temporal['precio_venta_producto'] * $und_venta;

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_venta_producto = '$total_venta_producto', 
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$precio_venta_producto        = intval($_POST['valor']);
$cod_transferencia_bodega_producto_temporal  = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta, precio_costo_producto FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $info_temporal['und_venta'];
$total_venta_producto         = $precio_venta_producto * $info_temporal['und_venta'];

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto',
cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$nombre_cliente              = addslashes(strtoupper($_POST['valor']));
$cod_transferencia_bodega_producto_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET nombre_cliente = '$nombre_cliente' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_cobrar') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$cod_tipo_cobrar             = addslashes(($_POST['valor']));
$id                          = addslashes($_POST['id']);
$frag                        = explode("__", $id);
$cod_transferencia_bodega_producto_temporal = $frag[1];

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET cod_tipo_cobrar = '$cod_tipo_cobrar' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_transferencia_bodega_producto_temporal')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_transferencia_bodega_producto_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_transferencia_bodega_producto_temporal SET fecha_alerta = '$fecha_alerta' WHERE cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_historia_clinica') && ($tipo_ajax=='tbl15_info_factura_transferencia_bodega')) {
$cod_historia_clinica         = intval($_POST['valor']);
$cod_venta_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_info_factura_transferencia_bodega SET cod_historia_clinica = '$cod_historia_clinica' WHERE cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_producto_barra') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$cod_producto_barra           = addslashes($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET cod_producto_barra = '$cod_producto_barra' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_producto') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$nombre_producto              = addslashes(strtoupper($_POST['valor']));
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET nombre_producto = '$nombre_producto' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_venta') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$und_venta                    = intval($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_costo_producto, precio_venta_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_costo_producto         = $info_temporal['precio_costo_producto'] * $und_venta;
$total_venta_producto         = $info_temporal['precio_venta_producto'] * $und_venta;

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET und_venta = '$und_venta', total_costo_producto = '$total_costo_producto', total_venta_producto = '$total_venta_producto' 
WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$precio_venta_producto        = intval($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT und_venta FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$total_venta_producto           = $precio_venta_producto * $info_temporal['und_venta'];
//$total_venta_audiometria        = $precio_venta_producto * $info_temporal['und_audiometria'];
//$total_venta_optometria         = $precio_venta_producto * $info_temporal['und_optometria'];
//$total_venta_electrocardiograma = $precio_venta_producto * $info_temporal['und_electrocardiograma'];

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto'
WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$und_audiometria              = intval($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_audiometria') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$und_audiometria               = intval($_POST['valor']);
$cod_venta_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_audiometria      = $precio_venta_producto * $und_audiometria;
$total_venta_producto         = $precio_venta_producto * $und_audiometria;

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET und_audiometria = '$und_audiometria', total_venta_audiometria = '$total_venta_audiometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_optometria') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$und_optometria               = intval($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto        = $info_temporal['precio_venta_producto'];
$total_venta_optometria       = $precio_venta_producto * $und_optometria;
$total_venta_producto         = $precio_venta_producto * $und_optometria;

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET und_optometria = '$und_optometria', total_venta_optometria = '$total_venta_optometria',  
total_venta_producto = '$total_venta_producto' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_electrocardiograma') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$und_electrocardiograma       = intval($_POST['valor']);
$cod_cotizacion_compra_producto           = intval($_POST['id']);

$datos_info_temporal = "SELECT precio_venta_producto FROM tbl15_cotizacion_compra_producto WHERE (cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto')";
$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

$precio_venta_producto            = $info_temporal['precio_venta_producto'];
$total_venta_electrocardiograma   = $precio_venta_producto * $und_electrocardiograma;
$total_venta_producto             = $precio_venta_producto * $und_electrocardiograma;

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET und_electrocardiograma = '$und_electrocardiograma', total_venta_electrocardiograma = '$total_venta_electrocardiograma',  
total_venta_producto = '$total_venta_producto' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_cliente') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$nombre_cliente               = addslashes(strtoupper($_POST['valor']));
$cod_venta_producto           = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET nombre_cliente = '$nombre_cliente' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='fecha_alerta') && ($tipo_ajax=='tbl15_cotizacion_compra_producto')) {
$fecha_alerta                = addslashes(($_POST['valor']));
$cod_transferencia_bodega_producto_temporal = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_cotizacion_compra_producto SET fecha_alerta = '$fecha_alerta' WHERE cod_cotizacion_compra_producto = '$cod_cotizacion_compra_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>