<?php 
$nombre_pagina          = "Cargar Soportes Aliado";
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
if (isset($_GET['cod_info_factura_venta'])) {

    $cod_info_factura_venta                                         = intval($_GET['cod_info_factura_venta']);
    if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = '../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern'; }

    $pagina_redirect                                                = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta.'&pagina='.$pagina;
    /* ----------------------------------------------------------------------------------------------------------/ */
    $calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $monto_deuda                                                    = $datos_cuenta_cobrar['monto_deuda'];
    $monto_cuota                                                    = $datos_cuenta_cobrar['monto_cuota'];
    $cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];
    $cod_factura                                                    = $datos_cuenta_cobrar['cod_factura'];
    $direccion_tercero                                              = $datos_cuenta_cobrar['direccion_tercero'];
    $telefono1_tercero                                              = $datos_cuenta_cobrar['telefono1_tercero'];
    $identificacion_tercero                                         = $datos_cuenta_cobrar['identificacion_tercero'];
    $nombre_tipo_cobro                                              = $datos_cuenta_cobrar['nombre_tipo_cobro'];
    $correo_tercero                                                 = $datos_cuenta_cobrar['correo_tercero'];
    $nombre_estado_factura                                          = $datos_cuenta_cobrar['nombre_estado_factura'];
    $cuenta                                                         = $datos_cuenta_cobrar['cuenta'];
    $cod_caja_virtual                                               = $datos_cuenta_cobrar['cod_caja_virtual'];
    $cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
    $modo_venta_por_defecto                                         = 'manual';
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
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
    $sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

    $cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $datos_entidad_crediticia);
    $data_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                            = $data_entidad_crediticia['nombre_entidad_crediticia'];

    if ($cod_seguridad == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_total_soportes = "SELECT cod_nota_observacion FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_total_soportes = mysqli_query($conectar, $sql_total_soportes) or die(mysqli_error($conectar));
    $conteo_total_soportes = mysqli_num_rows($consulta_total_soportes);

    $sql_total_soportes_aceptados = "SELECT cod_nota_observacion FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (codigo_estado_revision = '2')";
    $consulta_total_soportes_aceptados = mysqli_query($conectar, $sql_total_soportes_aceptados) or die(mysqli_error($conectar));
    $conteo_total_soportes_aceptados = mysqli_num_rows($consulta_total_soportes_aceptados);
/* ----------------------------------------------------------------------------------------------------------/ */
    if ($nombre_estado_factura == 'ABIERTA') {
        $pagina_redirect_ver_factura = '../admin/ver_info_factura_venta_abierta_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_edit_factura = '../admin/checkout_info_factura_venta_abierta_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_regresar = '../admin/lista_info_factura_venta_abierta_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_imprimir_factura = '#';
    } else {
        $pagina_redirect_ver_factura = '../admin/ver_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_edit_factura = '../admin/checkout_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_regresar = '../admin/lista_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
        $pagina_redirect_imprimir_factura = '../admin/venta_productos_opcion_imprimir_siscredito_visitante_intern.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
    }
    ?>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="contact-form-right">
                            <div class="row p-3 mb-2 bg-primary text-white">
                                <div class="col-md-1" style="text-align:center;"><a href="<?php echo $pagina_redirect_regresar ?>"><i class="fa fa-undo fa-2x"></i></a></div>
                                <div class="col-md-11">
                                    <div style="text-align:center;" class="">
                                        <a href="<?php echo $pagina_redirect_ver_factura ?>"><?php echo $nombre_cliente ?> | <?php echo $nombre_entidad_crediticia ?> | <?php echo $nombre_producto ?> | <?php echo number_format($monto_deuda, 0, ",", ".") ?></a> | 
                                        <?php if (($conteo_total_soportes == $conteo_total_soportes_aceptados) && ($nombre_estado_factura == 'ABIERTA')) { ?>
                                            <!--
                                            <br><br>
                                            <a href="../admin/generar_factura_venta_siscredito_venta_producto_reg.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>">Generar Factura</a>
                                            -->
                                        <?php } ?>
                                        <?php if ($nombre_estado_factura == 'CERRADA') { ?>
                                            <!--<br><br><a href="<?php echo $pagina_redirect_imprimir_factura ?>">Ver Factura <img src="../imagenes/imprimir_.png" class="img-polaroid"></a>-->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once("../admin/modal_previsualizar_imagen_soporte_aliado_estrategico.php"); ?>

        <!-- Start Cart -->
            <div id="salida_info_actualizada_carrito_compra_ajax">
                <div id="eliminar_ok" style="display:none;">&nbsp;</div>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-form-right">
                                <!--
                                <div class="row p-3 mb-2 bg-primary text-white">
                                    <div class="col-md-12">
                                        <div style="text-align:center;" class="">Observacion</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="text-align:center;" class="">Tipo</div>
                                    </div>
                                
                                    <div class="col-md-2">
                                        <div style="text-align:center;" class="">Fecha | Hora</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="text-align:center;" class="">Usuario</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="text-align:center;" class="">Estado</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="text-align:center;" class="">Estado</div>
                                    </div>
                                    <div class="col-md-1">
                                        <div style="text-align:center;" class="">Notificacion</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div style="text-align:center;" class="">ID</div>
                                    </div>
                                </div>
                            -->
    <?php
    $mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

        $cod_nota_observacion                           = $matriz_consulta['cod_nota_observacion'];
        $nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];
        $fecha_ymd                                      = $matriz_consulta['fecha_ymd'];
        $fecha_hora                                     = $matriz_consulta['fecha_hora'];
        $cuenta                                         = $matriz_consulta['cuenta'];
        $cod_tipo_nota_observacion                      = $matriz_consulta['cod_tipo_nota_observacion'];
        $url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
        $url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];
        $cod_posicion                                   = $matriz_consulta['cod_posicion'];
        $active                                         = $matriz_consulta['active'];
        $codigo_estado_revision                         = $matriz_consulta['codigo_estado_revision'];
        $notificacion_via_whatsapp                      = $matriz_consulta['notificacion_via_whatsapp'];
        $notificacion_via_msj                           = $matriz_consulta['notificacion_via_msj'];
        $notificacion_via_email                         = $matriz_consulta['notificacion_via_email'];
        $notificacion_via_whatsapp                      = str_pad($notificacion_via_whatsapp, 3, '0', STR_PAD_LEFT);
        $notificacion_via_msj                           = str_pad($notificacion_via_msj, 3, '0', STR_PAD_LEFT);
        $notificacion_via_email                         = str_pad($notificacion_via_email, 3, '0', STR_PAD_LEFT);

        if ($active == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }

        $sql_tipo_nota_observacion = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_tipo_nota_observacion = '$cod_tipo_nota_observacion')";
        $consulta_tipo_nota_observacion = mysqli_query($conectar, $sql_tipo_nota_observacion);
        $datos_tipo_nota_observacion = mysqli_fetch_assoc($consulta_tipo_nota_observacion);

        $nombre_tipo_nota_observacion                   = $datos_tipo_nota_observacion['nombre_tipo_nota_observacion'];

        $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
        $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
        $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

        $nombre_estado_revision                         = $datos_estado_revision['nombre_estado_revision'];
        $color_fondo_celda_estado                       = $datos_estado_revision['color_fondo_celda_estado'];
        $color_letra_celda_estado                       = $datos_estado_revision['color_letra_celda_estado'];
        $color_fondo_celda                              = $datos_estado_revision['color_fondo_celda'];
        $color_letra_celda                              = $datos_estado_revision['color_letra_celda'];

        if ($codigo_estado_revision == '0') { // 0 POR CARGAR
            $previsualizar_soporte = '';
            $url_estado_soporte = '<a href="../admin/soporte_por_cargar_info_factura_venta_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
        } 
        elseif ($codigo_estado_revision == '1') { // 1 POR REVISAR
            $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
            $url_estado_soporte = '<a href="../admin/soporte_por_revisar_cliente_info_factura_venta_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
        } 
        elseif ($codigo_estado_revision == '2') { // 2 ACEPTADO
            $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
            $url_estado_soporte = '<a href="#">'.$nombre_estado_revision.'</a>';
        }
        else { // 3 RECHAZADO
            $previsualizar_soporte = '<a href="#" onclick="obtener_datos_mostrar_imagen_modal('.$cod_nota_observacion.');" data-toggle="modal" data-target=".abrir_previsualizacion_imagen"><img src="../imagenes/pdf_peq.png" class="img-polaroid"></a>';
            $url_estado_soporte = '<a href="../admin/soporte_rechazado_cliente_siscredito_visitante_intern.php?cod_nota_observacion='.$cod_nota_observacion.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&pagina='.$pagina.'">'.$nombre_estado_revision.'</a>';
        }
    ?>
    <input type='hidden' value='<?php echo $cod_nota_observacion;?>' id='cod_nota_observacion<?php echo $cod_nota_observacion;?>'>
    <input type='hidden' value='<?php echo $url_img_orig_producto;?>' id='url_img_orig_producto<?php echo $cod_nota_observacion;?>'>
    <input type='hidden' value='<?php echo $codigo_estado_revision;?>' id='codigo_estado_revision<?php echo $cod_nota_observacion;?>'>
    <input type='hidden' value='<?php echo $nombre_nota_observacion;?>' id='nombre_nota_observacion<?php echo $cod_nota_observacion;?>'>
                                <div class="row">
                                <!--
                                    <div class="col-md-12">
                                        <div style="text-align:center;" class=""><?php echo $nombre_nota_observacion ?></div>
                                    </div>
                                -->

                                    <?php if ($codigo_estado_revision == '0' ) { // 0 POR CARGAR ?>
                                        <div class="col-md-12">
                                            <form id="formulario<?php echo $cod_nota_observacion ?>">
                                                <div style="text-align:center; <?php echo $color_fondo_celda_estado ?>; <?php echo $color_letra_celda_estado ?>" id="estado_revision_por_cargar<?php echo $cod_nota_observacion ?>" class="">
                                                    <span><input type="file" name="url_img1" id="url_img1" class="url_img1<?php echo $cod_nota_observacion ?>" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required/><a href="#" class="btn btn-primary btn-lg btn-block" id="archivo_selecionado"><span class="fas fa-camera"> <?php echo $nombre_nota_observacion ?></a><div id="vista_archivo"></div></span></span>
                                                    <span id="cargador_antes_respuesta<?php echo $cod_nota_observacion ?>"></span>
                                                    <br>
                                                    <input type="button" class="btn hvr-hover btn_guardar_soporte" id="submit<?php echo $cod_nota_observacion ?>" value="Guardar Soporte">
                                                </div>
                                                <input type="hidden" name="cod_nota_observacion" id="cod_nota_observacion" value="<?php echo $cod_nota_observacion ?>">
                                                <input type="hidden" name="cod_info_factura_venta" id="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>">
                                                <input type="hidden" name="cod_tercero" id="cod_tercero" value="<?php echo $cod_tercero ?>">
                                            </form>
                                        </div>
                                        <?php } elseif ($codigo_estado_revision == '3') { // 3 RECHAZADO ?>
                                        <div class="col-md-12">
                                            <form id="formulario<?php echo $cod_nota_observacion ?>">
                                                <div style="text-align:center; <?php echo $color_fondo_celda_estado ?>; <?php echo $color_letra_celda_estado ?>" id="estado_revision_por_cargar<?php echo $cod_nota_observacion ?>" class="">
                                                    <span><input type="file" name="url_img1" id="url_img1" class="url_img1<?php echo $cod_nota_observacion ?>" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required/><a href="#" class="btn btn-primary btn-lg btn-block" id="archivo_selecionado"><span class="fas fa-camera"> <?php echo $nombre_nota_observacion ?></a><div id="vista_archivo"></div></span></span>
                                                    <span id="cargador_antes_respuesta<?php echo $cod_nota_observacion ?>"></span>
                                                    ESTADO: <?php echo $nombre_estado_revision ?><a href="#" id="focotext<?php echo $cod_nota_observacion ?>"><?php echo $previsualizar_soporte ?></a>
                                                    <br>
                                                    <input type="button" class="btn hvr-hover btn_guardar_soporte" id="submit<?php echo $cod_nota_observacion ?>" value="Guardar Soporte">
                                                </div>
                                                <input type="hidden" name="cod_nota_observacion" id="cod_nota_observacion" value="<?php echo $cod_nota_observacion ?>">
                                                <input type="hidden" name="cod_info_factura_venta" id="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>">
                                                <input type="hidden" name="cod_tercero" id="cod_tercero" value="<?php echo $cod_tercero ?>">
                                            </form>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-md-12">
                                            <div style="text-align:center; <?php echo $color_fondo_celda_estado ?>; <?php echo $color_letra_celda_estado ?>" id="estado_revision_por_cargar<?php echo $cod_nota_observacion ?>" class=""><?php echo $nombre_nota_observacion ?> <br> ESTADO: <?php echo $nombre_estado_revision ?>
                                                <a href="#" id="focotext<?php echo $cod_nota_observacion ?>"><?php echo $previsualizar_soporte ?></a>
                                                <span id="cargador_check<?php echo $cod_nota_observacion ?>"><img src="../imagenes/eliminar_vacio.png" class="img-polaroid" id="foco_imagen_prev<?php echo $cod_nota_observacion ?>"></span>
                                            </div>
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
        </div>
        <!-- End Cart -->
<?php } ?>


