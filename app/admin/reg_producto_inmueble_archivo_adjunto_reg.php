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
include("../admin/class_php/class.upload.php");

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['cod_producto']) <> '') { $cod_producto = intval($_POST['cod_producto']); } else { $cod_producto = ''; }
if (isset($_POST['descripcion_archivo_adjunto']) <> '') { $descripcion_archivo_adjunto = mysqli_real_escape_string($conectar, ($_POST['descripcion_archivo_adjunto'])); } else { $descripcion_archivo_adjunto = ''; }
if (isset($_FILES['archivo_adjunto']) <> '') { $archivo_adjunto = $_FILES['archivo_adjunto']['name']; } else { $archivo_adjunto = ''; }
$pagina_else = addslashes($_POST['pagina']);
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra              = $matriz_consulta['cod_producto_barra'];
$nombre_producto                 = $matriz_consulta['nombre_producto'];
$und_producto                    = $matriz_consulta['und_producto'];
$precio_compra_producto          = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto           = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto           = $matriz_consulta['precio_venta_producto'];
$nombre_tipo_producto            = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida       = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion        = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta        = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                        = $matriz_consulta['tope_min'];
$iva_ptj                         = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1              = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1               = $matriz_consulta['vencimiento_lote1'];
$comision_ptj                    = $matriz_consulta['comision_ptj'];
$cod_dependencia                 = $matriz_consulta['cod_dependencia'];
$url_img_orig_producto           = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto            = $matriz_consulta['url_img_min_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");
$creador                         = $cuenta_actual;
$fecha_compra                    = date("Y-m-d");
$fecha_creacion                  = date("Y-m-d");
$ruta_archivo_adjunto_orig       = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
$formato_archivo_adjunto         = explode(".", $archivo_adjunto);
$formato_archivo_adjunto         = end($formato_archivo_adjunto);
$formato                         = strtoupper($formato_archivo_adjunto);
$nombre_normal_archivo           = $fecha_ymdHis.'_'.$cod_producto_barra.'.'.$formato_archivo_adjunto;
$url_archivo_adjunto             = $ruta_archivo_adjunto_orig.$nombre_normal_archivo;
$nombre_archivo_adjunto          = $archivo_adjunto;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, nombre_archivo_adjunto, descripcion_archivo_adjunto, url_archivo_adjunto, fecha_creacion, fecha_hora, cod_administrador, formato) 
VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_archivo_adjunto', '$descripcion_archivo_adjunto', '$url_archivo_adjunto', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$formato')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

if ($archivo_adjunto <> '') { 
copy($_FILES['archivo_adjunto']['tmp_name'], $url_archivo_adjunto); 
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_producto_inmueble_archivo_adjunto.php?cod_producto=<?php echo $cod_producto ?>&pagina=<?php echo $pagina_else ?>">
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