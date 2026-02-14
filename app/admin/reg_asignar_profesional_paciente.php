<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<script src="../js/jquery.min.js" type="text/javascript"></script> 
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
$fecha_hoy                           = date("Y/m/d H:i:00");
$pagina_red                          = $_SERVER['PHP_SELF'];
$cod_cliente                         = intval($_GET['cod_cliente']);

$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, cod_entidad, url_img_foto_min AS url_img_foto_min_cli, 
url_img_firma_min AS url_img_firma_min_cli, cod_grupo_area, cod_grupo_area_cargo, 
nombre_religion, nombre_ocupacion, nombre_estado_civil, nombre_escolaridad, nombre_empresa, nombre_empresa_contratante, 
nombre_actividad_ecoemp, cargo_empresa, area_empresa, ciudad_empresa, nombre_estrato, nombre_numero_hijos, 
nombre_tipo_regimen, nombre_fondo_pension, nombre_arl, nombre_contacto1, parentesco_contacto1, tel_contacto1, 
direccion_contacto1, nombre_pais, lugar_residencia
FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$nombre_religion                     = $info_cliente['nombre_religion'];
$nombre_ocupacion                    = $info_cliente['nombre_ocupacion'];
$nombre_estado_civil                 = $info_cliente['nombre_estado_civil'];
$nombre_escolaridad                  = $info_cliente['nombre_escolaridad'];
//$nombre_empresa                    = $info_cliente['nombre_empresa'];
//$nombre_empresa_contratante        = $info_cliente['nombre_empresa_contratante'];
$nombre_actividad_ecoemp             = $info_cliente['nombre_actividad_ecoemp'];
$cargo_empresa                       = $info_cliente['cargo_empresa'];
$area_empresa                        = $info_cliente['area_empresa'];
$ciudad_empresa                      = $info_cliente['ciudad_empresa'];
$nombre_estrato                      = $info_cliente['nombre_estrato'];
$nombre_numero_hijos                 = $info_cliente['nombre_numero_hijos'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$nombre_fondo_pension                = $info_cliente['nombre_fondo_pension'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_contacto1                    = $info_cliente['nombre_contacto1'];
$parentesco_contacto1                = $info_cliente['parentesco_contacto1'];
$tel_contacto1                       = $info_cliente['tel_contacto1'];
$direccion_contacto1                 = $info_cliente['direccion_contacto1'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$url_img_foto_min_cli                = $info_cliente['url_img_foto_min_cli'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$cod_grupo_area                      = $info_cliente['cod_grupo_area'];
$cod_grupo_area_cargo                = $info_cliente['cod_grupo_area_cargo'];
$nombre_pais                         = $info_cliente['nombre_pais'];
$lugar_residencia                    = $info_cliente['lugar_residencia'];
$nom_ape                             = $nombres.' '.$apellido1;
/* --------------------------------------------------------------------------------------------------------------*/
$obtener_cod_hist = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica, motivo, fecha_ymd FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente' AND cod_estado_facturacion = '1'";
$consultar_cod_hist = mysqli_query($conectar, $obtener_cod_hist) or die(mysqli_error($conectar));
$info_cod_hist = mysqli_fetch_assoc($consultar_cod_hist);

$cod_historia_clinica                = $info_cod_hist['cod_historia_clinica'];
$motivo                              = $info_cod_hist['motivo'];
$fecha_ymd                           = $info_cod_hist['fecha_ymd'];

$_SESSION['cod_cliente_sesion']      = $cod_cliente;
$_SESSION['cedula_sesion']           = $cedula;
?>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="reg_asignar_profesional_paciente_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($cod_historia_clinica <> '') { ?>
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th style="text-align:center" bgcolor="#FAC090" align="center" valign="middle"><img src="../imagenes/advertencia.gif"/>LA ULTIMA VEZ QUE ASISTIÓ <?php echo ($fecha_ymd) ?> Y EL MOTIVO FUE <?php echo ($motivo) ?> (HC - <?php echo ($cod_historia_clinica) ?>)<img src="../imagenes/advertencia.gif"/></th>
        </tr>
    </thead>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
            <th style="text-align:center" bgcolor="#FAC090" align="center" valign="middle"><a href="../admin/reg_asignar_profesional_paciente_firma_tactil.php?cod_cliente=<?php echo $cod_cliente ?>&pagina=../admin/lista_crear_cita.php">IR A LA VERSION TACTIL</a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th style="text-align:center" bgcolor="#FAC090" valign="middle"><a href="../admin/edit_cargar_foto_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_foto_min_cli ?>" class="img-polaroid" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
            <th style="text-align:center" bgcolor="#FAC090" valign="middle"><a href="../admin/edit_cargar_firma_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_firma_min_cli ?>" class="img-polaroid" alt="Foto Firma" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
	<thead><tr>
        <th style="text-align:center" bgcolor="#FAC090">APELLIDOS</th>
        <th style="text-align:center" bgcolor="#FAC090">NOMBRES COMPLETOS</th></tr></thead>
    <tbody><tr>
        <td style="text-align:center"><?php echo ($apellido1) ?></td>
        <td style="text-align:center"><?php echo ($nombres) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
        <th style="text-align:center" bgcolor="#FAC090">TIPO DE IDENTIFICACIÓN</th>
        <th style="text-align:center" bgcolor="#FAC090">NUMERO</th>
    </tr></thead>
    <tbody><tr>
        <td style="text-align:center"><?php echo ($nombre_tipo_doc) ?></td>
        <td style="text-align:center"><?php echo ($cedula) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead><tr>
    <th style="text-align:center" bgcolor="#FAC090">FECHA - HORA</th>
    <th style="text-align:center" bgcolor="#FAC090">MOTIVO CONSULTA</th>
    <th style="text-align:center" bgcolor="#FAC090">PROFESIONAL</th>
    <th style="text-align:center" bgcolor="#FAC090">TIPO HC</th>
    </tr></thead>
    <tbody>
    <tr>
<td style="text-align:center"><div id="fecha_ymd_hora" class="input-append date"><input type="text" name="fecha_ymd_hora" value="<?php echo $fecha_hoy ?>" readonly></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_motivo" name="motivo" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php
$sql_consulta = "SELECT * FROM tbl15_motivo_consulta";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) { 
$cod_motivo_consulta = $contenedor['cod_motivo_consulta'];
$motivo = $contenedor['motivo'];
?>
<option value="<?php echo $motivo ?>"><?php echo $motivo ?></option>
<?php } ?>
</select>

<input type="text" id="input_motivo" name="input_motivo" value="" class="form-control">

<span class="add-on">
<div id="boton_motivo_mas"><button type="button" id="func_boton_motivo_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_motivo_reg"><button type="button" id="func_boton_motivo_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_profesional" name="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php $sql_consulta = "SELECT tbl15_administrador.cod_administrador, tbl15_administrador.nombres, tbl15_administrador.apellidos, tbl15_administrador.cod_seguridad, tbl15_administrador.cod_tipo_historia_clinica, 
tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica
FROM tbl15_tipo_historia_clinica INNER JOIN tbl15_administrador ON tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_administrador.cod_tipo_historia_clinica
WHERE (tbl15_administrador.cod_seguridad = 1) ORDER BY nombres ASC";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) { 
$cod_administrador = $contenedor['cod_administrador'];
$nombres = $contenedor['nombres'];
$apellidos = $contenedor['apellidos'];
$nombre_tipo_historia_clinica = $contenedor['nombre_tipo_historia_clinica'];
?>
<option value="<?php echo $cod_administrador ?>"><?php echo $nombres.' '.$apellidos ?></option>
<?php } ?>
</select>

<input type="text" id="input_profesional" name="input_profesional" value="" class="form-control">

<span class="add-on">
<div id="boton_profesional_mas"><button type="button" id="func_boton_profesional_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_profesional_reg"><button type="button" id="func_boton_profesional_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<select name="cod_tipo_historia_clinica" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_tipo_historia_clinica)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_tipo_historia_clinica, nombre_tipo_historia_clinica FROM tbl15_tipo_historia_clinica ORDER BY cod_tipo_historia_clinica ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_tipo_historia_clinica) and $cod_tipo_historia_clinica == $datos2['cod_tipo_historia_clinica']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_tipo_historia_clinica'];
$nombre = $datos2['nombre_tipo_historia_clinica'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
<th style="text-align:center" bgcolor="#FAC090">RELIGIÓN</th>
<th style="text-align:center" bgcolor="#FAC090">OCUPACIÓN</th>
<th style="text-align:center" bgcolor="#FAC090">ESTADO CIVIL</th>
<th style="text-align:center" bgcolor="#FAC090">NIVEL EDUCATIVO</th>
<th style="text-align:center" bgcolor="#FAC090">ESTRATO</th>
<th style="text-align:center" bgcolor="#FAC090">Nº HIJOS</th>
</tr></thead>
<tbody><tr>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_religion" name="nombre_religion" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_religion)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_religion, nombre_religion FROM tbl15_religion ORDER BY nombre_religion ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_religion) and $nombre_religion == $datos2['nombre_religion']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_religion'];
$nombre = $datos2['nombre_religion'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_religion" name="input_nombre_religion" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_religion_mas"><button type="button" id="func_boton_nombre_religion_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_religion_reg"><button type="button" id="func_boton_nombre_religion_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:center"><input class="input-block-level" name="nombre_ocupacion" type="text" value="<?php echo $nombre_ocupacion ?>" /></td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_estado_civil" name="nombre_estado_civil" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_estado_civil)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_estado_civil, nombre_estado_civil FROM tbl15_estado_civil ORDER BY nombre_estado_civil ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_estado_civil) AND $nombre_estado_civil == $datos2['nombre_estado_civil']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_estado_civil'];
$nombre = $datos2['nombre_estado_civil'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_estado_civil" name="input_nombre_estado_civil" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_estado_civil_mas"><button type="button" id="func_boton_nombre_estado_civil_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_estado_civil_reg"><button type="button" id="func_boton_nombre_estado_civil_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_escolaridad" name="nombre_escolaridad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_escolaridad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_escolaridad, nombre_escolaridad FROM tbl15_escolaridad ORDER BY nombre_escolaridad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_escolaridad) AND $nombre_escolaridad == $datos2['nombre_escolaridad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_escolaridad'];
$nombre = $datos2['nombre_escolaridad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_escolaridad" name="input_nombre_escolaridad" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_escolaridad_mas"><button type="button" id="func_boton_nombre_escolaridad_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_escolaridad_reg"><button type="button" id="func_boton_nombre_escolaridad_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center"><input class="input-block-level" name="nombre_estrato" type="text" value="<?php echo $nombre_estrato ?>" /></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_numero_hijos" type="number" value="<?php echo $nombre_numero_hijos ?>" maxlength="2" required /></td>

</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
<th style="text-align:center" bgcolor="#FAC090">EMPRESA CONTRATANTE</th>
<th style="text-align:center" bgcolor="#FAC090">EMPRESA A LABORAR</th>
<th style="text-align:center" bgcolor="#FAC090">ACTIVIDAD ECONOMICA DE LA EMPRESA</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_empresa_contratante" name="nombre_empresa_contratante" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa_contratante)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa_contratante, nombre_empresa_contratante FROM tbl15_empresa_contratante ORDER BY nombre_empresa_contratante ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa_contratante) AND $nombre_empresa_contratante == $datos2['nombre_empresa_contratante']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa_contratante'];
$nombre = $datos2['nombre_empresa_contratante'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_empresa_contratante" name="input_nombre_empresa_contratante" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_empresa_contratante_mas"><button type="button" id="func_boton_nombre_empresa_contratante_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_empresa_contratante_reg"><button type="button" id="func_boton_nombre_empresa_contratante_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_empresa" name="nombre_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) AND $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_empresa" name="input_nombre_empresa" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_empresa_mas"><button type="button" id="func_boton_nombre_empresa_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_empresa_reg"><button type="button" id="func_boton_nombre_empresa_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_actividad_ecoemp" name="nombre_actividad_ecoemp" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_actividad_ecoemp)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_actividad_ecoemp, nombre_actividad_ecoemp FROM tbl15_actividad_ecoemp ORDER BY nombre_actividad_ecoemp ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_actividad_ecoemp) AND $nombre_actividad_ecoemp == $datos2['nombre_actividad_ecoemp']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_actividad_ecoemp'];
$nombre = $datos2['nombre_actividad_ecoemp'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_actividad_ecoemp" name="input_nombre_actividad_ecoemp" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_actividad_ecoemp_mas"><button type="button" id="func_boton_nombre_actividad_ecoemp_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_actividad_ecoemp_reg"><button type="button" id="func_boton_nombre_actividad_ecoemp_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
    <th style="text-align:center" bgcolor="#FAC090">------------ AREA A LABORAR Y CARGO ------------</th>
    <!--<th style="text-align:center" bgcolor="#FAC090">AREA A LABORAR</th>-->
    <th style="text-align:center" bgcolor="#FAC090">CIUDAD</th>
    <th style="text-align:center" bgcolor="#FAC090">LUGAR DE RESIDENCIA ULTIMOS 5 AÑOS</th>
    <th style="text-align:center" bgcolor="#FAC090">NACIONALIDAD</th>
</tr></thead>
<tbody><tr>
<td style="text-align:left">
<select name="cod_grupo_area_cargo" class="chosen-select" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_grupo_area_cargo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, tbl15_grupo_area_cargo.cod_grupo_area_cargo, tbl15_grupo_area_cargo.chek_diligenciar
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area_cargo) AND $cod_grupo_area_cargo == $datos2['cod_grupo_area_cargo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo                = $datos2['cod_grupo_area_cargo'];
$nombre                = $datos2['nombre_grupo_area'].' - '.$datos2['nombre_grupo_area_cargo'];
$chek_diligenciar      = $datos2['chek_diligenciar'];

if ($chek_diligenciar=='S') { ?> <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?> >(SI) - <?php echo $nombre ?></option><?php } 
else { ?> <option value='<?php echo $codigo ?>' <?php echo $seleccionado ?> >(NO) - <?php echo $nombre ?></option> <?php } ?>
<?php } ?>
</select>
<!--AREA A LABORAR<select name="cod_grupo_area" id="tbl15_grupo_area" class="form-control" required><option value="0">Seleccione</option></select>CARGO<select name="cod_grupo_area_cargo" id="tbl15_grupo_area_cargo" class="form-control"><option value="0">Seleccione</option></select>-->
</td>
<!--<td><input class="input-block-level" name="area_empresa" type="text" value="<?php echo $area_empresa ?>" /></td>-->
<td><input class="input-block-level" name="ciudad_empresa" type="text" value="<?php echo $ciudad_empresa ?>" /></td>
<td><input class="input-block-level" name="lugar_residencia" type="text" value="<?php echo $lugar_residencia ?>" /></td>
<td><input class="input-block-level" name="nombre_pais" type="text" value="<?php echo $nombre_pais ?>" /></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr>
<th style="text-align:center" bgcolor="#FAC090">EPS</th>
<th style="text-align:center" bgcolor="#FAC090">TIPO RÉGIMEN</th>
<th style="text-align:center" bgcolor="#FAC090">FONDO DE PENSIONES</th>
<th style="text-align:center" bgcolor="#FAC090">ARL</th>
</tr></thead>
<tbody><tr>

<td style="text-align:center">
<div class="input-append date">
<select id="select_cod_entidad" name="cod_entidad" class="selectpicker" data-show-subtext="true" data-live-search="true" >
<?php if (isset($cod_entidad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_entidad, nombre_entidad FROM tbl15_entidad ORDER BY nombre_entidad ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_entidad) AND $cod_entidad == $datos2['cod_entidad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_entidad'];
$nombre = $datos2['nombre_entidad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_cod_entidad" name="input_cod_entidad" value="" class="form-control">

<span class="add-on">
<div id="boton_cod_entidad_mas"><button type="button" id="func_boton_cod_entidad_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_cod_entidad_reg"><button type="button" id="func_boton_cod_entidad_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_tipo_regimen" name="nombre_tipo_regimen" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_tipo_regimen)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_tipo_regimen, nombre_tipo_regimen FROM tbl15_tipo_regimen ORDER BY nombre_tipo_regimen ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_regimen) AND $nombre_tipo_regimen == $datos2['nombre_tipo_regimen']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_regimen'];
$nombre = $datos2['nombre_tipo_regimen'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_tipo_regimen" name="input_nombre_tipo_regimen" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_tipo_regimen_mas"><button type="button" id="func_boton_nombre_tipo_regimen_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_tipo_regimen_reg"><button type="button" id="func_boton_nombre_tipo_regimen_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_fondo_pension" name="nombre_fondo_pension" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_fondo_pension)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_fondo_pension, nombre_fondo_pension FROM tbl15_fondo_pension ORDER BY nombre_fondo_pension ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_fondo_pension) AND $nombre_fondo_pension == $datos2['nombre_fondo_pension']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_fondo_pension'];
$nombre = $datos2['nombre_fondo_pension'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_fondo_pension" name="input_nombre_fondo_pension" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_fondo_pension_mas"><button type="button" id="func_boton_nombre_fondo_pension_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_fondo_pension_reg"><button type="button" id="func_boton_nombre_fondo_pension_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:center">
<div class="input-append date">
<select id="select_nombre_arl" name="nombre_arl" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_arl)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_arl, nombre_arl FROM tbl15_arl ORDER BY nombre_arl ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_arl) AND $nombre_arl == $datos2['nombre_arl']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_arl'];
$nombre = $datos2['nombre_arl'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>

<input type="text" id="input_nombre_arl" name="input_nombre_arl" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_arl_mas"><button type="button" id="func_boton_nombre_arl_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_arl_reg"><button type="button" id="func_boton_nombre_arl_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<thead><tr><th bgcolor="#FAC090">NOMBRES COMPLETOS RESPONSABLE</th><th bgcolor="#FAC090">PARENTESCO</th><th bgcolor="#FAC090">TELEFONO Y/O CELULAR</th><th bgcolor="#FAC090">DIRRECIÓN</th></tr></thead>
<tbody><tr>
<td><input class="input-block-level" name="nombre_contacto1" type="text" value="<?php echo $nombre_contacto1 ?>" /></td>
<td><input class="input-block-level" name="parentesco_contacto1" type="text" value="<?php echo $parentesco_contacto1 ?>" /></td>
<td><input class="input-block-level" name="tel_contacto1" type="tel" value="<?php echo $tel_contacto1 ?>"/></td>
<td><input class="input-block-level" name="direccion_contacto1" type="text" value="<?php echo $direccion_contacto1 ?>" /></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr><th bgcolor="#FAC090">VISTA PREVIA</th><th bgcolor="#FAC090">IMAGEN TOMADA</th><th bgcolor="#FAC090">IMAGEN FIRMA</th></tr></thead>
    <tbody>
        <tr>
            <td><div align="center" id="vista_previa_camara"></div><form><input type=button value="Tomar Foto" onClick="tomar_foto(<?php echo $cod_cliente ?>, <?php echo $cedula ?>)"></form></td>
            <td><div align="center" id="vista_imagen_tomada"></div></td>
            <td>
                <input type="file" name="url_img_firma" id="url_img_firma" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/>
                <a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"><p><!--No ha selecionado ningun archivo!</p>--></div>
            </td>
        </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script type="text/javascript" src="js/webcam.js"></script>
<!-- A button for taking snaps -->
<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
Webcam.set({ width: 300, height: 230, image_format: 'jpeg', jpeg_quality: 90 });
Webcam.attach( '#vista_previa_camara' );

function tomar_foto(cod_cliente, cedula) {
Webcam.snap( function(data_uri) {
document.getElementById('vista_imagen_tomada').innerHTML = '<h2>Procesando:</h2>';
Webcam.upload( data_uri, '../admin/guardar_img_foto_webcam_ajax.php', function(code, text) { document.getElementById('vista_imagen_tomada').innerHTML = '<input type="hidden" name="url_img_foto" value="'+text+'">' + '<img src="'+text+'"/>';
} ); } ); }
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img_firma = document.getElementById("url_img_firma"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img_firma) {
    url_img_firma.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_motivo_reg').hide(); //oculto mediante id
$('#input_motivo').hide(); //oculto mediante id

$("#func_boton_motivo_mas").click(function(){
    $('#input_motivo').show(); //muestro mediante id
    $('#boton_motivo_reg').show(); //muestro mediante id
    $('#select_motivo').hide(); //oculto mediante id
    $('#boton_motivo_mas').hide(); //oculto mediante id
});

$("#func_boton_motivo_reg").click(function(){
    $('#boton_motivo_mas').show(); //muestro mediante id
    $('#select_motivo').show(); //muestro mediante id
    $('#boton_motivo_reg').hide(); //oculto mediante id
    $('#input_motivo').hide(); //oculto mediante id

var valor = $("#input_motivo").val();
var campo = 'motivo';
var tipo_ajax = 'tbl15_motivo_consulta';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_tipo_doc();
        Cargar_tipo_doc(valor, campo);
    }
});

});

function Cargar_tipo_doc(valor, campo) {
var capa_cargar_datos = 'select_motivo';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_motivo';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_profesional_reg').hide(); //oculto mediante id
$('#input_profesional').hide(); //oculto mediante id

$("#func_boton_profesional_mas").click(function(){
    $('#input_profesional').show(); //muestro mediante id
    $('#boton_profesional_reg').show(); //muestro mediante id
    $('#select_profesional').hide(); //oculto mediante id
    $('#boton_profesional_mas').hide(); //oculto mediante id
});

$("#func_boton_profesional_reg").click(function(){
    $('#boton_profesional_mas').show(); //muestro mediante id
    $('#select_profesional').show(); //muestro mediante id
    $('#boton_profesional_reg').hide(); //oculto mediante id
    $('#input_profesional').hide(); //oculto mediante id

var valor = $("#input_profesional").val();
var campo = 'nombre_profesional';
var tipo_ajax = 'profesional';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_profesional();
        Cargar_profesional(valor, campo);
    }
});

});

function Cargar_profesional(valor, campo) {
var capa_cargar_datos = 'select_profesional';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_profesional() {
var limpiar_datos = 'input_profesional';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_religion_reg').hide(); //oculto mediante id
$('#input_nombre_religion').hide(); //oculto mediante id

$("#func_boton_nombre_religion_mas").click(function(){
    $('#input_nombre_religion').show(); //muestro mediante id
    $('#boton_nombre_religion_reg').show(); //muestro mediante id
    $('#select_nombre_religion').hide(); //oculto mediante id
    $('#boton_nombre_religion_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_religion_reg").click(function(){
    $('#boton_nombre_religion_mas').show(); //muestro mediante id
    $('#select_nombre_religion').show(); //muestro mediante id
    $('#boton_nombre_religion_reg').hide(); //oculto mediante id
    $('#input_nombre_religion').hide(); //oculto mediante id

var valor = $("#input_nombre_religion").val();
var campo = 'nombre_religion';
var tipo_ajax = 'nombre_religion';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_religion();
        Cargar_nombre_religion(valor, campo);
    }
});

});

function Cargar_nombre_religion(valor, campo) {
var capa_cargar_datos = 'select_nombre_religion';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_religion() {
var limpiar_datos = 'input_nombre_religion';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_estado_civil_reg').hide(); //oculto mediante id
$('#input_nombre_estado_civil').hide(); //oculto mediante id

$("#func_boton_nombre_estado_civil_mas").click(function(){
    $('#input_nombre_estado_civil').show(); //muestro mediante id
    $('#boton_nombre_estado_civil_reg').show(); //muestro mediante id
    $('#select_nombre_estado_civil').hide(); //oculto mediante id
    $('#boton_nombre_estado_civil_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_estado_civil_reg").click(function(){
    $('#boton_nombre_estado_civil_mas').show(); //muestro mediante id
    $('#select_nombre_estado_civil').show(); //muestro mediante id
    $('#boton_nombre_estado_civil_reg').hide(); //oculto mediante id
    $('#input_nombre_estado_civil').hide(); //oculto mediante id

var valor = $("#input_nombre_estado_civil").val();
var campo = 'nombre_estado_civil';
var tipo_ajax = 'nombre_estado_civil';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_estado_civil();
        Cargar_nombre_estado_civil(valor, campo);
    }
});

});

function Cargar_nombre_estado_civil(valor, campo) {
var capa_cargar_datos = 'select_nombre_estado_civil';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_estado_civil() {
var limpiar_datos = 'input_nombre_estado_civil';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_escolaridad_reg').hide(); //oculto mediante id
$('#input_nombre_escolaridad').hide(); //oculto mediante id

$("#func_boton_nombre_escolaridad_mas").click(function(){
    $('#input_nombre_escolaridad').show(); //muestro mediante id
    $('#boton_nombre_escolaridad_reg').show(); //muestro mediante id
    $('#select_nombre_escolaridad').hide(); //oculto mediante id
    $('#boton_nombre_escolaridad_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_escolaridad_reg").click(function(){
    $('#boton_nombre_escolaridad_mas').show(); //muestro mediante id
    $('#select_nombre_escolaridad').show(); //muestro mediante id
    $('#boton_nombre_escolaridad_reg').hide(); //oculto mediante id
    $('#input_nombre_escolaridad').hide(); //oculto mediante id

var valor = $("#input_nombre_escolaridad").val();
var campo = 'nombre_escolaridad';
var tipo_ajax = 'nombre_escolaridad';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_escolaridad();
        Cargar_nombre_escolaridad(valor, campo);
    }
});

});

function Cargar_nombre_escolaridad(valor, campo) {
var capa_cargar_datos = 'select_nombre_escolaridad';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_escolaridad() {
var limpiar_datos = 'input_nombre_escolaridad';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_empresa_contratante_reg').hide(); //oculto mediante id
$('#input_nombre_empresa_contratante').hide(); //oculto mediante id

$("#func_boton_nombre_empresa_contratante_mas").click(function(){
    $('#input_nombre_empresa_contratante').show(); //muestro mediante id
    $('#boton_nombre_empresa_contratante_reg').show(); //muestro mediante id
    $('#select_nombre_empresa_contratante').hide(); //oculto mediante id
    $('#boton_nombre_empresa_contratante_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_empresa_contratante_reg").click(function(){
    $('#boton_nombre_empresa_contratante_mas').show(); //muestro mediante id
    $('#select_nombre_empresa_contratante').show(); //muestro mediante id
    $('#boton_nombre_empresa_contratante_reg').hide(); //oculto mediante id
    $('#input_nombre_empresa_contratante').hide(); //oculto mediante id

var valor = $("#input_nombre_empresa_contratante").val();
var campo = 'nombre_empresa_contratante';
var tipo_ajax = 'nombre_empresa_contratante';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_empresa_contratante();
        Cargar_nombre_empresa_contratante(valor, campo);
    }
});

});

function Cargar_nombre_empresa_contratante(valor, campo) {
var capa_cargar_datos = 'select_nombre_empresa_contratante';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_empresa_contratante() {
var limpiar_datos = 'input_nombre_empresa_contratante';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_empresa_reg').hide(); //oculto mediante id
$('#input_nombre_empresa').hide(); //oculto mediante id

$("#func_boton_nombre_empresa_mas").click(function(){
    $('#input_nombre_empresa').show(); //muestro mediante id
    $('#boton_nombre_empresa_reg').show(); //muestro mediante id
    $('#select_nombre_empresa').hide(); //oculto mediante id
    $('#boton_nombre_empresa_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_empresa_reg").click(function(){
    $('#boton_nombre_empresa_mas').show(); //muestro mediante id
    $('#select_nombre_empresa').show(); //muestro mediante id
    $('#boton_nombre_empresa_reg').hide(); //oculto mediante id
    $('#input_nombre_empresa').hide(); //oculto mediante id

var valor = $("#input_nombre_empresa").val();
var campo = 'nombre_empresa';
var tipo_ajax = 'nombre_empresa';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_empresa();
        Cargar_nombre_empresa(valor, campo);
    }
});

});

function Cargar_nombre_empresa(valor, campo) {
var capa_cargar_datos = 'select_nombre_empresa';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_empresa() {
var limpiar_datos = 'input_nombre_empresa';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_actividad_ecoemp_reg').hide(); //oculto mediante id
$('#input_nombre_actividad_ecoemp').hide(); //oculto mediante id

$("#func_boton_nombre_actividad_ecoemp_mas").click(function(){
    $('#input_nombre_actividad_ecoemp').show(); //muestro mediante id
    $('#boton_nombre_actividad_ecoemp_reg').show(); //muestro mediante id
    $('#select_nombre_actividad_ecoemp').hide(); //oculto mediante id
    $('#boton_nombre_actividad_ecoemp_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_actividad_ecoemp_reg").click(function(){
    $('#boton_nombre_actividad_ecoemp_mas').show(); //muestro mediante id
    $('#select_nombre_actividad_ecoemp').show(); //muestro mediante id
    $('#boton_nombre_actividad_ecoemp_reg').hide(); //oculto mediante id
    $('#input_nombre_actividad_ecoemp').hide(); //oculto mediante id

var valor = $("#input_nombre_actividad_ecoemp").val();
var campo = 'nombre_actividad_ecoemp';
var tipo_ajax = 'nombre_actividad_ecoemp';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_actividad_ecoemp();
        Cargar_nombre_actividad_ecoemp(valor, campo);
    }
});

});

function Cargar_nombre_actividad_ecoemp(valor, campo) {
var capa_cargar_datos = 'select_nombre_actividad_ecoemp';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_actividad_ecoemp() {
var limpiar_datos = 'input_nombre_actividad_ecoemp';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_cod_entidad_reg').hide(); //oculto mediante id
$('#input_cod_entidad').hide(); //oculto mediante id

$("#func_boton_cod_entidad_mas").click(function(){
    $('#input_cod_entidad').show(); //muestro mediante id
    $('#boton_cod_entidad_reg').show(); //muestro mediante id
    $('#select_cod_entidad').hide(); //oculto mediante id
    $('#boton_cod_entidad_mas').hide(); //oculto mediante id
});

$("#func_boton_cod_entidad_reg").click(function(){
    $('#boton_cod_entidad_mas').show(); //muestro mediante id
    $('#select_cod_entidad').show(); //muestro mediante id
    $('#boton_cod_entidad_reg').hide(); //oculto mediante id
    $('#input_cod_entidad').hide(); //oculto mediante id

var valor = $("#input_cod_entidad").val();
var campo = 'nombre_entidad';
var tipo_ajax = 'nombre_entidad';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_entidad();
        Cargar_nombre_entidad(valor, campo);
    }
});

});

