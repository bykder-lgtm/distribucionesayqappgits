<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                   = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                = $_SESSION['usuario'];
$cod_administrador                               = ($_SESSION['cod_administrador']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
// Inicializar respuesta por defecto
$respuesta_final = array('success' => false, 'message' => 'Error: Parámetros no válidos', 'telegram_response' => null );

if (isset($_REQUEST['cod_info_factura_venta'])) {
    $cod_info_factura_venta                      = intval($_REQUEST['cod_info_factura_venta']);
    $pagina                                      = isset($_REQUEST['pagina']) ? $_REQUEST['pagina'] : '';
    $btn_origen                                  = isset($_REQUEST['btn_origen']) ? $_REQUEST['btn_origen'] : '';
    $cod_nota_observacion_vector                 = isset($_REQUEST['cod_notas_observacion_vector']) ? $_REQUEST['cod_notas_observacion_vector'] : '';

    if(isset($_REQUEST['estado_registro'])) { $estado_registro = $_REQUEST['estado_registro']; } else { $estado_registro = ''; }
    if($estado_registro == 'CLIENTE') { $mensaje_complementario = 'del cliente'; } else { $mensaje_complementario = 'de tu solicitud de crédito'; }   
    // Validar que cod_info_factura_venta sea válido
    if ($cod_info_factura_venta <= 0) { $respuesta_final['message'] = 'Error: ID de factura no válido'; header('Content-Type: application/json'); echo json_encode($respuesta_final); exit; }

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
    // Verificar que existe la factura
    if (mysqli_num_rows($consulta_data_info_factura) == 0) { $respuesta_final['message'] = 'Error: Factura no encontrada'; header('Content-Type: application/json'); echo json_encode($respuesta_final); exit; }
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

    $cod_info_factura_venta                                         = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $fecha_ymdhis                                                   = $data_info_factura['fecha_ymdhis'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $fecha_anyo                                                     = $data_info_factura['fecha_anyo'];
    $fecha_hora                                                     = $data_info_factura['fecha_hora'];
    $cod_tipo_pago                                                  = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                                              = $data_info_factura['cod_administrador'];
    $total_precio_venta                                             = $data_info_factura['total_precio_venta'];
    $cod_tipo_forma_pago                                            = $data_info_factura['cod_tipo_forma_pago'];
    $monto_deuda                                                    = $data_info_factura['monto_deuda'];
    $monto_cuota                                                    = $data_info_factura['monto_cuota'];
    $numero_cuota                                                   = $data_info_factura['numero_cuota'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $cod_entidad_crediticia                                         = $data_info_factura['cod_entidad_crediticia'];
    $cod_tienda                                                     = $data_info_factura['cod_tienda'];
    $cod_operador_credito                                           = $data_info_factura['cod_operador_credito'];
    $cod_tipo_forma_pago_operador_credito                           = $data_info_factura['cod_tipo_forma_pago_operador_credito'];
    $descripcion_tipo_forma_pago_operador_credito                   = $data_info_factura['descripcion_tipo_forma_pago_operador_credito'];
    $cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $direccion_tercero                                              = $data_info_factura['direccion_tercero'];
    $telefono1_tercero                                              = $data_info_factura['telefono1_tercero'];
    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $correo_tercero                                                 = $data_info_factura['correo_tercero'];
    $codigo_estado_facturacion                                      = $data_info_factura['cod_estado_factura'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_estado_facturacion = "SELECT nombre_estado_facturacion FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$codigo_estado_facturacion')";
    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion);
    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

    $nombre_estado_facturacion                                      = $datos_estado_facturacion['nombre_estado_facturacion'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Función para obtener nombres de administrador con validación
    function obtenerNombresAdmin($conectar, $cod_admin, $tipo_admin) { if (empty($cod_admin) || $cod_admin == 0) { return "No asignado"; }
        $sql = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_admin')";
        $consulta = mysqli_query($conectar, $sql);
        if ($consulta && mysqli_num_rows($consulta) > 0) { $datos = mysqli_fetch_assoc($consulta); return trim($datos['nombres'] . ' ' . $datos['apellidos']); }
        return $tipo_admin . " no encontrado";
    }
    
    $nombres_apellidos_lider = obtenerNombresAdmin($conectar, $cod_administrador_lider, "Líder");
    $nombres_apellidos_coordinador = obtenerNombresAdmin($conectar, $cod_administrador_coordinador, "Coordinador");
    $nombres_apellidos_asesor = obtenerNombresAdmin($conectar, $cod_administrador_asesor, "Asesor");
    $nombres_apellidos_aliado_estrategico = obtenerNombresAdmin($conectar, $cod_administrador_aliado_estrategico, "Aliado Estratégico");
    $nombres_apellidos_revisor = obtenerNombresAdmin($conectar, $cod_administrador_revisor, "Revisor");
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Obtener información de entidad crediticia
    $nombre_entidad_crediticia = "No especificada";
    if (!empty($cod_entidad_crediticia) && $cod_entidad_crediticia > 0) {
        $sql_entidad_crediticia = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
        $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia);
        if ($consulta_entidad_crediticia && mysqli_num_rows($consulta_entidad_crediticia) > 0) {
            $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);
            $nombre_entidad_crediticia = $datos_entidad_crediticia['nombre_entidad_crediticia'];
        }
    }
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Obtener información de tienda
    $nombre_tienda = "No especificada";
    if (!empty($cod_tienda) && $cod_tienda > 0) {
        $sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
        $consulta_tienda = mysqli_query($conectar, $sql_tienda);
        if ($consulta_tienda && mysqli_num_rows($consulta_tienda) > 0) {
            $datos_tienda = mysqli_fetch_assoc($consulta_tienda);
            $nombre_tienda = $datos_tienda['nombre_tienda'];
        }
    }
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Obtener información de operador de crédito
    $nombre_operador_credito = "No especificado";
    if (!empty($cod_operador_credito) && $cod_operador_credito > 0) {
        $sql_operador_credito = "SELECT nombre_operador_credito FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
        $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito);
        if ($consulta_operador_credito && mysqli_num_rows($consulta_operador_credito) > 0) {
            $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);
            $nombre_operador_credito = $datos_operador_credito['nombre_operador_credito'];
        }
    }
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Obtener información del producto
    $cod_producto_barra = "No especificado";
    $nombre_producto = "No especificado";
    $sql_venta_producto = "SELECT cod_producto_barra, nombre_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
    if ($consulta_venta_producto && mysqli_num_rows($consulta_venta_producto) > 0) {
        $datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto);
        $cod_producto_barra = $datos_venta_producto['cod_producto_barra'] ?: "No especificado";
        $nombre_producto = $datos_venta_producto['nombre_producto'] ?: "No especificado";
    }
    /* ----------------------------------------------------------------------------------------------------------/ */
    // Construir nombre completo del cliente con los datos ya obtenidos
    $nombre_cliente = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero);
