<?php 
$nombre_pagina = "Gestión de Solicitudes";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_inicio_sesion_adm_coordinador.php"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_info_empresa_adm_coordinador.php"; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- **************************************************** MODULO DE PLANTILLAS META ******************************************** -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<?php include "../admin/02_admin_modulo_estilo_css_adm_coordinador.php"; ?>
<link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
<script src="../js/sweetalert2.min_adm_tick.js"></script>
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<title><?php echo $nombre_pagina." | ".$nombre ?> </title>
    </head>
    <body class="nav-md">
<?php
$cod_seguridad                       = '25'; //CLIENTE 
$nombre_tipo_tercero_text            = ucfirst(strtolower('CLIENTE'));
$buscar_por                          = "nombre1_tercero_identificacion_tercero";
$nombre_estado_factura               = "ABIERTA";
?>
<!-- **************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
<?php include "../admin/03_admin_modulo_menu_navegacion_adm_coordinador.php"; ?>
<!-- 1**************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".abrir_modal_registrar_tienda"><i class="fa fa-plus-circle"></i> Registrar Tienda</button></div>
                        <!-- Form search -->
                         <br>
                        <form class="form-horizontal" role="form" id="ingresos">
<!--
                            <div class="col-md-1">
                                <select class="form-control" id="numero_registro_por_pagina" onchange='load(1);'>
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                    <option value="300">300</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                    <option value="9999999" selected>Todos</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" id="buscar_por" onchange='load(1);'>
                                    <option value="nombre1_tercero_identificacion_tercero" selected>Nombre / Cédula / Entidad</option>
                                    <option value="nombre1_tercero">Nombre</option>
                                    <option value="identificacion_tercero">Cédula</option>
                                </select>
                            </div>
-->
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="busqueda_ajax" placeholder="Buscar" onkeyup='load(1);'>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" onclick='load(1);'>
                                    <span class="glyphicon glyphicon-search"></span> Buscar
                                </button>
                                <span id="loader"></span>
                            </div>
                            <input type="hidden" id="cod_administrador" value="<?php echo $cod_administrador ?>">
                            <input type="hidden" id="cod_seguridad" value="<?php echo $cod_seguridad ?>">
                            <input type="hidden" id="tabla" value="tbl15_tercero">
                        </form>
                        <!-- end Form search -->
                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
<?php include "../admin/04_admin_modulo_footer_adm_coordinador.php"; ?>
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
            </div>
        </div>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include "../admin/05_admin_modulo_js_adm_coordinador.php"; ?>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!--<script src="../js/ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<!--<script src="../js/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>-->
    </body>
