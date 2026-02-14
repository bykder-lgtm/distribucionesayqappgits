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
$tabla_caja_mesa                    = "";

header('Content-Type: application/json');


if (isset($_REQUEST['nombre_estado_factura'])) {
    $nombre_estado_factura                = addslashes($_REQUEST['nombre_estado_factura']);
    $cuenta                               = addslashes($_REQUEST['cuenta']);
    $cod_administrador                    = intval($_REQUEST['cod_administrador']);

    $mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion, 
    nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, 
    cod_estado_revisado, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, latitud, longitud, latitud_longitud, 
    cod_estado_revisado_cocina, cod_estado_revisado_bartender, cod_estado_revisado_jugueria
    FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_estado_revisado_notificacion_vendedor = '1')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql);
    $total_reg = mysqli_num_rows($consulta);

    if ($total_reg <> '0') {
        $datos_array['salida_aviso_tombre_despachado_vendedor_cocina_ajax'] = '<audio autoplay><source src="../sonidos/timbre_salida_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>';
        $datos_array['cuenta'] = $cuenta;
        $datos_array['cod_administrador'] = $cod_administrador;
        $datos_array['total_reg'] = $total_reg;
    } else {
        $datos_array['salida_aviso_tombre_despachado_vendedor_cocina_ajax'] = '';
        $datos_array['cuenta'] = $cuenta;
        $datos_array['cod_administrador'] = $cod_administrador;
        $datos_array['total_reg'] = $total_reg;
    }
    echo json_encode($datos_array);
}

?>