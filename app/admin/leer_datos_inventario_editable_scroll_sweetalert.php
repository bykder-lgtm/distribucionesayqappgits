<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

if (isset($_REQUEST["cantidad_reg_por_pagina"])) { $cantidad_reg_por_pagina = intval($_REQUEST['cantidad_reg_por_pagina']); } else { $cantidad_reg_por_pagina = '50'; }
if (isset($_REQUEST["paginador_actual"])) { $paginador_actual = intval($_REQUEST['paginador_actual']); } else { $paginador_actual = '1'; }
if (isset($_REQUEST["buscar_por"])) { $buscar_por = addslashes($_REQUEST['buscar_por']); } else { $buscar_por = ''; }
if (isset($_REQUEST["busqueda"])) { $busqueda = addslashes($_REQUEST['busqueda']); } else { $busqueda = ''; }
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);
$cod_seguridad           = ($_SESSION['cod_seguridad']);
$cod_caja_virtual        = ($_SESSION['cod_caja_virtual']);
$token                   = ($_SESSION['token']);

include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT cod_estado_ptj_comision_global, cod_estado_fecha_vencimiento_global, cod_estado_cod_barra2_global, cod_estado_caja_fraccion_global, cod_estado_marca_global, 
cod_estado_cajas_sobre_global, cod_estado_und_sobre_global, cod_estado_iva_saludable_ptj_global, cod_estado_fecha_mantenimiento_global, cod_estado_meses_garantia_global, 
cod_estado_factura_compra_producto_global, cod_estado_producto_serial_global, cod_estado_peso_producto_global, cod_estado_opcion_descontable_inv_global, 
cod_estado_categoria_global, cod_estado_peso_global, cod_estado_origen_produccion_global, cod_estado_producto_de_cocina_global, cod_estado_dependencia_sub_global, 
cod_tipo_sistema_numeracion_und_compra, cod_tipo_sistema_numeracion_precio_compra, cod_tipo_sistema_numeracion_precio_venta, nombre_tipo_componente, cod_estado_provee_fechacompra_inv_masivo_global 
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_ptj_comision_global                                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_fecha_vencimiento_global                               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_cod_barra2_global                                      = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_caja_fraccion_global                                   = $info_empresa_data['cod_estado_caja_fraccion_global'];
$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_cajas_sobre_global                                     = $info_empresa_data['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                       = $info_empresa_data['cod_estado_und_sobre_global'];
$cod_estado_iva_saludable_ptj_global                               = $info_empresa_data['cod_estado_iva_saludable_ptj_global'];
$cod_estado_fecha_mantenimiento_global                             = $info_empresa_data['cod_estado_fecha_mantenimiento_global'];
$cod_estado_meses_garantia_global                                  = $info_empresa_data['cod_estado_meses_garantia_global'];
$cod_estado_factura_compra_producto_global                         = $info_empresa_data['cod_estado_factura_compra_producto_global'];
$cod_estado_producto_serial_global                                 = $info_empresa_data['cod_estado_producto_serial_global'];
$cod_estado_peso_producto_global                                   = $info_empresa_data['cod_estado_peso_producto_global'];
$cod_estado_opcion_descontable_inv_global                          = $info_empresa_data['cod_estado_opcion_descontable_inv_global'];
$cod_estado_categoria_global                                       = $info_empresa_data['cod_estado_categoria_global'];
$cod_estado_peso_global                                            = $info_empresa_data['cod_estado_peso_global'];
$cod_estado_origen_produccion_global                               = $info_empresa_data['cod_estado_origen_produccion_global'];
$cod_estado_producto_de_cocina_global                              = $info_empresa_data['cod_estado_producto_de_cocina_global'];
$cod_estado_dependencia_sub_global                                 = $info_empresa_data['cod_estado_dependencia_sub_global'];
$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];
$nombre_tipo_componente                                            = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_provee_fechacompra_inv_masivo_global                   = $info_empresa_data['cod_estado_provee_fechacompra_inv_masivo_global'];
$registro_inicio                                                   = ($paginador_actual - 1) * $cantidad_reg_por_pagina;
$seleccionado                                                      = 0;

