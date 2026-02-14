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
<div class="jumbotron"><h1>Entrar Como Aliado</h1></div>
	<div class="fcontacto">
	<div class="logito"><p class="editaxe_interactivo"><?php echo $nombre_emp ?></p></div>

		<form method="POST" id="fcontacto" action="verificacion_visitante_intern.php">
			<input type="text" class="form-control" name="cuenta" placeholder="Usuario" required="" autofocus=""/>
			<input type="password" class="form-control" name="contrasena" id="pass" placeholder="Contraseña" required="">
			<input type="hidden" class="form-control" name="pagina" id="pagina" value="<?php echo $pagina_local ?>">
			<br><br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" id="enviar" onclick="cifrar()">Entrar</button>
			<?php if (isset($_GET['error'])) { $error = $_GET['error']; echo '<br><font color="red">'.utf8_decode($error).'.</font>'; } ?>
		</form>
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

<script src="js/sha1.js"></script>
<script>
function cifrar(){
	var input_pass = document.getElementById("pass");
	input_pass.value = sha1(input_pass.value);
}
</script>
</body>
</html>