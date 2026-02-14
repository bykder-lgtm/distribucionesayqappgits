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

$valor_intro                 = addslashes($_REQUEST['valor']);
$campo                       = addslashes($_REQUEST['campo']);
$campo_id                    = addslashes($_REQUEST['id']);
//$frag                        = explode("_z_", $campo_id);
//$id                          = intval($frag[1]);
$id                          = addslashes($_REQUEST['id']);

if ($campo == 'codigo_puc[]') {
	if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); } 
	if (isset($_REQUEST['cod_puc'])) { $cod_puc = intval($_REQUEST['cod_puc']); } 

	if (isset($_REQUEST['valor'])) { $valor = addslashes($_REQUEST['valor']); } 
	if (isset($_REQUEST['codigo_puc'])) { $codigo_puc = intval($_REQUEST['codigo_puc']); } 
	if (isset($_REQUEST['nombre_puc'])) { $nombre_puc = addslashes($_REQUEST['nombre_puc']); } 
	if (isset($_REQUEST['jqui'])) { $jqui = intval($_REQUEST['jqui']); }
	$cod_movimiento_contable_concepto         = $id;

	$obtener_info_puc = "SELECT cod_puc, tipo_puc, codigo_puc FROM tbl15_puc WHERE cod_puc = '$cod_puc'";
	$resultado_info_puc = mysqli_query($conectar, $obtener_info_puc) or die(mysqli_error($conectar));
	$info_puc = mysqli_fetch_assoc($resultado_info_puc);

	$cod_puc       = $info_puc['cod_puc'];
	$codigo_puc    = $info_puc['codigo_puc'];
	$tipo_puc      = $info_puc['tipo_puc'];

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET cod_puc = '$cod_puc', codigo_puc = '$codigo_puc', nombre_puc = '$nombre_puc', 
	tipo_puc = '$tipo_puc' WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


