<?php $nombre_pagina = "Productos"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_inicio_sesion_adm_tick.php"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include "../admin/01_admin_modulo_info_empresa_adm_tick.php"; ?>

<?php include "../admin/02_admin_modulo_meta_adm_tick.php"; ?>
<!-- **************************************************** MODULO DE PLANTILLAS META ******************************************** -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<?php include "../admin/02_admin_modulo_estilo_css_adm_tick.php"; ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<title><?php echo $nombre_pagina." | ".$nombre ?> </title>
    </head>

    <body class="nav-md">
<?php
$tabla                         = 'tbl01_producto';
$tabla_codif                   = DAXCODIFCRYPTOR::encodiftextodax($tabla);
$tabla_codifcryp               = DAXCODIFCRYPTOR::encriptardax($tabla_codif);

$pagina                         = $_SERVER['PHP_SELF']; 
$pagina_codif                   = DAXCODIFCRYPTOR::encodiftextodax($pagina);
$pagina_codifcryp               = DAXCODIFCRYPTOR::encriptardax($pagina_codif);
?>
<!-- **************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
<?php include "../admin/03_admin_modulo_menu_navegacion_adm_tick.php"; ?>
<!-- 1**************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
<div><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".abrir_modal_registrar"><i class="fa fa-plus-circle"></i> Nuevo Producto</button></div>
<hr>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/reg_modal_producto_adm_tick.php"); ?>
<?php include_once("../admin/edit_modal_producto_adm_tick.php"); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** --> 
                        <!-- Form search -->
                        <form class="form-horizontal" role="form" id="ingresos">
                                <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
                                <div class="col-md-1">
                                    <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                                        <option value="10">10</option>
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
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="buscar_por" onchange='load(1);'>
                                        <option value="cod_producto_bar">REFERENCIA</option>
                                        <option value="nombre_producto">NOMBRE PRODUCTO</option>
                                        <option value="nombre_categoria">CATEGORIA PRODUCTO</option>
                                        <option value="nombre_marca">MARCA PRODUCTO</option>

                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
                                    <input type="hidden" id="tabla_codifcryp" Value="<?php echo $tabla_codifcryp; ?>">
                                    <input type="hidden" id="pagina_codifcryp" Value="<?php echo $pagina_codifcryp; ?>">
                                </div>
                        </form>
                        <!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div class='salida_informacion_actualizada' id='salida_informacion_actualizada'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
<?php include "../admin/04_admin_modulo_footer_adm_tick.php"; ?>
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
            </div>
        </div>

