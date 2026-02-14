<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_libre.php'); ?>
<?php include_once('../admin/class_php/funcion_cryptor_descryptor_class.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/fondo_login.css" rel="stylesheet">-->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../menu/03_menu_navegacion_libre_entrar.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div class="imagen_fondo_login"></div>
<div class="container-fluid h-100  content">

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_certificado_apoyo_emocional_codifcryp'])) {

	$cod_certificado_apoyo_emocional_codifcryp                         = ($_GET['cod_certificado_apoyo_emocional_codifcryp']);
	$cod_certificado_apoyo_emocional_codif                             = DAXCODIFCRYPTOR::descriptardax($cod_certificado_apoyo_emocional_codifcryp);
	$cod_certificado_apoyo_emocional                                   = intval(DAXCODIFCRYPTOR::descodifdax($cod_certificado_apoyo_emocional_codif));

	$sql_certificado_apoyo_emocional = "SELECT * FROM tbl15_certificado_apoyo_emocional WHERE (cod_certificado_apoyo_emocional = '$cod_certificado_apoyo_emocional')";
	$consulta_certificado_apoyo_emocional = mysqli_query($conectar, $sql_certificado_apoyo_emocional) or die(mysqli_error($conectar));
	$matriz_certificado_apoyo_emocional = mysqli_fetch_assoc($consulta_certificado_apoyo_emocional);

	$cod_certificado_apoyo_emocional                                             = $matriz_certificado_apoyo_emocional['cod_certificado_apoyo_emocional'];
	$nombre_certificado_apoyo_emocional                                          = $matriz_certificado_apoyo_emocional['nombre_certificado_apoyo_emocional'];
	$descripcion_certificado_apoyo_emocional                                     = $matriz_certificado_apoyo_emocional['descripcion_certificado_apoyo_emocional'];
	$estructura_todo_certificado_apoyo_emocional_esp                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_esp'];
	$estructura_todo_certificado_apoyo_emocional_eng                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_eng'];
	$estructura_titulo_certificado_apoyo_emocional_esp                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_esp'];
	$estructura_profesional_certificado_apoyo_emocional_esp                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_esp'];
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_esp'];
	$estructura_justificacion_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_esp'];
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_esp'];
	$estructura_vigencia_certificado_apoyo_emocional_esp                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_esp'];
	$estructura_titulo_certificado_apoyo_emocional_eng                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_eng'];
	$estructura_profesional_certificado_apoyo_emocional_eng                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_eng'];
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_eng'];
	$estructura_justificacion_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_eng'];
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_eng'];
	$estructura_vigencia_certificado_apoyo_emocional_eng                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_eng'];
	$nombre_mascota                                                              = $matriz_certificado_apoyo_emocional['nombre_mascota'];
	$edad_mascota                                                                = $matriz_certificado_apoyo_emocional['edad_mascota'];
	$unidad_medida_edad_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_edad_mascota'];
	$nombre_raza_mascota                                                         = $matriz_certificado_apoyo_emocional['nombre_raza_mascota'];
	$color_mascota                                                               = $matriz_certificado_apoyo_emocional['color_mascota'];
	$peso_mascota                                                                = $matriz_certificado_apoyo_emocional['peso_mascota'];
	$unidad_medida_peso_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_peso_mascota'];
	$talla_mascota                                                               = $matriz_certificado_apoyo_emocional['talla_mascota'];
	$nombre_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['nombre_propietario_mascota'];
	$documento_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['documento_propietario_mascota'];
	$direccion_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['direccion_propietario_mascota'];
	$correo_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['correo_propietario_mascota'];
	$fecha_certificado_apoyo_emocional                                           = $matriz_certificado_apoyo_emocional['fecha_certificado_apoyo_emocional'];
	$hora_certificado_apoyo_emocional                                            = $matriz_certificado_apoyo_emocional['hora_certificado_apoyo_emocional'];
	$fecha_creacion_certificado_apoyo_emocional                                  = $matriz_certificado_apoyo_emocional['fecha_creacion_certificado_apoyo_emocional'];
	$fecha_modificacion_certificado_apoyo_emocional                              = $matriz_certificado_apoyo_emocional['fecha_modificacion_certificado_apoyo_emocional'];
	$cuenta                                                                      = $matriz_certificado_apoyo_emocional['cuenta'];
	$cod_administrador                                                           = $matriz_certificado_apoyo_emocional['cod_administrador'];
	$cod_estado                                                                  = $matriz_certificado_apoyo_emocional['cod_estado'];
?>
<div class="ibod">
<div class="fcontacto">

	<div class="table-responsive">

	<table class="table table-striped">
	  <tr>
	    <td style="text-align:center;"><font color='black' size= "+1">La informacion ha sido enviada correctamente.</font></td>
	  </tr>
	</table>

	<table class="table table-striped">
	  <tr>
	    <td><font color='black' size= "+1">Nombres y Apellidos:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+1"><?php echo $nombre_propietario_mascota; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+1">Nombre de la Mascota:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+1"><?php echo $nombre_mascota; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+1">Raza de la Mascota:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+1"><?php echo $nombre_raza_mascota; ?></font></td>
	  </tr>
	  <tr>
	    <td><font color='black' size= "+1">Fecha del Envio:</font></td>
	    <td style="text-align:right;" colspan="2"><font color='black' size= "+1"><?php echo $fecha_creacion_certificado_apoyo_emocional; ?></font></td>
	  </tr>
	</table>

	<table class="table table-striped">
	  <tr>
	    <td style="text-align:center;"><a href="../admin/notificar_por_whatapp_certificado_apoyo_emocional_extern.php?cod_certificado_apoyo_emocional_codifcryp=<?php echo $cod_certificado_apoyo_emocional_codifcryp; ?>" id="listo"><img src="../imagenes/btn_tel_whatapp_solo.png" /><br>Notificar Por WhatsApp</a></td>
	  </tr>
	</table>
	</div>
	
</div>
</div>
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