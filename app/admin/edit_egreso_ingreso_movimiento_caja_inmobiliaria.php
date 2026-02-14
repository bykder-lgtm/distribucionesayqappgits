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

<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
 <!--<a class="btn btn-primary" href="#"><h6>Egreso</h6></a>-->
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
//$fecha_dmy                   = date("Y-m-d");
$origen                      = 'PARACLINICOS';

if (isset($_GET['cod_egreso'])) {
$cod_egreso                          = intval($_GET['cod_egreso']);
if (isset($_GET['fecha_dmy_ini']) <> '') { $fecha_dmy_ini_get = addslashes($_GET['fecha_dmy_ini']); } else { $fecha_dmy_ini_get = ''; }
if (isset($_GET['fecha_dmy_fin']) <> '') { $fecha_dmy_fin_get = addslashes($_GET['fecha_dmy_fin']); } else { $fecha_dmy_fin_get = ''; }
if (isset($_GET['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago_get = intval($_GET['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago_get = ''; }
if (isset($_GET['cod_dependencia']) <> '') { $cod_dependencia_get = intval($_GET['cod_dependencia']); } else { $cod_dependencia_get = ''; }
if (isset($_GET['nombre_tipo_puc']) <> '') { $nombre_tipo_puc_get = addslashes($_GET['nombre_tipo_puc']); } else { $nombre_tipo_puc_get = ''; }

$sql_egreso = "SELECT * FROM tbl15_egreso WHERE (cod_egreso = '$cod_egreso')";
$resultado_egreso = mysqli_query($conectar, $sql_egreso) or die(mysqli_error($conectar));
$total_egreso = mysqli_num_rows($resultado_egreso);
$info_egreso = mysqli_fetch_assoc($resultado_egreso);

$conceptos                              = $info_egreso['conceptos'];
$costo                                  = $info_egreso['costo'];
$comentario                             = $info_egreso['comentario'];
$cod_concepto_movimiento_caja           = $info_egreso['cod_concepto_movimiento_caja'];
$nombre_concepto_movimiento_caja        = $info_egreso['nombre_concepto_movimiento_caja'];
$cod_tipo_puc                           = $info_egreso['cod_tipo_puc'];
$nombre_tipo_puc                        = $info_egreso['nombre_tipo_puc'];
$simbolo_tipo_operacion                 = $info_egreso['simbolo_tipo_operacion'];
$cod_tipo_forma_pago                    = $info_egreso['cod_tipo_forma_pago'];
$fecha_dmy                              = $info_egreso['fecha_dmy'];
$cod_cuentas_pagar                      = $info_egreso['cod_cuentas_pagar'];
$cod_tercero                            = $info_egreso['cod_tercero'];
$cod_dependencia_db                     = $info_egreso['cod_dependencia'];
$url_img_orig_producto                  = $info_egreso['url_img_orig_producto'];
$url_img_min_producto                   = $info_egreso['url_img_min_producto'];
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_egreso_ingreso_movimiento_caja_inmobiliaria.php"><font size='+2'>EDITAR <?php echo $nombre_tipo_puc?></font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">TIPO</th>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">VALOR</th>
<th style="text-align:center">OBSERVACION</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:left">
    <select name="nombre_tipo_puc" id="nombre_tipo_puc" class="chosen-select1" style="width: 100px;" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($nombre_tipo_puc)) { echo ""; } else { echo ""; }
    $consulta2_sql = ("SELECT cod_tipo_puc, nombre_tipo_puc FROM tbl15_tipo_puc WHERE (cod_estado = '1') ORDER BY nombre_tipo_puc ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_tipo_puc) and $nombre_tipo_puc == $datos2['nombre_tipo_puc']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['nombre_tipo_puc'];
    $nombre = $datos2['nombre_tipo_puc'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<td style="text-align:left">
    <select name="cod_concepto_movimiento_caja" id="cod_concepto_movimiento_caja" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_concepto_movimiento_caja)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
    $consulta2_sql = ("SELECT cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc FROM tbl15_concepto_movimiento_caja WHERE (cod_estado = '1') ORDER BY cod_concepto_movimiento_caja ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_concepto_movimiento_caja) and $cod_concepto_movimiento_caja == $datos2['cod_concepto_movimiento_caja']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_concepto_movimiento_caja'];
    $nombre = $datos2['nombre_concepto_movimiento_caja'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<td style="text-align:center"><input class="input-block-level" style="width: 200px;" name="costo" id="costo" type="number" min="1" value="<?php echo $costo?>" required/></td>

<td style="text-align:center"><input class="input-block-level" name="comentario" type="text" value="<?php echo $comentario?>" /></td>
</tr>
</tbody>
</table>


<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">FORMA PAGO</th>
<th style="text-align:center">DEPENDENCIA</th>
<th style="text-align:center">FECHA</th>
</tr>
</thead>
<tbody>
<tr>
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
<input type="hidden" name="cod_egreso" value="<?php echo $cod_egreso ?>">
<input type="hidden" name="fecha_dmy_ini_get" value="<?php echo $fecha_dmy_ini_get ?>">
<input type="hidden" name="fecha_dmy_fin_get" value="<?php echo $fecha_dmy_fin_get ?>">
<input type="hidden" name="cod_tipo_forma_pago_get" value="<?php echo $cod_tipo_forma_pago_get ?>">
<input type="hidden" name="cod_dependencia_get" value="<?php echo $cod_dependencia_get ?>">
<input type="hidden" name="nombre_tipo_puc_get" value="<?php echo $nombre_tipo_puc_get ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Editar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>

</form>
</div>
<?php } ?>

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