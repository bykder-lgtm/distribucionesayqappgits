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
$pagina                             = addslashes($_POST['pagina']);
$fecha_copia_inventario             = date("Y-m-d");
$hora_copia_inventario              = date("H:i:s");
$fecha_creacion                     = date("Y-m-d");
$nombre_tipo_inventario             = "COMPLETO_VERSION";
$nombre_letra_alfabeto              = "TODAS";
//*************************************************************************************************************************//
if (isset($_POST['si'])) {

$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_producto_copia_inventario'";
$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar2));
$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);

$cod_info_producto_copia_inventario = $datos_autoincremento_sesion['AUTO_INCREMENT'];
//*************************************************************************************************************************//
$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_reg, SUM(precio_compra_producto * und_producto) AS total_precio_compra_producto_inv_viejo, 
SUM(precio_costo_producto * und_producto) AS total_precio_costo_producto_inv_viejo, SUM(precio_venta_producto * und_producto) AS total_precio_venta_producto_inv_viejo, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$total_reg                                      = $datos_conteo_atendido_mujer['total_reg'];
$total_precio_compra_producto_inv_viejo         = $datos_conteo_atendido_mujer['total_precio_compra_producto_inv_viejo'];
$total_precio_costo_producto_inv_viejo          = $datos_conteo_atendido_mujer['total_precio_costo_producto_inv_viejo'];
$total_precio_venta_producto_inv_viejo          = $datos_conteo_atendido_mujer['total_precio_venta_producto_inv_viejo'];
$total_compra_producto_bodega                   = $datos_conteo_atendido_mujer['total_compra_producto_bodega'];
$total_venta_producto_bodega                    = $datos_conteo_atendido_mujer['total_venta_producto_bodega'];
$cod_estado                                     = 0;
//*************************************************************************************************************************//

