    <div class="modal fade abrir_modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Producto</h4>
                </div>

                <div class="modal-body">

                    <form method="post" enctype="multipart/form-data" id="formulario_modal_edit" name="formulario_modal_edit" class="form-horizontal form-label-left input_mask">
                        
                        <input type="hidden" name="cod_producto" id="mod_<?php echo 'cod_producto' ?>">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CODIGO<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="cod_producto_barra" id="mod_<?php echo 'cod_producto_barra' ?>" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">NOMBRE PRODUCTO<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="nombre_producto" id="mod_<?php echo 'nombre_producto' ?>" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CATEGORIA<span class="required">*</span></label>
                            <div id="select_modal_edit_nombre_categoria" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_categoria" id="mod_<?php echo 'nombre_categoria' ?>" class="form-control" data-show-subtext="true" data-live-search="true" required>
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
                                <div id="boton_mas_modal_edit_nombre_categoria" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_edit_nombre_categoria_func"><i class="fa fa-plus-circle"></i></button></div>
                                <div id="input_modal_edit_nombre_categoria" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_categoria_input_modal_edit" name="nombre_categoria_input_modal_edit" value="" class="form-control"></div>
                                <div id="boton_modal_edit_nombre_categoria" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_edit_nombre_categoria_func"><i class="fa fa-check"></i></button></div>
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">SUB CATEGORIA<span class="required">*</span></label>
                            <div id="select_modal_edit_nombre_categoria_sub" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_categoria_sub" id="mod_<?php echo 'nombre_categoria_sub' ?>" class="form-control" data-show-subtext="true" data-live-search="true" required>
                                <?php if (isset($nombre_categoria_sub)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_categoria, nombre_categoria_sub FROM tbl15_categoria_sub ORDER BY cod_categoria_sub ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_categoria_sub) and $nombre_categoria_sub == $datos2['nombre_categoria_sub']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_categoria_sub'];
                                $nombre = $datos2['nombre_categoria_sub'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">MARCA<span class="required">*</span></label>
                            <div id="select_modal_edit_nombre_marca" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_marca" id="mod_<?php echo 'nombre_marca' ?>" class="form-control" data-show-subtext="true" data-live-search="true" required>
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
                                <div id="input_modal_edit_nombre_marca" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_marca_input_modal_edit" name="nombre_marca_input_modal_edit" value="" class="form-control"></div>
                                <div id="boton_modal_edit_nombre_marca" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_edit_nombre_marca_func"><i class="fa fa-check"></i></button></div>
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO APLICACION<span class="required"></span></label>
                            <div id="select_modal_edit_nombre_tipo_aplicacion" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_tipo_aplicacion" id="mod_<?php echo 'nombre_tipo_aplicacion' ?>" class="form-control" data-show-subtext="true" data-live-search="true">
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
                                <div id="boton_mas_modal_edit_nombre_tipo_aplicacion" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_edit_nombre_tipo_aplicacion_func"><i class="fa fa-plus-circle"></i></button></div>
                                <div id="input_modal_edit_nombre_tipo_aplicacion" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_tipo_aplicacion_input_modal_edit" name="nombre_tipo_aplicacion_input_modal_edit" value="" class="form-control"></div>
                                <div id="boton_modal_edit_nombre_tipo_aplicacion" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_edit_nombre_tipo_aplicacion_func"><i class="fa fa-check"></i></button></div>
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">DESCRIPCION TIPO APLICACION<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="descripcion_tipo_aplicacion" id="mod_<?php echo 'descripcion_tipo_aplicacion' ?>" value="" class="form-control" placeholder="" >
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO REFERENCIA<span class="required"></span></label>
                            <div id="select_modal_edit_nombre_tipo_referencia" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_tipo_referencia" id="mod_<?php echo 'nombre_tipo_referencia' ?>" class="form-control" data-show-subtext="true" data-live-search="true">
                                <?php if (isset($nombre_tipo_referencia)) { echo "<option value='' >Selecione</option>";
                                } else { echo  "<option value='' selected >Selecione</option>"; }
                                $consulta2_sql = ("SELECT cod_tipo_referencia, nombre_tipo_referencia FROM tbl15_tipo_referencia ORDER BY cod_tipo_referencia ASC");
                                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                if(isset($nombre_tipo_referencia) and $nombre_tipo_referencia == $datos2['nombre_tipo_referencia']) {
                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                $codigo = $datos2['cod_tipo_referencia'];
                                $nombre = $datos2['nombre_tipo_referencia'];
                                echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                            <span>
                                <div id="boton_mas_modal_edit_nombre_tipo_referencia" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_mas_modal_edit_nombre_tipo_referencia_func"><i class="fa fa-plus-circle"></i></button></div>
                                <div id="input_modal_edit_nombre_tipo_referencia" class="col-md-8 col-sm-8 col-xs-8"><input type="text" id="nombre_tipo_referencia_input_modal_edit" name="nombre_tipo_referencia_input_modal_edit" value="" class="form-control"></div>
                                <div id="boton_modal_edit_nombre_tipo_referencia" class="col-md-1 col-sm-1 col-xs-1"><button type="button" id="boton_modal_edit_nombre_tipo_referencia_func"><i class="fa fa-check"></i></button></div>
                            </span>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TIPO PRODUCTO<span class="required"></span></label>
                            <div id="select_nombre_promocion" class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_promocion" id="mod_<?php echo 'nombre_promocion' ?>" class="form-control" data-show-subtext="true" data-live-search="true">
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
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">UNIDADES INV<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="und_inv" id="mod_<?php echo 'und_inv' ?>" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO COMPRA<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_compra_producto" id="mod_<?php echo 'precio_compra_producto' ?>" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO VENTA 1<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_venta_producto" id="mod_<?php echo 'precio_venta_producto' ?>" value="" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PRECIO VENTA 2<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="precio_venta_producto2" id="mod_<?php echo 'precio_venta_producto2' ?>" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">IVA%<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="number" name="iva_ptj" id="mod_<?php echo 'iva_ptj' ?>" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">URL PAGINA DESCRIPCION<span class="required"></span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" name="url_pagina_descripcion" id="mod_<?php echo 'url_pagina_descripcion' ?>" value="" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">ESTADO<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                                <select name="nombre_estado" id="mod_<?php echo 'nombre_estado' ?>" class="form-control" data-show-subtext="true" data-live-search="true" required>
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
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>

                        <div class="ln_solid"></div>
                        
                        <div id="resultado_mensaje_respuesta_edit"></div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                              <button id="btn_guardar_formulario_modal_edit" type="submit" class="btn btn-success">Actualizar Información</button>
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

<script src="../js/ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../js/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
descripcion_producto = CKEDITOR.replace("descripcion_producto");
CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
}
</script>