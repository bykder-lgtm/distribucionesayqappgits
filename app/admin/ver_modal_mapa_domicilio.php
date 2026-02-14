    <div class="modal fade abrir_modal_mapa_visita" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubicacion mapa Domicilio</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="formulario_modal_edit" name="formulario_modal_edit">
                        
                        <input type="hidden" name="cod_info_factura_venta" id="mod_<?php echo 'cod_info_factura_venta' ?>">

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="url_mapa_ext"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="mostrar_mapa" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        
                        <div id="resultado_mensaje_respuesta_edit"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->