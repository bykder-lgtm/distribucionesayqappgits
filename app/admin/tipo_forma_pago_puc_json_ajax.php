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
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                     = $_SESSION['usuario'];
$tipo_ajax                                  = addslashes($_REQUEST['tipo_ajax']);
$campo                                      = addslashes($_REQUEST['campo']);

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT cod_estado_promediar_precio_compra_y_venta_cargar_factura_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global  = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'cod_tipo_forma_pago') && ($tipo_ajax == 'tbl15_cuentas_cobrar')) {
	$cod_tipo_forma_pago                           = intval($_REQUEST['valor']);
	$cod_info_factura_compra                       = intval($_REQUEST['id']);
	$nombre_modulo_puc                             = addslashes($_POST['nombre_modulo_puc']);

    $sql_parametrizacion_puc_movimiento_contable = "SELECT cod_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE (nombre_modulo_puc = '$nombre_modulo_puc' AND cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado_puc = '1')";
    $resultado_parametrizacion_puc_movimiento_contable = mysqli_query($conectar, $sql_parametrizacion_puc_movimiento_contable);
    $total_reg = mysqli_num_rows($resultado_parametrizacion_puc_movimiento_contable);
    $info_parametrizacion_puc_movimiento_contable = mysqli_fetch_assoc($resultado_parametrizacion_puc_movimiento_contable);

    $cod_puc                                       = $info_parametrizacion_puc_movimiento_contable['cod_puc'];
?>
    <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
        <?php if (isset($cod_puc)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
        $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE ((nombre_modulo_puc = '$nombre_modulo_puc') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')) ORDER BY nombre_puc ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_puc) AND $cod_puc == $datos2['cod_puc']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_puc'];
        $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
<?php
	//if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>