function Cargar_nombre_entidad(valor, campo) {
var capa_cargar_datos = 'select_cod_entidad';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_entidad() {
var limpiar_datos = 'input_cod_entidad';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_tipo_regimen_reg').hide(); //oculto mediante id
$('#input_nombre_tipo_regimen').hide(); //oculto mediante id

$("#func_boton_nombre_tipo_regimen_mas").click(function(){
    $('#input_nombre_tipo_regimen').show(); //muestro mediante id
    $('#boton_nombre_tipo_regimen_reg').show(); //muestro mediante id
    $('#select_nombre_tipo_regimen').hide(); //oculto mediante id
    $('#boton_nombre_tipo_regimen_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_tipo_regimen_reg").click(function(){
    $('#boton_nombre_tipo_regimen_mas').show(); //muestro mediante id
    $('#select_nombre_tipo_regimen').show(); //muestro mediante id
    $('#boton_nombre_tipo_regimen_reg').hide(); //oculto mediante id
    $('#input_nombre_tipo_regimen').hide(); //oculto mediante id

var valor = $("#input_nombre_tipo_regimen").val();
var campo = 'nombre_tipo_regimen';
var tipo_ajax = 'nombre_tipo_regimen';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_tipo_regimen();
        Cargar_nombre_tipo_regimen(valor, campo);
    }
});

});

