cargar_foto<?php $serguridad_pagina = 1; ?>
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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Archivo Adjunto</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_historia_clinica         = intval($_GET['cod_historia_clinica']);

$sql_info_historia_clinica = "SELECT cod_cliente, cod_empresa, motivo_consulta FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$cons_info_historia_clinica = mysqli_query($conectar, $sql_info_historia_clinica) or die(mysqli_error($conectar));
$dato_info_historia_clinica = mysqli_fetch_assoc($cons_info_historia_clinica);

$cod_cliente                 = $dato_info_historia_clinica['cod_cliente'];
$cod_empresa                 = $dato_info_historia_clinica['cod_empresa'];
$motivo_consulta             = $dato_info_historia_clinica['motivo_consulta'];

$sql_foto_cliente = "SELECT cod_cliente, cedula, nombres, apellido1, apellido2, url_img_foto, url_img_firma_min, url_img_firma, url_img_foto_min, url_img_foto 
FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$cons_foto_cliente = mysqli_query($conectar, $sql_foto_cliente) or die(mysqli_error($conectar));
$dato_foto_cliente = mysqli_fetch_assoc($cons_foto_cliente);

$cedula                      = $dato_foto_cliente['cedula'];
$nombres                     = $dato_foto_cliente['nombres'];
$apellido1                   = $dato_foto_cliente['apellido1'];
$apellido2                   = $dato_foto_cliente['apellido2'];
$url_img_foto_min            = $dato_foto_cliente['url_img_foto_min'];
$url_img_foto                = $dato_foto_cliente['url_img_foto'];

$sql_empresa = "SELECT nombre_empresa FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
$cons_empresa = mysqli_query($conectar, $sql_empresa) or die(mysqli_error($conectar));
$dato_empresa = mysqli_fetch_assoc($cons_empresa);

$nombre_empresa              = $dato_empresa['nombre_empresa'];
$pagina_actual               = $_SERVER['PHP_SELF'];
?>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="adjuntar_archivo_historia_clinica_reg.php">
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th style="text-align:left" class="column-title">HC</th>
<th style="text-align:left" class="column-title"><?php echo $cod_historia_clinica ?></th>
</tr>
<tr class="headings">
<th style="text-align:left" class="column-title">Nombre Paciente</th>
<th style="text-align:left" class="column-title"><?php echo $nombres ?></th>
</tr>
<tr class="headings">
<th style="text-align:left" class="column-title">Nombre Propietario</th>
<th style="text-align:left" class="column-title"><?php echo $nombre_empresa ?></th>
</tr>
<tr class="headings">
<th style="text-align:left" class="column-title">Motivo Consulta</th>
<th style="text-align:left" class="column-title"><?php echo $motivo_consulta ?></th>
</tr>
<tr class="headings">
<th style="text-align:left" class="column-title">Tipo Archivo</th>
<th style="text-align:left" class="column-title">
	    <select name="nombre_tipo_certificado" id="" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_tipo_certificado)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_tipo_certificado, nombre_tipo_certificado FROM tbl15_tipo_certificado ORDER BY cod_tipo_certificado ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_tipo_certificado) and $nombre_tipo_certificado == $datos2['nombre_tipo_certificado']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_tipo_certificado'];
		$nombre = $datos2['nombre_tipo_certificado'];
		echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
</th>
<tr class="headings">
<th style="text-align:left" class="column-title">Nombre Archivo</th>
<th style="text-align:left" class="column-title"><input name="nombre_archivo_adjunto" class="input-block-level" id="" type="text" value=""/></th>
<tr/>
<tr class="headings">
<th style="text-align:left" class="column-title">Descripcion Archivo</th>
<th style="text-align:left" class="column-title"><input name="descripcion_archivo_adjunto" class="input-block-level" id="" type="text" value=""/></th>
<tr/>
</tr>
<tr class="headings">
<th style="text-align:left" class="column-title">Archivo</th>
<th style="text-align:left" class="column-title"><input type="file" name="tbl15_archivo_adjunto" required="required"/></th>
<tr/>
<th style="text-align:left" class="column-title"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Guardar Archivo</button></th>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina_actual ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
</tr>
</thead>
<tbody>
</table>
</form>


<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th style="text-align:center" class="column-title">Hc</th>
<th style="text-align:center" class="column-title">TIPO</th>
<th style="text-align:center" class="column-title">NOMBRE</th>
<th style="text-align:center" class="column-title">DESCRIPCION</th>
<th style="text-align:center" class="column-title">VER</th>
<th style="text-align:center" class="column-title">FORMATO</th>
<th style="text-align:center" class="column-title">FECHA</th>
<th style="text-align:center" class="column-title">HORA</th>
<th style="text-align:center" class="column-title">ID</th>

</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_archivo_adjunto DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) { 	

$cod_archivo_adjunto                = $datos_consulta['cod_archivo_adjunto'];
$nombre_archivo_adjunto             = $datos_consulta['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto        = $datos_consulta['descripcion_archivo_adjunto'];
$nombre_tipo_certificado            = $datos_consulta['nombre_tipo_certificado'];
$cod_cliente                        = $datos_consulta['cod_cliente'];
$cod_empresa                        = $datos_consulta['cod_empresa'];
$url_archivo_adjunto                = $datos_consulta['url_archivo_adjunto'];
$fecha_creacion                     = $datos_consulta['fecha_creacion'];
$fecha_modificacion                 = $datos_consulta['fecha_modificacion'];
$fecha_hora                         = $datos_consulta['fecha_hora'];
$cuenta                             = $datos_consulta['cuenta'];
$formato                            = $datos_consulta['formato'];
?>
<tr class="even pointer">
<td style="text-align:center"><?php echo $cod_historia_clinica?></td>
<td><?php echo $nombre_tipo_certificado?></td>
<td><?php echo $nombre_archivo_adjunto?></td>
<td><?php echo $descripcion_archivo_adjunto?></td>
<td style="text-align:center"><a href="<?php echo $url_archivo_adjunto?>" target="_blank"><img src="../imagenes/ver_peq.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><?php echo $formato?></td>
<td style="text-align:center"><?php echo $fecha_creacion?></td>
<td style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:center"><?php echo $cod_archivo_adjunto?></td>
</tr>
<?php } ?>
</tr>
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