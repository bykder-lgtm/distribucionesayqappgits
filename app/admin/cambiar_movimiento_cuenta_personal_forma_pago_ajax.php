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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                             = $_SESSION['usuario'];
$cod_administrador_sesion           = $_SESSION['cod_administrador'];
$tipo_ajax                          = addslashes($_POST['tipo_ajax']);
$campo                              = addslashes($_POST['campo']);
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
$cod_estado_pvar_calculo_automatico_pcompra_global                 = $info_empresa_data['cod_estado_pvar_calculo_automatico_pcompra_global'];
$ptj_pvar_calculo_automatico_pcompra                               = $info_empresa_data['ptj_pvar_calculo_automatico_pcompra'];
$cod_estado_mostrar_venta_por_caja_global                          = $info_empresa_data['cod_estado_mostrar_venta_por_caja_global'];
// ------------------------------------------------------------------------------------------------- //

// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_movimiento_contable_cuenta_personal') && ($tipo_ajax=='tbl15_movimiento_contable_cuenta_personal')) {
	$cod_movimiento_contable_cuenta_personal                = intval($_POST['valor']);
	$cod_info_factura_venta                                 = intval($_POST['id']);
	$nombre_modulo_puc                                      = addslashes($_POST['nombre_modulo_puc']);

  $sql_infos_empresas = "SELECT cod_tipo_forma_pago FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
  $resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
  $info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

  $cod_tipo_forma_pago      = $info_empresa_data['cod_tipo_forma_pago'];
?>
    <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
        <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_tipo_forma_pago'];
        $nombre = $datos2['nombre_tipo_forma_pago'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
<?php
}
?>