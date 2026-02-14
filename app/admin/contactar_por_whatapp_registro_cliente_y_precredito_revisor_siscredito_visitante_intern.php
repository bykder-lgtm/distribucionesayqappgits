<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_info_empresa_visitante_intern_confirmdirect.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_info_factura_venta'])) {
    $cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
    $notificar                                          = addslashes($_GET['notificar']);
    $btn_origen                                         = isset($_GET['btn_origen']) ? addslashes($_GET['btn_origen']) : '';
/* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));    
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
    $cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_estado_facturacion = "SELECT nombre_estado_facturacion FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$codigo_estado_facturacion')";
    $consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion);
    $datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

    $nombre_estado_facturacion                                      = $datos_estado_facturacion['nombre_estado_facturacion'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia);
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda);
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);
    
    $nombre_tienda = $datos_tienda['nombre_tienda'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_operador_credito = "SELECT nombre_operador_credito FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito);
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);
    
    $nombre_operador_credito                                        = $datos_operador_credito['nombre_operador_credito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
    $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico);
    $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

    $nombres_apellidos_aliado_estrategico                           = $datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor);
    $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

    $nombres_apellidos_revisor                                      = $datos_administrador_revisor['nombres'].' '.$datos_administrador_revisor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    /*
    $sql_venta_producto = "SELECT cod_producto_barra, nombre_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
    $datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto);
    
    $cod_producto_barra = $datos_venta_producto['cod_producto_barra'] ?: "No especificado";
    $nombre_producto = $datos_venta_producto['nombre_producto'] ?: "No especificado";
    */
    /* ----------------------------------------------------------------------------------------------------------/ */
    $nombre_cliente = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero);
