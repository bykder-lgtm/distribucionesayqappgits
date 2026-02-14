    <div class="modal fade abrir_previsualizacion_imagen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <form action="../admin/reg_siscredito_tercero_cliente_simulador_visitante_extnosesion_reg.php" class="form-horizontal form-label-left input_mask" method="post" id="formulario_modal_edit" name="formulario_modal_edit">

                        <div class="col-lg-12 col-sm-12">
                            <div class="contact-info-left">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 style="text-align:center;" class="noo-sh-title">Ingresa tus datos personales</h2>
                                        <div style="text-align:center;" id="mensaje_verificacion_documento"><img src="../imagenes/eliminar_vacio.png" alt="" /></div>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Tipo de documento *</h3>
                                            <select id="select_nombre_tipo_identificacion" name="nombre_tipo_identificacion" class="form-control" required>
                                                <?php if (isset($nombre_tipo_identificacion)) { echo ""; } else { echo ""; }
                                                $consulta2_sql = "SELECT cod_tipo_identificacion, nombre_tipo_identificacion FROM tbl15_tipo_identificacion WHERE (cod_estado = '1')";
                                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                if(isset($nombre_tipo_identificacion) and $nombre_tipo_identificacion == $datos2['nombre_tipo_identificacion']) {
                                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                $codigo           = $datos2['nombre_tipo_identificacion'];
                                                $nombre           = $datos2['nombre_tipo_identificacion'];
                                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Documento *</h3>
                                            <input type="number" class="form-control" id="identificacion_tercero" name="identificacion_tercero" placeholder="Numero de identificación" required data-error="Por favor, escriba su numero de identificación" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Primer nombre *</h3>
                                            <input type="text" class="form-control" id="nombre1_tercero" name="nombre1_tercero" placeholder="Primer nombre" required data-error="Por favor, ingrese su primer nombre" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Segundo nombre</h3>
                                            <input type="text" class="form-control" id="nombre2_tercero" name="nombre2_tercero" placeholder="Segundo nombre" data-error="Por favor, ingrese su segundo nombre" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Primer apellido *</h3>
                                            <input type="text" class="form-control" id="apellido1_tercero" name="apellido1_tercero" placeholder="Primer apellido" required data-error="Por favor, ingrese su primer apellido" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Segundo apellido</h3>
                                            <input type="text" class="form-control" id="apellido2_tercero" name="apellido2_tercero" placeholder="Segundo apellido" data-error="Por favor, ingrese su segundo apellido" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Fecha de nacimiento</h3>
                                            <input type="date" class="form-control" id="fecha_nac_tercero" name="fecha_nac_tercero" placeholder="Fecha de nacimiento" data-error="Por favor, ingrese su fecha de nacimiento" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Fecha de expedición</h3>
                                            <input type="date" class="form-control" id="fecha_expedicion_tercero" name="fecha_expedicion_tercero" placeholder="Fecha de expedición" data-error="Por favor, ingrese su fecha de expedición"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Celular *</h3>
                                            <input type="number" class="form-control" id="telefono1_tercero" name="telefono1_tercero" placeholder="Celular" required data-error="Por favor, ingrese su celular" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Correo *</h3>
                                            <input type="email" class="form-control" id="correo_tercero" name="correo_tercero" placeholder="Correo" required data-error="Por favor, ingrese su Correo" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Dirección *</h3>
                                            <input type="text" class="form-control" id="direccion_tercero" name="direccion_tercero" placeholder="Dirección" data-error="Por favor, ingrese su dirección" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><h3 class="footer-compan">Estado Civil</h3>
                                            <select id="select_nombre_estado_civil" name="nombre_estado_civil" class="form-control" required>
                                                <?php if (isset($nombre_estado_civil)) { echo ""; } else { echo ""; }
                                                $consulta2_sql = "SELECT cod_estado_civil, nombre_estado_civil FROM tbl15_estado_civil";
                                                $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                                                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                                if(isset($nombre_estado_civil) and $nombre_estado_civil == $datos2['nombre_estado_civil']) {
                                                $seleccionado = "selected"; } else { $seleccionado = ""; }
                                                $codigo           = $datos2['nombre_estado_civil'];
                                                $nombre           = $datos2['nombre_estado_civil'];
                                                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo"><hr></div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div style="text-align:center;" class="shop-cat-bo">
                                            <button class="btn hvr-hover btn-lg btn-block" id="submit" type="submit">Continuar</button>
                                            <input type="hidden" name="cod_producto_codifcryp" value="<?php echo $cod_producto_codifcryp; ?>" />
                                            <input type="hidden" name="valor_credito" value="<?php echo $valor_credito; ?>" />
                                            <input type="hidden" name="cod_entidad_crediticia" value="<?php echo $cod_entidad_crediticia; ?>" />
                                            <input type="hidden" name="cod_tipo_cobro" value="<?php echo $cod_tipo_cobro; ?>" />
                                            <input type="hidden" name="cod_meses_credito" value="<?php echo $cod_meses_credito; ?>" />
                                            <input type="hidden" name="nombre_tipo_tercero" value="<?php echo $nombre_tipo_tercero; ?>" />
                                            <input type="hidden" name="nombre_tipo_tercero_modulo_creacion" value="<?php echo $nombre_tipo_tercero_modulo_creacion; ?>" />
                                        </div>
                                    </div>
                                </div>
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