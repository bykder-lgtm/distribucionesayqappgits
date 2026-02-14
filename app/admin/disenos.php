<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
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
<a href="../admin/lista_paciente_buscar.php"><h4>Asignar Médico al Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<fieldset class="form-group"><legend class="col-form-label">Diseños</legend>
<?php 
$sql_data = "SELECT cod_disenos, nombre_disenos, url_img FROM tbl15_disenos";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$pagina = $_SERVER['PHP_SELF'];
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>

</thead>
<tbody>
<?php
while ($datos = mysqli_fetch_assoc($exec_data)) {

$cod_disenos = $datos['cod_disenos'];
$nombre_disenos = $datos['nombre_disenos'];                         
$url_img = $datos['url_img'];
?>
<div class="single_comments">
<div class="center-block">
<a href="../admin/asignar_diseno.php?nombre_disenos=<?php echo $nombre_disenos?>&pagina=<?php echo $pagina ?>"><img src="<?php echo $url_img ?>" class="favth-img-polaroid" alt=""></a>
</div>
</div>
<?php   
}
?>
</tbody>
</table>
</div>

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
</fieldset>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

<script type="text/javascript">
$('.form_date').datetimepicker({
language:  'es',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
minView: 2,
forceParse: 0
});
</script>
<!-- 1****************************************************************************************************** -->
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
motivo = CKEDITOR.replace("motivo");
CKFinder.setupCKEditor(motivo, 'ckeditor/ckfinder');
}
</script>

</body>
</html>