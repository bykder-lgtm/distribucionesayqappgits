    <div class="modal fade abrir_previsualizacion_modal_entrar_intern" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="ibody">
                    <div class="jumbotron"><h1><div id="mod_tipo_rol">Entrar Como</div></h1></div>
                        <div class="fcontacto">

                            <form method="POST" id="fcontacto" action="../admin/verificacion_visitante_intern.php">
                                <input type="text" class="form-control" name="cuenta" placeholder="Usuario" required="" autofocus=""/>
                                <input type="password" class="form-control" name="contrasena" id="pass" placeholder="Contraseña" required="">
                                <input type="hidden" class="form-control" name="pagina" id="pagina" value="<?php echo $pagina_local ?>">
                                <br><br>
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="enviar" onclick="cifrar()">Entrar</button>
                                <?php if (isset($_GET['error'])) { $error = $_GET['error']; echo '<br><font color="red">'.utf8_decode($error).'.</font>'; } ?>
                            </form>
                        </div>
                    </div>
                </div>
            <!--
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            -->
            </div>
        </div>
    </div> <!-- /Modal -->