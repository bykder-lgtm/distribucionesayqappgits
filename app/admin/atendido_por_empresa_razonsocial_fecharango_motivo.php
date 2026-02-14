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
<div class="breadcrumbs"><a href="#"><h4>Lista de Paciente Atendidos Por Razon Social Empresa, Motivo Y Rango de Fechas</h4></a></div>
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
$url                   = $_SERVER['PHP_SELF'];

if (isset($_GET['razonsocial_empresa'])) {
$razonsocial_empresa  = addslashes($_GET['razonsocial_empresa']);
$fecha_ini            = addslashes($_GET['fecha_ini']);
$fecha_fin            = addslashes($_GET['fecha_fin']);
if (isset($_GET['total_muestra']) <> '') { $total_muestra = intval($_GET['total_muestra']); } else { $total_muestra = '0'; }
$pagina               = $_SERVER['PHP_SELF'];
$fecha                = date("Y/m/d");
$contador             = 0;
}
?>

<form action="" id="searchform_extra_super_mas_alto_ancho" method="GET">

<table cellspacing="0" cellpadding="0">
  <tr>
    <td><a>EMPRESA:</a></td>
    <td>
<select name="razonsocial_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($razonsocial_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT cod_empresa, razonsocial_empresa FROM tbl15_empresa GROUP BY razonsocial_empresa ASC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($razonsocial_empresa) and $razonsocial_empresa == $contenedor['razonsocial_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['razonsocial_empresa'];
$nombre = $contenedor['razonsocial_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
  </tr>
  <tr>
    <td><a>MOTIVO:</a></td>
    <td>
<select name="motivo[]" data-placeholder="Motivo de Consulta" class="chosen-select" multiple tabindex="4" required>
<?php $consulta2_sql = "SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_motivo_consulta = $datos2['cod_motivo_consulta'];
$motivo = $datos2['motivo'];
?><option value="<?php echo $motivo ?>"><?php echo $motivo ?></option><?php } ?></select>
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
  <tr >
    <td><a>POBLACIÓN OBJETO:</a></td>
    <td><input type="number" name="total_muestra" value="<?php echo $total_muestra; ?>" ></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><button type="submit">Ver</button></td>
  </tr>
</table>

</form>
<br>

<input type="hidden" id="url" name="url" value="<?php echo $url; ?>">

<?php
if (isset($_GET['razonsocial_empresa'])) {

foreach ($_GET['motivo'] as $indice => $valor_motivo) { $contador++; } unset($valor_motivo);

if (isset($_GET['motivo'][0])) { $motivo = $_GET['motivo'][0]; }
if (isset($_GET['motivo'][1])) { $motivo2 = $_GET['motivo'][1]; }
if (isset($_GET['motivo'][2])) { $motivo3 = $_GET['motivo'][2]; }
if (isset($_GET['motivo'][3])) { $motivo4 = $_GET['motivo'][3]; }
if (isset($_GET['motivo'][4])) { $motivo5 = $_GET['motivo'][4]; }
if (isset($_GET['motivo'][5])) { $motivo6 = $_GET['motivo'][5]; }
if (isset($_GET['motivo'][6])) { $motivo7 = $_GET['motivo'][6]; }
if (isset($_GET['motivo'][7])) { $motivo8 = $_GET['motivo'][7]; }
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($contador==1) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo')";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND (tbl15_historia_clinica.motivo='$motivo') AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==2) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==3) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==4) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==5) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==6) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==7) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
elseif ($contador==8) {

$sql_hist_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.motivo, tbl15_historia_clinica.motivo2, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_historia_clinica.cod_administrador, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.costo_motivo_consulta,
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.cod_estado_facturacion
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_hist_clinica = mysqli_query($conectar, $sql_hist_clinica) or die(mysqli_error($conectar));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_citas = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8'))";
$consulta_conteo_citas = mysqli_query($conectar, $sql_conteo_citas) or die(mysqli_error($conectar));
$datos_conteo_citas = mysqli_fetch_assoc($consulta_conteo_citas);

$conteo_citas = $datos_conteo_citas['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1)";
$consulta_conteo_atendido = mysqli_query($conectar, $sql_conteo_atendido) or die(mysqli_error($conectar));
$datos_conteo_atendido = mysqli_fetch_assoc($consulta_conteo_atendido);

$conteo_atendido = $datos_conteo_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_no_atendido = "SELECT COUNT(cod_historia_clinica) AS conteo_historia_clinica
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=0)";
$consulta_conteo_no_atendido = mysqli_query($conectar, $sql_conteo_no_atendido) or die(mysqli_error($conectar));
$datos_conteo_no_atendido = mysqli_fetch_assoc($consulta_conteo_no_atendido);

$conteo_no_atendido = $datos_conteo_no_atendido['conteo_historia_clinica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_hombre = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_hombre, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='M')";
$consulta_conteo_atendido_hombre = mysqli_query($conectar, $sql_conteo_atendido_hombre) or die(mysqli_error($conectar));
$datos_conteo_atendido_hombre = mysqli_fetch_assoc($consulta_conteo_atendido_hombre);

$conteo_atendido_hombres = $datos_conteo_atendido_hombre['conteo_hombre'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT Count(tbl15_cliente.nombre_sexo) AS conteo_mujer, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_empresa.razonsocial_empresa = tbl15_historia_clinica.razonsocial_empresa
GROUP BY tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.cod_estado_facturacion, tbl15_cliente.nombre_sexo, tbl15_historia_clinica.fecha_ymd
HAVING (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_cliente.nombre_sexo='F')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$conteo_atendido_mujeres = $datos_conteo_atendido_mujer['conteo_mujer'];
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" id="titulo_centrado_extra_largo_ancho_busqueda" method="GET">
<td align="center">EMPRESA: <?php echo $razonsocial_empresa ?><br>MOTIVO: <?php echo $motivo ?><br>FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?></td>
</form> 
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<?php if ($contador==1) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=1&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=1&motivo=<?php echo $motivo ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=1&motivo=<?php echo $motivo ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php } 
elseif ($contador==2) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=2&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=2&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=2&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==3) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=3&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=3&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=3&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==4) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=4&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=4&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=4&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==5) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=5&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=5&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=5&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==6) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=6&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=6&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=6&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==7) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=7&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=7&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=7&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php }
elseif ($contador==8) { ?>
<th style="text-align:left"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=8&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_factura.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_facturacion_por_empresa_razonsocial_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=8&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:right"><a id="url_modif" href="../admin/generar_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_motivo.php?fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&razonsocial_empresa=<?php echo $razonsocial_empresa ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=8&motivo=<?php echo $motivo ?>&motivo2=<?php echo $motivo2 ?>&motivo3=<?php echo $motivo3 ?>&motivo4=<?php echo $motivo4 ?>&motivo5=<?php echo $motivo5 ?>&motivo6=<?php echo $motivo6 ?>&motivo7=<?php echo $motivo7 ?>&motivo8=<?php echo $motivo8 ?>" target="_blank"><img src="../imagenes/ver_informe.png"></a></th>
<?php } ?>
</tr>
</table>
</div>