</html>
<!-- ****************************************************************************************************** -->
<!-- Modal Registrar Tienda -->
<div class="modal fade abrir_modal_registrar_tienda" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Tienda</h4>
            </div>
            <div class="modal-body">
                <div id="result_register"></div>
                <form id="form_reg_aliado" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nit *</label>
                                <input type="number" name="identificacion_tercero" id="identificacion_tercero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Tienda *</label>
                                <input type="text" name="nombre1_tercero" id="nombre1_tercero" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Aliado Estrategico *</label>
                                <select name="cod_aliado_estrategico" id="cod_aliado_estrategico" class="form-control" required>
                                    <?php $cod_aliado_estrategico = 0;
                                    if (isset($cod_aliado_estrategico)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_seguridad = '23') AND (cod_estado_activacion_usuario = '1') ORDER BY nombres_apellidos_tercero ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_aliado_estrategico) and $cod_aliado_estrategico == $datos2['cod_administrador']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_administrador'];
                                    $nombre = $datos2['nombres_apellidos_tercero'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono *</label>
                                <input type="text" name="telefono1_tercero" id="telefono1_tercero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo *</label>
                                <input type="email" name="correo_tercero" id="correo_tercero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" name="direccion_tercero" id="direccion_tercero" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Información del Representante -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-user-tie"></i> Información del Representante</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Representante</label>
                                <input type="text" name="nombre_representante" id="nombre_representante" class="form-control" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Documento Representante</label>
                                <input type="number" name="documento_representante" id="documento_representante" class="form-control" max="999999999">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo Representante</label>
                                <input type="email" name="correo_representante" id="correo_representante" class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Información del Negocio -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-building"></i> Información del Negocio</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Industria</label>
                                <input type="text" name="nombre_tipo_industria" id="nombre_tipo_industria" class="form-control" maxlength="30" placeholder="Ej: Comercio, Servicios">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub-Industria</label>
                                <input type="text" name="nombre_tipo_subindustria" id="nombre_tipo_subindustria" class="form-control" maxlength="30" placeholder="Ej: Retail, Restaurante">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Otra Industria</label>
                                <input type="text" name="nombre_tipo_otraindustria" id="nombre_tipo_otraindustria" class="form-control" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>¿Existe RUES? </label>
                                <select name="existe_rues" id="existe_rues" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Venta Presencial </label>
                                <select name="venta_presencial" id="venta_presencial" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Venta Online </label>
                                <select name="venta_online" id="venta_online" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Plataformas y Sistemas -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-laptop-code"></i> Plataformas y Sistemas</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Plataforma E-commerce</label>
                                <input type="text" name="nombre_plataforma_ecommerce" id="nombre_plataforma_ecommerce" class="form-control" maxlength="50" placeholder="Ej: Shopify, WooCommerce, Prestashop">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sistema Contable</label>
                                <input type="text" name="nombre_sistema_contable" id="nombre_sistema_contable" class="form-control" maxlength="50" placeholder="Ej: Siigo, Alegra, QuickBooks">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Información Financiera -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-dollar-sign"></i> Información Financiera</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Comisión (%) *</label>
                                <input type="number" name="comision_ptj" id="comision_ptj" class="form-control" required step="0.01" min="0" max="99.99" placeholder="Ej: 5.50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Banco de Cuenta * <small style="color: #6c757d;">(Primero seleccione un Aliado)</small></label>
                                <div class="input-group">
                                    <select name="cod_banco_cuenta" id="cod_banco_cuenta" class="form-control" required disabled><option value="">-- Seleccione primero un Aliado --</option></select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success" id="btn_agregar_banco" title="Agregar nuevo banco" disabled><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                                <div id="banco_loading" style="display:none; color:#00d4ff; margin-top:5px;"><i class="fa fa-spinner fa-spin"></i> Cargando bancos...</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Ubicación GPS -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-map-marker-alt"></i> Ubicación GPS</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Coordenadas GPS</label>
                                <input type="text" name="ubicacion_gps_tienda" id="ubicacion_gps_tienda" class="form-control" placeholder="Ej: 4.7110,-74.0721" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-success btn-block" onclick="obtenerUbicacionGPS()">
                                    <i class="fa fa-crosshairs"></i> Obtener Ubicación
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="gps_status" style="display:none; padding: 8px; border-radius: 4px; margin-bottom: 10px;"></div>

                    <!-- Sección: Documentación Legal -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-folder-open"></i> Documentación Legal</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-file-pdf"></i> RUT de la Tienda</label>
                                <input type="file" name="url_documentacion_rut_tienda" id="url_documentacion_rut_tienda" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-file-pdf"></i> Cámara de Comercio</label>
                                <input type="file" name="url_documentacion_camaracomercio_tienda" id="url_documentacion_camaracomercio_tienda" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-file-signature"></i> Contrato Firmado</label>
                                <input type="file" name="url_documentacion_contratofirma_tienda" id="url_documentacion_contratofirma_tienda" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-file-alt"></i> Documentación Extra (Opcional)</label>
                                <input type="file" name="url_documentacion_extra1_tienda" id="url_documentacion_extra1_tienda" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Imágenes del Establecimiento -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-camera"></i> Imágenes del Establecimiento</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-store-alt"></i> Logo/Imagen de la Tienda</label>
                                <input type="file" name="imagen_tienda" id="imagen_tienda" class="form-control" accept="image/*">
                                <img id="preview_img_tienda" src="" style="display:none; max-width:100px; margin-top:10px; border-radius:8px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-store-alt"></i> Imagen de la Fachada</label>
                                <input type="file" name="url_img_fachada_tienda" id="url_img_fachada_tienda" class="form-control" accept="image/*">
                                <img id="preview_img_fachada" src="" style="display:none; max-width:100px; margin-top:10px; border-radius:8px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-door-open"></i> Imagen Interna de la Tienda</label>
                                <input type="file" name="url_img_interna_tienda" id="url_img_interna_tienda" class="form-control" accept="image/*">
                                <img id="preview_img_interna" src="" style="display:none; max-width:100px; margin-top:10px; border-radius:8px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-user-circle"></i> Selfie del Administrador en la Tienda</label>
                                <input type="file" name="url_img_selfieadmin_tienda" id="url_img_selfieadmin_tienda" class="form-control" accept="image/*">
                                <img id="preview_img_selfieadmin" src="" style="display:none; max-width:100px; margin-top:10px; border-radius:8px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-image"></i> Otra Imagen (Opcional)</label>
                                <input type="file" name="url_img_otraopcional_tienda" id="url_img_otraopcional_tienda" class="form-control" accept="image/*">
                                <img id="preview_img_otraopcional" src="" style="display:none; max-width:100px; margin-top:10px; border-radius:8px;">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="tabla" value="tbl15_administrador">
                    <input type="hidden" name="cod_seguridad" value="<?php echo $cod_seguridad; ?>">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_guardar_aliado">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Nuevo Banco -->
<div class="modal fade" id="modalNuevoBanco" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-university"></i> Registrar Nueva Cuenta Bancaria</h4>
            </div>
            <div class="modal-body">
                <div id="result_register_banco"></div>
                <form id="form_reg_banco" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombre del Banco *</label>
                                <input type="text" name="nombre_banco_cuenta_new" id="nombre_banco_cuenta_new" class="form-control" required maxlength="100" placeholder="Ej: Bancolombia, Davivienda">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Número de Cuenta *</label>
                                <input type="text" name="numero_banco_cuenta_new" id="numero_banco_cuenta_new" class="form-control" required maxlength="30" placeholder="Número de la cuenta">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo de Cuenta *</label>
                                <select name="tipo_cuenta_new" id="tipo_cuenta_new" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="AHORROS">Ahorros</option>
                                    <option value="CORRIENTE">Corriente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre del Titular *</label>
                                <input type="text" name="nombre_titular_cuenta_new" id="nombre_titular_cuenta_new" class="form-control" required maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Documento del Titular</label>
                                <input type="number" name="identificacion_titular_cuenta_new" id="identificacion_titular_cuenta_new" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cod_aliado_estrategico_banco" id="cod_aliado_estrategico_banco" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btn_guardar_banco"><i class="fa fa-save"></i> Guardar Banco</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Tienda -->
<div class="modal fade" id="modalEditarTienda" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Tienda</h4>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div id="result_edit_tienda"></div>
                <form id="form_edit_tienda" class="form-horizontal">
                    <input type="hidden" name="cod_tienda_edit" id="cod_tienda_edit" value="">
                    
                    <!-- Información Básica -->
                    <div class="row">
                        <div class="col-md-12"><h5 style="margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-store"></i> Información Básica</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NIT *</label>
                                <input type="number" name="identificacion_tercero_edit" id="identificacion_tercero_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Tienda *</label>
                                <input type="text" name="nombre_tienda_edit" id="nombre_tienda_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Aliado Estratégico *</label>
                                <select name="cod_aliado_estrategico_edit" id="cod_aliado_estrategico_edit" class="form-control" required>
                                    <?php echo "<option value=''>Seleccione</option>";
                                    $consulta2_sql = ("SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE (cod_seguridad = '23') AND (cod_estado_activacion_usuario = '1') ORDER BY nombres_apellidos_tercero ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                        echo "<option value='".$datos2['cod_administrador']."'>".$datos2['nombres_apellidos_tercero']."</option>"; 
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teléfono *</label>
                                <input type="text" name="telefono1_tercero_edit" id="telefono1_tercero_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo *</label>
                                <input type="email" name="correo_tercero_edit" id="correo_tercero_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" name="direccion_tercero_edit" id="direccion_tercero_edit" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Información del Representante -->
                    <div class="row">
                        <div class="col-md-12"><h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-user-tie"></i> Información del Representante</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Representante</label>
                                <input type="text" name="nombre_representante_edit" id="nombre_representante_edit" class="form-control" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Documento Representante</label>
                                <input type="number" name="documento_representante_edit" id="documento_representante_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo Representante</label>
                                <input type="email" name="correo_representante_edit" id="correo_representante_edit" class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>

                    <!-- Información del Negocio -->
                    <div class="row">
                        <div class="col-md-12"><h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-building"></i> Información del Negocio</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Industria</label>
                                <input type="text" name="nombre_tipo_industria_edit" id="nombre_tipo_industria_edit" class="form-control" maxlength="30">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub-Industria</label>
                                <input type="text" name="nombre_tipo_subindustria_edit" id="nombre_tipo_subindustria_edit" class="form-control" maxlength="30">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Otra Industria</label>
                                <input type="text" name="nombre_tipo_otraindustria_edit" id="nombre_tipo_otraindustria_edit" class="form-control" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>¿Existe RUES?</label>
                                <select name="existe_rues_edit" id="existe_rues_edit" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Venta Presencial</label>
                                <select name="venta_presencial_edit" id="venta_presencial_edit" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Venta Online</label>
                                <select name="venta_online_edit" id="venta_online_edit" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="SI">Sí</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Plataformas y Sistemas -->
                    <div class="row">
                        <div class="col-md-12"><h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-laptop-code"></i> Plataformas y Sistemas</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Plataforma E-commerce</label>
                                <input type="text" name="nombre_plataforma_ecommerce_edit" id="nombre_plataforma_ecommerce_edit" class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sistema Contable</label>
                                <input type="text" name="nombre_sistema_contable_edit" id="nombre_sistema_contable_edit" class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>

                    <!-- Información Financiera -->
                    <div class="row">
                        <div class="col-md-12"><h5 style="margin-top: 15px; margin-bottom: 10px; border-bottom: 2px solid #ddd; padding-bottom: 5px;"><i class="fa fa-dollar-sign"></i> Información Financiera</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Comisión (%) *</label>
                                <input type="number" name="comision_ptj_edit" id="comision_ptj_edit" class="form-control" required step="0.01" min="0" max="99.99">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Banco de Cuenta *</label>
                                <select name="cod_banco_cuenta_edit" id="cod_banco_cuenta_edit" class="form-control" required><option value="">Seleccione un aliado primero</option></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado *</label>
                                <select name="cod_estado_edit" id="cod_estado_edit" class="form-control" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_actualizar_tienda"><i class="fa fa-save"></i> Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Firma Electrónica -->
<div class="modal fade" id="modalFirmaElectronica" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body" style="text-align: center; padding: 40px 30px;">
                <!-- Icono circular -->
                <div style="width: 100px; height: 100px; border: 4px solid #6ee7b7; border-radius: 50%; margin: 0 auto 25px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-question" style="font-size: 50px; color: #6ee7b7;"></i>
                </div>
                
                <h3 style="color: #2d3748; font-weight: 700; margin-bottom: 15px;">Firma electrónica</h3>
                <p style="color: #718096; font-size: 16px; margin-bottom: 30px;">¿Cómo deseas compartir el enlace de firma?</p>
                
                <!-- Campos ocultos para almacenar datos -->
                <input type="hidden" id="firma_cod_tienda" value="">
                <input type="hidden" id="firma_nombre_tienda" value="">
                <input type="hidden" id="firma_correo" value="">
                <input type="hidden" id="firma_telefono" value="">
                <input type="hidden" id="firma_enlace" value="">
                
                <!-- Botones -->
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                    <button type="button" class="btn" id="btn_copiar_link" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600;">
                        <i class="fa fa-copy"></i> Copiar link
                    </button>
                    <button type="button" class="btn" id="btn_enviar_correo" style="background: linear-gradient(135deg, #38b2ac 0%, #319795 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600;">
                        <i class="fa fa-envelope"></i> Enviar por correo
                    </button>
                    <button type="button" class="btn" id="btn_enviar_whatsapp" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); color: white; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600;">
                        <i class="fa fa-whatsapp"></i> Enviar por WhatsApp
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancelar_firma" style="background: #e2e8f0; color: #4a5568; border: none; padding: 12px 20px; border-radius: 8px; font-weight: 600;">
                        Cancelar
                    </button>
                </div>
                
                <!-- Mensaje de resultado -->
                <div id="result_firma" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
// Función para obtener ubicación GPS
function obtenerUbicacionGPS() {
    var input = document.getElementById('ubicacion_gps_tienda');
    var status = document.getElementById('gps_status');
    
    if (!navigator.geolocation) {
        status.style.display = 'block';
        status.style.background = 'rgba(255, 111, 0, 0.2)';
        status.style.color = '#ff6f00';
        status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Tu navegador no soporta geolocalización';
        return;
    }
    
    status.style.display = 'block';
    status.style.background = 'rgba(0, 212, 255, 0.2)';
    status.style.color = '#00d4ff';
    status.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...';
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            var lat = position.coords.latitude.toFixed(6);
            var lng = position.coords.longitude.toFixed(6);
            input.value = lat + ',' + lng;
            status.style.background = 'rgba(72, 187, 120, 0.2)';
            status.style.color = '#48bb78';
            status.innerHTML = '<i class="fa fa-check-circle"></i> Ubicación obtenida: ' + lat + ', ' + lng;
        },
        function(error) {
            var mensaje = 'Error al obtener ubicación';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    mensaje = 'Permiso denegado. Por favor habilita el GPS.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    mensaje = 'Información de ubicación no disponible.';
                    break;
                case error.TIMEOUT:
                    mensaje = 'Tiempo de espera agotado.';
                    break;
            }
            status.style.background = 'rgba(255, 111, 0, 0.2)';
            status.style.color = '#ff6f00';
            status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> ' + mensaje;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// Función para previsualizar imágenes
function setupImagePreview(inputId, previewId) {
    var input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('change', function(e) {
            var preview = document.getElementById(previewId);
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        });
    }
}