//---------------------------------------------------------------------------------------------------------------------------------//
	$fecha_creacion                                                 = date("Y-m-d H:i:s");
//---------------------------------------------------------------------------------------------------------------------------------//
    // Procesar el vector de cod_nota_observacion
    $texto_titulo                            = 'Registro exitoso de solicitud de crédito'."\n";
    $contaenar_nombre_nota_observacion       = "\n"."\n";
    if(isset($_REQUEST['cod_notas_observacion_vector'])) {
        if ($btn_origen == 'imagenes_iniciales') { $texto_titulo = 'Se han cargado exitosamente las imagenes'; } else { $texto_titulo = 'Se han cargado exitosamente las imagenes!'; }

        $cod_nota_observacion_vector_limpio      = str_replace(['"', ' '], '', $cod_nota_observacion_vector);
        $cod_nota_observacion_vector_limpio      = str_replace(['\\', ''], '', $cod_nota_observacion_vector_limpio);
        $cod_nota_observacion_vector_limpio      = str_replace(['[', ''], '', $cod_nota_observacion_vector_limpio);
        $cod_nota_observacion_vector_limpio      = str_replace([']', ''], '', $cod_nota_observacion_vector_limpio);
        $cod_nota_observacion_vector_limpio      = trim($cod_nota_observacion_vector_limpio);
        $cod_nota_observacion_vector_final       = explode(",", $cod_nota_observacion_vector_limpio);

        foreach ($cod_nota_observacion_vector_final as $cod_nota_observacion) {
            $cod_nota_observacion = intval($cod_nota_observacion);
            $sql_notas_observacion = "SELECT nombre_nota_observacion FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion')";
            $consulta_notas_observacion = mysqli_query($conectar, $sql_notas_observacion) or die(mysqli_error($conectar));
            $datos_notas_observacion = mysqli_fetch_assoc($consulta_notas_observacion);

            $nombre_nota_observacion                  = '*✓ '.$datos_notas_observacion['nombre_nota_observacion'].'*';
            $contaenar_nombre_nota_observacion       .= $nombre_nota_observacion."\n";
        }
        $contaenar_nombre_nota_observacion       .= "\n";
    }
