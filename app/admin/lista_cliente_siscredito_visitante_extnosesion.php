<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_extnosesion.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_extnosesion.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_extnosesion.php"); ?>
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
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_extnosesion.php"); ?>
    <!-- End Main Top -->
<?php //include_once("06_modulo_imagen_head.php"); ?>

<?php if (isset($_REQUEST['cod_tercero_codifcryp'])) { 
    $cod_tercero_codifcryp            = ($_REQUEST['cod_tercero_codifcryp']);
    $cod_tercero_codif                = DAXCODIFCRYPTOR::descriptardax($cod_tercero_codifcryp);
    $cod_tercero                      = intval(DAXCODIFCRYPTOR::descodifdax($cod_tercero_codif));
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div id="eliminar_ok" style="display:none;">&nbsp;</div>

        <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main">
                        <div class="mb-2">
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">T.Doc</th>
                                    <th style="text-align:center;">Documento</th>
                                    <th style="text-align:center;">Nombres</th>
                                    <th style="text-align:center;">Direccion</th>
                                    <th style="text-align:center;">Telefono</th>
                                    <!--<th style="text-align:center;">Soportes</th>-->
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

$sql_consulta = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$query_consulta = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($datos_consulta = mysqli_fetch_assoc($query_consulta)) {

    $cod_tercero                   = $datos_consulta['cod_tercero'];
    $nombre_tipo_tercero           = $datos_consulta['nombre_tipo_tercero'];
    $nombre_tipo_identificacion    = $datos_consulta['nombre_tipo_identificacion'];
    $identificacion_tercero        = $datos_consulta['identificacion_tercero'];
    $digito_tercero                = $datos_consulta['digito_tercero'];
    $nombre1_tercero               = $datos_consulta['nombre1_tercero'];
    $nombre2_tercero               = $datos_consulta['nombre2_tercero'];
    $apellido1_tercero             = $datos_consulta['apellido1_tercero'];
    $apellido2_tercero             = $datos_consulta['apellido2_tercero'];
    $direccion_tercero             = $datos_consulta['direccion_tercero'];
    $telefono1_tercero             = $datos_consulta['telefono1_tercero'];
    $telefono2_tercero             = $datos_consulta['telefono2_tercero'];
    $correo_tercero                = $datos_consulta['correo_tercero'];
    $nombre_pais                   = $datos_consulta['nombre_pais'];
    $nombre_departamento           = $datos_consulta['nombre_departamento'];
    $nombre_ciudad                 = $datos_consulta['nombre_ciudad'];
    $nombre_tipo_cliente           = $datos_consulta['nombre_tipo_cliente'];
    $nombre_tipo_regimen           = $datos_consulta['nombre_tipo_regimen'];
    $nombre_tipo_impuesto          = $datos_consulta['nombre_tipo_impuesto'];
    $contacto_tercero              = $datos_consulta['contacto_tercero'];
    $fax_tercero                   = $datos_consulta['fax_tercero'];
    //$cod_administrador             = $datos_consulta['cod_administrador'];
    $cod_estado_existe_usuario     = $datos_consulta['cod_estado_existe_usuario'];

    $sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
    $info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
        
    $cedula                        = $info_usuario_admin['cedula'];
    $nombres                       = $info_usuario_admin['nombres'];
    $apellidos                     = $info_usuario_admin['apellidos'];
    $cuenta                        = $info_usuario_admin['cuenta'];
    $usuario                       = $nombres.' '.$apellidos.' | '.$cuenta;
    $nombre_subalterno_concat      = '';
?>
                                <tr>
                                    <td style="text-align:center;" class="name-pr"><?php echo $nombre_tipo_identificacion ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $identificacion_tercero ?></td>
                                    <td style="text-align:left;" class="name-pr"><?php echo trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero) ?></td>
                                    <td style="text-align:left;" class="name-pr"><?php echo $direccion_tercero ?></td>
                                    <td style="text-align:center;" class="name-pr"><?php echo $telefono1_tercero ?></td>
                                    <!--<td style="text-align:center;" class="name-pr"><a href="../admin/lista_soportes_cliente_siscredito_visitante_intern.php?cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>-->
                                    <td style="text-align:center;" class="name-pr"><?php echo $cod_tercero ?></td>
                                </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
<?php } ?>

<?php include_once("../admin/09_modulo_footer_visitante_extnosesion.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_extnosesion.php"); ?>

</body>

</html>