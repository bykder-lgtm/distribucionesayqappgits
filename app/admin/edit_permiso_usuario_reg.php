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

$cod_administrador = intval($_POST['cod_administrador']);
$pagina = addslashes($_POST['pagina']);

if (isset($_POST['cod_estado_prod'])) { $cod_estado_prod = intval($_POST['cod_estado_prod']); } else { $cod_estado_prod = '0'; }
if (isset($_POST['cod_estado_prod_reg_producto'])) { $cod_estado_prod_reg_producto = intval($_POST['cod_estado_prod_reg_producto']); } else { $cod_estado_prod_reg_producto = '0'; }
if (isset($_POST['cod_estado_prod_asig_subproducto'])) { $cod_estado_prod_asig_subproducto = intval($_POST['cod_estado_prod_asig_subproducto']); } else { $cod_estado_prod_asig_subproducto = '0'; }
if (isset($_POST['cod_estado_prod_cargar_factura_compra'])) { $cod_estado_prod_cargar_factura_compra = intval($_POST['cod_estado_prod_cargar_factura_compra']); } else { $cod_estado_prod_cargar_factura_compra = '0'; }
if (isset($_POST['cod_estado_prod_cargar_factura_compra_soporte'])) { $cod_estado_prod_cargar_factura_compra_soporte = intval($_POST['cod_estado_prod_cargar_factura_compra_soporte']); } else { $cod_estado_prod_cargar_factura_compra_soporte = '0'; }
if (isset($_POST['cod_estado_prod_cargar_factura_compra_observacion'])) { $cod_estado_prod_cargar_factura_compra_observacion = intval($_POST['cod_estado_prod_cargar_factura_compra_observacion']); } else { $cod_estado_prod_cargar_factura_compra_observacion = '0'; }
if (isset($_POST['cod_estado_prod_transferencia'])) { $cod_estado_prod_transferencia = intval($_POST['cod_estado_prod_transferencia']); } else { $cod_estado_prod_transferencia = '0'; }
if (isset($_POST['cod_estado_prod_auditoria'])) { $cod_estado_prod_auditoria = intval($_POST['cod_estado_prod_auditoria']); } else { $cod_estado_prod_auditoria = '0'; }
if (isset($_POST['cod_estado_prod_nuevo_invenario'])) { $cod_estado_prod_nuevo_invenario = intval($_POST['cod_estado_prod_nuevo_invenario']); } else { $cod_estado_prod_nuevo_invenario = '0'; }
if (isset($_POST['cod_estado_prod_inventario_producto'])) { $cod_estado_prod_inventario_producto = intval($_POST['cod_estado_prod_inventario_producto']); } else { $cod_estado_prod_inventario_producto = '0'; }
if (isset($_POST['cod_estado_prod_registrar'])) { $cod_estado_prod_registrar = intval($_POST['cod_estado_prod_registrar']); } else { $cod_estado_prod_registrar = '0'; }
if (isset($_POST['cod_estado_prod_editar'])) { $cod_estado_prod_editar = intval($_POST['cod_estado_prod_editar']); } else { $cod_estado_prod_editar = '0'; }
if (isset($_POST['cod_estado_prod_eliminar'])) { $cod_estado_prod_eliminar = intval($_POST['cod_estado_prod_eliminar']); } else { $cod_estado_prod_eliminar = '0'; }
if (isset($_POST['cod_estado_prod_imprimir'])) { $cod_estado_prod_imprimir = intval($_POST['cod_estado_prod_imprimir']); } else { $cod_estado_prod_imprimir = '0'; }
if (isset($_POST['cod_estado_prod_exportar'])) { $cod_estado_prod_exportar = intval($_POST['cod_estado_prod_exportar']); } else { $cod_estado_prod_exportar = '0'; }
if (isset($_POST['cod_estado_prod_subproducto'])) { $cod_estado_prod_subproducto = intval($_POST['cod_estado_prod_subproducto']); } else { $cod_estado_prod_subproducto = '0'; }
if (isset($_POST['cod_estado_prod_und_producto'])) { $cod_estado_prod_und_producto = intval($_POST['cod_estado_prod_und_producto']); } else { $cod_estado_prod_und_producto = '0'; }
if (isset($_POST['cod_estado_prod_und_producto_bodega'])) { $cod_estado_prod_und_producto_bodega = intval($_POST['cod_estado_prod_und_producto_bodega']); } else { $cod_estado_prod_und_producto_bodega = '0'; }
if (isset($_POST['cod_estado_prod_precio_compra_producto'])) { $cod_estado_prod_precio_compra_producto = intval($_POST['cod_estado_prod_precio_compra_producto']); } else { $cod_estado_prod_precio_compra_producto = '0'; }
if (isset($_POST['cod_estado_prod_precio_costo_producto'])) { $cod_estado_prod_precio_costo_producto = intval($_POST['cod_estado_prod_precio_costo_producto']); } else { $cod_estado_prod_precio_costo_producto = '0'; }
if (isset($_POST['cod_estado_prod_precio_venta_producto'])) { $cod_estado_prod_precio_venta_producto = intval($_POST['cod_estado_prod_precio_venta_producto']); } else { $cod_estado_prod_precio_venta_producto = '0'; }
if (isset($_POST['cod_estado_prod_precio_venta_producto2'])) { $cod_estado_prod_precio_venta_producto2 = intval($_POST['cod_estado_prod_precio_venta_producto2']); } else { $cod_estado_prod_precio_venta_producto2 = '0'; }
if (isset($_POST['cod_estado_prod_precio_venta_producto3'])) { $cod_estado_prod_precio_venta_producto3 = intval($_POST['cod_estado_prod_precio_venta_producto3']); } else { $cod_estado_prod_precio_venta_producto3 = '0'; }
if (isset($_POST['cod_estado_prod_precio_venta_producto4'])) { $cod_estado_prod_precio_venta_producto4 = intval($_POST['cod_estado_prod_precio_venta_producto4']); } else { $cod_estado_prod_precio_venta_producto4 = '0'; }
if (isset($_POST['cod_estado_prod_precio_venta_producto5'])) { $cod_estado_prod_precio_venta_producto5 = intval($_POST['cod_estado_prod_precio_venta_producto5']); } else { $cod_estado_prod_precio_venta_producto5 = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_unidad_medida'])) { $cod_estado_prod_nombre_tipo_unidad_medida = intval($_POST['cod_estado_prod_nombre_tipo_unidad_medida']); } else { $cod_estado_prod_nombre_tipo_unidad_medida = '0'; }
if (isset($_POST['cod_estado_prod_iva_ptj'])) { $cod_estado_prod_iva_ptj = intval($_POST['cod_estado_prod_iva_ptj']); } else { $cod_estado_prod_iva_ptj = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_producto'])) { $cod_estado_prod_nombre_tipo_producto = intval($_POST['cod_estado_prod_nombre_tipo_producto']); } else { $cod_estado_prod_nombre_tipo_producto = '0'; }
if (isset($_POST['cod_estado_prod_cod_marca'])) { $cod_estado_prod_cod_marca = intval($_POST['cod_estado_prod_cod_marca']); } else { $cod_estado_prod_cod_marca = '0'; }
if (isset($_POST['cod_estado_prod_cod_proveedor'])) { $cod_estado_prod_cod_proveedor = intval($_POST['cod_estado_prod_cod_proveedor']); } else { $cod_estado_prod_cod_proveedor = '0'; }
if (isset($_POST['cod_estado_prod_cod_tercero'])) { $cod_estado_prod_cod_tercero = intval($_POST['cod_estado_prod_cod_tercero']); } else { $cod_estado_prod_cod_tercero = '0'; }
if (isset($_POST['cod_estado_prod_cod_estado'])) { $cod_estado_prod_cod_estado = intval($_POST['cod_estado_prod_cod_estado']); } else { $cod_estado_prod_cod_estado = '0'; }
if (isset($_POST['cod_estado_prod_cod_dependencia'])) { $cod_estado_prod_cod_dependencia = intval($_POST['cod_estado_prod_cod_dependencia']); } else { $cod_estado_prod_cod_dependencia = '0'; }
if (isset($_POST['cod_estado_prod_fecha_ult_compra'])) { $cod_estado_prod_fecha_ult_compra = intval($_POST['cod_estado_prod_fecha_ult_compra']); } else { $cod_estado_prod_fecha_ult_compra = '0'; }
if (isset($_POST['cod_estado_prod_fecha_ult_venta'])) { $cod_estado_prod_fecha_ult_venta = intval($_POST['cod_estado_prod_fecha_ult_venta']); } else { $cod_estado_prod_fecha_ult_venta = '0'; }
if (isset($_POST['cod_estado_prod_fecha_vencimiento'])) { $cod_estado_prod_fecha_vencimiento = intval($_POST['cod_estado_prod_fecha_vencimiento']); } else { $cod_estado_prod_fecha_vencimiento = '0'; }
if (isset($_POST['cod_estado_prod_tope_min'])) { $cod_estado_prod_tope_min = intval($_POST['cod_estado_prod_tope_min']); } else { $cod_estado_prod_tope_min = '0'; }
if (isset($_POST['cod_estado_prod_fecha_creacion'])) { $cod_estado_prod_fecha_creacion = intval($_POST['cod_estado_prod_fecha_creacion']); } else { $cod_estado_prod_fecha_creacion = '0'; }
if (isset($_POST['cod_estado_prod_fecha_modificacion'])) { $cod_estado_prod_fecha_modificacion = intval($_POST['cod_estado_prod_fecha_modificacion']); } else { $cod_estado_prod_fecha_modificacion = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_precio_venta'])) { $cod_estado_prod_nombre_tipo_precio_venta = intval($_POST['cod_estado_prod_nombre_tipo_precio_venta']); } else { $cod_estado_prod_nombre_tipo_precio_venta = '0'; }
if (isset($_POST['cod_estado_prod_url_img_orig_producto'])) { $cod_estado_prod_url_img_orig_producto = intval($_POST['cod_estado_prod_url_img_orig_producto']); } else { $cod_estado_prod_url_img_orig_producto = '0'; }
if (isset($_POST['cod_estado_prod_url_img_min_producto'])) { $cod_estado_prod_url_img_min_producto = intval($_POST['cod_estado_prod_url_img_min_producto']); } else { $cod_estado_prod_url_img_min_producto = '0'; }
if (isset($_POST['cod_estado_prod_comision_ptj'])) { $cod_estado_prod_comision_ptj = intval($_POST['cod_estado_prod_comision_ptj']); } else { $cod_estado_prod_comision_ptj = '0'; }
if (isset($_POST['cod_estado_prod_dto1'])) { $cod_estado_prod_dto1 = intval($_POST['cod_estado_prod_dto1']); } else { $cod_estado_prod_dto1 = '0'; }
if (isset($_POST['cod_estado_prod_dto2'])) { $cod_estado_prod_dto2 = intval($_POST['cod_estado_prod_dto2']); } else { $cod_estado_prod_dto2 = '0'; }
if (isset($_POST['cod_estado_prod_ipc_ptj'])) { $cod_estado_prod_ipc_ptj = intval($_POST['cod_estado_prod_ipc_ptj']); } else { $cod_estado_prod_ipc_ptj = '0'; }
if (isset($_POST['cod_estado_prod_precio_ipc'])) { $cod_estado_prod_precio_ipc = intval($_POST['cod_estado_prod_precio_ipc']); } else { $cod_estado_prod_precio_ipc = '0'; }
if (isset($_POST['cod_estado_prod_ret_ica_ptj'])) { $cod_estado_prod_ret_ica_ptj = intval($_POST['cod_estado_prod_ret_ica_ptj']); } else { $cod_estado_prod_ret_ica_ptj = '0'; }
if (isset($_POST['cod_estado_prod_iva_teorico_ptj'])) { $cod_estado_prod_iva_teorico_ptj = intval($_POST['cod_estado_prod_iva_teorico_ptj']); } else { $cod_estado_prod_iva_teorico_ptj = '0'; }
if (isset($_POST['cod_estado_prod_tarifa_rete_vigente_ptj'])) { $cod_estado_prod_tarifa_rete_vigente_ptj = intval($_POST['cod_estado_prod_tarifa_rete_vigente_ptj']); } else { $cod_estado_prod_tarifa_rete_vigente_ptj = '0'; }
if (isset($_POST['cod_estado_prod_rete_iva_asumido_ptj'])) { $cod_estado_prod_rete_iva_asumido_ptj = intval($_POST['cod_estado_prod_rete_iva_asumido_ptj']); } else { $cod_estado_prod_rete_iva_asumido_ptj = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_compra'])) { $cod_estado_prod_nombre_tipo_compra = intval($_POST['cod_estado_prod_nombre_tipo_compra']); } else { $cod_estado_prod_nombre_tipo_compra = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_cargue_factura'])) { $cod_estado_prod_nombre_tipo_cargue_factura = intval($_POST['cod_estado_prod_nombre_tipo_cargue_factura']); } else { $cod_estado_prod_nombre_tipo_cargue_factura = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_medida'])) { $cod_estado_prod_nombre_tipo_medida = intval($_POST['cod_estado_prod_nombre_tipo_medida']); } else { $cod_estado_prod_nombre_tipo_medida = '0'; }
if (isset($_POST['cod_estado_prod_cajas_sobre'])) { $cod_estado_prod_cajas_sobre = intval($_POST['cod_estado_prod_cajas_sobre']); } else { $cod_estado_prod_cajas_sobre = '0'; }
if (isset($_POST['cod_estado_prod_und_sobre'])) { $cod_estado_prod_und_sobre = intval($_POST['cod_estado_prod_und_sobre']); } else { $cod_estado_prod_und_sobre = '0'; }
if (isset($_POST['cod_estado_prod_cod_interno'])) { $cod_estado_prod_cod_interno = intval($_POST['cod_estado_prod_cod_interno']); } else { $cod_estado_prod_cod_interno = '0'; }
if (isset($_POST['cod_estado_prod_cod_original'])) { $cod_estado_prod_cod_original = intval($_POST['cod_estado_prod_cod_original']); } else { $cod_estado_prod_cod_original = '0'; }
if (isset($_POST['cod_estado_prod_codificacion'])) { $cod_estado_prod_codificacion = intval($_POST['cod_estado_prod_codificacion']); } else { $cod_estado_prod_codificacion = '0'; }
if (isset($_POST['cod_estado_prod_cod_producto_serial'])) { $cod_estado_prod_cod_producto_serial = intval($_POST['cod_estado_prod_cod_producto_serial']); } else { $cod_estado_prod_cod_producto_serial = '0'; }
if (isset($_POST['cod_estado_prod_fecha_mantenimiento'])) { $cod_estado_prod_fecha_mantenimiento = intval($_POST['cod_estado_prod_fecha_mantenimiento']); } else { $cod_estado_prod_fecha_mantenimiento = '0'; }
if (isset($_POST['cod_estado_prod_peso_producto'])) { $cod_estado_prod_peso_producto = intval($_POST['cod_estado_prod_peso_producto']); } else { $cod_estado_prod_peso_producto = '0'; }
if (isset($_POST['cod_estado_prod_cod_rodeo'])) { $cod_estado_prod_cod_rodeo = intval($_POST['cod_estado_prod_cod_rodeo']); } else { $cod_estado_prod_cod_rodeo = '0'; }
if (isset($_POST['cod_estado_prod_nombre_rodeo'])) { $cod_estado_prod_nombre_rodeo = intval($_POST['cod_estado_prod_nombre_rodeo']); } else { $cod_estado_prod_nombre_rodeo = '0'; }
if (isset($_POST['cod_estado_prod_nombre_sexo'])) { $cod_estado_prod_nombre_sexo = intval($_POST['cod_estado_prod_nombre_sexo']); } else { $cod_estado_prod_nombre_sexo = '0'; }
if (isset($_POST['cod_estado_prod_de_monta'])) { $cod_estado_prod_de_monta = intval($_POST['cod_estado_prod_de_monta']); } else { $cod_estado_prod_de_monta = '0'; }
if (isset($_POST['cod_estado_prod_nombre_estatus'])) { $cod_estado_prod_nombre_estatus = intval($_POST['cod_estado_prod_nombre_estatus']); } else { $cod_estado_prod_nombre_estatus = '0'; }
if (isset($_POST['cod_estado_prod_nombre_condicion_corporal'])) { $cod_estado_prod_nombre_condicion_corporal = intval($_POST['cod_estado_prod_nombre_condicion_corporal']); } else { $cod_estado_prod_nombre_condicion_corporal = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria_ingreso'])) { $cod_estado_prod_nombre_categoria_ingreso = intval($_POST['cod_estado_prod_nombre_categoria_ingreso']); } else { $cod_estado_prod_nombre_categoria_ingreso = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria_actual'])) { $cod_estado_prod_nombre_categoria_actual = intval($_POST['cod_estado_prod_nombre_categoria_actual']); } else { $cod_estado_prod_nombre_categoria_actual = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria_futura'])) { $cod_estado_prod_nombre_categoria_futura = intval($_POST['cod_estado_prod_nombre_categoria_futura']); } else { $cod_estado_prod_nombre_categoria_futura = '0'; }
if (isset($_POST['cod_estado_prod_nombre_procedencia'])) { $cod_estado_prod_nombre_procedencia = intval($_POST['cod_estado_prod_nombre_procedencia']); } else { $cod_estado_prod_nombre_procedencia = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_monta'])) { $cod_estado_prod_nombre_tipo_monta = intval($_POST['cod_estado_prod_nombre_tipo_monta']); } else { $cod_estado_prod_nombre_tipo_monta = '0'; }
if (isset($_POST['cod_estado_prod_nombre_lote_categoria'])) { $cod_estado_prod_nombre_lote_categoria = intval($_POST['cod_estado_prod_nombre_lote_categoria']); } else { $cod_estado_prod_nombre_lote_categoria = '0'; }
if (isset($_POST['cod_estado_prod_nombre_prog_reproductivo'])) { $cod_estado_prod_nombre_prog_reproductivo = intval($_POST['cod_estado_prod_nombre_prog_reproductivo']); } else { $cod_estado_prod_nombre_prog_reproductivo = '0'; }
if (isset($_POST['cod_estado_prod_nombre_potrero'])) { $cod_estado_prod_nombre_potrero = intval($_POST['cod_estado_prod_nombre_potrero']); } else { $cod_estado_prod_nombre_potrero = '0'; }
if (isset($_POST['cod_estado_prod_nombre_lote'])) { $cod_estado_prod_nombre_lote = intval($_POST['cod_estado_prod_nombre_lote']); } else { $cod_estado_prod_nombre_lote = '0'; }
if (isset($_POST['cod_estado_prod_nombre_calidad_animal'])) { $cod_estado_prod_nombre_calidad_animal = intval($_POST['cod_estado_prod_nombre_calidad_animal']); } else { $cod_estado_prod_nombre_calidad_animal = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_explotacion'])) { $cod_estado_prod_nombre_tipo_explotacion = intval($_POST['cod_estado_prod_nombre_tipo_explotacion']); } else { $cod_estado_prod_nombre_tipo_explotacion = '0'; }
if (isset($_POST['cod_estado_prod_peso_compra'])) { $cod_estado_prod_peso_compra = intval($_POST['cod_estado_prod_peso_compra']); } else { $cod_estado_prod_peso_compra = '0'; }
if (isset($_POST['cod_estado_prod_precio_compra'])) { $cod_estado_prod_precio_compra = intval($_POST['cod_estado_prod_precio_compra']); } else { $cod_estado_prod_precio_compra = '0'; }
if (isset($_POST['cod_estado_prod_fecha_nac'])) { $cod_estado_prod_fecha_nac = intval($_POST['cod_estado_prod_fecha_nac']); } else { $cod_estado_prod_fecha_nac = '0'; }
if (isset($_POST['cod_estado_prod_fecha_compra'])) { $cod_estado_prod_fecha_compra = intval($_POST['cod_estado_prod_fecha_compra']); } else { $cod_estado_prod_fecha_compra = '0'; }
if (isset($_POST['cod_estado_prod_fecha_castracion'])) { $cod_estado_prod_fecha_castracion = intval($_POST['cod_estado_prod_fecha_castracion']); } else { $cod_estado_prod_fecha_castracion = '0'; }
if (isset($_POST['cod_estado_prod_nro_hierros'])) { $cod_estado_prod_nro_hierros = intval($_POST['cod_estado_prod_nro_hierros']); } else { $cod_estado_prod_nro_hierros = '0'; }
if (isset($_POST['cod_estado_prod_hierro_animal'])) { $cod_estado_prod_hierro_animal = intval($_POST['cod_estado_prod_hierro_animal']); } else { $cod_estado_prod_hierro_animal = '0'; }
if (isset($_POST['cod_estado_prod_numero_partos'])) { $cod_estado_prod_numero_partos = intval($_POST['cod_estado_prod_numero_partos']); } else { $cod_estado_prod_numero_partos = '0'; }
if (isset($_POST['cod_estado_prod_id_electronica'])) { $cod_estado_prod_id_electronica = intval($_POST['cod_estado_prod_id_electronica']); } else { $cod_estado_prod_id_electronica = '0'; }
if (isset($_POST['cod_estado_prod_nombre_raza1'])) { $cod_estado_prod_nombre_raza1 = intval($_POST['cod_estado_prod_nombre_raza1']); } else { $cod_estado_prod_nombre_raza1 = '0'; }
if (isset($_POST['cod_estado_prod_nombre_raza2'])) { $cod_estado_prod_nombre_raza2 = intval($_POST['cod_estado_prod_nombre_raza2']); } else { $cod_estado_prod_nombre_raza2 = '0'; }
if (isset($_POST['cod_estado_prod_nombre_raza3'])) { $cod_estado_prod_nombre_raza3 = intval($_POST['cod_estado_prod_nombre_raza3']); } else { $cod_estado_prod_nombre_raza3 = '0'; }
if (isset($_POST['cod_estado_prod_nombre_raza4'])) { $cod_estado_prod_nombre_raza4 = intval($_POST['cod_estado_prod_nombre_raza4']); } else { $cod_estado_prod_nombre_raza4 = '0'; }
if (isset($_POST['cod_estado_prod_ptj_raza1'])) { $cod_estado_prod_ptj_raza1 = intval($_POST['cod_estado_prod_ptj_raza1']); } else { $cod_estado_prod_ptj_raza1 = '0'; }
if (isset($_POST['cod_estado_prod_ptj_raza2'])) { $cod_estado_prod_ptj_raza2 = intval($_POST['cod_estado_prod_ptj_raza2']); } else { $cod_estado_prod_ptj_raza2 = '0'; }
if (isset($_POST['cod_estado_prod_ptj_raza3'])) { $cod_estado_prod_ptj_raza3 = intval($_POST['cod_estado_prod_ptj_raza3']); } else { $cod_estado_prod_ptj_raza3 = '0'; }
if (isset($_POST['cod_estado_prod_ptj_raza4'])) { $cod_estado_prod_ptj_raza4 = intval($_POST['cod_estado_prod_ptj_raza4']); } else { $cod_estado_prod_ptj_raza4 = '0'; }
if (isset($_POST['cod_estado_prod_id_padre'])) { $cod_estado_prod_id_padre = intval($_POST['cod_estado_prod_id_padre']); } else { $cod_estado_prod_id_padre = '0'; }
if (isset($_POST['cod_estado_prod_raza_padre'])) { $cod_estado_prod_raza_padre = intval($_POST['cod_estado_prod_raza_padre']); } else { $cod_estado_prod_raza_padre = '0'; }
if (isset($_POST['cod_estado_prod_id_madre'])) { $cod_estado_prod_id_madre = intval($_POST['cod_estado_prod_id_madre']); } else { $cod_estado_prod_id_madre = '0'; }
if (isset($_POST['cod_estado_prod_raza_madre'])) { $cod_estado_prod_raza_madre = intval($_POST['cod_estado_prod_raza_madre']); } else { $cod_estado_prod_raza_madre = '0'; }
if (isset($_POST['cod_estado_prod_partos_madre'])) { $cod_estado_prod_partos_madre = intval($_POST['cod_estado_prod_partos_madre']); } else { $cod_estado_prod_partos_madre = '0'; }
if (isset($_POST['cod_estado_prod_id_abuelo_paterno'])) { $cod_estado_prod_id_abuelo_paterno = intval($_POST['cod_estado_prod_id_abuelo_paterno']); } else { $cod_estado_prod_id_abuelo_paterno = '0'; }
if (isset($_POST['cod_estado_prod_id_abuelo_materno'])) { $cod_estado_prod_id_abuelo_materno = intval($_POST['cod_estado_prod_id_abuelo_materno']); } else { $cod_estado_prod_id_abuelo_materno = '0'; }
if (isset($_POST['cod_estado_prod_nombre_abuelo_paterno'])) { $cod_estado_prod_nombre_abuelo_paterno = intval($_POST['cod_estado_prod_nombre_abuelo_paterno']); } else { $cod_estado_prod_nombre_abuelo_paterno = '0'; }
if (isset($_POST['cod_estado_prod_nombre_abuelo_materno'])) { $cod_estado_prod_nombre_abuelo_materno = intval($_POST['cod_estado_prod_nombre_abuelo_materno']); } else { $cod_estado_prod_nombre_abuelo_materno = '0'; }
if (isset($_POST['cod_estado_prod_raza_abuelo_paterno'])) { $cod_estado_prod_raza_abuelo_paterno = intval($_POST['cod_estado_prod_raza_abuelo_paterno']); } else { $cod_estado_prod_raza_abuelo_paterno = '0'; }
if (isset($_POST['cod_estado_prod_raza_abuelo_materno'])) { $cod_estado_prod_raza_abuelo_materno = intval($_POST['cod_estado_prod_raza_abuelo_materno']); } else { $cod_estado_prod_raza_abuelo_materno = '0'; }
if (isset($_POST['cod_estado_prod_id_abuela_paterno'])) { $cod_estado_prod_id_abuela_paterno = intval($_POST['cod_estado_prod_id_abuela_paterno']); } else { $cod_estado_prod_id_abuela_paterno = '0'; }
if (isset($_POST['cod_estado_prod_id_abuela_materno'])) { $cod_estado_prod_id_abuela_materno = intval($_POST['cod_estado_prod_id_abuela_materno']); } else { $cod_estado_prod_id_abuela_materno = '0'; }
if (isset($_POST['cod_estado_prod_nombre_abuela_paterno'])) { $cod_estado_prod_nombre_abuela_paterno = intval($_POST['cod_estado_prod_nombre_abuela_paterno']); } else { $cod_estado_prod_nombre_abuela_paterno = '0'; }
if (isset($_POST['cod_estado_prod_nombre_abuela_materno'])) { $cod_estado_prod_nombre_abuela_materno = intval($_POST['cod_estado_prod_nombre_abuela_materno']); } else { $cod_estado_prod_nombre_abuela_materno = '0'; }
if (isset($_POST['cod_estado_prod_raza_abuela_paterno'])) { $cod_estado_prod_raza_abuela_paterno = intval($_POST['cod_estado_prod_raza_abuela_paterno']); } else { $cod_estado_prod_raza_abuela_paterno = '0'; }
if (isset($_POST['cod_estado_prod_raza_abuela_materno'])) { $cod_estado_prod_raza_abuela_materno = intval($_POST['cod_estado_prod_raza_abuela_materno']); } else { $cod_estado_prod_raza_abuela_materno = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_concepcion'])) { $cod_estado_prod_nombre_tipo_concepcion = intval($_POST['cod_estado_prod_nombre_tipo_concepcion']); } else { $cod_estado_prod_nombre_tipo_concepcion = '0'; }
if (isset($_POST['cod_estado_prod_nombre_especie'])) { $cod_estado_prod_nombre_especie = intval($_POST['cod_estado_prod_nombre_especie']); } else { $cod_estado_prod_nombre_especie = '0'; }
if (isset($_POST['cod_estado_prod_marcas_tatuado'])) { $cod_estado_prod_marcas_tatuado = intval($_POST['cod_estado_prod_marcas_tatuado']); } else { $cod_estado_prod_marcas_tatuado = '0'; }
if (isset($_POST['cod_estado_prod_marcas_herrado'])) { $cod_estado_prod_marcas_herrado = intval($_POST['cod_estado_prod_marcas_herrado']); } else { $cod_estado_prod_marcas_herrado = '0'; }
if (isset($_POST['cod_estado_prod_marcas_descornado'])) { $cod_estado_prod_marcas_descornado = intval($_POST['cod_estado_prod_marcas_descornado']); } else { $cod_estado_prod_marcas_descornado = '0'; }
if (isset($_POST['cod_estado_prod_marcas_castrado'])) { $cod_estado_prod_marcas_castrado = intval($_POST['cod_estado_prod_marcas_castrado']); } else { $cod_estado_prod_marcas_castrado = '0'; }
if (isset($_POST['cod_estado_prod_nombre_color'])) { $cod_estado_prod_nombre_color = intval($_POST['cod_estado_prod_nombre_color']); } else { $cod_estado_prod_nombre_color = '0'; }
if (isset($_POST['cod_estado_prod_nombre_temperamento'])) { $cod_estado_prod_nombre_temperamento = intval($_POST['cod_estado_prod_nombre_temperamento']); } else { $cod_estado_prod_nombre_temperamento = '0'; }
if (isset($_POST['cod_estado_prod_peso_nacer'])) { $cod_estado_prod_peso_nacer = intval($_POST['cod_estado_prod_peso_nacer']); } else { $cod_estado_prod_peso_nacer = '0'; }
if (isset($_POST['cod_estado_prod_aplomo_corvejon'])) { $cod_estado_prod_aplomo_corvejon = intval($_POST['cod_estado_prod_aplomo_corvejon']); } else { $cod_estado_prod_aplomo_corvejon = '0'; }
if (isset($_POST['cod_estado_prod_aplomo_cuartilla'])) { $cod_estado_prod_aplomo_cuartilla = intval($_POST['cod_estado_prod_aplomo_cuartilla']); } else { $cod_estado_prod_aplomo_cuartilla = '0'; }
if (isset($_POST['cod_estado_prod_aplomo_cascos'])) { $cod_estado_prod_aplomo_cascos = intval($_POST['cod_estado_prod_aplomo_cascos']); } else { $cod_estado_prod_aplomo_cascos = '0'; }
if (isset($_POST['cod_estado_prod_genital_circun_escrotal'])) { $cod_estado_prod_genital_circun_escrotal = intval($_POST['cod_estado_prod_genital_circun_escrotal']); } else { $cod_estado_prod_genital_circun_escrotal = '0'; }
if (isset($_POST['cod_estado_prod_genital_prepusio'])) { $cod_estado_prod_genital_prepusio = intval($_POST['cod_estado_prod_genital_prepusio']); } else { $cod_estado_prod_genital_prepusio = '0'; }
if (isset($_POST['cod_estado_prod_genital_potencia'])) { $cod_estado_prod_genital_potencia = intval($_POST['cod_estado_prod_genital_potencia']); } else { $cod_estado_prod_genital_potencia = '0'; }
if (isset($_POST['cod_estado_prod_genital_semen'])) { $cod_estado_prod_genital_semen = intval($_POST['cod_estado_prod_genital_semen']); } else { $cod_estado_prod_genital_semen = '0'; }
if (isset($_POST['cod_estado_prod_observacion_animal'])) { $cod_estado_prod_observacion_animal = intval($_POST['cod_estado_prod_observacion_animal']); } else { $cod_estado_prod_observacion_animal = '0'; }
if (isset($_POST['cod_estado_prod_nombre_estado'])) { $cod_estado_prod_nombre_estado = intval($_POST['cod_estado_prod_nombre_estado']); } else { $cod_estado_prod_nombre_estado = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_movimiento'])) { $cod_estado_prod_nombre_tipo_movimiento = intval($_POST['cod_estado_prod_nombre_tipo_movimiento']); } else { $cod_estado_prod_nombre_tipo_movimiento = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria_animal_extern'])) { $cod_estado_prod_nombre_categoria_animal_extern = intval($_POST['cod_estado_prod_nombre_categoria_animal_extern']); } else { $cod_estado_prod_nombre_categoria_animal_extern = '0'; }
if (isset($_POST['cod_estado_prod_cod_finca'])) { $cod_estado_prod_cod_finca = intval($_POST['cod_estado_prod_cod_finca']); } else { $cod_estado_prod_cod_finca = '0'; }
if (isset($_POST['cod_estado_prod_nombre_finca'])) { $cod_estado_prod_nombre_finca = intval($_POST['cod_estado_prod_nombre_finca']); } else { $cod_estado_prod_nombre_finca = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria'])) { $cod_estado_prod_nombre_categoria = intval($_POST['cod_estado_prod_nombre_categoria']); } else { $cod_estado_prod_nombre_categoria = '0'; }
if (isset($_POST['cod_estado_prod_nombre_categoria_sub'])) { $cod_estado_prod_nombre_categoria_sub = intval($_POST['cod_estado_prod_nombre_categoria_sub']); } else { $cod_estado_prod_nombre_categoria_sub = '0'; }
if (isset($_POST['cod_estado_prod_und_inv'])) { $cod_estado_prod_und_inv = intval($_POST['cod_estado_prod_und_inv']); } else { $cod_estado_prod_und_inv = '0'; }
if (isset($_POST['cod_estado_prod_descripcion_producto'])) { $cod_estado_prod_descripcion_producto = intval($_POST['cod_estado_prod_descripcion_producto']); } else { $cod_estado_prod_descripcion_producto = '0'; }
if (isset($_POST['cod_estado_prod_url_img_producto_min'])) { $cod_estado_prod_url_img_producto_min = intval($_POST['cod_estado_prod_url_img_producto_min']); } else { $cod_estado_prod_url_img_producto_min = '0'; }
if (isset($_POST['cod_estado_prod_url_img_producto_orig'])) { $cod_estado_prod_url_img_producto_orig = intval($_POST['cod_estado_prod_url_img_producto_orig']); } else { $cod_estado_prod_url_img_producto_orig = '0'; }
if (isset($_POST['cod_estado_prod_nombre_promocion'])) { $cod_estado_prod_nombre_promocion = intval($_POST['cod_estado_prod_nombre_promocion']); } else { $cod_estado_prod_nombre_promocion = '0'; }
if (isset($_POST['cod_estado_prod_nombre_promocion_ing'])) { $cod_estado_prod_nombre_promocion_ing = intval($_POST['cod_estado_prod_nombre_promocion_ing']); } else { $cod_estado_prod_nombre_promocion_ing = '0'; }
if (isset($_POST['cod_estado_prod_posologia_cantidad'])) { $cod_estado_prod_posologia_cantidad = intval($_POST['cod_estado_prod_posologia_cantidad']); } else { $cod_estado_prod_posologia_cantidad = '0'; }
if (isset($_POST['cod_estado_prod_posologia_peso'])) { $cod_estado_prod_posologia_peso = intval($_POST['cod_estado_prod_posologia_peso']); } else { $cod_estado_prod_posologia_peso = '0'; }
if (isset($_POST['cod_estado_prod_nombre_tipo_presentacion'])) { $cod_estado_prod_nombre_tipo_presentacion = intval($_POST['cod_estado_prod_nombre_tipo_presentacion']); } else { $cod_estado_prod_nombre_tipo_presentacion = '0'; }
if (isset($_POST['cod_estado_prod_nombre_via_administracion'])) { $cod_estado_prod_nombre_via_administracion = intval($_POST['cod_estado_prod_nombre_via_administracion']); } else { $cod_estado_prod_nombre_via_administracion = '0'; }
if (isset($_POST['cod_estado_prod_nombre_frec_duracion'])) { $cod_estado_prod_nombre_frec_duracion = intval($_POST['cod_estado_prod_nombre_frec_duracion']); } else { $cod_estado_prod_nombre_frec_duracion = '0'; }
if (isset($_POST['cod_estado_plan_separe'])) { $cod_estado_plan_separe = intval($_POST['cod_estado_plan_separe']); } else { $cod_estado_plan_separe = '0'; }
if (isset($_POST['cod_estado_plan_separe_registrar'])) { $cod_estado_plan_separe_registrar = intval($_POST['cod_estado_plan_separe_registrar']); } else { $cod_estado_plan_separe_registrar = '0'; }
if (isset($_POST['cod_estado_plan_separe_editar'])) { $cod_estado_plan_separe_editar = intval($_POST['cod_estado_plan_separe_editar']); } else { $cod_estado_plan_separe_editar = '0'; }
if (isset($_POST['cod_estado_plan_separe_eliminar'])) { $cod_estado_plan_separe_eliminar = intval($_POST['cod_estado_plan_separe_eliminar']); } else { $cod_estado_plan_separe_eliminar = '0'; }
if (isset($_POST['cod_estado_plan_separe_imprimir'])) { $cod_estado_plan_separe_imprimir = intval($_POST['cod_estado_plan_separe_imprimir']); } else { $cod_estado_plan_separe_imprimir = '0'; }
if (isset($_POST['cod_estado_plan_separe_exportar'])) { $cod_estado_plan_separe_exportar = intval($_POST['cod_estado_plan_separe_exportar']); } else { $cod_estado_plan_separe_exportar = '0'; }
if (isset($_POST['cod_estado_contabilidad'])) { $cod_estado_contabilidad = intval($_POST['cod_estado_contabilidad']); } else { $cod_estado_contabilidad = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable'])) { $cod_estado_contabilidad_mov_contable = intval($_POST['cod_estado_contabilidad_mov_contable']); } else { $cod_estado_contabilidad_mov_contable = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable_registrar'])) { $cod_estado_contabilidad_mov_contable_registrar = intval($_POST['cod_estado_contabilidad_mov_contable_registrar']); } else { $cod_estado_contabilidad_mov_contable_registrar = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable_editar'])) { $cod_estado_contabilidad_mov_contable_editar = intval($_POST['cod_estado_contabilidad_mov_contable_editar']); } else { $cod_estado_contabilidad_mov_contable_editar = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable_eliminar'])) { $cod_estado_contabilidad_mov_contable_eliminar = intval($_POST['cod_estado_contabilidad_mov_contable_eliminar']); } else { $cod_estado_contabilidad_mov_contable_eliminar = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable_imprimir'])) { $cod_estado_contabilidad_mov_contable_imprimir = intval($_POST['cod_estado_contabilidad_mov_contable_imprimir']); } else { $cod_estado_contabilidad_mov_contable_imprimir = '0'; }
if (isset($_POST['cod_estado_contabilidad_mov_contable_exportar'])) { $cod_estado_contabilidad_mov_contable_exportar = intval($_POST['cod_estado_contabilidad_mov_contable_exportar']); } else { $cod_estado_contabilidad_mov_contable_exportar = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg'])) { $cod_estado_contabilidad_pyg = intval($_POST['cod_estado_contabilidad_pyg']); } else { $cod_estado_contabilidad_pyg = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg_registrar'])) { $cod_estado_contabilidad_pyg_registrar = intval($_POST['cod_estado_contabilidad_pyg_registrar']); } else { $cod_estado_contabilidad_pyg_registrar = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg_editar'])) { $cod_estado_contabilidad_pyg_editar = intval($_POST['cod_estado_contabilidad_pyg_editar']); } else { $cod_estado_contabilidad_pyg_editar = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg_eliminar'])) { $cod_estado_contabilidad_pyg_eliminar = intval($_POST['cod_estado_contabilidad_pyg_eliminar']); } else { $cod_estado_contabilidad_pyg_eliminar = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg_imprimir'])) { $cod_estado_contabilidad_pyg_imprimir = intval($_POST['cod_estado_contabilidad_pyg_imprimir']); } else { $cod_estado_contabilidad_pyg_imprimir = '0'; }
if (isset($_POST['cod_estado_contabilidad_pyg_exportar'])) { $cod_estado_contabilidad_pyg_exportar = intval($_POST['cod_estado_contabilidad_pyg_exportar']); } else { $cod_estado_contabilidad_pyg_exportar = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance'])) { $cod_estado_contabilidad_balance = intval($_POST['cod_estado_contabilidad_balance']); } else { $cod_estado_contabilidad_balance = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance_pyg_registrar'])) { $cod_estado_contabilidad_balance_pyg_registrar = intval($_POST['cod_estado_contabilidad_balance_pyg_registrar']); } else { $cod_estado_contabilidad_balance_pyg_registrar = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance_pyg_editar'])) { $cod_estado_contabilidad_balance_pyg_editar = intval($_POST['cod_estado_contabilidad_balance_pyg_editar']); } else { $cod_estado_contabilidad_balance_pyg_editar = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance_pyg_eliminar'])) { $cod_estado_contabilidad_balance_pyg_eliminar = intval($_POST['cod_estado_contabilidad_balance_pyg_eliminar']); } else { $cod_estado_contabilidad_balance_pyg_eliminar = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance_pyg_imprimir'])) { $cod_estado_contabilidad_balance_pyg_imprimir = intval($_POST['cod_estado_contabilidad_balance_pyg_imprimir']); } else { $cod_estado_contabilidad_balance_pyg_imprimir = '0'; }
if (isset($_POST['cod_estado_contabilidad_balance_pyg_exportar'])) { $cod_estado_contabilidad_balance_pyg_exportar = intval($_POST['cod_estado_contabilidad_balance_pyg_exportar']); } else { $cod_estado_contabilidad_balance_pyg_exportar = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc'])) { $cod_estado_contabilidad_puc = intval($_POST['cod_estado_contabilidad_puc']); } else { $cod_estado_contabilidad_puc = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc_registrar'])) { $cod_estado_contabilidad_puc_registrar = intval($_POST['cod_estado_contabilidad_puc_registrar']); } else { $cod_estado_contabilidad_puc_registrar = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc_editar'])) { $cod_estado_contabilidad_puc_editar = intval($_POST['cod_estado_contabilidad_puc_editar']); } else { $cod_estado_contabilidad_puc_editar = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc_eliminar'])) { $cod_estado_contabilidad_puc_eliminar = intval($_POST['cod_estado_contabilidad_puc_eliminar']); } else { $cod_estado_contabilidad_puc_eliminar = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc_imprimir'])) { $cod_estado_contabilidad_puc_imprimir = intval($_POST['cod_estado_contabilidad_puc_imprimir']); } else { $cod_estado_contabilidad_puc_imprimir = '0'; }
if (isset($_POST['cod_estado_contabilidad_puc_exportar'])) { $cod_estado_contabilidad_puc_exportar = intval($_POST['cod_estado_contabilidad_puc_exportar']); } else { $cod_estado_contabilidad_puc_exportar = '0'; }
if (isset($_POST['cod_estado_facturacion'])) { $cod_estado_facturacion = intval($_POST['cod_estado_facturacion']); } else { $cod_estado_facturacion = '0'; }
if (isset($_POST['cod_estado_facturacion_venta'])) { $cod_estado_facturacion_venta = intval($_POST['cod_estado_facturacion_venta']); } else { $cod_estado_facturacion_venta = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_registrar'])) { $cod_estado_facturacion_venta_registrar = intval($_POST['cod_estado_facturacion_venta_registrar']); } else { $cod_estado_facturacion_venta_registrar = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_editar'])) { $cod_estado_facturacion_venta_editar = intval($_POST['cod_estado_facturacion_venta_editar']); } else { $cod_estado_facturacion_venta_editar = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_eliminar'])) { $cod_estado_facturacion_venta_eliminar = intval($_POST['cod_estado_facturacion_venta_eliminar']); } else { $cod_estado_facturacion_venta_eliminar = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_imprimir'])) { $cod_estado_facturacion_venta_imprimir = intval($_POST['cod_estado_facturacion_venta_imprimir']); } else { $cod_estado_facturacion_venta_imprimir = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_exportar'])) { $cod_estado_facturacion_venta_exportar = intval($_POST['cod_estado_facturacion_venta_exportar']); } else { $cod_estado_facturacion_venta_exportar = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_devol'])) { $cod_estado_facturacion_venta_devol = intval($_POST['cod_estado_facturacion_venta_devol']); } else { $cod_estado_facturacion_venta_devol = '0'; }
if (isset($_POST['cod_estado_facturacion_compra'])) { $cod_estado_facturacion_compra = intval($_POST['cod_estado_facturacion_compra']); } else { $cod_estado_facturacion_compra = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_registrar'])) { $cod_estado_facturacion_compra_registrar = intval($_POST['cod_estado_facturacion_compra_registrar']); } else { $cod_estado_facturacion_compra_registrar = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_editar'])) { $cod_estado_facturacion_compra_editar = intval($_POST['cod_estado_facturacion_compra_editar']); } else { $cod_estado_facturacion_compra_editar = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_eliminar'])) { $cod_estado_facturacion_compra_eliminar = intval($_POST['cod_estado_facturacion_compra_eliminar']); } else { $cod_estado_facturacion_compra_eliminar = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_imprimir'])) { $cod_estado_facturacion_compra_imprimir = intval($_POST['cod_estado_facturacion_compra_imprimir']); } else { $cod_estado_facturacion_compra_imprimir = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_exportar'])) { $cod_estado_facturacion_compra_exportar = intval($_POST['cod_estado_facturacion_compra_exportar']); } else { $cod_estado_facturacion_compra_exportar = '0'; }
if (isset($_POST['cod_estado_facturacion_compra_devol'])) { $cod_estado_facturacion_compra_devol = intval($_POST['cod_estado_facturacion_compra_devol']); } else { $cod_estado_facturacion_compra_devol = '0'; }
if (isset($_POST['cod_estado_facturacion_devol_venta'])) { $cod_estado_facturacion_devol_venta = intval($_POST['cod_estado_facturacion_devol_venta']); } else { $cod_estado_facturacion_devol_venta = '0'; }
if (isset($_POST['cod_estado_facturacion_devol_inventario'])) { $cod_estado_facturacion_devol_inventario = intval($_POST['cod_estado_facturacion_devol_inventario']); } else { $cod_estado_facturacion_devol_inventario = '0'; }
if (isset($_POST['cod_estado_cotizacion'])) { $cod_estado_cotizacion = intval($_POST['cod_estado_cotizacion']); } else { $cod_estado_cotizacion = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta'])) { $cod_estado_cotizacion_venta = intval($_POST['cod_estado_cotizacion_venta']); } else { $cod_estado_cotizacion_venta = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta_registrar'])) { $cod_estado_cotizacion_venta_registrar = intval($_POST['cod_estado_cotizacion_venta_registrar']); } else { $cod_estado_cotizacion_venta_registrar = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta_editar'])) { $cod_estado_cotizacion_venta_editar = intval($_POST['cod_estado_cotizacion_venta_editar']); } else { $cod_estado_cotizacion_venta_editar = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta_eliminar'])) { $cod_estado_cotizacion_venta_eliminar = intval($_POST['cod_estado_cotizacion_venta_eliminar']); } else { $cod_estado_cotizacion_venta_eliminar = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta_imprimir'])) { $cod_estado_cotizacion_venta_imprimir = intval($_POST['cod_estado_cotizacion_venta_imprimir']); } else { $cod_estado_cotizacion_venta_imprimir = '0'; }
if (isset($_POST['cod_estado_cotizacion_venta_exportar'])) { $cod_estado_cotizacion_venta_exportar = intval($_POST['cod_estado_cotizacion_venta_exportar']); } else { $cod_estado_cotizacion_venta_exportar = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra'])) { $cod_estado_cotizacion_compra = intval($_POST['cod_estado_cotizacion_compra']); } else { $cod_estado_cotizacion_compra = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra_registrar'])) { $cod_estado_cotizacion_compra_registrar = intval($_POST['cod_estado_cotizacion_compra_registrar']); } else { $cod_estado_cotizacion_compra_registrar = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra_editar'])) { $cod_estado_cotizacion_compra_editar = intval($_POST['cod_estado_cotizacion_compra_editar']); } else { $cod_estado_cotizacion_compra_editar = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra_eliminar'])) { $cod_estado_cotizacion_compra_eliminar = intval($_POST['cod_estado_cotizacion_compra_eliminar']); } else { $cod_estado_cotizacion_compra_eliminar = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra_imprimir'])) { $cod_estado_cotizacion_compra_imprimir = intval($_POST['cod_estado_cotizacion_compra_imprimir']); } else { $cod_estado_cotizacion_compra_imprimir = '0'; }
if (isset($_POST['cod_estado_cotizacion_compra_exportar'])) { $cod_estado_cotizacion_compra_exportar = intval($_POST['cod_estado_cotizacion_compra_exportar']); } else { $cod_estado_cotizacion_compra_exportar = '0'; }
if (isset($_POST['cod_estado_venta'])) { $cod_estado_venta = intval($_POST['cod_estado_venta']); } else { $cod_estado_venta = '0'; }
if (isset($_POST['cod_estado_venta_manual'])) { $cod_estado_venta_manual = intval($_POST['cod_estado_venta_manual']); } else { $cod_estado_venta_manual = '0'; }
if (isset($_POST['cod_estado_venta_barras'])) { $cod_estado_venta_barras = intval($_POST['cod_estado_venta_barras']); } else { $cod_estado_venta_barras = '0'; }
if (isset($_POST['cod_estado_venta_fecha_venta'])) { $cod_estado_venta_fecha_venta = intval($_POST['cod_estado_venta_fecha_venta']); } else { $cod_estado_venta_fecha_venta = '0'; }
if (isset($_POST['cod_estado_venta_preventa'])) { $cod_estado_venta_preventa = intval($_POST['cod_estado_venta_preventa']); } else { $cod_estado_venta_preventa = '0'; }
if (isset($_POST['cod_estado_venta_propina'])) { $cod_estado_venta_propina = intval($_POST['cod_estado_venta_propina']); } else { $cod_estado_venta_propina = '0'; }
if (isset($_POST['cod_estado_venta_bolsa'])) { $cod_estado_venta_bolsa = intval($_POST['cod_estado_venta_bolsa']); } else { $cod_estado_venta_bolsa = '0'; }
if (isset($_POST['cod_estado_venta_observacion'])) { $cod_estado_venta_observacion = intval($_POST['cod_estado_venta_observacion']); } else { $cod_estado_venta_observacion = '0'; }
if (isset($_POST['cod_estado_tercero'])) { $cod_estado_tercero = intval($_POST['cod_estado_tercero']); } else { $cod_estado_tercero = '0'; }
if (isset($_POST['cod_estado_tercero_registrar'])) { $cod_estado_tercero_registrar = intval($_POST['cod_estado_tercero_registrar']); } else { $cod_estado_tercero_registrar = '0'; }
if (isset($_POST['cod_estado_tercero_editar'])) { $cod_estado_tercero_editar = intval($_POST['cod_estado_tercero_editar']); } else { $cod_estado_tercero_editar = '0'; }
if (isset($_POST['cod_estado_tercero_eliminar'])) { $cod_estado_tercero_eliminar = intval($_POST['cod_estado_tercero_eliminar']); } else { $cod_estado_tercero_eliminar = '0'; }
if (isset($_POST['cod_estado_tercero_imprimir'])) { $cod_estado_tercero_imprimir = intval($_POST['cod_estado_tercero_imprimir']); } else { $cod_estado_tercero_imprimir = '0'; }
if (isset($_POST['cod_estado_tercero_exportar'])) { $cod_estado_tercero_exportar = intval($_POST['cod_estado_tercero_exportar']); } else { $cod_estado_tercero_exportar = '0'; }
if (isset($_POST['cod_estado_cita'])) { $cod_estado_cita = intval($_POST['cod_estado_cita']); } else { $cod_estado_cita = '0'; }
if (isset($_POST['cod_estado_cita_registrar'])) { $cod_estado_cita_registrar = intval($_POST['cod_estado_cita_registrar']); } else { $cod_estado_cita_registrar = '0'; }
if (isset($_POST['cod_estado_cita_editar'])) { $cod_estado_cita_editar = intval($_POST['cod_estado_cita_editar']); } else { $cod_estado_cita_editar = '0'; }
if (isset($_POST['cod_estado_cita_eliminar'])) { $cod_estado_cita_eliminar = intval($_POST['cod_estado_cita_eliminar']); } else { $cod_estado_cita_eliminar = '0'; }
if (isset($_POST['cod_estado_cita_imprimir'])) { $cod_estado_cita_imprimir = intval($_POST['cod_estado_cita_imprimir']); } else { $cod_estado_cita_imprimir = '0'; }
if (isset($_POST['cod_estado_cita_exportar'])) { $cod_estado_cita_exportar = intval($_POST['cod_estado_cita_exportar']); } else { $cod_estado_cita_exportar = '0'; }
if (isset($_POST['cod_estado_cuenta'])) { $cod_estado_cuenta = intval($_POST['cod_estado_cuenta']); } else { $cod_estado_cuenta = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar'])) { $cod_estado_cuenta_cobrar = intval($_POST['cod_estado_cuenta_cobrar']); } else { $cod_estado_cuenta_cobrar = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_registrar'])) { $cod_estado_cuenta_cobrar_registrar = intval($_POST['cod_estado_cuenta_cobrar_registrar']); } else { $cod_estado_cuenta_cobrar_registrar = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_editar'])) { $cod_estado_cuenta_cobrar_editar = intval($_POST['cod_estado_cuenta_cobrar_editar']); } else { $cod_estado_cuenta_cobrar_editar = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_eliminar'])) { $cod_estado_cuenta_cobrar_eliminar = intval($_POST['cod_estado_cuenta_cobrar_eliminar']); } else { $cod_estado_cuenta_cobrar_eliminar = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_imprimir'])) { $cod_estado_cuenta_cobrar_imprimir = intval($_POST['cod_estado_cuenta_cobrar_imprimir']); } else { $cod_estado_cuenta_cobrar_imprimir = '0'; }
if (isset($_POST['cod_estado_cuenta_cobrar_exportar'])) { $cod_estado_cuenta_cobrar_exportar = intval($_POST['cod_estado_cuenta_cobrar_exportar']); } else { $cod_estado_cuenta_cobrar_exportar = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar'])) { $cod_estado_cuenta_pagar = intval($_POST['cod_estado_cuenta_pagar']); } else { $cod_estado_cuenta_pagar = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_registrar'])) { $cod_estado_cuenta_pagar_registrar = intval($_POST['cod_estado_cuenta_pagar_registrar']); } else { $cod_estado_cuenta_pagar_registrar = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_editar'])) { $cod_estado_cuenta_pagar_editar = intval($_POST['cod_estado_cuenta_pagar_editar']); } else { $cod_estado_cuenta_pagar_editar = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_eliminar'])) { $cod_estado_cuenta_pagar_eliminar = intval($_POST['cod_estado_cuenta_pagar_eliminar']); } else { $cod_estado_cuenta_pagar_eliminar = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_imprimir'])) { $cod_estado_cuenta_pagar_imprimir = intval($_POST['cod_estado_cuenta_pagar_imprimir']); } else { $cod_estado_cuenta_pagar_imprimir = '0'; }
if (isset($_POST['cod_estado_cuenta_pagar_exportar'])) { $cod_estado_cuenta_pagar_exportar = intval($_POST['cod_estado_cuenta_pagar_exportar']); } else { $cod_estado_cuenta_pagar_exportar = '0'; }
if (isset($_POST['cod_estado_cierre_caja'])) { $cod_estado_cierre_caja = intval($_POST['cod_estado_cierre_caja']); } else { $cod_estado_cierre_caja = '0'; }
if (isset($_POST['cod_estado_cierre_caja_registrar'])) { $cod_estado_cierre_caja_registrar = intval($_POST['cod_estado_cierre_caja_registrar']); } else { $cod_estado_cierre_caja_registrar = '0'; }
if (isset($_POST['cod_estado_cierre_caja_editar'])) { $cod_estado_cierre_caja_editar = intval($_POST['cod_estado_cierre_caja_editar']); } else { $cod_estado_cierre_caja_editar = '0'; }
if (isset($_POST['cod_estado_cierre_caja_eliminar'])) { $cod_estado_cierre_caja_eliminar = intval($_POST['cod_estado_cierre_caja_eliminar']); } else { $cod_estado_cierre_caja_eliminar = '0'; }
if (isset($_POST['cod_estado_cierre_caja_imprimir'])) { $cod_estado_cierre_caja_imprimir = intval($_POST['cod_estado_cierre_caja_imprimir']); } else { $cod_estado_cierre_caja_imprimir = '0'; }
if (isset($_POST['cod_estado_cierre_caja_exportar'])) { $cod_estado_cierre_caja_exportar = intval($_POST['cod_estado_cierre_caja_exportar']); } else { $cod_estado_cierre_caja_exportar = '0'; }
if (isset($_POST['cod_estado_egreso'])) { $cod_estado_egreso = intval($_POST['cod_estado_egreso']); } else { $cod_estado_egreso = '0'; }
if (isset($_POST['cod_estado_egreso_registrar'])) { $cod_estado_egreso_registrar = intval($_POST['cod_estado_egreso_registrar']); } else { $cod_estado_egreso_registrar = '0'; }
if (isset($_POST['cod_estado_egreso_editar'])) { $cod_estado_egreso_editar = intval($_POST['cod_estado_egreso_editar']); } else { $cod_estado_egreso_editar = '0'; }
if (isset($_POST['cod_estado_egreso_eliminar'])) { $cod_estado_egreso_eliminar = intval($_POST['cod_estado_egreso_eliminar']); } else { $cod_estado_egreso_eliminar = '0'; }
if (isset($_POST['cod_estado_egreso_imprimir'])) { $cod_estado_egreso_imprimir = intval($_POST['cod_estado_egreso_imprimir']); } else { $cod_estado_egreso_imprimir = '0'; }
if (isset($_POST['cod_estado_egreso_exportar'])) { $cod_estado_egreso_exportar = intval($_POST['cod_estado_egreso_exportar']); } else { $cod_estado_egreso_exportar = '0'; }
if (isset($_POST['cod_estado_sticker_barra'])) { $cod_estado_sticker_barra = intval($_POST['cod_estado_sticker_barra']); } else { $cod_estado_sticker_barra = '0'; }
if (isset($_POST['cod_estado_sticker_barra_registrar'])) { $cod_estado_sticker_barra_registrar = intval($_POST['cod_estado_sticker_barra_registrar']); } else { $cod_estado_sticker_barra_registrar = '0'; }
if (isset($_POST['cod_estado_sticker_barra_editar'])) { $cod_estado_sticker_barra_editar = intval($_POST['cod_estado_sticker_barra_editar']); } else { $cod_estado_sticker_barra_editar = '0'; }
if (isset($_POST['cod_estado_sticker_barra_eliminar'])) { $cod_estado_sticker_barra_eliminar = intval($_POST['cod_estado_sticker_barra_eliminar']); } else { $cod_estado_sticker_barra_eliminar = '0'; }
if (isset($_POST['cod_estado_sticker_barra_imprimir'])) { $cod_estado_sticker_barra_imprimir = intval($_POST['cod_estado_sticker_barra_imprimir']); } else { $cod_estado_sticker_barra_imprimir = '0'; }
if (isset($_POST['cod_estado_sticker_barra_exportar'])) { $cod_estado_sticker_barra_exportar = intval($_POST['cod_estado_sticker_barra_exportar']); } else { $cod_estado_sticker_barra_exportar = '0'; }
if (isset($_POST['cod_estado_sticker_barra_observacion'])) { $cod_estado_sticker_barra_observacion = intval($_POST['cod_estado_sticker_barra_observacion']); } else { $cod_estado_sticker_barra_observacion = '0'; }
if (isset($_POST['cod_estado_sticker_barra_archivo_plano'])) { $cod_estado_sticker_barra_archivo_plano = intval($_POST['cod_estado_sticker_barra_archivo_plano']); } else { $cod_estado_sticker_barra_archivo_plano = '0'; }
if (isset($_POST['cod_estado_reporte'])) { $cod_estado_reporte = intval($_POST['cod_estado_reporte']); } else { $cod_estado_reporte = '0'; }
if (isset($_POST['cod_estado_reporte_venta'])) { $cod_estado_reporte_venta = intval($_POST['cod_estado_reporte_venta']); } else { $cod_estado_reporte_venta = '0'; }
if (isset($_POST['cod_estado_reporte_venta_registrar'])) { $cod_estado_reporte_venta_registrar = intval($_POST['cod_estado_reporte_venta_registrar']); } else { $cod_estado_reporte_venta_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_editar'])) { $cod_estado_reporte_venta_editar = intval($_POST['cod_estado_reporte_venta_editar']); } else { $cod_estado_reporte_venta_editar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_eliminar'])) { $cod_estado_reporte_venta_eliminar = intval($_POST['cod_estado_reporte_venta_eliminar']); } else { $cod_estado_reporte_venta_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_imprimir'])) { $cod_estado_reporte_venta_imprimir = intval($_POST['cod_estado_reporte_venta_imprimir']); } else { $cod_estado_reporte_venta_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_venta_exportar'])) { $cod_estado_reporte_venta_exportar = intval($_POST['cod_estado_reporte_venta_exportar']); } else { $cod_estado_reporte_venta_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_compra'])) { $cod_estado_reporte_compra = intval($_POST['cod_estado_reporte_compra']); } else { $cod_estado_reporte_compra = '0'; }
if (isset($_POST['cod_estado_reporte_compra_registrar'])) { $cod_estado_reporte_compra_registrar = intval($_POST['cod_estado_reporte_compra_registrar']); } else { $cod_estado_reporte_compra_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_compra_editar'])) { $cod_estado_reporte_compra_editar = intval($_POST['cod_estado_reporte_compra_editar']); } else { $cod_estado_reporte_compra_editar = '0'; }
if (isset($_POST['cod_estado_reporte_compra_eliminar'])) { $cod_estado_reporte_compra_eliminar = intval($_POST['cod_estado_reporte_compra_eliminar']); } else { $cod_estado_reporte_compra_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_compra_imprimir'])) { $cod_estado_reporte_compra_imprimir = intval($_POST['cod_estado_reporte_compra_imprimir']); } else { $cod_estado_reporte_compra_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_compra_exportar'])) { $cod_estado_reporte_compra_exportar = intval($_POST['cod_estado_reporte_compra_exportar']); } else { $cod_estado_reporte_compra_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_general'])) { $cod_estado_reporte_general = intval($_POST['cod_estado_reporte_general']); } else { $cod_estado_reporte_general = '0'; }
if (isset($_POST['cod_estado_reporte_general_registrar'])) { $cod_estado_reporte_general_registrar = intval($_POST['cod_estado_reporte_general_registrar']); } else { $cod_estado_reporte_general_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_general_editar'])) { $cod_estado_reporte_general_editar = intval($_POST['cod_estado_reporte_general_editar']); } else { $cod_estado_reporte_general_editar = '0'; }
if (isset($_POST['cod_estado_reporte_general_eliminar'])) { $cod_estado_reporte_general_eliminar = intval($_POST['cod_estado_reporte_general_eliminar']); } else { $cod_estado_reporte_general_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_general_imprimir'])) { $cod_estado_reporte_general_imprimir = intval($_POST['cod_estado_reporte_general_imprimir']); } else { $cod_estado_reporte_general_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_general_exportar'])) { $cod_estado_reporte_general_exportar = intval($_POST['cod_estado_reporte_general_exportar']); } else { $cod_estado_reporte_general_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable'])) { $cod_estado_reporte_mov_contable = intval($_POST['cod_estado_reporte_mov_contable']); } else { $cod_estado_reporte_mov_contable = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable_registrar'])) { $cod_estado_reporte_mov_contable_registrar = intval($_POST['cod_estado_reporte_mov_contable_registrar']); } else { $cod_estado_reporte_mov_contable_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable_editar'])) { $cod_estado_reporte_mov_contable_editar = intval($_POST['cod_estado_reporte_mov_contable_editar']); } else { $cod_estado_reporte_mov_contable_editar = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable_eliminar'])) { $cod_estado_reporte_mov_contable_eliminar = intval($_POST['cod_estado_reporte_mov_contable_eliminar']); } else { $cod_estado_reporte_mov_contable_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable_imprimir'])) { $cod_estado_reporte_mov_contable_imprimir = intval($_POST['cod_estado_reporte_mov_contable_imprimir']); } else { $cod_estado_reporte_mov_contable_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_mov_contable_exportar'])) { $cod_estado_reporte_mov_contable_exportar = intval($_POST['cod_estado_reporte_mov_contable_exportar']); } else { $cod_estado_reporte_mov_contable_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto'])) { $cod_estado_reporte_venta_por_producto = intval($_POST['cod_estado_reporte_venta_por_producto']); } else { $cod_estado_reporte_venta_por_producto = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto_registrar'])) { $cod_estado_reporte_venta_por_producto_registrar = intval($_POST['cod_estado_reporte_venta_por_producto_registrar']); } else { $cod_estado_reporte_venta_por_producto_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto_editar'])) { $cod_estado_reporte_venta_por_producto_editar = intval($_POST['cod_estado_reporte_venta_por_producto_editar']); } else { $cod_estado_reporte_venta_por_producto_editar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto_eliminar'])) { $cod_estado_reporte_venta_por_producto_eliminar = intval($_POST['cod_estado_reporte_venta_por_producto_eliminar']); } else { $cod_estado_reporte_venta_por_producto_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto_imprimir'])) { $cod_estado_reporte_venta_por_producto_imprimir = intval($_POST['cod_estado_reporte_venta_por_producto_imprimir']); } else { $cod_estado_reporte_venta_por_producto_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_venta_por_producto_exportar'])) { $cod_estado_reporte_venta_por_producto_exportar = intval($_POST['cod_estado_reporte_venta_por_producto_exportar']); } else { $cod_estado_reporte_venta_por_producto_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_inventario'])) { $cod_estado_reporte_inventario = intval($_POST['cod_estado_reporte_inventario']); } else { $cod_estado_reporte_inventario = '0'; }
if (isset($_POST['cod_estado_reporte_inventario_registrar'])) { $cod_estado_reporte_inventario_registrar = intval($_POST['cod_estado_reporte_inventario_registrar']); } else { $cod_estado_reporte_inventario_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_inventario_editar'])) { $cod_estado_reporte_inventario_editar = intval($_POST['cod_estado_reporte_inventario_editar']); } else { $cod_estado_reporte_inventario_editar = '0'; }
if (isset($_POST['cod_estado_reporte_inventario_eliminar'])) { $cod_estado_reporte_inventario_eliminar = intval($_POST['cod_estado_reporte_inventario_eliminar']); } else { $cod_estado_reporte_inventario_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_inventario_imprimir'])) { $cod_estado_reporte_inventario_imprimir = intval($_POST['cod_estado_reporte_inventario_imprimir']); } else { $cod_estado_reporte_inventario_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_inventario_exportar'])) { $cod_estado_reporte_inventario_exportar = intval($_POST['cod_estado_reporte_inventario_exportar']); } else { $cod_estado_reporte_inventario_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer'])) { $cod_estado_reporte_prodcuto_vencer = intval($_POST['cod_estado_reporte_prodcuto_vencer']); } else { $cod_estado_reporte_prodcuto_vencer = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer_registrar'])) { $cod_estado_reporte_prodcuto_vencer_registrar = intval($_POST['cod_estado_reporte_prodcuto_vencer_registrar']); } else { $cod_estado_reporte_prodcuto_vencer_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer_editar'])) { $cod_estado_reporte_prodcuto_vencer_editar = intval($_POST['cod_estado_reporte_prodcuto_vencer_editar']); } else { $cod_estado_reporte_prodcuto_vencer_editar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer_eliminar'])) { $cod_estado_reporte_prodcuto_vencer_eliminar = intval($_POST['cod_estado_reporte_prodcuto_vencer_eliminar']); } else { $cod_estado_reporte_prodcuto_vencer_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer_imprimir'])) { $cod_estado_reporte_prodcuto_vencer_imprimir = intval($_POST['cod_estado_reporte_prodcuto_vencer_imprimir']); } else { $cod_estado_reporte_prodcuto_vencer_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_vencer_exportar'])) { $cod_estado_reporte_prodcuto_vencer_exportar = intval($_POST['cod_estado_reporte_prodcuto_vencer_exportar']); } else { $cod_estado_reporte_prodcuto_vencer_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento'])) { $cod_estado_reporte_prodcuto_mantenimiento = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento']); } else { $cod_estado_reporte_prodcuto_mantenimiento = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento_registrar'])) { $cod_estado_reporte_prodcuto_mantenimiento_registrar = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento_registrar']); } else { $cod_estado_reporte_prodcuto_mantenimiento_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento_editar'])) { $cod_estado_reporte_prodcuto_mantenimiento_editar = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento_editar']); } else { $cod_estado_reporte_prodcuto_mantenimiento_editar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento_eliminar'])) { $cod_estado_reporte_prodcuto_mantenimiento_eliminar = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento_eliminar']); } else { $cod_estado_reporte_prodcuto_mantenimiento_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento_imprimir'])) { $cod_estado_reporte_prodcuto_mantenimiento_imprimir = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento_imprimir']); } else { $cod_estado_reporte_prodcuto_mantenimiento_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_prodcuto_mantenimiento_exportar'])) { $cod_estado_reporte_prodcuto_mantenimiento_exportar = intval($_POST['cod_estado_reporte_prodcuto_mantenimiento_exportar']); } else { $cod_estado_reporte_prodcuto_mantenimiento_exportar = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero'])) { $cod_estado_reporte_cumplanos_tercero = intval($_POST['cod_estado_reporte_cumplanos_tercero']); } else { $cod_estado_reporte_cumplanos_tercero = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero_registrar'])) { $cod_estado_reporte_cumplanos_tercero_registrar = intval($_POST['cod_estado_reporte_cumplanos_tercero_registrar']); } else { $cod_estado_reporte_cumplanos_tercero_registrar = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero_editar'])) { $cod_estado_reporte_cumplanos_tercero_editar = intval($_POST['cod_estado_reporte_cumplanos_tercero_editar']); } else { $cod_estado_reporte_cumplanos_tercero_editar = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero_eliminar'])) { $cod_estado_reporte_cumplanos_tercero_eliminar = intval($_POST['cod_estado_reporte_cumplanos_tercero_eliminar']); } else { $cod_estado_reporte_cumplanos_tercero_eliminar = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero_imprimir'])) { $cod_estado_reporte_cumplanos_tercero_imprimir = intval($_POST['cod_estado_reporte_cumplanos_tercero_imprimir']); } else { $cod_estado_reporte_cumplanos_tercero_imprimir = '0'; }
if (isset($_POST['cod_estado_reporte_cumplanos_tercero_exportar'])) { $cod_estado_reporte_cumplanos_tercero_exportar = intval($_POST['cod_estado_reporte_cumplanos_tercero_exportar']); } else { $cod_estado_reporte_cumplanos_tercero_exportar = '0'; }
if (isset($_POST['cod_estado_admin'])) { $cod_estado_admin = intval($_POST['cod_estado_admin']); } else { $cod_estado_admin = '0'; }
if (isset($_POST['cod_estado_info_empresa'])) { $cod_estado_info_empresa = intval($_POST['cod_estado_info_empresa']); } else { $cod_estado_info_empresa = '0'; }
if (isset($_POST['cod_estado_info_empresa_registrar'])) { $cod_estado_info_empresa_registrar = intval($_POST['cod_estado_info_empresa_registrar']); } else { $cod_estado_info_empresa_registrar = '0'; }
if (isset($_POST['cod_estado_info_empresa_editar'])) { $cod_estado_info_empresa_editar = intval($_POST['cod_estado_info_empresa_editar']); } else { $cod_estado_info_empresa_editar = '0'; }
if (isset($_POST['cod_estado_info_empresa_eliminar'])) { $cod_estado_info_empresa_eliminar = intval($_POST['cod_estado_info_empresa_eliminar']); } else { $cod_estado_info_empresa_eliminar = '0'; }
if (isset($_POST['cod_estado_info_empresa_imprimir'])) { $cod_estado_info_empresa_imprimir = intval($_POST['cod_estado_info_empresa_imprimir']); } else { $cod_estado_info_empresa_imprimir = '0'; }
if (isset($_POST['cod_estado_info_empresa_exportar'])) { $cod_estado_info_empresa_exportar = intval($_POST['cod_estado_info_empresa_exportar']); } else { $cod_estado_info_empresa_exportar = '0'; }
if (isset($_POST['cod_estado_usuario'])) { $cod_estado_usuario = intval($_POST['cod_estado_usuario']); } else { $cod_estado_usuario = '0'; }
if (isset($_POST['cod_estado_usuario_registrar'])) { $cod_estado_usuario_registrar = intval($_POST['cod_estado_usuario_registrar']); } else { $cod_estado_usuario_registrar = '0'; }
if (isset($_POST['cod_estado_usuario_editar'])) { $cod_estado_usuario_editar = intval($_POST['cod_estado_usuario_editar']); } else { $cod_estado_usuario_editar = '0'; }
if (isset($_POST['cod_estado_usuario_eliminar'])) { $cod_estado_usuario_eliminar = intval($_POST['cod_estado_usuario_eliminar']); } else { $cod_estado_usuario_eliminar = '0'; }
if (isset($_POST['cod_estado_usuario_imprimir'])) { $cod_estado_usuario_imprimir = intval($_POST['cod_estado_usuario_imprimir']); } else { $cod_estado_usuario_imprimir = '0'; }
if (isset($_POST['cod_estado_usuario_exportar'])) { $cod_estado_usuario_exportar = intval($_POST['cod_estado_usuario_exportar']); } else { $cod_estado_usuario_exportar = '0'; }
if (isset($_POST['cod_estado_dependencia'])) { $cod_estado_dependencia = intval($_POST['cod_estado_dependencia']); } else { $cod_estado_dependencia = '0'; }
if (isset($_POST['cod_estado_dependencia_registrar'])) { $cod_estado_dependencia_registrar = intval($_POST['cod_estado_dependencia_registrar']); } else { $cod_estado_dependencia_registrar = '0'; }
if (isset($_POST['cod_estado_dependencia_editar'])) { $cod_estado_dependencia_editar = intval($_POST['cod_estado_dependencia_editar']); } else { $cod_estado_dependencia_editar = '0'; }
if (isset($_POST['cod_estado_dependencia_eliminar'])) { $cod_estado_dependencia_eliminar = intval($_POST['cod_estado_dependencia_eliminar']); } else { $cod_estado_dependencia_eliminar = '0'; }
if (isset($_POST['cod_estado_dependencia_imprimir'])) { $cod_estado_dependencia_imprimir = intval($_POST['cod_estado_dependencia_imprimir']); } else { $cod_estado_dependencia_imprimir = '0'; }
if (isset($_POST['cod_estado_dependencia_exportar'])) { $cod_estado_dependencia_exportar = intval($_POST['cod_estado_dependencia_exportar']); } else { $cod_estado_dependencia_exportar = '0'; }
if (isset($_POST['cod_estado_resol_facturacion'])) { $cod_estado_resol_facturacion = intval($_POST['cod_estado_resol_facturacion']); } else { $cod_estado_resol_facturacion = '0'; }
if (isset($_POST['cod_estado_resol_facturacion_registrar'])) { $cod_estado_resol_facturacion_registrar = intval($_POST['cod_estado_resol_facturacion_registrar']); } else { $cod_estado_resol_facturacion_registrar = '0'; }
if (isset($_POST['cod_estado_resol_facturacion_editar'])) { $cod_estado_resol_facturacion_editar = intval($_POST['cod_estado_resol_facturacion_editar']); } else { $cod_estado_resol_facturacion_editar = '0'; }
if (isset($_POST['cod_estado_resol_facturacion_eliminar'])) { $cod_estado_resol_facturacion_eliminar = intval($_POST['cod_estado_resol_facturacion_eliminar']); } else { $cod_estado_resol_facturacion_eliminar = '0'; }
if (isset($_POST['cod_estado_resol_facturacion_imprimir'])) { $cod_estado_resol_facturacion_imprimir = intval($_POST['cod_estado_resol_facturacion_imprimir']); } else { $cod_estado_resol_facturacion_imprimir = '0'; }
if (isset($_POST['cod_estado_resol_facturacion_exportar'])) { $cod_estado_resol_facturacion_exportar = intval($_POST['cod_estado_resol_facturacion_exportar']); } else { $cod_estado_resol_facturacion_exportar = '0'; }
if (isset($_POST['cod_estado_numero_letras'])) { $cod_estado_numero_letras = intval($_POST['cod_estado_numero_letras']); } else { $cod_estado_numero_letras = '0'; }
if (isset($_POST['cod_estado_numero_letras_registrar'])) { $cod_estado_numero_letras_registrar = intval($_POST['cod_estado_numero_letras_registrar']); } else { $cod_estado_numero_letras_registrar = '0'; }
if (isset($_POST['cod_estado_numero_letras_editar'])) { $cod_estado_numero_letras_editar = intval($_POST['cod_estado_numero_letras_editar']); } else { $cod_estado_numero_letras_editar = '0'; }
if (isset($_POST['cod_estado_numero_letras_eliminar'])) { $cod_estado_numero_letras_eliminar = intval($_POST['cod_estado_numero_letras_eliminar']); } else { $cod_estado_numero_letras_eliminar = '0'; }
if (isset($_POST['cod_estado_numero_letras_imprimir'])) { $cod_estado_numero_letras_imprimir = intval($_POST['cod_estado_numero_letras_imprimir']); } else { $cod_estado_numero_letras_imprimir = '0'; }
if (isset($_POST['cod_estado_numero_letras_exportar'])) { $cod_estado_numero_letras_exportar = intval($_POST['cod_estado_numero_letras_exportar']); } else { $cod_estado_numero_letras_exportar = '0'; }
if (isset($_POST['cod_estado_eliminar'])) { $cod_estado_eliminar = intval($_POST['cod_estado_eliminar']); } else { $cod_estado_eliminar = '0'; }
if (isset($_POST['cod_estado_eliminar_usuario'])) { $cod_estado_eliminar_usuario = intval($_POST['cod_estado_eliminar_usuario']); } else { $cod_estado_eliminar_usuario = '0'; }
if (isset($_POST['cod_estado_eliminar_tercero'])) { $cod_estado_eliminar_tercero = intval($_POST['cod_estado_eliminar_tercero']); } else { $cod_estado_eliminar_tercero = '0'; }
if (isset($_POST['cod_estado_eliminar_producto'])) { $cod_estado_eliminar_producto = intval($_POST['cod_estado_eliminar_producto']); } else { $cod_estado_eliminar_producto = '0'; }
if (isset($_POST['cod_estado_licencia'])) { $cod_estado_licencia = intval($_POST['cod_estado_licencia']); } else { $cod_estado_licencia = '0'; }
if (isset($_POST['cod_estado_licencia_registrar'])) { $cod_estado_licencia_registrar = intval($_POST['cod_estado_licencia_registrar']); } else { $cod_estado_licencia_registrar = '0'; }
if (isset($_POST['cod_estado_licencia_editar'])) { $cod_estado_licencia_editar = intval($_POST['cod_estado_licencia_editar']); } else { $cod_estado_licencia_editar = '0'; }
if (isset($_POST['cod_estado_licencia_imprimir'])) { $cod_estado_licencia_imprimir = intval($_POST['cod_estado_licencia_imprimir']); } else { $cod_estado_licencia_imprimir = '0'; }
if (isset($_POST['cod_estado_licencia_exportar'])) { $cod_estado_licencia_exportar = intval($_POST['cod_estado_licencia_exportar']); } else { $cod_estado_licencia_exportar = '0'; }
if (isset($_POST['cod_estado_repositorio'])) { $cod_estado_repositorio = intval($_POST['cod_estado_repositorio']); } else { $cod_estado_repositorio = '0'; }
if (isset($_POST['cod_estado_repositorio_registrar'])) { $cod_estado_repositorio_registrar = intval($_POST['cod_estado_repositorio_registrar']); } else { $cod_estado_repositorio_registrar = '0'; }
if (isset($_POST['cod_estado_repositorio_editar'])) { $cod_estado_repositorio_editar = intval($_POST['cod_estado_repositorio_editar']); } else { $cod_estado_repositorio_editar = '0'; }
if (isset($_POST['cod_estado_repositorio_eliminar'])) { $cod_estado_repositorio_eliminar = intval($_POST['cod_estado_repositorio_eliminar']); } else { $cod_estado_repositorio_eliminar = '0'; }
if (isset($_POST['cod_estado_repositorio_imprimir'])) { $cod_estado_repositorio_imprimir = intval($_POST['cod_estado_repositorio_imprimir']); } else { $cod_estado_repositorio_imprimir = '0'; }
if (isset($_POST['cod_estado_repositorio_exportar'])) { $cod_estado_repositorio_exportar = intval($_POST['cod_estado_repositorio_exportar']); } else { $cod_estado_repositorio_exportar = '0'; }

