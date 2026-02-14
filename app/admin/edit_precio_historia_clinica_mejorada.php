<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--</head>
<body id="pageBody">-->
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); 
$pagina_local = $_SERVER['PHP_SELF'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Precio Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy                = date("Y/m/d");
$fecha_hoy_time           = strtotime(date("Y/m/d"));
$cod_historia_clinica     = intval($_GET['cod_historia_clinica']);
$cod_cliente              = intval($_GET['cod_cliente']);

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, tbl15_historia_clinica.cod_factura,
tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_historia_clinica.motivo, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$cedula                       = $info_historia_clinica['cedula'];
$nombres_cli                  = $info_historia_clinica['nombres'];
$apellido1_cli                = $info_historia_clinica['apellido1'];
$apellido2_cli                = $info_historia_clinica['apellido2'];
$motivo                       = $info_historia_clinica['motivo'];
$costo_motivo_consulta        = $info_historia_clinica['costo_motivo_consulta'];
$cod_factura                  = $info_historia_clinica['cod_factura'];
$nombres_completos            = $nombres_cli.' '.$apellido1_cli;
$url_img_foto_min_cli         = $info_historia_clinica['url_img_foto_min_cli'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_precio_historia_clinica_mejorada_reg.php">
 <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%">
	<thead><tr>
		<th valign="middle">
			<img src="<?php echo $url_img_foto_min_cli ?>" class="img-thumbnail" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/>
		</th>
	</tr></thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead><tr>
<th bgcolor="#FAC090">IDENTIFICACIÓN</th>
<th bgcolor="#FAC090">NOMBRES</th>
<th bgcolor="#FAC090">APELLIDOS</th>
</tr></thead>
<tbody><tr>
<td style="text-align:center"><?php echo $cedula ?></td>
<td style="text-align:center"><?php echo $nombres_cli ?></td>
<td style="text-align:center"><?php echo $apellido1_cli ?></td>
</tr></tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
<thead>
<tr>
<td style="text-align:center" bgcolor="#FAC090"><strong>TIPO DE EXAMEN A REALIZAR O EVALUACIÓN</strong></td>
<td style="text-align:center" bgcolor="#FAC090"><strong>COSTO EVALUACIÓN</strong></td>
<td style="text-align:center" bgcolor="#FAC090"><strong>FACTURA</strong></td>
</tr>
<tr>
<td style="text-align:center"><?php echo $motivo ?></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="costo_motivo_consulta" type="number" value="<?php echo $costo_motivo_consulta ?>" required/></td>
<td style="text-align:center"><input style="text-align:center" class="input-block-level" name="cod_factura" type="number" value="<?php echo $cod_factura ?>" required/></td>
</tr>
</thead>
<tbody></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="fecha_dmy" value="<?php echo $fecha_hoy ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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