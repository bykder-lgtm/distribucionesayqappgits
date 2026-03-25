<?php 
$nombre_pagina          = "Mis Tiendas";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"     content="IE=edge">
<meta name="viewport"                  content="width=device-width, initial-scale=1">
<meta name="keywords"                  content="<?php echo $keywords ?>">
<meta name="description"               content="<?php echo $nombre_pagina ?>">
<meta name="author"                    content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style><?php include_once("../estilo_css/estilo_lista_tienda_aliado.css"); ?></style>

</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<?php
// Verificar cantidad de tiendas del aliado
$sql_count_tiendas = "SELECT COUNT(*) as total_tiendas FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador') AND cod_estado != '0'";
$consulta_count = mysqli_query($conectar, $sql_count_tiendas);
$datos_count = mysqli_fetch_assoc($consulta_count);
$total_tiendas_aliado = $datos_count['total_tiendas'];

// Consulta de tipos de sector para el formulario de registro de tienda
$sql_tipo_sector = "SELECT cod_tipo_sector, nombre_tipo_sector, descripcion_tipo_sector FROM tbl15_tipo_sector WHERE cod_estado = '1' ORDER BY cod_tipo_sector ASC";
$res_tipo_sector = mysqli_query($conectar, $sql_tipo_sector);
// Obtener datos del aliado para pre-llenar el formulario de registro de tienda
$sql_datos_aliado = "SELECT identificacion_tercero, telefono1_tercero, correo_tercero, direccion_tercero, barrio_tercero, cod_departamento, cod_municipio, cod_tipo_sector FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$res_datos_aliado = mysqli_query($conectar, $sql_datos_aliado);
$datos_aliado = ($res_datos_aliado && mysqli_num_rows($res_datos_aliado) > 0) ? mysqli_fetch_assoc($res_datos_aliado) : array();
?>

<main class="container py-4 mb-5">
    <!-- Encabezado de la página -->
    <div class="page-header">
        <div class="page-header-left">
            <h1 class="page-title"><i class="fa fa-store"></i> Mis Tiendas</h1>
            <p class="page-subtitle">Gestiona las tiendas asociadas a tu cuenta</p>
        </div>
        <?php if ($total_tiendas_aliado == 0) { ?><button class="btn-add-tienda" onclick="abrirModalTienda()"><i class="fa fa-plus"></i> Nueva Tienda</button><?php } ?>
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="tiendas-grid">
        <?php
        // Obtener las tiendas del aliado logueado
        $sql_tiendas = "SELECT * FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador') AND cod_estado != '0' ORDER BY nombre_tienda ASC";
        $consulta_tiendas = mysqli_query($conectar, $sql_tiendas);
        if (mysqli_num_rows($consulta_tiendas) > 0) {
            while ($tienda = mysqli_fetch_assoc($consulta_tiendas)) {

                $cod_tienda_item                                                = $tienda['cod_tienda'];
                $nombre_tienda                                                  = $tienda['nombre_tienda'];
                $abrev_tienda                                                   = $tienda['abrev_tienda'];
                $direccion_tienda                                               = isset($tienda['direccion_tienda']) ? $tienda['direccion_tienda'] : '';
                $telefono_tienda                                                = isset($tienda['telefono_tienda']) ? $tienda['telefono_tienda'] : '';
                $url_img_tienda                                                 = isset($tienda['url_img_orig_tienda']) ? $tienda['url_img_orig_tienda'] : '';
                $cod_estado_tienda                                              = isset($tienda['cod_estado']) ? $tienda['cod_estado'] : '1';
                
                $estado_class                                                   = ($cod_estado_tienda == '1') ? 'activo' : 'inactivo';
                $estado_text                                                    = ($cod_estado_tienda == '1') ? 'Activa' : 'Inactiva';
                // Contar productos de esta tienda
                $sql_total_prod = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda_item'";
                $consulta_total = mysqli_query($conectar, $sql_total_prod);
                $datos_total = mysqli_fetch_assoc($consulta_total);

                $total_productos                                                = $datos_total['total'];
                
                $sql_activos = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda_item' AND nombre_estado = 'HABILITADO'";
                $consulta_activos = mysqli_query($conectar, $sql_activos);
                $datos_activos = mysqli_fetch_assoc($consulta_activos);

                $productos_activos                                              = $datos_activos['total'];
                $productos_inactivos                                            = $total_productos - $productos_activos;
                // Contar vendedores de esta tienda
                $sql_total_vend = "SELECT COUNT(*) as total FROM tbl15_administrador WHERE cod_seguridad = '2' AND cod_vendedor = '$cod_tienda_item' AND cod_estado_activacion_usuario = '1'";
                $consulta_total_vend = mysqli_query($conectar, $sql_total_vend);
                $datos_total_vend = mysqli_fetch_assoc($consulta_total_vend);
                
                $total_vendedores                                               = $datos_total_vend['total'];
        ?>
        <div class="tienda-card">
            <div class="tienda-card-header">
                <?php if (!empty($url_img_tienda) && file_exists($url_img_tienda)) { ?>
                    <img src="<?php echo $url_img_tienda; ?>" alt="<?php echo $nombre_tienda; ?>" class="tienda-logo">
                <?php } else { ?>
                    <div class="tienda-logo-placeholder"><i class="fa fa-store"></i></div>
                <?php } ?>
            </div>
            <div class="tienda-card-body">
                <h3 class="tienda-nombre"><?php echo ucwords(strtolower($nombre_tienda)); ?></h3>
<!--
                <?php if (!empty($abrev_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-tag"></i><?php echo $abrev_tienda; ?></p>
                <?php } ?>
                <?php if (!empty($direccion_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-map-marker"></i><?php echo $direccion_tienda; ?></p>
                <?php } ?>
                <?php if (!empty($telefono_tienda)) { ?>
                    <p class="tienda-info"><i class="fa fa-phone"></i><?php echo $telefono_tienda; ?></p>
                <?php } ?>
                <span class="tienda-estado <?php echo $estado_class; ?>"><?php echo $estado_text; ?></span>
                <?php if(!empty($tienda['fecha_creacion'])): ?>
                <p class="tienda-info"><i class="fa fa-calendar-plus" style="color: #f59e0b;"></i><?php echo date('d/m/Y', strtotime($tienda['fecha_creacion'])); ?></p>
                <?php endif; ?>
-->
                
                <!-- Estadísticas de productos y vendedores -->
                <div class="tienda-stats">
                    <div class="stat-item stat-inactivos" onclick="verVendedoresTienda(<?php echo $cod_tienda_item; ?>, '<?php echo htmlspecialchars(addslashes($nombre_tienda), ENT_QUOTES); ?>')" style="cursor: pointer;">
                        <span class="stat-number"><?php echo $total_vendedores; ?></span>
                        <span class="stat-label">Vendedores</span>
                    </div>
                    <div class="stat-item stat-total" onclick="verProductosTienda(<?php echo $cod_tienda_item; ?>, '<?php echo htmlspecialchars(addslashes($nombre_tienda), ENT_QUOTES); ?>')" style="cursor: pointer;">
                        <span class="stat-number"><?php echo $total_productos; ?></span>
                        <span class="stat-label">Productos</span>
                    </div>
<!--
                    <div class="stat-item stat-activos">
                        <span class="stat-number"><?php echo $productos_activos; ?></span>
                        <span class="stat-label">Activos</span>
                    </div>
-->
                </div>

                <!-- Botones de acción rápida -->
                <div class="tienda-quick-actions">
                    <button type="button" class="btn-quick-action btn-vendedor" onclick="abrirRegistroVendedorDirecto(<?php echo $cod_tienda_item; ?>, '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-user-plus"></i> Registrar Vendedor
                    </button>
                    <button type="button" class="btn-quick-action btn-producto" onclick="abrirRegistroProductoDirecto(<?php echo $cod_tienda_item; ?>, '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-box-open"></i> Registrar Producto
                    </button>
                </div>
            </div>
            <div class="tienda-card-footer">
                <!--<a href="ver_catalogo_producto_visitante_intern.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-primary"><i class="fa fa-eye"></i> Ver Catálogo</a>-->
                <a href="../admin/lista_catalogo_tienda_productos_aliado_movil.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-primary"><i class="fa fa-eye"></i> Ver Catálogo</a>
                <a href="../admin/ver_detalle_tienda_aliado_movil.php?cod_tienda=<?php echo $cod_tienda_item; ?>" class="btn-tienda btn-tienda-secondary"><i class="fa fa-info-circle"></i> Ver Detalle</a>
                <button type="button" class="btn-tienda btn-tienda-secondary" onclick="abrirModalEditarTienda(<?php echo $cod_tienda_item; ?>)"><i class="fa fa-edit"></i> Editar</button>
            </div>
            <!-- Sección de Compartir URL de la Tienda -->
            <div class="tienda-share-section">
                <div class="share-title">
                    <i class="fa fa-share-alt"></i> Compartir Enlace de la Tienda
                </div>
                <div class="share-buttons">
                    <button type="button" class="btn-share btn-share-whatsapp" onclick="compartirTiendaWhatsApp('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa-brands fa-whatsapp"></i> <span>WhatsApp</span>
                    </button>
                    <button type="button" class="btn-share btn-share-email" onclick="compartirTiendaEmail('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-envelope"></i> <span>Email</span>
                    </button>
                    <button type="button" class="btn-share btn-share-copy" onclick="copiarEnlaceTienda('<?php echo $cod_tienda_item; ?>', '<?php echo addslashes($nombre_tienda); ?>')">
                        <i class="fa fa-copy"></i> <span>Copiar</span>
                    </button>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <i class="fa fa-store"></i>
            <h4>No tienes tiendas asignadas</h4>
            <p>Contacta al administrador para asignar tiendas a tu cuenta.</p>
        </div>
        <?php } ?>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>

<!-- Modal para registrar nueva tienda -->
<div id="modalNuevaTienda" class="modal-tienda">
    <div class="modal-tienda-content">

        <div class="modal-tienda-header">
            <h3><i class="fa fa-store"></i> Nueva Tienda</h3>
            <button class="modal-close" onclick="cerrarModalTienda()">&times;</button>
        </div>

        <form id="formNuevaTienda" onsubmit="return registrarTienda(event)" enctype="multipart/form-data">
            <div class="modal-tienda-body form-grid">
                <div id="alertSuccess" class="alert-success">
                    <i class="fa fa-check-circle"></i> <span id="alertSuccessText">Tienda registrada exitosamente</span>
                </div>
                <div id="alertError" class="alert-error">
                    <i class="fa fa-exclamation-circle"></i> <span id="alertErrorText">Error al registrar la tienda</span>
                </div>
                
                <!-- SECCIÓN: Información Básica -->
                <div class="form-section-title"><i class="fa fa-info-circle"></i> Información Básica</div>
                
                <div class="form-group-tienda full-width">
                    <label for="nombre_tienda"><i class="fa fa-building"></i> Nombre de la Tienda <span class="required-star">*</span></label>
                    <input type="text" id="nombre_tienda" name="nombre_tienda" placeholder="Ej: Mi Tienda Principal" required>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="identificacion_tercero"><i class="fa fa-id-card"></i> NIT / Identificación</label>
                        <input type="text" id="identificacion_tercero" name="identificacion_tercero" placeholder="Ej: 900123456-7" value="<?php echo isset($datos_aliado['identificacion_tercero']) ? htmlspecialchars($datos_aliado['identificacion_tercero']) : ''; ?>">
                    </div>
                    <div class="form-group-tienda">
                        <label for="telefono_tienda"><i class="fa fa-phone"></i> Teléfono</label>
                        <input type="text" id="telefono_tienda" name="telefono_tienda" placeholder="Ej: 3001234567" value="<?php echo isset($datos_aliado['telefono1_tercero']) ? htmlspecialchars($datos_aliado['telefono1_tercero']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group-tienda full-width">
                    <label for="correo_tercero"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" id="correo_tercero" name="correo_tercero" placeholder="Ej: tienda@ejemplo.com" value="<?php echo isset($datos_aliado['correo_tercero']) ? htmlspecialchars($datos_aliado['correo_tercero']) : ''; ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="cod_departamento"><i class="fa fa-map"></i> Departamento <span class="required-star">*</span></label>
                        <select id="cod_departamento" name="cod_departamento" onchange="cargarMunicipiosNuevaTienda()" required><option value="">Seleccione un departamento</option></select>
                    </div>
                    <div class="form-group-tienda">
                        <label for="cod_municipio"><i class="fa fa-map-pin"></i> Municipio <span class="required-star">*</span></label>
                        <select id="cod_municipio" name="cod_municipio" required><option value="">Seleccione primero un departamento</option></select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="direccion_tienda"><i class="fa fa-map-marker"></i> Dirección <span class="required-star">*</span></label>
                        <input type="text" id="direccion_tienda" name="direccion_tienda" placeholder="Ej: Calle 123 #45-67" required value="<?php echo isset($datos_aliado['direccion_tercero']) ? htmlspecialchars($datos_aliado['direccion_tercero']) : ''; ?>">
                    </div>
                    <div class="form-group-tienda">
                        <label for="barrio_tercero"><i class="fa fa-map-signs"></i> Barrio <span class="required-star">*</span></label>
                        <input type="text" id="barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel..." required value="<?php echo isset($datos_aliado['barrio_tercero']) ? htmlspecialchars($datos_aliado['barrio_tercero']) : ''; ?>">
                    </div>
                </div>

                <!-- Ubicación GPS -->
                <div class="form-group-tienda full-width">
                    <label for="ubicacion_gps_tienda"><i class="fa fa-map-marker-alt"></i> Ubicación GPS</label>
                    <div class="gps-input-wrapper">
                        <input type="text" id="ubicacion_gps_tienda" name="ubicacion_gps_tienda" placeholder="Ej: 4.7110,-74.0721" readonly>
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionGPS('ubicacion_gps_tienda', 'gps_status_registro')"><i class="fa fa-crosshairs"></i> Obtener</button>
                    </div>
                    <div id="gps_status_registro" class="gps-status"></div>
                </div>
                
                <!-- SECCIÓN: Información del Negocio -->
                <div class="form-section-title"><i class="fa fa-briefcase"></i> Información del Negocio</div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="cod_tipo_sector"><i class="fa fa-industry"></i> Tipo de Sector</label>
                        <select id="cod_tipo_sector" name="cod_tipo_sector">
                            <option value="">-- Seleccione --</option>
                            <?php 
                            if (isset($res_tipo_sector)) { mysqli_data_seek($res_tipo_sector, 0); }
                            while ($tipo_sector = mysqli_fetch_assoc($res_tipo_sector)): ?>
                            <option value="<?php echo $tipo_sector['cod_tipo_sector']; ?>" title="<?php echo htmlspecialchars($tipo_sector['descripcion_tipo_sector']); ?>"><?php echo $tipo_sector['nombre_tipo_sector']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group-tienda">
                        <label for="existe_rues"><i class="fa fa-clipboard-check"></i> ¿Existe en RUES?</label>
                        <select id="existe_rues" name="existe_rues">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="venta_presencial"><i class="fa fa-shopping-bag"></i> ¿Venta Presencial?</label>
                        <select id="venta_presencial" name="venta_presencial">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group-tienda">
                        <label for="venta_online"><i class="fa fa-globe"></i> ¿Venta Online?</label>
                        <select id="venta_online" name="venta_online">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="nombre_plataforma_ecommerce"><i class="fa fa-shopping-cart"></i> Plataforma E-commerce</label>
                        <input type="text" id="nombre_plataforma_ecommerce" name="nombre_plataforma_ecommerce" placeholder="Ej: Shopify, WooCommerce...">
                    </div>
                    <div class="form-group-tienda">
                        <label for="nombre_sistema_contable"><i class="fa fa-calculator"></i> Sistema Contable</label>
                        <input type="text" id="nombre_sistema_contable" name="nombre_sistema_contable" placeholder="Ej: Siigo, World Office, Alegra...">
                    </div>
                </div>

                <!-- SECCIÓN: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa fa-camera"></i> Imágenes del Establecimiento</div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="imagen_tienda"><i class="fa fa-image"></i> Imagen / Logo de la Tienda</label>
                        <input type="file" id="imagen_tienda" name="imagen_tienda" accept="image/*">
                        <img id="preview_img_tienda" src="" class="preview-img-tienda" alt="Vista previa">
                    </div>
                    <div class="form-group-tienda">
                        <label for="img_fachada_tienda"><i class="fa fa-store-alt"></i> Fachada</label>
                        <input type="file" id="img_fachada_tienda" name="url_img_fachada_tienda" accept="image/*">
                        <img id="preview_img_fachada" src="" class="preview-img-tienda" alt="Vista previa fachada">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="img_interna_tienda"><i class="fa fa-door-open"></i> Interna</label>
                        <input type="file" id="img_interna_tienda" name="url_img_interna_tienda" accept="image/*">
                        <img id="preview_img_interna" src="" class="preview-img-tienda" alt="Vista previa interna">
                    </div>
                    <div class="form-group-tienda">
                        <label for="img_selfieadmin_tienda"><i class="fa fa-user-circle"></i> Selfie con Admin</label>
                        <input type="file" id="img_selfieadmin_tienda" name="url_img_selfieadmin_tienda" accept="image/*">
                        <img id="preview_img_selfieadmin" src="" class="preview-img-tienda" alt="Vista previa selfie">
                    </div>
                </div>
                
            </div>
            <div class="modal-tienda-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalTienda()">Cancelar</button>
                <button type="submit" class="btn-modal btn-modal-primary" id="btnRegistrar">
                    <i class="fa fa-save"></i> Registrar Tienda
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Cargar departamentos en el modal de nueva tienda
function cargarDepartamentosNuevaTienda(selectedDept, selectedMuni) {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var select = $('#cod_departamento');
                select.empty();
                select.append('<option value="">Seleccione un departamento *</option>');
                $.each(response.departamentos, function(index, dept) {
                    var isSelected = (selectedDept && dept.cod_departamento == selectedDept) ? ' selected' : '';
                    select.append('<option value="' + dept.cod_departamento + '"' + isSelected + '>' +
                                dept.nombre_departamento + '</option>');
                });
                // Si hay departamento preseleccionado, cargar sus municipios
                if (selectedDept) {
                    cargarMunicipiosNuevaTiendaConPreseleccion(selectedDept, selectedMuni);
                }
            } else {
                console.error('Error al cargar departamentos:', response.mensaje);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX al cargar departamentos:', status, error);
        }
    });
}

