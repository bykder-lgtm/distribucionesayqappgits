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
if (isset($_POST['cargar_archivo_csv'])) {

$pagina                                 = addslashes($_POST['pagina']);
$longitudDeLinea                        = 1000;
$delimitador                            = ";"; # Separador de columnas
$caracterCircundante                    = '"'; # A veces los valores son encerrados entre comillas
$contador                               = 0;

$sql_max_cod_guia = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_producto_mas_vendido_externo";
$consulta_max_cod_guia = mysqli_query($conectar, $sql_max_cod_guia) or die(mysqli_error());
$dato_max_cod_guia = mysqli_fetch_assoc($consulta_max_cod_guia);

$cod_guia                             = $dato_max_cod_guia['cod_guia']+1;
//--------------------------------------------------------------------//
$datos_archivo_plano_intern           = array();
//--------------------------------------------------------------------//
$archivo_plano_csv                    = $_FILES['csv']['tmp_name'];
$abrir_archivo_plano_csv              = fopen($archivo_plano_csv,"r");
do {

	$contador++;

	//if ($contador != 1) {
		$cod_producto                  = $datos_archivo_plano_intern[0];
		$cod_producto_barra            = $datos_archivo_plano_intern[1];
		$nombre_producto               = $datos_archivo_plano_intern[2];
		$und_venta                     = $datos_archivo_plano_intern[3];
		$und_producto                  = $datos_archivo_plano_intern[4];
		$precio_venta_producto         = $datos_archivo_plano_intern[5];
		$total_venta_producto          = $datos_archivo_plano_intern[6];
		$fecha_mes_venta_producto      = $datos_archivo_plano_intern[7];
		$nombre_info_empresa           = $datos_archivo_plano_intern[8];

		$data_sql = "INSERT INTO tbl15_producto_mas_vendido_externo (cod_producto, cod_producto_barra, nombre_producto, und_venta, und_producto, precio_venta_producto, total_venta_producto, 
		fecha_mes_venta_producto, nombre_info_empresa, cod_guia, cod_info_hotel_cotizacion_factura_venta)
		VALUES ('".$cod_producto."', '".$cod_producto_barra."', '".$nombre_producto."', '".$und_venta."', '".$und_producto."', '".$precio_venta_producto."', '".$total_venta_producto."', 
		'".$fecha_mes_venta_producto."', '".$nombre_info_empresa."', '".$cod_guia."', '".$contador."')";
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error());
	//}
//--------------------------------------------------------------------//
} while ($datos_archivo_plano_intern = fgetcsv($abrir_archivo_plano_csv, $longitudDeLinea, $delimitador, $caracterCircundante));
fclose($abrir_archivo_plano_csv);

$pagina_redirect = '../admin/productos_mas_vendidos_lista_cargada_detalle.php?cod_guia='.$cod_guia.'&fecha_mes_venta_producto='.$fecha_mes_venta_producto;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
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
