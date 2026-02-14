<!--<script src="../js/jquery.min.js"></script>-->
<?php 
$nombre_tipo_regimen       = 'SIMPLE';
$nombre_tipo_impuesto      = 'NO_RESPONSABLE_DE_IVA';
$nombre_departamento       = 'CORDOBA';
?>
    <div id="modal_principal" class="modal_principal">
        <div class="flex" id="flex">
            <div class="modal_contenido">

                <div class="modal-header flex">
                    <h2>Registrar Terceros</h2>
                    <span class="modal_cerrar" id="modal_cerrar">&times;</span>
                </div>

                <form method="post" enctype="multipart/form-data" id="formulario_nuevo_registro_modal" name="formulario_nuevo_registro_modal" class="form-horizontal form-label-left input_mask">
                    <input type="hidden" name="cod_info_impuesto_facturas_hidden" id="cod_info_parqueo_cotizacion_factura_venta" value="<?php echo $cod_info_parqueo_cotizacion_factura_venta ?>" placeholder="">

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4"><span class="required"></span></label>
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_tipo_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Tipo de Tercero<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_tipo_identificacion_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Tipo de Documento<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                            <select name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" class="form-control">
                            <?php $sql_consulta="SELECT * FROM tbl15_tipo_identificacion ORDER BY cod_tipo_identificacion ASC";
                            $resultado = mysqli_query($conectar, $sql_consulta);
                            while ($contenedor=mysqli_fetch_array($resultado)) { 
                            $codigo = $contenedor['cod_tipo_identificacion'];
                            $nombre = $contenedor['nombre_tipo_identificacion'];
                            ?>
                            <option style="font-size:20px" value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                            <?php } ?>
                            </select>
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>


                <div class="modal_cuerpo" id="nombre_sino_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">¿Tiene Documento?<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="identificacion_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Documento<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="identificacion_tercero" id="identificacion_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>


                <div id="error_identificacion_repetida"></div>


                <div class="modal_cuerpo" id="digito_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Digito de Verificacion<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="digito_tercero" id="digito_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre1_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Primer Nombre<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="nombre1_tercero" id="nombre1_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre2_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Segundo Nombre<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="nombre2_tercero" id="nombre2_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="apellido1_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Primer Apellido<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="apellido1_tercero" id="apellido1_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="apellido2_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Segundo Apellido<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="apellido2_tercero" id="apellido2_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="fecha_nac_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Fecha Nacimiento<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="date" name="fecha_nac_tercero" id="fecha_nac_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_tipo_cliente_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Tipo de Cliente<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_tipo_regimen_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Tipo de Regimen<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_tipo_impuesto_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Tipo de Impuesto<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_pais_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Pais<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_departamento_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Departamento<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
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
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="nombre_ciudad_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Ciudad<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="nombre_ciudad" id="nombre_ciudad" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="direccion_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Direccion<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="direccion_tercero" id="direccion_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="telefono1_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Telefono<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="telefono1_tercero" id="telefono1_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="correo_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Correo<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="correo_tercero" id="correo_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo" id="fax_tercero_div">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">Fax<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="fax_tercero" id="fax_tercero" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                        <div class="ln_solid"></div>

<div id="resultado_mensaje_respuesta_registrar"></div>

                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                      <a href="#" id="btn_guardar_formulario_nuevo_registro_modal" class="btn btn-success"><img src="../imagenes/btn_guardar.png" alt="Guardar Informacion"></a>
                    </div>
                </div>

</form>
            </div>
        </div>
    </div>

<script>
let modal_principal = document.getElementById('modal_principal');
let flex = document.getElementById('flex');
let modal_abrir = document.getElementById('modal_abrir');
let modal_cerrar = document.getElementById('modal_cerrar');

modal_abrir.addEventListener('click', function(){
    modal_principal.style.display = 'block';
});

modal_cerrar.addEventListener('click', function(){
    modal_principal.style.display = 'none';
});

window.addEventListener('click', function(e){
    //console.log(e.target);
    if(e.target == flex){
        modal_principal.style.display = 'none';
    }
});
</script>

