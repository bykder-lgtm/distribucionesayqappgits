<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script src="js/jquery.js" type="text/javascript"></script> 
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
$nombre_tipo_resolucion_facturacion    = 'FACTURA_COMPRA';

if (isset($_GET['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_GET['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_compra_iva_inc_temporal_producto_manual_pos.php'; }

?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="../admin/lista_info_factura_compra_externa_copidrogas_abierta_temporal.php"><font size='+2'>Cargar Factura Compra Manual Interna</font></a></th>
    </tr>
</table>

<div class="table-responsive">

<form action="cargar_factura_factura_compra_manual_interna_reg.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center">PROVEEDOR</th>
                <th style="text-align:center">RESOLUCION</th>
                <th style="text-align:center"></th>
            </tr>
            <tr>
                <td style="text-align:left">
                    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
                        <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                        $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                        FROM tbl15_tercero WHERE (nombre_tipo_tercero='PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['cod_tercero'];
                        $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                    <a href="#" id="aaaa">.........</a>
                    <a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a>
                </td>
                <td style="text-align:center">
                    <select name="cod_resolucion_facturacion" id="cod_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;" required>
                        <?php if (isset($cod_resolucion_facturacion)) { echo ""; } else { echo ""; }
                        $consulta2_sql = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '2') AND (nombre_tipo_estado = 'ACTIVO')";
                        $consulta2 = mysqli_query($conectar, $consulta2_sql);
                        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        if(isset($cod_resolucion_facturacion) AND $cod_resolucion_facturacion == $datos2['cod_resolucion_facturacion']) {
                        $seleccionado = "selected"; } else { $seleccionado = ""; }
                        $codigo = $datos2['cod_resolucion_facturacion'];
                        $nombre = $datos2['nombre_tipo_resolucion_facturacion'].' | '.$datos2['numero_resolucion_facturacion'].' | '.$datos2['prefijo_resolucion_facturacion'].' | '.$datos2['cod_resolucion_facturacion'];
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                    </select>
                </td>
                <td style="text-align:center"><input type="submit" value="Crear Factura de Compra" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
            </tr>

            <input type="hidden" name="cod_tipo_origen_factura_compra" value="<?php echo $cod_tipo_origen_factura_compra ?>"/>
            <input type="hidden" name="nombre_tipo_cargue_factura" value="<?php echo $nombre_tipo_cargue_factura ?>"/>
            <input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
            </tr>
        </thead>
    </table>
</form>
<?php include_once("../admin/modal_registrar_tercero_factura_compra_manual_interna.php"); ?>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>