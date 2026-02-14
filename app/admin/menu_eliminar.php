<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#"><h4>Eliminar</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr><td align="center"><a href="eliminar_lista_administrador.php"><h4>Usuarios</h4></a></td></tr>

<tr><td align="center"><a href="eliminar_lista_tercero.php"><h4>Terceros</h4></a></td></tr>

<tr><td align="center"><a href="lista_producto.php"><h4>Productos</h4></a></td></tr>

<tr><td align="center"><a href="menu_eliminar_venta.php"><h4>Ventas</h4></a></td></tr>

<!--
<tr><td align="center"><a href="eliminar_lista_empresa.php"><h4>Cliente</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_usuario.php"><h4>Usuarios</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_historia_clinica_individual.php"><h4>Historia Clinica</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_cita_individual.php"><h4>Citas</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_paciente.php"><h4>Paciente</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_raza.php"><h4>Raza</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_concepto_actitud_laboral.php"><h4>Aptitud Laboral</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_manipulacion_alimento.php"><h4>Manipulacion de Alimentos</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_trabajo_altura.php"><h4>Trabajo en Alturas</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_medicamento.php"><h4>Medicamento</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_sexo.php"><h4>Sexo</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_tipo_doc.php"><h4>Tipo Documento</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_entidad.php"><h4>Eps</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_laboratorio.php"><h4>Laboratorio</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_actividad_economica.php"><h4>Actividad Economica</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_ayuda_diagnostica.php"><h4>Ayuda Diagnostica</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_empresa_contratante.php"><h4>Empresa Contratante</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_grupo_area_cargo.php"><h4>Cargo a Laborar</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_escolaridad.php"><h4>Nivel Educativo</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_estado_civil.php"><h4>Estado Civil</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_fondo_pension.php"><h4>Fondo de Pension</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_grupo_rh.php"><h4>Grupo RH</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_numero_hijos.php"><h4>Numero Hijos</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_religion.php"><h4>Religion</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_arl.php"><h4>Arl</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_tipo_regimen.php"><h4>Tipo de Regimen</h4></a></td></tr>
<tr><td align="center"><a href="eliminar_lista_remision.php"><h4>Remisión</h4></a></td></tr>
-->
</thead>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>