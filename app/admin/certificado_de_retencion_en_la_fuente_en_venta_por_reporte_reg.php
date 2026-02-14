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

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_administrador                  = ($_SESSION['cod_administrador']);
/* --------------------------------------------------------------------------------------------------------------------------------- */
$cod_servicio_propina                                           = '22222222';
$cod_servicio_cava                                              = '55555555';
$cod_servicio_domicilio                                         = '44444444';
$cod_servicio_descuento_punto_redimible                         = '11112222';
$cod_servicio_descuento                                         = '33333333';
$cod_servicio_imp_bolsa                                         = '11111111';
$cod_servicio_retefuente                                        = '11113333';
/* --------------------------------------------------------------------------------------------------------------------------------- */
if (isset($_GET["cod_tercero"])) {

	$fecha_ymd_venta_producto_ini                         = addslashes($_GET['fecha_ymd_venta_producto_ini']);
	$fecha_ymd_venta_producto_fin                         = addslashes($_GET['fecha_ymd_venta_producto_fin']);
	$cod_tercero                                          = intval($_GET['cod_tercero']);
	$nombre_tipo_factura                                  = addslashes($_GET['nombre_tipo_factura']);
	$nombre_certificado_retefuente                        = addslashes($_GET['nombre_certificado_retefuente']);
	$nombre_origen_modulo                                 = addslashes($_GET['nombre_origen_modulo']);
	$nombre_origen_creacion                               = addslashes($_GET['nombre_origen_creacion']);

	$cabecera_certificado_retefuente                      = $cabecera_emp;
	$propietario_nit_certificado_retefuente               = $propietario_nit_emp;
	$telefono_certificado_retefuente                      = $telefono_emp;
	$correo_certificado_retefuente                        = $correo_emp;
	$direccion_certificado_retefuente                     = $direccion_emp;
	$localidad_certificado_retefuente                     = $localidad_emp;

	if ($cod_tercero==0) {
	    $filtro_consulta_tercero = "";
	    $filtro_consulta_tercero_rel = "";
	    $filtro_consulta_tercero_productos_rel = "";
	} else {
	    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
	    $filtro_consulta_tercero_rel = "AND (tbl15_info_factura_venta.cod_tercero = '$cod_tercero')";
	    $filtro_consulta_tercero_productos_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
	}

	if ($nombre_tipo_factura=="0") {
	    $filtro_consulta_nombre_tipo_factura = "";
	    $filtro_consulta_nombre_tipo_factura_rel = "";
	} else {
	    $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
	    $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_info_factura_venta.nombre_tipo_factura = '$nombre_tipo_factura')";
	}


	$sql_autoincremento_certificado_retefuente = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_certificado_retefuente'";
	$exec_autoincremento_certificado_retefuente = mysqli_query($conectar, $sql_autoincremento_certificado_retefuente) or die(mysqli_error($conectar));
	$datos_autoincremento_certificado_retefuente = mysqli_fetch_assoc($exec_autoincremento_certificado_retefuente);
	$cod_certificado_retefuente = $datos_autoincremento_certificado_retefuente['AUTO_INCREMENT'];

    $subtotal_base_retencion_auxiliar                               = 0;
    $total_rete_fuente_valor_retenido_auxiliar                      = 0;
    $subtotal_base_retencion                                        = 0;
    $total_rete_fuente_valor_retenido                               = 0;

    $sql_info_venta = "SELECT cod_info_factura_venta, retefuente_ptj, total_retefuente FROM tbl15_info_factura_venta 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_estado_factura = 'CERRADA') AND (retefuente_ptj <> '0') $filtro_consulta_tercero $filtro_consulta_nombre_tipo_factura";
    $consulta_info_venta = mysqli_query($conectar, $sql_info_venta) or die(mysqli_error($conectar));
    while ($datos_info_venta = mysqli_fetch_assoc($consulta_info_venta)) {

        $cod_info_factura_venta                      = $datos_info_venta['cod_info_factura_venta'];
        $retefuente_ptj                              = $datos_info_venta['retefuente_ptj'];
        $total_retefuente                            = $datos_info_venta['total_retefuente'];

        $sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_retencion 
        FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
        AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible') AND (cod_producto_barra <> '$cod_servicio_retefuente')";
        $resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
        $info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

        $subtotal_base_retencion_auxiliar                           = $info_retefuente_en_factura['subtotal_base_retencion'];
        $total_rete_fuente_valor_retenido_auxiliar                  = $subtotal_base_retencion_auxiliar * ($retefuente_ptj/100);
        $subtotal_base_retencion                                   += $subtotal_base_retencion_auxiliar;
        $total_rete_fuente_valor_retenido                          += $total_rete_fuente_valor_retenido_auxiliar;
    }

	//$nombre_certificado_retefuente                        = "RETENCIÓN APLICADA A VENTAS DECLARANTES";
	$fecha_ini_certificado_retefuente                     = $fecha_ymd_venta_producto_ini;
	$fecha_fin_certificado_retefuente                     = $fecha_ymd_venta_producto_fin;
	$fecha_generacion_documento_certificado_retefuente 	  = date("Y-m-d");
	$hora_generacion_documento_certificado_retefuente     = date("H:i:s");
	$nombre_rete_fuente_ptj 	                          = "2.5";
	$subtotal_base_retencion 	                          = $subtotal_base_retencion;
	$total_retefuente_valor_retenido 	                  = $total_rete_fuente_valor_retenido;
	$fecha_creacion 		                              = date("Y-m-d H:i:s");
	$cod_estado                                           = 0;

	$sql_data = "INSERT INTO tbl15_certificado_retefuente (cod_tercero, nombre_certificado_retefuente, fecha_ini_certificado_retefuente, fecha_fin_certificado_retefuente, 
	fecha_generacion_documento_certificado_retefuente, hora_generacion_documento_certificado_retefuente, nombre_rete_fuente_ptj, subtotal_base_retencion, 
	total_retefuente_valor_retenido, fecha_creacion, cod_estado, cabecera_certificado_retefuente, propietario_nit_certificado_retefuente, 
	telefono_certificado_retefuente, correo_certificado_retefuente, direccion_certificado_retefuente, 
	localidad_certificado_retefuente, nombre_origen_modulo, nombre_origen_creacion) 
	VALUES ('$cod_tercero', '$nombre_certificado_retefuente', '$fecha_ini_certificado_retefuente', '$fecha_fin_certificado_retefuente', 
	'$fecha_generacion_documento_certificado_retefuente', '$hora_generacion_documento_certificado_retefuente', '$nombre_rete_fuente_ptj', '$subtotal_base_retencion', 
	'$total_retefuente_valor_retenido', '$fecha_creacion', '$cod_estado', '$cabecera_certificado_retefuente', '$propietario_nit_certificado_retefuente', 
	'$telefono_certificado_retefuente', '$correo_certificado_retefuente', '$direccion_certificado_retefuente', 
	'$localidad_certificado_retefuente', '$nombre_origen_modulo', '$nombre_origen_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_certificado_retencion_en_la_fuente_venta.php?cod_certificado_retefuente=<?php echo $cod_certificado_retefuente?>">
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