// Cargar municipios en el modal de nueva tienda
function cargarMunicipiosNuevaTienda() {
    var codDepartamento = $('#cod_departamento').val();
    var selectMuni = $('#cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    
    if (!codDepartamento) {
        return;
    }
    
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php',
        type: 'GET',
        data: { cod_departamento: codDepartamento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    selectMuni.append('<option value="' + muni.cod_municipio + '">' +
                                    muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() {
            console.error('Error al cargar municipios');
        }
    });
}

// Cargar municipios con preselección
function cargarMunicipiosNuevaTiendaConPreseleccion(codDepartamento, selectedMuni) {
    var selectMuni = $('#cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    if (!codDepartamento) return;
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php',
        type: 'GET',
        data: { cod_departamento: codDepartamento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    var isSelected = (selectedMuni && muni.cod_municipio == selectedMuni) ? ' selected' : '';
                    selectMuni.append('<option value="' + muni.cod_municipio + '"' + isSelected + '>' +
                                    muni.nombre_municipio + '</option>');
                });
            }
        }
    });
}

// Cargar departamentos en el modal de edición
function cargarDepartamentosEditarTienda(selectedDept, selectedMuni) {
    $.ajax({
        url: '../admin/obtener_departamentos_ajax.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var select = $('#edit_cod_departamento');
                select.empty();
                select.append('<option value="">Seleccione un departamento *</option>');
                $.each(response.departamentos, function(index, dept) {
                    var selected = (dept.cod_departamento == selectedDept) ? 'selected' : '';
                    select.append('<option value="' + dept.cod_departamento + '" ' + selected + '>' +
                                dept.nombre_departamento + '</option>');
                });
                // Si hay departamento seleccionado, cargar municipios
                if (selectedDept) {
                    cargarMunicipiosEditarTienda(selectedDept, selectedMuni);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar departamentos editar:', status, error);
        }
    });
}

// Cargar municipios en el modal de edición
function cargarMunicipiosEditarTienda(codDepartamento, selectedMuni) {
    if (!codDepartamento) {
        codDepartamento = $('#edit_cod_departamento').val();
    }
    var selectMuni = $('#edit_cod_municipio');
    selectMuni.empty();
    selectMuni.append('<option value="">Seleccione un municipio *</option>');
    
    if (!codDepartamento) {
        return;
    }
    
    $.ajax({
        url: '../admin/obtener_municipios_ajax.php',
        type: 'GET',
        data: { cod_departamento: codDepartamento },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.each(response.municipios, function(index, muni) {
                    var selected = (muni.cod_municipio == selectedMuni) ? 'selected' : '';
                    selectMuni.append('<option value="' + muni.cod_municipio + '" ' + selected + '>' +
                                    muni.nombre_municipio + '</option>');
                });
            }
        },
        error: function() {
            console.error('Error al cargar municipios en editar');
        }
    });
}

