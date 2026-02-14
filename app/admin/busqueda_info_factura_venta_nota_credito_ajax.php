<?php
include_once('../conexiones/conexione.php');

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);
$cod_seguridad                      = ($_SESSION['cod_seguridad']);
//----------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_marca_global, cod_estado_busqueda_venta_manual_resultado_unico_redirect_global, cod_estado_cod_barra2_global, cod_estado_venta_prod_en_cero_global, limite_mostrar_producto_lista_caja_virtual
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_busqueda_venta_manual_resultado_unico_redirect_global  = $info_empresa_data['cod_estado_busqueda_venta_manual_resultado_unico_redirect_global'];
$cod_estado_cod_barra2_global                                      = $info_empresa_data['cod_estado_cod_barra2_global'];
$cod_estado_venta_prod_en_cero_global                              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$limite_mostrar_producto_lista_caja_virtual                        = $info_empresa_data['limite_mostrar_producto_lista_caja_virtual'];

if ($limite_mostrar_producto_lista_caja_virtual == '0') { $limite_mostrar_registro = ''; } else { $limite_mostrar_registro = 'LIMIT 0,'.$limite_mostrar_producto_lista_caja_virtual; }
//----------------------------------------------------------------------------------------------------------------//
$buscar                                                            = addslashes($_POST['buscar']);
$pagina                                                            = addslashes($_POST['pagina']);
$nombre_tipo_moneda                                                = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                                               = addslashes($_POST['nombre_tipo_factura']);
$cod_estado_vacuna                                                 = addslashes($_POST['cod_estado_vacuna']);
$tipo_busqueda                                                     = addslashes($_POST['tipo_busqueda']);
$buscar_por                                                        = addslashes($_POST['buscar_por']);
$cuenta                                                            = addslashes($_POST['cuenta']);
$cod_caja_virtual                                                  = addslashes($_POST['cod_caja_virtual']);
$modo_venta_por_defecto                                            = addslashes($_POST['modo_venta_por_defecto']);

$sql_permiso_usuario = "SELECT cod_estado_prod_und_producto,cod_estado_prod_precio_compra_producto, cod_estado_prod_precio_costo_producto, cod_estado_prod_precio_venta_producto 
FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_permiso_usuario = mysqli_query($conectar, $sql_permiso_usuario) or die(mysqli_error($conectar));
$matriz_permiso_usuario = mysqli_fetch_assoc($consulta_permiso_usuario);

$cod_estado_prod_und_producto                                        = $matriz_permiso_usuario['cod_estado_prod_und_producto'];
$cod_estado_prod_precio_compra_producto                              = $matriz_permiso_usuario['cod_estado_prod_precio_compra_producto'];
$cod_estado_prod_precio_costo_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_costo_producto'];
$cod_estado_prod_precio_venta_producto                               = $matriz_permiso_usuario['cod_estado_prod_precio_venta_producto'];
//----------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_categoria'])) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_url_categoria = "&cod_categoria=".$cod_categoria; } else { $condicional_url_categoria = ""; }
if ($cod_estado_cod_barra2_global == '1') { $condicional_barra2 = " OR (cod_producto_barra2 LIKE '$buscar')"; } else { $condicional_barra2 = ""; }

$tab                      = 'tbl15_info_factura_venta';
$campo                    = 'cod_producto';
$tipo                     = 'insertar';
$foco                     = 'busqueda';


