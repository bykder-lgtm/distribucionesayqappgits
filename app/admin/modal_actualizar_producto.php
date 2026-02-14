<!-- Modal -->
<?php $mod = 'mod_'; ?>
    <div class="modal fade abrir_modal_actualizar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Producto</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="actualizar_registro_modal" name="actualizar_registro_modal">
                        <div id="result2"></div>
                        
                        <input type="hidden" name="cod_producto" id="<?php echo $mod;?>cod_producto">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Codigo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="cod_producto_barra" id="<?php echo $mod;?>cod_producto_barra" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="nombre_producto" id="<?php echo $mod;?>nombre_producto" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Und<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="und_producto" id="<?php echo $mod;?>und_producto" value="" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio costo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="precio_costo_producto" id="<?php echo $mod;?>precio_costo_producto" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio venta<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="precio_venta_producto" id="<?php echo $mod;?>precio_venta_producto" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select name="nombre_tipo_producto" id="<?php echo $mod;?>nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                            <?php if (isset($nombre_tipo_producto)) { echo "<option value='' >Selecione</option>";
                            } else { echo  "<option value='' selected >Selecione</option>"; }
                            $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto ORDER BY nombre_tipo_producto ASC");
                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($nombre_tipo_producto) AND $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $datos2['nombre_tipo_producto'];
                            $nombre = $datos2['nombre_tipo_producto'];
                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Unidad Medida<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select name="nombre_tipo_unidad_medida" id="<?php echo $mod;?>nombre_tipo_unidad_medida" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                            <?php if (isset($nombre_tipo_unidad_medida)) { echo "<option value='' >Selecione</option>";
                            } else { echo  "<option value='' selected >Selecione</option>"; }
                            $consulta2_sql = ("SELECT cod_tipo_unidad_medida, nombre_tipo_unidad_medida FROM tbl15_tipo_unidad_medida ORDER BY nombre_tipo_unidad_medida ASC");
                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($nombre_tipo_unidad_medida) AND $nombre_tipo_unidad_medida == $datos2['nombre_tipo_unidad_medida']) {
                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $datos2['nombre_tipo_unidad_medida'];
                            $nombre = $datos2['nombre_tipo_unidad_medida'];
                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Posologia Cantidad<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="posologia_cantidad" id="<?php echo $mod;?>posologia_cantidad" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Posologia Peso<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="posologia_peso" id="<?php echo $mod;?>posologia_peso" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Presentacion<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select name="nombre_tipo_presentacion" id="<?php echo $mod;?>nombre_tipo_presentacion" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                            <?php if (isset($nombre_tipo_presentacion)) { echo "<option value='' >Selecione</option>";
                            } else { echo  "<option value='' selected >Selecione</option>"; }
                            $consulta2_sql = ("SELECT cod_tipo_presentacion, nombre_tipo_presentacion FROM tbl15_tipo_presentacion ORDER BY nombre_tipo_presentacion ASC");
                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($nombre_tipo_presentacion) AND $nombre_tipo_presentacion == $datos2['nombre_tipo_presentacion']) {
                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $datos2['nombre_tipo_presentacion'];
                            $nombre = $datos2['nombre_tipo_presentacion'];
                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Via administracion<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select name="nombre_via_administracion" id="<?php echo $mod;?>nombre_via_administracion" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                            <?php if (isset($nombre_via_administracion)) { echo "<option value='' >Selecione</option>";
                            } else { echo  "<option value='' selected >Selecione</option>"; }
                            $consulta2_sql = ("SELECT cod_via_administracion, nombre_via_administracion FROM tbl15_via_administracion ORDER BY nombre_via_administracion ASC");
                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                            if(isset($nombre_via_administracion) AND $nombre_via_administracion == $datos2['nombre_via_administracion']) {
                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $datos2['nombre_via_administracion'];
                            $nombre = $datos2['nombre_via_administracion'];
                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                            </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Frecuencia y duracion<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="nombre_frec_duracion" id="<?php echo $mod;?>nombre_frec_duracion" value="" class="form-control" placeholder="">
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="guardar_actualizar_registro_modal" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->