<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php //include_once("../admin/01_rastreador.php"); ?>

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">
<meta property="og:url"                content="<?php echo $pagina_local ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php echo $nombre_pagina ?>" />
<meta property="og:description"        content="<?php echo $nombre_pagina ?>" />
<meta property="og:image"              content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg" />
<meta property="og:site_name"          content="<?php echo $nombre ?>"/>
<meta property="fb:admins"             content="editaxe"/>
<meta name="twitter:card"              content="<?php echo $nombre_pagina ?>">
<meta name="twitter:url"               contnet="<?php echo $pagina_local ?>">
<meta name="twitter:title"             content="<?php echo $nombre_pagina ?>">
<meta name="twitter:description"       content="<?php echo $descripcion_producto ?>">
<meta name="twitter:image"             content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/quienes_somos.jpg">

<?php include_once("../admin/03_modulo_css_visitante_intern.php"); ?>
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php
$tab_elim                          = "tbl15_carrito_compra_temporal";
$tab_elim_codif                    = DAXCODIFCRYPTOR::encodiftextodax($tab_elim);
$tab_elim_codifcryp                = DAXCODIFCRYPTOR::encriptardax($tab_elim_codif);

$campo_elim                        = "cod_carrito_compra_temporal";
$campo_elim_codif                  = DAXCODIFCRYPTOR::encodiftextodax($campo_elim);
$campo_elim_codifcryp              = DAXCODIFCRYPTOR::encriptardax($campo_elim_codif);

$tipo_elim                         = "eliminar";
$tipo_elim_codif                   = DAXCODIFCRYPTOR::encodiftextodax($tipo_elim);
$tipo_elim_codifcryp               = DAXCODIFCRYPTOR::encriptardax($tipo_elim_codif);

$tab                                      = "producto";
$tab_codif                                = DAXCODIFCRYPTOR::encodiftextodax($tab);
$tab_codifcryp                            = DAXCODIFCRYPTOR::encriptardax($tab_codif);

$campo                                    = "cod_producto";
$campo_codif                              = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                          = DAXCODIFCRYPTOR::encriptardax($campo_codif);

$tipo                                     = "carrito";
$tipo_codif                               = DAXCODIFCRYPTOR::encodiftextodax($tipo);
$tipo_codifcryp                           = DAXCODIFCRYPTOR::encriptardax($tipo_codif);

$accion                                   = "registrar";
$accion_codif                             = DAXCODIFCRYPTOR::encodiftextodax($accion);
$accion_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($accion_codif);

$origen                                   = "cupon";
$origen_codif                             = DAXCODIFCRYPTOR::encodiftextodax($origen);
$origen_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($origen_codif);

$tab1                                     = "tbl15_carrito_compra_temporal";
$tab_codif1                               = DAXCODIFCRYPTOR::encodiftextodax($tab1);
$tab_codifcryp1                           = DAXCODIFCRYPTOR::encriptardax($tab_codif1);

$tipo1                                    = "carrito";
$tipo_codif1                              = DAXCODIFCRYPTOR::encodiftextodax($tipo1);
$tipo_codifcryp1                          = DAXCODIFCRYPTOR::encriptardax($tipo_codif1);

$accion1                                  = "actualizar";
$accion_codif1                            = DAXCODIFCRYPTOR::encodiftextodax($accion1);
$accion_codifcryp1                        = DAXCODIFCRYPTOR::encriptardax($accion_codif1);

$origen1                                  = "tbl15_carrito_compra_temporal";
$origen_codif1                            = DAXCODIFCRYPTOR::encodiftextodax($origen1);
$origen_codifcryp1                        = DAXCODIFCRYPTOR::encriptardax($origen_codif1);

$campo                                    = "und_venta";
$campo_codif                              = DAXCODIFCRYPTOR::encodiftextodax($campo);
$campo_codifcryp                          = DAXCODIFCRYPTOR::encriptardax($campo_codif);
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form>

<div id="eliminar_ok" style="display:none;">&nbsp;</div>

        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Ver</th>
                                    <th style="text-align:center;">Factura</th>
                                    <th style="text-align:center;">Total</th>
                                    <th style="text-align:center;">Estado</th>
                                    <th style="text-align:center;">Fecha</th>
                                    <th style="text-align:center;">Hora</th>
                                    <th style="text-align:center;">Forma Pago</th>
                                    <th style="text-align:center;">Soportes</th>
                                    <th style="text-align:center;">ID</th>
                                </tr>
                            </thead>
                          <tbody>
<?php
$cod_cliente                              = 0;
$conteo                                   = 0;
$total_venta                              = 0;
$incre                                    = 0;
$smtr_iva_valor                           = 0;

