<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<!--<a class="btn btn-success" href="#">Lista Compra</a>-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Compra</font></a> <a href="../admin/lista_info_factura_compra_eliminada.php"></a></th>
        <?php if ($cod_estado_facturacion_compra_registrar == '1') { ?><th style="text-align:right"><a href="../admin/lista_info_factura_compra_externa_copidrogas_abierta_temporal.php"><font size='+2'>Facturar Compra</font></a></th><?php } ?>
    </tr>
</table>

<?php 
$pagina = $_SERVER['PHP_SELF']; 
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'nombre1_tercero'; }
?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php //include_once("../modal/modal_registrar_producto.php"); ?>
<?php //include_once("../modal/modal_actualizar_producto.php"); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->              
<!-- Form search -->
<form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4">
            Mostrar:
            <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);' style="width: 80px;">
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
            Buscar por:
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="load(1)" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '2' AND cod_estado = '1') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>

            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Nombre del Registro" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span></div>
        <input type="hidden" id="tabla" Value="tbl15_producto">
</form>
<!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
    </div><!-- /page content -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>
</body>
</html>

<script>
$(document).ready(function(){
    load(1);
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var tabla = $("#tabla").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/busqueda_paginacion_info_factura_compra_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&tabla='+tabla,
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>