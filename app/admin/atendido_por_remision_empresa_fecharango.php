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
<a class="btn btn-primary" href="#"><h6>Lista de Paciente Remitidos Por Empresa Y Rango de Fechas</h6></a>
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
if (isset($_GET['cod_entidad']) <> '') { $cod_entidad = addslashes($_GET['cod_entidad']); } else { $cod_entidad = ''; }
if (isset($_GET['fecha_ini']) <> '') { $fecha_ini = addslashes($_GET['fecha_ini']); } else { $fecha_ini = ''; }
if (isset($_GET['fecha_fin']) <> '') { $fecha_fin = addslashes($_GET['fecha_fin']); } else { $fecha_fin = ''; }
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
    <td><a>FECHA INI:</a></td>
    <td>
<select name="fecha_ini" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($fecha_ini)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_remision GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
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
$sql_consulta = ("SELECT fecha_ymd FROM tbl15_remision GROUP BY fecha_ymd ORDER BY fecha_ymd DESC");
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
?>
<form action="" id="titulo_centrado_extra_largo_ancho_busqueda" method="GET">
<td align="center">
</form> 
<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th style="text-align:center"><a href="../admin/ver_lista_por_empresa_fecharango_motivo_version_pdf.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_grande.png"></a></th>
<th style="text-align:center"><a href="../admin/ver_lista_remision_por_empresa_fecharango_version_xlsx.php?fecha=<?php echo $fecha ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa=<?php echo $nombre_empresa ?>&cod_entidad=<?php echo $cod_entidad ?>&cuenta=<?php echo $cuenta_actual ?>" target="_blank"><img src="../imagenes/ver_lista_excel_grande.png"></a></th>
</tr>
</table>
</div>
<br>
<?php
$sql_consulta = "SELECT tbl15_remision.cod_remision, tbl15_remision.cod_cliente, tbl15_remision.cod_administrador, tbl15_remision.cod_historia_clinica, tbl15_remision.fecha_ymd, tbl15_cliente.cod_entidad, 
tbl15_remision.cod_tipo_remision, tbl15_remision.motivo, tbl15_remision.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.url_img_firma, tbl15_cliente.url_img_foto, 
tbl15_remision.estructura_remision, tbl15_remision.nombre_empresa, tbl15_cliente.apellido2, tbl15_administrador.cuenta, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof 
FROM (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_remision ON tbl15_administrador.cod_administrador = tbl15_remision.cod_administrador) ON tbl15_cliente.cod_cliente = tbl15_remision.cod_cliente) 
WHERE (tbl15_remision.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_remision.nombre_empresa='$nombre_empresa') AND (tbl15_cliente.cod_entidad='$cod_entidad')";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_consulta);
$total_remisiones = mysqli_num_rows($resultado_motivo_conteo);
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<th><a href="#">Total Remisiones</a></th><td><?php echo number_format($total_remisiones, 0, ",", ".") ?></td><td></td>
</tr>
</table>
</div>
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th class="column-title">CRM</th>
<th class="column-title">Cedula</th>
<th class="column-title">Nombre Paciente</th>
<th class="column-title">Motivo</th>
<th class="column-title">Enpresa</th>
<th class="column-title">Eps</th>
<th class="column-title">Fecha</th>
<th class="column-title">Hora</th>
<th class="column-title">Imp</th>
<th class="column-title">Edit</th>
<th>#</th>
</tr>
</thead>
<tbody>
<?php
$conteo                        = 0;
while ($datos_consulta = mysqli_fetch_assoc($resultado_motivo_conteo)) {

$cod_remision                      = $datos_consulta['cod_remision'];
$cod_cliente                       = $datos_consulta['cod_cliente'];
$cod_administrador_hist            = $datos_consulta['cod_administrador'];
$cedula                            = $datos_consulta['cedula'];
$nombres                           = $datos_consulta['nombres'];
$apellido1                         = $datos_consulta['apellido1'];
$apellido2                         = $datos_consulta['apellido2'];
$motivo                            = $datos_consulta['motivo'];
$nombre_empresa                    = $datos_consulta['nombre_empresa'];
$cod_entidad                       = $datos_consulta['cod_entidad'];
$estructura_remision               = $datos_consulta['estructura_remision'];
$nombre_prof                       = $datos_consulta['nombre_prof'];
$apellidos_prof                    = $datos_consulta['apellidos_prof'];
$url_img_firma                     = $datos_consulta['url_img_firma'];
$url_img_foto                      = $datos_consulta['url_img_foto'];
$fecha_time                        = $datos_consulta['fecha_time'];
$fecha_dmy                         = date("Y/m/d", $fecha_time);
$hora                              = date("H:i", $fecha_time);
$conteo++;

$sql_eps = "SELECT cod_entidad, nombre_entidad FROM tbl15_entidad WHERE (cod_entidad='$cod_entidad')";
$resultado_eps = mysqli_query($conectar, $sql_eps);
$datos_eps = mysqli_fetch_assoc($resultado_eps);

$nombre_entidad                    = $datos_eps['nombre_entidad'];
?>
<tr>
<td><?php echo $cod_remision?></td>
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1.' '.$apellido2?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_empresa?></td>
<td><?php echo $nombre_entidad?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
<td align="center"><a href="../admin/ver_remisions_version_pdf.php?cod_remision=<?php echo $cod_remision?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<td align="center"><a href="../admin/edit_remision.php?cod_remision=<?php echo $cod_remision?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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