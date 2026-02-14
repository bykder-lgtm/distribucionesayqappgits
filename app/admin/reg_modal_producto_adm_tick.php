        <div class="modal fade abrir_modal_registrar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button><h4 class="modal-title" id=""><i class="fa fa-user-plus"></i> Nuevo Producto</h4></div>

                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="formulario_reg_nuevo_modal" name="formulario_reg_nuevo_modal" class="form-horizontal form-label-left input_mask">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                            <div id="respuesta_ajax" class="col-md-8 col-sm-8 col-xs-8"></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CODIGO<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="cod_producto_bar" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">NOMBRE PRODUCTO<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="nombre_producto" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CATEGORIA<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_categoria" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_categoria" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_categoria)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_categoria, nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_categoria) and $nombre_categoria == $datos2['nombre_categoria']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_categoria'];
                                $nombre = $datos2['nombre_categoria'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                                <span>
                                    <div id="boton_mas_modal_reg_nombre_categoria" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_reg_nombre_categoria_func"><i class="fa fa-plus-circle"></i></button></div>
                                    <div id="input_modal_reg_nombre_categoria" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_categoria_input_modal_reg" name="nombre_categoria_input_modal_reg" value="" class="form-control"></div>
                                    <div id="boton_modal_reg_nombre_categoria" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_reg_nombre_categoria_func"><i class="fa fa-check"></i></button></div>
                                </span>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">MARCA<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_marca" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_marca" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_marca)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_marca, nombre_marca FROM tbl15_marca ORDER BY cod_marca ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_marca) and $nombre_marca == $datos2['nombre_marca']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_marca'];
                                $nombre = $datos2['nombre_marca'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                                <span>
                                    <div id="boton_mas_modal_edit_nombre_marca" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_edit_nombre_marca_func"><i class="fa fa-plus-circle"></i></button></div>
                                    <div id="input_modal_reg_nombre_marca" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_marca_input_modal_reg" name="nombre_marca_input_modal_reg" value="" class="form-control"></div>
                                    <div id="boton_modal_reg_nombre_marca" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_reg_nombre_marca_func"><i class="fa fa-check"></i></button></div>
                                </span>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO APLICACION<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_tipo_aplicacion" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_tipo_aplicacion" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_tipo_aplicacion)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_tipo_aplicacion, nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion ORDER BY cod_tipo_aplicacion ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_tipo_aplicacion) and $nombre_tipo_aplicacion == $datos2['nombre_tipo_aplicacion']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_tipo_aplicacion'];
                                $nombre = $datos2['nombre_tipo_aplicacion'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                                <span>
                                    <div id="boton_mas_modal_reg_nombre_tipo_aplicacion" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_reg_nombre_tipo_aplicacion_func"><i class="fa fa-plus-circle"></i></button></div>
                                    <div id="input_modal_reg_nombre_tipo_aplicacion" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_tipo_aplicacion_input_modal_reg" name="nombre_tipo_aplicacion_input_modal_reg" value="" class="form-control"></div>
                                    <div id="boton_modal_reg_nombre_tipo_aplicacion" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_reg_nombre_tipo_aplicacion_func"><i class="fa fa-check"></i></button></div>
                                </span>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">DESCRIPCION TIPO APLICACION<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="descripcion_tipo_aplicacion" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO REFERENCIA<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_tipo_referencia" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_tipo_referencia" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_tipo_referencia)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_tipo_referencia, nombre_tipo_referencia FROM tbl15_tipo_referencia ORDER BY cod_tipo_referencia ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_tipo_referencia) and $nombre_tipo_referencia == $datos2['nombre_tipo_referencia']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_tipo_aplicacion'];
                                $nombre = $datos2['nombre_tipo_referencia'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                                <span>
                                    <div id="boton_mas_modal_reg_nombre_tipo_referencia" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_moda_reg_nombre_tipo_referencia_func"><i class="fa fa-plus-circle"></i></button></div>
                                    <div id="input_modal_reg_nombre_tipo_referencia" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_tipo_referencia_input_modal_reg" name="nombre_tipo_referencia_input_modal_reg" value="" class="form-control"></div>
                                    <div id="boton_modal_reg_nombre_tipo_referencia" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_reg_nombre_tipo_referencia_func"><i class="fa fa-check"></i></button></div>
                                </span>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO PRODUCTO<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_promocion" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_promocion" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_promocion)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_promocion, nombre_promocion FROM tbl15_promocion ORDER BY cod_promocion ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_promocion) and $nombre_promocion == $datos2['nombre_promocion']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_promocion'];
                                $nombre = $datos2['nombre_promocion'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">UNIDADES INV<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="und_inv" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO COMPRA<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_compra_producto" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO VENTA 1<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_venta_producto" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO VENTA 2<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_venta_producto2" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">IVA%<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="iva_ptj" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">URL PAGINA DESCRIPCION<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="url_pagina_descripcion" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">ESTADO<span class="required">*</span></label>
                            <div id="select_modal_reg_nombre_estado" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_estado" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_estado)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_estado, nombre_estado FROM tbl15_estado WHERE (tipo_estado = 'PRODUCTO') ORDER BY cod_estado ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_estado) and $nombre_estado == $datos2['nombre_estado']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_estado'];
                                $nombre = $datos2['nombre_estado'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">DESCRIPCION PRODUCTO<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <textarea rows="5" cols="30" name="descripcion_producto" id="descripcion_producto" class="form-control"></textarea>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">IMAGEN PRODUCTO<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a></div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PREVISUALIZACION<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8"><div id="vista_archivo"></div> </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="ln_solid"></div>

                        <div id="resultado_mensaje_respuesta_reg"></div>

                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="btn_guardar_formulario_reg_nuevo_modal" type="submit" class="btn btn-success">Guardar Información</button>
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