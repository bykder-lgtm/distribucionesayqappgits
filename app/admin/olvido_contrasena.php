<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_libre.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/fondo_login.css" rel="stylesheet">
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
<?php
if (isset($_GET['cuenta'])) {
$cuenta                                                              = addslashes($_GET['cuenta']);

$mostrar_datos_sql = "SELECT * FROM tbl15_administrador WHERE cuenta = '$cuenta'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);
$existe_reg = mysqli_num_rows($consulta);

$nombres                                                             = $matriz_consulta['nombres'];
$apellidos                                                           = $matriz_consulta['apellidos'];
$correo                                                              = $matriz_consulta['correo'];
$telefono                                                            = $matriz_consulta['telefono'];

} else { 
header("Location:../admin/index.php");
$existe_reg = '0';
} ?>
<div class="ibody">
<div class="jumbotron"><h1><?php echo $desarrollador_emp ?></h1></div>
<div class="fcontacto">

<?php if (($correo <> '') && ($existe_reg <> '0')) { ?>
<form method="POST" id="fcontacto" action="../admin/olvido_contrasena_reg.php">
<button class="btn btn-lg btn-primary btn-block" type="submit">Enviar correo de recuperacion de contraseña a: <?php echo $correo ?></button>
<input type="hidden" class="form-control" name="correo" id="correo" value="<?php echo $correo ?>"/>
<input type="hidden" class="form-control" name="cuenta" id="cuenta" value="<?php echo $cuenta ?>"/>
</form>
<?php } else { ?>
<form method="POST" id="fcontacto" action="../admin/index.php">
<button class="btn btn-lg btn-primary btn-block" type="submit">No existe usuario o correo. Regresar</button>
</form>
<?php } ?>
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
<br><br><br><br><br><br><br><br>
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
</div>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>