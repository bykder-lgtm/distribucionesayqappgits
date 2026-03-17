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

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	$cod_administrador                                    = intval($_POST['cod_administrador']);
	$cedula                                               = addslashes($_POST['cedula']);
	$nombres                                              = addslashes($_POST['nombres']);
	$apellidos                                            = addslashes($_POST['apellidos']);
	$cuenta                                               = stripslashes($_POST['cuenta']);
	$cod_seguridad                                        = intval($_POST['cod_seguridad']);
	$correo                                               = addslashes($_POST["correo"]);
	$cod_tipo_historia_clinica                            = intval($_POST['cod_tipo_historia_clinica']);
	$telefono                                             = addslashes($_POST["telefono"]);
	$pagina                                               = addslashes($_POST['pagina']);
	$reg_medico                                           = addslashes($_POST["reg_medico"]);
	$nombre_maquina                                       = addslashes($_POST["nombre_maquina"]);
	$nombre_impresora                                     = addslashes($_POST["nombre_impresora"]);
	$cod_caja                                             = intval($_POST['cod_caja']);
	$total_base_cierre_caja                               = intval($_POST['total_base_cierre_caja']);
	$cod_dependencia_user                                 = intval($_POST['cod_dependencia_user']);
	$nombre_tipo_precio_venta_predet_user                 = addslashes($_POST['nombre_tipo_precio_venta_predet_user']);
	$numero_precio_user                                   = intval($_POST['numero_precio_user']);
	$cod_tipo_aplicacion                                  = intval($_POST['cod_tipo_aplicacion']);
	$cod_origen_produccion_user                           = intval($_POST['cod_origen_produccion_user']);
	$num_max_caja_mesa_usuario                            = intval($_POST['num_max_caja_mesa_usuario']);

	// Obtener dinámicamente la URL de redirección basada en el rol seleccionado (cod_seguridad)
	$sql_url_seg = "SELECT url_pag_redirec_ini_sesion FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad'";
	$res_url_seg = mysqli_query($conectar, $sql_url_seg);
	$url_pag_redirec_ini_sesion = '';
	
	if ($res_url_seg && $row_url = mysqli_fetch_assoc($res_url_seg)) { $url_pag_redirec_ini_sesion = $row_url['url_pag_redirec_ini_sesion']; }

	$limite_max_venta_temp_por_caja_mesa_usuario          = intval($_POST['limite_max_venta_temp_por_caja_mesa_usuario']);
	$comision_funcionamiento_interes_propio_empresa_ptj   = addslashes($_POST['comision_funcionamiento_interes_propio_empresa_ptj']);

	if (isset($_POST['total_saldo_recarga'])) { $total_saldo_recarga = addslashes($_POST['total_saldo_recarga']); } else { $total_saldo_recarga = ''; }
	if (isset($_POST['cod_tienda'])) { $cod_tienda = addslashes($_POST['cod_tienda']); } else { $cod_tienda = '0'; }

	$identificacion_tercero                               = $cedula;
	$nombre1_tercero                                      = $nombres;
	$apellido1_tercero                                    = $apellidos;
	$telefono1_tercero                                    = $telefono;
	$correo_tercero                                       = $correo;

	$sql_data = sprintf("UPDATE tbl15_administrador SET cedula = '$cedula', nombres = UPPER('$nombres'), apellidos = UPPER('$apellidos'), cuenta = '$cuenta', correo = '$correo', 
	cod_seguridad = '$cod_seguridad', telefono = '$telefono', cod_tipo_historia_clinica = '$cod_tipo_historia_clinica', reg_medico = '$reg_medico', 
	nombre_maquina = '$nombre_maquina', nombre_impresora = '$nombre_impresora', cod_caja = '$cod_caja', total_base_cierre_caja = '$total_base_cierre_caja', 
	cod_dependencia_user = '$cod_dependencia_user', nombre_tipo_precio_venta_predet_user = '$nombre_tipo_precio_venta_predet_user', numero_precio_user = '$numero_precio_user', 
	cod_tipo_aplicacion = '$cod_tipo_aplicacion', cod_origen_produccion_user = '$cod_origen_produccion_user', num_max_caja_mesa_usuario = '$num_max_caja_mesa_usuario', 
	limite_max_venta_temp_por_caja_mesa_usuario = '$limite_max_venta_temp_por_caja_mesa_usuario', url_pag_redirec_ini_sesion = '$url_pag_redirec_ini_sesion', total_saldo_recarga = '$total_saldo_recarga', 
	identificacion_tercero = '$identificacion_tercero', nombre1_tercero = '$nombre1_tercero', apellido1_tercero = '$apellido1_tercero', telefono1_tercero = '$telefono1_tercero', 
	correo_tercero = '$correo_tercero', cod_tienda = '$cod_tienda', comision_funcionamiento_interes_propio_empresa_ptj = '$comision_funcionamiento_interes_propio_empresa_ptj'
	WHERE cod_administrador = '$cod_administrador'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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