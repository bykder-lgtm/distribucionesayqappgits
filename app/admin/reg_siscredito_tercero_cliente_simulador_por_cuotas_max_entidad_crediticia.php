<?php 
$nombre_pagina          = "Registrar Cliente";
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
<?php //include_once("../admin/01_rastreador_geolocalizacion_gps_javacript.php"); ?>
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
<link rel="stylesheet" href="../estilo_css/formulario_registro_cliente_visitante.css">

<?php //include_once("../pixel_facebook_js/pixel_editaxe.php"); ?>
</head>

<body>
    <!-- End Main Top -->
    <!-- End Main Top -->
<?php //include_once("04_modulo_main_top_visitante.php"); ?>
    <!-- Start Main Top -->
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php if (isset($_GET['nombre_tipo_origen_simulacion'])) { 
    $nombre_tipo_origen_simulacion                                = addslashes($_GET['nombre_tipo_origen_simulacion']);
    $precio_venta_producto                                        = intval($_GET['precio_venta_producto']);
    $cod_producto_codifcryp                                       = ($_GET['cod_producto_codifcryp']);
    $cod_producto_codif                                           = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                                 = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
    $valor_credito                                                = intval($_GET['valor_credito']);
    $cod_entidad_crediticia                                       = intval($_GET['cod_entidad_crediticia']);
    $cod_tipo_cobro                                               = intval($_GET['cod_tipo_cobro']);
    $cod_meses_credito                                            = intval($_GET['cod_meses_credito']);
    $total_pagar                                                  = intval($_GET['total_pagar']);
    $cuota_credito                                                = intval($_GET['cuota_credito']);
    $numero_cuotas                                                = $cod_meses_credito;
    $nombre_tipo_cobro                                            = addslashes($_GET['nombre_tipo_cobro']);
    $cod_categoria                                                = intval($_GET['cod_categoria']);
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $nombre_tipo_tercero                                          = 'CLIENTE';
    $nombre_tipo_tercero_modulo_creacion                          = 'CLIENTE';
    $fecha_pago                                                   = date("Y-m-d");
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad = '23') { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    } elseif ($cod_seguridad = '22') { //ASESOR
        $nombre_compo_interes_ptj                    = 'asesor_interes_ptj';
        $nombre_compo_aval_ptj                       = 'asesor_aval_ptj';
    } else { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                    = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                       = 'aliado_estrategico_aval_ptj';
    }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_requisito_credito = "SELECT * FROM tbl15_requisito_credito WHERE (cod_requisito_credito = '1')";
    $consulta_requisito_credito = mysqli_query($conectar, $sql_requisito_credito) or die(mysqli_error($conectar));
    $datos_requisito_credito = mysqli_fetch_assoc($consulta_requisito_credito);
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $cod_requisito_credito                                        = $datos_requisito_credito['cod_requisito_credito'];
    $nombre_requisito_credito                                     = $datos_requisito_credito['nombre_requisito_credito'];
    $descripcion_requisito_credito                                = $datos_requisito_credito['descripcion_requisito_credito'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                    = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL') {
        $sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
        $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
        $datos_producto = mysqli_fetch_assoc($consulta_producto);

        $cod_producto_barra                                           = $datos_producto['cod_producto_barra'];
        $nombre_producto                                              = $datos_producto['nombre_producto'];
        $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = addslashes($_REQUEST['nombre_producto']);
        $precio_venta_producto                                        = intval($_REQUEST['precio_venta_producto']);
    } else {
        $cod_producto_barra                                           = "";
        $nombre_producto                                              = "";
        $precio_venta_producto                                        = 0;
    }
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------/
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                               = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_seguridad = "SELECT nombre_seguridad FROM tbl15_seguridad WHERE (cod_seguridad = '$cod_seguridad')";
    $consulta_seguridad = mysqli_query($conectar, $sql_seguridad) or die(mysqli_error($conectar));
    $datos_seguridad = mysqli_fetch_assoc($consulta_seguridad);

    $nombre_seguridad                            = ucfirst(strtolower($datos_seguridad['nombre_seguridad']));
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $precio_venta_producto_mas_comision_funcionamiento            = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    $valor_credito                                                = $precio_venta_producto_mas_comision_funcionamiento;
    //---------------------------------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------------------------------//
    $interes_ptj                                                  = $datos_entidad_crediticia[$nombre_compo_interes_ptj];
    $aval_ptj                                                     = $datos_entidad_crediticia[$nombre_compo_aval_ptj];
    $total_pagar                                                  = round($precio_venta_producto / ((100/100) - ($interes_ptj / 100)), -3);
    $total_interes                                                = $total_pagar - $precio_venta_producto;
    $cuota_credito                                                = $total_pagar / $numero_cuotas;
    $calculo_diferencia_de_precios                                = $precio_venta_producto_mas_comision_funcionamiento - $total_pagar;
    $calculo_descuento_respecto_al_mayor                          = round((($calculo_diferencia_de_precios / $precio_venta_producto_mas_comision_funcionamiento) * 100), 2);
