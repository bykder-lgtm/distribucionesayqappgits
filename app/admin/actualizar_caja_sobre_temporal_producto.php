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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                 = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
// ------------------------------------------------------------------------------------------------- //
if (isset($_GET['cod_venta_producto_temporal'])) {

	$cod_venta_producto_temporal        = intval($_GET['cod_venta_producto_temporal']);
	$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);
	$cuenta                             = addslashes($_GET['cuenta']);
	$cod_caja_virtual                   = intval($_GET['cod_caja_virtual']);
	$tipo_caja_sobre                    = addslashes($_GET['tipo_caja_sobre']);
	$pagina                             = addslashes($_GET['pagina']).'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual;
	$nombre_tipo_und_caja_sobre         = $tipo_caja_sobre;
	$und_caja_sobre                     = '0';
	$nombre_tipo_precio_venta           = 'PV1';
	$nombre_tipo_unidad_medida          = $tipo_caja_sobre;

	$sql_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'";
	$consulta_temporal = mysqli_query($conectar, $sql_temporal);
	$temporal = mysqli_fetch_assoc($consulta_temporal);

	$cod_producto_barra                 = $temporal['cod_producto_barra'];
	$nombre_tipo_precio_venta_prod      = $temporal['nombre_tipo_precio_venta'];
	$precio_venta_producto_prod         = $temporal['precio_venta_producto'];
	$und_venta_prod                     = $temporal['und_venta'];

	$sql_productos = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$consulta_productos = mysqli_query($conectar, $sql_productos);
	$productos = mysqli_fetch_assoc($consulta_productos);

	$und_producto_inv                   = $productos['und_producto'];
	$cajas_sobre                        = $productos['cajas_sobre'];
	$und_sobre                          = $productos['und_sobre'];
	$precio_venta_producto              = $productos['precio_venta_producto'];
	$precio_venta_producto2             = $productos['precio_venta_producto2'];
	$precio_venta_producto3             = $productos['precio_venta_producto3'];
// ------------------------------------------------------------------------------------------------- //
	$mostrar_datos_sql = "SELECT nombre_tipo_precio_venta FROM tbl15_tipo_unidad_medida WHERE nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$nombre_tipo_precio_venta_predeter  = $matriz_consulta['nombre_tipo_precio_venta'];

	if ($nombre_tipo_precio_venta_predeter <> '') {

		if ($nombre_tipo_precio_venta_predeter == 'PV2') {
			if ($precio_venta_producto2 == '0') {
				$precio_venta_producto        = $precio_venta_producto;
				$nombre_tipo_precio_venta     = 'PV1';
			} else {
				$precio_venta_producto        = $precio_venta_producto2;
				$nombre_tipo_precio_venta     = $nombre_tipo_precio_venta_predeter;
			}
		} elseif ($nombre_tipo_precio_venta_predeter == 'PV3') {
			if ($precio_venta_producto2 == '0') {
				$precio_venta_producto        = $precio_venta_producto;
				$nombre_tipo_precio_venta     = 'PV1';
			} else {
				$precio_venta_producto        = $precio_venta_producto3;
				$nombre_tipo_precio_venta     = $nombre_tipo_precio_venta_predeter;
			}
		} else {
			if ($precio_venta_producto2 == '0') {
				$precio_venta_producto        = $precio_venta_producto;
				$nombre_tipo_precio_venta     = 'PV1';
			} else {
				$precio_venta_producto        = $precio_venta_producto;
				$nombre_tipo_precio_venta     = $nombre_tipo_precio_venta_predeter;
			}
		}
	} else {
		$precio_venta_producto        = $productos['precio_venta_producto'];
		$nombre_tipo_precio_venta     = $nombre_tipo_precio_venta_predeter;
	}
