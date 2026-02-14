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
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<!--<a class="btn btn-primary" href="#"><h6>Lista Cotizaciones</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Cotizaciones de Venta</font></a></th>
        <?php if ($cod_estado_cotizacion_venta_registrar == '1') { ?>
        <th style="text-align:right"><a href="../admin/facturacion_cotizacion_venta_temporal_producto_manual_pos.php"><font size='+2'>Cotizar Venta</font></a></th>
        <?php } ?>
    </tr>
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
    leer_registros(); /* it will load products when document loads */
});
//------------------------------------------------------------------------------------------------------------------//
function leer_registros(){

    var limite_inicial = 0;
    var limite_final = 10;
    var action = 'inactive';
    var cantidad_reg_por_pagina = 50;
    var paginador_actual = 0;
    var buscar_por = "";
    var busqueda = "";
    //var buscar_por = document.getElementById('buscar_por').value;
    //var busqueda = document.getElementById('busqueda').value;
    //var buscar_por = $("#buscar_por").val();
    //var busqueda = $("#busqueda").val();

    function cargar_datos_encontrados(limite_inicial, limite_final) {
        paginador_actual = paginador_actual + 1;
        $.ajax({
            url:"../admin/leer_datos_info_factura_cotizacion_venta_scroll_sweetalert.php",
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
        $('#cargar_datos_ajax').load('../admin/leer_datos_info_factura_cotizacion_venta_scroll_sweetalert.php?cantidad_reg_por_pagina='+cantidad_reg_por_pagina+'&paginador_actual='+paginador_actual+'&buscar_por='+buscar_por+'&busqueda='+busqueda);  
    }
}
</script>