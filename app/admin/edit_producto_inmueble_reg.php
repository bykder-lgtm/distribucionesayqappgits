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

if (isset($_POST['cod_producto']) <> '') { $cod_producto = intval($_POST['cod_producto']); } else { $cod_producto = ''; }
if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar, ($_POST['cod_producto_barra'])); } else { $cod_producto_barra = ''; }
if (isset($_POST['nombre_producto']) <> '') { $nombre_producto = mysqli_real_escape_string($conectar, ($_POST['nombre_producto'])); } else { $nombre_producto = ''; }
if (isset($_POST['und_producto']) <> '') { $und_producto = mysqli_real_escape_string($conectar, ($_POST['und_producto'])); } else { $und_producto = ''; }
if (isset($_POST['precio_compra_producto']) <> '') { $precio_compra_producto = mysqli_real_escape_string($conectar, ($_POST['precio_compra_producto'])); } else { $precio_compra_producto = ''; }
if (isset($_POST['precio_venta_producto']) <> '') { $precio_venta_producto = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto'])); } else { $precio_venta_producto = ''; }
if (isset($_POST['nombre_tipo_producto']) <> '') { $nombre_tipo_producto = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_producto'])); } else { $nombre_tipo_producto = ''; }
if (isset($_POST['nombre_tipo_unidad_medida']) <> '') { $nombre_tipo_unidad_medida = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_unidad_medida'])); } else { $nombre_tipo_unidad_medida = ''; }
if (isset($_POST['nombre_tipo_presentacion']) <> '') { $nombre_tipo_presentacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_presentacion'])); } else { $nombre_tipo_presentacion = ''; }
if (isset($_POST['nombre_tipo_precio_venta']) <> '') { $nombre_tipo_precio_venta = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_precio_venta'])); } else { $nombre_tipo_precio_venta = ''; }
if (isset($_POST['nombre_via_administracion']) <> '') { $nombre_via_administracion = mysqli_real_escape_string($conectar, ($_POST['nombre_via_administracion'])); } else { $nombre_via_administracion = ''; }
if (isset($_POST['posologia_cantidad']) <> '') { $posologia_cantidad = mysqli_real_escape_string($conectar, ($_POST['posologia_cantidad'])); } else { $posologia_cantidad = ''; }
if (isset($_POST['posologia_peso']) <> '') { $posologia_peso = mysqli_real_escape_string($conectar, ($_POST['posologia_peso'])); } else { $posologia_peso = ''; }
if (isset($_POST['nombre_frec_duracion']) <> '') { $nombre_frec_duracion = mysqli_real_escape_string($conectar, ($_POST['nombre_frec_duracion'])); } else { $nombre_frec_duracion = ''; }
if (isset($_POST['fecha_vencimiento1']) <> '') { $fecha_vencimiento1 = mysqli_real_escape_string($conectar, ($_POST['fecha_vencimiento1'])); } else { $fecha_vencimiento1 = ''; }
if (isset($_POST['vencimiento_lote1']) <> '') { $vencimiento_lote1 = mysqli_real_escape_string($conectar, ($_POST['vencimiento_lote1'])); } else { $vencimiento_lote1 = ''; }
if (isset($_POST['fecha_vencimiento2']) <> '') { $fecha_vencimiento2 = mysqli_real_escape_string($conectar, ($_POST['fecha_vencimiento2'])); } else { $fecha_vencimiento2 = ''; }
if (isset($_POST['vencimiento_lote2']) <> '') { $vencimiento_lote2 = mysqli_real_escape_string($conectar, ($_POST['vencimiento_lote2'])); } else { $vencimiento_lote2 = ''; }
if (isset($_POST['fecha_mantenimiento']) <> '') { $fecha_mantenimiento = mysqli_real_escape_string($conectar, ($_POST['fecha_mantenimiento'])); } else { $fecha_mantenimiento = ''; }
if (isset($_POST['iva_ptj']) <> '') { $iva_ptj = mysqli_real_escape_string($conectar, ($_POST['iva_ptj'])); } else { $iva_ptj = ''; }
if (isset($_POST['tope_min']) <> '') { $tope_min = mysqli_real_escape_string($conectar, ($_POST['tope_min'])); } else { $tope_min = ''; }
if (isset($_POST['comision_ptj']) <> '') { $comision_ptj = mysqli_real_escape_string($conectar, ($_POST['comision_ptj'])); } else { $comision_ptj = '0'; }
if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = '0'; }
if (isset($_POST['cod_producto_serial']) <> '') { $cod_producto_serial = mysqli_real_escape_string($conectar, ($_POST['cod_producto_serial'])); } else { $cod_producto_serial = ''; }
if (isset($_POST['lote_compra']) <> '') { $lote_compra = mysqli_real_escape_string($conectar, ($_POST['lote_compra'])); } else { $lote_compra = ''; }

if (isset($_POST['cod_rodeo']) <> '') { $cod_rodeo = mysqli_real_escape_string($conectar, ($_POST['cod_rodeo'])); } else { $cod_rodeo = ''; }
if (isset($_POST['nombre_rodeo']) <> '') { $nombre_rodeo = mysqli_real_escape_string($conectar, ($_POST['nombre_rodeo'])); } else { $nombre_rodeo = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar, ($_POST['nombre_sexo'])); } else { $nombre_sexo = ''; }
if (isset($_POST['de_monta']) <> '') { $de_monta = mysqli_real_escape_string($conectar, ($_POST['de_monta'])); } else { $de_monta = ''; }
if (isset($_POST['nombre_estatus']) <> '') { $nombre_estatus = mysqli_real_escape_string($conectar, ($_POST['nombre_estatus'])); } else { $nombre_estatus = ''; }
if (isset($_POST['nombre_condicion_corporal']) <> '') { $nombre_condicion_corporal = mysqli_real_escape_string($conectar, ($_POST['nombre_condicion_corporal'])); } else { $nombre_condicion_corporal = ''; }
if (isset($_POST['nombre_categoria_ingreso']) <> '') { $nombre_categoria_ingreso = mysqli_real_escape_string($conectar, ($_POST['nombre_categoria_ingreso'])); } else { $nombre_categoria_ingreso = ''; }
if (isset($_POST['nombre_categoria_actual']) <> '') { $nombre_categoria_actual = mysqli_real_escape_string($conectar, ($_POST['nombre_categoria_actual'])); } else { $nombre_categoria_actual = ''; }
if (isset($_POST['nombre_categoria_futura']) <> '') { $nombre_categoria_futura = mysqli_real_escape_string($conectar, ($_POST['nombre_categoria_futura'])); } else { $nombre_categoria_futura = ''; }
if (isset($_POST['nombre_procedencia']) <> '') { $nombre_procedencia = mysqli_real_escape_string($conectar, ($_POST['nombre_procedencia'])); } else { $nombre_procedencia = ''; }
if (isset($_POST['nombre_tipo_monta']) <> '') { $nombre_tipo_monta = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_monta'])); } else { $nombre_tipo_monta = ''; }
if (isset($_POST['nombre_lote_categoria']) <> '') { $nombre_lote_categoria = mysqli_real_escape_string($conectar, ($_POST['nombre_lote_categoria'])); } else { $nombre_lote_categoria = ''; }
if (isset($_POST['nombre_prog_reproductivo']) <> '') { $nombre_prog_reproductivo = mysqli_real_escape_string($conectar, ($_POST['nombre_prog_reproductivo'])); } else { $nombre_prog_reproductivo = ''; }
if (isset($_POST['nombre_potrero']) <> '') { $nombre_potrero = mysqli_real_escape_string($conectar, ($_POST['nombre_potrero'])); } else { $nombre_potrero = ''; }
if (isset($_POST['nombre_lote']) <> '') { $nombre_lote = mysqli_real_escape_string($conectar, ($_POST['nombre_lote'])); } else { $nombre_lote = ''; }
if (isset($_POST['nombre_calidad_animal']) <> '') { $nombre_calidad_animal = mysqli_real_escape_string($conectar, ($_POST['nombre_calidad_animal'])); } else { $nombre_calidad_animal = ''; }
if (isset($_POST['nombre_tipo_explotacion']) <> '') { $nombre_tipo_explotacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_explotacion'])); } else { $nombre_tipo_explotacion = ''; }
if (isset($_POST['peso_compra']) <> '') { $peso_compra = mysqli_real_escape_string($conectar, ($_POST['peso_compra'])); } else { $peso_compra = ''; }
if (isset($_POST['precio_compra']) <> '') { $precio_compra = mysqli_real_escape_string($conectar, ($_POST['precio_compra'])); } else { $precio_compra = ''; }
if (isset($_POST['nombre_propietario']) <> '') { $nombre_propietario = mysqli_real_escape_string($conectar, ($_POST['nombre_propietario'])); } else { $nombre_propietario = ''; }
if (isset($_POST['fecha_nac']) <> '') { $fecha_nac = mysqli_real_escape_string($conectar, ($_POST['fecha_nac'])); } else { $fecha_nac = ''; }
if (isset($_POST['fecha_compra']) <> '') { $fecha_compra = mysqli_real_escape_string($conectar, ($_POST['fecha_compra'])); } else { $fecha_compra = ''; }
if (isset($_POST['fecha_castracion']) <> '') { $fecha_castracion = mysqli_real_escape_string($conectar, ($_POST['fecha_castracion'])); } else { $fecha_castracion = ''; }
if (isset($_POST['nro_hierros']) <> '') { $nro_hierros = mysqli_real_escape_string($conectar, ($_POST['nro_hierros'])); } else { $nro_hierros = ''; }
if (isset($_POST['hierro_animal']) <> '') { $hierro_animal = mysqli_real_escape_string($conectar, ($_POST['hierro_animal'])); } else { $hierro_animal = ''; }
if (isset($_POST['numero_partos']) <> '') { $numero_partos = mysqli_real_escape_string($conectar, ($_POST['numero_partos'])); } else { $numero_partos = ''; }
if (isset($_POST['id_electronica']) <> '') { $id_electronica = mysqli_real_escape_string($conectar, ($_POST['id_electronica'])); } else { $id_electronica = ''; }
if (isset($_POST['nombre_raza']) <> '') { $nombre_raza = mysqli_real_escape_string($conectar, ($_POST['nombre_raza'])); } else { $nombre_raza = ''; }
if (isset($_POST['nombre_raza1']) <> '') { $nombre_raza1 = mysqli_real_escape_string($conectar, ($_POST['nombre_raza1'])); } else { $nombre_raza1 = ''; }
if (isset($_POST['nombre_raza2']) <> '') { $nombre_raza2 = mysqli_real_escape_string($conectar, ($_POST['nombre_raza2'])); } else { $nombre_raza2 = ''; }
if (isset($_POST['nombre_raza3']) <> '') { $nombre_raza3 = mysqli_real_escape_string($conectar, ($_POST['nombre_raza3'])); } else { $nombre_raza3 = ''; }
if (isset($_POST['nombre_raza4']) <> '') { $nombre_raza4 = mysqli_real_escape_string($conectar, ($_POST['nombre_raza4'])); } else { $nombre_raza4 = ''; }
if (isset($_POST['ptj_raza1']) <> '') { $ptj_raza1 = mysqli_real_escape_string($conectar, ($_POST['ptj_raza1'])); } else { $ptj_raza1 = ''; }
if (isset($_POST['ptj_raza2']) <> '') { $ptj_raza2 = mysqli_real_escape_string($conectar, ($_POST['ptj_raza2'])); } else { $ptj_raza2 = ''; }
if (isset($_POST['ptj_raza3']) <> '') { $ptj_raza3 = mysqli_real_escape_string($conectar, ($_POST['ptj_raza3'])); } else { $ptj_raza3 = ''; }
if (isset($_POST['ptj_raza4']) <> '') { $ptj_raza4 = mysqli_real_escape_string($conectar, ($_POST['ptj_raza4'])); } else { $ptj_raza4 = ''; }
if (isset($_POST['id_padre']) <> '') { $id_padre = mysqli_real_escape_string($conectar, ($_POST['id_padre'])); } else { $id_padre = ''; }
if (isset($_POST['raza_padre']) <> '') { $raza_padre = mysqli_real_escape_string($conectar, ($_POST['raza_padre'])); } else { $raza_padre = ''; }
if (isset($_POST['id_madre']) <> '') { $id_madre = mysqli_real_escape_string($conectar, ($_POST['id_madre'])); } else { $id_madre = ''; }
if (isset($_POST['raza_madre']) <> '') { $raza_madre = mysqli_real_escape_string($conectar, ($_POST['raza_madre'])); } else { $raza_madre = ''; }
if (isset($_POST['partos_madre']) <> '') { $partos_madre = mysqli_real_escape_string($conectar, ($_POST['partos_madre'])); } else { $partos_madre = ''; }
if (isset($_POST['id_abuelo_paterno']) <> '') { $id_abuelo_paterno = mysqli_real_escape_string($conectar, ($_POST['id_abuelo_paterno'])); } else { $id_abuelo_paterno = ''; }
if (isset($_POST['id_abuelo_materno']) <> '') { $id_abuelo_materno = mysqli_real_escape_string($conectar, ($_POST['id_abuelo_materno'])); } else { $id_abuelo_materno = ''; }
if (isset($_POST['nombre_abuelo_paterno']) <> '') { $nombre_abuelo_paterno = mysqli_real_escape_string($conectar, ($_POST['nombre_abuelo_paterno'])); } else { $nombre_abuelo_paterno = ''; }
if (isset($_POST['nombre_abuelo_materno']) <> '') { $nombre_abuelo_materno = mysqli_real_escape_string($conectar, ($_POST['nombre_abuelo_materno'])); } else { $nombre_abuelo_materno = ''; }
if (isset($_POST['raza_abuelo_paterno']) <> '') { $raza_abuelo_paterno = mysqli_real_escape_string($conectar, ($_POST['raza_abuelo_paterno'])); } else { $raza_abuelo_paterno = ''; }
if (isset($_POST['raza_abuelo_materno']) <> '') { $raza_abuelo_materno = mysqli_real_escape_string($conectar, ($_POST['raza_abuelo_materno'])); } else { $raza_abuelo_materno = ''; }
if (isset($_POST['id_abuela_paterno']) <> '') { $id_abuela_paterno = mysqli_real_escape_string($conectar, ($_POST['id_abuela_paterno'])); } else { $id_abuela_paterno = ''; }
if (isset($_POST['id_abuela_materno']) <> '') { $id_abuela_materno = mysqli_real_escape_string($conectar, ($_POST['id_abuela_materno'])); } else { $id_abuela_materno = ''; }
if (isset($_POST['nombre_abuela_paterno']) <> '') { $nombre_abuela_paterno = mysqli_real_escape_string($conectar, ($_POST['nombre_abuela_paterno'])); } else { $nombre_abuela_paterno = ''; }
if (isset($_POST['nombre_abuela_materno']) <> '') { $nombre_abuela_materno = mysqli_real_escape_string($conectar, ($_POST['nombre_abuela_materno'])); } else { $nombre_abuela_materno = ''; }
if (isset($_POST['raza_abuela_paterno']) <> '') { $raza_abuela_paterno = mysqli_real_escape_string($conectar, ($_POST['raza_abuela_paterno'])); } else { $raza_abuela_paterno = ''; }
if (isset($_POST['raza_abuela_materno']) <> '') { $raza_abuela_materno = mysqli_real_escape_string($conectar, ($_POST['raza_abuela_materno'])); } else { $raza_abuela_materno = ''; }
if (isset($_POST['nombre_tipo_concepcion']) <> '') { $nombre_tipo_concepcion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_concepcion'])); } else { $nombre_tipo_concepcion = ''; }
if (isset($_POST['nombre_especie']) <> '') { $nombre_especie = mysqli_real_escape_string($conectar, ($_POST['nombre_especie'])); } else { $nombre_especie = ''; }
if (isset($_POST['marcas_tatuado']) <> '') { $marcas_tatuado = mysqli_real_escape_string($conectar, ($_POST['marcas_tatuado'])); } else { $marcas_tatuado = ''; }
if (isset($_POST['marcas_herrado']) <> '') { $marcas_herrado = mysqli_real_escape_string($conectar, ($_POST['marcas_herrado'])); } else { $marcas_herrado = ''; }
if (isset($_POST['marcas_descornado']) <> '') { $marcas_descornado = mysqli_real_escape_string($conectar, ($_POST['marcas_descornado'])); } else { $marcas_descornado = ''; }
if (isset($_POST['marcas_castrado']) <> '') { $marcas_castrado = mysqli_real_escape_string($conectar, ($_POST['marcas_castrado'])); } else { $marcas_castrado = ''; }
if (isset($_POST['nombre_color']) <> '') { $nombre_color = mysqli_real_escape_string($conectar, ($_POST['nombre_color'])); } else { $nombre_color = ''; }
if (isset($_POST['nombre_temperamento']) <> '') { $nombre_temperamento = mysqli_real_escape_string($conectar, ($_POST['nombre_temperamento'])); } else { $nombre_temperamento = ''; }
if (isset($_POST['peso_nacer']) <> '') { $peso_nacer = mysqli_real_escape_string($conectar, ($_POST['peso_nacer'])); } else { $peso_nacer = ''; }
if (isset($_POST['aplomo_corvejon']) <> '') { $aplomo_corvejon = mysqli_real_escape_string($conectar, ($_POST['aplomo_corvejon'])); } else { $aplomo_corvejon = ''; }
if (isset($_POST['aplomo_cuartilla']) <> '') { $aplomo_cuartilla = mysqli_real_escape_string($conectar, ($_POST['aplomo_cuartilla'])); } else { $aplomo_cuartilla = ''; }
if (isset($_POST['aplomo_cascos']) <> '') { $aplomo_cascos = mysqli_real_escape_string($conectar, ($_POST['aplomo_cascos'])); } else { $aplomo_cascos = ''; }
if (isset($_POST['genital_circun_escrotal']) <> '') { $genital_circun_escrotal = mysqli_real_escape_string($conectar, ($_POST['genital_circun_escrotal'])); } else { $genital_circun_escrotal = ''; }
if (isset($_POST['genital_prepusio']) <> '') { $genital_prepusio = mysqli_real_escape_string($conectar, ($_POST['genital_prepusio'])); } else { $genital_prepusio = ''; }
if (isset($_POST['genital_potencia']) <> '') { $genital_potencia = mysqli_real_escape_string($conectar, ($_POST['genital_potencia'])); } else { $genital_potencia = ''; }
if (isset($_POST['genital_semen']) <> '') { $genital_semen = mysqli_real_escape_string($conectar, ($_POST['genital_semen'])); } else { $genital_semen = ''; }
if (isset($_POST['observacion_animal']) <> '') { $observacion_animal = mysqli_real_escape_string($conectar, ($_POST['observacion_animal'])); } else { $observacion_animal = ''; }
if (isset($_POST['nombre_estado']) <> '') { $nombre_estado = mysqli_real_escape_string($conectar, ($_POST['nombre_estado'])); } else { $nombre_estado = ''; }
if (isset($_POST['nombre_tipo_movimiento']) <> '') { $nombre_tipo_movimiento = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_movimiento'])); } else { $nombre_tipo_movimiento = ''; }
if (isset($_POST['nombre_categoria_animal_extern']) <> '') { $nombre_categoria_animal_extern = mysqli_real_escape_string($conectar, ($_POST['nombre_categoria_animal_extern'])); } else { $nombre_categoria_animal_extern = ''; }
if (isset($_POST['descripcion_producto']) <> '') { $descripcion_producto = mysqli_real_escape_string($conectar, ($_POST['descripcion_producto'])); } else { $descripcion_producto = ''; }

if (isset($_POST['cajas_sobre']) <> '') { $cajas_sobre = mysqli_real_escape_string($conectar, ($_POST['cajas_sobre'])); } else { $cajas_sobre = ''; }
if (isset($_POST['und_sobre']) <> '') { $und_sobre = mysqli_real_escape_string($conectar, ($_POST['und_sobre'])); } else { $und_sobre = ''; }

if (isset($_POST['meses_mantenimiento']) <> '') { $meses_mantenimiento = mysqli_real_escape_string($conectar, ($_POST['meses_mantenimiento'])); } else { $meses_mantenimiento = ''; }
if (isset($_POST['meses_garantia']) <> '') { $meses_garantia = mysqli_real_escape_string($conectar, ($_POST['meses_garantia'])); } else { $meses_garantia = ''; }
if (isset($_POST['cod_marca']) <> '') { $cod_marca = mysqli_real_escape_string($conectar, ($_POST['cod_marca'])); } else { $cod_marca = ''; }
if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }

if (isset($_POST['cod_categoria']) <> '') { $cod_categoria = mysqli_real_escape_string($conectar, ($_POST['cod_categoria'])); } else { $cod_categoria = '0'; }
if (isset($_POST['cod_origen_produccion']) <> '') { $cod_origen_produccion = mysqli_real_escape_string($conectar, ($_POST['cod_origen_produccion'])); } else { $cod_origen_produccion = '0'; }
if (isset($_POST['cod_dependencia_sub']) <> '') { $cod_dependencia_sub = intval($_POST['cod_dependencia_sub']); } else { $cod_dependencia_sub = '0'; }
if (isset($_POST['cod_factura']) <> '') { $cod_factura = mysqli_real_escape_string($conectar, ($_POST['cod_factura'])); } else { $cod_factura = ''; }
if (isset($_POST['direccion_producto']) <> '') { $direccion_producto = mysqli_real_escape_string($conectar, ($_POST['direccion_producto'])); } else { $direccion_producto = ''; }
if (isset($_POST['referencia_catastral_inmueble']) <> '') { $referencia_catastral_inmueble = mysqli_real_escape_string($conectar, ($_POST['referencia_catastral_inmueble'])); } else { $referencia_catastral_inmueble = ''; }
if (isset($_POST['numero_matricula_inmueble']) <> '') { $numero_matricula_inmueble = mysqli_real_escape_string($conectar, ($_POST['numero_matricula_inmueble'])); } else { $numero_matricula_inmueble = ''; }
if (isset($_POST['cod_estado_inmueble']) <> '') { $cod_estado_inmueble = intval($_POST['cod_estado_inmueble']); } else { $cod_estado_inmueble = '1'; }
if (isset($_POST['deduccion_comision_ptj_inmueble']) <> '') { $deduccion_comision_ptj_inmueble = intval($_POST['deduccion_comision_ptj_inmueble']); } else { $deduccion_comision_ptj_inmueble = '0'; }
if (isset($_POST['dia_pago_propietario_inmueble']) <> '') { $dia_pago_propietario_inmueble = addslashes($_POST['dia_pago_propietario_inmueble']); } else { $dia_pago_propietario_inmueble = ''; }
if (isset($_POST['nombre_tipo_cobro_propietario_inmueble']) <> '') { $nombre_tipo_cobro_propietario_inmueble = addslashes($_POST['nombre_tipo_cobro_propietario_inmueble']); } else { $nombre_tipo_cobro_propietario_inmueble = ''; }
if (isset($_POST['cod_tercero_propietario_inmueble'])) { $cod_tercero_propietario_inmueble = intval($_POST['cod_tercero_propietario_inmueble']); } else { $cod_tercero_propietario_inmueble = 0; }
if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = 0; }
$pagina                       = addslashes($_POST['pagina']).'?cod_tercero='.$cod_tercero_propietario_inmueble.'&pagina=';

$sql_data = sprintf("UPDATE tbl15_producto SET cod_producto_barra = '$cod_producto_barra', nombre_producto = '$nombre_producto', 
und_producto = '$und_producto', precio_compra_producto = '$precio_compra_producto', precio_venta_producto = '$precio_venta_producto', 
nombre_tipo_producto = '$nombre_tipo_producto', nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', nombre_tipo_presentacion = '$nombre_tipo_presentacion', 
tope_min = '$tope_min', iva_ptj = '$iva_ptj', nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', fecha_vencimiento1 = '$fecha_vencimiento1', 
vencimiento_lote1 = '$vencimiento_lote1', fecha_mantenimiento = '$fecha_mantenimiento', 
comision_ptj = '$comision_ptj', cod_dependencia = '$cod_dependencia', cod_producto_serial = '$cod_producto_serial', 
cod_rodeo = '$cod_rodeo', nombre_rodeo = '$nombre_rodeo', nombre_sexo = '$nombre_sexo', de_monta = '$de_monta', nombre_estatus = '$nombre_estatus', 
nombre_condicion_corporal = '$nombre_condicion_corporal', nombre_categoria_ingreso = '$nombre_categoria_ingreso', nombre_categoria_actual = '$nombre_categoria_actual', 
nombre_categoria_futura = '$nombre_categoria_futura', nombre_procedencia = '$nombre_procedencia', nombre_tipo_monta = '$nombre_tipo_monta', 
nombre_lote_categoria = '$nombre_lote_categoria', nombre_prog_reproductivo = '$nombre_prog_reproductivo', nombre_potrero = '$nombre_potrero', 
nombre_lote = '$nombre_lote', nombre_calidad_animal = '$nombre_calidad_animal', nombre_tipo_explotacion = '$nombre_tipo_explotacion', 
peso_compra = '$peso_compra', precio_compra = '$precio_compra', nombre_propietario = '$nombre_propietario', 
fecha_nac = '$fecha_nac', fecha_compra = '$fecha_compra', fecha_castracion = '$fecha_castracion', 
nro_hierros = '$nro_hierros', hierro_animal = '$hierro_animal', numero_partos = '$numero_partos', 
id_electronica = '$id_electronica', nombre_raza = '$nombre_raza', nombre_raza1 = '$nombre_raza1', 
nombre_raza2 = '$nombre_raza2', nombre_raza3 = '$nombre_raza3', nombre_raza4 = '$nombre_raza4', 
ptj_raza1 = '$ptj_raza1', ptj_raza2 = '$ptj_raza2', ptj_raza3 = '$ptj_raza3', 
ptj_raza4 = '$ptj_raza4', id_padre = '$id_padre', raza_padre = '$raza_padre', 
id_madre = '$id_madre', raza_madre = '$raza_madre', partos_madre = '$partos_madre', 
id_abuelo_paterno = '$id_abuelo_paterno', id_abuelo_materno = '$id_abuelo_materno', nombre_abuelo_paterno = '$nombre_abuelo_paterno', 
nombre_abuelo_materno = '$nombre_abuelo_materno', raza_abuelo_paterno = '$raza_abuelo_paterno', raza_abuelo_materno = '$raza_abuelo_materno', 
id_abuela_paterno = '$id_abuela_paterno', id_abuela_materno = '$id_abuela_materno', nombre_abuela_paterno = '$nombre_abuela_paterno', 
nombre_abuela_materno = '$nombre_abuela_materno', raza_abuela_paterno = '$raza_abuela_paterno', raza_abuela_materno = '$raza_abuela_materno', 
nombre_tipo_concepcion = '$nombre_tipo_concepcion', nombre_especie = '$nombre_especie', marcas_tatuado = '$marcas_tatuado', 
marcas_herrado = '$marcas_herrado', marcas_descornado = '$marcas_descornado', marcas_castrado = '$marcas_castrado', 
nombre_color = '$nombre_color', nombre_temperamento = '$nombre_temperamento', peso_nacer = '$peso_nacer', 
aplomo_corvejon = '$aplomo_corvejon', aplomo_cuartilla = '$aplomo_cuartilla', aplomo_cascos = '$aplomo_cascos', 
genital_circun_escrotal = '$genital_circun_escrotal', genital_prepusio = '$genital_prepusio', genital_potencia = '$genital_potencia', 
genital_semen = '$genital_semen', observacion_animal = '$observacion_animal', nombre_estado = '$nombre_estado', 
nombre_tipo_movimiento = '$nombre_tipo_movimiento', nombre_categoria_animal_extern = '$nombre_categoria_animal_extern', 
descripcion_producto = '$descripcion_producto',  cajas_sobre = '$cajas_sobre', und_sobre = '$und_sobre', 
meses_mantenimiento = '$meses_mantenimiento', meses_garantia = '$meses_garantia', cod_marca = '$cod_marca', cod_tercero = '$cod_tercero', lote_compra = '$lote_compra',
cod_categoria = '$cod_categoria', cod_origen_produccion = '$cod_origen_produccion', cod_dependencia_sub = '$cod_dependencia_sub', cod_factura = '$cod_factura', 
direccion_producto = '$direccion_producto', referencia_catastral_inmueble = '$referencia_catastral_inmueble', numero_matricula_inmueble = '$numero_matricula_inmueble', 
cod_estado_inmueble = '$cod_estado_inmueble', deduccion_comision_ptj_inmueble = '$deduccion_comision_ptj_inmueble', 
dia_pago_propietario_inmueble = '$dia_pago_propietario_inmueble', nombre_tipo_cobro_propietario_inmueble = '$nombre_tipo_cobro_propietario_inmueble', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago'
WHERE cod_producto = '$cod_producto'");
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