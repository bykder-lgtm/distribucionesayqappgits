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
$cod_administrador                   = intval($_GET['cod_administrador']);
$cod_tercero                         = intval($_GET['cod_tercero']);
$cod_tipo_pago                       = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                 = intval($_GET['cod_tipo_forma_pago']);

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
if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
$filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
}
if ($cod_tipo_pago==0) {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
} else {
$filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
$filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
}
if ($cod_tipo_forma_pago==0) {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
} else {
$filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_costo_producto) AS total_costo_producto, 
SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
$datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

$total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
$total_costo_producto            = $datos_total_venta['total_costo_producto'];
$total_ganancia                  = $total_suma_venta_producto - $total_costo_producto;
$total_comision_venta            = $datos_total_venta['total_comision'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_costo_producto) AS total_costo_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$contado') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
$datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

$total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
$total_costo_producto_contado    = $datos_total_venta_contado['total_costo_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_costo_producto) AS total_costo_producto 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$credito') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
$datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

$total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
$total_costo_producto_credito    = $datos_total_venta_credito['total_costo_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
$datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

$total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

$total_caja_venta_fisica         = $total_venta_producto_contado + $total_cuenta_credito_abonado;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_producto_barra = '$cod_producto_barra') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
$datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

$total_suma_servicio_propina       = $datos_total_servicio_propina['total_suma_servicio_propina'];
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
<td align="center"><p style="font-size:12px">NIT: '.$nit_emp.'</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">DIRECCION: '.$direccion_emp.'</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">RESUMEN INFORME FISCAL DE VENTAS DIARIAS</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">DEL '.$fecha_ymd_venta_producto_ini.' AL '.$fecha_ymd_venta_producto_fin.'</p></td>
</tr>
<tr>
<td align="center"><p style="font-size:12px">RESOLUCION P.O.S</p></td>
</tr>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<table align="center" border="0" width="95%" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td align="center" style="font-size:12px;">Porcentaje Iva</td>
    <td align="center" style="font-size:12px;">Valor Base</td>
    <td align="center" style="font-size:12px;">Valor Iva</td>
    <td align="center" style="font-size:12px;">Valor Total</td>
  </tr>
';
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$total_valor_base                     = 0;
$total_valor_iva                      = 0;
$total_valor_total                    = 0;
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (precio_ipc <> '0') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

$total_venta_impoconsumo              = 0;
$total_base_impoconsumo               = 0;
$total_impoconsumo                    = $datos_total_tipos_iva_ipc['total_impoconsumo'];
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT  cod_tipo_iva, nombre_tipo_iva, descripcion_tipo_iva, iva, nombre_estado FROM tbl15_tipo_iva WHERE nombre_estado = 'ACTIVO' ORDER BY iva ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$iva_ptj                                 = $datos['iva'];

$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (iva_ptj = '$iva_ptj') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago";
$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

$total_venta                         = $datos_total_tipos_iva['total_venta'];
$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
$total_iva                           = $datos_total_tipos_iva['total_iva'];

$total_valor_base                    += $total_base_iva;
$total_valor_iva                     += $total_iva;
$total_valor_total                   += $total_venta;

if ($iva_ptj == '0') { $operacion = 'No'; } else { $operacion = ''; }
$codigoHTML.='
  <tr>
    <td align="left" style="font-size:12px;">Ingresos Por Operac. '.$operacion.' Gravadas: '.$iva.'%</td>
    <td align="right" style="font-size:12px;">'.number_format($total_base_iva, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_iva, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_venta, 0, ",", ".").'</td>
  </tr>
';
}
$codigoHTML.='
  <tr>
    <td align="left" style="font-size:12px;">Impuesto al Consumo</td>
    <td align="right" style="font-size:12px;">'.number_format($total_compra_impoconsumo, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_base_impoconsumo, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_impoconsumo, 0, ",", ".").'</td>
  </tr>
  <tr>
    <td align="right" style="font-size:12px;"></td>
    <td align="right" style="font-size:12px;">'.number_format($total_valor_base + $total_compra_impoconsumo, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_valor_iva + $total_base_impoconsumo, 0, ",", ".").'</td>
    <td align="right" style="font-size:12px;">'.number_format($total_valor_total + $total_impoconsumo, 0, ",", ".").'</td>
  </tr>
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
?>