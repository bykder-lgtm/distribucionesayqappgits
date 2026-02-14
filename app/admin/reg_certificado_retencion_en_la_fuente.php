<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
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
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_certificado_retencion_en_la_fuente.php"><font size='+1'>Registrar Certificado Manual</font></a></th>
    </tr>
</table>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$pagina = $_SERVER['PHP_SELF']; 
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_certificado_retencion_en_la_fuente_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">TERCERO</th>
		<th style="text-align:center">FECHA INICIAL</th>
		<th style="text-align:center">FECHA FINAL</th>
	</tr>
  	<tr>
		<td style="text-align:left">
	        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
	            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
	            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
	            $consulta2 = mysqli_query($conectar, $consulta2_sql);
	            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
	            $seleccionado = "selected"; } else { $seleccionado = ""; }
	            $codigo = $datos2['cod_tercero'];
	            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
	            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	        </select>
		</td>
		<td style="text-align:center"><input class="input-block-level" name="fecha_ini_certificado_retefuente" type="date" value="" required /></td>
		<td style="text-align:center"><input class="input-block-level" name="fecha_fin_certificado_retefuente" type="date" value="" required /></td>
	</tr>
	<tr>
		<th style="text-align:center">TASA%</th>
		<th style="text-align:center">BASE RETENCION</th>
		<th style="text-align:center">VALOR RETENIDO</th>
	</tr>
  	<tr>
		<td style="text-align:center"><input class="input-block-level" name="nombre_rete_fuente_ptj" type="text" value="" required /></td>
		<td style="text-align:center"><input class="input-block-level" name="subtotal_base_retencion" type="text" value="" required /></td>
		<td style="text-align:center"><input class="input-block-level" name="total_retefuente_valor_retenido" type="text" value="" required /></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_origen_resolucion_facturacion").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_origen_resolucion_facturacion";
        var tipo_ajax = "tbl15_origen_resolucion_facturacion";
        var id = "0";
        var pagina_local = "<?php echo $pagina; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_tipo_resolucion_facturacion_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
            	$("#nombre_tipo_resolucion_facturacion_select").html(respuesta);
            }
        });

   });
});
</script>
</body>
</html>