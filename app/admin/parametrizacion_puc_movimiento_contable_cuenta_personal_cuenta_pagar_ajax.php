<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../houseburger_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//header('Content-Type: application/json');

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if (isset($_POST['valor'])) {
	$id                                                 = addslashes($_POST['id']);
	$cod_tipo_forma_pago                                = intval($_POST['valor']);
	$campo                                              = addslashes($_POST['campo']);
	$nombre_modulo_puc                                  = addslashes($_POST['nombre_modulo_puc']);
	$tipo_ajax                                          = addslashes($_POST['tipo_ajax']);
	$cod_tercero                                        = intval($_POST['cod_tercero']);
	$cod_factura                                        = intval($_POST['cod_factura']);
	$respuesta_ajax                                     = array();

        $sql_parametrizacion_puc_movimiento_contable = "SELECT cod_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE (nombre_modulo_puc = '$nombre_modulo_puc' AND cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado_puc = '1')";
        $resultado_parametrizacion_puc_movimiento_contable = mysqli_query($conectar, $sql_parametrizacion_puc_movimiento_contable);
        $total_reg = mysqli_num_rows($resultado_parametrizacion_puc_movimiento_contable);
        $info_parametrizacion_puc_movimiento_contable = mysqli_fetch_assoc($resultado_parametrizacion_puc_movimiento_contable);

        $cod_puc                                       = $info_parametrizacion_puc_movimiento_contable['cod_puc'];

	if ($campo == 'cod_tipo_forma_pago') {
?>
    <select name="cod_movimiento_contable_cuenta_personal" id="cod_puc" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
        <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
        $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado = '1') ORDER BY nombre_puc ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
        $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'].' | '.$codigo;
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
<?php
	}
	else {
	}
}
?>