<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
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
$fecha_hoy = date("Y/m/d H:i:00");
$pagina_red = $_SERVER['PHP_SELF'];
$cod_cliente = intval($_GET['cod_cliente']);

$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, cod_entidad, url_img_foto_min AS url_img_foto_min_cli, 
url_img_firma_min AS url_img_firma_min_cli,
nombre_religion, nombre_ocupacion, nombre_estado_civil, nombre_escolaridad, nombre_empresa, nombre_empresa_contratante, 
nombre_actividad_ecoemp, cargo_empresa, area_empresa, ciudad_empresa, nombre_estrato, nombre_numero_hijos, 
nombre_tipo_regimen, nombre_fondo_pension, nombre_arl, nombre_contacto1, parentesco_contacto1, tel_contacto1, direccion_contacto1
FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$nombre_tipo_doc = $info_cliente['nombre_tipo_doc'];
$nombre_religion = $info_cliente['nombre_religion'];
$nombre_ocupacion = $info_cliente['nombre_ocupacion'];
$nombre_estado_civil = $info_cliente['nombre_estado_civil'];
$nombre_escolaridad = $info_cliente['nombre_escolaridad'];
$nombre_empresa = $info_cliente['nombre_empresa'];
$nombre_empresa_contratante = $info_cliente['nombre_empresa_contratante'];
$nombre_actividad_ecoemp = $info_cliente['nombre_actividad_ecoemp'];
$cargo_empresa = $info_cliente['cargo_empresa'];
$area_empresa = $info_cliente['area_empresa'];
$ciudad_empresa = $info_cliente['ciudad_empresa'];
$nombre_estrato = $info_cliente['nombre_estrato'];
$nombre_numero_hijos = $info_cliente['nombre_numero_hijos'];
$nombre_tipo_regimen = $info_cliente['nombre_tipo_regimen'];
$nombre_fondo_pension = $info_cliente['nombre_fondo_pension'];
$nombre_arl = $info_cliente['nombre_arl'];
$nombre_contacto1 = $info_cliente['nombre_contacto1'];
$parentesco_contacto1 = $info_cliente['parentesco_contacto1'];
$tel_contacto1 = $info_cliente['tel_contacto1'];
$direccion_contacto1 = $info_cliente['direccion_contacto1'];
$cod_entidad = $info_cliente['cod_entidad'];
$url_img_foto_min_cli = $info_cliente['url_img_foto_min_cli'];
$url_img_firma_min_cli = $info_cliente['url_img_firma_min_cli'];

$nom_ape = $nombres.' '.$apellido1;
/* --------------------------------------------------------------------------------------------------------------*/
$obtener_cod_hist = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica, motivo, fecha_ymd FROM tbl15_historia_clinica WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cod_hist = mysqli_query($conectar, $obtener_cod_hist) or die(mysqli_error($conectar));
$info_cod_hist = mysqli_fetch_assoc($consultar_cod_hist);

$cod_historia_clinica = $info_cod_hist['cod_historia_clinica'];
$motivo = $info_cod_hist['motivo'];
$fecha_ymd = $info_cod_hist['fecha_ymd'];
?>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="reg_asignar_profesional_paciente_secretaria_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($cod_historia_clinica <> '') { ?>
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th align="center" valign="middle"><img src="../imagenes/advertencia.gif"/>Ultima vez que asistió <?php echo ($fecha_ymd) ?> y el motivo fue <?php echo ($motivo) ?><img src="../imagenes/advertencia.gif"/></th>
        </tr>
    </thead>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th valign="middle"><a href="../admin/edit_cargar_foto_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_foto_min_cli ?>" class="img-polaroid" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
            <th valign="middle"><a href="../admin/edit_cargar_firma_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_firma_min_cli ?>" class="img-polaroid" alt="Foto Firma" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
	<thead><tr><th> APELLIDOS</th><th>NOMBRES COMPLETOS</th></tr></thead>
    <tbody><tr><td><?php echo ($apellido1) ?></td><td><?php echo ($nombres) ?></td></tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr><th>TIPO DE IDENTIFICACIÓN</th><th>NUMERO</th></tr></thead>
    <tbody><tr><td><?php echo ($nombre_tipo_doc) ?></td><td><?php echo ($cedula) ?></td></tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr><th>FECHA - HORA</th><th>MOTIVO CONSULTA</th><th>PROFESIONAL</th></tr></thead>
    <tbody>
    <tr>
