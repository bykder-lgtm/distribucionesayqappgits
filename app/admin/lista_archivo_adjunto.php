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

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Archivos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<!--<a href="../admin/reg_usuario.php">Registrar Archivos</h4></a>-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
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
<!--<th style="text-align:center" class="column-title">EDIT</th>-->
</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM tbl15_archivo_adjunto ORDER BY cod_archivo_adjunto DESC";
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
$cod_historia_clinica               = $datos_consulta['cod_historia_clinica'];
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
<!--<td align="center"><a href="../admin/edit_usuario.php?cod_archivo_adjunto=<?php echo $cod_archivo_adjunto?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
</tr>
<?php } ?>
</tr>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>