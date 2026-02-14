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
<div class="breadcrumbs"><a href="#"><h1>Historias Clinicas</h1></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cliente = intval($_GET['cod_cliente']);

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula = $datos_cliente['cedula'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$fecha_nac_ymd = $datos_cliente['fecha_nac_ymd'];
$lugar_nac = $datos_cliente['lugar_nac'];
$lugar_procedencia = $datos_cliente['lugar_procedencia'];
$lugar_residencia = $datos_cliente['lugar_residencia'];
$nombre_grupo_rh = $datos_cliente['nombre_grupo_rh'];
$nombre_raza = $datos_cliente['nombre_raza'];
$nombre_religion = $datos_cliente['nombre_religion'];
$nombre_ocupacion = $datos_cliente['nombre_ocupacion'];
$nombre_estado_civil = $datos_cliente['nombre_estado_civil'];
$nombre_escolaridad = $datos_cliente['nombre_escolaridad'];
$correo = $datos_cliente['correo'];
$direccion = $datos_cliente['direccion'];
$tel_cliente = $datos_cliente['tel_cliente'];
$nombre_contacto1 = $datos_cliente['nombre_contacto1'];
$tel_contacto1 = $datos_cliente['tel_contacto1'];
$nombre_contacto2 = $datos_cliente['nombre_contacto2'];
$tel_contacto2 = $datos_cliente['tel_contacto2'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/crear_historial_clinico_reg.php">
<p><a>CC:</a>
<td><input type="text" name="cedula" value="" class="input-block-level" /></td>

<p><a>Nombres:</a>
<td><input type="text" name="nombres" value="" class="input-block-level" /></td>

<p><a>Apellidos:</a>
<td><input type="text" name="apellido1" value="" class="input-block-level" /></td>

<p><a>Fecha:</a></p>
<td><input class="form-control" id="fecha_dmy" name="fecha_dmy" placeholder="dd/mm/aaaa" type="text" value=""/></td>

<p><a>Motivo De Consulta:</a></p>
<td><input type="text" name="motivo" id="name" value="" class="input-block-level" /></td>

<p><a>Enfermedad Actual:</a></p>
<td><textarea rows="11" name="enfermedad_actual" class="input-block-level"></textarea></td>

<p><a>Examen Físico:</a></p>
<td><textarea rows="11" name="examen_fisico" class="input-block-level"></textarea></td>

<p><a>Antecedente:</a></p>
<td><textarea rows="11" name="antecedente" class="input-block-level"></textarea></td>

<p><a>Análisis:</a></p>
<td><textarea rows="11" name="analisis" class="input-block-level"></textarea></td>

<p><a>Plan:</a></p>
<td><textarea rows="11" name="plan" class="input-block-level"></textarea></td>
<hr>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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