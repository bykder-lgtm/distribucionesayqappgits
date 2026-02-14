<?php 
$garantia_tienda = 'El producto es suministrado por el proveedor arriba indicado, quien asume la garantía legal conforme a la Ley 1480 de 2011. El cliente declara haber recibido el producto a satisfacción, sin golpes, humedad o daños visibles. Para proceder con devoluciones o reclamaciones, el producto debe conservar su empaque original, accesorios y encontrarse en perfecto estado físico y funcional. La garantía no cubre daños causados por mal uso, instalación inadecuada o manipulación indebida<br>En caso cumpla estos requisitos de garantías comunicarse a:'; 
?>
    <div class="modal fade abrir_previsualizacion_datos_nuevo_tienda" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id=""><i class="fa fa-user-plus"></i> Registrar Nueva Tienda</h4><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="contact-form-right">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">Nit Tienda *
                                                <input type="text" class="form-control" id="mod_<?php echo 'identificacion_tercero_tienda' ?>" name="identificacion_tercero" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">Nombre de la Tienda *
                                                <input type="text" class="form-control" id="mod_<?php echo 'nombre_tienda' ?>" name="nombre_tienda" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">Direccion *
                                                <input type="text" class="form-control" id="mod_<?php echo 'direccion_tercero' ?>" name="direccion_tercero" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">Telefono *
                                                <input type="number" class="form-control" id="mod_<?php echo 'telefono1_tercero' ?>" name="telefono1_tercero" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">Correo *
                                                <input type="text" class="form-control" id="mod_<?php echo 'correo_tercero' ?>" name="correo_tercero" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">Garantia *
                                                <textarea class="form-control" id="mod_<?php echo 'garantia_tienda' ?>" name="garantia_tienda"><?php echo $garantia_tienda ?></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn hvr-hover btn-lg btn-block" id="btn_guardar_registro_nuevo_tienda_modal" type="submit">Registrar Informacion</button>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="mod_<?php echo 'cod_info_factura_venta' ?>" name="cod_info_factura_venta" value="" />
                                        <input type="hidden" id="mod_<?php echo 'cod_tercero' ?>" name="cod_tercero" value="" />
                                        <input type="hidden" id="mod_<?php echo 'cuenta' ?>" name="cuenta" value="" />
                                        <input type="hidden" id="mod_<?php echo 'cod_caja_virtual' ?>" name="cod_caja_virtual" value="" />
                                        <input type="hidden" id="mod_<?php echo 'modo_venta_por_defecto' ?>" name="modo_venta_por_defecto" value="" />
                                        <input type="hidden" id="mod_<?php echo 'pagina' ?>" name="pagina" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->

<script>
$("#btn_guardar_registro_nuevo_tienda_modal").click(function(){

    var cod_info_factura_venta = document.getElementById('mod_'+'cod_info_factura_venta').value;
    var cod_tercero = document.getElementById('mod_'+'cod_tercero').value;
    var cuenta = document.getElementById('mod_'+'cuenta').value;
    var cod_caja_virtual = document.getElementById('mod_'+'cod_caja_virtual').value;
    var modo_venta_por_defecto = document.getElementById('mod_'+'modo_venta_por_defecto').value;
    var pagina = document.getElementById('mod_'+'pagina').value;
    var identificacion_tercero = document.getElementById('mod_'+'identificacion_tercero_tienda').value;
    var nombre_tienda = document.getElementById('mod_'+'nombre_tienda').value;
    var direccion_tercero = document.getElementById('mod_'+'direccion_tercero').value;
    var telefono1_tercero = document.getElementById('mod_'+'telefono1_tercero').value;
    var correo_tercero = document.getElementById('mod_'+'correo_tercero').value;
    var garantia_tienda = document.getElementById('mod_'+'garantia_tienda').value;

    var datos_url_ajax = "cod_info_factura_venta="+cod_info_factura_venta+"&cod_tercero="+cod_tercero+"&identificacion_tercero="+identificacion_tercero+"&nombre_tienda="+nombre_tienda+"&direccion_tercero="+direccion_tercero+"&telefono1_tercero="+telefono1_tercero+"&correo_tercero="+correo_tercero+"&garantia_tienda="+garantia_tienda;

    $.ajax({
        type: "POST",
        url: "../admin/reg_modal_nuevo_tienda_factura_venta_ajax_reg.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#btn_guardar_registro_modal').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            var afectado = respuesta.afectado;
            var cod_info_factura_venta = respuesta.cod_info_factura_venta;
            var cod_tercero = respuesta.cod_tercero;
            var mensaje = respuesta.mensaje;
            //window.location.href = window.location.href;
            window.location.reload();
        }
    });

});
</script>