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

<?php if (isset($_GET['cod_producto_codifcryp'])) { 
    $cod_producto_codifcryp                      = ($_GET['cod_producto_codifcryp']);
    $cod_producto_codif                          = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
    $valor_credito                               = intval($_GET['valor_credito']);
    $cod_entidad_crediticia                      = intval($_GET['cod_entidad_crediticia']);
    $cod_tipo_cobro                              = intval($_GET['cod_tipo_cobro']);
    $cod_meses_credito                           = intval($_GET['cod_meses_credito']);

    $nombre_tipo_tercero                         = 'CLIENTE';
    $nombre_tipo_tercero_modulo_creacion         = 'CLIENTE';

    $sql_requisito_credito = "SELECT * FROM tbl15_requisito_credito WHERE (cod_requisito_credito = '1')";
    $consulta_requisito_credito = mysqli_query($conectar, $sql_requisito_credito) or die(mysqli_error($conectar));
    $datos_requisito_credito = mysqli_fetch_assoc($consulta_requisito_credito);

    $cod_requisito_credito                       = $datos_requisito_credito['cod_requisito_credito'];
    $nombre_requisito_credito                    = $datos_requisito_credito['nombre_requisito_credito'];
    $descripcion_requisito_credito               = $datos_requisito_credito['descripcion_requisito_credito'];

    if ($cod_seguridad == '1') {
        $condicion_vendedor = '';
        $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
    } else {
        if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
            $condicion_vendedor = '';
            $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
        } else {
            $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador;
            $condicion_vendedor_option = '';
        }
    }
    $cod_seguridad                               = intval($_GET['cod_seguridad']);

    $sql_seguridad = "SELECT nombre_seguridad FROM tbl15_seguridad WHERE (cod_seguridad = '$cod_seguridad')";
    $consulta_seguridad = mysqli_query($conectar, $sql_seguridad) or die(mysqli_error($conectar));
    $datos_seguridad = mysqli_fetch_assoc($consulta_seguridad);

    $nombre_seguridad                            = ucfirst(strtolower($datos_seguridad['nombre_seguridad']));
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
                        <div id="mensaje_verificacion_documento"></div>
                        <form action="../admin/reg_tercero_visitante_intern_siscredito_reg.php" method="post" id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">Tipo de documento
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
                                    <div class="form-group">Documento
                                        <input type="number" class="form-control" id="identificacion_tercero" name="identificacion_tercero" placeholder="Numero de identificación" required data-error="Por favor, escriba su numero de identificación"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Nombre del aliado estrategico
                                        <input type="text" class="form-control" id="nombre1_tercero" name="nombre1_tercero" placeholder="Nombre" required data-error="Por favor, ingrese su nombre" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Celular
                                        <input type="number" class="form-control" id="telefono1_tercero" name="telefono1_tercero" placeholder="Celular" required data-error="Por favor, ingrese su celular"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Correo
                                        <input type="email" class="form-control" id="correo_tercero" name="correo_tercero" placeholder="Correo" required data-error="Por favor, ingrese su Correo" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">Dirección
                                        <input type="text" class="form-control" id="direccion_tercero" name="direccion_tercero" placeholder="Dirección" data-error="Por favor, ingrese su dirección" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit">Registrar Aliado</button>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp; ?>" />
                                <input type="hidden" name="valor_credito" value="<?php echo $valor_credito; ?>" />
                                <input type="hidden" name="cod_entidad_crediticia" value="<?php echo $cod_entidad_crediticia; ?>" />
                                <input type="hidden" name="cod_tipo_cobro" value="<?php echo $cod_tipo_cobro; ?>" />
                                <input type="hidden" name="cod_meses_credito" value="<?php echo $cod_meses_credito; ?>" />
                                <input type="hidden" name="nombre_tipo_tercero" value="<?php echo $nombre_tipo_tercero; ?>" />
                                <input type="hidden" name="nombre_tipo_tercero_modulo_creacion" value="<?php echo $nombre_tipo_tercero_modulo_creacion; ?>" />
                                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>" />
                                <input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad; ?>" />
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

                if (resultado > '0') {
                    $("#submit").attr("disabled",true);
                    $("#mensaje_verificacion_documento").html(mensaje);
                } else {
                    $("#submit").attr("disabled",false);
                    $("#mensaje_verificacion_documento").html(mensaje);
                }
            }
        });
    });
});
</script>