// Configurar previsualizaciones al cargar la página
$(document).ready(function() {
    setupImagePreview('imagen_tienda', 'preview_img_tienda');
    setupImagePreview('url_img_fachada_tienda', 'preview_img_fachada');
    setupImagePreview('url_img_interna_tienda', 'preview_img_interna');
    setupImagePreview('url_img_selfieadmin_tienda', 'preview_img_selfieadmin');
    setupImagePreview('url_img_otraopcional_tienda', 'preview_img_otraopcional');
});

// Envío AJAX para registrar tienda (con FormData para archivos)
$(document).on('click','#btn_guardar_aliado',function(e){
    var form = $('#form_reg_aliado')[0];
    
    // Validar el formulario HTML5
    if (!form.checkValidity()) {
        // Si no es válido, mostrar los mensajes de error nativos
        form.reportValidity();
        return false;
    }
    
    // Validación adicional de campos específicos
    var errores = [];
    // Campos obligatorios
    if ($('#identificacion_tercero').val().trim() === '') errores.push('Documento es requerido');
    if ($('#nombre1_tercero').val().trim() === '') errores.push('Nombre Tienda es requerido');
    if ($('#cod_aliado_estrategico').val() === '' || $('#cod_aliado_estrategico').val() === null) errores.push('Aliado Estratégico es requerido');
    if ($('#comision_ptj').val().trim() === '' || parseFloat($('#comision_ptj').val()) < 0) errores.push('Comisión es requerido');
    if ($('#cod_banco_cuenta').val() === '' || $('#cod_banco_cuenta').val() === null) errores.push('Banco de Cuenta es requerido');
    
    // Validar formato de correo del representante
    var emailRep = $('#correo_representante').val().trim();
    if (emailRep !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailRep)) {
        errores.push('El correo del representante no tiene un formato válido');
    }
    
    // Si hay errores, mostrarlos
    if (errores.length > 0) {
        var mensajeError = '<div class="alert alert-danger"><strong>Por favor corrija los siguientes errores:</strong><ul>';
        errores.forEach(function(error) {
            mensajeError += '<li>' + error + '</li>';
        });
        mensajeError += '</ul></div>';
        $('#result_register').html(mensajeError);
        return false;
    }
    
    // Habilitar temporalmente el select de banco para que se incluya en el FormData
    var bancoPrevDisabled = $('#cod_banco_cuenta').prop('disabled');
    $('#cod_banco_cuenta').prop('disabled', false);
    
    // Usar FormData para poder enviar archivos
    var formData = new FormData(form);
    
    // Restaurar estado del select de banco
    $('#cod_banco_cuenta').prop('disabled', bancoPrevDisabled);
    $('#result_register').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
    $.ajax({
        type: 'POST',
        url: '../admin/reg_tienda_modal_coordinador_ajax_reg.php',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response){
            if(response.afectado === 'SI'){
                // Mostrar mensaje de éxito
                $('#result_register').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Tienda registrada correctamente.</div>');
                
                // Cerrar modal de registro
                setTimeout(function(){
                    $('.abrir_modal_registrar_tienda').modal('hide');
                    // Limpiar el formulario
                    $('#form_reg_aliado')[0].reset();
                    $('#result_register').html('');
                    // Resetear el campo de banco
                    $('#cod_banco_cuenta').empty().append('<option value="">-- Seleccione primero un Aliado --</option>').prop('disabled', true);
                    $('#btn_agregar_banco').prop('disabled', true);
                    // Ocultar previews de imágenes
                    $('#preview_img_tienda, #preview_img_fachada, #preview_img_interna, #preview_img_selfieadmin, #preview_img_otraopcional').hide().attr('src', '');
                    // Ocultar estado GPS
                    $('#gps_status').hide();
                    
                    // Preparar datos para el modal de firma electrónica
                    // Detectar URL base dinámicamente (funciona en local y producción)
                    var currentPath = window.location.pathname;
                    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
                    var enlaceFirma = window.location.origin + basePath + 'firma_tienda.php?cod=' + encodeURIComponent(response.cod_tienda_codifcryp);
                    
                    $('#firma_cod_tienda').val(response.cod_tienda);
                    $('#firma_nombre_tienda').val(response.nombre_tienda);
                    $('#firma_correo').val(response.correo_tercero);
                    $('#firma_telefono').val(response.telefono1_tercero);
                    $('#firma_enlace').val(enlaceFirma);
                    $('#result_firma').html('');
                    
                    // Abrir modal de firma electrónica
                    $('#modalFirmaElectronica').modal('show');
                    
                    // Recargar la tabla
                    load(1);
                }, 1000);
            } else {
                $('#result_register').html('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> La tienda ya existe o no se pudo registrar.</div>');
            }
        },
        error: function(){
            $('#result_register').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error en la petición. Intente nuevamente.</div>');
        }
    });
});
</script>

