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
<a href="#"><h4>Slider Principal (Nosotros)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
<div class="table-responsive">
<table class="table table-striped">
	<thead>
		<tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Id</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Nombre Producto</th>
			<th style="text-align:center; background-color:#DBE0F3; color:#000;">Descripcion</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Boton Accion</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Img Fondo</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Img</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Posicion</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">Estado</th>
            <?php if ($cod_estado_prod_editar==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Edit</th><?php } ?>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_banner_slider ORDER BY posicion_banner_slider ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos_consulta = mysqli_fetch_assoc($consulta)) {

    $cod_banner_slider                          = $datos_consulta['cod_banner_slider'];
    $nombre_banner_slider                       = $datos_consulta['nombre_banner_slider'];
    $descripcion_banner_slider                  = $datos_consulta['descripcion_banner_slider'];
    $texto_boton_accion_banner_slider           = $datos_consulta['texto_boton_accion_banner_slider'];
    $url_img_banner_slider_orig                 = $datos_consulta['url_img_banner_slider_orig'];
    $url_img_banner_slider_min                  = $datos_consulta['url_img_banner_slider_min'];
    $url_personaje_banner_slider                = $datos_consulta['url_personaje_banner_slider'];
    $active_banner_slider                       = $datos_consulta['active_banner_slider'];
    $posicion_banner_slider                     = $datos_consulta['posicion_banner_slider'];
    $url_accion_banner_slider                   = $datos_consulta['posicion_banner_slider'];
    $cod_estado                                 = $datos_consulta['cod_estado'];

    if ($url_personaje_banner_slider == '') { $url_personaje_banner_slider = '../imagenes/img_disponible.png'; } else { $url_personaje_banner_slider = $url_personaje_banner_slider; }
?>
		<tr>
            <td style="text-align:center"><?php echo $cod_banner_slider; ?></td>
            <td style="text-align:left"><?php echo $nombre_banner_slider; ?></td>
            <td style="text-align:left"><?php echo $descripcion_banner_slider; ?></td>
            <td style="text-align:center"><?php echo $texto_boton_accion_banner_slider; ?></td>

            <td style="text-align:center"><a href="../admin/cambiar_imagen_fondo_slider_principal_nosotros_siscredito.php?cod_banner_slider=<?php echo $cod_banner_slider?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>"><img src="<?php echo $url_img_banner_slider_min ?>" style="width:100px;" class="img-rounded" alt=""></a></td>
            <td style="text-align:center"><a href="../admin/cambiar_imagen_personaje_slider_principal_nosotros_siscredito.php?cod_banner_slider=<?php echo $cod_banner_slider?>&pagina=<?php echo $pagina?>&pagina_local=<?php echo $pagina_local?>"><img src="<?php echo $url_personaje_banner_slider ?>" style="width:100px;" class="img-rounded" alt=""></a></td>

            <td style="text-align:center"><?php echo $posicion_banner_slider; ?></td>
            <td style="text-align:center"><?php echo $cod_estado; ?></td>

            <!--<td style="text-align:center"><a href="#" class='' title='Editar tbl15_producto' onclick="obtener_datos('<?php echo $cod_banner_slider;?>');" data-toggle="modal" data-target=".abrir_modal_actualizar"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
            <?php if ($cod_estado_prod_editar == '1') { ?>
            <td style="text-align:center"><a href="../admin/edit_slider_principal_nosotros_siscredito.php?cod_banner_slider=<?php echo $cod_banner_slider?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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