<script>
$(document).ready(function() {

    var cod_estado_modal_tercero_nombre_tipo_tercero_global = <?php echo $cod_estado_modal_tercero_nombre_tipo_tercero_global; ?> ;
    var cod_estado_modal_tercero_nombre_tipo_identificacion_global = <?php echo $cod_estado_modal_tercero_nombre_tipo_identificacion_global; ?> ;
    var cod_estado_modal_tercero_nombre_sino_global = <?php echo $cod_estado_modal_tercero_nombre_sino_global; ?> ;
    var cod_estado_modal_tercero_identificacion_tercero_global = <?php echo $cod_estado_modal_tercero_identificacion_tercero_global; ?> ;
    var cod_estado_modal_tercero_digito_tercero_global = <?php echo $cod_estado_modal_tercero_digito_tercero_global; ?> ;
    var cod_estado_modal_tercero_nombre1_tercero_global = <?php echo $cod_estado_modal_tercero_nombre1_tercero_global; ?> ;
    var cod_estado_modal_tercero_nombre2_tercero_global = <?php echo $cod_estado_modal_tercero_nombre2_tercero_global; ?> ;
    var cod_estado_modal_tercero_apellido1_tercero_global = <?php echo $cod_estado_modal_tercero_apellido1_tercero_global; ?> ;
    var cod_estado_modal_tercero_apellido2_tercero_global = <?php echo $cod_estado_modal_tercero_apellido2_tercero_global; ?> ;
    var cod_estado_modal_tercero_fecha_nac_tercero_global = <?php echo $cod_estado_modal_tercero_fecha_nac_tercero_global; ?> ;
    var cod_estado_modal_tercero_nombre_tipo_cliente_global = <?php echo $cod_estado_modal_tercero_nombre_tipo_cliente_global; ?> ;
    var cod_estado_modal_tercero_nombre_tipo_regimen_global = <?php echo $cod_estado_modal_tercero_nombre_tipo_regimen_global; ?> ;
    var cod_estado_modal_tercero_nombre_tipo_impuesto_global = <?php echo $cod_estado_modal_tercero_nombre_tipo_impuesto_global; ?> ;
    var cod_estado_modal_tercero_nombre_pais_global = <?php echo $cod_estado_modal_tercero_nombre_pais_global; ?> ;
    var cod_estado_modal_tercero_nombre_departamento_global = <?php echo $cod_estado_modal_tercero_nombre_departamento_global; ?> ;
    var cod_estado_modal_tercero_nombre_ciudad_global = <?php echo $cod_estado_modal_tercero_nombre_ciudad_global; ?> ;
    var cod_estado_modal_tercero_direccion_tercero_global = <?php echo $cod_estado_modal_tercero_direccion_tercero_global; ?> ;
    var cod_estado_modal_tercero_telefono1_tercero_global = <?php echo $cod_estado_modal_tercero_telefono1_tercero_global; ?> ;
    var cod_estado_modal_tercero_correo_tercero_global = <?php echo $cod_estado_modal_tercero_correo_tercero_global; ?> ;
    var cod_estado_modal_tercero_fax_tercero_global = <?php echo $cod_estado_modal_tercero_fax_tercero_global; ?> ;

    if (cod_estado_modal_tercero_nombre_tipo_tercero_global == '0') { $('#nombre_tipo_tercero_div').hide(); }
    if (cod_estado_modal_tercero_nombre_tipo_identificacion_global == '0') { $('#nombre_tipo_identificacion_div').hide(); }
    if (cod_estado_modal_tercero_nombre_sino_global == '0') { $('#nombre_sino_div').hide(); }
    if (cod_estado_modal_tercero_identificacion_tercero_global == '0') { $('#identificacion_tercero_div').hide(); }
    if (cod_estado_modal_tercero_digito_tercero_global == '0') { $('#digito_tercero_div').hide(); }
    if (cod_estado_modal_tercero_nombre1_tercero_global == '0') { $('#nombre1_tercero_div').hide(); }
    if (cod_estado_modal_tercero_nombre2_tercero_global == '0') { $('#nombre2_tercero_div').hide(); }
    if (cod_estado_modal_tercero_apellido1_tercero_global == '0') { $('#apellido1_tercero_div').hide(); }
    if (cod_estado_modal_tercero_apellido2_tercero_global == '0') { $('#apellido2_tercero_div').hide(); }
    if (cod_estado_modal_tercero_fecha_nac_tercero_global == '0') { $('#fecha_nac_tercero_div').hide(); }
    if (cod_estado_modal_tercero_nombre_tipo_cliente_global == '0') { $('#nombre_tipo_cliente_div').hide(); }
    if (cod_estado_modal_tercero_nombre_tipo_regimen_global == '0') { $('#nombre_tipo_regimen_div').hide(); }
    if (cod_estado_modal_tercero_nombre_tipo_impuesto_global == '0') { $('#nombre_tipo_impuesto_div').hide(); }
    if (cod_estado_modal_tercero_nombre_pais_global == '0') { $('#nombre_pais').hide(); }
    if (cod_estado_modal_tercero_nombre_departamento_global == '0') { $('#nombre_departamento_div').hide(); }
    if (cod_estado_modal_tercero_nombre_ciudad_global == '0') { $('#nombre_ciudad_div').hide(); }
    if (cod_estado_modal_tercero_direccion_tercero_global == '0') { $('#direccion_tercero_div').hide(); }
    if (cod_estado_modal_tercero_telefono1_tercero_global == '0') { $('#telefono1_tercero_div').hide(); }
    if (cod_estado_modal_tercero_correo_tercero_global == '0') { $('#correo_tercero_div').hide(); }
    if (cod_estado_modal_tercero_fax_tercero_global == '0') { $('#fax_tercero_div').hide(); }
    
});
</script>