<td><div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_hoy ?>" readonly></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>

<td>
<select name="motivo" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php
$sql_consulta = "SELECT * FROM tbl15_motivo_consulta";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) { 
$cod_motivo_consulta = $contenedor['cod_motivo_consulta'];
$motivo = $contenedor['motivo'];
?>
<option value="<?php echo $motivo ?>"><?php echo $motivo ?></option>
<?php } ?> </select>
</td>

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
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr><th>EPS</th><th>RELIGIÓN</th><th>OCUPACIÓN</th><th>ESTADO CIVIL</th><th>NIVEL EDUCATIVO</th></tr></thead>
<tbody><tr>

<td><select name="cod_entidad" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_entidad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_entidad, nombre_entidad FROM tbl15_entidad ORDER BY nombre_entidad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_entidad) and $cod_entidad == $datos2['cod_entidad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_entidad'];
$nombre = $datos2['nombre_entidad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td><input class="input-block-level" name="nombre_religion" type="text" value="<?php echo $nombre_religion ?>" required/></td>
<td><input class="input-block-level" name="nombre_ocupacion" type="text" value="<?php echo $nombre_ocupacion ?>" /></td>
<td><input class="input-block-level" name="nombre_estado_civil" type="text" value="<?php echo $nombre_estado_civil ?>" required/></td>
<td><input class="input-block-level" name="nombre_escolaridad" type="text" value="<?php echo $nombre_escolaridad ?>" required/></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr><th>EMPRESA CONTRATANTE</th><th>EMPRESA A LABORAR</th><th>ACTIVIDAD ECONOMICA DE LA EMPRESA</th><th>CARGO</th><th>AREA A LABORAR</th><th>CIUDAD</th></tr></thead>
<tbody><tr>
<td><input class="input-block-level" name="nombre_empresa_contratante" type="text" value="<?php echo $nombre_empresa_contratante  ?>" required/></td>
<td><input class="input-block-level" name="nombre_empresa" type="text" value="<?php echo $nombre_empresa ?>" required/></td>
<td><input class="input-block-level" name="nombre_actividad_ecoemp" type="text" value="<?php echo $nombre_actividad_ecoemp ?>" /></td>
<td><input class="input-block-level" name="cargo_empresa" type="text" value="<?php echo $cargo_empresa ?>" /></td>
<td><input class="input-block-level" name="area_empresa" type="text" value="<?php echo $area_empresa ?>" /></td>
<td><input class="input-block-level" name="ciudad_empresa" type="text" value="<?php echo $ciudad_empresa ?>" /></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr><th>ESTRATO</th><th>NUMERO DE HIJOS</th><th>TIPO RÉGIMEN</th><th>FONDO DE PENSIONES</th><th>ARL</th></tr></thead>
<tbody><tr>
<td><input class="input-block-level" name="nombre_estrato" type="text" value="<?php echo $nombre_estrato ?>" /></td>
<td><input class="input-block-level" name="nombre_numero_hijos" type="number" value="<?php echo $nombre_numero_hijos ?>" maxlength="2" required /></td>
<td><input class="input-block-level" name="nombre_tipo_regimen" type="text" value="<?php echo $nombre_tipo_regimen ?>" required/></td>
<td><input class="input-block-level" name="nombre_fondo_pension" type="text" value="<?php echo $nombre_fondo_pension ?>" required/></td>
<td><input class="input-block-level" name="nombre_arl" type="text" value="<?php echo $nombre_arl ?>" required/></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr><th>NOMBRES COMPLETOS RESPONSABLE</th><th>PARENTESCO</th><th>TELEFONO Y/O CELULAR</th><th>DIRECIÓN</th></tr></thead>
<tbody><tr>
<td><input class="input-block-level" name="nombre_contacto1" type="text" value="<?php echo $nombre_contacto1 ?>" /></td>
<td><input class="input-block-level" name="parentesco_contacto1" type="text" value="<?php echo $parentesco_contacto1 ?>" /></td>
<td><input class="input-block-level" name="tel_contacto1" type="tel" value="<?php echo $tel_contacto1 ?>"/></td>
<td><input class="input-block-level" name="direccion_contacto1" type="text" value="<?php echo $direccion_contacto1 ?>" /></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina_red ?>">
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
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
</body>
</html>