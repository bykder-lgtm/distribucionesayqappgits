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
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                                    = $_SERVER['PHP_SELF'];
$pagina_local                              = $_SERVER['PHP_SELF'];
$tab                                       = 'tbl15_egresos';
$tipo                                      = 'eliminar';
$campo                                     = 'cod_egreso';
$fecha_dmy                                 = date("Y-m-d");
$origen                                    = 'PARACLINICOS';
$nombre_tipo_puc                           = '';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_movimiento_contable_cuenta_personal.php"><font size='+2'>REGISTRAR NUEVO CONCEPTO</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_concepto_movimiento_contable_cuenta_personal_reg.php">
<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center">TIPO CUENTA</th>
        <th style="text-align:center">NOMBRE DEL CONCEPTO</th>
        <th style="text-align:center">GUARDAR</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center">
            <select name="nombre_tipo_puc" id="nombre_tipo_puc" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($nombre_tipo_puc)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                $consulta2_sql = ("SELECT * FROM tbl15_tipo_puc WHERE (cod_estado = '1') ORDER BY cod_tipo_puc ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_puc) and $nombre_tipo_puc == $datos2['nombre_tipo_puc']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_puc'];
                $nombre = $datos2['nombre_tipo_puc'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <td style="text-align:center"><input class="input-block-level" name="nombre_concepto_movimiento_caja" id="nombre_concepto_movimiento_caja" type="text" value="" required/></td>
        <td style="text-align:center"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
    </tr>
</tbody>
</table>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
</div>
</form>
</div>

<script language="javascript">
$(document).ready(function(){
    $("#cod_movimiento_contable_cuenta_personal").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_movimiento_contable_cuenta_personal";
        var tipo_ajax = "tbl15_movimiento_contable_cuenta_personal";
        var pagina_local = "<?php echo $pagina_local;?>";
        var id = 0;

        $.post("cambiar_movimiento_cuenta_personal_forma_pago_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:id }, function(data){
            $("#cod_tipo_forma_pago").html(data);
        });
   });
});
</script>



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