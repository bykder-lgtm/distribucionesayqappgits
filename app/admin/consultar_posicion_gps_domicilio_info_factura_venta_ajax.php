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


if (isset($_REQUEST['cod_info_factura_venta'])) {
$cod_info_factura_venta = intval($_REQUEST['cod_info_factura_venta']);

if (isset($_REQUEST['pagina'])) { $pagina = addslashes($_REQUEST['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = addslashes($_REQUEST['pagina_redirect']); } else { $pagina_redirect = 'facturacion_venta_temporal_producto_manual_pos.php'; }

$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud
FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$datos = mysqli_fetch_assoc($consulta);


$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cod_caja_virtual                   = $datos['cod_caja_virtual'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$nombre1_tercero                    = $datos['nombre1_tercero'];
$direccion_tercero                  = $datos['direccion_tercero'];
$telefono1_tercero                  = $datos['telefono1_tercero'];
$correo_tercero                     = $datos['correo_tercero'];
$cod_tipo_metodo_envio              = $datos['cod_tipo_metodo_envio'];
$cod_tipo_aplicacion                = $datos['cod_tipo_aplicacion'];
$cod_zona_envio                     = $datos['cod_zona_envio'];
$observacion                        = $datos['observacion'];
$latitud                            = $datos['latitud'];
$longitud                           = $datos['longitud'];
$latitud_longitud                   = $datos['latitud_longitud'];


$datos_array = array('nombre1_tercero' => $nombre1_tercero, 'telefono1_tercero' => $telefono1_tercero, 'direccion_tercero' => $direccion_tercero, 'correo_tercero' => $correo_tercero, 'latitud' => $latitud, 'longitud' => $longitud, 'latitud_longitud' => $latitud_longitud);
echo json_encode($datos_array);
} 
?>