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

if (isset($_POST['cod_egreso']) <> '') { $cod_egreso = intval($_POST['cod_egreso']); } else { $cod_egreso = ''; }
if (isset($_POST['conceptos']) <> '') { $conceptos = mysqli_real_escape_string($conectar, ($_POST['conceptos'])); } else { $conceptos = ''; }
if (isset($_POST['costo']) <> '') { $costo = mysqli_real_escape_string($conectar, ($_POST['costo'])); } else { $costo = ''; }
if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
if (isset($_POST['comentario']) <> '') { $comentario = mysqli_real_escape_string($conectar, ($_POST['comentario'])); } else { $comentario = ''; }
if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
if (isset($_POST['fecha_dmy']) <> '') { $fecha_dmy = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy'])); } else { $fecha_dmy = ''; }
if (isset($_POST['nombre_ccosto']) <> '') { $nombre_ccosto = mysqli_real_escape_string($conectar, ($_POST['nombre_ccosto'])); } else { $nombre_ccosto = ''; }
if (isset($_POST['fecha_dmy_ini']) <> '') { $fecha_dmy_ini = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy_ini'])); } else { $fecha_dmy_ini = ''; }
if (isset($_POST['fecha_dmy_fin']) <> '') { $fecha_dmy_fin = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy_fin'])); } else { $fecha_dmy_fin = ''; }

$fecha_time     	= time();
$fecha_mes_ym	    = date("Y-m", strtotime($fecha_dmy));
$anyo		        = date("Y", strtotime($fecha_dmy));
$hora	            = date("H:i:s");
$cuenta             = $cuenta_actual;

$actualizar_sql = "UPDATE tbl15_egreso SET conceptos = '$conceptos', costo = '$costo', cod_tercero = '$cod_tercero', comentario = '$comentario', 
codigo_puc = '$codigo_puc', nombre_puc = '$nombre_puc', cod_dependencia = '$cod_dependencia', fecha_dmy = '$fecha_dmy', fecha_mes_ym = '$fecha_mes_ym', 
anyo = '$anyo', nombre_ccosto = '$nombre_ccosto' WHERE cod_egreso = '$cod_egreso'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_egreso.php?fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>">
<?php } ?>
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