<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</body>
</html>

<script>
$(document).ready(function() {
    $(".btn_guardar_soporte").on('click', function() {
        var formData = new FormData();
        var url_img1 = $('#url_img1')[0].files[0];
        var cod_nota_observacion = $('#cod_nota_observacion').val();
        var cod_info_factura_venta = $('#cod_info_factura_venta').val();
        var cod_tercero = $('#cod_tercero').val();
        const estado_revision_por_cargar = document.getElementById('estado_revision_por_cargar'+cod_nota_observacion);
        var foco = "focotext"+cod_nota_observacion;
        var pagina_refrescar = "<?php echo $pagina_local ?>"+"?cod_info_factura_venta="+cod_info_factura_venta+"&foco="+foco+"&pagina=<?php echo $pagina ?>";

        formData.append('cod_nota_observacion', cod_nota_observacion);
        formData.append('cod_info_factura_venta', cod_info_factura_venta);
        formData.append('cod_tercero', cod_tercero);
        formData.append('url_img1', url_img1);
        $.ajax({
            url: '../admin/guardar_soportes_camara_o_documento_info_factura_venta_siscredito_visitante_intern_ajax.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(objeto){
                $('#cargador_antes_respuesta'+cod_nota_observacion).html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success: function(respuesta) {
                var afectado = respuesta.afectado;
                var cod_afectado = respuesta.cod_afectado;
                var cod_nota_observacion = respuesta.cod_nota_observacion;
                var codigo_estado_revision = respuesta.codigo_estado_revision;
                var url_img_orig_producto = respuesta.url_img_orig_producto;
                var mensaje = respuesta.mensaje;

                 if (cod_afectado == 'CARGADO_CORRECTAMENTE') { // CARGADO_CORRECTAMENTE
                    //$(".previsualizacion_imagen").attr("src", url_img_orig_producto);
                    $('#submit'+cod_nota_observacion).val(mensaje);
                    $('#cargador_antes_respuesta'+cod_nota_observacion).html('');
                    estado_revision_por_cargar.style.backgroundColor = '#FFFF00';
                    $("#submit"+cod_nota_observacion).prop('disabled', true);
                    $(".url_img1"+cod_nota_observacion).prop('disabled', true);
                    window.location.href = pagina_refrescar;
                }
                else if (cod_afectado == 'FORMATO_INCORRECTO') { // FORMATO_INCORRECTO
                    $('#cargador_antes_respuesta'+cod_nota_observacion).html(mensaje);
                } else { // NO_SE_ENVIO_ARCHIVO
                    $('#cargador_antes_respuesta'+cod_nota_observacion).html('');
                    $('#cargador_antes_respuesta'+cod_nota_observacion).html(mensaje);
                    alert(mensaje);
                }
            }
        });
        //return false;
    });
});
</script>

