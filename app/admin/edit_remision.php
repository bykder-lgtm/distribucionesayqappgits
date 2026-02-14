<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
$pagina                                  = addslashes($_GET['pagina']); 
$fecha_hoy                               = date("d/m/Y");
$fecha_hoy_time                          = strtotime(date("Y/m/d"));
$cod_remision                            = intval($_GET['cod_remision']);
$cod_cliente                             = intval($_GET['cod_cliente']);

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$sql_remision = "SELECT motivo, cod_historia_clinica, 
cod_grupo_area, cod_grupo_area_cargo, costo_motivo_consulta, cod_factura, nombre_ocupacion, 
nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante,
exa_fis_talla, exa_fis_peso, exa_fis_imc, exa_fis_interpreimc, 
exa_fis_fresp, exa_fis_ta, exa_fis_fc, exa_fis_lateral, exa_fis_periabdom, exa_fis_temperat, exa_fis_ojoder_sncorre_vlejan, 
exa_fis_ojoder_sncorre_vcerca, exa_fis_ojoder_cncorre_vlejan, exa_fis_ojoder_cncorre_vcerca, 
exa_fis_ojoizq_sncorre_vlejan, exa_fis_ojoizq_sncorre_vcerca, exa_fis_ojoizq_cncorre_vlejan, exa_fis_ojoizq_cncorre_vcerca, 
exa_fis_ojoamb_sncorre_vlejan, exa_fis_ojoamb_sncorre_vcerca, exa_fis_oojoamb_cncorre_vlejan, exa_fis_ojoamb_cncorre_vcerca, 
estructura_remision, nombre_tipo_remision, fecha_time FROM tbl15_remision WHERE cod_remision = '$cod_remision'";
$consulta_remision = mysqli_query($conectar, $sql_remision) or die(mysqli_error($conectar));
$datos_remision = mysqli_fetch_assoc($consulta_remision);

