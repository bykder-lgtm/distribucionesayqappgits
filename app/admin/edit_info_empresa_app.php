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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_info_empresa.php"><h4></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<?php
$cod_info_empresa                 = intval($_GET['cod_info_empresa']);
$pagina                           = addslashes($_GET['pagina']);
$pagina_local                     = $_SERVER['PHP_SELF'];
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_empresa.php">Editar Información</a></strong></td>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/edit_info_empresa_admin.php?cod_info_empresa=<?php echo $cod_info_empresa ?>&pagina=<?php echo $pagina ?>">.</a></strong></td>
    </tr></tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$titulo                                     = $matriz_consulta['titulo'];
$nombre                                     = $matriz_consulta['nombre'];
$eslogan                                    = $matriz_consulta['eslogan'];
$url_pag                                    = $matriz_consulta['url_pag'];
$localidad                                  = $matriz_consulta['localidad'];
$correo                                     = $matriz_consulta['correo'];
$cabecera                                   = $matriz_consulta['cabecera'];
$nit_empresa                                = $matriz_consulta['nit_empresa'];
$info_legal                                 = $matriz_consulta['info_legal'];
$telefono                                   = $matriz_consulta['telefono'];
$celular                                    = $matriz_consulta['celular'];
$direccion                                  = $matriz_consulta['direccion'];
$dir_oficiana1                              = $matriz_consulta['dir_oficiana1'];
$dir_oficiana2                              = $matriz_consulta['dir_oficiana2'];
$dir_oficiana3                              = $matriz_consulta['dir_oficiana3'];
$dir_oficiana4                              = $matriz_consulta['dir_oficiana4'];
$tel1                                       = $matriz_consulta['tel1'];
$tel2                                       = $matriz_consulta['tel2'];
$tel3                                       = $matriz_consulta['tel3'];
$tel4                                       = $matriz_consulta['tel4'];
$resena_info_empresa                        = $matriz_consulta['resena_info_empresa'];
$mision_info_empresa                        = $matriz_consulta['mision_info_empresa'];
$vision_info_empresa                        = $matriz_consulta['vision_info_empresa'];
$principios_filosoficos_info_empresa        = $matriz_consulta['principios_filosoficos_info_empresa'];
$declaracion_privacidad_info_empresa        = $matriz_consulta['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa           = $matriz_consulta['politica_devolucion_info_empresa'];
$politica_calidad_info_empresa              = $matriz_consulta['politica_calidad_info_empresa'];
$keywords                                   = $matriz_consulta['keywords'];
$description                                = $matriz_consulta['description'];
$url_mapa1                                  = $matriz_consulta['url_mapa1'];
$url_mapa2                                  = $matriz_consulta['url_mapa2'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_info_empresa_app_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">CABECERA PROGRAM</th>
		<th style="text-align:center">ESLOGAN</th>
		<th style="text-align:center">TITULO</th>
		<th style="text-align:center">CABECERA FACTURA</th>
		<th style="text-align:center">NIT EMPRESA</th>
	</tr>
	<tr>
		<td style="text-align:center"><input type="text" name="nombre" value="<?php echo ($nombre) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="eslogan" value="<?php echo ($eslogan) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="titulo" value="<?php echo ($titulo) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="cabecera" value="<?php echo ($cabecera) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="nit_empresa" value="<?php echo ($nit_empresa) ?>"  class="input-block-level" /></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">TELEFONO</th>
		<th style="text-align:center">CELULAR</th>
		<th style="text-align:center">TELEFONO 1</th>
		<th style="text-align:center">TELEFONO 2</th>
		<th style="text-align:center">TELEFONO 3</th>
		<th style="text-align:center">TELEFONO 4</th>
	</tr>
	<tr>
		<td style="text-align:center"><input type="text" name="telefono" value="<?php echo ($telefono) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="celular" value="<?php echo ($celular) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="tel1" value="<?php echo ($tel1) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="tel2" value="<?php echo ($tel2) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="tel3" value="<?php echo ($tel3) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="tel4" value="<?php echo ($tel4) ?>"  class="input-block-level" /></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">DIRECCION</th>
		<th style="text-align:center">DIRECCION OFICINA 1</th>
		<th style="text-align:center">DIRECCION OFICINA 2</th>
		<th style="text-align:center">DIRECCION OFICINA 3</th>
		<th style="text-align:center">DIRECCION OFICINA 4</th>
	</tr>
	<tr>
		<td style="text-align:center"><input type="text" name="direccion" value="<?php echo ($direccion) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="dir_oficiana1" value="<?php echo ($dir_oficiana1) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="dir_oficiana2" value="<?php echo ($dir_oficiana2) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="dir_oficiana3" value="<?php echo ($dir_oficiana3) ?>"  class="input-block-level" /></td>
		<td style="text-align:center"><input type="text" name="dir_oficiana4" value="<?php echo ($dir_oficiana4) ?>"  class="input-block-level" /></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">KEYWORDS (SEO)</th>
		<th style="text-align:center">DESCRIPCION (SEO)</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="keywords" rows="2" cols="20"><?php echo $keywords ?></textarea></td>
		<td style="text-align:center"><textarea class="input-block-level" name="description" rows="2" cols="20"><?php echo $description ?></textarea></td>

	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">MAPA 1 (EMBED URL)</th>
		<th style="text-align:center">MAPA 2 (EMBED URL)</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="url_mapa1" rows="2" cols="20"><?php echo $url_mapa1 ?></textarea></td>
		<td style="text-align:center"><textarea class="input-block-level" name="url_mapa2" rows="2" cols="20"><?php echo $url_mapa2 ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">RESEÑA (QUIENES SOMOS)</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="resena_info_empresa" rows="2" cols="20"><?php echo $resena_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">MISION</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="mision_info_empresa" rows="2" cols="20"><?php echo $mision_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">VISION</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="vision_info_empresa" rows="2" cols="20"><?php echo $vision_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">PRICIPIOS FILOSOFICOS (VALORES CORPORATIVOS)</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="principios_filosoficos_info_empresa" rows="2" cols="20"><?php echo $principios_filosoficos_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">POLITICA DE PRIVACIDAD (MANEJO DE DATOS)</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="declaracion_privacidad_info_empresa" rows="2" cols="20"><?php echo $declaracion_privacidad_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">POLITICA DE DEVOLUCION</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="politica_devolucion_info_empresa" rows="2" cols="20"><?php echo $politica_devolucion_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">POLITICA DE CALIDAD</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="politica_calidad_info_empresa" rows="2" cols="20"><?php echo $politica_calidad_info_empresa ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">INFORMACION LEGAL</th>
	</tr>
	<tr>
		<td style="text-align:center"><textarea class="input-block-level" name="info_legal" rows="2" cols="20"><?php echo $info_legal ?></textarea></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_info_empresa" value="<?php echo $cod_info_empresa ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina_local ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
    resena_info_empresa = CKEDITOR.replace("resena_info_empresa");
    CKFinder.setupCKEditor(resena_info_empresa, 'ckeditor/ckfinder');

    mision_info_empresa = CKEDITOR.replace("mision_info_empresa");
    CKFinder.setupCKEditor(mision_info_empresa, 'ckeditor/ckfinder');

    vision_info_empresa = CKEDITOR.replace("vision_info_empresa");
    CKFinder.setupCKEditor(vision_info_empresa, 'ckeditor/ckfinder');

    principios_filosoficos_info_empresa = CKEDITOR.replace("principios_filosoficos_info_empresa");
    CKFinder.setupCKEditor(principios_filosoficos_info_empresa, 'ckeditor/ckfinder');

    declaracion_privacidad_info_empresa = CKEDITOR.replace("declaracion_privacidad_info_empresa");
    CKFinder.setupCKEditor(declaracion_privacidad_info_empresa, 'ckeditor/ckfinder');

    politica_devolucion_info_empresa = CKEDITOR.replace("politica_devolucion_info_empresa");
    CKFinder.setupCKEditor(politica_devolucion_info_empresa, 'ckeditor/ckfinder');

    politica_calidad_info_empresa = CKEDITOR.replace("politica_calidad_info_empresa");
    CKFinder.setupCKEditor(politica_calidad_info_empresa, 'ckeditor/ckfinder');

    info_legal = CKEDITOR.replace("info_legal");
    CKFinder.setupCKEditor(info_legal, 'ckeditor/ckfinder');
}
</script>