if($buscar <> NULL) {
	if ($buscar_por == 'nombre1_tercero') {
		$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta INNER JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero WHERE (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_tercero.nombre1_tercero LIKE '%$buscar%') ORDER BY cod_info_factura_venta DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
	} elseif ($buscar_por == 'identificacion_tercero') {
		$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta INNER JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero WHERE (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_tercero.identificacion_tercero LIKE '$buscar%') ORDER BY cod_info_factura_venta DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
	} elseif ($buscar_por == 'cod_factura') {
		$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta INNER JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero WHERE (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_info_factura_venta.cod_factura LIKE '$buscar') ORDER BY cod_info_factura_venta DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
	} elseif ($buscar_por == 'fecha_ymd_venta_producto') {
		$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta INNER JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero WHERE (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_info_factura_venta.fecha_anyo LIKE '$buscar') ORDER BY cod_info_factura_venta DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
	} else {
		$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta INNER JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero WHERE (tbl15_info_factura_venta.nombre_estado_factura = 'CERRADA') AND (tbl15_tercero.nombre1_tercero LIKE '%$buscar%') ORDER BY cod_info_factura_venta DESC";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$total_resultados = mysqli_num_rows($consulta);
	}
}
if ($total_resultados <> 0) {
?>
<br>
<div class="table-responsive">
<table class="table table-striped">
	<tr class="headings">
        <th style="text-align:center;">Tipo</th>
        <th style="text-align:center;">Factura</th>
        <th style="text-align:center;">Cliente</th>
        <th style="text-align:center;">Concepto</th>
        <th style="text-align:center;">Total</th>
        <th style="text-align:center;">Fecha</th>
        <th style="text-align:center;">Hora</th>
        <th style="text-align:center;">Forma Pago</th>
        <th style="text-align:center;">Dian</th>
        <th style="text-align:center;">Usuario</th>
        <th style="text-align:center;">ID</th>
	</tr>
<?php
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta)) {

    $nombre_producto_concat                             = '';
    $cod_info_factura_venta                             = $datos_total_tipo_factura['cod_info_factura_venta'];
    $cod_factura                                        = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero                                        = $datos_total_tipo_factura['cod_tercero'];
    $vlr_cancelado                                      = $datos_total_tipo_factura['vlr_cancelado'];
    $vlr_vuelto                                         = $datos_total_tipo_factura['vlr_vuelto'];
    $fecha_anyo                                         = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_hora                                         = $datos_total_tipo_factura['fecha_hora'];
    $cod_tipo_pago                                      = $datos_total_tipo_factura['cod_tipo_pago'];
    $cod_administrador                                  = $datos_total_tipo_factura['cod_administrador'];
    $total_precio_compra                                = $datos_total_tipo_factura['total_precio_compra'];
    $total_precio_venta                                 = $datos_total_tipo_factura['total_precio_venta'];
    $cod_dependencia                                    = $datos_total_tipo_factura['cod_dependencia'];
    $cod_tipo_forma_pago                                = $datos_total_tipo_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura                                = $datos_total_tipo_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                 = $datos_total_tipo_factura['nombre_tipo_moneda'];
    $total_datos_data                                   = $datos_total_tipo_factura['total_datos_data'];
    $observacion_tercero                                = $datos_total_tipo_factura['observacion_tercero'];
    $cod_base_caja                                      = $datos_total_tipo_factura['cod_base_caja'];
    $cod_estado_cava                                    = $datos_total_tipo_factura['cod_estado_cava'];
    $cod_cuentas_cobrar                                 = $datos_total_tipo_factura['cod_cuentas_cobrar'];
    $fecha_entrega                                      = $datos_total_tipo_factura['fecha_entrega'];
    $cod_resolucion_facturacion                         = $datos_total_tipo_factura['cod_resolucion_facturacion'];
    $nombre_estado_factura_dataico_dian                 = $datos_total_tipo_factura['nombre_estado_factura_dataico_dian'];

    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                     = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre1_tercero                             = $matriz_cliente['nombre1_tercero'];
    $nombre2_tercero                             = $matriz_cliente['nombre2_tercero'];
    $apellido1_tercero                           = $matriz_cliente['apellido1_tercero'];
    $apellido2_tercero                           = $matriz_cliente['apellido2_tercero'];
    $identificacion_tercero                      = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                               = $matriz_cliente['direccion_tercero'];
    $nombre_tipo_identificacion                  = $matriz_cliente['nombre_tipo_identificacion'];
    $digito_tercero                              = $matriz_cliente['digito_tercero'];
    $nombre_tercero                              = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;

    $sql_datos_venta_temp = "SELECT cod_venta_producto, cod_producto_barra, und_venta, nombre_producto 
    FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC $limite_mostrar_registro";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_venta_con                       = $datos_venta_temp['und_venta'];

        $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.'<br>';
    }
    ?>
	<tr class="even pointer">
        <td style="text-align:center"><a href="../admin/reg_factura_venta_nota_credito.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><?php echo $nombre_tipo_factura?></a></td>
        <td style="text-align:center"><a href="../admin/reg_factura_venta_nota_credito.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><?php echo ($prefijo_resolucion_facturacion.'|'.$cod_factura)?></a></td>
        <td style="text-align:left"><a href="../admin/reg_factura_venta_nota_credito.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><?php echo $nombre_tercero?></a></td>
        <td style="text-align:left;"><?php echo $nombre_producto_concat?></td>
        <td style="text-align:right;"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo $fecha_anyo?></td>
        <td style="text-align:center;"><?php echo $fecha_hora?></td>
        <td style="text-align:center;"><?php echo $nombre_tipo_forma_pago?></td>
        <td style="text-align:center;"><?php echo $nombre_estado_factura_dataico_dian?></td>
        <td style="text-align:center;"><?php echo $cuenta?></td>
        <td style="text-align:center;"><?php echo $cod_info_factura_venta?></td>
	</tr>
<?php } ?>
</table>
</div>
<?php } else { } ?>