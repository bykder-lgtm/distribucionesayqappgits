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
<a class="btn btn-primary" href="#"><h6>Crear PyG</h6></a>
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
$tab                         = 'tbl15_puc';
$tipo                        = 'eliminar';
$campo                       = 'cod_puc';
//$fecha_dmy                   = date("Y-m-d");
$origen                      = '';
?>
<form action="../admin/reg_pyg_reg.php" id="" method="POST">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:right;">MES: </td>
    <td style="text-align:left;">
        <select name="nombre_tabla_mes" id="nombre_tabla_mes" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tabla_mes)) { echo "<option value='0' $seleccionado >Seleccionar</option>"; } else { echo  "<option value='0' $seleccionado >Seleccionar</option>"; }
            $consulta2_sql = "SELECT nombre_tabla_mes, nombre_letra_tabla_mes FROM tbl15_tabla_mes ORDER BY nombre_tabla_mes ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tabla_mes) AND $nombre_tabla_mes == $datos2['nombre_tabla_mes']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tabla_mes'];
            $nombre = $datos2['nombre_letra_tabla_mes'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td style="text-align:right;">AÑO: </td>
    <td style="text-align:left;">
        <select name="nombre_tabla_anyo" id="nombre_tabla_anyo" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tabla_anyo)) { echo "<option value='0' $seleccionado >Seleccionar</option>"; } else { echo  "<option value='0' $seleccionado >Seleccionar</option>"; }
            $consulta2_sql = "SELECT nombre_tabla_anyo FROM tbl15_tabla_anyo ORDER BY cod_tabla_anyo ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tabla_anyo) AND $nombre_tabla_anyo == $datos2['nombre_tabla_anyo']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tabla_anyo'];
            $nombre = $datos2['nombre_tabla_anyo'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
</table>
<?php
$total_datos_ingre_operacional          = 1;
$total_datos_costo_operacional          = 1;
$total_datos_gasto_operacional          = 3;
?>
<input type="hidden" name="puc_ingre_operacional[]" value="131505" required>
<input type="hidden" name="nombre_ingre_operacional[]" value="VENTAS" required>
<input type="hidden" name="total_datos_ingre_operacional" value="<?php echo $total_datos_ingre_operacional ?>" required>


<input type="hidden" name="puc_costo_operacional[]" value="6135" required>
<input type="hidden" name="nombre_costo_operacional[]" value="COSTOS DE VENTA" required>
<input type="hidden" name="total_datos_costo_operacional" value="<?php echo $total_datos_costo_operacional ?>" required>


<input type="hidden" name="puc_gasto_operacional[]" value="5110" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="HONORARIOS" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5115" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="IMPUESTOS" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5120" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="ARRENDAMIENTO LOCAL" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5130" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="SEGUROS" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5135" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="SERVICIOS" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5140" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="GASTOS LEGALES" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5145" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="MANTENIMIENTO Y REPARACIONES" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5150" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="ADECUACIONES E INSTALACIONES" required>

<input type="hidden" name="puc_gasto_operacional[]" value="5195" required>
<input type="hidden" name="nombre_gasto_operacional[]" value="DIVERSOS" required>

<input type="hidden" name="total_datos_gasto_operacional" value="<?php echo $total_datos_gasto_operacional ?>" required>

<hr>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>