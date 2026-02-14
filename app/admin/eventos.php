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
$sql_evento = "SELECT * FROM tbl15_evento ORDER BY fecha_ymd ASC";
$exec_evento = mysqli_query($conectar, $sql_evento) or die(mysqli_error($conectar));
?>
<div id="contentOuterSeparator"></div>
<div class="container">
    <div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Eventos</h4></a></div>
        <div class="row-fluid">
			<!--Edit Main Content Area here-->
                <div class="span8" id="divMain">
					<hr>
<?php
while ($datos_evento = mysqli_fetch_assoc($exec_evento)) {
$nombre_evento = $datos_evento['nombre_evento'];
$descripcion_evento = $datos_evento['descripcion_evento'];
$url_imagen = $datos_evento['url_imagen'];
$fecha_ymd = $datos_evento['fecha_ymd'];
$fecha_hora = $datos_evento['fecha_hora'];
$cod_estado = $datos_evento['cod_estado'];
?>
<h5><?php echo (($nombre_evento)) ?></h5>
<img src="<?php echo $url_imagen ?>" class="img-polaroid" style="margin:12px 0px;">  
<p align="justify"><?php echo (($descripcion_evento)) ?></p>
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