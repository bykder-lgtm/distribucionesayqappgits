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
<div class="breadcrumbs">
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                          = $_SERVER['PHP_SELF'];
$tab                                   = 'tbl15_informe_condiciones_salud';
$tipo                                  = 'eliminar';
$campo                                 = 'cod_informe_condiciones_salud';
$fecha                                 = date("Y/m/d");
$origen                                = 'PARACLINICOS';
$cod_tipo_origen_factura_compra        = '1';
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'lista_inventario_masivo_html.php'; }
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="#"><font size='+2'>Importar Archivo Plano Productos Inventario</font></a></th>
    </tr>
</table>

<div class="table-responsive">

<form action="../admin/importar_productos_inventario_campos_punto_y_coma_csv_reg.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table class="table table-striped">
        <thead>
            <tr>
            <th style="text-align:center">Selecionar archivo: <input name="csv" type="file" required autofocus/></th>
            <th style="text-align:left"><input type="submit" name="Submit" class="btn hvr-hover nav-item active jumbotron" value="AGREGAR" /></th>
            <input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
            </tr>
        </thead>
    </table>
</form>

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