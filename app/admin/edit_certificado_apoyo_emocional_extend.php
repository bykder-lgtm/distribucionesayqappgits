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

    estructura_todo_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_todo_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_todo_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_todo_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_todo_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_todo_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');

    estructura_profesional_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_profesional_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_profesional_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_propietario_diagnosti_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_propietario_diagnosti_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_propietario_diagnosti_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_justificacion_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_justificacion_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_justificacion_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_tabla_mascota_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_tabla_mascota_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_tabla_mascota_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_vigencia_certificado_apoyo_emocional_esp = CKEDITOR.replace("estructura_vigencia_certificado_apoyo_emocional_esp");
    CKFinder.setupCKEditor(estructura_vigencia_certificado_apoyo_emocional_esp, 'ckeditor/ckfinder');

    estructura_profesional_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_profesional_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_profesional_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');

    estructura_propietario_diagnosti_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_propietario_diagnosti_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_propietario_diagnosti_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');

    estructura_justificacion_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_justificacion_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_justificacion_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');

    estructura_tabla_mascota_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_tabla_mascota_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_tabla_mascota_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');

    estructura_vigencia_certificado_apoyo_emocional_eng = CKEDITOR.replace("estructura_vigencia_certificado_apoyo_emocional_eng");
    CKFinder.setupCKEditor(estructura_vigencia_certificado_apoyo_emocional_eng, 'ckeditor/ckfinder');
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
<div class="breadcrumbs"><a href="#"><h4>Editar Producto</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                  = $_SERVER['PHP_SELF'];

if (isset($_GET['cod_certificado_apoyo_emocional'])) {

    $cod_certificado_apoyo_emocional                                           = intval($_GET['cod_certificado_apoyo_emocional']);
    if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'nombre_producto'; }

    $mostrar_datos_sql = "SELECT * FROM tbl15_certificado_apoyo_emocional WHERE cod_certificado_apoyo_emocional = '$cod_certificado_apoyo_emocional'";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_certificado_apoyo_emocional                                        = $matriz_consulta['nombre_certificado_apoyo_emocional'];
    $descripcion_certificado_apoyo_emocional                                   = $matriz_consulta['descripcion_certificado_apoyo_emocional'];
    $estructura_profesional_certificado_apoyo_emocional_esp                    = $matriz_consulta['estructura_profesional_certificado_apoyo_emocional_esp'];
    $estructura_propietario_diagnosti_certificado_apoyo_emocional_esp          = $matriz_consulta['estructura_propietario_diagnosti_certificado_apoyo_emocional_esp'];
    $estructura_justificacion_certificado_apoyo_emocional_esp                  = $matriz_consulta['estructura_justificacion_certificado_apoyo_emocional_esp'];
    $estructura_tabla_mascota_certificado_apoyo_emocional_esp                  = $matriz_consulta['estructura_tabla_mascota_certificado_apoyo_emocional_esp'];
    $estructura_vigencia_certificado_apoyo_emocional_esp                       = $matriz_consulta['estructura_vigencia_certificado_apoyo_emocional_esp'];
    $estructura_titulo_certificado_apoyo_emocional_eng                         = $matriz_consulta['estructura_titulo_certificado_apoyo_emocional_eng'];
    $estructura_profesional_certificado_apoyo_emocional_eng                    = $matriz_consulta['estructura_profesional_certificado_apoyo_emocional_eng'];
    $estructura_propietario_diagnosti_certificado_apoyo_emocional_eng          = $matriz_consulta['estructura_propietario_diagnosti_certificado_apoyo_emocional_eng'];
    $estructura_justificacion_certificado_apoyo_emocional_eng                  = $matriz_consulta['estructura_justificacion_certificado_apoyo_emocional_eng'];
    $estructura_tabla_mascota_certificado_apoyo_emocional_eng                  = $matriz_consulta['estructura_tabla_mascota_certificado_apoyo_emocional_eng'];
    $estructura_vigencia_certificado_apoyo_emocional_eng                       = $matriz_consulta['estructura_vigencia_certificado_apoyo_emocional_eng'];

    $estructura_todo_certificado_apoyo_emocional_esp                           = $matriz_consulta['estructura_todo_certificado_apoyo_emocional_esp'];
    $estructura_todo_certificado_apoyo_emocional_eng                           = $matriz_consulta['estructura_todo_certificado_apoyo_emocional_eng'];

    $nombre_mascota                                                            = $matriz_consulta['nombre_mascota'];
    $edad_mascota                                                              = $matriz_consulta['edad_mascota'];
    $unidad_medida_edad_mascota                                                = $matriz_consulta['unidad_medida_edad_mascota'];
    $nombre_raza_mascota                                                       = $matriz_consulta['nombre_raza_mascota'];
    $color_mascota                                                             = $matriz_consulta['color_mascota'];
    $peso_mascota                                                              = $matriz_consulta['peso_mascota'];
    $unidad_medida_peso_mascota                                                = $matriz_consulta['unidad_medida_peso_mascota'];
    $talla_mascota                                                             = $matriz_consulta['talla_mascota'];
    $nombre_profesional                                                        = $matriz_consulta['nombre_profesional'];
    $documento_profesional                                                     = $matriz_consulta['documento_profesional'];
    $tarjeta_profesional                                                       = $matriz_consulta['tarjeta_profesional'];
    $nombre_propietario_mascota                                                = $matriz_consulta['nombre_propietario_mascota'];
    $documento_propietario_mascota                                             = $matriz_consulta['documento_propietario_mascota'];
    $direccion_propietario_mascota                                             = $matriz_consulta['direccion_propietario_mascota'];
    $correo_propietario_mascota                                                = $matriz_consulta['correo_propietario_mascota'];
    $fecha_certificado_apoyo_emocional                                         = $matriz_consulta['fecha_certificado_apoyo_emocional'];
    $hora_certificado_apoyo_emocional                                          = $matriz_consulta['hora_certificado_apoyo_emocional'];
