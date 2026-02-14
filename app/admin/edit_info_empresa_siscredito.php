<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 

<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
    resena_info_empresa = CKEDITOR.replace("resena_info_empresa");
    CKFinder.setupCKEditor(resena_info_empresa, 'ckeditor/ckfinder');

    mision_info_empresa = CKEDITOR.replace("mision_info_empresa");
    CKFinder.setupCKEditor(mision_info_empresa, 'ckeditor/ckfinder');

    vision_info_empresa = CKEDITOR.replace("vision_info_empresa");
    CKFinder.setupCKEditor(vision_info_empresa, 'ckeditor/ckfinder');

    declaracion_privacidad_info_empresa = CKEDITOR.replace("declaracion_privacidad_info_empresa");
    CKFinder.setupCKEditor(declaracion_privacidad_info_empresa, 'ckeditor/ckfinder');

    politica_devolucion_info_empresa = CKEDITOR.replace("politica_devolucion_info_empresa");
    CKFinder.setupCKEditor(politica_devolucion_info_empresa, 'ckeditor/ckfinder');

    info_entrega_info_empresa = CKEDITOR.replace("info_entrega_info_empresa");
    CKFinder.setupCKEditor(info_entrega_info_empresa, 'ckeditor/ckfinder');

    politica_calidad_info_empresa = CKEDITOR.replace("politica_calidad_info_empresa");
    CKFinder.setupCKEditor(politica_calidad_info_empresa, 'ckeditor/ckfinder');

    principios_filosoficos_info_empresa = CKEDITOR.replace("principios_filosoficos_info_empresa");
    CKFinder.setupCKEditor(principios_filosoficos_info_empresa, 'ckeditor/ckfinder');

    politica_tratamiento_datos_info_empresa = CKEDITOR.replace("politica_tratamiento_datos_info_empresa");
    CKFinder.setupCKEditor(politica_tratamiento_datos_info_empresa, 'ckeditor/ckfinder');
}
</script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_info_empresa.php"><h4>Editar Info Empresa</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                        = $_SERVER['PHP_SELF'];
$pagina_local                  = $_SERVER['PHP_SELF'];

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'nombre_producto'; }
$cod_info_empresa                           = 1;

