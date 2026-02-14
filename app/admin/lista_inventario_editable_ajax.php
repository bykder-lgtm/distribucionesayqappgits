<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min.css" type="text/css" />
<script src="../js/jquery.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
    $(elemento).className = 'inputon';
    last = valor;
}
function Blur(elemento, valor, campo, id) {
    $(elemento).className = 'inputoff';
    if (last != valor) {
        myajax.Link('inventario_masivo_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
    }
}
</script>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="../admin/lista_inventario_editable_buscador_ajax.php"><h6>Inventario Busqueda Multiple</h6></a>
<a class="btn btn-primary" href="../admin/lista_inventario_editable_buscar_ajax.php"><h6>Inventario Masivo</h6></a>
<?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_activo_visitante_ext_ajax.php"><h6>Inventario Masivo Estado</h6></a>
<?php } ?>
<?php if ($cod_estado_origen_produccion_global == '1') { ?>
<a class="btn btn-primary" href="../admin/lista_inventario_masivo_editable_origen_produccion_ajax.php"><h6>Inventario Masivo Origen Produccion</h6></a>
<?php } ?>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<?php
$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto WHERE (cod_producto >= '0') AND (und_producto > '0')";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$total_codigos                           = $datos_conteo_atendido_mujer['total_codigos'];
$total_compra_producto                   = $datos_conteo_atendido_mujer['total_compra_producto'];
$total_venta_producto                    = $datos_conteo_atendido_mujer['total_venta_producto'];
$total_compra_producto_bodega            = $datos_conteo_atendido_mujer['total_compra_producto_bodega'];
$total_venta_producto_bodega             = $datos_conteo_atendido_mujer['total_venta_producto_bodega'];

$total_ganacia_invenario                 = $total_venta_producto - $total_compra_producto;
$total_ganacia_invenario_ptj             = ($total_compra_producto / $total_venta_producto) * 100;

$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Y-m-d");
$hora_venta_his                          = date("H:i:s");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$pagina                                  = $_SERVER['PHP_SELF'];
?>
<table class="table table-striped">
    <tr>
        <th style="text-align:center">Total Codigos</th>
        <th style="text-align:center">Total Inv Precio Compra</th>
        <th style="text-align:center">Total Inv Precio Venta</th>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center">Total Inv Precio Compra Bodega</th><th style="text-align:center">Total Inv Precio Venta Bodega</th><?php } ?>
        <?php if ($cod_estado_diferencia_ganancia_inventario_global == '1') { ?><th style="text-align:center">Ganancia $</th><?php } ?>
        <?php if ($cod_estado_diferencia_ganancia_inventario_ptj_promedio_global == '1') { ?><th style="text-align:center">Ganancia % Promedio</th><?php } ?>
    </tr>
    <tr>
        <th style="text-align:center"><?php echo number_format($total_codigos, 0, ",", ".") ?></th>
        <th style="text-align:center"><?php echo number_format($total_compra_producto, 0, ",", ".") ?></th>
        <th style="text-align:center"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></th>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
        <th style="text-align:center"><?php echo number_format($total_compra_producto_bodega, 0, ",", ".") ?></th>
        <th style="text-align:center"><?php echo number_format($total_venta_producto_bodega, 0, ",", ".") ?></th>
        <?php } ?>
        <?php if ($cod_estado_diferencia_ganancia_inventario_global == '1') { ?>
        <th style="text-align:center"><?php echo number_format($total_ganacia_invenario, 0, ",", ".") ?></th>
        <?php } ?>
        <?php if ($cod_estado_diferencia_ganancia_inventario_ptj_promedio_global == '1') { ?>
        <th style="text-align:center"><?php echo number_format($total_ganacia_invenario_ptj, 0, ",", ".") ?>%</th>
        <?php } ?>
    </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
            <input type="text" id="busqueda" name="busqueda" onkeyup="leer_registros()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
        </tr>
    </tbody>
</table>

<div class="AAAA">
    <div class="right_col" role="main"> <!-- page content -->
        <div class="DDDD">
            <div id="cargar_datos_ajax"></div><!-- los registros se cargarán aquí -->
            <div id="cargador_scroll"></div>
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
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/custom.min.js"></script>


<script>
$(document).ready(function(){
    leer_registros(); /* it will load products when document loads */
});
//------------------------------------------------------------------------------------------------------------------//
function leer_registros(){

    var limite_inicial = 0;
    var limite_final = 10;
    var action = 'inactive';
    var cantidad_reg_por_pagina = 50;
    var paginador_actual = 0;
    var buscar_por = document.getElementById('buscar_por').value;
    var busqueda = document.getElementById('busqueda').value;
    //var buscar_por = $("#buscar_por").val();
    //var busqueda = $("#busqueda").val();

    function cargar_datos_encontrados(limite_inicial, limite_final) {
        paginador_actual = paginador_actual + 1;
        $.ajax({
            url:"../admin/leer_datos_inventario_editable_scroll_sweetalert.php",
            method:"POST",
            data:{ cantidad_reg_por_pagina:cantidad_reg_por_pagina, paginador_actual:paginador_actual, buscar_por:buscar_por, busqueda:busqueda },
            cache:false,
            success:function(respuesta) {
                $('#cargar_datos_ajax').append(respuesta);
                if(respuesta == '') {
                    //$('#cargador_scroll').html("<button type='button' class='btn btn-info'>Datos no encontrados</button>");
                    action = 'active';
                }
                else {
                    //$('#cargador_scroll').html("<button type='button' class='btn btn-warning'>Cargando....</button>");
                    action = "inactive";
                }
            }
        });
    }
    if(action == 'inactive') {
        action = 'active';
        cargar_datos_encontrados(limite_inicial, limite_final);
    }
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#cargar_datos_ajax").height() && action == 'inactive') {
            action = 'active';
            limite_inicial = limite_inicial + limite_final;
            setTimeout(function(){
                cargar_datos_encontrados(limite_inicial, limite_final);
            }, 100);
        }
    });

    if (busqueda == '') { 
        $('#cargar_datos_ajax').html(""); 
    } else {
        $('#cargar_datos_ajax').load('../admin/leer_datos_inventario_editable_scroll_sweetalert.php?cantidad_reg_por_pagina='+cantidad_reg_por_pagina+'&paginador_actual='+paginador_actual+'&buscar_por='+buscar_por+'&busqueda='+busqueda);  
    }
}
</script>

</body>
</html>