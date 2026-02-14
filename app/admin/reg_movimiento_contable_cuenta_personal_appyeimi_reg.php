<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_administrador                  = ($_SESSION['cod_administrador']);
$pagina_else                        = addslashes($_POST['pagina']);
if (isset($_POST['tipo_modulo']) <> '') { $tipo_modulo = addslashes($_POST['tipo_modulo']); } else { $tipo_modulo = 'NORMAL'; }
if ($tipo_modulo <> 'NORMAL') { $pag_redirect_imprimir = "../admin/lista_movimiento_contable_cuenta_personal.php"; } else { $pag_redirect_imprimir = "../admin/lista_movimiento_contable_cuenta_personal.php"; }
$pagina_redirect = '../admin/lista_movimiento_contable_cuenta_personal.php';

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_movimiento_contable_cuenta_personal_sale']) <> '') { $cod_movimiento_contable_cuenta_personal_sale = intval($_POST['cod_movimiento_contable_cuenta_personal_sale']); } else { $cod_movimiento_contable_cuenta_personal_sale = ''; }
	if (isset($_POST['cod_movimiento_contable_cuenta_personal_entra']) <> '') { $cod_movimiento_contable_cuenta_personal_entra = intval($_POST['cod_movimiento_contable_cuenta_personal_entra']); } else { $cod_movimiento_contable_cuenta_personal_entra = ''; }

	if (isset($_POST['cod_concepto_movimiento_caja']) <> '') { $cod_concepto_movimiento_caja = intval($_POST['cod_concepto_movimiento_caja']); } else { $cod_concepto_movimiento_caja = ''; }
	if (isset($_POST['costo']) <> '') { $costo = mysqli_real_escape_string($conectar, ($_POST['costo'])); } else { $costo = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['comentario']) <> '') { $comentario = mysqli_real_escape_string($conectar, ($_POST['comentario'])); } else { $comentario = ''; }
	if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
	if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
	if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
	if (isset($_POST['nombre_ccosto']) <> '') { $nombre_ccosto = mysqli_real_escape_string($conectar, ($_POST['nombre_ccosto'])); } else { $nombre_ccosto = ''; }
	if (isset($_POST['fecha_dmy']) <> '') { $fecha_dmy = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy'])); } else { $fecha_dmy = ''; }
	if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = mysqli_real_escape_string($conectar, ($_POST['cod_tipo_forma_pago'])); } else { $cod_tipo_forma_pago = ''; }
	if (isset($_POST['cod_cuentas_pagar']) <> '') { $cod_cuentas_pagar = intval($_POST['cod_cuentas_pagar']); } else { $cod_cuentas_pagar = '0'; }
	if (isset($_POST['nombre_cuenta_pagar']) <> '') { $nombre_cuenta_pagar = mysqli_real_escape_string($conectar, ($_POST['nombre_cuenta_pagar'])); } else { $nombre_cuenta_pagar = ''; }
	if (isset($_POST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	//-------------------------------------- -----------------------------------------------------------------//
	if (($nombre_cuenta_pagar <> '') && ($cod_cuentas_pagar <> '0')) { $nombre_tipo_cuenta_cobrar_pagar = 'CUENTA_PAGAR'; } else { $nombre_tipo_cuenta_cobrar_pagar    = ''; }
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_info_factura = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
	$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

	$nombre_concepto_movimiento_caja       = $info_info_factura['nombre_concepto_movimiento_caja'];
	$nombre_tipo_puc                       = $info_info_factura['nombre_tipo_puc'];
	$simbolo_tipo_operacion                = $info_info_factura['simbolo_tipo_operacion'];
	$tipo_puc                              = $nombre_tipo_puc;
	$nombre_puc                            = $nombre_concepto_movimiento_caja;

	$fecha_time     	                   = time();
	$fecha_mes_ym	                       = date("Y-m", strtotime($fecha_dmy));
	$anyo		                           = date("Y", strtotime($fecha_dmy));
	$hora	                               = date("H:i:s");
	$cuenta                                = $cuenta_actual;
	$und_vendida                           = 1;
	$costo_movimiento_contable             = $costo;
	$total_costo_movimiento_contable       = $costo;

	$fecha_anyo                            = $fecha_dmy;
	$fecha_mes                             = date("Y-m", strtotime($fecha_dmy));
	$fecha_seg                             = time();
	$fecha_ymd                             = $fecha_dmy;
	$anyo                                  = date("Y", strtotime($fecha_dmy));
	$ip                                    = $_SERVER["REMOTE_ADDR"];
	$fecha_ymd_movimiento_caja             = $fecha_dmy;
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_contable_cuenta_personal_sale = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal_sale, nombre_puc FROM tbl15_movimiento_contable_cuenta_personal 
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_sale')";
	$resultado_movimiento_contable_cuenta_personal_sale = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_sale);
	$info_movimiento_contable_cuenta_personal_sale = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal_sale);

	$total_saldo_movimiento_contable_cuenta_personal_sale   = $info_movimiento_contable_cuenta_personal_sale['total_saldo_movimiento_contable_cuenta_personal_sale'];
	$total_saldo_sale                                       = $total_saldo_movimiento_contable_cuenta_personal_sale;
	$saldo_actual_puc_sale                                  = $costo;
	$subtotal_puc_sale                                      = $total_saldo_movimiento_contable_cuenta_personal_sale;
	$nombre_puc_sale_db                                     = $info_movimiento_contable_cuenta_personal_sale['nombre_puc'];
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_contable_cuenta_personal_entra = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal_entra, nombre_puc FROM tbl15_movimiento_contable_cuenta_personal 
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_entra')";
	$resultado_movimiento_contable_cuenta_personal_entra = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_entra);
	$info_movimiento_contable_cuenta_personal_entra = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal_entra);

	$total_saldo_movimiento_contable_cuenta_personal_entra   = $info_movimiento_contable_cuenta_personal_entra['total_saldo_movimiento_contable_cuenta_personal_entra'];
	$total_saldo_entra                                       = $total_saldo_movimiento_contable_cuenta_personal_entra;
	$saldo_actual_puc_entra                                  = $costo;
	$subtotal_puc_entra                                      = $total_saldo_movimiento_contable_cuenta_personal_entra;
	$nombre_puc_entra_db                                     = $info_movimiento_contable_cuenta_personal_entra['nombre_puc'];
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_egreso'";
	$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
	$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);
	$cod_egreso                                            = $datos_autoincremento_egresos['AUTO_INCREMENT'];
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_obtener_guia = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable_cuenta_personal_concepto";
	$resultado_obtener_guia = mysqli_query($conectar, $sql_obtener_guia);
	$info_obtener_guia = mysqli_fetch_assoc($resultado_obtener_guia);

	$cod_guia                                              = $info_obtener_guia['cod_guia'] + 1;
	//-------------------------------------- -----------------------------------------------------------------//
	$total_saldo_final_sale                    = $total_saldo_sale - $costo;
	$total_saldo_final_entra                   = $total_saldo_entra + $costo;
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql_sale = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final_sale', saldo_actual_puc = '$saldo_actual_puc_sale', subtotal_puc = '$subtotal_puc_sale'
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_sale')";
	$resultado_sale = mysqli_query($conectar, $actualizar_sql_sale) or die(mysqli_error($conectar));

	$actualizar_sql_entra = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final_entra', saldo_actual_puc = '$saldo_actual_puc_entra', subtotal_puc = '$subtotal_puc_entra'
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_entra')";
	$resultado_entra = mysqli_query($conectar, $actualizar_sql_entra) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_movimiento_contable_cuenta_personal_concepto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable_cuenta_personal_concepto'";
	$exec_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_autoincremento_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
	$datos_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($exec_autoincremento_movimiento_contable_cuenta_personal_concepto);

	$cod_movimiento_contable_cuenta_personal_concepto        = $datos_autoincremento_movimiento_contable_cuenta_personal_concepto['AUTO_INCREMENT'];
	//-------------------------------------- -----------------------------------------------------------------//
	$nombre_puc_entra = "SALE DE ".$nombre_puc_sale_db." Y ENTRA A ".$nombre_puc_entra_db;
	$nombre_puc_sale = "ENTRA A ".$nombre_puc_entra_db." Y SALE DE ".$nombre_puc_sale_db;

	$tipo_puc                              = 'INGRESOS';
	$simbolo_tipo_operacion                = '+';
	$nombre_tipo_documento                 = 'RECIBO DE CAJA';
	$nombre_tipo_movimiento                = 'DEBITOS';


	$agreg_mov_credito_reg_sale = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
	nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
	cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_egreso, cod_tipo_pago, cod_guia)
	VALUES ('$cod_movimiento_contable_cuenta_personal_entra', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
	'$nombre_puc_entra', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
	'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal_entra', '$cod_egreso', '$cod_tipo_pago', '$cod_guia')";
	$resultado_mov_credito_sale = mysqli_query($conectar, $agreg_mov_credito_reg_sale) or die(mysqli_error($conectar));

	$tipo_puc                              = 'EGRESOS';
	$simbolo_tipo_operacion                = '-';
	$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
	$nombre_tipo_movimiento                = 'DEBITOS';

	$agreg_mov_credito_reg_sale = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
	nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
	cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_egreso, cod_tipo_pago, cod_guia)
	VALUES ('$cod_movimiento_contable_cuenta_personal_sale', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
	'$nombre_puc_sale', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
	'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal_sale', '$cod_egreso', '$cod_tipo_pago', '$cod_guia')";
	$resultado_mov_credito_sale = mysqli_query($conectar, $agreg_mov_credito_reg_sale) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/opcion_imprimir_movimiento_contable_cuenta_personal.php?cod_movimiento_contable_cuenta_personal_concepto=<?php echo $cod_movimiento_contable_cuenta_personal_concepto ?>&pagina_redirect=<?php echo $pagina_redirect ?>&pagina=<?php echo $pagina_else ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>