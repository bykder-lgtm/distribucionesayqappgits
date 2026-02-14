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

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['nombre_raza']) <> '') { $nombre_raza = mysqli_real_escape_string($conectar, ($_POST['nombre_raza'])); } else { $nombre_raza = ''; }

$obtener_raza = "SELECT nombre_raza FROM tbl15_raza WHERE nombre_raza = '".($nombre_raza)."'";
$consultar_raza = mysqli_query($conectar, $obtener_raza) or die(mysqli_error($conectar));
$info_raza = mysqli_fetch_assoc($consultar_raza);

if(mysqli_num_rows(@$consultar_raza) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"><h4>LA RAZA '. $nombre_raza.' YA ESTA REGISTRADO</h4></div>';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="5; <?php echo $pagina_else ?>">
<?php } else {
$sql_data = "INSERT INTO tbl15_raza (nombre_raza) VALUES ('$nombre_raza')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_raza.php">
<?php } } ?>
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
<script type="text/javascript" src="../js/jquery-1.3.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
$('#cedula').blur(function(){
$('#Info').html('<img src="../imagenes/loader.gif" alt="" />').fadeOut(1000);

var cedula = $(this).val();		
var dataString = 'cedula='+cedula;
		
$.ajax({ type: "GET", url: "validar_cedula.php", data: dataString, success: function(data) { $('#Info').fadeIn(1000).html(data);
//alert(data);
} }); }); });    
</script>

</body>
</html>