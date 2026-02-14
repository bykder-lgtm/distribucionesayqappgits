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
<a class="btn btn-primary" href="#"><h6>Cuenta por pagar manual</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_cuentas_pagar';
$tipo                        = 'eliminar';
$campo                       = 'cod_cuentas_pagar  ';
$fecha                       = date("Y-m-d");
$fecha_pago                  = date("Y-m-d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_cuentas_pagar.php"><font size='+2'>REGRESAR</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_cuentas_pagar_manual_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">COD FACTURA</th>
<th style="text-align:center">TERCERO</th>
<th style="text-align:center">DEUDA</th>
<th style="text-align:center">FECHA REG</th>
<th style="text-align:center">FECHA PAGO</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:center"><input class="input-block-level" name="cod_factura" id="cod_factura" type="text" value="" /></td>
<td style="text-align:center">
    <select name="cod_tercero" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_tercero)) { echo "";
    } else { echo  ""; }
    $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero ORDER BY nombre1_tercero");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tercero'];
    $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'].' - '.$datos2['nombre_tipo_tercero'].' - '.$datos2['identificacion_tercero'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
<td style="text-align:center"><input class="input-block-level" name="monto_deuda" type="text" value="" /></td>
<td style="text-align:center"><input class="input-block-level" name="fecha" type="date" value="<?php echo $fecha ?>" required/></td>
<td style="text-align:center"><input class="input-block-level" name="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" /></td>
</tr>
</tbody>
</table>

<hr>
<input type="hidden" name="cod_info_factura_compra" id="cod_info_factura_compra" value="0">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>

</form>
</div>

<script type="text/javascript">
$(function() {
$("#cod_factura").autocomplete({
source: "../admin/autocompletar_cod_factura_compra_cod_info_factura_compra_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
    event.preventDefault();
    let id = this.id;
    var valor = $(this).val();
    var campo = $(this).attr("name");
    var jqui = "jqui";

    $('#cod_info_factura_compra').val(ui.item.cod_info_factura_compra);
    $('#cod_factura').val(ui.item.cod_factura);
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