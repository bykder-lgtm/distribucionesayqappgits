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

<div class="breadcrumbs"><a href="../admin/menu_eliminar.php"><h4>Eliminar Paciente</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
$tab = 'tbl15_cliente';
$tipo = 'eliminar';
$campo = 'cod_cliente';
?>
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-1">
            Mostrar:
            <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                <option value="800">800</option>
                <option value="1000">1000</option>
                <option value="2000">2000</option>
                <option value="10000">10000</option>
                <option value="100000">100000</option>
            </select>
        </div>
        <div class="col-md-2">
            Buscar por:
            <select class="form-control" id="buscar_por" onchange='load(1);'>
                <option value="nombres_apellidos">Nombre Paciente</option>
                <option value="cedula">Documento</option>
                <option value="cod_cliente">Codigo Paciente</option>
            </select>
        </div>
        <div class="col-md-3">
            Buscar:
            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'>
        </div>
        <div class="col-md-1">.
            <button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
            <input type="hidden" id="tabla_codifcryp" Value="<?php echo $tabla_codifcryp; ?>">
            <input type="hidden" id="pagina_codifcryp" Value="<?php echo $pagina_codifcryp; ?>">
        </div>
</form>
<!-- end Form search -->

<div class="x_content">
    <div class="table-responsive">
        <!-- ajax -->
            <div id="salida_informacion_actualizada_eliminada"></div><!-- Carga los datos ajax -->
            <div class='salida_informacion_actualizada'></div><!-- Carga los datos ajax -->
        <!-- /ajax -->
    </div>
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

<script type="text/javascript" src="../ajax/busqueda_paginacion_paciente_ajax.js"></script>