function abrirModalTienda() {
    document.getElementById('modalNuevaTienda').style.display = 'block';
    document.getElementById('formNuevaTienda').reset();
    document.getElementById('alertSuccess').style.display = 'none';
    document.getElementById('alertError').style.display = 'none';
    
    // Restaurar valores pre-llenados del aliado (el reset los borra)
    var aliadoData = {
        identificacion_tercero: '<?php echo isset($datos_aliado["identificacion_tercero"]) ? addslashes($datos_aliado["identificacion_tercero"]) : ""; ?>',
        telefono1_tercero: '<?php echo isset($datos_aliado["telefono1_tercero"]) ? addslashes($datos_aliado["telefono1_tercero"]) : ""; ?>',
        correo_tercero: '<?php echo isset($datos_aliado["correo_tercero"]) ? addslashes($datos_aliado["correo_tercero"]) : ""; ?>',
        direccion_tercero: '<?php echo isset($datos_aliado["direccion_tercero"]) ? addslashes($datos_aliado["direccion_tercero"]) : ""; ?>',
        barrio_tercero: '<?php echo isset($datos_aliado["barrio_tercero"]) ? addslashes($datos_aliado["barrio_tercero"]) : ""; ?>',
        cod_departamento: '<?php echo isset($datos_aliado["cod_departamento"]) ? $datos_aliado["cod_departamento"] : ""; ?>',
        cod_municipio: '<?php echo isset($datos_aliado["cod_municipio"]) ? $datos_aliado["cod_municipio"] : ""; ?>',
        cod_tipo_sector: '<?php echo isset($datos_aliado["cod_tipo_sector"]) ? $datos_aliado["cod_tipo_sector"] : ""; ?>'
    };
    
    document.getElementById('identificacion_tercero').value = aliadoData.identificacion_tercero;
    document.getElementById('telefono_tienda').value = aliadoData.telefono1_tercero;
    document.getElementById('correo_tercero').value = aliadoData.correo_tercero;
    document.getElementById('direccion_tienda').value = aliadoData.direccion_tercero;
    document.getElementById('barrio_tercero').value = aliadoData.barrio_tercero;
    if (aliadoData.cod_tipo_sector) {
        document.getElementById('cod_tipo_sector').value = aliadoData.cod_tipo_sector;
    }
    
    // Cargar departamentos con preselección del aliado
    cargarDepartamentosNuevaTienda(aliadoData.cod_departamento, aliadoData.cod_municipio);
    
    // Ocultar previews de imágenes
    var imagePreviews = ['preview_img_tienda', 'preview_img_fachada', 'preview_img_interna', 'preview_img_selfieadmin'];
    imagePreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.src = '';
        }
    });
}

function cerrarModalTienda() {
    document.getElementById('modalNuevaTienda').style.display = 'none';
}

// Cerrar modal al hacer clic fuera

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

// Función para obtener ubicación GPS
function obtenerUbicacionGPS(inputId, statusId) {
    var input = document.getElementById(inputId);
    var status = document.getElementById(statusId);
    
    if (!navigator.geolocation) {
        status.className = 'gps-status error';
        status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Tu navegador no soporta geolocalización';
        return;
    }
    
    status.className = 'gps-status loading';
    status.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...';
    
    navigator.geolocation.getCurrentPosition(
        function(position) {
            var lat = position.coords.latitude.toFixed(6);
            var lng = position.coords.longitude.toFixed(6);
            input.value = lat + ',' + lng;
            status.className = 'gps-status success';
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
            status.className = 'gps-status error';
            status.innerHTML = '<i class="fa fa-exclamation-triangle"></i> ' + mensaje;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// Función para previsualizar documentos
function setupDocPreview(inputId, previewId) {
    var input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('change', function(e) {
            var preview = document.getElementById(previewId);
            if (this.files && this.files[0]) {
                var fileName = this.files[0].name;
                var fileSize = (this.files[0].size / 1024).toFixed(1) + ' KB';
                preview.innerHTML = '<div class="file-preview-item"><i class="fa fa-file"></i> ' + fileName + ' (' + fileSize + ')</div>';
            } else {
                preview.innerHTML = '';
            }
        });
    }
}

// Configurar previsualizaciones al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Previews de imágenes - Modal Nueva Tienda
    setupImagePreview('imagen_tienda', 'preview_img_tienda');
    setupImagePreview('img_fachada_tienda', 'preview_img_fachada');
    setupImagePreview('img_interna_tienda', 'preview_img_interna');
    setupImagePreview('img_selfieadmin_tienda', 'preview_img_selfieadmin');
    
    // Previews de imágenes - Modal Editar Tienda
    setupImagePreview('edit_imagen_tienda', 'preview_img_tienda_edit');
    setupImagePreview('edit_img_fachada_tienda', 'edit_preview_img_fachada');
    setupImagePreview('edit_img_interna_tienda', 'edit_preview_img_interna');
    setupImagePreview('edit_img_selfieadmin_tienda', 'edit_preview_img_selfieadmin');
    setupImagePreview('edit_img_otraopcional_tienda', 'edit_preview_img_otraopcional');
    
    // Previews de documentos - Modal Editar Tienda
    setupDocPreview('edit_rut_tienda', 'edit_preview_rut_tienda');
    setupDocPreview('edit_camaracomercio_tienda', 'edit_preview_camaracomercio_tienda');
    setupDocPreview('edit_contratofirma_tienda', 'edit_preview_contratofirma_tienda');
    setupDocPreview('edit_extra1_tienda', 'edit_preview_extra1_tienda');
});

// =====================================================
// FUNCIONES PARA MODAL DE NOTIFICACIÓN
// =====================================================
function mostrarModalNotificacion(tipo, titulo, mensaje, recargar) {
    var modal = document.getElementById('modalNotificacion');
    var icon = document.getElementById('notifIcon');
    var iconSymbol = document.getElementById('notifIconSymbol');
    var titleEl = document.getElementById('notifTitle');
    var messageEl = document.getElementById('notifMessage');
    var button = document.getElementById('notifButton');
    
    // Remover clases previas
    icon.classList.remove('success', 'error');
    button.classList.remove('success', 'error');
    
    if (tipo === 'success') {
        icon.classList.add('success');
        button.classList.add('success');
        iconSymbol.className = 'fa fa-check-circle';
        titleEl.textContent = titulo || '¡Éxito!';
    } else {
        icon.classList.add('error');
        button.classList.add('error');
        iconSymbol.className = 'fa fa-exclamation-circle';
        titleEl.textContent = titulo || 'Error';
    }
    messageEl.textContent = mensaje;
    modal.classList.add('show');
    // Si debe recargar la página al cerrar
    if (recargar) { button.setAttribute('data-reload', 'true'); } else { button.removeAttribute('data-reload'); }
}

function cerrarModalNotificacion() {
    var modal = document.getElementById('modalNotificacion');
    var button = document.getElementById('notifButton');
    
    modal.classList.remove('show');
    
    // Si tiene atributo de recargar, recargar la página
    if (button.getAttribute('data-reload') === 'true') {
        setTimeout(function() {
            location.reload();
        }, 300);
    }
}

function registrarTienda(event) {
    event.preventDefault();
    
    var nombre_tienda = document.getElementById('nombre_tienda').value.trim();
    
    if (nombre_tienda === '') {
        mostrarModalNotificacion('error', 'Campo Requerido', 'El nombre de la tienda es obligatorio', false);
        return false;
    }
    
    document.getElementById('btnRegistrar').disabled = true;
    document.getElementById('btnRegistrar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Registrando...';
    
    // Usar FormData para enviar archivos
    var formData = new FormData(document.getElementById('formNuevaTienda'));
    formData.append('cod_aliado_estrategico', '<?php echo $cod_administrador; ?>');
    
    $.ajax({
        url: 'registrar_tienda_aliado_movil_ajax.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            // Cerrar el modal de registro
            cerrarModalTienda();
            
            if (response.success) {
                // Guardar datos de la tienda registrada para usar en los modales de vendedores/productos
                window._tiendaRegistrada = {
                    cod_tienda: response.cod_tienda,
                    nombre_tienda: document.getElementById('nombre_tienda').value.trim()
                };
                // Resetear listas de items registrados
                window._vendedoresRegistrados = [];
                window._productosRegistrados = [];
                // Mostrar modal de confirmación post-registro
                abrirModalConfirmacion(window._tiendaRegistrada.nombre_tienda);
            } else {
                mostrarModalNotificacion(
                    'error',
                    'Error al Registrar',
                    response.message || 'No se pudo registrar la tienda. Por favor, verifica los datos e intenta nuevamente.',
                    false
                );
            }
        },
        error: function(xhr, status, error) {
            cerrarModalTienda();
            mostrarModalNotificacion(
                'error',
                'Error de Conexión',
                'No se pudo conectar con el servidor. Por favor, verifica tu conexión a internet e intenta nuevamente.',
                false
            );
        },
        complete: function() {
            document.getElementById('btnRegistrar').disabled = false;
            document.getElementById('btnRegistrar').innerHTML = '<i class="fa fa-save"></i> Registrar Tienda';
        }
    });
    
    return false;
}

