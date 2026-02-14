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

<div class="breadcrumbs"><a href="../admin/reg_videotutorial.php"><h4>Videotutorial</h4></a></div>
<hr>
<div class="row-fluid">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina               = $_SERVER['PHP_SELF'];

$sql_cliente = "SELECT * FROM tbl15_videotutorial ORDER BY cod_videotutorial ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
?>
<div class="span5">
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_videotutorial            = $info_cliente['cod_videotutorial'];
$nombre_videotutorial         = $info_cliente['nombre_videotutorial'];
$descripcion_videotutorial    = $info_cliente['descripcion_videotutorial'];
$url_videotutorial            = $info_cliente['url_videotutorial'];
$cod_estado                   = $info_cliente['cod_estado'];
$nomb_videotutorial           = $info_cliente['nomb_videotutorial'];
$fecha_mes                    = $info_cliente['fecha_mes'];
$fecha_anyo                   = $info_cliente['fecha_anyo'];
$fecha_ymd                    = $info_cliente['fecha_ymd'];
$fecha_dmy                    = $info_cliente['fecha_dmy'];
$fecha_time                   = $info_cliente['fecha_time'];
$fecha_reg_time               = $info_cliente['fecha_reg_time'];
?>
     <h5><a href="<?php echo $pagina ?>?cod_videotutorial=<?php echo $cod_videotutorial?>"><?php echo $nombre_videotutorial; ?></a></h5>
<?php } ?>
</div>


<?php
if (isset($_GET['cod_videotutorial'])) {

$cod_videotutorial            = intval($_GET['cod_videotutorial']);

$sql_cliente = "SELECT * FROM tbl15_videotutorial WHERE cod_videotutorial = '$cod_videotutorial'";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
$info_cliente = mysqli_fetch_assoc($resultado_cliente);

$cod_videotutorial            = $info_cliente['cod_videotutorial'];
$nombre_videotutorial         = $info_cliente['nombre_videotutorial'];
$descripcion_videotutorial    = $info_cliente['descripcion_videotutorial'];
$url_videotutorial            = $info_cliente['url_videotutorial'];
$cod_estado                   = $info_cliente['cod_estado'];
?>
<div class="span7" id="divMain">
     <h3><a><?php echo $nombre_videotutorial; ?></a><a href="edit_videotutorial.php?cod_videotutorial=<?php echo $cod_videotutorial ?>&pagina=<?php echo $pagina ?>">.</a></h3>
     <hr>
     <video src="<?php echo $url_videotutorial ?>" controls width="600" height="450">Tu navegador no soporta el elemento video. <a href="<?php echo $url_videotutorial ?>">Intenta descargando este video</a>. <code>video</code>.</video>
     <hr>
    <p><?php echo $descripcion_videotutorial; ?></p>
</div>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>

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