function Cargar_nombre_tipo_regimen(valor, campo) {
var capa_cargar_datos = 'select_nombre_tipo_regimen';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_tipo_regimen() {
var limpiar_datos = 'input_nombre_tipo_regimen';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_fondo_pension_reg').hide(); //oculto mediante id
$('#input_nombre_fondo_pension').hide(); //oculto mediante id

$("#func_boton_nombre_fondo_pension_mas").click(function(){
    $('#input_nombre_fondo_pension').show(); //muestro mediante id
    $('#boton_nombre_fondo_pension_reg').show(); //muestro mediante id
    $('#select_nombre_fondo_pension').hide(); //oculto mediante id
    $('#boton_nombre_fondo_pension_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_fondo_pension_reg").click(function(){
    $('#boton_nombre_fondo_pension_mas').show(); //muestro mediante id
    $('#select_nombre_fondo_pension').show(); //muestro mediante id
    $('#boton_nombre_fondo_pension_reg').hide(); //oculto mediante id
    $('#input_nombre_fondo_pension').hide(); //oculto mediante id

var valor = $("#input_nombre_fondo_pension").val();
var campo = 'nombre_fondo_pension';
var tipo_ajax = 'nombre_fondo_pension';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_fondo_pension();
        Cargar_nombre_fondo_pension(valor, campo);
    }
});

});

