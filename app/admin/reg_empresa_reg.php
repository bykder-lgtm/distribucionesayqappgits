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

if (isset($_POST['nombre_empresa']) <> '') { $nombre_empresa = mysqli_real_escape_string($conectar, ($_POST['nombre_empresa'])); } else { $nombre_empresa = ''; }
if (isset($_POST['direccion_empresa']) <> '') { $direccion_empresa = mysqli_real_escape_string($conectar, ($_POST['direccion_empresa'])); } else { $direccion_empresa = ''; }
if (isset($_POST['telefono_empresa']) <> '') { $telefono_empresa = mysqli_real_escape_string($conectar, ($_POST['telefono_empresa'])); } else { $telefono_empresa = ''; }
if (isset($_POST['nit_empresa']) <> '') { $nit_empresa = mysqli_real_escape_string($conectar, ($_POST['nit_empresa'])); } else { $nit_empresa = ''; }
if (isset($_POST['correo_empresa']) <> '') { $aaacorreo_empresaa = mysqli_real_escape_string($conectar, ($_POST['correo_empresa'])); } else { $correo_empresa = ''; }
if (isset($_POST['municipio_empresa']) <> '') { $municipio_empresa = mysqli_real_escape_string($conectar, ($_POST['municipio_empresa'])); } else { $municipio_empresa = ''; }
if (isset($_POST['estrato_empresa']) <> '') { $estrato_empresa = mysqli_real_escape_string($conectar, ($_POST['estrato_empresa'])); } else { $estrato_empresa = ''; }
if (isset($_POST['ocupacion_empresa']) <> '') { $ocupacion_empresa = mysqli_real_escape_string($conectar, ($_POST['ocupacion_empresa'])); } else { $ocupacion_empresa = ''; }

$obtener_empresa = "SELECT nombre_empresa FROM tbl15_empresa WHERE nombre_empresa = '".($nombre_empresa)."'";
$consultar_empresa = mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$tbl15_info_empresa = mysqli_fetch_assoc($consultar_empresa);

if(mysqli_num_rows(@$consultar_empresa) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"><h4>LA EMPRESA '. $nombre_empresa.' YA ESTA REGISTRADA</h4></div>';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="5; <?php echo $pagina_else ?>">
<?php } else {
$sql_data = "INSERT INTO tbl15_empresa (nombre_empresa, direccion_empresa, telefono_empresa, nit_empresa, 
correo_empresa, municipio_empresa, estrato_empresa, ocupacion_empresa) 
VALUES ('$nombre_empresa', '$direccion_empresa', '$telefono_empresa', '$nit_empresa', 
'$correo_empresa', '$municipio_empresa', '$estrato_empresa', '$ocupacion_empresa')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_empresa.php">
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
		
$.ajax({
type: "GET",
url: "validar_cedula.php",
data: dataString,
success: function(data) {
$('#Info').fadeIn(1000).html(data);
//alert(data);
}
});
});              
});    
</script>

</body>
</html>