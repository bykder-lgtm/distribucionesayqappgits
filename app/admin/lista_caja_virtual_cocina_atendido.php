<?php include_once('../admin/01_modulo_diseno_superior_aplicacion_tv.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once('../admin/02_modulo_estilo_css_aplicacion_tv.php'); ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
		<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 class="text-primary">App Tv</h5>
            </nav>
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = 'lista_caja_virtual_cocina.php'; } else { $pagina_redirect = 'lista_caja_virtual_cocina.php'; }
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }
$pagina_local        = $_SERVER['PHP_SELF'];

if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '1')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '1')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '1')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '1')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '1')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '1')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
else { 
    $condic_estado_info = ""; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '1')"; 
    $condic_origen_produccion_user = ""; 
}
?>
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="text-primary"><?php echo $nombre_concepto_multi_virtual; ?>S ATENDIDAS</h3>
                            <div class="table-responsive">

                                <div id="salida_tabla_caja_mesa_ajax">
                                    <table class="table table-dark table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">VER</th>
                                                <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
                                                <th style="text-align:center;">USUARIO</th>
                                                <th style="text-align:center;">DESCRIPCION</th>
                                                <th style="text-align:center;">PRIORIDAD</th>
                                                <!--<th style="text-align:center;">CLIENTE</th>-->
                                                <th style="text-align:center;">FECHA | HORA</th>
                                                <!--<th style="text-align:center;">ATENDIDO</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$nombre_producto_concat             = '';
$salida_tra                         = '';

$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_prioridad";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

$nombre_producto_concat             = '';
$comentario_producto_concat         = '';

$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cod_caja_virtual                   = $datos['cod_caja_virtual'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$cod_prioridad                      = $datos['cod_prioridad'];
$cod_base_caja                      = $datos['cod_base_caja'];

$sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
$nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
$apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
$apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

$cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_info_usuario = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
$datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

$nombres                            = $datos_info_usuario['nombres'];
$apellidos                          = $datos_info_usuario['apellidos'];
$nombre_usuario                     = $nombres.' '.$apellidos;

$sql_datos_venta_temp = "SELECT cod_producto_barra, und_venta, nombre_producto, comentario_producto 
FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') $condic_origen_produccion_user $condic_estado_venta_temp ORDER BY cod_venta_producto_temporal DESC";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

$nombre_producto_concat             .= intval($datos_venta_temp['und_venta']).' | '.$datos_venta_temp['nombre_producto'].' | '.$datos_venta_temp['comentario_producto'].'<br>';

}
?>
                                            <tr>
                                                <td style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/ver3.png alt="ver"></td>
                                                <td style="text-align:center;"><?php echo $cod_base_caja; ?></td>
                                                <td style="text-align:left;"><?php echo $nombre_usuario; ?></td>
                                                <td style="text-align:left;"><?php echo $nombre_producto_concat; ?></td>
                                                <td style="text-align:center;"><?php echo $cod_prioridad; ?></td>
                                                <!--<td style="text-align:left;"><?php echo $cliente; ?></td>-->
                                                <td style="text-align:center;"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></td>
                                                <!--<td style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></td>-->
                                            </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
<?php include_once('../admin/04_modulo_footer_aplicacion_tv.php'); ?>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_aplicacion_tv.php'); ?>
</body>
</html>

<script language="javascript">
setInterval("location.reload()",10000);
</script>