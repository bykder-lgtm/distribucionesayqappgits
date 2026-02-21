<?php 
$nombre_pagina = "Gestión de Solicitudes";
$cod_seguridad_pag = "1";
$pagina_local = $_SERVER['PHP_SELF'];
$cod_base_caja = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_inicio_sesion_adm_lider.php"; ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include "../admin/01_admin_modulo_info_empresa_adm_lider.php"; ?>
<!DOCTYPE html>
<html lang="es">
    <head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- **************************************************** MODULO DE PLANTILLAS META ******************************************** -->
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<!-- **************************************************** MODULO DE PLANTILLAS CSS ********************************************* -->
<?php include "../admin/02_admin_modulo_estilo_css_adm_lider.php"; ?>
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
<?php include "../admin/03_admin_modulo_menu_navegacion_adm_lider.php"; ?>
<!-- 1**************************************************** MODULO MENU DE NAVEGACION ******************************************** -->
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".abrir_modal_registrar_producto"><i class="fa fa-plus-circle"></i> Registrar Producto</button></div>
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
<?php include "../admin/04_admin_modulo_footer_adm_lider.php"; ?>
<!-- ******************************************************* MODULO FOOTER *********************************************** -->
            </div>
        </div>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include "../admin/05_admin_modulo_js_adm_lider.php"; ?>
<!-- ******************************************************* MODULO PLANTILLA JS *********************************************** -->
<!--<script src="../js/ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<!--<script src="../js/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>-->
    </body>