if (isset($_POST['cod_estado_prod_subproducto_registrar'])) { $cod_estado_prod_subproducto_registrar = intval($_POST['cod_estado_prod_subproducto_registrar']); } else { $cod_estado_prod_subproducto_registrar = '0'; }
if (isset($_POST['cod_estado_prod_subproducto_editar'])) { $cod_estado_prod_subproducto_editar = intval($_POST['cod_estado_prod_subproducto_editar']); } else { $cod_estado_prod_subproducto_editar = '0'; }
if (isset($_POST['cod_estado_prod_subproducto_eliminar'])) { $cod_estado_prod_subproducto_eliminar = intval($_POST['cod_estado_prod_subproducto_eliminar']); } else { $cod_estado_prod_subproducto_eliminar = '0'; }
if (isset($_POST['cod_estado_prod_subproducto_imprimir'])) { $cod_estado_prod_subproducto_imprimir = intval($_POST['cod_estado_prod_subproducto_imprimir']); } else { $cod_estado_prod_subproducto_imprimir = '0'; }
if (isset($_POST['cod_estado_prod_subproducto_exportar'])) { $cod_estado_prod_subproducto_exportar = intval($_POST['cod_estado_prod_subproducto_exportar']); } else { $cod_estado_prod_subproducto_exportar = '0'; }

