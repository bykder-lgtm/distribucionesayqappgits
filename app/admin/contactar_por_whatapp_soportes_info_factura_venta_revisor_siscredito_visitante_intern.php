<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_info_empresa_visitante_intern_confirmdirect.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);

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
if (isset($_GET['cod_nota_observacion'])) {
    $cod_nota_observacion                               = intval($_GET['cod_nota_observacion']);
    $cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
    $cod_tercero                                        = intval($_GET['cod_tercero']);
    //$pagina                                             = addslashes($_GET['pagina']);
    $pagina                                             = '../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php';  
    $pagina_redirect                                    = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&cod_nota_observacion='.$cod_nota_observacion.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina;
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_info_fact = "SELECT cod_administrador_revisor, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
    $info_fact = mysqli_fetch_assoc($resultado_info_fact);

    $cod_administrador_revisor                          = $info_fact['cod_administrador_revisor'];
    $nombre1_tercero                                    = $info_fact['nombre1_tercero'];
    $nombre2_tercero                                    = $info_fact['nombre2_tercero'];
    $apellido1_tercero                                  = $info_fact['apellido1_tercero'];
    $apellido2_tercero                                  = $info_fact['apellido2_tercero'];
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $resultado_administrador_revisor = mysqli_query($conectar, $obtener_administrador_revisor) or die(mysqli_error($conectar));
    $info_administrador_revisor = mysqli_fetch_assoc($resultado_administrador_revisor);

    $telefono_revisor                                   = $info_administrador_revisor['telefono'];
/* ----------------------------------------------------------------------------------------------------------/ */
    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_nota_observacion = '$cod_nota_observacion') ORDER BY cod_nota_observacion DESC";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_nota_observacion                            = $matriz_consulta['nombre_nota_observacion'];
    $fecha_ymd                                          = $matriz_consulta['fecha_ymd'];
    $fecha_hora                                         = $matriz_consulta['fecha_hora'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_servicio_domicilio = "SELECT nombre_producto, precio_venta_producto, total_venta_producto, cupo_credito_ptj
    FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_servicio_domicilio = mysqli_query($conectar, $sql_servicio_domicilio) or die(mysqli_error($conectar));
    $existe_servicio_domicilio = mysqli_num_rows($consulta_servicio_domicilio);
    $info_servicio_domicilio = mysqli_fetch_assoc($consulta_servicio_domicilio);

    $nombre_producto                                    = $info_servicio_domicilio['nombre_producto'];
    $precio_venta_producto                              = $info_servicio_domicilio['precio_venta_producto'];
    $total_venta_producto                               = $info_servicio_domicilio['total_venta_producto'];
    $cupo_credito_ptj                                   = $info_servicio_domicilio['cupo_credito_ptj'];
/* ----------------------------------------------------------------------------------------------------------/ */
    $url_soporte                                        = 'https://distribucionesayq.com/app/admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cod_nota_observacion='.$cod_nota_observacion.'&pagina='.$pagina;
/* ----------------------------------------------------------------------------------------------------------/ */
    $enterbr                                      = '%0A';
    $negrita_abre                                 = "%0A*";
    $negrita_cierre                               = "*%0A";

    $mensaje_whatsapp_formateado_confirm_compra   = '';
    $mensaje_whatsapp_formateado_confirm_compra  .= '*👋 CONFIRMACIÓN DE CARGUE DE SOPORTE!';
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '🗓️ '.$fecha_ymd.' ⏰ '.$fecha_hora;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'Nombre del Cliente: '.trim($nombre1_tercero.' '.$apellido1_tercero);
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '📝 Nombre del Producto: '.$nombre_producto;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'Nombre Soporte Cargado: '.$nombre_nota_observacion;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'ID: '.$cod_info_factura_venta;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'Url Soporte: '.$url_soporte;


	$url_redir = "https://api.whatsapp.com/send?phone=57$telefono_revisor&text=".$mensaje_whatsapp_formateado_confirm_compra;
	header("Location: $url_redir");
} 
elseif ($accion == 'redirecionar_telefono' && $origen == 'carrito') {

	$url_redir = "tel:57$telefono_revisor";
	header("Location: $url_redir");
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>