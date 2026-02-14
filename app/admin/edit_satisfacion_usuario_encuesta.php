<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery-3.1.1.min.js"></script> 

<script language="javascript" src="../admin/class_php/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_medicamento_formulado_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body id="pageBody" onLoad="myajax = new isiAJAX();">

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
<a href="#"><h4>Encuesta de satisfación al usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_tbl15_satisfacion_usuario_encuesta   = intval($_GET['cod_satisfacion_usuario_encuesta']);
$cod_historia_clinica                = intval($_GET['cod_historia_clinica']);
$cod_cliente                         = intval($_GET['cod_cliente']);
$pagina                              = addslashes($_GET['pagina']);
$pagina_local                        = $_SERVER['PHP_SELF'];
$fecha_hoy_time                      = strtotime(date("Y/m/d"));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_tbl15_satisfacion_usuario_encuesta= "SELECT * FROM tbl15_tbl15_satisfacion_usuario_encuestaWHERE cod_tbl15_satisfacion_usuario_encuesta= '".($cod_satisfacion_usuario_encuesta)."'";
$consultar_tbl15_satisfacion_usuario_encuesta= mysqli_query($conectar, $obtener_satisfacion_usuario_encuesta) or die(mysqli_error($conectar));
$info_satisfacion_usuario_encuesta= mysqli_fetch_assoc($consultar_satisfacion_usuario_encuesta);

$cod_cliente                          = $info_satisfacion_usuario_encuesta['cod_cliente'];
$cod_administrador                    = $info_satisfacion_usuario_encuesta['cod_administrador'];

$cod_sede                             = $info_satisfacion_usuario_encuesta['cod_sede'];
$calif_serv_global                    = $info_satisfacion_usuario_encuesta['calif_serv_global'];
$examedic_experiencia_servicio        = $info_satisfacion_usuario_encuesta['examedic_experiencia_servicio'];
$audiomet_experiencia_servicio        = $info_satisfacion_usuario_encuesta['audiomet_experiencia_servicio'];
$optomet_experiencia_servicio         = $info_satisfacion_usuario_encuesta['optomet_experiencia_servicio'];
$visiomet_experiencia_servicio        = $info_satisfacion_usuario_encuesta['visiomet_experiencia_servicio'];
$espiro_experiencia_servicio          = $info_satisfacion_usuario_encuesta['espiro_experiencia_servicio'];
$osteomusc_experiencia_servicio       = $info_satisfacion_usuario_encuesta['osteomusc_experiencia_servicio'];
$vacunacion_experiencia_servicio      = $info_satisfacion_usuario_encuesta['vacunacion_experiencia_servicio'];
$labclinic_experiencia_servicio       = $info_satisfacion_usuario_encuesta['labclinic_experiencia_servicio'];
$recep_experiencia_servicio           = $info_satisfacion_usuario_encuesta['recep_experiencia_servicio'];
$otros_experiencia_servicio           = $info_satisfacion_usuario_encuesta['otros_experiencia_servicio'];
$comentario_suger                     = $info_satisfacion_usuario_encuesta['comentario_suger'];
$nombre_recomend_ips                  = $info_satisfacion_usuario_encuesta['nombre_recomend_ips'];
$tel_contacto1                        = $info_satisfacion_usuario_encuesta['tel_contacto1'];
$correo_contacto1                     = $info_satisfacion_usuario_encuesta['correo_contacto1'];

$fecha_mes                            = $info_satisfacion_usuario_encuesta['fecha_mes'];
$fecha_anyo                           = $info_satisfacion_usuario_encuesta['fecha_anyo'];
$fecha_ymd                            = $info_satisfacion_usuario_encuesta['fecha_ymd'];
$fecha_dmy                            = $info_satisfacion_usuario_encuesta['fecha_dmy'];
$fecha_hora                           = $info_satisfacion_usuario_encuesta['fecha_hora'];