if (isset($_POST['cod_estado_prod_transferencia_registrar'])) { $cod_estado_prod_transferencia_registrar = intval($_POST['cod_estado_prod_transferencia_registrar']); } else { $cod_estado_prod_transferencia_registrar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_editar'])) { $cod_estado_prod_transferencia_editar = intval($_POST['cod_estado_prod_transferencia_editar']); } else { $cod_estado_prod_transferencia_editar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_eliminar'])) { $cod_estado_prod_transferencia_eliminar = intval($_POST['cod_estado_prod_transferencia_eliminar']); } else { $cod_estado_prod_transferencia_eliminar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_imprimir'])) { $cod_estado_prod_transferencia_imprimir = intval($_POST['cod_estado_prod_transferencia_imprimir']); } else { $cod_estado_prod_transferencia_imprimir = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_exportar'])) { $cod_estado_prod_transferencia_exportar = intval($_POST['cod_estado_prod_transferencia_exportar']); } else { $cod_estado_prod_transferencia_exportar = '0'; }

if (isset($_POST['cod_estado_prod_auditoria_registrar'])) { $cod_estado_prod_auditoria_registrar = intval($_POST['cod_estado_prod_auditoria_registrar']); } else { $cod_estado_prod_auditoria_registrar = '0'; }
if (isset($_POST['cod_estado_prod_auditoria_editar'])) { $cod_estado_prod_auditoria_editar = intval($_POST['cod_estado_prod_auditoria_editar']); } else { $cod_estado_prod_auditoria_editar = '0'; }
if (isset($_POST['cod_estado_prod_auditoria_eliminar'])) { $cod_estado_prod_auditoria_eliminar = intval($_POST['cod_estado_prod_auditoria_eliminar']); } else { $cod_estado_prod_auditoria_eliminar = '0'; }
if (isset($_POST['cod_estado_prod_auditoria_imprimir'])) { $cod_estado_prod_auditoria_imprimir = intval($_POST['cod_estado_prod_auditoria_imprimir']); } else { $cod_estado_prod_auditoria_imprimir = '0'; }
if (isset($_POST['cod_estado_prod_auditoria_exportar'])) { $cod_estado_prod_auditoria_exportar = intval($_POST['cod_estado_prod_auditoria_exportar']); } else { $cod_estado_prod_auditoria_exportar = '0'; }

