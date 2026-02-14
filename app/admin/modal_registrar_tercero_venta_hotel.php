<!--<script src="../js/jquery.min.js"></script>-->
<?php 
$nombre_tipo_regimen       = 'SIMPLE';
$nombre_tipo_impuesto      = 'NO_RESPONSABLE_DE_IVA';
$nombre_departamento       = 'CORDOBA';
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h3 class="col-12 bg-success border">Registrar Tercero</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-white text-center">

                    <div id="error_identificacion_repetida"></div>

                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Tipo de Tercero</div>
                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                            <select name="nombre_tipo_tercero" id="nombre_tipo_tercero" class="form-control">
                                <?php $sql_consulta="SELECT * FROM tbl15_tipo_tercero WHERE (nombre_tipo_tercero = 'CLIENTE') ORDER BY cod_tipo_tercero ASC";
                                $resultado = mysqli_query($conectar, $sql_consulta);
                                while ($contenedor=mysqli_fetch_array($resultado)) { 
                                $codigo = $contenedor['cod_tipo_tercero'];
                                $nombre = $contenedor['nombre_tipo_tercero'];
                                ?>
                                <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Tipo de Identificacion</div>
                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                            <select name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" class="form-control">
                                <?php $sql_consulta="SELECT * FROM tbl15_tipo_identificacion WHERE (cod_estado =  '1') ORDER BY cod_tipo_identificacion ASC";
                                $resultado = mysqli_query($conectar, $sql_consulta);
                                while ($contenedor=mysqli_fetch_array($resultado)) { 
                                $codigo = $contenedor['cod_tipo_identificacion'];
                                $nombre = $contenedor['nombre_tipo_identificacion'];
                                ?>
                                <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">¿Tiene Documento?</div>
                        <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                            <select name="nombre_sino" id="nombre_sino" class="form-control">
                                <?php $sql_consulta="SELECT * FROM tbl15_sino ORDER BY cod_sino ASC";
                                $resultado = mysqli_query($conectar, $sql_consulta);
                                while ($contenedor=mysqli_fetch_array($resultado)) { 
                                $codigo = $contenedor['cod_sino'];
                                $nombre = $contenedor['nombre_sino'];
                                ?>
                                <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    <div id="modal_cuerpo_documento_titulo" class="col-6 bg-success border" style="text-align: center; font-size:20px;">Documento</div>
                    <div id="modal_cuerpo_documento_componente" class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="identificacion_tercero" id="identificacion_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div >
                    <div id="modal_cuerpo_digito_titulo" class="col-6 bg-success border" style="text-align: center; font-size:20px;">Digito de Verificacion</div>
                    <div id="modal_cuerpo_digito_componente" class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="digito_tercero" id="digito_tercero" value="" class="form-control" placeholder="">
                    </div>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Primer Nombre</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="nombre1_tercero" id="nombre1_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Segundo Nombre</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="nombre2_tercero" id="nombre2_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Primer Apellido</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="apellido1_tercero" id="apellido1_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Segundo Apellido</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="apellido2_tercero" id="apellido2_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Fecha Nacimiento</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="date" name="fecha_nac_tercero" id="fecha_nac_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Tipo de Cliente</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                        <select name="nombre_tipo_cliente" id="nombre_tipo_cliente" class="form-control">
                            <?php $sql_consulta="SELECT * FROM tbl15_tipo_cliente ORDER BY cod_tipo_cliente ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            $codigo = $contenedor['cod_tipo_cliente'];
                            $nombre = $contenedor['nombre_tipo_cliente'];
                            ?>
                            <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Tipo de Regimen</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                        <select name="nombre_tipo_regimen" id="nombre_tipo_regimen" class="form-control">
                            <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo  ""; }
                            $sql_consulta="SELECT * FROM tbl15_tipo_regimen ORDER BY cod_tipo_regimen ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            if(isset($nombre_tipo_regimen) and $nombre_tipo_regimen == $contenedor['nombre_tipo_regimen']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $contenedor['cod_tipo_regimen'];
                            $nombre = $contenedor['nombre_tipo_regimen'];
                            ?>
                            <option style='font-size:20px' value='<?php echo $nombre ?>' <?php echo $seleccionado ?> ><?php echo $nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Tipo de Impuesto</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                        <select name="nombre_tipo_impuesto" id="nombre_tipo_impuesto" class="form-control">
                            <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo  ""; }
                            $sql_consulta="SELECT * FROM tbl15_tipo_impuesto ORDER BY cod_tipo_impuesto ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            if(isset($nombre_tipo_impuesto) and $nombre_tipo_impuesto == $contenedor['nombre_tipo_impuesto']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $contenedor['cod_tipo_impuesto'];
                            $nombre = $contenedor['nombre_tipo_impuesto'];
                            ?>
                            <option style='font-size:20px' value='<?php echo $nombre ?>' <?php echo $seleccionado ?> ><?php echo $nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Pais</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                        <select name="nombre_pais" id="nombre_pais" class="form-control">
                            <?php $sql_consulta="SELECT * FROM tbl15_pais ORDER BY cod_pais ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            $codigo = $contenedor['cod_pais'];
                            $nombre = $contenedor['nombre_pais'];
                            ?>
                            <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Departamento</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                        <select name="nombre_departamento" id="nombre_departamento" class="form-control">
                            <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo  ""; }
                            $sql_consulta="SELECT * FROM tbl15_departamento ORDER BY cod_departamento ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            if(isset($nombre_departamento) and $nombre_departamento == $contenedor['nombre_departamento']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
                            $codigo = $contenedor['cod_departamento'];
                            $nombre = $contenedor['nombre_departamento'];
                            ?>
                            <option style='font-size:20px' value='<?php echo $nombre ?>' <?php echo $seleccionado ?> ><?php echo $nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Ciudad</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="nombre_ciudad" id="nombre_ciudad" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Direccion</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="direccion_tercero" id="direccion_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Telefono</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="telefono1_tercero" id="telefono1_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Correo</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="correo_tercero" id="correo_tercero" value="" class="form-control" placeholder="">
                    </div>

                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">Fax</div>
                    <div class="col-6 bg-success border" style="text-align: center; font-size:20px;">
                    <input type="text" name="fax_tercero" id="fax_tercero" value="" class="form-control" placeholder="">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>-->
                <button type="button" class="btn btn-primary" id="btn_guardar_formulario_nuevo_registro_modal">Guardar Informacion</button>
            </div>
        </div>
        <div id="resultado_mensaje_respuesta_registrar"></div>
    </div>