if (isset($_REQUEST['busqueda'])) { 
    if ($busqueda <> '') { 
        if ($buscar_por == 'nombre_producto') {
        	$mostrar_datos_sql = "WHERE (nombre_producto LIKE '$busqueda%')";
        } elseif ($buscar_por == 'cod_producto_barra') {
        	$mostrar_datos_sql = "WHERE (cod_producto_barra LIKE '$busqueda')";
        } elseif ($buscar_por == 'cod_producto_barra_nombre_producto') {
        	$mostrar_datos_sql = "WHERE (nombre_producto LIKE '$busqueda%') OR (cod_producto_barra LIKE '$busqueda')";
        } else {
        	$mostrar_datos_sql = "WHERE (nombre_producto LIKE '%$busqueda%') OR (cod_producto_barra LIKE '$busqueda')";
        }

        $filtro_cod_barra_nombre_producto = $mostrar_datos_sql; 
    } else { 
        $filtro_cod_barra_nombre_producto = "";  
    }
} else { 
    $busqueda = ''; 
    $filtro_cod_barra_nombre_producto = ""; 
}
?>
<table class="table table-striped">
<thead>
	<tr>
		<!--<th style="text-align:center">Elm</th>-->
		<th style="text-align:center">COD PRODUCTO</th>

		<?php if ($cod_estado_cod_barra2_global == '1') { ?>
		<th style="text-align:center">CODIGO BARRA 2</th>
		<?php } ?>

		<th style="text-align:center">NOMBRE PRODUCTO</th>

		<?php if ($cod_estado_prod_und_producto == '1') { ?>
		<th style="text-align:center">T.UND</th>
		<?php } ?>

		<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
		<th style="text-align:center">CAJ|FRAC</th>
		<?php } ?>

		<?php if ($cod_estado_prod_und_producto_bodega == '1') { ?>
		<th style="text-align:center">T.UND BODEGA</th>
		<?php } ?>

		<?php if ($cod_estado_marca_global == '1') { ?>
		<th style="text-align:center">MARCA</th>
		<?php } ?>

		<th style="text-align:center">MEDIDA</th>

		<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
		<th style="text-align:center">P.COMPRA</th>
		<?php } ?>

		<th style="text-align:center">T.P</th>

		<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
		<?php for ($i=1; $i <= $numero_precio_user; $i++) { $contador = 1; if ($i==1) { $contador = ""; } else { $contador = $i; } ?>
		<th style="text-align:center">P.VENTA<?php echo $contador; ?></th>
		<?php } ?>
		<?php } ?>

		<?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
		<th style="text-align:center;">CAJA (PRESENTACION)</th>
		<?php } ?>

		<?php if ($cod_estado_und_sobre_global  == '1') { ?>
		<th style="text-align:center;">SOBRE</th>
		<?php } ?>

		<th style="text-align:center">IVA</th>

		<?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
		<th style="text-align:center">IVA SALUDABLE</th>
		<?php } ?>

		<?php if ($cod_estado_ptj_comision_global == '1') { ?>
		<th style="text-align:center">COMISION</th>
		<?php } ?>

		<?php if ($cod_estado_prod_tope_min == '1') { ?>
		<th style="text-align:center">STOCK</th>
		<?php } ?>

		<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
		<th style="text-align:center">F.VENCIMIENTO</th>
		<th style="text-align:center">LOTE</th>
		<?php } ?>

		<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
		<th style="text-align:center">FECHA MANTENIMIENTO</th>
		<th style="text-align:center">MANTENIMIENTO MESES</th>
		<?php } ?>

		<?php if ($cod_estado_meses_garantia_global  == '1') { ?>
		<th style="text-align:center;">GARANTIA MESES</th>
		<?php } ?>

		<?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
		<th style="text-align:center">FACTURA</th>
		<?php } ?>

		<?php if ($cod_estado_producto_serial_global == '1') { ?>
		<th style="text-align:center">SERIAL PRODUCTO</th>
		<?php } ?>

		<th style="text-align:center">TIPO PRODUCTO</th>

		<?php if ($cod_estado_peso_producto_global == '1') { ?>
		<th style="text-align:center">PESO (KG)</th>
		<?php } ?>

		<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
		<th style="text-align:center">DESCONTABLE</th>
		<?php } ?>

		<?php if ($cod_estado_categoria_global == '1') { ?>
		<th style="text-align:center">CATEGORIA</th>
		<?php } ?>

		<?php if ($cod_estado_peso_global == '1') { ?>
		<th style="text-align:center">PESAR?</th>
		<?php } ?>

		<?php if ($cod_estado_origen_produccion_global == '1') { ?>
		<th style="text-align:center">ORIGEN</th>
		<?php } ?>

		<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
		<th style="text-align:center">IMPRIMIR EN COCINA</th>
		<?php } ?>

		<th style="text-align:center">DEPENDENCIA</th>

		<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
		<th style="text-align:center">SUB DEPENDENCIA - SEDE</th>
		<?php } ?>

		<?php if ($cod_estado_provee_fechacompra_inv_masivo_global == '1') { ?>
		<th style="text-align:center">PROVEEDOR</th>
		<th style="text-align:center">FECHA COMPRA</th>
		<?php } ?>
	</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT cod_producto, cod_producto_barra, cod_producto_barra2, nombre_producto, und_producto, precio_compra_producto, precio_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
