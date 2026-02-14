<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_libre.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../menu/03_menu_navegacion_libre.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php

?>
<div id="contentOuterSeparator"></div>
<div class="container">
    <div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Portafolio de Servicios</h4></a></div>
        <div class="row-fluid">
			<!--Edit Main Content Area here-->
                <div class="span8" id="divMain">
					<hr>
<?php
           
$sql_evento = "SELECT * FROM tbl15_portafolio_servicio";
$exec_evento = mysqli_query($conectar, $sql_evento) or die(mysqli_error($conectar));

while ($datos_evento = mysqli_fetch_assoc($exec_evento)) {
$cod_portafolio_servicio = $datos_evento['cod_portafolio_servicio'];
$nombre_portafolio_servicio = $datos_evento['nombre_portafolio_servicio'];
$descripcion_portafolio_servicio = $datos_evento['descripcion_portafolio_servicio'];
$url_imagen = $datos_evento['url_imagen'];
?>
<h5><?php echo (($nombre_portafolio_servicio)) ?></h5>
<img src="<?php echo $url_imagen ?>" class="img-rounded" style="margin:12px 0px;">
<p align="justify"><?php echo (($descripcion_portafolio_servicio)) ?></p>
<?php } ?>
			<div class="row-fluid"></div>
                </div>
				<!--End Main Content Area here-->

<!-- 1******************************************************* MODULO PUBLICIDAD *********************************************** -->
<?php include_once('../admin/modulo_evento.php'); ?>
<!-- 1******************************************************* MODULO PUBLICIDAD *********************************************** -->

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