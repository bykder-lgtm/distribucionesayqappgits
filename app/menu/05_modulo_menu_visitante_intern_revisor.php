    <?php 
    $sql_tienda_compartir = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta_tienda_compartir = mysqli_query($conectar, $sql_tienda_compartir) or die(mysqli_error($conectar));
    $datos_tienda_compartir = mysqli_fetch_assoc($consulta_tienda_compartir);

    $abrev_tienda                          = $datos_tienda_compartir['abrev_tienda'];

    $pagina_compartir_catalogo = 'https://distribucionesayq.com/app/admin/ver_catalogo_producto_visitante_extnosesion.php?abrev_tienda='.$abrev_tienda; 
    ?>
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-morado_oscuro navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" style="color:white"></i></button>
                    <a class="navbar-brand" href="../admin/ver_producto_visitante_intern_simulador_credito.php"><img src="../imagenes/logo.png" class="logo" alt=""><span id="nombre_usuario_login_menu"><?php echo trim($nombres_usuar.' '.$apellidos_usuar) ?></span></a>
                </div>
                <!-- End Header Navigation -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_info_factura_venta_abierta_siscredito_visitante_intern_revisor.php">Transacciones Abiertas</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_info_factura_venta_cerrada_siscredito_visitante_intern_revisor.php">Transacciones Cerradas</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php" target="_blank">Modelo Gets</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/lista_producto_adm_tick.php" target="_blank">Admin 1</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/index.php" target="_blank">Admin 2</a></li>
                            <li class="nav-item"><a class="nav-link" href="../admin/cambiar_contrasena_revisor_movil.php">Cambiar Contraseña</a></li>
                            <li class="nav-item"><a class="nav-link" href="../session/salir_visitante_intern.php?token=<?php echo $token ?>&pagina_salir=<?php echo $pagina_salir_visitante ?>">Salir</a></li>
                        </ul>
                    </ul>
                </div>

            </div>
        </nav>
        <!-- End Navigation -->
    </header>