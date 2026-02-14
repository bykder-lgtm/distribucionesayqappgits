<?php
date_default_timezone_set("America/Bogota");
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];
$cod_administrador                     = $_SESSION['cod_administrador'];

$respuesta_ajax                        = array();

if (isset($_POST['cod_tipo_accion_caja_registradora'])) {

	$tipo_ajax                                              = addslashes($_POST['tipo_ajax']);
	$campo                                                  = addslashes($_POST['campo']);
	$valor                                                  = addslashes($_POST['valor']);
	$opcion                                                 = addslashes($_POST['opcion']);
	$cod_tipo_forma_pago                                    = intval($_POST['cod_tipo_forma_pago']);
	$cod_tercero                                            = intval($_POST['cod_tercero']);
	$cod_tipo_accion_caja_registradora                      = intval($_POST['cod_tipo_accion_caja_registradora']);

	$respuesta_ajax['llave']                                = 0;
	$respuesta_ajax['total_precio_venta']                   = 0;
	$respuesta_ajax['vlr_cancelado']                        = 0;
	$respuesta_ajax['vlr_vuelto']                           = 0;
	$respuesta_ajax['estado']                               = '0';
	$respuesta_ajax['total_datos_data']                     = 0;
	$respuesta_ajax['cod_tipo_accion_caja_registradora']    = $cod_tipo_accion_caja_registradora;

	if ($cod_tipo_accion_caja_registradora == '1') { $nombre_tipo_tercero = 'CLIENTE'; } elseif ($cod_tipo_accion_caja_registradora == '2') { $nombre_tipo_tercero = 'PROVEEDOR'; } elseif ($cod_tipo_accion_caja_registradora == '3') { $nombre_tipo_tercero = 'CLIENTE'; } else { $nombre_tipo_tercero = 'PROVEEDOR'; }
?>
    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="text-align:center; font-size:15pt; width: 400px;" required>
		<?php if (isset($cod_tercero)) { echo "<option value='1' >...</option>"; } else { echo "<option value='1' selected ></option>"; }
		$consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
		FROM tbl15_tercero WHERE (nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo                = $datos2['cod_tercero'];
		$nombre                = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
		echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
<?php
}
?>
