<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_info_empresa_visitante_intern_confirmdirect.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);

$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);

$accion_codifcryp                   = $_GET['accion_codifcryp'];
$accion_codif                       = DAXCODIFCRYPTOR::descriptardax($accion_codifcryp);
$accion                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($accion_codif));

$tipo_codifcryp                     = $_GET['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$origen_codifcryp                   = $_GET['origen_codifcryp'];
$origen_codif                       = DAXCODIFCRYPTOR::descriptardax($origen_codifcryp);
$origen                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($origen_codif));
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($accion == 'redirecionar_whatapp' && $origen == 'carrito') {

	$sqlr_adm = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$modificar_adm = mysqli_query($conectar, $sqlr_adm) or die(mysqli_error($conectar));
	$datos_adm = mysqli_fetch_assoc($modificar_adm);

    $cod_factura                                  = $datos_adm['cod_factura'];
    $fecha_anyo                                   = $datos_adm['fecha_anyo'];
    $fecha_hora                                   = $datos_adm['fecha_hora'];
    $cod_tipo_forma_pago                          = $datos_adm['cod_tipo_forma_pago'];
    $cod_administrador_tercero                    = $datos_adm['cod_administrador_tercero'];
    $total_precio_venta                           = $datos_adm['total_precio_venta'];
    $cod_administrador_vendedor                   = $datos_adm['cod_administrador'];

    $sql_info_vendedor = "SELECT nombre1_tercero, apellido1_tercero, telefono1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_vendedor'";
    $consultar_info_vendedor = mysqli_query($conectar, $sql_info_vendedor) or die(mysqli_error($conectar));
    $info_vendedor = mysqli_fetch_assoc($consultar_info_vendedor);

    $nombre1_tercero                              = $info_vendedor['nombre1_tercero'];
    $apellido1_tercero                            = $info_vendedor['apellido1_tercero'];
    $telefono1_tercero                            = $info_vendedor['telefono1_tercero'];

    $sql_info_impresora = "SELECT * FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
    $info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

    $nombre_tipo_forma_pago                       = $info_impresora['nombre_tipo_forma_pago'];

    $enterbr                                      = '%0A';
    $negrita_abre                                 = "%0A*";
    $negrita_cierre                               = "*%0A";
    $info_pedido_producto_concat                  = "";
    $mensaje_whatsapp_formateado_confirm_compra   = '';
    $mensaje_whatsapp_formateado_acceso           = '';
    $mensaje_whatsapp_formateado_garantia         = '';

    $correo_correcion_soporte_tecnico             = '';
    $contrasena_correcion_soporte_tecnico         = '';
    $perfil_correcion_soporte_tecnico             = '';
    $pin_correcion_soporte_tecnico                = '';
    $cliente_correcion_soporte_tecnico            = '';
    $vence_correcion_soporte_tecnico              = '';
    $precio_correcion_soporte_tecnico             = '0';

    $sql_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
    $total_reg = mysqli_num_rows($consulta_producto);
    while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

        $cod_venta_producto                       = $datos_producto['cod_venta_producto'];
        $nombre_producto                          = $datos_producto['nombre_producto'];
        $und_venta                                = $datos_producto['und_venta'];
        $precio_venta_producto                    = $datos_producto['precio_venta_producto'];
        $total_venta_producto                     = $datos_producto['total_venta_producto'];
        $total_venta_ind                          = $und_venta * $precio_venta_producto;
        $total_venta                             += $und_venta * $precio_venta_producto;
        $info_pedido_producto_concat             .= $negrita_abre.'X'.intval($und_venta).' '.$nombre_producto.' %24'.number_format($precio_venta_producto, 0, ",", ".").$negrita_cierre;
        
    }

    $vengo_de                                     = "👋 Vengo de "."urbanstreaming.com"." la compra ha sido cargada correctamente";
    $tipo_solicitud_cliente                       = $negrita_abre.'Tipo de Solicitud'.'%3A '.'Confirmacion de Compra'.$negrita_cierre;
    $fecha_hora_registro                          = '🗓️ '.$fecha_anyo.' ⏰ '.$fecha_hora;
    $nombre_cliente                               = 'Nombre'.'%3A '.trim($nombre1_tercero.' '.$apellido1_tercero).' - IDV:'.$cod_administrador_vendedor;
    $telefono_cliente                             = 'Teléfono%3A '.$telefono1_tercero;
    $productos_cliente                            = $enterbr.'📝 Productos'.$info_pedido_producto_concat;
    $subtotal_cliente                             = 'Subtotal'.'%3A '.number_format($total_precio_venta, 0, ",", ".");
    $entrega_cliente                              = 'Entrega'.'%3A '.'0';
    $total_cliente                                = $negrita_abre.'Total'.'%3A '.number_format($total_precio_venta, 0, ",", ".").$negrita_cierre;
    $titulo_pago_cliente                          = $negrita_abre."💲 Pago".$negrita_cierre;
    $forma_pago_cliente                           = $negrita_abre."Total Pagado".'%3A '.number_format($total_venta, 0, ",", ".").$negrita_cierre.$enterbr.$nombre_tipo_forma_pago.'%3A '.number_format($total_venta, 0, ",", ".");
    $total_saldo_recarga_cliente                  = 'Saldo Actual'.'%3A '.number_format($total_saldo_recarga, 0, ",", ".");
    $factura_cliente                              = $enterbr."FACTURA".'%3A'.$cod_factura;
    $id_cod_info_factura_venta                    = "ID".'%3A'.$cod_info_factura_venta;
    $mensaje_final                                = $enterbr."👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.";
    $mensaje_whatsapp                             = $vengo_de.''.$enterbr.$tipo_solicitud_cliente.$enterbr.$fecha_hora_registro.$enterbr.$nombre_cliente.$enterbr.$telefono_cliente.$enterbr.$productos_cliente.$forma_pago_cliente.$enterbr.$total_saldo_recarga_cliente.$enterbr.$factura_cliente.$enterbr.$id_cod_info_factura_venta.$mensaje_final;

    $mensaje_whatsapp_formateado_confirm_compra  .= '*👋 CONFIRMACIÓN DE COMPRA! 🍿*';
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '🗓️ '.$fecha_anyo.' ⏰ '.$fecha_hora;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'Nombre'.'%3A '.trim($nombre1_tercero.' '.$apellido1_tercero).' - IDV:'.$cod_administrador_vendedor;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Teléfono*: '.$telefono1_tercero;;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '📝 Productos'.$info_pedido_producto_concat;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Subtotal*: $'.number_format($total_precio_venta, 0, ",", ".");
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Total*: $'.number_format($total_precio_venta, 0, ",", ".");
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*FACTURA*: '.$cod_factura;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*ID*: '.$cod_info_factura_venta;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*👆 Envíanos este mensaje ahora. En cuanto lo recibamos estaremos atendiéndole.*';

    $mensaje_whatsapp_formateado_acceso          .= '*¡ACCESO ...! 🍿*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Correo:* '.$correo_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Contraseña*: '.$contrasena_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Perfil:* '.$perfil_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Pin:* '.$pin_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Cliente:* '.$cliente_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Vence:* '.$vence_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*- Precio:* '.number_format($precio_correcion_soporte_tecnico, 0, ",", ".");
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*✨Gracias por su compra✨*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '📝 Reglas de uso:';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No eliminar otros perfiles*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No editar perfiles*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No cambiar pin*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No agregar otro perfil*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No invadir otra pantalla*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No compartir cuenta con nadie*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*🚫 No cambiar imagen y nombre de otros perfiles*';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '⚠️ Leer con atención. Incumplir reglas puede resultar en eliminación de cuenta.';
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= $enterbr;
    $mensaje_whatsapp_formateado_acceso          .= '*¡Disfruta tu acceso! 😊*';

    $mensaje_whatsapp_formateado_garantia        .= '*Garantía de Satisfacción ✨*';
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*NUEVA CONTRASEÑA🔑*';
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '🍿';
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '¡Gracias por confiar en nosotros! 🙏';
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Correo:* '.$correo_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Contraseña*: '.$contrasena_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Perfil:* '.$perfil_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Pin:* '.$pin_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Cliente:* '.$cliente_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Vence:* '.$vence_correcion_soporte_tecnico;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*- Precio:* '.number_format($precio_correcion_soporte_tecnico, 0, ",", ".");
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '🌟 Garantía de satisfacción: Si nuestro servicio no funciona correctamente, te devolveremos los días que no hayas podido disfrutar del servicio. Por favor, lee las reglas de uso para más información.';
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= $enterbr;
    $mensaje_whatsapp_formateado_garantia        .= '*¡Disfruta tu acceso! 😊*';

	$url_redir = "https://api.whatsapp.com/send?phone=57$telefono&text=".$mensaje_whatsapp_formateado_confirm_compra;
	header("Location: $url_redir");
} 
elseif ($accion == 'redirecionar_telefono' && $origen == 'carrito') {

	$url_redir = "tel:57$telefono";
	header("Location: $url_redir");
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>