function Cargar_nombre_fondo_pension(valor, campo) {
var capa_cargar_datos = 'select_nombre_fondo_pension';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_fondo_pension() {
var limpiar_datos = 'input_nombre_fondo_pension';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_arl_reg').hide(); //oculto mediante id
$('#input_nombre_arl').hide(); //oculto mediante id

$("#func_boton_nombre_arl_mas").click(function(){
    $('#input_nombre_arl').show(); //muestro mediante id
    $('#boton_nombre_arl_reg').show(); //muestro mediante id
    $('#select_nombre_arl').hide(); //oculto mediante id
    $('#boton_nombre_arl_mas').hide(); //oculto mediante id
});

$("#func_boton_nombre_arl_reg").click(function(){
    $('#boton_nombre_arl_mas').show(); //muestro mediante id
    $('#select_nombre_arl').show(); //muestro mediante id
    $('#boton_nombre_arl_reg').hide(); //oculto mediante id
    $('#input_nombre_arl').hide(); //oculto mediante id

var valor = $("#input_nombre_arl").val();
var campo = 'nombre_arl';
var tipo_ajax = 'nombre_arl';

$.ajax({
    type: "POST",
    dataType: 'html',
    url: "../admin/guardar_consulta_select_ajax.php",
    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
    success: function(resp){
        $('#respuesta_ajax').html(resp);
        Limpiar_nombre_arl();
        Cargar_nombre_arl(valor, campo);
    }
});

});

function Cargar_nombre_arl(valor, campo) {
var capa_cargar_datos = 'select_nombre_arl';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_nombre_arl() {
var limpiar_datos = 'input_nombre_arl';
$("#"+limpiar_datos).val("");
}

});
</script>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>

<script src="js/funcion_select_dependiente_area_cargo_ajax.js"></script>
<!-- 1****************************************************************************************************** -->
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>