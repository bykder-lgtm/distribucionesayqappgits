<?php 
$nombre_pagina = "Gestión de Solicitudes";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_inicio_sesion_adm_revisor.php"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_info_empresa_adm_revisor.php"; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- **************************************************** MODULO DE PLANTILLAS META ******************************************** -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<?php include "../admin/02_admin_modulo_estilo_css_adm_revisor.php"; ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<title><?php echo $nombre_pagina." | ".$nombre ?> </title>
    </head>
    <body class="nav-md">
<?php
$cod_seguridad                         = '27'; //REVISOR 
$nombre_tipo_tercero_text              = ucfirst(strtolower('REVISOR'));
$buscar_por                            = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura                 = "ABIERTA";

if (isset($_GET['desplegar_modal_id'])) { $desplegar_modal_id = addslashes($_GET['desplegar_modal_id']); } else { $desplegar_modal_id = ''; }
if (isset($_GET['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
?>
<!-- **************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
<?php include "../admin/03_admin_modulo_menu_navegacion_adm_revisor.php"; ?>
<!-- 1**************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Form search -->
                        <form class="form-horizontal" role="form" id="ingresos">
                                <div class="col-md-1">
                                    <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="150">150</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                        <option value="9999999" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="buscar_por" onchange='load(1);'>
                                        <option value="nombre1_tercero_identificacion_tercero" selected>Nombre / Cédula / Entidad</option>
                                        <option value="nombre1_tercero">Nombre</option>
                                        <option value="identificacion_tercero">Cédula</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar por nombre, cédula o entidad..." onkeyup='load(1);'>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search"></span> Buscar
                                    </button>
                                    <span id="loader"></span>
                                </div>
                                <input type="hidden" id="cod_administrador" value="<?php echo $cod_administrador ?>">
                                <input type="hidden" id="cod_seguridad" value="<?php echo $cod_seguridad ?>">
                                <input type="hidden" id="tabla" value="tbl15_tercero">
                        </form>
                        <!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
<?php include "../admin/04_admin_modulo_footer_adm_revisor.php"; ?>
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
            </div>
        </div>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include "../admin/05_admin_modulo_js_adm_revisor.php"; ?>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!--<script src="../js/ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<!--<script src="../js/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>-->
    </body>
</html>
<!-- ****************************************************************************************************** -->
<script>
$(document).ready(function(){ 
    load(1); 
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    var nombre_estado_factura = "<?php echo $nombre_estado_factura ?>";
    var pagina = "<?php echo $pagina_local ?>";

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/tabla_busqueda_paginacion_info_factura_venta_cerrada_revisor_diseno_vertical_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>

