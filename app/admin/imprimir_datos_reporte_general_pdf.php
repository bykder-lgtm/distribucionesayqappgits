<?php
include_once('mpdf/mpdf.php');
require_once('../conexiones/conexione.php'); 
require_once('../evitar_mensaje_error/error.php'); 
date_default_timezone_set("America/Bogota");

include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
      } else { header("Location:../index.php");
}
$cuenta_actual                       = addslashes($_SESSION['usuario']);
$fecha_ymd_venta_producto_ini        = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin        = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$fecha_hora                          = date("H:i:s");
$fecha                               = date("Ymd");
$hora                                = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                            = $info_empresa_data['titulo'];
$nombre_emp                            = $info_empresa_data['nombre'];
$eslogan_emp                           = $info_empresa_data['eslogan'];
$direccion_emp                         = $info_empresa_data['direccion'];
$ciudad_emp                            = $info_empresa_data['ciudad'];
$pais_emp                              = $info_empresa_data['pais'];
$correo_emp                            = $info_empresa_data['correo'];
$img_cabecera_emp                      = $info_empresa_data['img_cabecera'];
$telefono_emp                          = $info_empresa_data['telefono'];
$info_legal_emp                        = $info_empresa_data['info_legal'];
$logotipo_emp                          = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp     = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                   = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                       = $info_empresa_data['nit_empresa'];
$cabecera_emp                          = $info_empresa_data['cabecera'];
$icono_emp                             = $info_empresa_data['icono'];
$desarrollador_emp                     = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                 = $info_empresa_data['pag_desarrollador'];
$anyo_emp                              = $info_empresa_data['anyo'];
$url_pag                               = $info_empresa_data['url_pag'];
$nombre_font                           = $info_empresa_data['nombre_font'];
$res_emp                               = $info_empresa_data['res'];
$res1_emp                              = $info_empresa_data['res1'];
$res2_emp                              = $info_empresa_data['res2'];
$departamento_emp                      = $info_empresa_data['departamento'];
$localidad_emp                         = $info_empresa_data['localidad'];
$reg_medico_emp                        = $info_empresa_data['reg_medico'];
$regimen_emp                           = $info_empresa_data['regimen'];
$version_emp                           = $info_empresa_data['version'];
$propietario_url_firma_emp             = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                        = $info_empresa_data['fecha_time'];
$licencia_emp                          = $info_empresa_data['licencia'];
$tamano_font_emp                       = $info_empresa_data['tamano_font'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp               = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp               = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                  = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                  = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp              = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp              = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                  = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual         = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta              = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                         = $info_empresa_data['numero_precio'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                  = str_pad($fecha, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$margen_izq                          = '2';
$margen_der                          = '2';
$margen_inf_encabezado               = '2';
$margen_sup_encabezado               = '2';
$posicion_sup_encabezado             = '1';
$posicion_inf_encabezado             = '2';

$titulo_doc_pdf                      = $fecha;
$autor_doc_pdf                       = $fecha;
$creador_doc_pdf                     = $fecha;
$tema_doc_pdf                        = "Venta";
$palabras_claves_doc_pdf             = $fecha;
//$mpdf                              = new mPDF('c','Legal');
$mpdf                                = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$motivo                                  = 'TODOS';
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
$contado                                 = '1';
$credito                                 = '2';
$efectivo                                = '1';
$cod_servicio_propina                    = '22222222';
$cod_producto_barra                      = $cod_servicio_propina;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto, 
SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
$datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

$total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
$total_compra_producto            = $datos_total_venta['total_compra_producto'];
$total_ganancia                  = $total_suma_venta_producto - $total_compra_producto;
$total_comision_venta            = $datos_total_venta['total_comision'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo')";
$consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
$datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

$total_venta_producto_contado_efectivo    = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
$total_compra_producto_contado             = $datos_total_venta_contado_efectivo['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '1')";
$consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
$datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

$total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
$total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '2')";
$consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
$datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

$total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
$total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
$datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

$total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

$total_caja_venta_fisica         = $total_venta_producto_contado_efectivo + $total_cuenta_credito_abonado;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_producto_barra = '$cod_producto_barra')";
$consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
$datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

$total_suma_servicio_propina       = $datos_total_servicio_propina['total_suma_servicio_propina'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_egreso = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
$datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

$total_egreso                      = $datos_total_egreso['total_egreso'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$total_utilidad                    = $total_ganancia - $total_egreso;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_cliente = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente
FROM tbl15_info_factura_compra WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (nombre_estado_factura = 'CERRADA')";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($resultado_cliente);

$total_factura_compra_retefuente         = $info_cliente['total_factura_compra_retefuente'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$codigoHTML='
<!DOCTYPE html>
<html lang="es">
<head>
<title></title>
<meta charset="utf-8" />
<title>'."Venta: ".$fecha.'</title>
</head>
<body>
<style> div { width: 800px; margin:0px; text-align:center; font-size:12px; } #barras { padding:0px; } </style>
';
$codigoHTML.='
<table align="center" border="0" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:15pt;">
<tr>
<td align="center"><p style="font-size:15px"><strong>'.$cabecera_emp.'</strong></p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">'.$localidad_emp.'</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">NIT: '.$nit_empresa_emp.'</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">DIRECCION: '.$direccion_emp.'</p></td>
</tr>
</table>
<hr>
';

$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">REPORTE GENERAL DEL '.$fecha_ymd_venta_producto_ini.' AL '.$fecha_ymd_venta_producto_fin.'</th>
</tr>
</table>

<hr>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Reporte Venta</th>
</tr>
</table>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Total Venta</th>
<th style="text-align:center;">Total Venta Contado</th>
<th style="text-align:center;">Total Venta Credito</th>
<th style="text-align:center;">Total Venta Efectivo</th>
';
if ($cod_seguridad==1) {
$codigoHTML.='
<th style="text-align:center;">Total Ganancia</th>
<th style="text-align:center;">Total Utilidad</th>
';
if ($cod_estado_ptj_comision_global == '1') {
$codigoHTML.='
<th style="text-align:center;">Total Comision</th>
';
}
if ($cod_estado_propina_global == '1') {
$codigoHTML.='
<th style="text-align:center;">Total Propina</th>
';
}
}
$codigoHTML.='
</tr>
<tr>
<td style="text-align:center;">'.number_format($total_suma_venta_producto, 0, ",", ".").'</td>
<td style="text-align:center;">'.number_format($total_venta_producto_contado, 0, ",", ".").'</td>
<td style="text-align:center;">'.number_format($total_venta_producto_credito, 0, ",", ".").'</td>
<td style="text-align:center;">'.number_format($total_venta_producto_contado_efectivo, 0, ",", ".").'</td>
';
if ($cod_seguridad==1) {
$codigoHTML.='
<td style="text-align:center;">'.number_format($total_ganancia, 0, ",", ".").'</td>
<td style="text-align:center;">'.number_format($total_utilidad, 0, ",", ".").'</td>
';
if ($cod_estado_ptj_comision_global == '1') {
$codigoHTML.='
<td style="text-align:center;">'.number_format($total_comision_venta, 0, ",", ".").'</td>
';
}
if ($cod_estado_propina_global == '1') {
$codigoHTML.='
<td style="text-align:center;">'.number_format($total_suma_servicio_propina, 0, ",", ".").'</td>
';
}
}
$codigoHTML.='
</tr>
</table>
<br>
';

$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<thead>
<tr>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Cod</th>
<th style="text-align:center">Concepto</th>
<th style="text-align:center">Und</th>
<th style="text-align:center">P.Venta</th>
<th style="text-align:center">Total Venta</th>
';
if ($cod_estado_ptj_comision_global == '1') {
$codigoHTML.='
<th style="text-align:center">% Comision</th>
<th style="text-align:center">$ Comision</th>
';
}
$codigoHTML.='
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
';
if ($cod_seguridad == '1') {
$codigoHTML.='
<th style="text-align:center">Inv</th>
';
}
$codigoHTML.='
</tr>
</thead>
<tbody>
';
$sql_cliente = "SELECT cod_venta_producto, cod_producto, cod_producto_barra, cod_info_factura_venta, cod_factura, cod_historia_clinica, nombre_producto, 
und_venta, precio_costo_producto, total_compra_producto, precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_hora_venta_producto, cod_administrador,
cuenta, cod_tipo_cobrar, comision_ptj, cod_tipo_pago, cod_tipo_forma_pago, cod_dependencia, nombre_tipo_factura, cod_tercero, und_producto_inv
FROM tbl15_venta_producto
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')
ORDER BY cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_venta_producto            = $info_cliente['cod_venta_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
$cod_factura                   = $info_cliente['cod_factura'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_venta                     = $info_cliente['und_venta'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$total_venta_producto          = $info_cliente['total_venta_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
$nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$und_producto_inv              = $info_cliente['und_producto_inv'];

$total_comision                = ($total_venta_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

$sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_propietario            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido1_tercero'];

$codigoHTML.='
<tr>
<td style="text-align:center">'.$cod_factura.'</td>
<td style="text-align:left">'.$cod_producto_barra.'</td>
<td style="text-align:left">'.utf8_decode($nombre_producto).'</td>
<td style="text-align:center">'.$und_venta.'</td>
<td style="text-align:right">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
<td style="text-align:right">'.number_format($total_venta_producto, 0, ",", ".").'</td>
';
if ($cod_estado_ptj_comision_global == '1') {
$codigoHTML.='
<td style="text-align:center">'.$comision_ptj.'%' .'</td>
<td style="text-align:right">'.number_format($total_comision, 0, ",", ".").'</td>
';
}
$codigoHTML.='
<td style="text-align:center">'.$fecha_ymd_venta_producto.'</td>
<td style="text-align:center">'.$fecha_hora_venta_producto.'</td>
';
if ($cod_seguridad == '1') {
$codigoHTML.='
<td style="text-align:center">'.$und_producto_inv.'</td>
';
}
$codigoHTML.='
</tr>
';
} 
$codigoHTML.='
</tbody>
</table>
<hr>
';
//*******************************************************************************************************************************************//
//*******************************************************************************************************************************************//
$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Reporte Compra</th>
</tr>
</table>
';

$sql_compra = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente FROM tbl15_info_factura_compra 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_compra = mysqli_query($conectar, $sql_compra) or die(mysqli_error($conectar));
$datos_compra = mysqli_fetch_assoc($consulta_compra);

$total_factura_compra_retefuente      = $datos_compra['total_factura_compra_retefuente'];

$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Total Compra</th>
</tr>
<tr>
<td style="text-align:center;">'.number_format($total_factura_compra_retefuente, 0, ",", ".").'</td>
</tr>
</table>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<thead>
<tr>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Cod</th>
<th style="text-align:center">Concepto</th>
<th style="text-align:center">Proveedor</th>
<th style="text-align:center">Unidades</th>
<th style="text-align:center">P.Compra</th>
<th style="text-align:center">Total Compra</th>
<th style="text-align:center">%Iva</th>
<th style="text-align:center">Tipo Pago</th>
<th style="text-align:center">Fecha</th>
</tr>
</thead>
<tbody>
';
$sql_cliente = "SELECT cod_factura_compra_producto, cod_producto, cod_producto_barra, cod_info_factura_compra, cod_factura, cod_historia_clinica, nombre_producto, 
und_compra, precio_costo_producto, total_costo_producto, precio_compra_producto, total_compra_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, cod_administrador, iva_ptj, cod_tercero, 
cuenta, cod_tipo_cobrar, comision_ptj, cod_tipo_pago, cod_tipo_forma_pago, cod_dependencia, nombre_tipo_compra, und_producto
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')
ORDER BY cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_compra                    = $info_cliente['und_compra'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$und_producto                  = $info_cliente['und_producto'];


$total_comision                = ($total_compra_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

$sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_propietario            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido1_tercero'];

$codigoHTML.='
<tr>
<td style="text-align:center">'.$cod_factura.'</td>
<td style="text-align:left">'.$cod_producto_barra.'</td>
<td style="text-align:left">'.utf8_decode($nombre_producto).'</td>
<td style="text-align:left">'.$nombre_propietario.'</td>
<td style="text-align:center">'.$und_compra.'</td>
<td style="text-align:right">'.number_format($precio_compra_producto, 0, ",", ".").'</td>
<td style="text-align:right">'.number_format($total_compra_producto, 0, ",", ".").'</td>
<td style="text-align:center">'.$iva_ptj.'</td>
<td style="text-align:center">'.$nombre_tipo_pago.'</td>
<td style="text-align:center">'.$fecha_ymd_venta_producto.'</td>
</tr>
';
}
$codigoHTML.='
</tbody>
</table>
<hr>
';
//*******************************************************************************************************************************************//
//*******************************************************************************************************************************************//
$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Reporte Egresos</th>
</tr>
</table>
';
$sql_total_egreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
$datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

$total_egreso                            = $datos_total_egreso['costo'];

$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
    <tr>
        <th style="text-align:center">Total Egresos</th>
    </tr>
    <tr>
        <th style="text-align:center">'.number_format($total_egreso, 0, ",", ".").'</th>
    </tr>
</table>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<thead>
<tr>
<th style="text-align:center">Concepto</th>
<th style="text-align:center">Costo</th>
<th style="text-align:center">Comentario</th>
<th style="text-align:center">C.Costo</th>
<th style="text-align:center">Fecha</th>
</tr>
</thead>
<tbody>
';
$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
$nombre_ccosto                       = $info_info_factura['nombre_ccosto'];

$codigoHTML.='
<tr>
<td style="text-align:left">'.utf8_decode($conceptos).'</td>
<td style="text-align:right">'.number_format($costo, 0, ",", ".") .'</td>
<td style="text-align:left">'.$comentario.'</td>
<td style="text-align:center">'.$nombre_ccosto.'</td>
<td style="text-align:center">'.$fecha_dmy.'</td>
</tr>
';
}
$codigoHTML.='
</tbody>
</table>
<hr>
';
//*******************************************************************************************************************************************//
//*******************************************************************************************************************************************//
$codigoHTML.='
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<th style="text-align:center;">Reporte Movimientos Contables</th>
</tr>
</table>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<thead>
<tr>
<th style="text-align:center;">Tipo Movimiento Contable</th>
<th style="text-align:center;">Tercero</th>
<th style="text-align:center;">Total Movimiento</th>
<th style="text-align:center;">Forma pago</th>
<th style="text-align:center;"></th>
<th style="text-align:center;">Fecha</th>
</tr>
</thead>
<tbody>
';
$sql_mov_detalle = "SELECT * FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (nombre_estado_factura = 'CERRADA') ORDER BY fecha_ymd DESC";
$resultado_mov_detalle = mysqli_query($conectar, $sql_mov_detalle) or die(mysqli_error($conectar));
while ($info_mov_detalle = mysqli_fetch_assoc($resultado_mov_detalle)) {

$cod_movimiento_contable                 = $info_mov_detalle['cod_movimiento_contable'];
$nombre_estado_factura                   = $info_mov_detalle['nombre_estado_factura'];
$cod_factura                             = $info_mov_detalle['cod_factura'];
$doc_modifica                            = $info_mov_detalle['doc_modifica'];
$nombre_tipo_documento                   = $info_mov_detalle['nombre_tipo_documento'];
$descripcion_movimiento                  = $info_mov_detalle['descripcion_movimiento'];
$total_costo_movimiento_contable         = $info_mov_detalle['total_costo_movimiento_contable'];
$cod_tercero                             = $info_mov_detalle['cod_tercero'];
$fecha_ymd                               = $info_mov_detalle['fecha_ymd'];
$cod_guia                                = $info_mov_detalle['cod_guia'];
$cod_tipo_forma_pago                     = $info_mov_detalle['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago             = $info_mov_detalle['descripcion_tipo_forma_pago'];

$sql_tipo_pago = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$identificacion_tercero       = $datos_tipo_pago['identificacion_tercero'];
$nombre1_tercero              = $datos_tipo_pago['nombre1_tercero'];
$nombre2_tercero              = $datos_tipo_pago['nombre2_tercero'];
$apellido1_tercero            = $datos_tipo_pago['apellido1_tercero'];
$apellido2_tercero            = $datos_tipo_pago['apellido2_tercero'];
$nombre_tercero               = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];

$codigoHTML.='
<tr>
<td style="text-align:left">'.$nombre_tipo_documento.'</td>
<td style="text-align:left">'.utf8_decode($nombre_tercero).'</td>
<td style="text-align:right">'.number_format($total_costo_movimiento_contable, 0, ",", ".").'</td>
<td style="text-align:center">'.$nombre_tipo_forma_pago.'</td>
<td style="text-align:left">'.$descripcion_tipo_forma_pago.'</td>
<td style="text-align:center">'.$fecha_ymd.'</td>
</tr>
';
}
$codigoHTML.='
</tbody>
</table>

<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<thead>
<tr>
<th style="text-align:left;">Tipo Movimiento Contable</th>
<th style="text-align:left;">Total Movimiento</th>
</tr>
</thead>
<tbody>
';
$sql_cliente = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable, nombre_tipo_documento 
FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (nombre_estado_factura = 'CERRADA') GROUP BY nombre_tipo_documento DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$nombre_tipo_documento                   = $info_cliente['nombre_tipo_documento'];
$total_costo_movimiento_contable         = $info_cliente['total_costo_movimiento_contable'];

$codigoHTML.='
<tr>
<td style="text-align:left">'.$nombre_tipo_documento.'</td>
<td style="text-align:left">'.number_format($total_costo_movimiento_contable, 0, ",", ".").'</td>
</tr>
';
}
$codigoHTML.='
</tbody>
</table>
';

$codigoHTML.='
<table align="center" border="0" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:20pt;">
<tr>
<td align="center"><p style="font-size:8px"><strong>'.$desarrollador_emp.' : '.$pag_desarrollador_emp.'</strong></p></td>
</tr>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

</body>
</html>
';
//$mpdf = new mPDF('en-GB-x','A4','','',5,5,5,5,0,0);
//$mpdf = new mPDF('','', 0, '', 15, 15, 16, 16, 9, 9, 'L');
//$mpdf = new mPDF('utf-8', 'A4');
//$mpdf=new mPDF('UTF-8-s',''
//$mpdf->SetDisplayMode('fullpage','continuous');
//$mpdf->SetDisplayMode('fullpage');
$mpdf->mirrorMargins = 1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->writeHTML(utf8_encode($codigoHTML));
$mpdf->SetJS('print();');
$nombre_archivo = 'Reporte_Venta_'.$fecha;
$mpdf->output($nombre_archivo, 'I');
exit;