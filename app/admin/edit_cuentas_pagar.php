<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('edit_cuentas_pagar_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>
</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Cuentas Por Pagar</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                   = $_SERVER['PHP_SELF'];
$cod_tercero                    = intval($_GET['cod_tercero']);

$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente);
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                        = $nombre1_tercero.' '.$apellido1_tercero;

$sql_total_cuenta_pagar = "SELECT Sum(tbl15_cuentas_pagar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_pagar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_pagar.abonado) AS abonado 
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero
WHERE (tbl15_cuentas_pagar.cod_tercero='$cod_tercero')";
$consulta_total_cuenta_pagar = mysqli_query($conectar, $sql_total_cuenta_pagar);
$datos_total_cuenta_pagar = mysqli_fetch_assoc($consulta_total_cuenta_pagar);

$total_monto_deuda             = $datos_total_cuenta_pagar['monto_deuda'];
$total_abonado                 = $datos_total_cuenta_pagar['abonado'];
$total_subtotal                = $datos_total_cuenta_pagar['subtotal'];

$pagina_refrescar = $pagina_local.'?cod_tercero='.$cod_tercero.'&pagina='.$pagina;
?>
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
	<tr>
		<th style="text-align:center">TERCERO</th>
		<th style="text-align:center">TOTAL DEUDA</th>
		<th style="text-align:center">TOTAL ABONADO</th>
		<th style="text-align:center">PENDIENTE</th>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo $nombre1_tercero ?></td>
		<th style="text-align:center"><?php echo number_format($total_monto_deuda, 0, ",", ".")?></th>
		<th style="text-align:center"><?php echo number_format($total_abonado, 0, ",", ".")?></th>
		<th style="text-align:center"><?php echo number_format($total_subtotal, 0, ",", ".")?></th>
	</tr>
</table>

<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TERCERO</th>
			<th style="text-align:center">FACTURA</th>
			<th style="text-align:center">DEUDA</th>
			<th style="text-align:center">ABONADO</th>
			<th style="text-align:center">PENDIENTE</th>
			<th style="text-align:center">FECHA</th>
			<th style="text-align:center">ID</th>
		</tr>
<?php
$monto_deuda_smtr               = 0;
$abonado_smtr                   = 0;
$subtotal_smtr                  = 0;

$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda, tbl15_cuentas_pagar.abonado, tbl15_cuentas_pagar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_pagar.mensaje, tbl15_cuentas_pagar.fecha_pago, tbl15_cuentas_pagar.vendedor, tbl15_cuentas_pagar.cod_info_factura_compra
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero 
WHERE (tbl15_cuentas_pagar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_pagar.fecha_invert DESC";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar)) {

$cod_cuentas_pagar              = $datos_cuenta_pagar['cod_cuentas_pagar'];
$cod_info_factura_compra        = $datos_cuenta_pagar['cod_info_factura_compra'];
$cod_factura                    = $datos_cuenta_pagar['cod_factura'];
$cliente                        = $datos_cuenta_pagar['nombre1_tercero']." ".$datos_cuenta_pagar['apellido1_tercero'];
$monto_deuda                    = $datos_cuenta_pagar['monto_deuda'];
$abonado                        = $datos_cuenta_pagar['abonado'];
$subtotal                       = $datos_cuenta_pagar['subtotal'];
$mensaje                        = $datos_cuenta_pagar['mensaje'];
$fecha_pago                     = $datos_cuenta_pagar['fecha_pago'];
$vendedor                       = $datos_cuenta_pagar['vendedor'];
$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
$abonado_smtr                   = $abonado_smtr + $abonado;
$subtotal_smtr                  = $subtotal_smtr + $subtotal;
?>
    	<tr>
		    <!--<td style="text-align:left;">
		    	<select name="cod_tercero" id="<?php echo $cod_cuentas_pagar;?>" class="<?php echo $cod_cuentas_pagar;?>" style="width: 250px;">
		            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
		            } else { echo  "<option value='' selected ></option>"; }
		            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
		            FROM tbl15_tercero WHERE (nombre_tipo_tercero='PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
		            $consulta2 = mysqli_query($conectar, $consulta2_sql);
		            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
		            $seleccionado = "selected"; } else { $seleccionado = ""; }
		            $codigo = $datos2['cod_tercero'];
		            $nombre = $datos2['nombre1_tercero'].' - '.$datos2['identificacion_tercero'];
		            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		        </select>
		    </td>-->

			<td style="text-align:center"><?php echo $nombre1_tercero ?></td>
			<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_factura', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $cod_factura;?>" class="input-block-level" style="width: 100px;"></td>
			<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'monto_deuda', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $monto_deuda;?>" class="input-block-level" style="width: 140px;"></td>
			<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'abonado', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $abonado;?>" class="input-block-level" style="width: 140px;"></td>
			<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'subtotal', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $subtotal;?>" class="input-block-level" style="width: 140px;"></td>
			<td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_pago', <?php echo $cod_cuentas_pagar;?>)" id="<?php echo $cod_cuentas_pagar;?>" value="<?php echo $fecha_pago;?>" class="input-block-level" style="width: 140px;"></td>
			<td style="text-align:center"><?php echo $cod_cuentas_pagar ?></td>
    	</tr>
<?php } ?>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<div class="actions">
<a href="<?php echo $pagina_refrescar ?>" class="btn btn-info" role="button">Guardar Cambios</a>
</div>
</fieldset>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="js/jquery-ui.js"></script>

<script type="text/javascript">
$('#nombre_ciudad').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';
var nombre_departamento = $("#nombre_departamento option:selected").text();

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_nombre_municipio.php?nombre_campo="+nombre_campo+"&nombre_departamento="+nombre_departamento+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.nombre_municipio);
}
});
});

});
</script>
</body>
</html>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_tercero"]').change(function(){ 
  var cod_tercero = $(this).val();  
  let id = this.id;
    $.ajax({ url:"edit_cuentas_pagar_ajax_reg.php", method:"GET", data:{valor:cod_tercero, campo:"cod_tercero", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>