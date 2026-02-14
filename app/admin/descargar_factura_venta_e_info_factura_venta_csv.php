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

$fecha              = date("Y/m/d");
$hora               = date("H:i:s");
$salida             = "";

if (isset($_GET['cod_info_impuesto_facturas'])) {

	$cod_factura                 = intval($_GET['cod_factura']);
	$cod_info_impuesto_facturas  = intval($_GET['cod_info_impuesto_facturas']);
	$nombre_tipo_factura         = addslashes($_GET['nombre_tipo_factura']);
	$nombre                      = "FACTURA_INTERNA_".$cod_factura_electronica.'_INTERNA_'.$cod_factura.'_'.$fecha.'_Hora_'.$hora.'.csv';

	header("Content-type: application/vnd.ms-excel" ) ;
	header("Content-Disposition: attachment; filename=$nombre" );

	$salida .='cod_info_impuesto_facturas'.',';
	$salida .='flete'.',';
	$salida .='cod_factura'.',';
	$salida .='cod_clientes'.',';
	$salida .='total_compra'.',';
	$salida .='total_venta'.',';
	$salida .='subtotal_base'.',';
	$salida .='total_iva'.',';
	$salida .='total_descuento'.',';
	$salida .='vlr_cancelado'.',';
	$salida .='vlr_vuelto'.',';
	$salida .='vendedor'.',';
	$salida .='estado'.',';
	$salida .='fecha_dia'.',';
	$salida .='fecha_mes'.',';
	$salida .='fecha_anyo'.',';
	$salida .='anyo'.',';
	$salida .='fecha_hora'.',';
	$salida .='tipo_pago'.',';
	$salida .='fecha_remision'.',';
	$salida .='garantia_meses'.',';
	$salida .='observacion'.',';
	$salida .='bolsa'.',';
	$salida .='tiempo_ejecucion'.',';
	$salida .='cod_tipo_forma_pago'.',';
	$salida .='nombre_tipo_forma_pago'.',';
	$salida .='descripcion_tipo_forma_pago'.',';
	$salida .='servicio'.',';
	$salida .='nombre_tipo_factura'.',';
	$salida .='nombre_tipo_moneda'.',';
	$salida .='cod_factura_electronica'.',';
	$salida .='cod_tercero'.',';
	$salida .='nombre_maquina'.',';
	$salida .='cod_resolucion_facturacion'.',';
	$salida .='total_datos_data'.',';

	$salida .='cod_ventas'.',';
	$salida .='cod_productos'.',';
	$salida .='cod_proveedores'.',';
	$salida .='cod_marcas'.',';
	$salida .='nombre_productos'.',';
	$salida .='unidades_vendidas'.',';
	$salida .='und_vend_orig'.',';
	$salida .='devoluciones'.',';
	$salida .='precio_compra'.',';
	$salida .='precio_costo'.',';
	$salida .='precio_venta'.',';
	$salida .='vlr_total_venta'.',';
	$salida .='vlr_total_compra'.',';
	$salida .='comentario'.',';
	$salida .='tipo_venta'.',';
	$salida .='iva'.',';
	$salida .='iva_v'.',';
	$salida .='detalles'.',';
	$salida .='nombre_lineas'.',';
	$salida .='nombre_ccosto'.',';
	$salida .='cod_base_caja'.',';
	$salida .='descuento'.',';
	$salida .='descuento_ptj'.',';
	$salida .='precio_compra_con_descuento'.',';
	$salida .='porcentaje_vendedor'.',';
	$salida .='nombre_peso'.',';
	$salida .='cuenta'.',';
	$salida .='ip'.',';
	$salida .='fecha_devolucion'.',';
	$salida .='hora_devolucion'.',';
	$salida .='fecha_orig'.',';
	$salida .='fecha'.',';
	$salida .='cod_uniq_credito'.',';
	$salida .='unidades_faltantes_inv'.',';
	$salida .='fecha_pago'.',';
	$salida .='cod_dependencia'.',';
	$salida .='promo'.',';
	$salida .='und_min_precio_venta_desc'.',';
	$salida .='chk'.',';
	$salida .='fecha_ymdhis_seg'.',';
	$salida .='cod_factura_dian'.',';
	$salida .='envio_dian'.',';
	$salida .='envio_dian_fecha_ymdhis'.',';
	$salida .='envio_dian_usuario'.',';
	$salida .='estado_temp_dian'.',';
	$salida .='precio_servicio'.',';
	$salida .='precio_compra_viejo'.',';
	$salida .='precio_costo_viejo'.',';
	$salida .='chk2'.',';
	$salida .='cod_info_impuesto_facturas_electronica'.',';
	$salida .='cod_cierre_caja'.',';
	$salida .='fecha_cierre_caja'.',';
	$salida .='hora_cierre_caja'.',';
	$salida .='fecha_time_cierre_caja'.',';
	$salida .='nombre_marcas'.',';
	$salida .='nombre_tipo_producto'.',';
	$salida .='nombre_tipo_referencia'.',';
	$salida .='nombre_tipo_unidad_medida'.',';
	$salida .='nombre_clase_producto'.',';
	$salida .='ptj_imp_consumo'.',';
	$salida .='ptj_ret_iva'.',';
	$salida .='ptj_ret_ica'.',';
	$salida .='ptj_ret_fuente'.',';
	$salida .='ptj_ipc'.',';
	$salida .='precio_ipc_total'.',';
	$salida .='precio_ipc'.',';
	$salida .='nombre_tipo_compra'.',';
	$salida .='fecha_creacion'.',';
	$salida .='fecha_modificacion'.'';
	$salida .="\n";

	$sql = "SELECT info_impuesto_facturas.cod_info_impuesto_facturas, info_impuesto_facturas.flete, info_impuesto_facturas.cod_factura, 
	info_impuesto_facturas.cod_clientes, info_impuesto_facturas.total_compra, info_impuesto_facturas.total_venta, 
	info_impuesto_facturas.subtotal_base, info_impuesto_facturas.total_iva, info_impuesto_facturas.total_descuento, 
	info_impuesto_facturas.vlr_cancelado, info_impuesto_facturas.vlr_vuelto, info_impuesto_facturas.vendedor, 
	info_impuesto_facturas.estado, info_impuesto_facturas.fecha_dia, info_impuesto_facturas.fecha_mes, 
	info_impuesto_facturas.fecha_anyo, info_impuesto_facturas.anyo, info_impuesto_facturas.fecha_hora, 
	info_impuesto_facturas.tipo_pago, info_impuesto_facturas.fecha_remision, info_impuesto_facturas.garantia_meses, 
	info_impuesto_facturas.observacion, info_impuesto_facturas.bolsa, info_impuesto_facturas.tiempo_ejecucion, 
	info_impuesto_facturas.cod_tipo_forma_pago, info_impuesto_facturas.nombre_tipo_forma_pago, 
	info_impuesto_facturas.descripcion_tipo_forma_pago, info_impuesto_facturas.servicio, 
	info_impuesto_facturas.nombre_tipo_factura, info_impuesto_facturas.nombre_tipo_moneda, 
	info_impuesto_facturas.cod_factura_electronica, info_impuesto_facturas.cod_tercero, 
	info_impuesto_facturas.nombre_maquina, info_impuesto_facturas.cod_resolucion_facturacion, info_impuesto_facturas.total_datos_data, 
	ventas.cod_ventas, ventas.cod_productos, ventas.cod_proveedores, ventas.cod_marcas, ventas.nombre_productos, ventas.unidades_vendidas, 
	ventas.und_vend_orig, ventas.devoluciones, ventas.precio_compra, ventas.precio_costo, ventas.precio_venta, ventas.vlr_total_venta,
	ventas.vlr_total_compra, ventas.comentario, ventas.tipo_venta, ventas.iva, ventas.iva_v, ventas.detalles,
	ventas.nombre_lineas, ventas.nombre_ccosto, ventas.cod_base_caja, ventas.descuento, ventas.descuento_ptj, ventas.precio_compra_con_descuento,
	ventas.porcentaje_vendedor, ventas.nombre_peso, ventas.cuenta, ventas.ip, ventas.fecha_devolucion, ventas.hora_devolucion,
	ventas.fecha_orig, ventas.fecha, ventas.cod_uniq_credito, ventas.unidades_faltantes_inv, ventas.fecha_pago, ventas.cod_dependencia,
	ventas.promo, ventas.und_min_precio_venta_desc, ventas.chk, ventas.fecha_ymdhis_seg, ventas.cod_factura_dian, ventas.envio_dian,
	ventas.envio_dian_fecha_ymdhis, ventas.envio_dian_usuario, ventas.estado_temp_dian, ventas.precio_servicio, ventas.precio_compra_viejo, ventas.precio_costo_viejo,
	ventas.chk2, ventas.cod_info_impuesto_facturas_electronica, ventas.cod_cierre_caja, ventas.fecha_cierre_caja, ventas.hora_cierre_caja, 
	ventas.fecha_time_cierre_caja,ventas.nombre_marcas, ventas.nombre_tipo_producto, ventas.nombre_tipo_referencia, ventas.nombre_tipo_unidad_medida, 
	ventas.nombre_clase_producto, ventas.ptj_imp_consumo, ventas.ptj_ret_iva, ventas.ptj_ret_ica, ventas.ptj_ret_fuente, ventas.ptj_ipc, 
	ventas.precio_ipc_total, ventas.precio_ipc, ventas.nombre_tipo_compra, ventas.fecha_creacion, ventas.fecha_modificacion
	FROM ventas LEFT JOIN info_impuesto_facturas ON ventas.cod_factura = info_impuesto_facturas.cod_factura 
	WHERE (info_impuesto_facturas.cod_info_impuesto_facturas = '$cod_info_impuesto_facturas')";
	$consulta = mysql_query($sql, $conectar) or die(mysql_error());
	while ($datos = mysql_fetch_assoc($consulta)) {

		$cod_info_impuesto_facturas                    = $datos['cod_info_impuesto_facturas'];
		$flete                                         = $datos['flete'];
		$cod_factura                                   = $datos['cod_factura'];
		$cod_clientes                                  = $datos['cod_clientes'];
		$total_compra                                  = $datos['total_compra'];
		$total_venta                                   = $datos['total_venta'];
		$subtotal_base                                 = $datos['subtotal_base'];
		$total_iva                                     = $datos['total_iva'];
		$total_descuento                               = $datos['total_descuento'];
		$vlr_cancelado                                 = $datos['vlr_cancelado'];
		$vlr_vuelto                                    = $datos['vlr_vuelto'];
		$vendedor                                      = $datos['vendedor'];
		$estado                                        = $datos['estado'];
		$fecha_dia                                     = $datos['fecha_dia'];
		$fecha_mes                                     = $datos['fecha_mes'];
		$fecha_anyo                                    = $datos['fecha_anyo'];
		$anyo                                          = $datos['anyo'];
		$fecha_hora                                    = $datos['fecha_hora'];
		$tipo_pago                                     = $datos['tipo_pago'];
		$fecha_remision                                = $datos['fecha_remision'];
		$garantia_meses                                = $datos['garantia_meses'];
		$observacion                                   = $datos['observacion'];
		$bolsa                                         = $datos['bolsa'];
		$tiempo_ejecucion                              = $datos['tiempo_ejecucion'];
		$cod_tipo_forma_pago                           = $datos['cod_tipo_forma_pago'];
		$nombre_tipo_forma_pago                        = $datos['nombre_tipo_forma_pago'];
		$descripcion_tipo_forma_pago                   = $datos['descripcion_tipo_forma_pago'];
		$servicio                                      = $datos['servicio'];
		$nombre_tipo_factura                           = $datos['nombre_tipo_factura'];
		$nombre_tipo_moneda                            = $datos['nombre_tipo_moneda'];
		$cod_factura_electronica                       = $datos['cod_factura_electronica'];
		$cod_tercero                                   = $datos['cod_tercero'];
		$nombre_maquina                                = $datos['nombre_maquina'];
		$cod_resolucion_facturacion                    = $datos['cod_resolucion_facturacion'];
		$total_datos_data                              = $datos['total_datos_data'];

		$cod_ventas                                    = $datos['cod_ventas'];
		$cod_productos                                 = $datos['cod_productos'];
		$cod_proveedores                               = $datos['cod_proveedores'];
		$cod_marcas                                    = $datos['cod_marcas'];
		$nombre_productos                              = $datos['nombre_productos'];
		$unidades_vendidas                             = $datos['unidades_vendidas'];
		$und_vend_orig                                 = $datos['und_vend_orig'];
		$devoluciones                                  = $datos['devoluciones'];
		$precio_compra                                 = $datos['precio_compra'];
		$precio_costo                                  = $datos['precio_costo'];
		$precio_venta                                  = $datos['precio_venta'];
		$vlr_total_venta                               = $datos['vlr_total_venta'];
		$vlr_total_compra                              = $datos['vlr_total_compra'];
		$comentario                                    = $datos['comentario'];
		$tipo_venta                                    = $datos['tipo_venta'];
		$iva                                           = $datos['iva'];
		$iva_v                                         = $datos['iva_v'];
		$detalles                                      = $datos['detalles'];
		$nombre_lineas                                 = $datos['nombre_lineas'];
		$nombre_ccosto                                 = $datos['nombre_ccosto'];
		$cod_base_caja                                 = $datos['cod_base_caja'];
		$descuento                                     = $datos['descuento'];
		$descuento_ptj                                 = $datos['descuento_ptj'];
		$precio_compra_con_descuento                   = $datos['precio_compra_con_descuento'];
		$porcentaje_vendedor                           = $datos['porcentaje_vendedor'];
		$nombre_peso                                   = $datos['nombre_peso'];
		$cuenta                                        = $datos['cuenta'];
		$ip                                            = $datos['ip'];
		$fecha_devolucion                              = $datos['fecha_devolucion'];
		$hora_devolucion                               = $datos['hora_devolucion'];
		$fecha_orig                                    = $datos['fecha_orig'];
		$fecha                                         = $datos['fecha'];
		$cod_uniq_credito                              = $datos['cod_uniq_credito'];
		$unidades_faltantes_inv                        = $datos['unidades_faltantes_inv'];
		$fecha_pago                                    = $datos['fecha_pago'];
		$cod_dependencia                               = $datos['cod_dependencia'];
		$promo                                         = $datos['promo'];
		$und_min_precio_venta_desc                     = $datos['und_min_precio_venta_desc'];
		$chk                                           = $datos['chk'];
		$fecha_ymdhis_seg                              = $datos['fecha_ymdhis_seg'];
		$cod_factura_dian                              = $datos['cod_factura_dian'];
		$envio_dian                                    = $datos['envio_dian'];
		$envio_dian_fecha_ymdhis                       = $datos['envio_dian_fecha_ymdhis'];
		$envio_dian_usuario                            = $datos['envio_dian_usuario'];
		$estado_temp_dian                              = $datos['estado_temp_dian'];
		$precio_servicio                               = $datos['precio_servicio'];
		$precio_compra_viejo                           = $datos['precio_compra_viejo'];
		$precio_costo_viejo                            = $datos['precio_costo_viejo'];
		$chk2                                          = $datos['chk2'];
		$cod_info_impuesto_facturas_electronica        = $datos['cod_info_impuesto_facturas_electronica'];
		$cod_cierre_caja                               = $datos['cod_cierre_caja'];
		$fecha_cierre_caja                             = $datos['fecha_cierre_caja'];
		$hora_cierre_caja                              = $datos['hora_cierre_caja'];
		$fecha_time_cierre_caja                        = $datos['fecha_time_cierre_caja'];
		$nombre_marcas                                 = $datos['nombre_marcas'];
		$nombre_tipo_producto                          = $datos['nombre_tipo_producto'];
		$nombre_tipo_referencia                        = $datos['nombre_tipo_referencia'];
		$nombre_tipo_unidad_medida                     = $datos['nombre_tipo_unidad_medida'];
		$nombre_clase_producto                         = $datos['nombre_clase_producto'];
		$ptj_imp_consumo                               = $datos['ptj_imp_consumo'];
		$ptj_ret_iva                                   = $datos['ptj_ret_iva'];
		$ptj_ret_ica                                   = $datos['ptj_ret_ica'];
		$ptj_ret_fuente                                = $datos['ptj_ret_fuente'];
		$ptj_ipc                                       = $datos['ptj_ipc'];
		$precio_ipc_total                              = $datos['precio_ipc_total'];
		$precio_ipc                                    = $datos['precio_ipc'];
		$nombre_tipo_compra                            = $datos['nombre_tipo_compra'];
		$fecha_creacion                                = $datos['fecha_creacion'];
		$fecha_modificacion                            = $datos['fecha_modificacion'];

		$salida .=''.$cod_info_impuesto_facturas.',';
		$salida .=''.$flete.',';
		$salida .=''.$cod_factura.',';
		$salida .=''.$cod_clientes.',';
		$salida .=''.$total_compra.',';
		$salida .=''.$total_venta.',';
		$salida .=''.$subtotal_base.',';
		$salida .=''.$total_iva.',';
		$salida .=''.$total_descuento.',';
		$salida .=''.$vlr_cancelado.',';
		$salida .=''.$vlr_vuelto.',';
		$salida .=''.$vendedor.',';
		$salida .=''.$estado.',';
		$salida .=''.$fecha_dia.',';
		$salida .=''.$fecha_mes.',';
		$salida .=''.$fecha_anyo.',';
		$salida .=''.$anyo.',';
		$salida .=''.$fecha_hora.',';
		$salida .=''.$tipo_pago.',';
		$salida .=''.$fecha_remision.',';
		$salida .=''.$garantia_meses.',';
		$salida .=''.$observacion.',';
		$salida .=''.$bolsa.',';
		$salida .=''.$tiempo_ejecucion.',';
		$salida .=''.$cod_tipo_forma_pago.',';
		$salida .=''.$nombre_tipo_forma_pago.',';
		$salida .=''.$descripcion_tipo_forma_pago.',';
		$salida .=''.$servicio.',';
		$salida .=''.$nombre_tipo_factura.',';
		$salida .=''.$nombre_tipo_moneda.',';
		$salida .=''.$cod_factura_electronica.',';
		$salida .=''.$cod_tercero.',';
		$salida .=''.$nombre_maquina.',';
		$salida .=''.$cod_resolucion_facturacion.',';
		$salida .=''.$total_datos_data.',';

		$salida .=''.$cod_ventas.',';
		$salida .=''.$cod_productos.',';
		$salida .=''.$cod_proveedores.',';
		$salida .=''.$cod_marcas.',';
		$salida .=''.$nombre_productos.',';
		$salida .=''.$unidades_vendidas.',';
		$salida .=''.$und_vend_orig.',';
		$salida .=''.$devoluciones.',';
		$salida .=''.$precio_compra.',';
		$salida .=''.$precio_costo.',';
		$salida .=''.$precio_venta.',';
		$salida .=''.$vlr_total_venta.',';
		$salida .=''.$vlr_total_compra.',';
		$salida .=''.$comentario.',';
		$salida .=''.$tipo_venta.',';
		$salida .=''.$iva.',';
		$salida .=''.$iva_v.',';
		$salida .=''.$detalles.',';
		$salida .=''.$nombre_lineas.',';
		$salida .=''.$nombre_ccosto.',';
		$salida .=''.$cod_base_caja.',';
		$salida .=''.$descuento.',';
		$salida .=''.$descuento_ptj.',';
		$salida .=''.$precio_compra_con_descuento.',';
		$salida .=''.$porcentaje_vendedor.',';
		$salida .=''.$nombre_peso.',';
		$salida .=''.$cuenta.',';
		$salida .=''.$ip.',';
		$salida .=''.$fecha_devolucion.',';
		$salida .=''.$hora_devolucion.',';
		$salida .=''.$fecha_orig.',';
		$salida .=''.$fecha.',';
		$salida .=''.$cod_uniq_credito.',';
		$salida .=''.$unidades_faltantes_inv.',';
		$salida .=''.$fecha_pago.',';
		$salida .=''.$cod_dependencia.',';
		$salida .=''.$promo.',';
		$salida .=''.$und_min_precio_venta_desc.',';
		$salida .=''.$chk.',';
		$salida .=''.$fecha_ymdhis_seg.',';
		$salida .=''.$cod_factura_dian.',';
		$salida .=''.$envio_dian.',';
		$salida .=''.$envio_dian_fecha_ymdhis.',';
		$salida .=''.$envio_dian_usuario.',';
		$salida .=''.$estado_temp_dian.',';
		$salida .=''.$precio_servicio.',';
		$salida .=''.$precio_compra_viejo.',';
		$salida .=''.$precio_costo_viejo.',';
		$salida .=''.$chk2.',';
		$salida .=''.$cod_info_impuesto_facturas_electronica.',';
		$salida .=''.$cod_cierre_caja.',';
		$salida .=''.$fecha_cierre_caja.',';
		$salida .=''.$hora_cierre_caja.',';
		$salida .=''.$fecha_time_cierre_caja.',';
		$salida .=''.$nombre_marcas.',';
		$salida .=''.$nombre_tipo_producto.',';
		$salida .=''.$nombre_tipo_referencia.',';
		$salida .=''.$nombre_tipo_unidad_medida.',';
		$salida .=''.$nombre_clase_producto.',';
		$salida .=''.$ptj_imp_consumo.',';
		$salida .=''.$ptj_ret_iva.',';
		$salida .=''.$ptj_ret_ica.',';
		$salida .=''.$ptj_ret_fuente.',';
		$salida .=''.$ptj_ipc.',';
		$salida .=''.$precio_ipc_total.',';
		$salida .=''.$precio_ipc.',';
		$salida .=''.$nombre_tipo_compra.',';
		$salida .=''.$fecha_creacion.',';
		$salida .=''.$fecha_modificacion.'';
		$salida .="\n";
	}
echo $salida;
}
?>

