    <div class="modal fade abrir_previsualizacion_datos_valor_credito_factura_venta" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id=""><i class="fa fa-user-plus"></i> Editar Informacion del Credito</h4><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="contact-form-right">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">Total Factura *
                                                <input type="number" class="form-control" id="mod_<?php echo 'monto_deuda' ?>" name="monto_deuda" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">Cuota *
                                                <input type="number" class="form-control" id="mod_<?php echo 'monto_cuota' ?>" name="monto_cuota" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">Numero de Cuotas *
                                                <input type="number" class="form-control" id="mod_<?php echo 'numero_cuota' ?>" name="numero_cuota" placeholder="" data-error="" required/>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn hvr-hover btn-lg btn-block" id="btn_guardar_registro_valor_credito_modal" type="submit">Guardar Cambios</button>
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
$("#btn_guardar_registro_valor_credito_modal").click(function(){

    var cod_info_factura_venta = document.getElementById('mod_'+'cod_info_factura_venta').value;
    var cod_tercero = document.getElementById('mod_'+'cod_tercero').value;
    var monto_deuda = document.getElementById('mod_'+'monto_deuda').value;
    var monto_cuota = document.getElementById('mod_'+'monto_cuota').value;
    var numero_cuota = document.getElementById('mod_'+'numero_cuota').value;
    var cuenta = document.getElementById('mod_'+'cuenta').value;
    var cod_caja_virtual = document.getElementById('mod_'+'cod_caja_virtual').value;
    var modo_venta_por_defecto = document.getElementById('mod_'+'modo_venta_por_defecto').value;
    var pagina = document.getElementById('mod_'+'pagina').value;

    var datos_url_ajax = "cod_info_factura_venta="+cod_info_factura_venta+"&cod_tercero="+cod_tercero+"&monto_deuda="+monto_deuda+"&monto_cuota="+monto_cuota+"&numero_cuota="+numero_cuota;

    $.ajax({
        type: "POST",
        url: "../admin/edit_valor_credito_factura_venta_ajax_reg.php",
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