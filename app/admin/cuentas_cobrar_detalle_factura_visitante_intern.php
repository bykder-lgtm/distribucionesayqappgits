<?php 
$nombre_pagina          = "Simulador de Credito";
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

<?php if (isset($_REQUEST['cod_tercero'])) { 
$cod_tercero                       = addslashes($_REQUEST['cod_tercero']);
$pagina                            = $_SERVER['PHP_SELF'];

$tab                               = 'tbl15_cuentas_cobrar_por_factura';
$tab2                              = 'tbl15_cuentas_cobrar_archivar_por_factura';
$campo                             = 'cod_cuentas_cobrar';
$tipo                              = 'eliminar';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero            = $total_cliente['identificacion_tercero'];
$nombre1_tercero                   = $total_cliente['nombre1_tercero'];
$apellido1_tercero                 = $total_cliente['apellido1_tercero'];
$nombre_cliente                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                  = 0;
$abonado_smtr                      = 0;
$subtotal_smtr                     = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_cobrar.subtotal > '0') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_cuentas_cobrar                = $datos_total_facturas['cod_cuentas_cobrar'];
$cod_factura                       = $datos_total_facturas['cod_factura'];
$cod_factura_strpad                = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$fecha_hoy                         = date("Y-m-d");
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Cuentas Por Cobrar</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Facturas en Credito: <?php echo $cliente;?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form-right">

                        <div class="row p-3 mb-2 bg-primary text-white">
                        <!--
                            <?php if ($cod_estado_cuenta_cobrar_eliminar== '1') { ?>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Archivar</div>
                            </div>
                            <?php } ?>
                        -->
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Factura</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Entidad | Producto</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Total Credito</div>
                            </div>
                            <div class="col-md-2">
                                <div style="text-align:center;" class="">Total Abonado</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Pendiente</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Soportes</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Abonar</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Fecha Reg</div>
                            </div>
                        <!--
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Vendedor</div>
                            </div>
                        -->
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">ID</div>
                            </div>
                            <?php if ($cod_estado_cuenta_cobrar_editar== '1') { ?>
                            <div class="col-md-1">
                                <div style="text-align:center;" class="">Edit</div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                        $calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
                        tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
                        tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, 
                        tbl15_cuentas_cobrar.cod_info_factura_venta, tbl15_cuentas_cobrar.cod_estado_pago, tbl15_cuentas_cobrar.cod_producto_barra, 
                        tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_entidad_crediticia
                        FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
                        WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0') ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
                        $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
                        $total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
                        while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

                            $cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
                            $cod_info_factura_venta         = $datos_cuenta_cobrar['cod_info_factura_venta'];
                            $cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
                            $cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
                            $monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
                            $abonado                        = $datos_cuenta_cobrar['abonado'];
                            $subtotal                       = $datos_cuenta_cobrar['subtotal'];
                            $mensaje                        = $datos_cuenta_cobrar['mensaje'];
                            $fecha                          = $datos_cuenta_cobrar['fecha'];
                            $fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
                            $vendedor                       = $datos_cuenta_cobrar['vendedor'];
                            $cod_estado_pago                = $datos_cuenta_cobrar['cod_estado_pago'];
                            $cod_producto_barra             = $datos_cuenta_cobrar['cod_producto_barra'];
                            $nombre_producto                = $datos_cuenta_cobrar['nombre_producto'];
                            $cod_entidad_crediticia         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
                            $monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
                            $abonado_smtr                   = $abonado_smtr + $abonado;
                            $subtotal_smtr                  = $subtotal_smtr + $subtotal;

                            if (($fecha_hoy > $fecha_pago) && ($subtotal > '0')) { $condicional_fecha_subtotal = true; } else { $condicional_fecha_subtotal = false; }
                            if ($cod_estado_pago == '0') { $condicional_estado_pago = true; } else { $condicional_estado_pago = false; }

                            if ($condicional_fecha_subtotal && $condicional_estado_pago) { 
                                $cod_estado_pago_invert = '1';
                                $url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
                                $boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; 
                            } else { 
                                $cod_estado_pago_invert = '0';
                                $url_actualizar_estado_pago = '../admin/actualizar_estado_pago_cuenta_cobrar_reg.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cod_estado_pago='.$cod_estado_pago_invert.'&pagina='.$pagina;
                                $boton_alerta_caducidad = '<img src="../imagenes/sem_atendido_peq.png">'; 
                            }

                            $sql_consulta_cliente = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
                            $consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
                            $total_cliente = mysqli_fetch_assoc($consulta_cliente);

                            $nombre_entidad_crediticia            = $total_cliente['nombre_entidad_crediticia'];  
                        ?>
                        <div class="row">
                        <!--
                            <?php if ($cod_estado_cuenta_cobrar_eliminar== '1') { ?>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php if ($subtotal <= '0') { ?><a href="../admin/eliminar.php?llave=<?php echo $cod_cuentas_cobrar; ?>&tab=<?php echo $tab2; ?>&campo=<?php echo $campo; ?>&tipo=<?php echo $tipo; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/btn_archivar.png" class="img-polaroid" alt=""></a><?php } else { ?><?php } ?></div>
                            </div>
                        -->
                            <?php } ?>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $cod_factura;?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $nombre_entidad_crediticia;?> | <?php echo $nombre_producto;?> (<?php echo $cod_producto_barra;?>)</div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo number_format($monto_deuda, 0, ",", ".")?></div>
                            </div>
                            <div class="col-md-2">
                                <div style="text-align:center;" class=""><?php echo number_format($abonado, 0, ",", ".");?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo number_format($subtotal, 0, ",", "."); ?></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><a href="../admin/lista_soportes_cuenta_cobrar_siscredito_visitante_intern.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><a href="#"><img src=../imagenes/abono_nuevo.png alt="Abonar"></a></div>
                            </div>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $fecha;?></div>
                            </div>
                        <!--
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $vendedor; ?></div>
                            </div>
                        -->
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><?php echo $cod_cuentas_cobrar; ?></div>
                            </div>
                            <?php if ($cod_estado_cuenta_cobrar_editar== '1') { ?>
                            <div class="col-md-1">
                                <div style="text-align:center;" class=""><a href="#"><img src=../imagenes/editar.png alt="Abonar"></a></div>
                            </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>

</html>