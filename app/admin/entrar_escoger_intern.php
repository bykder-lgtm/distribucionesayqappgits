<?php 
$nombre_pagina          = "Compras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_libre.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/fondo_dasboard_login.css" rel="stylesheet">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../menu/03_menu_navegacion_libre_entrar.php'); ?>
<?php include_once("../admin/modal_previsualizar_entrar_intern.php"); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div class="imagen_fondo_login"></div>
<div class="container-fluid h-100  content">

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<div class="ibody">
<div class="jumbotron"><h1>Ingresar Como</h1></div>
	<div class="fcontacto">
		<a href="#" class="btn btn-lg btn-primary btn-block" onclick="obtener_datos_rol_ingreso_modal('Asesor');" data-toggle="modal" data-target=".abrir_previsualizacion_modal_entrar_intern"><h2>Asesor</h2></a>
		<a href="#" class="btn btn-lg btn-primary btn-block" onclick="obtener_datos_rol_ingreso_modal('Aliado');" data-toggle="modal" data-target=".abrir_previsualizacion_modal_entrar_intern"><h2>Aliado</h2></a>
		<a href="#" class="btn btn-lg btn-primary btn-block" onclick="obtener_datos_rol_ingreso_modal('Revisor');" data-toggle="modal" data-target=".abrir_previsualizacion_modal_entrar_intern"><h2>Revisor</h2></a>
		<?php if (isset($_GET['error'])) { $error = $_GET['error']; echo '<br><font color="red">'.utf8_decode($error).'.</font>'; } ?>
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
<br><br><br><br><br><br><br><br><br><br>
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

<script>
function obtener_datos_rol_ingreso_modal(tipo_rol){
    var tipo_rol = tipo_rol;
    $("#mod_"+"tipo_rol").html('Ingresar Como '+tipo_rol);
}
</script>

<script src="js/sha1.js"></script>
<script>
function cifrar(){
	var input_pass = document.getElementById("pass");
	input_pass.value = sha1(input_pass.value);
}
</script>