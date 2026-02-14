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
    descripcion_banner_slider = CKEDITOR.replace("descripcion_banner_slider");
    CKFinder.setupCKEditor(descripcion_banner_slider, 'ckeditor/ckfinder');
    console.log("sdsd");
}
</script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Slider</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                  = $_SERVER['PHP_SELF'];

$cod_banner_slider                  = intval($_GET['cod_banner_slider']);
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'nombre_producto'; }

$mostrar_datos_sql = "SELECT * FROM tbl15_banner_slider WHERE cod_banner_slider = '$cod_banner_slider'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_banner_slider                       = $matriz_consulta['nombre_banner_slider'];
$descripcion_banner_slider                  = $matriz_consulta['descripcion_banner_slider'];
$texto_boton_accion_banner_slider           = $matriz_consulta['texto_boton_accion_banner_slider'];
$url_img_banner_slider_orig                 = $matriz_consulta['url_img_banner_slider_orig'];
$url_img_banner_slider_min                  = $matriz_consulta['url_img_banner_slider_min'];
$alineacion_texto_banner_slider             = $matriz_consulta['alineacion_texto_banner_slider'];
$url_personaje_banner_slider                = $matriz_consulta['url_personaje_banner_slider'];
$url_personaje_banner_slider_min            = $matriz_consulta['url_personaje_banner_slider_min'];
$nombre_accion_banner_slider                = $matriz_consulta['nombre_accion_banner_slider'];
$descripcion_accion_banner_slider           = $matriz_consulta['descripcion_accion_banner_slider'];
$url_accion_banner_slider                   = $matriz_consulta['url_accion_banner_slider'];
$active_banner_slider                       = $matriz_consulta['active_banner_slider'];
$active_banner_slider2                      = $matriz_consulta['active_banner_slider2'];
$posicion_banner_slider                     = $matriz_consulta['posicion_banner_slider'];
$cod_estado                                 = $matriz_consulta['cod_estado'];
$nombre_estado                              = $matriz_consulta['nombre_estado'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_slider_principal_nosotros_siscredito_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE</th>
            <th style="text-align:center">TEXTO BOTON ACCION</th>
            <th style="text-align:center">URL ACCION</th>
            <th style="text-align:center">POSICION</th>
            <th style="text-align:center">ESTADO</th>
        </tr>
        <tr>
            <td style="text-align:center"><input class="input-block-level" name="nombre_banner_slider" id="nombre_banner_slider" type="text" value="<?php echo $nombre_banner_slider ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="texto_boton_accion_banner_slider" id="texto_boton_accion_banner_slider" type="text" value="<?php echo $texto_boton_accion_banner_slider ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="url_accion_banner_slider" id="url_accion_banner_slider" type="text" value="<?php echo $url_accion_banner_slider ?>" size="50" required /></td>
            <td style="text-align:center"><input class="input-block-level" name="posicion_banner_slider" id="posicion_banner_slider" type="number" min="1" value="<?php echo $posicion_banner_slider ?>" size="50" required /></td>
            <td style="text-align:center">
                <select name="cod_estado" id="" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" >
                    <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT codigo_estado, nombre_estado FROM tbl15_estado");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado) and $cod_estado == $datos2['codigo_estado']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['codigo_estado'];
                    $nombre = $datos2['nombre_estado'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">DESCRIPCION</th>
        </tr>
        <tr>
            <th style="text-align:center"><textarea class="input-block-level" name="descripcion_banner_slider" id="descripcion_banner_slider" rows="2" cols="20"><?php echo $descripcion_banner_slider ?></textarea></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CAMBIAR IMAGEN DE FONDO</th>
            <th style="text-align:center">CAMBIAR IMAGEN PERSONAJE</th>
        </tr>
        <tr>
            <th style="text-align:center"><a href="../admin/cambiar_imagen_fondo_slider_principal_nosotros_siscredito.php?cod_banner_slider=<?php echo $cod_banner_slider?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>"><img src="<?php echo $url_img_banner_slider_min?>" style="height: 100px" alt="CAMBIAR IMAGEN DE FONDO"></a></th>
            <th style="text-align:center"><a href="../admin/cambiar_imagen_personaje_slider_principal_nosotros_siscredito.php?cod_banner_slider=<?php echo $cod_banner_slider?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>"><img src="<?php echo $url_personaje_banner_slider_min?>" style="height: 100px" alt="CAMBIAR IMAGEN PERSONAJE"></a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_banner_slider" value="<?php echo $cod_banner_slider ?>"/>
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