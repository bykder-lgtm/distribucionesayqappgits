<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                                  = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                               = $_SESSION['usuario'];
$cod_administrador                                              = ($_SESSION['cod_administrador']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_info_factura_venta'])) {
    $cod_info_factura_venta                                     = intval($_GET['cod_info_factura_venta']);
    $pagina                                                     = intval($_GET['pagina']);

    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $existe_info_factura_venta = mysqli_num_rows($consulta_info_factura_venta);
    $info_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_tienda                                                    = $info_info_factura_venta['cod_tienda'];

	$fecha_creacion                                                 = date("Y-m-d H:i:s");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_administrador = "SELECT cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico, cod_tienda FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$resultado_administrador = mysqli_query($conectar, $obtener_administrador) or die(mysqli_error($conectar));
	$info_administrador = mysqli_fetch_assoc($resultado_administrador);

	$cod_lider                                                      = $info_administrador['cod_lider'];
	$cod_coordinador                                                = $info_administrador['cod_coordinador'];
	$cod_asesor                                                     = $info_administrador['cod_asesor'];
	$cod_aliado_estrategico                                         = $cod_administrador;
	$cod_tienda                                                     = $info_administrador['cod_tienda'];

	$cod_administrador_lider                                        = $cod_lider;
	$cod_administrador_coordinador                                  = $cod_coordinador;
	$cod_administrador_asesor                                       = $cod_asesor;
	$cod_administrador_aliado_estrategico                           = $cod_aliado_estrategico;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_lider = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_lider'";
	$resultado_lider = mysqli_query($conectar, $obtener_lider) or die(mysqli_error($conectar));
	$info_lider = mysqli_fetch_assoc($resultado_lider);

	$lider_comision_ptj                                             = $info_lider['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_coordinador = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_coordinador'";
	$resultado_coordinador = mysqli_query($conectar, $obtener_coordinador) or die(mysqli_error($conectar));
	$info_coordinador = mysqli_fetch_assoc($resultado_coordinador);

	$coordinador_comision_ptj                                       = $info_coordinador['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_asesor = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_asesor'";
	$resultado_asesor = mysqli_query($conectar, $obtener_asesor) or die(mysqli_error($conectar));
	$info_asesor = mysqli_fetch_assoc($resultado_asesor);

	$asesor_comision_ptj                                            = $info_asesor['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_tipo_cobro = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_tipo_cobro = '$cod_tipo_cobro')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $nombre_tipo_cobro                                              = $datos_tipo_cobro['nombre_tipo_cobro'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_tercero = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_dato_tercero = mysqli_query($conectar, $sql_dato_tercero) or die(mysqli_error($conectar));
	$info_dato_tercero = mysqli_fetch_assoc($consultar_dato_tercero);
	$existe_dato_tercero = mysqli_num_rows(@$consultar_dato_tercero);

	$cod_tercero                                                    = intval($info_dato_tercero['cod_tercero']);
   	$cod_tercero_codif                                              = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
	$cod_tercero_codifcryp                                          = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                                           = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                                           = $datos_meses_credito['nombre_meses_credito'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                                 = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_comision_ptj_factura_venta (cod_info_factura_venta, cod_lider, lider_comision_ptj, cod_coordinador, coordinador_comision_ptj, cod_asesor, asesor_comision_ptj, 
	cod_aliado_estrategico, cod_revisor, fecha_creaccion) 
	VALUES ('$cod_info_factura_venta', '$cod_lider', '$lider_comision_ptj', '$cod_coordinador', '$coordinador_comision_ptj', '$cod_asesor', '$asesor_comision_ptj', 
	'$cod_aliado_estrategico', '$cod_revisor', '$fecha_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	//---------------------------------------------------------------------------------------------------------------------------------//
	$url_redir = $pagina_redirect."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_entidad_crediticia=".$cod_entidad_crediticia."&cod_tercero_codifcryp=".$cod_tercero_codifcryp."&pagina=".$pagina;
	header("Location: $url_redir");
}
?>