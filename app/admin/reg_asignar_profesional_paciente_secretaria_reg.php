<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {
include("../admin/class_php/class.upload.php");
//include("../admin/class_php/class.upload.php");
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_historia_clinica        = intval($_POST['cod_historia_clinica']);
$cod_cliente                 = intval($_POST['cod_cliente']);
$pagina                      = addslashes($_POST['pagina']);
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_cedula = "SELECT cedula FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$resultado_cedula = mysqli_query($conectar, $sql_cedula) or die(mysqli_error($conectar));
$data_cedula = mysqli_fetch_assoc($resultado_cedula);
$cedula = $data_cedula['cedula'];
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_administrador              = intval($_POST['cod_administrador']);
$motivo                         = strtoupper(addslashes($_POST['motivo']));
$cod_entidad                    = intval($_POST['cod_entidad']);
$nombre_religion                = strtoupper(addslashes($_POST['nombre_religion']));
$nombre_ocupacion               = strtoupper(addslashes($_POST['nombre_ocupacion']));
$nombre_estado_civil            = strtoupper(addslashes($_POST['nombre_estado_civil']));
$nombre_escolaridad             = strtoupper(addslashes($_POST['nombre_escolaridad']));
$nombre_empresa_contratante     = strtoupper(addslashes($_POST['nombre_empresa_contratante']));
$nombre_empresa                 = strtoupper(addslashes($_POST['nombre_empresa']));
$nombre_actividad_ecoemp        = strtoupper(addslashes($_POST['nombre_actividad_ecoemp']));
$cargo_empresa                  = strtoupper(addslashes($_POST['cargo_empresa']));
$area_empresa                   = strtoupper(addslashes($_POST['area_empresa']));
$ciudad_empresa                 = strtoupper(addslashes($_POST['ciudad_empresa']));
$nombre_estrato                 = intval($_POST['nombre_estrato']);
$nombre_numero_hijos            = intval($_POST['nombre_numero_hijos']);
$nombre_tipo_regimen            = strtoupper(addslashes($_POST['nombre_tipo_regimen']));
$nombre_fondo_pension           = strtoupper(addslashes($_POST['nombre_fondo_pension']));
$nombre_arl                     = strtoupper(addslashes($_POST['nombre_arl']));
$nombre_contacto1               = strtoupper(addslashes($_POST['nombre_contacto1']));
$parentesco_contacto1           = strtoupper(addslashes($_POST['parentesco_contacto1']));
$tel_contacto1                  = strtoupper(addslashes($_POST['tel_contacto1']));
$direccion_contacto1            = strtoupper(addslashes($_POST['direccion_contacto1']));

$fecha_ymd_hora                 = addslashes($_POST['fecha_ymd_hora']);
$formato                        = 'jpg';
$time                           = time();
$fecha_ymdHis                   = date("YmdHis");
$fecha_time                     = strtotime($fecha_ymd_hora);
$fecha_ymd                      = date("Y/m/d", $fecha_time);
$fecha_dmy                      = date("d/m/Y", $fecha_time);
$fecha_mes                      = date("m/Y", $fecha_time);
$fecha_anyo                     = date("Y", $fecha_time);
$hora                           = date("H:i", $fecha_time);
$fecha_reg_time                 = time();
$cuenta                         = $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_razon_soc_empresa = "SELECT razonsocial_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_razon_soc_empresa = mysqli_query($conectar, $sql_razon_soc_empresa) or die(mysqli_error($conectar));
$datos_razon_soc_empresa = mysqli_fetch_assoc($consulta_razon_soc_empresa);

$razonsocial_empresa             = $datos_razon_soc_empresa['razonsocial_empresa'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_admin = "SELECT cod_tipo_historia_clinica FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_admin = mysqli_query($conectar, $sql_admin) or die(mysqli_error($conectar));
$data_admin = mysqli_fetch_assoc($resultado_admin);
$cod_tipo_historia_clinica = $data_admin['cod_tipo_historia_clinica'];
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_historia_clinica (cod_cliente, cod_administrador, cod_tipo_historia_clinica, motivo,  
cod_entidad, nombre_religion, nombre_ocupacion, nombre_estado_civil, nombre_escolaridad, 
nombre_empresa_contratante, nombre_empresa, razonsocial_empresa, nombre_actividad_ecoemp, cargo_empresa, 
area_empresa, ciudad_empresa, nombre_estrato, nombre_numero_hijos, nombre_tipo_regimen, 
nombre_fondo_pension, nombre_arl, nombre_contacto1, parentesco_contacto1, tel_contacto1, direccion_contacto1,
fecha_ymd, fecha_dmy, fecha_mes, fecha_anyo, fecha_time, hora, fecha_reg_time, cuenta) 
VALUES ('$cod_cliente', '$cod_administrador', '$cod_tipo_historia_clinica', '$motivo', 
'$cod_entidad', '$nombre_religion', '$nombre_ocupacion', '$nombre_estado_civil', '$nombre_escolaridad', 
'$nombre_empresa_contratante', '$nombre_empresa', '$razonsocial_empresa', '$nombre_actividad_ecoemp', '$cargo_empresa', 
'$area_empresa', '$ciudad_empresa', '$nombre_estrato', '$nombre_numero_hijos', '$nombre_tipo_regimen', 
'$nombre_fondo_pension', '$nombre_arl', '$nombre_contacto1', '$parentesco_contacto1', '$tel_contacto1', '$direccion_contacto1',
'$fecha_ymd', '$fecha_dmy', '$fecha_mes', '$fecha_anyo', '$fecha_time', '$hora', '$fecha_reg_time', '$cuenta')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "UPDATE tbl15_historia_clinica SET motivo = '$motivo', nombre_religion = '$nombre_religion', 
nombre_ocupacion = '$nombre_ocupacion', nombre_estado_civil = '$nombre_estado_civil', 
nombre_escolaridad = '$nombre_escolaridad', nombre_empresa_contratante = '$nombre_empresa_contratante', 
nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa', nombre_actividad_ecoemp = '$nombre_actividad_ecoemp', 
cargo_empresa = '$cargo_empresa', area_empresa = '$area_empresa', ciudad_empresa = '$ciudad_empresa', 
nombre_estrato = '$nombre_estrato', nombre_numero_hijos = '$nombre_numero_hijos', 
nombre_tipo_regimen = '$nombre_tipo_regimen', nombre_fondo_pension = '$nombre_fondo_pension', 
nombre_arl = '$nombre_arl', nombre_contacto1 = '$nombre_contacto1', parentesco_contacto1 = '$parentesco_contacto1', 
tel_contacto1 = '$tel_contacto1', direccion_contacto1 = '$direccion_contacto1' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
?>
<h3>Se ha guardado correctamente la información</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="3; ../admin/lista_paciente.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="3; <?php echo $pagina_else?>">
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