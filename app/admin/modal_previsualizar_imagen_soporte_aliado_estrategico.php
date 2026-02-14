    <div class="modal fade abrir_previsualizacion_imagen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Previsualizacion</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="formulario_modal_edit" name="formulario_modal_edit">
                        <input type="hidden" id="codigo_estado_revision_actual" name="codigo_estado_revision_actual" value=""/>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12" id="mod_<?php echo 'nombre_nota_observacion_actual' ?>"></div>
                        </div>

<!--
                        <div class="form-group">Estado:
                             <select name="codigo_estado_revision" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                                <?php if (isset($codigo_estado_revision)) { echo ""; } else { echo ""; }
                                $consulta2_sql = ("SELECT * FROM tbl15_estado_revision WHERE (cod_estado = '1')");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) { 

                                    $cod_estado_revision     = $datos2['cod_estado_revision'];
                                    $codigo_estado_revision  = $datos2['codigo_estado_revision'];
                                    $nombre_estado_revision  = $datos2['nombre_estado_revision'];
                                ?>
                                <script>
                                var cod_estado_revision = '<?php echo $cod_estado_revision ?>';
                                var codigo_estado_revision = '<?php echo $codigo_estado_revision ?>';
                                var nombre_estado_revision = '<?php echo $nombre_estado_revision ?>';
                                //var codigo_estado_revision_actual = $("#codigo_estado_revision_actual").val();
                                var codigo_estado_revision_actual = document.getElementById('codigo_estado_revision_actual'); 

                                console.log("codigo_estado_revision_actual = "+codigo_estado_revision_actual);
                                console.log("codigo_estado_revision = "+codigo_estado_revision);

                                if (codigo_estado_revision_actual == codigo_estado_revision) { 
                                    seleccionado = "selected"; 
                                    //$("#codigo_estado_revision_seleccionado"+cod_estado_revision).html('<option id="codigo_estado_revision_seleccionado="'+cod_estado_revision+'" value="'+codigo_estado_revision+'" "'+seleccionado+'">"'+nombre_estado_revision+'"</option>');
                                } else { 
                                    seleccionado = ""; 
                                    //$("#codigo_estado_revision_seleccionado"+cod_estado_revision).html('<option id="codigo_estado_revision_seleccionado="'+cod_estado_revision+'" value="'+codigo_estado_revision+'" "'+seleccionado+'">"'+nombre_estado_revision+'"</option>');
                                }
                                </script>
                                <option id="codigo_estado_revision_seleccionado<?php echo $cod_estado_revision ?>"></option>
                            <?php } ?>
                            </select>
                        </div>
-->
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12" id="mod_<?php echo 'url_img_orig_producto' ?>"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->