$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$resena_info_empresa                        = $matriz_consulta['resena_info_empresa'];
$mision_info_empresa                        = $matriz_consulta['mision_info_empresa'];
$vision_info_empresa                        = $matriz_consulta['vision_info_empresa'];
$direccion                                  = $matriz_consulta['direccion'];
$localidad                                  = $matriz_consulta['localidad'];
$correo                                     = $matriz_consulta['correo'];
$tel1                                       = $matriz_consulta['tel1'];
$tel2                                       = $matriz_consulta['tel2'];
$declaracion_privacidad_info_empresa        = $matriz_consulta['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa           = $matriz_consulta['politica_devolucion_info_empresa'];
$politica_tratamiento_datos_info_empresa    = $matriz_consulta['politica_tratamiento_datos_info_empresa'];
$info_entrega_info_empresa                  = $matriz_consulta['info_entrega_info_empresa'];
$politica_calidad_info_empresa              = $matriz_consulta['politica_calidad_info_empresa'];
$principios_filosoficos_info_empresa        = $matriz_consulta['principios_filosoficos_info_empresa'];
$url_redsocial_facebook                     = $matriz_consulta['url_redsocial_facebook'];
$url_redsocial_twitter                      = $matriz_consulta['url_redsocial_twitter'];
$url_redsocial_linkedin                     = $matriz_consulta['url_redsocial_linkedin'];
$url_redsocial_skype                        = $matriz_consulta['url_redsocial_skype'];
$url_redsocial_instagram                    = $matriz_consulta['url_redsocial_instagram'];
$url_redsocial_pinterest                    = $matriz_consulta['url_redsocial_pinterest'];
$url_redsocial_youtube                      = $matriz_consulta['url_redsocial_youtube'];
$url_redsocial_tiktok                       = $matriz_consulta['url_redsocial_tiktok'];
$url_redsocial_telegram                     = $matriz_consulta['url_redsocial_telegram'];
$url_redsocial_whatsapp                     = $matriz_consulta['url_redsocial_whatsapp'];
$url_redsocial_generic1                     = $matriz_consulta['url_redsocial_generic1'];
$url_redsocial_generic2                     = $matriz_consulta['url_redsocial_generic2'];
$url_redsocial_generic3                     = $matriz_consulta['url_redsocial_generic3'];
$description                                = $matriz_consulta['description'];
$keywords                                   = $matriz_consulta['keywords'];
$author                                     = $matriz_consulta['author'];
$url_mapa1                                  = $matriz_consulta['url_mapa1'];
$url_mapa2                                  = $matriz_consulta['url_mapa2'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_info_empresa_siscredito_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">HISTORIA - RESEÑA DE LA EMPRESA - (QUIENES SOMOS)</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="resena_info_empresa" id="resena_info_empresa" rows="2" cols="20"><?php echo $resena_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">MISION DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="mision_info_empresa" id="mision_info_empresa" rows="2" cols="20"><?php echo $mision_info_empresa ?></textarea></td>
        </tr> 
        <tr>
            <th style="text-align:center">VISION DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="vision_info_empresa" id="vision_info_empresa" rows="2" cols="20"><?php echo $vision_info_empresa ?></textarea></td>
        </tr> 
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DIRECCION</th>
            <th style="text-align:center">LOCALIDAD</th>
            <th style="text-align:center">CORREO</th>
            <th style="text-align:center">TELEFONO 1</th>
            <th style="text-align:center">TELEFONO 2</th>

        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="direccion" id="direccion" type="text" min="1" value="<?php echo $direccion ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="localidad" id="localidad" type="text" min="1" value="<?php echo $localidad ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="correo" id="correo" type="text" min="1" value="<?php echo $correo ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="tel1" id="tel1" type="text" min="1" value="<?php echo $tel1 ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="tel2" id="tel2" type="text" min="1" value="<?php echo $tel2 ?>" size="50"  /></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th style="text-align:center">POLITICAS DE LA EMPRESA</th><tr></thead></table>
<table border="1" class="table table-responsive">
    <thead>
  
        <tr>
            <th style="text-align:center">POLITICA DE TRATAMIENTO DE DATOS DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="politica_tratamiento_datos_info_empresa" id="politica_tratamiento_datos_info_empresa" rows="2" cols="20"><?php echo $politica_tratamiento_datos_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">POLITICA DE PRIVACIDAD DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="declaracion_privacidad_info_empresa" id="declaracion_privacidad_info_empresa" rows="2" cols="20"><?php echo $declaracion_privacidad_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">POLITICA DE DEVOLUCION DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="politica_devolucion_info_empresa" id="politica_devolucion_info_empresa" rows="2" cols="20"><?php echo $politica_devolucion_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">POLITICA DE ENTREGA DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="info_entrega_info_empresa" id="info_entrega_info_empresa" rows="2" cols="20"><?php echo $info_entrega_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">POLITICA DE CALIDAD DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="politica_calidad_info_empresa" id="politica_calidad_info_empresa" rows="2" cols="20"><?php echo $politica_calidad_info_empresa ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">PRINCIPIOS DE LA EMPRESA</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="principios_filosoficos_info_empresa" id="principios_filosoficos_info_empresa" rows="2" cols="20"><?php echo $principios_filosoficos_info_empresa ?></textarea></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th style="text-align:center">REDES SOCIALES</th><tr></thead></table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">FACEBOOK</th>
            <th style="text-align:center">TWITTER (X)</th>
            <th style="text-align:center">LINKEDIN</th>
            <th style="text-align:center">SKYPE</th>
            <th style="text-align:center">INSTAGRAM</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_facebook" id="url_redsocial_facebook" rows="2" cols="20"><?php echo $url_redsocial_facebook ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_twitter" id="url_redsocial_twitter" rows="2" cols="20"><?php echo $url_redsocial_twitter ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_linkedin" id="url_redsocial_linkedin" rows="2" cols="20"><?php echo $url_redsocial_linkedin ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_skype" id="url_redsocial_skype" rows="2" cols="20"><?php echo $url_redsocial_skype ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_instagram" id="url_redsocial_instagram" rows="2" cols="20"><?php echo $url_redsocial_instagram ?></textarea></td>
        </tr>
        <tr>
            <th style="text-align:center">PINTEREST</th>
            <th style="text-align:center">YOUTUBE</th>
            <th style="text-align:center">TIKTOK</th>
            <th style="text-align:center">TEELGRAM</th>
            <th style="text-align:center">WHATSAPP</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_pinterest" id="url_redsocial_pinterest" rows="2" cols="20"><?php echo $url_redsocial_pinterest ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_youtube" id="url_redsocial_youtube" rows="2" cols="20"><?php echo $url_redsocial_youtube ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_tiktok" id="url_redsocial_tiktok" rows="2" cols="20"><?php echo $url_redsocial_tiktok ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_telegram" id="url_redsocial_telegram" rows="2" cols="20"><?php echo $url_redsocial_telegram ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_redsocial_whatsapp" id="url_redsocial_whatsapp" rows="2" cols="20"><?php echo $url_redsocial_whatsapp ?></textarea></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th style="text-align:center">ESTRATEGIA SEO NAVEGADORES</th><tr></thead></table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DESCRIPCION SEO</th>
            <th style="text-align:center">KEYWORDS SEO</th>
            <th style="text-align:center">AUTOR SEO</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="description" id="description" rows="2" cols="20"><?php echo $description ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="keywords" id="keywords" rows="2" cols="20"><?php echo $keywords ?></textarea></td>
            <td style="text-align:center"><input class="input-block-level" name="author" id="author" type="text" value="<?php echo $author ?>" /></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th style="text-align:center">MAPA</th><tr></thead></table>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">MAPA EMBED 1</th>
            <th style="text-align:center">MAPA EMBED 2</th>
        </tr>
        <tr>
            <td style="text-align:center"><textarea class="input-block-level" name="url_mapa1" id="url_mapa1" rows="2" cols="20"><?php echo $url_mapa1 ?></textarea></td>
            <td style="text-align:center"><textarea class="input-block-level" name="url_mapa2" id="url_mapa2" rows="2" cols="20"><?php echo $url_mapa2 ?></textarea></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_info_empresa" value="<?php echo $cod_info_empresa ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
</fieldset>
</form>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>