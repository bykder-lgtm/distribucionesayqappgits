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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Escoger Opción</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$cod_cliente = intval($_GET['cod_cliente']);

$sql_actitud_laboral = "SELECT cod_actitud_laboral FROM tbl15_actitud_laboral WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_actitud_laboral = mysqli_query($conectar, $sql_actitud_laboral) or die(mysqli_error($conectar));
$datos_actitud_laboral = mysqli_fetch_assoc($consulta_actitud_laboral);

$cod_actitud_laboral = $datos_actitud_laboral['cod_actitud_laboral'];

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];

$fecha_hoy = date("d/m/Y");
?>
<div class="container">
    <div class="row">
        <div class="span6 offset4">
<a href="../admin/edit_cie10.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>" target="_blank"><button type="button" class="btn btn-danger">Desea Terminar de Diligenciar el Cie10?</button></a>
<br><br>
<a href="../admin/edit_concepto_actitud_laboral.php?cod_actitud_laboral=<?php echo $cod_actitud_laboral ?>&cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>" target="_blank"><button type="button" class="btn btn-primary">Desea Diligenciar el Concepto de Aptitud Laboral?</button></a>
        </div>
    </div>
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