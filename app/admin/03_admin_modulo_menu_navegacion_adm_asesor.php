        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;"><a href="#" class="site_title"><!--<i class="fa fa-ticket"></i>--><img src="<?php echo $url_img_orig_tienda;?>" style="height: 70px" alt="Logo"></i> <!--<span>DentaClic</span>--></a></div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                        <img src="<?php echo $url_img_foto_prof_min_usuario;?>" alt="<?php echo $nombres_usuario;?>" class="img-circle profile_img">
                                    </div>
                                    <div class="profile_info"><span>Bienvenido,</span><h2><?php echo $nombres_usuario.' '.$apellidos_usuario;?></h2></div>
                                </div>
                            <!-- /menu profile quick info -->

                        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
<!--
<li class="dropdown active"><a href="#" class="dropdown-toggle"><i class="fa fa-ticket"></i> Pacientes<b class="caret"></b></a>
<ul class="dropdown-menu">
<li class=""><a href="../admin/odontograma.php"><i class="fa fa-area-chart"></i> Reg Pacientes</a></li>
<li class=""><a href="../admin/odontograma.php"><i class="fa fa-child"></i> Edit Pacientes</a></li>
</ul>
</li>
-->
<li class=""><a href="../admin/lista_info_factura_venta_asesor_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Creditos</a></li>
<li class=""><a href="../admin/lista_aliado_asesor_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Aliados</a></li>
<li class=""><a href="../admin/lista_tienda_asesor_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Tiendas</a></li>
<li class=""><a href="../admin/lista_producto_asesor_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Productos</a></li>
<li class=""><a href="../admin/lista_usuario_archivado.php"><i class="fa fa-box-archive"></i> Usuarios Archivados</a></li>

<!--
<li class=""><a href="../admin/lista_banner_slider.php"><i class="fa fa-ticket"></i> Banner Slider</a></li>
<li class=""><a href="../admin/lista_categoria.php"><i class="fa fa-ticket"></i> Categorias</a></li>
<li class=""><a href="../admin/lista_cotizar_producto.php"><i class="fa fa-ticket"></i> Cotizacion</a></li>
<li class=""><a href="../admin/lista_galeria_video.php"><i class="fa fa-ticket"></i> Galeria de Videos</a></li>
<li class=""><a href="../admin/lista_paciente.php"><i class="fa fa-list-alt"></i> Mascotas</a></li>
<li class=""><a href="../admin/lista_recurso.php"><i class="fa fa-ticket"></i> Recursos</a></li>
<li class=""><a href="../admin/lista_campanya.php"><i class="fa fa-ticket"></i> Campañas</a></li>
<li class=""><a href="../admin/lista_visita.php"><i class="fa fa-binoculars"></i> Visitas</a></li>
<li class=""><a href="../admin/lista_estadistica.php"><i class="fa fa-pie-chart"></i> Estadisticas</a></li>
<li class=""><a href="../admin/lista_nuestro_equipo.php"><i class="fa fa-users"></i> Nuestro Equipo</a></li>
<li class=""><a href="../admin/lista_info_empresa.php"><i class="fa fa-list-alt"></i> Info Empresa</a></li>
-->
                </ul>
            </div>
        </div><!-- /sidebar menu -->

    </div>
</div> 
     
    <div class="top_nav"><!-- top navigation -->
        <div class="nav_menu">

            <nav>
                <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $url_img_foto_prof_min_usuario;?>" alt=""><?php echo $nombres_usuario.' '.$apellidos_usuario;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <!--<li><a href="../admin/usuario.php"><i class="fa fa-user"></i> Mi cuenta</a></li>-->
                            <li><a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div><!-- /top navigation -->    