$motivo                                  = $datos_remision['motivo'];
$cod_historia_clinica                    = $datos_remision['cod_historia_clinica'];
$exa_fis_talla                           = $datos_remision['exa_fis_talla'];
$exa_fis_peso                            = $datos_remision['exa_fis_peso'];
$exa_fis_imc                             = $datos_remision['exa_fis_imc'];
$exa_fis_interpreimc                     = $datos_remision['exa_fis_interpreimc'];
$exa_fis_fresp                           = $datos_remision['exa_fis_fresp'];
$exa_fis_ta                              = $datos_remision['exa_fis_ta'];
$exa_fis_fc                              = $datos_remision['exa_fis_fc'];
$exa_fis_lateral                         = $datos_remision['exa_fis_lateral'];
$exa_fis_periabdom                       = $datos_remision['exa_fis_periabdom'];
$exa_fis_temperat                        = $datos_remision['exa_fis_temperat'];
$exa_fis_ojoder_sncorre_vlejan           = $datos_remision['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca           = $datos_remision['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan           = $datos_remision['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca           = $datos_remision['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan           = $datos_remision['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca           = $datos_remision['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan           = $datos_remision['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca           = $datos_remision['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan           = $datos_remision['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca           = $datos_remision['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan          = $datos_remision['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca           = $datos_remision['exa_fis_ojoamb_cncorre_vcerca'];
$estructura_remision                     = $datos_remision['estructura_remision'];
$nombre_tipo_remision                    = $datos_remision['nombre_tipo_remision'];

$cod_grupo_area                          = $datos_remision['cod_grupo_area'];
$cod_grupo_area_cargo                    = $datos_remision['cod_grupo_area_cargo'];
$costo_motivo_consulta                   = $datos_remision['costo_motivo_consulta'];
$cod_factura                             = $datos_remision['cod_factura'];
$nombre_ocupacion                        = $datos_remision['nombre_ocupacion'];
$nombre_empresa                          = $datos_remision['nombre_empresa'];
$cargo_empresa                           = $datos_remision['cargo_empresa'];
$area_empresa                            = $datos_remision['area_empresa'];
$ciudad_empresa                          = $datos_remision['ciudad_empresa'];
$nombre_empresa_contratante              = $datos_remision['nombre_empresa_contratante'];

$fecha_time                              = $datos_remision['fecha_time'];
$fecha_ymd_hora                          = date("Y/m/d H:i:s", $fecha_time);
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Remisión</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cedula                    = $datos_cliente['cedula'];
$nombre_tipo_doc           = $datos_cliente['nombre_tipo_doc'];

$fecha_nac_ymd             = $datos_cliente['fecha_nac_ymd'];
$fecha_nac_timedb          = $datos_cliente['fecha_nac_time'];
$fecha_nac_time            = strtotime($fecha_nac_ymd);
$diferencia_edad           = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                 = floor($diferencia_edad / (365*60*60*24));
$direccion                 = $datos_cliente['direccion'];
$cod_entidad               = $datos_cliente['cod_entidad'];
$nombre_sexo               = $datos_cliente['nombre_sexo'];
$nombre_contacto1          = $datos_cliente['nombre_contacto1'];
$parentesco_contacto1      = $datos_cliente['parentesco_contacto1'];
$tel_contacto1             = $datos_cliente['tel_contacto1'];
$nombres                   = $datos_cliente['nombres'];
$apellido1                 = $datos_cliente['apellido1'];
$apellido2                 = $datos_cliente['apellido2'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad            = $info_entidad['nombre_entidad'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_remision_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr>
<th style="text-align:center" valign="middle">MOTIVO DE LA CONSULTA: 
<select name="motivo" id="" required>
<?php if (isset($motivo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($motivo) and $motivo == $datos2['motivo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['motivo'];
$nombre = $datos2['motivo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</th>

<th style="text-align:center" valign="middle">CRM - <?php echo $cod_remision ?></th>
</tr></thead></table>
<table border="1" class="table table-responsive">
	<thead><tr>
	<th style="text-align:center">PRIMER APELLIDO</th>
	<th style="text-align:center">SEGUNDO APELLIDO</th>
	<th style="text-align:center">NOMBRES COMPLETOS </th>
</tr></thead>
    <tbody><tr>
	<td style="text-align:center"><?php echo ($apellido1) ?></td>
	<td style="text-align:center"><?php echo ($apellido2) ?></td>
	<td style="text-align:center"><?php echo ($nombres) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr>
    	<th style="text-align:center">TIPO DE IDENTIFICACIÓN</th>
    	<th style="text-align:center">NUMERO</th>
    </tr></thead>
    <tbody><tr>
    	<td style="text-align:center"><?php echo ($nombre_tipo_doc) ?></td>
    	<td style="text-align:center"><?php echo ($cedula) ?></td>
    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead><tr>
    	<th style="text-align:center">FECHA DE NACIMIENTO</th>
    	<th style="text-align:center">EDAD</th>
    	<th style="text-align:center">SEXO</th>
    	<th style="text-align:center">CARNET DE SALUD</th>
    	<th style="text-align:center">DOMICILIO</th>
    	<th style="text-align:center">TIPO DE REMISIÓN</th>
    </tr></thead>
    <tbody><tr>
    	<td style="text-align:center"><?php echo ($fecha_nac_ymd) ?></td>
    	<td style="text-align:center"><?php echo ($edad_anyo) ?> Años</td>
    	<td style="text-align:center"><?php echo ($nombre_sexo) ?></td>
    	<td style="text-align:center"><?php echo ($nombre_entidad) ?></td>
    	<td style="text-align:center"><?php echo ($direccion) ?></td>

<td style="text-align:center"><select name="nombre_tipo_remision" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_tipo_remision)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_tipo_remision, nombre_tipo_remision FROM tbl15_tipo_remision ORDER BY nombre_tipo_remision ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_remision) and $nombre_tipo_remision == $datos2['nombre_tipo_remision']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_remision'];
$nombre = $datos2['nombre_tipo_remision'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select></td>

    </tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive"><thead><tr><th style="text-align:center" valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>

<table border="1" class="table table-responsive">
<thead><tr>
    <th style="text-align:center">Empresa</th>
    <th style="text-align:center">Area y Cargo a Laborar</th>
    <th style="text-align:center">Ciudad</th>
</tr></thead>
<tbody><tr>
<td style="text-align:center">
<select name="nombre_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<td style="text-align:center">
<select name="cod_grupo_area_cargo" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_grupo_area_cargo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, tbl15_grupo_area_cargo.cod_grupo_area_cargo
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area_cargo) and $cod_grupo_area_cargo == $datos2['cod_grupo_area_cargo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_grupo_area_cargo'];
$nombre = $datos2['nombre_grupo_area_cargo'];
$nombre2 = $datos2['nombre_grupo_area'];
echo "<option value='".$codigo."' $seleccionado >".$nombre2.' | '.$nombre."</option>"; } ?></select>
</td>

<td style="text-align:center"><input class="input-block-level" name="ciudad_empresa" type="text" id="<?php echo $cod_remision ?>" value="<?php echo $ciudad_empresa ?>"/></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
<thead><td><textarea rows="11" name="estructura_remision" class="input-block-level"><?php echo ($estructura_remision) ?></textarea></td></thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">6. EXAMEN FÍSICO</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
<tbody>
<tr>
<td style="text-align:center"><strong>&nbsp;Talla: (Mts)<input style="text-align:center" name="exa_fis_talla" class="exa_fis_talla" id="exa_fis_talla" type="text" value="<?php echo $exa_fis_talla ?>" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>PESO: (Kg)<input style="text-align:center" name="exa_fis_peso" class="exa_fis_peso" id="exa_fis_peso" type="text" value="<?php echo $exa_fis_peso ?>" onChange="calc_imc();" required/></strong></td>
<td style="text-align:center"><strong>IMC:<input style="text-align:center" name="exa_fis_imc" class="exa_fis_imc" id="exa_fis_imc" type="text" value="<?php echo $exa_fis_imc ?>"/></strong></td>
<td style="text-align:center"><strong>INTERPRETACIÓN IMC:<input style="text-align:center" name="exa_fis_interpreimc" class="exa_fis_interpreimc" id="exa_fis_interpreimc" type="text" value="<?php echo $exa_fis_interpreimc ?>"/></strong></td>
<td style="text-align:center"><strong>F. Resp: (/Min)<input style="text-align:center" name="exa_fis_fresp" class="exa_fis_fresp" id="exa_fis_fresp" type="text" value="<?php echo $exa_fis_fresp ?>"/></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong>TA: (Mm/Hg)<input style="text-align:center" name="exa_fis_ta" class="exa_fis_ta" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ta ?>"/></strong></td>
<td style="text-align:center"><strong>FC: (/Min)<input style="text-align:center" name="exa_fis_fc" class="exa_fis_fc" id="exa_fis_fc" type="text" value="<?php echo $exa_fis_fc ?>"/></strong></td>
<td style="text-align:center"><strong>
Lateralidad&nbsp;&nbsp;&nbsp;&nbsp;
D<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_remision ?>" value="D" <?php echo ($exa_fis_lateral=='D')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
I<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_remision ?>" value="I" <?php echo ($exa_fis_lateral=='I')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;
AM<input type="radio" name="exa_fis_lateral" id="<?php echo $cod_remision ?>" value="AM" <?php echo ($exa_fis_lateral=='AM')?'checked':'' ?> >
</strong></td>
<td style="text-align:center"><strong>Perímetro Abdominal: (Cm)<input style="text-align:center" name="exa_fis_periabdom" class="exa_fis_periabdom" id="exa_fis_periabdom" type="number" value="<?php echo $exa_fis_periabdom ?>"/>
<td style="text-align:center"><strong>
Temperatura:&nbsp;&nbsp;&nbsp;&nbsp;
<input style="text-align:center" name="exa_fis_temperat" class="exa_fis_temperat" id="exa_fis_temperat" type="text" value="<?php echo $exa_fis_temperat ?>"/></strong></td>
</tr>
</tbody>
</table>

<script>
function calc_imc(){
var exa_fis_talla = document.getElementById("exa_fis_talla").value;
var exa_fis_peso = document.getElementById("exa_fis_peso").value;
var exa_fis_imc = (exa_fis_peso / Math.pow(exa_fis_talla, 2)).toFixed(2);
var exa_fis_interpreimc = "";
var img_imc = "";

if ((exa_fis_imc  < 18.50)) { exa_fis_interpreimc = "BAJO PESO"; img_imc = '<img src="../imagenes/imc/peso1.png">'; }
if ((exa_fis_imc  >= 18.50) && (exa_fis_imc  <= 24.99)) { exa_fis_interpreimc = "PESO NORMAL"; img_imc = '<img src="../imagenes/imc/peso2.png">'; }
if ((exa_fis_imc  >= 25.0) && (exa_fis_imc  <= 29.99)) { exa_fis_interpreimc = "SOBREPESO"; img_imc = '<img src="../imagenes/imc/peso3.png">'; }
if ((exa_fis_imc  >= 30.0) && (exa_fis_imc  <= 34.99)) { exa_fis_interpreimc = "OBESIDAD I"; img_imc = '<img src="../imagenes/imc/peso4.png">'; }
if ((exa_fis_imc  >= 35.0) && (exa_fis_imc  <= 39.99)) { exa_fis_interpreimc = "OBESIDAD II"; img_imc = '<img src="../imagenes/imc/peso5.png">'; }
if ((exa_fis_imc  >= 40.0) && (exa_fis_imc  <= 49.99)) { exa_fis_interpreimc = "OBESIDAD III"; img_imc = '<img src="../imagenes/imc/peso6.png">'; }
if ((exa_fis_imc  >= 50.0)) { exa_fis_interpreimc = "OBESIDAD EXTREMA"; img_imc = '<img src="../imagenes/imc/peso7.png">'; }

document.getElementById("exa_fis_imc").value = exa_fis_imc;
document.getElementById("exa_fis_interpreimc").value = exa_fis_interpreimc;
document.getElementsByName("img_imc").innerHTML=img_imc;
}
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
        <tr><td colspan="5"></td></tr>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>AGUDEZA VISUAL</strong></td>
            <td style="text-align:center" colspan="2"><strong>SIN CORRECCIÓN</strong></td>
            <td style="text-align:center" colspan="2"><strong>CON CORRECCIÓN</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
        </tr>
        <tr>
            <td><strong>OJO DERECHO</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vlejan" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vlejan" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vlejan" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vlejan" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vlejan" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_oojoamb_cncorre_vlejan"id="<?php echo $cod_remision ?>"  type="text" value="<?php echo $exa_fis_oojoamb_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_cncorre_vcerca" id="<?php echo $cod_remision ?>" type="text" value="<?php echo $exa_fis_ojoamb_cncorre_vcerca ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_remision" value="<?php echo $cod_remision ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="fecha_dmy" value="<?php echo $fecha_hoy ?>"/>
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>
<!--
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>
-->
<!-- <script src="../js/jquery-1.12.4.js"></script>-->
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
estructura_remision = CKEDITOR.replace("estructura_remision");
CKFinder.setupCKEditor(estructura_remision, 'ckeditor/ckfinder');
}
</script>

</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_remision_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_remision ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_remision_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_remision ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_remision_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_remision ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>