if (isset($_POST['cod_estado_precio_compra_mod_venta'])) { $cod_estado_precio_compra_mod_venta = intval($_POST['cod_estado_precio_compra_mod_venta']); } else { $cod_estado_precio_compra_mod_venta = '0'; }
if (isset($_POST['cod_estado_eliminar_caja_mesa_virtual'])) { $cod_estado_eliminar_caja_mesa_virtual = intval($_POST['cod_estado_eliminar_caja_mesa_virtual']); } else { $cod_estado_eliminar_caja_mesa_virtual = '0'; }
if (isset($_POST['cod_estado_deshabilitar_opc_eliminar_ventatemp'])) { $cod_estado_deshabilitar_opc_eliminar_ventatemp = intval($_POST['cod_estado_deshabilitar_opc_eliminar_ventatemp']); } else { $cod_estado_deshabilitar_opc_eliminar_ventatemp = '0'; }
if (isset($_POST['cod_estado_habilitar_btn_facturar_mod_venta'])) { $cod_estado_habilitar_btn_facturar_mod_venta = intval($_POST['cod_estado_habilitar_btn_facturar_mod_venta']); } else { $cod_estado_habilitar_btn_facturar_mod_venta = '0'; }

if (isset($_POST['cod_estado_seguridad'])) { $cod_estado_seguridad = intval($_POST['cod_estado_seguridad']); } else { $cod_estado_seguridad = '0'; }
if (isset($_POST['cod_estado_seguridad_registrar'])) { $cod_estado_seguridad_registrar = intval($_POST['cod_estado_seguridad_registrar']); } else { $cod_estado_seguridad_registrar = '0'; }
if (isset($_POST['cod_estado_seguridad_editar'])) { $cod_estado_seguridad_editar = intval($_POST['cod_estado_seguridad_editar']); } else { $cod_estado_seguridad_editar = '0'; }
if (isset($_POST['cod_estado_seguridad_eliminar'])) { $cod_estado_seguridad_eliminar = intval($_POST['cod_estado_seguridad_eliminar']); } else { $cod_estado_seguridad_eliminar = '0'; }
if (isset($_POST['cod_estado_seguridad_imprimir'])) { $cod_estado_seguridad_imprimir = intval($_POST['cod_estado_seguridad_imprimir']); } else { $cod_estado_seguridad_imprimir = '0'; }
if (isset($_POST['cod_estado_seguridad_exportar'])) { $cod_estado_seguridad_exportar = intval($_POST['cod_estado_seguridad_exportar']); } else { $cod_estado_seguridad_exportar = '0'; }