// ===================== EDITAR TIENDA =====================
function abrirModalEditarTienda(codTienda) {
    // Limpiar modal
    document.getElementById('formEditarTienda').reset();
    document.getElementById('alertEditSuccess').style.display = 'none';
    document.getElementById('alertEditError').style.display = 'none';
    
    // Ocultar previews de imágenes
    var imagePreviews = ['preview_img_tienda_edit', 'edit_preview_img_fachada', 'edit_preview_img_interna', 'edit_preview_img_selfieadmin', 'edit_preview_img_otraopcional'];
    imagePreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.src = '';
        }
    });
    
    // Limpiar previews de documentos
    var docPreviews = ['edit_preview_rut_tienda', 'edit_preview_camaracomercio_tienda', 'edit_preview_contratofirma_tienda', 'edit_preview_extra1_tienda'];
    docPreviews.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.innerHTML = '';
    });
    
    // Mostrar loader
    document.getElementById('btnActualizar').disabled = true;
    document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Cargando...';
    
    // Mostrar modal
    document.getElementById('modalEditarTienda').style.display = 'block';
    
    // Cargar datos de la tienda
    $.ajax({
        url: 'obtener_tienda_aliado_ajax.php',
        type: 'GET',
        data: { cod_tienda: codTienda },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var tienda = response.tienda;
                document.getElementById('edit_cod_tienda').value = tienda.cod_tienda;
                document.getElementById('edit_nombre_tienda').value = tienda.nombre_tienda;
                document.getElementById('edit_identificacion_tercero').value = tienda.identificacion_tercero || '';
                document.getElementById('edit_direccion_tienda').value = tienda.direccion_tercero || '';
                document.getElementById('edit_barrio_tercero').value = tienda.barrio_tercero || '';
                document.getElementById('edit_telefono_tienda').value = tienda.telefono1_tercero || '';
                document.getElementById('edit_correo_tercero').value = tienda.correo_tercero || '';
                document.getElementById('edit_ubicacion_gps_tienda').value = tienda.ubicacion_gps_tienda || '';
                document.getElementById('edit_cod_estado').value = tienda.cod_estado;
                
                // Cargar campos de Información del Negocio
                if (tienda.cod_tipo_sector) document.getElementById('edit_cod_tipo_sector').value = tienda.cod_tipo_sector;
                if (tienda.existe_rues) document.getElementById('edit_existe_rues').value = tienda.existe_rues;
                if (tienda.venta_presencial) document.getElementById('edit_venta_presencial').value = tienda.venta_presencial;
                if (tienda.venta_online) document.getElementById('edit_venta_online').value = tienda.venta_online;
                document.getElementById('edit_nombre_plataforma_ecommerce').value = tienda.nombre_plataforma_ecommerce || '';
                document.getElementById('edit_nombre_sistema_contable').value = tienda.nombre_sistema_contable || '';
                
                // Cargar departamentos y municipios con valores guardados
                cargarDepartamentosEditarTienda(tienda.cod_departamento, tienda.cod_municipio);
                
                // Mostrar imagen actual si existe
                if (tienda.url_img_min_tienda || tienda.url_img_orig_tienda) {
                    document.getElementById('preview_img_tienda_edit').src = tienda.url_img_min_tienda || tienda.url_img_orig_tienda;
                    document.getElementById('preview_img_tienda_edit').style.display = 'block';
                }
                // Mostrar imágenes del establecimiento si existen
                if (tienda.url_img_fachada_tienda) {
                    document.getElementById('edit_preview_img_fachada').src = tienda.url_img_fachada_tienda;
                    document.getElementById('edit_preview_img_fachada').style.display = 'block';
                }
                if (tienda.url_img_interna_tienda) {
                    document.getElementById('edit_preview_img_interna').src = tienda.url_img_interna_tienda;
                    document.getElementById('edit_preview_img_interna').style.display = 'block';
                }
                if (tienda.url_img_selfieadmin_tienda) {
                    document.getElementById('edit_preview_img_selfieadmin').src = tienda.url_img_selfieadmin_tienda;
                    document.getElementById('edit_preview_img_selfieadmin').style.display = 'block';
                }
                if (tienda.url_img_otraopcional_tienda) {
                    document.getElementById('edit_preview_img_otraopcional').src = tienda.url_img_otraopcional_tienda;
                    document.getElementById('edit_preview_img_otraopcional').style.display = 'block';
                }
                // Mostrar indicadores de documentos existentes
                if (tienda.url_documentacion_rut_tienda) {
                    document.getElementById('edit_preview_rut_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_camaracomercio_tienda) {
                    document.getElementById('edit_preview_camaracomercio_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_contratofirma_tienda) {
                    document.getElementById('edit_preview_contratofirma_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
                if (tienda.url_documentacion_extra1_tienda) {
                    document.getElementById('edit_preview_extra1_tienda').innerHTML = '<div class="file-preview-item"><i class="fa fa-check-circle"></i> Documento cargado</div>';
                }
            } else {
                document.getElementById('alertEditErrorText').innerText = response.message || 'Error al cargar datos';
                document.getElementById('alertEditError').style.display = 'block';
            }
        },
        error: function() {
            document.getElementById('alertEditErrorText').innerText = 'Error de conexión. Intente nuevamente.';
            document.getElementById('alertEditError').style.display = 'block';
        },
        complete: function() {
            document.getElementById('btnActualizar').disabled = false;
            document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-save"></i> Guardar Cambios';
        }
    });
}

function cerrarModalEditarTienda() {
    document.getElementById('modalEditarTienda').style.display = 'none';
}
// Previsualización de imagen en edición
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('edit_imagen_tienda').addEventListener('change', function(e) {
        var input = this;
        var preview = document.getElementById('preview_img_tienda_edit');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});

function actualizarTienda(event) {
    event.preventDefault();
    
    var nombre_tienda = document.getElementById('edit_nombre_tienda').value.trim();
    
    if (nombre_tienda === '') {
        mostrarModalNotificacion('error', 'Campo Requerido', 'El nombre de la tienda es obligatorio', false);
        return false;
    }
    
    document.getElementById('btnActualizar').disabled = true;
    document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
    
    // Usar FormData para enviar archivos
    var formData = new FormData(document.getElementById('formEditarTienda'));
    
    $.ajax({
        url: 'editar_tienda_aliado_ajax.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(response) {
            // Cerrar el modal de edición
            cerrarModalEditarTienda();
            
            if (response.success) {
                mostrarModalNotificacion(
                    'success',
                    '¡Tienda Actualizada!',
                    response.message || 'Los cambios se guardaron correctamente. La página se recargará para mostrar las actualizaciones.',
                    true // recargar al cerrar
                );
            } else {
                mostrarModalNotificacion(
                    'error',
                    'Error al Actualizar',
                    response.message || 'No se pudieron guardar los cambios. Por favor, verifica los datos e intenta nuevamente.',
                    false
                );
            }
        },
        error: function(xhr, status, error) {
            cerrarModalEditarTienda();
            mostrarModalNotificacion(
                'error',
                'Error de Conexión',
                'No se pudo conectar con el servidor. Por favor, verifica tu conexión a internet e intenta nuevamente.',
                false
            );
        },
        complete: function() {
            document.getElementById('btnActualizar').disabled = false;
            document.getElementById('btnActualizar').innerHTML = '<i class="fa fa-save"></i> Guardar Cambios';
        }
    });
    
    return false;
}

// Cerrar modales al hacer clic fuera

// =====================================================
// FUNCIONES PARA COMPARTIR URL DE TIENDA
// =====================================================

// Generar la URL del catálogo de la tienda
function generarUrlCatalogoTienda(codTienda) {
    var currentPath = window.location.pathname;
    var basePath = currentPath.substring(0, currentPath.lastIndexOf('/app/admin/') + '/app/admin/'.length);
    return window.location.origin + basePath + 'catalogo_productos_tienda_movil.php?cod_tienda=' + encodeURIComponent(codTienda);
}

// Compartir por WhatsApp
function compartirTiendaWhatsApp(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    var mensaje = '¡Hola! 👋\n\n' +
        '✨ Te comparto el catálogo de *' + nombreTienda + '*\n\n' +
        '🛒 Visita nuestra tienda y descubre todos nuestros productos:\n\n' +
        urlCatalogo + '\n\n' +
        '¡Te esperamos! 🎉';
    
    var urlWhatsApp = 'https://wa.me/?text=' + encodeURIComponent(mensaje);
    window.open(urlWhatsApp, '_blank');
}

// Compartir por Email
function compartirTiendaEmail(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    var asunto = 'Te invito a conocer la tienda ' + nombreTienda;
    var cuerpo = 'Hola,\n\n' +
        'Quiero compartirte el catálogo de nuestra tienda: ' + nombreTienda + '\n\n' +
        'Puedes ver todos nuestros productos en el siguiente enlace:\n\n' +
        urlCatalogo + '\n\n' +
        '¡Te esperamos!\n\n' +
        'Saludos.';
    
    var mailtoLink = 'mailto:?subject=' + encodeURIComponent(asunto) + '&body=' + encodeURIComponent(cuerpo);
    window.location.href = mailtoLink;
}

// Copiar enlace al portapapeles
function copiarEnlaceTienda(codTienda, nombreTienda) {
    var urlCatalogo = generarUrlCatalogoTienda(codTienda);
    
    // Intentar usar la API moderna de Clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(urlCatalogo).then(function() {
            mostrarNotificacionCopiado(nombreTienda);
        }).catch(function() {
            copiarEnlaceFallback(urlCatalogo, nombreTienda);
        });
    } else {
        copiarEnlaceFallback(urlCatalogo, nombreTienda);
    }
}

// Fallback para navegadores que no soportan clipboard API
function copiarEnlaceFallback(texto, nombreTienda) {
    var tempInput = document.createElement('input');
    tempInput.value = texto;
    tempInput.style.position = 'fixed';
    tempInput.style.opacity = '0';
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999);
    
    try {
        var exitoso = document.execCommand('copy');
        if (exitoso) {
            mostrarNotificacionCopiado(nombreTienda);
        } else {
            alert('No se pudo copiar el enlace. Por favor copia manualmente: ' + texto);
        }
    } catch (err) {
        alert('Error al copiar: ' + err);
    }
    document.body.removeChild(tempInput);
}

// Mostrar notificación de éxito al copiar (compatible sin SweetAlert)
function mostrarNotificacionCopiado(nombreTienda) {
    // Crear notificación flotante
    var notif = document.createElement('div');
    notif.innerHTML = '<i class="fa fa-check-circle"></i> ¡Enlace de "' + nombreTienda + '" copiado!';
    notif.style.cssText = 'position: fixed; bottom: 100px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%); color: white; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 20px rgba(0, 212, 255, 0.5); z-index: 10000; animation: slideUp 0.3s ease;';
    document.body.appendChild(notif);
    
    // Agregar animación temporal
    var styleSheet = document.createElement('style');
    styleSheet.textContent = '@keyframes slideUp { from { opacity: 0; transform: translateX(-50%) translateY(20px); } to { opacity: 1; transform: translateX(-50%) translateY(0); } }';
    document.head.appendChild(styleSheet);
    
    // Remover después de 2.5 segundos
    setTimeout(function() {
        notif.style.opacity = '0';
        notif.style.transform = 'translateX(-50%) translateY(20px)';
        notif.style.transition = 'all 0.3s ease';
        setTimeout(function() {
            notif.remove();
            styleSheet.remove();
        }, 300);
    }, 2500);
}

