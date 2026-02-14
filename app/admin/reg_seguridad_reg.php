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

if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, strip_tags($_POST['cuenta'])); } else { $cuenta = ''; }

$obtener_entidad = "SELECT cuenta FROM tbl15_seguridad WHERE cuenta = '".($cuenta)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

if(mysqli_num_rows(@$consultar_entidad) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"><h4>EL seguridad '. $cuenta.' YA ESTA REGISTRADO</h4></div>';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="5; <?php echo $pagina_else ?>">
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
} else {
if (isset($_POST['nombres']) <> '') { $nombres = mysqli_real_escape_string($conectar, ($_POST['nombres'])); } else { $nombres = ''; }
if (isset($_POST['apellidos']) <> '') { $apellidos = mysqli_real_escape_string($conectar, ($_POST['apellidos'])); } else { $apellidos = ''; }
if (isset($_POST['cod_seguridad']) <> '') { $cod_seguridad = mysqli_real_escape_string($conectar, ($_POST['cod_seguridad'])); } else { $cod_seguridad = ''; }
if (isset($_POST['cod_tipo_historia_clinica']) <> '') { $cod_tipo_historia_clinica = mysqli_real_escape_string($conectar, ($_POST['cod_tipo_historia_clinica'])); } else { $cod_tipo_historia_clinica = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar, ($_POST['nombre_sexo'])); } else { $nombre_sexo = ''; }
if (isset($_POST['contrasena1']) <> '') { $contrasena1 = mysqli_real_escape_string($conectar, ($_POST['contrasena1'])); } else { $contrasena1 = ''; }
if (isset($_POST['contrasena2']) <> '') { $contrasena2 = mysqli_real_escape_string($conectar, ($_POST['contrasena2'])); } else { $contrasena2 = ''; }
if (isset($_POST['contrasena']) <> '') { $contrasena = mysqli_real_escape_string($conectar, ($_POST['contrasena'])); } else { $contrasena = ''; }
if (isset($_POST['correo']) <> '') { $correo = mysqli_real_escape_string($conectar, ($_POST['correo'])); } else { $correo = ''; }
if (isset($_POST['telefono']) <> '') { $telefono = mysqli_real_escape_string($conectar, ($_POST['telefono'])); } else { $telefono = ''; }
if (isset($_POST['estilo_css']) <> '') { $estilo_css = mysqli_real_escape_string($conectar, ($_POST['estilo_css'])); } else { $estilo_css = ''; }
if (isset($_POST['reg_medico']) <> '') { $reg_medico = mysqli_real_escape_string($conectar, ($_POST['reg_medico'])); } else { $reg_medico = ''; }
if (isset($_POST['fecha_hora']) <> '') { $fecha_hora = mysqli_real_escape_string($conectar, ($_POST['fecha_hora'])); } else { $fecha_hora = ''; }
if (isset($_POST['fecha']) <> '') { $fecha = mysqli_real_escape_string($conectar, ($_POST['fecha'])); } else { $fecha = ''; }
if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, ($_POST['cuenta'])); } else { $cuenta = ''; }
if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, ($_POST['cuenta'])); } else { $cuenta = ''; }
if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, ($_POST['cuenta'])); } else { $cuenta = ''; }
$creador = $cuenta_actual;

if ($contrasena1 == $contrasena2) {
$contrasena = sha1($contrasena1);

$agreg = "INSERT INTO tbl15_seguridad (nombres, apellidos, nombre_sexo, cuenta, contrasena, correo, cod_seguridad, cod_tipo_historia_clinica, telefono, 
estilo_css, creador, fecha_hora, fecha, reg_medico) 
VALUES ('$nombres', '$apellidos', '$nombre_sexo', '$cuenta', '$contrasena', '$correo', '$cod_seguridad', '$cod_tipo_historia_clinica', '$telefono', 
'$estilo_css', '$creador', '$fecha_hora', '$fecha', '$reg_medico')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_seguridad.php">
<?php } } } ?>
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