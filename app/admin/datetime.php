<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
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
<a href="../admin/lista_paciente_buscar.php"><h4>Asignar Médico al Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy = date("d/m/Y");

$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc FROM tbl15_cliente WHERE cod_cliente = '25'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$nombre_tipo_doc = $info_cliente['nombre_tipo_doc'];

$nom_ape = $nombres.' '.$apellido1.' '.$apellido2;
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
	<tr>
		<th>PRIMER APELLIDO</th>
		<th>SEGUNDO APELLIDO </th>
        <th>NOMBRES COMPLETOS </th>
	</tr>
</thead>
    <tbody>
    <tr>
        <td><?php echo ($apellido1) ?></td>
        <td><?php echo ($apellido2) ?></td>
        <td><?php echo ($nombres) ?></td>
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
    <tr>
        <th>TIPO DE IDENTIFICACIÓN</th>
        <th>NUMERO</th>
    </tr>
</thead>
    <tbody>
    <tr>
        <td><?php echo ($nombre_tipo_doc) ?></td>
        <td><?php echo ($cedula) ?></td>
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
    <tr>
        <th>FECHA</th>
        <th>MÉDICO</th>
    </tr>
</thead>
    <tbody>
    <tr>



<td><div id="datetimepicker" class="input-append date"><input type="text" readonly></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>



<td>
<select name="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php
$sql_consulta = "SELECT tbl15_administrador.cod_administrador, tbl15_administrador.nombres, tbl15_administrador.apellidos, tbl15_administrador.cod_tipo_historia_clinica, 
tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica
FROM tbl15_tipo_historia_clinica INNER JOIN tbl15_administrador ON tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_administrador.cod_tipo_historia_clinica
GROUP BY tbl15_administrador.nombres, tbl15_administrador.apellidos, tbl15_administrador.cod_tipo_historia_clinica, tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica
HAVING (((tbl15_administrador.cod_tipo_historia_clinica)<>0)) ORDER BY nombres ASC";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) { 
$cod_administrador = $contenedor['cod_administrador'];
$nombres = $contenedor['nombres'];
$apellidos = $contenedor['apellidos'];
$nombre_tipo_historia_clinica = $contenedor['nombre_tipo_historia_clinica'];
?>
<option value="<?php echo $cod_administrador ?>"><?php echo $nombres.' '.$apellidos.' - '.$nombre_tipo_historia_clinica ?></option>
<?php } ?> </select>
</td>
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<p><a>Motivo De Consulta:</a></p>
<td><textarea rows="11" name="motivo" class="input-block-level"><p><strong>Motivo De Consulta</strong>:</p></textarea></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
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
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#datetimepicker').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>

</body>
</html>