﻿<div id="decorative2">
<div class="container">
<div class="divPanel topArea notop nobottom">
<div class="row-fluid">
<div class="span12">

<div id="divLogo" class="pull-left">
<?php if ($tipo_dispositivo_encontrado == 'PC') { ?>
<a href="../admin/lista_menu_tableta_capacitiva.php" id="divSiteTitle"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></a>
<?php } ?>
</div>

<div id="divMenuRight" class="pull-right">

<?php //if ($tipo_dispositivo == 'PC') { include_once("../admin/notificacion_publicidad_alerta.php"); } else { } ?>

<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">MENU <span class="icon-chevron-down icon-white"></span></button>
    <div class="nav-collapse collapse">
        <ul class="nav nav-pills ddmenu">
            <li class="dropdown"><a href="../admin/lista_producto.php">Productos</a></li>
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!--
            <li class="dropdown active"><a href="#" class="dropdown-toggle">Integrantes<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=20&nombre_tipo_tercero=LIDER">Lider</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=21&nombre_tipo_tercero=COORDINADOR">Coordinador</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=22&nombre_tipo_tercero=ASESOR">Asesor</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=2&nombre_tipo_tercero=VENDEDOR">Vendedor</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=23&nombre_tipo_tercero=ALIADO_ESTRATEGICO">Aliado Estrategico</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php?cod_seguridad=25&nombre_tipo_tercero=CLIENTE">Cliente</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_entidad_crediticia.php">Entidad</a></li>
                </ul>
            </li>
            -->
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <!--
            <li class="dropdown active"><a href="#" class="dropdown-toggle">Pagina<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown"><a href="../admin/lista_info_empresa_siscredito.php">Info Empresa</a></li>
                    <?php if ($cod_estado_modulo_producto_global == '1') { ?><li class="dropdown"><a href="../admin/lista_producto.php">Catalogo</a></li><?php } ?>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php">Servicios</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php">Lineas de Credito</a></li>
                    <li class="dropdown"><a href="../admin/lista_siscredito_tercero.php">Contactanos</a></li>
                    <li class="dropdown"><a href="../admin/lista_slider_productos_destacados_siscredito.php">Slider Inicio (Productos Destacados)</a></li>
                    <li class="dropdown"><a href="../admin/lista_slider_principal_nosotros_siscredito.php">Slider Nosotros (Slider)</a></li>
                </ul>
            </li>
            -->
            <li class="dropdown"><a href="../admin/reporte_venta_fechas_simple.php">Reporte Ventas</a></li>
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <li class="dropdown active"><a href="#" class="dropdown-toggle">Admin<b class="caret"></b></a>
                <ul class="dropdown-menu">
                <?php if ($cod_estado_info_empresa == '1') { ?><li><a href="../admin/lista_info_empresa.php">Info Empresa</a></li><?php } ?>
                <?php if ($cod_estado_usuario_global == '1') { ?><li><a href="../admin/lista_usuario.php">Usuarios</a></li><?php } ?>
                <?php if ($cod_estado_tienda_global == '1') { ?><li><a href="../admin/lista_tienda.php">Tienda</a></li><?php } ?>
                <li><a href="../admin/lista_operador_credito.php">Operador Credito</a></li>
                </ul>
            </li>
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <li class="dropdown"><a href="../session/salir_siscredito.php?token=<?php echo $token ?>">Salir</a></li>
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </ul>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="breadcrumbs"><a href="#"><h6>HOLA <?php echo $nombres_des.' '.$apellidos_des; ?></a></h6></div>