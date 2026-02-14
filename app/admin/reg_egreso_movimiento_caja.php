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

$sql_movimiento_caja = "SELECT total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '1')";
$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

$total_compra_producto                 = $datos_movimiento_caja['total_compra_producto'];
$total_venta_producto                  = $datos_movimiento_caja['total_venta_producto'];
$total_saldo                           = $datos_movimiento_caja['total_saldo'];
$cod_movimiento_caja                   = 1;
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_egreso_movimiento_caja.php"><font size='+2'>VER LISTA DE MOVIMIENTOS</font></a></th>
        <!--<th style="text-align:right"><a href="../admin/reg_concepto_egreso_movimiento_caja.php"><font size='+2'>AGREGAR NUEVO CONCEPTO DE MOVIMIENTO</font></a></th>-->
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_egreso_movimiento_caja_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CUENTA TOTAL SALDO</th>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">VALOR</th>
<th style="text-align:center">COMENTARIO</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:left;">
    <select name="cod_movimiento_caja" id="cod_movimiento_caja" class="chosen" data-show-subtext="true" data-live-search="true" style="font-size: 25px; height: 50px; width: 400px;" required>
        <?php if (isset($cod_movimiento_caja)) { echo ""; } else { echo ""; }
        $consulta2_sql = ("SELECT * FROM tbl15_movimiento_caja WHERE (cod_estado = '1') ORDER BY cod_movimiento_caja ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_movimiento_caja) and $cod_movimiento_caja == $datos2['cod_movimiento_caja']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_movimiento_caja'];
        $nombre = $datos2['nombre_puc'].' ($ '.number_format($datos2['total_saldo'], 0, ",", ".").')';
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<td style="text-align:left">
    <select name="cod_concepto_movimiento_caja" id="cod_concepto_movimiento_caja" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_concepto_movimiento_caja)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
        $consulta2_sql = ("SELECT cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc FROM tbl15_concepto_movimiento_caja 
        WHERE (cod_estado = '1') ORDER BY cod_concepto_movimiento_caja ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_concepto_movimiento_caja) and $cod_concepto_movimiento_caja == $datos2['cod_concepto_movimiento_caja']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_concepto_movimiento_caja'];
        $nombre = $datos2['nombre_concepto_movimiento_caja'].' ('.$datos2['nombre_tipo_puc'].')';
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>

<td style="text-align:center"><input style="font-size: 30px; height: 50px; width: 180px;" class="input-block-level" name="costo" id="costo" type="number" min="1" value="" step="any" required/></td>
<td style="text-align:center"><input class="input-block-level" name="comentario" type="text" value="" /></td>

</tr>
</tbody>
</table>


<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CUENTA POR PAGAR</th>
<th style="text-align:center">FORMA PAGO</th>
<th style="text-align:center">TERCERO</th>
<th style="text-align:center">DEPENDENCIA</th>
<th style="text-align:center">FECHA</th>
</tr>
</thead>
<tbody>
<tr>
<!--
<td style="text-align:center"><input class="input-block-level" name="codigo_puc" id="codigo_puc" type="text" value="" /></td>
<td style="text-align:center"><input class="input-block-level" name="nombre_puc" id="nombre_puc" type="text" value="" /></td>
-->
<td style="text-align:center"><input class="input-block-level" name="nombre_cuenta_pagar" id="nombre_cuenta_pagar" type="text" value="" style="width: 500px;" /></td>
<input class="input-block-level" name="cod_cuentas_pagar" id="cod_cuentas_pagar" type="hidden" value="" />

<td style="text-align:center;">
    <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
        <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_tipo_forma_pago'];
        $nombre = $datos2['nombre_tipo_forma_pago'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>

<td style="text-align:left">
    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
    $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tercero'];
    $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'].' - '.$datos2['nombre_tipo_tercero'].' - '.$datos2['identificacion_tercero'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>


<td style="text-align:center">
    <select name="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" required>
        <?php if (isset($cod_dependencia)) { echo ""; } else { echo  ""; }
        $consulta2_sql = ("SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
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
$("#nombre_cuenta_pagar").autocomplete({
source: "../admin/autocompletar_cuenta_pagar_movimiento_caja_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

var cod_cuentas_pagar = ui.item.cod_cuentas_pagar;
var cod_factura = ui.item.cod_factura;
var nombre1_tercero = ui.item.nombre1_tercero;
var monto_deuda = ui.item.monto_deuda;
var subtotal = ui.item.subtotal;
var costo = ui.item.costo;
var texto_completo = ui.item.value;

$('#nombre_cuenta_pagar').val(texto_completo);
$('#cod_cuentas_pagar').val(ui.item.cod_cuentas_pagar);
$('#costo').val(ui.item.costo);

var input_costo = document.getElementById("costo");
input_costo.setAttribute("max",costo);
input_costo.setAttribute("min",1);

}
});
});
</script>

<script type="text/javascript">
$(function() {
$("#codigo_puc").autocomplete({
source: "../admin/autocompletar_cuenta_pagar_movimiento_caja_ajax.php?tipo_puc=NINGUNO",
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