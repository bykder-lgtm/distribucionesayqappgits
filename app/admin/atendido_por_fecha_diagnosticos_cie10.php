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
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista de Diágnosticos por Paciente Empresa Y Rango de Fechas</h6></a>
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
if (isset($_GET['fecha_ini'])) {
$motivo               = 'TODOS';
$fecha_ini            = addslashes($_GET['fecha_ini']);
$fecha_fin            = addslashes($_GET['fecha_fin']);
$nombre_empresa       = addslashes($_GET['nombre_empresa']);
$fecha                = date("Y/m/d");
}
?>

<form action="" id="searchform_alto_ancho" method="GET">
<td><a href="#">EMPRESA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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

<br>

<td><a href="#">FECHA INI:&nbsp;&nbsp;&nbsp;&nbsp;</a>
<select name="fecha_ini" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($fecha_ini)) { echo "<option value='-1' >...</option>";
} else { echo  "<option value='-1' selected >...</option>"; }
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_historia_clinica GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($fecha_ini) and $fecha_ini == $contenedor['fecha_ymd']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['fecha_ymd'];
$nombre = $contenedor['fecha_ymd'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<br>

<td><a href="#">FECHA FIN:&nbsp;&nbsp;&nbsp;</a>
<select name="fecha_fin" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($fecha_fin)) { echo "<option value='-1' >...</option>";
} else { echo  "<option value='-1' selected >...</option>"; }
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_historia_clinica GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
$resultado = mysqli_query($conectar, $sql_consulta);
while ($contenedor = mysqli_fetch_assoc($resultado)) {
if(isset($fecha_fin) and $fecha_fin == $contenedor['fecha_ymd']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $contenedor['fecha_ymd'];
$nombre = $contenedor['fecha_ymd'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<td align="center"><button type="submit">Ver</button></td>
</form>
<br>
<?php
if (isset($_GET['fecha_ini'])) {
$motivo               = 'TODOS';
$fecha_ini            = addslashes($_GET['fecha_ini']);
$fecha_fin            = addslashes($_GET['fecha_fin']);
$nombre_empresa       = addslashes($_GET['nombre_empresa']);
$fecha                = date("Y/m/d");
$pagina               = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" id="titulo_centrado_largo_ancho_busqueda" method="GET">
<td align="center">FECHA INI: <?php echo $fecha_ini ?><br>FECHA FIN: <?php echo $fecha_fin ?><br>EMPRESA <?php echo $nombre_empresa ?></td>
</form> 

<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th style="text-align:center"><a href="../admin/ver_lista_diagnosticos_cliente_empresa_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
</tr>
</table>
</div>

<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>#</th>
<th>Empresa</th>
<th>Cedula</th>
<th>Nombres</th>
<th>Motivo</th>
<th>Edad (Años)</th>
<th>IMC</th>
<th>Diágnostico</th>
<th>Fecha</th>
</tr>
</thead>
<tbody>
<?php
$numero                         = 0;
$fecha_hoy_time                 = strtotime(date("Y/m/d"));
$integral                       = "";

$sql_cliente = "SELECT tbl15_historia_clinica.nombre_empresa, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.fecha_ymd, 
tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.exa_fis_imc, tbl15_historia_clinica.exa_fis_interpreimc, tbl15_cliente.fecha_nac_ymd
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
WHERE (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$nombre_empresa                = $info_cliente['nombre_empresa'];
$cedula                        = $info_cliente['cedula'];
$cedula                        = $info_cliente['cedula'];
$nombres                       = $info_cliente['nombres'];
$apellido1                     = $info_cliente['apellido1'];
$motivo                        = $info_cliente['motivo'];
$fecha_ymd                     = $info_cliente['fecha_ymd'];
$exa_fis_imc                   = $info_cliente['exa_fis_imc'];
$exa_fis_interpreimc           = $info_cliente['exa_fis_interpreimc'];
$fecha_nac_ymd                 = $info_cliente['fecha_nac_ymd'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];

$fecha_nac_time                = strtotime($fecha_nac_ymd);
$diferencia_edad               = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                     = floor($diferencia_edad / (365*60*60*24));
$integral                       = "";

$sql_cliente1 = "SELECT cie10_cod, cie10_diag FROM tbl15_cie10diag WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_cliente1 = mysqli_query($conectar, $sql_cliente1) or die(mysqli_error($conectar));
while ($info_cliente1 = mysqli_fetch_assoc($resultado_cliente1)) {

$cie10_cod                     = $info_cliente1['cie10_cod'];
$cie10_diag                    = $info_cliente1['cie10_diag'];

$integral                     .= ' |'.$cie10_cod.' - '.$cie10_diag.'| ';
}

$numero++;
?>
<tr>
<td><?php echo $numero?></td>
<td><?php echo $nombre_empresa?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><strong><?php echo $motivo?></strong></td>
<td><?php echo $edad_anyo?></td>
<td><?php echo $exa_fis_imc.' ('.$exa_fis_interpreimc.')' ?></td>
<td><?php echo $integral ?></td>
<td><?php echo $fecha_ymd?></td>
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
</body>
</html>