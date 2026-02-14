<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
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
<a href="#"><h4>Digilenciar Cie10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy = date("Y/m/d H:i:00");
//$pagina = addslashes($_GET['pagina']);
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$cod_cliente = intval($_GET['cod_cliente']);

$obtener_estructura_cie10 = "SELECT motivo, cod_cliente FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_cie10 = mysqli_query($conectar, $obtener_estructura_cie10) or die(mysqli_error($conectar));
$info_estructura_cie10 = mysqli_fetch_assoc($consultar_estructura_cie10);

$motivo = $info_estructura_cie10['motivo'];
$cod_cliente = $info_estructura_cie10['cod_cliente'];

$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_foto_min AS url_img_foto_min_cli FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$nombre_tipo_doc = $info_cliente['nombre_tipo_doc'];
$url_img_foto_min_cli = $info_cliente['url_img_foto_min_cli'];

$nom_ape = $nombres.' '.$apellido1;
?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_cie10_reg.php">
<fieldset>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="<?php echo $url_img_foto_min_cli ?>" width="71px"/></th></tr></thead></table>
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th>NOMBRES Y APELLIDOS</th>
<th>TIPO IDENTIFICACIÓN</th>
<th>IDENTIFICACIÓN</th>
<th>HC</th>
</tr></thead>
<tbody><tr>
<td align="center"><?php echo $nombres.' '.$apellido1 ?></td>
<td align="center"><?php echo $nombre_tipo_doc ?></td>
<td align="center"><?php echo $cedula ?></td>
<td align="center"><?php echo $cod_historia_clinica ?></td>
</tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<div class="table-responsive">
<table border="1" class="table table-striped">
<thead>
<tr>
<td style="text-align:center"><strong>CIE 10</strong></td>
<td style="text-align:center"><strong>Diágnostico</strong></td>
<td style="text-align:center"><strong>Impresión Diagnostica</strong></td>
<td style="text-align:center"><strong>Confirmado Nuevo</strong></td>
<td style="text-align:center"><strong>Confirmado Repetido</strong></td>
<td style="text-align:center"><strong>DIÁGNOSTICO PRINCIPAL</strong></td>
<td style="text-align:center"><strong>Elim</strong></td>
</tr>
</thead>
<tbody>
<?php
$obtener_cie10diag = "SELECT * FROM tbl15_cie10diag WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consultar_cie10diag);

while ($info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag)) {
$cod_cie10diag      = $info_cie10diag['cod_cie10diag'];
$cie10_cod          = $info_cie10diag['cie10_cod'];
$cie10_diag         = $info_cie10diag['cie10_diag'];
$cie10_impdiag      = $info_cie10diag['cie10_impdiag'];
$cie10_confirnuev   = $info_cie10diag['cie10_confirnuev'];
$cie10_confirepet   = $info_cie10diag['cie10_confirepet'];
$cie10_diagprinc    = $info_cie10diag['cie10_diagprinc'];
?>
<tr>
<input class="input-block-level" name="cod_cie10diag[]" type="hidden" value="<?php echo $cod_cie10diag ?>"/>
<td><input class="input-block-level" name="cie10_cod[]" type="text" value="<?php echo $cie10_cod ?>" size="15"/></td>
<td><input class="input-block-level" name="cie10_diag[]" type="text" value="<?php echo $cie10_diag ?>" size="200"/></td>
<td><input class="input-block-level" name="cie10_impdiag[]" type="text" value="<?php echo $cie10_impdiag ?>"/></td>
<td><input class="input-block-level" name="cie10_confirnuev[]" type="text" value="<?php echo $cie10_confirnuev ?>"/></td>
<td><input class="input-block-level" name="cie10_confirepet[]" type="text" value="<?php echo $cie10_confirepet ?>"/></td>
<td><input class="input-block-level" name="cie10_diagprinc[]" type="text" value="<?php echo $cie10_diagprinc ?>"/></td>
<td align="center"><a href="../admin/eliminar.php?llave=<?php echo $cod_cie10diag?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tab=tbl15_cie10diag&tipo=eliminar&campo=cod_cie10diag&pagina=edit_cie10.php"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<input type="hidden" name="total_datos" value="<?php echo $total_datos ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
window.onload = function() {
//-------------------------------------------------------------------------------------------------//
estructura_cie10 = CKEDITOR.replace("estructura_cie10");
CKFinder.setupCKEditor(estructura_cie10, 'ckeditor/ckfinder');
}
</script>
</body>
</html>