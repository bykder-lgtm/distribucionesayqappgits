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
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

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
if (isset($_GET['cod_info_factura_venta'])) {

    $cod_info_factura_venta                                         = intval($_GET['cod_info_factura_venta']);
    $pagina                                                         = '../admin/ver_info_factura_venta_abierta_siscredito_visitante_intern_revisor.php';
    $pagina_redirect                                                = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&pagina='.$pagina;
    $modo_venta_por_defecto                                         = 'manual';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

    $cod_info_factura_venta                                         = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $fecha_ini                                                      = $data_info_factura['fecha_ini'];
    $fecha_fin                                                      = $data_info_factura['fecha_fin'];
    $cod_empresa                                                    = $data_info_factura['cod_empresa'];
    $nombre_empresa                                                 = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                                            = $data_info_factura['razonsocial_empresa'];
    $total_motivo                                                   = $data_info_factura['total_motivo'];
    $total_muestra                                                  = $data_info_factura['total_muestra'];
    $fecha_ymdhis                                                   = $data_info_factura['fecha_ymdhis'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_estado_factura                                             = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                                                  = $data_info_factura['cod_base_caja'];
    $descuento_ptj                                                  = $data_info_factura['descuento_ptj'];
    $iva_ptj                                                        = $data_info_factura['iva_ptj'];
    $flete_ptj                                                      = $data_info_factura['flete_ptj'];
    $cod_cliente                                                    = $data_info_factura['cod_cliente'];
    $vlr_cancelado                                                  = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                                                     = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                                      = $data_info_factura['fecha_dia'];
    $fecha_mes                                                      = $data_info_factura['fecha_mes'];
    $fecha_anyo                                                     = $data_info_factura['fecha_anyo'];
    $anyo                                                           = $data_info_factura['anyo'];
    $fecha_hora                                                     = $data_info_factura['fecha_hora'];
    $fecha_remision                                                 = $data_info_factura['fecha_remision'];
    $nombre_ccosto                                                  = $data_info_factura['nombre_ccosto'];
    $garantia_meses                                                 = $data_info_factura['garantia_meses'];
    $observacion                                                    = $data_info_factura['observacion'];
    $cod_tipo_pago                                                  = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                                              = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                                           = $data_info_factura['nombre_tipo_producto'];
    $total_precio_compra                                            = $data_info_factura['total_precio_compra'];
    $total_precio_venta                                             = $data_info_factura['total_precio_venta'];
    $cod_dependencia                                                = $data_info_factura['cod_dependencia'];
    $servicio                                                       = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                                            = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                                         = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago                                    = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                                            = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                             = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                                                = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                                                 = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                                             = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                                                 = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                                                = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                                              = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion                                     = $data_info_factura['cod_resolucion_facturacion'];
    $cod_tipo_inventario                                            = $data_info_factura['cod_tipo_inventario'];
    $observacion_tercero                                            = $data_info_factura['observacion_tercero'];
    $cod_tipo_metodo_envio                                          = $data_info_factura['cod_tipo_metodo_envio'];
    $nombre1_tercero_ext                                            = $data_info_factura['nombre1_tercero'];
    $nombre_factura_remision                                        = $data_info_factura['nombre_factura_remision'];
    $nombre_tipo_pendiente                                          = $data_info_factura['nombre_tipo_pendiente'];
    $descripcion_tipo_pendiente                                     = $data_info_factura['descripcion_tipo_pendiente'];
    $fecha_entrega                                                  = $data_info_factura['fecha_entrega'];
    $hora_entrega                                                   = $data_info_factura['hora_entrega'];
    $nombre_elaboro                                                 = $data_info_factura['nombre_elaboro'];
    $fecha_pago                                                     = $data_info_factura['fecha_pago'];
    $cod_domiciliario                                               = $data_info_factura['cod_domiciliario'];
    $cod_puc                                                        = $data_info_factura['cod_puc'];
    $cod_sino_crear_mov_contable                                    = $data_info_factura['cod_sino_crear_mov_contable'];
    $cod_puntos_redimibles_campanya                                 = $data_info_factura['cod_puntos_redimibles_campanya'];
    $cod_movimiento_contable_cuenta_personal                        = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_movimiento_caja                                            = $data_info_factura['cod_movimiento_caja'];
    $retefuente_ptj                                                 = $data_info_factura['retefuente_ptj'];
    $reteica_ptj                                                    = $data_info_factura['reteica_ptj'];
    $reteiva_ptj                                                    = $data_info_factura['reteiva_ptj'];
    $cod_estado_alquiler_renta                                      = $data_info_factura['cod_estado_alquiler_renta'];
    $fecha_ini_renta_alquiler                                       = $data_info_factura['fecha_ini_renta_alquiler'];
    $fecha_fin_renta_alquiler                                       = $data_info_factura['fecha_fin_renta_alquiler'];
    $cod_info_factura_strpad                                        = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

    $monto_deuda                                                    = $data_info_factura['monto_deuda'];
    $monto_cuota                                                    = $data_info_factura['monto_cuota'];
    $numero_cuota                                                   = $data_info_factura['numero_cuota'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $direccion_tercero                                              = $data_info_factura['direccion_tercero'];
    $telefono1_tercero                                              = $data_info_factura['telefono1_tercero'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $correo_tercero                                                 = $data_info_factura['correo_tercero'];
    $nombre_estado_factura                                          = $data_info_factura['nombre_estado_factura'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_caja_virtual                                               = $data_info_factura['cod_caja_virtual'];
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
    $nombre_modulo_puc                                              = "";
    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $cod_banco_cuenta                                               = $data_info_factura['cod_banco_cuenta'];
    $cod_vendedor                                                   = $data_info_factura['cod_vendedor'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_lider')";
    $consulta_administrador_lider = mysqli_query($conectar, $sql_administrador_lider) or die(mysqli_error($conectar));
    $datos_administrador_lider = mysqli_fetch_assoc($consulta_administrador_lider);

    $nombres_apellidos_lider                                        = $datos_administrador_lider['nombres'].' '.$datos_administrador_lider['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_coordinador = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_coordinador')";
    $consulta_administrador_coordinador = mysqli_query($conectar, $sql_administrador_coordinador) or die(mysqli_error($conectar));
    $datos_administrador_coordinador = mysqli_fetch_assoc($consulta_administrador_coordinador);

    $nombres_apellidos_coordinador                                  = $datos_administrador_coordinador['nombres'].' '.$datos_administrador_coordinador['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_asesor')";
    $consulta_administrador_asesor = mysqli_query($conectar, $sql_administrador_asesor) or die(mysqli_error($conectar));
    $datos_administrador_asesor = mysqli_fetch_assoc($consulta_administrador_asesor);

    $nombres_apellidos_asesor                                       = $datos_administrador_asesor['nombres'].' '.$datos_administrador_asesor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
    $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico) or die(mysqli_error($conectar));
    $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

    $nombres_apellidos_aliado_estrategico                           = $datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor) or die(mysqli_error($conectar));
    $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

    $nombres_apellidos_revisor                                       = $datos_administrador_revisor['nombres'].' '.$datos_administrador_revisor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tienda = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

    $nombre_tienda                                      = $datos_tienda['nombre_tienda'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

    $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $nombre_cliente                                                 = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
    $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
    $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);

    $nombre_banco_cuenta                                            = $datos_banco_cuenta['nombre_banco_cuenta'].' | '.$datos_banco_cuenta['numero_banco_cuenta'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
    $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
    $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);

    $nombre_vendedor                                                = $datos_vendedor['nombres'].' '.$datos_vendedor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];

    $suma_temporal = "SELECT Sum(total_venta_producto) As total_precio_venta_info, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto, 
    Count(cod_venta_producto_temporal) As total_art_temp FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_precio_venta_info      = $matriz_temporal['total_precio_venta_info'];
    $total_venta                  = $matriz_temporal['total_precio_venta_info'];
    $total_peso_producto          = $matriz_temporal['total_peso_producto'];
    $total_art_temp               = $matriz_temporal['total_art_temp'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $tipo_ajax                     = "tbl15_venta_producto_temporal";
    $nombre_tipo_transaccion       = "Edición de Transacción - Abierta";
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php include_once("../admin/info_factura_venta_pos_edit_checkout_siscredito_visitante_intern_revisor.php"); ?>

                                <div class="col-md-12 col-lg-12">
                                    <div class="odr-box">
                                        <div class="title-left">
                                            <h3>Productos en compras</h3>
                                        </div>
                                        <div class="rounded p-2 bg-light">
        <?php
        //----------------------------------------------------------------------------------------------------------------------------------//
        //----------------------------------------------------------------------------------------------------------------------------------//
        $conteo = 0;
        $incre = 0;

        if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }

        $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
        while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

            $cod_venta_producto_temporal                                    = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
            $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
            $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
            $precio_venta_producto                                          = $datos_venta_producto_temporal['precio_venta_producto'];
            $und_venta                                                      = $datos_venta_producto_temporal['und_venta'];
            $cod_categoria                                                  = $datos_venta_producto_temporal['cod_categoria'];
            $serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
            $serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];
            $incre++;
        ?>
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"> <a href="detail.html"> <?php echo $nombre_producto ?></a>
                                                    <!--<div class="small text-muted">Precio: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?> <span class="mx-2">|</span> Cant: <?php echo $und_venta ?> <span class="mx-2">|</span> Total: $<?php echo number_format($precio_venta_producto, 0, ",", ".") ?></div>-->
                                                    <?php if ($cod_categoria == '2') { ?>
                                                    <div class="small text-muted">
                                                        <span class="mx-2">
                                                        Imei 1: <input type="text" name="serial1_producto" id="serial1_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $serial1_producto ?>">
                                                        Imei 2: <input type="text" name="serial2_producto" id="serial2_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $serial2_producto ?>">
                                                        </span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
        <!--<input type="hidden" name="cod_carrito_compra_temporal[]" value="<?php echo $cod_carrito_compra_temporal;?>">-->
        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="../admin/generar_factura_venta_siscredito_venta_producto_reg.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>" class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Guardar y Generar Factura</div></a>
                                        <!--<button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Guardar Cambios</div></button>-->
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <div class="order-box">
                                        <div class="title-left">
                                            <h3>Su orden</h3>
                                        </div>
                                        <hr class="my-1">
                                        <div class="d-flex">
                                            <h4>SubTotal</h4>
                                            <div class="ml-auto font-weight-bold"> $ <?php echo number_format($monto_deuda, 0, ",", ".") ?> </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex gr-total">
                                            <h5>Total</h5>
                                            <div class="ml-auto h5"> $ <?php echo number_format($monto_deuda, 0, ",", ".") ?> </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type='hidden' value='<?php echo $cod_info_factura_venta;?>' id='cod_info_factura_venta<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $cod_tercero;?>' id='cod_tercero<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $identificacion_tercero;?>' id='identificacion_tercero<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $nombre1_tercero;?>' id='nombre1_tercero<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $nombre2_tercero;?>' id='nombre2_tercero<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $apellido1_tercero;?>' id='apellido1_tercero<?php echo $cod_info_factura_venta;?>'>
    <input type='hidden' value='<?php echo $apellido2_tercero;?>' id='apellido2_tercero<?php echo $cod_info_factura_venta;?>'>

    <script>
    function obtener_datos_tercero_factura_venta_modal(id){

        var cod_info_factura_venta = $("#cod_info_factura_venta"+id).val();
        var cod_tercero = $("#cod_tercero"+id).val();
        var cuenta = "<?php echo $cuenta;?>";
        var cod_caja_virtual = "<?php echo $cod_caja_virtual;?>";
        var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto;?>";
        var pagina = "<?php echo $pagina;?>";
        var identificacion_tercero = $("#identificacion_tercero"+id).val();
        var nombre1_tercero = $("#nombre1_tercero"+id).val();
        var nombre2_tercero = $("#nombre2_tercero"+id).val();
        var apellido1_tercero = $("#apellido1_tercero"+id).val();
        var apellido2_tercero = $("#apellido2_tercero"+id).val();

        $("#mod_"+"cod_info_factura_venta").val(cod_info_factura_venta);
        $("#mod_"+"cod_tercero").val(cod_tercero);
        $("#mod_"+"cuenta").val(cuenta);
        $("#mod_"+"cod_caja_virtual").val(cod_caja_virtual);
        $("#mod_"+"modo_venta_por_defecto").val(modo_venta_por_defecto);
        $("#mod_"+"pagina").val(pagina);
        $("#mod_"+"identificacion_tercero").val(identificacion_tercero);
        $("#mod_"+"nombre1_tercero").val(nombre1_tercero);
        $("#mod_"+"nombre2_tercero").val(nombre2_tercero);
        $("#mod_"+"apellido1_tercero").val(apellido1_tercero);
        $("#mod_"+"apellido2_tercero").val(apellido2_tercero);
    }
    </script>

    <script>
    function obtener_datos_valor_credito_factura_venta_modal(id){

        var cod_info_factura_venta = $("#cod_info_factura_venta"+id).val();
        var cod_tercero = $("#cod_tercero"+id).val();
        var cuenta = "<?php echo $cuenta;?>";
        var cod_caja_virtual = "<?php echo $cod_caja_virtual;?>";
        var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto;?>";
        var pagina = "<?php echo $pagina;?>";
        var monto_deuda = "<?php echo intval($monto_deuda);?>";
        var monto_cuota = "<?php echo intval($monto_cuota);?>";
        var numero_cuota = "<?php echo $numero_cuota;?>";

        $("#mod_"+"cod_info_factura_venta").val(cod_info_factura_venta);
        $("#mod_"+"cod_tercero").val(cod_tercero);
        $("#mod_"+"cuenta").val(cuenta);
        $("#mod_"+"cod_caja_virtual").val(cod_caja_virtual);
        $("#mod_"+"modo_venta_por_defecto").val(modo_venta_por_defecto);
        $("#mod_"+"pagina").val(pagina);
        $("#mod_"+"monto_deuda").val(monto_deuda);
        $("#mod_"+"monto_cuota").val(monto_cuota);
        $("#mod_"+"numero_cuota").val(numero_cuota);
    }
    </script>

    <script>
    function obtener_datos_nuevo_vendedor_factura_venta_modal(id){

        var cod_info_factura_venta = $("#cod_info_factura_venta"+id).val();
        var cod_tercero = $("#cod_tercero"+id).val();
        var cuenta = "<?php echo $cuenta;?>";
        var cod_caja_virtual = "<?php echo $cod_caja_virtual;?>";
        var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto;?>";
        var pagina = "<?php echo $pagina;?>";
        var cedula = "<?php echo ($cedula);?>";
        var nombres = "<?php echo ($nombres);?>";
        var apellidos = "<?php echo $apellidos;?>";

        $("#mod_"+"cod_info_factura_venta").val(cod_info_factura_venta);
        $("#mod_"+"cod_tercero").val(cod_tercero);
        $("#mod_"+"cuenta").val(cuenta);
        $("#mod_"+"cod_caja_virtual").val(cod_caja_virtual);
        $("#mod_"+"modo_venta_por_defecto").val(modo_venta_por_defecto);
        $("#mod_"+"pagina").val(pagina);
        $("#mod_"+"cedula").val(cedula);
        $("#mod_"+"nombres").val(nombres);
        $("#mod_"+"apellidos").val(apellidos);
    }
    </script>

    <script>
    function obtener_datos_nuevo_tienda_factura_venta_modal(id){

        var cod_info_factura_venta = $("#cod_info_factura_venta"+id).val();
        var cod_tercero = $("#cod_tercero"+id).val();
        var cuenta = "<?php echo $cuenta;?>";
        var cod_caja_virtual = "<?php echo $cod_caja_virtual;?>";
        var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto;?>";
        var pagina = "<?php echo $pagina;?>";
        var garantia_tienda = "<?php echo $garantia_tienda;?>";

        $("#mod_"+"cod_info_factura_venta").val(cod_info_factura_venta);
        $("#mod_"+"cod_tercero").val(cod_tercero);
        $("#mod_"+"cuenta").val(cuenta);
        $("#mod_"+"cod_caja_virtual").val(cod_caja_virtual);
        $("#mod_"+"modo_venta_por_defecto").val(modo_venta_por_defecto);
        $("#mod_"+"pagina").val(pagina);
        $("#mod_"+"garantia_tienda").val(garantia_tienda);
    }
    </script>

    <script>
    function obtener_datos_nuevo_banco_cuenta_factura_venta_modal(id){

        var cod_info_factura_venta = $("#cod_info_factura_venta"+id).val();
        var cod_tercero = $("#cod_tercero"+id).val();
        var cod_caja_virtual = "<?php echo $cod_caja_virtual;?>";
        var cuenta = "<?php echo $cuenta;?>";
        var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto;?>";
        var pagina = "<?php echo $pagina;?>";
        var nombre_banco_cuenta = "<?php echo ($nombre_banco_cuenta);?>";
        var numero_banco_cuenta = "<?php echo ($numero_banco_cuenta);?>";
        var nombre_titular_cuenta = "<?php echo $nombre_titular_cuenta;?>";
        var identificacion_titular_cuenta = "<?php echo $identificacion_titular_cuenta;?>";

        $("#mod_"+"cod_info_factura_venta").val(cod_info_factura_venta);
        $("#mod_"+"cod_tercero").val(cod_tercero);
        $("#mod_"+"cod_caja_virtual").val(cod_caja_virtual);
        $("#mod_"+"cuenta").val(cuenta);
        $("#mod_"+"modo_venta_por_defecto").val(modo_venta_por_defecto);
        $("#mod_"+"pagina").val(pagina);
        $("#mod_"+"nombre_banco_cuenta").val(nombre_banco_cuenta);
        $("#mod_"+"numero_banco_cuenta").val(numero_banco_cuenta);
        $("#mod_"+"nombre_titular_cuenta").val(nombre_titular_cuenta);
        $("#mod_"+"identificacion_titular_cuenta").val(identificacion_titular_cuenta);
    }
    </script>
<?php } ?>

    <!-- End Cart -->

<?php //include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_sin_jquery.php"); ?>

</body>
</html>
