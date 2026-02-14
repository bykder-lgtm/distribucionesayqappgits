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
<a class="btn btn-primary" href="#"><h6>Crear Movimiento Contable</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_movimiento_contable';
$tipo                        = 'eliminar';
$campo                       = 'cod_movimiento_contable';
//$fecha_dmy                   = date("Y-m-d");
$origen                      = '';
$total_datos_movimiento_contable_concepto   = 1;
?>
<form action="../admin/reg_movimiento_contable_temporal_cuenta_reg.php" id="" method="POST">

<table class="table table-striped" cellspacing="0" cellpadding="20">

<input type="hidden" name="nombre_tipo_movimiento[]" value="DEBITOS" required>
<input type="hidden" name="total_datos_movimiento_contable_concepto" value="<?php echo $total_datos_movimiento_contable_concepto ?>" required>

  <tr>
    <td style="text-align:right;">CREAR: </td>
    <td style="text-align:left;">
        <select name="nombre_tipo_documento" id="nombre_tipo_documento" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_documento)) { echo "<option value='' $seleccionado >Seleccionar</option>"; } else { echo  "<option value='' $seleccionado >Seleccionar</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_documento FROM tbl15_tipo_documento WHERE (cod_estado = '1') ORDER BY cod_tipo_documento ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_documento) AND $nombre_tipo_documento == $datos2['nombre_tipo_documento']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_documento'];
            $nombre = $datos2['nombre_tipo_documento'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
</table>
<hr>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</form>

<table class="table table-striped" cellspacing="0" cellpadding="20">
<tr>
<th style="text-align:center;">DOCUMENTOS ABIERTOS</th>
</tr>
</table>

<table class="table table-striped" cellspacing="0" cellpadding="20">
<?php
$obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual')";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
while ($info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional)) {

$cod_movimiento_contable                        = $info_ingre_operacional['cod_movimiento_contable'];
$nombre_tipo_documento                          = $info_ingre_operacional['nombre_tipo_documento'];
?>
<tr>
<td><?php echo $cod_movimiento_contable;?></td>
<td><a href="edit_movimiento_contable_cuenta_temporal.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable;?>"><?php echo $nombre_tipo_documento;?></td>
<td><a href="../admin/eliminar.php?llave=<?php echo $cod_movimiento_contable?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" title="Eliminar" alt=""></a></td>

</tr>
<?php } ?>
</table>
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