<?php if (isset($_GET['foco'])) { 
    $foco = $_GET['foco']; 
    ?>
    <script> 
    $(document).ready(function() {
        console.log("foco = <?php echo $foco ?>"); 
        //document.getElementById("<?php echo $foco ?>").focus(); 
        $("#<?php echo $foco ?>").focus();
    }); 
    </script>
<?php } ?>

<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>

<script>
function obtener_datos_mostrar_imagen_modal(id){

    var cod_nota_observacion = $("#cod_nota_observacion"+id).val();
    var url_img_orig_producto = $("#url_img_orig_producto"+id).val();
    var codigo_estado_revision_actual = $("#codigo_estado_revision"+id).val();
    var nombre_nota_observacion_actual = $("#nombre_nota_observacion"+id).val();

    //$("#mod_"+"cod_nota_observacion").val(id);
    $("#mod_"+"url_img_orig_producto").html('<img class="w-100 mb-4" src="'+url_img_orig_producto+'" width="750px">');
    $("#mod_"+"codigo_estado_revision").html(codigo_estado_revision_actual);
    $("#codigo_estado_revision_actual").val(codigo_estado_revision_actual);
    $("#mod_"+"nombre_nota_observacion_actual").html(nombre_nota_observacion_actual);
    //console.log('<img src="'+url_img_orig_producto+'" width="500px">');
}
</script>


<script language="javascript">
$(document).ready(function(){
    $('select[name="codigo_estado_revision"]').change(function(){ 
    //$("input").on('change', function () {
        var codigo_estado_revision = $(this).val();
        var cod_nota_observacion = $(this).attr("id");
        var valor_credito = $(this).attr("valorcredito");

        var campo = "codigo_estado_revision";
        var tipo_ajax = "tbl15_nota_observacion";
        var pagina = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'id='+cod_nota_observacion+'&'+'valor='+codigo_estado_revision+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: "../admin/cambiar_estado_revision_soportes_revisor_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#cargador_check'+cod_nota_observacion).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var cod_nota_observacion = respuesta.cod_nota_observacion;
                var codigo_estado_revision = respuesta.codigo_estado_revision;
                var mensaje = respuesta.mensaje;

                if (afectado == 'SI') {
                    $('#cargador_check'+cod_nota_observacion).html('<img src="../imagenes/bien.png">');
                }
                
            }
        });
    });
});
</script>