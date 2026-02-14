<?php 
$nombre_pagina                            = "Alquiler de Habitaciones";
$url_pagina_local_completa                = $_SERVER['PHP_SELF'];
$explode_url_pagina_local_completa        = explode('/', $url_pagina_local_completa);
$url_pagina_local_parcial                 = end($explode_url_pagina_local_completa);
?>
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
<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">


                            <!--<h3 class="text-primary"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h3>-->
                            <div class="table-responsive">
                                <div id="salida_tabla_caja_mesa_ajax">

                                </div>
                            </div>

<?php 
if (isset($_POST['cod_producto_barra'])) {
    $cod_producto                                    = intval($_POST['cod_producto']);
    $cod_producto_barra                              = addslashes($_POST['cod_producto_barra']);
    $cod_venta_producto_temporal                     = intval($_POST['cod_venta_producto_temporal']);
    $cod_estado_habitacion_hotel                     = intval($_POST['cod_estado_habitacion_hotel']);
    $cod_tipo_habitacion_hotel                       = intval($_POST['cod_tipo_habitacion_hotel']);
    $cod_tercero                                     = intval($_POST['cod_tercero']);
    $cod_administrador                               = intval($_POST['cod_administrador']);
    $fecha_ymd_parqueo_ini                           = addslashes($_POST['fecha_ymd_parqueo_ini']);
    $fecha_ymd_parqueo_fin                           = addslashes($_POST['fecha_ymd_parqueo_fin']);
    $precio_venta_producto                           = addslashes($_POST['precio_venta_producto']);
    $total_venta_producto                            = addslashes($_POST['total_venta_producto']);
    $pagina                                          = addslashes($_POST['pagina']);
    $nombre_tipo_factura                             = addslashes($_POST['nombre_tipo_factura']);
    $nombre_tipo_moneda                              = addslashes($_POST['nombre_tipo_moneda']);
    $total_venta_producto_hidden                     = addslashes($_POST['total_venta_producto_hidden']);
    $und_venta                                       = intval($_POST['und_venta']);
    $btn_enviar                                      = addslashes($_POST['btn_enviar']);

    $total_compra_producto                           = 0;
    $total_costo_producto                            = 0;
    $total_venta_producto                            = $total_venta_producto_hidden;
    $cod_tipo_inventario                             = "1";
    $precio_venta_producto_orig                      = $precio_venta_producto;
    $cod_estado_revisado                             = "0";
    $cod_estado_timbre_entrada                       = "0";
    $nombre_estado_factura                           = 'ABIERTA';
    $cod_tipo_pago                                   = "1";
    $cod_tipo_forma_pago                             = "1";
    $fecha_dia                                       = strtotime(date("Y-m-d"));
    $fecha_mes                                       = date("Y-m");
    $fecha_anyo                                      = date("Y-m-d");
    $anyo                                            = date("Y");
    $fecha_hora                                      = date("H:i:s");
    $fecha_remision                                  = date("Y-m-d");
    $nombre_ccosto                                   = '';
    $garantia_meses                                  = '';
    $observacion                                     = '';
    $cod_empresa                                     = '0';
    $fecha_ymdhis                                    = date("Y-m-d H:is");
    $cod_tipo_cobrar                                 = '1';
    $cuenta                                          = $cuenta_actual;
    $fecha_ymd_venta_producto                        = date("Y-m-d");
    $fecha_mes_venta_producto                        = date("Y-m");
    $fecha_anyo_venta_producto                       = date("Y");
    $fecha_seg_venta_producto                        = time();
    $cod_estado_factura                              = '1';
    $descuento_ptj                                   = '0';
    $flete_ptj                                       = '0';
    $vlr_cancelado                                   = '';
    $vlr_vuelto                                      = '';
    $cod_check_imp                                   = '1';
    $cod_tipo_metodo_envio                           = '1';
    $fecha_limpieza_hotel_ini                        = $fecha_anyo;
    $hora_limpieza_hotel_ini                         = $fecha_hora;
    $fecha_hora_reg                                  = $fecha_ymdhis;
    $cod_estado_tipo_hotel_parqueo                   = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_venta_producto_temporal";
    $resultado_animal = mysqli_query($conectar, $sql_animal);
    $info_animal = mysqli_fetch_assoc($resultado_animal);

    $cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
    $cod_base_caja                      = $info_animal['cod_base_caja'] + 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_habitaciones_hotel = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, cod_venta_producto_temporal, cod_dependencia, precio_compra_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, nombre_tipo_precio_venta, nombre_tipo_producto, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, 
    cod_tipo_producto_cocina, unidad_medida_peso, cod_origen_produccion, iva_ptj
    FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
    $consulta_habitaciones_hotel = mysqli_query($conectar, $sql_habitaciones_hotel);
    $datos_habitaciones_hotel = mysqli_fetch_assoc($consulta_habitaciones_hotel);

    $cod_producto                                = $datos_habitaciones_hotel['cod_producto'];
    $cod_producto_barra                          = $datos_habitaciones_hotel['cod_producto_barra'];
    $nombre_producto                             = $datos_habitaciones_hotel['nombre_producto'];
    $cod_venta_producto_temporal                 = $datos_habitaciones_hotel['cod_venta_producto_temporal'];
    $cod_estado_habitacion_hotel                 = $datos_habitaciones_hotel['cod_estado_habitacion_hotel'];
    $cod_tipo_habitacion_hotel                   = $datos_habitaciones_hotel['cod_tipo_habitacion_hotel'];
    $cod_dependencia                             = $datos_habitaciones_hotel['cod_dependencia'];
    $precio_compra_producto                      = $datos_habitaciones_hotel['precio_compra_producto'];
    $total_compra_producto                       = $precio_compra_producto * $und_venta;
    $precio_costo_producto                       = $precio_compra_producto;
    $total_costo_producto                        = $total_compra_producto;
    $nombre_tipo_unidad_medida                   = $datos_habitaciones_hotel['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion                    = $datos_habitaciones_hotel['nombre_tipo_presentacion'];
    $nombre_tipo_precio_venta                    = $datos_habitaciones_hotel['nombre_tipo_precio_venta'];
    $nombre_tipo_producto                        = $datos_habitaciones_hotel['nombre_tipo_producto'];
    $cod_opcion_descontable_inv                  = $datos_habitaciones_hotel['cod_opcion_descontable_inv'];
    $cod_categoria                               = $datos_habitaciones_hotel['cod_categoria'];
    $cod_categoria_sub                           = $datos_habitaciones_hotel['cod_categoria_sub'];
    $cod_tipo_producto_cocina                    = $datos_habitaciones_hotel['cod_tipo_producto_cocina'];
    $unidad_medida_peso                          = $datos_habitaciones_hotel['unidad_medida_peso'];
    $cod_origen_produccion                       = $datos_habitaciones_hotel['cod_origen_produccion'];
    $iva_ptj                                     = $datos_habitaciones_hotel['iva_ptj'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    if (isset($_GET['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_GET['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
    if (isset($_GET['cod_categoria'])) { $cod_categoria = intval($_GET['cod_categoria']); $condicional_url_categoria = "&cod_categoria=".$cod_categoria; } else { $condicional_url_categoria = ""; }
    if ($cod_producto_barra == '55555555') { $cod_estado_cava = 1; } else { $cod_estado_cava = 0; }
    if ($cod_estado_deshabilitar_und_venta_ventatemp == '1') { $cod_estado_componente_und_venta = '1'; } else { $cod_estado_componente_und_venta = '0'; }
    if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_estado_habitacion_hotel = "SELECT cod_estado_habitacion_hotel, nombre_estado_habitacion_hotel, estilo_estado_habitacion_hotel FROM tbl15_estado_habitacion_hotel 
    WHERE (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel')";
    $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
    $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

    $nombre_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['nombre_estado_habitacion_hotel'];
    $estilo_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['estilo_estado_habitacion_hotel'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_estado_habitacion_hotel = "SELECT cod_tipo_habitacion_hotel, nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel WHERE (cod_tipo_habitacion_hotel = '$cod_tipo_habitacion_hotel')";
    $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
    $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

    $nombre_tipo_habitacion_hotel                = $datos_estado_habitacion_hotel['nombre_tipo_habitacion_hotel'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
    $consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
    $datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

    $cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
    $exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
    $datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

    $cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_venta_producto_temporal = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_venta_producto_temporal'";
    $exec_autoincremento_venta_producto_temporal = mysqli_query($conectar, $sql_autoincremento_venta_producto_temporal) or die(mysqli_error($conectar));
    $datos_autoincremento_venta_producto_temporal = mysqli_fetch_assoc($exec_autoincremento_venta_producto_temporal);

    $cod_venta_producto_temporal             = $datos_autoincremento_venta_producto_temporal['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_limpieza_hotel = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_limpieza_hotel'";
    $exec_autoincremento_limpieza_hotel = mysqli_query($conectar, $sql_autoincremento_limpieza_hotel) or die(mysqli_error($conectar));
    $datos_autoincremento_limpieza_hotel = mysqli_fetch_assoc($exec_autoincremento_limpieza_hotel);

    $cod_limpieza_hotel             = $datos_autoincremento_limpieza_hotel['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
    if ($btn_enviar == 'btn_Alquilar') {
        $cod_estado_habitacion_hotel = 1;

        $sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
        fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
        nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_estado_habitacion_hotel, 
        cod_tipo_habitacion_hotel, fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin) 
        VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
        '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
        '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_estado_habitacion_hotel', 
        '$cod_tipo_habitacion_hotel', '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin')";
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

        $sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_venta_producto_temporal, cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
        precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
        precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
        fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
        cod_administrador, cod_tipo_cobrar, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
        precio_venta_producto_orig, cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, 
        cod_check_imp, unidad_medida_peso, cod_estado_componente_und_venta, cod_origen_produccion, cod_estado_cava, iva_ptj, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, 
        fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin, cod_estado_tipo_hotel_parqueo) 
        VALUES ('$cod_venta_producto_temporal', '$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
        '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
        '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
        '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
        '$cod_administrador', '$cod_tipo_cobrar', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
        '$precio_venta_producto_orig', '$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', 
        '$cod_check_imp', '$unidad_medida_peso', '$cod_estado_componente_und_venta', '$cod_origen_produccion', '$cod_estado_cava', '$iva_ptj', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', 
        '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin', '$cod_estado_tipo_hotel_parqueo')";
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

        $sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel', cod_info_factura_venta = '$cod_info_factura_venta', 
        cod_venta_producto_temporal = '$cod_venta_producto_temporal' WHERE (cod_producto_barra = '$cod_producto_barra')");
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    } elseif ($btn_enviar == 'btn_Reservar') {
        $cod_estado_habitacion_hotel = 2;

        $sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
        fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
        nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_estado_habitacion_hotel, 
        cod_tipo_habitacion_hotel, fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin) 
        VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
        '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
        '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_estado_habitacion_hotel', 
        '$cod_tipo_habitacion_hotel', '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin')";
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

        $sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_venta_producto_temporal, cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
        precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
        precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
        fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
        cod_administrador, cod_tipo_cobrar, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
        precio_venta_producto_orig, cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, 
        cod_check_imp, unidad_medida_peso, cod_estado_componente_und_venta, cod_origen_produccion, cod_estado_cava, iva_ptj, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, 
        fecha_ymd_parqueo_ini, fecha_ymd_parqueo_fin, cod_estado_tipo_hotel_parqueo) 
        VALUES ('$cod_venta_producto_temporal', '$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
        '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
        '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
        '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
        '$cod_administrador', '$cod_tipo_cobrar', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
        '$precio_venta_producto_orig', '$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', 
        '$cod_check_imp', '$unidad_medida_peso', '$cod_estado_componente_und_venta', '$cod_origen_produccion', '$cod_estado_cava', '$iva_ptj', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', 
        '$fecha_ymd_parqueo_ini', '$fecha_ymd_parqueo_fin', '$cod_estado_tipo_hotel_parqueo')";
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

        $sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel', cod_info_factura_venta = '$cod_info_factura_venta', 
        cod_venta_producto_temporal = '$cod_venta_producto_temporal' WHERE (cod_producto_barra = '$cod_producto_barra')");
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar)); 
    } elseif ($btn_enviar == 'btn_Limpiar') {
        $cod_estado_habitacion_hotel = 3;

        $sql_data = "INSERT INTO tbl15_limpieza_hotel (cod_limpieza_hotel, fecha_limpieza_hotel_ini, hora_limpieza_hotel_ini, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, fecha_hora_reg, 
            cod_administrador, cuenta) 
        VALUES ('$cod_limpieza_hotel', '$fecha_limpieza_hotel_ini', '$hora_limpieza_hotel_ini', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', '$fecha_hora_reg', 
            '$cod_administrador', '$cuenta')";
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

        $sql_data = sprintf("UPDATE tbl15_producto SET cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel', cod_limpieza_hotel = '$cod_limpieza_hotel' 
            WHERE (cod_producto_barra = '$cod_producto_barra')");
        $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar)); 
    } elseif ($btn_enviar == 'btn_Cancelar') { ?>
        <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
    <?php
    } else { ?>
        <META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
    <?php
    }
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
<!-- ******************************************************************************************************************************* -->
<!-- ******************************************************************************************************************************* -->
        <?php include_once('../admin/04_modulo_footer_aplicacion_hotel.php'); ?>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_aplicacion_hotel.php'); ?>
</body>
</html>
