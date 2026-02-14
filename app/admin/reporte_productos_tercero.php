<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
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
<a class="btn btn-primary" href="#"><h6>Reporte Invenatio Por Proveedor</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado = 0;

if (isset($_GET['cod_tercero'])) {
$cod_tercero                             = intval($_GET['cod_tercero']);
$fecha                                   = date("Y-m-d");
$sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_cliente                          = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
} else {
$cod_tercero                             = 0;
$fecha                                   = date("Y-m-d");
$nombre_cliente                          = 0;
}

$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">TERCERO</th>
  </tr>
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'PROVEEDOR' ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
<?php
if (isset($_GET['cod_tercero'])) {
$motivo                                  = 'TODOS';
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
?>
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Codigo</th>
<th style="text-align:center">Nombre</th>
<th style="text-align:center">Und</th>
<th style="text-align:center">P.Compra</th>
<th style="text-align:center">P.Venta</th>
<th style="text-align:center">Proveedor</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_producto WHERE (cod_tercero = '$cod_tercero') ORDER BY nombre_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
   
$cod_producto_barra                      = $info_cliente['cod_producto_barra'];
$nombre_producto                         = $info_cliente['nombre_producto'];
$und_producto                            = $info_cliente['und_producto'];
$precio_compra_producto                  = $info_cliente['precio_compra_producto'];
$precio_venta_producto                   = $info_cliente['precio_venta_producto'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:center"><?php echo $und_producto?></td>
<td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".")?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $nombre_cliente?></td>
</tr>
<?php } ?>
</tbody>
</table>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>