if (isset($_POST['cod_estado_grafico_estadistico'])) { $cod_estado_grafico_estadistico = intval($_POST['cod_estado_grafico_estadistico']); } else { $cod_estado_grafico_estadistico = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_registrar'])) { $cod_estado_grafico_estadistico_registrar = intval($_POST['cod_estado_grafico_estadistico_registrar']); } else { $cod_estado_grafico_estadistico_registrar = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_editar'])) { $cod_estado_grafico_estadistico_editar = intval($_POST['cod_estado_grafico_estadistico_editar']); } else { $cod_estado_grafico_estadistico_editar = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_eliminar'])) { $cod_estado_grafico_estadistico_eliminar = intval($_POST['cod_estado_grafico_estadistico_eliminar']); } else { $cod_estado_grafico_estadistico_eliminar = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_imprimir'])) { $cod_estado_grafico_estadistico_imprimir = intval($_POST['cod_estado_grafico_estadistico_imprimir']); } else { $cod_estado_grafico_estadistico_imprimir = '0'; }
if (isset($_POST['cod_estado_grafico_estadistico_exportar'])) { $cod_estado_grafico_estadistico_exportar = intval($_POST['cod_estado_grafico_estadistico_exportar']); } else { $cod_estado_grafico_estadistico_exportar = '0'; }
if (isset($_POST['cod_estado_nota_observacion'])) { $cod_estado_nota_observacion = intval($_POST['cod_estado_nota_observacion']); } else { $cod_estado_nota_observacion = '0'; }
if (isset($_POST['cod_estado_nota_observacion_eliminar'])) { $cod_estado_nota_observacion_eliminar = intval($_POST['cod_estado_nota_observacion_eliminar']); } else { $cod_estado_nota_observacion_eliminar = '0'; }
if (isset($_POST['cod_estado_nota_observacion_registrar'])) { $cod_estado_nota_observacion_registrar = intval($_POST['cod_estado_nota_observacion_registrar']); } else { $cod_estado_nota_observacion_registrar = '0'; }
if (isset($_POST['cod_estado_nota_observacion_editar'])) { $cod_estado_nota_observacion_editar = intval($_POST['cod_estado_nota_observacion_editar']); } else { $cod_estado_nota_observacion_editar = '0'; }
if (isset($_POST['cod_estado_nota_observacion_imprimir'])) { $cod_estado_nota_observacion_imprimir = intval($_POST['cod_estado_nota_observacion_imprimir']); } else { $cod_estado_nota_observacion_imprimir = '0'; }
if (isset($_POST['cod_estado_nota_observacion_exportar'])) { $cod_estado_nota_observacion_exportar = intval($_POST['cod_estado_nota_observacion_exportar']); } else { $cod_estado_nota_observacion_exportar = '0'; }

if (isset($_POST['cod_estado_tipo_roles'])) { $cod_estado_tipo_roles = intval($_POST['cod_estado_tipo_roles']); } else { $cod_estado_tipo_roles = '0'; }
if (isset($_POST['cod_estado_tipo_roles_registrar'])) { $cod_estado_tipo_roles_registrar = intval($_POST['cod_estado_tipo_roles_registrar']); } else { $cod_estado_tipo_roles_registrar = '0'; }
if (isset($_POST['cod_estado_tipo_roles_editar'])) { $cod_estado_tipo_roles_editar = intval($_POST['cod_estado_tipo_roles_editar']); } else { $cod_estado_tipo_roles_editar = '0'; }
if (isset($_POST['cod_estado_tipo_roles_eliminar'])) { $cod_estado_tipo_roles_eliminar = intval($_POST['cod_estado_tipo_roles_eliminar']); } else { $cod_estado_tipo_roles_eliminar = '0'; }
if (isset($_POST['cod_estado_tipo_roles_imprimir'])) { $cod_estado_tipo_roles_imprimir = intval($_POST['cod_estado_tipo_roles_imprimir']); } else { $cod_estado_tipo_roles_imprimir = '0'; }
if (isset($_POST['cod_estado_tipo_roles_exportar'])) { $cod_estado_tipo_roles_exportar = intval($_POST['cod_estado_tipo_roles_exportar']); } else { $cod_estado_tipo_roles_exportar = '0'; }

if (isset($_POST['cod_estado_agregar_productos_a_venta_facturada'])) { $cod_estado_agregar_productos_a_venta_facturada = intval($_POST['cod_estado_agregar_productos_a_venta_facturada']); } else { $cod_estado_agregar_productos_a_venta_facturada = '0'; }
if (isset($_POST['cod_estado_eliminar_productos_a_venta_facturada'])) { $cod_estado_eliminar_productos_a_venta_facturada = intval($_POST['cod_estado_eliminar_productos_a_venta_facturada']); } else { $cod_estado_eliminar_productos_a_venta_facturada = '0'; }
if (isset($_POST['cod_estado_habilitar_total_venta_ventatemp'])) { $cod_estado_habilitar_total_venta_ventatemp = intval($_POST['cod_estado_habilitar_total_venta_ventatemp']); } else { $cod_estado_habilitar_total_venta_ventatemp = '0'; }
if (isset($_POST['cod_estado_habilitar_total_venta_caja_mesa_virtual'])) { $cod_estado_habilitar_total_venta_caja_mesa_virtual = intval($_POST['cod_estado_habilitar_total_venta_caja_mesa_virtual']); } else { $cod_estado_habilitar_total_venta_caja_mesa_virtual = '0'; }
if (isset($_POST['cod_estado_habilitar_caja_mesa_virtual_en_uso'])) { $cod_estado_habilitar_caja_mesa_virtual_en_uso = intval($_POST['cod_estado_habilitar_caja_mesa_virtual_en_uso']); } else { $cod_estado_habilitar_caja_mesa_virtual_en_uso = '0'; }
if (isset($_POST['cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso'])) { $cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso = intval($_POST['cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso']); } else { $cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso = '0'; }

if (isset($_POST['cod_estado_prod_inventario_producto_masivo'])) { $cod_estado_prod_inventario_producto_masivo = intval($_POST['cod_estado_prod_inventario_producto_masivo']); } else { $cod_estado_prod_inventario_producto_masivo = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern'])) { $cod_estado_prod_transferencia_extern = intval($_POST['cod_estado_prod_transferencia_extern']); } else { $cod_estado_prod_transferencia_extern = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern_registrar'])) { $cod_estado_prod_transferencia_extern_registrar = intval($_POST['cod_estado_prod_transferencia_extern_registrar']); } else { $cod_estado_prod_transferencia_extern_registrar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern_editar'])) { $cod_estado_prod_transferencia_extern_editar = intval($_POST['cod_estado_prod_transferencia_extern_editar']); } else { $cod_estado_prod_transferencia_extern_editar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern_eliminar'])) { $cod_estado_prod_transferencia_extern_eliminar = intval($_POST['cod_estado_prod_transferencia_extern_eliminar']); } else { $cod_estado_prod_transferencia_extern_eliminar = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern_imprimir'])) { $cod_estado_prod_transferencia_extern_imprimir = intval($_POST['cod_estado_prod_transferencia_extern_imprimir']); } else { $cod_estado_prod_transferencia_extern_imprimir = '0'; }
if (isset($_POST['cod_estado_prod_transferencia_extern_exportar'])) { $cod_estado_prod_transferencia_extern_exportar = intval($_POST['cod_estado_prod_transferencia_extern_exportar']); } else { $cod_estado_prod_transferencia_extern_exportar = '0'; }
if (isset($_POST['cod_estado_categoria'])) { $cod_estado_categoria = intval($_POST['cod_estado_categoria']); } else { $cod_estado_categoria = '0'; }
if (isset($_POST['cod_estado_categoria_registrar'])) { $cod_estado_categoria_registrar = intval($_POST['cod_estado_categoria_registrar']); } else { $cod_estado_categoria_registrar = '0'; }
if (isset($_POST['cod_estado_categoria_editar'])) { $cod_estado_categoria_editar = intval($_POST['cod_estado_categoria_editar']); } else { $cod_estado_categoria_editar = '0'; }
if (isset($_POST['cod_estado_categoria_eliminar'])) { $cod_estado_categoria_eliminar = intval($_POST['cod_estado_categoria_eliminar']); } else { $cod_estado_categoria_eliminar = '0'; }
if (isset($_POST['cod_estado_categoria_imprimir'])) { $cod_estado_categoria_imprimir = intval($_POST['cod_estado_categoria_imprimir']); } else { $cod_estado_categoria_imprimir = '0'; }
if (isset($_POST['cod_estado_categoria_exportar'])) { $cod_estado_categoria_exportar = intval($_POST['cod_estado_categoria_exportar']); } else { $cod_estado_categoria_exportar = '0'; }
if (isset($_POST['cod_estado_caja_mesa'])) { $cod_estado_caja_mesa = intval($_POST['cod_estado_caja_mesa']); } else { $cod_estado_caja_mesa = '0'; }
if (isset($_POST['cod_estado_caja_mesa_registrar'])) { $cod_estado_caja_mesa_registrar = intval($_POST['cod_estado_caja_mesa_registrar']); } else { $cod_estado_caja_mesa_registrar = '0'; }
if (isset($_POST['cod_estado_caja_mesa_editar'])) { $cod_estado_caja_mesa_editar = intval($_POST['cod_estado_caja_mesa_editar']); } else { $cod_estado_caja_mesa_editar = '0'; }
if (isset($_POST['cod_estado_caja_mesa_eliminar'])) { $cod_estado_caja_mesa_eliminar = intval($_POST['cod_estado_caja_mesa_eliminar']); } else { $cod_estado_caja_mesa_eliminar = '0'; }
if (isset($_POST['cod_estado_caja_mesa_imprimir'])) { $cod_estado_caja_mesa_imprimir = intval($_POST['cod_estado_caja_mesa_imprimir']); } else { $cod_estado_caja_mesa_imprimir = '0'; }
if (isset($_POST['cod_estado_caja_mesa_exportar'])) { $cod_estado_caja_mesa_exportar = intval($_POST['cod_estado_caja_mesa_exportar']); } else { $cod_estado_caja_mesa_exportar = '0'; }
if (isset($_POST['cod_estado_usuario_cambiar_contrasena'])) { $cod_estado_usuario_cambiar_contrasena = intval($_POST['cod_estado_usuario_cambiar_contrasena']); } else { $cod_estado_usuario_cambiar_contrasena = '0'; }
if (isset($_POST['cod_estado_usuario_cambiar_firma'])) { $cod_estado_usuario_cambiar_firma = intval($_POST['cod_estado_usuario_cambiar_firma']); } else { $cod_estado_usuario_cambiar_firma = '0'; }
if (isset($_POST['cod_estado_usuario_permisos_personalizados'])) { $cod_estado_usuario_permisos_personalizados = intval($_POST['cod_estado_usuario_permisos_personalizados']); } else { $cod_estado_usuario_permisos_personalizados = '0'; }
if (isset($_POST['cod_estado_usuario_permisos_asignar_matriz'])) { $cod_estado_usuario_permisos_asignar_matriz = intval($_POST['cod_estado_usuario_permisos_asignar_matriz']); } else { $cod_estado_usuario_permisos_asignar_matriz = '0'; }
if (isset($_POST['cod_estado_usuario_cambiar_tipo_rol'])) { $cod_estado_usuario_cambiar_tipo_rol = intval($_POST['cod_estado_usuario_cambiar_tipo_rol']); } else { $cod_estado_usuario_cambiar_tipo_rol = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_dependencia_user'])) { $cod_estado_facturacion_venta_dependencia_user = intval($_POST['cod_estado_facturacion_venta_dependencia_user']); } else { $cod_estado_facturacion_venta_dependencia_user = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_precio_venta_predet_user'])) { $cod_estado_facturacion_venta_precio_venta_predet_user = intval($_POST['cod_estado_facturacion_venta_precio_venta_predet_user']); } else { $cod_estado_facturacion_venta_precio_venta_predet_user = '0'; }
if (isset($_POST['cod_estado_facturacion_venta_acceso_facturas_otros_user'])) { $cod_estado_facturacion_venta_acceso_facturas_otros_user = intval($_POST['cod_estado_facturacion_venta_acceso_facturas_otros_user']); } else { $cod_estado_facturacion_venta_acceso_facturas_otros_user = '0'; }

if (isset($_POST['cod_estado_grafico_venta'])) { $cod_estado_grafico_venta = intval($_POST['cod_estado_grafico_venta']); } else { $cod_estado_grafico_venta = '0'; }
if (isset($_POST['cod_estado_grafico_compra'])) { $cod_estado_grafico_compra = intval($_POST['cod_estado_grafico_compra']); } else { $cod_estado_grafico_compra = '0'; }
if (isset($_POST['cod_estado_grafico_venta_compra'])) { $cod_estado_grafico_venta_compra = intval($_POST['cod_estado_grafico_venta_compra']); } else { $cod_estado_grafico_venta_compra = '0'; }
if (isset($_POST['cod_estado_grafico_venta_egreso'])) { $cod_estado_grafico_venta_egreso = intval($_POST['cod_estado_grafico_venta_egreso']); } else { $cod_estado_grafico_venta_egreso = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_pago'])) { $cod_estado_grafico_venta_tipo_pago = intval($_POST['cod_estado_grafico_venta_tipo_pago']); } else { $cod_estado_grafico_venta_tipo_pago = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_forma_pago'])) { $cod_estado_grafico_venta_tipo_forma_pago = intval($_POST['cod_estado_grafico_venta_tipo_forma_pago']); } else { $cod_estado_grafico_venta_tipo_forma_pago = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_factura'])) { $cod_estado_grafico_venta_tipo_factura = intval($_POST['cod_estado_grafico_venta_tipo_factura']); } else { $cod_estado_grafico_venta_tipo_factura = '0'; }
if (isset($_POST['cod_estado_grafico_venta_categoria'])) { $cod_estado_grafico_venta_categoria = intval($_POST['cod_estado_grafico_venta_categoria']); } else { $cod_estado_grafico_venta_categoria = '0'; }
if (isset($_POST['cod_estado_grafico_venta_dependencia'])) { $cod_estado_grafico_venta_dependencia = intval($_POST['cod_estado_grafico_venta_dependencia']); } else { $cod_estado_grafico_venta_dependencia = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_compra'])) { $cod_estado_grafico_venta_tipo_compra = intval($_POST['cod_estado_grafico_venta_tipo_compra']); } else { $cod_estado_grafico_venta_tipo_compra = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_metodo_envio'])) { $cod_estado_grafico_venta_tipo_metodo_envio = intval($_POST['cod_estado_grafico_venta_tipo_metodo_envio']); } else { $cod_estado_grafico_venta_tipo_metodo_envio = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tipo_aplicacion'])) { $cod_estado_grafico_venta_tipo_aplicacion = intval($_POST['cod_estado_grafico_venta_tipo_aplicacion']); } else { $cod_estado_grafico_venta_tipo_aplicacion = '0'; }
if (isset($_POST['cod_estado_grafico_venta_producto'])) { $cod_estado_grafico_venta_producto = intval($_POST['cod_estado_grafico_venta_producto']); } else { $cod_estado_grafico_venta_producto = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tercero'])) { $cod_estado_grafico_venta_tercero = intval($_POST['cod_estado_grafico_venta_tercero']); } else { $cod_estado_grafico_venta_tercero = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tercero_producto'])) { $cod_estado_grafico_venta_tercero_producto = intval($_POST['cod_estado_grafico_venta_tercero_producto']); } else { $cod_estado_grafico_venta_tercero_producto = '0'; }
if (isset($_POST['cod_estado_grafico_venta_tercero_domicilio'])) { $cod_estado_grafico_venta_tercero_domicilio = intval($_POST['cod_estado_grafico_venta_tercero_domicilio']); } else { $cod_estado_grafico_venta_tercero_domicilio = '0'; }
if (isset($_POST['cod_estado_grafico_producto_mas_vendido_und_venta'])) { $cod_estado_grafico_producto_mas_vendido_und_venta = intval($_POST['cod_estado_grafico_producto_mas_vendido_und_venta']); } else { $cod_estado_grafico_producto_mas_vendido_und_venta = '0'; }
if (isset($_POST['cod_estado_grafico_producto_mas_vendido_precio_venta'])) { $cod_estado_grafico_producto_mas_vendido_precio_venta = intval($_POST['cod_estado_grafico_producto_mas_vendido_precio_venta']); } else { $cod_estado_grafico_producto_mas_vendido_precio_venta = '0'; }
if (isset($_POST['cod_estado_grafico_producto_menos_vendido_und_venta'])) { $cod_estado_grafico_producto_menos_vendido_und_venta = intval($_POST['cod_estado_grafico_producto_menos_vendido_und_venta']); } else { $cod_estado_grafico_producto_menos_vendido_und_venta = '0'; }
if (isset($_POST['cod_estado_grafico_producto_menos_vendido_precio_venta'])) { $cod_estado_grafico_producto_menos_vendido_precio_venta = intval($_POST['cod_estado_grafico_producto_menos_vendido_precio_venta']); } else { $cod_estado_grafico_producto_menos_vendido_precio_venta = '0'; }
if (isset($_POST['cod_estado_grafico_compra_precio_compra_precio_venta'])) { $cod_estado_grafico_compra_precio_compra_precio_venta = intval($_POST['cod_estado_grafico_compra_precio_compra_precio_venta']); } else { $cod_estado_grafico_compra_precio_compra_precio_venta = '0'; }
if (isset($_POST['cod_estado_grafico_ganancia_venta_egreso'])) { $cod_estado_grafico_ganancia_venta_egreso = intval($_POST['cod_estado_grafico_ganancia_venta_egreso']); } else { $cod_estado_grafico_ganancia_venta_egreso = '0'; }
if (isset($_POST['cod_estado_grafico_ganancia_venta'])) { $cod_estado_grafico_ganancia_venta = intval($_POST['cod_estado_grafico_ganancia_venta']); } else { $cod_estado_grafico_ganancia_venta = '0'; }
if (isset($_POST['cod_estado_grafico_venta_por_vendedor'])) { $cod_estado_grafico_venta_por_vendedor = intval($_POST['cod_estado_grafico_venta_por_vendedor']); } else { $cod_estado_grafico_venta_por_vendedor = '0'; }
if (isset($_POST['cod_estado_grafico_extras'])) { $cod_estado_grafico_extras = intval($_POST['cod_estado_grafico_extras']); } else { $cod_estado_grafico_extras = '0'; }
if (isset($_POST['cod_estado_deshabilitar_und_venta_ventatemp'])) { $cod_estado_deshabilitar_und_venta_ventatemp = intval($_POST['cod_estado_deshabilitar_und_venta_ventatemp']); } else { $cod_estado_deshabilitar_und_venta_ventatemp = '0'; }
if (isset($_POST['cod_estado_deshabilitar_und_venta_atendido_cocina_chef'])) { $cod_estado_deshabilitar_und_venta_atendido_cocina_chef = intval($_POST['cod_estado_deshabilitar_und_venta_atendido_cocina_chef']); } else { $cod_estado_deshabilitar_und_venta_atendido_cocina_chef = '0'; }

