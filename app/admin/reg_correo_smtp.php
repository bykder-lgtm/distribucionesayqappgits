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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Registrar Correo Smtp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_correo_smtp.php">Lista de Correos Smtp</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; ?>

<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_correo_smtp_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
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
			<td style="text-align:center"><input class="input-block-level" name="nombre_correo_smtp" type="text" value="" placeholder="" style="width: 300px;" required/></td>
		<!--
			<td style="text-align:center"><input class="input-block-level" name="contrasena_correo_smtp" type="text" value="" placeholder="" /></td>
			<td style="text-align:center"><input class="input-block-level" name="contrasena_encrip_correo_smtp" type="text" value="" placeholder="" /></td>
		-->
			<td style="text-align:center"><input class="input-block-level" name="contrasena_app_correo_smtp" type="text" value="" placeholder="" /></td>
			<td style="text-align:center"><input class="input-block-level" name="host_correo_smtp" type="text" value="" placeholder="" /></td>
			<td style="text-align:center"><input class="input-block-level" name="auth_correo_smtp" type="text" value="" placeholder="" style="width: 50px;" /></td>
			<td style="text-align:center"><input class="input-block-level" name="secure_correo_smtp" type="text" value="" placeholder="" style="width: 50px;" /></td>
			<td style="text-align:center"><input class="input-block-level" name="port_correo_smtp" type="number" value="" placeholder="" style="width: 70px;" /></td>

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
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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