<script>
document.getElementById('digito_tercero_div').style.display = 'none';
document.getElementById('identificacion_tercero_div').style.display = 'block';

$("#nombre_sino").change(function(){
var nombre_tipo_identificacion = document.getElementById('nombre_sino').value;

    if (nombre_sino=="NIT") {
        document.getElementById('digito_tercero_div').style.display = 'block';
    } else {
        document.getElementById('digito_tercero_div').style.display = 'none';
    };

});

var nombre_sino = $("#nombre_sino").val();

if (nombre_sino=='NO') {
    document.getElementById('identificacion_tercero_div').style.display = 'none';
} else {
    document.getElementById('identificacion_tercero_div').style.display = 'block';
}

$("#nombre_sino").change(function(){
var nombre_sino = document.getElementById('nombre_sino').value;

    if (nombre_sino=="NO") {
        document.getElementById('identificacion_tercero_div').style.display = 'none';
    } else {
        document.getElementById('identificacion_tercero_div').style.display = 'block';
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

        var cod_info_parqueo_cotizacion_factura_venta = document.getElementById('cod_info_parqueo_cotizacion_factura_venta').value;
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
        url: "../admin/guardar_consulta_tercero_parqueo_select_ajax.php",
        data: "nombre_tipo_tercero="+nombre_tipo_tercero+"&nombre_tipo_identificacion="+nombre_tipo_identificacion+"&nombre_sino="+nombre_sino+"&identificacion_tercero="+identificacion_tercero+"&digito_tercero="+digito_tercero+"&nombre1_tercero="+nombre1_tercero+"&nombre2_tercero="+nombre2_tercero+"&apellido1_tercero="+apellido1_tercero+"&apellido2_tercero="+apellido2_tercero+"&nombre_tipo_cliente="+nombre_tipo_cliente+"&nombre_tipo_regimen="+nombre_tipo_regimen+"&nombre_tipo_impuesto="+nombre_tipo_impuesto+"&nombre_pais="+nombre_pais+"&nombre_departamento="+nombre_departamento+"&nombre_ciudad="+nombre_ciudad+"&direccion_tercero="+direccion_tercero+"&telefono1_tercero="+telefono1_tercero+"&correo_tercero="+correo_tercero+"&fax_tercero="+fax_tercero+"&cod_info_parqueo_cotizacion_factura_venta="+cod_info_parqueo_cotizacion_factura_venta+"&fecha_nac_tercero="+fecha_nac_tercero+"&valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
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
    $('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo, 'tipo_ajax': tipo_ajax });
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