?>
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-info-left">
                        <h2><?php echo $nombre_requisito_credito ?></h2>
                        <p><?php echo $nombre ?>.</p>
                        <?php echo $descripcion_requisito_credito ?>
                    </div>
                </div>

                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Formulario de Solicitud Para <?php echo $nombre_seguridad; ?>s</h2>
                        <h1>Ingresa los datos</h1>
                        <div id="mensaje_verificacion_documento"><img src="../imagenes/eliminar_vacio.png"></div>
                        <form action="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas_max_entidad_crediticia_reg.php" method="post" id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">Tipo de documento *
                                        <select id="select_nombre_tipo_identificacion" name="nombre_tipo_identificacion" class="form-control" required>
                                            <?php if (isset($nombre_tipo_identificacion)) { echo ""; } else { echo ""; }
                                            $consulta2_sql = "SELECT cod_tipo_identificacion, nombre_tipo_identificacion FROM tbl15_tipo_identificacion WHERE (cod_estado = '1')";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($nombre_tipo_identificacion) and $nombre_tipo_identificacion == $datos2['nombre_tipo_identificacion']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo           = $datos2['nombre_tipo_identificacion'];
                                            $nombre           = $datos2['nombre_tipo_identificacion'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Documento *
                                        <input type="number" class="form-control" id="identificacion_tercero" name="identificacion_tercero" placeholder="Numero de identificación" data-error="Por favor, escriba su numero de identificación" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Primer nombre *
                                        <input type="text" class="form-control" id="nombre1_tercero" name="nombre1_tercero" placeholder="Primer nombre" data-error="Por favor, ingrese su primer nombre" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Segundo nombre
                                        <input type="text" class="form-control" id="nombre2_tercero" name="nombre2_tercero" placeholder="Segundo nombre" data-error="Por favor, ingrese su segundo nombre" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Primer apellido *
                                        <input type="text" class="form-control" id="apellido1_tercero" name="apellido1_tercero" placeholder="Primer apellido" data-error="Por favor, ingrese su primer apellido" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Segundo apellido
                                        <input type="text" class="form-control" id="apellido2_tercero" name="apellido2_tercero" placeholder="Segundo apellido" data-error="Por favor, ingrese su segundo apellido" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            <!--
                                <div class="col-md-6">
                                    <div class="form-group">Fecha de nacimiento
                                        <input type="date" class="form-control" id="fecha_nac_tercero" name="fecha_nac_tercero" placeholder="Fecha de nacimiento" data-error="Por favor, ingrese su fecha de nacimiento"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Fecha de expedición
                                        <input type="date" class="form-control" id="fecha_expedicion_tercero" name="fecha_expedicion_tercero" placeholder="Fecha de expedición" data-error="Por favor, ingrese su fecha de expedición"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            -->
                                <div class="col-md-6">
                                    <div class="form-group">Celular *
                                        <input type="number" class="form-control" id="telefono1_tercero" name="telefono1_tercero" placeholder="Celular" data-error="Por favor, ingrese su celular" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Correo *
                                        <input type="email" class="form-control" id="correo_tercero" name="correo_tercero" placeholder="Correo"  data-error="Por favor, ingrese su Correo" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Dirección *
                                        <input type="text" class="form-control" id="direccion_tercero" name="direccion_tercero" placeholder="Dirección" data-error="Por favor, ingrese su dirección" required/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Estado Civil
                                        <select id="select_nombre_estado_civil" name="nombre_estado_civil" class="form-control" required>
                                            <?php if (isset($nombre_estado_civil)) { echo ""; } else { echo ""; }
                                            $consulta2_sql = "SELECT cod_estado_civil, nombre_estado_civil FROM tbl15_estado_civil";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($nombre_estado_civil) and $nombre_estado_civil == $datos2['nombre_estado_civil']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo           = $datos2['nombre_estado_civil'];
                                            $nombre           = $datos2['nombre_estado_civil'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">Total Credito: $ <?php echo number_format($total_pagar, 0, ",", "."); ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">Cuota <?php echo ucfirst(strtolower($nombre_tipo_cobro)); ?>: $ <?php echo number_format($cuota_credito, 0, ",", "."); ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Cantidad Cuotas: 
                                        <?php echo $numero_cuotas; ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Entidad: 
                                        <?php echo $nombre_entidad_crediticia; ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Producto: 
                                        <?php echo $nombre_producto; ?> | <?php echo $cod_producto_barra; ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">Fecha Reg: <?php echo date("d/m/Y", strtotime($fecha_pago)); ?>
                                        <!--<input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="<?php echo $fecha_pago; ?>" placeholder="Fecha" data-error="" readonly/>-->
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit"><div id="nombre_boton_accion">Crear Registro</div></button>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="precio_venta_producto" value="<?php echo $precio_venta_producto ?>" />
                                <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>" />
                                <input type="hidden" name="nombre_producto" value="<?php echo $nombre_producto ?>" />
                                <input type="hidden" name="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp; ?>" />
                                <input type="hidden" name="valor_credito" value="<?php echo $valor_credito; ?>" />
                                <input type="hidden" name="cod_entidad_crediticia" value="<?php echo $cod_entidad_crediticia; ?>" />
                                <input type="hidden" name="cod_tipo_cobro" value="<?php echo $cod_tipo_cobro; ?>" />
                                <input type="hidden" name="cod_meses_credito" value="<?php echo $cod_meses_credito; ?>" />
                                <input type="hidden" name="nombre_tipo_tercero" value="<?php echo $nombre_tipo_tercero; ?>" />
                                <input type="hidden" name="nombre_tipo_tercero_modulo_creacion" value="<?php echo $nombre_tipo_tercero_modulo_creacion; ?>" />
                                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>" />
                                <input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad; ?>" />
                                <input type="hidden" name="cod_categoria" value="<?php echo $cod_categoria; ?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- End About Page -->
</body>
<?php include_once("../admin/09_modulo_footer_visitante_intern.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern.php"); ?>

</html>

<script language="javascript">
$(document).ready(function(){
    $("#identificacion_tercero").on('change', function () {
        var identificacion_tercero = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_venta_producto_temporal";
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';

        var datos_url_ajax = 'identificacion_tercero='+identificacion_tercero+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax;

        $.ajax({
            type: "POST",
            url: "../admin/verificar_existencia_siscredito_tercero_cliente_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var emisor = respuesta.emisor;
                var resultado = respuesta.resultado;
                var ok_ajax = respuesta.ok_ajax;
                var mensaje = respuesta.mensaje;

                var identificacion_tercero = respuesta.identificacion_tercero;
                var nombre1_tercero = respuesta.nombre1_tercero;
                var nombre2_tercero = respuesta.nombre2_tercero;
                var apellido1_tercero = respuesta.apellido1_tercero;
                var apellido2_tercero = respuesta.apellido2_tercero;
                var fecha_nac_tercero = respuesta.fecha_nac_tercero;
                var fecha_expedicion_tercero = respuesta.fecha_expedicion_tercero;
                var telefono1_tercero = respuesta.telefono1_tercero;
                var correo_tercero = respuesta.correo_tercero;
                var direccion_tercero = respuesta.direccion_tercero;

                if (resultado > '0') {
                    $("#nombre1_tercero").val(nombre1_tercero);
                    $("#nombre2_tercero").val(nombre2_tercero);
                    $("#apellido1_tercero").val(apellido1_tercero);
                    $("#apellido2_tercero").val(apellido2_tercero);
                    $("#fecha_nac_tercero").val(fecha_nac_tercero);
                    $("#fecha_expedicion_tercero").val(fecha_expedicion_tercero);
                    $("#telefono1_tercero").val(telefono1_tercero);
                    $("#correo_tercero").val(correo_tercero);
                    $("#direccion_tercero").val(direccion_tercero);
                    $("#mensaje_verificacion_documento").html(mensaje);
                    $("#nombre_boton_accion").html("Continuar");
                    //$("#submit").attr("disabled",true);
                } else {
                    $("#mensaje_verificacion_documento").html(mensaje);
                    $("#submit").attr("disabled",false);
                }
            }
        });
    });
});
</script>