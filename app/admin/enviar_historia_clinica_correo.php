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
<?php $pagina  = $_SERVER['PHP_SELF']; ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Enviar Historia Clinica a Correo Electrónico</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_historia_clinica                   = intval($_GET['cod_historia_clinica']);

$sql_historia_clinica = "SELECT cod_empresa, nombre_contacto1, correo_contacto1 FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$cod_empresa                            = $datos_historia_clinica['cod_empresa'];
$nombre_contacto1                       = $datos_historia_clinica['nombre_contacto1'];
$correo_contacto1                       = $datos_historia_clinica['correo_contacto1'];

$sql_cliente = "SELECT * FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_empresa                         = $datos_cliente['nombre_empresa'];
$correo_empresa                         = $datos_cliente['correo_empresa'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/enviar_historia_clinica_correo_reg.php">
<fieldset>
 	 	 	 	 	 	
<p><a>Nombres Y Apellidos:</a></p>
<td><input class="input-block-level" name="nombres_apellidos" type="text" value="<?php echo $nombre_empresa ?>" required autofocus/></td>

<p><a>Correo:</a></p>
<td><input class="input-block-level" name="correo" type="text" value="<?php echo $correo_empresa ?>"/></td>

<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
<hr>
<div class="actions">
<input type="submit" value="Enviar Correo" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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