<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include "../admin/05_admin_modulo_js_adm_tick.php"; ?>
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
//****************************************************************************************************//
function load(page){
    $(document).ready(function(){
        var action = 'ajax';
        var busqueda_ajax = $("#busqueda_ajax").val();
        var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
        var buscar_por = $("#buscar_por").val();

        $.ajax({
            url:'../admin/busqueda_paginacion_producto_ajax_adm_tick.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&buscar_por='+buscar_por,
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif">');
            },
            success:function(data){
                $(".salida_informacion_actualizada").html(data).fadeIn('slow');
                $('#loader').html('');
            }
        })
        $(document).on('click', '#cod_producto', function(e){
            var info_ajax = $(this).data('id');
            var frag = info_ajax.split('|');
            var cod_producto = frag[0];
            var nombre_regtro = frag[1];
            var cedula = frag[2];
            var action = frag[3];
            var page = frag[4];
            var busqueda_ajax = frag[5];
            var numero_registro_por_pagina = frag[6];
            var buscar_por = frag[7];

            SwalDelete(cod_producto, nombre_regtro, cedula, action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por);
            e.preventDefault();
        });
    });
}
//****************************************************************************************************//
function SwalDelete(cod_producto, nombre_regtro, cedula, action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por){
    swal({
        title: 'Estás seguro?',
        text: "Se eliminará permanentemente a <br>"+nombre_regtro+"!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínar!',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
             $.ajax({
                url: '../admin/eliminar_registro_ajax_adm_tick.php',
                type: 'POST',
                data: 'cod_producto='+cod_producto,
                dataType: 'json'
             })
             .done(function(response){
                swal('Eliminado!', response.message, response.status);
                leer_registros(action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por);
             })
             .fail(function(){
                swal('Oops...', 'Algo salió mal !', 'error');
             });
          });
        },
        allowOutsideClick: false              
    }); 
}
//****************************************************************************************************//
function leer_registros(action, page, busqueda_ajax, numero_registro_por_pagina, buscar_por){
    $.ajax({
        url:"../admin/busqueda_paginacion_producto_ajax_adm_tick.php",
        method:"POST",
        data:{action:action, page:page, busqueda_ajax:busqueda_ajax, numero_registro_por_pagina:numero_registro_por_pagina, buscar_por:buscar_por},
        cache:false,
        success:function(data) {
        $('#salida_informacion_actualizada').empty();
        $('#salida_informacion_actualizada').append(data);
        }
    });
}
</script>
<!-- *********************************************************************************************** -->
<!-- *********************************************************************************************** -->
<script>
$( "#formulario_reg_nuevo_modal" ).submit(function( event ) {
    $('#btn_guardar_formulario_reg_nuevo_modal').attr("disabled", true);

    //var descripcion_producto = CKEDITOR.instances['descripcion_producto'].getData();
    var parametros = new FormData($("#formulario_reg_nuevo_modal")[0]);
    //var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../admin/reg_producto_ajax_reg_adm_tick.php",
        data: parametros,
        contentType: false,
        processData: false,
         beforeSend: function(objeto){
            $("#resultado_mensaje_respuesta_reg").html('Mensaje: <img src="../imagenes/loader.gif"/>Cargando...');
        },
        success: function(datos){
            $("#resultado_mensaje_respuesta_reg").html(datos);
            $('#btn_guardar_formulario_reg_nuevo_modal').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})
// success
$( "#formulario_modal_edit" ).submit(function( event ) {
    $('#btn_guardar_formulario_modal_edit').attr("disabled", true);
  
 //var descripcion_producto = CKEDITOR.instances['mod_descripcion_producto'].getData();
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../admin/edit_producto_ajax_reg_adm_tick.php",
        data: parametros,
         beforeSend: function(objeto){
            $("#resultado_mensaje_respuesta_edit").html('Mensaje: <img src="../imagenes/loader.gif"/>Cargando...');
          },
        success: function(datos){
            $("#resultado_mensaje_respuesta_edit").html(datos);
            $('#btn_guardar_formulario_modal_edit').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})

function obtener_datos_actualizar_modal(id){

    var cod_producto_bar = $("#cod_producto_bar"+id).val();
    var cod_producto_bar2 = $("#cod_producto_bar2"+id).val();
    var cod_producto_bar3 = $("#cod_producto_bar3"+id).val();
    var nombre_producto = $("#nombre_producto"+id).val();
    var nombre_categoria = $("#nombre_categoria"+id).val();
    var nombre_categoria_sub = $("#nombre_categoria_sub"+id).val();
    var nombre_promocion = $("#nombre_promocion"+id).val();
    var nombre_tipo_empaque = $("#nombre_tipo_empaque"+id).val();
    var nombre_lugar_pieza = $("#nombre_lugar_pieza"+id).val();
    var nombre_marca = $("#nombre_marca"+id).val();
    var nombre_tipo_aplicacion = $("#nombre_tipo_aplicacion"+id).val();
    var nombre_tipo_referencia = $("#nombre_tipo_referencia"+id).val();
    var descripcion_tipo_aplicacion = $("#descripcion_tipo_aplicacion"+id).val();
    var und_inv = $("#und_inv"+id).val();
    var precio_compra_producto = $("#precio_compra_producto"+id).val();
    var precio_costo_producto = $("#precio_costo_producto"+id).val();
    var precio_venta_producto = $("#precio_venta_producto"+id).val();
    var precio_venta_producto2 = $("#precio_venta_producto2"+id).val();
    var precio_venta_producto3 = $("#precio_venta_producto3"+id).val();
    var url_img_producto_min = $("#url_img_producto_min"+id).val();
    var url_img_producto_orig = $("#url_img_producto_orig"+id).val();
    var iva_ptj = $("#iva_ptj"+id).val();
    var detalle_producto = $("#detalle_producto"+id).val();
    var descripcion_producto = $("#descripcion_producto"+id).val();
    var url_pagina_descripcion = $("#url_pagina_descripcion"+id).val();
    var codificacion = $("#codificacion"+id).val();
    var nombre_estado = $("#nombre_estado"+id).val();
    
    $("#mod_"+"cod_producto").val(id);

    $("#mod_"+"cod_producto_bar").val(cod_producto_bar);
    $("#mod_"+"cod_producto_bar2").val(cod_producto_bar2);
    $("#mod_"+"cod_producto_bar3").val(cod_producto_bar3);
    $("#mod_"+"nombre_producto").val(nombre_producto);
    $("#mod_"+"nombre_categoria").val(nombre_categoria);
    $("#mod_"+"nombre_categoria_sub").val(nombre_categoria_sub);
    $("#mod_"+"nombre_promocion").val(nombre_promocion);
    $("#mod_"+"nombre_tipo_empaque").val(nombre_tipo_empaque);
    $("#mod_"+"nombre_lugar_pieza").val(nombre_lugar_pieza);
    $("#mod_"+"nombre_marca").val(nombre_marca);
    $("#mod_"+"nombre_tipo_aplicacion").val(nombre_tipo_aplicacion);
    $("#mod_"+"nombre_tipo_referencia").val(nombre_tipo_referencia);
    $("#mod_"+"descripcion_tipo_aplicacion").val(descripcion_tipo_aplicacion);
    $("#mod_"+"und_inv").val(und_inv);
    $("#mod_"+"precio_compra_producto").val(precio_compra_producto);
    $("#mod_"+"precio_costo_producto").val(precio_costo_producto);
    $("#mod_"+"precio_venta_producto").val(precio_venta_producto);
    $("#mod_"+"precio_venta_producto2").val(precio_venta_producto2);
    $("#mod_"+"precio_venta_producto3").val(precio_venta_producto3);
    $("#mod_"+"url_img_producto_min").val(url_img_producto_min);
    $("#mod_"+"url_img_producto_orig").val(url_img_producto_orig);
    $("#mod_"+"iva_ptj").val(iva_ptj);
    $("#mod_"+"detalle_producto").val(detalle_producto);
    $("#mod_"+"url_pagina_descripcion").val(url_pagina_descripcion);
    $("#mod_"+"codificacion").val(codificacion);
    $("#mod_"+"nombre_estado").val(nombre_estado);
    $("#mod_"+"descripcion_producto").val(descripcion_producto);
    //$("#mod_"+"descripcion_producto").val("");
    //var mod_descripcion_producto = CKEDITOR.instances["mod_"+"descripcion_producto"].getData();
    //CKEDITOR.instances["mod_descripcion_producto"].setData(mod_descripcion_producto + descripcion_producto);
}
</script>

<script>
$(document).ready(function() {

    $('#boton_modal_reg_nombre_categoria').hide();
    $('#input_modal_reg_nombre_categoria').hide();

    $("#boton_mas_modal_reg_nombre_categoria_func").click(function(){
        $('#input_modal_reg_nombre_categoria').show();
        $('#boton_modal_reg_nombre_categoria').show();
        $('#select_modal_reg_nombre_categoria').hide();
        $('#boton_mas_modal_reg_nombre_categoria').hide();
        document.getElementById("nombre_categoria_input_modal_reg").focus();
    });

    $("#boton_modal_reg_nombre_categoria_func").click(function(){
        $('#boton_mas_modal_reg_nombre_categoria').show();
        $('#select_modal_reg_nombre_categoria').show();
        $('#boton_modal_reg_nombre_categoria').hide();
        $('#input_modal_reg_nombre_categoria').hide();

        var valor = $("#nombre_categoria_input_modal_reg").val();
        var campo = 'nombre_categoria';
        var tipo_ajax = 'nombre_categoria';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_categoria();
                Cargar_nombre_categoria(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_categoria(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_reg_nombre_categoria';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_categoria() {
        $("#nombre_categoria_input_modal_reg").val("");
    }
});
</script>


<script>
$(document).ready(function() {

    $('#boton_modal_reg_nombre_marca').hide();
    $('#input_modal_reg_nombre_marca').hide();

    $("#boton_mas_modal_reg_nombre_marca_func").click(function(){
        $('#input_modal_reg_nombre_marca').show();
        $('#boton_modal_reg_nombre_marca').show();
        $('#select_modal_reg_nombre_marca').hide();
        $('#boton_mas_modal_edit_nombre_marca').hide();
        document.getElementById("nombre_marca_input_modal_reg").focus();
    });

    $("#boton_modal_reg_nombre_marca_func").click(function(){
        $('#boton_mas_modal_edit_nombre_marca').show();
        $('#select_modal_reg_nombre_marca').show();
        $('#boton_modal_reg_nombre_marca').hide();
        $('#input_modal_reg_nombre_marca').hide();

        var valor = $("#nombre_marca_input_modal_reg").val();
        var campo = 'nombre_marca';
        var tipo_ajax = 'nombre_marca';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_marca();
                Cargar_nombre_marca(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_marca(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_reg_nombre_marca';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_marca() {
        $("#nombre_marca_input_modal_reg").val("");
    }
});
</script>

<script>
$(document).ready(function() {

    $('#boton_modal_reg_nombre_tipo_aplicacion').hide();
    $('#input_modal_reg_nombre_tipo_aplicacion').hide();

    $("#boton_mas_modal_reg_nombre_tipo_aplicacion_func").click(function(){
        $('#input_modal_reg_nombre_tipo_aplicacion').show();
        $('#boton_modal_reg_nombre_tipo_aplicacion').show();
        $('#select_modal_reg_nombre_tipo_aplicacion').hide();
        $('#boton_mas_modal_reg_nombre_tipo_aplicacion').hide();
        document.getElementById("nombre_tipo_aplicacion_input_modal_reg").focus();
    });


    $("#boton_modal_reg_nombre_tipo_aplicacion_func").click(function(){
        $('#boton_mas_modal_reg_nombre_tipo_aplicacion').show();
        $('#select_modal_reg_nombre_tipo_aplicacion').show();
        $('#boton_modal_reg_nombre_tipo_aplicacion').hide();
        $('#input_modal_reg_nombre_tipo_aplicacion').hide();

        var valor = $("#nombre_tipo_aplicacion_input_modal_reg").val();
        var campo = 'nombre_tipo_aplicacion';
        var tipo_ajax = 'nombre_tipo_aplicacion';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_tipo_aplicacion();
                Cargar_nombre_tipo_aplicacion(valor, campo, tipo_ajax);
            }
        });

    });
    function Cargar_nombre_tipo_aplicacion(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_reg_nombre_tipo_aplicacion';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_tipo_aplicacion() {
        $("#nombre_tipo_aplicacion_input_modal_reg").val("");
    }
});
</script>

<script>
$(document).ready(function() {

    $('#boton_modal_reg_nombre_tipo_referencia').hide();
    $('#input_modal_reg_nombre_tipo_referencia').hide();

    $("#boton_mas_modal_reg_nombre_tipo_referencia_func").click(function(){
        $('#input_modal_reg_nombre_tipo_referencia').show();
        $('#boton_modal_reg_nombre_tipo_referencia').show();
        $('#select_modal_reg_nombre_tipo_referencia').hide();
        $('#boton_mas_modal_reg_nombre_tipo_referencia').hide();
        document.getElementById("nombre_tipo_referencia_input_modal_reg").focus();
    });

    $("#boton_modal_reg_nombre_tipo_referencia_func").click(function(){
        $('#boton_mas_modal_reg_nombre_tipo_referencia').show();
        $('#select_modal_reg_nombre_tipo_referencia').show();
        $('#boton_modal_reg_nombre_tipo_referencia').hide();
        $('#input_modal_reg_nombre_tipo_referencia').hide();

        var valor = $("#nombre_tipo_referencia_input_modal_reg").val();
        var campo = 'nombre_tipo_referencia';
        var tipo_ajax = 'nombre_tipo_referencia';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_tipo_referencia();
                Cargar_nombre_tipo_referencia(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_tipo_referencia(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_reg_nombre_tipo_referencia';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_tipo_referencia() {
        $("#nombre_tipo_referencia_input_modal_reg").val("");
    }
});
</script>


<script>
$(document).ready(function() {

    $('#boton_modal_edit_nombre_categoria').hide();
    $('#input_modal_edit_nombre_categoria').hide();

    $("#boton_mas_modal_edit_nombre_categoria_func").click(function(){
        $('#input_modal_edit_nombre_categoria').show();
        $('#boton_modal_edit_nombre_categoria').show();
        $('#select_modal_edit_nombre_categoria').hide();
        $('#boton_mas_modal_edit_nombre_categoria').hide();
        document.getElementById("nombre_categoria_input_modal_edit").focus();
    });

    $("#boton_modal_edit_nombre_categoria_func").click(function(){
        $('#boton_mas_modal_edit_nombre_categoria').show();
        $('#select_modal_edit_nombre_categoria').show();
        $('#boton_modal_edit_nombre_categoria').hide();
        $('#input_modal_edit_nombre_categoria').hide();

        var valor = $("#nombre_categoria_input_modal_edit").val();
        var campo = 'nombre_categoria';
        var tipo_ajax = 'nombre_categoria';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_categoria();
                Cargar_nombre_categoria(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_categoria(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_edit_nombre_categoria';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_categoria() {
        $("#nombre_categoria_input_modal_edit").val("");
    }
});
</script>

<script>
$(document).ready(function() {

    $('#boton_modal_edit_nombre_marca').hide();
    $('#input_modal_edit_nombre_marca').hide();

    $("#boton_mas_modal_edit_nombre_marca_func").click(function(){
        $('#input_modal_edit_nombre_marca').show();
        $('#boton_modal_edit_nombre_marca').show();
        $('#select_modal_edit_nombre_marca').hide();
        $('#boton_mas_modal_edit_nombre_marca').hide();
        document.getElementById("nombre_marca_input_modal_edit").focus();
    });

    $("#boton_modal_edit_nombre_marca_func").click(function(){
        $('#boton_mas_modal_edit_nombre_marca').show();
        $('#select_modal_edit_nombre_marca').show();
        $('#boton_modal_edit_nombre_marca').hide();
        $('#input_modal_edit_nombre_marca').hide();

        var valor = $("#nombre_marca_input_modal_edit").val();
        var campo = 'nombre_marca';
        var tipo_ajax = 'nombre_marca';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_marca();
                Cargar_nombre_marca(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_marca(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_edit_nombre_marca';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_marca() {
        $("#nombre_marca_input_modal_edit").val("");
    }
});
</script>



<script>
$(document).ready(function() {

    $('#boton_modal_edit_nombre_tipo_aplicacion').hide();
    $('#input_modal_edit_nombre_tipo_aplicacion').hide();

    $("#boton_mas_modal_edit_nombre_tipo_aplicacion_func").click(function(){
        $('#input_modal_edit_nombre_tipo_aplicacion').show();
        $('#boton_modal_edit_nombre_tipo_aplicacion').show();
        $('#select_modal_edit_nombre_tipo_aplicacion').hide();
        $('#boton_mas_modal_edit_nombre_tipo_aplicacion').hide();
        document.getElementById("nombre_tipo_aplicacion_input_modal_edit").focus();
    });

    $("#boton_modal_edit_nombre_tipo_aplicacion_func").click(function(){
        $('#boton_mas_modal_edit_nombre_tipo_aplicacion').show();
        $('#select_modal_edit_nombre_tipo_aplicacion').show();
        $('#boton_modal_edit_nombre_tipo_aplicacion').hide();
        $('#input_modal_edit_nombre_tipo_aplicacion').hide();

        var valor = $("#nombre_tipo_aplicacion_input_modal_edit").val();
        var campo = 'nombre_tipo_aplicacion';
        var tipo_ajax = 'nombre_tipo_aplicacion';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax_adm_tick.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_tipo_aplicacion();
                Cargar_nombre_tipo_aplicacion(valor, campo, tipo_ajax);
            }
        });
    });
    function Cargar_nombre_tipo_aplicacion(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_edit_nombre_tipo_aplicacion';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }
    function Limpiar_nombre_tipo_aplicacion() {
        $("#nombre_tipo_aplicacion_input_modal_edit").val("");
    }
});
</script>


<script>
$(document).ready(function() {

    $('#boton_modal_edit_nombre_tipo_referencia').hide();
    $('#input_modal_edit_nombre_tipo_referencia').hide();

    $("#boton_mas_moda_edit_nombre_tipo_referencia_func").click(function(){
        $('#input_modal_edit_nombre_tipo_referencia').show();
        $('#boton_modal_edit_nombre_tipo_referencia').show();
        $('#select_modal_edit_nombre_tipo_referencia').hide();
        $('#boton_mas_modal_edit_nombre_tipo_referencia').hide();
        document.getElementById("nombre_tipo_referencia_input_modal_edit").focus();
    });

    $("#boton_modal_edit_nombre_tipo_referencia_func").click(function(){
        $('#boton_mas_modal_edit_nombre_tipo_referencia').show();
        $('#select_modal_edit_nombre_tipo_referencia').show();
        $('#boton_modal_edit_nombre_tipo_referencia').hide();
        $('#input_modal_edit_nombre_tipo_referencia').hide();

        var valor = $("#nombre_tipo_referencia_input_modal_edit").val();
        var campo = 'nombre_tipo_referencia';
        var tipo_ajax = 'nombre_tipo_referencia';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/guardar_consulta_select_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#respuesta_ajax').html(resp);
                Limpiar_nombre_tipo_referencia();
                Cargar_nombre_tipo_referencia(valor, campo, tipo_ajax);
            }
        });
    });

    function Cargar_nombre_tipo_referencia(valor, campo, tipo_ajax) {
        var capa_cargar_datos = 'select_modal_edit_nombre_tipo_referencia';
        $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax_adm_tick.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    }

    function Limpiar_nombre_tipo_referencia() {
        $("#nombre_tipo_referencia_input_modal_edit").val("");
    }
});
</script>


<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>