?>
    <form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/edit_certificado_apoyo_emocional_extend_reg.php">
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Fecha</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="fecha_certificado_apoyo_emocional" type="date" value="<?php echo $fecha_certificado_apoyo_emocional ?>" required /></td>
            </tr>
        </thead>
    </table>

<hr>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Documento En Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_todo_certificado_apoyo_emocional_esp" id="estructura_todo_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_todo_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
        </thead>
    </table>

<hr>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Documento En Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_todo_certificado_apoyo_emocional_eng" id="estructura_todo_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_todo_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
        </thead>
    </table>

<hr>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Parte 1 - Documento Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_profesional_certificado_apoyo_emocional_esp" id="estructura_profesional_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_profesional_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 2 - Documento Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_propietario_diagnosti_certificado_apoyo_emocional_esp" id="estructura_propietario_diagnosti_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_propietario_diagnosti_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 3 - Documento Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_justificacion_certificado_apoyo_emocional_esp" id="estructura_justificacion_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_justificacion_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 4 - Documento Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_tabla_mascota_certificado_apoyo_emocional_esp" id="estructura_tabla_mascota_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_tabla_mascota_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 5 - Documento Español</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_vigencia_certificado_apoyo_emocional_esp" id="estructura_vigencia_certificado_apoyo_emocional_esp" rows="2" cols="20"><?php echo $estructura_vigencia_certificado_apoyo_emocional_esp ?></textarea></th>
            </tr>
        </thead>
    </table>