<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th><a href="#">Total Citas</a></th><td><?php echo number_format($conteo_citas, 0, ",", ".") ?></td><td></td>
<th><a href="#">Total Atendidos</a></th><td><?php echo number_format($conteo_atendido, 0, ",", ".") ?></td><td></td>
<th><a href="#">Total Sin Atender</a></th><td><?php echo number_format($conteo_no_atendido, 0, ",", ".") ?></td><td></td>
<th><a href="#">Poblacion Objeto</a></th><td><input style="text-align:center" id="total_muestra" value="<?php echo $total_muestra;?>" class="input-block-level" size="6"></td>

<!--
<th><a href="#">Total Hombres</a></th><td><?php echo number_format($conteo_atendido_hombres, 0, ",", ".") ?></td><td></td>
<th><a href="#">Total Mujeres</a></th><td><?php echo number_format($conteo_atendido_mujeres, 0, ",", ".") ?></td><td></td>
-->
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
<th>Motivo2</th>
<th>Profesional</th>
<th>Razon Empresa</th>
<th>Empresa</th>
<th>Costo</th>
<!--<th>Factura</th>-->
<th>Fecha</th>
<th>Hora</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php
while ($info_hist_clinica = mysqli_fetch_assoc($resultado_hist_clinica)) {

$cod_historia_clinica          = $info_hist_clinica['cod_historia_clinica'];
$cod_cliente                   = $info_hist_clinica['cod_cliente'];
$cod_administrador_hist        = $info_hist_clinica['cod_administrador'];
$cedula                        = $info_hist_clinica['cedula'];
$nombres                       = $info_hist_clinica['nombres'];
$apellido1                     = $info_hist_clinica['apellido1'];
$motivo                        = $info_hist_clinica['motivo'];
$motivo2                       = $info_hist_clinica['motivo2'];
$nombre_prof                   = $info_hist_clinica['nombre_prof'];
$apellidos_prof                = $info_hist_clinica['apellidos_prof'];
$nombre_sexo                   = $info_hist_clinica['nombre_sexo'];
$nombre_empresa                = $info_hist_clinica['nombre_empresa'];
$razonsocial_empresa           = $info_hist_clinica['razonsocial_empresa'];
$cod_factura                   = $info_hist_clinica['cod_factura'];
$costo_motivo_consulta         = $info_hist_clinica['costo_motivo_consulta'];
$fecha_time                    = $info_hist_clinica['fecha_time'];
$fecha_dmy                     = date("Y/m/d", $fecha_time);
$hora                          = date("H:i", $fecha_time);
?>
<tr>
<td><?php echo $cod_historia_clinica?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $nombre_sexo?></td>
<td><strong><?php echo $motivo?></strong></td>
<td><?php echo $motivo2?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof ?></td>
<td><?php echo $razonsocial_empresa?></td>
<td><?php echo $nombre_empresa?></td>
<td style="text-align:center"><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'costo_motivo_consulta', <?php echo $cod_historia_clinica;?>)" id="costo_motivo_consulta" value="<?php echo $costo_motivo_consulta;?>" class="input-block-level" size="6"></td>
<!--<td style="text-align:center"><input style="text-align:center" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_factura', <?php echo $cod_historia_clinica;?>)" id="cod_factura" value="<?php echo $cod_factura;?>" class="input-block-level" size="1"></td>-->
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
<td align="center"><a href="../admin/edit_historia_clinica_mejorada.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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