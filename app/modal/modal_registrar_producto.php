<?php
$sql_barra_prod_max = "SELECT MAX(cod_producto_barra) AS cod_producto_barra FROM tbl15_producto";
$resultado_barra_prod_max = mysqli_query($conectar, $sql_barra_prod_max);
$info_barra_prod_max = mysqli_fetch_assoc($resultado_barra_prod_max);

$cod_producto_barra            = $info_barra_prod_max['cod_producto_barra'] + 1;
?>
        <!-- Modal -->
        <div class="modal fade abrir_modal_registrar" tabindex="10" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button><h4 class="modal-title" id="">Nuevo Producto</h4></div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="nuevo_registro_modal" name="nuevo_registro_modal">
                        <div id="result"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Codigo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="cod_producto_barra" value="<?php echo $cod_producto_barra ?>" class="form-control" placeholder="" required>
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
                              <input type="text" name="nombre_producto" value="" class="form-control" placeholder="" required>
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
                              <input type="number" name="und_producto" value="" class="form-control" placeholder="">
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
                              <input type="number" name="precio_costo_producto" value="" class="form-control" placeholder="">
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
                              <input type="number" name="precio_venta_producto" class="form-control" value="" placeholder="" required>
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
                            <div class="col-md-9 col-sm-9 col-xs-12">
							<select name="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
								<?php if (isset($nombre_tipo_producto)) { echo "<option value='' >Selecione</option>";
								} else { echo  "<option value='' selected >Selecione</option>"; }
								$consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto ORDER BY nombre_tipo_producto ASC");
								$consulta2 = mysqli_query($conectar, $consulta2_sql);
								while ($datos2 = mysqli_fetch_assoc($consulta2)) {
								if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
								$seleccionado = "selected"; } else { $seleccionado = ""; }
								$codigo = $datos2['nombre_tipo_producto'];
								$nombre = $datos2['nombre_tipo_producto'];
								echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="guardar_nuevo_registro_modal" type="submit" class="btn btn-success">Guardar</button>
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