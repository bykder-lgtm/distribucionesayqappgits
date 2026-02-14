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

if (isset($_REQUEST["cantidad_reg_por_pagina"])) { $cantidad_reg_por_pagina = intval($_REQUEST['cantidad_reg_por_pagina']); } else { $cantidad_reg_por_pagina = '50'; }
if (isset($_REQUEST["paginador_actual"])) { $paginador_actual = intval($_REQUEST['paginador_actual']); } else { $paginador_actual = '1'; }
if (isset($_REQUEST["buscar_por"])) { $buscar_por = addslashes($_REQUEST['buscar_por']); } else { $buscar_por = ''; }
if (isset($_REQUEST["busqueda"])) { $busqueda = addslashes($_REQUEST['busqueda']); } else { $busqueda = ''; }
$registro_inicio                                                   = ($paginador_actual - 1) * $cantidad_reg_por_pagina;
$seleccionado                                                      = 0;
$pagina                                                            = "../admin/lista_info_factura_cotizacion_venta.php";

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
        <?php if ($cod_estado_cotizacion_venta_editar == '1') { ?>
        <th style="text-align:center">Edit</th>
        <?php } ?>
        <th style="text-align:center">Tipo</th>
        <th style="text-align:center">Factura</th>
        <th style="text-align:left">Cliente</th>
        <th style="text-align:center">Total</th>
        <th style="text-align:center">Fecha</th>
        <th style="text-align:center">Hora</th>
        <?php if ($cod_estado_cotizacion_venta_imprimir == '1') { ?>
        <th style="text-align:center">Imp1</th>
        <th style="text-align:center">Imp2</th>
        <?php } ?>
        <th style="text-align:center">ID</th>
	</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_cotizacion_factura_venta WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_cotizacion_factura_venta DESC LIMIT $registro_inicio, $cantidad_reg_por_pagina";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
    $cod_info_cotizacion_factura_venta    = $info_info_factura['cod_info_cotizacion_factura_venta'];
    $cod_factura                          = $info_info_factura['cod_factura'];
    $nombre_empresa                       = $info_info_factura['nombre_empresa'];
    $razonsocial_empresa                  = $info_info_factura['razonsocial_empresa'];
    $cuenta                               = $info_info_factura['cuenta'];
    $cod_estado_factura                   = $info_info_factura['cod_estado_factura'];
    $fecha_anyo                           = $info_info_factura['fecha_anyo'];
    $fecha_hora                           = $info_info_factura['fecha_hora'];
    $cod_administrador                    = $info_info_factura['cod_administrador'];
    $nombre_tipo_producto                 = $info_info_factura['nombre_tipo_producto'];
    $total_precio_venta                   = $info_info_factura['total_precio_venta'];
    $cod_tipo_forma_pago                  = $info_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura                  = $info_info_factura['nombre_tipo_factura'];
    $cod_tercero                          = $info_info_factura['cod_tercero'];
    $cod_tipo_cotizacion                  = $info_info_factura['cod_tipo_cotizacion'];

    $obtener_cliente = "SELECT * FROM tbl15_tipo_cotizacion WHERE (cod_tipo_cotizacion = '$cod_tipo_cotizacion')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre_tipo_cotizacion               = $matriz_cliente['nombre_tipo_cotizacion'];

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre_cliente                       = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
    $cedula_cli                           = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                        = $matriz_cliente['direccion_tercero'];
?>
	<tr>
        <?php if ($cod_estado_cotizacion_venta_editar == '1') { ?>
        <td style="text-align:center" id="edit<?php echo $cod_info_cotizacion_factura_venta;?>"><a href="../admin/edit_factura_cotizacion_venta.php?cod_info_cotizacion_factura_venta=<?php echo $cod_info_cotizacion_factura_venta ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <!--<td class="service_list" id="cod_info_cotizacion_factura_venta<?php echo $cod_info_cotizacion_factura_venta ?>" data="<?php echo $cod_info_cotizacion_factura_venta ?>"><a class="eliminar" id="cod_info_cotizacion_factura_venta<?php echo $cod_info_cotizacion_factura_venta ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
        <td style="text-align:left" id="nombre_tipo_cotizacion<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $nombre_tipo_cotizacion?></td>
        <td style="text-align:center" id="cod_factura<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $cod_factura?></td>
        <td style="text-align:left" id="nombre_empresa<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $nombre_cliente?></td>
        <td style="text-align:right" id="nombre_empresa<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
        <td style="text-align:center" id="fecha_anyo<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $fecha_anyo?></td>
        <td style="text-align:center" id="fecha_hora<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $fecha_hora?></td>
        <?php if ($cod_estado_cotizacion_venta_imprimir == '1') { ?>
        <td style="text-align:center" id="edit<?php echo $cod_info_cotizacion_factura_venta;?>"><a href="../admin/cotizacion_venta_productos_opcion_imprimir.php?cod_info_cotizacion_factura_venta=<?php echo $cod_info_cotizacion_factura_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos_peq2.png" class="img-polaroid" alt=""></a></td>
        <td style="text-align:center" id="imp<?php echo $cod_info_cotizacion_factura_venta;?>"><a href="../admin/ver_factura_cotizacion_venta_pdf.php?cod_info_cotizacion_factura_venta=<?php echo $cod_info_cotizacion_factura_venta ?>&fecha=<?php echo $fecha_anyo ?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <td style="text-align:center" id="nombre_tipo_cotizacion<?php echo $cod_info_cotizacion_factura_venta;?>"><?php echo $cod_info_cotizacion_factura_venta?></td>
	</tr>
<?php } ?>
</tbody>
</table>