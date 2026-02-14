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
$cod_estado_posicion_mapa_gps_pedidos_info_venta_global            = $info_empresa_data['cod_estado_posicion_mapa_gps_pedidos_info_venta_global'];
$cod_estado_filtro_aplicacion_chef_bartender_global                = $info_empresa_data['cod_estado_filtro_aplicacion_chef_bartender_global'];


if (isset($_REQUEST['pagina'])) { $pagina = 'lista_caja_virtual_cocina.php'; } else { $pagina = 'lista_caja_virtual_cocina.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = 'lista_caja_virtual_cocina.php'; } else { $pagina_redirect = 'lista_caja_virtual_cocina.php'; }
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }

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
    $condic_estado_revisado_venta_temp = ", cod_estado_revisado_universal = '0'"; 
}

$tabla_caja_mesa .= '<table class="table table-dark table-hover table-bordered">';
$tabla_caja_mesa .= '   <thead>';
$tabla_caja_mesa .= '	<tr>';

$tabla_caja_mesa .= '		<th style="text-align:center;">VER</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">'.$nombre_concepto_multi_virtual.'</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">USUARIO</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">DESCRIPCION</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;"></th>';

if ($cod_estado_prioridad_caja_mesa_global == '1') {
    $tabla_caja_mesa .= '		<th style="text-align:center;">PRIORIDAD</th>';
}

$tabla_caja_mesa .= '		<th style="text-align:center;">FECHA | HORA</th>';
$tabla_caja_mesa .= '		<th style="text-align:center;">ATENDIDO</th>';

$tabla_caja_mesa .= '	</tr>';
$tabla_caja_mesa .= '   </thead>';
$tabla_caja_mesa .= '   <tbody>';
?>

<?php
$nombre_producto_concat             = '';

$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, 
cod_estado_revisado, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, latitud, longitud, latitud_longitud, 
cod_estado_revisado_cocina, cod_estado_revisado_bartender, cod_estado_revisado_jugueria
FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') $condic_estado_info $ordenar_consulta";
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
    $cod_estado_revisado_cocina         = $datos['cod_estado_revisado_cocina'];
    $cod_estado_revisado_bartender      = $datos['cod_estado_revisado_bartender'];
    $cod_estado_revisado_jugueria       = $datos['cod_estado_revisado_jugueria'];

    if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
    if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }
    //if (($cod_estado_revisado_cocina == '0') && ($cod_origen_produccion_user == '1')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
    //if (($cod_estado_revisado_bartender == '0') && ($cod_origen_produccion_user == '2')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
    //if (($cod_estado_revisado_jugueria == '0') && ($cod_origen_produccion_user == '3')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

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

    $sql_datos_venta_temp = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, nombre_producto, cod_estado_revisado, cod_estado_revisado_cocina, 
    cod_estado_revisado_bartender, cod_estado_revisado_jugueria, comentario_producto, cod_origen_produccion  
    FROM tbl15_venta_producto_temporal 
    WHERE (cod_info_factura_venta = '$cod_info_factura_venta') $condic_origen_produccion_user $condic_estado_venta_temp ORDER BY cod_venta_producto_temporal DESC";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_venta_con                       = $datos_venta_temp['und_venta'];
        $comentario_producto_con             = $datos_venta_temp['comentario_producto'];
        $cod_origen_produccion_con           = $datos_venta_temp['cod_origen_produccion'];
        $cod_estado_revisado_con             = $datos_venta_temp['cod_estado_revisado'];
        $cod_estado_revisado_cocina_con      = $datos_venta_temp['cod_estado_revisado_cocina'];
        $cod_estado_revisado_bartender_con   = $datos_venta_temp['cod_estado_revisado_bartender'];
        $cod_estado_revisado_jugueria_con    = $datos_venta_temp['cod_estado_revisado_jugueria'];

        if ($cod_estado_marcado_revisado_caja_mesa_venta_temporal_global == '1') { $nombre_producto_concat .= "<mark>".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'</mark><br>'; } else { $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'<br>'; }
    }

    $sql_datos_venta_temp_total = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
    $datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

    $total_venta_producto_ciclo                = $datos_venta_temp_total['total_venta_producto'];

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

    $tabla_caja_mesa .= '		<th style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_base_caja='.$cod_base_caja.'&pagina='.$pagina_redirect.'"><img src=../imagenes/ver3.png alt="ver"></a></th>';
    $tabla_caja_mesa .= '		<th style="text-align:center;">'.$cod_base_caja.'</th>';
    $tabla_caja_mesa .= '		<th style="text-align:left;">'.$nombre_usuario.'</th>';
    $tabla_caja_mesa .= '		<th style="text-align:left;">'.$nombre_producto_concat.'</th>';
    $tabla_caja_mesa .= '		<th style="text-align:left;">'.$observacion.'</th>';

    if ($cod_estado_prioridad_caja_mesa_global == '1') {
        $tabla_caja_mesa .= '		<th style="text-align:center;">'.$cod_prioridad.'</th>';
    }

        $tabla_caja_mesa .= '		<th style="text-align:center;">'.$fecha_anyo.' | '.$fecha_hora.'</th>';
        $tabla_caja_mesa .= '		<th style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_base_caja='.$cod_base_caja.'&pagina='.$pagina_redirect.'"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></a></th>';

        $tabla_caja_mesa .= '	</tr>';

}
$tabla_caja_mesa .= '   </tbody>';
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

$datos_array = array('salida_tabla_caja_mesa_ajax' => $tabla_caja_mesa);
echo json_encode($datos_array);
?>