<script>
// Cargar bancos cuando se seleccione un aliado
$('#cod_aliado_estrategico').on('change', function() {
    var codAliado = $(this).val();
    var selectBanco = $('#cod_banco_cuenta');
    var btnAgregarBanco = $('#btn_agregar_banco');
    
    if (codAliado && codAliado !== '') {
        // Mostrar loading
        $('#banco_loading').show();
        selectBanco.prop('disabled', true);
        
        // Cargar bancos del aliado
        $.ajax({
            type: 'POST',
            url: '../admin/obtener_bancos_cuenta_por_aliado_ajax.php',
            data: { cod_aliado_estrategico: codAliado },
            dataType: 'json',
            success: function(response) {
                $('#banco_loading').hide();
                selectBanco.empty();
                
                if (response.success && response.bancos.length > 0) {
                    selectBanco.append('<option value="">-- Seleccione un banco --</option>');
                    $.each(response.bancos, function(index, banco) {
                        var textoOpcion = banco.nombre_banco_cuenta + ' - ' + banco.numero_banco_cuenta;
                        if (banco.nombre_titular_cuenta) {
                            textoOpcion += ' (' + banco.nombre_titular_cuenta + ')';
                        }
                        selectBanco.append('<option value="' + banco.cod_banco_cuenta + '">' + textoOpcion + '</option>');
                    });
                } else {
                    selectBanco.append('<option value="">-- No hay bancos registrados para este aliado --</option>');
                }
                
                // Actualizar el campo de comisión con el valor del aliado
                if (response.comision_ptj !== undefined) {
                    $('#comision_ptj').val(response.comision_ptj);
                }
                
                // Habilitar el select y botón
                selectBanco.prop('disabled', false);
                btnAgregarBanco.prop('disabled', false);
            },
            error: function() {
                $('#banco_loading').hide();
                selectBanco.empty();
                selectBanco.append('<option value="">-- Error al cargar bancos --</option>');
                selectBanco.prop('disabled', false);
                btnAgregarBanco.prop('disabled', false);
            }
        });
    } else {
        // Deshabilitar y limpiar
        selectBanco.empty();
        selectBanco.append('<option value="">-- Seleccione primero un Aliado --</option>');
        selectBanco.prop('disabled', true);
        btnAgregarBanco.prop('disabled', true);
        // Limpiar el campo de comisión
        $('#comision_ptj').val('');
    }
});

