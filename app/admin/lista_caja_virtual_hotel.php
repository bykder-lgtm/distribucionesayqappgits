<?php $nombre_pagina = "Lista"; ?>
<!-- ************************************************************************************************************************* -->
<?php include_once('../admin/01_modulo_diseno_superior_aplicacion_hotel.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../admin/02_modulo_estilo_css_aplicacion_hotel.php'); ?>
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
                <h5 class="text-primary"><?php echo $nombre_pagina ?></h5>
            </nav>
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = 'lista_caja_virtual_cocina.php'; } else { $pagina_redirect = 'lista_caja_virtual_cocina.php'; }
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }
$pagina_local        = $_SERVER['PHP_SELF'];

if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
else { 
    $condic_estado_info = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_origen_produccion_user = ""; 
}
?>
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="text-primary"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h3>
                            <div class="table-responsive">

                                <div id="salida_tabla_caja_mesa_ajax">
                                    <table class="table table-dark table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">VER</th>
                                                <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
                                                <th style="text-align:center;">USUARIO</th>
                                                <th style="text-align:center;">DESCRIPCION</th>
                                                <th style="text-align:center;"></th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><th style="text-align:center;">PRIORIDAD</th><?php } ?>
                                                <th style="text-align:center;">FECHA | HORA</th>
                                                <th style="text-align:center;">ATENDIDO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$nombre_producto_concat             = '';
$salida_tra                         = '';

$mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion, 
nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, 
cod_estado_revisado, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, latitud, longitud, latitud_longitud, 
cod_estado_revisado_cocina, cod_estado_revisado_bartender, cod_estado_revisado_jugueria
FROM tbl15_info_factura_venta 
WHERE (nombre_estado_factura = 'ABIERTA') $condic_estado_info $ordenar_consulta";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_reg = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$nombre_producto_concat             = '';
$cod_info_factura_venta             = $datos['cod_info_factura_venta'];
$cod_caja_virtual                   = $datos['cod_caja_virtual'];
$cuenta                             = $datos['cuenta'];
$cod_tercero                        = $datos['cod_tercero'];
$fecha_anyo                         = $datos['fecha_anyo'];
$fecha_hora                         = $datos['fecha_hora'];
$cod_administrador                  = $datos['cod_administrador'];
$cod_prioridad                      = $datos['cod_prioridad'];
$cod_base_caja                      = $datos['cod_base_caja'];

$nombre1_tercero                    = $datos['nombre1_tercero'];
$nombre2_tercero                    = $datos['nombre2_tercero'];
$apellido1_tercero                  = $datos['apellido1_tercero'];
$apellido2_tercero                  = $datos['apellido2_tercero'];
$identificacion_tercero             = $datos['identificacion_tercero'];
$fecha_nac_tercero                  = $datos['fecha_nac_tercero'];
$direccion_tercero                  = $datos['direccion_tercero'];
$telefono1_tercero                  = $datos['telefono1_tercero'];
$correo_tercero                     = $datos['correo_tercero'];
$cod_estado_revisado                = $datos['cod_estado_revisado'];
$cod_tipo_metodo_envio              = $datos['cod_tipo_metodo_envio'];
$cod_tipo_aplicacion                = $datos['cod_tipo_aplicacion'];
$cod_zona_envio                     = $datos['cod_zona_envio'];
$observacion_db                     = $datos['observacion'];
$latitud                            = $datos['latitud'];
$longitud                           = $datos['longitud'];
$latitud_longitud                   = $datos['latitud_longitud'];
$cod_estado_revisado_cocina         = $datos['cod_estado_revisado_cocina'];
$cod_estado_revisado_bartender      = $datos['cod_estado_revisado_bartender'];
$cod_estado_revisado_jugueria       = $datos['cod_estado_revisado_jugueria'];

if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }
//if (($cod_estado_revisado_cocina == '0') && ($cod_origen_produccion_user == '1')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
//if (($cod_estado_revisado_bartender == '0') && ($cod_origen_produccion_user == '2')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }
//if (($cod_estado_revisado_jugueria == '0') && ($cod_origen_produccion_user == '3')) { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

$sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
$datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

$nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
$nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
$apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
$apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

$cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
$datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

$nombres                            = $datos_info_usuario['nombres'];
$apellidos                          = $datos_info_usuario['apellidos'];
$nombre_usuario                     = $nombres.' '.$apellidos;
$cuenta_usuario                     = $datos_info_usuario['cuenta'];

$sql_datos_venta_temp = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, nombre_producto, cod_estado_revisado, cod_estado_revisado_cocina, 
cod_estado_revisado_bartender, cod_estado_revisado_jugueria, comentario_producto, cod_origen_produccion 
FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') $condic_origen_produccion_user $condic_estado_venta_temp ORDER BY cod_venta_producto_temporal DESC";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

$nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
$und_venta_con                       = $datos_venta_temp['und_venta'];
$comentario_producto_con             = $datos_venta_temp['comentario_producto'];
$cod_origen_produccion_con           = $datos_venta_temp['cod_origen_produccion'];
$cod_estado_revisado_con             = $datos_venta_temp['cod_estado_revisado'];
$cod_estado_revisado_cocina_con      = $datos_venta_temp['cod_estado_revisado_cocina'];
$cod_estado_revisado_bartender_con   = $datos_venta_temp['cod_estado_revisado_bartender'];
$cod_estado_revisado_jugueria_con    = $datos_venta_temp['cod_estado_revisado_jugueria'];

if ($cod_estado_marcado_revisado_caja_mesa_venta_temporal_global == '1') { $nombre_producto_concat .= "<mark>".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'</mark><br>'; } else { $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.'<br>'; }

}

$sql_datos_venta_temp_total = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
$datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

$total_venta_producto_ciclo                = $datos_venta_temp_total['total_venta_producto'];

$sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
$consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio);
$datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

$nombre_tipo_metodo_envio                  = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];

$sql_tipo_aplicacion = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE (cod_tipo_aplicacion = '$cod_tipo_aplicacion')";
$consulta_tipo_aplicacion = mysqli_query($conectar, $sql_tipo_aplicacion);
$datos_tipo_aplicacion = mysqli_fetch_assoc($consulta_tipo_aplicacion);

$nombre_tipo_aplicacion                    = $datos_tipo_aplicacion['nombre_tipo_aplicacion'];


$sql_zona_envio = "SELECT nombre_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '$cod_zona_envio')";
$consulta_zona_envio = mysqli_query($conectar, $sql_zona_envio);
$datos_zona_envio = mysqli_fetch_assoc($consulta_zona_envio);

$nombre_zona_envio                         = $datos_zona_envio['nombre_zona_envio'];
?>
                                            <tr>
                                                <th style="text-align:center;"><a href="../admin/cocina_facturacion_venta_temporal_producto_manual_pos.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/ver3.png alt="ver"></th>
                                                <th style="text-align:center;"><?php echo $cod_base_caja; ?></th>
                                                <th style="text-align:left;"><?php echo $nombre_usuario; ?></th>
                                                <th style="text-align:left;"><?php echo $nombre_producto_concat; ?></th>
                                                <th style="text-align:left;"><?php echo $observacion; ?></th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><th style="text-align:center;"><?php echo $cod_prioridad; ?></th><?php } ?>
                                                <th style="text-align:center;"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></th>
                                                <th style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></th>
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
<?php include_once('../admin/04_modulo_footer_aplicacion_hotel.php'); ?>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_aplicacion_hotel.php'); ?>
</body>
</html>