if (isset($_POST['cod_estado_reporte_venta_total_ganancia'])) { $cod_estado_reporte_venta_total_ganancia = intval($_POST['cod_estado_reporte_venta_total_ganancia']); } else { $cod_estado_reporte_venta_total_ganancia = '0'; }
if (isset($_POST['cod_estado_reporte_venta_total_utilidad'])) { $cod_estado_reporte_venta_total_utilidad = intval($_POST['cod_estado_reporte_venta_total_utilidad']); } else { $cod_estado_reporte_venta_total_utilidad = '0'; }
if (isset($_POST['cod_estado_reporte_venta_total_comision'])) { $cod_estado_reporte_venta_total_comision = intval($_POST['cod_estado_reporte_venta_total_comision']); } else { $cod_estado_reporte_venta_total_comision = '0'; }
if (isset($_POST['cod_estado_reporte_venta_total_propina'])) { $cod_estado_reporte_venta_total_propina = intval($_POST['cod_estado_reporte_venta_total_propina']); } else { $cod_estado_reporte_venta_total_propina = '0'; }

if (isset($_POST['cod_estado_timbre_entrada_pedido_temporal_cocina'])) { $cod_estado_timbre_entrada_pedido_temporal_cocina = intval($_POST['cod_estado_timbre_entrada_pedido_temporal_cocina']); } else { $cod_estado_timbre_entrada_pedido_temporal_cocina = '0'; }
if (isset($_POST['cod_estado_timbre_salida_pedido_temporal_cocina'])) { $cod_estado_timbre_salida_pedido_temporal_cocina = intval($_POST['cod_estado_timbre_salida_pedido_temporal_cocina']); } else { $cod_estado_timbre_salida_pedido_temporal_cocina = '0'; }

if (isset($_POST['cod_estado_cuenta_cobrar_abono_glob'])) { $cod_estado_cuenta_cobrar_abono_glob = intval($_POST['cod_estado_cuenta_cobrar_abono_glob']); } else { $cod_estado_cuenta_cobrar_abono_glob = '0'; }
if (isset($_POST['cod_estado_origen_produccion'])) { $cod_estado_origen_produccion = intval($_POST['cod_estado_origen_produccion']); } else { $cod_estado_origen_produccion = '0'; }