//---------------------------------------------------------------------------------------------------------------------------------//
	$fecha_creacion                                                 = date("Y-m-d H:i:s");
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $resultado_administrador_revisor = mysqli_query($conectar, $obtener_administrador_revisor) or die(mysqli_error($conectar));
    $info_administrador_revisor = mysqli_fetch_assoc($resultado_administrador_revisor);

    $telefono_revisor                                   = $info_administrador_revisor['telefono'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_venta_producto_temporal = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
    FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $existe_venta_producto_temporal = mysqli_num_rows($consulta_venta_producto_temporal);
    $info_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $nombre_producto                                    = $info_venta_producto_temporal['nombre_producto'];
    $precio_venta_producto                              = $info_venta_producto_temporal['precio_venta_producto'];
    $total_venta_producto                               = $info_venta_producto_temporal['total_venta_producto'];
    $cupo_credito_ptj                                   = $info_venta_producto_temporal['cupo_credito_ptj'];
/* ----------------------------------------------------------------------------------------------------------/ */
    $mostrar_datos_sql = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_tienda                                      = $matriz_consulta['nombre_tienda'];
    $abrev_tienda                                       = $matriz_consulta['abrev_tienda'];  
/* ----------------------------------------------------------------------------------------------------------/ */
    if ($notificar == 'REVISOR' && $codigo_estado_facturacion == '1') { 
        $telefono_notificar         = $telefono_revisor; 
        $texto_titulo_mensaje       = '✅ *Registro exitoso de solicitud de crédito*'; 
    } elseif ($notificar == 'REVISOR' && $codigo_estado_facturacion == '2') { 
        $telefono_notificar         = $telefono_revisor; 
        $texto_titulo_mensaje       = '✅ *Registro exitoso de imagenes finales*';  
    } elseif ($notificar == 'CLIENTE' && $codigo_estado_facturacion == '1') {  
        $telefono_notificar         = $telefono1_tercero; 
        $texto_titulo_mensaje       = '✅ *Registro exitoso de tu solicitud de crédito*'; 
    } elseif ($notificar == 'CLIENTE' && $codigo_estado_facturacion == '2') {  
        $telefono_notificar         = $telefono1_tercero; 
        $texto_titulo_mensaje       = '✅ *Registro exitoso de las imagenes finales*';  
    } else { 
        $telefono_notificar         = $telefono_revisor; 
        $texto_titulo_mensaje       = '';  
    }
/* ----------------------------------------------------------------------------------------------------------/ */
    if ($btn_origen == 'imagenes_iniciales') {
        $texto_titulo = '✅ *Se han cargado exitosamente las imagenes.*';
    } else {
        $texto_titulo = '✅ *Se han cargado exitosamente las imagenes.*';
    }
/* ----------------------------------------------------------------------------------------------------------/ */
    $url_soporte                                        = 'https://distribucionesayq.com/app/admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php?cod_info_factura_venta='.$cod_info_factura_venta;
/* ----------------------------------------------------------------------------------------------------------/ */
    $enterbr                                      = '%0A';
    $negrita_abre                                 = "%0A*";
    $negrita_cierre                               = "*%0A";
    $mensaje_whatsapp_formateado_confirm_compra   = '';

    if ($codigo_estado_facturacion == '1') { 
        $mensaje_whatsapp_formateado_confirm_compra  .= $texto_titulo;
        //$mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        //$mensaje_whatsapp_formateado_confirm_compra  .= $texto_titulo_mensaje;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Estado:* '.trim($nombre_estado_facturacion);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🤝 *Aliado estrategico:* '.trim($nombres_apellidos_aliado_estrategico);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🏬 *Tienda:* '.$nombre_tienda;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Datos del Cliente*';
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Cliente:* '.trim($nombre_cliente);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🛍️ *Producto:* '.$nombre_producto;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '💰 *Monto del crédito:* '.number_format($monto_deuda, 0, ",", ".");
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '📆 *Cuota mensual:* '.number_format($monto_cuota, 0, ",", ".");
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🏦 *Linea de Credito:* '.$nombre_entidad_crediticia;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🕵️ *Revisor:* '.$nombres_apellidos_revisor;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '📩 *Importante:* En los proximos minutos nos comunicaremos para continuar con el proceso*';
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Gracias por confiar en nosotros*';
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= 'ID: '.$cod_info_factura_venta;
    } elseif ($codigo_estado_facturacion == '2') { 
        $mensaje_whatsapp_formateado_confirm_compra  .= $texto_titulo;
        //$mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        //$mensaje_whatsapp_formateado_confirm_compra  .= $texto_titulo_mensaje;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Estado:* '.trim($nombre_estado_facturacion);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🤝 *Aliado estrategico:* '.trim($nombres_apellidos_aliado_estrategico);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🏬 *Tienda:* '.$nombre_tienda;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Datos del Cliente*';
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Cliente:* '.trim($nombre_cliente);
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🛍️ *Producto:* '.$nombre_producto;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '🕵️ *Revisor:* '.$nombres_apellidos_revisor;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '📩 *Importante:* Para mayor información, puedes comunicarte con el revisor.';
        $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
        $mensaje_whatsapp_formateado_confirm_compra  .= '*Gracias por confiar en nosotros*';
    } else { 
        $mensaje_whatsapp_formateado_confirm_compra  .= 'dfdfdf';
    }   
	// Limpiar la variable para envío seguro por URL
	// 1. Eliminar saltos de línea reales que podrían existir
	$mensaje_limpio1 = str_replace(["\r", "\n", "\r\n"], '', $mensaje_whatsapp_formateado_confirm_compra);
    $mensaje_limpio2 = str_replace(["&"], 'Y', $mensaje_limpio1);

	// 2. Codificar la URL para que caracteres especiales no causen problemas
	$mensaje_codificado = urlencode($mensaje_limpio2);
	// 3. Construir la URL de redirección
	$url_redir = "https://api.whatsapp.com/send?phone=57".$telefono_notificar."&text=".$mensaje_limpio2;
	header("Location: ".$url_redir);
	exit;
} else {
    print "No se enviaron los datos correctamente.";
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>