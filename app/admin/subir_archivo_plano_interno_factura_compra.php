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
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_compra_iva_inc_temporal_producto_manual_pos.php'; }
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="../admin/lista_info_factura_compra_externa_copidrogas_abierta_temporal.php"><font size='+2'>Cargar Factura Compra Interna (Archivo Plano)</font></a></th>
    </tr>
</table>

<div class="table-responsive">

<form action="subir_archivo_plano_interno_factura_compra_reg.php" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <table class="table table-striped">
        <thead>
            <tr>
            <th style="text-align:left;">Proveedor:
                <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
                    <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
                    } else { echo  "<option value='' selected ></option>"; }
                    $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
                    FROM tbl15_tercero WHERE (nombre_tipo_tercero='PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['cod_tercero'];
                    $nombre = $datos2['nombre1_tercero'].' - '.$datos2['identificacion_tercero'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </th> 
            <th style="text-align:left">Selecionar archivo: <input name="csv" type="file" required autofocus/></th>
            <th style="text-align:left"><input type="submit" value="Crear Factura de Compra" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></th>
            <input type="hidden" name="cod_tipo_origen_factura_compra" value="<?php echo $cod_tipo_origen_factura_compra ?>"/>
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