if (isset($_POST['cod_estado_cantidad_caja_mesa'])) { $cod_estado_cantidad_caja_mesa = intval($_POST['cod_estado_cantidad_caja_mesa']); } else { $cod_estado_cantidad_caja_mesa = '0'; }
if (isset($_POST['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar'])) { $cod_estado_reporte_fecha_pago_venta_cuenta_cobrar = intval($_POST['cod_estado_reporte_fecha_pago_venta_cuenta_cobrar']); } else { $cod_estado_reporte_fecha_pago_venta_cuenta_cobrar = '0'; }
if (isset($_POST['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar'])) { $cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar = intval($_POST['cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar']); } else { $cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar = '0'; }
if (isset($_POST['cod_estado_reporte_mantenimiento'])) { $cod_estado_reporte_mantenimiento = intval($_POST['cod_estado_reporte_mantenimiento']); } else { $cod_estado_reporte_mantenimiento = '0'; }
if (isset($_POST['cod_estado_lista_puc'])) { $cod_estado_lista_puc = intval($_POST['cod_estado_lista_puc']); } else { $cod_estado_lista_puc = '0'; }
if (isset($_POST['cod_estado_licencia_sistema'])) { $cod_estado_licencia_sistema = intval($_POST['cod_estado_licencia_sistema']); } else { $cod_estado_licencia_sistema = '0'; }
if (isset($_POST['cod_estado_repositorio_sistema'])) { $cod_estado_repositorio_sistema = intval($_POST['cod_estado_repositorio_sistema']); } else { $cod_estado_repositorio_sistema = '0'; }
if (isset($_POST['cod_estado_resolucion_factura'])) { $cod_estado_resolucion_factura = intval($_POST['cod_estado_resolucion_factura']); } else { $cod_estado_resolucion_factura = '0'; }
if (isset($_POST['cod_estado_numero_letra'])) { $cod_estado_numero_letra = intval($_POST['cod_estado_numero_letra']); } else { $cod_estado_numero_letra = '0'; }
if (isset($_POST['cod_estado_abrir_cajon_monedero_driv_direct'])) { $cod_estado_abrir_cajon_monedero_driv_direct = intval($_POST['cod_estado_abrir_cajon_monedero_driv_direct']); } else { $cod_estado_abrir_cajon_monedero_driv_direct = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_diaria'])) { $cod_estado_subreporte_venta_diaria = intval($_POST['cod_estado_subreporte_venta_diaria']); } else { $cod_estado_subreporte_venta_diaria = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_mensual'])) { $cod_estado_subreporte_venta_mensual = intval($_POST['cod_estado_subreporte_venta_mensual']); } else { $cod_estado_subreporte_venta_mensual = '0'; }
if (isset($_POST['cod_estado_subreporte_venta_anual'])) { $cod_estado_subreporte_venta_anual = intval($_POST['cod_estado_subreporte_venta_anual']); } else { $cod_estado_subreporte_venta_anual = '0'; }
if (isset($_POST['cod_estado_subreporte_totalventa'])) { $cod_estado_subreporte_totalventa = intval($_POST['cod_estado_subreporte_totalventa']); } else { $cod_estado_subreporte_totalventa = '0'; }
if (isset($_POST['cod_estado_subreporte_impuestos'])) { $cod_estado_subreporte_impuestos = intval($_POST['cod_estado_subreporte_impuestos']); } else { $cod_estado_subreporte_impuestos = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasgenerales'])) { $cod_estado_subreporte_ventasgenerales = intval($_POST['cod_estado_subreporte_ventasgenerales']); } else { $cod_estado_subreporte_ventasgenerales = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporfacturas'])) { $cod_estado_subreporte_ventasporfacturas = intval($_POST['cod_estado_subreporte_ventasporfacturas']); } else { $cod_estado_subreporte_ventasporfacturas = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasportipofacturas'])) { $cod_estado_subreporte_ventasportipofacturas = intval($_POST['cod_estado_subreporte_ventasportipofacturas']); } else { $cod_estado_subreporte_ventasportipofacturas = '0'; }
if (isset($_POST['cod_estado_subreporte_ventaspordependencia'])) { $cod_estado_subreporte_ventaspordependencia = intval($_POST['cod_estado_subreporte_ventaspordependencia']); } else { $cod_estado_subreporte_ventaspordependencia = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasportipoproducto'])) { $cod_estado_subreporte_ventasportipoproducto = intval($_POST['cod_estado_subreporte_ventasportipoproducto']); } else { $cod_estado_subreporte_ventasportipoproducto = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporvendedor'])) { $cod_estado_subreporte_ventasporvendedor = intval($_POST['cod_estado_subreporte_ventasporvendedor']); } else { $cod_estado_subreporte_ventasporvendedor = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporpropinavendedor'])) { $cod_estado_subreporte_ventasporpropinavendedor = intval($_POST['cod_estado_subreporte_ventasporpropinavendedor']); } else { $cod_estado_subreporte_ventasporpropinavendedor = '0'; }
if (isset($_POST['cod_estado_subreporte_ventasporcreditocliente'])) { $cod_estado_subreporte_ventasporcreditocliente = intval($_POST['cod_estado_subreporte_ventasporcreditocliente']); } else { $cod_estado_subreporte_ventasporcreditocliente = '0'; }
if (isset($_POST['cod_estado_dependencia_sub'])) { $cod_estado_dependencia_sub = intval($_POST['cod_estado_dependencia_sub']); } else { $cod_estado_dependencia_sub = '0'; }
if (isset($_POST['cod_estado_precio_venta_variable_disponible'])) { $cod_estado_precio_venta_variable_disponible = intval($_POST['cod_estado_precio_venta_variable_disponible']); } else { $cod_estado_precio_venta_variable_disponible = '0'; }
if (isset($_POST['cod_estado_habilitar_precio_venta_producto'])) { $cod_estado_habilitar_precio_venta_producto = intval($_POST['cod_estado_habilitar_precio_venta_producto']); } else { $cod_estado_habilitar_precio_venta_producto = '0'; }
if (isset($_POST['cod_estado_und_producto_factura_compra'])) { $cod_estado_und_producto_factura_compra = intval($_POST['cod_estado_und_producto_factura_compra']); } else { $cod_estado_und_producto_factura_compra = '0'; }
if (isset($_POST['cod_estado_edit_precio_venta_btn_factura_venta'])) { $cod_estado_edit_precio_venta_btn_factura_venta = intval($_POST['cod_estado_edit_precio_venta_btn_factura_venta']); } else { $cod_estado_edit_precio_venta_btn_factura_venta = '0'; }
if (isset($_POST['cod_estado_edit_precio_venta_pvar_factura_venta'])) { $cod_estado_edit_precio_venta_pvar_factura_venta = intval($_POST['cod_estado_edit_precio_venta_pvar_factura_venta']); } else { $cod_estado_edit_precio_venta_pvar_factura_venta = '0'; }
if (isset($_POST['cod_estado_edit_precio_venta_precio_estatico_factura_venta'])) { $cod_estado_edit_precio_venta_precio_estatico_factura_venta = intval($_POST['cod_estado_edit_precio_venta_precio_estatico_factura_venta']); } else { $cod_estado_edit_precio_venta_precio_estatico_factura_venta = '0'; }
if (isset($_POST['cod_estado_cambiar_vendedor_al_vender'])) { $cod_estado_cambiar_vendedor_al_vender = intval($_POST['cod_estado_cambiar_vendedor_al_vender']); } else { $cod_estado_cambiar_vendedor_al_vender = '0'; }
if (isset($_POST['cod_estado_observacion_factura_compra'])) { $cod_estado_observacion_factura_compra = intval($_POST['cod_estado_observacion_factura_compra']); } else { $cod_estado_observacion_factura_compra = '0'; }
if (isset($_POST['cod_estado_observacion_factura_venta'])) { $cod_estado_observacion_factura_venta = intval($_POST['cod_estado_observacion_factura_venta']); } else { $cod_estado_observacion_factura_venta = '0'; }
if (isset($_POST['cod_estado_fecha_entrega_factura_compra'])) { $cod_estado_fecha_entrega_factura_compra = intval($_POST['cod_estado_fecha_entrega_factura_compra']); } else { $cod_estado_fecha_entrega_factura_compra = '0'; }
if (isset($_POST['cod_estado_fecha_entrega_factura_venta'])) { $cod_estado_fecha_entrega_factura_venta = intval($_POST['cod_estado_fecha_entrega_factura_venta']); } else { $cod_estado_fecha_entrega_factura_venta = '0'; }


$sql_data = sprintf("UPDATE tbl15_administrador SET 
cod_estado_prod = '$cod_estado_prod',
cod_estado_prod_reg_producto = '$cod_estado_prod_reg_producto', cod_estado_prod_asig_subproducto = '$cod_estado_prod_asig_subproducto',
cod_estado_prod_cargar_factura_compra = '$cod_estado_prod_cargar_factura_compra', cod_estado_prod_cargar_factura_compra_soporte = '$cod_estado_prod_cargar_factura_compra_soporte',
cod_estado_prod_cargar_factura_compra_observacion = '$cod_estado_prod_cargar_factura_compra_observacion', cod_estado_prod_transferencia = '$cod_estado_prod_transferencia',
cod_estado_prod_auditoria = '$cod_estado_prod_auditoria', cod_estado_prod_nuevo_invenario = '$cod_estado_prod_nuevo_invenario',
cod_estado_prod_inventario_producto = '$cod_estado_prod_inventario_producto', cod_estado_prod_registrar = '$cod_estado_prod_registrar',
cod_estado_prod_editar = '$cod_estado_prod_editar', cod_estado_prod_eliminar = '$cod_estado_prod_eliminar',
cod_estado_prod_imprimir = '$cod_estado_prod_imprimir', cod_estado_prod_exportar = '$cod_estado_prod_exportar',
cod_estado_prod_subproducto = '$cod_estado_prod_subproducto', cod_estado_prod_und_producto = '$cod_estado_prod_und_producto',
cod_estado_prod_und_producto_bodega = '$cod_estado_prod_und_producto_bodega', cod_estado_prod_precio_compra_producto = '$cod_estado_prod_precio_compra_producto',
cod_estado_prod_precio_costo_producto = '$cod_estado_prod_precio_costo_producto', cod_estado_prod_precio_venta_producto = '$cod_estado_prod_precio_venta_producto',
cod_estado_prod_precio_venta_producto2 = '$cod_estado_prod_precio_venta_producto2', cod_estado_prod_precio_venta_producto3 = '$cod_estado_prod_precio_venta_producto3',
cod_estado_prod_precio_venta_producto4 = '$cod_estado_prod_precio_venta_producto4', cod_estado_prod_precio_venta_producto5 = '$cod_estado_prod_precio_venta_producto5',
cod_estado_prod_nombre_tipo_unidad_medida = '$cod_estado_prod_nombre_tipo_unidad_medida', cod_estado_prod_iva_ptj = '$cod_estado_prod_iva_ptj',
cod_estado_prod_nombre_tipo_producto = '$cod_estado_prod_nombre_tipo_producto', cod_estado_prod_cod_marca = '$cod_estado_prod_cod_marca',
cod_estado_prod_cod_proveedor = '$cod_estado_prod_cod_proveedor', cod_estado_prod_cod_tercero = '$cod_estado_prod_cod_tercero',
cod_estado_prod_cod_estado = '$cod_estado_prod_cod_estado', cod_estado_prod_cod_dependencia = '$cod_estado_prod_cod_dependencia',
cod_estado_prod_fecha_ult_compra = '$cod_estado_prod_fecha_ult_compra', cod_estado_prod_fecha_ult_venta = '$cod_estado_prod_fecha_ult_venta',
cod_estado_prod_fecha_vencimiento = '$cod_estado_prod_fecha_vencimiento', cod_estado_prod_tope_min = '$cod_estado_prod_tope_min',
cod_estado_prod_fecha_creacion = '$cod_estado_prod_fecha_creacion', cod_estado_prod_fecha_modificacion = '$cod_estado_prod_fecha_modificacion',
cod_estado_prod_nombre_tipo_precio_venta = '$cod_estado_prod_nombre_tipo_precio_venta', cod_estado_prod_url_img_orig_producto = '$cod_estado_prod_url_img_orig_producto',
cod_estado_prod_url_img_min_producto = '$cod_estado_prod_url_img_min_producto', cod_estado_prod_comision_ptj = '$cod_estado_prod_comision_ptj',
cod_estado_prod_dto1 = '$cod_estado_prod_dto1', cod_estado_prod_dto2 = '$cod_estado_prod_dto2', cod_estado_prod_ipc_ptj = '$cod_estado_prod_ipc_ptj',
cod_estado_prod_precio_ipc = '$cod_estado_prod_precio_ipc', cod_estado_prod_ret_ica_ptj = '$cod_estado_prod_ret_ica_ptj',
cod_estado_prod_iva_teorico_ptj = '$cod_estado_prod_iva_teorico_ptj', cod_estado_prod_tarifa_rete_vigente_ptj = '$cod_estado_prod_tarifa_rete_vigente_ptj',
cod_estado_prod_rete_iva_asumido_ptj = '$cod_estado_prod_rete_iva_asumido_ptj', cod_estado_prod_nombre_tipo_compra = '$cod_estado_prod_nombre_tipo_compra',
cod_estado_prod_nombre_tipo_cargue_factura = '$cod_estado_prod_nombre_tipo_cargue_factura', cod_estado_prod_nombre_tipo_medida = '$cod_estado_prod_nombre_tipo_medida',
cod_estado_prod_cajas_sobre = '$cod_estado_prod_cajas_sobre', cod_estado_prod_und_sobre = '$cod_estado_prod_und_sobre',
cod_estado_prod_cod_interno = '$cod_estado_prod_cod_interno', cod_estado_prod_cod_original = '$cod_estado_prod_cod_original',
cod_estado_prod_codificacion = '$cod_estado_prod_codificacion', cod_estado_prod_cod_producto_serial = '$cod_estado_prod_cod_producto_serial',
cod_estado_prod_fecha_mantenimiento = '$cod_estado_prod_fecha_mantenimiento', cod_estado_prod_peso_producto = '$cod_estado_prod_peso_producto',
cod_estado_prod_cod_rodeo = '$cod_estado_prod_cod_rodeo', cod_estado_prod_nombre_rodeo = '$cod_estado_prod_nombre_rodeo',
cod_estado_prod_nombre_sexo = '$cod_estado_prod_nombre_sexo', cod_estado_prod_de_monta = '$cod_estado_prod_de_monta',
cod_estado_prod_nombre_estatus = '$cod_estado_prod_nombre_estatus', cod_estado_prod_nombre_condicion_corporal = '$cod_estado_prod_nombre_condicion_corporal',
cod_estado_prod_nombre_categoria_ingreso = '$cod_estado_prod_nombre_categoria_ingreso', cod_estado_prod_nombre_categoria_actual = '$cod_estado_prod_nombre_categoria_actual',
cod_estado_prod_nombre_categoria_futura = '$cod_estado_prod_nombre_categoria_futura', cod_estado_prod_nombre_procedencia = '$cod_estado_prod_nombre_procedencia',
cod_estado_prod_nombre_tipo_monta = '$cod_estado_prod_nombre_tipo_monta', cod_estado_prod_nombre_lote_categoria = '$cod_estado_prod_nombre_lote_categoria',
cod_estado_prod_nombre_prog_reproductivo = '$cod_estado_prod_nombre_prog_reproductivo', cod_estado_prod_nombre_potrero = '$cod_estado_prod_nombre_potrero',
cod_estado_prod_nombre_lote = '$cod_estado_prod_nombre_lote', cod_estado_prod_nombre_calidad_animal = '$cod_estado_prod_nombre_calidad_animal',
cod_estado_prod_nombre_tipo_explotacion = '$cod_estado_prod_nombre_tipo_explotacion', cod_estado_prod_peso_compra = '$cod_estado_prod_peso_compra',
cod_estado_prod_precio_compra = '$cod_estado_prod_precio_compra', cod_estado_prod_fecha_nac = '$cod_estado_prod_fecha_nac',
cod_estado_prod_fecha_compra = '$cod_estado_prod_fecha_compra', cod_estado_prod_fecha_castracion = '$cod_estado_prod_fecha_castracion',
cod_estado_prod_nro_hierros = '$cod_estado_prod_nro_hierros', cod_estado_prod_hierro_animal = '$cod_estado_prod_hierro_animal',
cod_estado_prod_numero_partos = '$cod_estado_prod_numero_partos', cod_estado_prod_id_electronica = '$cod_estado_prod_id_electronica',
cod_estado_prod_nombre_raza1 = '$cod_estado_prod_nombre_raza1', cod_estado_prod_nombre_raza2 = '$cod_estado_prod_nombre_raza2',
cod_estado_prod_nombre_raza3 = '$cod_estado_prod_nombre_raza3', cod_estado_prod_nombre_raza4 = '$cod_estado_prod_nombre_raza4',
cod_estado_prod_ptj_raza1 = '$cod_estado_prod_ptj_raza1', cod_estado_prod_ptj_raza2 = '$cod_estado_prod_ptj_raza2',
cod_estado_prod_ptj_raza3 = '$cod_estado_prod_ptj_raza3', cod_estado_prod_ptj_raza4 = '$cod_estado_prod_ptj_raza4',
cod_estado_prod_id_padre = '$cod_estado_prod_id_padre', cod_estado_prod_raza_padre = '$cod_estado_prod_raza_padre',
cod_estado_prod_id_madre = '$cod_estado_prod_id_madre', cod_estado_prod_raza_madre = '$cod_estado_prod_raza_madre',
cod_estado_prod_partos_madre = '$cod_estado_prod_partos_madre', cod_estado_prod_id_abuelo_paterno = '$cod_estado_prod_id_abuelo_paterno',
cod_estado_prod_id_abuelo_materno = '$cod_estado_prod_id_abuelo_materno', cod_estado_prod_nombre_abuelo_paterno = '$cod_estado_prod_nombre_abuelo_paterno',
cod_estado_prod_nombre_abuelo_materno = '$cod_estado_prod_nombre_abuelo_materno', cod_estado_prod_raza_abuelo_paterno = '$cod_estado_prod_raza_abuelo_paterno',
cod_estado_prod_raza_abuelo_materno = '$cod_estado_prod_raza_abuelo_materno', cod_estado_prod_id_abuela_paterno = '$cod_estado_prod_id_abuela_paterno',
cod_estado_prod_id_abuela_materno = '$cod_estado_prod_id_abuela_materno', cod_estado_prod_nombre_abuela_paterno = '$cod_estado_prod_nombre_abuela_paterno',
cod_estado_prod_nombre_abuela_materno = '$cod_estado_prod_nombre_abuela_materno', cod_estado_prod_raza_abuela_paterno = '$cod_estado_prod_raza_abuela_paterno',
cod_estado_prod_raza_abuela_materno = '$cod_estado_prod_raza_abuela_materno', cod_estado_prod_nombre_tipo_concepcion = '$cod_estado_prod_nombre_tipo_concepcion',
cod_estado_prod_nombre_especie = '$cod_estado_prod_nombre_especie', cod_estado_prod_marcas_tatuado = '$cod_estado_prod_marcas_tatuado',
cod_estado_prod_marcas_herrado = '$cod_estado_prod_marcas_herrado', cod_estado_prod_marcas_descornado = '$cod_estado_prod_marcas_descornado',
cod_estado_prod_marcas_castrado = '$cod_estado_prod_marcas_castrado', cod_estado_prod_nombre_color = '$cod_estado_prod_nombre_color',
cod_estado_prod_nombre_temperamento = '$cod_estado_prod_nombre_temperamento', cod_estado_prod_peso_nacer = '$cod_estado_prod_peso_nacer',
cod_estado_prod_aplomo_corvejon = '$cod_estado_prod_aplomo_corvejon', cod_estado_prod_aplomo_cuartilla = '$cod_estado_prod_aplomo_cuartilla',
cod_estado_prod_aplomo_cascos = '$cod_estado_prod_aplomo_cascos', cod_estado_prod_genital_circun_escrotal = '$cod_estado_prod_genital_circun_escrotal',
cod_estado_prod_genital_prepusio = '$cod_estado_prod_genital_prepusio', cod_estado_prod_genital_potencia = '$cod_estado_prod_genital_potencia',
cod_estado_prod_genital_semen = '$cod_estado_prod_genital_semen', cod_estado_prod_observacion_animal = '$cod_estado_prod_observacion_animal',
cod_estado_prod_nombre_estado = '$cod_estado_prod_nombre_estado', cod_estado_prod_nombre_tipo_movimiento = '$cod_estado_prod_nombre_tipo_movimiento',
cod_estado_prod_nombre_categoria_animal_extern = '$cod_estado_prod_nombre_categoria_animal_extern', cod_estado_prod_cod_finca = '$cod_estado_prod_cod_finca',
cod_estado_prod_nombre_finca = '$cod_estado_prod_nombre_finca', cod_estado_prod_nombre_categoria = '$cod_estado_prod_nombre_categoria',
cod_estado_prod_nombre_categoria_sub = '$cod_estado_prod_nombre_categoria_sub', cod_estado_prod_und_inv = '$cod_estado_prod_und_inv',
cod_estado_prod_descripcion_producto = '$cod_estado_prod_descripcion_producto', cod_estado_prod_url_img_producto_min = '$cod_estado_prod_url_img_producto_min',
cod_estado_prod_url_img_producto_orig = '$cod_estado_prod_url_img_producto_orig', cod_estado_prod_nombre_promocion = '$cod_estado_prod_nombre_promocion',
cod_estado_prod_nombre_promocion_ing = '$cod_estado_prod_nombre_promocion_ing', cod_estado_prod_posologia_cantidad = '$cod_estado_prod_posologia_cantidad',
cod_estado_prod_posologia_peso = '$cod_estado_prod_posologia_peso', cod_estado_prod_nombre_tipo_presentacion = '$cod_estado_prod_nombre_tipo_presentacion',
cod_estado_prod_nombre_via_administracion = '$cod_estado_prod_nombre_via_administracion', cod_estado_prod_nombre_frec_duracion = '$cod_estado_prod_nombre_frec_duracion',
cod_estado_plan_separe = '$cod_estado_plan_separe', cod_estado_plan_separe_registrar = '$cod_estado_plan_separe_registrar',
cod_estado_plan_separe_editar = '$cod_estado_plan_separe_editar', cod_estado_plan_separe_eliminar = '$cod_estado_plan_separe_eliminar',
cod_estado_plan_separe_imprimir = '$cod_estado_plan_separe_imprimir', cod_estado_plan_separe_exportar = '$cod_estado_plan_separe_exportar',
cod_estado_contabilidad = '$cod_estado_contabilidad', cod_estado_contabilidad_mov_contable = '$cod_estado_contabilidad_mov_contable',
cod_estado_contabilidad_mov_contable_registrar = '$cod_estado_contabilidad_mov_contable_registrar', cod_estado_contabilidad_mov_contable_editar = '$cod_estado_contabilidad_mov_contable_editar',
cod_estado_contabilidad_mov_contable_eliminar = '$cod_estado_contabilidad_mov_contable_eliminar', cod_estado_contabilidad_mov_contable_imprimir = '$cod_estado_contabilidad_mov_contable_imprimir',
cod_estado_contabilidad_mov_contable_exportar = '$cod_estado_contabilidad_mov_contable_exportar', cod_estado_contabilidad_pyg = '$cod_estado_contabilidad_pyg',
cod_estado_contabilidad_pyg_registrar = '$cod_estado_contabilidad_pyg_registrar', cod_estado_contabilidad_pyg_editar = '$cod_estado_contabilidad_pyg_editar',
cod_estado_contabilidad_pyg_eliminar = '$cod_estado_contabilidad_pyg_eliminar', cod_estado_contabilidad_pyg_imprimir = '$cod_estado_contabilidad_pyg_imprimir',
cod_estado_contabilidad_pyg_exportar = '$cod_estado_contabilidad_pyg_exportar', cod_estado_contabilidad_balance = '$cod_estado_contabilidad_balance',
cod_estado_contabilidad_balance_pyg_registrar = '$cod_estado_contabilidad_balance_pyg_registrar', cod_estado_contabilidad_balance_pyg_editar = '$cod_estado_contabilidad_balance_pyg_editar',
cod_estado_contabilidad_balance_pyg_eliminar = '$cod_estado_contabilidad_balance_pyg_eliminar', cod_estado_contabilidad_balance_pyg_imprimir = '$cod_estado_contabilidad_balance_pyg_imprimir',
cod_estado_contabilidad_balance_pyg_exportar = '$cod_estado_contabilidad_balance_pyg_exportar', cod_estado_contabilidad_puc = '$cod_estado_contabilidad_puc',
cod_estado_contabilidad_puc_registrar = '$cod_estado_contabilidad_puc_registrar', cod_estado_contabilidad_puc_editar = '$cod_estado_contabilidad_puc_editar',
cod_estado_contabilidad_puc_eliminar = '$cod_estado_contabilidad_puc_eliminar', cod_estado_contabilidad_puc_imprimir = '$cod_estado_contabilidad_puc_imprimir',
cod_estado_contabilidad_puc_exportar = '$cod_estado_contabilidad_puc_exportar', cod_estado_facturacion = '$cod_estado_facturacion',
cod_estado_facturacion_venta = '$cod_estado_facturacion_venta', cod_estado_facturacion_venta_registrar = '$cod_estado_facturacion_venta_registrar',
cod_estado_facturacion_venta_editar = '$cod_estado_facturacion_venta_editar', cod_estado_facturacion_venta_eliminar = '$cod_estado_facturacion_venta_eliminar',
cod_estado_facturacion_venta_imprimir = '$cod_estado_facturacion_venta_imprimir', cod_estado_facturacion_venta_exportar = '$cod_estado_facturacion_venta_exportar',
cod_estado_facturacion_venta_devol = '$cod_estado_facturacion_venta_devol', cod_estado_facturacion_compra = '$cod_estado_facturacion_compra',
cod_estado_facturacion_compra_registrar = '$cod_estado_facturacion_compra_registrar', cod_estado_facturacion_compra_editar = '$cod_estado_facturacion_compra_editar',
cod_estado_facturacion_compra_eliminar = '$cod_estado_facturacion_compra_eliminar', cod_estado_facturacion_compra_imprimir = '$cod_estado_facturacion_compra_imprimir',
cod_estado_facturacion_compra_exportar = '$cod_estado_facturacion_compra_exportar', cod_estado_facturacion_compra_devol = '$cod_estado_facturacion_compra_devol',
cod_estado_facturacion_devol_venta = '$cod_estado_facturacion_devol_venta', cod_estado_facturacion_devol_inventario = '$cod_estado_facturacion_devol_inventario',
cod_estado_cotizacion = '$cod_estado_cotizacion', cod_estado_cotizacion_venta = '$cod_estado_cotizacion_venta',
cod_estado_cotizacion_venta_registrar = '$cod_estado_cotizacion_venta_registrar', cod_estado_cotizacion_venta_editar = '$cod_estado_cotizacion_venta_editar',
cod_estado_cotizacion_venta_eliminar = '$cod_estado_cotizacion_venta_eliminar', cod_estado_cotizacion_venta_imprimir = '$cod_estado_cotizacion_venta_imprimir',
cod_estado_cotizacion_venta_exportar = '$cod_estado_cotizacion_venta_exportar', cod_estado_cotizacion_compra = '$cod_estado_cotizacion_compra',
cod_estado_cotizacion_compra_registrar = '$cod_estado_cotizacion_compra_registrar', cod_estado_cotizacion_compra_editar = '$cod_estado_cotizacion_compra_editar',
cod_estado_cotizacion_compra_eliminar = '$cod_estado_cotizacion_compra_eliminar', cod_estado_cotizacion_compra_imprimir = '$cod_estado_cotizacion_compra_imprimir',
cod_estado_cotizacion_compra_exportar = '$cod_estado_cotizacion_compra_exportar', cod_estado_venta = '$cod_estado_venta',
cod_estado_venta_manual = '$cod_estado_venta_manual', cod_estado_venta_barras = '$cod_estado_venta_barras', cod_estado_venta_fecha_venta = '$cod_estado_venta_fecha_venta',
cod_estado_venta_preventa = '$cod_estado_venta_preventa', cod_estado_venta_propina = '$cod_estado_venta_propina', cod_estado_venta_bolsa = '$cod_estado_venta_bolsa',
cod_estado_venta_observacion = '$cod_estado_venta_observacion', cod_estado_tercero = '$cod_estado_tercero', cod_estado_tercero_registrar = '$cod_estado_tercero_registrar',
cod_estado_tercero_editar = '$cod_estado_tercero_editar', cod_estado_tercero_eliminar = '$cod_estado_tercero_eliminar', cod_estado_tercero_imprimir = '$cod_estado_tercero_imprimir',
cod_estado_tercero_exportar = '$cod_estado_tercero_exportar', cod_estado_cita = '$cod_estado_cita', cod_estado_cita_registrar = '$cod_estado_cita_registrar',
cod_estado_cita_editar = '$cod_estado_cita_editar', cod_estado_cita_eliminar = '$cod_estado_cita_eliminar', cod_estado_cita_imprimir = '$cod_estado_cita_imprimir',
cod_estado_cita_exportar = '$cod_estado_cita_exportar', cod_estado_cuenta = '$cod_estado_cuenta', cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar',
cod_estado_cuenta_cobrar_registrar = '$cod_estado_cuenta_cobrar_registrar', cod_estado_cuenta_cobrar_editar = '$cod_estado_cuenta_cobrar_editar',
cod_estado_cuenta_cobrar_eliminar = '$cod_estado_cuenta_cobrar_eliminar', cod_estado_cuenta_cobrar_imprimir = '$cod_estado_cuenta_cobrar_imprimir',
cod_estado_cuenta_cobrar_exportar = '$cod_estado_cuenta_cobrar_exportar', cod_estado_cuenta_pagar = '$cod_estado_cuenta_pagar',
cod_estado_cuenta_pagar_registrar = '$cod_estado_cuenta_pagar_registrar', cod_estado_cuenta_pagar_editar = '$cod_estado_cuenta_pagar_editar',
cod_estado_cuenta_pagar_eliminar = '$cod_estado_cuenta_pagar_eliminar', cod_estado_cuenta_pagar_imprimir = '$cod_estado_cuenta_pagar_imprimir',
cod_estado_cuenta_pagar_exportar = '$cod_estado_cuenta_pagar_exportar', cod_estado_cierre_caja = '$cod_estado_cierre_caja',
cod_estado_cierre_caja_registrar = '$cod_estado_cierre_caja_registrar', cod_estado_cierre_caja_editar = '$cod_estado_cierre_caja_editar',
cod_estado_cierre_caja_eliminar = '$cod_estado_cierre_caja_eliminar', cod_estado_cierre_caja_imprimir = '$cod_estado_cierre_caja_imprimir',
cod_estado_cierre_caja_exportar = '$cod_estado_cierre_caja_exportar', cod_estado_egreso = '$cod_estado_egreso', cod_estado_egreso_registrar = '$cod_estado_egreso_registrar',
cod_estado_egreso_editar = '$cod_estado_egreso_editar', cod_estado_egreso_eliminar = '$cod_estado_egreso_eliminar', cod_estado_egreso_imprimir = '$cod_estado_egreso_imprimir',
cod_estado_egreso_exportar = '$cod_estado_egreso_exportar', cod_estado_sticker_barra = '$cod_estado_sticker_barra', cod_estado_sticker_barra_registrar = '$cod_estado_sticker_barra_registrar',
cod_estado_sticker_barra_editar = '$cod_estado_sticker_barra_editar', cod_estado_sticker_barra_eliminar = '$cod_estado_sticker_barra_eliminar',
cod_estado_sticker_barra_imprimir = '$cod_estado_sticker_barra_imprimir', cod_estado_sticker_barra_exportar = '$cod_estado_sticker_barra_exportar',
cod_estado_sticker_barra_observacion = '$cod_estado_sticker_barra_observacion', cod_estado_sticker_barra_archivo_plano = '$cod_estado_sticker_barra_archivo_plano',
cod_estado_reporte = '$cod_estado_reporte', cod_estado_reporte_venta = '$cod_estado_reporte_venta', cod_estado_reporte_venta_registrar = '$cod_estado_reporte_venta_registrar',
cod_estado_reporte_venta_editar = '$cod_estado_reporte_venta_editar', cod_estado_reporte_venta_eliminar = '$cod_estado_reporte_venta_eliminar',
cod_estado_reporte_venta_imprimir = '$cod_estado_reporte_venta_imprimir', cod_estado_reporte_venta_exportar = '$cod_estado_reporte_venta_exportar',
cod_estado_reporte_compra = '$cod_estado_reporte_compra', cod_estado_reporte_compra_registrar = '$cod_estado_reporte_compra_registrar',
cod_estado_reporte_compra_editar = '$cod_estado_reporte_compra_editar', cod_estado_reporte_compra_eliminar = '$cod_estado_reporte_compra_eliminar',
cod_estado_reporte_compra_imprimir = '$cod_estado_reporte_compra_imprimir', cod_estado_reporte_compra_exportar = '$cod_estado_reporte_compra_exportar',
cod_estado_reporte_general = '$cod_estado_reporte_general', cod_estado_reporte_general_registrar = '$cod_estado_reporte_general_registrar',
cod_estado_reporte_general_editar = '$cod_estado_reporte_general_editar', cod_estado_reporte_general_eliminar = '$cod_estado_reporte_general_eliminar',
cod_estado_reporte_general_imprimir = '$cod_estado_reporte_general_imprimir', cod_estado_reporte_general_exportar = '$cod_estado_reporte_general_exportar',
cod_estado_reporte_mov_contable = '$cod_estado_reporte_mov_contable', cod_estado_reporte_mov_contable_registrar = '$cod_estado_reporte_mov_contable_registrar',
cod_estado_reporte_mov_contable_editar = '$cod_estado_reporte_mov_contable_editar', cod_estado_reporte_mov_contable_eliminar = '$cod_estado_reporte_mov_contable_eliminar',
cod_estado_reporte_mov_contable_imprimir = '$cod_estado_reporte_mov_contable_imprimir', cod_estado_reporte_mov_contable_exportar = '$cod_estado_reporte_mov_contable_exportar',
cod_estado_reporte_venta_por_producto = '$cod_estado_reporte_venta_por_producto', cod_estado_reporte_venta_por_producto_registrar = '$cod_estado_reporte_venta_por_producto_registrar',
cod_estado_reporte_venta_por_producto_editar = '$cod_estado_reporte_venta_por_producto_editar', cod_estado_reporte_venta_por_producto_eliminar = '$cod_estado_reporte_venta_por_producto_eliminar',
cod_estado_reporte_venta_por_producto_imprimir = '$cod_estado_reporte_venta_por_producto_imprimir', cod_estado_reporte_venta_por_producto_exportar = '$cod_estado_reporte_venta_por_producto_exportar',
cod_estado_reporte_inventario = '$cod_estado_reporte_inventario', cod_estado_reporte_inventario_registrar = '$cod_estado_reporte_inventario_registrar',
cod_estado_reporte_inventario_editar = '$cod_estado_reporte_inventario_editar', cod_estado_reporte_inventario_eliminar = '$cod_estado_reporte_inventario_eliminar',
cod_estado_reporte_inventario_imprimir = '$cod_estado_reporte_inventario_imprimir', cod_estado_reporte_inventario_exportar = '$cod_estado_reporte_inventario_exportar',
cod_estado_reporte_prodcuto_vencer = '$cod_estado_reporte_prodcuto_vencer', cod_estado_reporte_prodcuto_vencer_registrar = '$cod_estado_reporte_prodcuto_vencer_registrar',
cod_estado_reporte_prodcuto_vencer_editar = '$cod_estado_reporte_prodcuto_vencer_editar', cod_estado_reporte_prodcuto_vencer_eliminar = '$cod_estado_reporte_prodcuto_vencer_eliminar',
cod_estado_reporte_prodcuto_vencer_imprimir = '$cod_estado_reporte_prodcuto_vencer_imprimir', cod_estado_reporte_prodcuto_vencer_exportar = '$cod_estado_reporte_prodcuto_vencer_exportar',
cod_estado_reporte_prodcuto_mantenimiento = '$cod_estado_reporte_prodcuto_mantenimiento', cod_estado_reporte_prodcuto_mantenimiento_registrar = '$cod_estado_reporte_prodcuto_mantenimiento_registrar',
cod_estado_reporte_prodcuto_mantenimiento_editar = '$cod_estado_reporte_prodcuto_mantenimiento_editar', cod_estado_reporte_prodcuto_mantenimiento_eliminar = '$cod_estado_reporte_prodcuto_mantenimiento_eliminar',
cod_estado_reporte_prodcuto_mantenimiento_imprimir = '$cod_estado_reporte_prodcuto_mantenimiento_imprimir', cod_estado_reporte_prodcuto_mantenimiento_exportar = '$cod_estado_reporte_prodcuto_mantenimiento_exportar',
cod_estado_reporte_cumplanos_tercero = '$cod_estado_reporte_cumplanos_tercero', cod_estado_reporte_cumplanos_tercero_registrar = '$cod_estado_reporte_cumplanos_tercero_registrar',
cod_estado_reporte_cumplanos_tercero_editar = '$cod_estado_reporte_cumplanos_tercero_editar', cod_estado_reporte_cumplanos_tercero_eliminar = '$cod_estado_reporte_cumplanos_tercero_eliminar',
cod_estado_reporte_cumplanos_tercero_imprimir = '$cod_estado_reporte_cumplanos_tercero_imprimir', cod_estado_reporte_cumplanos_tercero_exportar = '$cod_estado_reporte_cumplanos_tercero_exportar',
cod_estado_admin = '$cod_estado_admin', cod_estado_info_empresa = '$cod_estado_info_empresa', cod_estado_info_empresa_registrar = '$cod_estado_info_empresa_registrar',
cod_estado_info_empresa_editar = '$cod_estado_info_empresa_editar', cod_estado_info_empresa_eliminar = '$cod_estado_info_empresa_eliminar',
cod_estado_info_empresa_imprimir = '$cod_estado_info_empresa_imprimir', cod_estado_info_empresa_exportar = '$cod_estado_info_empresa_exportar',
cod_estado_usuario = '$cod_estado_usuario', cod_estado_usuario_registrar = '$cod_estado_usuario_registrar', cod_estado_usuario_editar = '$cod_estado_usuario_editar',
cod_estado_usuario_eliminar = '$cod_estado_usuario_eliminar', cod_estado_usuario_imprimir = '$cod_estado_usuario_imprimir', cod_estado_usuario_exportar = '$cod_estado_usuario_exportar',
cod_estado_dependencia = '$cod_estado_dependencia', cod_estado_dependencia_registrar = '$cod_estado_dependencia_registrar', cod_estado_dependencia_editar = '$cod_estado_dependencia_editar',
cod_estado_dependencia_eliminar = '$cod_estado_dependencia_eliminar', cod_estado_dependencia_imprimir = '$cod_estado_dependencia_imprimir',
cod_estado_dependencia_exportar = '$cod_estado_dependencia_exportar', cod_estado_resol_facturacion = '$cod_estado_resol_facturacion',
cod_estado_resol_facturacion_registrar = '$cod_estado_resol_facturacion_registrar', cod_estado_resol_facturacion_editar = '$cod_estado_resol_facturacion_editar',
cod_estado_resol_facturacion_eliminar = '$cod_estado_resol_facturacion_eliminar', cod_estado_resol_facturacion_imprimir = '$cod_estado_resol_facturacion_imprimir',
cod_estado_resol_facturacion_exportar = '$cod_estado_resol_facturacion_exportar', cod_estado_numero_letras = '$cod_estado_numero_letras',
cod_estado_numero_letras_registrar = '$cod_estado_numero_letras_registrar', cod_estado_numero_letras_editar = '$cod_estado_numero_letras_editar',
cod_estado_numero_letras_eliminar = '$cod_estado_numero_letras_eliminar', cod_estado_numero_letras_imprimir = '$cod_estado_numero_letras_imprimir',
cod_estado_numero_letras_exportar = '$cod_estado_numero_letras_exportar', cod_estado_eliminar = '$cod_estado_eliminar', cod_estado_eliminar_usuario = '$cod_estado_eliminar_usuario',
cod_estado_eliminar_tercero = '$cod_estado_eliminar_tercero', cod_estado_eliminar_producto = '$cod_estado_eliminar_producto', cod_estado_licencia = '$cod_estado_licencia',
cod_estado_licencia_registrar = '$cod_estado_licencia_registrar', cod_estado_licencia_editar = '$cod_estado_licencia_editar', cod_estado_licencia_imprimir = '$cod_estado_licencia_imprimir',
cod_estado_licencia_exportar = '$cod_estado_licencia_exportar', cod_estado_repositorio = '$cod_estado_repositorio', cod_estado_repositorio_registrar = '$cod_estado_repositorio_registrar',
cod_estado_repositorio_editar = '$cod_estado_repositorio_editar', cod_estado_repositorio_eliminar = '$cod_estado_repositorio_eliminar',
cod_estado_repositorio_imprimir = '$cod_estado_repositorio_imprimir', cod_estado_repositorio_exportar = '$cod_estado_repositorio_exportar', 
cod_estado_prod_subproducto_registrar = '$cod_estado_prod_subproducto_registrar', cod_estado_prod_subproducto_editar = '$cod_estado_prod_subproducto_editar', cod_estado_prod_subproducto_eliminar = '$cod_estado_prod_subproducto_eliminar', 
cod_estado_prod_subproducto_imprimir = '$cod_estado_prod_subproducto_imprimir', cod_estado_prod_subproducto_exportar = '$cod_estado_prod_subproducto_exportar', 
cod_estado_prod_transferencia_registrar = '$cod_estado_prod_transferencia_registrar', cod_estado_prod_transferencia_editar = '$cod_estado_prod_transferencia_editar', 
cod_estado_prod_transferencia_eliminar = '$cod_estado_prod_transferencia_eliminar', cod_estado_prod_transferencia_imprimir = '$cod_estado_prod_transferencia_imprimir', 
cod_estado_prod_transferencia_exportar = '$cod_estado_prod_transferencia_exportar', 
cod_estado_prod_auditoria_registrar = '$cod_estado_prod_auditoria_registrar', cod_estado_prod_auditoria_editar = '$cod_estado_prod_auditoria_editar', 
cod_estado_prod_auditoria_eliminar = '$cod_estado_prod_auditoria_eliminar', cod_estado_prod_auditoria_imprimir = '$cod_estado_prod_auditoria_imprimir', 
cod_estado_prod_auditoria_exportar = '$cod_estado_prod_auditoria_exportar',
cod_estado_precio_compra_mod_venta = '$cod_estado_precio_compra_mod_venta', cod_estado_eliminar_caja_mesa_virtual = '$cod_estado_eliminar_caja_mesa_virtual', 
cod_estado_deshabilitar_opc_eliminar_ventatemp = '$cod_estado_deshabilitar_opc_eliminar_ventatemp', cod_estado_habilitar_btn_facturar_mod_venta = '$cod_estado_habilitar_btn_facturar_mod_venta', 
cod_estado_seguridad = '$cod_estado_seguridad',
cod_estado_seguridad_registrar = '$cod_estado_seguridad_registrar',
cod_estado_seguridad_editar = '$cod_estado_seguridad_editar',
cod_estado_seguridad_eliminar = '$cod_estado_seguridad_eliminar',
cod_estado_seguridad_imprimir = '$cod_estado_seguridad_imprimir',
cod_estado_seguridad_exportar = '$cod_estado_seguridad_exportar', 
cod_estado_grafico_estadistico = '$cod_estado_grafico_estadistico', 
cod_estado_grafico_estadistico_registrar = '$cod_estado_grafico_estadistico_registrar', 
cod_estado_grafico_estadistico_editar = '$cod_estado_grafico_estadistico_editar', 
cod_estado_grafico_estadistico_eliminar = '$cod_estado_grafico_estadistico_eliminar', 
cod_estado_grafico_estadistico_imprimir = '$cod_estado_grafico_estadistico_imprimir', 
cod_estado_grafico_estadistico_exportar = '$cod_estado_grafico_estadistico_exportar', 
cod_estado_nota_observacion = '$cod_estado_nota_observacion', 
cod_estado_nota_observacion_eliminar = '$cod_estado_nota_observacion_eliminar', 
cod_estado_nota_observacion_registrar = '$cod_estado_nota_observacion_registrar', 
cod_estado_nota_observacion_editar = '$cod_estado_nota_observacion_editar', 
cod_estado_nota_observacion_imprimir = '$cod_estado_nota_observacion_imprimir', 
cod_estado_nota_observacion_exportar = '$cod_estado_nota_observacion_exportar', 
cod_estado_tipo_roles = '$cod_estado_tipo_roles', 
cod_estado_tipo_roles_registrar = '$cod_estado_tipo_roles_registrar', 
cod_estado_tipo_roles_editar = '$cod_estado_tipo_roles_editar', 
cod_estado_tipo_roles_eliminar = '$cod_estado_tipo_roles_eliminar', 
cod_estado_tipo_roles_imprimir = '$cod_estado_tipo_roles_imprimir', 
cod_estado_tipo_roles_exportar = '$cod_estado_tipo_roles_exportar', 
cod_estado_agregar_productos_a_venta_facturada = '$cod_estado_agregar_productos_a_venta_facturada', 
cod_estado_eliminar_productos_a_venta_facturada = '$cod_estado_eliminar_productos_a_venta_facturada', 
cod_estado_habilitar_total_venta_ventatemp = '$cod_estado_habilitar_total_venta_ventatemp', 
cod_estado_habilitar_total_venta_caja_mesa_virtual = '$cod_estado_habilitar_total_venta_caja_mesa_virtual', 
cod_estado_habilitar_caja_mesa_virtual_en_uso = '$cod_estado_habilitar_caja_mesa_virtual_en_uso', 
cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso = '$cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso',
cod_estado_prod_inventario_producto_masivo = '$cod_estado_prod_inventario_producto_masivo', 
cod_estado_prod_transferencia_extern = '$cod_estado_prod_transferencia_extern', 
cod_estado_prod_transferencia_extern_registrar = '$cod_estado_prod_transferencia_extern_registrar', 
cod_estado_prod_transferencia_extern_editar = '$cod_estado_prod_transferencia_extern_editar', 
cod_estado_prod_transferencia_extern_eliminar = '$cod_estado_prod_transferencia_extern_eliminar', 
cod_estado_prod_transferencia_extern_imprimir = '$cod_estado_prod_transferencia_extern_imprimir', 
cod_estado_prod_transferencia_extern_exportar = '$cod_estado_prod_transferencia_extern_exportar', 
cod_estado_categoria = '$cod_estado_categoria', 
cod_estado_categoria_registrar = '$cod_estado_categoria_registrar', 
cod_estado_categoria_editar = '$cod_estado_categoria_editar', 
cod_estado_categoria_eliminar = '$cod_estado_categoria_eliminar', 
cod_estado_categoria_imprimir = '$cod_estado_categoria_imprimir', 
cod_estado_categoria_exportar = '$cod_estado_categoria_exportar', 
cod_estado_caja_mesa = '$cod_estado_caja_mesa', 
cod_estado_caja_mesa_registrar = '$cod_estado_caja_mesa_registrar', 
cod_estado_caja_mesa_editar = '$cod_estado_caja_mesa_editar', 
cod_estado_caja_mesa_eliminar = '$cod_estado_caja_mesa_eliminar', 
cod_estado_caja_mesa_imprimir = '$cod_estado_caja_mesa_imprimir', 
cod_estado_caja_mesa_exportar = '$cod_estado_caja_mesa_exportar', 
cod_estado_usuario_cambiar_contrasena = '$cod_estado_usuario_cambiar_contrasena', 
cod_estado_usuario_cambiar_firma = '$cod_estado_usuario_cambiar_firma', 
cod_estado_usuario_permisos_personalizados = '$cod_estado_usuario_permisos_personalizados', 
cod_estado_usuario_permisos_asignar_matriz = '$cod_estado_usuario_permisos_asignar_matriz', 
cod_estado_usuario_cambiar_tipo_rol = '$cod_estado_usuario_cambiar_tipo_rol',
cod_estado_facturacion_venta_dependencia_user = '$cod_estado_facturacion_venta_dependencia_user',
cod_estado_facturacion_venta_precio_venta_predet_user = '$cod_estado_facturacion_venta_precio_venta_predet_user',
cod_estado_facturacion_venta_acceso_facturas_otros_user = '$cod_estado_facturacion_venta_acceso_facturas_otros_user', 
cod_estado_grafico_venta = '$cod_estado_grafico_venta', 
cod_estado_grafico_compra = '$cod_estado_grafico_compra', 
cod_estado_grafico_venta_compra = '$cod_estado_grafico_venta_compra', 
cod_estado_grafico_venta_egreso = '$cod_estado_grafico_venta_egreso', 
cod_estado_grafico_venta_tipo_pago = '$cod_estado_grafico_venta_tipo_pago', 
cod_estado_grafico_venta_tipo_forma_pago = '$cod_estado_grafico_venta_tipo_forma_pago', 
cod_estado_grafico_venta_tipo_factura = '$cod_estado_grafico_venta_tipo_factura', 
cod_estado_grafico_venta_categoria = '$cod_estado_grafico_venta_categoria', 
cod_estado_grafico_venta_dependencia = '$cod_estado_grafico_venta_dependencia', 
cod_estado_grafico_venta_tipo_compra = '$cod_estado_grafico_venta_tipo_compra', 
cod_estado_grafico_venta_tipo_metodo_envio = '$cod_estado_grafico_venta_tipo_metodo_envio', 
cod_estado_grafico_venta_tipo_aplicacion = '$cod_estado_grafico_venta_tipo_aplicacion', 
cod_estado_grafico_venta_producto = '$cod_estado_grafico_venta_producto', 
cod_estado_grafico_venta_tercero = '$cod_estado_grafico_venta_tercero', 
cod_estado_grafico_venta_tercero_producto = '$cod_estado_grafico_venta_tercero_producto', 
cod_estado_grafico_venta_tercero_domicilio = '$cod_estado_grafico_venta_tercero_domicilio', 
cod_estado_grafico_producto_mas_vendido_und_venta = '$cod_estado_grafico_producto_mas_vendido_und_venta', 
cod_estado_grafico_producto_mas_vendido_precio_venta = '$cod_estado_grafico_producto_mas_vendido_precio_venta', 
cod_estado_grafico_producto_menos_vendido_und_venta = '$cod_estado_grafico_producto_menos_vendido_und_venta', 
cod_estado_grafico_producto_menos_vendido_precio_venta = '$cod_estado_grafico_producto_menos_vendido_precio_venta', 
cod_estado_grafico_compra_precio_compra_precio_venta = '$cod_estado_grafico_compra_precio_compra_precio_venta', 
cod_estado_grafico_ganancia_venta_egreso = '$cod_estado_grafico_ganancia_venta_egreso', 
cod_estado_grafico_ganancia_venta = '$cod_estado_grafico_ganancia_venta', 
cod_estado_grafico_venta_por_vendedor = '$cod_estado_grafico_venta_por_vendedor', 
cod_estado_grafico_extras = '$cod_estado_grafico_extras',
cod_estado_deshabilitar_und_venta_ventatemp = '$cod_estado_deshabilitar_und_venta_ventatemp', 
cod_estado_deshabilitar_und_venta_atendido_cocina_chef = '$cod_estado_deshabilitar_und_venta_atendido_cocina_chef', 
cod_estado_reporte_venta_total_ganancia = '$cod_estado_reporte_venta_total_ganancia',
cod_estado_reporte_venta_total_utilidad = '$cod_estado_reporte_venta_total_utilidad',
cod_estado_reporte_venta_total_comision = '$cod_estado_reporte_venta_total_comision',
cod_estado_reporte_venta_total_propina = '$cod_estado_reporte_venta_total_propina',
cod_estado_timbre_entrada_pedido_temporal_cocina = '$cod_estado_timbre_entrada_pedido_temporal_cocina',
cod_estado_timbre_salida_pedido_temporal_cocina = '$cod_estado_timbre_salida_pedido_temporal_cocina', 
cod_estado_cuenta_cobrar_abono_glob = '$cod_estado_cuenta_cobrar_abono_glob', 
cod_estado_origen_produccion = '$cod_estado_origen_produccion', 
cod_estado_cantidad_caja_mesa = '$cod_estado_cantidad_caja_mesa', 
cod_estado_reporte_fecha_pago_venta_cuenta_cobrar = '$cod_estado_reporte_fecha_pago_venta_cuenta_cobrar', 
cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar = '$cod_estado_reporte_fecha_entrega_venta_cuenta_cobrar', 
cod_estado_reporte_mantenimiento = '$cod_estado_reporte_mantenimiento', 
cod_estado_lista_puc = '$cod_estado_lista_puc', 
cod_estado_licencia_sistema = '$cod_estado_licencia_sistema', 
cod_estado_repositorio_sistema = '$cod_estado_repositorio_sistema', 
cod_estado_resolucion_factura = '$cod_estado_resolucion_factura', 
cod_estado_numero_letra = '$cod_estado_numero_letra', 
cod_estado_abrir_cajon_monedero_driv_direct = '$cod_estado_abrir_cajon_monedero_driv_direct', 
cod_estado_subreporte_venta_diaria = '$cod_estado_subreporte_venta_diaria', 
cod_estado_subreporte_venta_mensual = '$cod_estado_subreporte_venta_mensual', 
cod_estado_subreporte_venta_anual = '$cod_estado_subreporte_venta_anual', 
cod_estado_subreporte_totalventa = '$cod_estado_subreporte_totalventa', 
cod_estado_subreporte_impuestos = '$cod_estado_subreporte_impuestos', 
cod_estado_subreporte_ventasgenerales = '$cod_estado_subreporte_ventasgenerales', 
cod_estado_subreporte_ventasporfacturas = '$cod_estado_subreporte_ventasporfacturas', 
cod_estado_subreporte_ventasportipofacturas = '$cod_estado_subreporte_ventasportipofacturas', 
cod_estado_subreporte_ventaspordependencia = '$cod_estado_subreporte_ventaspordependencia', 
cod_estado_subreporte_ventasportipoproducto = '$cod_estado_subreporte_ventasportipoproducto', 
cod_estado_subreporte_ventasporvendedor = '$cod_estado_subreporte_ventasporvendedor', 
cod_estado_subreporte_ventasporpropinavendedor = '$cod_estado_subreporte_ventasporpropinavendedor', 
cod_estado_subreporte_ventasporcreditocliente = '$cod_estado_subreporte_ventasporcreditocliente', 
cod_estado_dependencia_sub = '$cod_estado_dependencia_sub', 
cod_estado_factura_compra_producto = '$cod_estado_factura_compra_producto', 
cod_estado_precio_venta_variable_disponible = '$cod_estado_precio_venta_variable_disponible', 
cod_estado_habilitar_precio_venta_producto = '$cod_estado_habilitar_precio_venta_producto', 
cod_estado_und_producto_factura_compra = '$cod_estado_und_producto_factura_compra', 
cod_estado_edit_precio_venta_btn_factura_venta = '$cod_estado_edit_precio_venta_btn_factura_venta', 
cod_estado_edit_precio_venta_pvar_factura_venta = '$cod_estado_edit_precio_venta_pvar_factura_venta', 
cod_estado_edit_precio_venta_precio_estatico_factura_venta = '$cod_estado_edit_precio_venta_precio_estatico_factura_venta',
cod_estado_cambiar_vendedor_al_vender = '$cod_estado_cambiar_vendedor_al_vender', 
cod_estado_observacion_factura_compra = '$cod_estado_observacion_factura_compra', 
cod_estado_observacion_factura_venta = '$cod_estado_observacion_factura_venta', 
cod_estado_fecha_entrega_factura_compra = '$cod_estado_fecha_entrega_factura_compra', 
cod_estado_fecha_entrega_factura_venta = '$cod_estado_fecha_entrega_factura_venta'
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