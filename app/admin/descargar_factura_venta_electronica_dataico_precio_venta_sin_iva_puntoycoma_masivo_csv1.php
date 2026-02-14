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

$fecha                          = date("Ymd");
$hora                           = date("His");
$salida                         = "";
$pagina                         = "../admin/reporte_venta_fechas.php";

$fecha_ymd_venta_producto_ini   = addslashes($_POST["fecha_ymd_venta_producto_ini"]);
$fecha_ymd_venta_producto_fin   = addslashes($_POST["fecha_ymd_venta_producto_fin"]);
$cod_administrador              = addslashes($_POST["cod_administrador"]);
$cod_tercero                    = addslashes($_POST["cod_tercero"]);
$cod_tipo_pago                  = addslashes($_POST["cod_tipo_pago"]);
$cod_tipo_forma_pago            = addslashes($_POST["cod_tipo_forma_pago"]);
$cod_dependencia                = addslashes($_POST["cod_dependencia"]);
$nombre_tipo_factura            = addslashes($_POST["nombre_tipo_factura"]);
$nombre_tipo_compra             = addslashes($_POST["nombre_tipo_compra"]);
$pagina_post                    = addslashes($_POST["pagina"]);

if (isset($_POST["REGENERAR_CODIGOS_DE_FACTURA_SELECIONADOS"]) && ($_POST["cod_ultima_factura"] <> '0')) {

	$cod_estado_check_factura_electronica  = 1;
	$cod_ultima_factura                    = addslashes($_POST["cod_ultima_factura"]);
	$pagina_redirect                       = $pagina_post.'?cod_administrador='.$cod_administrador.'&cod_tercero='.$cod_tercero.'&cod_dependencia='.$cod_dependencia.'&cod_tipo_pago='.$cod_tipo_pago.'&nombre_tipo_compra='.$nombre_tipo_compra.'&fecha_ymd_venta_producto_ini='.$fecha_ymd_venta_producto_ini.'&fecha_ymd_venta_producto_fin='.$fecha_ymd_venta_producto_fin.'&cod_tipo_forma_pago='.$cod_tipo_forma_pago.'&nombre_tipo_factura='.$nombre_tipo_factura;
	$contador                              = 0;

	foreach($_POST["cod_info_factura_venta"] as $key => $cod_info_factura_venta) {
		$contador++;
		$cod_factura = $cod_ultima_factura + $contador;

		$mostrar_datos_sql = "SELECT cod_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$matriz_consulta = mysqli_fetch_assoc($consulta);

		$cod_factura_antigua           = $matriz_consulta['cod_factura'];

		$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET cod_factura = '$cod_factura', cod_estado_check_factura_electronica = '$cod_estado_check_factura_electronica', 
		cod_factura_antigua = '$cod_factura_antigua' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = sprintf("UPDATE tbl15_venta_producto SET cod_factura = '$cod_factura', cod_estado_check_factura_electronica = '$cod_estado_check_factura_electronica', 
		cod_factura_antigua = '$cod_factura_antigua' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php }

if (isset($_POST["GENERAR_ARCHIVO_PLANO_DE_FACTURA_ELECTRONICA"])) {
	$facturas_array                 = ($_POST["cod_info_factura_venta"]);
	$cod_info_factura_venta_primera = reset($facturas_array);
	$cod_info_factura_venta_ultima  = end($facturas_array);

	$sql_info_factura_venta_primera = "SELECT cod_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta_primera'";
	$consulta_info_factura_venta_primera = mysqli_query($conectar, $sql_info_factura_venta_primera) or die(mysqli_error($conectar));
	$matriz_info_factura_venta_primera = mysqli_fetch_assoc($consulta_info_factura_venta_primera);

	$sql_info_factura_venta_ultima = "SELECT cod_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta_ultima'";
	$consulta_info_factura_venta_ultima = mysqli_query($conectar, $sql_info_factura_venta_ultima) or die(mysqli_error($conectar));
	$matriz_info_factura_venta_ultima = mysqli_fetch_assoc($consulta_info_factura_venta_ultima);

	$primera_factura           = $matriz_info_factura_venta_primera['cod_factura'];
	$ultima_factura            = $matriz_info_factura_venta_ultima['cod_factura'];

	$nombre                    = "FACTURA_"."DATAICO_PUNTOYCOMAS_MASIVO".'_DE_'.$primera_factura.'_A_'.$ultima_factura.'_'.$fecha.''.$hora.'_'.'.csv';
	$observacion               = "";

	header("Content-type: application/vnd.ms-excel" ) ;
	header("Content-Disposition: attachment; filename=$nombre" );

	$salida .='DESCUENTO_GLOBAL'.';';
	$salida .='FECHA_EXPEDICION'.';';
	$salida .='FECHA_VENCIMIENTO'.';';
	$salida .='NUMERO'.';';
	$salida .='MEDIO_DE_PAGO'.';';
	$salida .='TIPO_MEDIO_DE_PAGO'.';';
	$salida .='ORDEN_DE_COMPRA'.';';
	$salida .='MONEDA'.';';
	$salida .='CLIENTE_PAIS'.';';
	$salida .='CLIENTE_NOMBRE'.';';
	$salida .='CLIENTE_PRIMER_NOMBRE'.';';
	$salida .='CLIENTE_APELLIDO'.';';
	$salida .='CLIENTE_IDENTIFICATION'.';';
	$salida .='CLIENTE_TIPO_IDENTIFICATION'.';';
	$salida .='CLIENTE_DIRECCION'.';';
	$salida .='CLIENTE_TELEFONO'.';';
	$salida .='CLIENTE_CIUDAD'.';';
	$salida .='CLIENTE_DEPARTAMENTO'.';';
	$salida .='CLIENTE_TIPO'.';';
	$salida .='CLIENTE_CORREO'.';';
	$salida .='CLIENTE_TAX_LEVEL'.';';
	$salida .='CLIENTE_REGIMEN'.';';
	$salida .='ITEM_DESCRIPCION'.';';
	$salida .='ITEM_REFERENCIA'.';';
	$salida .='ITEM_CANTIDAD'.';';
	$salida .='ITEM_PRECIO'.';';
	$salida .='IVA%'.';';
	$salida .='IMP_CONSUMO%'.';';
	$salida .='RET_IVA%'.';';
	$salida .='RET_ICA%'.';';
	$salida .='RET_FUENTE%'.'';
	$salida .="\n";

	foreach($_POST["cod_info_factura_venta"] as $key => $cod_info_factura_venta) {

		$sql = "SELECT tbl15_tercero.nombre_tipo_tercero, tbl15_tercero.nombre_tipo_identificacion, tbl15_tercero.identificacion_tercero, 
		tbl15_tercero.digito_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, 
		tbl15_tercero.apellido2_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.telefono2_tercero, 
		tbl15_tercero.correo_tercero, tbl15_tercero.nombre_pais, tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.nombre_tipo_cliente,  
		tbl15_tercero.nombre_tipo_regimen, tbl15_tercero.nombre_tipo_impuesto, 
		tbl15_venta_producto.cod_producto_barra, tbl15_venta_producto.cod_factura, tbl15_venta_producto.nombre_producto, tbl15_venta_producto.und_venta, 
		tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
		tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.iva_ptj, 
		tbl15_venta_producto.ptj_imp_consumo, tbl15_venta_producto.ptj_ret_iva, tbl15_venta_producto.ptj_ret_ica, tbl15_venta_producto.ptj_ret_fuente, 
		tbl15_venta_producto.ptj_ipc, tbl15_venta_producto.precio_ipc_total, tbl15_venta_producto.precio_ipc, tbl15_venta_producto.cod_tipo_pago, 
		tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.nombre_tipo_moneda 
		FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
		WHERE (tbl15_venta_producto.cod_info_factura_venta = '$cod_info_factura_venta')";
		$consulta = mysqli_query($conectar, $sql);
		while ($datos = mysqli_fetch_assoc($consulta)) {

			$cod_producto_barra              = $datos['cod_producto_barra'];
			$cod_factura                     = $datos['cod_factura'];
			$nombre_producto                 = $datos['nombre_producto'];
			$und_venta                       = $datos['und_venta'];
			$precio_compra_producto          = $datos['precio_compra_producto'];
			$total_compra_producto           = $datos['total_compra_producto'];
			$precio_venta_producto           = $datos['precio_venta_producto'];
			$total_venta_producto            = $datos['total_venta_producto'];
			$fecha_ymd_venta_producto        = $datos['fecha_ymd_venta_producto'];
			$descuento_ptj                   = $datos['descuento_ptj'];
			$iva_ptj                         = $datos['iva_ptj'];
			$ptj_imp_consumo                 = $datos['ptj_imp_consumo'];
			$ptj_ret_iva                     = $datos['ptj_ret_iva'];
			$ptj_ret_ica                     = $datos['ptj_ret_ica'];
			$ptj_ret_fuente                  = $datos['ptj_ret_fuente'];
			$ptj_ipc                         = $datos['ptj_ipc'];
			$precio_ipc_total                = $datos['precio_ipc_total'];
			$precio_ipc                      = $datos['precio_ipc'];
			$cod_tipo_pago                   = $datos['cod_tipo_pago'];
			$cod_tipo_forma_pago             = $datos['cod_tipo_forma_pago'];
			$nombre_tipo_moneda              = $datos['nombre_tipo_moneda'];
			$nombre_tipo_tercero             = $datos['nombre_tipo_tercero'];
			$nombre_tipo_identificacion      = $datos['nombre_tipo_identificacion'];
			$identificacion_tercero          = $datos['identificacion_tercero'];
			$digito_tercero                  = $datos['digito_tercero'];
			$nombre1_tercero                 = $datos['nombre1_tercero'];
			$nombre2_tercero                 = $datos['nombre2_tercero'];
			$apellido1_tercero               = $datos['apellido1_tercero'];
			$apellido2_tercero               = $datos['apellido2_tercero'];
			$direccion_tercero               = $datos['direccion_tercero'];
			$telefono1_tercero               = $datos['telefono1_tercero'];
			$telefono2_tercero               = $datos['telefono2_tercero'];
			$correo_tercero                  = $datos['correo_tercero'];
			$nombre_pais                     = $datos['nombre_pais'];
			$nombre_departamento             = $datos['nombre_departamento'];
			$nombre_ciudad                   = $datos['nombre_ciudad'];
			$nombre_tipo_cliente             = $datos['nombre_tipo_cliente'];
			$nombre_tipo_regimen             = $datos['nombre_tipo_regimen'];
			$nombre_tipo_impuesto            = $datos['nombre_tipo_impuesto'];
			$nombre_tipo_identificacion      = 'CC';
			//$precio_venta_producto           = ($precio_venta_producto * $und_venta);
			$precio_venta_producto_sin_iva   = (($precio_venta_producto - (($descuento_ptj/100) * $precio_venta_producto)) / (($iva_ptj/100) + (100/100)));
			$apellidos_tercero               = $apellido1_tercero.' '.$nombre2_tercero;


			if ($cod_tipo_pago==1) { $tipo_medio_pago = "DEBITO"; } else { $tipo_medio_pago = "CREDITO"; }
			if ($nombre_pais=='COLOMBIA') { $nombre_pais = "CO"; } else { $nombre_pais = $nombre_pais; }
			if ($descuento_ptj==0) { $descuento_ptj = ""; } else { $descuento_ptj = $descuento_ptj; }
			if ($direccion_tercero=='') { $direccion_tercero = 'SAN PELAYO'; } else { $direccion_tercero = $direccion_tercero; }
			if ($telefono1_tercero=='') { $telefono1_tercero = '11111111'; } else { $telefono1_tercero = $telefono1_tercero; }
			if ($nombre_ciudad=='') { $nombre_ciudad = 'SAN PELAYO'; } else { $nombre_ciudad = $nombre_ciudad; }
			if ($correo_tercero=='') { $correo_tercero = 'sincorreo@gmail.com'; } else { $correo_tercero = $correo_tercero; }

			$sql_forma_pago = "SELECT nombre_tipo_forma_pago, nombre_tipo_forma_pago2 FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
			$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago);
			$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

			$nombre_tipo_forma_pago          = $datos_forma_pago['nombre_tipo_forma_pago'];
			$nombre_tipo_forma_pago2         = $datos_forma_pago['nombre_tipo_forma_pago2'];

			$salida .=''.$descuento_ptj.';';
			$salida .=''.$fecha_ymd_venta_producto.';';
			$salida .=''.$fecha_ymd_venta_producto.';';
			$salida .=''.$cod_factura.';';
			$salida .=''.$nombre_tipo_forma_pago2.';';
			$salida .=''.$tipo_medio_pago.';';
			$salida .=''.$observacion.';';
			$salida .=''.$nombre_tipo_moneda.';';
			$salida .=''.$nombre_pais.';';
			$salida .=''.$nombre1_tercero.';';
			$salida .=''.$nombre2_tercero.';';
			$salida .=''.$apellidos_tercero.';';
			$salida .=''.$identificacion_tercero.';';
			$salida .=''.$nombre_tipo_identificacion.';';
			$salida .=''.$direccion_tercero.';';
			$salida .=''.$telefono1_tercero.';';
			$salida .=''.$nombre_ciudad.';';
			$salida .=''.$nombre_departamento.';';
			$salida .=''.$nombre_tipo_cliente.';';
			$salida .=''.$correo_tercero.';';
			$salida .=''.$nombre_tipo_impuesto.';';
			$salida .=''.$nombre_tipo_regimen.';';
			$salida .=''.$nombre_producto.';';
			$salida .=''.$cod_producto_barra.';';
			$salida .=''.$und_venta.';';
			$salida .=''.round($precio_venta_producto_sin_iva, 2).';';
			$salida .=''.$iva_ptj.';';
			$salida .=''.$ptj_imp_consumo.';';
			$salida .=''.$ptj_ret_iva.';';
			$salida .=''.$ptj_ret_ica.';';
			$salida .=''.$ptj_ret_fuente.'';
			$salida .="\n";
		}
	}
echo $salida;
}
?>