// =====================================================
// FUNCIONES PARA MODAL DE CONFIRMACIÓN POST-REGISTRO
// =====================================================
function abrirModalConfirmacion(nombreTienda) {
    document.getElementById('confirmNombreTienda').textContent = nombreTienda;
    document.getElementById('modalConfirmacionRegistro').classList.add('show');
}

function cerrarModalConfirmacion() {
    document.getElementById('modalConfirmacionRegistro').classList.remove('show');
}

function cerrarConfirmacionYRecargar() {
    cerrarModalConfirmacion();
    location.reload();
}

// Contadores para items registrados en esta sesión
window._vendedoresRegistrados = [];
window._productosRegistrados = [];

function irCrearVendedores() {
    cerrarModalConfirmacion();
    if (window._tiendaRegistrada && window._tiendaRegistrada.cod_tienda) {
        document.getElementById('vendedor_cod_tienda').value = window._tiendaRegistrada.cod_tienda;
        document.getElementById('vendedorNombreTienda').textContent = window._tiendaRegistrada.nombre_tienda;
        document.getElementById('formRegistroVendedor').reset();
        document.getElementById('vendedor_cod_tienda').value = window._tiendaRegistrada.cod_tienda;
        document.getElementById('modalRegistroVendedor').classList.add('show');
    } else {
        location.reload();
    }
}

function irCrearProductos() {
    cerrarModalConfirmacion();
    if (window._tiendaRegistrada && window._tiendaRegistrada.cod_tienda) {
        document.getElementById('producto_cod_tienda').value = window._tiendaRegistrada.cod_tienda;
        document.getElementById('productoNombreTienda').textContent = window._tiendaRegistrada.nombre_tienda;
        document.getElementById('formRegistroProducto').reset();
        document.getElementById('producto_cod_tienda').value = window._tiendaRegistrada.cod_tienda;
        var previewImg = document.getElementById('preview_producto_img');
        if (previewImg) { previewImg.style.display = 'none'; previewImg.src = ''; }
        document.getElementById('modalRegistroProducto').classList.add('show');
    } else {
        location.reload();
    }
}

// Abrir modal de registro de vendedor directamente desde la tarjeta de tienda
function abrirRegistroVendedorDirecto(codTienda, nombreTienda) {
    document.getElementById('vendedor_cod_tienda').value = codTienda;
    document.getElementById('vendedorNombreTienda').textContent = nombreTienda;
    document.getElementById('formRegistroVendedor').reset();
    document.getElementById('vendedor_cod_tienda').value = codTienda;
    document.getElementById('modalRegistroVendedor').classList.add('show');
}

// Abrir modal de registro de producto directamente desde la tarjeta de tienda
function abrirRegistroProductoDirecto(codTienda, nombreTienda) {
    document.getElementById('producto_cod_tienda').value = codTienda;
    document.getElementById('productoNombreTienda').textContent = nombreTienda;
    document.getElementById('formRegistroProducto').reset();
    document.getElementById('producto_cod_tienda').value = codTienda;
    var previewImg = document.getElementById('preview_producto_img');
    if (previewImg) { previewImg.style.display = 'none'; previewImg.src = ''; }
    document.getElementById('modalRegistroProducto').classList.add('show');
}

function cerrarModalVendedor() {
    document.getElementById('modalRegistroVendedor').classList.remove('show');
}

function cerrarModalProducto() {
    document.getElementById('modalRegistroProducto').classList.remove('show');
}

function volverAConfirmacion() {
    cerrarModalVendedor();
    abrirModalConfirmacion(window._tiendaRegistrada ? window._tiendaRegistrada.nombre_tienda : '');
}

function volverAConfirmacionDesdeProducto() {
    cerrarModalProducto();
    abrirModalConfirmacion(window._tiendaRegistrada ? window._tiendaRegistrada.nombre_tienda : '');
}

function finalizarYRecargar() {
    cerrarModalVendedor();
    cerrarModalProducto();
    cerrarModalConfirmacion();
    location.reload();
}

