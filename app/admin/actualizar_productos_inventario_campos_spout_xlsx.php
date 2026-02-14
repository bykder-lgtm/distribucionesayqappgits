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
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'lista_reg_actualizacion_tabla_sistema_inventario_masivo_html.php'; }
?>
<br>

<div class="table-responsive">

<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="#"><font size='+2'>Actualizar Productos Del Inventario Por Archivo de Excel</font></a></th>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="#"><font size='+2'>Escoger Campos a Actualizar</font></a></th>
    </tr>
</table>

<form action="../admin/actualizar_productos_inventario_campos_spout_xlsx_reg.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center">UND INVENTARIO</th>
                <th style="text-align:center">NOMBRE PRODUCTO</th>
                <th style="text-align:center">PRECIO COMPRA</th>
                <th style="text-align:center">PRECIO VENTA 1</th>
                <th style="text-align:center">PRECIO VENTA 2</th>
                <th style="text-align:center">PRECIO VENTA 3</th>
                <th style="text-align:center">PRECIO VENTA 4</th>
                <th style="text-align:center">PRECIO VENTA 5</th>
            </tr>
            <tr>
                <th style="text-align:center"><input type="checkbox" name="und_producto" value="und_producto"></th>
                <th style="text-align:center"><input type="checkbox" name="nombre_producto" value="nombre_producto"></th>
                <th style="text-align:center"><input type="checkbox" name="precio_compra_producto" value="precio_compra_producto"></th>
                <th style="text-align:center"><input type="checkbox" name="precio_venta_producto" value="precio_venta_producto" checked></th>
                <th style="text-align:center"><input type="checkbox" name="precio_venta_producto2" value="precio_venta_producto2"></th>
                <th style="text-align:center"><input type="checkbox" name="precio_venta_producto3" value="precio_venta_producto3"></th>
                <th style="text-align:center"><input type="checkbox" name="precio_venta_producto4" value="precio_venta_producto4"></th>
                <th style="text-align:center"><input type="checkbox" name="precio_venta_producto5" value="precio_venta_producto5"></th>
            </tr>
        </thead>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center">% IVA</th>
                <th style="text-align:center">% COMISION VENTA</th>
                <th style="text-align:center">DEPENDENCIA</th>
                <th style="text-align:center">PRESENTACION CAJA</th>
                <th style="text-align:center">PRESENTACION SOBRE</th>
            </tr>
            <tr>
                <th style="text-align:center"><input type="checkbox" name="iva_ptj" value="iva_ptj"></th>
                <th style="text-align:center"><input type="checkbox" name="comision_ptj" value="comision_ptj"></th>
                <th style="text-align:center"><input type="checkbox" name="cod_dependencia" value="cod_dependencia"></th>
                <th style="text-align:center"><input type="checkbox" name="cajas_sobre" value="cajas_sobre"></th>
                <th style="text-align:center"><input type="checkbox" name="und_sobre" value="und_sobre"></th>
            </tr>
        </thead>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
            <th style="text-align:center">Selecionar archivo: <input name="csv" type="file" required autofocus/></th>
            <input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
            </tr>
        </thead>
    </table>

<div class="actions">
<input type="submit" value="Actualizar Campos" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>

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