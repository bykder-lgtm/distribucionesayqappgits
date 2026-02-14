<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_campo_undidades_inv1                                = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_tipo_sistema_numeracion                                = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_tipo_sistema_numeracion_und_compra                     = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                      = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                  = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                   = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra               = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra            = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta             = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
$nombre                                                     = $info_empresa_data['nombre'];
$nombre_info_empresa                                        = str_replace(" ", "_", $nombre);
//-----------------------------------------------------------------------------------------------------//
if (isset($_GET['fecha_dmy_ini'])) {

$fecha_dmy_ini                                              = addslashes($_GET['fecha_dmy_ini']);
$fecha_dmy_fin                                              = addslashes($_GET['fecha_dmy_fin']);
$time_seg                                                   = time();
$time_date_ymd                                              = strtotime(date("Y/m/d"));
$hora                                                       = date("His");
$fecha_venta_ymd                                            = date("Ymd");
$hora_venta_his                                             = date("His");
$fecha                                                      = date("Ymd");
$hora                                                       = date("His");
$salida                                                     = "";
$nombre_archivo                                             = 'MOVIMIENTO_CAJA_'.$nombre_info_empresa.'_DE_'.$fecha_dmy_ini.'_A_'.$fecha_dmy_fin.'_'.$time_seg.'.csv';
$observacion                                                = "";
$nombre_filtro                                              = '(fecha_dmy BETWEEN '.$fecha_dmy_ini.' AND '.$fecha_dmy_fin.')';

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre_archivo" );

$salida .='ID'.';';
$salida .='conceptos'.';';
$salida .='costo'.';';
$salida .='comentario'.';';
$salida .='cod_concepto_movimiento_caja'.';';
$salida .='nombre_concepto_movimiento_caja'.';';
$salida .='cod_tipo_puc'.';';
$salida .='nombre_tipo_puc'.';';
$salida .='simbolo_tipo_operacion'.';';
$salida .='cod_tipo_forma_pago'.';';
$salida .='total_compra_producto'.';';
$salida .='total_venta_producto'.';';
$salida .='total_saldo'.';';
$salida .='fecha_ymd_movimiento_caja'.';';
$salida .='nombre_ccosto'.';';
$salida .='fecha_time'.';';
$salida .='fecha_dmy'.';';
$salida .='fecha_mes_ym'.';';
$salida .='anyo'.';';
$salida .='hora'.';';
$salida .='ip'.';';
$salida .='cod_tercero'.';';
$salida .='codigo_puc'.';';
$salida .='nombre_puc'.';';
$salida .='tipo_puc'.';';
$salida .='cod_dependencia'.';';
$salida .='cuenta'.';';
$salida .='nombre_tipo_cuenta_cobrar_pagar'.';';
$salida .='cod_cuentas_pagar'.';';
$salida .='nombre_cuenta_pagar'.';';
$salida .='nombre_filtro'.';';
$salida .='nombre_info_empresa'.'';
$salida .="\n";

$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$cod_concepto_movimiento_caja        = $info_info_factura['cod_concepto_movimiento_caja'];
$cod_tipo_forma_pago                 = $info_info_factura['cod_tipo_forma_pago'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
$nombre_ccosto                       = $info_info_factura['nombre_ccosto'];
$cod_tipo_puc                        = $info_info_factura['cod_tipo_puc'];
$cod_tipo_forma_pago                 = $info_info_factura['cod_tipo_forma_pago'];
$total_compra_producto               = $info_info_factura['total_compra_producto'];
$total_venta_producto                = $info_info_factura['total_venta_producto'];
$total_saldo                         = $info_info_factura['total_saldo'];
$fecha_ymd_movimiento_caja           = $info_info_factura['fecha_ymd_movimiento_caja'];
$fecha_time                          = $info_info_factura['fecha_time'];
$fecha_mes_ym                        = $info_info_factura['fecha_mes_ym'];
$anyo                                = $info_info_factura['anyo'];
$hora                                = $info_info_factura['hora'];
$ip                                  = $info_info_factura['ip'];
$cod_tercero                         = $info_info_factura['cod_tercero'];
$codigo_puc                          = $info_info_factura['codigo_puc'];
$nombre_puc                          = $info_info_factura['nombre_puc'];
$tipo_puc                            = $info_info_factura['tipo_puc'];
$cod_dependencia                     = $info_info_factura['cod_dependencia'];
$cuenta                              = $info_info_factura['cuenta'];
$nombre_tipo_cuenta_cobrar_pagar     = $info_info_factura['nombre_tipo_cuenta_cobrar_pagar'];
$cod_cuentas_pagar                   = $info_info_factura['cod_cuentas_pagar'];
$nombre_cuenta_pagar                 = $info_info_factura['nombre_cuenta_pagar'];

$sql_concepto_movimiento_caja = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
$resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
$info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);
    
$nombre_concepto_movimiento_caja      = $info_concepto_movimiento_caja['nombre_concepto_movimiento_caja'];
$nombre_tipo_puc                      = $info_concepto_movimiento_caja['nombre_tipo_puc'];
$simbolo_tipo_operacion               = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];

$salida .=''.$cod_egreso.';';
$salida .=''.$conceptos.';';
$salida .=''.$costo.';';
$salida .=''.$comentario.';';
$salida .=''.$cod_concepto_movimiento_caja.';';
$salida .=''.$nombre_concepto_movimiento_caja.';';
$salida .=''.$cod_tipo_puc.';';
$salida .=''.$nombre_tipo_puc.';';
$salida .=''.$simbolo_tipo_operacion.';';
$salida .=''.$cod_tipo_forma_pago.';';
$salida .=''.$total_compra_producto.';';
$salida .=''.$total_venta_producto.';';
$salida .=''.$total_saldo.';';
$salida .=''.$fecha_ymd_movimiento_caja.';';
$salida .=''.$nombre_ccosto.';';
$salida .=''.$fecha_time.';';
$salida .=''.$fecha_dmy.';';
$salida .=''.$fecha_mes_ym.';';
$salida .=''.$anyo.';';
$salida .=''.$hora.';';
$salida .=''.$ip.';';
$salida .=''.$cod_tercero.';';
$salida .=''.$codigo_puc.';';
$salida .=''.$nombre_puc.';';
$salida .=''.$tipo_puc.';';
$salida .=''.$cod_dependencia.';';
$salida .=''.$cuenta.';';
$salida .=''.$nombre_tipo_cuenta_cobrar_pagar.';';
$salida .=''.$cod_cuentas_pagar.';';
$salida .=''.$nombre_cuenta_pagar.';';
$salida .=''.$nombre_filtro.';';
$salida .=''.$nombre_info_empresa.'';
$salida .="\n"; 	
}
echo $salida;
}
?>

