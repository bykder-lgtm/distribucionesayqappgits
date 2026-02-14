<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
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
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Correos Smtp</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_correo_smtp             = intval($_GET['cod_correo_smtp']);

$mostrar_datos_sql = "SELECT * FROM tbl15_correo_smtp WHERE cod_correo_smtp = '$cod_correo_smtp'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_correo_smtp                      = $matriz_consulta['nombre_correo_smtp'];
$nombre_alterno_correo_smtp              = $matriz_consulta['nombre_alterno_correo_smtp'];
$contrasena_correo_smtp                  = $matriz_consulta['contrasena_correo_smtp'];
$contrasena_encrip_correo_smtp           = $matriz_consulta['contrasena_encrip_correo_smtp'];
$contrasena_app_correo_smtp              = $matriz_consulta['contrasena_app_correo_smtp'];
$host_correo_smtp                        = $matriz_consulta['host_correo_smtp'];
$auth_correo_smtp                        = $matriz_consulta['auth_correo_smtp'];
$secure_correo_smtp                      = $matriz_consulta['secure_correo_smtp'];
$port_correo_smtp                        = $matriz_consulta['port_correo_smtp'];
$cod_estado_correo_predeterminado        = $matriz_consulta['cod_estado_correo_predeterminado'];
$cod_estado                              = $matriz_consulta['cod_estado'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_correo_smtp_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
            <th style="text-align:center">Cod</th>
            <th style="text-align:center">Nombre Correo Smtp</th>
        <!--
            <th style="text-align:center">Contraseña Correo Smtp</th>
            <th style="text-align:center">Contraseña Encript Correo Smtp</th>
        -->
            <th style="text-align:center">Contraseña App Correo Smtp</th>
            <th style="text-align:center">Host Smtp</th>
            <th style="text-align:center">Auth Smtp</th>
            <th style="text-align:center">Secure Smtp</th>
            <th style="text-align:center">Puerto Smtp</th>
            <th style="text-align:center">Predeter</th>
            <th style="text-align:center">Estado</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
            <td style="text-align:center"><?php echo ($cod_correo_smtp) ?></td>
            <td style="text-align:center"><input class="input-block-level" name="nombre_correo_smtp" type="text" value="<?php echo $nombre_correo_smtp ?>" placeholder="" style="width: 300px;" required/></td>
        <!--
            <td style="text-align:center"><input class="input-block-level" name="contrasena_correo_smtp" type="text" value="<?php echo $contrasena_correo_smtp ?>" placeholder="" /></td>
            <td style="text-align:center"><input class="input-block-level" name="contrasena_encrip_correo_smtp" type="text" value="<?php echo $contrasena_encrip_correo_smtp ?>" placeholder="" /></td>
        -->
            <td style="text-align:center"><input class="input-block-level" name="contrasena_app_correo_smtp" type="text" value="<?php echo $contrasena_app_correo_smtp ?>" placeholder="" /></td>
            <td style="text-align:center"><input class="input-block-level" name="host_correo_smtp" type="text" value="<?php echo $host_correo_smtp ?>" placeholder="" /></td>
            <td style="text-align:center"><input class="input-block-level" name="auth_correo_smtp" type="text" value="<?php echo $auth_correo_smtp ?>" placeholder="" style="width: 50px;" /></td>
            <td style="text-align:center"><input class="input-block-level" name="secure_correo_smtp" type="text" value="<?php echo $secure_correo_smtp ?>" placeholder="" style="width: 50px;" /></td>
            <td style="text-align:center"><input class="input-block-level" name="port_correo_smtp" type="number" value="<?php echo $port_correo_smtp ?>" placeholder="" style="width: 70px;" /></td>

            <td style="text-align:center">        
                <select name="cod_estado_correo_predeterminado" id="cod_estado_correo_predeterminado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;">
                    <?php if (isset($cod_estado_correo_predeterminado)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT cod_si_no, nombre_si_no2 FROM tbl15_si_no ORDER BY nombre_si_no2 ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado_correo_predeterminado) AND $cod_estado_correo_predeterminado == $datos2['cod_si_no']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_si_no'];
                    $nombre = $datos2['nombre_si_no2'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>

            <td style="text-align:center">        
                <select name="cod_estado" id="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;">
                    <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
                    $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_estado) AND $cod_estado == $datos2['cod_estado']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_estado'];
                    $nombre = $datos2['nombre_estado'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_correo_smtp" value="<?php echo $cod_correo_smtp ?>"/>
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