$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_administrador = '$cod_administrador') ORDER BY cod_info_factura_venta DESC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_info_factura_venta                             = $datos_total_tipo_factura['cod_info_factura_venta'];
    $cod_factura                                        = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero                                        = $datos_total_tipo_factura['cod_tercero'];
    $vlr_cancelado                                      = $datos_total_tipo_factura['vlr_cancelado'];
    $vlr_vuelto                                         = $datos_total_tipo_factura['vlr_vuelto'];
    $fecha_anyo                                         = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_hora                                         = $datos_total_tipo_factura['fecha_hora'];
    $cod_tipo_pago                                      = $datos_total_tipo_factura['cod_tipo_pago'];
    $cod_administrador                                  = $datos_total_tipo_factura['cod_administrador'];
    $total_precio_compra                                = $datos_total_tipo_factura['total_precio_compra'];
    $total_precio_venta                                 = $datos_total_tipo_factura['total_precio_venta'];
    $cod_dependencia                                    = $datos_total_tipo_factura['cod_dependencia'];
    $cod_tipo_forma_pago                                = $datos_total_tipo_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura                                = $datos_total_tipo_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                 = $datos_total_tipo_factura['nombre_tipo_moneda'];
    $total_datos_data                                   = $datos_total_tipo_factura['total_datos_data'];
    $observacion_tercero                                = $datos_total_tipo_factura['observacion_tercero'];
    $cod_base_caja                                      = $datos_total_tipo_factura['cod_base_caja'];
    $cod_estado_cava                                    = $datos_total_tipo_factura['cod_estado_cava'];
    $cod_cuentas_cobrar                                 = $datos_total_tipo_factura['cod_cuentas_cobrar'];
    $fecha_entrega                                      = $datos_total_tipo_factura['fecha_entrega'];
    $cod_resolucion_facturacion                         = $datos_total_tipo_factura['cod_resolucion_facturacion'];
    $nombre_estado_factura_dataico_dian                 = $datos_total_tipo_factura['nombre_estado_factura_dataico_dian'];
    $cod_administrador_tercero                          = $datos_total_tipo_factura['cod_administrador_tercero'];
    $nombre_estado_factura                              = $datos_total_tipo_factura['nombre_estado_factura'];

    if ($nombre_estado_factura == 'CERRADA') { $nombre_estado_confirmacion = 'CONFIRMADA'; $url_estado_confirmacion = '../admin/ver_factura_venta_visitante_intern_confirmada.php'; } else { $nombre_estado_confirmacion = 'EN ESPERA'; $url_estado_confirmacion = '../admin/ver_factura_venta_visitante_intern_no_confirmada.php'; }
    
    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                     = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];

    $sql_dependencia = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_tercero                = trim($datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['nombre2_tercero'].' '.$datos_dependencia['apellido1_tercero'].' '.$datos_dependencia['apellido2_tercero'].' - '.$datos_dependencia['identificacion_tercero']);

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    if ($total_precio_venta == '0') {
        $sql_venta_producto_temporal = "SELECT SUM(total_venta_producto) AS total_precio_venta FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
        $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

        $total_precio_venta       = $datos_venta_producto_temporal['total_precio_venta'];

        $actualiza_producto = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_venta = '$total_precio_venta' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
        $resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
    }

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
    $cedula_cli                          = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                       = $matriz_cliente['direccion_tercero'];
    $nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
    $digito_tercero                      = $matriz_cliente['digito_tercero'];
    if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }

    $obtener_vendedor_tercero = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_tercero')";
    $resultado_vendedor_tercero = mysqli_query($conectar, $obtener_vendedor_tercero) or die(mysqli_error($conectar));
    $matriz_vendedor_tercero = mysqli_fetch_assoc($resultado_vendedor_tercero);

    $cliente_vendedor_tercero                         = $matriz_vendedor_tercero['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
    $cedula_vendedor_tercero_                         = $matriz_vendedor_tercero['identificacion_tercero'];
    $direccion_vendedor_tercero                       = $matriz_vendedor_tercero['direccion_tercero'];

    $incre++;
?>
                                <tr>
                                    <td style="text-align:center;"><a href="<?php echo $url_estado_confirmacion ?>?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo ($prefijo_resolucion_facturacion.'|'.$cod_factura) ?></td>
                                    <td style="text-align:right;" class="total-pr"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $nombre_estado_confirmacion ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $fecha_anyo ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $fecha_hora ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $nombre_tipo_forma_pago ?></td>
                                    <td style="text-align:center;"><a href="../admin/lista_soporte_archivo_adjunto_info_factura_venta_visitante_intern.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/expediente.png" class="img-polaroid" alt=""></a></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $cod_info_factura_venta ?></td>
                                </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>