// Abrir modal para agregar nuevo banco
$('#btn_agregar_banco').on('click', function() {
    var codAliado = $('#cod_aliado_estrategico').val();
    if (codAliado && codAliado !== '') {
        $('#cod_aliado_estrategico_banco').val(codAliado);
        $('#form_reg_banco')[0].reset();
        $('#result_register_banco').html('');
        $('#modalNuevoBanco').modal('show');
    } else {
        alert('Primero debe seleccionar un Aliado Estratégico');
    }
});

// Guardar nuevo banco
$('#btn_guardar_banco').on('click', function() {
    var form = $('#form_reg_banco')[0];
    
    // Validar formulario
    if (!form.checkValidity()) {
        form.reportValidity();
        return false;
    }
    
    // Validaciones adicionales
    var errores = [];
    if ($('#nombre_banco_cuenta_new').val().trim() === '') errores.push('Nombre del Banco es requerido');
    if ($('#numero_banco_cuenta_new').val().trim() === '') errores.push('Número de Cuenta es requerido');
    if ($('#tipo_cuenta_new').val() === '' || $('#tipo_cuenta_new').val() === null) errores.push('Tipo de Cuenta es requerido');
    if ($('#nombre_titular_cuenta_new').val().trim() === '') errores.push('Nombre del Titular es requerido');
    if ($('#identificacion_titular_cuenta_new').val().trim() === '') errores.push('Documento del Titular es requerido');
    
    if (errores.length > 0) {
        var mensajeError = '<div class="alert alert-danger"><strong>Por favor corrija los siguientes errores:</strong><ul>';
        errores.forEach(function(error) {
            mensajeError += '<li>' + error + '</li>';
        });
        mensajeError += '</ul></div>';
        $('#result_register_banco').html(mensajeError);
        return false;
    }
    
    var codAliado = $('#cod_aliado_estrategico_banco').val();
    var data = {
        nombre_banco_cuenta: $('#nombre_banco_cuenta_new').val(),
        numero_banco_cuenta: $('#numero_banco_cuenta_new').val(),
        tipo_cuenta: $('#tipo_cuenta_new').val(),
        nombre_titular_cuenta: $('#nombre_titular_cuenta_new').val(),
        identificacion_titular_cuenta: $('#identificacion_titular_cuenta_new').val(),
        cod_aliado_estrategico: codAliado
    };
    
    $('#result_register_banco').html('<img src="../imagenes/ajax-loader.gif"> Guardando...');
    
    $.ajax({
        type: 'POST',
        url: '../admin/reg_banco_cuenta_tienda_ajax.php',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#result_register_banco').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + response.message + '</div>');
                
                // Cerrar modal y recargar bancos
                setTimeout(function() {
                    $('#modalNuevoBanco').modal('hide');
                    // Disparar la recarga de bancos
                    $('#cod_aliado_estrategico').trigger('change');
                    // Seleccionar el nuevo banco
                    setTimeout(function() {
                        $('#cod_banco_cuenta').val(response.cod_banco_cuenta);
                    }, 500);
                }, 1000);
            } else {
                $('#result_register_banco').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> ' + response.message + '</div>');
            }
        },
        error: function() {
            $('#result_register_banco').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error en la petición. Intente nuevamente.</div>');
        }
    });
});

// =====================================================
// FUNCIONES PARA MODAL DE FIRMA ELECTRÓNICA
// =====================================================

// Copiar enlace al portapapeles
$('#btn_copiar_link').on('click', function() {
    var enlace = $('#firma_enlace').val();
    
    // Usar la API moderna del portapapeles si está disponible
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(enlace).then(function() {
            $('#result_firma').html('<div class="alert alert-success" style="margin-top: 15px;"><i class="fa fa-check"></i> Enlace copiado al portapapeles</div>');
            setTimeout(function() {
                $('#result_firma').html('');
            }, 3000);
        }).catch(function() {
            copiarFallback(enlace);
        });
    } else {
        copiarFallback(enlace);
    }
});

// Función fallback para copiar en navegadores antiguos
function copiarFallback(texto) {
    var tempInput = document.createElement('input');
    tempInput.style.position = 'absolute';
    tempInput.style.left = '-9999px';
    tempInput.value = texto;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
        document.execCommand('copy');
        $('#result_firma').html('<div class="alert alert-success" style="margin-top: 15px;"><i class="fa fa-check"></i> Enlace copiado al portapapeles</div>');
        setTimeout(function() {
            $('#result_firma').html('');
        }, 3000);
    } catch (err) {
        $('#result_firma').html('<div class="alert alert-danger" style="margin-top: 15px;"><i class="fa fa-times"></i> No se pudo copiar el enlace</div>');
    }
    document.body.removeChild(tempInput);
}