// ------------------------------------------------------------------------------------------------- //
	if ($tipo_caja_sobre == 'CAJA') {

		if ($productos['precio_venta_producto2'] == '0') { 
			//$precio_venta_producto = $productos['precio_venta_producto']; 
			$und_venta = $cajas_sobre;  
			$total_venta_producto = $precio_venta_producto * $und_venta;
		} else { 
			//$precio_venta_producto = $productos['precio_venta_producto2']; 
			$und_venta = $cajas_sobre; 
			$total_venta_producto = $precio_venta_producto * $und_venta;
		}

		if ($nombre_tipo_precio_venta_prod == 'PVAR') { 
			$nombre_tipo_precio_venta = $nombre_tipo_precio_venta_prod; 
			$precio_venta_producto = $precio_venta_producto_prod; 
			$total_venta_producto = $precio_venta_producto * $und_venta_prod; 
		}

		$und_caja_sobre            = '1';
		$cajas_sobre               = $cajas_sobre;

	    if ($cajas_sobre == '0') { $cajas_sobre = 1; $max_und_venta = ''; } else { $cajas_sobre = $cajas_sobre; $max_und_venta = ($und_producto_inv / $cajas_sobre); }
	    $total_cajas_disponibles = ($und_producto_inv / $cajas_sobre);

		$actualizar_sql = "UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', und_venta = '$und_venta', total_venta_producto = '$total_venta_producto', 
		nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_tipo_und_caja_sobre = '$nombre_tipo_und_caja_sobre', und_caja_sobre = '$und_caja_sobre', 
		nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', cajas_sobre = '$cajas_sobre', und_producto = '$max_und_venta', total_cajas_disponibles = '$total_cajas_disponibles'
		WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
		FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
		$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

		$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

		if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
			if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
			$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
	<?php }

	elseif ($tipo_caja_sobre == 'SOBRE') {

		if ($productos['precio_venta_producto3'] == '0') { 
			//$precio_venta_producto = $productos['precio_venta_producto']; 
			$und_venta = $und_sobre;
			$total_venta_producto = $precio_venta_producto * $und_venta;
		} else { 
			//$precio_venta_producto = $productos['precio_venta_producto3']; 
			$und_venta = $und_sobre; 
			$total_venta_producto = $precio_venta_producto * $und_venta;
		}

		if ($nombre_tipo_precio_venta_prod == 'PVAR') { 
			$nombre_tipo_precio_venta = $nombre_tipo_precio_venta_prod; 
			$precio_venta_producto = $precio_venta_producto_prod; 
			$total_venta_producto = $precio_venta_producto * $und_venta_prod; 
		}

		$und_caja_sobre            = '1';
		$cajas_sobre               = $und_sobre;

	    if ($und_sobre == '0') { $und_sobre = 1; $max_und_venta = ''; } else { $und_sobre = $und_sobre; $max_und_venta = ($und_producto_inv / $und_sobre); }
	    $total_sobres_disponibles = ($und_producto_inv / $und_sobre);

		$actualizar_sql = "UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', und_venta = '$und_venta', total_venta_producto = '$total_venta_producto', 
		nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_tipo_und_caja_sobre = '$nombre_tipo_und_caja_sobre', und_caja_sobre = '$und_caja_sobre', 
		nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', und_sobre = '$und_sobre', und_producto = '$max_und_venta', total_sobres_disponibles = '$total_sobres_disponibles'  
		WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
		FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
		$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

		$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

		if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
			if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
			$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
	<?php } else { 
		//$precio_venta_producto        = $productos['precio_venta_producto']; 

		if ($nombre_tipo_precio_venta_prod == 'PVAR') { 
			$nombre_tipo_precio_venta = $nombre_tipo_precio_venta_prod; 
			$precio_venta_producto = $precio_venta_producto_prod; 
			$total_venta_producto = $precio_venta_producto * $und_venta_prod; 
		}

		$und_venta                    = 1; 
		$total_venta_producto         = $precio_venta_producto * $und_venta;
		$max_und_venta                = $und_producto_inv;
		$cajas_sobre                  = 1; 

		$actualizar_sql = "UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', und_venta = '$und_venta', total_venta_producto = '$total_venta_producto', 
		nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_tipo_und_caja_sobre = '$nombre_tipo_und_caja_sobre', und_caja_sobre = '$und_caja_sobre', 
		nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', und_producto = '$max_und_venta'  
		WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
		FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
		$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

		$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

		if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
			if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
			$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
			$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
		}
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
	<?php } ?>

<?php } ?>