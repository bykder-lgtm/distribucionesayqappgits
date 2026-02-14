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
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>-->
<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<a class="btn btn-success" href="../admin/reg_inquilino.php">Registrar Arrendatario</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--<a class="btn btn-danger" href="../admin/reg_inquilino.php">Arrendatarios Eliminados</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<a class="btn btn-primary" href="../admin/lista_inquilino_deshabilitado.php">Arrendatarios Deshabilitados</a>
<?php } ?>
<br>
<!--
<a class="btn btn-success" data-toggle="modal" data-target=".abrir_modal_registrar">Registrar Producto</a>
<a class="btn btn-success" href="../admin/reg_inmueble.php">Registrar Producto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<div><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".abrir_modal_registrar">Registrar Producto</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">

<?php $pagina = $_SERVER['PHP_SELF']; ?>
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
        <div class="col-md-4"><input type="text" class="form-control" id="busqueda_ajax" placeholder="Nombre del Arrendatario" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span></div>
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
<script type="text/javascript" src="../admin/busqueda_paginacion_inquilino_ajax.js"></script>

</body>
</html>

<script>
$( "#nuevo_registro_modal" ).submit(function( event ) {
  $('#guardar_nuevo_registro_modal').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "../admin/reg_producto_ajax_reg.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#guardar_nuevo_registro_modal').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})
// success
$( "#actualizar_registro_modal" ).submit(function( event ) {
  $('#guardar_actualizar_registro_modal').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "../admin/edit_producto_ajax_reg.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#guardar_actualizar_registro_modal').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

function obtener_datos(id){
        var cod_producto = id;
        var cod_producto_barra = $("#cod_producto_barra"+id).val();
        var nombre_producto = $("#nombre_producto"+id).val();
        var und_producto = $("#und_producto"+id).val();
        var precio_costo_producto = $("#precio_costo_producto"+id).val();
        var precio_venta_producto = $("#precio_venta_producto"+id).val();
        var nombre_tipo_unidad_medida = $("#nombre_tipo_unidad_medida"+id).val();
        var posologia_cantidad = $("#posologia_cantidad"+id).val();
        var posologia_peso = $("#posologia_peso"+id).val();
        var nombre_tipo_producto = $("#nombre_tipo_producto"+id).val();
        var nombre_tipo_presentacion = $("#nombre_tipo_presentacion"+id).val();
        var nombre_via_administracion = $("#nombre_via_administracion"+id).val();
        var nombre_frec_duracion = $("#nombre_frec_duracion"+id).val();
        var fecha_vencimiento1 = $("#fecha_vencimiento1"+id).val();
        var vencimiento_lote1 = $("#vencimiento_lote1"+id).val();
        var fecha_vencimiento2 = $("#fecha_vencimiento2"+id).val();
        var vencimiento_lote2 = $("#vencimiento_lote2"+id).val();
        var iva_ptj = $("#iva_ptj"+id).val();
        var tope_min = $("#tope_min"+id).val();

        $("#mod_"+"cod_producto").val(id);
        $("#mod_"+"cod_producto_barra").val(cod_producto_barra);
        $("#mod_"+"nombre_producto").val(nombre_producto);
        $("#mod_"+"und_producto").val(und_producto);
        $("#mod_"+"precio_costo_producto").val(precio_costo_producto);
        $("#mod_"+"precio_venta_producto").val(precio_venta_producto);
        $("#mod_"+"nombre_tipo_unidad_medida").val(nombre_tipo_unidad_medida);
        $("#mod_"+"posologia_cantidad").val(posologia_cantidad);
        $("#mod_"+"posologia_peso").val(posologia_peso);
        $("#mod_"+"nombre_tipo_producto").val(nombre_tipo_producto);
        $("#mod_"+"nombre_tipo_presentacion").val(nombre_tipo_presentacion);
        $("#mod_"+"nombre_via_administracion").val(nombre_via_administracion);
        $("#mod_"+"nombre_frec_duracion").val(nombre_frec_duracion);
        $("#mod_"+"fecha_vencimiento1").val(fecha_vencimiento1);
        $("#mod_"+"vencimiento_lote1").val(vencimiento_lote1);
        $("#mod_"+"fecha_vencimiento2").val(fecha_vencimiento2);
        $("#mod_"+"vencimiento_lote2").val(vencimiento_lote2);
        $("#mod_"+"iva_ptj").val(iva_ptj);
        $("#mod_"+"tope_min").val(tope_min);
}
</script>