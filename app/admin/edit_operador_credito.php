<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery-1.12.3.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Operadores de Credito</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local = $_SERVER['PHP_SELF'];

if (isset($_GET['cod_operador_credito'])) {

    $cod_operador_credito             = intval($_GET['cod_operador_credito']);

    $mostrar_datos_sql = "SELECT * FROM tbl15_operador_credito WHERE cod_operador_credito = '$cod_operador_credito'";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
    $matriz_consulta = mysqli_fetch_assoc($consulta);

    $nombre_operador_credito                           = $matriz_consulta['nombre_operador_credito'];
    $nombre1_tercero                                   = $matriz_consulta['nombre1_tercero'];
    $identificacion_tercero                            = $matriz_consulta['identificacion_tercero'];
    $digito_tercero                                    = $matriz_consulta['digito_tercero'];
    $direccion_tercero                                 = $matriz_consulta['direccion_tercero'];
    $telefono1_tercero                                 = $matriz_consulta['telefono1_tercero'];
    $correo_tercero                                    = $matriz_consulta['correo_tercero'];
    $cod_pais                                          = $matriz_consulta['cod_pais'];
    $cod_departamento                                  = $matriz_consulta['cod_departamento'];
    $cod_municipio                                     = $matriz_consulta['cod_municipio'];
    $nombre_tipo_cliente                               = $matriz_consulta['nombre_tipo_cliente'];
    $nombre_tipo_regimen                               = $matriz_consulta['nombre_tipo_regimen'];
    $nombre_tipo_impuesto                              = $matriz_consulta['nombre_tipo_impuesto'];
?>
    <form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_operador_credito_reg.php">
    <fieldset>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <table border="1" class="table table-responsive">
        <tbody>
            <tr>
                <th style="text-align:center">NOMBRE</th>
                <th style="text-align:center">DOCUMENTO</th>
                <th style="text-align:center">DIGITO</th>
            </tr>
            <tr>
                <td><input class="input-block-level" name="nombre1_tercero" type="text" value="<?php echo $nombre1_tercero ?>"/></td>
                <td><input class="input-block-level" name="identificacion_tercero" type="number" value="<?php echo $identificacion_tercero ?>"/></td>
                <td><input class="input-block-level" name="digito_tercero" type="number" value="<?php echo $digito_tercero ?>"/></td>
            </tr>
            <tr>
                <th style="text-align:center">DIRECCION</th>
                <th style="text-align:center">TELEFONO</th>
                <th style="text-align:center">CORREO</th>
            </tr>
            <tr>
                <td><input class="input-block-level" name="direccion_tercero" type="text" value="<?php echo $direccion_tercero ?>"/></td>
                <td><input class="input-block-level" name="telefono1_tercero" type="text" value="<?php echo $telefono1_tercero ?>"/></td>
                <td><input class="input-block-level" name="correo_tercero" type="text" value="<?php echo $correo_tercero ?>"/></td>
            </tr>
            <tr>
                <th style="text-align:center">PAIS</th>
                <th style="text-align:center">DEPARTAMENTO</th>
                <th style="text-align:center">CIUDAD</th>
            </tr>
            <tr>
                <td>
                    <select id="cod_pais" name="cod_pais" class="input-block-level"  style="font-size:15px">
                        <?php if (isset($cod_pais)) { echo ""; } else { echo  ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_pais WHERE (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($nombre_pais_defec_global) and $nombre_pais_defec_global == $datos2['nombre_pais']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['cod_pais'];
                        $nombre           = $datos2['nombre_pais'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>

                <td>
                    <select name="cod_departamento" id="cod_departamento" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                        <?php if (isset($cod_departamento)) { echo ""; } else { echo  ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_departamento WHERE (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_departamento) and $cod_departamento == $datos2['cod_departamento']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['cod_departamento'];
                        $nombre           = $datos2['nombre_departamento'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>

                <td id="cod_municipio_select">
                    <select name="cod_municipio" id="cod_municipio" class="chosen" data-show-subtext="true" data-live-search="true" required>
                        <?php if (isset($cod_municipio)) { echo "<option value='0' selected >Selecione</option>"; } else { echo "<option value='0' selected >Selecione</option>"; }
                        $consulta2_sql = "SELECT * FROM tbl15_municipio WHERE (cod_departamento = '$nombre_departamento_defec_global') AND (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_municipio) and $cod_municipio == $datos2['cod_municipio']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['cod_municipio'];
                        $nombre           = $datos2['nombre_municipio'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th style="text-align:center">TIPO PERSONA</th>
                <th style="text-align:center">TIPO REGIMEN</th>
                <th style="text-align:center">TIPO IMPUESTO</th>
            </tr>
            <tr>
                <td>
                    <select id="select_nombre_tipo_cliente" name="nombre_tipo_cliente" class="input-block-level"  style="font-size:15px">
                        <?php if (isset($nombre_tipo_cliente)) { echo ""; } else { echo ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_tipo_cliente WHERE (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($nombre_tipo_cliente) and $nombre_tipo_cliente == $datos2['nombre_tipo_cliente']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['nombre_tipo_cliente'];
                        $nombre           = $datos2['nombre_tipo_cliente'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
                <td>
                    <select id="select_nombre_tipo_regimen" name="nombre_tipo_regimen" class="input-block-level"  style="font-size:15px">
                        <?php if (isset($nombre_tipo_regimen)) { echo ""; } else { echo ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_tipo_regimen WHERE (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($nombre_tipo_regimen) and $nombre_tipo_regimen == $datos2['nombre_tipo_regimen']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['nombre_tipo_regimen'];
                        $nombre           = $datos2['nombre_tipo_regimen'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
                <td>
                    <select id="select_nombre_tipo_impuesto" name="nombre_tipo_impuesto" class="input-block-level"  style="font-size:15px">
                        <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo  ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto WHERE (cod_estado = '1')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($nombre_tipo_impuesto) and $nombre_tipo_impuesto == $datos2['nombre_tipo_impuesto']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo           = $datos2['nombre_tipo_impuesto'];
                        $nombre           = $datos2['nombre_tipo_impuesto'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <hr>
    <input type="hidden" name="cod_operador_credito" value="<?php echo $cod_operador_credito ?>"/>
    <input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
    <input type="hidden" name="ins_edit" value="formulario_insert_edit">

    <div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
    </fieldset>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script src="js/jquery-ui.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#cod_departamento").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_departamento";
        var tipo_ajax = "tbl15_tercero";
        var id = "0";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_municipio_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                $("#cod_municipio_select").html(respuesta);
            }
        });

   });
});
</script>