//---------------------------------------------------------------------------------------------------------------------------------//
	$texto_mensaje_formateado  = "";
	$texto_mensaje_formateado .= "*✅ ".$texto_titulo."*";
    if(isset($_REQUEST['cod_notas_observacion_vector'])) {
        $texto_mensaje_formateado .= $contaenar_nombre_nota_observacion;
    } else {
        $texto_mensaje_formateado .= "🏬 *Estado:* ".$nombre_estado_facturacion;
        $texto_mensaje_formateado .= "\n";
        $texto_mensaje_formateado .= "\n";
    }
	$texto_mensaje_formateado .= "🤝 *Aliado estrategico: *".$nombres_apellidos_aliado_estrategico;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "🏬 *Tienda:* ".$nombre_tienda;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "*Datos del Cliente*";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "*Cliente: *".$nombre_cliente;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "🛍️ *Producto:* ".$nombre_producto;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "💰 *Monto del crédito:* ".number_format($monto_deuda);
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "📆 *Cuota mensual:* ".number_format($monto_cuota);
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "🏦 *Linea de Credito:* ".$nombre_entidad_crediticia;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "🕵️ *Revisor:* ".$nombres_apellidos_revisor;
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "📩 *Importante:* En los proximos minutos nos comunicaremos para continuar con el proceso\.";
	$texto_mensaje_formateado .= "\n";
	$texto_mensaje_formateado .= "_Gracias por confiar en nosotros\._";
//---------------------------------------------------------------------------------------------------------------------------------//
	//$token_AsincLearnSwift = "8482849863:AAFLvg9q19Y9h5o8XajseMcoEeYELqk3lLs";
	//id canal (AsincLearnSwift): -1003088703944

	//id chat (Virgin GPS Moto Tel Me): 7976434029
	//id chat (Me Est Propio Wom): 6329228090

	//id canal_Virgin (NotificadorDtx): -1003104321542
	//$token_Virgin = "8323068794:AAF3kRp1wveO4lcbytnpmBXXDtpkVIoG-bI";

    $token_chatbot_telegram = "8323068794:AAF3kRp1wveO4lcbytnpmBXXDtpkVIoG-bI";//
	$datos_json_telegram = [
	    'chat_id' => '-1003104321542',//Aquí va el id númerico del destinatario
	    'text' => $texto_mensaje_formateado,
	    'parse_mode' => 'MarkdownV2' #formato del mensaje
	    #'chat_id' => '@el_canal si va dirigido a un canal',
	    //'text' => 'El mensaje con *formato* que el bot va a enviar, los puntos van escapados con barra invertida\. Un enlace a un [sitio](https://www.editaxe.com.co/)\.',
	];
	$curl                                        = curl_init();
	$url_enviar_datos_chatbot_telegram           = "https://api.telegram.org/bot".$token_chatbot_telegram."/sendMessage";

	curl_setopt($curl, CURLOPT_URL, $url_enviar_datos_chatbot_telegram);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $datos_json_telegram);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$respuesta_json = curl_exec($curl);
	$curl_error = curl_error($curl);
	curl_close($curl);

	// Procesar respuesta de Telegram
	if ($curl_error) {
	    $respuesta_final['success'] = false;
	    $respuesta_final['message'] = 'Error de conexión: ' . $curl_error;
	    $respuesta_final['telegram_response'] = null;
	} else {
	    $telegram_data = json_decode($respuesta_json, true);
	    if ($telegram_data && isset($telegram_data['ok']) && $telegram_data['ok'] === true) {
	        $respuesta_final['success'] = true;
	        $respuesta_final['message'] = 'Notificación enviada correctamente';
	        $respuesta_final['telegram_response'] = $telegram_data;
	    } else {
	        $respuesta_final['success'] = false;
	        $respuesta_final['message'] = 'Error al enviar notificación a Telegram';
	        $respuesta_final['telegram_response'] = $telegram_data;
	    }
	}

	header('Content-Type: application/json');
	echo json_encode($respuesta_final);
} else {
    // Si no se proporcionaron parámetros, devolver error
    header('Content-Type: application/json');
    echo json_encode($respuesta_final);
}
?>