// Enviar por correo electrónico (abre cliente de correo)
$('#btn_enviar_correo').on('click', function() {
    var correo = $('#firma_correo').val();
    var nombreTienda = $('#firma_nombre_tienda').val();
    var enlace = $('#firma_enlace').val();
    
    var asunto = encodeURIComponent('Firma Electronica Pendiente - ' + nombreTienda);
    var cuerpo = encodeURIComponent(
        'Hola!\n\n' +
        '========================================\n' +
        '    FIRMA ELECTRONICA PENDIENTE\n' +
        '========================================\n\n' +
        'Nos complace informarle que su tienda "' + nombreTienda + '" ha sido registrada exitosamente en nuestro sistema.\n\n' +
        'Para completar el proceso de registro, solo necesita firmar electronicamente. Es muy sencillo:\n\n' +
        '> PASO 1: Haga clic en el siguiente enlace\n' +
        '> PASO 2: Dibuje su firma en el recuadro\n' +
        '> PASO 3: Presione "Confirmar Firma"\n\n' +
        'ENLACE DE FIRMA:\n' +
        enlace + '\n\n' +
        'Este enlace es valido y seguro.\n\n' +
        '========================================\n\n' +
        'Si tiene alguna consulta, no dude en contactarnos.\n\n' +
        'Gracias por confiar en nosotros!\n\n' +
        'Atentamente,\n' +
        'Equipo Distribuciones AYQ\n' +
        'Soporte al Cliente'
    );
    
    if (correo && correo !== '') {
        window.location.href = 'mailto:' + correo + '?subject=' + asunto + '&body=' + cuerpo;
        $('#result_firma').html('<div class="alert alert-info" style="margin-top: 15px;"><i class="fa fa-envelope"></i> Abriendo cliente de correo...</div>');
    } else {
        $('#result_firma').html('<div class="alert alert-warning" style="margin-top: 15px;"><i class="fa fa-exclamation-triangle"></i> No hay correo registrado para esta tienda</div>');
    }
});

// Enviar por WhatsApp
$('#btn_enviar_whatsapp').on('click', function() {
    var telefono = $('#firma_telefono').val();
    var nombreTienda = $('#firma_nombre_tienda').val();
    var enlace = $('#firma_enlace').val();
    
    // Formatear número de teléfono (quitar espacios y caracteres especiales, agregar código de país si no lo tiene)
    var telefonoFormateado = telefono.replace(/[\s\-\(\)\.]/g, '');
    
    // Si no empieza con + o código de país, asumir Colombia (+57)
    if (!telefonoFormateado.startsWith('+') && !telefonoFormateado.startsWith('57')) {
        telefonoFormateado = '57' + telefonoFormateado;
    }
    
    var mensaje = encodeURIComponent(
        'Hola!\n\n' +
        '*EXCELENTES NOTICIAS*\n\n' +
        'Su tienda *' + nombreTienda + '* ha sido registrada exitosamente en nuestro sistema.\n\n' +
        '--------------------\n' +
        '*FIRMA ELECTRONICA*\n' +
        '--------------------\n\n' +
        'Para completar el proceso, siga estos simples pasos:\n\n' +
        '1. Haga clic en el enlace\n' +
        '2. Dibuje su firma\n' +
        '3. Confirme\n\n' +
        '*Enlace de firma:*\n' +
        enlace + '\n\n' +
        'El proceso es rapido, seguro y solo toma unos segundos.\n\n' +
        'Tiene alguna duda? Estamos para ayudarle.\n\n' +
        'Gracias por confiar en *Distribuciones AYQ*!'
    );
    
    if (telefonoFormateado && telefonoFormateado.length >= 10) {
        window.open('https://wa.me/' + telefonoFormateado + '?text=' + mensaje, '_blank');
        $('#result_firma').html('<div class="alert alert-success" style="margin-top: 15px;"><i class="fa fa-whatsapp"></i> Abriendo WhatsApp...</div>');
    } else {
        // Si no hay teléfono válido, abrir WhatsApp sin número para que el usuario lo ingrese
        window.open('https://wa.me/?text=' + mensaje, '_blank');
        $('#result_firma').html('<div class="alert alert-info" style="margin-top: 15px;"><i class="fa fa-whatsapp"></i> Abriendo WhatsApp (sin número)...</div>');
    }
});

// Cerrar modal de firma y continuar
$('#btn_cancelar_firma').on('click', function() {
    $('#modalFirmaElectronica').modal('hide');
});

// =====================================================
// FUNCIONES PARA EDITAR TIENDA
// =====================================================

// Variable para almacenar el banco seleccionado al cargar
var bancoPrecargado = null;

// Abrir modal de edición al hacer clic en el botón
$(document).on('click', '.btn-editar-tienda', function() {
    var codTienda = $(this).data('cod-tienda');
    cargarDatosTienda(codTienda);
});

// Cargar datos de la tienda
function cargarDatosTienda(codTienda) {
    $('#result_edit_tienda').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Cargando datos...</div>');
    
    $.ajax({
        type: 'POST',
        url: '../admin/obtener_tienda_ajax.php',
        data: { cod_tienda: codTienda },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.tienda) {
                var t = response.tienda;
                
                // Llenar campos básicos
                $('#cod_tienda_edit').val(t.cod_tienda);
                $('#identificacion_tercero_edit').val(t.identificacion_tercero);
                $('#nombre_tienda_edit').val(t.nombre_tienda);
                $('#cod_aliado_estrategico_edit').val(t.cod_aliado_estrategico);
                $('#telefono1_tercero_edit').val(t.telefono1_tercero);
                $('#correo_tercero_edit').val(t.correo_tercero);
                $('#direccion_tercero_edit').val(t.direccion_tercero);
                
                // Información del representante
                $('#nombre_representante_edit').val(t.nombre_representante);
                $('#documento_representante_edit').val(t.documento_representante);
                $('#correo_representante_edit').val(t.correo_representante);
                
                // Información del negocio
                $('#nombre_tipo_industria_edit').val(t.nombre_tipo_industria);
                $('#nombre_tipo_subindustria_edit').val(t.nombre_tipo_subindustria);
                $('#nombre_tipo_otraindustria_edit').val(t.nombre_tipo_otraindustria);
                $('#numero_comercios_edit').val(t.numero_comercios || 1);
                $('#existe_rues_edit').val(t.existe_rues);
                $('#venta_presencial_edit').val(t.venta_presencial);
                $('#venta_online_edit').val(t.venta_online);
                
                // Plataformas y sistemas
                $('#nombre_plataforma_ecommerce_edit').val(t.nombre_plataforma_ecommerce);
                $('#nombre_sistema_contable_edit').val(t.nombre_sistema_contable);
                
                // Información financiera
                $('#comision_ptj_edit').val(t.comision_ptj);
                $('#cod_estado_edit').val(t.cod_estado);
                
                // Guardar el banco para preseleccionar después de cargar la lista
                bancoPrecargado = t.cod_banco_cuenta;
                
                // Cargar bancos del aliado (false = no actualizar comisión porque ya se cargó de la BD)
                cargarBancosEdicion(t.cod_aliado_estrategico, t.cod_banco_cuenta, false);
                
                $('#result_edit_tienda').html('');
                $('#modalEditarTienda').modal('show');
            } else {
                $('#result_edit_tienda').html('<div class="alert alert-danger">Error al cargar los datos de la tienda</div>');
            }
        },
        error: function() {
            $('#result_edit_tienda').html('<div class="alert alert-danger">Error en la petición</div>');
        }
    });
}

