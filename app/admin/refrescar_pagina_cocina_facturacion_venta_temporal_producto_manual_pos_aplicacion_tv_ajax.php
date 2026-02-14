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
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);
$cod_seguridad           = ($_SESSION['cod_seguridad']);
$cod_caja_virtual        = ($_SESSION['cod_caja_virtual']);
$token                   = ($_SESSION['token']);

$cod_info_factura_venta                                            = intval($_POST['cod_info_factura_venta']);

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$nombre_concepto_multi_virtual                                     = $info_empresa_data['nombre_concepto_multi_virtual'];
$cod_estado_comentario_venta_global                                = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_cocina_global                                          = $info_empresa_data['cod_estado_cocina_global'];
$cod_estado_timbre_entrada_pedido_temporal_cocina_global           = $info_empresa_data['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global            = $info_empresa_data['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];
$cod_estado_filtro_aplicacion_chef_bartender_global                = $info_empresa_data['cod_estado_filtro_aplicacion_chef_bartender_global'];

$sql_permiso_usuario = "SELECT nombres, apellidos, cod_estado_origen_produccion, cod_origen_produccion_user FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cod_estado_origen_produccion                                      = $matriz_permiso_usuario['cod_estado_origen_produccion'];
$cod_origen_produccion_user                                        = $matriz_permiso_usuario['cod_origen_produccion_user'];

if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado = '0'"; 
} 
else { 
    $condic_estado_info = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_origen_produccion_user = ""; 
    $condic_estado_revisado_info = ", cod_estado_revisado = '0'"; 
}


/*
if($cod_estado_origen_produccion == 1 && $cod_origen_produccion_user == 1) { //COCINA
    $condicional_origen_produccion = 'AND cod_origen_produccion = "1"';
} elseif ($cod_estado_origen_produccion == 1 && $cod_origen_produccion_user == 2) { //BARTENDER
    $condicional_origen_produccion = 'AND cod_origen_produccion = "2"';
} else { //EXTERNA
    $condicional_origen_produccion = '';
}
*/
?>
<table class="table table-dark table-hover table-bordered">
		<thead>
			<tr>
				<th style="text-align:center;">CODIGO</th>
				<th style="text-align:center;">NOMBRE CONCEPTO</th>
				<th style="text-align:center;">CANTIDAD</th>
				<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
				<th style="text-align:center;">FECHA - HORA</th>
				<!--
				<th style="text-align:center;">VALOR UNITARIO</th>
				<td align="center"></td>
				<th style="text-align:center;">VALOR TOTAL</th>
				-->
			</tr>
		</thead>
	<tbody>
<?php
$incre                             = 0;
$nombre_producto_concat            = '';

$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta' $condic_origen_produccion_user) 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
$total_reg = mysqli_num_rows($consulta_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

	$cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
	$cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
	$cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
	$nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
	$cedula                            = $datos_venta_producto_temporal['cedula'];
	$nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
	$und_venta                         = $datos_venta_producto_temporal['und_venta'];
	$precio_costo_producto             = $datos_venta_producto_temporal['precio_costo_producto'];
	$precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
	$total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
	$precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
	$total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
	$nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
	$nombre_tipo_unidad_medida         = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
	$posologia_cantidad                = $datos_venta_producto_temporal['posologia_cantidad'];
	$posologia_peso                    = $datos_venta_producto_temporal['posologia_peso'];
	$nombre_tipo_presentacion          = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
	$nombre_via_administracion         = $datos_venta_producto_temporal['nombre_via_administracion'];
	$nombre_frec_duracion              = $datos_venta_producto_temporal['nombre_frec_duracion'];
	$cod_tipo_cobrar                   = $datos_venta_producto_temporal['cod_tipo_cobrar'];
	//$cod_info_factura_venta            = $datos_venta_producto_temporal['cod_info_factura_venta'];
	$nombre_tipo_precio_venta          = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
	$cod_estado_permitir_venta         = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
	$und_producto                      = $datos_venta_producto_temporal['und_producto'];

	$comentario_producto               = $datos_venta_producto_temporal['comentario_producto'];
	$placa_producto                    = $datos_venta_producto_temporal['placa_producto'];
	$fecha_ymd_parqueo_ini             = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
	$fecha_hora_parqueo_ini            = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
	$fecha_ymd_parqueo_fin             = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
	$fecha_hora_parqueo_fin            = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];
    $cod_estado_revisado_cocina        = $datos_venta_producto_temporal['cod_estado_revisado_cocina'];
    $fecha_seg_venta_producto          = date("Y-m-d H:i:s", $datos_venta_producto_temporal['fecha_seg_venta_producto']);

	if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
	if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

	if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }

    if ($cod_estado_revisado_cocina == '0') { 
    	$cod_producto_barra = "<mark>".$cod_producto_barra.'</mark>'; 
    	$nombre_producto = "<mark>".$nombre_producto.'</mark>'; 
    	$und_venta = "<mark>".$und_venta.'</mark>'; 
    	$comentario_producto = "<mark>".$comentario_producto.'</mark>'; 
    	$fecha_seg_venta_producto = "<mark>".$fecha_seg_venta_producto.'</mark>'; 
    }
    
	$incre++;
?>
		<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto_temporal;?>">
			<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
			<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
			<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $und_venta ?></td>
			<td style="text-align:center;" id="comentario_producto_<?php echo $incre;?>"><?php echo $comentario_producto;?></td>
			<td style="text-align:center;" id="fecha_seg_venta_producto_<?php echo $incre;?>"><?php echo $fecha_seg_venta_producto;?></td>
			<!--
			<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
			<td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>
			<td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
			-->
		</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto_temporal;?>">
	<?php } ?>
	</tbody>
</table>