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
<script type="text/javascript" src="js/jquery.number.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){
// Set up the number formatting.
$('#monto_deuda_sin_interes_number').on('change',function(){
//console.log('Change event.');
var monto_deuda_sin_interes_number = $('#monto_deuda_sin_interes_number').val();
$('#the_number').text( monto_deuda_sin_interes_number !== '' ? monto_deuda_sin_interes_number : '(empty)' );
});
//$('#monto_deuda_sin_interes').change(function(){ console.log('Second change event...'); });
$('#monto_deuda_sin_interes_number').number( true, 0 );

$("#monto_deuda_sin_interes_number").keyup(function () {
    var monto_deuda_sin_interes = $(this).val();
    $("#monto_deuda_sin_interes").val(monto_deuda_sin_interes);
});

});
</script>

<script>
    $(document).ready(function(){
        $("#cod_tercero").chosen();
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
<a class="btn btn-primary" href="#"><h6>Prestamos</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_cuentas_cobrar';
$tipo                        = 'eliminar';
$campo                       = 'cod_cuentas_cobrar  ';
$fecha_pago                  = date("Y-m-d");
$origen                      = 'PARACLINICOS';
$cod_administrador_sesion    = $cod_administrador;
//*******************************************************************************************************************//
if ($cod_seguridad == '1') { $condicional_consulta_admin = ''; } else { $condicional_consulta_admin = 'WHERE cod_administrador = "'.$cod_administrador.'"'; }

if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {

    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = ''; 
    } else { 
        $condicional_consulta_tercero = 'WHERE cod_administrador = "'.$cod_administrador.'"'; 
    }

} else { 
$condicional_consulta_tercero = ''; 
}
//*******************************************************************************************************************//
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_cuentas_cobrar_prestamo.php"><font size='+2'>REGRESAR</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_cuentas_cobrar_manual_prestamo_reg.php">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">TERCERO</th>
<tr>
<td style="text-align:left">
    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
    <?php if (isset($cod_tercero)) { echo ""; } else { echo  ""; }
    $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, cod_administrador FROM tbl15_tercero $condicional_consulta_tercero ORDER BY cod_tercero");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tercero'];
    $cod_administrador = $datos2['cod_administrador'];

    $sql_info_adm = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $resultado_info_adm = mysqli_query($conectar, $sql_info_adm);
    $info_adm = mysqli_fetch_assoc($resultado_info_adm);

    $cuenta                                 = $info_adm['cuenta'];

    if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {
    $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' | '.$datos2['identificacion_tercero'].' | '.$cuenta.' | '.$datos2['nombre_tipo_tercero'];
    } else {
    $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' | '.$datos2['identificacion_tercero'].' | '.$datos2['nombre_tipo_tercero'];
    }
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
</tr>
<tr>
<th style="text-align:center">TOTAL PRESTAMO</th>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="monto_deuda_sin_interes_number" id="monto_deuda_sin_interes_number" type="text" value="" required/></td>
<input type="hidden" name="monto_deuda_sin_interes" id="monto_deuda_sin_interes" value="" />
</tr>
<tr>
<th style="text-align:center">NUMERO CUOTAS</th>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="numero_cuota" type="number" value="" required/></td>
</tr>
<tr>
<th style="text-align:center">% INTERES</th>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="interes_ptj" type="number" step="any" value="" required/></td>
</tr>
<tr>
<th style="text-align:center">TIPO ENTREGA</th>
</tr>
<tr>
<td style="text-align:center">
    <select name="cod_tipo_forma_pago" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
    $consulta2_sql = ("SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1')");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tipo_forma_pago) and $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tipo_forma_pago'];
    $nombre = $datos2['nombre_tipo_forma_pago'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
</tr>
<tr>
<th style="text-align:center">OBSERVACIONES</th>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="mensaje" type="text" value="" /></td>
</tr>
<tr>
<th style="text-align:center">TIPO COBRO</th>
</tr>
<tr>
<td style="text-align:center">
    <select name="nombre_tipo_cobro" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($nombre_tipo_cobro)) { echo ""; } else { echo  ""; }
    $consulta2_sql = ("SELECT * FROM tbl15_tipo_cobro WHERE (cod_estado = '1')");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($nombre_tipo_cobro) and $nombre_tipo_cobro == $datos2['nombre_tipo_cobro']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['nombre_tipo_cobro'];
    $nombre = $datos2['nombre_tipo_cobro'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
</tr>

<tr>
<th style="text-align:center">USUARIO</th>
</tr>
<tr>
<td style="text-align:center">
    <select name="cod_administrador" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_administrador_sesion)) { echo ""; } else { echo  ""; }
    $consulta2_sql = ("SELECT * FROM tbl15_administrador $condicional_consulta_admin");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_administrador_sesion) and $cod_administrador_sesion == $datos2['cod_administrador']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_administrador'];
    $nombre = $datos2['nombres'].' '.$contenedor['apellidos'].' | '.$datos2['cuenta'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
</tr>


<tr>
<th style="text-align:center">CARGAR SOPORTE</th>
</tr>
<tr>
<td style="text-align:center"><input type="file" name="url_img1" id="url_img1"></td>
</tr>
<tr>
<th style="text-align:center">FECHA REG</th>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" name="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" required/></td>
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