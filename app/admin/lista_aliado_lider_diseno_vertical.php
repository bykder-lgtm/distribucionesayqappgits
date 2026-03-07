<?php 
$nombre_pagina = "Gestión de Solicitudes";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_inicio_sesion_adm_lider.php"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_info_empresa_adm_lider.php"; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- **************************************************** MODULO DE PLANTILLAS META ******************************************** -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<?php include "../admin/02_admin_modulo_estilo_css_adm_lider.php"; ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<title><?php echo $nombre_pagina." | ".$nombre ?> </title>
    </head>
    <body class="nav-md">
<?php
$cod_seguridad                       = '23'; //ALIADO 
$nombre_tipo_tercero_text            = ucfirst(strtolower('ALIADO'));
$buscar_por                          = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura               = "ABIERTA";

if (isset($_GET['desplegar_modal_id'])) { $desplegar_modal_id = addslashes($_GET['desplegar_modal_id']); } else { $desplegar_modal_id = ''; }
if (isset($_GET['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_GET['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = ''; }
?>
<!-- **************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
<?php include "../admin/03_admin_modulo_menu_navegacion_adm_lider.php"; ?>
<!-- 1**************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".abrir_modal_registrar_aliado"><i class="fa fa-plus-circle"></i> Registrar Aliado</button></div>
                        <!-- Form search -->
                         <br>
                        <form class="form-horizontal" role="form" id="ingresos">
<!--
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
-->
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'>
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
<?php include "../admin/04_admin_modulo_footer_adm_lider.php"; ?>
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
            </div>
        </div>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include "../admin/05_admin_modulo_js_adm_lider.php"; ?>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!--<script src="../js/ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<!--<script src="../js/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>-->
    </body>
</html>
<!-- ****************************************************************************************************** -->
<!-- Modal Registrar Aliado -->
<div class="modal fade abrir_modal_registrar_aliado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Aliado</h4>
            </div>
            <div class="modal-body">
                <div id="result_register"></div>
                <form id="form_reg_aliado" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Identificación *</label>
                                <input type="number" name="identificacion_tercero" id="identificacion_tercero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre *</label>
                                <input type="text" name="nombre1_tercero" id="nombre1_tercero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Apellido *</label>
                                <input type="text" name="apellido1_tercero" id="apellido1_tercero" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" name="telefono1_tercero" id="telefono1_tercero" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" name="correo_tercero" id="correo_tercero" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" name="direccion_tercero" id="direccion_tercero" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Comision *</label>
                                <input type="number" name="comision_ptj" id="direccion_tercero" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Líder *</label>
                                <select name="cod_lider" id="cod_lider" class="form-control" required>
                                    <?php $cod_administrador_lider = 0;
                                    if (isset($cod_administrador_lider)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_seguridad = '20') AND (cod_estado_activacion_usuario = '1') ORDER BY nombres_apellidos_tercero ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_administrador_lider) and $cod_administrador_lider == $datos2['cod_administrador']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_administrador'];
                                    $nombre = $datos2['nombres_apellidos_tercero'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>lider *</label>
                                <select name="cod_lider" id="cod_lider" class="form-control" required>
                                    <?php $cod_administrador_lider = 0;
                                    if (isset($cod_administrador_lider)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_seguridad = '21') AND (cod_estado_activacion_usuario = '1') ORDER BY nombres_apellidos_tercero ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_administrador_lider) and $cod_administrador_lider == $datos2['cod_administrador']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_administrador'];
                                    $nombre = $datos2['nombres_apellidos_tercero'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Asesor *</label>
                                <select name="cod_asesor" id="cod_asesor" class="form-control" required>
                                    <?php $cod_administrador_lider = $cod_administrador;
                                    if (isset($cod_administrador_lider)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_seguridad = '22') AND (cod_estado_activacion_usuario = '1') ORDER BY nombres_apellidos_tercero ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_administrador_lider) and $cod_administrador_lider == $datos2['cod_administrador']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_administrador'];
                                    $nombre = $datos2['nombres_apellidos_tercero'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tabla" value="tbl15_administrador">
                    <input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad; ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_guardar_aliado">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Envío AJAX para registrar aliado
$(document).on('click','#btn_guardar_aliado',function(e){
    var form = $('#form_reg_aliado');
    var data = form.serialize();
    $('#result_register').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
    $.ajax({
        type: 'POST',
        url: '../admin/reg_aliado_modal_lider_ajax_reg.php',
        data: data,
        success: function(response){
            // mostrar respuesta en el modal
            $('#result_register').html(response);
            var low = String(response).toLowerCase();
            // si no parece contener error, asumimos éxito y cerramos + refrescamos
            if(low.indexOf('error') === -1){
                setTimeout(function(){
                    $('.abrir_modal_registrar_aliado').modal('hide');
                    load(1);
                },1200);
            }
        },
        error: function(){
            $('#result_register').html('<div class="alert alert-danger">Error en la petición. Intente nuevamente.</div>');
        }
    });
});
</script>
<script>
$(document).ready(function(){ load(1); });

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    //var buscar_por = $("#buscar_por").val();
    //var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var buscar_por = '';
    var numero_registro_por_pagina = '99999999';

    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    var nombre_estado_factura = "<?php echo $nombre_estado_factura ?>";
    var pagina = "<?php echo $pagina_local ?>";

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/tabla_busqueda_paginacion_aliado_lider_diseno_vertical_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
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