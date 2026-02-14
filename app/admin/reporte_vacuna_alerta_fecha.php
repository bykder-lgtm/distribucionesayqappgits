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
<a class="btn btn-primary" href="#"><h6>Reporte Alertas Vacunas</h6></a>
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
if (isset($_GET['fecha_alerta_ini'])) {
$motivo               = 'TODOS';
$fecha_alerta_ini                        = addslashes($_GET['fecha_alerta_ini']);
$fecha_alerta_fin                        = addslashes($_GET['fecha_alerta_fin']);
$nombre_tipo_producto                    = addslashes($_GET['nombre_tipo_producto']);
$fecha                                   = date("Y-m-d");	
} else {
$fecha_alerta_ini                        = date("Y-m-d");
$fecha_alerta_fin                        = date("Y-m-d");
$nombre_tipo_producto                    = "VACUNA";
$fecha                                   = date("Y-m-d");	
}
?>
<form action="" id="" method="GET">

<table align="center" border="0" width="25%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>TIPO: </em></strong></td>
    <td>
        <select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_producto)) { echo "";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto ORDER BY nombre_tipo_producto ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_producto) AND $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_producto'];
            $nombre = $datos2['nombre_tipo_producto'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td><strong><em>FECHA INI: </em></strong></td>
    <td><strong><em><input class="input-block-level" name="fecha_alerta_ini" type="date" value="<?php echo $fecha_alerta_ini ?>" required/></em></strong></td>
  </tr>
  <tr>
    <td><strong><em>FECHA FIN: </em></strong></td>
    <td><strong><em><input class="input-block-level" name="fecha_alerta_fin" type="date" value="<?php echo $fecha_alerta_fin ?>" required/></em></strong></td>
  </tr>
  <tr>
    <td><strong><em></em></strong></td>
    <td><strong><em><button type="submit">Ver Registros</button></em></strong></td>
  </tr>
</table>
</form>
<br>
<?php
if (isset($_GET['fecha_alerta_ini'])) {
$motivo                                  = 'TODOS';
$fecha_alerta_ini                        = addslashes($_GET['fecha_alerta_ini']);
$fecha_alerta_fin                        = addslashes($_GET['fecha_alerta_fin']);
$nombre_tipo_producto                    = addslashes($_GET['nombre_tipo_producto']);
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_conteo_atendido_mujer = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto
WHERE (fecha_alerta BETWEEN '$fecha_alerta_ini' AND '$fecha_alerta_fin') AND (nombre_tipo_producto = '$nombre_tipo_producto')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$total_venta_producto = $datos_conteo_atendido_mujer['total_venta_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" id="titulo_centrado_largo_ancho_busqueda" method="GET">
<td align="center">TIPO: <?php echo $nombre_tipo_producto ?><br>FECHA INI: <?php echo $fecha_alerta_ini ?><br>FECHA FIN: <?php echo $fecha_alerta_fin ?></td>
</form> 

<br>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<!--<th><a href="#">Total $</a></th><td><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td><td></td>-->
</tr>
</table>
</div>

<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Paciente</th>
<th style="text-align:center">Propietario</th>
<th style="text-align:center">Tipo</th>
<th style="text-align:center">Fecha Activar Alerta</th>
<th style="text-align:center">Fecha a Vacunar</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_costo_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_alerta, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_cliente.nombres AS nombre_cliente, 
tbl15_empresa.nombre_empresa AS nombre_propietario, tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar
FROM tbl15_empresa RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_empresa.cod_empresa = tbl15_venta_producto.cod_empresa 
WHERE (tbl15_venta_producto.fecha_alerta BETWEEN '$fecha_alerta_ini' AND '$fecha_alerta_fin') AND (tbl15_venta_producto.nombre_tipo_producto = '$nombre_tipo_producto')
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_venta_producto            = $info_cliente['cod_venta_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_venta              = $info_cliente['cod_info_factura_venta'];
$cod_factura                   = $info_cliente['cod_factura'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_venta                     = $info_cliente['und_venta'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$total_venta_producto          = $info_cliente['total_venta_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
$nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
$fecha_alerta                  = $info_cliente['fecha_alerta'];
$fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$nombre_cliente                = $info_cliente['nombre_cliente'];
$nombre_propietario            = $info_cliente['nombre_propietario'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_cliente?></td>
<td style="text-align:left"><?php echo $nombre_propietario?></td>
<td style="text-align:center"><?php echo $nombre_tipo_producto?></td>
<td style="text-align:center"><?php echo $fecha_alerta?></td>
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