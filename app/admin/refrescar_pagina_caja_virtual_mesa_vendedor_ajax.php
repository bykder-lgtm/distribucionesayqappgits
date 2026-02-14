<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
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
$cod_seguridad                      = ($_SESSION['cod_seguridad']);
$cod_caja_virtual                   = ($_SESSION['cod_caja_virtual']);
$token                              = ($_SESSION['token']);
$cod_administrador_glob             = intval($_REQUEST['cod_administrador']);
$cuenta_actual_glob                 = addslashes($_REQUEST['cuenta_actual']);


include_once('../admin/01_modulo_permisos.php');

header('Content-Type: application/json');

$retorno_array                      = array();
$retorno_array2                     = array();
$tabla_caja_mesa                    = '';
$codigoHTML_menu_total_reg          = '';
$pagina_local                       = $_SERVER['PHP_SELF'];
$respuesta_ajax                     = array();
$total_reg                          = 0;


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
$cod_estado_habilitar_hora_venta_temporal_global                   = $info_empresa_data['cod_estado_habilitar_hora_venta_temporal_global'];
$cod_estado_revisado_venta_temporal_global                         = $info_empresa_data['cod_estado_revisado_venta_temporal_global'];
$cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global        = $info_empresa_data['cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global'];
$cod_estado_habilitar_hora_venta_temporal_global                   = $info_empresa_data['cod_estado_habilitar_hora_venta_temporal_global'];
$cod_estado_prioridad_caja_mesa_global                             = $info_empresa_data['cod_estado_prioridad_caja_mesa_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global       = $info_empresa_data['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_tipo_metodo_envio_global                               = $info_empresa_data['cod_estado_tipo_metodo_envio_global'];
$cod_estado_posicion_mapa_gps_pedidos_info_venta_global            = $info_empresa_data['cod_estado_posicion_mapa_gps_pedidos_info_venta_global'];
$limite_mostrar_producto_lista_caja_virtual                        = $info_empresa_data['limite_mostrar_producto_lista_caja_virtual'];


if (isset($_REQUEST['pagina'])) { $pagina = addslashes($_REQUEST['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = addslashes($_REQUEST['pagina_redirect']); } else { $pagina_redirect = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }
if ($limite_mostrar_producto_lista_caja_virtual == '0') { $limite_mostrar_registro = ''; } else { $limite_mostrar_registro = 'LIMIT 0,'.$limite_mostrar_producto_lista_caja_virtual; }
if ($_REQUEST['caja_mesa'] <> '') {  $caja_mesa = intval($_REQUEST['caja_mesa']); $filtro_buscar_mesa = "AND (cod_base_caja = '$caja_mesa')"; } else { $caja_mesa = ''; $filtro_buscar_mesa = ""; }


if ($cod_seguridad == "1") {
$sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA')";
$consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
$datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

$sql_domicilio = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2')";
$consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
$total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

$sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal";
$consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
$datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
} else {
$sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual_glob')";
$consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
$datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

$sql_domicilio = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2') AND (cuenta = '$cuenta_actual_glob')";
$consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
$total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

$sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto 
FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual_glob')";
$consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
$datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
}
$total_caja_mesa_en_uso                 = $datos_mesa_caja_uso['total_caja_mesa_en_uso'];
$total_venta_producto_sup               = $datos_venta_temp_total_sup['total_venta_producto'];



$tabla_caja_mesa .= '<table class="table table-hover">';
$tabla_caja_mesa .= '	<tr>';
$tabla_caja_mesa .= '		<th style="text-align:center;">USUARIO</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">'.$nombre_concepto_multi_virtual.'S EN USO</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">TOTAL '.$nombre_concepto_multi_virtual.'S</th>';
$tabla_caja_mesa .= '	</tr>';
?>

<?php
$nombre_producto_concat             = '';

if ($cod_seguridad=='1') {
$mostrar_datos_sql = "SELECT COUNT(cod_administrador) AS total_mesa_caja, cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud
FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') GROUP BY cod_administrador";
} else {
$mostrar_datos_sql = "SELECT COUNT(cod_administrador) AS total_mesa_caja, cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud
FROM tbl15_info_factura_venta 
WHERE (cuenta = '$cuenta_actual') AND (nombre_estado_factura = 'ABIERTA') GROUP BY cod_administrador";
}
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_reg = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$nombre_producto_concat             = '';
$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$cod_prioridad                      = $datos['cod_prioridad'];
$cod_base_caja                      = $datos['cod_base_caja'];
$nombre1_tercero                    = $datos['nombre1_tercero'];
$nombre2_tercero                    = $datos['nombre2_tercero'];
$apellido1_tercero                  = $datos['apellido1_tercero'];
$apellido2_tercero                  = $datos['apellido2_tercero'];
$identificacion_tercero             = $datos['identificacion_tercero'];
$fecha_nac_tercero                  = $datos['fecha_nac_tercero'];
$direccion_tercero                  = $datos['direccion_tercero'];
$telefono1_tercero                  = $datos['telefono1_tercero'];
$correo_tercero                     = $datos['correo_tercero'];
$cod_estado_revisado                = $datos['cod_estado_revisado'];
$cod_tipo_metodo_envio              = $datos['cod_tipo_metodo_envio'];
$cod_tipo_aplicacion                = $datos['cod_tipo_aplicacion'];
$cod_zona_envio                     = $datos['cod_zona_envio'];
$observacion_db                     = $datos['observacion'];
$latitud                            = $datos['latitud'];
$longitud                           = $datos['longitud'];
$latitud_longitud                   = $datos['latitud_longitud'];
$total_mesa_caja                    = $datos['total_mesa_caja'];

if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }
if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

$sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
$nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
$apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
$apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

$cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
$datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

$nombres                            = $datos_info_usuario['nombres'];
$apellidos                          = $datos_info_usuario['apellidos'];
$nombre_usuario                     = $nombres.' '.$apellidos;
$cuenta_usuario                     = $datos_info_usuario['cuenta'];

$sql_datos_venta_temp = "SELECT cod_base_caja, cod_caja_virtual, cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cod_administrador = '$cod_administrador') AND (nombre_estado_factura = 'ABIERTA')";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

$cod_base_caja                       = $datos_venta_temp['cod_base_caja'];
$cod_caja_virtual                    = $datos_venta_temp['cod_caja_virtual'];
$cod_info_factura_venta              = $datos_venta_temp['cod_info_factura_venta'];

$sql_datos_venta_temp_total = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
$datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

$total_venta_producto_ciclo          = $datos_venta_temp_total['total_venta_producto'];
$nombre_producto_concat             .= '<a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_base_caja='.$cod_base_caja.'&pagina='.$pagina_redirect.'">'.$nombre_concepto_multi_virtual.' '.$cod_base_caja.' | | $'.number_format($total_venta_producto_ciclo, 0, ",", ".").'</a><br>'; 
}

$sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
$consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio);
$datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

$nombre_tipo_metodo_envio                  = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];

