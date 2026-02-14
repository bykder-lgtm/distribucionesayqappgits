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

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                  = $info_empresa_data['titulo'];
$nombre_emp                                                  = $info_empresa_data['nombre'];
$eslogan_emp                                                 = $info_empresa_data['eslogan'];
$direccion_emp                                               = $info_empresa_data['direccion'];
$ciudad_emp                                                  = $info_empresa_data['ciudad'];
$pais_emp                                                    = $info_empresa_data['pais'];
$correo_emp                                                  = $info_empresa_data['correo'];
$img_cabecera_emp                                            = $info_empresa_data['img_cabecera'];
$telefono_emp                                                = $info_empresa_data['telefono'];
$info_legal_emp                                              = $info_empresa_data['info_legal'];
$logotipo_emp                                                = $info_empresa_data['logotipo'];
$nit_empresa_emp                                             = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                = $info_empresa_data['cabecera'];
$icono_emp                                                   = $info_empresa_data['icono'];
$nombre_concepto_multi_virtual                               = $info_empresa_data['nombre_concepto_multi_virtual'];
$cod_estado_comentario_venta_global                          = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_cocina_global                                    = $info_empresa_data['cod_estado_cocina_global'];
$cod_estado_timbre_entrada_pedido_temporal_cocina_global     = $info_empresa_data['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global      = $info_empresa_data['cod_estado_timbre_salida_pedido_temporal_cocina_global'];

if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
$pagina_local        = '../admin/lista_caja_virtual_cocina.php';
?>

<table class="table table-hover">
<tr>
<th style="text-align:center;">VER</th>
<th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
<th style="text-align:center;">USUARIO</th>
<th style="text-align:center;">DESCRIPCION</th>
<th style="text-align:center;"></th>
<th style="text-align:center;">PRIORIDAD</th>
<!--<th style="text-align:center;">CLIENTE</th>-->
<th style="text-align:center;">FECHA | HORA</th>
<th style="text-align:center;">ATENDIDO</th>
</tr>
<?php
$nombre_producto_concat             = '';

$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion 
FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_estado_cocina = '0') ORDER BY cod_prioridad";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_reg = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$nombre_producto_concat             = '';
$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cod_caja_virtual                   = $datos['cod_caja_virtual'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$cod_prioridad                      = $datos['cod_prioridad'];
$cod_base_caja                      = $datos['cod_base_caja'];
$observacion                        = $datos['observacion'];

$sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
$nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
$apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
$apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

$cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_info_usuario = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
$datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

$nombres                            = $datos_info_usuario['nombres'];
$apellidos                          = $datos_info_usuario['apellidos'];
$nombre_usuario                     = $nombres.' '.$apellidos;

$sql_datos_venta_temp = "SELECT cod_producto_barra, und_venta, nombre_producto, comentario_producto FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

$nombre_producto_concat             .= intval($datos_venta_temp['und_venta']).' | '.$datos_venta_temp['nombre_producto'].' | '.$datos_venta_temp['comentario_producto'].'<br>';
}
?>
<tr>
<td style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/ver3.png alt="ver"></td>
<td style="text-align:center;"><?php echo $cod_base_caja; ?></td>
<td style="text-align:left;"><?php echo $nombre_usuario; ?></td>
<td style="text-align:left;"><?php echo $nombre_producto_concat; ?></td>
<td style="text-align:left;"><?php echo $observacion; ?></td>
<td style="text-align:center;"><?php echo $cod_prioridad; ?></td>
<!--<td style="text-align:left;"><?php echo $cliente; ?></td>-->
<td style="text-align:center;"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></td>
<td style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></td>
</tr>
<?php } ?>
</table>

<?php 
if ($cod_estado_timbre_entrada_pedido_temporal_cocina_global == '1') { 

$mostrar_datos_sql = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_estado_timbre_entrada = '0')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_registro = mysqli_num_rows($consulta);

if ($total_registro <> '0') { 
$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_timbre_entrada = '1'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
?>
<audio autoplay><source src="../sonidos/timbre_entrada_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>
<?php } ?>
<?php } ?>
