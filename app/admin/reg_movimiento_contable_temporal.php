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
$pagina                                     = $_SERVER['PHP_SELF'];
$tab                                        = 'tbl15_puc';
$tipo                                       = 'eliminar';
$campo                                      = 'cod_puc';
//$fecha_dmy                                  = date("Y-m-d");
$origen                                     = '';
$total_datos_movimiento_contable_concepto   = 2;
$seleccionado                               = 0;
?>
<form id="" method="POST" action="../admin/reg_movimiento_contable_temporal_reg.php">

<table class="table table-striped" cellspacing="0" cellpadding="20">

<input type="hidden" name="nombre_tipo_movimiento[]" value="DEBITOS" required>
<input type="hidden" name="nombre_tipo_movimiento[]" value="CREDITOS" required>
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
    <td style="text-align:left;"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
  </tr>
</table>
<hr>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
</form>
<?php
$obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') ORDER BY cod_movimiento_contable DESC";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$existe_documento_abierto = mysqli_num_rows($resultado_info_ingre_operacional);

if ($existe_documento_abierto <> '0') { ?>
    <table class="table table-striped">
        <tr> 
          <th style="text-align:center">Documentos sin guardar</th>
        </tr>
    </table>

    <table class="table table-striped">
        <tr> 
          <th style="text-align:center">Ver</th>
          <th style="text-align:center">Id</th>
          <th style="text-align:center">Tipo Documento</th>
          <th style="text-align:center">Tercero</th>
          <th style="text-align:center">Descripcion</th>
          <th style="text-align:center">Fecha</th>
          <th style="text-align:center">Elim</th>
        </tr>
    <?php
    $obtener_info_ingre_operacional = "SELECT * FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') ORDER BY cod_movimiento_contable DESC";
    $resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
    $total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
    while ($info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional)) {

        $cod_movimiento_contable                        = $info_ingre_operacional['cod_movimiento_contable'];
        $nombre_tipo_documento                          = $info_ingre_operacional['nombre_tipo_documento'];
        $descripcion_movimiento                         = $info_ingre_operacional['descripcion_movimiento'];
        $fecha_ymd                                      = $info_ingre_operacional['fecha_ymd'];
        $cod_tercero                                    = $info_ingre_operacional['cod_tercero'];

        $obtener_info_movimiento_contable_cuenta_personal = "SELECT identificacion_tercero, nombre1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $resultado_info_movimiento_contable_cuenta_personal = mysqli_query($conectar, $obtener_info_movimiento_contable_cuenta_personal) or die(mysqli_error($conectar));
        $info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_info_movimiento_contable_cuenta_personal);

        $identificacion_tercero                         = $info_movimiento_contable_cuenta_personal['identificacion_tercero'];
        $nombre1_tercero                                = $info_movimiento_contable_cuenta_personal['nombre1_tercero'];
    ?>
        <tr> 
            <td style="text-align:center"><a href="../admin/edit_movimiento_contable_temporal.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
            <td style="text-align:center"><?php echo $cod_movimiento_contable;?></td>
            <td style="text-align:left"><?php echo $nombre_tipo_documento;?></td>
            <td style="text-align:left"><?php echo $nombre1_tercero;?></td>
            <td style="text-align:left"><?php echo $descripcion_movimiento;?></td>
            <td style="text-align:center"><?php echo $fecha_ymd;?></td>
            <td style="text-align:center"><a href="../admin/eliminar_movimiento_contable_temporal_reg.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
        </tr>
    <?php } ?>
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