cod_dependencia, iva_ptj, nombre_tipo_producto, comision_ptj, fecha_vencimiento, fecha_vencimiento1, lote_vencimiento, 
vencimiento_lote1, nombre_tipo_precio_venta, und_producto_bodega, nombre_tipo_unidad_medida, fecha_mantenimiento, cajas_sobre, 
und_sobre, cod_opcion_descontable_inv, cod_categoria, cod_tipo_producto_cocina, peso_producto, unidad_medida_peso, cod_estado_peso, 
cod_dependencia_sub, cod_factura, meses_mantenimiento, meses_garantia, cod_producto_serial, cod_marca, iva_saludable_ptj, tope_min, cod_origen_produccion, cod_tercero, cod_info_factura_compra
FROM tbl15_producto $filtro_cod_barra_nombre_producto 
ORDER BY nombre_producto DESC LIMIT $registro_inicio, $cantidad_reg_por_pagina";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

	$cod_producto                   = $info_info_factura['cod_producto'];
	$cod_producto_barra             = $info_info_factura['cod_producto_barra'];
	$cod_producto_barra2            = $info_info_factura['cod_producto_barra2'];
	$nombre_producto                = $info_info_factura['nombre_producto'];
	$und_producto                   = $info_info_factura['und_producto'];
	$precio_compra_producto         = $info_info_factura['precio_compra_producto'];
	$precio_costo_producto          = $info_info_factura['precio_costo_producto'];
	$precio_venta_producto          = $info_info_factura['precio_venta_producto'];
	$precio_venta_producto2         = $info_info_factura['precio_venta_producto2'];
	$precio_venta_producto3         = $info_info_factura['precio_venta_producto3'];
	$precio_venta_producto4         = $info_info_factura['precio_venta_producto4'];
	$precio_venta_producto5         = $info_info_factura['precio_venta_producto5'];
	if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto = intval($und_producto); } else { $und_producto = $und_producto; }
	if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
	if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
	$cod_dependencia                = $info_info_factura['cod_dependencia'];
	$iva_ptj                        = $info_info_factura['iva_ptj'];
	$nombre_tipo_producto           = $info_info_factura['nombre_tipo_producto'];
	$comision_ptj                   = $info_info_factura['comision_ptj'];
	$fecha_vencimiento              = $info_info_factura['fecha_vencimiento'];
	$fecha_vencimiento1             = $info_info_factura['fecha_vencimiento1'];
	$lote_vencimiento               = $info_info_factura['lote_vencimiento'];
	$vencimiento_lote1              = $info_info_factura['vencimiento_lote1'];
	$nombre_tipo_precio_venta       = $info_info_factura['nombre_tipo_precio_venta'];
	$und_producto_bodega            = $info_info_factura['und_producto_bodega'];
	$nombre_tipo_unidad_medida      = $info_info_factura['nombre_tipo_unidad_medida'];
	$fecha_mantenimiento            = $info_info_factura['fecha_mantenimiento'];
	$cajas_sobre                    = $info_info_factura['cajas_sobre'];
	$und_sobre                      = $info_info_factura['und_sobre'];
	$cod_opcion_descontable_inv     = $info_info_factura['cod_opcion_descontable_inv'];
	$cod_categoria                  = $info_info_factura['cod_categoria'];
	$cod_tipo_producto_cocina       = $info_info_factura['cod_tipo_producto_cocina'];
	$peso_producto                  = $info_info_factura['peso_producto'];
	$unidad_medida_peso             = $info_info_factura['unidad_medida_peso'];
	$cod_estado_peso                = $info_info_factura['cod_estado_peso'];
	$cod_dependencia_sub            = $info_info_factura['cod_dependencia_sub'];
	$cod_factura                    = $info_info_factura['cod_factura'];
	$meses_mantenimiento            = $info_info_factura['meses_mantenimiento'];
	$meses_garantia                 = $info_info_factura['meses_garantia'];
	$cod_producto_serial            = $info_info_factura['cod_producto_serial'];
	$cod_marca                      = $info_info_factura['cod_marca'];
	$iva_saludable_ptj              = $info_info_factura['iva_saludable_ptj'];
	$tope_min                       = $info_info_factura['tope_min'];
	$cod_origen_produccion          = $info_info_factura['cod_origen_produccion'];
	$cod_tercero                    = $info_info_factura['cod_tercero'];
	$cod_info_factura_compra        = $info_info_factura['cod_info_factura_compra'];

	$sql_info_factura_compra = "SELECT fecha_anyo FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
	$resultado_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
	$info_info_factura_compra = mysqli_fetch_assoc($resultado_info_factura_compra);

	$fecha_anyo                            = $info_info_factura_compra['fecha_anyo']; 

	$sql_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_tercero = mysqli_query($conectar, $sql_tercero);
	$info_tercero = mysqli_fetch_assoc($resultado_tercero);

	$nombre1_tercero                            = $info_tercero['nombre1_tercero']; 

	if ($cajas_sobre > '1') {
	    $total_cajas                    = intval($und_producto / $cajas_sobre);
	    $total_fraccion                 = $und_producto - ($total_cajas * $cajas_sobre);
	    $total_caja_fraccion            = $total_cajas.'|'.$total_fraccion;
	} else {
	    $total_cajas                    = '';
	    $total_fraccion                 = '';
	    $total_caja_fraccion            = '';
	}
