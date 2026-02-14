<?php 
$nombre_pagina                            = "Lista de Habitaciones";
$pagina_local                             = $_SERVER['PHP_SELF'];
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

<?php if (isset($_GET['cod_estado_habitacion_hotel'])) { $cod_estado_habitacion_hotel = intval($_GET['cod_estado_habitacion_hotel']); $condicional_estado_habitacion_hotel = " AND (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel')"; } else { $condicional_estado_habitacion_hotel = ""; }
?>
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


                            <div class="m-n2">

                                <div class="col-sm-12 col-xl-12">
                                    <div class="bg-secondary rounded h-100 p-4">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item bg-transparent">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">Ver Estado de las Habitaciones</button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body" style="text-align: center;">
                            <?php
                            $total_reg = 0;

                            $sql_habitaciones_hotel_grupo = "SELECT cod_estado_habitacion_hotel, nombre_estado_habitacion_hotel, estilo_estado_habitacion_hotel FROM tbl15_estado_habitacion_hotel 
                            WHERE (cod_estado = '1') ORDER BY cod_estado_habitacion_hotel";
                            $consulta_habitaciones_hotel_grupo = mysqli_query($conectar, $sql_habitaciones_hotel_grupo);
                            while ($datos_habitaciones_hotel_grupo = mysqli_fetch_assoc($consulta_habitaciones_hotel_grupo)) {

                                $cod_estado_habitacion_hotel                                   = $datos_habitaciones_hotel_grupo['cod_estado_habitacion_hotel'];
                                $nombre_estado_habitacion_hotel                                = $datos_habitaciones_hotel_grupo['nombre_estado_habitacion_hotel'];
                                $estilo_estado_habitacion_hotel                                = $datos_habitaciones_hotel_grupo['estilo_estado_habitacion_hotel'];

                                $sql_habitaciones_hotel_sum = "SELECT count(*) AS total_reg_sum FROM tbl15_producto WHERE (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel') AND (nombre_tipo_producto = 'HABITACION')";
                                $consulta_habitaciones_hotel_sum = mysqli_query($conectar, $sql_habitaciones_hotel_sum);
                                $datos_habitaciones_hotel_sum = mysqli_fetch_assoc($consulta_habitaciones_hotel_sum);

                                $total_reg_sum                                                 = $datos_habitaciones_hotel_sum['total_reg_sum'];
                                $total_reg                                                    += $total_reg_sum;
                            ?>
                                                        <a href="../admin/lista_hospedaje_virtual_hotel.php?cod_estado_habitacion_hotel=<?php echo $cod_estado_habitacion_hotel ?>">
                                                            <div class="<?php echo $estilo_estado_habitacion_hotel ?>" style="width:150px; height:70px;">
                                                                <button type="button" class="btn-outline-dark" style="width:50px;"><?php echo $total_reg_sum ?></button>
                                                                <br>
                                                                <?php echo $nombre_estado_habitacion_hotel ?>
                                                            </div>
                                                        </a>
                            <?php } ?>
                                                        <a href="../admin/lista_hospedaje_virtual_hotel.php">
                                                            <div class="btn btn-link m-2" style="width:150px; height:70px;">
                                                                <button type="button" class="btn-outline-dark" style="width:50px;"><?php echo $total_reg ?></button>
                                                                <br>
                                                                Total
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            $sql_habitaciones_hotel = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, cod_venta_producto_temporal, cod_info_factura_venta 
                            FROM tbl15_producto WHERE (nombre_tipo_producto = 'HABITACION') $condicional_estado_habitacion_hotel ORDER BY cod_producto ASC";
                            $consulta_habitaciones_hotel = mysqli_query($conectar, $sql_habitaciones_hotel);
                            $total_reg = mysqli_num_rows($consulta_habitaciones_hotel);
                            while ($datos_habitaciones_hotel = mysqli_fetch_assoc($consulta_habitaciones_hotel)) {

                                $cod_producto                                = $datos_habitaciones_hotel['cod_producto'];
                                $cod_producto_barra                          = $datos_habitaciones_hotel['cod_producto_barra'];
                                $nombre_producto                             = $datos_habitaciones_hotel['nombre_producto'];
                                $cod_venta_producto_temporal                 = $datos_habitaciones_hotel['cod_venta_producto_temporal'];
                                $cod_estado_habitacion_hotel                 = $datos_habitaciones_hotel['cod_estado_habitacion_hotel'];
                                $cod_tipo_habitacion_hotel                   = $datos_habitaciones_hotel['cod_tipo_habitacion_hotel'];
                                $cod_info_factura_venta                      = $datos_habitaciones_hotel['cod_info_factura_venta'];
/***************************************************************************************************************************************************/
                                $sql_estado_habitacion_hotel = "SELECT cod_estado_habitacion_hotel, nombre_estado_habitacion_hotel, estilo_estado_habitacion_hotel FROM tbl15_estado_habitacion_hotel 
                                WHERE (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel')";
                                $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
                                $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

                                $nombre_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['nombre_estado_habitacion_hotel'];
                                $estilo_estado_habitacion_hotel              = $datos_estado_habitacion_hotel['estilo_estado_habitacion_hotel'];
/***************************************************************************************************************************************************/
                                $sql_estado_habitacion_hotel = "SELECT cod_tipo_habitacion_hotel, nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel WHERE (cod_tipo_habitacion_hotel = '$cod_tipo_habitacion_hotel')";
                                $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel);
                                $datos_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

                                $nombre_tipo_habitacion_hotel                = $datos_estado_habitacion_hotel['nombre_tipo_habitacion_hotel'];

                                if ($cod_estado_habitacion_hotel == '0') { //LIBRE
                                    $url_redirect_accion = '../admin/reg_alquilar_habitacion_libre_hotel.php';
                                } elseif ($cod_estado_habitacion_hotel == '1') { //OCUPADO
                                    $url_redirect_accion = '../admin/habitacion_ocupada_hotel.php';
                                } elseif ($cod_estado_habitacion_hotel == '2') { //RESERVADO
                                    $url_redirect_accion = '../admin/habitacion_reservada_hotel.php';
                                } elseif ($cod_estado_habitacion_hotel == '3') { //LIMPIEZA
                                    $url_redirect_accion = '../admin/habitacion_limpieza_hotel.php';
                                } elseif ($cod_estado_habitacion_hotel == '4') { //MOMENTANEO
                                    $url_redirect_accion = '../admin/habitacion_momentanea_hotel.php';
                                } else { //IHABILITADO
                                    $url_redirect_accion = '../admin/habitacion_inhabilitada_hotel.php';
                                }
                            ?>
                            <a href="<?php echo $url_redirect_accion ?>?cod_producto_barra=<?php echo $cod_producto_barra ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&pagina=<?php echo $pagina_local ?>">
                                <div class="<?php echo $estilo_estado_habitacion_hotel ?>" style="width:150px; height:170px;">
                                    <button type="button" class="btn-outline-dark" style="width:50px;"><?php echo $cod_producto_barra ?></button>
                                    <br><br>
                                    <?php echo $nombre_tipo_habitacion_hotel ?>
                                    <br>
                                    <button type="button" class="btn btn-square btn-secondary m-2"><i class="fas fa-bed"></i></button>
                                    <br>
                                    <?php echo $nombre_estado_habitacion_hotel ?>
                                </div>
                            </a>
                            <?php } ?>
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
