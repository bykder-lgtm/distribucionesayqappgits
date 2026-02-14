<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" href="../estilo_css/chosen_250px.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script>
    $(document).ready(function(){
        $("#conceptos").chosen();
        $("#cod_tercero").chosen();
        $("#nombre_ccosto").chosen();
   });
</script>
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
<a class="btn btn-primary" href="#"><h6>Egreso</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_egresos';
$tipo                        = 'eliminar';
$campo                       = 'cod_egreso';
$fecha_dmy                   = date("Y-m-d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_egreso.php"><font size='+2'>VER LISTA DE EGRESOS</font></a></th>
        <th style="text-align:right"><a href="../admin/reg_concepto_egreso.php"><font size='+2'>AGREGAR NUEVO CONCEPTO DE EGRESO</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_egreso_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">COSTO</th>
<th style="text-align:center">TERCERO</th>
<th style="text-align:center">COMENTARIO</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:left">
    <select name="conceptos" id="conceptos" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($nombre_concepto_egreso_defec_global)) { echo ""; } else { echo ""; }
    $consulta2_sql = ("SELECT * FROM tbl15_gastos_tabla ORDER BY cod_gastos_tabla ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_concepto_egreso_defec_global) and $nombre_concepto_egreso_defec_global == $datos2['conceptos']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['conceptos'];
    $nombre = $datos2['conceptos'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
<td style="text-align:center"><input class="input-block-level" name="costo" type="text" value="" /></td>
<td style="text-align:left">
    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($nombre_cod_tercero_defec_global)) { echo ""; } else { echo ""; }
    $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_cod_tercero_defec_global) and $nombre_cod_tercero_defec_global == $datos2['cod_tercero']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tercero'];
    $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'].' - '.$datos2['nombre_tipo_tercero'].' - '.$datos2['identificacion_tercero'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
<td style="text-align:center"><input class="input-block-level" name="comentario" type="text" value="" /></td>
</tr>
</tbody>
</table>


<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">PUC</th>
<th style="text-align:center">NOMBRE PUC</th>
<th style="text-align:center">C.COSTO</th>
<th style="text-align:center">DEPENDENCIA</th>
<th style="text-align:center">FECHA</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:center"><input class="input-block-level" name="codigo_puc" id="codigo_puc" type="text" value="" /></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_puc" id="nombre_puc" type="text" value="" /></td>
<td style="text-align:left">
    <select name="nombre_ccosto" id="nombre_ccosto" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($nombre_ccosto_defec_global)) { echo ""; } else { echo ""; }
        $consulta2_sql = ("SELECT cod_ccosto, nombre_ccosto FROM tbl15_ccosto ORDER BY nombre_ccosto ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($nombre_ccosto_defec_global) and $nombre_ccosto_defec_global == $datos2['nombre_ccosto']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['nombre_ccosto'];
        $nombre = $datos2['nombre_ccosto'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>

<td style="text-align:center">
    <select name="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($nombre_cod_dependencia_defec_global)) { echo ""; } else { echo ""; }
        $consulta2_sql = ("SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($nombre_cod_dependencia_defec_global) and $nombre_cod_dependencia_defec_global == $datos2['cod_dependencia']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_dependencia'];
        $nombre = $datos2['nombre_dependencia'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<td style="text-align:center"><input class="input-block-level" name="fecha_dmy" type="date" value="<?php echo $fecha_dmy ?>" /></td>
</tr>
</tbody>
</table>

<hr>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>

</form>
</div>

<script type="text/javascript">
$(function() {
$("#codigo_puc").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#codigo_puc').val(ui.item.codigo_puc);
$('#nombre_puc').val(ui.item.nombre_puc);

}
});
});
</script>
</div>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>