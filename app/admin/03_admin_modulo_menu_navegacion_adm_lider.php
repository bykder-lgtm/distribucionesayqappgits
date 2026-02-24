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
<li class=""><a href="../admin/lista_info_factura_venta_lider_diseno_vertical.php"><i class="fa fa-list-alt"></i> Lista de Creditos</a></li>
<li class=""><a href="../admin/lista_coordinador_lider_movil.php"><i class="fa fa-users-gear"></i> Lista de Coordinadores</a></li>
<li class=""><a href="../admin/lista_aliado_lider_diseno_vertical.php"><i class="fa fa-users"></i> Lista de Aliados</a></li>
<li class=""><a href="../admin/lista_tienda_lider_diseno_vertical.php"><i class="fa fa-store"></i> Lista de Tiendas</a></li>
<li class=""><a href="../admin/lista_producto_lider_diseno_vertical.php"><i class="fa fa-boxes-stacked"></i> Lista de Productos</a></li>
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
                            <li><a href="../session/salir_visitante_intern.php?token=<?php echo $token ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar SesiÃ³n</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div><!-- /top navigation -->    