﻿
<div id="decorative2_cocina_bartender">
<div class="container">
<div class="divPanel topArea notop nobottom">
<div class="row-fluid">
<div class="span12">

<div id="divLogo" class="pull-left">
<?php if ($tipo_dispositivo_encontrado == 'PC') { ?><a href="#" id="divSiteTitle"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></a><?php } ?>
</div>

<div id="divMenuRight" class="pull-right">
<?php //if ($tipo_dispositivo == 'PC') { include_once("../admin/notificacion_publicidad_alerta.php"); } else { } ?>
<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">MENU <span class="icon-chevron-down icon-white"></span></button>
<div class="nav-collapse collapse">
<ul class="nav nav-pills ddmenu">
<?php if ($cod_estado_cocina_global == '1') { ?><li class="dropdown"><a href="../admin/lista_caja_virtual_cocina.php">Pedidos</a></li><?php } ?>
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
