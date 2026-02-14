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
$sql_data = "SELECT * FROM tbl15_vision ORDER BY cod_vision = '1'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
$datos = mysqli_fetch_assoc($exec_data);
//$total_datos = mysqli_num_rows($datos);
$nombre_vision = $datos['nombre_vision'];
$descripcion_vision = $datos['descripcion_vision'];
$url_imagen = $datos['url_imagen'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
    <div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Visión</h4></a></div>
        <div class="row-fluid">
			<!--Edit Main Content Area here-->
                <div class="span8" id="divMain">
					<hr>					
<img src="<?php echo $url_imagen ?>" class="img-polaroid" style="margin:12px 0px;">  
<!--<h2>Consequat bibendum quam</h2>-->
<p align="justify"><?php echo (($descripcion_vision)) ?></p>
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