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

if (isset($_POST['cod_movimiento_contable'])) {

	if (isset($_POST['nombre_tipo_documento'])) { $nombre_tipo_documento = addslashes($_POST['nombre_tipo_documento']); } else { $nombre_tipo_documento = ""; } 
	if (isset($_POST['descripcion_movimiento'])) { $descripcion_movimiento = addslashes($_POST['descripcion_movimiento']); } else { $descripcion_movimiento = ""; } 
	if (isset($_POST['cod_factura'])) { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ""; } 
	if (isset($_POST['doc_modifica'])) { $doc_modifica = addslashes($_POST['doc_modifica']); } else { $doc_modifica = ""; } 
	if (isset($_POST['motivo_modificacion'])) { $motivo_modificacion = addslashes($_POST['motivo_modificacion']); } else { $motivo_modificacion = ""; } 
	if (isset($_POST['fecha_factura'])) { $fecha_factura = addslashes($_POST['fecha_factura']); } else { $fecha_factura = ""; } 
	if (isset($_POST['fecha_ymd'])) { $fecha_ymd = addslashes($_POST['fecha_ymd']); } else { $fecha_ymd = ""; } 
	if (isset($_POST['cod_tercero'])) { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ""; } 
	if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = ""; } 
	if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ""; } 
	if (isset($_POST['cod_movimiento_contable_cuenta_personal_entrada'])) { $cod_movimiento_contable_cuenta_personal_entrada = intval($_POST['cod_movimiento_contable_cuenta_personal_entrada']); } else { $cod_movimiento_contable_cuenta_personal_entrada = "0"; } 
	if (isset($_POST['cod_movimiento_contable_cuenta_personal_salida'])) { $cod_movimiento_contable_cuenta_personal_salida = intval($_POST['cod_movimiento_contable_cuenta_personal_salida']); } else { $cod_movimiento_contable_cuenta_personal_salida = "0"; } 
	if (isset($_POST['cod_dependencia'])) { $cod_dependencia = intval($_POST['cod_dependencia']); } else { $cod_dependencia = "0"; } 
	if (isset($_POST['nombre_ccosto'])) { $nombre_ccosto = addslashes($_POST['nombre_ccosto']); } else { $nombre_ccosto = ""; } 

	$pagina = addslashes($_POST['pagina']);

	$fecha_seg                                = strtotime($fecha_ymd);
	$fecha_anyo                               = date("Y-m-d", $fecha_seg);
	$fecha_mes                                = date("Y-m", $fecha_seg);
	$anyo                                     = date("Y", $fecha_seg);
	$ip                                       = $_SERVER["REMOTE_ADDR"];
	$cuenta                                   = $cuenta_actual;
	$total_costo_movimiento_contable_smrt     = 0;

	$obtener_info_puc = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, digito_tercero 
	FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_puc = mysqli_query($conectar, $obtener_info_puc) or die(mysqli_error($conectar));
	$info_puc = mysqli_fetch_assoc($resultado_info_puc);

	$nit_cliente                              = $info_puc['identificacion_tercero'];
	$nombres                                  = $info_puc['nombre1_tercero'];
	$apellidos                                = $info_puc['apellido1_tercero'];
	$digito                                   = $info_puc['digito_tercero'];
	$nombres_clientes                         = $nombres.' '.$apellidos;


	$sql_autoincremento_pyg = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
	$exec_autoincremento_pyg = mysqli_query($conectar, $sql_autoincremento_pyg) or die(mysqli_error($conectar));
	$datos_autoincremento_pyg = mysqli_fetch_assoc($exec_autoincremento_pyg);
	$cod_movimiento_contable                     = $datos_autoincremento_pyg['AUTO_INCREMENT'];

	foreach ($_POST["cod_movimiento_contable_concepto"] as $clave => $cod_movimiento_contable_concepto) { 

		$und_vendida                            = $_POST["und_vendida"][$clave];
		$codigo_puc                             = $_POST["codigo_puc"][$clave];
		$nombre_puc                             = $_POST["nombre_puc"][$clave];
		$costo_movimiento_contable              = $_POST["costo_movimiento_contable"][$clave];
		$total_costo_movimiento_contable        = $und_vendida * $costo_movimiento_contable;

		$obtener_info_cod_nota_credit = "SELECT * FROM tbl15_movimiento_contable_concepto WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
		$resultado_info_cod_nota_credit = mysqli_query($conectar, $obtener_info_cod_nota_credit) or die(mysqli_error($conectar));
		$info_cod_nota_credit = mysqli_fetch_assoc($resultado_info_cod_nota_credit);

		$cod_puc                                = $info_cod_nota_credit['cod_puc'];
		$nombre_tipo_movimiento                 = $info_cod_nota_credit['nombre_tipo_movimiento'];
		$tipo_puc                               = $info_cod_nota_credit['tipo_puc'];
		$venta_movimiento_contable              = $info_cod_nota_credit['venta_movimiento_contable'];
		$total_venta_movimiento_contable        = $info_cod_nota_credit['total_venta_movimiento_contable'];

		if ($nombre_tipo_movimiento == 'DEBITOS') { $total_costo_movimiento_contable_smrt += $total_costo_movimiento_contable; }

		$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET nombre_tipo_movimiento = '$nombre_tipo_movimiento', nombre_tipo_documento = '$nombre_tipo_documento', 
		cod_puc = '$cod_puc', codigo_puc = '$codigo_puc', nombre_puc = '$nombre_puc', tipo_puc = '$tipo_puc', und_vendida = '$und_vendida', venta_movimiento_contable = '$venta_movimiento_contable', 
		total_costo_movimiento_contable = '$total_costo_movimiento_contable', total_venta_movimiento_contable = '$total_venta_movimiento_contable', fecha_anyo = '$fecha_anyo', 
		fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', anyo = '$anyo', ip = '$ip', cuenta = '$cuenta', cod_tercero = '$cod_tercero'
		WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_factura = '$cod_factura', doc_modifica = '$doc_modifica', nombre_tipo_documento = '$nombre_tipo_documento', 
	descripcion_movimiento = '$descripcion_movimiento', total_costo_movimiento_contable = '$total_costo_movimiento_contable_smrt', total_venta_movimiento_contable = '$total_venta_movimiento_contable', 
	cod_tercero = '$cod_tercero', nombres_clientes = '$nombres_clientes', nit_cliente = '$nit_cliente', digito = '$digito', motivo_modificacion = '$motivo_modificacion', 
	fecha_anyo = '$fecha_anyo', fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', anyo = '$anyo', fecha_factura = '$fecha_factura', ip = '$ip', 
	cuenta = '$cuenta', cod_tipo_forma_pago = '$cod_tipo_forma_pago', descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago', 
	cod_movimiento_contable_cuenta_personal_entrada = '$cod_movimiento_contable_cuenta_personal_entrada', cod_movimiento_contable_cuenta_personal_salida = '$cod_movimiento_contable_cuenta_personal_salida', 
	cod_dependencia = '$cod_dependencia', nombre_ccosto = '$nombre_ccosto'
	WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>