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

<div class="breadcrumbs"><a href="#"><h4>Lista Desplegable</h4></a></div>
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
<tr><td align="center"><a href="../admin/lista_motivo_consulta.php"><h4>Motivo Consulta</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_grupo_area.php"><h4>Area a Laborar</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_grupo_area_cargo.php"><h4>Cargo a Laborar</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_cie10_edit_estado.php"><h4>Cie - 10</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_entidad.php"><h4>Eps</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_empresa_contratante.php"><h4>Empresa Contratante</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_empresa.php"><h4>Empresa a Laborar</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_escolaridad.php"><h4>Nivel Educativo</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_area_cargo_edit.php"><h4>Matriz de Riego Cargos</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_actividad_economica.php"><h4>Actividad Economica</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_estado_civil.php"><h4>Estado Civil</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_fondo_pension.php"><h4>Fondo de Pension</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_grupo_rh.php"><h4>Grupo RH</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_numero_hijos.php"><h4>Numero Hijos</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_raza.php"><h4>Raza</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_religion.php"><h4>Religion</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_sexo.php"><h4>Sexo</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_arl.php"><h4>Arl</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_tipo_regimen.php"><h4>Tipo Regimen</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_tipo_doc.php"><h4>Tipo Doc</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_tipo_profesional.php"><h4>Tipo de Profesional</h4></a></td></tr>
<tr><td align="center"><a href="../admin/lista_tipo_rol.php"><h4>Tipo de Roles</h4></a></td></tr>
<tr><td align="center"><a href="../admin/menu_lista_correciones.php"><h4>Correciones</h4></a></td></tr>
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