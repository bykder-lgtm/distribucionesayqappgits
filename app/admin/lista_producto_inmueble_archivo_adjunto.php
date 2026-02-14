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
<?php
$cod_producto                  = intval($_GET['cod_producto']);
$pagina                        = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra           = $matriz_consulta['cod_producto_barra'];
$nombre_producto              = $matriz_consulta['nombre_producto'];
$und_producto                 = $matriz_consulta['und_producto'];
$precio_compra_producto       = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto        = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];
$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida    = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion     = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta     = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                     = $matriz_consulta['tope_min'];
$iva_ptj                      = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1           = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1            = $matriz_consulta['vencimiento_lote1'];
$comision_ptj                 = $matriz_consulta['comision_ptj'];
$cod_dependencia              = $matriz_consulta['cod_dependencia'];
$url_img_orig_producto        = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto         = $matriz_consulta['url_img_min_producto'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Lista Imagenes Producto</h4></a></div>-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_producto_inmueble.php"><font size='+2'>Lista Archivos Adjuntos de Producto</font></a></th>
    </tr>
</table>

<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center"><?php echo $cod_producto_barra ?></th>
		</tr>
		<tr>
			<th style="text-align:center"><?php echo $nombre_producto ?></th>
		</tr>
	</thead>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">VER ARCHIVO</th>
      		<th style="text-align:center">NOMBRE ARCHIVO</th>
      		<th style="text-align:center">DESCRIPCION ARCHIVO</th>
      		<th style="text-align:center">FORMATO</th>
			<th style="text-align:center">FECHA | HORA</th>
			<!--<th style="text-align:center">CAMBIAR</th>-->
		</tr>
<?php
$fecha_hoy                 = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto WHERE (cod_producto = '$cod_producto') ORDER BY cod_archivo_adjunto DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

$cod_archivo_adjunto            = $datos_consulta['cod_archivo_adjunto'];
$cod_producto                   = $datos_consulta['cod_producto'];
$cod_producto_barra             = $datos_consulta['cod_producto_barra'];
$fecha_creacion                 = $datos_consulta['fecha_creacion'];
$fecha_hora                     = $datos_consulta['fecha_hora'];
$url_archivo_adjunto            = $datos_consulta['url_archivo_adjunto'];
$nombre_archivo_adjunto         = $datos_consulta['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto    = $datos_consulta['descripcion_archivo_adjunto'];
$formato                        = $datos_consulta['formato'];
?>
		<tr>
     		<td style="text-align:center"><a href="<?php echo $url_archivo_adjunto?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
			<td style="text-align:left"><?php echo $nombre_archivo_adjunto; ?></td>
			<td style="text-align:center"><input style="font-size:12px" class="<?php echo $cod_archivo_adjunto ?>" name="descripcion_archivo_adjunto" id="descripcion_archivo_adjunto" type="text" value="<?php echo $descripcion_archivo_adjunto ?>" size="200" /></td>
     		<td style="text-align:center"><?php echo $formato; ?></td>
      		<td style="text-align:center"><?php echo $fecha_creacion.' | '.$fecha_hora; ?></td>
    	<!--<td style="text-align:center"><a href="../admin/edit_producto_url_img.php?cod_archivo_adjunto=<?php echo $cod_archivo_adjunto?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
		</tr>
<?php } //end while ?>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_producto_inmueble_archivo_adjunto_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE Y ARCHIVO</th>
		</tr>
		<tr>
			<th style="text-align:center"><input class="form-control" name="descripcion_archivo_adjunto" type="text" value="" required/><input type="file" name="archivo_adjunto" id="archivo_adjunto"></th>
		</tr>
	</thead>
</table>
<input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>">
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
</body>
</html>

<script>
 $(document).ready(function(){  

  $('input[name="descripcion_archivo_adjunto"]').change(function(){ 
  var cod_estado = $(this).val();  
  var cod_archivo_adjunto = $(this).attr('class');

  var tab = "tbl15_archivo_adjunto";
  var tipo = "editar";
  var campo = "descripcion_archivo_adjunto";

  let ids = this.id;
    $.ajax({ url:"edit_archivo_adjunto_ajax_reg.php", method:"GET", data:{valor:cod_estado, campo:"cod_estado", tab:tab, tipo:tipo, campo:campo, id:cod_archivo_adjunto }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>