$fecha_time                           = $info_satisfacion_usuario_encuesta['fecha_time'];
$fecha_reg_time                       = $info_satisfacion_usuario_encuesta['fecha_reg_time'];
$cuenta                               = $info_satisfacion_usuario_encuesta['cuenta'];
$cuenta_reg                           = $info_satisfacion_usuario_encuesta['cuenta_reg'];
$nombre_empresa                       = $info_satisfacion_usuario_encuesta['nombre_empresa'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_firma_min AS url_img_firma_min_cli, direccion, lugar_residencia,
tel_cliente, cod_entidad, fecha_nac_ymd, nombre_arl, nombre_tipo_regimen FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$nombre_sexo                         = $info_cliente['nombre_sexo'];
$direccion                           = $info_cliente['direccion'];
$lugar_residencia                    = $info_cliente['lugar_residencia'];
$tel_cliente                         = $info_cliente['tel_cliente'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$fecha_nac_ymd                       = $info_cliente['fecha_nac_ymd'];
$fecha_nac_time                      = strtotime($fecha_nac_ymd);
$diferencia_edad                     = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
$nom_ape                             = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '".($cod_entidad)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($fecha_ymd == '') { $fecha_ymd = date("Y-m-d"); } 
else { $fecha_ymd = $fecha_ymd; } ?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_satisfacion_usuario_encuesta_reg.php">

<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<fieldset>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:center">AGRADECEMOS SU OPINION, VITAL PARA NUESTRO MEJORAMIENTO CONTINUO.</td>
  </tr>
</table>

<br>

<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="6">FECHA - HORA</td>
  </tr>
  <tr>
      <td style="text-align:center"><input type="date" name="fecha_ymd" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" value="<?php echo $fecha_ymd ?>" required>
       - <input type="time" name="fecha_hora" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" value="<?php echo $fecha_hora ?>" required>
    </td>
  </tr>
</table>

<br>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">1. ¿Cómo calificaria su expreriencia global respecto a los servicios que ha recibido?</td>
    <td style="text-align:left">
<select name="calif_serv_global" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($calif_serv_global)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($calif_serv_global) AND $calif_serv_global == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
  </td>
  </tr>
</table>

<br>

<table style="text-align:center" border="2" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">2. Por favor califique los servicios realizados</td>
  </tr>
</table>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left"><strong>SERVICIO</strong></td>
    <td style="text-align:left"><strong>CALIFICACIÓN</strong></td>
  </tr>
  <tr>
    <td style="text-align:left">EXAMEN MÉDICO</td>
    <td style="text-align:left">
<select name="examedic_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($examedic_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($examedic_experiencia_servicio) AND $examedic_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">AUDIOMETRÍA</td>
    <td style="text-align:left">
<select name="audiomet_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($audiomet_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($audiomet_experiencia_servicio) AND $audiomet_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">OPTOMETRÍA</td>
    <td style="text-align:left">
<select name="optomet_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($optomet_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($optomet_experiencia_servicio) AND $optomet_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">VISIOMETRÍA</td>
    <td style="text-align:left">
<select name="visiomet_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($visiomet_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($visiomet_experiencia_servicio) AND $visiomet_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">ESPEROMETRÍA</td>
    <td style="text-align:left">
<select name="espiro_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($espiro_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($espiro_experiencia_servicio) AND $espiro_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">OSTEMUSCULAR</td>
    <td style="text-align:left">
<select name="osteomusc_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($osteomusc_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($osteomusc_experiencia_servicio) AND $osteomusc_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">VACUNACIÓN</td>
    <td style="text-align:left">
<select name="vacunacion_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($vacunacion_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($vacunacion_experiencia_servicio) AND $vacunacion_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">LABORATORIO CLÍNICO</td>
    <td style="text-align:left">
<select name="labclinic_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($labclinic_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($labclinic_experiencia_servicio) AND $labclinic_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">RECEPCIÓN</td>
    <td style="text-align:left">
<select name="recep_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($recep_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($recep_experiencia_servicio) AND $recep_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">OTROS</td>
    <td style="text-align:left">
<select name="otros_experiencia_servicio" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($otros_experiencia_servicio)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_experiencia_servicio, nombre_experiencia_servicio FROM tbl15_experiencia_servicio ORDER BY cod_experiencia_servicio ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($otros_experiencia_servicio) AND $otros_experiencia_servicio == $datos2['nombre_experiencia_servicio']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_experiencia_servicio'];
$nombre = $datos2['nombre_experiencia_servicio'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
</table>

</fieldset>

<br>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">3. ¿Tiene alguna sugerencia y/o comentario?</td>
  </tr>
  <tr>
    <td style="text-align:left"><textarea rows="4" name="comentario_suger" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" class="input-block-level"><?php echo ($comentario_suger) ?></textarea></td>
  </tr>
</table>

<br>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">4. ¿Recomendaria a sus familiares y amigos este consultorio?</td>
    <td style="text-align:left">
<select name="nombre_recomend_ips" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
<?php if (isset($nombre_recomend_ips)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_recomendacion_fam_amigos, nombre_recomendacion_fam_amigos FROM tbl15_recomendacion_fam_amigos ORDER BY cod_recomendacion_fam_amigos ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_recomend_ips) AND $nombre_recomend_ips == $datos2['nombre_recomendacion_fam_amigos']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_recomendacion_fam_amigos'];
$nombre = $datos2['nombre_recomendacion_fam_amigos'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
  </td>
  </tr>
</table>

<br>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left"><strong>Apreciado usuario: </strong>en caso de requerir respuesta a su comentario y/o sugerencia por favor diligencie los siguientes datos</td>
  </tr>
</table>

<table style="text-align:center" border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td style="text-align:left">Nombre del paciente: <?php echo $nom_ape ?></td>
  </tr>
  <tr>
    <td style="text-align:left">Cedula: <?php echo $cedula ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono de contacto: <input type="number" name="tel_contacto1" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" value="<?php echo $tel_contacto1 ?>" required></td>
  </tr>
  <tr>
    <td style="text-align:left">Email: <input type="text" name="correo_contacto1" class="input-block-level" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" value="<?php echo $correo_contacto1 ?>" required></td>
  </tr>
  <tr>
    <td style="text-align:left">Empresa remitente: 
<select name="nombre_empresa" id="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>" required>
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
    </td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<input type="hidden" name="cod_satisfacion_usuario_encuesta" value="<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>">
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<!--<input type="hidden" name="pagina" value="<?php echo $pagina ?>">-->
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>

</form>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_satisfacion_usuario_encuesta_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>},  
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
    url:"guardar_edit_satisfacion_usuario_encuesta_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>},  
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
    url:"guardar_edit_satisfacion_usuario_encuesta_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_tbl15_satisfacion_usuario_encuesta?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>