</div>


<script>
document.getElementById('modal_cuerpo_digito_componente').style.display = 'none';
document.getElementById('modal_cuerpo_digito_titulo').style.display = 'none';

document.getElementById('modal_cuerpo_documento_componente').style.display = 'block';
document.getElementById('modal_cuerpo_documento_titulo').style.display = 'block';

$("#nombre_sino").change(function(){
var nombre_tipo_identificacion = document.getElementById('nombre_sino').value;

    if (nombre_sino=="NIT") {
        document.getElementById('modal_cuerpo_digito_componente').style.display = 'block';
        document.getElementById('modal_cuerpo_digito_titulo').style.display = 'block';
    } else {
        document.getElementById('modal_cuerpo_digito_componente').style.display = 'none';
        document.getElementById('modal_cuerpo_digito_titulo').style.display = 'none';
    };

});

var nombre_sino = $("#nombre_sino").val();

if (nombre_sino=='NO') {
    document.getElementById('modal_cuerpo_documento_componente').style.display = 'none';
    document.getElementById('modal_cuerpo_documento_titulo').style.display = 'none';

} else {
    document.getElementById('modal_cuerpo_documento_componente').style.display = 'block';
    document.getElementById('modal_cuerpo_documento_titulo').style.display = 'block';
}

$("#nombre_sino").change(function(){
var nombre_sino = document.getElementById('nombre_sino').value;

    if (nombre_sino=="NO") {
        document.getElementById('modal_cuerpo_documento_componente').style.display = 'none';
        document.getElementById('modal_cuerpo_documento_titulo').style.display = 'none';
    } else {
        document.getElementById('modal_cuerpo_documento_componente').style.display = 'block';
        document.getElementById('modal_cuerpo_documento_titulo').style.display = 'block';
    };

});
</script>