function previewImageProducto(input) {
    var preview = document.getElementById('preview_producto_img');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

// Agregar vendedor registrado a la lista visual
function agregarVendedorALista(nombre, identificacion, usuario) {
    window._vendedoresRegistrados.push({ nombre: nombre, identificacion: identificacion });
    var container = document.getElementById('listaVendedoresRegistrados');
    var list = document.getElementById('vendedoresRegistradosList');
    var counter = document.getElementById('contadorVendedores');
    container.style.display = 'block';
    counter.textContent = window._vendedoresRegistrados.length;
    
    var html = '<div class="item-registrado">' +
        '<div class="item-registrado-icon vendedor-bg"><i class="fa fa-user"></i></div>' +
        '<div class="item-registrado-info">' +
            '<h5>' + nombre + '</h5>' +
            '<span>CC: ' + identificacion + (usuario ? ' | Usuario: ' + usuario : '') + '</span>' +
        '</div>' +
        '<i class="fa fa-check-circle item-registrado-check"></i>' +
    '</div>';
    list.insertAdjacentHTML('beforeend', html);
}

// Agregar producto registrado a la lista visual
function agregarProductoALista(nombre, codigo, precioVenta) {
    window._productosRegistrados.push({ nombre: nombre, codigo: codigo });
    var container = document.getElementById('listaProductosRegistrados');
    var list = document.getElementById('productosRegistradosList');
    var counter = document.getElementById('contadorProductos');
    container.style.display = 'block';
    counter.textContent = window._productosRegistrados.length;
    
    var precioFormateado = Number(precioVenta).toLocaleString('es-CO');
    var html = '<div class="item-registrado">' +
        '<div class="item-registrado-icon producto-bg"><i class="fa fa-cube"></i></div>' +
        '<div class="item-registrado-info">' +
            '<h5>' + nombre + '</h5>' +
            '<span>Código: ' + codigo + ' | $' + precioFormateado + '</span>' +
        '</div>' +
        '<i class="fa fa-check-circle item-registrado-check"></i>' +
    '</div>';
    list.insertAdjacentHTML('beforeend', html);
}

// ========== FORMATEAR PRECIOS CON SEPARADOR DE MILES ==========
function formatearPrecio(input) {
    var valor = input.value.replace(/[^\d]/g, '');
    if (valor === '') { input.value = ''; return; }
    var numero = parseInt(valor, 10);
    input.value = '$ ' + numero.toLocaleString('es-CO');
}

</script>

<!-- Modal para editar tienda -->
<div id="modalEditarTienda" class="modal-tienda">
    <div class="modal-tienda-content">
        <div class="modal-tienda-header">
            <h3><i class="fa fa-edit"></i> Editar Tienda</h3>
            <button class="modal-close" onclick="cerrarModalEditarTienda()">&times;</button>
        </div>
        <form id="formEditarTienda" onsubmit="return actualizarTienda(event)" enctype="multipart/form-data">
            <input type="hidden" id="edit_cod_tienda" name="cod_tienda">
            <div class="modal-tienda-body form-grid">
                <div id="alertEditSuccess" class="alert-success">
                    <i class="fa fa-check-circle"></i> <span id="alertEditSuccessText">Tienda actualizada exitosamente</span>
                </div>
                <div id="alertEditError" class="alert-error">
                    <i class="fa fa-exclamation-circle"></i> <span id="alertEditErrorText">Error al actualizar la tienda</span>
                </div>
                
                <!-- SECCIÓN: Información Básica -->
                <div class="form-section-title"><i class="fa fa-info-circle"></i> Información Básica</div>
                
                <div class="form-group-tienda">
                    <label for="edit_nombre_tienda"><i class="fa fa-building"></i> Nombre de la Tienda <span class="required-star">*</span></label>
                    <input type="text" id="edit_nombre_tienda" name="nombre_tienda" placeholder="Ej: Mi Tienda Principal" required>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_identificacion_tercero"><i class="fa fa-id-card"></i> NIT de la Tienda</label>
                    <input type="text" id="edit_identificacion_tercero" name="identificacion_tercero" placeholder="Ej: 900123456-7">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_direccion_tienda"><i class="fa fa-map-marker"></i> Dirección</label>
                    <input type="text" id="edit_direccion_tienda" name="direccion_tienda" placeholder="Ej: Calle 123 #45-67">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_barrio_tercero"><i class="fa fa-map-signs"></i> Barrio</label>
                    <input type="text" id="edit_barrio_tercero" name="barrio_tercero" placeholder="Ej: Centro, Santa Isabel...">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_telefono_tienda"><i class="fa fa-phone"></i> Teléfono</label>
                    <input type="text" id="edit_telefono_tienda" name="telefono_tienda" placeholder="Ej: 3001234567">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_correo_tercero"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" id="edit_correo_tercero" name="correo_tercero" placeholder="Ej: tienda@ejemplo.com">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_departamento"><i class="fa fa-map"></i> Departamento <span class="required-star">*</span></label>
                    <select id="edit_cod_departamento" name="cod_departamento" onchange="cargarMunicipiosEditarTienda()" required>
                        <option value="">Seleccione un departamento</option>
                    </select>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_municipio"><i class="fa fa-map-pin"></i> Municipio <span class="required-star">*</span></label>
                    <select id="edit_cod_municipio" name="cod_municipio" required>
                        <option value="">Seleccione primero un departamento</option>
                    </select>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_ubicacion_gps_tienda"><i class="fa fa-map-marker-alt"></i> Ubicación GPS</label>
                    <div class="gps-input-wrapper">
                        <input type="text" id="edit_ubicacion_gps_tienda" name="ubicacion_gps_tienda" placeholder="Ej: 4.7110,-74.0721" readonly>
                        <button type="button" class="btn-gps" onclick="obtenerUbicacionGPS('edit_ubicacion_gps_tienda', 'gps_status_editar')"><i class="fa fa-crosshairs"></i> Obtener</button>
                    </div>
                    <div id="gps_status_editar" class="gps-status"></div>
                </div>
                
                <!-- SECCIÓN: Información del Negocio -->
                <div class="form-section-title"><i class="fa fa-briefcase"></i> Información del Negocio</div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="edit_cod_tipo_sector"><i class="fa fa-industry"></i> Tipo de Sector</label>
                        <select id="edit_cod_tipo_sector" name="cod_tipo_sector">
                            <option value="">-- Seleccione --</option>
                            <?php 
                            if (isset($res_tipo_sector)) { mysqli_data_seek($res_tipo_sector, 0); }
                            while ($tipo_sector = mysqli_fetch_assoc($res_tipo_sector)): ?>
                            <option value="<?php echo $tipo_sector['cod_tipo_sector']; ?>" title="<?php echo htmlspecialchars($tipo_sector['descripcion_tipo_sector']); ?>"><?php echo $tipo_sector['nombre_tipo_sector']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group-tienda">
                        <label for="edit_existe_rues"><i class="fa fa-clipboard-check"></i> ¿Existe en RUES?</label>
                        <select id="edit_existe_rues" name="existe_rues">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="edit_venta_presencial"><i class="fa fa-shopping-bag"></i> ¿Venta Presencial?</label>
                        <select id="edit_venta_presencial" name="venta_presencial">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group-tienda">
                        <label for="edit_venta_online"><i class="fa fa-globe"></i> ¿Venta Online?</label>
                        <select id="edit_venta_online" name="venta_online">
                            <option value="">-- Seleccione --</option>
                            <option value="SI">Sí</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-tienda">
                        <label for="edit_nombre_plataforma_ecommerce"><i class="fa fa-shopping-cart"></i> Plataforma E-commerce</label>
                        <input type="text" id="edit_nombre_plataforma_ecommerce" name="nombre_plataforma_ecommerce" placeholder="Ej: Shopify, WooCommerce...">
                    </div>
                    <div class="form-group-tienda">
                        <label for="edit_nombre_sistema_contable"><i class="fa fa-calculator"></i> Sistema Contable</label>
                        <input type="text" id="edit_nombre_sistema_contable" name="nombre_sistema_contable" placeholder="Ej: Siigo, World Office, Alegra...">
                    </div>
                </div>

                <div class="form-group-tienda">
                    <label for="edit_imagen_tienda"><i class="fa fa-image"></i> Imagen / Logo (dejar vacío para mantener)</label>
                    <input type="file" id="edit_imagen_tienda" name="imagen_tienda" accept="image/*">
                    <img id="preview_img_tienda_edit" src="" class="preview-img-tienda" alt="Vista previa">
                </div>
                
                <!-- SECCIÓN: Documentación Legal -->
                <div class="form-section-title"><i class="fa fa-folder-open"></i> Documentación Legal</div>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-bottom: 1rem;">Dejar vacío para mantener los documentos actuales</p>
                
                <div class="form-group-tienda">
                    <label for="edit_rut_tienda"><i class="fa fa-file-pdf"></i> RUT de la Tienda</label>
                    <input type="file" id="edit_rut_tienda" name="url_documentacion_rut_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_rut_tienda" class="file-preview-container"></div>
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_camaracomercio_tienda"><i class="fa fa-file-pdf"></i> Cámara de Comercio</label>
                    <input type="file" id="edit_camaracomercio_tienda" name="url_documentacion_camaracomercio_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_camaracomercio_tienda" class="file-preview-container"></div>
                </div>
<!--
                <div class="form-group-tienda">
                    <label for="edit_contratofirma_tienda"><i class="fa fa-file-signature"></i> Contrato Firmado</label>
                    <input type="file" id="edit_contratofirma_tienda" name="url_documentacion_contratofirma_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_contratofirma_tienda" class="file-preview-container"></div>
                </div>
                -->
                <div class="form-group-tienda">
                    <label for="edit_extra1_tienda"><i class="fa fa-file-alt"></i> Documentación Extra (Opcional)</label>
                    <input type="file" id="edit_extra1_tienda" name="url_documentacion_extra1_tienda" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="edit_preview_extra1_tienda" class="file-preview-container"></div>
                </div>
                
                <!-- SECCIÓN: Imágenes del Establecimiento -->
                <div class="form-section-title"><i class="fa fa-camera"></i> Imágenes del Establecimiento</div>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-bottom: 1rem;">Dejar vacío para mantener las imágenes actuales</p>
                
                <div class="form-group-tienda">
                    <label for="edit_img_fachada_tienda"><i class="fa fa-store-alt"></i> Imagen de la Fachada</label>
                    <input type="file" id="edit_img_fachada_tienda" name="url_img_fachada_tienda" accept="image/*">
                    <img id="edit_preview_img_fachada" src="" class="preview-img-tienda" alt="Vista previa fachada">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_interna_tienda"><i class="fa fa-door-open"></i> Imagen Interna de la Tienda</label>
                    <input type="file" id="edit_img_interna_tienda" name="url_img_interna_tienda" accept="image/*">
                    <img id="edit_preview_img_interna" src="" class="preview-img-tienda" alt="Vista previa interna">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_selfieadmin_tienda"><i class="fa fa-user-circle"></i> Selfie del Administrador en la Tienda</label>
                    <input type="file" id="edit_img_selfieadmin_tienda" name="url_img_selfieadmin_tienda" accept="image/*">
                    <img id="edit_preview_img_selfieadmin" src="" class="preview-img-tienda" alt="Vista previa selfie">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_img_otraopcional_tienda"><i class="fa fa-image"></i> Otra Imagen (Opcional)</label>
                    <input type="file" id="edit_img_otraopcional_tienda" name="url_img_otraopcional_tienda" accept="image/*">
                    <img id="edit_preview_img_otraopcional" src="" class="preview-img-tienda" alt="Vista previa opcional">
                </div>
                
                <div class="form-group-tienda">
                    <label for="edit_cod_estado"><i class="fa fa-toggle-on"></i> Estado</label>
                    <select id="edit_cod_estado" name="cod_estado">
                        <option value="1">Activa</option>
                        <option value="0">Inactiva</option>
                    </select>
                </div>
            </div>
            <div class="modal-tienda-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalEditarTienda()">Cancelar</button>
                <button type="submit" class="btn-modal btn-modal-primary" id="btnActualizar">
                    <i class="fa fa-save"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Notificación -->
<div id="modalNotificacion" class="modal-notificacion">
    <div class="modal-notificacion-content">
        <div class="modal-notificacion-header">
            <div id="notifIcon" class="modal-notificacion-icon">
                <i id="notifIconSymbol" class="fa fa-check-circle"></i>
            </div>
        </div>
        <div class="modal-notificacion-body">
            <h3 id="notifTitle" class="modal-notificacion-title">¡Éxito!</h3>
            <p id="notifMessage" class="modal-notificacion-message">Operación completada correctamente</p>
        </div>
        <div class="modal-notificacion-footer">
            <button id="notifButton" class="btn-notificacion success" onclick="cerrarModalNotificacion()">Aceptar</button>
        </div>
    </div>
</div>

<!-- Modal Confirmación Post-Registro -->
<div class="confirm-modal-overlay" id="modalConfirmacionRegistro">
    <div class="confirm-modal-box">
        <div class="confirm-success-header">
            <div class="confirm-success-icon">
                <i class="fa fa-check"></i>
            </div>
            <h3>¡Tienda Creada Exitosamente!</h3>
            <p>La tienda ha sido registrada correctamente</p>
            <div class="confirm-store-name" id="confirmNombreTienda"></div>
        </div>
        
        <div class="confirm-body">
            <p class="confirm-body-title">¿Qué deseas hacer ahora?</p>
            
            <div class="confirm-actions-grid">
                <!-- Opción: Crear Vendedores -->
                <div class="confirm-action-card vendedores" onclick="irCrearVendedores()">
                    <div class="confirm-action-icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="confirm-action-text">
                        <h4>Crear Vendedores</h4>
                        <p>Agrega vendedores a esta tienda</p>
                    </div>
                    <i class="fa fa-chevron-right confirm-action-arrow"></i>
                </div>
                
                <!-- Opción: Crear Productos -->
                <div class="confirm-action-card productos" onclick="irCrearProductos()">
                    <div class="confirm-action-icon">
                        <i class="fa fa-cube"></i>
                    </div>
                    <div class="confirm-action-text">
                        <h4>Crear Productos</h4>
                        <p>Agrega productos al catálogo de la tienda</p>
                    </div>
                    <i class="fa fa-chevron-right confirm-action-arrow"></i>
                </div>
            </div>
        </div>
        
        <div class="confirm-footer">
            <button class="confirm-skip-btn" onclick="cerrarConfirmacionYRecargar()">
                <i class="fa fa-arrow-right"></i> Finalizar y volver a la lista
            </button>
        </div>
    </div>
</div>

<!-- Modal Registro de Vendedores -->
<div class="reg-modal-overlay" id="modalRegistroVendedor">
    <div class="reg-modal-container">
        <div class="reg-modal-header vendedor-theme">
            <h2><i class="fa fa-user-plus"></i> Registrar Vendedor</h2>
            <button class="modal-close" onclick="cerrarModalVendedor()"><i class="fa fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body">
            <div class="reg-tienda-badge">
                <i class="fa fa-store"></i>
                Tienda: <strong id="vendedorNombreTienda"></strong>
            </div>
            
            <form id="formRegistroVendedor">
                <input type="hidden" id="vendedor_cod_tienda" name="cod_tienda" value="">
                
                <div class="form-group">
                    <label class="form-label">Identificación (Cédula) *</label>
                    <input type="text" class="form-input" name="identificacion_tercero" id="vendedor_identificacion" placeholder="Ej: 1234567890" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombres *</label>
                        <input type="text" class="form-input" name="nombre1_tercero" id="vendedor_nombre" placeholder="Ej: Juan Carlos" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos *</label>
                        <input type="text" class="form-input" name="apellido1_tercero" id="vendedor_apellido" placeholder="Ej: Pérez López" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" class="form-input" name="telefono1_tercero" id="vendedor_telefono" placeholder="Ej: 3001234567" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo *</label>
                        <input type="email" class="form-input" name="correo_tercero" id="vendedor_correo" placeholder="correo@email.com" required>
                    </div>
                </div>
                
                <button type="submit" class="reg-submit-btn vendedor-theme">
                    <i class="fa fa-user-plus"></i> Registrar Vendedor
                </button>
            </form>
            
            <!-- Lista de vendedores registrados -->
            <div class="items-registrados" id="listaVendedoresRegistrados" style="display: none;">
                <div class="items-registrados-title">
                    <i class="fa fa-users"></i> Vendedores Registrados
                    <span class="badge-count" id="contadorVendedores">0</span>
                </div>
                <div id="vendedoresRegistradosList"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer">
            <button class="reg-footer-btn back-btn" onclick="volverAConfirmacion()">
                <i class="fa fa-arrow-left"></i> Volver
            </button>
            <button class="reg-footer-btn finish-btn" onclick="finalizarYRecargar()">
                <i class="fa fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<!-- Modal Registro de Productos -->
<div class="reg-modal-overlay" id="modalRegistroProducto">
    <div class="reg-modal-container">
        <div class="reg-modal-header producto-theme">
            <h2><i class="fa fa-cube"></i> Registrar Producto</h2>
            <button class="modal-close" onclick="cerrarModalProducto()"><i class="fa fa-times"></i></button>
        </div>
        
        <div class="reg-modal-body producto-theme">
            <div class="reg-tienda-badge">
                <i class="fa fa-store"></i>
                Tienda: <strong id="productoNombreTienda"></strong>
            </div>
            
            <form id="formRegistroProducto" enctype="multipart/form-data">
                <input type="hidden" id="producto_cod_tienda" name="cod_tienda" value="">
                <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                <input type="hidden" name="cod_estado" value="1">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Código de Barras *</label>
                        <input type="text" class="form-input" name="cod_producto_barra" id="producto_codigo" placeholder="Ej: 7701234567890" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="cod_categoria" id="producto_categoria">
                            <option value="0">Sin categoría</option>
                            <?php
                            $sql_categorias_modal = "SELECT cod_categoria, nombre_categoria FROM tbl15_categoria WHERE cod_estado = '1' ORDER BY nombre_categoria ASC";
                            $result_categorias_modal = mysqli_query($conectar, $sql_categorias_modal);
                            if ($result_categorias_modal) {
                                while ($cat = mysqli_fetch_assoc($result_categorias_modal)) {
                                    echo '<option value="'.$cat['cod_categoria'].'">'.ucwords(strtolower($cat['nombre_categoria'])).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nombre del Producto *</label>
                    <input type="text" class="form-input" name="nombre_producto" id="producto_nombre" placeholder="Ej: Arroz Diana x 500g" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Precio Compra ($)</label>
                        <input type="text" class="form-input" inputmode="numeric" id="producto_precio_compra" placeholder="$ 0" value="0" oninput="formatearPrecio(this)">
                        <input type="hidden" name="precio_compra_producto" id="precio_compra_producto_hidden" value="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Precio Venta ($) *</label>
                        <input type="text" class="form-input" inputmode="numeric" id="producto_precio_venta" placeholder="$ 0" oninput="formatearPrecio(this)">
                        <input type="hidden" name="precio_venta_producto" id="precio_venta_producto_hidden" value="0">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">IVA (%)</label>
                        <select class="form-select" name="iva_ptj" id="producto_iva">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Imagen</label>
                        <div class="file-input-wrapper" style="padding: 0.75rem;">
                            <input type="file" name="imagen_producto" id="producto_imagen" accept="image/*" onchange="previewImageProducto(this)">
                            <div class="file-input-icon" style="font-size: 1.2rem; margin-bottom: 0.2rem;"><i class="fa fa-camera"></i></div>
                            <div class="file-input-text" style="font-size: 0.75rem;">Foto producto</div>
                        </div>
                    </div>
                </div>

                <img id="preview_producto_img" class="image-preview" alt="Vista previa" style="display:none; max-height:100px; margin-top:0.5rem;">
                
                <div class="form-group">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-input" name="descripcion_producto" id="producto_descripcion" rows="2" placeholder="Descripción del producto (opcional)" style="resize: vertical; min-height: 60px;"></textarea>
                </div>
                
                <button type="submit" class="reg-submit-btn producto-theme">
                    <i class="fa fa-cube"></i> Registrar Producto
                </button>
            </form>
            
            <!-- Lista de productos registrados -->
            <div class="items-registrados" id="listaProductosRegistrados" style="display: none;">
                <div class="items-registrados-title">
                    <i class="fa fa-cubes"></i> Productos Registrados
                    <span class="badge-count" id="contadorProductos">0</span>
                </div>
                <div id="productosRegistradosList"></div>
            </div>
        </div>
        
        <div class="reg-modal-footer">
            <button class="reg-footer-btn back-btn" onclick="volverAConfirmacionDesdeProducto()">
                <i class="fa fa-arrow-left"></i> Volver
            </button>
            <button class="reg-footer-btn finish-btn" onclick="finalizarYRecargar()">
                <i class="fa fa-check"></i> Finalizar
            </button>
        </div>
    </div>
</div>

<script>
// ========== FORMULARIO REGISTRO VENDEDOR ==========
// (Debe ir aquí, DESPUÉS de los modales HTML para que getElementById funcione)
var _formVendedor = document.getElementById('formRegistroVendedor');
if (_formVendedor) { _formVendedor.addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Registrando vendedor...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: 'agregar_vendedor_tienda_asesor_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                var nombreVendedor = document.getElementById('vendedor_nombre').value + ' ' + document.getElementById('vendedor_apellido').value;
                var idVendedor = document.getElementById('vendedor_identificacion').value;
                agregarVendedorALista(nombreVendedor, idVendedor, response.usuario || '');
                
                // Limpiar formulario pero mantener cod_tienda
                var codTienda = document.getElementById('vendedor_cod_tienda').value;
                document.getElementById('formRegistroVendedor').reset();
                document.getElementById('vendedor_cod_tienda').value = codTienda;
                
                Swal.fire({ icon: 'success', title: '¡Vendedor Registrado!', text: 'Credenciales: Usuario: ' + (response.usuario || '') + ' / Contraseña: ' + (response.contrasena_inicial || ''), confirmButtonColor: '#6366f1', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo registrar el vendedor', confirmButtonColor: '#6366f1', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#6366f1', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});
}

// ========== FORMULARIO REGISTRO PRODUCTO ==========
var _formProducto = document.getElementById('formRegistroProducto');
if (_formProducto) { _formProducto.addEventListener('submit', function(e) {
    e.preventDefault();
    // Copiar valores limpios a los hidden fields
    var precioCompra = document.getElementById('producto_precio_compra');
    var precioVenta = document.getElementById('producto_precio_venta');
    if (precioCompra) document.getElementById('precio_compra_producto_hidden').value = precioCompra.value.replace(/[^\d]/g, '') || '0';
    if (precioVenta) document.getElementById('precio_venta_producto_hidden').value = precioVenta.value.replace(/[^\d]/g, '') || '0';
    // Validar precio de venta
    var precioVentaVal = parseInt(document.getElementById('precio_venta_producto_hidden').value) || 0;
    if (precioVentaVal <= 0) {
        Swal.fire({ icon: 'warning', title: 'Precio requerido', text: 'El precio de venta es obligatorio y debe ser mayor a 0.', background: '#1a1f2e', color: 'white', confirmButtonColor: '#f59e0b', customClass: { container: 'swal-high-zindex' } });
        return;
    }
    var formData = new FormData(this);
    
    Swal.fire({ title: 'Registrando producto...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); }, background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
    
    $.ajax({
        url: 'reg_producto_tienda_aliado_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.success) {
                var nombreProducto = document.getElementById('producto_nombre').value;
                var codigoProducto = document.getElementById('producto_codigo').value;
                var precioProducto = document.getElementById('producto_precio_venta').value;
                agregarProductoALista(nombreProducto, codigoProducto, precioProducto);
                
                // Limpiar formulario pero mantener cod_tienda y cod_administrador
                var codTienda = document.getElementById('producto_cod_tienda').value;
                document.getElementById('formRegistroProducto').reset();
                document.getElementById('producto_cod_tienda').value = codTienda;
                var previewImg = document.getElementById('preview_producto_img');
                if (previewImg) { previewImg.style.display = 'none'; previewImg.src = ''; }
                
                Swal.fire({ icon: 'success', title: '¡Producto Registrado!', text: 'El producto fue creado correctamente.', confirmButtonColor: '#f59e0b', background: '#1a1f2e', color: 'white', timer: 2500, timerProgressBar: true, customClass: { container: 'swal-high-zindex' } });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'No se pudo registrar el producto', confirmButtonColor: '#f59e0b', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire({ icon: 'error', title: 'Error de conexión', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#f59e0b', background: '#1a1f2e', color: 'white', customClass: { container: 'swal-high-zindex' } });
        }
    });
});
}

// Cerrar modales al hacer clic fuera
var _modalConfirmacion = document.getElementById('modalConfirmacionRegistro');
var _modalVendedor = document.getElementById('modalRegistroVendedor');
var _modalProducto = document.getElementById('modalRegistroProducto');
if (_modalConfirmacion) { _modalConfirmacion.addEventListener('click', function(e) { if (e.target === this) { cerrarConfirmacionYRecargar(); } }); }
if (_modalVendedor) { _modalVendedor.addEventListener('click', function(e) { if (e.target === this) { cerrarModalVendedor(); } }); }
if (_modalProducto) { _modalProducto.addEventListener('click', function(e) { if (e.target === this) { cerrarModalProducto(); } }); }
</script>

<!-- Botón flotante de notificaciones -->
<button class="notification-bell-movil" id="notificationBellMovil" onclick="toggleNotificationPanelMovil()">
    <i class="fa-solid fa-bell"></i>
    <span class="notification-badge-movil" id="notificationBadgeMovil" style="display: none;">0</span>
</button>

<!-- Panel de notificaciones -->
<div class="notification-panel-movil" id="notificationPanelMovil">
    <div class="notification-header-movil">
        <h4><i class="fa-solid fa-bell"></i> Notificaciones</h4>
        <div class="notification-header-actions-movil">
            <button onclick="marcarTodasLeidasMovil()" title="Marcar todas como leídas">
                <i class="fa-solid fa-check-double"></i> Leer todas
            </button>
            <button onclick="toggleNotificationPanelMovil()" title="Cerrar">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </div>
    <div class="notification-list-movil" id="notificationListMovil">
        <div class="notification-empty-movil">
            <i class="fa-solid fa-bell-slash"></i>
            <p>No hay notificaciones pendientes</p>
        </div>
    </div>
</div>

<script>
// ====================== SISTEMA DE NOTIFICACIONES MÓVIL ======================
var notificationCheckIntervalMovil = null;

// Inicializar sistema de notificaciones
$(document).ready(function() {
    cargarNotificacionesMovil();
    notificationCheckIntervalMovil = setInterval(cargarNotificacionesMovil, 30000);
});

function cargarNotificacionesMovil() {
    $.ajax({
        url: '../admin/obtener_notificaciones_ajax.php', type: 'GET', dataType: 'json',
        success: function(response) {
            if (response.success) {
                actualizarUINotificacionesMovil(response.notificaciones, response.count);
            }
        }, error: function() { console.log('Error al cargar notificaciones'); }
    });
}

function actualizarUINotificacionesMovil(notificaciones, count) {
    var $badge = $('#notificationBadgeMovil');
    var $bell = $('#notificationBellMovil');
    var $list = $('#notificationListMovil');
    
    if (count > 0) {
        $badge.text(count > 99 ? '99+' : count).show();
        $bell.addClass('has-notifications');
    } else {
        $badge.hide();
        $bell.removeClass('has-notifications');
    }
    
    if (notificaciones.length > 0) {
        var html = '';
        notificaciones.forEach(function(notif) {
            var iconClass = 'type-' + (notif.tipo || 1);
            var iconSymbol = getNotificationIconMovil(notif.tipo);
            html += '<div class="notification-item-movil" onclick="marcarNotificacionLeidaMovil(' + notif.id + ', this)">';
            html += '  <div class="notification-icon-movil ' + iconClass + '"><i class="fa-solid ' + iconSymbol + '"></i></div>';
            html += '  <div class="notification-content-movil">';
            html += '    <div class="notification-title-movil">' + escapeHtmlMovil(notif.titulo) + '</div>';
            html += '    <div class="notification-desc-movil">' + escapeHtmlMovil(notif.descripcion) + '</div>';
            html += '    <div class="notification-time-movil"><i class="fa-regular fa-clock"></i> ' + notif.fecha_corta + '</div>';
            html += '  </div>';
            html += '</div>';
        });
        $list.html(html);
    } else {
        $list.html('<div class="notification-empty-movil"><i class="fa-solid fa-bell-slash"></i><p>No hay notificaciones pendientes</p></div>');
    }
}

function getNotificationIconMovil(tipo) {
    switch(parseInt(tipo)) {
        case 1: return 'fa-signature';
        case 2: return 'fa-triangle-exclamation';
        case 3: return 'fa-circle-info';
        default: return 'fa-bell';
    }
}

function toggleNotificationPanelMovil() { $('#notificationPanelMovil').toggleClass('show'); }

$(document).on('click', function(e) { if (!$(e.target).closest('#notificationPanelMovil, #notificationBellMovil').length) { $('#notificationPanelMovil').removeClass('show'); } });

function marcarNotificacionLeidaMovil(codNotificacion, element) {
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { cod_notificacion: codNotificacion }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                $(element).fadeOut(300, function() {
                    $(this).remove();
                    cargarNotificacionesMovil();
                });
            }
        }
    });
}

function marcarTodasLeidasMovil() {
    Swal.fire({
        title: '¿Marcar todas como leídas?',
        text: 'Se marcarán todas las notificaciones pendientes como leídas',
        icon: 'question', showCancelButton: true, confirmButtonColor: '#4169e1', cancelButtonColor: '#6c757d', confirmButtonText: 'Sí, marcar todas', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../admin/marcar_notificacion_leida_ajax.php', type: 'POST', data: { marcar_todas: 'si' }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarNotificacionesMovil();
                        Swal.fire({ icon: 'success', title: '¡Listo!', text: 'Todas las notificaciones han sido marcadas como leídas', timer: 2000, showConfirmButton: false, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}

function escapeHtmlMovil(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}
</script>

<!-- ===================================================== -->
<!-- MODALES PARA LISTAS (VENDEDORES / PRODUCTOS)        -->
<!-- ===================================================== -->

<!-- Modal para ver Lista de Vendedores -->
<div id="modalListVendedores" class="modal-tienda">
    <div class="modal-tienda-content">
        <div class="modal-tienda-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <h3><i class="fas fa-users"></i> Vendedores: <span id="vendedor_store_name"></span></h3>
            <button class="modal-close" onclick="cerrarModalListVendedores()">&times;</button>
        </div>
        <div class="modal-tienda-body">
            <div id="vendedores_list_container" class="modal-list-container">
                <!-- Se llenará vía AJAX -->
                <div class="empty-state">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Cargando vendedores...</p>
                </div>
            </div>
        </div>
        <div class="modal-tienda-footer">
            <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalListVendedores()" style="flex: 1;">Cerrar</button>
        </div>
    </div>
</div>

<!-- Modal para ver Lista de Productos -->
<div id="modalListProductos" class="modal-tienda">
    <div class="modal-tienda-content">
        <div class="modal-tienda-header" style="background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);">
            <h3><i class="fas fa-boxes"></i> Productos: <span id="producto_store_name"></span></h3>
            <button class="modal-close" onclick="cerrarModalListProductos()">&times;</button>
        </div>
        <div class="modal-tienda-body">
            <div id="productos_list_container" class="modal-list-container">
                <!-- Se llenará vía AJAX -->
                <div class="empty-state">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Cargando productos...</p>
                </div>
            </div>
        </div>
        <div class="modal-tienda-footer">
            <button type="button" class="btn-modal btn-modal-secondary" onclick="cerrarModalListProductos()" style="flex: 1;">Cerrar</button>
        </div>
    </div>
</div>

<style>
/* Estilos para listas en modales */
.modal-list-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    padding-bottom: 0.5rem;
}

.modal-list-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.2);
    border-radius: 12px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.modal-list-item:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(0, 212, 255, 0.4);
}

.item-img-container {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 2px solid rgba(0, 212, 255, 0.3);
    background: #1a1d3a;
}

.item-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-main-text {
    display: block;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.item-sub-text {
    display: block;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.75rem;
    margin-top: 1px;
}

.item-badge {
    background: rgba(0, 212, 255, 0.1);
    color: #00d4ff;
    padding: 0.2rem 0.5rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
}
</style>

<script>
/**
 * Funciones para el listado de Vendedores y Productos de una tienda
 */
function verVendedoresTienda(codTienda, nombreTienda) {
    var storeNameEl = document.getElementById('vendedor_store_name');
    var modalEl = document.getElementById('modalListVendedores');
    var container = document.getElementById('vendedores_list_container');
    
    if (storeNameEl) storeNameEl.textContent = nombreTienda;
    if (modalEl) modalEl.style.display = 'block';
    if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Cargando vendedores...</p></div>';
    
    $.ajax({
        url: 'obtener_vendedores_tienda_ajax.php', type: 'GET', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                if (response.vendedores && response.vendedores.length > 0) {
                    var html = '';
                    response.vendedores.forEach(function(v) {
                        var nombre = (v.nombres_apellidos_tercero || '').toLowerCase().replace(/\b\w/g, function(l) { return l.toUpperCase(); });
                        var tipoVend = v.nombre_tipo_vendedor ? v.nombre_tipo_vendedor : 'NORMAL';
                        html += '<div class="modal-list-item">';
                        html += '    <div class="item-img-container">';
                        if (v.url_img_foto_prof_min) {
                            html += '        <img src="' + v.url_img_foto_prof_min + '" class="item-img" alt="' + nombre + '">';
                        } else {
                            html += '        <div class="item-placeholder"><i class="fas fa-user"></i></div>';
                        }
                        html += '    </div>';
                        html += '    <div class="item-details">';
                        html += '        <span class="item-main-text">' + nombre + '</span>';
                        html += '        <span class="item-sub-text"><i class="fas fa-at"></i> Usuario: ' + (v.cuenta || v.usuario || '') + '</span>';
                        if (v.telefono1_tercero) {
                            html += '        <span class="item-sub-text"><i class="fas fa-phone"></i> ' + v.telefono1_tercero + '</span>';
                        }
                        html += '        <span class="item-sub-text" style="color:#8b5cf6; font-weight:bold; margin-top:3px;"><i class="fa-solid fa-user-tag"></i> ' + tipoVend + '</span>';
                        html += '    </div>';
                        html += '    <div><span class="item-badge">Activo</span></div>';
                        html += '</div>';
                    });
                    if (container) container.innerHTML = html;
                } else {
                    if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-user-slash"></i><p>No hay vendedores registrados.</p></div>';
                }
            } else {
                if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>' + (response.message || 'Error desconocido') + '</p></div>';
            }
        }, error: function() { if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-wifi"></i><p>Error de conexión</p></div>'; }
    });
}

function cerrarModalListVendedores() {
    var modal = document.getElementById('modalListVendedores');
    if (modal) modal.style.display = 'none';
}

function verProductosTienda(codTienda, nombreTienda) {
    var storeNameEl = document.getElementById('producto_store_name');
    var modalEl = document.getElementById('modalListProductos');
    var container = document.getElementById('productos_list_container');
    
    if (storeNameEl) storeNameEl.textContent = nombreTienda;
    if (modalEl) modalEl.style.display = 'block';
    if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Cargando productos...</p></div>';
    
    $.ajax({
        url: 'obtener_productos_tienda_ajax.php', type: 'GET', data: { cod_tienda: codTienda }, dataType: 'json',
        success: function(response) {
            if (response.success) {
                if (response.productos && response.productos.length > 0) {
                    var html = '';
                    response.productos.forEach(function(p) {
                        html += '<div class="modal-list-item">';
                        html += '    <div class="item-img-container" style="border-radius: 8px;">';
                        if (p.url_img_min_producto) { html += '        <img src="' + p.url_img_min_producto + '" class="item-img" alt="' + p.nombre_producto + '">'; } else { html += '        <div class="item-placeholder" style="border-radius: 8px;"><i class="fas fa-box"></i></div>'; }
                        html += '    </div>';
                        html += '    <div class="item-details">';
                        html += '        <span class="item-main-text">' + p.nombre_producto + '</span>';
                        html += '        <span class="item-sub-text"><i class="fas fa-barcode"></i> Ref: ' + p.cod_producto_barra + '</span>';
                        html += '    </div>';
                        html += '    <div><span class="item-badge">' + p.precio_formateado + '</span></div>';
                        html += '</div>';
                    });
                    if (container) container.innerHTML = html;
                } else {
                    if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-archive"></i><p>No hay productos disponibles.</p></div>';
                }
            } else {
                if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>' + (response.message || 'Error desconocido') + '</p></div>';
            }
        }, error: function() { if (container) container.innerHTML = '<div class="empty-state"><i class="fas fa-wifi"></i><p>Error de conexión</p></div>'; }
    });
}

function cerrarModalListProductos() {
    var modal = document.getElementById('modalListProductos');
    if (modal) modal.style.display = 'none';
}

// Consolidar el cierre de modales al hacer clic fuera
$(window).on('click', function(event) {
    if (event.target.id === 'modalNuevaTienda') cerrarModalTienda();
    if (event.target.id === 'modalEditarTienda') cerrarModalEditarTienda();
    if (event.target.id === 'modalListVendedores') cerrarModalListVendedores();
    if (event.target.id === 'modalListProductos') cerrarModalListProductos();
});
</script>

</body>
</html>
