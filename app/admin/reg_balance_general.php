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
<a class="btn btn-primary" href="#"><h6>Crear Balance General</h6></a>
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
<form action="../admin/reg_balance_general_reg.php" id="" method="POST">

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
$total_datos_activo_corriente           = 4;
$total_datos_propied_planta_equipo      = 4;
$total_datos_pasivo_corriente           = 2;
$total_datos_patrimonio                 = 4;
?>
<input type="hidden" name="puc_activo_corriente[]" value="1105" required>
<input type="hidden" name="nombre_activo_corriente[]" value="CAJA" required>
<input type="hidden" name="puc_activo_corriente[]" value="1110" required>
<input type="hidden" name="nombre_activo_corriente[]" value="BANCOS" required>
<input type="hidden" name="puc_activo_corriente[]" value="138020" required>
<input type="hidden" name="nombre_activo_corriente[]" value="CUENTA POR COBRAR" required>
<input type="hidden" name="puc_activo_corriente[]" value="14" required>
<input type="hidden" name="nombre_activo_corriente[]" value="INVENTARIOS" required>
<input type="hidden" name="total_datos_activo_corriente" value="<?php echo $total_datos_activo_corriente ?>" required>

<input type="hidden" name="puc_propied_planta_equipo[]" value="0000" required>
<input type="hidden" name="nombre_propied_planta_equipo[]" value="Maquinaria y equipos" required>
<input type="hidden" name="puc_propied_planta_equipo[]" value="0000" required>
<input type="hidden" name="nombre_propied_planta_equipo[]" value="Equipo de oficina" required>
<input type="hidden" name="puc_propied_planta_equipo[]" value="0000" required>
<input type="hidden" name="nombre_propied_planta_equipo[]" value="Equipo de computacion y comunicacion" required>
<input type="hidden" name="puc_propied_planta_equipo[]" value="0000" required>
<input type="hidden" name="nombre_propied_planta_equipo[]" value="Depreciacion acumulada" required>
<input type="hidden" name="total_datos_propied_planta_equipo" value="<?php echo $total_datos_propied_planta_equipo ?>" required>

<input type="hidden" name="puc_pasivo_corriente[]" value="0000" required>
<input type="hidden" name="nombre_pasivo_corriente[]" value="OBLIGACIONES FINANCIERAS" required>
<input type="hidden" name="puc_pasivo_corriente[]" value="0000" required>
<input type="hidden" name="nombre_pasivo_corriente[]" value="Cuentas Corrientes Comerciales" required>
<input type="hidden" name="total_datos_pasivo_corriente" value="<?php echo $total_datos_pasivo_corriente ?>" required>

<input type="hidden" name="puc_patrimonio[]" value="0000" required>
<input type="hidden" name="nombre_patrimonio[]" value="CAPITAL SOCIAL" required>
<input type="hidden" name="puc_patrimonio[]" value="0000" required>
<input type="hidden" name="nombre_patrimonio[]" value="Reserva Legal" required>
<input type="hidden" name="puc_patrimonio[]" value="0000" required>
<input type="hidden" name="nombre_patrimonio[]" value="Resultados del ejercicio" required>
<input type="hidden" name="puc_patrimonio[]" value="0000" required>
<input type="hidden" name="nombre_patrimonio[]" value="Resultados de Ejercicios anteriores" required>
<input type="hidden" name="total_datos_patrimonio" value="<?php echo $total_datos_patrimonio ?>" required>

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