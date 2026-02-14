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
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_venta')) {
	$cod_tipo_forma_pago                = intval($_POST['valor']);
	$cod_info_factura_venta             = intval($_POST['id']);
	$nombre_modulo_puc                  = addslashes($_POST['nombre_modulo_puc']);
?>
  <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 300px;" required>
      <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
      $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado = '1') ORDER BY nombre_puc ASC";
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
      $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
  </select>
<?php
}
?>