// Cargar bancos para el modal de edición
function cargarBancosEdicion(codAliado, bancoSeleccionado, actualizarComision) {
    var selectBanco = $('#cod_banco_cuenta_edit');
    
    if (codAliado && codAliado !== '') {
        $.ajax({
            type: 'POST',
            url: '../admin/obtener_bancos_cuenta_por_aliado_ajax.php',
            data: { cod_aliado_estrategico: codAliado },
            dataType: 'json',
            success: function(response) {
                selectBanco.empty();
                
                if (response.success && response.bancos.length > 0) {
                    selectBanco.append('<option value="">-- Seleccione un banco --</option>');
                    $.each(response.bancos, function(index, banco) {
                        var textoOpcion = banco.nombre_banco_cuenta + ' - ' + banco.numero_banco_cuenta;
                        var selected = (banco.cod_banco_cuenta == bancoSeleccionado) ? 'selected' : '';
                        selectBanco.append('<option value="' + banco.cod_banco_cuenta + '" ' + selected + '>' + textoOpcion + '</option>');
                    });
                } else {
                    selectBanco.append('<option value="">-- No hay bancos registrados --</option>');
                }
                
                // Si se indica actualizar comisión (cuando se cambia el aliado manualmente)
                if (actualizarComision && response.comision_ptj !== undefined) {
                    $('#comision_ptj_edit').val(response.comision_ptj);
                }
            },
            error: function() {
                selectBanco.empty();
                selectBanco.append('<option value="">-- Error al cargar bancos --</option>');
            }
        });
    }
}

// Recargar bancos cuando se cambie el aliado en el modal de edición
$('#cod_aliado_estrategico_edit').on('change', function() {
    var codAliado = $(this).val();
    // true = actualizar comisión porque el usuario cambió manualmente el aliado
    cargarBancosEdicion(codAliado, null, true);
});

// Guardar cambios de la tienda
$('#btn_actualizar_tienda').on('click', function() {
    var form = $('#form_edit_tienda')[0];
    
    // Validar formulario HTML5
    if (!form.checkValidity()) {
        form.reportValidity();
        return false;
    }
    
    var data = {
        cod_tienda: $('#cod_tienda_edit').val(),
        identificacion_tercero: $('#identificacion_tercero_edit').val(),
        nombre_tienda: $('#nombre_tienda_edit').val(),
        telefono1_tercero: $('#telefono1_tercero_edit').val(),
        correo_tercero: $('#correo_tercero_edit').val(),
        direccion_tercero: $('#direccion_tercero_edit').val(),
        cod_aliado_estrategico: $('#cod_aliado_estrategico_edit').val(),
        nombre_representante: $('#nombre_representante_edit').val(),
        documento_representante: $('#documento_representante_edit').val(),
        correo_representante: $('#correo_representante_edit').val(),
        nombre_tipo_industria: $('#nombre_tipo_industria_edit').val(),
        nombre_tipo_subindustria: $('#nombre_tipo_subindustria_edit').val(),
        nombre_tipo_otraindustria: $('#nombre_tipo_otraindustria_edit').val(),
        numero_comercios: $('#numero_comercios_edit').val(),
        existe_rues: $('#existe_rues_edit').val(),
        venta_presencial: $('#venta_presencial_edit').val(),
        venta_online: $('#venta_online_edit').val(),
        nombre_plataforma_ecommerce: $('#nombre_plataforma_ecommerce_edit').val(),
        nombre_sistema_contable: $('#nombre_sistema_contable_edit').val(),
        comision_ptj: $('#comision_ptj_edit').val(),
        cod_banco_cuenta: $('#cod_banco_cuenta_edit').val(),
        cod_estado: $('#cod_estado_edit').val()
    };
    
    $('#result_edit_tienda').html('<div class="text-center"><img src="../imagenes/ajax-loader.gif"> Guardando...</div>');
    
    $.ajax({
        type: 'POST',
        url: '../admin/actualizar_tienda_ajax.php',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#result_edit_tienda').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + response.message + '</div>');
                
                setTimeout(function() {
                    $('#modalEditarTienda').modal('hide');
                    load(1); // Recargar la tabla
                }, 1500);
            } else {
                $('#result_edit_tienda').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> ' + response.message + '</div>');
            }
        },
        error: function() {
            $('#result_edit_tienda').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Error en la petición. Intente nuevamente.</div>');
        }
    });
});
</script>

<script>
$(document).ready(function(){ load(1); });

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    //var buscar_por = $("#buscar_por").val();
    //var numero_registro_por_pagina = $("#numero_registro_por_pagina").val();
    var buscar_por = '';
    var numero_registro_por_pagina = '99999999';

    var cod_administrador = $("#cod_administrador").val();
    var cod_seguridad = $("#cod_seguridad").val();
    var tabla = $("#tabla").val();
    var nombre_estado_factura = "<?php echo $nombre_estado_factura ?>";
    var pagina = "<?php echo $pagina_local ?>";

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/tabla_busqueda_paginacion_tienda_coordinador_diseno_vertical_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $("#outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>

<!-- ====================== SISTEMA DE NOTIFICACIONES ====================== -->
<style>
/* Botón flotante de notificaciones */
.notification-bell {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    z-index: 9999;
    transition: all 0.3s ease;
    border: none;
}

.notification-bell:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 30px rgba(102, 126, 234, 0.6);
}

