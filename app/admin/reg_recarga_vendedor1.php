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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
 <!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Usuario</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_administrador             = intval($_GET['cod_administrador']);
$pagina                        = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cedula                                                              = $matriz_consulta['cedula'];
$nombres                                                             = $matriz_consulta['nombres'];
$apellidos                                                           = $matriz_consulta['apellidos'];
$cuenta                                                              = $matriz_consulta['cuenta'];
$correo                                                              = $matriz_consulta['correo'];
$cod_seguridad                                                       = $matriz_consulta['cod_seguridad'];
$nombre_sexo                                                         = $matriz_consulta['nombre_sexo'];
$telefono                                                            = $matriz_consulta['telefono'];
$cod_tipo_historia_clinica                                           = $matriz_consulta['cod_tipo_historia_clinica'];
$url_img_firma_prof_min                                              = $matriz_consulta['url_img_firma_prof_min'];
$url_img_firma_prof_ori                                              = $matriz_consulta['url_img_firma_prof_ori'];
$reg_medico                                                          = $matriz_consulta['reg_medico'];
$licencia                                                            = $matriz_consulta['licencia'];
$tarjeta_profesional                                                 = $matriz_consulta['tarjeta_profesional'];
$especialidad                                                        = $matriz_consulta['especialidad'];
$especialidad2                                                       = $matriz_consulta['especialidad2'];
$universidad                                                         = $matriz_consulta['universidad'];
$nombre_maquina                                                      = $matriz_consulta['nombre_maquina'];
$nombre_impresora                                                    = $matriz_consulta['nombre_impresora'];
$cod_caja                                                            = $matriz_consulta['cod_caja'];
$total_base_cierre_caja                                              = $matriz_consulta['total_base_cierre_caja'];
$cod_dependencia_user                                                = $matriz_consulta['cod_dependencia_user'];
$nombre_tipo_precio_venta_predet_user                                = $matriz_consulta['nombre_tipo_precio_venta_predet_user'];
$numero_precio_user                                                  = $matriz_consulta['numero_precio_user'];
$cod_tipo_aplicacion                                                 = $matriz_consulta['cod_tipo_aplicacion'];
$cod_origen_produccion_user                                          = $matriz_consulta['cod_origen_produccion_user'];
$num_max_caja_mesa_usuario                                           = $matriz_consulta['num_max_caja_mesa_usuario'];
$url_pag_redirec_ini_sesion                                          = $matriz_consulta['url_pag_redirec_ini_sesion'];
$limite_max_venta_temp_por_caja_mesa_usuario                         = $matriz_consulta['limite_max_venta_temp_por_caja_mesa_usuario'];
$total_saldo_recarga                                                 = $matriz_consulta['total_saldo_recarga'];

if ($nombre_maquina == '') { $nombre_maquina = gethostname(); } else { $nombre_maquina = $matriz_consulta['nombre_maquina']; }
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/reg_recarga_vendedor_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">DOCUMENTO</th>
		<th style="text-align:center">NOMBRES</th>
		<th style="text-align:center">APELLIDOS</th>
		<th style="text-align:center">USUARIO</th>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo ($cedula) ?></td>
		<td style="text-align:center"><?php echo ($nombres) ?></td>
		<td style="text-align:center"><?php echo ($apellidos) ?></td>
		<td style="text-align:center"><?php echo ($cuenta) ?></td>
	</tr>
</table>

<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center">SALDO RECARGA</th>
		<th style="text-align:center">NUEVA RECARGA</th>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo number_format($total_saldo_recarga, 0, ",", ".") ?></td>
		<td style="text-align:center"><input type="number" name="recarga_actual" value="" class="input-block-level" min="1" max="999999" style="width: 200px;" required/></td>
	</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
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
 <!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>