$sql_data = "INSERT INTO tbl15_info_producto_copia_inventario (total_reg, total_precio_compra_producto_inv_viejo, total_precio_costo_producto_inv_viejo, total_precio_venta_producto_inv_viejo, 
fecha_copia_inventario, hora_copia_inventario, cod_administrador, fecha_creacion, nombre_tipo_inventario, nombre_letra_alfabeto) 
VALUES ('$total_reg', '$total_precio_compra_producto_inv_viejo', '$total_precio_costo_producto_inv_viejo', '$total_precio_venta_producto_inv_viejo', 
'$fecha_copia_inventario', '$hora_copia_inventario', '$cod_administrador', '$fecha_creacion', '$nombre_tipo_inventario', '$nombre_letra_alfabeto')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//*************************************************************************************************************************//
$sql_data = "INSERT INTO tbl15_producto_copia_inventario (
cod_info_producto_copia_inventario, cod_producto, cod_estado_subproducto, cod_producto_barra, nombre_producto, und_producto_viejo, und_producto_bodega, precio_compra_producto, 
precio_costo_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
total_precio_venta_producto, total_precio_costo_producto, nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, iva_ptj, nombre_tipo_producto, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, cod_marca, cod_proveedor, cod_tercero, cod_estado, cod_dependencia, 
fecha_ult_compra, fecha_ult_venta, fecha_vencimiento1, vencimiento_lote1, fecha_vencimiento2, vencimiento_lote2, tope_min, fecha_creacion, fecha_modificacion, 
cuenta, cod_info_factura_compra, nombre_tipo_precio, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, comision_ptj, und_unidades, und_caja, 
dto1, dto2, ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, iva_teorico_ptj, tarifa_rete_vigente_ptj, rete_iva_asumido_ptj, nombre_tipo_compra, 
nombre_tipo_cargue_factura, nombre_tipo_medida, cajas_sobre, und_sobre, cod_interno, cod_original, codificacion, cod_producto_serial, fecha_vencimiento, 
lote_vencimiento, fecha_mantenimiento, cod_rodeo, nombre_rodeo, nombre_sexo, de_monta, nombre_estatus, nombre_condicion_corporal, nombre_categoria_ingreso, 
nombre_categoria_actual, nombre_categoria_futura, nombre_procedencia, nombre_tipo_monta, nombre_lote_categoria, nombre_prog_reproductivo, nombre_potrero, nombre_lote, 
nombre_calidad_animal, nombre_tipo_explotacion, peso_compra, precio_compra, nombre_propietario, fecha_nac, fecha_compra, fecha_castracion, nro_hierros, 
hierro_animal, numero_partos, id_electronica, nombre_raza, nombre_raza1, nombre_raza2, nombre_raza3, nombre_raza4, ptj_raza1, ptj_raza2, ptj_raza3, 
ptj_raza4, id_padre, raza_padre, id_madre, raza_madre, partos_madre, id_abuelo_paterno, id_abuelo_materno, nombre_abuelo_paterno, nombre_abuelo_materno, 
raza_abuelo_paterno, raza_abuelo_materno, id_abuela_paterno, id_abuela_materno, nombre_abuela_paterno, nombre_abuela_materno, raza_abuela_paterno, 
raza_abuela_materno, nombre_tipo_concepcion, nombre_especie, marcas_tatuado, marcas_herrado, marcas_descornado, marcas_castrado, nombre_color, nombre_temperamento, 
peso_nacer, aplomo_corvejon, aplomo_cuartilla, aplomo_cascos, genital_circun_escrotal, genital_prepusio, genital_potencia, genital_semen, observacion_animal, 
nombre_estado, nombre_tipo_movimiento, nombre_categoria_animal_extern, cod_finca, nombre_finca, nombre_categoria, und_inv, descripcion_producto, 
url_img_producto_min, url_img_producto_orig, nombre_promocion, nombre_promocion_ing, nombre_tipo_inventario, nombre_letra_alfabeto
) 
SELECT 
'$cod_info_producto_copia_inventario', cod_producto, cod_estado_subproducto, cod_producto_barra, nombre_producto, und_producto, und_producto_bodega, precio_compra_producto, 
precio_costo_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
total_precio_venta_producto, total_precio_costo_producto, nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, iva_ptj, nombre_tipo_producto, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, cod_marca, cod_proveedor, cod_tercero, '$cod_estado', cod_dependencia, 
fecha_ult_compra, fecha_ult_venta, fecha_vencimiento1, vencimiento_lote1, fecha_vencimiento2, vencimiento_lote2, tope_min, fecha_creacion, fecha_modificacion, 
'$cod_administrador', cod_info_factura_compra, nombre_tipo_precio, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, comision_ptj, und_unidades, und_caja, 
dto1, dto2, ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, iva_teorico_ptj, tarifa_rete_vigente_ptj, rete_iva_asumido_ptj, nombre_tipo_compra, 
nombre_tipo_cargue_factura, nombre_tipo_medida, cajas_sobre, und_sobre, cod_interno, cod_original, codificacion, cod_producto_serial, fecha_vencimiento, 
lote_vencimiento, fecha_mantenimiento, cod_rodeo, nombre_rodeo, nombre_sexo, de_monta, nombre_estatus, nombre_condicion_corporal, nombre_categoria_ingreso, 
nombre_categoria_actual, nombre_categoria_futura, nombre_procedencia, nombre_tipo_monta, nombre_lote_categoria, nombre_prog_reproductivo, nombre_potrero, nombre_lote, 
nombre_calidad_animal, nombre_tipo_explotacion, peso_compra, precio_compra, nombre_propietario, fecha_nac, fecha_compra, fecha_castracion, nro_hierros, 
hierro_animal, numero_partos, id_electronica, nombre_raza, nombre_raza1, nombre_raza2, nombre_raza3, nombre_raza4, ptj_raza1, ptj_raza2, ptj_raza3, 
ptj_raza4, id_padre, raza_padre, id_madre, raza_madre, partos_madre, id_abuelo_paterno, id_abuelo_materno, nombre_abuelo_paterno, nombre_abuelo_materno, 
raza_abuelo_paterno, raza_abuelo_materno, id_abuela_paterno, id_abuela_materno, nombre_abuela_paterno, nombre_abuela_materno, raza_abuela_paterno, 
raza_abuela_materno, nombre_tipo_concepcion, nombre_especie, marcas_tatuado, marcas_herrado, marcas_descornado, marcas_castrado, nombre_color, nombre_temperamento, 
peso_nacer, aplomo_corvejon, aplomo_cuartilla, aplomo_cascos, genital_circun_escrotal, genital_prepusio, genital_potencia, genital_semen, observacion_animal, 
nombre_estado, nombre_tipo_movimiento, nombre_categoria_animal_extern, cod_finca, nombre_finca, nombre_categoria, und_inv, descripcion_producto, 
url_img_producto_min, url_img_producto_orig, nombre_promocion, nombre_promocion_ing, '$nombre_tipo_inventario', '$nombre_letra_alfabeto' 
FROM tbl15_producto";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; producto_copia_inventario_completo_version2.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
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