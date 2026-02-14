<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">
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

<?php
$pagina               = $_SERVER['PHP_SELF'];
$tabla                = addslashes($_GET['tabla']);

if ($tabla=='tbl15_actitud_laboral') {
$boton_registrar      = '../imagenes/aptitud_laboral.png';
$texto_enunciado      = 'Nuevo Concepto de Aptitud Laboral';
} 
elseif ($tabla=='tbl15_manipulacion_alimento') {
$boton_registrar      = '../imagenes/tbl15_manipulacion_alimento.png';
$texto_enunciado      = 'Nuevo Certificado de Manipulación de Alimentos';
}
elseif ($tabla=='tbl15_trabajo_altura') {
$boton_registrar      = '../imagenes/tbl15_trabajo_altura.png';
$texto_enunciado      = 'Nuevo Certificado de Trabajo en Alturas';
}
elseif ($tabla=='tbl15_remision') {
$boton_registrar      = '../imagenes/tbl15_remision.png';
$texto_enunciado      = 'Nueva Remisión';
}
elseif ($tabla=='tbl15_consentimiento_informado') {
$boton_registrar      = '../imagenes/tbl15_consentimiento_informado.png';
$texto_enunciado      = 'Nuevo Consentimiento Informado';
}
elseif ($tabla=='tbl15_satisfacion_usuario_encuesta') {
$boton_registrar      = '../imagenes/tbl15_consentimiento_informado.png';
$texto_enunciado      = 'Nueva Encuesta de satisfación';
}
?>
<div class="breadcrumbs">
<a href="#"><h4>Crear <?php echo $texto_enunciado ?></a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->                  
<!-- Form search -->
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4"><input type="text" class="form-control" id="busqueda_ajax" placeholder="Cedula o Nombre del Paciente" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span></div>
        <input type="hidden" class="form-control" id="tabla" value="<?php echo $tabla ?>">
        <input type="hidden" class="form-control" id="boton_registrar" value="<?php echo $boton_registrar ?>">
        <input type="hidden" class="form-control" id="texto_enunciado" value="<?php echo $texto_enunciado ?>">
</form>     
<!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
    </div><!-- /page content -->
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
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>
<script type="text/javascript" src="../admin/busqueda_paginacion_crear_nuevo_registro_ajax.js"></script>
</body>
</html>