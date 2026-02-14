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
<div class="breadcrumbs"><a href="../admin/lista_historia_clinica_individual_buscar.php"><h4>Historias Clinicas</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
 	 	 	
$sql_cliente = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.cod_cliente, tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.cod_tipo_historia_clinica, tbl15_historia_clinica.cod_estado_facturacion, 
tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.motivo, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig,  
tbl15_historia_clinica.fecha_time, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.url_img_firma, tbl15_cliente.url_img_foto, 
tbl15_cliente.apellido2, tbl15_administrador.cuenta, tbl15_administrador.nombres AS nombre_prof, tbl15_administrador.apellidos AS apellidos_prof, 
tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica FROM tbl15_tipo_historia_clinica 
RIGHT JOIN (tbl15_cliente RIGHT JOIN (tbl15_administrador RIGHT JOIN tbl15_historia_clinica ON tbl15_administrador.cod_administrador = tbl15_historia_clinica.cod_administrador) 
ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) ON tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_historia_clinica.cod_tipo_historia_clinica 
WHERE tbl15_historia_clinica.cod_estado_facturacion = '1' ORDER BY fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<!--<th>Evolución</th>-->
<th>Cedula</th>
<th>Nombre Paciente</th>
<th>Motivo</th>
<th>Nombre Profesional</th>
<th>Fecha</th>
<th>Hora</th>
<th>Foto</th>
<th>Firma</th>
<th>Imp</th>
<th>EmailH</th>
</tr>
</thead>
<tbody>
<?php
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
$cod_historia_clinica = $info_cliente['cod_historia_clinica'];
$cod_cliente = $info_cliente['cod_cliente'];
$cod_administrador_hist = $info_cliente['cod_administrador'];
$cedula = $info_cliente['cedula'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];
$motivo = $info_cliente['motivo'];
$nombre_prof = $info_cliente['nombre_prof'];
$apellidos_prof = $info_cliente['apellidos_prof'];
$nombre_tipo_historia_clinica = $info_cliente['nombre_tipo_historia_clinica'];
$url_img_firma_min = $info_cliente['url_img_firma_min'];
$url_img_firma_orig = $info_cliente['url_img_firma_orig'];
$url_img_foto_min = $info_cliente['url_img_foto_min'];
$url_img_foto_orig = $info_cliente['url_img_foto_orig'];
$url_img_firma = $info_cliente['url_img_firma'];
$url_img_foto = $info_cliente['url_img_foto'];
$fecha_time = $info_cliente['fecha_time'];
$fecha_dmy = date("Y/m/d", $fecha_time);
$hora = date("H:i", $fecha_time);
?>
<tr>
<!--<td align="center"><a href="../admin/reg_evolucion.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/tbl15_evolucion.png" class="img-polaroid" alt=""></a></td>-->
<td><?php echo $cedula?></td>
<td><?php echo $nombres.' '.$apellido1?></td>
<td><?php echo $motivo?></td>
<td><?php echo $nombre_prof.' '.$apellidos_prof?></td>
<td><?php echo $fecha_dmy?></td>
<td><?php echo $hora?></td>
<?php if ($url_img_foto <> '') { ?>
<td align="center"><a href="../admin/edit_cargar_foto.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/existe_archivo.png" class="img-polaroid" alt=""></a></td>
<?php } else { ?>
<td align="center"><a href="../admin/edit_cargar_foto.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/no_existe_archivo.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<?php if ($url_img_firma_orig <> '') { ?>
<td align="center"><a href="../admin/edit_cargar_firma.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/existe_firma.png" class="img-polaroid" alt=""></a></td>
<?php } else { ?>
<td align="center"><a href="../admin/edit_cargar_firma.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/no_existe_firma.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<td align="center"><a href="../admin/ver_historial_clinico_version_pdf_mejorada.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>

<td align="center"><a href="../admin/enviar_historia_clinica_correo.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>" target="_blank"><img src="../imagenes/email.png" class="img-polaroid" alt=""></a></td>
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