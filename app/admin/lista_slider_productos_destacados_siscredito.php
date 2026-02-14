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
<a href="#"><h4>Productos Destacados (Slider)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local = $_SERVER['PHP_SELF'];
$pagina = $_SERVER['PHP_SELF'];
?>
<script type="text/javascript">
function hacer_busqueda() {
    var xmlhttp;

    var valor_buscar = document.getElementById('busqueda').value;
    var pagina = "<?php echo $pagina_local ?>";

    if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
    }
    xmlhttp.open("POST","../admin/busqueda_inmediata_slider_productos_destacados_siscredito_php.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("buscar="+valor_buscar+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<form action="" id="" method="GET">
	<table class="table table-striped" cellspacing="0" cellpadding="20">
	  <tr>
	    <th style="text-align:right;"><input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" class="input-block-level" placeholder="Agregar nuevos productos destacados"/><div id="logo_cargador"></div></th>
	  </tr>
	</table>
</form>

<table class="table table-striped">
	<thead>
		<tr>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;">ELIM</th>-->
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Codigo</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Nombre Producto</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000;">Descripcion</th>
			<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Precio Compra</th><?php } ?>
            <?php if ($cod_estado_prod_precio_venta_producto == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Precio Venta</th><?php } ?>
            <?php if ($cod_estado_marca_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Marca</th><?php } ?>
            <?php if ($cod_estado_prod_url_img_producto_orig == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Img</th><?php } ?>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Posicion</th>
            <?php if ($cod_estado_prod_editar==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Edit</th><?php } ?>
            <?php if ($cod_estado_prod_eliminar==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Elim</th><?php } ?>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE (cod_estado_destacado = '1') ORDER BY posicion_destacado ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_producto              = $datos_consulta['cod_producto'];
    $cod_producto_barra        = $datos_consulta['cod_producto_barra'];
    $nombre_producto           = $datos_consulta['nombre_producto'];
    $und_producto              = $datos_consulta['und_producto'];
    $precio_costo_producto     = $datos_consulta['precio_costo_producto'];
    $precio_compra_producto    = $datos_consulta['precio_compra_producto'];
    $precio_venta_producto     = $datos_consulta['precio_venta_producto'];
    $nombre_tipo_producto      = $datos_consulta['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida = $datos_consulta['nombre_tipo_unidad_medida'];
    $posologia_cantidad        = $datos_consulta['posologia_cantidad'];
    $posologia_peso            = $datos_consulta['posologia_peso'];
    $nombre_tipo_presentacion  = $datos_consulta['nombre_tipo_presentacion'];
    $nombre_via_administracion = $datos_consulta['nombre_via_administracion'];
    $nombre_frec_duracion      = $datos_consulta['nombre_frec_duracion'];
    $fecha_vencimiento1        = $datos_consulta['fecha_vencimiento1'];
    $vencimiento_lote1         = $datos_consulta['vencimiento_lote1'];
    $fecha_vencimiento2        = $datos_consulta['fecha_vencimiento2'];
    $vencimiento_lote2         = $datos_consulta['vencimiento_lote2'];
    $iva_ptj                   = $datos_consulta['iva_ptj'];
    $tope_min                  = $datos_consulta['tope_min'];
    $und_producto_bodega       = $datos_consulta['und_producto_bodega'];
    $url_img_orig_producto     = $datos_consulta['url_img_orig_producto'];
    $url_img_min_producto      = $datos_consulta['url_img_min_producto'];
    $fecha_mantenimiento       = $datos_consulta['fecha_mantenimiento'];
    $cod_marca                 = $datos_consulta['cod_marca'];
    $descripcion_producto      = $datos_consulta['descripcion_producto'];
    $posicion_destacado        = $datos_consulta['posicion_destacado'];

    $sql_marca = "SELECT cod_marca, nombre_marca FROM tbl15_marca WHERE (cod_marca = '$cod_marca')";
    $query_marca = mysqli_query($conectar, $sql_marca);
    $datos_marca = mysqli_fetch_array($query_marca);

    $nombre_marca                  = $datos_marca['nombre_marca'];

    if ($url_img_orig_producto == '') { $url_img_min_producto = '../imagenes/img_disponible.png'; } else { $url_img_min_producto = $url_img_min_producto; }
?>
		<tr>
            <td style="text-align:left"><?php echo $cod_producto_barra; ?></td>
            <td style="text-align:left"><?php echo $nombre_producto; ?></td>
            <td style="text-align:left"><?php echo $descripcion_producto; ?></td>

            <?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
            <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
            <?php } ?>

            <?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
            <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
            <?php } ?>

            <?php if ($cod_estado_marca_global == '1') { ?>
            <td style="text-align:center"><?php echo $nombre_marca; ?></td>
            <?php } ?>


            <?php if ($cod_estado_prod_url_img_producto_orig == '1') { ?>
            <td style="text-align:center"><img src="<?php echo $url_img_min_producto ?>" style="width:100px;" class="img-rounded" alt=""></td>
            <?php } ?>

            <td style="text-align:center"><?php echo $posicion_destacado; ?></td>

            <!--<td style="text-align:center"><a href="#" class='' title='Editar tbl15_producto' onclick="obtener_datos('<?php echo $cod_producto;?>');" data-toggle="modal" data-target=".abrir_modal_actualizar"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
            <?php if ($cod_estado_prod_editar == '1') { ?>
            <td style="text-align:center"><a href="../admin/edit_producto.php?cod_producto=<?php echo $cod_producto?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
            <?php } ?>

            <?php if ($cod_estado_archivo_adjunto_global==1) { ?>
            <td style="text-align:center"><a href="../admin/lista_producto_archivo_adjunto.php?cod_producto=<?php echo $cod_producto?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/adjuntar_archivo.png" class="img-rounded" alt=""></a></td>
            <?php } ?>

            <?php if ($cod_estado_prod_eliminar == '1') { ?>
            <td style="text-align:center"><a href="../admin/desactivar_producto_destacado.php?cod_producto=<?php echo $cod_producto?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
            <?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>