$sql_tipo_aplicacion = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE (cod_tipo_aplicacion = '$cod_tipo_aplicacion')";
$consulta_tipo_aplicacion = mysqli_query($conectar, $sql_tipo_aplicacion);
$datos_tipo_aplicacion = mysqli_fetch_assoc($consulta_tipo_aplicacion);

$nombre_tipo_aplicacion                    = $datos_tipo_aplicacion['nombre_tipo_aplicacion'];


$sql_zona_envio = "SELECT nombre_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '$cod_zona_envio')";
$consulta_zona_envio = mysqli_query($conectar, $sql_zona_envio);
$datos_zona_envio = mysqli_fetch_assoc($consulta_zona_envio);

$nombre_zona_envio                         = $datos_zona_envio['nombre_zona_envio'];


$tabla_caja_mesa .= '	<tr>';
$tabla_caja_mesa .= '		<td style="text-align:center;"><h4>'.$cuenta_usuario.'</h4></td>';
$tabla_caja_mesa .= '		<td style="text-align:center;"><h4>'.$nombre_producto_concat.'</h4></td>';
$tabla_caja_mesa .= '		<td style="text-align:center;"><h4>'.$total_mesa_caja.'</h4></td>';
$tabla_caja_mesa .= '	</tr>';
} 
$tabla_caja_mesa .= '</table>';
?>



<?php if ($cod_estado_timbre_entrada_pedido_temporal_cocina == '1') { 
$cod_estado_timbre_entrada           = '1';

$mostrar_datos_sql = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_estado_timbre_entrada = '0') LIMIT 0,1";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_registro = mysqli_num_rows($consulta);
$info_data = mysqli_fetch_assoc($consulta);

$cod_info_factura_venta              = $info_data['cod_info_factura_venta'];

if ($total_registro <> '0') { 
$agregar_regis = "UPDATE tbl15_info_factura_venta SET cod_estado_timbre_entrada = '$cod_estado_timbre_entrada' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
$tabla_caja_mesa .= '<audio autoplay><source src="../sonidos/timbre_entrada_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>';
}
} 

$datos_array = array('total_caja_mesa_en_uso_ajax' => str_pad($total_caja_mesa_en_uso, 12, "_", STR_PAD_BOTH), 'total_venta_producto_sup_ajax' => str_pad(number_format($total_venta_producto_sup, 0, ",", "."), 12, "_", STR_PAD_BOTH), 'total_reg_domicilio_ajax' => str_pad($total_reg_domicilio, 12, "_", STR_PAD_BOTH), 'salida_tabla_caja_mesa_ajax' => $tabla_caja_mesa);
echo json_encode($datos_array);
?>