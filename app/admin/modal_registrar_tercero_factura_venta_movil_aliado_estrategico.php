    <style>
        .modal-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 1.5rem;
            border: none;
        }
        .modal-header-custom .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        .modal-header-custom .modal-title i {
            font-size: 2rem;
            margin-right: 0.8rem;
            animation: pulse 2s infinite;
        }
        .modal-header-custom .close {
            color: white;
            opacity: 1;
            text-shadow: none;
            font-size: 2rem;
        }
        .modal-content-custom {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .form-group-icon {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-group-icon label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        .form-group-icon label i {
            margin-right: 0.5rem;
            color: #667eea;
            font-size: 1.1rem;
        }
        .form-group-icon .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .form-group-icon .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }
        .form-group-icon select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }
        .btn-save-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-save-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .btn-save-custom i {
            margin-right: 0.5rem;
        }
        .btn-cancel-custom {
            background: #e2e8f0;
            border: none;
            color: #4a5568;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-cancel-custom:hover {
            background: #cbd5e0;
            transform: translateY(-2px);
        }
        .section-divider {
            display: flex;
            align-items: center;
            margin: 2rem 0 1.5rem 0;
        }
        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #e2e8f0;
        }
        .section-divider span {
            padding: 0 1rem;
            color: #667eea;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        #mensaje_verificacion_documento {
            margin-bottom: 1.5rem;
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .alert-verificacion {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            font-weight: 500;
            animation: slideDown 0.4s ease-out;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .alert-verificacion i {
            font-size: 1.5rem;
            margin-right: 1rem;
            animation: bounceIn 0.6s ease-out;
        }
        .alert-verificacion-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        .alert-verificacion-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        .alert-verificacion-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        .alert-verificacion-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes bounceIn {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
        .required-star {
            color: #f56565;
            margin-left: 0.2rem;
        }
    </style>

<?php $nombre_estado_civil = 'SOLTERO/A';  ?>
    <div class="modal fade abrir_registrar_datos_tercero_factura_venta_movil_aliado_estrategico" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-content-custom">

                <div class="modal-header modal-header-custom">
                    <h4 class="modal-title" id=""><i class="fa fa-user-plus"></i> Registrar Nuevo Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body" style="padding: 2rem;">

                    <div id="mensaje_verificacion_documento"></div>

                    <!-- Sección: Identificación -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group-icon">
                                <label><i class="fa fa-id-card"></i> Documento<span class="required-star">*</span></label>
                                <input type="number" class="form-control" id="mod_<?php echo 'identificacion_tercero' ?>" name="identificacion_tercero" placeholder="Ingrese número de identificación" data-error="Por favor, escriba su numero de identificación" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Datos Personales -->
                    <div class="section-divider">
                        <span><i class="fa fa-user"></i> Datos Personales</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-user"></i> Primer Nombre<span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="mod_<?php echo 'nombre1_tercero' ?>" name="nombre1_tercero" placeholder="Ej: Juan" data-error="Por favor, ingrese su primer nombre" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-user"></i> Segundo Nombre</label>
                                <input type="text" class="form-control" id="mod_<?php echo 'nombre2_tercero' ?>" name="nombre2_tercero" placeholder="Ej: Carlos" data-error="Por favor, ingrese su segundo nombre" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-user"></i> Primer Apellido<span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="mod_<?php echo 'apellido1_tercero' ?>" name="apellido1_tercero" placeholder="Ej: Pérez" data-error="Por favor, ingrese su primer apellido" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-user"></i> Segundo Apellido</label>
                                <input type="text" class="form-control" id="mod_<?php echo 'apellido2_tercero' ?>" name="apellido2_tercero" placeholder="Ej: López" data-error="Por favor, ingrese su segundo apellido" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Información de Contacto -->
                    <div class="section-divider">
                        <span><i class="fa fa-phone"></i> Información de Contacto</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-mobile"></i> Celular<span class="required-star">*</span></label>
                                <input type="number" class="form-control" id="mod_<?php echo 'telefono1_tercero' ?>" name="telefono1_tercero" placeholder="Ej: 3001234567" data-error="Por favor, ingrese su Celular" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-envelope"></i> Correo Electrónico</label>
                                <input type="email" class="form-control" id="mod_<?php echo 'correo_tercero' ?>" name="correo_tercero" placeholder="correo@ejemplo.com" data-error="Por favor, ingrese su Correo" />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-map-marker"></i> Dirección<span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="mod_<?php echo 'direccion_tercero' ?>" name="direccion_tercero" placeholder="Ej: Calle 123 #45-67" data-error="Por favor, ingrese su Dirección" required/>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-icon">
                                <label><i class="fa fa-heart"></i> Estado Civil</label>
                                <select id="mod_<?php echo 'nombre_estado_civil' ?>" name="nombre_estado_civil" class="form-control" required>
                                    <option value="">Seleccione...</option>
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
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-save-custom btn-lg btn-block" id="btn_registrar_tercero_movil_aliado_estrategico_modal" type="submit">
                                <i class="fa fa-save"></i> Guardar Cliente
                            </button>
                        </div>
                    </div>

                </div>
                
                <div class="modal-footer" style="border-top: 2px solid #e2e8f0; padding: 1rem 2rem;">
                    <button type="button" class="btn btn-cancel-custom" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->

<script>
//$(document).ready(function(){
    $("#btn_registrar_tercero_movil_aliado_estrategico_modal").click(function(){

        // Validar campos obligatorios
        var identificacion_tercero = document.getElementById('mod_'+'identificacion_tercero').value;
        var nombre1_tercero = document.getElementById('mod_'+'nombre1_tercero').value;
        var apellido1_tercero = document.getElementById('mod_'+'apellido1_tercero').value;
        var telefono1_tercero = document.getElementById('mod_'+'telefono1_tercero').value;
        var direccion_tercero = document.getElementById('mod_'+'direccion_tercero').value;

        // Validación de campos requeridos
        if(!identificacion_tercero || !nombre1_tercero || !apellido1_tercero || !telefono1_tercero || !direccion_tercero) {
            var mensajeHTML = '<div class="alert-verificacion alert-verificacion-warning">' +
                             '<i class="fa fa-exclamation-triangle"></i>' +
                             '<div><strong>¡Campos Incompletos!</strong><br>Por favor complete todos los campos obligatorios (*).</div>' +
                             '</div>';
            $("#mensaje_verificacion_documento").html(mensajeHTML);
            return false;
        }

        var nombre2_tercero = document.getElementById('mod_'+'nombre2_tercero').value;
        var apellido2_tercero = document.getElementById('mod_'+'apellido2_tercero').value;
        var correo_tercero = document.getElementById('mod_'+'correo_tercero').value;
        var nombre_estado_civil = document.getElementById('mod_'+'nombre_estado_civil').value;

        var datos_url_ajax = "identificacion_tercero="+identificacion_tercero+"&nombre1_tercero="+nombre1_tercero+"&nombre2_tercero="+nombre2_tercero+"&apellido1_tercero="+apellido1_tercero+"&apellido2_tercero="+apellido2_tercero+"&telefono1_tercero="+telefono1_tercero+"&correo_tercero="+correo_tercero+"&direccion_tercero="+direccion_tercero+"&nombre_estado_civil="+nombre_estado_civil;
        $.ajax({
            type: "POST",
            url: "../admin/reg_tercero_cliente_modal_movil_ajax_reg.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#btn_registrar_tercero_movil_aliado_estrategico_modal').html('<i class="fa fa-spinner fa-spin"></i> Guardando...');
                $('#btn_registrar_tercero_movil_aliado_estrategico_modal').prop('disabled', true);
                
                var mensajeHTML = '<div class="alert-verificacion alert-verificacion-info">' +
                                 '<i class="fa fa-spinner fa-spin"></i>' +
                                 '<div><strong>Procesando...</strong><br>Guardando información del cliente.</div>' +
                                 '</div>';
                $("#mensaje_verificacion_documento").html(mensajeHTML);
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                var cod_tercero = respuesta.cod_tercero;
                var mensaje = respuesta.mensaje;
                console.log('afectado AJAX:', afectado);
                
                // Mostrar mensaje de éxito antes de recargar
                var mensajeHTML = '<div class="alert-verificacion alert-verificacion-success">' +
                                 '<i class="fa fa-check-circle"></i>' +
                                 '<div><strong>¡Guardado Exitoso!</strong><br>Cliente registrado correctamente.</div>' +
                                 '</div>';
                $("#mensaje_verificacion_documento").html(mensajeHTML);
                
                // Recargar después de 1 segundo para que vea el mensaje
                setTimeout(function(){
                    //window.location.reload();
                    window.location.replace("../admin/lista_info_factura_venta_siscredito_visitante_intern_aliado_movil.php?cod_info_factura_venta="+cod_info_factura_venta+"&cod_tercero="+cod_tercero);
                }, 1500);
            },
            error: function(xhr, status, error) {
                var mensajeHTML = '<div class="alert-verificacion alert-verificacion-error">' +
                                 '<i class="fa fa-times-circle"></i>' +
                                 '<div><strong>¡Error!</strong><br>No se pudo guardar el cliente. Intente nuevamente.</div>' +
                                 '</div>';
                $("#mensaje_verificacion_documento").html(mensajeHTML);
                $('#btn_registrar_tercero_movil_aliado_estrategico_modal').html('<i class="fa fa-save"></i> Guardar Cliente');
                $('#btn_registrar_tercero_movil_aliado_estrategico_modal').prop('disabled', false);
            }
        });

    });
//});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#mod_"+"identificacion_tercero").on('change', function () {
        var identificacion_tercero = $(this).val();
        
        // Validar que tenga al menos 5 dígitos
        if(identificacion_tercero.length < 5) {
            var mensajeHTML = '<div class="alert-verificacion alert-verificacion-warning">' +
                             '<i class="fa fa-exclamation-circle"></i>' +
                             '<div><strong>Documento Inválido</strong><br>El documento debe tener al menos 5 dígitos.</div>' +
                             '</div>';
            $("#mensaje_verificacion_documento").html(mensajeHTML);
            return;
        }
        
        var campo = "identificacion_tercero";
        var tipo_ajax = "";
        var pagina_local = "";
        var foco = '';

        var datos_url_ajax = 'identificacion_tercero='+identificacion_tercero+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax;
        $.ajax({
            type: "POST",
            url: "../admin/verificar_existencia_siscredito_tercero_cliente_modal_movil_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                var mensajeHTML = '<div class="alert-verificacion alert-verificacion-info">' +
                                 '<i class="fa fa-spinner fa-spin"></i>' +
                                 '<div><strong>Verificando...</strong><br>Buscando documento en la base de datos.</div>' +
                                 '</div>';
                $("#mensaje_verificacion_documento").html(mensajeHTML);
            },
            success:function(respuesta){
                var emisor = respuesta.emisor;
                var resultado = respuesta.resultado;
                var ok_ajax = respuesta.ok_ajax;
                var mensaje = respuesta.mensaje;

                var identificacion_tercero = respuesta.identificacion_tercero;
                var nombre1_tercero = respuesta.nombre1_tercero;
                var nombre2_tercero = respuesta.nombre2_tercero;
                var apellido1_tercero = respuesta.apellido1_tercero;
                var apellido2_tercero = respuesta.apellido2_tercero;
                var fecha_nac_tercero = respuesta.fecha_nac_tercero;
                var fecha_expedicion_tercero = respuesta.fecha_expedicion_tercero;
                var telefono1_tercero = respuesta.telefono1_tercero;
                var correo_tercero = respuesta.correo_tercero;
                var direccion_tercero = respuesta.direccion_tercero;

                if (resultado > '0') {
                    $("#mod_"+"nombre1_tercero").val(nombre1_tercero);
                    $("#mod_"+"nombre2_tercero").val(nombre2_tercero);
                    $("#mod_"+"apellido1_tercero").val(apellido1_tercero);
                    $("#mod_"+"apellido2_tercero").val(apellido2_tercero);
                    $("#mod_"+"fecha_nac_tercero").val(fecha_nac_tercero);
                    $("#mod_"+"fecha_expedicion_tercero").val(fecha_expedicion_tercero);
                    $("#mod_"+"telefono1_tercero").val(telefono1_tercero);
                    $("#mod_"+"correo_tercero").val(correo_tercero);
                    $("#mod_"+"direccion_tercero").val(direccion_tercero);
                    
                    // Mostrar mensaje con diseño atractivo
                    var mensajeHTML = '<div class="alert-verificacion alert-verificacion-success">' +
                                     '<i class="fa fa-check-circle"></i>' +
                                     '<div><strong>¡Cliente Encontrado!</strong><br>' + mensaje + '</div>' +
                                     '</div>';
                    $("#mensaje_verificacion_documento").html(mensajeHTML);
                    $("#"+"nombre_boton_accion").html("Continuar");
                    //$("#submit").attr("disabled",true);
                } else {
                    // Mostrar mensaje de nuevo cliente
                    var mensajeHTML = '<div class="alert-verificacion alert-verificacion-info">' +
                                     '<i class="fa fa-info-circle"></i>' +
                                     '<div><strong>Nuevo Cliente</strong><br>Complete los datos para registrar.</div>' +
                                     '</div>';
                    $("#mensaje_verificacion_documento").html(mensajeHTML);
                    $("#submit").attr("disabled",false);
                }
            },
            error: function(xhr, status, error) {
                var mensajeHTML = '<div class="alert-verificacion alert-verificacion-error">' +
                                 '<i class="fa fa-times-circle"></i>' +
                                 '<div><strong>Error de Conexión</strong><br>No se pudo verificar el documento. Intente nuevamente.</div>' +
                                 '</div>';
                $("#mensaje_verificacion_documento").html(mensajeHTML);
            }
        });
    });
});
</script>