</html>
<!-- ****************************************************************************************************** -->
<!-- Modal Registrar Tienda -->
<div class="modal fade abrir_modal_registrar_producto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Producto</h4>
            </div>
            <?php
            $mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
            $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
            $matriz_consulta = mysqli_fetch_assoc($consulta);

            $cod_producto_barra                = $matriz_consulta['cod_producto_barra'] + 1;
            ?>
            <div class="modal-body">
                <div id="result_register"></div>
                <form id="form_reg_aliado" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Codigo Producto *</label>
                                <input type="text" name="cod_producto_barra" id="cod_producto_barra" value="<?php echo $cod_producto_barra ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Producto *</label>
                                <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tienda  *</label>
                                <select name="cod_tienda" id="cod_tienda" class="form-control" required>
                                    <?php $cod_tienda = 0;
                                    if (isset($cod_tienda)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE (cod_estado = '1') ORDER BY nombre_tienda ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_tienda) and $cod_tienda == $datos2['cod_tienda']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_tienda'];
                                    $nombre = $datos2['nombre_tienda'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Compra *</label>
                                <input type="text" name="precio_compra_producto" id="precio_compra_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Venta (Contado) *</label>
                                <input type="text" name="precio_venta_producto" id="precio_venta_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Categoria *</label>
                                <select name="cod_categoria" id="cod_categoria" class="form-control" required>
                                    <?php $cod_categoria = 0;
                                    if (isset($cod_categoria)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
                                    $consulta2_sql = ("SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY nombre_categoria ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_categoria) and $cod_categoria == $datos2['cod_categoria']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_categoria'];
                                    $nombre = $datos2['nombre_categoria'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Iva *</label>
                                <select name="iva_ptj" id="iva_ptj" class="form-control" required>
                                    <?php $iva_ptj = 0;
                                    if (isset($iva_ptj)) { echo ""; } else { echo ""; }
                                    $consulta2_sql = ("SELECT iva FROM tbl15_tipo_iva WHERE (cod_estado = '1') ORDER BY iva ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($iva_ptj) and $iva_ptj == $datos2['iva']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['iva'];
                                    $nombre = $datos2['iva'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion_producto" rows="2" cols="20" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Imagen Producto</label>
                                <input type="file" name="imagen_producto" id="imagen_producto" accept="image/*" class="form-control" required>
                                <small class="text-muted">Se guardará versión original y miniatura.</small>
                                <div id="preview_imagen" style="margin-top:8px;">
                                    <img id="preview_img" src="" style="max-width:100%; border-radius:6px; display:none;" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="cod_estado" id="cod_estado" class="form-control" required>
                                    <?php $cod_estado = 1;
                                    if (isset($cod_estado)) { echo ""; } else { echo ""; }
                                    $consulta2_sql = ("SELECT cod_estado, nombre_estado FROM tbl15_estado ORDER BY nombre_estado ASC");
                                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                    if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
                                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                                    $codigo = $datos2['cod_estado'];
                                    $nombre = $datos2['nombre_estado'];
                                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                </select>
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
                <button type="button" class="btn btn-primary" id="btn_guardar_producto">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Envío AJAX para registrar producto: manejar JSON, enviar FormData y mostrar previsualización
$(document).on('click','#btn_guardar_producto',function(e){
    e.preventDefault();
    var $btn = $(this);
    var form = $('#form_reg_aliado');

    // Validación cliente de campos obligatorios (acumular campos faltantes)
    var fieldMap = {
        'cod_producto_barra': 'Código Producto',
        'nombre_producto': 'Nombre Producto',
        'cod_tienda': 'Tienda',
        'precio_compra_producto': 'Precio Compra',
        'precio_venta_producto': 'Precio Venta',
        'cod_categoria': 'Categoría',
        'cod_estado': 'Estado',
        'imagen_producto': 'Imagen Producto'
    };

        // helper para convertir/format
        function unformatNumber(str){ if(!str) return ''; return String(str).replace(/[^0-9\-]/g,''); }
        function formatNumberDisplay(str){ if(!str) return ''; var n = String(str).replace(/[^0-9\-]/g,''); return n.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }

        var cod_producto_barra = $.trim($('#cod_producto_barra').val());
        var nombre_producto = $.trim($('#nombre_producto').val());
        var cod_tienda = $('#cod_tienda').val();
        // obtener valores sin formato
        var precio_compra_raw = $('#precio_compra_producto').data('raw') || unformatNumber($('#precio_compra_producto').val());
        var precio_venta_raw = $('#precio_venta_producto').data('raw') || unformatNumber($('#precio_venta_producto').val());
        var cod_categoria = $('#cod_categoria').val();
        var cod_estado = $('#cod_estado').val();
        var imagen_files = $('#imagen_producto')[0].files;

    var faltantes = [];
    if(!cod_producto_barra) faltantes.push('cod_producto_barra');
    if(!nombre_producto) faltantes.push('nombre_producto');
    if(!cod_tienda || cod_tienda=='') faltantes.push('cod_tienda');
    if(!precio_compra_raw || precio_compra_raw=='') faltantes.push('precio_compra_producto');
    if(!precio_venta_raw || precio_venta_raw=='') faltantes.push('precio_venta_producto');
    if(!cod_categoria || cod_categoria=='') faltantes.push('cod_categoria');
    if(!cod_estado || cod_estado=='') faltantes.push('cod_estado');
    if(!imagen_files || imagen_files.length === 0) faltantes.push('imagen_producto');

    if(faltantes.length > 0){
        var nombres = $.map(faltantes, function(k){ return fieldMap[k] || k; });
        $('#result_register').html('<div class="alert alert-danger">Faltan los siguientes campos obligatorios: <strong>'+nombres.join(', ')+'</strong></div>');
        return;
    }

    // Validación adicional: precio_venta_producto debe ser mayor a 0
    if (Number(precio_venta_raw) <= 0) {
        $('#precio_venta_producto').css('border', '1px solid #a94442').focus();
        $('#result_register').html('<div class="alert alert-danger">El campo <strong>Precio Venta</strong> debe ser mayor a 0.</div>');
        return;
    } else {
        $('#precio_venta_producto').css('border', '');
    }

    // Validación adicional: precio_venta_producto debe ser >= precio_compra_producto
    if (Number(precio_venta_raw) < Number(precio_compra_raw)) {
        $('#precio_venta_producto, #precio_compra_producto').css('border', '1px solid #a94442');
        $('#result_register').html('<div class="alert alert-danger">El <strong>Precio Venta</strong> debe ser mayor o igual al <strong>Precio Compra</strong>.</div>');
        return;
    } else {
        $('#precio_venta_producto, #precio_compra_producto').css('border', '');
    }

    var formData = new FormData(form[0]);
    // Asegurar que los valores enviados estén sin formato (sin separadores)
    formData.set('precio_compra_producto', precio_compra_raw);
    formData.set('precio_venta_producto', precio_venta_raw);
    $('#result_register').html('<div class="text-center"><img src="../imagenes/ajax-loader.gif"> Cargando...</div>');
    $btn.prop('disabled', true);
    $.ajax({
        type: 'POST',
        url: '../admin/reg_producto_modal_lider_ajax_reg.php',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response){
            if(response && response.afectado && response.afectado === 'SI'){
                $('#result_register').html('<div class="alert alert-success">'+(response.mensaje||'Guardado correctamente.')+'</div>');
                setTimeout(function(){
                    $('.abrir_modal_registrar_producto').modal('hide');
                    $('#form_reg_aliado')[0].reset();
                    $('#preview_img').hide().attr('src','');
                    //load(1);
                },1200);
            } else {
                var msg = (response && response.mensaje) ? response.mensaje : 'Error al guardar.';
                // Si el servidor devolvió una lista de campos, convertir claves a nombres amigables
                if(response && response.mensaje && typeof response.mensaje === 'string' && response.mensaje.indexOf(':') !== -1){
                    var parts = response.mensaje.split(':');
                    var after = parts.slice(1).join(':').trim();
                    var keys = after.split(',').map(function(s){ return s.trim(); }).filter(Boolean);
                    if(keys.length){
                        var friendly = $.map(keys, function(k){ return fieldMap[k] || k; });
                        msg = 'Faltan o son inválidos los campos: ' + friendly.join(', ');
                    }
                }
                $('#result_register').html('<div class="alert alert-danger">'+msg+'</div>');
            }
        },
        error: function(xhr, status, error){
            $('#result_register').html('<div class="alert alert-danger">Error en la petición. Intente nuevamente.</div>');
        },
        complete: function(){
            $btn.prop('disabled', false);
        }
    });
});

// Previsualizar imagen seleccionada
$('#imagen_producto').on('change', function(e){
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_img').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview_img').hide().attr('src','');
    }
});
// Previsualizar imagen seleccionada (editar)
$('#edit_imagen_producto').on('change', function(e){
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_img_edit').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview_img_edit').hide().attr('src','');
    }
});

// Abrir modal editar: delegación para botones dinámicos con clase .btn_editar_producto y atributo data-id
$(document).on('click', '.btn_editar_producto', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    if(!id) return;
    $('#result_edit_register').html('<div class="text-center"><img src="../imagenes/ajax-loader.gif"> Cargando...</div>');
    // obtener datos del producto
    $.ajax({
        url: '../admin/get_producto_modal_lider_ajax.php',
        method: 'GET',
        dataType: 'json',
        data: { cod_producto: id },
        success: function(resp){
            if(resp && resp.afectado === 'SI'){
                var p = resp.producto;
                $('#edit_cod_producto').val(p.cod_producto);
                $('#edit_cod_producto_barra').val(p.cod_producto_barra);
                $('#edit_nombre_producto').val(p.nombre_producto);
                // Poblar selects con listas enviadas por el servidor si están disponibles
                if (resp.tiendas && resp.tiendas.length) {
                    var opts = '<option value="">Selecione</option>';
                    $.each(resp.tiendas, function(i,t){ opts += '<option value="'+t.cod_tienda+'">'+t.nombre_tienda+'</option>'; });
                    $('#edit_cod_tienda').html(opts).val(p.cod_tienda);
                } else {
                    $('#edit_cod_tienda').html('<option value="'+p.cod_tienda+'">'+p.nombre_tienda+'</option>').val(p.cod_tienda);
                }

                if (resp.categorias && resp.categorias.length) {
                    var opts = '<option value="">Selecione</option>';
                    $.each(resp.categorias, function(i,c){ opts += '<option value="'+c.cod_categoria+'">'+c.nombre_categoria+'</option>'; });
                    $('#edit_cod_categoria').html(opts).val(p.cod_categoria);
                } else {
                    $('#edit_cod_categoria').html('<option value="'+p.cod_categoria+'">'+p.nombre_categoria+'</option>').val(p.cod_categoria);
                }

                if (resp.ivas && resp.ivas.length) {
                    var opts = '<option value="">Selecione</option>';
                    $.each(resp.ivas, function(i,v){ opts += '<option value="'+v.iva+'">'+v.iva+'%</option>'; });
                    $('#edit_iva_ptj').html(opts).val(p.iva_ptj);
                } else {
                    $('#edit_iva_ptj').html('<option value="'+p.iva_ptj+'">'+p.iva_ptj+'%</option>').val(p.iva_ptj);
                }

                if (resp.estados && resp.estados.length) {
                    var opts = '';
                    $.each(resp.estados, function(i,e){ opts += '<option value="'+e.cod_estado+'">'+e.nombre_estado+'</option>'; });
                    $('#edit_cod_estado').html(opts).val(p.cod_estado);
                } else {
                    $('#edit_cod_estado').html('<option value="'+p.cod_estado+'">'+p.nombre_estado+'</option>').val(p.cod_estado);
                }

                $('#edit_precio_compra_producto').data('raw', String(p.precio_compra_producto));
                $('#edit_precio_compra_producto').val(String(p.precio_compra_producto).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                $('#edit_precio_venta_producto').data('raw', String(p.precio_venta_producto));
                $('#edit_precio_venta_producto').val(String(p.precio_venta_producto).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                $('#edit_descripcion_producto').val(p.descripcion_producto);
                if(p.url_img_orig_producto){
                    $('#preview_img_edit').attr('src', p.url_img_min_producto || p.url_img_orig_producto).show();
                } else { $('#preview_img_edit').hide().attr('src',''); }
                $('#result_edit_register').html('');
                $('.abrir_modal_editar_producto').modal('show');
            } else {
                $('#result_edit_register').html('<div class="alert alert-danger">No se pudo cargar producto.</div>');
            }
        },
        error: function(){
            $('#result_edit_register').html('<div class="alert alert-danger">Error en la petición.</div>');
        }
    });
});

// Envío AJAX para editar producto
$(document).on('click','#btn_guardar_producto_editar',function(e){
    e.preventDefault();
    var form = $('#form_edit_producto');
    var $btn = $(this);
    // Recoger datos y enviar sin validaciones (modal de edición no requiere verificaciones cliente)
    var unformat = function(str){ return String(str||'').replace(/[^0-9\-]/g,''); };
    var cod_producto = $('#edit_cod_producto').val();
    var precio_compra_raw = $('#edit_precio_compra_producto').data('raw') || unformat($('#edit_precio_compra_producto').val());
    var precio_venta_raw = $('#edit_precio_venta_producto').data('raw') || unformat($('#edit_precio_venta_producto').val());

    var formData = new FormData(form[0]);
    // Mantener envío de valores sin formato para la base de datos
    formData.set('precio_compra_producto', precio_compra_raw);
    formData.set('precio_venta_producto', precio_venta_raw);
    formData.set('cod_producto', cod_producto);
    $('#result_edit_register').html('<div class="text-center"><img src="../imagenes/ajax-loader.gif"> Guardando...</div>');
    $btn.prop('disabled', true);
    $.ajax({
        url: '../admin/edit_producto_modal_lider_ajax_reg.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            if(resp && resp.afectado === 'SI'){
                $('#result_edit_register').html('<div class="alert alert-success">'+(resp.mensaje||'Guardado correctamente.')+'</div>');
                setTimeout(function(){
                    $('.abrir_modal_editar_producto').modal('hide');
                    $('#form_edit_producto')[0].reset();
                    $('#preview_img_edit').hide().attr('src','');
                    load(1);
                },1200);
            } else {
                var msg = (resp && resp.mensaje) ? resp.mensaje : 'Error al guardar.';
                $('#result_edit_register').html('<div class="alert alert-danger">'+msg+'</div>');
            }
        },
        error: function(){ $('#result_edit_register').html('<div class="alert alert-danger">Error en la petición.</div>'); },
        complete: function(){ $btn.prop('disabled', false); }
    });
});
// Formateo visual de precios con separador de miles (puntos)
$('#precio_compra_producto, #precio_venta_producto').on('input', function(e){
    var $this = $(this);
    var raw = String($this.val()).replace(/[^0-9\-]/g,'');
    $this.data('raw', raw);
    if(raw === ''){ $this.val(''); return; }
    var formatted = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    $this.val(formatted);
});

