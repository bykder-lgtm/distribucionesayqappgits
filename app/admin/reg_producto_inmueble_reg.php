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
include("../admin/class_php/class.upload.php");

$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar, ($_POST['cod_producto_barra'])); } else { $cod_producto_barra = ''; }

$obtener_entidad = "SELECT nombre_producto FROM tbl15_producto WHERE cod_producto_barra = '".($cod_producto_barra)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows(@$consultar_entidad);
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

if($existe_producto > 0) 	{
echo '<img src="../imagenes/advertencia.gif"><h4>EL CODIGO '. $cod_producto_barra.' YA ESTA REGISTRADO</h4></div>';
?>
<META HTTP-EQUIV="REFRESH" CONTENT="1; <?php echo $pagina_else ?>">
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
} else {
if (isset($_POST['nombre_producto']) <> '') { 
$nombre_producto0 = mysqli_real_escape_string($conectar, ($_POST['nombre_producto'])); 
$nombre_producto1 = str_replace("'", " PULG ", $nombre_producto0);
$nombre_producto2 = str_replace(",", ".", $nombre_producto1);
$nombre_producto3 = str_replace("#", " NO ", $nombre_producto2);
$nombre_producto4 = str_replace("%", " PTJ ", $nombre_producto3);
$nombre_producto = trim(str_replace('"', " PULG ", $nombre_producto4));
} else { $nombre_producto = ''; }

if (isset($_POST['und_producto']) <> '') { $und_producto = mysqli_real_escape_string($conectar, ($_POST['und_producto'])); } else { $und_producto = ''; }
if (isset($_POST['precio_compra_producto']) <> '') { $precio_compra_producto = mysqli_real_escape_string($conectar, ($_POST['precio_compra_producto'])); } else { $precio_compra_producto = ''; }
if (isset($_POST['precio_venta_producto']) <> '') { $precio_venta_producto = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto'])); } else { $precio_venta_producto = ''; }
if (isset($_POST['precio_venta_producto2']) <> '') { $precio_venta_producto2 = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto2'])); } else { $precio_venta_producto2 = ''; }
if (isset($_POST['precio_venta_producto3']) <> '') { $precio_venta_producto3 = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto3'])); } else { $precio_venta_producto3 = ''; }
if (isset($_POST['precio_venta_producto4']) <> '') { $precio_venta_producto4 = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto4'])); } else { $precio_venta_producto4 = ''; }
if (isset($_POST['precio_venta_producto5']) <> '') { $precio_venta_producto5 = mysqli_real_escape_string($conectar, ($_POST['precio_venta_producto5'])); } else { $precio_venta_producto5 = ''; }
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
if (isset($_POST['iva_ptj']) <> '') { $iva_ptj = mysqli_real_escape_string($conectar, ($_POST['iva_ptj'])); } else { $iva_ptj = ''; }
if (isset($_POST['tope_min']) <> '') { $tope_min = mysqli_real_escape_string($conectar, ($_POST['tope_min'])); } else { $tope_min = ''; }
if (isset($_POST['comision_ptj']) <> '') { $comision_ptj = mysqli_real_escape_string($conectar, ($_POST['comision_ptj'])); } else { $comision_ptj = '0'; }
if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = '0'; }
if (isset($_POST['und_producto_bodega']) <> '') { $und_producto_bodega = mysqli_real_escape_string($conectar, ($_POST['und_producto_bodega'])); } else { $und_producto_bodega = '0'; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
if (isset($_POST['fecha_mantenimiento']) <> '') { $fecha_mantenimiento = mysqli_real_escape_string($conectar, ($_POST['fecha_mantenimiento'])); } else { $fecha_mantenimiento = ''; }
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
if (isset($_POST['nombre_categoria_sub']) <> '') { $nombre_categoria_sub = mysqli_real_escape_string($conectar, ($_POST['nombre_categoria_sub'])); } else { $nombre_categoria_sub = ''; }
if (isset($_POST['descripcion_producto']) <> '') { $descripcion_producto = mysqli_real_escape_string($conectar, ($_POST['descripcion_producto'])); } else { $descripcion_producto = ''; }

if (isset($_POST['cajas_sobre']) <> '') { $cajas_sobre = mysqli_real_escape_string($conectar, ($_POST['cajas_sobre'])); } else { $cajas_sobre = ''; }
if (isset($_POST['und_sobre']) <> '') { $und_sobre = mysqli_real_escape_string($conectar, ($_POST['und_sobre'])); } else { $und_sobre = ''; }

if (isset($_POST['meses_mantenimiento']) <> '') { $meses_mantenimiento = mysqli_real_escape_string($conectar, ($_POST['meses_mantenimiento'])); } else { $meses_mantenimiento = ''; }
if (isset($_POST['meses_garantia']) <> '') { $meses_garantia = mysqli_real_escape_string($conectar, ($_POST['meses_garantia'])); } else { $meses_garantia = ''; }
if (isset($_POST['cod_factura']) <> '') { $cod_factura = mysqli_real_escape_string($conectar, ($_POST['cod_factura'])); } else { $cod_factura = ''; }
if (isset($_POST['cod_marca']) <> '') { $cod_marca = mysqli_real_escape_string($conectar, ($_POST['cod_marca'])); } else { $cod_marca = ''; }
if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
if (isset($_POST['cod_opcion_descontable_inv']) <> '') { $cod_opcion_descontable_inv = intval($_POST['cod_opcion_descontable_inv']); } else { $cod_opcion_descontable_inv = '0'; }
if (isset($_POST['cod_categoria']) <> '') { $cod_categoria = intval($_POST['cod_categoria']); } else { $cod_categoria = '0'; }
if (isset($_POST['cod_categoria_sub']) <> '') { $cod_categoria_sub = intval($_POST['cod_categoria_sub']); } else { $cod_categoria_sub = '0'; }
if (isset($_POST['cod_tipo_producto_cocina']) <> '') { $cod_tipo_producto_cocina = intval($_POST['cod_tipo_producto_cocina']); } else { $cod_tipo_producto_cocina = '0'; }

if (isset($_POST['peso_producto']) <> '') { $peso_producto = mysqli_real_escape_string($conectar, ($_POST['peso_producto'])); } else { $peso_producto = ''; }
if (isset($_POST['unidad_medida_peso']) <> '') { $unidad_medida_peso = mysqli_real_escape_string($conectar, ($_POST['unidad_medida_peso'])); } else { $unidad_medida_peso = ''; }
if (isset($_POST['cod_origen_produccion']) <> '') { $cod_origen_produccion = intval($_POST['cod_origen_produccion']); } else { $cod_origen_produccion = '0'; }
if (isset($_POST['cod_dependencia_sub']) <> '') { $cod_dependencia_sub = intval($_POST['cod_dependencia_sub']); } else { $cod_dependencia_sub = '0'; }

if (isset($_POST['referencia_catastral_inmueble']) <> '') { $referencia_catastral_inmueble = mysqli_real_escape_string($conectar, ($_POST['referencia_catastral_inmueble'])); } else { $referencia_catastral_inmueble = ''; }
if (isset($_POST['numero_matricula_inmueble']) <> '') { $numero_matricula_inmueble = mysqli_real_escape_string($conectar, ($_POST['numero_matricula_inmueble'])); } else { $numero_matricula_inmueble = ''; }

if (isset($_POST['deduccion_comision_ptj_inmueble']) <> '') { $deduccion_comision_ptj_inmueble = intval($_POST['deduccion_comision_ptj_inmueble']); } else { $deduccion_comision_ptj_inmueble = '0'; }

if (isset($_POST['descripcion_archivo_adjunto']) <> '') { $descripcion_archivo_adjunto = mysqli_real_escape_string($conectar, ($_POST['descripcion_archivo_adjunto'])); } else { $descripcion_archivo_adjunto = ''; }
if (isset($_POST['descripcion_archivo_adjunto2']) <> '') { $descripcion_archivo_adjunto2 = mysqli_real_escape_string($conectar, ($_POST['descripcion_archivo_adjunto2'])); } else { $descripcion_archivo_adjunto2 = ''; }
if (isset($_POST['descripcion_archivo_adjunto3']) <> '') { $descripcion_archivo_adjunto3 = mysqli_real_escape_string($conectar, ($_POST['descripcion_archivo_adjunto3'])); } else { $descripcion_archivo_adjunto3 = ''; }

if (isset($_FILES['archivo_adjunto']) <> '') { $archivo_adjunto = $_FILES['archivo_adjunto']['name']; } else { $archivo_adjunto = ''; }
if (isset($_FILES['archivo_adjunto2']) <> '') { $archivo_adjunto2 = $_FILES['archivo_adjunto2']['name']; } else { $archivo_adjunto2 = ''; }
if (isset($_FILES['archivo_adjunto3']) <> '') { $archivo_adjunto3 = $_FILES['archivo_adjunto3']['name']; } else { $archivo_adjunto3 = ''; }

$fecha_vencimiento               = $fecha_vencimiento1;
$lote_vencimiento                = $vencimiento_lote1;
$precio_costo_producto           = $precio_compra_producto;
$creador                         = $cuenta_actual;
$fecha_compra                    = date("Y-m-d");
$fecha_creacion                  = date("Y-m-d H:i:s");
$fecha_hora                      = date("H:i:s");
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$formato                         = 'jpg';
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");
$ruta_archivo_adjunto_orig       = '../archivador/documentos/';
$cod_estado_inmueble             = '1';

$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_producto'";
$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
$cod_producto = $datos_autoincremento_sesion['AUTO_INCREMENT'];

$agreg = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_producto, precio_costo_producto, precio_compra_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, nombre_via_administracion, posologia_cantidad, posologia_peso, 
nombre_frec_duracion, fecha_vencimiento1, vencimiento_lote1, fecha_vencimiento2, vencimiento_lote2, iva_ptj, tope_min, 
nombre_tipo_precio_venta, comision_ptj, cod_dependencia, fecha_vencimiento, lote_vencimiento, und_producto_bodega, fecha_mantenimiento, 
cod_producto_serial, 
cod_rodeo, nombre_rodeo, nombre_sexo, de_monta, nombre_estatus, nombre_condicion_corporal, nombre_categoria_ingreso, 
nombre_categoria_actual, nombre_categoria_futura, nombre_procedencia, nombre_tipo_monta, nombre_lote_categoria, 
nombre_prog_reproductivo, nombre_potrero, nombre_lote, nombre_calidad_animal, nombre_tipo_explotacion, peso_compra, 
precio_compra, nombre_propietario, fecha_nac, fecha_compra, fecha_castracion, nro_hierros, hierro_animal, 
numero_partos, id_electronica, nombre_raza, nombre_raza1, nombre_raza2, nombre_raza3, nombre_raza4, 
ptj_raza1, ptj_raza2, ptj_raza3, ptj_raza4, id_padre, raza_padre, id_madre, raza_madre, partos_madre, 
id_abuelo_paterno, id_abuelo_materno, nombre_abuelo_paterno, nombre_abuelo_materno, raza_abuelo_paterno, 
raza_abuelo_materno, id_abuela_paterno, id_abuela_materno, nombre_abuela_paterno, nombre_abuela_materno, 
raza_abuela_paterno, raza_abuela_materno, nombre_tipo_concepcion, nombre_especie, marcas_tatuado, 
marcas_herrado, marcas_descornado, marcas_castrado, nombre_color, nombre_temperamento, peso_nacer, 
aplomo_corvejon, aplomo_cuartilla, aplomo_cascos, genital_circun_escrotal, genital_prepusio, 
genital_potencia, genital_semen, observacion_animal, nombre_estado, nombre_tipo_movimiento, 
nombre_categoria_animal_extern, nombre_categoria_sub, descripcion_producto, cajas_sobre, und_sobre, 
meses_mantenimiento, meses_garantia, cod_factura, cod_marca, cod_tercero, cod_opcion_descontable_inv, 
cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, fecha_creacion, peso_producto, unidad_medida_peso, lote_compra, cod_origen_produccion, cod_dependencia_sub, 
referencia_catastral_inmueble, numero_matricula_inmueble, cod_estado_inmueble, deduccion_comision_ptj_inmueble) 
VALUES ('$cod_producto_barra', UPPER('$nombre_producto'), '$und_producto', '$precio_costo_producto', '$precio_compra_producto', 
'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5',
'$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$posologia_cantidad', '$posologia_peso', 
'$nombre_frec_duracion', '$fecha_vencimiento1', '$vencimiento_lote1', '$fecha_vencimiento2', '$vencimiento_lote2', '$iva_ptj', '$tope_min', 
'$nombre_tipo_precio_venta', '$comision_ptj', '$cod_dependencia', '$fecha_vencimiento', '$lote_vencimiento', '$und_producto_bodega', '$fecha_mantenimiento', 
'$cod_producto_serial', 
'$cod_rodeo', '$nombre_rodeo', '$nombre_sexo', '$de_monta', '$nombre_estatus', '$nombre_condicion_corporal', '$nombre_categoria_ingreso', 
'$nombre_categoria_actual', '$nombre_categoria_futura', '$nombre_procedencia', '$nombre_tipo_monta', '$nombre_lote_categoria', 
'$nombre_prog_reproductivo', '$nombre_potrero', '$nombre_lote', '$nombre_calidad_animal', '$nombre_tipo_explotacion', '$peso_compra', 
'$precio_compra', '$nombre_propietario', '$fecha_nac', '$fecha_compra', '$fecha_castracion', '$nro_hierros', '$hierro_animal', 
'$numero_partos', '$id_electronica', '$nombre_raza', '$nombre_raza1', '$nombre_raza2', '$nombre_raza3', '$nombre_raza4', 
'$ptj_raza1', '$ptj_raza2', '$ptj_raza3', '$ptj_raza4', '$id_padre', '$raza_padre', '$id_madre', '$raza_madre', '$partos_madre', 
'$id_abuelo_paterno', '$id_abuelo_materno', '$nombre_abuelo_paterno', '$nombre_abuelo_materno', '$raza_abuelo_paterno', 
'$raza_abuelo_materno', '$id_abuela_paterno', '$id_abuela_materno', '$nombre_abuela_paterno', '$nombre_abuela_materno', 
'$raza_abuela_paterno', '$raza_abuela_materno', '$nombre_tipo_concepcion', '$nombre_especie', '$marcas_tatuado', 
'$marcas_herrado', '$marcas_descornado', '$marcas_castrado', '$nombre_color', '$nombre_temperamento', '$peso_nacer', 
'$aplomo_corvejon', '$aplomo_cuartilla', '$aplomo_cascos', '$genital_circun_escrotal', '$genital_prepusio', 
'$genital_potencia', '$genital_semen', '$observacion_animal', '$nombre_estado', '$nombre_tipo_movimiento', 
'$nombre_categoria_animal_extern', '$nombre_categoria_sub', '$descripcion_producto', '$cajas_sobre', '$und_sobre', 
'$meses_mantenimiento', '$meses_garantia', '$cod_factura', '$cod_marca', '$cod_tercero', '$cod_opcion_descontable_inv', 
'$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$fecha_creacion', '$peso_producto', '$unidad_medida_peso', '$lote_compra', '$cod_origen_produccion', '$cod_dependencia_sub', 
'$referencia_catastral_inmueble', '$numero_matricula_inmueble', '$cod_estado_inmueble', '$deduccion_comision_ptj_inmueble')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

if ($fecha_vencimiento1 <> "") {
$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_compra, fecha_vencimiento, vencimiento_lote) 
VALUES ('$cod_producto_barra', '$fecha_compra', '$fecha_vencimiento', '$lote_vencimiento')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
}

if ($fecha_mantenimiento <> "") {
$agreg = "INSERT INTO tbl15_historial_fecha_mantenimiento (cod_producto_barra, fecha_compra, fecha_mantenimiento, meses_mantenimiento) 
VALUES ('$cod_producto_barra', '$fecha_compra', '$fecha_mantenimiento', '$meses_mantenimiento')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
}
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/foto/original/';
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_max_imagen = "SELECT MAX(cod_posicion) AS cod_posicion FROM tbl15_producto_imagen WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_max_imagen = mysqli_query($conectar, $sql_max_imagen) or die(mysqli_error($conectar));
$info_max_imagen = mysqli_fetch_assoc($consulta_max_imagen);

$cod_posicion                       = $info_max_imagen['cod_posicion']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
if ($descripcion_archivo_adjunto <> '') { 

$nombre_archivo_adjunto          = $descripcion_archivo_adjunto;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, fecha_creacion, fecha_hora, cod_administrador, nombre_archivo_adjunto, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$nombre_archivo_adjunto', UPPER('$descripcion_archivo_adjunto'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
if ($descripcion_archivo_adjunto2 <> '') { 

$nombre_archivo_adjunto          = $descripcion_archivo_adjunto2;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, fecha_creacion, fecha_hora, cod_administrador, nombre_archivo_adjunto, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$nombre_archivo_adjunto', UPPER('$descripcion_archivo_adjunto2'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
if ($descripcion_archivo_adjunto3 <> '') { 

$nombre_archivo_adjunto          = $descripcion_archivo_adjunto3;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, fecha_creacion, fecha_hora, cod_administrador, nombre_archivo_adjunto, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$nombre_archivo_adjunto', UPPER('$descripcion_archivo_adjunto3'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
/* ----------------------------------------------------------------------------------------------------------/ */
if ($archivo_adjunto <> '') { 

$formato_archivo_adjunto         = explode(".", $archivo_adjunto);
$formato_archivo_adjunto         = end($formato_archivo_adjunto);
$formato                         = strtoupper($formato_archivo_adjunto);
$nombre_normal_archivo           = $fecha_ymdHis.'_'.$cod_producto_barra.'.'.$formato_archivo_adjunto;
$url_archivo_adjunto             = $ruta_archivo_adjunto_orig.$nombre_normal_archivo;
$nombre_archivo_adjunto          = $archivo_adjunto;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, nombre_archivo_adjunto, url_archivo_adjunto, fecha_creacion, fecha_hora, cod_administrador, formato, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_archivo_adjunto', '$url_archivo_adjunto', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$formato', UPPER('$descripcion_archivo_adjunto'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

copy($_FILES['archivo_adjunto']['tmp_name'], $url_archivo_adjunto); 
}

if ($archivo_adjunto2 <> '') { 

$formato_archivo_adjunto         = explode(".", $archivo_adjunto2);
$formato_archivo_adjunto         = end($formato_archivo_adjunto);
$formato                         = strtoupper($formato_archivo_adjunto);
$nombre_normal_archivo           = $fecha_ymdHis.'_'.$cod_producto_barra.'.'.$formato_archivo_adjunto;
$url_archivo_adjunto             = $ruta_archivo_adjunto_orig.$nombre_normal_archivo;
$nombre_archivo_adjunto          = $archivo_adjunto2;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, nombre_archivo_adjunto, url_archivo_adjunto, fecha_creacion, fecha_hora, cod_administrador, formato, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_archivo_adjunto', '$url_archivo_adjunto', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$formato', UPPER('$descripcion_archivo_adjunto2'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

copy($_FILES['archivo_adjunto2']['tmp_name'], $url_archivo_adjunto); 
}

if ($archivo_adjunto3 <> '') { 

$formato_archivo_adjunto         = explode(".", $archivo_adjunto3);
$formato_archivo_adjunto         = end($formato_archivo_adjunto);
$formato                         = strtoupper($formato_archivo_adjunto);
$nombre_normal_archivo           = $fecha_ymdHis.'_'.$cod_producto_barra.'.'.$formato_archivo_adjunto;
$url_archivo_adjunto             = $ruta_archivo_adjunto_orig.$nombre_normal_archivo;
$nombre_archivo_adjunto          = $archivo_adjunto3;

$sql_data = "INSERT INTO tbl15_archivo_adjunto (cod_producto, cod_producto_barra, nombre_archivo_adjunto, url_archivo_adjunto, fecha_creacion, fecha_hora, cod_administrador, formato, descripcion_archivo_adjunto) 
VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_archivo_adjunto', '$url_archivo_adjunto', '$fecha_creacion', '$fecha_hora', '$cod_administrador', '$formato', UPPER('$descripcion_archivo_adjunto3'))";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

copy($_FILES['archivo_adjunto3']['tmp_name'], $url_archivo_adjunto); 
}
if ($url_img1 <> '') { 

$formato_img2                    = explode(".", $url_img1);
$formato_img2                    = end($formato_img2);
$formato_orig2                   = strtolower($formato_img2);
$nombre_foto_cryp                = crc32($url_img1);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_ori'.'.'.$formato_orig2;
$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;

copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
/* ----------------------------------------------------------------------------------------------------------/ */
$imagen_foto_miniatura                              = new upload($_FILES['url_img1']);
if ($imagen_foto_miniatura->uploaded) {
$imagen_foto_miniatura->image_resize                = true; // default is true
$imagen_foto_miniatura->image_convert               = $formato;
$imagen_foto_miniatura->image_x                     = 200; // para el ancho a cortar
$imagen_foto_miniatura->image_ratio_y               = true; // para que se ajuste dependiendo del ancho definido
$imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'; // agregamos un nuevo nombre
$imagen_foto_miniatura->process($ruta_foto_miniatura);

$nombre_miniatura = $fecha_ymdHis.'_'.$cod_producto.'_'.$cod_producto_barra.'_min'.'.'.$formato;
$url_img_min_producto = $ruta_foto_miniatura.$nombre_miniatura;

$sql_data = sprintf("UPDATE tbl15_producto SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "INSERT INTO tbl15_producto_imagen (cod_producto, cod_producto_barra, nombre_producto, url_img_orig_producto, url_img_min_producto, 
fecha_ymd, fecha_hora, cod_posicion) 
VALUES ('$cod_producto', '$cod_producto_barra', '$nombre_producto', '$url_img_orig_producto', '$url_img_min_producto', '$fecha_ymd', '$fecha_hora', '$cod_posicion')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} else { echo 'error : ' . $imagen_foto_miniatura->error; }
/* ----------------------------------------------------------------------------------------------------------/ */
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_producto_inmueble.php?cod_producto=<?php echo $cod_producto ?>">
<?php } } ?>
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