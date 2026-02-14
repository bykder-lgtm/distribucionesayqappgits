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

<div class="breadcrumbs">
<a href="#"><h4>Lista de Plantillas Word&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="#">Registrar Plantilla Word</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:left">Nombre Plantilla</th>
<th style="text-align:center">Tipo Plantilla</th>
<th style="text-align:center">Cod</th>
<th style="text-align:center">Descargar</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_plantilla_word_formato_docx WHERE cod_estado = '1'";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_plantilla_word_formato_docx            = $info_cliente['cod_plantilla_word_formato_docx'];
$nombre_plantilla_word_formato_docx         = $info_cliente['nombre_plantilla_word_formato_docx'];
$descripcion_plantilla_word_formato_docx    = $info_cliente['descripcion_plantilla_word_formato_docx'];
$url_plantilla_word_formato_docx            = $info_cliente['url_plantilla_word_formato_docx'];
$tipo_palntilla                             = $info_cliente['tipo_palntilla'];
$cod_estado                                 = $info_cliente['cod_estado'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_plantilla_word_formato_docx?></td>
<td style="text-align:center"><?php echo $tipo_palntilla?></td>
<td style="text-align:center"><?php echo $cod_plantilla_word_formato_docx?></td>
<td style="text-align:center"><a href="<?php echo $url_plantilla_word_formato_docx?>"><img src="../imagenes/word.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>