// Al abrir modal limpiar data-raw si hay
$('.abrir_modal_registrar_producto').on('show.bs.modal', function(){
    $('#precio_compra_producto, #precio_venta_producto').data('raw', '');
});
</script>
<!-- Modal Editar Producto -->
<div class="modal fade abrir_modal_editar_producto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Producto</h4>
            </div>
            <div class="modal-body">
                <div id="result_edit_register"></div>
                <form id="form_edit_producto" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="cod_producto" id="edit_cod_producto" value="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Codigo Producto *</label>
                                <input type="text" name="cod_producto_barra" id="edit_cod_producto_barra" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre Producto *</label>
                                <input type="text" name="nombre_producto" id="edit_nombre_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tienda  *</label>
                                <select name="cod_tienda" id="edit_cod_tienda" class="form-control" required>
                                    <!-- Opciones cargadas dinámicamente -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Compra *</label>
                                <input type="text" name="precio_compra_producto" id="edit_precio_compra_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Venta (Contado) *</label>
                                <input type="text" name="precio_venta_producto" id="edit_precio_venta_producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Categoria *</label>
                                <select name="cod_categoria" id="edit_cod_categoria" class="form-control" required>
                                    <!-- Opciones cargadas dinámicamente -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Iva *</label>
                                <select name="iva_ptj" id="edit_iva_ptj" class="form-control" required>
                                    <!-- Opciones cargadas dinámicamente -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion_producto" id="edit_descripcion_producto" rows="2" cols="20" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Imagen Producto (dejar en blanco para mantener)</label>
                                <input type="file" name="imagen_producto" id="edit_imagen_producto" accept="image/*" class="form-control">
                                <small class="text-muted">Se guardará versión original y miniatura.</small>
                                <div id="preview_imagen_edit" style="margin-top:8px;">
                                    <img id="preview_img_edit" src="" style="max-width:100%; border-radius:6px; display:none;" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="cod_estado" id="edit_cod_estado" class="form-control" required>
                                    <!-- Opciones cargadas dinámicamente -->
                                </select>
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
                <button type="button" class="btn btn-primary" id="btn_guardar_producto_editar">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
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
        url:'../admin/tabla_busqueda_paginacion_producto_lider_diseno_vertical_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&cod_administrador='+cod_administrador+'&cod_seguridad='+cod_seguridad+'&tabla='+tabla+'&nombre_estado_factura='+nombre_estado_factura+'&pagina='+pagina, 
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