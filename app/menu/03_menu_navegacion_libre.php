<?php $serguridad_pagina = 1; ?>
﻿<div id="decorative2">
<div class="container">
<div class="divPanel topArea notop nobottom">
<div class="row-fluid">
<div class="span12">

<div id="divLogo" class="pull-left">
<?php if ($tipo_dispositivo_encontrado == 'PC') { ?>
<a href="#" id="divSiteTitle"><img src="<?php echo $img_cabecera_emp; ?>" alt="logo"></a>
<?php } ?>
<!--<a href="#" id="divSiteTitle"><?php echo $nombre_emp;?></a><br /><a href="#" id="divTagLine"><?php echo $eslogan_emp;?></a>-->
</div>

<div id="divMenuRight" class="pull-right">
<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">MENU <span class="icon-chevron-down icon-white"></span></button>
<div class="nav-collapse collapse">
<ul class="nav nav-pills ddmenu">
<?php if ($cod_estado_consultar_precios_extern_global  == '1') { ?>
<li class="dropdown"><a href="../admin/index_consultar_precios_extern.php">Consultar Precios</a></li>
<?php } ?>
<!--
<li class="dropdown"><a href="../admin/tbl15_vision.php">Visión</a></li>
<li class="dropdown"><a href="../admin/tbl15_portafolio_servicio.php">Servicios</a></li>
<li class="dropdown"><a href="../admin/eventos.php">Eventos</a></li>
<li class="dropdown"><a href="../admin/index.php">Entrar</a></li>
-->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>