.notification-bell i {
    font-size: 24px;
    color: white;
}

.notification-bell.has-notifications {
    animation: bellPulse 2s infinite;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
    color: white;
    font-size: 12px;
    font-weight: 700;
    min-width: 24px;
    height: 24px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 6px;
    box-shadow: 0 2px 8px rgba(255, 107, 107, 0.5);
}

@keyframes bellPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes bellShake {
    0%, 100% { transform: rotate(0); }
    25% { transform: rotate(15deg); }
    75% { transform: rotate(-15deg); }
}

.notification-bell.shake i {
    animation: bellShake 0.5s ease;
}

/* Panel de notificaciones */
.notification-panel {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 380px;
    max-height: 500px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    z-index: 9998;
    display: none;
    overflow: hidden;
}

.notification-panel.show {
    display: block;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.notification-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notification-header h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.notification-header-actions {
    display: flex;
    gap: 10px;
}

.notification-header-actions button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-header-actions button:hover {
    background: rgba(255, 255, 255, 0.3);
}

.notification-list {
    max-height: 400px;
    overflow-y: auto;
}

.notification-item {
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.notification-item:hover {
    background: #f7fafc;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.notification-icon.type-1 {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.notification-icon.type-2 {
    background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    color: white;
}

.notification-icon.type-3 {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
}

.notification-content {
    flex: 1;
    min-width: 0;
}

.notification-title {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notification-desc {
    font-size: 13px;
    color: #718096;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.notification-time {
    font-size: 11px;
    color: #a0aec0;
    margin-top: 6px;
}

.notification-empty {
    padding: 40px 20px;
    text-align: center;
    color: #a0aec0;
}

.notification-empty i {
    font-size: 48px;
    margin-bottom: 15px;
    display: block;
}

/* Responsive */
@media (max-width: 480px) {
    .notification-panel {
        width: calc(100% - 20px);
        right: 10px;
        bottom: 90px;
    }
    
    .notification-bell {
        right: 15px;
        bottom: 15px;
        width: 50px;
        height: 50px;
    }
}
</style>

<!-- Botón flotante de notificaciones -->
<button class="notification-bell" id="notificationBell" onclick="toggleNotificationPanel()">
    <i class="fa fa-bell"></i>
    <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
</button>

<!-- Panel de notificaciones -->
<div class="notification-panel" id="notificationPanel">
    <div class="notification-header">
        <h4><i class="fa fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions">
            <button onclick="marcarTodasLeidas()" title="Marcar todas como leídas">
                <i class="fa fa-check-double"></i> Leer todas
            </button>
            <button onclick="toggleNotificationPanel()" title="Cerrar">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="notification-list" id="notificationList">
        <div class="notification-empty">
            <i class="fa fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
// ====================== SISTEMA DE NOTIFICACIONES ======================
var notificationCheckInterval = null;

// Inicializar sistema de notificaciones
$(document).ready(function() {
    cargarNotificaciones();
    // Revisar notificaciones cada 30 segundos
    notificationCheckInterval = setInterval(cargarNotificaciones, 30000);
});

// Cargar notificaciones desde el servidor
function cargarNotificaciones() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                actualizarUINotificaciones(response.notificaciones, response.count);
            }
        },
        error: function() {
            console.log('Error al cargar notificaciones');
        }
    });
}

// Actualizar la interfaz con las notificaciones
function actualizarUINotificaciones(notificaciones, count) {
    var $badge = $('#notificationBadge');
    var $bell = $('#notificationBell');
    var $list = $('#notificationList');
    
    // Actualizar badge
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
        
        // Efecto de shake si hay nuevas notificaciones
        if (!$bell.hasClass('notified')) {
            $bell.addClass('shake notified');
            setTimeout(function() { $bell.removeClass('shake'); }, 500);
        }
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications notified');
    }
    
    // Actualizar lista
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIcon(notif.tipo);
            
            html += '<div class="notification-item" onclick="marcarNotificacionLeida(' + notif.id + ', this)">';
            html += '  <div class="notification-icon ' + iconClass + '"><i class="fa ' + iconSymbol + '"></i></div>';
            html += '  <div class="notification-content">';
            html += '    <div class="notification-title">' + escapeHtml(notif.titulo) + '</div>';
            html += '    <div class="notification-desc">' + escapeHtml(notif.descripcion) + '</div>';
            html += '    <div class="notification-time"><i class="fa fa-clock"></i> ' + notif.fecha_corta + '</div>';
            html += '  </div>';
            html += '</div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty"><i class="fa fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

// Obtener icono según el tipo de notificación
function getNotificationIcon(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-signature'; // Firma
        case 2: return 'fa-exclamation-circle'; // Alerta
        case 3: return 'fa-info-circle'; // Info
        default: return 'fa-bell';
    }
}

// Toggle del panel de notificaciones
function toggleNotificationPanel() {
    var $panel = $('#notificationPanel');
    $panel.toggleClass('show');
}

// Cerrar panel al hacer clic fuera
$(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationPanel, #notificationBell').length) {
        $('#notificationPanel').removeClass('show');
    }
});

// Marcar una notificación como leída
function marcarNotificacionLeida(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        data: { cod_notificacion: codNotificacion },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Remover el elemento con animación
                $(element).fadeOut(300, function() {
                    $(this).remove();
                    // Recargar notificaciones
                    cargarNotificaciones();
                });
            }
        }
    });
}

// Marcar todas las notificaciones como leídas
function marcarTodasLeidas() {
    Swal.fire({
        title: '¿Marcar todas como leídas?',
        text: 'Se marcarán todas las notificaciones pendientes como leídas',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#667eea',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, marcar todas',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php',
                type: 'POST',
                data: { marcar_todas: 'si' },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificaciones();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Listo!',
                            text: 'Todas las notificaciones han sido marcadas como leídas',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
    });
}

// Escapar HTML para seguridad
function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>