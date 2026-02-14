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
<!--<a class="btn btn-primary" href="../imagenes/tabla_comprativa_causacion_puc_movimiento_contable.jpg" target="_blank"><h6>Lista de Movimientos Contables</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$pagina                         = $_SERVER['PHP_SELF'];
$tab                            = 'tbl15_informe_condiciones_salud';
$tipo                           = 'eliminar';
$campo                          = 'cod_informe_condiciones_salud';
$fecha                          = date("Y/m/d");
$origen                         = 'PARACLINICOS';

$tab1                           = 'movimiento_contable_concepto';
$campo1                         = 'cod_movimiento_contable_concepto';
$tipo1                          = 'eliminar';
$tab2                           = 'movimiento_contable_codigo';
$campo2                         = 'cod_movimiento_contable_codigo';
$tipo2                          = 'eliminar';

$nombre_tab_mad1                = 'movimiento_contable';
$nombre_tab_mad2                = 'movimiento_contable';

$nombre_campo_key1              = 'cod_movimiento_contable';
$nombre_campo_key2              = 'cod_movimiento_contable';

$nombre_campo_calc1             = 'costo_movimiento_contable_concepto';
$nombre_campo_calc2             = 'costo_movimiento_contable_concepto';

$nombre_campo_update1           = 'nombres_clientes';
$nombre_campo_update2           = 'nombres_clientes';
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = 'nombre1_tercero'; }
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+1'>Lista de Movimiento Contable</font></a></th>
        <th style="text-align:center"><?php if ($cod_estado_modulo_contabilidad_global == '1') { ?><font size='+1'><a href="../admin/reporte_movimiento_contable.php">Reporte Movimiento Contable</a></font><?php } ?></th>
        <th style="text-align:right"><a href="../admin/reg_movimiento_contable_temporal.php"><font size='+1'>Registrar Movimiento Contable</font></a></th>
    </tr>
</table>

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
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '3' AND cod_estado = '1') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>

            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Nombre del Producto" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span></div>
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
        url:'../admin/busqueda_paginacion_movimiento_contable_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&tabla='+tabla,
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