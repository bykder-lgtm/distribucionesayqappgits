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
                    <h2>Registrar Clientes</h2>
                    <span class="modal_cerrar" id="modal_cerrar">&times;</span>
                </div>

<form method="post" enctype="multipart/form-data" id="formulario_nuevo_registro_modal" name="formulario_nuevo_registro_modal" class="form-horizontal form-label-left input_mask">

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">NOMBRE<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="cedula" id="cedula" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div id="modal_cuerpo_digito" class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">IDENTIFICACIÓN<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="digito" id="digito" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">DIRECCIÓN<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="nombres" id="nombres" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">ESTRATO<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="nombres2" id="nombres2" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">MUNICIPIO<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="apellidos" id="apellidos" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">TELÉFONO<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="ciudad" id="ciudad" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">EMAIL<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="direccion" id="direccion" value="" class="form-control" placeholder="">
                        <!--</div>-->
                        <div class="col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                </div>

                <div class="modal_cuerpo">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-4">OCUPACIÓN<span class="required">:</span></label>
                        <!--<div class="col-md-4 col-sm-4 col-xs-4">-->
                          <input type="text" name="telefono" id="telefono" value="" class="form-control" placeholder="">
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

    $("#btn_guardar_formulario_nuevo_registro_modal").click(function(){
        $('#boton_mas_nombre_estado').show();
        $('#select_nombre_estado').show();
        $('#boton_reg_nombre_estado').hide();
        $('#input_nombre_estado').hide();

        var cod_info_impuesto_facturas = document.getElementById('cod_info_impuesto_facturas').value;
        var cod_factura = document.getElementById('cod_factura').value;
        var nombre_tipo_tercero = document.getElementById('nombre_tipo_tercero').value;
        var nombre_tipo_identificacion = document.getElementById('nombre_tipo_identificacion').value;
        var cedula = document.getElementById('cedula').value;
        var digito = document.getElementById('digito').value;
        var nombres = document.getElementById('nombres').value;
        var nombres2 = document.getElementById('nombres2').value;
        var apellidos = document.getElementById('apellidos').value;
        var apellidos2 = document.getElementById('apellidos2').value;
        var nombre_tipo_cliente = document.getElementById('nombre_tipo_cliente').value;
        var nombre_tipo_regimen = document.getElementById('nombre_tipo_regimen').value;
        var nombre_tipo_impuesto = document.getElementById('nombre_tipo_impuesto').value;
        var nombre_pais = document.getElementById('nombre_pais').value;
        var nombre_departamento = document.getElementById('nombre_departamento').value;
        var ciudad = document.getElementById('ciudad').value;
        var direccion = document.getElementById('direccion').value;
        var telefono = document.getElementById('telefono').value;
        var correo = document.getElementById('correo').value;
        var fax = document.getElementById('fax').value;
        var valor = cedula;
        var campo = 'nombres_clientes';
        var tipo_ajax = 'registrar';

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/guardar_consulta_select_ajax.php",
        data: "nombre_tipo_tercero="+nombre_tipo_tercero+"&nombre_tipo_identificacion="+nombre_tipo_identificacion+"&cedula="+cedula+"&digito="+digito+"&nombres="+nombres+"&nombres2="+nombres2+"&apellidos="+apellidos+"&apellidos2="+apellidos2+"&nombre_tipo_cliente="+nombre_tipo_cliente+"&nombre_tipo_regimen="+nombre_tipo_regimen+"&nombre_tipo_impuesto="+nombre_tipo_impuesto+"&nombre_pais="+nombre_pais+"&nombre_departamento="+nombre_departamento+"&ciudad="+ciudad+"&direccion="+direccion+"&telefono="+telefono+"&correo="+correo+"&fax="+fax+"&cod_info_impuesto_facturas="+cod_info_impuesto_facturas+"&cod_factura="+cod_factura+"&valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
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
}

function Limpiar_campos() {
    document.getElementById('nombre_tipo_tercero').value="";
    document.getElementById('nombre_tipo_identificacion').value="";
    document.getElementById('cedula').value="";
    document.getElementById('digito').value="";
    document.getElementById('nombres').value="";
    document.getElementById('nombres2').value="";
    document.getElementById('apellidos').value="";
    document.getElementById('apellidos2').value="";
    document.getElementById('nombre_tipo_cliente').value="";
    document.getElementById('nombre_tipo_regimen').value="";
    document.getElementById('nombre_tipo_impuesto').value="";
    document.getElementById('nombre_pais').value="";
    document.getElementById('nombre_departamento').value="";
    document.getElementById('ciudad').value="";
    document.getElementById('direccion').value="";
    document.getElementById('telefono').value="";
    document.getElementById('correo').value="";
    document.getElementById('fax').value="";
}

});
</script>