?>
<tr>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_barra', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_barra;?>" class="input-block-level" style="width: 130px;"></td>

<?php if ($cod_estado_cod_barra2_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_barra2', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_barra2;?>" class="input-block-level" style="width: 130px;"></td>
<?php } ?>

<td style="text-align:center">
<?php if ($nombre_tipo_componente == 'TEXTAREA') { ?>
<textarea onFocus="Focus(this.id, this.value)" name="nombre_producto" onBlur="Blur(this.id, this.value, 'nombre_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" class="input-block-level" rows="9" cols="50"><?php echo $nombre_producto;?></textarea>
<?php } else { ?><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'nombre_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $nombre_producto;?>" class="input-block-level" style="width: 500px;"><?php } ?>
</td>

<?php if ($cod_estado_prod_und_producto == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_producto;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_caja_fraccion_global == '1') { ?>
<td style="text-align:center"><?php echo $total_caja_fraccion;?></td>
<?php } ?>

<?php if ($cod_estado_prod_und_producto_bodega == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_producto_bodega', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_producto_bodega;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_marca_global == '1') { ?>
<td style="text-align:center">
<select name="cod_marca" id="cod_marca-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_marca)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_marca, nombre_marca FROM tbl15_marca ORDER BY cod_marca ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_marca) and $cod_marca == $datos2['cod_marca']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_marca'];
$nombre = $datos2['nombre_marca'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>
<?php } ?>


<td align="center">
<select name="nombre_tipo_unidad_medida" id="nombre_tipo_unidad_medida-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 70px;">
<?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT nombre_tipo_unidad_medida FROM tbl15_tipo_unidad_medida WHERE (cod_estado = '1') ORDER BY cod_tipo_unidad_medida ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_unidad_medida) and $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_unidad_medida'];
$nombre = $datos2['nombre_tipo_unidad_medida'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_prod_precio_compra_producto == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'precio_compra_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $precio_compra_producto;?>" class="input-block-level" style="width: 100px;"></td>
<?php } ?>

<td align="center">
<select name="nombre_tipo_precio_venta" id="nombre_tipo_precio_venta-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 70px;">
<?php if (isset($nombre_tipo_precio_venta)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT nombre_tipo_precio_venta FROM tbl15_tipo_precio_venta ORDER BY nombre_tipo_precio_venta ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_precio_venta) and $nombre_tipo_precio_venta == $datos2['nombre_tipo_precio_venta']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_precio_venta'];
$nombre = $datos2['nombre_tipo_precio_venta'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_prod_precio_venta_producto == '1') { ?>
<?php for ($i=1; $i <= $numero_precio_user; $i++) { $contador = 1; $precio_ventas = 0; 
if ($i==1) { $contador = ""; $precio_ventas = $precio_venta_producto; } elseif ($i==2) { $contador = $i; $precio_ventas = $precio_venta_producto2; } elseif ($i==3) { $contador = $i; $precio_ventas = $precio_venta_producto3;
} elseif ($i==4) { $contador = $i; $precio_ventas = $precio_venta_producto4; } elseif ($i==5) { $contador = $i; $precio_ventas = $precio_venta_producto5; } else { $contador = ""; $precio_ventas = $precio_venta_producto; } ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'precio_venta_producto<?php echo $contador; ?>', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo "$precio_ventas"; ?>" class="input-block-level" style="width: 100px;"></td>
<?php } ?>
<?php } ?>

<?php if ($cod_estado_cajas_sobre_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cajas_sobre', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cajas_sobre;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_und_sobre_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'und_sobre', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $und_sobre;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'iva_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $iva_ptj;?>" class="input-block-level" style="width: 60px;"></td>

<?php if ($cod_estado_iva_saludable_ptj_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'iva_saludable_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $iva_saludable_ptj;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_ptj_comision_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'comision_ptj', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $comision_ptj;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_prod_tope_min == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'tope_min', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $tope_min;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_vencimiento1', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $fecha_vencimiento1;?>" class="input-block-level" size="10"></td>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'vencimiento_lote1', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $vencimiento_lote1;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_mantenimiento', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $fecha_mantenimiento;?>" class="input-block-level" style="width: 140px;"></td>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'meses_mantenimiento', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $meses_mantenimiento;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_meses_garantia_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'meses_garantia', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $meses_garantia;?>" class="input-block-level" size="30"></td>
<?php } ?>


<?php if ($cod_estado_factura_compra_producto_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_factura', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_factura;?>" class="input-block-level" size="30"></td>
<?php } ?>

<?php if ($cod_estado_producto_serial_global == '1') { ?>
<td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_producto_serial', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $cod_producto_serial;?>" class="input-block-level" size="30"></td>
<?php } ?>

<td style="text-align:center">
<select name="nombre_tipo_producto" id="nombre_tipo_producto-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($nombre_tipo_producto)) { echo "<option value='' >Selecione</option>";
} else { echo "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_producto'];
$nombre = $datos2['nombre_tipo_producto'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_peso_producto_global == '1') { ?>
<td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'peso_producto', <?php echo $cod_producto;?>)" id="<?php echo $cod_producto;?>" value="<?php echo $peso_producto;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>


<?php if ($cod_estado_opcion_descontable_inv_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_opcion_descontable_inv" id="cod_opcion_descontable_inv-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
    <?php if (isset($cod_opcion_descontable_inv)) { echo ""; } else { echo ""; }
    $sql_consulta2 = "SELECT cod_opcion_descontable_inv, nombre_opcion_descontable_inv FROM tbl15_opcion_descontable_inv ORDER BY cod_opcion_descontable_inv ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_opcion_descontable_inv) and $cod_opcion_descontable_inv == $datos2['cod_opcion_descontable_inv']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_opcion_descontable_inv'];
    $nombre = $datos2['nombre_opcion_descontable_inv'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<?php if ($cod_estado_categoria_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_categoria" id="cod_categoria-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
    <?php if (isset($cod_categoria)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $sql_consulta2 = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_categoria'];
    $nombre = $datos2['nombre_categoria'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<?php if ($cod_estado_peso_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_estado_peso" id="cod_estado_peso-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
    <?php if (isset($cod_estado_peso)) { echo ""; } else { echo ""; }
    $sql_consulta2 = "SELECT cod_estado_peso, nombre_estado_peso FROM tbl15_estado_peso ORDER BY cod_estado_peso ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_estado_peso) and $cod_estado_peso == $datos2['cod_estado_peso']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_estado_peso'];
    $nombre = $datos2['nombre_estado_peso'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<?php if ($cod_estado_origen_produccion_global == '1') { ?>
<td style="text-align:center">
    <select name="cod_origen_produccion" id="cod_origen_produccion-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 140px;" required>
        <?php if (isset($cod_origen_produccion)) { echo "<option value='' >Selecione</option>"; } else { echo  "<option value='' selected >Selecione</option>"; }
        $consulta2_sql = ("SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion WHERE (cod_estado = '1') ORDER BY cod_origen_produccion ASC");
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_origen_produccion) and $cod_origen_produccion == $datos2['cod_origen_produccion']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_origen_produccion'];
        $nombre = $datos2['nombre_origen_produccion'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<?php } ?>

<?php if ($cod_estado_producto_de_cocina_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_tipo_producto_cocina" id="cod_tipo_producto_cocina-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 50px;">
    <?php if (isset($cod_tipo_producto_cocina)) { echo "<option value='' >Selecione</option>";
    } else { echo  "<option value='' selected >Selecione</option>"; }
    $sql_consulta2 = "SELECT cod_tipo_producto_cocina, nombre_tipo_producto_cocina FROM tbl15_tipo_producto_cocina ORDER BY cod_tipo_producto_cocina ASC";
    $consulta2 = mysqli_query($conectar, $sql_consulta2);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_tipo_producto_cocina) and $cod_tipo_producto_cocina == $datos2['cod_tipo_producto_cocina']) {
    $seleccionado = "selected";
    } else { $seleccionado = ""; }
    $codigo = $datos2['cod_tipo_producto_cocina'];
    $nombre = $datos2['nombre_tipo_producto_cocina'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </td>
<?php } ?>

<td style="text-align:center">
<select name="cod_dependencia" id="cod_dependencia-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
<?php if (isset($cod_dependencia)) { echo "<option value='' >Selecione</option>";
} else { echo "<option value='' selected >Selecione</option>"; }
$sql_consulta2 = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
$consulta2 = mysqli_query($conectar, $sql_consulta2);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_dependencia) and $cod_dependencia == $datos2['cod_dependencia']) {
$seleccionado = "selected";
} else { $seleccionado = ""; }
$codigo = $datos2['cod_dependencia'];
$nombre = $datos2['nombre_dependencia'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</td>

<?php if ($cod_estado_dependencia_sub_global == '1') { ?>
    <td style="text-align:center">
    <select name="cod_dependencia_sub" id="cod_dependencia_sub-<?php echo $cod_producto;?>" class="<?php echo $cod_producto;?>" style="width: 120px;">
    <?php if (isset($cod_dependencia_sub)) { echo ""; } else { echo ""; }
    $consulta2_sql = ("SELECT cod_dependencia_sub, nombre_dependencia_sub FROM tbl15_dependencia_sub ORDER BY cod_dependencia_sub ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_dependencia_sub) and $cod_dependencia_sub == $datos2['cod_dependencia_sub']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
    $codigo = $datos2['cod_dependencia_sub'];
    $nombre = $datos2['nombre_dependencia_sub'];
    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
<?php } ?>

<?php if ($cod_estado_provee_fechacompra_inv_masivo_global == '1') { ?>
	<td style="text-align:left"><?php echo $nombre1_tercero;?></td>
	<td style="text-align:center"><?php echo $fecha_anyo;?></td>
<?php } ?>

</tr>
<?php } ?>
</tbody>
</table>


<script>  
 $(document).ready(function(){  
  $('select[name="cod_dependencia"]').change(function(){ 
  var cod_dependencia = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_dependencia, campo:"cod_dependencia", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_dependencia_sub"]').change(function(){ 
  var cod_dependencia_sub = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_dependencia_sub, campo:"cod_dependencia_sub", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_categoria"]').change(function(){ 
  var cod_categoria = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_categoria, campo:"cod_categoria", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_marca"]').change(function(){ 
  var cod_marca = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_marca, campo:"cod_marca", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_estado_peso"]').change(function(){ 
  var cod_estado_peso = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_estado_peso, campo:"cod_estado_peso", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>
 
<script>  
 $(document).ready(function(){  

  $('select[name="cod_tipo_producto_cocina"]').change(function(){ 
  var cod_tipo_producto_cocina = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_tipo_producto_cocina, campo:"cod_tipo_producto_cocina", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>
 
<script>  
 $(document).ready(function(){  

  $('select[name="cod_opcion_descontable_inv"]').change(function(){ 
  var cod_opcion_descontable_inv = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_opcion_descontable_inv, campo:"cod_opcion_descontable_inv", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
</script>

<script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_precio_venta"]').change(function(){ 
  var nombre_tipo_precio_venta = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_precio_venta, campo:"nombre_tipo_precio_venta", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_producto"]').change(function(){ 
  var nombre_tipo_producto = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_producto, campo:"nombre_tipo_producto", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="nombre_tipo_unidad_medida"]').change(function(){ 
  var nombre_tipo_unidad_medida = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_tipo_unidad_medida, campo:"nombre_tipo_unidad_medida", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('select[name="unidad_medida_peso"]').change(function(){ 
  var unidad_medida_peso = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:unidad_medida_peso, campo:"unidad_medida_peso", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

 <script>  
 $(document).ready(function(){  

  $('textarea[name="nombre_producto"]').change(function(){ 
  var nombre_producto = $(this).val();  
  //let id = this.id;
  var id = $(this).attr("class");
  console.log("id = "+id);
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:nombre_producto, campo:"nombre_producto", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_origen_produccion"]').change(function(){ 
  var cod_origen_produccion = $(this).val();  
  let id = this.id;
    $.ajax({ url:"inventario_masivo_editable_ajax_reg.php", method:"GET", data:{valor:cod_origen_produccion, campo:"cod_origen_produccion", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>