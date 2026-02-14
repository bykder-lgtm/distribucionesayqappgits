<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
date_default_timezone_set("America/Bogota");
$cuenta_actual             = addslashes($_SESSION['usuario']);
$cuenta                    = addslashes($_SESSION['usuario']);
$cod_caja_virtual          = addslashes($_SESSION['cod_caja_virtual']);

$tab                       = addslashes($_GET['tab']);
$tipo                      = addslashes($_GET['tipo']);
$campo                     = addslashes($_GET['campo']);
$pagina                    = addslashes($_GET['pagina']);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_movimiento_contable_cuenta_personal_global, codigo_tipo_modulo_cuenta_cobrar_defect_global, cod_estado_no_eliminar_info_fact_venta_en_cero_villad_global
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global          = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_movimiento_contable_cuenta_personal_global             = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
$codigo_tipo_modulo_cuenta_cobrar_defect_global                    = $info_empresa_data['codigo_tipo_modulo_cuenta_cobrar_defect_global'];
$cod_estado_no_eliminar_info_fact_venta_en_cero_villad_global      = $info_empresa_data['cod_estado_no_eliminar_info_fact_venta_en_cero_villad_global'];
// ------------------------------------------------------------------------------------------------- //
if ($tipo == 'eliminar' && $tab == 'tbl15_cliente') {
$llave                     = addslashes($_GET['llave']);

$sql_datos = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$llave'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$cod_cliente               = $info_datos['cod_cliente']; 
$cod_entidad               = $info_datos['cod_entidad']; 
$cedula                    = $info_datos['cedula']; 
$nombres                   = $info_datos['nombres']; 
$apellido1                 = $info_datos['apellido1'];
$apellido2                 = $info_datos['apellido2']; 
$fecha_nac_ymd             = $info_datos['fecha_nac_ymd']; 
$fecha_nac_time            = $info_datos['fecha_nac_time']; 
$lugar_nac                 = $info_datos['lugar_nac']; 
$nombre_raza               = $info_datos['nombre_raza']; 
$lugar_procedencia         = $info_datos['lugar_procedencia']; 
$lugar_residencia          = $info_datos['lugar_residencia']; 
$nombre_religion           = $info_datos['nombre_religion']; 
$nombre_ocupacion          = $info_datos['nombre_ocupacion']; 
$nombre_estado_civil       = $info_datos['nombre_estado_civil']; 
$edad_anyo                 = $info_datos['edad_anyo']; 
$nombre_grupo_rh           = $info_datos['nombre_grupo_rh']; 
$tel_cliente               = $info_datos['tel_cliente']; 
$nombre_contacto1          = $info_datos['nombre_contacto1']; 
$tel_contacto1             = $info_datos['tel_contacto1']; 
$nombre_contacto2          = $info_datos['nombre_contacto2']; 
$tel_contacto2             = $info_datos['tel_contacto2']; 
$correo                    = $info_datos['correo']; 
$nombre_escolaridad        = $info_datos['nombre_escolaridad']; 
$fax                       = $info_datos['fax']; 
$direccion                 = $info_datos['direccion']; 
$nombre_ciudad             = $info_datos['nombre_ciudad']; 
$nombre_pais               = $info_datos['nombre_pais']; 
$longitud                  = $info_datos['longitud']; 
$latitud                   = $info_datos['latitud']; 

$sql_data = "INSERT INTO tbl15_elim_cliente (cod_cliente, cod_entidad, cedula, nombres, apellido1, apellido2, fecha_nac_ymd, fecha_nac_time, 
lugar_nac, nombre_raza, lugar_procedencia, lugar_residencia, nombre_religion, nombre_ocupacion, 
nombre_estado_civil, edad_anyo, nombre_grupo_rh, tel_cliente, nombre_contacto1, tel_contacto1, 
nombre_contacto2, tel_contacto2, correo, nombre_escolaridad, fax, direccion, nombre_ciudad, nombre_pais, longitud, latitud) 
VALUES ('$cod_cliente', '$cod_entidad', '$cedula', '$nombres', '$apellido1', '$apellido2', '$fecha_nac_ymd', '$fecha_nac_time', 
'$lugar_nac', '$nombre_raza', '$lugar_procedencia', '$lugar_residencia', '$nombre_religion', '$nombre_ocupacion', 
'$nombre_estado_civil', '$edad_anyo', '$nombre_grupo_rh', '$tel_cliente', '$nombre_contacto1', '$tel_contacto1', 
'$nombre_contacto2', '$tel_contacto2', '$correo', '$nombre_escolaridad', '$fax', '$direccion', '$nombre_ciudad', '$nombre_pais', '$longitud', '$latitud')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));


$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_historia_clinica') {
$llave = intval($_GET['llave']);

