<?php 
$nombre_pagina          = "Registrar Soporte";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_confirmdirect.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_confirmdirect.php"); ?>
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

<?php include_once("../admin/03_modulo_css_visitante_intern_confirmdirect.php"); ?>
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
<?php include_once("../seguridad/seguridad_diseno_plantillas_visitante_intern_confirmdirect.php"); ?>
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

$sql_info_administrador = "SELECT * FROM tbl15_administrador WHERE cuenta = '$cuenta'";
$consultar_info_administrador = mysqli_query($conectar, $sql_info_administrador) or die(mysqli_error($conectar));
$info_administrador = mysqli_fetch_assoc($consultar_info_administrador);

$nombre1_tercero                              = $info_administrador['nombre1_tercero'];
$apellido1_tercero                            = $info_administrador['apellido1_tercero'];
$telefono1_tercero                            = $info_administrador['telefono1_tercero'];
$correo_tercero                               = $info_administrador['correo_tercero'];
?>
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/reg_soporte_tecnico_visitante_intern_confirmdirect_reg.php">
            <div id="salida_info_actualizada_carrito_compra_ajax" class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">

                            <div class="mb-3">
                                <label for="address">Tu correo de registro *</label>
                                <input type="text" class="form-control" name="correo_registro_soporte_tecnico" id="correo_registro_soporte_tecnico" value="<?php echo $correo_tercero ?>" placeholder="" required>
                                <div class="invalid-feedback">Tu correo de registro</div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Correo - Contraseña - Perfil (solo si aplica) de la cuenta dañada. *</label>
                                <textarea class="form-control" name="correo_contrasena_perfil_cuenta_danada_soporte_tecnico" id="correo_contrasena_perfil_cuenta_danada_soporte_tecnico" placeholder="" rows="2" cols="5" required></textarea>
                                <div class="invalid-feedback">Correo - Contraseña - Perfil (solo si aplica) de la cuenta dañada</div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Perfil o Cuenta completa *</label><br>
                                <select name="cod_perfil_cuenta_completa" id="cod_perfil_cuenta_completa" class="form-control" data-show-subtext="false" data-live-search="false" tabindex="1" required>
                                    <?php if (isset($cod_perfil_cuenta_completa)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                                    $consulta2_sql = "SELECT cod_perfil_cuenta_completa, nombre_perfil_cuenta_completa FROM tbl15_perfil_cuenta_completa WHERE (cod_estado = '1') ORDER BY cod_perfil_cuenta_completa ASC";
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_perfil_cuenta_completa) AND $cod_perfil_cuenta_completa == $datos2['cod_perfil_cuenta_completa']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_perfil_cuenta_completa'];
                                    $nombre = $datos2['nombre_perfil_cuenta_completa'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                                <div class="invalid-feedback"> Perfil o Cuenta completa </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Fecha de compra *</label>
                                <input type="date" class="form-control" name="fecha_compra_soporte_tecnico" id="fecha_compra_soporte_tecnico" value="<?php echo date("Y-m-d") ?>" placeholder="" required>
                                <div class="invalid-feedback"> Fecha de compra </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Fecha de vencimiento *</label>
                                <input type="date" class="form-control" name="fecha_vencimiento_soporte_tecnico" id="fecha_vencimiento_soporte_tecnico" value="<?php echo date("Y-m-d") ?>" placeholder="" required>
                                <div class="invalid-feedback"> Fecha de vencimiento </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Descripción del Problema *</label>
                                <textarea class="form-control" name="problema_soporte_tecnico" id="problema_soporte_tecnico" placeholder="Describa el problema" rows="2" cols="5" required></textarea>
                                <div class="invalid-feedback"> Descripción del Problema</div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Plataforma *</label><br>
                                <select name="cod_plataforma_streaming" id="cod_plataforma_streaming" class="form-control" data-show-subtext="false" data-live-search="false" tabindex="1" required>
                                    <?php if (isset($cod_plataforma_streaming)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                                    $consulta2_sql = "SELECT cod_plataforma_streaming, nombre_plataforma_streaming FROM tbl15_plataforma_streaming WHERE (cod_estado = '1') ORDER BY cod_plataforma_streaming ASC";
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_plataforma_streaming) AND $cod_plataforma_streaming == $datos2['cod_plataforma_streaming']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_plataforma_streaming'];
                                    $nombre = $datos2['nombre_plataforma_streaming'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                                <div class="invalid-feedback"> Plataforma </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Tipo de reporte *</label><br>
                                    <?php
                                    $consulta2_sql = "SELECT cod_tipo_reporte_fallo, nombre_tipo_reporte_fallo FROM tbl15_tipo_reporte_fallo WHERE (cod_estado = '1') ORDER BY cod_tipo_reporte_fallo ASC";
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_tipo_reporte_fallo) AND $cod_tipo_reporte_fallo == $datos2['cod_tipo_reporte_fallo']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_tipo_reporte_fallo'];
                                    $nombre = $datos2['nombre_tipo_reporte_fallo'];
                                    echo "<input type='radio' name='cod_tipo_reporte_fallo' id='cod_tipo_reporte_fallo' class='' value='".$codigo."'> ".$nombre."<br>"; } ?>
                                <div class="invalid-feedback"> Tipo de reporte </div>
                            </div>
                            <div class="mb-3">
                                <label for="telefono">Puedes carga una imagen para mostrar el error. </label>
                                <input type="file" id="url_img1" name="url_img1" multiple/>
                                <div class="invalid-feedback"> Adjuntar Soporte. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Aceptar términos y condiciones *</label>
                                <input type="checkbox" name="cod_estado_acepta_terminos_condiciones" id="cod_estado_acepta_terminos_condiciones" class="" value="" required>
                                <div class="invalid-feedback"> Aceptar términos y condiciones </div>
                            </div>

                            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                            <input type="hidden" name="insertar_datos" value="formulario">
                            <div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Enviar Solicitud</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Cart -->

<?php include_once("../admin/09_modulo_footer_visitante_intern_confirmdirect.php"); ?>

<?php include_once("../admin/10_modulo_js_visitante_intern_confirmdirect.php"); ?>

</body>

</html>