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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Enviar Medicamentos y Ayudas Diagnosticas a Correo Electrónico</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_historia_clinica = intval($_GET['cod_historia_clinica']);

$sql_historia_clinica = "SELECT * FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$cod_cliente = $datos_historia_clinica['cod_cliente'];

$sql_cliente = "SELECT cedula, nombres, apellido1, apellido2, correo FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula = $datos_cliente['cedula'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];
$correo = $datos_cliente['correo'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/enviar_medicamentos_ayudas_diagnosticas_correo_reg.php">
<fieldset>
 	 	 	 	 	 	
<p><a>Nombres Y Apellidos:</a></p>
<td><input class="input-block-level" name="nombres_apellidos" type="text" value="<?php echo $nombres.' '.$apellido1.' '.$apellido2 ?>" required autofocus/></td>

<p><a>Correo:</a></p>
<td><input class="input-block-level" name="correo" type="text" value="<?php echo $correo ?>"/></td>

<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cedula" value="<?php echo $cedula ?>">
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