$sql_data = "INSERT INTO tbl15_historia_clinica_copia SELECT * FROM tbl15_historia_clinica WHERE $campo = '$llave'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cie10diag') {
$llave                     = intval($_GET['llave']);
$cod_historia_clinica      = intval($_GET['cod_historia_clinica']);
$cod_cliente               = intval($_GET['cod_cliente']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_tipo_regimen') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php 
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_grupo_area_cargo') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php 
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_tipo_doc') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_sexo') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_religion') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_raza') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_numero_hijos') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_grupo_rh') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_fondo_pension') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_estado_civil') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_escolaridad') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_empresa') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_empresa_contratante') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_arl') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_categoria') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_info_producto_copia_inventario') {
$llave = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_producto_copia_inventario WHERE cod_info_producto_copia_inventario = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?> <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>"> <?php }
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_entidad') {
$llave = addslashes($_GET['llave']);

$sql_datos = "SELECT * FROM tbl15_entidad WHERE cod_entidad = '$llave'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$cod_entidad            = $info_datos['cod_entidad']; 
$cod_eps                = $info_datos['cod_eps']; 
$nombre_entidad         = $info_datos['nombre_entidad']; 
$direccion              = $info_datos['direccion']; 
$telefono               = $info_datos['telefono']; 
$correo                 = $info_datos['correo']; 
$atiende                = $info_datos['atiende'];

$sql_data = "INSERT INTO tbl15_elim_entidad (cod_entidad, cod_eps, nombre_entidad, direccion, telefono, correo, atiende) 
VALUES ('$cod_entidad', '$cod_eps', '$nombre_entidad', '$direccion', '$telefono', '$correo', '$atiende')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_laboratorio') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_medicamento') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_ayuda_diagnostica') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
if ($tipo == 'eliminar' && $tab == 'tbl15_actividad_ecoemp') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_venta_producto_temporal') {
	$llave                          = intval($_GET['llave']);
	$cuenta_actual                  = addslashes($_GET['cuenta']);
	$cod_caja_virtual               = intval($_GET['cod_caja_virtual']);

	$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_venta, cod_producto_barra FROM tbl15_venta_producto_temporal WHERE (cod_venta_producto_temporal = '$llave')";
	$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
	$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

	$cod_info_factura_venta            = $datos_cod_info_impuesto_facturas['cod_info_factura_venta'];
	$cod_producto_barra                = $datos_cod_info_impuesto_facturas['cod_producto_barra'];

	$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_temporal = mysqli_query($conectar, $suma_temporal);
	$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

	$total_venta                 = $matriz_temporal['total_venta'];
	$pagina_redirect             = $pagina.'?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual;

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($total_venta > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}

	if ($cod_estado_no_eliminar_info_fact_venta_en_cero_villad_global == '0') {
		$datos_info_factura_cero = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
		$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);
		
		if ($existe_factura_abierta_cero == 0) {
			$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_estado_factura = 'ABIERTA')");
			$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
		}
	}

    $sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '0', cod_info_factura_venta = '0', cod_venta_producto_temporal = '0' WHERE (cod_producto_barra = '$cod_producto_barra')");
    $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

    $sql_conteo_reg_prod_repetido_temporal = "SELECT Count(cod_producto_barra) AS total_conteo_reg_prod_repetido FROM tbl15_venta_producto_temporal WHERE (cod_producto_barra = '$cod_producto_barra')";
    $resultado_conteo_reg_prod_repetido_temporal = mysqli_query($conectar, $sql_conteo_reg_prod_repetido_temporal) or die(mysqli_error($conectar));
    $info_conteo_reg_prod_repetido_temporal = mysqli_fetch_assoc($resultado_conteo_reg_prod_repetido_temporal);

    $total_conteo_reg_prod_repetido_temporal      = $info_conteo_reg_prod_repetido_temporal['total_conteo_reg_prod_repetido'];

    if ($total_conteo_reg_prod_repetido_temporal > 0) {
	    $sql_producto_barra_repetido_mas_nuevo_temporal = "SELECT cod_venta_producto_temporal AS cod_venta_producto_temporal_repetido_mas_nuevo FROM tbl15_venta_producto_temporal WHERE (cod_producto_barra = '$cod_producto_barra') ORDER BY cod_venta_producto_temporal DESC LIMIT 0, 1";
	    $resultado_producto_barra_repetido_mas_nuevo_temporal = mysqli_query($conectar, $sql_producto_barra_repetido_mas_nuevo_temporal) or die(mysqli_error($conectar));
	    $info_producto_barra_repetido_mas_nuevo_temporal = mysqli_fetch_assoc($resultado_producto_barra_repetido_mas_nuevo_temporal);

	    $cod_venta_producto_temporal_repetido_mas_nuevo      = $info_producto_barra_repetido_mas_nuevo_temporal['cod_venta_producto_temporal_repetido_mas_nuevo'];

		$sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET cod_estado_prod_repet_max_und_venta_aumentar = '0' WHERE (cod_producto_barra = '$cod_producto_barra')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET cod_estado_prod_repet_max_und_venta_aumentar = '1' WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal_repetido_mas_nuevo')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}


if ($tipo == 'eliminar' && $tab == 'tbl15_gasto_inmueble_detalle_venta_temporal') {
$llave = intval($_GET['llave']);
$cuenta_actual = addslashes($_GET['cuenta']);
$cod_caja_virtual = intval($_GET['cod_caja_virtual']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_gasto_inmueble_detalle_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_gasto_inmueble_detalle_venta_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_gasto_inmueble_detalle_venta            = $datos_cod_info_impuesto_facturas['cod_info_gasto_inmueble_detalle_venta'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_info_factura_cero = "SELECT cod_gasto_inmueble_detalle_venta_temporal FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>">
<?php
}


if ($tipo == 'eliminar' && $tab == 'tbl15_gasto_inmueble_inquilino_venta_temporal') {
$llave = intval($_GET['llave']);
$cuenta_actual = addslashes($_GET['cuenta']);
$cod_caja_virtual = intval($_GET['cod_caja_virtual']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_gasto_inmueble_inquilino_venta FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_gasto_inmueble_inquilino_venta            = $datos_cod_info_impuesto_facturas['cod_info_gasto_inmueble_inquilino_venta'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_info_factura_cero = "SELECT cod_gasto_inmueble_inquilino_venta_temporal FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>">
<?php
}



if ($tipo == 'eliminar' && $tab == 'tbl15_mantenimiento_producto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_venta FROM tbl15_mantenimiento_producto_temporal WHERE (cod_venta_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_venta            = $datos_cod_info_impuesto_facturas['cod_info_factura_venta'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_venta_producto_temporal FROM tbl15_mantenimiento_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_base_caja = '$cod_base_caja')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_mantenimiento WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_orden_produccion_venta_producto') {
$llave = intval($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_orden_produccion_factura_venta FROM tbl15_orden_produccion_venta_producto 
WHERE (cod_orden_produccion_venta_producto = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_orden_produccion_factura_venta            = $datos_cod_info_impuesto_facturas['cod_info_orden_produccion_factura_venta'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_orden_produccion_venta_producto FROM tbl15_orden_produccion_venta_producto 
WHERE (cod_info_orden_produccion_factura_venta = '$cod_info_orden_produccion_factura_venta')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_venta_producto * und_venta) AS total_precio_venta 
FROM tbl15_orden_produccion_venta_producto WHERE (cod_info_orden_produccion_factura_venta = '$cod_info_orden_produccion_factura_venta')";
$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

$total_precio_compra          = $info_datos_venta_sum['total_precio_compra']; 
$total_precio_venta           = $info_datos_venta_sum['total_precio_venta']; 
$monto_deuda                  = $total_precio_venta; 

$sql_total_abonado_credito = "SELECT SUM(abonado) AS total_abono FROM tbl15_orden_produccion_abonos 
WHERE (cod_info_orden_produccion_factura_venta = '$cod_info_orden_produccion_factura_venta')";
$consulta_total_abonado_credito = mysqli_query($conectar, $sql_total_abonado_credito) or die(mysqli_error($conectar));
$info_total_abonado_credito = mysqli_fetch_assoc($consulta_total_abonado_credito);

$total_abono                  = $info_total_abonado_credito['total_abono'];
$subtotal                     = $monto_deuda - $total_abono;

$data_sql = ("UPDATE tbl15_info_orden_produccion_factura_venta SET total_precio_venta = '$total_precio_venta', total_precio_compra = '$total_precio_compra', 
monto_deuda = '$monto_deuda', subtotal = '$subtotal', total_abono = '$total_abono' 
WHERE (cod_info_orden_produccion_factura_venta = '$cod_info_orden_produccion_factura_venta')");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ($existe_factura_abierta_cero == '0') {
$borrar_sql = sprintf("DELETE FROM tbl15_info_orden_produccion_factura_venta 
WHERE (cod_info_orden_produccion_factura_venta = '$cod_info_orden_produccion_factura_venta')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
$pagina_redirect = $pagina.'?cod_info_orden_produccion_factura_venta='.$cod_info_orden_produccion_factura_venta;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_transferencia_producto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_transferencia  FROM tbl15_transferencia_producto_temporal WHERE (cod_transferencia_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_transferencia             = $datos_cod_info_impuesto_facturas['cod_info_factura_transferencia '];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_transferencia_producto_temporal FROM tbl15_transferencia_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_base_caja = '$cod_base_caja')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_transferencia WHERE (cod_info_factura_transferencia  = '$cod_info_factura_transferencia ') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}


if ($tipo == 'eliminar' && $tab == 'tbl15_transferencia_bodega_producto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_transferencia_bodega  FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_transferencia_bodega             = $datos_cod_info_impuesto_facturas['cod_info_factura_transferencia_bodega '];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_transferencia_bodega_producto_temporal FROM tbl15_transferencia_bodega_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_base_caja = '$cod_base_caja')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega  = '$cod_info_factura_transferencia_bodega ') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_subproducto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_subproducto FROM tbl15_subproducto_temporal WHERE (cod_subproducto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_subproducto            = $datos_cod_info_impuesto_facturas['cod_info_factura_subproducto'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_subproducto_temporal FROM tbl15_subproducto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_base_caja = '$cod_base_caja')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_subproducto WHERE (cod_info_factura_subproducto = '$cod_info_factura_subproducto') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_subproducto_temporal_nuevo') {
	$llave = addslashes($_GET['llave']);
	$pagina = addslashes($_GET['pagina']);

	$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_subproducto FROM tbl15_subproducto_temporal WHERE (cod_subproducto_temporal = '$llave')";
	$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
	$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

	$cod_info_factura_subproducto            = $datos_cod_info_impuesto_facturas['cod_info_factura_subproducto'];

	$borrar_sql = sprintf("DELETE FROM tbl15_subproducto_temporal WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$datos_info_factura_cero = "SELECT cod_subproducto_temporal FROM tbl15_subproducto_temporal WHERE (cod_info_factura_subproducto = '$cod_info_factura_subproducto')";
	$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
	$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

	if ($existe_factura_abierta_cero == 0) {
		$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_subproducto WHERE (cod_info_factura_subproducto = '$cod_info_factura_subproducto') AND (nombre_estado_factura = 'ABIERTA')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

		$pagina_redirect = '../admin/reg_cargar_subproducto_principal.php'.'?cod_info_factura_subproducto='.$cod_info_factura_subproducto;
	} else {
		$pagina_redirect = $pagina.'?cod_info_factura_subproducto='.$cod_info_factura_subproducto;
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}



if ($tipo == 'eliminar' && $tab == 'tbl15_compra_producto_temporal') {
$llave                              = intval($_GET['llave']);
//$nombre_tipo_cargue_factura         = addslashes($_GET['nombre_tipo_cargue_factura']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_compra FROM tbl15_compra_producto_temporal WHERE (cod_compra_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_compra            = $datos_cod_info_impuesto_facturas['cod_info_factura_compra'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_info_cotizacion_compra = "SELECT nombre_rete_fuente_ptj, ret_ica_ptj FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_info_cotizacion_compra = mysqli_query($conectar, $sql_info_cotizacion_compra) or die(mysqli_error($conectar));
$info_cotizacion_compra = mysqli_fetch_assoc($consulta_info_cotizacion_compra);

$nombre_rete_fuente_ptj                 = $info_cotizacion_compra['nombre_rete_fuente_ptj'];
$ret_ica_ptj                            = $info_cotizacion_compra['ret_ica_ptj'];

if ($nombre_rete_fuente_ptj == '') { $nombre_rete_fuente_ptj = 0; } else { $nombre_rete_fuente_ptj = $suma['nombre_rete_fuente_ptj']; }
if ($ret_ica_ptj == '') { $ret_ica_ptj = 0; } else { $ret_ica_ptj = $suma['ret_ica_ptj']; }

$suma_factura = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(valor_iva * und_compra) AS valor_iva, SUM(precio_costo_producto * und_compra) AS total_precio_costo,
SUM(precio_ipc_total) AS total_precio_ipc, SUM((precio_compra_producto * und_compra) / ((iva_ptj/100)+1)) AS subtotal, SUM((precio_compra_producto * und_compra)) AS con_iva, 
SUM(total_dto) AS total_dto 
FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_suma = mysqli_query($conectar, $suma_factura) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_suma);

$total                                  = round($suma['total_compra_producto'], 2);
$total_precio_costo                     = round($suma['total_precio_costo'], 2);
//$valor_iva                              = round($suma['valor_iva'], 2);
$subtotal                               = round($suma['subtotal'], 2);
$total_sin_iva                          = $subtotal;
$total_con_iva                          = round($suma['con_iva'], 2);
$valor_iva                              = $total_con_iva - $total_sin_iva;
$total_precio_ipc                       = $suma['total_precio_ipc'];
$valor_neto                             = $total;
$total_rete_fuente                      = $subtotal * ($nombre_rete_fuente_ptj/100);
$total_ret_ica                          = $subtotal * ($ret_ica_ptj/1000);
$total_factura_compra_retefuente        = ($total - ($total_rete_fuente + $total_ret_ica));
$total_factura_compra                   = $total; 
$total_descuento                        = round($suma['total_dto'], 2);
$total_compra_imp                       = $total;

$data_sql = ("UPDATE tbl15_info_factura_compra SET subtotal = '$subtotal', total_precio_ipc = '$total_precio_ipc',
valor_iva = '$valor_iva', total = '$total', valor_neto = '$valor_neto', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra', total_descuento = '$total_descuento', total_compra_imp = '$total_compra_imp' 
WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_compra_producto_temporal FROM tbl15_compra_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_auditoria_producto_temporal') {
$llave                         = intval($_GET['llave']);
$nombre_tipo_cargue_factura    = addslashes($_GET['nombre_tipo_cargue_factura']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_auditoria FROM tbl15_auditoria_producto_temporal WHERE (cod_auditoria_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_auditoria            = $datos_cod_info_impuesto_facturas['cod_info_factura_auditoria'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_auditoria_producto_temporal FROM tbl15_auditoria_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_auditoria WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_cotizacion_venta_producto_temporal') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_cotizacion_compra_producto_temporal') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_cotizacion_venta_producto') {
$llave = addslashes($_GET['llave']);
$cod_info_cotizacion_factura_venta = addslashes($_GET['cod_info_cotizacion_factura_venta']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina.'?cod_info_cotizacion_factura_venta='.$cod_info_cotizacion_factura_venta ?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_orden_produccion_venta_producto_temporal') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_venta_producto') {
	$llave                                           = intval($_GET['llave']);
	$cod_venta_producto                              = intval($_GET['llave']);

	$origen_operacion                                = 'ventas';
	$fecha_devolucion                                = date("Y-m-d");
	$hora_devolucion                                 = date("H:i:s");
	$fecha_time                                      = time();	
	$fecha_dia                                       = date("Y-m-d");
	$fecha_mes                                       = date("Y-m");
	$fecha_anyo                                      = date("Y-m-d");
	$anyo                                            = date("Y");
	$fecha_hora                                      = date("H:i:s");
	$fecha_creacion                                  = date("Y-m-d H:i:s");
	$comentario                                      = 'devolucion venta btn elim inf';
	$fecha	                                         = $fecha_time;
	$nombre_estado_factura_dataico_dian              = 'ANULADA PA';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_max_info_nota_credito = "SELECT MAX(cod_factura_nota_credito) AS cod_factura_nota_credito FROM tbl15_info_nota_credito";
	$resultado_max_info_nota_credito = mysqli_query($conectar, $sql_max_info_nota_credito);
	$info_max_info_nota_credito = mysqli_fetch_assoc($resultado_max_info_nota_credito);

	$cod_factura_nota_credito                        = $info_max_info_nota_credito['cod_factura_nota_credito'] + 1; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$prefijo_nota_credito                            = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_nota_credito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_credito'";
	$exec_autoincremento_info_nota_credito = mysqli_query($conectar, $sql_autoincremento_info_nota_credito) or die(mysqli_error($conectar));
	$datos_autoincremento_info_nota_credito = mysqli_fetch_assoc($exec_autoincremento_info_nota_credito);
	$cod_info_nota_credito = $datos_autoincremento_info_nota_credito['AUTO_INCREMENT'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_datos = "SELECT * FROM tbl15_venta_producto WHERE cod_venta_producto = '$llave'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	$info_datos = mysqli_fetch_assoc($resultado_datos);

	$cod_venta_producto                           = $info_datos['cod_venta_producto']; 
	$cod_producto                                 = $info_datos['cod_producto']; 
	$cod_producto_barra                           = $info_datos['cod_producto_barra']; 
	$cod_producto_barra_madre                     = $info_datos['cod_producto_barra_madre']; 
	$cod_info_factura_venta                       = $info_datos['cod_info_factura_venta']; 
	$cod_factura                                  = $info_datos['cod_factura']; 
	$cod_tercero                                  = $info_datos['cod_tercero']; 
	$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
	$nombre_producto                              = $info_datos['nombre_producto']; 
	$und_venta                                    = $info_datos['und_venta']; 
	$precio_compra_producto                       = $info_datos['precio_compra_producto']; 
	$total_compra_producto                        = $info_datos['total_compra_producto']; 
	$precio_costo_producto                        = $info_datos['precio_costo_producto']; 
	$total_costo_producto                         = $info_datos['total_costo_producto']; 
	$precio_venta_producto                        = $info_datos['precio_venta_producto']; 
	$total_venta_producto                         = $info_datos['total_venta_producto']; 
	$precio_venta_producto_orig                   = $info_datos['precio_venta_producto_orig']; 
	$und_caja_sobre                               = $info_datos['und_caja_sobre']; 
	$cajas_sobre                                  = $info_datos['cajas_sobre']; 
	$nombre_tipo_und_caja_sobre                   = $info_datos['nombre_tipo_und_caja_sobre']; 
	$posologia_cantidad                           = $info_datos['posologia_cantidad']; 
	$posologia_peso                               = $info_datos['posologia_peso']; 
	$peso_producto                                = $info_datos['peso_producto']; 
	$unidad_medida_peso                           = $info_datos['unidad_medida_peso']; 
	$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
	$nombre_tipo_unidad_medida                    = $info_datos['nombre_tipo_unidad_medida']; 
	$nombre_tipo_presentacion                     = $info_datos['nombre_tipo_presentacion']; 
	$nombre_via_administracion                    = $info_datos['nombre_via_administracion']; 
	$nombre_frec_duracion                         = $info_datos['nombre_frec_duracion']; 
	$und_producto                                 = $info_datos['und_producto']; 
	$fecha_ymd_venta_producto                     = $info_datos['fecha_ymd_venta_producto']; 
	$fecha_mes_venta_producto                     = $info_datos['fecha_mes_venta_producto']; 
	$fecha_anyo_venta_producto                    = $info_datos['fecha_anyo_venta_producto']; 
	$fecha_hora_venta_producto                    = $info_datos['fecha_hora_venta_producto']; 
	$fecha_seg_venta_producto                     = $info_datos['fecha_seg_venta_producto']; 
	$fecha_alerta                                 = $info_datos['fecha_alerta']; 
	$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
	$cuenta                                       = $info_datos['cuenta']; 
	$cod_administrador                            = $info_datos['cod_administrador']; 
	$cod_base_caja                                = $info_datos['cod_base_caja']; 
	$cod_opcion_descontable_inv                   = $info_datos['cod_opcion_descontable_inv']; 
	$und_producto_inv                             = $info_datos['und_producto_inv']; 
	$und_producto_bodega_inv                      = $info_datos['und_producto_bodega_inv']; 
	$cod_tipo_cobrar                              = $info_datos['cod_tipo_cobrar']; 
	$descuento_ptj                                = $info_datos['descuento_ptj']; 
	$iva_ptj                                      = $info_datos['iva_ptj']; 
	$iva_saludable_ptj                            = $info_datos['iva_saludable_ptj']; 
	$ptj_imp_consumo                              = $info_datos['ptj_imp_consumo']; 
	$ptj_ret_iva                                  = $info_datos['ptj_ret_iva']; 
	$ptj_ret_ica                                  = $info_datos['ptj_ret_ica']; 
	$ptj_ret_fuente                               = $info_datos['ptj_ret_fuente']; 
	$ptj_ipc                                      = $info_datos['ptj_ipc']; 
	$precio_ipc_total                             = $info_datos['precio_ipc_total']; 
	$precio_ipc                                   = $info_datos['precio_ipc']; 
	$cod_factura_electronica                      = $info_datos['cod_factura_electronica']; 
	$cod_resolucion_facturacion                   = $info_datos['cod_resolucion_facturacion']; 
	$nombre_tipo_precio                           = $info_datos['nombre_tipo_precio']; 
	$nombre_tipo_precio_venta                     = $info_datos['nombre_tipo_precio_venta']; 
	$comision_ptj                                 = $info_datos['comision_ptj']; 
	$nombre_cliente                               = $info_datos['nombre_cliente']; 
	$cedula                                       = $info_datos['cedula']; 
	$nombre_empresa                               = $info_datos['nombre_empresa']; 
	$cod_empresa                                  = $info_datos['cod_empresa']; 
	$cod_cliente                                  = $info_datos['cod_cliente']; 
	$cod_historia_clinica                         = $info_datos['cod_historia_clinica']; 
	$cod_prioridad                                = $info_datos['cod_prioridad']; 
	//$cod_cufe                                     = $info_datos['cod_cufe']; 
	$cod_tipo_mantenimiento                       = $info_datos['cod_tipo_mantenimiento']; 
	$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
	$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
	$total_datos_data                             = $info_datos['total_datos_data']; 
	$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
	$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
	$vlr_cancelado                                = $info_datos['vlr_cancelado']; 
	$vlr_vuelto                                   = $info_datos['vlr_vuelto']; 
	$nombre_promocion                             = $info_datos['nombre_promocion']; 
	$nombre_promocion_ing                         = $info_datos['nombre_promocion_ing']; 
	$url_img_producto_min                         = $info_datos['url_img_producto_min']; 
	$url_img_producto_orig                        = $info_datos['url_img_producto_orig']; 
	$cod_categoria                                = $info_datos['cod_categoria']; 
	$cod_categoria_sub                            = $info_datos['cod_categoria_sub']; 
	$cod_estado                                   = $info_datos['cod_estado']; 
	$cod_dependencia                              = $info_datos['cod_dependencia']; 
	$cod_tipo_inventario                          = $info_datos['cod_tipo_inventario']; 
	$cod_tipo_pedido                              = $info_datos['cod_tipo_pedido']; 
	$cod_factura_compra_producto                  = $info_datos['cod_factura_compra_producto']; 
	$cod_tipo_producto_cocina                     = $info_datos['cod_tipo_producto_cocina']; 
	$cod_cierre_caja                              = $info_datos['cod_cierre_caja']; 
	$fecha_cierre_caja                            = $info_datos['fecha_cierre_caja']; 
	$hora_cierre_caja                             = $info_datos['hora_cierre_caja']; 
	$fecha_time_cierre_caja                       = $info_datos['fecha_time_cierre_caja']; 
	$comentario_producto                          = $info_datos['comentario_producto']; 
	$nombre_categoria                             = $info_datos['nombre_categoria']; 
	$nombre_categoria_sub                         = $info_datos['nombre_categoria_sub']; 
	$nombre_tipo_compra                           = $info_datos['nombre_tipo_compra']; 
	$placa_producto                               = $info_datos['placa_producto']; 
	$fecha_ymd_parqueo_ini                        = $info_datos['fecha_ymd_parqueo_ini']; 
	$fecha_hora_parqueo_ini                       = $info_datos['fecha_hora_parqueo_ini']; 
	$fecha_ymd_parqueo_fin                        = $info_datos['fecha_ymd_parqueo_fin']; 
	$fecha_hora_parqueo_fin                       = $info_datos['fecha_hora_parqueo_fin']; 
	$cod_info_parqueo_cotizacion_factura_venta    = $info_datos['cod_info_parqueo_cotizacion_factura_venta']; 
	$cod_parqueo_cotizacion_venta_producto        = $info_datos['cod_parqueo_cotizacion_venta_producto']; 
	$cod_info_hotel_cotizacion_factura_venta      = $info_datos['cod_info_hotel_cotizacion_factura_venta']; 
	$cod_hotel_cotizacion_venta_producto          = $info_datos['cod_hotel_cotizacion_venta_producto']; 
	$cod_tipo_metodo_envio                        = $info_datos['cod_tipo_metodo_envio']; 
	$cod_tipo_aplicacion                          = $info_datos['cod_tipo_aplicacion']; 
	$cod_zona_envio                               = $info_datos['cod_zona_envio']; 
	$cod_estado_cava                              = $info_datos['cod_estado_cava']; 
	$cod_dia_semana                               = $info_datos['cod_dia_semana']; 
	$cod_estado_check_factura_electronica         = $info_datos['cod_estado_check_factura_electronica']; 
	$cod_estado_factura_electronica_enviado_dian  = $info_datos['cod_estado_factura_electronica_enviado_dian']; 
	$cod_factura_antigua                          = $info_datos['cod_factura_antigua']; 
	$cod_venta_producto_temporal                  = $info_datos['cod_venta_producto_temporal']; 
	$cod_estado_habitacion_hotel                  = $info_datos['cod_estado_habitacion_hotel']; 
	$cod_tipo_habitacion_hotel                    = $info_datos['cod_tipo_habitacion_hotel']; 
	$cod_estado_tipo_hotel_parqueo                = $info_datos['cod_estado_tipo_hotel_parqueo']; 
	$total_horas                                  = $info_datos['total_horas']; 
	$total_dias                                   = $info_datos['total_dias']; 
	$cod_tipo_cod_barra                           = $info_datos['cod_tipo_cod_barra']; 
	$nombre_tipo_cobro                            = $info_datos['nombre_tipo_cobro']; 
	$fecha_cobro_renovacion                       = $info_datos['fecha_cobro_renovacion']; 
	$cod_puc                                      = $info_datos['cod_puc']; 
	$vendedor                                     = $info_datos['cuenta'];

	$total_costo_producto                         = $info_datos['precio_costo_producto'] * $und_venta;
	$total_venta_producto                         = $info_datos['precio_venta_producto'] * $und_venta;
	$unidades_vendidas                            = $und_venta - $und_venta;
	$und_vend_orig                                = $und_venta;
	$vlr_total_venta                              = $precio_venta_producto * $und_venta;
	$vlr_total_compra                             = $precio_compra_producto * $und_venta;
	$devoluciones                                 = $und_venta;
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_venta_producto * und_venta) AS total_precio_venta 
	FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
	$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
	$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

	$total_precio_compra                          = $info_datos_venta_sum['total_precio_compra']; 
	$total_precio_venta                           = $info_datos_venta_sum['total_precio_venta']; 

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
	total_datos_data = '$total_datos_data', nombre_estado_factura_dataico_dian = '$nombre_estado_factura_dataico_dian' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
	$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

	$und_producto_inv                             = $info_datos_producto['und_producto']; 
	$und_producto                                 = $und_producto_inv + $und_venta;
	$und_inventario	                              = $und_producto_inv;
	$und_nuevas                                   = $und_venta;

	$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
	$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

	$unidades_faltantes                           = $info_datos_producto_desp['und_producto']; 

	$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_info_factura_venta, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
	unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
	vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
	fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
	VALUES ('$cod_venta_producto', '$cod_info_factura_venta', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
	'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
	'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
	'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
	$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$agregar_nota_credito = "INSERT INTO tbl15_nota_credito (cod_info_factura_venta, cod_venta_producto, cod_producto, cod_producto_barra, cod_producto_barra_madre, 
	cod_factura, cod_tercero, cod_caja_virtual, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, 
	total_costo_producto, precio_venta_producto, total_venta_producto, precio_venta_producto_orig, und_caja_sobre, cajas_sobre, 
	nombre_tipo_und_caja_sobre, posologia_cantidad, posologia_peso, peso_producto, unidad_medida_peso, nombre_tipo_producto, 
	nombre_tipo_unidad_medida, nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, und_producto, 
	fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_hora_venta_producto, 
	fecha_seg_venta_producto, fecha_alerta, cod_estado_vacuna, cuenta, cod_administrador, cod_base_caja, 
	cod_opcion_descontable_inv, und_producto_inv, und_producto_bodega_inv, cod_tipo_cobrar, descuento_ptj, 
	iva_ptj, iva_saludable_ptj, ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, ptj_ipc, 
	precio_ipc_total, precio_ipc, cod_factura_electronica, cod_resolucion_facturacion, nombre_tipo_precio, 
	nombre_tipo_precio_venta, comision_ptj, nombre_cliente, cedula, nombre_empresa, cod_empresa, cod_cliente, 
	cod_historia_clinica, cod_prioridad, cod_tipo_mantenimiento, cod_tipo_pago, cod_tipo_forma_pago, 
	total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, nombre_promocion, 
	nombre_promocion_ing, url_img_producto_min, url_img_producto_orig, cod_categoria, cod_categoria_sub, 
	cod_estado, cod_dependencia, cod_tipo_inventario, cod_tipo_pedido, cod_factura_compra_producto, 
	cod_tipo_producto_cocina, cod_cierre_caja, fecha_cierre_caja, hora_cierre_caja, fecha_time_cierre_caja, 
	comentario_producto, nombre_categoria, nombre_categoria_sub, nombre_tipo_compra, placa_producto, 
	fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, 
	cod_info_parqueo_cotizacion_factura_venta, cod_parqueo_cotizacion_venta_producto, cod_info_hotel_cotizacion_factura_venta, 
	cod_hotel_cotizacion_venta_producto, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, 
	cod_estado_cava, cod_dia_semana, cod_estado_check_factura_electronica, cod_estado_factura_electronica_enviado_dian, 
	cod_factura_antigua, cod_venta_producto_temporal, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, 
	cod_estado_tipo_hotel_parqueo, total_horas, total_dias, cod_tipo_cod_barra, nombre_tipo_cobro, fecha_cobro_renovacion, cod_puc) 
	VALUES ('$cod_info_factura_venta', '$cod_venta_producto', '$cod_producto', '$cod_producto_barra', '$cod_producto_barra_madre', 
	'$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', 
	'$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$precio_venta_producto_orig', '$und_caja_sobre', '$cajas_sobre', 
	'$nombre_tipo_und_caja_sobre', '$posologia_cantidad', '$posologia_peso', '$peso_producto', '$unidad_medida_peso', '$nombre_tipo_producto', 
	'$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$nombre_frec_duracion', '$und_producto', 
	'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_hora_venta_producto', 
	'$fecha_seg_venta_producto', '$fecha_alerta', '$cod_estado_vacuna', '$cuenta', '$cod_administrador', '$cod_base_caja', 
	'$cod_opcion_descontable_inv', '$und_producto_inv', '$und_producto_bodega_inv', '$cod_tipo_cobrar', '$descuento_ptj', 
	'$iva_ptj', '$iva_saludable_ptj', '$ptj_imp_consumo', '$ptj_ret_iva', '$ptj_ret_ica', '$ptj_ret_fuente', '$ptj_ipc', 
	'$precio_ipc_total', '$precio_ipc', '$cod_factura_electronica', '$cod_resolucion_facturacion', '$nombre_tipo_precio', 
	'$nombre_tipo_precio_venta', '$comision_ptj', '$nombre_cliente', '$cedula', '$nombre_empresa', '$cod_empresa', '$cod_cliente', 
	'$cod_historia_clinica', '$cod_prioridad', '$cod_tipo_mantenimiento', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
	'$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$nombre_promocion', 
	'$nombre_promocion_ing', '$url_img_producto_min', '$url_img_producto_orig', '$cod_categoria', '$cod_categoria_sub', 
	'$cod_estado', '$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_pedido', '$cod_factura_compra_producto', 
	'$cod_tipo_producto_cocina', '$cod_cierre_caja', '$fecha_cierre_caja', '$hora_cierre_caja', '$fecha_time_cierre_caja', 
	'$comentario_producto', '$nombre_categoria', '$nombre_categoria_sub', '$nombre_tipo_compra', '$placa_producto', 
	'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', 
	'$cod_info_parqueo_cotizacion_factura_venta', '$cod_parqueo_cotizacion_venta_producto', '$cod_info_hotel_cotizacion_factura_venta', 
	'$cod_hotel_cotizacion_venta_producto', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_zona_envio', 
	'$cod_estado_cava', '$cod_dia_semana', '$cod_estado_check_factura_electronica', '$cod_estado_factura_electronica_enviado_dian', 
	'$cod_factura_antigua', '$cod_venta_producto_temporal', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', 
	'$cod_estado_tipo_hotel_parqueo', '$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$nombre_tipo_cobro', '$fecha_cobro_renovacion', '$cod_puc')";
	$resultado_nota_crediton = mysqli_query($conectar, $agregar_nota_credito) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_factura                                     = $datos_info_factura_venta['cod_factura'];
    $cod_resolucion_facturacion                      = $datos_info_factura_venta['cod_resolucion_facturacion'];
    $cod_tercero                                     = $datos_info_factura_venta['cod_tercero'];
    $cod_caja_virtual                                = $datos_info_factura_venta['cod_caja_virtual'];
    $cod_tipo_pago                                   = $datos_info_factura_venta['cod_tipo_pago'];
    $cod_tipo_forma_pago                             = $datos_info_factura_venta['cod_tipo_forma_pago'];
    $nombre_tipo_factura                             = $datos_info_factura_venta['nombre_tipo_factura'];
    $total_precio_compra                             = $datos_info_factura_venta['total_precio_compra'];
    $total_precio_venta                              = $datos_info_factura_venta['total_precio_venta'];
    $cod_factura_antigua                             = $datos_info_factura_venta['cod_factura_antigua'];
	$cod_cufe                                        = $datos_info_factura_venta['cod_cufe'];
	$dataico_email_status                            = $datos_info_factura_venta['dataico_email_status'];
	$dataico_uuid                                    = $datos_info_factura_venta['dataico_uuid'];
	$dataico_issue_date                              = $datos_info_factura_venta['dataico_issue_date'];
	$dataico_dian_messages                           = $datos_info_factura_venta['dataico_dian_messages'];
	$dataico_xml_url                                 = $datos_info_factura_venta['dataico_xml_url'];
	$dataico_customer_status                         = $datos_info_factura_venta['dataico_customer_status'];
	$dataico_validation_date                         = $datos_info_factura_venta['dataico_validation_date'];
	$dataico_qrcode                                  = $datos_info_factura_venta['dataico_qrcode'];
	$dataico_xml                                     = $datos_info_factura_venta['dataico_xml'];
	$dataico_invoice_type_code                       = $datos_info_factura_venta['dataico_invoice_type_code'];
	$dataico_pdf_url                                 = $datos_info_factura_venta['dataico_pdf_url'];
	$dataico_dian_status                             = $datos_info_factura_venta['dataico_dian_status'];
	$cod_movimiento_caja                             = $datos_info_factura_venta['cod_movimiento_caja'];
	$cod_movimiento_contable_cuenta_personal         = $datos_info_factura_venta['cod_movimiento_contable_cuenta_personal'];
	$cod_puc_db                                      = $datos_info_factura_venta['cod_puc'];
	$cod_cuentas_cobrar                              = $datos_info_factura_venta['cod_cuentas_cobrar'];
    $total_precio_venta_factura                      = $datos_info_factura_venta['total_precio_venta'];

	$tiempo_final                                    = microtime(true);
	$tiempo_ejecucion_dian_dataico                   = $tiempo_final - $tiempo_inicial;
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_pago == '2' && $cod_cuentas_cobrar <> '0') {
		$cod_estado_archivado                             = 1;

		$sql_cuentas_cobrar = "SELECT monto_deuda, mensaje FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
		$consulta_cuentas_cobrar = mysqli_query($conectar, $sql_cuentas_cobrar) or die(mysqli_error($conectar));
		$matriz_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);

		$monto_deuda_db                                  = $matriz_cuentas_cobrar['monto_deuda'];
		$mensaje                                         = $matriz_cuentas_cobrar['mensaje'].' | '.'alter por btn inf venta';

		$sql_info_tercero = "SELECT total_monto_deuda_cuenta_cobrar AS total_monto_deuda_cuenta_cobrar_db FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
		$consulta_info_tercero = mysqli_query($conectar, $sql_info_tercero) or die(mysqli_error($conectar));
		$matriz_info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

		$total_monto_deuda_cuenta_cobrar_db                 = $matriz_info_tercero['total_monto_deuda_cuenta_cobrar_db'];

		if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '0') {

			$sql_total_abonado_credito = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
			$consulta_total_abonado_credito = mysqli_query($conectar, $sql_total_abonado_credito) or die(mysqli_error($conectar));
			$info_total_abonado_credito = mysqli_fetch_assoc($consulta_total_abonado_credito);

			$abonado                                    = $info_total_abonado_credito['abonado'];
			$monto_deuda                                = $monto_deuda_db - $info_datos['total_venta_producto'];
			$subtotal                                   = $monto_deuda;

			$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal', mensaje = '$mensaje' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		} else {
			$total_monto_deuda_cuenta_cobrar            = $total_monto_deuda_cuenta_cobrar_db - $info_datos['total_venta_producto'];

			$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', mensaje = '$mensaje' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

			$data_sql = ("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar' WHERE cod_tercero = '$cod_tercero'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		}
	}
	//-------------------------------------------------------------------------------------------------------------------//
    $sql_existe_info_nota_credito = "SELECT * FROM tbl15_info_nota_credito WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_existe_info_nota_credito = mysqli_query($conectar, $sql_existe_info_nota_credito) or die(mysqli_error($conectar));
    $existe_info_nota_credito = mysqli_num_rows($consulta_existe_info_nota_credito);

	if ($existe_info_nota_credito == '0') {
		$agreg = "INSERT INTO tbl15_info_nota_credito (cod_factura_nota_credito, cod_info_factura_venta, cod_cufe, dataico_email_status, dataico_uuid, 
		dataico_issue_date, dataico_dian_messages, dataico_customer_status, 
		dataico_xml_url, dataico_validation_date, dataico_qrcode, dataico_xml, dataico_pdf_url, dataico_dian_status, dataico_invoice_type_code, dataico_dian_reason, 
		cod_factura, cod_resolucion_facturacion, cod_tercero, cod_caja_virtual, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, total_precio_compra, total_precio_venta, 
		cod_factura_antigua, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, fecha_creacion, tiempo_ejecucion_dian_dataico, 
		cod_cufe_viejo, dataico_email_status_viejo, dataico_uuid_viejo, dataico_issue_date_viejo, dataico_dian_messages_viejo, 
		dataico_payment_date_viejo, dataico_xml_url_viejo, dataico_customer_status_viejo, dataico_validation_date_viejo, 
		dataico_qrcode_viejo, dataico_xml_viejo, dataico_invoice_type_code_viejo, dataico_pdf_url_viejo, 
		dataico_dian_status_viejo, dataico_dian_error_viejo, dataico_dian_path_viejo) 
		VALUES ('$cod_factura_nota_credito', '$cod_info_factura_venta', '$cod_cufe', '$dataico_email_status', '$dataico_uuid', 
		'$dataico_issue_date', '$dataico_dian_messages', '$dataico_customer_status', 
		'$dataico_xml_url', '$dataico_validation_date', '$dataico_qrcode', '$dataico_xml', '$dataico_pdf_url', '$dataico_dian_status', '$dataico_invoice_type_code', '$dataico_dian_reason', 
		'$cod_factura', '$cod_resolucion_facturacion', '$cod_tercero', '$cod_caja_virtual', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$total_precio_compra', '$total_precio_venta', 
		'$cod_factura_antigua', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$fecha_creacion', '$tiempo_ejecucion_dian_dataico', 
		'$cod_cufe_viejo', '$dataico_email_status_viejo', '$dataico_uuid_viejo', '$dataico_issue_date_viejo', '$dataico_dian_messages_viejo', 
		'$dataico_payment_date_viejo', '$dataico_xml_url_viejo', '$dataico_customer_status_viejo', '$dataico_validation_date_viejo', 
		'$dataico_qrcode_viejo', '$dataico_xml_viejo', '$dataico_invoice_type_code_viejo', '$dataico_pdf_url_viejo', 
		'$dataico_dian_status_viejo', '$dataico_dian_error_viejo', '$dataico_dian_path_viejo')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
		$fecha_ymd                                             = $fecha_movimiento_contable_cuenta_personal;
		$fecha_seg                                             = time();
		$anyo                                                  = date("Y");
		$fecha_anyo                                            = $fecha_movimiento_contable_cuenta_personal;
		$fecha_anyo                                            = date("Y-m-d", strtotime($fecha_movimiento_contable_cuenta_personal));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_movimiento_contable_cuenta_personal));
		$fecha_seg                                             = time();
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_movimiento_contable_cuenta_personal));
		$anyo                                                  = date("Y", strtotime($fecha_movimiento_contable_cuenta_personal));

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '1470';
		$codigo_puc                                            = '4175';
		$nombre_puc                                            = 'DEVOLUCIONES EN VENTAS (DB)';
		$tipo_puc                                              = 'PASIVOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $total_venta_producto;
		$total_costo_movimiento_contable                       = $total_venta_producto;

		$sql_tercero = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
		$consulta_tercero = mysqli_query($conectar, $sql_tercero);
		$datos_tercero = mysqli_fetch_assoc($consulta_tercero);
		
		$cod_tercero                                           = $datos_tercero['cod_tercero'];
		$cliente                                               = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];
		$identificacion_tercero                                = $datos_tercero['identificacion_tercero'];

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $total_venta_producto;
		$saldo_actual_puc                                      = $total_venta_producto;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $total_venta_producto;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "-";
		$comentario                                            = $comentario.' - factura de venta: '.$cod_factura.' - cliente: '.$cliente.' - '.$nombre_producto.' ('.$cod_producto_barra.') - IDI: '.$cod_info_factura_venta.' - IDV: '.$cod_venta_producto;

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_venta, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_venta', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>">
<?php
}




















if ($tipo == 'eliminar' && $tab == 'tbl15_factura_compra_producto') {
	$llave                                                        = intval($_GET['llave']);
	$cod_factura_compra_producto                                  = intval($_GET['llave']);
	$origen_operacion                                             = 'compras';
	$fecha_devolucion                                             = date("Y-m-d");
	$hora_devolucion                                              = date("H:i:s");
	$fecha_time                                                   = time();

	$sql_datos = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
	cod_tipo_pago, cod_info_factura_compra, cod_factura, precio_costo_producto, precio_venta_producto, und_compra, iva_ptj, fecha_ymd_venta_producto, cuenta 
	FROM tbl15_factura_compra_producto WHERE (cod_factura_compra_producto = '$cod_factura_compra_producto')";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	$info_datos = mysqli_fetch_assoc($resultado_datos);

	$und_compra                                                   = $info_datos['und_compra']; 
	$cod_producto                                                 = $info_datos['cod_producto'];
	$cod_producto_barra                                           = $info_datos['cod_producto_barra'];
	$nombre_producto                                              = $info_datos['nombre_producto'];
	$cod_tercero                                                  = $info_datos['cod_tercero'];
	$precio_compra_producto                                       = $info_datos['precio_compra_producto'];
	$precio_costo_producto                                        = $info_datos['precio_costo_producto'];
	$precio_venta_producto                                        = $info_datos['precio_venta_producto'];
	$iva_ptj                                                      = $info_datos['iva_ptj'];
	$fecha_ymd_venta_producto                                     = $info_datos['fecha_ymd_venta_producto'];
	$vendedor                                                     = $info_datos['cuenta'];
	$cod_tipo_pago                                                = $info_datos['cod_tipo_pago'];
	$cod_info_factura_compra                                      = $info_datos['cod_info_factura_compra'];
	$cod_factura                                                  = $info_datos['cod_factura'];
	$total_costo_producto                                         = $info_datos['precio_costo_producto'] * $und_compra;
	$total_venta_producto                                         = $info_datos['precio_venta_producto'] * $und_compra;
	$unidades_vendidas                                            = $und_compra - $und_compra;
	$und_vend_orig                                                = $und_compra;
	$vlr_total_venta                                              = $precio_venta_producto * $und_compra;
	$vlr_total_compra                                             = $precio_compra_producto * $und_compra;
	$devoluciones                                                 = $und_compra;
	$comentario                                                   = 'devolucion compra btn elim inf';
	$fecha	                                                      = $fecha_time;
	$fecha_mes                                                    = date("Y-m");

	$sql_info_factura_compra = "SELECT cod_movimiento_caja, cod_movimiento_contable_cuenta_personal, cod_puc FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
	$info_info_factura_compra = mysqli_fetch_assoc($resultado_info_factura_compra);

	$cod_movimiento_caja                                          = $info_info_factura_compra['cod_movimiento_caja'];
	$cod_movimiento_contable_cuenta_personal                      = $info_info_factura_compra['cod_movimiento_contable_cuenta_personal'];
	$cod_puc_db                                                   = $info_info_factura_compra['cod_puc'];

	$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$sql_datos_venta_sum = "SELECT SUM(precio_compra_producto * und_compra) AS total_precio_compra, SUM(precio_venta_producto * und_compra) AS total_precio_venta 
	FROM tbl15_factura_compra_producto WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
	$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
	$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
	$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

	$total_precio_compra                  = $info_datos_venta_sum['total_precio_compra']; 
	$total_factura_compra_retefuente      = $total_precio_compra; 
	$total_precio_venta                   = $info_datos_venta_sum['total_precio_venta']; 

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_compra SET total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
	total_datos_data = '$total_datos_data' WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
	$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

	$und_producto_inv      = $info_datos_producto['und_producto']; 
	$und_producto          = $und_producto_inv - $und_compra;
	$und_inventario	       = $und_producto_inv;
	$und_nuevas            = $und_compra;

	$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
	$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

	$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 

	$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
	unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
	vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
	fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
	VALUES ('$cod_factura_compra_producto', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
	'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
	'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
	'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
	$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
		$fecha_ymd                                             = $fecha_movimiento_contable_cuenta_personal;
		$fecha_seg                                             = time();
		$anyo                                                  = date("Y");
		$fecha_anyo                                            = $fecha_movimiento_contable_cuenta_personal;

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '2360';
		$codigo_puc                                            = '6225';
		$nombre_puc                                            = 'DEVOLUCIONES EN COMPRAS (CR)';
		$tipo_puc                                              = 'PASIVOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $vlr_total_venta;
		$total_costo_movimiento_contable                       = $vlr_total_venta;

		$sql_tercero = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
		$consulta_tercero = mysqli_query($conectar, $sql_tercero);
		$datos_tercero = mysqli_fetch_assoc($consulta_tercero);
		
		$cod_tercero                                           = $datos_tercero['cod_tercero'];
		$cliente                                               = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];
		$identificacion_tercero                                = $datos_tercero['identificacion_tercero'];
	
		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $vlr_total_venta;
		$saldo_actual_puc                                      = $vlr_total_venta;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $vlr_total_venta;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "-";
		$comentario                                            = $comentario." - factura de compra: ".$cod_factura.' - proveedor: '.$cliente." - producto: ".$nombre_producto." (".$cod_producto_barra.")"." - ID: ".$cod_factura_compra_producto;

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_compra, simbolo_tipo_operacion, total_saldo)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_compra', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>">
<?php 
} 


if ($tipo == 'eliminar' && $tab == 'tbl15_info_factura_venta') {
	$llave                                           = intval($_GET['llave']);
	$cod_info_factura_venta                          = intval($_GET['llave']);

	$origen_operacion                                = 'ventas';
	$fecha_devolucion                                = date("Y-m-d");
	$hora_devolucion                                 = date("H:i:s");
	$fecha_time                                      = time();	
	$fecha_dia                                       = date("Y-m-d");
	$fecha_mes                                       = date("Y-m");
	$fecha_anyo                                      = date("Y-m-d");
	$anyo                                            = date("Y");
	$fecha_hora                                      = date("H:i:s");
	$fecha_creacion                                  = date("Y-m-d H:i:s");
	$comentario                                      = 'devolucion venta btn elim sup';
	$fecha	                                         = $fecha_time;
	$nombre_estado_factura_dataico_dian              = 'ANULADA';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_max_info_nota_credito = "SELECT MAX(cod_factura_nota_credito) AS cod_factura_nota_credito FROM tbl15_info_nota_credito";
	$resultado_max_info_nota_credito = mysqli_query($conectar, $sql_max_info_nota_credito);
	$info_max_info_nota_credito = mysqli_fetch_assoc($resultado_max_info_nota_credito);

	$cod_factura_nota_credito                        = $info_max_info_nota_credito['cod_factura_nota_credito'] + 1; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$prefijo_nota_credito                            = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_nota_credito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_credito'";
	$exec_autoincremento_info_nota_credito = mysqli_query($conectar, $sql_autoincremento_info_nota_credito) or die(mysqli_error($conectar));
	$datos_autoincremento_info_nota_credito = mysqli_fetch_assoc($exec_autoincremento_info_nota_credito);
	$cod_info_nota_credito = $datos_autoincremento_info_nota_credito['AUTO_INCREMENT'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_datos = "SELECT * FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

		$cod_venta_producto                           = $info_datos['cod_venta_producto']; 
		$cod_producto                                 = $info_datos['cod_producto']; 
		$cod_producto_barra                           = $info_datos['cod_producto_barra']; 
		$cod_producto_barra_madre                     = $info_datos['cod_producto_barra_madre']; 
		$cod_info_factura_venta                       = $info_datos['cod_info_factura_venta']; 
		$cod_factura                                  = $info_datos['cod_factura']; 
		$cod_tercero                                  = $info_datos['cod_tercero']; 
		$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
		$nombre_producto                              = $info_datos['nombre_producto']; 
		$und_venta                                    = $info_datos['und_venta']; 
		$precio_compra_producto                       = $info_datos['precio_compra_producto']; 
		$total_compra_producto                        = $info_datos['total_compra_producto']; 
		$precio_costo_producto                        = $info_datos['precio_costo_producto']; 
		$total_costo_producto                         = $info_datos['total_costo_producto']; 
		$precio_venta_producto                        = $info_datos['precio_venta_producto']; 
		$total_venta_producto                         = $info_datos['total_venta_producto']; 
		$precio_venta_producto_orig                   = $info_datos['precio_venta_producto_orig']; 
		$und_caja_sobre                               = $info_datos['und_caja_sobre']; 
		$cajas_sobre                                  = $info_datos['cajas_sobre']; 
		$nombre_tipo_und_caja_sobre                   = $info_datos['nombre_tipo_und_caja_sobre']; 
		$posologia_cantidad                           = $info_datos['posologia_cantidad']; 
		$posologia_peso                               = $info_datos['posologia_peso']; 
		$peso_producto                                = $info_datos['peso_producto']; 
		$unidad_medida_peso                           = $info_datos['unidad_medida_peso']; 
		$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
		$nombre_tipo_unidad_medida                    = $info_datos['nombre_tipo_unidad_medida']; 
		$nombre_tipo_presentacion                     = $info_datos['nombre_tipo_presentacion']; 
		$nombre_via_administracion                    = $info_datos['nombre_via_administracion']; 
		$nombre_frec_duracion                         = $info_datos['nombre_frec_duracion']; 
		$und_producto                                 = $info_datos['und_producto']; 
		$fecha_ymd_venta_producto                     = $info_datos['fecha_ymd_venta_producto']; 
		$fecha_mes_venta_producto                     = $info_datos['fecha_mes_venta_producto']; 
		$fecha_anyo_venta_producto                    = $info_datos['fecha_anyo_venta_producto']; 
		$fecha_hora_venta_producto                    = $info_datos['fecha_hora_venta_producto']; 
		$fecha_seg_venta_producto                     = $info_datos['fecha_seg_venta_producto']; 
		$fecha_alerta                                 = $info_datos['fecha_alerta']; 
		$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
		$cuenta                                       = $info_datos['cuenta']; 
		$cod_administrador                            = $info_datos['cod_administrador']; 
		$cod_base_caja                                = $info_datos['cod_base_caja']; 
		$cod_opcion_descontable_inv                   = $info_datos['cod_opcion_descontable_inv']; 
		$und_producto_inv                             = $info_datos['und_producto_inv']; 
		$und_producto_bodega_inv                      = $info_datos['und_producto_bodega_inv']; 
		$cod_tipo_cobrar                              = $info_datos['cod_tipo_cobrar']; 
		$descuento_ptj                                = $info_datos['descuento_ptj']; 
		$iva_ptj                                      = $info_datos['iva_ptj']; 
		$iva_saludable_ptj                            = $info_datos['iva_saludable_ptj']; 
		$ptj_imp_consumo                              = $info_datos['ptj_imp_consumo']; 
		$ptj_ret_iva                                  = $info_datos['ptj_ret_iva']; 
		$ptj_ret_ica                                  = $info_datos['ptj_ret_ica']; 
		$ptj_ret_fuente                               = $info_datos['ptj_ret_fuente']; 
		$ptj_ipc                                      = $info_datos['ptj_ipc']; 
		$precio_ipc_total                             = $info_datos['precio_ipc_total']; 
		$precio_ipc                                   = $info_datos['precio_ipc']; 
		$cod_factura_electronica                      = $info_datos['cod_factura_electronica']; 
		$cod_resolucion_facturacion                   = $info_datos['cod_resolucion_facturacion']; 
		$nombre_tipo_precio                           = $info_datos['nombre_tipo_precio']; 
		$nombre_tipo_precio_venta                     = $info_datos['nombre_tipo_precio_venta']; 
		$comision_ptj                                 = $info_datos['comision_ptj']; 
		$nombre_cliente                               = $info_datos['nombre_cliente']; 
		$cedula                                       = $info_datos['cedula']; 
		$nombre_empresa                               = $info_datos['nombre_empresa']; 
		$cod_empresa                                  = $info_datos['cod_empresa']; 
		$cod_cliente                                  = $info_datos['cod_cliente']; 
		$cod_historia_clinica                         = $info_datos['cod_historia_clinica']; 
		$cod_prioridad                                = $info_datos['cod_prioridad']; 
		//$cod_cufe                                     = $info_datos['cod_cufe']; 
		$cod_tipo_mantenimiento                       = $info_datos['cod_tipo_mantenimiento']; 
		$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
		$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
		$total_datos_data                             = $info_datos['total_datos_data']; 
		$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
		$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
		$vlr_cancelado                                = $info_datos['vlr_cancelado']; 
		$vlr_vuelto                                   = $info_datos['vlr_vuelto']; 
		$nombre_promocion                             = $info_datos['nombre_promocion']; 
		$nombre_promocion_ing                         = $info_datos['nombre_promocion_ing']; 
		$url_img_producto_min                         = $info_datos['url_img_producto_min']; 
		$url_img_producto_orig                        = $info_datos['url_img_producto_orig']; 
		$cod_categoria                                = $info_datos['cod_categoria']; 
		$cod_categoria_sub                            = $info_datos['cod_categoria_sub']; 
		$cod_estado                                   = $info_datos['cod_estado']; 
		$cod_dependencia                              = $info_datos['cod_dependencia']; 
		$cod_tipo_inventario                          = $info_datos['cod_tipo_inventario']; 
		$cod_tipo_pedido                              = $info_datos['cod_tipo_pedido']; 
		$cod_factura_compra_producto                  = $info_datos['cod_factura_compra_producto']; 
		$cod_tipo_producto_cocina                     = $info_datos['cod_tipo_producto_cocina']; 
		$cod_cierre_caja                              = $info_datos['cod_cierre_caja']; 
		$fecha_cierre_caja                            = $info_datos['fecha_cierre_caja']; 
		$hora_cierre_caja                             = $info_datos['hora_cierre_caja']; 
		$fecha_time_cierre_caja                       = $info_datos['fecha_time_cierre_caja']; 
		$comentario_producto                          = $info_datos['comentario_producto']; 
		$nombre_categoria                             = $info_datos['nombre_categoria']; 
		$nombre_categoria_sub                         = $info_datos['nombre_categoria_sub']; 
		$nombre_tipo_compra                           = $info_datos['nombre_tipo_compra']; 
		$placa_producto                               = $info_datos['placa_producto']; 
		$fecha_ymd_parqueo_ini                        = $info_datos['fecha_ymd_parqueo_ini']; 
		$fecha_hora_parqueo_ini                       = $info_datos['fecha_hora_parqueo_ini']; 
		$fecha_ymd_parqueo_fin                        = $info_datos['fecha_ymd_parqueo_fin']; 
		$fecha_hora_parqueo_fin                       = $info_datos['fecha_hora_parqueo_fin']; 
		$cod_info_parqueo_cotizacion_factura_venta    = $info_datos['cod_info_parqueo_cotizacion_factura_venta']; 
		$cod_parqueo_cotizacion_venta_producto        = $info_datos['cod_parqueo_cotizacion_venta_producto']; 
		$cod_info_hotel_cotizacion_factura_venta      = $info_datos['cod_info_hotel_cotizacion_factura_venta']; 
		$cod_hotel_cotizacion_venta_producto          = $info_datos['cod_hotel_cotizacion_venta_producto']; 
		$cod_tipo_metodo_envio                        = $info_datos['cod_tipo_metodo_envio']; 
		$cod_tipo_aplicacion                          = $info_datos['cod_tipo_aplicacion']; 
		$cod_zona_envio                               = $info_datos['cod_zona_envio']; 
		$cod_estado_cava                              = $info_datos['cod_estado_cava']; 
		$cod_dia_semana                               = $info_datos['cod_dia_semana']; 
		$cod_estado_check_factura_electronica         = $info_datos['cod_estado_check_factura_electronica']; 
		$cod_estado_factura_electronica_enviado_dian  = $info_datos['cod_estado_factura_electronica_enviado_dian']; 
		$cod_factura_antigua                          = $info_datos['cod_factura_antigua']; 
		$cod_venta_producto_temporal                  = $info_datos['cod_venta_producto_temporal']; 
		$cod_estado_habitacion_hotel                  = $info_datos['cod_estado_habitacion_hotel']; 
		$cod_tipo_habitacion_hotel                    = $info_datos['cod_tipo_habitacion_hotel']; 
		$cod_estado_tipo_hotel_parqueo                = $info_datos['cod_estado_tipo_hotel_parqueo']; 
		$total_horas                                  = $info_datos['total_horas']; 
		$total_dias                                   = $info_datos['total_dias']; 
		$cod_tipo_cod_barra                           = $info_datos['cod_tipo_cod_barra']; 
		$nombre_tipo_cobro                            = $info_datos['nombre_tipo_cobro']; 
		$fecha_cobro_renovacion                       = $info_datos['fecha_cobro_renovacion']; 
		$cod_puc                                      = $info_datos['cod_puc']; 
		$vendedor                                     = $info_datos['cuenta'];

		$total_costo_producto                         = $info_datos['precio_costo_producto'] * $und_venta;
		$total_venta_producto                         = $info_datos['precio_venta_producto'] * $und_venta;
		$unidades_vendidas                            = $und_venta - $und_venta;
		$und_vend_orig                                = $und_venta;
		$vlr_total_venta                              = $precio_venta_producto * $und_venta;
		$vlr_total_compra                             = $precio_compra_producto * $und_venta;
		$devoluciones                                 = $und_venta;

		$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
		$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

		$und_producto_inv                             = $info_datos_producto['und_producto']; 
		$und_producto                                 = $und_producto_inv + $und_venta;
		$und_inventario	                              = $und_producto_inv;
		$und_nuevas                                   = $und_venta;

		$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

		$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
		$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

		$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 

		$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_info_factura_venta, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
		unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
		vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
		fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
		VALUES ('$cod_venta_producto', '$cod_info_factura_venta', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
		'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
		'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
		'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
		$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
		$agregar_nota_credito = "INSERT INTO tbl15_nota_credito (cod_info_nota_credito, cod_info_factura_venta, cod_venta_producto, cod_producto, cod_producto_barra, cod_producto_barra_madre, 
		cod_factura, cod_tercero, cod_caja_virtual, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, 
		total_costo_producto, precio_venta_producto, total_venta_producto, precio_venta_producto_orig, und_caja_sobre, cajas_sobre, 
		nombre_tipo_und_caja_sobre, posologia_cantidad, posologia_peso, peso_producto, unidad_medida_peso, nombre_tipo_producto, 
		nombre_tipo_unidad_medida, nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, und_producto, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_hora_venta_producto, 
		fecha_seg_venta_producto, fecha_alerta, cod_estado_vacuna, cuenta, cod_administrador, cod_base_caja, 
		cod_opcion_descontable_inv, und_producto_inv, und_producto_bodega_inv, cod_tipo_cobrar, descuento_ptj, 
		iva_ptj, iva_saludable_ptj, ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, ptj_ipc, 
		precio_ipc_total, precio_ipc, cod_factura_electronica, cod_resolucion_facturacion, nombre_tipo_precio, 
		nombre_tipo_precio_venta, comision_ptj, nombre_cliente, cedula, nombre_empresa, cod_empresa, cod_cliente, 
		cod_historia_clinica, cod_prioridad, cod_tipo_mantenimiento, cod_tipo_pago, cod_tipo_forma_pago, 
		total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, nombre_promocion, 
		nombre_promocion_ing, url_img_producto_min, url_img_producto_orig, cod_categoria, cod_categoria_sub, 
		cod_estado, cod_dependencia, cod_tipo_inventario, cod_tipo_pedido, cod_factura_compra_producto, 
		cod_tipo_producto_cocina, cod_cierre_caja, fecha_cierre_caja, hora_cierre_caja, fecha_time_cierre_caja, 
		comentario_producto, nombre_categoria, nombre_categoria_sub, nombre_tipo_compra, placa_producto, 
		fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, 
		cod_info_parqueo_cotizacion_factura_venta, cod_parqueo_cotizacion_venta_producto, cod_info_hotel_cotizacion_factura_venta, 
		cod_hotel_cotizacion_venta_producto, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, 
		cod_estado_cava, cod_dia_semana, cod_estado_check_factura_electronica, cod_estado_factura_electronica_enviado_dian, 
		cod_factura_antigua, cod_venta_producto_temporal, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, 
		cod_estado_tipo_hotel_parqueo, total_horas, total_dias, cod_tipo_cod_barra, nombre_tipo_cobro, fecha_cobro_renovacion, cod_puc) 
		VALUES ('$cod_info_nota_credito', '$cod_info_factura_venta', '$cod_venta_producto', '$cod_producto', '$cod_producto_barra', '$cod_producto_barra_madre', 
		'$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', 
		'$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$precio_venta_producto_orig', '$und_caja_sobre', '$cajas_sobre', 
		'$nombre_tipo_und_caja_sobre', '$posologia_cantidad', '$posologia_peso', '$peso_producto', '$unidad_medida_peso', '$nombre_tipo_producto', 
		'$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$nombre_frec_duracion', '$und_producto', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_hora_venta_producto', 
		'$fecha_seg_venta_producto', '$fecha_alerta', '$cod_estado_vacuna', '$cuenta', '$cod_administrador', '$cod_base_caja', 
		'$cod_opcion_descontable_inv', '$und_producto_inv', '$und_producto_bodega_inv', '$cod_tipo_cobrar', '$descuento_ptj', 
		'$iva_ptj', '$iva_saludable_ptj', '$ptj_imp_consumo', '$ptj_ret_iva', '$ptj_ret_ica', '$ptj_ret_fuente', '$ptj_ipc', 
		'$precio_ipc_total', '$precio_ipc', '$cod_factura_electronica', '$cod_resolucion_facturacion', '$nombre_tipo_precio', 
		'$nombre_tipo_precio_venta', '$comision_ptj', '$nombre_cliente', '$cedula', '$nombre_empresa', '$cod_empresa', '$cod_cliente', 
		'$cod_historia_clinica', '$cod_prioridad', '$cod_tipo_mantenimiento', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
		'$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$nombre_promocion', 
		'$nombre_promocion_ing', '$url_img_producto_min', '$url_img_producto_orig', '$cod_categoria', '$cod_categoria_sub', 
		'$cod_estado', '$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_pedido', '$cod_factura_compra_producto', 
		'$cod_tipo_producto_cocina', '$cod_cierre_caja', '$fecha_cierre_caja', '$hora_cierre_caja', '$fecha_time_cierre_caja', 
		'$comentario_producto', '$nombre_categoria', '$nombre_categoria_sub', '$nombre_tipo_compra', '$placa_producto', 
		'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', 
		'$cod_info_parqueo_cotizacion_factura_venta', '$cod_parqueo_cotizacion_venta_producto', '$cod_info_hotel_cotizacion_factura_venta', 
		'$cod_hotel_cotizacion_venta_producto', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_zona_envio', 
		'$cod_estado_cava', '$cod_dia_semana', '$cod_estado_check_factura_electronica', '$cod_estado_factura_electronica_enviado_dian', 
		'$cod_factura_antigua', '$cod_venta_producto_temporal', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', 
		'$cod_estado_tipo_hotel_parqueo', '$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$nombre_tipo_cobro', '$fecha_cobro_renovacion', '$cod_puc')";
		$resultado_nota_crediton = mysqli_query($conectar, $agregar_nota_credito) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto WHERE cod_venta_producto = '$cod_venta_producto'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_factura                                     = $datos_info_factura_venta['cod_factura'];
    $cod_resolucion_facturacion                      = $datos_info_factura_venta['cod_resolucion_facturacion'];
    $cod_tercero                                     = $datos_info_factura_venta['cod_tercero'];
    $cod_caja_virtual                                = $datos_info_factura_venta['cod_caja_virtual'];
    $cod_tipo_pago                                   = $datos_info_factura_venta['cod_tipo_pago'];
    $cod_tipo_forma_pago                             = $datos_info_factura_venta['cod_tipo_forma_pago'];
    $nombre_tipo_factura                             = $datos_info_factura_venta['nombre_tipo_factura'];
    $total_precio_compra                             = $datos_info_factura_venta['total_precio_compra'];
    $total_precio_venta                              = $datos_info_factura_venta['total_precio_venta'];
    $cod_factura_antigua                             = $datos_info_factura_venta['cod_factura_antigua'];
	$cod_cufe                                        = $datos_info_factura_venta['cod_cufe'];
	$dataico_email_status                            = $datos_info_factura_venta['dataico_email_status'];
	$dataico_uuid                                    = $datos_info_factura_venta['dataico_uuid'];
	$dataico_issue_date                              = $datos_info_factura_venta['dataico_issue_date'];
	$dataico_dian_messages                           = $datos_info_factura_venta['dataico_dian_messages'];
	$dataico_xml_url                                 = $datos_info_factura_venta['dataico_xml_url'];
	$dataico_customer_status                         = $datos_info_factura_venta['dataico_customer_status'];
	$dataico_validation_date                         = $datos_info_factura_venta['dataico_validation_date'];
	$dataico_qrcode                                  = $datos_info_factura_venta['dataico_qrcode'];
	$dataico_xml                                     = $datos_info_factura_venta['dataico_xml'];
	$dataico_invoice_type_code                       = $datos_info_factura_venta['dataico_invoice_type_code'];
	$dataico_pdf_url                                 = $datos_info_factura_venta['dataico_pdf_url'];
	$dataico_dian_status                             = $datos_info_factura_venta['dataico_dian_status'];
	$cod_movimiento_caja                             = $datos_info_factura_venta['cod_movimiento_caja'];
	$cod_movimiento_contable_cuenta_personal         = $datos_info_factura_venta['cod_movimiento_contable_cuenta_personal'];
	$cod_puc_db                                      = $datos_info_factura_venta['cod_puc'];
	$cod_cuentas_cobrar                              = $datos_info_factura_venta['cod_cuentas_cobrar'];
	$nombre_estado_factura_dataico_dian              = $datos_info_factura_venta['nombre_estado_factura_dataico_dian'];
	$monto_deuda                                     = $total_precio_venta;
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_pago == '2' && $cod_cuentas_cobrar <> '0' && $nombre_estado_factura_dataico_dian == '') {
		$cod_estado_archivado                             = 1;
	
		$sql_cuentas_cobrar = "SELECT mensaje FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
		$consulta_cuentas_cobrar = mysqli_query($conectar, $sql_cuentas_cobrar) or die(mysqli_error($conectar));
		$matriz_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);

		$mensaje                                         = $matriz_cuentas_cobrar['mensaje'].' | '.'archivado por btn sup venta';

		$sql_info_tercero = "SELECT total_monto_deuda_cuenta_cobrar AS total_monto_deuda_cuenta_cobrar_db FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
		$consulta_info_tercero = mysqli_query($conectar, $sql_info_tercero) or die(mysqli_error($conectar));
		$matriz_info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

		$total_monto_deuda_cuenta_cobrar_db                 = $matriz_info_tercero['total_monto_deuda_cuenta_cobrar_db'];

		if ($codigo_tipo_modulo_cuenta_cobrar_defect_global == '0') {

			$data_sql = ("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', mensaje = '$mensaje' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

			$data_sql = ("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		} else {
			$total_monto_deuda_cuenta_cobrar               = $total_monto_deuda_cuenta_cobrar_db - $monto_deuda;

			$data_sql = ("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', mensaje = '$mensaje' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

			$data_sql = ("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

			$data_sql = ("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar' WHERE cod_tercero = '$cod_tercero'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		}
	}
	//-------------------------------------------------------------------------------------------------------------------//
	$nombre_estado_factura_dataico_dian              = 'ANULADA';
	$tiempo_final                                    = microtime(true);
	$tiempo_ejecucion_dian_dataico                   = $tiempo_final - $tiempo_inicial;
	//-------------------------------------------------------------------------------------------------------------------//
	$data_sql = ("UPDATE tbl15_info_factura_venta SET nombre_estado_factura_dataico_dian = '$nombre_estado_factura_dataico_dian' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	$agreg = "INSERT INTO tbl15_info_nota_credito (cod_info_factura_venta, cod_cufe, dataico_email_status, dataico_uuid, 
	dataico_issue_date, dataico_dian_messages, dataico_customer_status, 
	dataico_xml_url, dataico_validation_date, dataico_qrcode, dataico_xml, dataico_pdf_url, dataico_dian_status, dataico_invoice_type_code, 
	cod_factura, cod_resolucion_facturacion, cod_tercero, cod_caja_virtual, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, total_precio_compra, total_precio_venta, 
	cod_factura_antigua, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, fecha_creacion) 
	VALUES ('$cod_info_factura_venta', '$cod_cufe', '$dataico_email_status', '$dataico_uuid', 
	'$dataico_issue_date', '$dataico_dian_messages', '$dataico_customer_status', 
	'$dataico_xml_url', '$dataico_validation_date', '$dataico_qrcode', '$dataico_xml', '$dataico_pdf_url', '$dataico_dian_status', '$dataico_invoice_type_code', 
	'$cod_factura', '$cod_resolucion_facturacion', '$cod_tercero', '$cod_caja_virtual', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$total_precio_compra', '$total_precio_venta', 
	'$cod_factura_antigua', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$fecha_creacion')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
    //$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
    //$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '1470';
		$codigo_puc                                            = '4175';
		$nombre_puc                                            = 'DEVOLUCIONES EN VENTAS (DB)';
		$tipo_puc                                              = 'PASIVOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $monto_deuda;
		$total_costo_movimiento_contable                       = $monto_deuda;
		$fecha_anyo                                            = date("Y-m-d", strtotime($fecha_movimiento_contable_cuenta_personal));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_movimiento_contable_cuenta_personal));
		$fecha_seg                                             = time();
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_movimiento_contable_cuenta_personal));
		$anyo                                                  = date("Y", strtotime($fecha_movimiento_contable_cuenta_personal));

		$sql_tercero = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
		$consulta_tercero = mysqli_query($conectar, $sql_tercero);
		$datos_tercero = mysqli_fetch_assoc($consulta_tercero);
		
		$cod_tercero                                           = $datos_tercero['cod_tercero'];
		$cliente                                               = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];
		$identificacion_tercero                                = $datos_tercero['identificacion_tercero'];

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $monto_deuda;
		$saldo_actual_puc                                      = $monto_deuda;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $monto_deuda;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "-";
		$comentario                                            = $comentario." - factura de venta: ".$cod_factura." - cliente: ".$cliente." - IDI: ".$cod_info_factura_venta;

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_venta, simbolo_tipo_operacion, total_saldo)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_venta', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>">
<?php
}



if ($tipo == 'eliminar' && $tab == 'tbl15_cotizacion_venta_producto') {
$llave                                         = intval($_GET['llave']);
$cod_venta_producto                            = intval($_GET['llave']);
$cod_info_cotizacion_factura_venta             = intval($_GET['cod_info_cotizacion_factura_venta']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_cotizacion_venta_producto = "SELECT SUM(total_venta_producto) AS total_precio_venta FROM tbl15_cotizacion_venta_producto WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')";
$consulta_cotizacion_venta_producto = mysqli_query($conectar, $sql_cotizacion_venta_producto);
$datos_cotizacion_venta_producto = mysqli_fetch_assoc($consulta_cotizacion_venta_producto);

$total_precio_venta                 = $datos_cotizacion_venta_producto['total_precio_venta'];

$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET total_precio_venta = '$total_precio_venta' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_cotizacion_factura_venta=<?php echo $cod_info_cotizacion_factura_venta ?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_info_cotizacion_factura_venta') {
$llave                                    = intval($_GET['llave']);
$cod_info_cotizacion_factura_venta        = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_cotizacion_venta_producto WHERE cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_cotizacion_factura_venta=<?php echo $cod_info_cotizacion_factura_venta ?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_cotizacion_compra_producto') {
$llave                                      = intval($_GET['llave']);
$cod_cotizacion_compra_producto             = intval($_GET['llave']);
//$cod_cotizacion_compra_producto             = intval($_GET['cod_cotizacion_compra_producto']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_cotizacion_compra_producto=<?php echo $cod_cotizacion_compra_producto ?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_info_cotizacion_factura_compra') {
$llave                                      = intval($_GET['llave']);
$cod_info_cotizacion_factura_compra         = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_cotizacion_compra_producto WHERE cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_cotizacion_factura_compra=<?php echo $cod_info_cotizacion_factura_compra ?>">
<?php
}






if ($tipo == 'eliminar' && $tab == 'tbl15_info_parqueo_cotizacion_factura_venta') {
$llave                                    = intval($_GET['llave']);
$cod_info_parqueo_cotizacion_factura_venta        = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_parqueo_cotizacion_venta_producto WHERE cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_parqueo_cotizacion_factura_venta=<?php echo $cod_info_parqueo_cotizacion_factura_venta ?>">
<?php
}

if ($tipo == 'eliminar' && $tab == 'tbl15_mantenimiento_producto') {
$llave                          = intval($_GET['llave']);
$cod_venta_producto             = intval($_GET['llave']);
$origen_operacion               = 'mantenimiento';
$fecha_devolucion               = date("Y-m-d");
$hora_devolucion                = date("H:i:s");
$fecha_time                     = time();

$sql_datos = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
cod_tipo_pago, cod_info_factura_venta, cod_factura, precio_costo_producto, precio_venta_producto, und_venta, iva_ptj, fecha_ymd_venta_producto, fecha_hora_venta_producto, cuenta 
FROM tbl15_mantenimiento_producto WHERE cod_venta_producto = '$llave'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$und_venta                      = $info_datos['und_venta']; 
$cod_producto                   = $info_datos['cod_producto'];
$cod_producto_barra             = $info_datos['cod_producto_barra'];
$nombre_producto                = $info_datos['nombre_producto'];
$cod_tercero                    = $info_datos['cod_tercero'];
$precio_compra_producto         = $info_datos['precio_compra_producto'];
$precio_costo_producto          = $info_datos['precio_costo_producto'];
$precio_venta_producto          = $info_datos['precio_venta_producto'];
$iva_ptj                        = $info_datos['iva_ptj'];
$fecha_ymd_venta_producto       = $info_datos['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto      = $info_datos['fecha_hora_venta_producto'];
$vendedor                       = $info_datos['cuenta'];
$cod_tipo_pago                  = $info_datos['cod_tipo_pago'];
$cod_info_factura_venta         = $info_datos['cod_info_factura_venta'];
$cod_factura                    = $info_datos['cod_factura'];
$total_costo_producto           = $info_datos['precio_costo_producto'] * $und_venta;
$total_venta_producto           = $info_datos['precio_venta_producto'] * $und_venta;
$unidades_vendidas              = $und_venta;
$und_vend_orig                  = $und_venta;
$vlr_total_venta                = $precio_venta_producto * $und_venta;
$vlr_total_compra               = $precio_compra_producto * $und_venta;
$devoluciones                   = $und_venta;
$comentario                     = 'devolucion venta btn elim mant';
$fecha	                        = $fecha_time;
$fecha_mes                      = date("Y-m");

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_venta_producto * und_venta) AS total_precio_venta 
FROM tbl15_mantenimiento_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

$total_precio_compra      = $info_datos_venta_sum['total_precio_compra']; 
$total_precio_venta       = $info_datos_venta_sum['total_precio_venta']; 

$agregar_regis = sprintf("UPDATE tbl15_info_factura_mantenimiento SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
total_datos_data = '$total_datos_data' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

$und_producto_inv      = $info_datos_producto['und_producto']; 
$und_producto          = $und_producto_inv + $und_venta;
$und_inventario	       = $und_producto_inv;
$und_nuevas            = $und_venta;

//$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
//$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_venta_producto', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_venta_producto_eliminar_sin_devolucion') {
$llave                          = intval($_GET['llave']);
$cod_venta_producto             = intval($_GET['llave']);
$origen_operacion               = 'ventas';
$fecha_devolucion               = date("Y-m-d");
$hora_devolucion                = date("H:i:s");
$fecha_time                     = time();

$sql_datos = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tercero, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
cod_tipo_pago, cod_info_factura_venta, cod_factura, precio_costo_producto, precio_venta_producto, und_venta, iva_ptj, fecha_ymd_venta_producto, fecha_hora_venta_producto, cuenta 
FROM tbl15_venta_producto WHERE cod_venta_producto = '$llave'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$und_venta                      = $info_datos['und_venta']; 
$cod_producto                   = $info_datos['cod_producto'];
$cod_producto_barra             = $info_datos['cod_producto_barra'];
$nombre_producto                = $info_datos['nombre_producto'];
$cod_tercero                    = $info_datos['cod_tercero'];
$precio_compra_producto         = $info_datos['precio_compra_producto'];
$precio_costo_producto          = $info_datos['precio_costo_producto'];
$precio_venta_producto          = $info_datos['precio_venta_producto'];
$iva_ptj                        = $info_datos['iva_ptj'];
$fecha_ymd_venta_producto       = $info_datos['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto      = $info_datos['fecha_hora_venta_producto'];
$vendedor                       = $info_datos['cuenta'];
$cod_tipo_pago                  = $info_datos['cod_tipo_pago'];
$cod_info_factura_venta         = $info_datos['cod_info_factura_venta'];
$cod_factura                    = $info_datos['cod_factura'];
$total_costo_producto           = $info_datos['precio_costo_producto'] * $und_venta;
$total_venta_producto           = $info_datos['precio_venta_producto'] * $und_venta;
$unidades_vendidas              = $und_venta;
$und_vend_orig                  = $info_datos['und_venta'];
$vlr_total_venta                = $precio_venta_producto * $und_venta;
$vlr_total_compra               = $precio_compra_producto * $und_venta;
$devoluciones                   = $und_vend_orig - $und_venta;
$comentario                     = 'devolucion venta sin alterar inventario';
$fecha	                        = $fecha_time;
$fecha_mes                      = date("Y-m");

$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_datos_venta_sum = "SELECT SUM(precio_costo_producto * und_venta) AS total_precio_compra, SUM(precio_venta_producto * und_venta) AS total_precio_venta 
FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_datos_venta_sum = mysqli_query($conectar, $sql_datos_venta_sum);
$total_datos_data = mysqli_num_rows($resultado_datos_venta_sum);
$info_datos_venta_sum = mysqli_fetch_assoc($resultado_datos_venta_sum);

$total_precio_compra      = $info_datos_venta_sum['total_precio_compra']; 
$total_precio_venta       = $info_datos_venta_sum['total_precio_venta']; 

$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', 
total_datos_data = '$total_datos_data' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, vendedor, cuenta, fecha_time, comentario, fecha, fecha_mes) 
VALUES ('$cod_venta_producto', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

if ($cod_tipo_pago == '2') {
$sql_total_deuda_credito = "SELECT SUM(total_venta_producto) AS monto_deuda FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_total_deuda_credito = mysqli_query($conectar, $sql_total_deuda_credito) or die(mysqli_error($conectar));
$info_total_deuda_credito = mysqli_fetch_assoc($consulta_total_deuda_credito);

$monto_deuda                  = $info_total_deuda_credito['monto_deuda'];

$sql_total_abonado_credito = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_factura = '$cod_factura')";
$consulta_total_abonado_credito = mysqli_query($conectar, $sql_total_abonado_credito) or die(mysqli_error($conectar));
$info_total_abonado_credito = mysqli_fetch_assoc($consulta_total_abonado_credito);

$abonado                      = $info_total_abonado_credito['abonado'];
$subtotal                     = $monto_deuda - $abonado;

$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal', abonado = '$abonado' WHERE cod_factura = '$cod_factura'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_sticker_producto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_sticker FROM tbl15_sticker_producto_temporal WHERE (cod_sticker_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_sticker            = $datos_cod_info_impuesto_facturas['cod_info_factura_sticker'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_sticker_producto_temporal FROM tbl15_sticker_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_base_caja = '$cod_base_caja')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_sticker WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_sticker_producto') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_sticker FROM tbl15_sticker_producto WHERE (cod_sticker_producto = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_sticker            = $datos_cod_info_impuesto_facturas['cod_info_factura_sticker'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_sticker_producto FROM tbl15_sticker_producto WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_sticker WHERE (cod_info_factura_sticker = '$cod_info_factura_sticker')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT='0; <?php echo $pagina."?cod_info_factura_sticker=".$cod_info_factura_sticker ?>'>
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_administrador') {
$llave = addslashes($_GET['llave']);

$sql_datos = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$llave'";
$resultado_datos = mysqli_query($conectar, $sql_datos);
$info_datos = mysqli_fetch_assoc($resultado_datos);

$cod_administrador = $info_datos['cod_administrador']; 
$nombres = $info_datos['nombres']; 
$apellidos = $info_datos['apellidos']; 
$nombre_sexo = $info_datos['nombre_sexo']; 
$cuenta = $info_datos['cuenta']; 
$contrasena = $info_datos['contrasena']; 
$creador = $info_datos['creador'];
$correo = $info_datos['correo']; 
$cod_seguridad = $info_datos['cod_seguridad']; 
$cod_base_caja = $info_datos['cod_base_caja']; 
$estilo_css = $info_datos['estilo_css']; 
$fecha = $info_datos['fecha']; 
$fecha_hora = $info_datos['fecha_hora'];

$sql_data = "INSERT INTO tbl15_elim_administrador (cod_administrador, nombres, apellidos, nombre_sexo, cuenta, contrasena, creador, correo, cod_seguridad, cod_base_caja, 
estilo_css, fecha, fecha_hora) 
VALUES ('$cod_administrador', '$nombres', '$apellidos', '$nombre_sexo', '$cuenta', '$contrasena', '$creador', '$correo', '$cod_seguridad', '$cod_base_caja', 
'$estilo_css', '$fecha', '$fecha_hora')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));


$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_subproducto') {
$llave = addslashes($_GET['llave']);
$cod_producto_barra_madre = addslashes($_GET['cod_producto_barra_madre']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$pagina_redirec = $pagina.'?cod_producto_barra_madre='.$cod_producto_barra_madre.'&pagina='.$pagina;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar') {
	$cod_tercero                           = intval($_GET['llave']);
	$cod_estado_cuenta_cobrar              = 0;
	$total_monto_deuda_cuenta_cobrar       = 0;
	$total_subtotal_cuenta_cobrar          = 0;
	$total_abonado_cuenta_cobrar           = 0;
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");
	$fecha_elim                            = date("Y-m-d H:i:s");
	$usuario_elim                          = $cuenta;

	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

		$cod_cuentas_cobrar                = $datos_venta_producto_temporal['cod_cuentas_cobrar']; 
		$cod_factura                       = $datos_venta_producto_temporal['cod_factura']; 
		$cod_clientes                      = $datos_venta_producto_temporal['cod_clientes']; 
		$monto_deuda                       = $datos_venta_producto_temporal['monto_deuda']; 
		$monto_deuda_sin_interes           = $datos_venta_producto_temporal['monto_deuda_sin_interes']; 
		$subtotal                          = $datos_venta_producto_temporal['subtotal']; 
		$subtotal_sin_interes              = $datos_venta_producto_temporal['subtotal_sin_interes']; 
		$numero_cuota                      = $datos_venta_producto_temporal['numero_cuota']; 
		$monto_cuota                       = $datos_venta_producto_temporal['monto_cuota']; 
		$monto_cuota_sin_interes           = $datos_venta_producto_temporal['monto_cuota_sin_interes']; 	
		$interes_ptj                       = $datos_venta_producto_temporal['interes_ptj']; 
		$monto_deuda_mas_interes           = $datos_venta_producto_temporal['monto_deuda_mas_interes']; 
		$monto_cuota_interes               = $datos_venta_producto_temporal['monto_cuota_interes']; 
		$nombre_tipo_cobro                 = $datos_venta_producto_temporal['nombre_tipo_cobro']; 
		$cod_tipo_pago                     = $datos_venta_producto_temporal['cod_tipo_pago']; 
		$cod_tipo_forma_pago               = $datos_venta_producto_temporal['cod_tipo_forma_pago']; 
		$descuento                         = $datos_venta_producto_temporal['descuento']; 
		$abonado                           = $datos_venta_producto_temporal['abonado']; 
		$mensaje                           = $datos_venta_producto_temporal['mensaje']; 
		$vendedor                          = $datos_venta_producto_temporal['vendedor']; 
		$cuenta                            = $datos_venta_producto_temporal['cuenta']; 
		$fecha_pago                        = $datos_venta_producto_temporal['fecha_pago']; 
		$fecha                             = $datos_venta_producto_temporal['fecha']; 
		$fecha_mes                         = $datos_venta_producto_temporal['fecha_mes']; 
		$anyo                              = $datos_venta_producto_temporal['anyo']; 
		$fecha_invert                      = $datos_venta_producto_temporal['fecha_invert']; 
		$fecha_seg                         = $datos_venta_producto_temporal['fecha_seg']; 
		$fecha_creacion                    = $datos_venta_producto_temporal['fecha_creacion']; 
		$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta']; 
		$url_img_orig_producto             = $datos_venta_producto_temporal['url_img_orig_producto']; 
		$url_img_min_producto              = $datos_venta_producto_temporal['url_img_min_producto']; 
		$cod_tipo_calificacion             = $datos_venta_producto_temporal['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion          = $datos_venta_producto_temporal['nombre_tipo_calificacion']; 
		$cod_administrador                 = $datos_venta_producto_temporal['cod_administrador']; 
		$cod_estado                        = $datos_venta_producto_temporal['cod_estado'];

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, 
		numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, nombre_tipo_cobro, 
		cod_tipo_pago, cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
		fecha_seg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, 
		fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', 
		'$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$nombre_tipo_cobro', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
		'$fecha_seg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', 
		'$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

	$sql_pagar_abono = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_pagar_abono = mysqli_query($conectar, $sql_pagar_abono);
	while ($datos_pagar_abono = mysqli_fetch_assoc($consulta_pagar_abono)) { 	

		$cod_cuentas_cobrar_abonos         = $datos_pagar_abono['cod_cuentas_cobrar_abonos']; 
		$cod_cuentas_cobrar                = $datos_pagar_abono['cod_cuentas_cobrar']; 
		$cod_factura                       = $datos_pagar_abono['cod_factura']; 
		$cod_clientes                      = $datos_pagar_abono['cod_clientes']; 
		$cod_tercero                       = $datos_pagar_abono['cod_tercero']; 
		$monto_deuda                       = $datos_pagar_abono['monto_deuda']; 
		$subtotal                          = $datos_pagar_abono['subtotal']; 
		$descuento                         = $datos_pagar_abono['descuento']; 
		$abonado                           = $datos_pagar_abono['abonado']; 
		$mensaje                           = $datos_pagar_abono['mensaje']; 
		$cod_administrador                 = $datos_pagar_abono['cod_administrador']; 
		$vendedor                          = $datos_pagar_abono['vendedor']; 
		$cuenta                            = $datos_pagar_abono['cuenta']; 
		$cod_abono_global                  = $datos_pagar_abono['cod_abono_global']; 
		$fecha_pago                        = $datos_pagar_abono['fecha_pago']; 
		$fecha_anyo                        = $datos_pagar_abono['fecha_anyo']; 
		$fecha_mes                         = $datos_pagar_abono['fecha_mes']; 
		$anyo                              = $datos_pagar_abono['anyo']; 
		$fecha_invert                      = $datos_pagar_abono['fecha_invert']; 
		$fecha_seg                         = $datos_pagar_abono['fecha_seg']; 
		$hora                              = $datos_pagar_abono['hora']; 
		$fecha_creacion                    = $datos_pagar_abono['fecha_creacion']; 
		$cod_info_factura_venta            = $datos_pagar_abono['cod_info_factura_venta']; 
		$cod_estado                        = $datos_pagar_abono['cod_estado']; 
		$cod_tipo_forma_pago               = $datos_pagar_abono['cod_tipo_forma_pago']; 
		$cod_cuentas_cobrar_alerta         = $datos_pagar_abono['cod_cuentas_cobrar_alerta']; 
		$numero_alerta                     = $datos_pagar_abono['numero_alerta']; 
		$url_img_orig_producto             = $datos_pagar_abono['url_img_orig_producto']; 
		$url_img_min_producto              = $datos_pagar_abono['url_img_min_producto']; 
		$cod_tipo_calificacion             = $datos_pagar_abono['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion          = $datos_pagar_abono['nombre_tipo_calificacion']; 
		$cod_dependencia                   = $datos_pagar_abono['cod_dependencia']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, cod_administrador, 
		vendedor, cuenta, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_creacion, 
		cod_info_factura_venta, cod_estado, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, numero_alerta, url_img_orig_producto, 
		url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$cod_administrador', 
		'$vendedor', '$cuenta', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_creacion', 
		'$cod_info_factura_venta', '$cod_estado', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', '$numero_alerta', '$url_img_orig_producto', 
		'$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}
	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_archivar_por_factura') {
	$cod_cuentas_cobrar                    = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");
	$cod_estado_archivado                  = 1;

	$sql_datos = "SELECT cod_tercero FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	$info_datos = mysqli_fetch_assoc($resultado_datos);

	$cod_tercero                            = $info_datos['cod_tercero']; 

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado' WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado' WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_archivar_por_factura_dudoso_recaudo') {
	$cod_cuentas_cobrar                    = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");
	$cod_estado_archivado                  = 1;
	$cod_estado_archivado_dudoso_recaudo   = 1;

	$sql_datos = "SELECT cod_tercero FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	$info_datos = mysqli_fetch_assoc($resultado_datos);

	$cod_tercero                            = $info_datos['cod_tercero']; 

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_por_factura_desarchivar') {
	$cod_cuentas_cobrar                    = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");
	$cod_estado_archivado                  = 0;
	$cod_estado_archivado_dudoso_recaudo   = 0;

	$sql_datos = "SELECT cod_tercero FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	$info_datos = mysqli_fetch_assoc($resultado_datos);

	$cod_tercero                            = $info_datos['cod_tercero']; 

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_archivar_por_tercero') {
	$cod_tercero                           = intval($_GET['llave']);
	$cod_estado_archivado                  = 1;
	$cod_estado_cuenta_cobrar              = '';
	$total_monto_deuda_cuenta_cobrar       = '';
	$total_abonado_cuenta_cobrar           = '';
	$total_subtotal_cuenta_cobrar          = '';
	$fecha_modificacion_cuenta_cobrar      = '';

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado' WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado' WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_archivar_por_tercero_dudoso_recaudo') {
	$cod_tercero                           = intval($_GET['llave']);
	$cod_estado_archivado                  = 1;
	$cod_estado_archivado_dudoso_recaudo   = 1;
	$cod_estado_cuenta_cobrar              = '';
	$total_monto_deuda_cuenta_cobrar       = '';
	$total_abonado_cuenta_cobrar           = '';
	$total_subtotal_cuenta_cobrar          = '';
	$fecha_modificacion_cuenta_cobrar      = '';

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_desarchivar') {
	$cod_tercero                           = intval($_GET['llave']);
	$cod_estado_archivado                  = 0;
	$cod_estado_archivado_dudoso_recaudo   = 0;
	$cod_estado_cuenta_cobrar              = '';
	$total_monto_deuda_cuenta_cobrar       = '';
	$total_abonado_cuenta_cobrar           = '';
	$total_subtotal_cuenta_cobrar          = '';
	$fecha_modificacion_cuenta_cobrar      = '';

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', cod_estado_archivado_dudoso_recaudo = '$cod_estado_archivado_dudoso_recaudo' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$pagina_redirec                         = $pagina.'?cod_tercero='.$cod_tercero;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirec?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_por_factura') {
	$cod_cuentas_cobrar                    = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	$cod_cuentas_cobrar                = $datos_venta_producto_temporal['cod_cuentas_cobrar']; 
	$cod_factura                       = $datos_venta_producto_temporal['cod_factura'];
	$cod_tercero                       = $datos_venta_producto_temporal['cod_tercero'];
	$monto_deuda                       = $datos_venta_producto_temporal['monto_deuda']; 
	$monto_deuda_sin_interes           = $datos_venta_producto_temporal['monto_deuda_sin_interes']; 
	$subtotal                          = $datos_venta_producto_temporal['subtotal']; 
	$subtotal_sin_interes              = $datos_venta_producto_temporal['subtotal_sin_interes']; 
	$numero_cuota                      = $datos_venta_producto_temporal['numero_cuota']; 
	$monto_cuota                       = $datos_venta_producto_temporal['monto_cuota']; 
	$monto_cuota_sin_interes           = $datos_venta_producto_temporal['monto_cuota_sin_interes']; 	
	$interes_ptj                       = $datos_venta_producto_temporal['interes_ptj']; 
	$monto_deuda_mas_interes           = $datos_venta_producto_temporal['monto_deuda_mas_interes']; 
	$monto_cuota_interes               = $datos_venta_producto_temporal['monto_cuota_interes']; 
	$nombre_tipo_cobro                 = $datos_venta_producto_temporal['nombre_tipo_cobro']; 
	$cod_tipo_pago                     = $datos_venta_producto_temporal['cod_tipo_pago']; 
	$cod_tipo_forma_pago               = $datos_venta_producto_temporal['cod_tipo_forma_pago']; 
	$descuento                         = $datos_venta_producto_temporal['descuento']; 
	$abonado                           = $datos_venta_producto_temporal['abonado']; 
	$mensaje                           = $datos_venta_producto_temporal['mensaje']; 
	$vendedor                          = $datos_venta_producto_temporal['vendedor']; 
	$cuenta                            = $datos_venta_producto_temporal['cuenta']; 
	$fecha_pago                        = $datos_venta_producto_temporal['fecha_pago']; 
	$fecha                             = $datos_venta_producto_temporal['fecha']; 
	$fecha_mes                         = $datos_venta_producto_temporal['fecha_mes']; 
	$anyo                              = $datos_venta_producto_temporal['anyo']; 
	$fecha_invert                      = $datos_venta_producto_temporal['fecha_invert']; 
	$fecha_seg                         = $datos_venta_producto_temporal['fecha_seg']; 
	$fecha_creacion                    = $datos_venta_producto_temporal['fecha_creacion']; 
	$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta']; 
	$url_img_orig_producto             = $datos_venta_producto_temporal['url_img_orig_producto']; 
	$url_img_min_producto              = $datos_venta_producto_temporal['url_img_min_producto']; 
	$cod_tipo_calificacion             = $datos_venta_producto_temporal['cod_tipo_calificacion']; 
	$nombre_tipo_calificacion          = $datos_venta_producto_temporal['nombre_tipo_calificacion']; 
	$cod_administrador                 = $datos_venta_producto_temporal['cod_administrador']; 
	$cod_estado                        = $datos_venta_producto_temporal['cod_estado'];

	$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_tercero, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, 
	numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, nombre_tipo_cobro, 
	cod_tipo_pago, cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
	fecha_seg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', 
	'$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$nombre_tipo_cobro', 
	'$cod_tipo_pago', '$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
	'$fecha_seg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));


	$sql_pagar_abono = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_pagar_abono = mysqli_query($conectar, $sql_pagar_abono);
	while ($datos_pagar_abono = mysqli_fetch_assoc($consulta_pagar_abono)) { 	

		$cod_cuentas_cobrar_abonos         = $datos_pagar_abono['cod_cuentas_cobrar_abonos']; 
		$cod_cuentas_cobrar                = $datos_pagar_abono['cod_cuentas_cobrar']; 
		$cod_factura                       = $datos_pagar_abono['cod_factura']; 
		$cod_clientes                      = $datos_pagar_abono['cod_clientes']; 
		$cod_tercero                       = $datos_pagar_abono['cod_tercero']; 
		$monto_deuda                       = $datos_pagar_abono['monto_deuda']; 
		$subtotal                          = $datos_pagar_abono['subtotal']; 
		$descuento                         = $datos_pagar_abono['descuento']; 
		$abonado                           = $datos_pagar_abono['abonado']; 
		$mensaje                           = $datos_pagar_abono['mensaje']; 
		$cod_administrador                 = $datos_pagar_abono['cod_administrador']; 
		$vendedor                          = $datos_pagar_abono['vendedor']; 
		$cuenta                            = $datos_pagar_abono['cuenta']; 
		$cod_abono_global                  = $datos_pagar_abono['cod_abono_global']; 
		$fecha_pago                        = $datos_pagar_abono['fecha_pago']; 
		$fecha_anyo                        = $datos_pagar_abono['fecha_anyo']; 
		$fecha_mes                         = $datos_pagar_abono['fecha_mes']; 
		$anyo                              = $datos_pagar_abono['anyo']; 
		$fecha_invert                      = $datos_pagar_abono['fecha_invert']; 
		$fecha_seg                         = $datos_pagar_abono['fecha_seg']; 
		$hora                              = $datos_pagar_abono['hora']; 
		$fecha_creacion                    = $datos_pagar_abono['fecha_creacion']; 
		$cod_info_factura_venta            = $datos_pagar_abono['cod_info_factura_venta']; 
		$cod_estado                        = $datos_pagar_abono['cod_estado']; 
		$cod_tipo_forma_pago               = $datos_pagar_abono['cod_tipo_forma_pago']; 
		$cod_cuentas_cobrar_alerta         = $datos_pagar_abono['cod_cuentas_cobrar_alerta']; 
		$numero_alerta                     = $datos_pagar_abono['numero_alerta']; 
		$url_img_orig_producto             = $datos_pagar_abono['url_img_orig_producto']; 
		$url_img_min_producto              = $datos_pagar_abono['url_img_min_producto']; 
		$cod_tipo_calificacion             = $datos_pagar_abono['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion          = $datos_pagar_abono['nombre_tipo_calificacion']; 
		$cod_dependencia                   = $datos_pagar_abono['cod_dependencia']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, cod_administrador, 
		vendedor, cuenta, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_creacion, 
		cod_info_factura_venta, cod_estado, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, numero_alerta, url_img_orig_producto, 
		url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$cod_administrador', 
		'$vendedor', '$cuenta', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_creacion', 
		'$cod_info_factura_venta', '$cod_estado', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', '$numero_alerta', '$url_img_orig_producto', 
		'$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}






//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_por_abono_directa') {
	$cod_cuentas_cobrar_abonos             = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

	$sql_pagar_abono = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
	$consulta_pagar_abono = mysqli_query($conectar, $sql_pagar_abono);
	while ($datos_pagar_abono = mysqli_fetch_assoc($consulta_pagar_abono)) { 	

		$cod_cuentas_cobrar_abonos         = $datos_pagar_abono['cod_cuentas_cobrar_abonos']; 
		$cod_cuentas_cobrar                = $datos_pagar_abono['cod_cuentas_cobrar']; 
		$cod_factura                       = $datos_pagar_abono['cod_factura']; 
		$cod_clientes                      = $datos_pagar_abono['cod_clientes']; 
		$cod_tercero                       = $datos_pagar_abono['cod_tercero']; 
		$monto_deuda                       = $datos_pagar_abono['monto_deuda']; 
		$subtotal                          = $datos_pagar_abono['subtotal']; 
		$descuento                         = $datos_pagar_abono['descuento']; 
		$abonado                           = $datos_pagar_abono['abonado']; 
		$mensaje                           = $datos_pagar_abono['mensaje']; 
		$cod_administrador                 = $datos_pagar_abono['cod_administrador']; 
		$vendedor                          = $datos_pagar_abono['vendedor']; 
		$cuenta                            = $datos_pagar_abono['cuenta']; 
		$cod_abono_global                  = $datos_pagar_abono['cod_abono_global']; 
		$fecha_pago                        = $datos_pagar_abono['fecha_pago']; 
		$fecha_anyo                        = $datos_pagar_abono['fecha_anyo']; 
		$fecha_mes                         = $datos_pagar_abono['fecha_mes']; 
		$anyo                              = $datos_pagar_abono['anyo']; 
		$fecha_invert                      = $datos_pagar_abono['fecha_invert']; 
		$fecha_seg                         = $datos_pagar_abono['fecha_seg']; 
		$hora                              = $datos_pagar_abono['hora']; 
		$fecha_creacion                    = $datos_pagar_abono['fecha_creacion']; 
		$cod_info_factura_venta            = $datos_pagar_abono['cod_info_factura_venta']; 
		$cod_estado                        = $datos_pagar_abono['cod_estado']; 
		$cod_tipo_forma_pago               = $datos_pagar_abono['cod_tipo_forma_pago']; 
		$cod_cuentas_cobrar_alerta         = $datos_pagar_abono['cod_cuentas_cobrar_alerta']; 
		$numero_alerta                     = $datos_pagar_abono['numero_alerta']; 
		$url_img_orig_producto             = $datos_pagar_abono['url_img_orig_producto']; 
		$url_img_min_producto              = $datos_pagar_abono['url_img_min_producto']; 
		$cod_tipo_calificacion             = $datos_pagar_abono['cod_tipo_calificacion']; 
		$nombre_tipo_calificacion          = $datos_pagar_abono['nombre_tipo_calificacion']; 
		$cod_dependencia                   = $datos_pagar_abono['cod_dependencia']; 

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, cod_administrador, 
		vendedor, cuenta, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_creacion, 
		cod_info_factura_venta, cod_estado, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, numero_alerta, url_img_orig_producto, 
		url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$cod_administrador', 
		'$vendedor', '$cuenta', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_creacion', 
		'$cod_info_factura_venta', '$cod_estado', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', '$numero_alerta', '$url_img_orig_producto', 
		'$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}







//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_por_factura_directa') {
	$cod_cuentas_cobrar                    = intval($_GET['llave']);
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	$cod_cuentas_cobrar                = $datos_venta_producto_temporal['cod_cuentas_cobrar']; 
	$cod_factura                       = $datos_venta_producto_temporal['cod_factura'];
	$cod_tercero                       = $datos_venta_producto_temporal['cod_tercero'];
	$monto_deuda                       = $datos_venta_producto_temporal['monto_deuda']; 
	$monto_deuda_sin_interes           = $datos_venta_producto_temporal['monto_deuda_sin_interes']; 
	$subtotal                          = $datos_venta_producto_temporal['subtotal']; 
	$subtotal_sin_interes              = $datos_venta_producto_temporal['subtotal_sin_interes']; 
	$numero_cuota                      = $datos_venta_producto_temporal['numero_cuota']; 
	$monto_cuota                       = $datos_venta_producto_temporal['monto_cuota']; 
	$monto_cuota_sin_interes           = $datos_venta_producto_temporal['monto_cuota_sin_interes']; 	
	$interes_ptj                       = $datos_venta_producto_temporal['interes_ptj']; 
	$monto_deuda_mas_interes           = $datos_venta_producto_temporal['monto_deuda_mas_interes']; 
	$monto_cuota_interes               = $datos_venta_producto_temporal['monto_cuota_interes']; 
	$nombre_tipo_cobro                 = $datos_venta_producto_temporal['nombre_tipo_cobro']; 
	$cod_tipo_pago                     = $datos_venta_producto_temporal['cod_tipo_pago']; 
	$cod_tipo_forma_pago               = $datos_venta_producto_temporal['cod_tipo_forma_pago']; 
	$descuento                         = $datos_venta_producto_temporal['descuento']; 
	$abonado                           = $datos_venta_producto_temporal['abonado']; 
	$mensaje                           = $datos_venta_producto_temporal['mensaje']; 
	$vendedor                          = $datos_venta_producto_temporal['vendedor']; 
	$cuenta                            = $datos_venta_producto_temporal['cuenta']; 
	$fecha_pago                        = $datos_venta_producto_temporal['fecha_pago']; 
	$fecha                             = $datos_venta_producto_temporal['fecha']; 
	$fecha_mes                         = $datos_venta_producto_temporal['fecha_mes']; 
	$anyo                              = $datos_venta_producto_temporal['anyo']; 
	$fecha_invert                      = $datos_venta_producto_temporal['fecha_invert']; 
	$fecha_seg                         = $datos_venta_producto_temporal['fecha_seg']; 
	$fecha_creacion                    = $datos_venta_producto_temporal['fecha_creacion']; 
	$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta']; 
	$url_img_orig_producto             = $datos_venta_producto_temporal['url_img_orig_producto']; 
	$url_img_min_producto              = $datos_venta_producto_temporal['url_img_min_producto']; 
	$cod_tipo_calificacion             = $datos_venta_producto_temporal['cod_tipo_calificacion']; 
	$nombre_tipo_calificacion          = $datos_venta_producto_temporal['nombre_tipo_calificacion']; 
	$cod_administrador                 = $datos_venta_producto_temporal['cod_administrador']; 
	$cod_estado                        = $datos_venta_producto_temporal['cod_estado'];

	$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_tercero, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, 
	numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, nombre_tipo_cobro, 
	cod_tipo_pago, cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
	fecha_seg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', 
	'$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$nombre_tipo_cobro', 
	'$cod_tipo_pago', '$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
	'$fecha_seg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));


	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}









//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_pagar') {
	$cod_tercero                      = intval($_GET['llave']);

	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

		$cod_cuentas_pagar                 = $datos_venta_producto_temporal['cod_cuentas_pagar']; 
		$cod_factura                       = $datos_venta_producto_temporal['cod_factura']; 
		$cod_proveedores                   = $datos_venta_producto_temporal['cod_proveedores']; 
		$monto_deuda                       = $datos_venta_producto_temporal['monto_deuda']; 
		$subtotal                          = $datos_venta_producto_temporal['subtotal']; 
		$descuento                         = $datos_venta_producto_temporal['descuento']; 
		$abonado                           = $datos_venta_producto_temporal['abonado']; 
		$mensaje                           = $datos_venta_producto_temporal['mensaje']; 
		$vendedor                          = $datos_venta_producto_temporal['vendedor']; 
		$cuenta                            = $datos_venta_producto_temporal['cuenta']; 
		$fecha_pago                        = $datos_venta_producto_temporal['fecha_pago']; 
		$fecha                             = $datos_venta_producto_temporal['fecha']; 
		$fecha_invert                      = $datos_venta_producto_temporal['fecha_invert']; 
		$fecha_seg                         = $datos_venta_producto_temporal['fecha_seg']; 
		$cod_info_factura_compra           = $datos_venta_producto_temporal['cod_info_factura_compra'];
		$cod_abono_global                  = $datos_venta_producto_temporal['cod_abono_global']; 
		$cod_administrador                 = $datos_venta_producto_temporal['cod_administrador']; 
		$cod_estado                        = $datos_venta_producto_temporal['cod_estado'];  	
		 	
		$sql_data = "INSERT INTO tbl15_cuentas_pagar_copia (cod_cuentas_pagar, cod_factura, cod_proveedores, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, vendedor, 
		cuenta, fecha_pago, fecha, fecha_invert, fecha_seg, cod_info_factura_compra, cod_abono_global, cod_administrador, cod_estado) 
		VALUES ('$cod_cuentas_pagar', '$cod_factura', '$cod_proveedores', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$vendedor', 
		'$cuenta', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_info_factura_compra', '$cod_abono_global', '$cod_administrador', '$cod_estado')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_pagar WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

	$sql_pagar_abono = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_pagar_abono = mysqli_query($conectar, $sql_pagar_abono);
	while ($datos_pagar_abono = mysqli_fetch_assoc($consulta_pagar_abono)) { 
	 	
		$cod_cuentas_pagar_abonos          = $datos_pagar_abono['cod_cuentas_pagar_abonos']; 
		$cod_factura                       = $datos_pagar_abono['cod_factura']; 
		$cod_proveedores                   = $datos_pagar_abono['cod_proveedores']; 
		$monto_deuda                       = $datos_pagar_abono['monto_deuda']; 
		$subtotal                          = $datos_pagar_abono['subtotal']; 
		$descuento                         = $datos_pagar_abono['descuento']; 
		$abonado                           = $datos_pagar_abono['abonado']; 
		$mensaje                           = $datos_pagar_abono['mensaje']; 
		$vendedor                          = $datos_pagar_abono['vendedor']; 
		$cuenta                            = $datos_pagar_abono['cuenta']; 
		$fecha_pago                        = $datos_pagar_abono['fecha_pago']; 
		$fecha_anyo                        = $datos_pagar_abono['fecha_anyo']; 
		$fecha_mes                         = $datos_pagar_abono['fecha_mes']; 
		$anyo                              = $datos_pagar_abono['anyo']; 
		$fecha_invert                      = $datos_pagar_abono['fecha_invert'];
		$fecha_seg                         = $datos_pagar_abono['fecha_seg']; 
		$hora                              = $datos_pagar_abono['hora']; 
		$nombre_rete_fuente_ptj            = $datos_pagar_abono['nombre_rete_fuente_ptj'];  	
		$cod_cuentas_pagar                 = $datos_pagar_abono['cod_cuentas_pagar'];  	
		$cod_info_factura_compra           = $datos_pagar_abono['cod_info_factura_compra'];  	
		$cod_abono_global                  = $datos_pagar_abono['cod_abono_global'];  	
		$cod_administrador                 = $datos_pagar_abono['cod_administrador'];  	
		$cod_estado                        = $datos_pagar_abono['cod_estado'];  	
		$cod_tipo_forma_pago               = $datos_pagar_abono['cod_tipo_forma_pago'];  	
		$cod_dependencia                   = $datos_pagar_abono['cod_dependencia'];  	
			
		$sql_data = "INSERT INTO tbl15_cuentas_pagar_abonos_copia (cod_cuentas_pagar_abonos, cod_factura, cod_proveedores, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, vendedor, 
		cuenta, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, nombre_rete_fuente_ptj, cod_cuentas_pagar, 
		cod_info_factura_compra, cod_abono_global, cod_administrador, cod_estado, cod_tipo_forma_pago, cod_dependencia) 
		VALUES ('$cod_cuentas_pagar_abonos', '$cod_factura', '$cod_proveedores', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$vendedor', 
		'$cuenta', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$nombre_rete_fuente_ptj', '$cod_cuentas_pagar', 
		'$cod_info_factura_compra', '$cod_abono_global', '$cod_administrador', '$cod_estado', '$cod_tipo_forma_pago', '$cod_dependencia')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}





//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_egreso') {
$llave                 = addslashes($_GET['llave']);
$fecha_dmy_ini         = addslashes($_GET['fecha_dmy_ini']);
$fecha_dmy_fin         = addslashes($_GET['fecha_dmy_fin']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_egreso_movimiento_caja') {
	$cod_egreso            = intval($_GET['llave']);
	$fecha_dmy_ini         = addslashes($_GET['fecha_dmy_ini']);
	$fecha_dmy_fin         = addslashes($_GET['fecha_dmy_fin']);

	$sql_egreso_movimiento_caja = "SELECT cod_concepto_movimiento_caja, costo FROM tbl15_egreso WHERE (cod_egreso = '$cod_egreso')";
	$consulta_egreso_movimiento_caja = mysqli_query($conectar, $sql_egreso_movimiento_caja) or die(mysqli_error($conectar));
	$datos_egreso_movimiento_caja = mysqli_fetch_assoc($consulta_egreso_movimiento_caja);

	$cod_concepto_movimiento_caja         = $datos_egreso_movimiento_caja['cod_concepto_movimiento_caja'];
	$costo                                = $datos_egreso_movimiento_caja['costo'];

	$sql_concepto_movimiento_caja = "SELECT nombre_tipo_puc FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
	$consulta_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
	$datos_concepto_movimiento_caja = mysqli_fetch_assoc($consulta_concepto_movimiento_caja);

	$nombre_tipo_puc                      = $datos_concepto_movimiento_caja['nombre_tipo_puc'];

	$sql_movimiento_caja = "SELECT total_saldo FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '1')";
	$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
	$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

	$total_saldo                           = $datos_movimiento_caja['total_saldo'];

	if ($nombre_tipo_puc == 'INGRESO') {
		$total_saldo_final                     = $total_saldo - $costo;
	} else {
		$total_saldo_final                     = $total_saldo + $costo;
	}

	$agregar_regis = sprintf("UPDATE tbl15_movimiento_caja SET total_saldo = '$total_saldo_final' WHERE cod_movimiento_caja = '1'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_egreso WHERE cod_egreso = '$cod_egreso'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_egreso_ingreso') {
$llave                 = addslashes($_GET['llave']);
$fecha_dmy_ini         = addslashes($_GET['fecha_dmy_ini']);
$fecha_dmy_fin         = addslashes($_GET['fecha_dmy_fin']);
$cod_tipo_forma_pago   = intval($_POST['cod_tipo_forma_pago']);
$nombre_tipo_puc       = addslashes($_POST['nombre_tipo_puc']);
$cod_dependencia       = intval($_POST['cod_dependencia']);

$borrar_sql = sprintf("DELETE FROM tbl15_egreso WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_gastos_tabla') {
$llave = addslashes($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_movimiento_contable') {
$llave                               = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_movimiento_contable_temporal_concepto WHERE (cod_movimiento_contable = '$llave')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$pagina_redirect = $pagina.'?cod_movimiento_contable='.$llave;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_movimiento_contable_temporal_concepto') {
$llave                               = intval($_GET['llave']);
$cod_movimiento_contable             = intval($_GET['cod_movimiento_contable']);

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$pagina_redirect = $pagina.'?cod_movimiento_contable='.$cod_movimiento_contable;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_movimiento_contable_concepto') {
$llave                               = intval($_GET['llave']);
$cod_movimiento_contable             = intval($_GET['cod_movimiento_contable']);

$sql_insert = "INSERT INTO tbl15_movimiento_contable_concepto_copia (cod_movimiento_contable_concepto, cod_movimiento_contable, nombre_tipo_movimiento, nombre_tipo_documento, 
codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, 
fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, cod_guia) 
SELECT cod_movimiento_contable_concepto, cod_movimiento_contable, nombre_tipo_movimiento, nombre_tipo_documento, 
codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, 
fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, cod_guia 
FROM tbl15_movimiento_contable_concepto WHERE $campo = '$llave'";
$result_insert = mysqli_query($conectar, $sql_insert) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_datos_concepto = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable FROM tbl15_movimiento_contable_concepto WHERE (cod_movimiento_contable = '$cod_movimiento_contable')";
$resultado_datos_concepto = mysqli_query($conectar, $sql_datos_concepto);
$info_datos_concepto = mysqli_fetch_assoc($resultado_datos_concepto);

$total_costo_movimiento_contable = $info_datos_concepto['total_costo_movimiento_contable']; 

$data_sql = ("UPDATE tbl15_movimiento_contable SET total_costo_movimiento_contable = '$total_costo_movimiento_contable' WHERE (cod_movimiento_contable = '$cod_movimiento_contable')");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$pagina_redirect = $pagina.'?cod_movimiento_contable='.$cod_movimiento_contable;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_parqueo_cotizacion_venta_producto_temporal') {
$llave = addslashes($_GET['llave']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_parqueo_cotizacion_factura_venta FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cod_parqueo_cotizacion_venta_producto_temporal = '$llave')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_parqueo_cotizacion_factura_venta            = $datos_cod_info_impuesto_facturas['cod_info_parqueo_cotizacion_factura_venta'];

$borrar_sql = sprintf("DELETE FROM $tab WHERE $campo = '$llave'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$datos_info_factura_cero = "SELECT cod_parqueo_cotizacion_venta_producto_temporal FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_parqueo_cotizacion_factura_venta WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}

//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_eliminar_inmobiliaria') {
$cod_cuentas_cobrar                 = intval($_GET['llave']);
$pagina                             = '../admin/lista_cuentas_cobrar_historial_alquiler.php';
$fecha_elim                         = date("Y-m-d H:i:s");	
$usuario_elim                       = $cuenta_actual;

$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

$cod_cuentas_cobrar                           = $datos_venta_producto_temporal['cod_cuentas_cobrar']; 
$cod_factura                                  = $datos_venta_producto_temporal['cod_factura']; 
$cod_clientes                                 = $datos_venta_producto_temporal['cod_clientes']; 
$cod_tercero                                  = $datos_venta_producto_temporal['cod_tercero']; 
$cod_producto                                 = $datos_venta_producto_temporal['cod_producto']; 
$cod_producto_barra                           = $datos_venta_producto_temporal['cod_producto_barra']; 
$nombre_producto                              = $datos_venta_producto_temporal['nombre_producto']; 
$monto_deuda                                  = $datos_venta_producto_temporal['monto_deuda']; 
$monto_deuda_sin_interes                      = $datos_venta_producto_temporal['monto_deuda_sin_interes']; 
$subtotal                                     = $datos_venta_producto_temporal['subtotal']; 
$subtotal_sin_interes                         = $datos_venta_producto_temporal['subtotal_sin_interes']; 
$numero_cuota                                 = $datos_venta_producto_temporal['numero_cuota']; 
$monto_cuota                                  = $datos_venta_producto_temporal['monto_cuota']; 
$monto_cuota_sin_interes                      = $datos_venta_producto_temporal['monto_cuota_sin_interes']; 
$interes_ptj                                  = $datos_venta_producto_temporal['interes_ptj']; 
$monto_deuda_mas_interes                      = $datos_venta_producto_temporal['monto_deuda_mas_interes']; 
$monto_cuota_interes                          = $datos_venta_producto_temporal['monto_cuota_interes']; 
$total_recibido                               = $datos_venta_producto_temporal['total_recibido']; 
$total_pendiente                              = $datos_venta_producto_temporal['total_pendiente']; 
$nombre_tipo_cobro                            = $datos_venta_producto_temporal['nombre_tipo_cobro']; 
$cod_tipo_pago                                = $datos_venta_producto_temporal['cod_tipo_pago']; 
$cod_tipo_forma_pago                          = $datos_venta_producto_temporal['cod_tipo_forma_pago']; 
$descuento                                    = $datos_venta_producto_temporal['descuento']; 
$abonado                                      = $datos_venta_producto_temporal['abonado']; 
$mensaje                                      = $datos_venta_producto_temporal['mensaje']; 
$vendedor                                     = $datos_venta_producto_temporal['vendedor']; 
$cuenta                                       = $datos_venta_producto_temporal['cuenta']; 
$deduccion_retefuente                         = $datos_venta_producto_temporal['deduccion_retefuente']; 
$deduccion_reparacion                         = $datos_venta_producto_temporal['deduccion_reparacion']; 
$deduccion_servicio                           = $datos_venta_producto_temporal['deduccion_servicio']; 
$deduccion_otro_impuesto_dian                 = $datos_venta_producto_temporal['deduccion_otro_impuesto_dian']; 
$deduccion_otro_concepto                      = $datos_venta_producto_temporal['deduccion_otro_concepto'];
$deduccion_servicio_energia                   = $datos_venta_producto_temporal['deduccion_servicio_energia'];
$deduccion_servicio_agua                      = $datos_venta_producto_temporal['deduccion_servicio_agua'];
$deduccion_servicio_gas                       = $datos_venta_producto_temporal['deduccion_servicio_gas'];
$deduccion_deudas_anteriores                  = $datos_venta_producto_temporal['deduccion_deudas_anteriores'];
$ingreso_administracion_incluida              = $datos_venta_producto_temporal['ingreso_administracion_incluida']; 
$ingreso_gasto_juridica                       = $datos_venta_producto_temporal['ingreso_gasto_juridica']; 
$deduccion_saldo_favor                        = $datos_venta_producto_temporal['deduccion_saldo_favor']; 
$ingreso_otro_concepto                        = $datos_venta_producto_temporal['ingreso_otro_concepto']; 
$ingreso_deudas_anteriores                    = $datos_venta_producto_temporal['ingreso_deudas_anteriores']; 
$numero_deudas_anteriores                     = $datos_venta_producto_temporal['numero_deudas_anteriores']; 
$total_deduccion                              = $datos_venta_producto_temporal['total_deduccion']; 
$total_ingreso                                = $datos_venta_producto_temporal['total_ingreso']; 
$fecha_reg                                    = $datos_venta_producto_temporal['fecha_reg']; 
$fecha_pago                                   = $datos_venta_producto_temporal['fecha_pago']; 
$fecha                                        = $datos_venta_producto_temporal['fecha']; 
$fecha_mes                                    = $datos_venta_producto_temporal['fecha_mes']; 
$anyo                                         = $datos_venta_producto_temporal['anyo']; 
$fecha_invert                                 = $datos_venta_producto_temporal['fecha_invert']; 
$fecha_seg                                    = $datos_venta_producto_temporal['fecha_seg']; 
$fecha_creacion                               = $datos_venta_producto_temporal['fecha_creacion']; 
$cod_info_factura_venta                       = $datos_venta_producto_temporal['cod_info_factura_venta']; 
$url_img_orig_producto                        = $datos_venta_producto_temporal['url_img_orig_producto']; 
$url_img_min_producto                         = $datos_venta_producto_temporal['url_img_min_producto']; 
$cod_tipo_calificacion                        = $datos_venta_producto_temporal['cod_tipo_calificacion']; 
$nombre_tipo_calificacion                     = $datos_venta_producto_temporal['nombre_tipo_calificacion']; 
$cod_administrador                            = $datos_venta_producto_temporal['cod_administrador']; 
$cod_estado                                   = $datos_venta_producto_temporal['cod_estado']; 
$nombre1_tercero                              = $datos_venta_producto_temporal['nombre1_tercero']; 
$nombre2_tercero                              = $datos_venta_producto_temporal['nombre2_tercero']; 
$apellido1_tercero                            = $datos_venta_producto_temporal['apellido1_tercero']; 
$apellido2_tercero                            = $datos_venta_producto_temporal['apellido2_tercero']; 
$identificacion_tercero                       = $datos_venta_producto_temporal['identificacion_tercero']; 
$fecha_nac_tercero                            = $datos_venta_producto_temporal['fecha_nac_tercero']; 
$direccion_tercero                            = $datos_venta_producto_temporal['direccion_tercero']; 
$telefono1_tercero                            = $datos_venta_producto_temporal['telefono1_tercero']; 
$correo_tercero                               = $datos_venta_producto_temporal['correo_tercero']; 
$fecha_entrega                                = $datos_venta_producto_temporal['fecha_entrega']; 
$hora_entrega                                 = $datos_venta_producto_temporal['hora_entrega']; 
$cod_tipo_moneda                              = $datos_venta_producto_temporal['cod_tipo_moneda']; 
$clausula_alquiler                            = $datos_venta_producto_temporal['clausula_alquiler']; 
$cod_estado_contrato                          = $datos_venta_producto_temporal['cod_estado_contrato']; 
$cod_estado_renovacio_contrato                = $datos_venta_producto_temporal['cod_estado_renovacio_contrato']; 

$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, monto_deuda, 
monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, 
monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, nombre_tipo_cobro, cod_tipo_pago, 
cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, 
deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, 
deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, ingreso_administracion_incluida, 
ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, 
numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_reg, fecha_pago, fecha, fecha_mes, anyo, 
fecha_invert, fecha_seg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, 
cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, nombre1_tercero, nombre2_tercero, 
apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, 
telefono1_tercero, correo_tercero, fecha_entrega, hora_entrega, cod_tipo_moneda, clausula_alquiler, 
cod_estado_contrato, cod_estado_renovacio_contrato, fecha_elim, usuario_elim) 
VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', 
'$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', 
'$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', '$nombre_tipo_cobro', '$cod_tipo_pago', 
'$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', 
'$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', 
'$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', 
'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', 
'$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_reg', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', 
'$fecha_invert', '$fecha_seg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', 
'$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', '$nombre1_tercero', '$nombre2_tercero', 
'$apellido1_tercero', '$apellido2_tercero', '$identificacion_tercero', '$fecha_nac_tercero', '$direccion_tercero', 
'$telefono1_tercero', '$correo_tercero', '$fecha_entrega', '$hora_entrega', '$cod_tipo_moneda', '$clausula_alquiler', 
'$cod_estado_contrato', '$cod_estado_renovacio_contrato', '$fecha_elim', '$usuario_elim')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos);
while ($datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos)) { 	

$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos']; 
$cod_cuentas_cobrar                           = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar']; 
$cod_factura                                  = $datos_cuentas_cobrar_abonos['cod_factura']; 
$cod_clientes                                 = $datos_cuentas_cobrar_abonos['cod_clientes']; 
$cod_tercero                                  = $datos_cuentas_cobrar_abonos['cod_tercero']; 
$cod_producto                                 = $datos_cuentas_cobrar_abonos['cod_producto']; 
$cod_producto_barra                           = $datos_cuentas_cobrar_abonos['cod_producto_barra']; 
$nombre_producto                              = $datos_cuentas_cobrar_abonos['nombre_producto']; 
$monto_deuda                                  = $datos_cuentas_cobrar_abonos['monto_deuda']; 
$subtotal                                     = $datos_cuentas_cobrar_abonos['subtotal']; 
$descuento                                    = $datos_cuentas_cobrar_abonos['descuento']; 
$abonado                                      = $datos_cuentas_cobrar_abonos['abonado']; 
$total_pagar                                  = $datos_cuentas_cobrar_abonos['total_pagar']; 
$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_sin_interes']; 
$subtotal_sin_interes                         = $datos_cuentas_cobrar_abonos['subtotal_sin_interes']; 
$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_abonos['monto_cuota_sin_interes']; 
$total_recibido                               = $datos_cuentas_cobrar_abonos['total_recibido']; 
$total_pendiente                              = $datos_cuentas_cobrar_abonos['total_pendiente']; 
$interes_ptj                                  = $datos_cuentas_cobrar_abonos['interes_ptj']; 
$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_abonos['monto_deuda_mas_interes']; 
$monto_cuota_interes                          = $datos_cuentas_cobrar_abonos['monto_cuota_interes']; 
$mensaje                                      = $datos_cuentas_cobrar_abonos['mensaje']; 
$cod_administrador                            = $datos_cuentas_cobrar_abonos['cod_administrador']; 
$vendedor                                     = $datos_cuentas_cobrar_abonos['vendedor']; 
$cuenta                                       = $datos_cuentas_cobrar_abonos['cuenta']; 
$deduccion_retefuente                         = $datos_cuentas_cobrar_abonos['deduccion_retefuente']; 
$deduccion_reparacion                         = $datos_cuentas_cobrar_abonos['deduccion_reparacion']; 
$deduccion_servicio                           = $datos_cuentas_cobrar_abonos['deduccion_servicio']; 
$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian']; 
$deduccion_otro_concepto                      = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto']; 
$deduccion_servicio_energia                   = $datos_cuentas_cobrar_abonos['deduccion_servicio_energia']; 
$deduccion_servicio_agua                      = $datos_cuentas_cobrar_abonos['deduccion_servicio_agua']; 
$deduccion_servicio_gas                       = $datos_cuentas_cobrar_abonos['deduccion_servicio_gas']; 
$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_abonos['deduccion_deudas_anteriores']; 
$ingreso_administracion_incluida              = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida']; 
$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_abonos['ingreso_gasto_juridica']; 
$deduccion_saldo_favor                        = $datos_cuentas_cobrar_abonos['deduccion_saldo_favor']; 
$ingreso_otro_concepto                        = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto']; 
$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_abonos['ingreso_deudas_anteriores']; 
$numero_deudas_anteriores                     = $datos_cuentas_cobrar_abonos['numero_deudas_anteriores']; 
$total_deduccion                              = $datos_cuentas_cobrar_abonos['total_deduccion']; 
$total_ingreso                                = $datos_cuentas_cobrar_abonos['total_ingreso']; 
$cod_abono_global                             = $datos_cuentas_cobrar_abonos['cod_abono_global']; 
$fecha_pago                                   = $datos_cuentas_cobrar_abonos['fecha_pago']; 
$fecha_anyo                                   = $datos_cuentas_cobrar_abonos['fecha_anyo']; 
$fecha_mes                                    = $datos_cuentas_cobrar_abonos['fecha_mes']; 
$anyo                                         = $datos_cuentas_cobrar_abonos['anyo']; 
$fecha_invert                                 = $datos_cuentas_cobrar_abonos['fecha_invert']; 
$fecha_seg                                    = $datos_cuentas_cobrar_abonos['fecha_seg']; 
$hora                                         = $datos_cuentas_cobrar_abonos['hora']; 
$fecha_pago_deuda                             = $datos_cuentas_cobrar_abonos['fecha_pago_deuda']; 
$fecha_pago_reg                               = $datos_cuentas_cobrar_abonos['fecha_pago_reg']; 
$hora_pago_reg                                = $datos_cuentas_cobrar_abonos['hora_pago_reg']; 
$fecha_creacion                               = $datos_cuentas_cobrar_abonos['fecha_creacion']; 
$cod_info_factura_venta                       = $datos_cuentas_cobrar_abonos['cod_info_factura_venta']; 
$cod_estado                                   = $datos_cuentas_cobrar_abonos['cod_estado']; 
$cod_estado_contrato                          = $datos_cuentas_cobrar_abonos['cod_estado_contrato']; 
$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago']; 
$cod_cuentas_cobrar_alerta                    = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta']; 
$numero_alerta                                = $datos_cuentas_cobrar_abonos['numero_alerta']; 
$url_img_orig_producto                        = $datos_cuentas_cobrar_abonos['url_img_orig_producto']; 
$url_img_min_producto                         = $datos_cuentas_cobrar_abonos['url_img_min_producto']; 
$cod_tipo_calificacion                        = $datos_cuentas_cobrar_abonos['cod_tipo_calificacion']; 
$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_abonos['nombre_tipo_calificacion']; 
$cod_dependencia                              = $datos_cuentas_cobrar_abonos['cod_dependencia']; 
$cod_tipo_moneda                              = $datos_cuentas_cobrar_abonos['cod_tipo_moneda']; 
$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_cuenta_cobro']; 
$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_abonos['cod_estado_renovacio_contrato']; 

$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, 
monto_deuda, subtotal, descuento, abonado, total_pagar, monto_deuda_sin_interes, subtotal_sin_interes, monto_cuota_sin_interes, 
total_recibido, total_pendiente, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, mensaje, cod_administrador, vendedor, 
cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, 
deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, ingreso_administracion_incluida, 
ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, 
total_ingreso, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_pago_deuda, fecha_pago_reg, 
hora_pago_reg, fecha_creacion, cod_info_factura_venta, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, 
numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, cod_tipo_moneda, 
cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, fecha_elim, usuario_elim) 
VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
'$monto_deuda', '$subtotal', '$descuento', '$abonado', '$total_pagar', '$monto_deuda_sin_interes', '$subtotal_sin_interes', '$monto_cuota_sin_interes', 
'$total_recibido', '$total_pendiente', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$mensaje', '$cod_administrador', '$vendedor', 
'$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', 
'$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', 
'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', 
'$total_ingreso', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_pago_deuda', '$fecha_pago_reg', 
'$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', 
'$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia', '$cod_tipo_moneda', 
'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$fecha_elim', '$usuario_elim')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
//----------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
while ($datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta)) { 	

$cod_cuentas_cobrar_alerta                    = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta']; 
$cod_cuentas_cobrar                           = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar']; 
$cod_cuentas_cobrar_abonos                    = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos']; 
$numero_alerta                                = $datos_cuentas_cobrar_alerta['numero_alerta']; 
$cod_factura                                  = $datos_cuentas_cobrar_alerta['cod_factura']; 
$cod_clientes                                 = $datos_cuentas_cobrar_alerta['cod_clientes']; 
$cod_tercero                                  = $datos_cuentas_cobrar_alerta['cod_tercero']; 
$cod_producto                                 = $datos_cuentas_cobrar_alerta['cod_producto']; 
$cod_producto_barra                           = $datos_cuentas_cobrar_alerta['cod_producto_barra']; 
$nombre_producto                              = $datos_cuentas_cobrar_alerta['nombre_producto']; 
$monto_deuda                                  = $datos_cuentas_cobrar_alerta['monto_deuda']; 
$monto_deuda_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_sin_interes']; 
$subtotal                                     = $datos_cuentas_cobrar_alerta['subtotal']; 
$subtotal_sin_interes                         = $datos_cuentas_cobrar_alerta['subtotal_sin_interes']; 
$numero_cuota                                 = $datos_cuentas_cobrar_alerta['numero_cuota']; 
$monto_cuota                                  = $datos_cuentas_cobrar_alerta['monto_cuota']; 
$monto_cuota_sin_interes                      = $datos_cuentas_cobrar_alerta['monto_cuota_sin_interes']; 
$interes_ptj                                  = $datos_cuentas_cobrar_alerta['interes_ptj']; 
$monto_deuda_mas_interes                      = $datos_cuentas_cobrar_alerta['monto_deuda_mas_interes']; 
$monto_cuota_interes                          = $datos_cuentas_cobrar_alerta['monto_cuota_interes']; 
$total_recibido                               = $datos_cuentas_cobrar_alerta['total_recibido']; 
$total_pendiente                              = $datos_cuentas_cobrar_alerta['total_pendiente']; 
$nombre_tipo_cobro                            = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro']; 
$descuento                                    = $datos_cuentas_cobrar_alerta['descuento']; 
$abonado                                      = $datos_cuentas_cobrar_alerta['abonado']; 
$total_pagar                                  = $datos_cuentas_cobrar_alerta['total_pagar']; 
$mensaje                                      = $datos_cuentas_cobrar_alerta['mensaje']; 
$vendedor                                     = $datos_cuentas_cobrar_alerta['vendedor']; 
$cuenta                                       = $datos_cuentas_cobrar_alerta['cuenta']; 
$deduccion_retefuente                         = $datos_cuentas_cobrar_alerta['deduccion_retefuente']; 
$deduccion_reparacion                         = $datos_cuentas_cobrar_alerta['deduccion_reparacion']; 
$deduccion_servicio                           = $datos_cuentas_cobrar_alerta['deduccion_servicio']; 
$deduccion_otro_impuesto_dian                 = $datos_cuentas_cobrar_alerta['deduccion_otro_impuesto_dian']; 
$deduccion_otro_concepto                      = $datos_cuentas_cobrar_alerta['deduccion_otro_concepto']; 
$deduccion_servicio_energia                   = $datos_cuentas_cobrar_alerta['deduccion_servicio_energia']; 
$deduccion_servicio_agua                      = $datos_cuentas_cobrar_alerta['deduccion_servicio_agua']; 
$deduccion_servicio_gas                       = $datos_cuentas_cobrar_alerta['deduccion_servicio_gas']; 
$deduccion_deudas_anteriores                  = $datos_cuentas_cobrar_alerta['deduccion_deudas_anteriores']; 
$ingreso_administracion_incluida              = $datos_cuentas_cobrar_alerta['ingreso_administracion_incluida']; 
$ingreso_gasto_juridica                       = $datos_cuentas_cobrar_alerta['ingreso_gasto_juridica']; 
$deduccion_saldo_favor                        = $datos_cuentas_cobrar_alerta['deduccion_saldo_favor']; 
$ingreso_otro_concepto                        = $datos_cuentas_cobrar_alerta['ingreso_otro_concepto']; 
$ingreso_deudas_anteriores                    = $datos_cuentas_cobrar_alerta['ingreso_deudas_anteriores']; 
$numero_deudas_anteriores                     = $datos_cuentas_cobrar_alerta['numero_deudas_anteriores']; 
$total_deduccion                              = $datos_cuentas_cobrar_alerta['total_deduccion']; 
$total_ingreso                                = $datos_cuentas_cobrar_alerta['total_ingreso']; 
$fecha_pago                                   = $datos_cuentas_cobrar_alerta['fecha_pago']; 
$fecha                                        = $datos_cuentas_cobrar_alerta['fecha']; 
$fecha_mes                                    = $datos_cuentas_cobrar_alerta['fecha_mes']; 
$anyo                                         = $datos_cuentas_cobrar_alerta['anyo']; 
$fecha_invert                                 = $datos_cuentas_cobrar_alerta['fecha_invert']; 
$fecha_seg                                    = $datos_cuentas_cobrar_alerta['fecha_seg']; 
$fecha_pago_reg                               = $datos_cuentas_cobrar_alerta['fecha_pago_reg']; 
$hora_pago_reg                                = $datos_cuentas_cobrar_alerta['hora_pago_reg']; 
$fecha_creacion                               = $datos_cuentas_cobrar_alerta['fecha_creacion']; 
$cod_info_factura_venta                       = $datos_cuentas_cobrar_alerta['cod_info_factura_venta']; 
$url_img_orig_producto                        = $datos_cuentas_cobrar_alerta['url_img_orig_producto']; 
$url_img_min_producto                         = $datos_cuentas_cobrar_alerta['url_img_min_producto']; 
$cod_tipo_calificacion                        = $datos_cuentas_cobrar_alerta['cod_tipo_calificacion']; 
$nombre_tipo_calificacion                     = $datos_cuentas_cobrar_alerta['nombre_tipo_calificacion']; 
$cod_administrador                            = $datos_cuentas_cobrar_alerta['cod_administrador']; 
$cod_estado                                   = $datos_cuentas_cobrar_alerta['cod_estado']; 
$cod_estado_contrato                          = $datos_cuentas_cobrar_alerta['cod_estado_contrato']; 
$cod_tipo_forma_pago                          = $datos_cuentas_cobrar_alerta['cod_tipo_forma_pago']; 
$cod_tipo_moneda                              = $datos_cuentas_cobrar_alerta['cod_tipo_moneda']; 
$cod_estado_envio_correo_cuenta_cobro         = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_cuenta_cobro']; 
$cod_estado_renovacio_contrato                = $datos_cuentas_cobrar_alerta['cod_estado_renovacio_contrato']; 

$sql_data = "INSERT INTO tbl15_cuentas_cobrar_alerta_copia (cod_cuentas_cobrar_alerta, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, cod_factura, cod_clientes, cod_tercero, 
cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, 
monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, 
nombre_tipo_cobro, descuento, abonado, total_pagar, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, 
deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, 
deduccion_deudas_anteriores, ingreso_administracion_incluida, ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, 
ingreso_deudas_anteriores, numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, 
fecha_seg, fecha_pago_reg, hora_pago_reg, fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, 
cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, cod_estado, cod_estado_contrato, cod_tipo_forma_pago, cod_tipo_moneda, 
cod_estado_envio_correo_cuenta_cobro, cod_estado_renovacio_contrato, fecha_elim, usuario_elim) 
VALUES ('$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', '$numero_alerta', '$cod_factura', '$cod_clientes', '$cod_tercero', 
'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', 
'$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', 
'$nombre_tipo_cobro', '$descuento', '$abonado', '$total_pagar', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', 
'$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', 
'$deduccion_deudas_anteriores', '$ingreso_administracion_incluida', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', 
'$ingreso_deudas_anteriores', '$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', 
'$fecha_seg', '$fecha_pago_reg', '$hora_pago_reg', '$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', 
'$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', '$cod_estado', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_tipo_moneda', 
'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_renovacio_contrato', '$fecha_elim', '$usuario_elim')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}

//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_agrupado_eliminar_inmobiliaria') {
	$cod_cuentas_cobrar                 = intval($_GET['llave']);
	$cod_factura                        = intval($_GET['cod_factura']);
	$pagina                             = '../admin/lista_cuentas_cobrar_agrupado_historial_alquiler.php';
	$fecha_elim                         = date("Y-m-d H:i:s");	
	$usuario_elim                       = $cuenta_actual;

	$sql_cuentas_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_factura = '$cod_factura')";
	$consulta_cuentas_cobrar = mysqli_query($conectar, $sql_cuentas_cobrar);
	while ($datos_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar)) {

		$cod_cuentas_cobrar                         = $datos_cuentas_cobrar['cod_cuentas_cobrar'];
		$cod_factura                                = $datos_cuentas_cobrar['cod_factura'];
		$cod_clientes                               = $datos_cuentas_cobrar['cod_clientes'];
		$cod_tercero                                = $datos_cuentas_cobrar['cod_tercero'];
		$cod_tercero_propietario                    = $datos_cuentas_cobrar['cod_tercero_propietario'];
		$cod_producto                               = $datos_cuentas_cobrar['cod_producto'];
		$cod_producto_barra                         = $datos_cuentas_cobrar['cod_producto_barra'];
		$nombre_producto                            = $datos_cuentas_cobrar['nombre_producto'];
		$monto_deuda                                = $datos_cuentas_cobrar['monto_deuda'];
		$monto_deuda_sin_interes                    = $datos_cuentas_cobrar['monto_deuda_sin_interes'];
		$subtotal                                   = $datos_cuentas_cobrar['subtotal'];
		$subtotal_sin_interes                       = $datos_cuentas_cobrar['subtotal_sin_interes'];
		$numero_cuota                               = $datos_cuentas_cobrar['numero_cuota'];
		$monto_cuota                                = $datos_cuentas_cobrar['monto_cuota'];
		$monto_cuota_sin_interes                    = $datos_cuentas_cobrar['monto_cuota_sin_interes'];
		$interes_ptj                                = $datos_cuentas_cobrar['interes_ptj'];
		$monto_deuda_mas_interes                    = $datos_cuentas_cobrar['monto_deuda_mas_interes'];
		$monto_cuota_interes                        = $datos_cuentas_cobrar['monto_cuota_interes'];
		$total_recibido                             = $datos_cuentas_cobrar['total_recibido'];
		$total_pendiente                            = $datos_cuentas_cobrar['total_pendiente'];
		$nombre_tipo_cobro                          = $datos_cuentas_cobrar['nombre_tipo_cobro'];
		$cod_tipo_pago                              = $datos_cuentas_cobrar['cod_tipo_pago'];
		$cod_tipo_forma_pago                        = $datos_cuentas_cobrar['cod_tipo_forma_pago'];
		$descuento                                  = $datos_cuentas_cobrar['descuento'];
		$abonado                                    = $datos_cuentas_cobrar['abonado'];
		$mensaje                                    = $datos_cuentas_cobrar['mensaje'];
		$vendedor                                   = $datos_cuentas_cobrar['vendedor'];
		$cuenta                                     = $datos_cuentas_cobrar['cuenta'];
		$deduccion_retefuente                       = $datos_cuentas_cobrar['deduccion_retefuente'];
		$deduccion_reparacion                       = $datos_cuentas_cobrar['deduccion_reparacion'];
		$deduccion_servicio                         = $datos_cuentas_cobrar['deduccion_servicio'];
		$deduccion_otro_impuesto_dian               = $datos_cuentas_cobrar['deduccion_otro_impuesto_dian'];
		$deduccion_otro_concepto                    = $datos_cuentas_cobrar['deduccion_otro_concepto'];
		$deduccion_servicio_energia                 = $datos_cuentas_cobrar['deduccion_servicio_energia'];
		$deduccion_servicio_agua                    = $datos_cuentas_cobrar['deduccion_servicio_agua'];
		$deduccion_servicio_gas                     = $datos_cuentas_cobrar['deduccion_servicio_gas'];
		$deduccion_deudas_anteriores                = $datos_cuentas_cobrar['deduccion_deudas_anteriores'];
		$deduccion_comision                         = $datos_cuentas_cobrar['deduccion_comision'];
		$deduccion_imp_cuatroxmil                   = $datos_cuentas_cobrar['deduccion_imp_cuatroxmil'];
		$ingreso_administracion_incluida            = $datos_cuentas_cobrar['ingreso_administracion_incluida'];
		$ingreso_gasto_juridica                     = $datos_cuentas_cobrar['ingreso_gasto_juridica'];
		$deduccion_saldo_favor                      = $datos_cuentas_cobrar['deduccion_saldo_favor'];
		$ingreso_otro_concepto                      = $datos_cuentas_cobrar['ingreso_otro_concepto'];
		$ingreso_deudas_anteriores                  = $datos_cuentas_cobrar['ingreso_deudas_anteriores'];
		$ingreso_impuesto_iva                       = $datos_cuentas_cobrar['ingreso_impuesto_iva'];
		$numero_deudas_anteriores                   = $datos_cuentas_cobrar['numero_deudas_anteriores'];
		$total_deduccion                            = $datos_cuentas_cobrar['total_deduccion'];
		$total_ingreso                              = $datos_cuentas_cobrar['total_ingreso'];
		$fecha_reg                                  = $datos_cuentas_cobrar['fecha_reg'];
		$fecha_pago                                 = $datos_cuentas_cobrar['fecha_pago'];
		$fecha                                      = $datos_cuentas_cobrar['fecha'];
		$fecha_mes                                  = $datos_cuentas_cobrar['fecha_mes'];
		$anyo                                       = $datos_cuentas_cobrar['anyo'];
		$fecha_invert                               = $datos_cuentas_cobrar['fecha_invert'];
		$fecha_seg                                  = $datos_cuentas_cobrar['fecha_seg'];
		$fecha_creacion                             = $datos_cuentas_cobrar['fecha_creacion'];
		$cod_info_factura_venta                     = $datos_cuentas_cobrar['cod_info_factura_venta'];
		$url_img_orig_producto                      = $datos_cuentas_cobrar['url_img_orig_producto'];
		$url_img_min_producto                       = $datos_cuentas_cobrar['url_img_min_producto'];
		$cod_tipo_calificacion                      = $datos_cuentas_cobrar['cod_tipo_calificacion'];
		$nombre_tipo_calificacion                   = $datos_cuentas_cobrar['nombre_tipo_calificacion'];
		$cod_administrador                          = $datos_cuentas_cobrar['cod_administrador'];
		$cod_estado                                 = $datos_cuentas_cobrar['cod_estado'];
		$cod_estado_pago                            = $datos_cuentas_cobrar['cod_estado_pago'];
		$nombre1_tercero                            = $datos_cuentas_cobrar['nombre1_tercero'];
		$nombre2_tercero                            = $datos_cuentas_cobrar['nombre2_tercero'];
		$apellido1_tercero                          = $datos_cuentas_cobrar['apellido1_tercero'];
		$apellido2_tercero                          = $datos_cuentas_cobrar['apellido2_tercero'];
		$identificacion_tercero                     = $datos_cuentas_cobrar['identificacion_tercero'];
		$fecha_nac_tercero                          = $datos_cuentas_cobrar['fecha_nac_tercero'];
		$direccion_tercero                          = $datos_cuentas_cobrar['direccion_tercero'];
		$telefono1_tercero                          = $datos_cuentas_cobrar['telefono1_tercero'];
		$correo_tercero                             = $datos_cuentas_cobrar['correo_tercero'];
		$fecha_entrega                              = $datos_cuentas_cobrar['fecha_entrega'];
		$hora_entrega                               = $datos_cuentas_cobrar['hora_entrega'];
		$cod_tipo_moneda                            = $datos_cuentas_cobrar['cod_tipo_moneda'];
		$clausula_alquiler                          = $datos_cuentas_cobrar['clausula_alquiler'];
		$cod_estado_contrato                        = $datos_cuentas_cobrar['cod_estado_contrato'];
		$cod_estado_renovacio_contrato              = $datos_cuentas_cobrar['cod_estado_renovacio_contrato'];
		$cod_renovacion_contrato                    = $datos_cuentas_cobrar['cod_renovacion_contrato'];

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_copia (cod_cuentas_cobrar, cod_factura, cod_tercero, cod_tercero_propietario, cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, 
		numero_cuota, monto_cuota, monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, nombre_tipo_cobro, 
		cod_tipo_pago, cod_tipo_forma_pago, descuento, abonado, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, 
		deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, 
		deduccion_comision, deduccion_imp_cuatroxmil, ingreso_administracion_incluida, ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, 
		ingreso_deudas_anteriores, ingreso_impuesto_iva, numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_reg, fecha_pago, fecha, fecha_mes, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$cod_tercero_propietario', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', 
		'$numero_cuota', '$monto_cuota', '$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', '$nombre_tipo_cobro', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$descuento', '$abonado', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', 
		'$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', 
		'$deduccion_comision', '$deduccion_imp_cuatroxmil', '$ingreso_administracion_incluida', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', 
		'$ingreso_deudas_anteriores', '$ingreso_impuesto_iva', '$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_reg', '$fecha_pago', '$fecha', '$fecha_mes', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}


	$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_factura = '$cod_factura')";
	$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
	while ($datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta)) { 	

		$cod_cuentas_cobrar_alerta                       = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta'];
		$cod_cuentas_cobrar                              = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar'];
		$cod_cuentas_cobrar_abonos                       = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos'];
		$numero_alerta                                   = $datos_cuentas_cobrar_alerta['numero_alerta'];
		$cod_factura                                     = $datos_cuentas_cobrar_alerta['cod_factura'];
		$cod_clientes                                    = $datos_cuentas_cobrar_alerta['cod_clientes'];
		$cod_tercero                                     = $datos_cuentas_cobrar_alerta['cod_tercero'];
		$cod_tercero_propietario                         = $datos_cuentas_cobrar_alerta['cod_tercero_propietario'];
		$cod_producto                                    = $datos_cuentas_cobrar_alerta['cod_producto'];
		$cod_producto_barra                              = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
		$nombre_producto                                 = $datos_cuentas_cobrar_alerta['nombre_producto'];
		$monto_deuda                                     = $datos_cuentas_cobrar_alerta['monto_deuda'];
		$monto_deuda_sin_interes                         = $datos_cuentas_cobrar_alerta['monto_deuda_sin_interes'];
		$subtotal                                        = $datos_cuentas_cobrar_alerta['subtotal'];
		$subtotal_sin_interes                            = $datos_cuentas_cobrar_alerta['subtotal_sin_interes'];
		$numero_cuota                                    = $datos_cuentas_cobrar_alerta['numero_cuota'];
		$monto_cuota                                     = $datos_cuentas_cobrar_alerta['monto_cuota'];
		$monto_cuota_sin_interes                         = $datos_cuentas_cobrar_alerta['monto_cuota_sin_interes'];
		$interes_ptj                                     = $datos_cuentas_cobrar_alerta['interes_ptj'];
		$monto_deuda_mas_interes                         = $datos_cuentas_cobrar_alerta['monto_deuda_mas_interes'];
		$monto_cuota_interes                             = $datos_cuentas_cobrar_alerta['monto_cuota_interes'];
		$total_recibido                                  = $datos_cuentas_cobrar_alerta['total_recibido'];
		$total_pendiente                                 = $datos_cuentas_cobrar_alerta['total_pendiente'];
		$nombre_tipo_cobro                               = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro'];
		$descuento                                       = $datos_cuentas_cobrar_alerta['descuento'];
		$abonado                                         = $datos_cuentas_cobrar_alerta['abonado'];
		$total_pagar                                     = $datos_cuentas_cobrar_alerta['total_pagar'];
		$mensaje                                         = $datos_cuentas_cobrar_alerta['mensaje'];
		$vendedor                                        = $datos_cuentas_cobrar_alerta['vendedor'];
		$cuenta                                          = $datos_cuentas_cobrar_alerta['cuenta'];
		$deduccion_retefuente                            = $datos_cuentas_cobrar_alerta['deduccion_retefuente'];
		$deduccion_reparacion                            = $datos_cuentas_cobrar_alerta['deduccion_reparacion'];
		$deduccion_servicio                              = $datos_cuentas_cobrar_alerta['deduccion_servicio'];
		$deduccion_otro_impuesto_dian                    = $datos_cuentas_cobrar_alerta['deduccion_otro_impuesto_dian'];
		$deduccion_otro_concepto                         = $datos_cuentas_cobrar_alerta['deduccion_otro_concepto'];
		$deduccion_servicio_energia                      = $datos_cuentas_cobrar_alerta['deduccion_servicio_energia'];
		$deduccion_servicio_agua                         = $datos_cuentas_cobrar_alerta['deduccion_servicio_agua'];
		$deduccion_servicio_gas                          = $datos_cuentas_cobrar_alerta['deduccion_servicio_gas'];
		$deduccion_deudas_anteriores                     = $datos_cuentas_cobrar_alerta['deduccion_deudas_anteriores'];
		$deduccion_comision                              = $datos_cuentas_cobrar_alerta['deduccion_comision'];
		$deduccion_imp_cuatroxmil                        = $datos_cuentas_cobrar_alerta['deduccion_imp_cuatroxmil'];
		$ingreso_administracion_incluida                 = $datos_cuentas_cobrar_alerta['ingreso_administracion_incluida'];
		$ingreso_gasto_juridica                          = $datos_cuentas_cobrar_alerta['ingreso_gasto_juridica'];
		$deduccion_saldo_favor                           = $datos_cuentas_cobrar_alerta['deduccion_saldo_favor'];
		$ingreso_otro_concepto                           = $datos_cuentas_cobrar_alerta['ingreso_otro_concepto'];
		$ingreso_deudas_anteriores                       = $datos_cuentas_cobrar_alerta['ingreso_deudas_anteriores'];
		$ingreso_impuesto_iva                            = $datos_cuentas_cobrar_alerta['ingreso_impuesto_iva'];
		$numero_deudas_anteriores                        = $datos_cuentas_cobrar_alerta['numero_deudas_anteriores'];
		$total_deduccion                                 = $datos_cuentas_cobrar_alerta['total_deduccion'];
		$total_ingreso                                   = $datos_cuentas_cobrar_alerta['total_ingreso'];
		$fecha_pago                                      = $datos_cuentas_cobrar_alerta['fecha_pago'];
		$fecha                                           = $datos_cuentas_cobrar_alerta['fecha'];
		$fecha_mes                                       = $datos_cuentas_cobrar_alerta['fecha_mes'];
		$anyo                                            = $datos_cuentas_cobrar_alerta['anyo'];
		$fecha_invert                                    = $datos_cuentas_cobrar_alerta['fecha_invert'];
		$fecha_seg                                       = $datos_cuentas_cobrar_alerta['fecha_seg'];
		$fecha_pago_reg                                  = $datos_cuentas_cobrar_alerta['fecha_pago_reg'];
		$hora_pago_reg                                   = $datos_cuentas_cobrar_alerta['hora_pago_reg'];
		$fecha_creacion                                  = $datos_cuentas_cobrar_alerta['fecha_creacion'];
		$cod_info_factura_venta                          = $datos_cuentas_cobrar_alerta['cod_info_factura_venta'];
		$url_img_orig_producto                           = $datos_cuentas_cobrar_alerta['url_img_orig_producto'];
		$url_img_min_producto                            = $datos_cuentas_cobrar_alerta['url_img_min_producto'];
		$cod_tipo_calificacion                           = $datos_cuentas_cobrar_alerta['cod_tipo_calificacion'];
		$nombre_tipo_calificacion                        = $datos_cuentas_cobrar_alerta['nombre_tipo_calificacion'];
		$cod_administrador                               = $datos_cuentas_cobrar_alerta['cod_administrador'];
		$cod_estado                                      = $datos_cuentas_cobrar_alerta['cod_estado'];
		$cod_estado_pago                                 = $datos_cuentas_cobrar_alerta['cod_estado_pago'];
		$cod_estado_contrato                             = $datos_cuentas_cobrar_alerta['cod_estado_contrato'];
		$cod_tipo_forma_pago                             = $datos_cuentas_cobrar_alerta['cod_tipo_forma_pago'];
		$cod_tipo_moneda                                 = $datos_cuentas_cobrar_alerta['cod_tipo_moneda'];
		$cod_estado_envio_correo_cuenta_cobro            = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_cuenta_cobro'];
		$cod_estado_envio_correo_comprobante_ingreso     = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_comprobante_ingreso'];
		$cod_estado_envio_correo_comision_propietario    = $datos_cuentas_cobrar_alerta['cod_estado_envio_correo_comision_propietario'];
		$cod_estado_renovacio_contrato                   = $datos_cuentas_cobrar_alerta['cod_estado_renovacio_contrato'];
		$cod_renovacion_contrato                         = $datos_cuentas_cobrar_alerta['cod_renovacion_contrato'];
		$fecha_anyo                                      = $datos_cuentas_cobrar_alerta['fecha_anyo'];
		$hora                                            = $datos_cuentas_cobrar_alerta['hora'];
		$fecha_pago_deuda                                = $datos_cuentas_cobrar_alerta['fecha_pago_deuda'];
		$cod_cuentas_cobrar_factura_comision_propietario = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_factura_comision_propietario'];
		$cod_cuentas_cobrar_alerta_cbk                   = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta_cbk'];
		$cod_cuentas_cobrar_alerta_cbk2                  = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta_cbk2'];
		$cod_cuentas_cobrar_abonos_cbk                   = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos_cbk'];
		$cod_cuentas_cobrar_abonos_cbk2                  = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos_cbk2'];

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_alerta_copia (cod_cuentas_cobrar_alerta, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, numero_alerta, cod_factura, cod_clientes, cod_tercero, cod_tercero_propietario, 
		cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, 
		monto_cuota_sin_interes, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, total_recibido, total_pendiente, nombre_tipo_cobro, descuento, abonado, 
		total_pagar, mensaje, vendedor, cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, 
		deduccion_servicio_energia, deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, deduccion_comision, deduccion_imp_cuatroxmil, 
		ingreso_administracion_incluida, ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, ingreso_impuesto_iva, 
		numero_deudas_anteriores, total_deduccion, total_ingreso, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_pago_reg, hora_pago_reg, 
		fecha_creacion, cod_info_factura_venta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_administrador, 
		cod_estado, cod_estado_pago, cod_estado_contrato, cod_tipo_forma_pago, cod_tipo_moneda, cod_estado_envio_correo_cuenta_cobro, cod_estado_envio_correo_comprobante_ingreso, 
		cod_estado_envio_correo_comision_propietario, cod_estado_renovacio_contrato, cod_renovacion_contrato, fecha_anyo, hora, fecha_pago_deuda, 
		cod_cuentas_cobrar_factura_comision_propietario, cod_cuentas_cobrar_alerta_cbk, cod_cuentas_cobrar_alerta_cbk2, cod_cuentas_cobrar_abonos_cbk, cod_cuentas_cobrar_abonos_cbk2, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', '$numero_alerta', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_tercero_propietario', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', 
		'$monto_cuota_sin_interes', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$total_recibido', '$total_pendiente', '$nombre_tipo_cobro', '$descuento', '$abonado', 
		'$total_pagar', '$mensaje', '$vendedor', '$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', 
		'$deduccion_servicio_energia', '$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$deduccion_comision', '$deduccion_imp_cuatroxmil', 
		'$ingreso_administracion_incluida', '$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', '$ingreso_impuesto_iva', 
		'$numero_deudas_anteriores', '$total_deduccion', '$total_ingreso', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$fecha_pago_reg', '$hora_pago_reg', 
		'$fecha_creacion', '$cod_info_factura_venta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_administrador', 
		'$cod_estado', '$cod_estado_pago', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_tipo_moneda', '$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_envio_correo_comprobante_ingreso', 
		'$cod_estado_envio_correo_comision_propietario', '$cod_estado_renovacio_contrato', '$cod_renovacion_contrato', '$fecha_anyo', '$hora', '$fecha_pago_deuda', 
		'$cod_cuentas_cobrar_factura_comision_propietario', '$cod_cuentas_cobrar_alerta_cbk', '$cod_cuentas_cobrar_alerta_cbk2', '$cod_cuentas_cobrar_abonos_cbk', '$cod_cuentas_cobrar_abonos_cbk2', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}


	$sql_cuentas_cobrar_abonos = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_factura = '$cod_factura')";
	$consulta_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_cuentas_cobrar_abonos);
	while ($datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos)) { 	

		$cod_cuentas_cobrar_abonos                       = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos'];
		$cod_cuentas_cobrar                              = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar'];
		$cod_factura                                     = $datos_cuentas_cobrar_abonos['cod_factura'];
		$cod_clientes                                    = $datos_cuentas_cobrar_abonos['cod_clientes'];
		$cod_tercero                                     = $datos_cuentas_cobrar_abonos['cod_tercero'];
		$cod_tercero_propietario                         = $datos_cuentas_cobrar_abonos['cod_tercero_propietario'];
		$cod_producto                                    = $datos_cuentas_cobrar_abonos['cod_producto'];
		$cod_producto_barra                              = $datos_cuentas_cobrar_abonos['cod_producto_barra'];
		$nombre_producto                                 = $datos_cuentas_cobrar_abonos['nombre_producto'];
		$monto_deuda                                     = $datos_cuentas_cobrar_abonos['monto_deuda'];
		$subtotal                                        = $datos_cuentas_cobrar_abonos['subtotal'];
		$descuento                                       = $datos_cuentas_cobrar_abonos['descuento'];
		$abonado                                         = $datos_cuentas_cobrar_abonos['abonado'];
		$total_pagar                                     = $datos_cuentas_cobrar_abonos['total_pagar'];
		$monto_deuda_sin_interes                         = $datos_cuentas_cobrar_abonos['monto_deuda_sin_interes'];
		$subtotal_sin_interes                            = $datos_cuentas_cobrar_abonos['subtotal_sin_interes'];
		$numero_cuota                                    = $datos_cuentas_cobrar_abonos['numero_cuota'];
		$monto_cuota                                     = $datos_cuentas_cobrar_abonos['monto_cuota'];
		$monto_cuota_sin_interes                         = $datos_cuentas_cobrar_abonos['monto_cuota_sin_interes'];
		$total_recibido                                  = $datos_cuentas_cobrar_abonos['total_recibido'];
		$total_pendiente                                 = $datos_cuentas_cobrar_abonos['total_pendiente'];
		$interes_ptj                                     = $datos_cuentas_cobrar_abonos['interes_ptj'];
		$monto_deuda_mas_interes                         = $datos_cuentas_cobrar_abonos['monto_deuda_mas_interes'];
		$monto_cuota_interes                             = $datos_cuentas_cobrar_abonos['monto_cuota_interes'];
		$mensaje                                         = $datos_cuentas_cobrar_abonos['mensaje'];
		$cod_administrador                               = $datos_cuentas_cobrar_abonos['cod_administrador'];
		$vendedor                                        = $datos_cuentas_cobrar_abonos['vendedor'];
		$cuenta                                          = $datos_cuentas_cobrar_abonos['cuenta'];
		$deduccion_retefuente                            = $datos_cuentas_cobrar_abonos['deduccion_retefuente'];
		$deduccion_reparacion                            = $datos_cuentas_cobrar_abonos['deduccion_reparacion'];
		$deduccion_servicio                              = $datos_cuentas_cobrar_abonos['deduccion_servicio'];
		$deduccion_otro_impuesto_dian                    = $datos_cuentas_cobrar_abonos['deduccion_otro_impuesto_dian'];
		$deduccion_otro_concepto                         = $datos_cuentas_cobrar_abonos['deduccion_otro_concepto'];
		$deduccion_servicio_energia                      = $datos_cuentas_cobrar_abonos['deduccion_servicio_energia'];
		$deduccion_servicio_agua                         = $datos_cuentas_cobrar_abonos['deduccion_servicio_agua'];
		$deduccion_servicio_gas                          = $datos_cuentas_cobrar_abonos['deduccion_servicio_gas'];
		$deduccion_deudas_anteriores                     = $datos_cuentas_cobrar_abonos['deduccion_deudas_anteriores'];
		$deduccion_comision                              = $datos_cuentas_cobrar_abonos['deduccion_comision'];
		$deduccion_imp_cuatroxmil                        = $datos_cuentas_cobrar_abonos['deduccion_imp_cuatroxmil'];
		$ingreso_administracion_incluida                 = $datos_cuentas_cobrar_abonos['ingreso_administracion_incluida'];
		$ingreso_gasto_juridica                          = $datos_cuentas_cobrar_abonos['ingreso_gasto_juridica'];
		$deduccion_saldo_favor                           = $datos_cuentas_cobrar_abonos['deduccion_saldo_favor'];
		$ingreso_otro_concepto                           = $datos_cuentas_cobrar_abonos['ingreso_otro_concepto'];
		$ingreso_deudas_anteriores                       = $datos_cuentas_cobrar_abonos['ingreso_deudas_anteriores'];
		$ingreso_impuesto_iva                            = $datos_cuentas_cobrar_abonos['ingreso_impuesto_iva'];
		$numero_deudas_anteriores                        = $datos_cuentas_cobrar_abonos['numero_deudas_anteriores'];
		$total_deduccion                                 = $datos_cuentas_cobrar_abonos['total_deduccion'];
		$total_ingreso                                   = $datos_cuentas_cobrar_abonos['total_ingreso'];
		$cod_abono_global                                = $datos_cuentas_cobrar_abonos['cod_abono_global'];
		$fecha_pago                                      = $datos_cuentas_cobrar_abonos['fecha_pago'];
		$fecha_anyo                                      = $datos_cuentas_cobrar_abonos['fecha_anyo'];
		$fecha_mes                                       = $datos_cuentas_cobrar_abonos['fecha_mes'];
		$anyo                                            = $datos_cuentas_cobrar_abonos['anyo'];
		$fecha_invert                                    = $datos_cuentas_cobrar_abonos['fecha_invert'];
		$fecha_seg                                       = $datos_cuentas_cobrar_abonos['fecha_seg'];
		$hora                                            = $datos_cuentas_cobrar_abonos['hora'];
		$fecha_pago_deuda                                = $datos_cuentas_cobrar_abonos['fecha_pago_deuda'];
		$fecha_pago_reg                                  = $datos_cuentas_cobrar_abonos['fecha_pago_reg'];
		$hora_pago_reg                                   = $datos_cuentas_cobrar_abonos['hora_pago_reg'];
		$fecha_creacion                                  = $datos_cuentas_cobrar_abonos['fecha_creacion'];
		$cod_info_factura_venta                          = $datos_cuentas_cobrar_abonos['cod_info_factura_venta'];
		$cod_estado                                      = $datos_cuentas_cobrar_abonos['cod_estado'];
		$cod_estado_pago                                 = $datos_cuentas_cobrar_abonos['cod_estado_pago'];
		$cod_estado_contrato                             = $datos_cuentas_cobrar_abonos['cod_estado_contrato'];
		$cod_tipo_forma_pago                             = $datos_cuentas_cobrar_abonos['cod_tipo_forma_pago'];
		$cod_cuentas_cobrar_alerta                       = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta'];
		$cod_cuentas_cobrar_alerta_cbk                   = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_alerta_cbk'];
		$numero_alerta                                   = $datos_cuentas_cobrar_abonos['numero_alerta'];
		$url_img_orig_producto                           = $datos_cuentas_cobrar_abonos['url_img_orig_producto'];
		$url_img_min_producto                            = $datos_cuentas_cobrar_abonos['url_img_min_producto'];
		$cod_tipo_calificacion                           = $datos_cuentas_cobrar_abonos['cod_tipo_calificacion'];
		$nombre_tipo_calificacion                        = $datos_cuentas_cobrar_abonos['nombre_tipo_calificacion'];
		$cod_dependencia                                 = $datos_cuentas_cobrar_abonos['cod_dependencia'];
		$cod_tipo_moneda                                 = $datos_cuentas_cobrar_abonos['cod_tipo_moneda'];
		$cod_estado_envio_correo_cuenta_cobro            = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_cuenta_cobro'];
		$cod_estado_envio_correo_comprobante_ingreso     = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_comprobante_ingreso'];
		$cod_estado_envio_correo_comision_propietario    = $datos_cuentas_cobrar_abonos['cod_estado_envio_correo_comision_propietario'];
		$cod_estado_renovacio_contrato                   = $datos_cuentas_cobrar_abonos['cod_estado_renovacio_contrato'];
		$cod_renovacion_contrato                         = $datos_cuentas_cobrar_abonos['cod_renovacion_contrato'];
		$cod_cuentas_cobrar_factura_comision_propietario = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_factura_comision_propietario'];
		$cod_cuentas_cobrar_abonos_cbk                   = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos_cbk'];
		$cod_cuentas_cobrar_abonos_cbk2                  = $datos_cuentas_cobrar_abonos['cod_cuentas_cobrar_abonos_cbk2'];

		$sql_data = "INSERT INTO tbl15_cuentas_cobrar_abonos_copia (cod_cuentas_cobrar_abonos, cod_cuentas_cobrar, cod_factura, cod_clientes, cod_tercero, cod_tercero_propietario, cod_producto, cod_producto_barra, 
		nombre_producto, monto_deuda, subtotal, descuento, abonado, total_pagar, monto_deuda_sin_interes, subtotal_sin_interes, numero_cuota, monto_cuota, 
		monto_cuota_sin_interes, total_recibido, total_pendiente, interes_ptj, monto_deuda_mas_interes, monto_cuota_interes, mensaje, cod_administrador, vendedor, 
		cuenta, deduccion_retefuente, deduccion_reparacion, deduccion_servicio, deduccion_otro_impuesto_dian, deduccion_otro_concepto, deduccion_servicio_energia, 
		deduccion_servicio_agua, deduccion_servicio_gas, deduccion_deudas_anteriores, deduccion_comision, deduccion_imp_cuatroxmil, ingreso_administracion_incluida, 
		ingreso_gasto_juridica, deduccion_saldo_favor, ingreso_otro_concepto, ingreso_deudas_anteriores, ingreso_impuesto_iva, numero_deudas_anteriores, total_deduccion, 
		total_ingreso, cod_abono_global, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, fecha_pago_deuda, fecha_pago_reg, hora_pago_reg, 
		fecha_creacion, cod_info_factura_venta, cod_estado, cod_estado_pago, cod_estado_contrato, cod_tipo_forma_pago, cod_cuentas_cobrar_alerta, cod_cuentas_cobrar_alerta_cbk, 
		numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion, cod_dependencia, cod_tipo_moneda, 
		cod_estado_envio_correo_cuenta_cobro, cod_estado_envio_correo_comprobante_ingreso, cod_estado_envio_correo_comision_propietario, cod_estado_renovacio_contrato, 
		cod_renovacion_contrato, cod_cuentas_cobrar_factura_comision_propietario, cod_cuentas_cobrar_abonos_cbk, cod_cuentas_cobrar_abonos_cbk2, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_cuentas_cobrar', '$cod_factura', '$cod_clientes', '$cod_tercero', '$cod_tercero_propietario', '$cod_producto', '$cod_producto_barra', 
		'$nombre_producto', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$total_pagar', '$monto_deuda_sin_interes', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', 
		'$monto_cuota_sin_interes', '$total_recibido', '$total_pendiente', '$interes_ptj', '$monto_deuda_mas_interes', '$monto_cuota_interes', '$mensaje', '$cod_administrador', '$vendedor', 
		'$cuenta', '$deduccion_retefuente', '$deduccion_reparacion', '$deduccion_servicio', '$deduccion_otro_impuesto_dian', '$deduccion_otro_concepto', '$deduccion_servicio_energia', 
		'$deduccion_servicio_agua', '$deduccion_servicio_gas', '$deduccion_deudas_anteriores', '$deduccion_comision', '$deduccion_imp_cuatroxmil', '$ingreso_administracion_incluida', 
		'$ingreso_gasto_juridica', '$deduccion_saldo_favor', '$ingreso_otro_concepto', '$ingreso_deudas_anteriores', '$ingreso_impuesto_iva', '$numero_deudas_anteriores', '$total_deduccion', 
		'$total_ingreso', '$cod_abono_global', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$fecha_pago_deuda', '$fecha_pago_reg', '$hora_pago_reg', 
		'$fecha_creacion', '$cod_info_factura_venta', '$cod_estado', '$cod_estado_pago', '$cod_estado_contrato', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar_alerta_cbk', 
		'$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion', '$cod_dependencia', '$cod_tipo_moneda', 
		'$cod_estado_envio_correo_cuenta_cobro', '$cod_estado_envio_correo_comprobante_ingreso', '$cod_estado_envio_correo_comision_propietario', '$cod_estado_renovacio_contrato', 
		'$cod_renovacion_contrato', '$cod_cuentas_cobrar_factura_comision_propietario', '$cod_cuentas_cobrar_abonos_cbk', '$cod_cuentas_cobrar_abonos_cbk2', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_agrupado_archivar') {
	$cod_cuentas_cobrar                 = intval($_GET['llave']);
	$cod_factura                        = intval($_GET['cod_factura']);
	$pagina                             = '../admin/lista_cuentas_cobrar_agrupado_historial_alquiler.php';
	$fecha_elim                         = date("Y-m-d H:i:s");	
	$usuario_elim                       = $cuenta_actual;
	$cod_estado_archivado               = 1;

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_cuentas_cobrar_agrupado_desarchivar') {
	$cod_cuentas_cobrar                 = intval($_GET['llave']);
	$cod_factura                        = intval($_GET['cod_factura']);
	$pagina                             = '../admin/lista_cuentas_cobrar_agrupado_historial_alquiler.php';
	$fecha_elim                         = date("Y-m-d H:i:s");	
	$usuario_elim                       = $cuenta_actual;
	$cod_estado_archivado               = 0;

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>?cod_tercero=<?php echo $cod_tercero ?>">
<?php
}
?>