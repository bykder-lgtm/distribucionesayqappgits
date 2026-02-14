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
cod_tipo_sistema_numeracion_und_compra, cod_tipo_sistema_numeracion_precio_compra, cod_tipo_sistema_numeracion_precio_venta, nombre_tipo_componente 
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
$registro_inicio                                                   = ($paginador_actual - 1) * $cantidad_reg_por_pagina;
$seleccionado                                                      = 0;
$pagina                                                            = "../admin/lista_puc.php";

if (isset($_REQUEST['busqueda'])) { 
    if ($busqueda <> '') { 
        if ($buscar_por == 'todo') {
        	$mostrar_datos_sql = "WHERE (codigo_puc LIKE '%$busqueda%') OR (nombre_puc LIKE '%$busqueda%')";
        } elseif ($buscar_por == 'codigo_puc') {
        	$mostrar_datos_sql = "WHERE (codigo_puc LIKE '$busqueda')";
        } elseif ($buscar_por == 'nombre_puc') {
        	$mostrar_datos_sql = "WHERE (nombre_puc LIKE '%$busqueda%')";
        } else {
        	$mostrar_datos_sql = "WHERE (codigo_puc LIKE '%$busqueda%') OR (nombre_puc LIKE '%$busqueda%')";
        }

        $filtro_consulta_busqueda = $mostrar_datos_sql; 
    } else { 
        $filtro_consulta_busqueda = "";  
    }
} else { 
    $busqueda = ''; 
    $filtro_consulta_busqueda = ""; 
}
?>
<table class="table table-striped">
<thead>
	<tr>
		<th style="text-align:left; background-color:#DBE0F3; color:#000;">CODIGO PUC</th>
		<th style="text-align:left; background-color:#DBE0F3; color:#000;">CUENTA PUC</th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000;">TIPO</th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000;">SALDO INICIAL</th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000;">SALDO ACTUAL</th>
		<th style="text-align:center; background-color:#DBE0F3; color:#000;">ESTADO_PUC</th>
		<?php if ($cod_estado_contabilidad_puc_editar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">EDIT</th><?php } ?>
		<?php if ($cod_estado_contabilidad_puc_registrar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">CREAR SUBCUENTA</th><?php } ?>
		<th style="text-align:center; background-color:#DBE0F3; color:#000;">#</th>
	</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_puc $filtro_consulta_busqueda ORDER BY cod_estado, fecha_creacion ASC LIMIT $registro_inicio, $cantidad_reg_por_pagina";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
				
	$cod_puc                             = $info_cliente['cod_puc'];
	$codigo_puc                          = $info_cliente['codigo_puc'];
	$nombre_puc                          = $info_cliente['nombre_puc'];
	$tipo_puc                            = $info_cliente['tipo_puc'];
	$cod_estado                          = $info_cliente['cod_estado'];
    $saldo_inicial_puc                   = $info_cliente['saldo_inicial_puc'];
    $subtotal_puc                        = $info_cliente['subtotal_puc'];
    $saldo_actual_puc                    = $info_cliente['saldo_actual_puc'];
    $nombre_modulo_puc                   = $info_cliente['nombre_modulo_puc'];

	$sql_estado = "SELECT * FROM tbl15_estado WHERE cod_estado = '$cod_estado'";
	$resultado_estado = mysqli_query($conectar, $sql_estado);
	$info_estado = mysqli_fetch_assoc($resultado_estado);

	$nombre_estado                  = $info_estado['nombre_estado'];
	$color_fondo_celda_estado       = $info_estado['color_fondo_celda_estado'];
	$color_letra_celda_estado       = $info_estado['color_letra_celda_estado'];
?>
	<tr>
		<th style="text-align:left; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo $codigo_puc ?></th>
		<th style="text-align:left; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo $nombre_puc ?></th>
		<th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo $tipo_puc ?></th>
		<th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo number_format($saldo_inicial_puc, 0, ",", ".") ?></th>
		<th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo number_format($saldo_actual_puc, 0, ",", ".") ?></th>

        <th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;">
            <select name="cod_estado" id="<?php echo $cod_puc;?>" class="input-block-level" style="width: 100px;">
            <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
            $consulta2_sql = ("SELECT * FROM tbl15_estado");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_estado'];
            $nombre = $datos2['nombre_estado'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
        </th>
		<?php if ($cod_estado_contabilidad_puc_editar == '1') { ?><th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><a href="../admin/edit_puc.php?cod_puc=<?php echo $cod_puc?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></th><?php } ?>
		<?php if ($cod_estado_contabilidad_puc_registrar == '1') { ?><th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><a href="../admin/reg_subcuenta_puc.php?cod_puc=<?php echo $cod_puc?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></th><?php } ?>
		<th style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;"><?php echo $cod_puc?></th>
	</tr>
<?php } ?>
</tbody>
</table>

<script language="javascript">
$(document).ready(function(){
    $('select[name="cod_estado"]').change(function(){  
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_puc";
        var id = $(this).attr("id");
        var foco = '';

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_puc_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('select[name="nombre_modulo_puc"]').change(function(){  
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_puc";
        var id = $(this).attr("id");
        var foco = '';

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_puc_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>