<hr>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Parte 1 - Documento Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_profesional_certificado_apoyo_emocional_eng" id="estructura_profesional_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_profesional_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 2 - Documento Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_propietario_diagnosti_certificado_apoyo_emocional_eng" id="estructura_propietario_diagnosti_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_propietario_diagnosti_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 3 - Documento Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_justificacion_certificado_apoyo_emocional_eng" id="estructura_justificacion_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_justificacion_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 4 - Documento Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_tabla_mascota_certificado_apoyo_emocional_eng" id="estructura_tabla_mascota_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_tabla_mascota_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
            <tr>
                <th style="text-align:center">Parte 5 - Documento Ingles</th>
            </tr>
            <tr>
                <th style="text-align:center"><textarea class="input-block-level" name="estructura_vigencia_certificado_apoyo_emocional_eng" id="estructura_vigencia_certificado_apoyo_emocional_eng" rows="2" cols="20"><?php echo $estructura_vigencia_certificado_apoyo_emocional_eng ?></textarea></th>
            </tr>
        </thead>
    </table>

    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align:center">Nombres y Apellidos</th>
                <th style="text-align:center">Numero de Documento</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="nombre_propietario_mascota" type="text" value="<?php echo $nombre_propietario_mascota ?>" required /></td>
                <td style="text-align:center"><input class="input-block-level" name="documento_propietario_mascota" type="number" value="<?php echo $documento_propietario_mascota ?>" required /></td>
            </tr>
            <tr>
                <th style="text-align:center">Dirección</th>
                <th style="text-align:center">Correo Electronico</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="direccion_propietario_mascota" type="text" value="<?php echo $direccion_propietario_mascota ?>" required /></td>
                <td style="text-align:center"><input class="input-block-level" name="correo_propietario_mascota" type="text" value="<?php echo $correo_propietario_mascota ?>" /></td>
            </tr>
            <tr>
                <th style="text-align:center">Nombre de la Mascota</th>
                <th style="text-align:center">Edad de la Mascota (Años)</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="nombre_mascota" type="text" value="<?php echo $nombre_mascota ?>" required /></td>
                <td style="text-align:center"><input class="input-block-level" name="edad_mascota" type="number" value="<?php echo $edad_mascota ?>" step="any" lang="en" min="1" max="999" oninput="validity.valid||(value='');" required /></td>
            </tr>
            <tr>
                <th style="text-align:center">Raza de la Mascota</th>
                <th style="text-align:center">Color de la Mascota</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="nombre_raza_mascota" type="text" value="<?php echo $nombre_raza_mascota ?>" required /></td>
                <td style="text-align:center"><input class="input-block-level" name="color_mascota" type="text" value="<?php echo $color_mascota ?>" required /></td>
            </tr>
            <tr>
                <th style="text-align:center">Peso de la Mascota (Kilos)</th>
                <th style="text-align:center">Talla de la Mascota</th>
            </tr>
            <tr>
                <td style="text-align:center"><input class="input-block-level" name="peso_mascota" type="number" value="<?php echo $peso_mascota ?>" step="any" lang="en" min="1" max="999" oninput="validity.valid||(value='');" required /></td>
                <td style="text-align:center">
                    <select name="talla_mascota" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                        <?php if (isset($nombre_talla)) { echo ""; } else { echo ""; }
                        $consulta2_sql = ("SELECT cod_talla, nombre_talla FROM tbl15_talla WHERE (cod_estado = '1') ORDER BY cod_talla ASC");
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($nombre_talla) and $nombre_talla == $datos2['nombre_talla']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['nombre_talla'];
                        $nombre = $datos2['nombre_talla'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
            </tr>
        </thead>
    </table>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
    <input type="hidden" name="cod_certificado_apoyo_emocional" value="<?php echo $cod_certificado_apoyo_emocional ?>">
    <input type="hidden" name="cod_certificado_apoyo_emocional_codifcryp" value="<?php echo $cod_certificado_apoyo_emocional_codifcryp ?>">
    <input type="hidden" name="pagina" value="<?php echo $pagina_local ?>">
    <input type="hidden" name="ins_edit" value="formulario_insert_edit">
    <hr>
    <div class="actions">
    <input type="submit" value="Guardar Cambios" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
    </div>
    </form>
<?php } ?>
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