<script>
$(document).ready(function() {

    $("#btn_guardar_formulario_nuevo_registro_modal").click(function(){
        $('#boton_mas_nombre_estado').show();
        $('#select_nombre_estado').show();
        $('#boton_reg_nombre_estado').hide();
        $('#input_nombre_estado').hide();

        var cod_info_factura_venta = document.getElementById('cod_info_factura_venta').value;
        var nombre_tipo_tercero = document.getElementById('nombre_tipo_tercero').value;
        var nombre_tipo_identificacion = document.getElementById('nombre_tipo_identificacion').value;
        var identificacion_tercero = document.getElementById('identificacion_tercero').value;
        var digito_tercero = document.getElementById('digito_tercero').value;
        var nombre1_tercero = document.getElementById('nombre1_tercero').value;
        var nombre2_tercero = document.getElementById('nombre2_tercero').value;
        var apellido1_tercero = document.getElementById('apellido1_tercero').value;
        var apellido2_tercero = document.getElementById('apellido2_tercero').value;
        var nombre_tipo_cliente = document.getElementById('nombre_tipo_cliente').value;
        var nombre_tipo_regimen = document.getElementById('nombre_tipo_regimen').value;
        var nombre_tipo_impuesto = document.getElementById('nombre_tipo_impuesto').value;
        var nombre_pais = document.getElementById('nombre_pais').value;
        var nombre_departamento = document.getElementById('nombre_departamento').value;
        var nombre_ciudad = document.getElementById('nombre_ciudad').value;
        var direccion_tercero = document.getElementById('direccion_tercero').value;
        var telefono1_tercero = document.getElementById('telefono1_tercero').value;
        var correo_tercero = document.getElementById('correo_tercero').value;
        var fax_tercero = document.getElementById('fax_tercero').value;
        var nombre_sino = document.getElementById('nombre_sino').value;
        var fecha_nac_tercero = document.getElementById('fecha_nac_tercero').value;

        var valor = identificacion_tercero;
        var campo = 'nombres_clientes';
        var tipo_ajax = 'registrar';

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/guardar_registrar_tercero_venta_hotel_select_modal_ajax.php",
        data: "nombre_tipo_tercero="+nombre_tipo_tercero+"&nombre_tipo_identificacion="+nombre_tipo_identificacion+"&nombre_sino="+nombre_sino+"&identificacion_tercero="+identificacion_tercero+"&digito_tercero="+digito_tercero+"&nombre1_tercero="+nombre1_tercero+"&nombre2_tercero="+nombre2_tercero+"&apellido1_tercero="+apellido1_tercero+"&apellido2_tercero="+apellido2_tercero+"&nombre_tipo_cliente="+nombre_tipo_cliente+"&nombre_tipo_regimen="+nombre_tipo_regimen+"&nombre_tipo_impuesto="+nombre_tipo_impuesto+"&nombre_pais="+nombre_pais+"&nombre_departamento="+nombre_departamento+"&nombre_ciudad="+nombre_ciudad+"&direccion_tercero="+direccion_tercero+"&telefono1_tercero="+telefono1_tercero+"&correo_tercero="+correo_tercero+"&fax_tercero="+fax_tercero+"&cod_info_factura_venta="+cod_info_factura_venta+"&fecha_nac_tercero="+fecha_nac_tercero+"&valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
        success: function(resp){
            $('#resultado_mensaje_respuesta_registrar').html(resp);
            Limpiar_campos();
            Cargar_nombre_cliente(valor, campo, tipo_ajax);
            document.getElementById('modal_principal').style.display = 'none';
        }
    });

});

function Cargar_nombre_cliente(valor, campo, tipo_ajax) {
    var capa_cargar_datos = 'cod_tercero';
    $('#'+capa_cargar_datos).load("../admin/recargar_tercero_venta_hotel_select_modal_ajax.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
    location.reload(true);
}

function Limpiar_campos() {
    document.getElementById('nombre_tipo_tercero').value="";
    document.getElementById('nombre_tipo_identificacion').value="";
    document.getElementById('identificacion_tercero').value="";
    document.getElementById('digito_tercero').value="";
    document.getElementById('nombre1_tercero').value="";
    document.getElementById('nombre2_tercero').value="";
    document.getElementById('apellido1_tercero').value="";
    document.getElementById('apellido2_tercero').value="";
    document.getElementById('nombre_tipo_cliente').value="";
    document.getElementById('nombre_tipo_regimen').value="";
    document.getElementById('nombre_tipo_impuesto').value="";
    document.getElementById('nombre_pais').value="";
    document.getElementById('nombre_departamento').value="";
    document.getElementById('nombre_ciudad').value="";
    document.getElementById('direccion_tercero').value="";
    document.getElementById('telefono1_tercero').value="";
    document.getElementById('correo_tercero').value="";
    document.getElementById('fax_tercero').value="";
    document.getElementById('nombre_sino').value="";
}

});
</script>