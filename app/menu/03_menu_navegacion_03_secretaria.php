﻿<div id="decorative2">
<div class="container">
<div class="divPanel topArea notop nobottom">
<div class="row-fluid">
<div class="span12">

<div id="divLogo" class="pull-left">
<?php if ($tipo_dispositivo_encontrado == 'PC') { ?>
<a href="#" id="divSiteTitle"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></a>
<?php } ?>
</div>

<div id="divMenuRight" class="pull-right">

<?php //if ($tipo_dispositivo == 'PC') { include_once("../admin/notificacion_publicidad_alerta.php"); } else { } ?>

<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">MENU <span class="icon-chevron-down icon-white"></span></button>
<div class="nav-collapse collapse">
<ul class="nav nav-pills ddmenu">

<li class="dropdown active"><a href="#" class="dropdown-toggle">Productos<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/reg_producto.php">Registrar</a></li>
<!--
<li><a href="../admin/lista_usuario.php">Cargar Factura</a></li>
<li><a href="../admin/menu_eliminar.php">Eliminar</a></li>
-->
</ul>
</li>

<li class="dropdown active"><a href="#" class="dropdown-toggle">Facturación<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/lista_info_factura_venta.php">Factura de Venta</a></li>
</ul>
</li>

<li class="dropdown active"><a href="#" class="dropdown-toggle">Venta Pos<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/facturacion_venta_temporal_producto_manual_pos.php">Manual</a></li>
<li><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php">Barras</a></li>
</ul>
</li>

<li class="dropdown"><a href="../admin/lista_tercero.php">Cliente</a></li>


<li class="dropdown active"><a href="#" class="dropdown-toggle">Reporte<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../admin/reporte_venta_fechas.php">Reporte Venta</a></li>
<li><a href="../admin/reporte_venta_fechas_productos.php">Reporte Venta Por Producto</a></li>
</ul>
</li>

<li class="dropdown active"><a href="#" class="dropdown-toggle">Admin<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="../licencia/licencia_gpl_espanol.pdf" target="_blank">Licencia Español</a></li>
<li><a href="../licencia/licencia_gpl_ingles.pdf" target="_blank">Licencia Ingles</a></li>
<li><a href="https://github.com/editaxe/Hlaboral" target="_blank">Repositorio</a></li>
</ul>
</li>
<li class="dropdown"><a href="../session/salir.php?token=<?php echo $token ?>">Salir</a></li>
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