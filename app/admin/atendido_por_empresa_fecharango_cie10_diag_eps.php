<?php $serguridad_pagina = 1; ?> 
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<link href="../estilo_css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../estilo_css/prism.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
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
<a class="btn btn-primary" href="#"><h6>Lista de Paciente Atendidos Por Empresa, Diágnosticos, Eps Y Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>

<script language="javascript" src="../admin/js/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'cajhabiltada';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'cajdeshabiltada';
if (last != valor)
myajax.Link('guardar_cod_factura_precio_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body onLoad="myajax = new isiAJAX();">

<?php
if (isset($_GET['nombre_empresa']) <> '') { $nombre_empresa = addslashes($_GET['nombre_empresa']); } else { $nombre_empresa = ''; }
if (isset($_GET['fecha_ini']) <> '') { $fecha_ini = addslashes($_GET['fecha_ini']); } else { $fecha_ini = ''; }
if (isset($_GET['fecha_fin']) <> '') { $fecha_fin = addslashes($_GET['fecha_fin']); } else { $fecha_fin = ''; }
if (isset($_GET['cod_entidad']) <> '') { $cod_entidad = intval($_GET['cod_entidad']); } else { $cod_entidad = ''; }

$pagina                = $_SERVER['PHP_SELF'];
$fecha                 = date("Y/m/d");
$contador              = 0;
$contadors             = 0;
$url                   = $_SERVER['PHP_SELF'];
?>

<form action="" id="searchform_extra_super_mas_alto_ancho" method="GET">

<table cellspacing="0" cellpadding="0">
  <tr>
    <td><a>EMPRESA:</a></td>
    <td>
<select name="nombre_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($nombre_empresa) and $nombre_empresa == $contenedor['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['nombre_empresa'];
$nombre = $contenedor['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
  </tr>

  <tr>
    <td><a>EPS:</a></td>
    <td>
<select name="cod_entidad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_entidad)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT cod_entidad, nombre_entidad FROM tbl15_entidad ORDER BY nombre_entidad ASC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($cod_entidad) and $cod_entidad == $contenedor['cod_entidad']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['cod_entidad'];
$nombre = $contenedor['nombre_entidad'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
  </tr>

  <tr>
    <td><a>DIÁGNOSTICO:</a></td>
    <td>
<select name="cie10_diag[]" data-placeholder="Diágnostico" class="chosen-select" multiple tabindex="4" required>
<option value="0"></option>
<?php
$seleccionado = '';
$datos_encontrados = array();

$consulta2_sql = "SELECT cie10_diag FROM tbl15_cie10diag GROUP BY cie10_diag ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) { $cie10_diags = $datos2['cie10_diag']; ?>

<?php if (isset($_GET['cie10_diag'])) {
foreach ($_GET['cie10_diag'] as $key => $cie10_diags_vector) { 
if ($cie10_diags_vector == $cie10_diags) { $seleccionado = 'selected'; } else { $seleccionado = ''; } ?>
<option value="<?php echo $cie10_diags ?>" <?php echo $seleccionado ?> ><?php echo $cie10_diags ?></option>
<?php } 
} else { ?> <option value="<?php echo $cie10_diags ?>" <?php echo $seleccionado ?> ><?php echo $cie10_diags ?></option> <?php } ?>

<?php } ?>
</select>
    </td>
  </tr>

  <tr>
    <td><a>FECHA INI:</a></td>
    <td>
<select name="fecha_ini" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($fecha_ini)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_historia_clinica GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($fecha_ini) and $fecha_ini == $contenedor['fecha_ymd']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['fecha_ymd'];
$nombre = $contenedor['fecha_ymd'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td><a>FECHA FIN:</a></td>
    <td>
<select name="fecha_fin" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($fecha_fin)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_historia_clinica GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($fecha_fin) and $fecha_fin == $contenedor['fecha_ymd']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['fecha_ymd'];
$nombre = $contenedor['fecha_ymd'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2"><button type="submit">Ver</button></td>
  </tr>
</table>

</form>
<br>

<input type="hidden" id="url" name="url" value="<?php echo $url; ?>">

<?php
if (isset($_GET['nombre_empresa'])) {

foreach ($_GET['cie10_diag'] as $indice => $valor_cie10_diag) { $contador++; } unset($valor_cie10_diag);

if (isset($_GET['cie10_diag'][0])) { $cie10_diag = $_GET['cie10_diag'][0]; }
if (isset($_GET['cie10_diag'][1])) { $cie10_diag2 = $_GET['cie10_diag'][1]; }
if (isset($_GET['cie10_diag'][2])) { $cie10_diag3 = $_GET['cie10_diag'][2]; }
if (isset($_GET['cie10_diag'][3])) { $cie10_diag4 = $_GET['cie10_diag'][3]; }
if (isset($_GET['cie10_diag'][4])) { $cie10_diag5 = $_GET['cie10_diag'][4]; }
if (isset($_GET['cie10_diag'][5])) { $cie10_diag6 = $_GET['cie10_diag'][5]; }
if (isset($_GET['cie10_diag'][6])) { $cie10_diag7 = $_GET['cie10_diag'][6]; }
if (isset($_GET['cie10_diag'][7])) { $cie10_diag8 = $_GET['cie10_diag'][7]; }
if (isset($_GET['cie10_diag'][8])) { $cie10_diag9 = $_GET['cie10_diag'][8]; }
if (isset($_GET['cie10_diag'][9])) { $cie10_diag10 = $_GET['cie10_diag'][9]; }
if (isset($_GET['cie10_diag'][10])) { $cie10_diag11 = $_GET['cie10_diag'][10]; }
if (isset($_GET['cie10_diag'][11])) { $cie10_diag12 = $_GET['cie10_diag'][11]; }
if (isset($_GET['cie10_diag'][12])) { $cie10_diag13 = $_GET['cie10_diag'][12]; }
if (isset($_GET['cie10_diag'][13])) { $cie10_diag14 = $_GET['cie10_diag'][13]; }
if (isset($_GET['cie10_diag'][14])) { $cie10_diag15 = $_GET['cie10_diag'][14]; }
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($contador==1) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND (tbl15_cie10diag.cie10_diag='$cie10_diag') AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==2) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2')) AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==3) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==4) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==5) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==6) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==7) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==8) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==9) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') OR (tbl15_cie10diag.cie10_diag='$cie10_diag9')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==10) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==11) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==12) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==13) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==14) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($contador==15) {

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14') OR (tbl15_cie10diag.cie10_diag='$cie10_diag15')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" id="titulo_centrado_extra_largo_ancho_busqueda" method="GET">
<td align="center">
<?php 
if ($contador==1) { ?>     EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==2) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==3) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==4) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==5) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==6) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==7) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==8) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==9) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==10) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==11) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10.' | '.$cie10_diag11 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==12) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10.' | '.$cie10_diag11.' | '.$cie10_diag12 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==13) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10.' | '.$cie10_diag11.' | '.$cie10_diag12.' | '.$cie10_diag13 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==14) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10.' | '.$cie10_diag11.' | '.$cie10_diag12.' | '.$cie10_diag13.' | '.$cie10_diag14 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td><?php }
elseif ($contador==15) { ?> EMPRESA: <?php echo $nombre_empresa ?><br>DIÁGNOSTICO: <?php echo $cie10_diag.' | '.$cie10_diag2.' | '.$cie10_diag3.' | '.$cie10_diag4.' | '.$cie10_diag5.' | '.$cie10_diag6.' | '.$cie10_diag7.' | '.$cie10_diag8.' | '.$cie10_diag9.' | '.$cie10_diag10.' | '.$cie10_diag11.' | '.$cie10_diag12.' | '.$cie10_diag13.' | '.$cie10_diag14.' | '.$cie10_diag15 ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?>
</td>

<?php } ?>
</form> 
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<?php if ($contador==1) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=1&cie10_diag=<?php echo $cie10_diag ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=1&cie10_diag=<?php echo $cie10_diag ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==2) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=2&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=2&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==3) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=3&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=3&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==4) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=4&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=4&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==5) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=5&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=5&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==6) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=6&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=6&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==7) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=7&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=7&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==8) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==9) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==10) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==11) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==12) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==13) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==14) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cie10_diag14<?php echo $cie10_diag14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cie10_diag14<?php echo $cie10_diag14 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } elseif ($contador==15) { ?>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cie10_diag14<?php echo $cie10_diag14 ?>&cie10_diag15<?php echo $cie10_diag15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_cie10_diag_eps_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&total_cie10_diag=8&cie10_diag=<?php echo $cie10_diag ?>&cie10_diag2=<?php echo $cie10_diag2 ?>&cie10_diag3=<?php echo $cie10_diag3 ?>&cie10_diag4=<?php echo $cie10_diag4 ?>&cie10_diag5=<?php echo $cie10_diag5 ?>&cie10_diag6=<?php echo $cie10_diag6 ?>&cie10_diag7=<?php echo $cie10_diag7 ?>&cie10_diag8=<?php echo $cie10_diag8 ?>&cie10_diag9=<?php echo $cie10_diag9 ?>&cie10_diag10=<?php echo $cie10_diag10 ?>&cie10_diag11=<?php echo $cie10_diag11 ?>&cie10_diag12=<?php echo $cie10_diag12 ?>&cie10_diag13=<?php echo $cie10_diag13 ?>&cie10_diag14<?php echo $cie10_diag14 ?>&cie10_diag15<?php echo $cie10_diag15 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
<?php } ?>
</tr>
</table>
</div>
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Hc</th>
<th>Cedula</th>
<th>Nombres</th>
<th>Sexo</th>
<th>Motivo</th>
<th>Empresa</th>
<th>Diágnostico</th>
<th>Eps</th>
<th>Fecha</th>
<th>Edit</th>
<th>#</th>
</tr>
</thead>
<tbody>
<?php
$conteo                        = 0;
while ($info_cie10_diag_conteo = mysqli_fetch_assoc($resultado_cie10_diag_conteo)) {

$cod_historia_clinica          = $info_cie10_diag_conteo['cod_historia_clinica'];
$cod_cliente                   = $info_cie10_diag_conteo['cod_cliente'];
$cedula                        = $info_cie10_diag_conteo['cedula'];
$nombres                       = $info_cie10_diag_conteo['nombres'];
$apellido1                     = $info_cie10_diag_conteo['apellido1'];
$motivo                        = $info_cie10_diag_conteo['motivo'];
$nombre_sexo                   = $info_cie10_diag_conteo['nombre_sexo'];
$nombre_empresa                = $info_cie10_diag_conteo['nombre_empresa'];
$nombre_entidad                = $info_cie10_diag_conteo['nombre_entidad'];
$cie10_diag                    = $info_cie10_diag_conteo['cie10_diag'];
$fecha_time                    = $info_cie10_diag_conteo['fecha_time'];
$fecha_dmy                     = date("Y/m/d", $fecha_time);
$hora                          = date("H:i", $fecha_time);
$conteo++;
?>
<tr>
<td><?php echo $cod_historia_clinica?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $nombre_sexo?></td>
<td><strong><?php echo $motivo?></strong></td>
<td><?php echo $nombre_empresa?></td>
<td><?php echo $cie10_diag?></td>
<td><?php echo $nombre_entidad?></td>
<td><?php echo $fecha_dmy?></td>
<td align="center"><a href="../admin/edit_historia_clinica_mejorada.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<td><?php echo $conteo?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
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
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>

<script>  
$(document).ready(function(){ 

$("#total_muestra").change(function(){ 
var url_parameter = $("#url_modif").attr("href");
var url = $("#url").val();
var total_muestra = $(this).val();
var reem_total_muestra = '';
var frag_url = url_parameter.split('&');
var total_muestra_text = frag_url[3]; 
reem_total_muestra = url_parameter.replace(total_muestra_text,'total_muestra='+total_muestra);

$("#url_modif").attr("href", reem_total_muestra);
});

});
</script>

</body>
</html>