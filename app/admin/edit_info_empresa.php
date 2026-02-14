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
<div class="breadcrumbs"><a href="../admin/lista_info_empresa.php"><h4></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<?php
$cod_info_empresa                 = intval($_GET['cod_info_empresa']);
$pagina                           = addslashes($_GET['pagina']);
$pagina_local                     = $_SERVER['PHP_SELF'];
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_empresa.php">Editar Información</a></strong></td>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/edit_info_empresa_admin.php?cod_info_empresa=<?php echo $cod_info_empresa ?>&pagina=<?php echo $pagina ?>">.</a></strong></td>
    </tr></tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '$cod_info_empresa'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$titulo                                     = $matriz_consulta['titulo']; 
$desarrollador                              = $matriz_consulta['desarrollador']; 
$anyo                                       = $matriz_consulta['anyo']; 
$nombre                                     = $matriz_consulta['nombre']; 
$eslogan                                    = $matriz_consulta['eslogan']; 
$res                                        = $matriz_consulta['res']; 
$res1                                       = $matriz_consulta['res1']; 
$res2                                       = $matriz_consulta['res2']; 
$fecha_res                                  = $matriz_consulta['fecha_res'];
$pais                                       = $matriz_consulta['pais']; 
$departamento                               = $matriz_consulta['departamento']; 
$ciudad                                     = $matriz_consulta['ciudad']; 
$url_pag                                    = $matriz_consulta['url_pag']; 
$localidad                                  = $matriz_consulta['localidad']; 
$direccion                                  = $matriz_consulta['direccion']; 
$correo                                     = $matriz_consulta['correo']; 
$cabecera                                   = $matriz_consulta['cabecera']; 
$img_cabecera                               = $matriz_consulta['img_cabecera']; 
$telefono                                   = $matriz_consulta['telefono']; 
$nit_empresa                                = $matriz_consulta['nit_empresa']; 
$info_legal                                 = $matriz_consulta['info_legal']; 
$logotipo                                   = $matriz_consulta['logotipo']; 
$icono                                      = $matriz_consulta['icono']; 
$nombre_font                                = $matriz_consulta['nombre_font'];
$tamano_font_hc                             = $matriz_consulta['tamano_font_hc'];
$tamano_font_aptlab                         = $matriz_consulta['tamano_font_aptlab'];
$tamano_font_trabaltu                       = $matriz_consulta['tamano_font_trabaltu'];
$tamano_font_manaliment                     = $matriz_consulta['tamano_font_manaliment'];
$tamano_font_informe                        = $matriz_consulta['tamano_font_informe'];
$tamano_font_remision                       = $matriz_consulta['tamano_font_remision'];
$tamano_font_factura                        = $matriz_consulta['tamano_font_factura'];
$version                                    = $matriz_consulta['version']; 
$propietario_nombres_apellidos              = $matriz_consulta['propietario_nombres_apellidos']; 
$propietario_nit                            = $matriz_consulta['propietario_nit']; 
$propietario_url_firma                      = $matriz_consulta['propietario_url_firma'];
$reg_medico                                 = $matriz_consulta['reg_medico']; 
$licencia                                   = $matriz_consulta['licencia']; 
$regimen                                    = $matriz_consulta['regimen']; 
$smtp_correo_host                           = $matriz_consulta['smtp_correo_host']; 
$smtp_correo_auth                           = $matriz_consulta['smtp_correo_auth']; 
$smtp_correo_username                       = $matriz_consulta['smtp_correo_username']; 
$smtp_correo_password                       = $matriz_consulta['smtp_correo_password']; 
$smtp_correo_secure                         = $matriz_consulta['smtp_correo_secure']; 
$smtp_correo_port                           = $matriz_consulta['smtp_correo_port']; 
$info_histclinic                            = $matriz_consulta['info_histclinic']; 
$info_aptlaboral                            = $matriz_consulta['info_aptlaboral'];
$dia_ini_facturacion                        = $matriz_consulta['dia_ini_facturacion'];
$dia_fin_facturacion                        = $matriz_consulta['dia_fin_facturacion'];
$fecha_time                                 = $matriz_consulta['fecha_time'];
$nombre_tipo_precio_venta                   = $matriz_consulta['nombre_tipo_precio_venta'];
$numero_precio                              = $matriz_consulta['numero_precio'];
$nombre_concepto_multi_virtual              = $matriz_consulta['nombre_concepto_multi_virtual'];
$ptj_servicio_propina                       = $matriz_consulta['ptj_servicio_propina'];
$cod_servicio_propina                       = $matriz_consulta['cod_servicio_propina'];
$nombre_servicio_propina                    = $matriz_consulta['nombre_servicio_propina'];
$precio_servicio_propina                    = $matriz_consulta['precio_servicio_propina'];
$ptj_bolsa                                  = $matriz_consulta['ptj_bolsa'];
$cod_bolsa                                  = $matriz_consulta['cod_bolsa'];
$nombre_bolsa                               = $matriz_consulta['nombre_bolsa'];
$precio_bolsa                               = $matriz_consulta['precio_bolsa'];
$nombre_tipo_empresa                        = $matriz_consulta['nombre_tipo_empresa'];
$dias_vencimiento_producto_alerta           = $matriz_consulta['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global               = $matriz_consulta['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                    = $matriz_consulta['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                     = $matriz_consulta['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                            = $matriz_consulta['cod_estado_dto1_global'];
$cod_estado_dto2_global                            = $matriz_consulta['cod_estado_dto2_global'];
$cod_estado_preventa_global                        = $matriz_consulta['cod_estado_preventa_global'];
$cod_estado_propina_global                         = $matriz_consulta['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global             = $matriz_consulta['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra            = $matriz_consulta['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global     = $matriz_consulta['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_inventario_bodega_global               = $matriz_consulta['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                  = $matriz_consulta['cod_estado_sticker_barras_global'];
$cod_estado_modulo_contabilidad_global             = $matriz_consulta['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global               = $matriz_consulta['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica        = $matriz_consulta['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                = $matriz_consulta['cod_estado_producto_consumo_global'];
$nombre_tipo_impresora_zebra_ticket         = $matriz_consulta['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                   = $matriz_consulta['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                    = $matriz_consulta['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                          = $matriz_consulta['cod_estado_egreso_global'];
$cod_estado_usuario_global                         = $matriz_consulta['cod_estado_usuario_global'];
$cod_estado_dependencia_global                     = $matriz_consulta['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                    = $matriz_consulta['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global              = $matriz_consulta['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                            = $matriz_consulta['cod_estado_cita_global'];
$cod_estado_factura_compra_global                  = $matriz_consulta['cod_estado_factura_compra_global'];
$cod_estado_modulo_producto_global                 = $matriz_consulta['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global              = $matriz_consulta['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                    = $matriz_consulta['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                  = $matriz_consulta['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                   = $matriz_consulta['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                  = $matriz_consulta['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                    = $matriz_consulta['cod_estado_modulo_admin_global'];

$cod_estado_pyg_global                             = $matriz_consulta['cod_estado_pyg_global'];
$cod_estado_balance_global                         = $matriz_consulta['cod_estado_balance_global'];
$cod_estado_mov_contable_global                    = $matriz_consulta['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                    = $matriz_consulta['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global         = $matriz_consulta['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                = $matriz_consulta['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                       = $matriz_consulta['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                    = $matriz_consulta['cod_estado_envio_correo_global'];

$cod_estado_ordenamiento_alfabetico_venta_global   = $matriz_consulta['cod_estado_ordenamiento_alfabetico_venta_global'];
$cod_estado_nocodif_precio_compra_sticker_global   = $matriz_consulta['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global    = $matriz_consulta['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global          = $matriz_consulta['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global            = $matriz_consulta['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global             = $matriz_consulta['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global              = $matriz_consulta['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global    = $matriz_consulta['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                      = $matriz_consulta['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                            = $matriz_consulta['nombre_empresa_sticker'];
$nombre_buscar_por                                 = $matriz_consulta['nombre_buscar_por'];

$cod_estado_img_producto_global                    = $matriz_consulta['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global             = $matriz_consulta['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                          = $matriz_consulta['cod_estado_animal_global'];
$cod_estado_producto_serial_global                 = $matriz_consulta['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global              = $matriz_consulta['cod_estado_venta_prod_en_cero_global'];

$dias_prenes_parto                                 = $info_empresa_data['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global   = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                            = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_subproducto_global                     = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                = $info_empresa_data['cod_estado_nuevo_inventario_global'];

$tamano_font_sticker_barra_pdf                     = $info_empresa_data['tamano_font_sticker_barra_pdf'];
$ancho_sticker_barra_pdf                           = $info_empresa_data['ancho_sticker_barra_pdf'];
$alto_sticker_barra_pdf                            = $info_empresa_data['alto_sticker_barra_pdf'];
$columnas_sticker_barra_pdf                        = $info_empresa_data['columnas_sticker_barra_pdf'];
$nombre_estandar_sticker_barra_pdf                 = $info_empresa_data['nombre_estandar_sticker_barra_pdf'];
$tipo_hoja_sticker_barra_pdf                       = $info_empresa_data['tipo_hoja_sticker_barra_pdf'];

$correo_notificacion_alerta                        = $info_empresa_data['correo_notificacion_alerta'];

$nombre_pais_defec_global                          = $info_empresa_data['nombre_pais_defec_global'];
$nombre_departamento_defec_global                  = $info_empresa_data['nombre_departamento_defec_global'];
$nombre_ciudad_defec_global                        = $info_empresa_data['nombre_ciudad_defec_global'];
$nombre_tipo_cliente_defec_global                  = $info_empresa_data['nombre_tipo_cliente_defec_global'];
$nombre_tipo_regimen_defec_global                  = $info_empresa_data['nombre_tipo_regimen_defec_global'];
$nombre_tipo_impuesto_defec_global                 = $info_empresa_data['nombre_tipo_impuesto_defec_global'];
$leyenda1_defec_global                             = $info_empresa_data['leyenda1_defec_global'];
$leyenda2_defec_global                             = $info_empresa_data['leyenda2_defec_global'];
$leyenda3_defec_global                             = $info_empresa_data['leyenda3_defec_global'];
$leyenda4_defec_global                             = $info_empresa_data['leyenda4_defec_global'];
$leyenda_envio_correo_defec_global                 = $info_empresa_data['leyenda_envio_correo_defec_global'];
$nombre_concepto_egreso_defec_global               = $info_empresa_data['nombre_concepto_egreso_defec_global'];
$nombre_cod_tercero_defec_global                   = $info_empresa_data['nombre_cod_tercero_defec_global'];
$nombre_ccosto_defec_global                        = $info_empresa_data['nombre_ccosto_defec_global'];
$nombre_cod_tipo_pago_defec_global                 = $info_empresa_data['nombre_cod_tipo_pago_defec_global'];
$nombre_cod_tipo_forma_pago_defec_global           = $info_empresa_data['nombre_cod_tipo_forma_pago_defec_global'];
$nombre_cod_dependencia_defec_global               = $info_empresa_data['nombre_cod_dependencia_defec_global'];
$nombre_nombre_tipo_factura_defec_global           = $info_empresa_data['nombre_nombre_tipo_factura_defec_global'];
$cod_estado_tipo_nominacion_moneda_cierre_caja_global         = $info_empresa_data['cod_estado_tipo_nominacion_moneda_cierre_caja_global'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_info_empresa_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CABECERA PROGRAM</th>
			<th style="text-align:center">ESLOGAN</th>
			<th style="text-align:center">TITULO</th>
			<th style="text-align:center">CABECERA FACTURA</th>
			<th style="text-align:center">LEYENDA</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="nombre" value="<?php echo ($nombre) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="eslogan" value="<?php echo ($eslogan) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="titulo" value="<?php echo ($titulo) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="cabecera" value="<?php echo ($cabecera) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><textarea class="input-block-level" name="info_legal" rows="1" cols="20"><?php echo $info_legal ?></textarea></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PAIS</th>
			<th style="text-align:center">DEPARTAMENTO</th>
			<th style="text-align:center">CIUDAD</th>
			<th style="text-align:center">LOCALIDAD</th>
			<th style="text-align:center">DIRECCIÓN</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="pais" value="<?php echo ($pais) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="departamento" value="<?php echo ($departamento) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ciudad" value="<?php echo ($ciudad) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="localidad" value="<?php echo ($localidad) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="direccion" value="<?php echo ($direccion) ?>"  class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TELÉFONO</th>
			<th style="text-align:center">CORREO</th>
			<th style="text-align:center">NIT EMPRESA</th>
			<th style="text-align:center">RÉGIMEN</th>
			<th style="text-align:center">CORREO DE NOTIFICACION ALERTA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="telefono" value="<?php echo ($telefono) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="correo" value="<?php echo ($correo) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nit_empresa" value="<?php echo ($nit_empresa) ?>"  class="input-block-level" /></td>
<td style="text-align:center">
	<select name="regimen" class="input-block-level"  style="font-size:15px">
        <?php if (isset($regimen)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto";
        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($regimen) and $regimen == $datos2['nombre_tipo_impuesto']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo           = $datos2['nombre_tipo_impuesto'];
        $nombre           = $datos2['nombre_tipo_impuesto'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center"><input type="text" name="correo_notificacion_alerta" value="<?php echo ($correo_notificacion_alerta) ?>"  class="input-block-level" /></td>

    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">RESOLUCIÓN DIAN</th>
			<th style="text-align:center">DE</th>
			<th style="text-align:center">A</th>
			<th style="text-align:center">FECHA RESOLUCIÓN</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="res" value="<?php echo ($res) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="res1" value="<?php echo ($res1) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="res2" value="<?php echo ($res2) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="fecha_res" value="<?php echo ($fecha_res) ?>"  class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TAMAÑO LETRA BARRA PDF</th>
			<th style="text-align:center">ANCHO BARRA PDF</th>
			<th style="text-align:center">ALTO BARRA PDF</th>
			<th style="text-align:center">CANTIDAD COLUMNAS BARRA PDF</th>
			<th style="text-align:center">ESTANDAR BARRA PDF</th>
			<th style="text-align:center">TIPO HOJA BARRA PDF</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="number" name="tamano_font_sticker_barra_pdf" value="<?php echo ($tamano_font_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="ancho_sticker_barra_pdf" value="<?php echo ($ancho_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="alto_sticker_barra_pdf" value="<?php echo ($alto_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="columnas_sticker_barra_pdf" value="<?php echo ($columnas_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_estandar_sticker_barra_pdf" value="<?php echo ($nombre_estandar_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="tipo_hoja_sticker_barra_pdf" value="<?php echo ($tipo_hoja_sticker_barra_pdf) ?>"  class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE EMPRESA STICKER</th>
			<th style="text-align:center">BUSCAR POR DEFECTO</th>
			<th style="text-align:center">TIPO DE NOMINACION MONEDAS CIERRE CAJA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>   
			<td style="text-align:center"><input type="text" name="nombre_empresa_sticker" value="<?php echo ($nombre_empresa_sticker) ?>"  class="input-block-level" /></td>   
			<td style="text-align:center">
				<select name="nombre_buscar_por" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_buscar_por)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_buscar_por) and $nombre_buscar_por == $datos2['nombre_buscar_por']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_buscar_por'];
			        $nombre           = $datos2['titulo_buscar_por'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="cod_estado_tipo_nominacion_moneda_cierre_caja_global" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_estado_tipo_nominacion_moneda_cierre_caja_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_nominacion_moneda_cierre_caja WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado_tipo_nominacion_moneda_cierre_caja_global) and $cod_estado_tipo_nominacion_moneda_cierre_caja_global == $datos2['cod_tipo_nominacion_moneda_cierre_caja']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_tipo_nominacion_moneda_cierre_caja'];
			        $nombre           = $datos2['nombre_tipo_nominacion_moneda_cierre_caja'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO DE EMPRESA</th>
			<th style="text-align:center">CAJA VIRTUAL</th>
			<th style="text-align:center">NUM PRECIO</th>
			<th style="text-align:center">PRECIO PREDETERMINADO</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center">
	<select name="nombre_tipo_empresa" class="input-block-level"  style="font-size:15px">
        <?php if (isset($nombre_tipo_empresa)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT * FROM tbl15_tipo_empresa";
        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($nombre_tipo_empresa) and $nombre_tipo_empresa == $datos2['nombre_tipo_empresa']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo           = $datos2['nombre_tipo_empresa'];
        $nombre           = $datos2['nombre_tipo_empresa'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center"><input type="text" name="nombre_concepto_multi_virtual" value="<?php echo ($nombre_concepto_multi_virtual) ?>"  class="input-block-level" /></td>
<td style="text-align:center">
	<select name="numero_precio" class="selectpicker" data-show-subtext="true" data-live-search="true">
	<?php if (isset($numero_precio)) { echo "<option value='' >Selecione</option>";
	} else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta WHERE (cod_tipo_precio_venta <= 5) ORDER BY cod_tipo_precio_venta ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($numero_precio) and $numero_precio == $datos2['cod_tipo_precio_venta']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['cod_tipo_precio_venta'];
	$nombre = $datos2['cod_tipo_precio_venta'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
<td style="text-align:center">
	<select name="nombre_tipo_precio_venta" class="selectpicker" data-show-subtext="true" data-live-search="true">
	<?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' >Selecione</option>";
	} else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_tipo_precio_venta, nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta ORDER BY cod_tipo_precio_venta ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($nombre_tipo_precio_venta) and $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['nombre_tipo_precio_venta'];
	$nombre = $datos2['nombre_tipo_precio_venta'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>
</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PAIS POR DEFECT</th>
			<th style="text-align:center">DEPARTAMENTO POR DEFECT</th>
			<th style="text-align:center">CIUDAD POR DEFECT</th>
			<th style="text-align:center">TIPO CLIENTE POR DEFECT</th>
			<th style="text-align:center">TIPO REGIMEN POR DEFECT</th>
			<th style="text-align:center">TIPO IMPUESTO DEFECT</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
			    <select name="nombre_pais_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_pais_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_pais, nombre_pais FROM tbl15_pais WHERE (cod_estado = '1')");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_pais_defec_global) and $nombre_pais_defec_global == $datos2['cod_pais']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_pais'];
			        $nombre = $datos2['nombre_pais'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>

			<td>
            	<select name="nombre_departamento_defec_global" id="cod_departamento" class="chosen" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($nombre_departamento_defec_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_departamento WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_departamento_defec_global) and $nombre_departamento_defec_global == $datos2['cod_departamento']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_departamento'];
			        $nombre           = $datos2['nombre_departamento'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td id="cod_municipio_select">
            	<select name="nombre_ciudad_defec_global" id="cod_municipio" class="chosen" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($nombre_ciudad_defec_global)) { echo "<option value='0' selected >Selecione</option>"; } else { echo "<option value='0' selected >Selecione</option>"; }
			        $consulta2_sql = "SELECT * FROM tbl15_municipio WHERE (cod_departamento = '$nombre_departamento_defec_global') AND (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_ciudad_defec_global) and $nombre_ciudad_defec_global == $datos2['cod_municipio']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_municipio'];
			        $nombre           = $datos2['nombre_municipio'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td style="text-align:center">
			    <select name="nombre_tipo_cliente_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_tipo_cliente_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_cliente, nombre_tipo_cliente FROM tbl15_tipo_cliente");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_cliente_defec_global) and $nombre_tipo_cliente_defec_global == $datos2['nombre_tipo_cliente']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_tipo_cliente'];
			        $nombre = $datos2['nombre_tipo_cliente'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>
			<td style="text-align:center">
			    <select name="nombre_tipo_regimen_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_tipo_regimen_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_regimen, nombre_tipo_regimen FROM tbl15_tipo_regimen WHERE (cod_estado = '1')");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_regimen_defec_global) and $nombre_tipo_regimen_defec_global == $datos2['nombre_tipo_regimen']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_tipo_regimen'];
			        $nombre = $datos2['nombre_tipo_regimen'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>
			<td style="text-align:center">
			    <select name="nombre_tipo_impuesto_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_tipo_impuesto_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_impuesto, nombre_tipo_impuesto FROM tbl15_tipo_impuesto");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_impuesto_defec_global) and $nombre_tipo_impuesto_defec_global == $datos2['nombre_tipo_impuesto']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_tipo_impuesto'];
			        $nombre = $datos2['nombre_tipo_impuesto'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CEONCEPTO EGRESO POR DEFECT</th>
			<th style="text-align:center">TERCERO POR DEFECT</th>
			<th style="text-align:center">CENTRO COSTO POR DEFECT</th>
			<th style="text-align:center">TIPO PAGO POR DEFECT</th>
			<th style="text-align:center">FORMA PAGO POR DEFECT</th>
			<th style="text-align:center">DEPENDENCIA POR DEFECT</th>
			<th style="text-align:center">TIPO FACTURA POR DEFECT</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:left">
			    <select name="nombre_concepto_egreso_defec_global" id="nombre_concepto_egreso_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			    <?php if (isset($nombre_concepto_egreso_defec_global)) { echo ""; } else { echo ""; }
			    $consulta2_sql = ("SELECT * FROM tbl15_gastos_tabla ORDER BY cod_gastos_tabla ASC");
			    $consulta2 = mysqli_query($conectar, $consulta2_sql);
			    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			    if(isset($nombre_concepto_egreso_defec_global) and $nombre_concepto_egreso_defec_global == $datos2['conceptos']) {
			    $seleccionado = "selected"; } else { $seleccionado = ""; }
			    $codigo = $datos2['conceptos'];
			    $nombre = $datos2['conceptos'];
			    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>

			<td style="text-align:left">
			    <select name="nombre_cod_tercero_defec_global" id="nombre_cod_tercero_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			    <?php if (isset($nombre_cod_tercero_defec_global)) { echo ""; } else { echo ""; }
			    $consulta2_sql = ("SELECT cod_tercero, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC");
			    $consulta2 = mysqli_query($conectar, $consulta2_sql);
			    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			    if(isset($nombre_cod_tercero_defec_global) and $nombre_cod_tercero_defec_global == $datos2['cod_tercero']) {
			    $seleccionado = "selected"; } else { $seleccionado = ""; }
			    $codigo = $datos2['cod_tercero'];
			    $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'].' - '.$datos2['nombre_tipo_tercero'].' - '.$datos2['identificacion_tercero'];
			    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>
			<td style="text-align:left">
			    <select name="nombre_ccosto_defec_global" id="nombre_ccosto_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_ccosto_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_ccosto, nombre_ccosto FROM tbl15_ccosto ORDER BY nombre_ccosto ASC");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_ccosto_defec_global) and $nombre_ccosto_defec_global == $datos2['nombre_ccosto']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_ccosto'];
			        $nombre = $datos2['nombre_ccosto'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>

			<td style="text-align:left">
			    <select name="nombre_cod_tipo_pago_defec_global" id="nombre_cod_tipo_pago_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_cod_tipo_pago_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_cod_tipo_pago_defec_global) and $nombre_cod_tipo_pago_defec_global == $datos2['cod_tipo_pago']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_tipo_pago'];
			        $nombre = $datos2['nombre_tipo_pago'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>

			<td style="text-align:left">
			    <select name="nombre_cod_tipo_forma_pago_defec_global" id="nombre_cod_tipo_forma_pago_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_cod_tipo_forma_pago_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1')");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_cod_tipo_forma_pago_defec_global) and $nombre_cod_tipo_forma_pago_defec_global == $datos2['cod_tipo_forma_pago']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_tipo_forma_pago'];
			        $nombre = $datos2['nombre_tipo_forma_pago'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>

			<td style="text-align:center">
			    <select name="nombre_cod_dependencia_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_cod_dependencia_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY cod_dependencia ASC");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_cod_dependencia_defec_global) and $nombre_cod_dependencia_defec_global == $datos2['cod_dependencia']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_dependencia'];
			        $nombre = $datos2['nombre_dependencia'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>

			<td style="text-align:center">
			    <select name="nombre_nombre_tipo_factura_defec_global" class="input-block-level" data-show-subtext="true" data-live-search="true" >
			        <?php if (isset($nombre_nombre_tipo_factura_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = ("SELECT cod_tipo_factura, nombre_tipo_factura FROM tbl15_tipo_factura");
			        $consulta2 = mysqli_query($conectar, $consulta2_sql);
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_nombre_tipo_factura_defec_global) and $nombre_nombre_tipo_factura_defec_global == $datos2['nombre_tipo_factura']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_tipo_factura'];
			        $nombre = $datos2['nombre_tipo_factura'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
			    </select>
			</td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">LEYENDA 1 SITIO RECIB COTIZ CORF</th>
			<th style="text-align:center">LEYENDA 2 HORARIO ATENCION COTIZ CORF</th>
			<th style="text-align:center">LEYENDA 3 SEÑOR PROV COTIZ CORF</th>

		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda1_defec_global" rows="5" cols="20"><?php echo $leyenda1_defec_global ?></textarea></td>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda2_defec_global" rows="5" cols="20"><?php echo $leyenda2_defec_global ?></textarea></td>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda3_defec_global" rows="5" cols="20"><?php echo $leyenda3_defec_global ?></textarea></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">LEYENDA 4 POLITIC PROTEC DATOS</th>
			<th style="text-align:center">LEYENDA 5 ADVERTENCIA LEGAL</th>
			<th style="text-align:center">LEYENDA ENVIO CORREO</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda4_defec_global" rows="5" cols="20"><?php echo $leyenda4_defec_global ?></textarea></td>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda5_defec_global" rows="5" cols="20"><?php echo $leyenda5_defec_global ?></textarea></td>
			<td style="text-align:center"><textarea class="input-block-level" name="leyenda_envio_correo_defec_global" rows="5" cols="20"><?php echo $leyenda_envio_correo_defec_global ?></textarea></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">OPERADOR DE FACTURA ELECTRONCIA</th>
			<th style="text-align:center">TIPO IMPRESORA ZEBRA TICKET</th>
			<th style="text-align:center">URL ENCUESTA EXPERIENCIA COMPRA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center">
				<select name="nombre_operador_factura_electronica" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_operador_factura_electronica)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_operador_factura_electronica";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_operador_factura_electronica) and $nombre_operador_factura_electronica == $datos2['nombre_operador_factura_electronica']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_operador_factura_electronica'];
			        $nombre           = $datos2['nombre_operador_factura_electronica'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_impresora_zebra_ticket" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_impresora_zebra_ticket)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impresora_zebra_ticket";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_impresora_zebra_ticket) and $nombre_tipo_impresora_zebra_ticket == $datos2['nombre_tipo_impresora_zebra_ticket']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_impresora_zebra_ticket'];
			        $nombre           = $datos2['nombre_tipo_impresora_zebra_ticket'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><input type="text" name="url_encuesta_experiencia_compra" value="<?php echo ($url_encuesta_experiencia_compra) ?>"  class="input-block-level" /></td>	
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PTJ PROPINA</th>
			<th style="text-align:center">COD PROPINA</th>
			<th style="text-align:center">NOMBRE PROPINA</th>
			<th style="text-align:center">PRECIO PROPINA</th>
			<th style="text-align:center">PTJ BOLSA</th>
			<th style="text-align:center">COD BOLSA</th>
			<th style="text-align:center">NOMBRE BOLSA</th>
			<th style="text-align:center">PRECIO BOLSA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="ptj_servicio_propina" value="<?php echo ($ptj_servicio_propina) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="cod_servicio_propina" value="<?php echo ($cod_servicio_propina) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_servicio_propina" value="<?php echo ($nombre_servicio_propina) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_servicio_propina" value="<?php echo ($precio_servicio_propina) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="ptj_bolsa" value="<?php echo ($ptj_bolsa) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="cod_bolsa" value="<?php echo ($cod_bolsa) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="nombre_bolsa" value="<?php echo ($nombre_bolsa) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="precio_bolsa" value="<?php echo ($precio_bolsa) ?>"  class="input-block-level" /></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">NOMBRE PROPIETARIO</th>
			<th style="text-align:center">NIT PROPIETARIO</th>
			<th style="text-align:center">FIRMA PROPIETARIO</th>
			<th style="text-align:center">CAMBIAR FIRMA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>   
<td style="text-align:center"><input type="text" name="propietario_nombres_apellidos" value="<?php echo ($propietario_nombres_apellidos) ?>"  class="input-block-level" /></td>   
<td style="text-align:center"><input type="text" name="propietario_nit" value="<?php echo ($propietario_nit) ?>" class="input-block-level" /></td> 
<td style="text-align:center"><img src="<?php echo ($propietario_url_firma) ?>" height="20"></td>
<td style="text-align:center"><a href="../admin/edit_cargar_firma_empresa.php?cod_info_empresa=<?php echo $cod_info_empresa; ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/cambiar_firma_usuario.png"></a></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">REG MEDICO</th>
			<th style="text-align:center">LICENCIA</th>
			<!--<th style="text-align:center">INFO HC</th>-->
			<th style="text-align:center">INFO APTLAB</th>
			<th style="text-align:center">DIA INI FACT</th>
			<th style="text-align:center">DIA FIN FACT</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="reg_medico" value="<?php echo ($reg_medico) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="licencia" value="<?php echo ($licencia) ?>"  class="input-block-level" /></td>
<!--<td style="text-align:center"><input type="text" name="info_histclinic" value="<?php echo ($info_histclinic) ?>"  class="input-block-level" /></td>-->
<td style="text-align:center"><textarea class="input-block-level" name="info_aptlaboral" rows="5" cols="20"><?php echo $info_aptlaboral ?></textarea></td>
<td style="text-align:center"><input type="text" name="dia_ini_facturacion" value="<?php echo ($dia_ini_facturacion) ?>"  class="input-block-level"  size="1"/></td> 
<td style="text-align:center"><input type="text" name="dia_fin_facturacion" value="<?php echo ($dia_fin_facturacion) ?>"  class="input-block-level"  size="1"/></td> 
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">LETRA HC</th>
			<th style="text-align:center">LETRA APTLAB</th>
			<th style="text-align:center">LETRA TRABALTURA</th>
			<th style="text-align:center">LETRA MANALIMENT</th>
			<th style="text-align:center">LETRA INFORME</th>
			<th style="text-align:center">LETRA REMISION</th>
			<th style="text-align:center">LETRA FACTURA</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="number" name="tamano_font_hc" value="<?php echo ($tamano_font_hc) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_aptlab" value="<?php echo ($tamano_font_aptlab) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_trabaltu" value="<?php echo ($tamano_font_trabaltu) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_manaliment" value="<?php echo ($tamano_font_manaliment) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_informe" value="<?php echo ($tamano_font_informe) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_remision" value="<?php echo ($tamano_font_remision) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="number" name="tamano_font_factura" value="<?php echo ($tamano_font_factura) ?>"  class="input-block-level" /></td> 
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">IMAG CABECERA</th>
			<th style="text-align:center">LOGOTIPO</th>
			<th style="text-align:center">TIPOGRAFIA</th>
			<th style="text-align:center">ICONO</th>
		</tr></thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="img_cabecera" value="<?php echo ($img_cabecera) ?>"  class="input-block-level" /></td>   
<td style="text-align:center"><input type="text" name="logotipo" value="<?php echo ($logotipo) ?>"  class="input-block-level" /></td>
<td style="text-align:center">
	<select name="nombre_font" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_font)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_font, nombre_font FROM tbl15_font ORDER BY nombre_font ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_font) and $nombre_font == $datos2['nombre_font']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_font'];
$nombre = $datos2['nombre_font'];
echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
<td style="text-align:center">
<?php $sql_consulta = "SELECT * FROM tbl15_icono_logo";
$resultado = mysqli_query($conectar, $sql_consulta) or die(mysqli_error($conectar));
while ($contenedor = mysqli_fetch_assoc($resultado)) {?>
<input type="radio" name="icono" value="<?php echo $contenedor['nombre_icono_logo'] ?>"checked>
<img src=<?php echo $contenedor['url_icono_logo']?> width="30" height="30">
<?php } ?> </td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">SMTP HOST</th>
			<th style="text-align:center">SMTP AUTH</th>
			<th style="text-align:center">SMTP USER</th>
			<th style="text-align:center">SMTP PASS</th>
			<th style="text-align:center">SMTP SECURE</th>
			<th style="text-align:center">SMTP PORT</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
<td style="text-align:center"><input type="text" name="smtp_correo_host" value="<?php echo ($smtp_correo_host) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_auth" value="<?php echo ($smtp_correo_auth) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_username" value="<?php echo ($smtp_correo_username) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_password" value="<?php echo ($smtp_correo_password) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_secure" value="<?php echo ($smtp_correo_secure) ?>"  class="input-block-level" /></td>
<td style="text-align:center"><input type="text" name="smtp_correo_port" value="<?php echo ($smtp_correo_port) ?>"  class="input-block-level" /></td> 
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_info_empresa" value="<?php echo $cod_info_empresa ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>
<script language="javascript">
$(document).ready(function(){
    $("#cod_departamento").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_departamento";
        var tipo_ajax = "tbl15_tercero";
        var id = "0";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_municipio_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
            	$("#cod_municipio_select").html(respuesta);
            }
        });

   });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
var cod_estado_modulo_producto_global = $('#cod_estado_modulo_producto_global').val();
var cod_estado_modulo_facturacion_global = $('#cod_estado_modulo_facturacion_global').val();
var cod_estado_modulo_venta_global = $('#cod_estado_modulo_venta_global').val();
var cod_estado_modulo_tercero_global = $('#cod_estado_modulo_tercero_global').val();
var cod_estado_modulo_cuenta_global = $('#cod_estado_modulo_cuenta_global').val();
var cod_estado_modulo_reporte_global = $('#cod_estado_modulo_reporte_global').val();
var cod_estado_modulo_admin_global = $('#cod_estado_modulo_admin_global').val();
var cod_estado_mov_contable_global = $('#cod_estado_mov_contable_global').val();
var cod_estado_pyg_global = $('#cod_estado_pyg_global').val();
var cod_estado_balance_global = $('#cod_estado_balance_global').val();
var cod_estado_ganancia_ptj_global = $('#cod_estado_ganancia_ptj_global').val();
var cod_estado_modulo_orden_produccion_global = $('#cod_estado_modulo_orden_produccion_global').val();
var cod_estado_comentario_venta_global = $('#cod_estado_comentario_venta_global').val();
var cod_estado_envio_sms_global = $('#cod_estado_envio_sms_global').val();
var cod_estado_envio_correo_global = $('#cod_estado_envio_correo_global').val();
var cod_estado_fecha_vencimiento_global = $('#cod_estado_fecha_vencimiento_global').val();
var cod_estado_ptj_comision_global = $('#cod_estado_ptj_comision_global').val();
var cod_estado_impoconsumo_global = $('#cod_estado_impoconsumo_global').val();
var cod_estado_dto1_global = $('#cod_estado_dto1_global').val();
var cod_estado_dto2_global = $('#cod_estado_dto2_global').val();
var cod_estado_producto_consumo_global = $('#cod_estado_producto_consumo_global').val();
var cod_estado_cuenta_cobrar_global = $('#cod_estado_cuenta_cobrar_global').val();
var cod_estado_cuenta_pagar_global = $('#cod_estado_cuenta_pagar_global').val();
var cod_estado_egreso_global = $('#cod_estado_egreso_global').val();
var cod_estado_factura_compra_global = $('#cod_estado_factura_compra_global').val();
var cod_estado_cita_global = $('#cod_estado_cita_global').val();
var cod_estado_usuario_global = $('#cod_estado_usuario_global').val();
var cod_estado_dependencia_global = $('#cod_estado_dependencia_global').val();
var cod_estado_resolucion_factura_global = $('#cod_estado_resolucion_factura_global').val();
var cod_estado_numero_letra_global = $('#cod_estado_numero_letra_global').val();
var cod_estado_encuesta_experiencia_compra_global = $('#cod_estado_encuesta_experiencia_compra_global').val();
var cod_estado_codif_precio_compra_global = $('#cod_estado_codif_precio_compra_global').val();
var cod_estado_codif_precio_venta_global = $('#cod_estado_codif_precio_venta_global').val();
var cod_estado_img_impimir_factura_global = $('#cod_estado_img_impimir_factura_global').val();
var cod_estado_preventa_global = $('#cod_estado_preventa_global').val();
var cod_estado_propina_global = $('#cod_estado_propina_global').val();
var cod_estado_inventario_bodega_global = $('#cod_estado_inventario_bodega_global').val();
var cod_estado_modulo_contabilidad_global = $('#cod_estado_modulo_contabilidad_global').val();
var cod_estado_modulo_cotizacion_global = $('#cod_estado_modulo_cotizacion_global').val();
var cod_estado_compra_caja_global = $('#cod_estado_compra_caja_global').val();
var cod_estado_sticker_barras_global = $('#cod_estado_sticker_barras_global').val();
var cod_estado_modulo_cotizacion_global = $('#cod_estado_modulo_cotizacion_global').val();
var cod_estado_producto_consumo_global = $('#cod_estado_producto_consumo_global').val();
var cod_estado_compra_caja_global = $('#cod_estado_compra_caja_global').val();
var cod_estado_cuenta_cobrar_global = $('#cod_estado_cuenta_cobrar_global').val();
var cod_estado_cuenta_pagar_global = $('#cod_estado_cuenta_pagar_global').val();
var cod_estado_egreso_global = $('#cod_estado_egreso_global').val();
var cod_estado_usuario_global = $('#cod_estado_usuario_global').val();
var cod_estado_dependencia_global = $('#cod_estado_dependencia_global').val();
var cod_estado_numero_letra_global = $('#cod_estado_numero_letra_global').val();
var cod_estado_resolucion_factura_global = $('#cod_estado_resolucion_factura_global').val();
var cod_estado_cita_global = $('#cod_estado_cita_global').val();
var cod_estado_factura_compra_global = $('#cod_estado_factura_compra_global').val();
var cod_estado_modulo_producto_global = $('#cod_estado_modulo_producto_global').val();
var cod_estado_modulo_facturacion_global = $('#cod_estado_modulo_facturacion_global').val();
var cod_estado_modulo_venta_global = $('#cod_estado_modulo_venta_global').val();
var cod_estado_modulo_tercero_global = $('#cod_estado_modulo_tercero_global').val();
var cod_estado_modulo_cuenta_global = $('#cod_estado_modulo_cuenta_global').val();
var cod_estado_modulo_reporte_global = $('#cod_estado_modulo_reporte_global').val();
var cod_estado_modulo_admin_global = $('#cod_estado_modulo_admin_global').val();
var cod_estado_pyg_global = $('#cod_estado_pyg_global').val();
var cod_estado_balance_global = $('#cod_estado_balance_global').val();
var cod_estado_ganancia_ptj_global = $('#cod_estado_ganancia_ptj_global').val();
var cod_estado_modulo_orden_produccion_global = $('#cod_estado_modulo_orden_produccion_global').val();
var cod_estado_comentario_venta_global = $('#cod_estado_comentario_venta_global').val();
var cod_estado_envio_sms_global = $('#cod_estado_envio_sms_global').val();
var cod_estado_envio_correo_global = $('#cod_estado_envio_correo_global').val();
var cod_estado_ordenamiento_alfabetico_venta_global = $('#cod_estado_ordenamiento_alfabetico_venta_global').val();
var cod_estado_nocodif_precio_compra_sticker_global = $('#cod_estado_nocodif_precio_compra_sticker_global').val();
var cod_estado_nocodif_precio_venta_sticker_global = $('#cod_estado_nocodif_precio_venta_sticker_global').val();
var cod_estado_nombre_empresa_sticker_global = $('#cod_estado_nombre_empresa_sticker_global').val();
var cod_estado_fecha_compra_sticker_global = $('#cod_estado_fecha_compra_sticker_global').val();
var cod_estado_cod_tercero_sticker_global = $('#cod_estado_cod_tercero_sticker_global').val();
var cod_estado_url_pagina_sticker_global = $('#cod_estado_url_pagina_sticker_global').val();
var cod_estado_nombre_desarrollador_sticker_global = $('#cod_estado_nombre_desarrollador_sticker_global').val();
var cod_estado_qr_sticker_global = $('#cod_estado_qr_sticker_global').val();
var cod_estado_habilitar_tercero_por_usuario_global = $('#cod_estado_habilitar_tercero_por_usuario_global').val();
var cod_estado_subproducto_global = $('#cod_estado_subproducto_global').val();
var cod_estado_nuevo_inventario_global = $('#cod_estado_nuevo_inventario_global').val();
var cod_estado_auditoria_global = $('#cod_estado_auditoria_global').val();
var cod_estado_cierre_caja_global = $('#cod_estado_cierre_caja_global').val();


if (cod_estado_modulo_producto_global=='1') { $('#cod_estado_modulo_producto_global').val('1'); $('#cod_estado_modulo_producto_global').prop('checked',true); } else { $('#cod_estado_modulo_producto_global').val('0'); $('#cod_estado_modulo_producto_global').prop('checked',false); } 
if (cod_estado_modulo_facturacion_global=='1') { $('#cod_estado_modulo_facturacion_global').val('1'); $('#cod_estado_modulo_facturacion_global').prop('checked',true); } else { $('#cod_estado_modulo_facturacion_global').val('0'); $('#cod_estado_modulo_facturacion_global').prop('checked',false); }
if (cod_estado_modulo_venta_global=='1') { $('#cod_estado_modulo_venta_global').val('1'); $('#cod_estado_modulo_venta_global').prop('checked',true); } else { $('#cod_estado_modulo_venta_global').val('0'); $('#cod_estado_modulo_venta_global').prop('checked',false); } 
if (cod_estado_modulo_tercero_global=='1') { $('#cod_estado_modulo_tercero_global').val('1'); $('#cod_estado_modulo_tercero_global').prop('checked',true); } else { $('#cod_estado_modulo_tercero_global').val('0'); $('#cod_estado_modulo_tercero_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_global=='1') { $('#cod_estado_modulo_cuenta_global').val('1'); $('#cod_estado_modulo_cuenta_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_global').val('0'); $('#cod_estado_modulo_cuenta_global').prop('checked',false); } 
if (cod_estado_modulo_reporte_global=='1') { $('#cod_estado_modulo_reporte_global').val('1'); $('#cod_estado_modulo_reporte_global').prop('checked',true); } else { $('#cod_estado_modulo_reporte_global').val('0'); $('#cod_estado_modulo_reporte_global').prop('checked',false); } 
if (cod_estado_modulo_admin_global=='1') { $('#cod_estado_modulo_admin_global').val('1'); $('#cod_estado_modulo_admin_global').prop('checked',true); } else { $('#cod_estado_modulo_admin_global').val('0'); $('#cod_estado_modulo_admin_global').prop('checked',false); } 
if (cod_estado_mov_contable_global=='1') { $('#cod_estado_mov_contable_global').val('1'); $('#cod_estado_mov_contable_global').prop('checked',true); } else { $('#cod_estado_mov_contable_global').val('0'); $('#cod_estado_mov_contable_global').prop('checked',false); } 
if (cod_estado_pyg_global=='1') { $('#cod_estado_pyg_global').val('1'); $('#cod_estado_pyg_global').prop('checked',true); } else { $('#cod_estado_pyg_global').val('0'); $('#cod_estado_pyg_global').prop('checked',false); } 
if (cod_estado_balance_global=='1') { $('#cod_estado_balance_global').val('1'); $('#cod_estado_balance_global').prop('checked',true); } else { $('#cod_estado_balance_global').val('0'); $('#cod_estado_balance_global').prop('checked',false); } 
if (cod_estado_ganancia_ptj_global=='1') { $('#cod_estado_ganancia_ptj_global').val('1'); $('#cod_estado_ganancia_ptj_global').prop('checked',true); } else { $('#cod_estado_ganancia_ptj_global').val('0'); $('#cod_estado_ganancia_ptj_global').prop('checked',false); } 
if (cod_estado_modulo_orden_produccion_global=='1') { $('#cod_estado_modulo_orden_produccion_global').val('1'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',true); } else { $('#cod_estado_modulo_orden_produccion_global').val('0'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',false); } 
if (cod_estado_comentario_venta_global=='1') { $('#cod_estado_comentario_venta_global').val('1'); $('#cod_estado_comentario_venta_global').prop('checked',true); } else { $('#cod_estado_comentario_venta_global').val('0'); $('#cod_estado_comentario_venta_global').prop('checked',false); } 
if (cod_estado_envio_sms_global=='1') { $('#cod_estado_envio_sms_global').val('1'); $('#cod_estado_envio_sms_global').prop('checked',true); } else { $('#cod_estado_envio_sms_global').val('0'); $('#cod_estado_envio_sms_global').prop('checked',false); } 
if (cod_estado_envio_correo_global=='1') { $('#cod_estado_envio_correo_global').val('1'); $('#cod_estado_envio_correo_global').prop('checked',true); } else { $('#cod_estado_envio_correo_global').val('0'); $('#cod_estado_envio_correo_global').prop('checked',false); } 
if (cod_estado_fecha_vencimiento_global=='1') { $('#cod_estado_fecha_vencimiento_global').val('1'); $('#cod_estado_fecha_vencimiento_global').prop('checked',true); } else { $('#cod_estado_fecha_vencimiento_global').val('0'); $('#cod_estado_fecha_vencimiento_global').prop('checked',false); } 
if (cod_estado_ptj_comision_global=='1') { $('#cod_estado_ptj_comision_global').val('1'); $('#cod_estado_ptj_comision_global').prop('checked',true); } else { $('#cod_estado_ptj_comision_global').val('0'); $('#cod_estado_ptj_comision_global').prop('checked',false); } 
if (cod_estado_impoconsumo_global=='1') { $('#cod_estado_impoconsumo_global').val('1'); $('#cod_estado_impoconsumo_global').prop('checked',true); } else { $('#cod_estado_impoconsumo_global').val('0'); $('#cod_estado_impoconsumo_global').prop('checked',false); } 
if (cod_estado_dto1_global=='1') { $('#cod_estado_dto1_global').val('1'); $('#cod_estado_dto1_global').prop('checked',true); } else { $('#cod_estado_dto1_global').val('0'); $('#cod_estado_dto1_global').prop('checked',false); } 
if (cod_estado_dto2_global=='1') { $('#cod_estado_dto2_global').val('1'); $('#cod_estado_dto2_global').prop('checked',true); } else { $('#cod_estado_dto2_global').val('0'); $('#cod_estado_dto2_global').prop('checked',false); } 
if (cod_estado_producto_consumo_global=='1') { $('#cod_estado_producto_consumo_global').val('1'); $('#cod_estado_producto_consumo_global').prop('checked',true); } else { $('#cod_estado_producto_consumo_global').val('0'); $('#cod_estado_producto_consumo_global').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_global=='1') { $('#cod_estado_cuenta_cobrar_global').val('1'); $('#cod_estado_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_global').val('0'); $('#cod_estado_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_cuenta_pagar_global=='1') { $('#cod_estado_cuenta_pagar_global').val('1'); $('#cod_estado_cuenta_pagar_global').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_global').val('0'); $('#cod_estado_cuenta_pagar_global').prop('checked',false); } 
if (cod_estado_egreso_global=='1') { $('#cod_estado_egreso_global').val('1'); $('#cod_estado_egreso_global').prop('checked',true); } else { $('#cod_estado_egreso_global').val('0'); $('#cod_estado_egreso_global').prop('checked',false); } 
if (cod_estado_factura_compra_global=='1') { $('#cod_estado_factura_compra_global').val('1'); $('#cod_estado_factura_compra_global').prop('checked',true); } else { $('#cod_estado_factura_compra_global').val('0'); $('#cod_estado_factura_compra_global').prop('checked',false); } 
if (cod_estado_cita_global=='1') { $('#cod_estado_cita_global').val('1'); $('#cod_estado_cita_global').prop('checked',true); } else { $('#cod_estado_cita_global').val('0'); $('#cod_estado_cita_global').prop('checked',false); } 
if (cod_estado_usuario_global=='1') { $('#cod_estado_usuario_global').val('1'); $('#cod_estado_usuario_global').prop('checked',true); } else { $('#cod_estado_usuario_global').val('0'); $('#cod_estado_usuario_global').prop('checked',false); } 
if (cod_estado_dependencia_global=='1') { $('#cod_estado_dependencia_global').val('1'); $('#cod_estado_dependencia_global').prop('checked',true); } else { $('#cod_estado_dependencia_global').val('0'); $('#cod_estado_dependencia_global').prop('checked',false); } 
if (cod_estado_resolucion_factura_global=='1') { $('#cod_estado_resolucion_factura_global').val('1'); $('#cod_estado_resolucion_factura_global').prop('checked',true); } else { $('#cod_estado_resolucion_factura_global').val('0'); $('#cod_estado_resolucion_factura_global').prop('checked',false); } 
if (cod_estado_numero_letra_global=='1') { $('#cod_estado_numero_letra_global').val('1'); $('#cod_estado_numero_letra_global').prop('checked',true); } else { $('#cod_estado_numero_letra_global').val('0'); $('#cod_estado_numero_letra_global').prop('checked',false); } 
if (cod_estado_encuesta_experiencia_compra_global=='1') { $('#cod_estado_encuesta_experiencia_compra_global').val('1'); $('#cod_estado_encuesta_experiencia_compra_global').prop('checked',true); } else { $('#cod_estado_encuesta_experiencia_compra_global').val('0'); $('#cod_estado_encuesta_experiencia_compra_global').prop('checked',false); } 
if (cod_estado_codif_precio_compra_global=='1') { $('#cod_estado_codif_precio_compra_global').val('1'); $('#cod_estado_codif_precio_compra_global').prop('checked',true); } else { $('#cod_estado_codif_precio_compra_global').val('0'); $('#cod_estado_codif_precio_compra_global').prop('checked',false); } 
if (cod_estado_codif_precio_venta_global=='1') { $('#cod_estado_codif_precio_venta_global').val('1'); $('#cod_estado_codif_precio_venta_global').prop('checked',true); } else { $('#cod_estado_codif_precio_venta_global').val('0'); $('#cod_estado_codif_precio_venta_global').prop('checked',false); } 
if (cod_estado_img_impimir_factura_global=='1') { $('#cod_estado_img_impimir_factura_global').val('1'); $('#cod_estado_img_impimir_factura_global').prop('checked',true); } else { $('#cod_estado_img_impimir_factura_global').val('0'); $('#cod_estado_img_impimir_factura_global').prop('checked',false); } 
if (cod_estado_preventa_global=='1') { $('#cod_estado_preventa_global').val('1'); $('#cod_estado_preventa_global').prop('checked',true); } else { $('#cod_estado_preventa_global').val('0'); $('#cod_estado_preventa_global').prop('checked',false); } 
if (cod_estado_propina_global=='1') { $('#cod_estado_propina_global').val('1'); $('#cod_estado_propina_global').prop('checked',true); } else { $('#cod_estado_propina_global').val('0'); $('#cod_estado_propina_global').prop('checked',false); } 
if (cod_estado_inventario_bodega_global=='1') { $('#cod_estado_inventario_bodega_global').val('1'); $('#cod_estado_inventario_bodega_global').prop('checked',true); } else { $('#cod_estado_inventario_bodega_global').val('0'); $('#cod_estado_inventario_bodega_global').prop('checked',false); } 
if (cod_estado_modulo_contabilidad_global=='1') { $('#cod_estado_modulo_contabilidad_global').val('1'); $('#cod_estado_modulo_contabilidad_global').prop('checked',true); } else { $('#cod_estado_modulo_contabilidad_global').val('0'); $('#cod_estado_modulo_contabilidad_global').prop('checked',false); } 
if (cod_estado_modulo_cotizacion_global=='1') { $('#cod_estado_modulo_cotizacion_global').val('1'); $('#cod_estado_modulo_cotizacion_global').prop('checked',true); } else { $('#cod_estado_modulo_cotizacion_global').val('0'); $('#cod_estado_modulo_cotizacion_global').prop('checked',false); } 
if (cod_estado_compra_caja_global=='1') { $('#cod_estado_compra_caja_global').val('1'); $('#cod_estado_compra_caja_global').prop('checked',true); } else { $('#cod_estado_compra_caja_global').val('0'); $('#cod_estado_compra_caja_global').prop('checked',false); } 
if (cod_estado_sticker_barras_global=='1') { $('#cod_estado_sticker_barras_global').val('1'); $('#cod_estado_sticker_barras_global').prop('checked',true); } else { $('#cod_estado_sticker_barras_global').val('0'); $('#cod_estado_sticker_barras_global').prop('checked',false); } 
if (cod_estado_modulo_cotizacion_global=='1') { $('#cod_estado_modulo_cotizacion_global').val('1'); $('#cod_estado_modulo_cotizacion_global').prop('checked',true); } else { $('#cod_estado_modulo_cotizacion_global').val('0'); $('#cod_estado_modulo_cotizacion_global').prop('checked',false); } 
if (cod_estado_producto_consumo_global=='1') { $('#cod_estado_producto_consumo_global').val('1'); $('#cod_estado_producto_consumo_global').prop('checked',true); } else { $('#cod_estado_producto_consumo_global').val('0'); $('#cod_estado_producto_consumo_global').prop('checked',false); } 
if (cod_estado_compra_caja_global=='1') { $('#cod_estado_compra_caja_global').val('1'); $('#cod_estado_compra_caja_global').prop('checked',true); } else { $('#cod_estado_compra_caja_global').val('0'); $('#cod_estado_compra_caja_global').prop('checked',false); } 
if (cod_estado_cuenta_cobrar_global=='1') { $('#cod_estado_cuenta_cobrar_global').val('1'); $('#cod_estado_cuenta_cobrar_global').prop('checked',true); } else { $('#cod_estado_cuenta_cobrar_global').val('0'); $('#cod_estado_cuenta_cobrar_global').prop('checked',false); } 
if (cod_estado_cuenta_pagar_global=='1') { $('#cod_estado_cuenta_pagar_global').val('1'); $('#cod_estado_cuenta_pagar_global').prop('checked',true); } else { $('#cod_estado_cuenta_pagar_global').val('0'); $('#cod_estado_cuenta_pagar_global').prop('checked',false); } 
if (cod_estado_egreso_global=='1') { $('#cod_estado_egreso_global').val('1'); $('#cod_estado_egreso_global').prop('checked',true); } else { $('#cod_estado_egreso_global').val('0'); $('#cod_estado_egreso_global').prop('checked',false); } 
if (cod_estado_usuario_global=='1') { $('#cod_estado_usuario_global').val('1'); $('#cod_estado_usuario_global').prop('checked',true); } else { $('#cod_estado_usuario_global').val('0'); $('#cod_estado_usuario_global').prop('checked',false); } 
if (cod_estado_dependencia_global=='1') { $('#cod_estado_dependencia_global').val('1'); $('#cod_estado_dependencia_global').prop('checked',true); } else { $('#cod_estado_dependencia_global').val('0'); $('#cod_estado_dependencia_global').prop('checked',false); } 
if (cod_estado_numero_letra_global=='1') { $('#cod_estado_numero_letra_global').val('1'); $('#cod_estado_numero_letra_global').prop('checked',true); } else { $('#cod_estado_numero_letra_global').val('0'); $('#cod_estado_numero_letra_global').prop('checked',false); } 
if (cod_estado_resolucion_factura_global=='1') { $('#cod_estado_resolucion_factura_global').val('1'); $('#cod_estado_resolucion_factura_global').prop('checked',true); } else { $('#cod_estado_resolucion_factura_global').val('0'); $('#cod_estado_resolucion_factura_global').prop('checked',false); } 
if (cod_estado_cita_global=='1') { $('#cod_estado_cita_global').val('1'); $('#cod_estado_cita_global').prop('checked',true); } else { $('#cod_estado_cita_global').val('0'); $('#cod_estado_cita_global').prop('checked',false); } 
if (cod_estado_factura_compra_global=='1') { $('#cod_estado_factura_compra_global').val('1'); $('#cod_estado_factura_compra_global').prop('checked',true); } else { $('#cod_estado_factura_compra_global').val('0'); $('#cod_estado_factura_compra_global').prop('checked',false); } 
if (cod_estado_modulo_producto_global=='1') { $('#cod_estado_modulo_producto_global').val('1'); $('#cod_estado_modulo_producto_global').prop('checked',true); } else { $('#cod_estado_modulo_producto_global').val('0'); $('#cod_estado_modulo_producto_global').prop('checked',false); } 
if (cod_estado_modulo_facturacion_global=='1') { $('#cod_estado_modulo_facturacion_global').val('1'); $('#cod_estado_modulo_facturacion_global').prop('checked',true); } else { $('#cod_estado_modulo_facturacion_global').val('0'); $('#cod_estado_modulo_facturacion_global').prop('checked',false); } 
if (cod_estado_modulo_venta_global=='1') { $('#cod_estado_modulo_venta_global').val('1'); $('#cod_estado_modulo_venta_global').prop('checked',true); } else { $('#cod_estado_modulo_venta_global').val('0'); $('#cod_estado_modulo_venta_global').prop('checked',false); } 
if (cod_estado_modulo_tercero_global=='1') { $('#cod_estado_modulo_tercero_global').val('1'); $('#cod_estado_modulo_tercero_global').prop('checked',true); } else { $('#cod_estado_modulo_tercero_global').val('0'); $('#cod_estado_modulo_tercero_global').prop('checked',false); } 
if (cod_estado_modulo_cuenta_global=='1') { $('#cod_estado_modulo_cuenta_global').val('1'); $('#cod_estado_modulo_cuenta_global').prop('checked',true); } else { $('#cod_estado_modulo_cuenta_global').val('0'); $('#cod_estado_modulo_cuenta_global').prop('checked',false); } 
if (cod_estado_modulo_reporte_global=='1') { $('#cod_estado_modulo_reporte_global').val('1'); $('#cod_estado_modulo_reporte_global').prop('checked',true); } else { $('#cod_estado_modulo_reporte_global').val('0'); $('#cod_estado_modulo_reporte_global').prop('checked',false); } 
if (cod_estado_modulo_admin_global=='1') { $('#cod_estado_modulo_admin_global').val('1'); $('#cod_estado_modulo_admin_global').prop('checked',true); } else { $('#cod_estado_modulo_admin_global').val('0'); $('#cod_estado_modulo_admin_global').prop('checked',false); } 
if (cod_estado_pyg_global=='1') { $('#cod_estado_pyg_global').val('1'); $('#cod_estado_pyg_global').prop('checked',true); } else { $('#cod_estado_pyg_global').val('0'); $('#AAAA').prop('checked',false); } 
if (cod_estado_balance_global=='1') { $('#cod_estado_balance_global').val('1'); $('#cod_estado_balance_global').prop('checked',true); } else { $('#cod_estado_balance_global').val('0'); $('#cod_estado_balance_global').prop('checked',false); } 
if (cod_estado_ganancia_ptj_global=='1') { $('#cod_estado_ganancia_ptj_global').val('1'); $('#cod_estado_ganancia_ptj_global').prop('checked',true); } else { $('#cod_estado_ganancia_ptj_global').val('0'); $('#cod_estado_ganancia_ptj_global').prop('checked',false); } 
if (cod_estado_modulo_orden_produccion_global=='1') { $('#cod_estado_modulo_orden_produccion_global').val('1'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',true); } else { $('#cod_estado_modulo_orden_produccion_global').val('0'); $('#cod_estado_modulo_orden_produccion_global').prop('checked',false); } 
if (cod_estado_comentario_venta_global=='1') { $('#cod_estado_comentario_venta_global').val('1'); $('#cod_estado_comentario_venta_global').prop('checked',true); } else { $('#cod_estado_comentario_venta_global').val('0'); $('#cod_estado_comentario_venta_global').prop('checked',false); } 
if (cod_estado_envio_sms_global=='1') { $('#cod_estado_envio_sms_global').val('1'); $('#cod_estado_envio_sms_global').prop('checked',true); } else { $('#cod_estado_envio_sms_global').val('0'); $('#cod_estado_envio_sms_global').prop('checked',false); } 
if (cod_estado_envio_correo_global=='1') { $('#cod_estado_envio_correo_global').val('1'); $('#cod_estado_envio_correo_global').prop('checked',true); } else { $('#cod_estado_envio_correo_global').val('0'); $('#cod_estado_envio_correo_global').prop('checked',false); } 
if (cod_estado_ordenamiento_alfabetico_venta_global=='1') { $('#cod_estado_ordenamiento_alfabetico_venta_global').val('1'); $('#cod_estado_ordenamiento_alfabetico_venta_global').prop('checked',true); } else { $('#cod_estado_ordenamiento_alfabetico_venta_global').val('0'); $('#cod_estado_ordenamiento_alfabetico_venta_global').prop('checked',false); } 
if (cod_estado_nocodif_precio_compra_sticker_global=='1') { $('#cod_estado_nocodif_precio_compra_sticker_global').val('1'); $('#cod_estado_nocodif_precio_compra_sticker_global').prop('checked',true); } else { $('#cod_estado_nocodif_precio_compra_sticker_global').val('0'); $('#cod_estado_nocodif_precio_compra_sticker_global').prop('checked',false); } 
if (cod_estado_nocodif_precio_venta_sticker_global=='1') { $('#cod_estado_nocodif_precio_venta_sticker_global').val('1'); $('#cod_estado_nocodif_precio_venta_sticker_global').prop('checked',true); } else { $('#cod_estado_nocodif_precio_venta_sticker_global').val('0'); $('#cod_estado_nocodif_precio_venta_sticker_global').prop('checked',false); } 
if (cod_estado_nombre_empresa_sticker_global=='1') { $('#cod_estado_nombre_empresa_sticker_global').val('1'); $('#cod_estado_nombre_empresa_sticker_global').prop('checked',true); } else { $('#cod_estado_nombre_empresa_sticker_global').val('0'); $('#cod_estado_nombre_empresa_sticker_global').prop('checked',false); } 
if (cod_estado_fecha_compra_sticker_global=='1') { $('#cod_estado_fecha_compra_sticker_global').val('1'); $('#cod_estado_fecha_compra_sticker_global').prop('checked',true); } else { $('#cod_estado_fecha_compra_sticker_global').val('0'); $('#cod_estado_fecha_compra_sticker_global').prop('checked',false); } 
if (cod_estado_cod_tercero_sticker_global=='1') { $('#cod_estado_cod_tercero_sticker_global').val('1'); $('#cod_estado_cod_tercero_sticker_global').prop('checked',true); } else { $('#cod_estado_cod_tercero_sticker_global').val('0'); $('#cod_estado_cod_tercero_sticker_global').prop('checked',false); } 
if (cod_estado_url_pagina_sticker_global=='1') { $('#cod_estado_url_pagina_sticker_global').val('1'); $('#cod_estado_url_pagina_sticker_global').prop('checked',true); } else { $('#cod_estado_url_pagina_sticker_global').val('0'); $('#cod_estado_url_pagina_sticker_global').prop('checked',false); } 
if (cod_estado_nombre_desarrollador_sticker_global=='1') { $('#cod_estado_nombre_desarrollador_sticker_global').val('1'); $('#cod_estado_nombre_desarrollador_sticker_global').prop('checked',true); } else { $('#cod_estado_nombre_desarrollador_sticker_global').val('0'); $('#cod_estado_nombre_desarrollador_sticker_global').prop('checked',false); } 
if (cod_estado_qr_sticker_global=='1') { $('#cod_estado_qr_sticker_global').val('1'); $('#cod_estado_qr_sticker_global').prop('checked',true); } else { $('#cod_estado_qr_sticker_global').val('0'); $('#cod_estado_qr_sticker_global').prop('checked',false); } 
if (cod_estado_habilitar_tercero_por_usuario_global=='1') { $('#cod_estado_habilitar_tercero_por_usuario_global').val('1'); $('#cod_estado_habilitar_tercero_por_usuario_global').prop('checked',true); } else { $('#cod_estado_habilitar_tercero_por_usuario_global').val('0'); $('#cod_estado_habilitar_tercero_por_usuario_global').prop('checked',false); } 
if (cod_estado_subproducto_global=='1') { $('#cod_estado_subproducto_global').val('1'); $('#cod_estado_subproducto_global').prop('checked',true); } else { $('#cod_estado_subproducto_global').val('0'); $('#cod_estado_subproducto_global').prop('checked',false); } 
if (cod_estado_nuevo_inventario_global=='1') { $('#cod_estado_nuevo_inventario_global').val('1'); $('#cod_estado_nuevo_inventario_global').prop('checked',true); } else { $('#cod_estado_nuevo_inventario_global').val('0'); $('#cod_estado_nuevo_inventario_global').prop('checked',false); } 
if (cod_estado_auditoria_global=='1') { $('#cod_estado_auditoria_global').val('1'); $('#cod_estado_auditoria_global').prop('checked',true); } else { $('#cod_estado_auditoria_global').val('0'); $('#cod_estado_auditoria_global').prop('checked',false); } 
if (cod_estado_cierre_caja_global=='1') { $('#cod_estado_cierre_caja_global').val('1'); $('#cod_estado_cierre_caja_global').prop('checked',true); } else { $('#cod_estado_cierre_caja_global').val('0'); $('#cod_estado_cierre_caja_global').prop('checked',false); } 


$("#cod_estado_modulo_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_producto_global").val("1"); } else { $("#cod_estado_modulo_producto_global").val("0"); } });
$("#cod_estado_modulo_facturacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_facturacion_global").val("1"); } else { $("#cod_estado_modulo_facturacion_global").val("0"); } });
$("#cod_estado_modulo_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_venta_global").val("1"); } else { $("#cod_estado_modulo_venta_global").val("0"); } });
$("#cod_estado_modulo_tercero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_tercero_global").val("1"); } else { $("#cod_estado_modulo_tercero_global").val("0"); } });
$("#cod_estado_modulo_cuenta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_global").val("1"); } else { $("#cod_estado_modulo_cuenta_global").val("0"); } });
$("#cod_estado_modulo_reporte_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_reporte_global").val("1"); } else { $("#cod_estado_modulo_reporte_global").val("0"); } });
$("#cod_estado_modulo_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_admin_global").val("1"); } else { $("#cod_estado_modulo_admin_global").val("0"); } });
$("#cod_estado_mov_contable_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_mov_contable_global").val("1"); } else { $("#cod_estado_mov_contable_global").val("0"); } });
$("#cod_estado_pyg_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_pyg_global").val("1"); } else { $("#cod_estado_pyg_global").val("0"); } });
$("#cod_estado_balance_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_balance_global").val("1"); } else { $("#cod_estado_balance_global").val("0"); } });
$("#cod_estado_ganancia_ptj_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ganancia_ptj_global").val("1"); } else { $("#cod_estado_ganancia_ptj_global").val("0"); } });
$("#cod_estado_modulo_orden_produccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_orden_produccion_global").val("1"); } else { $("#cod_estado_modulo_orden_produccion_global").val("0"); } });
$("#cod_estado_comentario_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_comentario_venta_global").val("1"); } else { $("#cod_estado_comentario_venta_global").val("0"); } });
$("#cod_estado_envio_sms_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_sms_global").val("1"); } else { $("#cod_estado_envio_sms_global").val("0"); } });
$("#cod_estado_envio_correo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_correo_global").val("1"); } else { $("#cod_estado_envio_correo_global").val("0"); } });
$("#cod_estado_fecha_vencimiento_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_vencimiento_global").val("1"); } else { $("#cod_estado_fecha_vencimiento_global").val("0"); } });
$("#cod_estado_ptj_comision_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ptj_comision_global").val("1"); } else { $("#cod_estado_ptj_comision_global").val("0"); } });
$("#cod_estado_impoconsumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_impoconsumo_global").val("1"); } else { $("#cod_estado_impoconsumo_global").val("0"); } });
$("#cod_estado_dto1_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dto1_global").val("1"); } else { $("#cod_estado_dto1_global").val("0"); } });
$("#cod_estado_dto2_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dto2_global").val("1"); } else { $("#cod_estado_dto2_global").val("0"); } });
$("#cod_estado_producto_consumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_consumo_global").val("1"); } else { $("#cod_estado_producto_consumo_global").val("0"); } });
$("#cod_estado_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_cuenta_pagar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_pagar_global").val("1"); } else { $("#cod_estado_cuenta_pagar_global").val("0"); } });
$("#cod_estado_egreso_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_egreso_global").val("1"); } else { $("#cod_estado_egreso_global").val("0"); } });
$("#cod_estado_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_global").val("1"); } else { $("#cod_estado_factura_compra_global").val("0"); } });
$("#cod_estado_cita_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cita_global").val("1"); } else { $("#cod_estado_cita_global").val("0"); } });
$("#cod_estado_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_usuario_global").val("1"); } else { $("#cod_estado_usuario_global").val("0"); } });
$("#cod_estado_dependencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dependencia_global").val("1"); } else { $("#cod_estado_dependencia_global").val("0"); } });
$("#cod_estado_resolucion_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_resolucion_factura_global").val("1"); } else { $("#cod_estado_resolucion_factura_global").val("0"); } });
$("#cod_estado_numero_letra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_numero_letra_global").val("1"); } else { $("#cod_estado_numero_letra_global").val("0"); } });
$("#cod_estado_encuesta_experiencia_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_encuesta_experiencia_compra_global").val("1"); } else { $("#cod_estado_encuesta_experiencia_compra_global").val("0"); } });
$("#cod_estado_codif_precio_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_codif_precio_compra_global").val("1"); } else { $("#cod_estado_codif_precio_compra_global").val("0"); } });
$("#cod_estado_codif_precio_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_codif_precio_venta_global").val("1"); } else { $("#cod_estado_codif_precio_venta_global").val("0"); } });
$("#cod_estado_img_impimir_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_img_impimir_factura_global").val("1"); } else { $("#cod_estado_img_impimir_factura_global").val("0"); } });
$("#cod_estado_preventa_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_preventa_global").val("1"); } else { $("#cod_estado_preventa_global").val("0"); } });
$("#cod_estado_propina_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_propina_global").val("1"); } else { $("#cod_estado_propina_global").val("0"); } });
$("#cod_estado_inventario_bodega_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_inventario_bodega_global").val("1"); } else { $("#cod_estado_inventario_bodega_global").val("0"); } });
$("#cod_estado_modulo_contabilidad_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_contabilidad_global").val("1"); } else { $("#cod_estado_modulo_contabilidad_global").val("0"); } });
$("#cod_estado_modulo_cotizacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cotizacion_global").val("1"); } else { $("#cod_estado_modulo_cotizacion_global").val("0"); } });
$("#cod_estado_compra_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_compra_caja_global").val("1"); } else { $("#cod_estado_compra_caja_global").val("0"); } });
$("#cod_estado_sticker_barras_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_sticker_barras_global").val("1"); } else { $("#cod_estado_sticker_barras_global").val("0"); } });
$("#cod_estado_modulo_cotizacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cotizacion_global").val("1"); } else { $("#cod_estado_modulo_cotizacion_global").val("0"); } });
$("#cod_estado_producto_consumo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_producto_consumo_global").val("1"); } else { $("#cod_estado_producto_consumo_global").val("0"); } });
$("#cod_estado_compra_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_compra_caja_global").val("1"); } else { $("#cod_estado_compra_caja_global").val("0"); } });
$("#cod_estado_cuenta_cobrar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_cobrar_global").val("1"); } else { $("#cod_estado_cuenta_cobrar_global").val("0"); } });
$("#cod_estado_cuenta_pagar_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cuenta_pagar_global").val("1"); } else { $("#cod_estado_cuenta_pagar_global").val("0"); } });
$("#cod_estado_egreso_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_egreso_global").val("1"); } else { $("#cod_estado_egreso_global").val("0"); } });
$("#cod_estado_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_usuario_global").val("1"); } else { $("#cod_estado_usuario_global").val("0"); } });
$("#cod_estado_dependencia_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_dependencia_global").val("1"); } else { $("#cod_estado_dependencia_global").val("0"); } });
$("#cod_estado_numero_letra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_numero_letra_global").val("1"); } else { $("#cod_estado_numero_letra_global").val("0"); } });
$("#cod_estado_resolucion_factura_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_resolucion_factura_global").val("1"); } else { $("#cod_estado_resolucion_factura_global").val("0"); } });
$("#cod_estado_cita_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cita_global").val("1"); } else { $("#cod_estado_cita_global").val("0"); } });
$("#cod_estado_factura_compra_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_factura_compra_global").val("1"); } else { $("#cod_estado_factura_compra_global").val("0"); } });
$("#cod_estado_modulo_producto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_producto_global").val("1"); } else { $("#cod_estado_modulo_producto_global").val("0"); } });
$("#cod_estado_modulo_facturacion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_facturacion_global").val("1"); } else { $("#cod_estado_modulo_facturacion_global").val("0"); } });
$("#cod_estado_modulo_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_venta_global").val("1"); } else { $("#cod_estado_modulo_venta_global").val("0"); } });
$("#cod_estado_modulo_tercero_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_tercero_global").val("1"); } else { $("#cod_estado_modulo_tercero_global").val("0"); } });
$("#cod_estado_modulo_cuenta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_cuenta_global").val("1"); } else { $("#cod_estado_modulo_cuenta_global").val("0"); } });
$("#cod_estado_modulo_reporte_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_reporte_global").val("1"); } else { $("#cod_estado_modulo_reporte_global").val("0"); } });
$("#cod_estado_modulo_admin_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_admin_global").val("1"); } else { $("#cod_estado_modulo_admin_global").val("0"); } });
$("#cod_estado_pyg_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_pyg_global").val("1"); } else { $("#cod_estado_pyg_global").val("0"); } });
$("#cod_estado_balance_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_balance_global").val("1"); } else { $("#cod_estado_balance_global").val("0"); } });
$("#cod_estado_ganancia_ptj_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ganancia_ptj_global").val("1"); } else { $("#cod_estado_ganancia_ptj_global").val("0"); } });
$("#cod_estado_modulo_orden_produccion_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_modulo_orden_produccion_global").val("1"); } else { $("#cod_estado_modulo_orden_produccion_global").val("0"); } });
$("#cod_estado_comentario_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_comentario_venta_global").val("1"); } else { $("#cod_estado_comentario_venta_global").val("0"); } });
$("#cod_estado_envio_sms_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_sms_global").val("1"); } else { $("#cod_estado_envio_sms_global").val("0"); } });
$("#cod_estado_envio_correo_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_envio_correo_global").val("1"); } else { $("#cod_estado_envio_correo_global").val("0"); } });
$("#cod_estado_ordenamiento_alfabetico_venta_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_ordenamiento_alfabetico_venta_global").val("1"); } else { $("#cod_estado_ordenamiento_alfabetico_venta_global").val("0"); } });
$("#cod_estado_nocodif_precio_compra_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nocodif_precio_compra_sticker_global").val("1"); } else { $("#cod_estado_nocodif_precio_compra_sticker_global").val("0"); } });
$("#cod_estado_nocodif_precio_venta_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nocodif_precio_venta_sticker_global").val("1"); } else { $("#cod_estado_nocodif_precio_venta_sticker_global").val("0"); } });
$("#cod_estado_nombre_empresa_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nombre_empresa_sticker_global").val("1"); } else { $("#cod_estado_nombre_empresa_sticker_global").val("0"); } });
$("#cod_estado_fecha_compra_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_fecha_compra_sticker_global").val("1"); } else { $("#cod_estado_fecha_compra_sticker_global").val("0"); } });
$("#cod_estado_cod_tercero_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cod_tercero_sticker_global").val("1"); } else { $("#cod_estado_cod_tercero_sticker_global").val("0"); } });
$("#cod_estado_url_pagina_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_url_pagina_sticker_global").val("1"); } else { $("#cod_estado_url_pagina_sticker_global").val("0"); } });
$("#cod_estado_nombre_desarrollador_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nombre_desarrollador_sticker_global").val("1"); } else { $("#cod_estado_nombre_desarrollador_sticker_global").val("0"); } });
$("#cod_estado_qr_sticker_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_qr_sticker_global").val("1"); } else { $("#cod_estado_qr_sticker_global").val("0"); } });
$("#cod_estado_habilitar_tercero_por_usuario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_habilitar_tercero_por_usuario_global").val("1"); } else { $("#cod_estado_habilitar_tercero_por_usuario_global").val("0"); } });
$("#cod_estado_subproducto_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_subproducto_global").val("1"); } else { $("#cod_estado_subproducto_global").val("0"); } });
$("#cod_estado_nuevo_inventario_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_nuevo_inventario_global").val("1"); } else { $("#cod_estado_nuevo_inventario_global").val("0"); } });
$("#cod_estado_auditoria_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_auditoria_global").val("1"); } else { $("#cod_estado_auditoria_global").val("0"); } });
$("#cod_estado_cierre_caja_global").change(function(){ if( $(this).is(':checked') ){ $("#cod_estado_cierre_caja_global").val("1"); } else { $("#cod_estado_cierre_caja_global").val("0"); } });
});
</script>