if ($campo == 'cod_tercero') {
	if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); } 
	if (isset($_REQUEST['valor'])) { $cod_tercero = intval($_REQUEST['valor']); } 
	$cod_movimiento_contable         = $id;

	$obtener_info_puc = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, digito_tercero 
	FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_puc = mysqli_query($conectar, $obtener_info_puc) or die(mysqli_error($conectar));
	$info_puc = mysqli_fetch_assoc($resultado_info_puc);

	$nit_cliente      = $info_puc['identificacion_tercero'];
	$nombres          = $info_puc['nombre1_tercero'];
	$apellidos        = $info_puc['apellido1_tercero'];
	$digito           = $info_puc['digito_tercero'];
	$nombres_clientes = $nombres.' '.$apellidos;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET cod_tercero = '$cod_tercero' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	
	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_tercero = '$cod_tercero', nit_cliente = '$nit_cliente', 
	nombres_clientes = '$nombres_clientes', digito = '$digito' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'nit_cliente') {
	if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); } 
	if (isset($_REQUEST['valor'])) { $cod_clientes = intval($_REQUEST['valor']); } 
	if (isset($_REQUEST['codigo_puc'])) { $nit_cliente = addslashes($_REQUEST['codigo_puc']); } 
	if (isset($_REQUEST['nombre_puc'])) { $nombres_clientes = addslashes($_REQUEST['nombre_puc']); } 
	if (isset($_REQUEST['jqui'])) { $jqui = intval($_REQUEST['jqui']); }
	$cod_movimiento_contable         = $id;

	$obtener_info_puc = "SELECT digito FROM tbl15_clientes WHERE cod_clientes = '$cod_clientes'";
	$resultado_info_puc = mysqli_query($conectar, $obtener_info_puc) or die(mysqli_error($conectar));
	$info_puc = mysqli_fetch_assoc($resultado_info_puc);

	$digito      = $info_puc['digito'];

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_clientes = '$cod_clientes', nit_cliente = '$nit_cliente', 
	nombres_clientes = '$nombres_clientes', digito = '$digito' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'motivo_modificacion') {
	$motivo_modificacion             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET motivo_modificacion = '$motivo_modificacion' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'doc_modifica') {
	$doc_modifica                    = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET doc_modifica = '$doc_modifica' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'cod_factura') {
	$cod_factura                     = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_factura = '$cod_factura' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'cod_tipo_forma_pago') {
	$cod_tipo_forma_pago             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'cod_movimiento_contable_cuenta_personal_salida') {
	$cod_movimiento_contable_cuenta_personal_salida             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_movimiento_contable_cuenta_personal_salida = '$cod_movimiento_contable_cuenta_personal_salida' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'cod_movimiento_contable_cuenta_personal_entrada') {
	$cod_movimiento_contable_cuenta_personal_entrada             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_movimiento_contable_cuenta_personal_entrada = '$cod_movimiento_contable_cuenta_personal_entrada' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'cod_dependencia') {
	$cod_dependencia             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET cod_dependencia = '$cod_dependencia' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


if ($campo == 'nombre_ccosto') {
	$nombre_ccosto             = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET nombre_ccosto = '$nombre_ccosto' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


	if ($campo == 'descripcion_tipo_forma_pago') {
	$descripcion_tipo_forma_pago     = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


if ($campo == 'fecha_factura') {
	$fecha_factura                   = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET fecha_factura = '$fecha_factura' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'descripcion_movimiento') {
	$descripcion_movimiento         = addslashes($valor_intro);
	$cod_movimiento_contable         = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET descripcion_movimiento = '$descripcion_movimiento' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


if ($campo == 'fecha_ymd') {
	$fecha_ymd                          = addslashes($valor_intro);
	$cod_movimiento_contable            = $id;
	$fecha_seg                          = strtotime($fecha_ymd);
	$fecha_anyo                         = date("Y-m-d", $fecha_seg);
	$fecha_mes                          = date("Y-m", $fecha_seg);
	$anyo                               = date("Y", $fecha_seg);

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_seg = '$fecha_seg' 
	WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_seg = '$fecha_seg' 
	WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'und_vendida[]') {
	$und_vendida                              = addslashes($valor_intro);
	$cod_movimiento_contable_concepto         = $id;

	$obtener_info_cod_nota_credit = "SELECT costo_movimiento_contable_concepto, cod_movimiento_contable 
	FROM tbl15_movimiento_contable_concepto WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_info_cod_nota_credit = mysqli_query($conectar, $obtener_info_cod_nota_credit) or die(mysqli_error($conectar));
	$info_cod_nota_credit = mysqli_fetch_assoc($resultado_info_cod_nota_credit);

	$costo_movimiento_contable_concepto      = $info_cod_nota_credit['costo_movimiento_contable_concepto'];
	$total_movimiento_contable_concepto      = $und_vendida * $costo_movimiento_contable_concepto;
	$cod_movimiento_contable                 = $info_cod_nota_credit['cod_movimiento_contable'];

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET und_vendida = '$und_vendida', total_movimiento_contable_concepto = '$total_movimiento_contable_concepto'
	WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	$obtener_info_ingre_operacional = "SELECT SUM(total_movimiento_contable_concepto) AS total_movimiento_contable 
	FROM tbl15_movimiento_contable_concepto WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
	$info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

	$total_movimiento_contable    = $info_ingre_operacional['total_movimiento_contable'];

	$agregar_total_nota_credit = "UPDATE tbl15_movimiento_contable SET total_movimiento_contable = '$total_movimiento_contable' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_total_nota_credit = mysqli_query($conectar, $agregar_total_nota_credit) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'costo_movimiento_contable[]') {
	$costo_movimiento_contable                 = addslashes($valor_intro);
	$cod_movimiento_contable_concepto          = $id;

	$obtener_info_cod_nota_credit = "SELECT und_vendida, cod_movimiento_contable FROM tbl15_movimiento_contable_concepto WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_info_cod_nota_credit = mysqli_query($conectar, $obtener_info_cod_nota_credit) or die(mysqli_error($conectar));
	$info_cod_nota_credit = mysqli_fetch_assoc($resultado_info_cod_nota_credit);

	$und_vendida                                    = $info_cod_nota_credit['und_vendida'];
	$cod_movimiento_contable                        = $info_cod_nota_credit['cod_movimiento_contable'];
	$total_costo_movimiento_contable                = $und_vendida * $costo_movimiento_contable;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET costo_movimiento_contable = '$costo_movimiento_contable', 
	total_costo_movimiento_contable = '$total_costo_movimiento_contable' WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	$obtener_info_ingre_operacional = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable 
	FROM tbl15_movimiento_contable_concepto 
	WHERE (cod_movimiento_contable = '$cod_movimiento_contable') AND (nombre_tipo_movimiento = 'DEBITOS')";
	$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
	$info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional);

	$total_costo_movimiento_contable    = $info_ingre_operacional['total_costo_movimiento_contable'];

	$agregar_total_nota_credit = "UPDATE tbl15_movimiento_contable SET total_costo_movimiento_contable = '$total_costo_movimiento_contable' 
	WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_total_nota_credit = mysqli_query($conectar, $agregar_total_nota_credit) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}

if ($campo == 'comentario[]') {
	$comentario                                     = addslashes($valor_intro);
	$cod_movimiento_contable_concepto               = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable_concepto SET comentario = '$comentario' WHERE cod_movimiento_contable_concepto = '$cod_movimiento_contable_concepto'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}


if ($campo == 'elaborada') {
	$elaborada_movimiento_contable      = addslashes($valor_intro);
	$cod_movimiento_contable            = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET elaborada_movimiento_contable = '$elaborada_movimiento_contable' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
if ($campo == 'revisada') {
	$revisada_movimiento_contable      = addslashes($valor_intro);
	$cod_movimiento_contable           = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET revisada_movimiento_contable = '$revisada_movimiento_contable' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
if ($campo == 'autorizada') {
	$autorizada_movimiento_contable      = addslashes($valor_intro);
	$cod_movimiento_contable             = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET autorizada_movimiento_contable = '$autorizada_movimiento_contable' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
if ($campo == 'contabilizada') {
	$contabilizada_movimiento_contable      = addslashes($valor_intro);
	$cod_movimiento_contable                = $id;

	$agregar_reg_pyg = "UPDATE tbl15_movimiento_contable SET contabilizada_movimiento_contable = '$contabilizada_movimiento_contable' WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

	if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>