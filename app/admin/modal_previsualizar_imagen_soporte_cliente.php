    <div class="modal fade abrir_previsualizacion_imagen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Previsualizacion</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="formulario_modal_edit" name="formulario_modal_edit">
                        
                        <div class="form-group">Estado:
                            <select name="codigo_estado_revision" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                                <?php if (isset($codigo_estado_revision)) { echo ""; } else { echo ""; }
                                $consulta2_sql = ("SELECT * FROM tbl15_estado_revision WHERE (cod_estado = '1')");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($codigo_estado_revision) and $codigo_estado_revision == $datos2['codigo_estado_revision']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['codigo_estado_revision'];
                                $nombre = $datos2['nombre_estado_revision'];
                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>

                            <div class="col-md-9 col-sm-9 col-xs-9" id="mod_<?php echo 'codigo_estado_revision' ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-9" id="mod_<?php echo 'url_img_orig_producto' ?>"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->