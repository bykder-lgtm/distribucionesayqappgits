<?php
header('Content-Type: text/html; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cod_administrador  = $_SESSION['cod_administrador'];
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_habilitar_tercero_por_usuario_global = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];

$pagina_local = "";
$pagina_complt = $_SERVER['PHP_SELF'];
$fragm = explode("/", $pagina_complt);
$ultimo = end($fragm);
$total_elementos = count($fragm) - 1;
$concatenador = '';
foreach ($fragm as $key => $element) { if ($key <> $total_elementos) { $concatenador .= $element."/"; } }

$pagina = $concatenador."lista_aliado_lider_diseno_vertical.php";

if (($cod_estado_habilitar_tercero_por_usuario_global == '1')) {
    if ($cod_seguridad == '1') {
        $condicional_consulta_tercero = '';
        $condicional_consulta_tercero_rel = '';
        $condicional_consulta_cuenta_cobrar = '';
    } else {
        $condicional_consulta_tercero = " AND (tbl15_tercero.cod_administrador = '$cod_administrador')";
        $condicional_consulta_tercero_rel = " AND (tbl15_tercero_rel.cod_administrador = '$cod_administrador')";
        $condicional_consulta_cuenta_cobrar = " AND (tbl15_info_factura_venta.cod_administrador = '$cod_administrador')";
    }
} else { 
    $condicional_consulta_tercero = ''; 
    $condicional_consulta_tercero_rel = '';
    $condicional_consulta_cuenta_cobrar = '';
}

$cuenta_actual = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);

$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if($action == 'ajax') {
    $busqueda_ajax = isset($_REQUEST['busqueda_ajax']) ? mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES))) : '';
    $buscar_por = isset($_POST['buscar_por']) ? mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES))) : 'nombres_apellidos_tercero';
    $numero_registro_por_pagina = isset($_POST['numero_registro_por_pagina']) ? intval($_REQUEST['numero_registro_por_pagina']) : '10000000';

    $cod_administrador                 = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_administrador'], ENT_QUOTES)));
    $cod_seguridad                     = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_seguridad'], ENT_QUOTES)));
    $tabla                             = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
    $nombre_estado_factura             = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['nombre_estado_factura'], ENT_QUOTES)));
    $pagina                            = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['pagina'], ENT_QUOTES)));
}

if($busqueda_ajax <> NULL) {
    $aColumns = array('nombres_apellidos_tercero', 'identificacion_tercero');
}

if($action == 'ajax') {
    $sTable = "tbl15_administrador";
    $sWhere = " WHERE (cod_lider = '$cod_administrador')";
    if ($busqueda_ajax != "") {
        $sWhere = " WHERE (cod_lider = '$cod_administrador') AND ( ";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) { $sWhere .= $aColumns[$i]." LIKE '%".$busqueda_ajax."%' OR "; }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    $sWhere.=" ORDER BY cod_administrador DESC";

    include_once('../admin/paginacion_ajax_buscador_sistecredito.php');
    $page                              = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page                          = 10;
    $adjacents                         = 4;
    $registro_inicio                   = ($page - 1) * $per_page;
    
    $sql_cantidad_registros            = "SELECT count(*) AS cantidad_registros FROM $sTable $sWhere";
    $consulta_cantidad_registros       = mysqli_query($conectar, $sql_cantidad_registros) or die(mysqli_error($conectar));
    $datos_cantidad_registros          = mysqli_fetch_array($consulta_cantidad_registros);
    $cantidad_registros                = $datos_cantidad_registros['cantidad_registros'];
    $total_pages                       = ceil($cantidad_registros/$per_page);
    $reload                            = '../admin/lista_aliado_lider_diseno_vertical.php';


    if ($cantidad_registros>0) { 
?>
<!-- Contenedor de tarjetas de aliados -->
<div class="aliados-grid">
<?php
    $sql_administradores = "SELECT * FROM $sTable $sWhere LIMIT $registro_inicio, $numero_registro_por_pagina";
    $consulta_administradores = mysqli_query($conectar, $sql_administradores) or die(mysqli_error($conectar));
    $contador_aliado = 0;
    while ($datos_admin = mysqli_fetch_assoc($consulta_administradores)) {
        $contador_aliado++;
        $cod_administrador_item             = $datos_admin['cod_administrador'];
        $cedula                             = $datos_admin['cedula'];
        $nombres                            = $datos_admin['nombres'];
        $apellidos                          = $datos_admin['apellidos'];
        $cuenta                             = $datos_admin['cuenta'];
        $correo                             = $datos_admin['correo'];
        $telefono                           = $datos_admin['telefono'];
        $cod_seguridad_admin                = $datos_admin['cod_seguridad'];
        $cod_estado_activacion_usuario      = $datos_admin['cod_estado_activacion_usuario'];
        $comision_ptj                       = $datos_admin['comision_ptj'];
        $cod_aliado_estrategico             = $cod_administrador_item;
        
        // Obtener estado de activación
        $sql_estado = "SELECT * FROM tbl15_estado_activacion_usuario WHERE (codigo_estado_activacion_usuario = '$cod_estado_activacion_usuario')";
        $consulta_estado = mysqli_query($conectar, $sql_estado) or die(mysqli_error($conectar));
        $datos_estado = mysqli_fetch_assoc($consulta_estado);
        $nombre_estado_activacion_usuario = isset($datos_estado['nombre_estado_activacion_usuario']) ? $datos_estado['nombre_estado_activacion_usuario'] : 'Desconocido';
        
        // Estado de activación
        $estado_clase = ($cod_estado_activacion_usuario == 1) ? 'activo' : 'inactivo';
        $estado_texto = ($cod_estado_activacion_usuario == 1) ? 'Activo' : 'Inactivo';
        
        // Obtener tiendas del aliado
        $sql_tiendas = "SELECT t.*, 
        (SELECT COUNT(*) FROM tbl15_producto WHERE cod_tienda = t.cod_tienda) as total_productos,
        (SELECT COUNT(*) FROM tbl15_producto WHERE cod_tienda = t.cod_tienda AND nombre_estado = 'HABILITADO') as productos_activos
        FROM tbl15_tienda t 
        WHERE t.cod_aliado_estrategico = '$cod_aliado_estrategico' 
        ORDER BY t.nombre_tienda ASC";
        $consulta_tiendas = mysqli_query($conectar, $sql_tiendas) or die(mysqli_error($conectar));
        $num_tiendas = mysqli_num_rows($consulta_tiendas);
?>
    <!-- Tarjeta de Aliado -->
    <div class="aliado-card" id="aliado-<?php echo $cod_administrador_item; ?>">
        <div class="aliado-card-header">
            <div class="aliado-avatar">
                <i class="fa fa-user"></i>
            </div>
            <div class="aliado-info-header">
                <h3 class="aliado-nombre"><?php echo ucwords(strtolower($nombres . ' ' . $apellidos)); ?></h3>
                <p class="aliado-cedula"><i class="fa fa-id-card"></i> <?php echo $cedula; ?></p>
            </div>
            <span class="aliado-estado <?php echo $estado_clase; ?>"><?php echo $estado_texto; ?></span>
        </div>
        
        <div class="aliado-card-body">
            <div class="aliado-detalles">
                <?php if (!empty($telefono)) { ?>
                <div class="aliado-detalle-item">
                    <i class="fa fa-phone"></i>
                    <span><?php echo $telefono; ?></span>
                </div>
                <?php } ?>
                <?php if (!empty($correo)) { ?>
                <div class="aliado-detalle-item">
                    <i class="fa fa-envelope"></i>
                    <span><?php echo $correo; ?></span>
                </div>
                <?php } ?>
                <?php if (!empty($cuenta)) { ?>
                <div class="aliado-detalle-item">
                    <i class="fa fa-user-circle"></i>
                    <span><?php echo $cuenta; ?></span>
                </div>
                <?php } ?>
            </div>
            
            <!-- Sección de Tiendas -->
            <div class="tiendas-section">
                <div class="tiendas-header" onclick="toggleTiendas(<?php echo $cod_administrador_item; ?>)">
                    <div class="tiendas-titulo">
                        <i class="fa fa-store"></i>
                        <span>Tiendas</span>
                        <span class="tiendas-badge"><?php echo $num_tiendas; ?></span>
                    </div>
                    <i class="fa fa-chevron-down tiendas-toggle-icon" id="toggle-icon-<?php echo $cod_administrador_item; ?>"></i>
                </div>
                
                <div class="tiendas-lista" id="tiendas-lista-<?php echo $cod_administrador_item; ?>" style="display: none;">
                    <?php 
                    if ($num_tiendas > 0) {
                        while ($tienda = mysqli_fetch_assoc($consulta_tiendas)) {
                            $cod_tienda_item = $tienda['cod_tienda'];
                            $nombre_tienda = $tienda['nombre_tienda'];
                            $direccion_tienda = isset($tienda['direccion_tienda']) ? $tienda['direccion_tienda'] : '';
                            $url_img_tienda = isset($tienda['url_img_min_tienda']) ? $tienda['url_img_min_tienda'] : '';
                            $total_productos = $tienda['total_productos'];
                            $productos_activos = $tienda['productos_activos'];
                    ?>
                    <div class="tienda-item" id="tienda-item-<?php echo $cod_tienda_item; ?>">
                        <div class="tienda-item-header" onclick="toggleProductos(<?php echo $cod_tienda_item; ?>)">
                            <div class="tienda-icono">
                                <?php if (!empty($url_img_tienda) && file_exists($url_img_tienda)) { ?>
                                    <img src="<?php echo $url_img_tienda; ?>" alt="<?php echo $nombre_tienda; ?>">
                                <?php } else { ?>
                                    <i class="fa fa-store"></i>
                                <?php } ?>
                            </div>
                            <div class="tienda-item-info">
                                <h4 class="tienda-item-nombre"><?php echo ucwords(strtolower($nombre_tienda)); ?></h4>
                                <?php if (!empty($direccion_tienda)) { ?>
                                <p class="tienda-item-direccion"><i class="fa fa-map-marker"></i> <?php echo $direccion_tienda; ?></p>
                                <?php } ?>
                                <div class="tienda-stats-mini">
                                    <span class="stat-mini"><i class="fa fa-box"></i> <?php echo $total_productos; ?> productos</span>
                                    <span class="stat-mini activos"><i class="fa fa-check-circle"></i> <?php echo $productos_activos; ?> activos</span>
                                </div>
                            </div>
                            <i class="fa fa-chevron-right tienda-toggle-icon" id="tienda-toggle-<?php echo $cod_tienda_item; ?>"></i>
                        </div>
                        
                        <!-- Contenedor de productos (se carga dinámicamente) -->
                        <div class="productos-container" id="productos-container-<?php echo $cod_tienda_item; ?>" style="display: none;">
                            <div class="productos-loading" id="productos-loading-<?php echo $cod_tienda_item; ?>">
                                <i class="fa fa-spinner fa-spin"></i> Cargando productos...
                            </div>
                            <div class="productos-grid" id="productos-grid-<?php echo $cod_tienda_item; ?>"></div>
                        </div>
                    </div>
                    <?php 
                        }
                    } else { 
                    ?>
                    <div class="empty-tiendas">
                        <i class="fa fa-store-slash"></i>
                        <p>No hay tiendas asociadas</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="aliado-card-footer">
            <span class="aliado-id">ID: <?php echo $cod_administrador_item; ?></span>
            <?php if ($comision_ptj > 0) { ?>
            <span class="aliado-comision"><i class="fa fa-percent"></i> Comisión: <?php echo $comision_ptj; ?>%</span>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>

<!-- JavaScript para manejar los acordeones y carga de productos -->
<script>
// Función para alternar la visualización de tiendas
function toggleTiendas(codAliado) {
    var lista = document.getElementById('tiendas-lista-' + codAliado);
    var icon = document.getElementById('toggle-icon-' + codAliado);
    
    if (lista.style.display === 'none') {
        lista.style.display = 'block';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        lista.classList.add('slide-in');
    } else {
        lista.style.display = 'none';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
}

// Función para alternar la visualización de productos
function toggleProductos(codTienda) {
    var container = document.getElementById('productos-container-' + codTienda);
    var icon = document.getElementById('tienda-toggle-' + codTienda);
    var grid = document.getElementById('productos-grid-' + codTienda);
    var loading = document.getElementById('productos-loading-' + codTienda);
    
    if (container.style.display === 'none') {
        container.style.display = 'block';
        icon.classList.remove('fa-chevron-right');
        icon.classList.add('fa-chevron-down');
        
        // Cargar productos solo si el grid está vacío
        if (grid.innerHTML.trim() === '') {
            loading.style.display = 'flex';
            cargarProductos(codTienda);
        }
    } else {
        container.style.display = 'none';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-right');
    }
}

// Función para cargar productos vía AJAX
function cargarProductos(codTienda) {
    var grid = document.getElementById('productos-grid-' + codTienda);
    var loading = document.getElementById('productos-loading-' + codTienda);
    
    $.ajax({
        type: 'POST',
        url: '../admin/obtener_productos_por_tienda_ajax.php',
        data: { cod_tienda: codTienda },
        dataType: 'json',
        success: function(response) {
            loading.style.display = 'none';
            
            if (response.success && response.productos.length > 0) {
                var html = '';
                response.productos.forEach(function(producto) {
                    var stockClass = 'stock-disponible';
                    var stockIcon = 'fa-check-circle';
                    if (parseInt(producto.stock) <= 0) {
                        stockClass = 'stock-agotado';
                        stockIcon = 'fa-times-circle';
                    } else if (parseInt(producto.stock) < 5) {
                        stockClass = 'stock-bajo';
                        stockIcon = 'fa-exclamation-circle';
                    }
                    
                    var estadoClass = producto.estado === 'HABILITADO' ? 'estado-activo' : 'estado-inactivo';
                    
                    html += '<div class="producto-card">';
                    html += '  <div class="producto-imagen">';
                    html += '    <img src="' + producto.imagen + '" alt="' + producto.nombre_producto + '" onerror="this.src=\'../imagenes/no-image.png\'">';
                    html += '  </div>';
                    html += '  <div class="producto-info">';
                    html += '    <h5 class="producto-nombre">' + producto.nombre_producto + '</h5>';
                    if (producto.categoria) {
                        html += '    <span class="producto-categoria"><i class="fa fa-tag"></i> ' + producto.categoria + '</span>';
                    }
                    html += '    <div class="producto-precios">';
                    html += '      <div class="precio-contado"><span class="precio-label">Contado</span><span class="precio-valor">$' + producto.precio_venta + '</span></div>';
                    html += '      <div class="precio-credito"><span class="precio-label">Crédito</span><span class="precio-valor">$' + producto.precio_credito + '</span></div>';
                    html += '    </div>';
                    html += '    <div class="producto-footer">';
                    html += '      <span class="producto-stock ' + stockClass + '"><i class="fa ' + stockIcon + '"></i> ' + producto.stock + ' und</span>';
                    html += '      <span class="producto-estado ' + estadoClass + '">' + producto.estado + '</span>';
                    html += '    </div>';
                    html += '  </div>';
                    html += '</div>';
                });
                grid.innerHTML = html;
            } else {
                grid.innerHTML = '<div class="empty-productos"><i class="fa fa-box-open"></i><p>No hay productos en esta tienda</p></div>';
            }
        },
        error: function() {
            loading.style.display = 'none';
            grid.innerHTML = '<div class="error-productos"><i class="fa fa-exclamation-triangle"></i><p>Error al cargar productos</p></div>';
        }
    });
}
</script>
<?php echo paginador_ajax($reload, $page, $total_pages, $adjacents);
    } else { ?> 
    <div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aviso!</strong> No hay datos para mostrar</div>
<?php    
    }
}
?>


<style>
/* Estilos para el botón Ver Factura PDF */
#btnVerFacturaPdfExito:hover {
    background: #c53030 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(229, 62, 62, 0.4) !important;
}

#btnVerFacturaPdfExito:active {
    transform: translateY(0);
}

/* Estilos para los switches llamativos de diligenciamiento */
.switch-container input[type="checkbox"]:checked + .switch-slider {
    background: linear-gradient(135deg, #48bb78, #38a169) !important;
    box-shadow: 0 4px 8px rgba(72, 187, 120, 0.4) !important;
}

.switch-container input[type="checkbox"]:checked + .switch-slider span {
    transform: translateX(30px);
    background-color: #ffffff;
}

.switch-container .switch-slider:hover {
    box-shadow: 0 6px 12px rgba(255, 107, 107, 0.4);
    transform: translateY(-1px);
}

.switch-container input[type="checkbox"]:checked + .switch-slider:hover {
    box-shadow: 0 6px 12px rgba(72, 187, 120, 0.5);
}

.switch-container .switch-slider span {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.switch-container input[type="checkbox"]:focus + .switch-slider {
    outline: 2px solid #4299e1;
    outline-offset: 2px;
}

.estado_en_solicitud {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    color: #4a5568;
    border: 1px solid #cbd5e0;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

.estado_en_solicitud::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_en_proceso {
    background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
    color: #c53030;
    border: 1px solid #fc8181;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(197, 48, 48, 0.2);
    animation: pulse 2s infinite;
}

.estado_en_proceso::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_venta_aprobada {
    background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
    color: #276749;
    border: 1px solid #68d391;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(39, 103, 73, 0.2);
}

.estado_venta_aprobada::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_generacion_factura {
    background: linear-gradient(135deg, #fef5e7 0%, #fbd38d 100%);
    color: #c05621;
    border: 1px solid #f6ad55;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(192, 86, 33, 0.2);
}

.estado_generacion_factura::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_generacion_pago {
    background: linear-gradient(135deg, #e6fffa 0%, #81e6d9 100%);
    color: #234e52;
    border: 1px solid #4fd1c7;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(35, 78, 82, 0.2);
}

.estado_generacion_pago::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_credito_exitoso {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    border: 1px solid #38a169;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 3px 6px rgba(72, 187, 120, 0.4);
    animation: glow 2s ease-in-out infinite alternate;
}

.estado_credito_exitoso::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_abandonado {
    background: linear-gradient(135deg, #fed7d7 0%, #f56565 100%);
    color: white;
    border: 1px solid #e53e3e;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(229, 62, 62, 0.3);
    opacity: 0.8;
}

.estado_abandonado::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_rechazado {
    background: linear-gradient(135deg, #fed7d7 0%, #f56565 100%);
    color: white;
    border: 1px solid #e53e3e;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 4px rgba(229, 62, 62, 0.3);
    opacity: 0.8;
}

.estado_rechazado::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.estado_default {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
    color: #2d3748;
    border: 1px solid #a0aec0;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.estado_default::before {
    content: '';
    margin-right: 0.3rem;
    font-size: 0.6rem;
}

.modal-detalle-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0;
    padding: 2rem;
    border: none;
    position: relative;
}
.modal-detalle-header .close {
    color: white;
    opacity: 1;
    text-shadow: none;
    font-size: 2rem;
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    background: none;
    border: none;
    cursor: pointer;
}
.modal-detalle-content {
    border-radius: 10px;
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    overflow: hidden;
}
.detalle-section {
    background: #f7fafc;
    padding: 2rem;
    border-bottom: 1px solid #e2e8f0;
}
.detalle-section * {
    color: #2d3748 !important;
}
.detalle-section i {
    color: #667eea !important;
}
.detalle-info-box {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}
.detalle-info-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

/* Estilos para imágenes obligatorias primarias (cod_estado_obligatorio = "1") - SIMPLE */
.tarjeta-imagen-obligatoria {
    border: 2px solid #dc2626 !important;
    box-shadow: 0 2px 8px rgba(220, 38, 38, 0.15) !important;
    background: linear-gradient(145deg, #ffffff, #fef2f2) !important;
}

.tarjeta-imagen-obligatoria:hover {
    border-color: #b91c1c !important;
}

.label-obligatoria {
    background: #fecaca !important;
    color: #7f1d1d !important;
    padding: 0.4rem 0.8rem !important;
    border-radius: 6px !important;
    font-weight: 700 !important;
    border: 1px solid #dc2626 !important;
}

/* Estilos para imágenes obligatorias secundarias (cod_estado_obligatorio2 = "1") */
.tarjeta-imagen-obligatoria-secundaria {
    border: 2px solid #f56565 !important;
    box-shadow: 0 2px 8px rgba(245, 101, 101, 0.12) !important;
    background: linear-gradient(145deg, #ffffff, #fff5f5) !important;
}

.tarjeta-imagen-obligatoria-secundaria:hover {
    border-color: #e53e3e !important;
}

.label-obligatoria-secundaria {
    background: #fed7d7 !important;
    color: #822727 !important;
    padding: 0.4rem 0.8rem !important;
    border-radius: 6px !important;
    font-weight: 600 !important;
    border: 1px solid #f56565 !important;
}

.label-opcional {
    background: #f7fafc !important;
    color: #4a5568 !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 4px !important;
    padding: 0.2rem 0.4rem !important;
}
.detalle-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #2d3748 !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}
.detalle-label i {
    margin-right: 0.5rem;
    color: #667eea;
}
.detalle-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
}
.detalle-value-large {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
    margin: 0;
}
.btn-detalle-action {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-detalle-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
}
.btn-detalle-action i {
    font-size: 1rem;
}
.section-divider-detalle {
    display: flex;
    align-items: center;
    margin: 1.5rem 0 1rem 0;
}
.section-divider-detalle::before,
.section-divider-detalle::after {
    content: '';
    flex: 1;
    border-bottom: 2px solid #e2e8f0;
}
.section-divider-detalle span {
    padding: 0 1rem;
    color: #667eea;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.estado-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.modal-detalle-wrapper {
    max-height: 90vh;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}
.modal-detalle-wrapper::-webkit-scrollbar {
    width: 8px;
}
.modal-detalle-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.modal-detalle-wrapper::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}
.modal-detalle-wrapper::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
}
@media (max-width: 768px) {
    .modal-detalle-wrapper {
        max-height: 85vh;
    }
    .detalle-info-box {
        padding: 0.75rem;
    }
    .section-divider-detalle {
        margin: 1rem 0 0.5rem 0;
    }
    .detalle-section {
        padding: 1rem;
    }
    .modal-detalle-header {
        padding: 1rem;
    }
    .modal-detalle-header h4 {
        font-size: 1.3rem;
    }
}
@media (max-width: 576px) {
    .modal-lg {
        max-width: 95%;
        margin: 0.5rem auto;
    }
    .modal-detalle-wrapper {
        max-height: 80vh;
    }
    .detalle-value-large {
        font-size: 1.2rem;
    }
    .detalle-value {
        font-size: 0.95rem;
    }
}

/* Estilos para tabla con fondo oscuro homogéneo */
.table.jambo_table tbody tr {
    background-color: #10162D !important;
    transition: background-color 0.2s ease;
}

.table.jambo_table tbody tr:hover {
    background-color: #090C1A !important;
}

.table.jambo_table tbody td {
    background-color: transparent !important;
    color: #ffffff !important;
    border-color: rgba(255, 255, 255, 0.1) !important;
}

/* Estilos para fila de filtros */
.filtros-tabla {
    background-color: #1a2038 !important;
}

.filtros-tabla th {
    padding: 0.5rem !important;
    background-color: #1a2038 !important;
    border-bottom: 2px solid #667eea !important;
}

.filtro-input {
    background-color: #2d3748 !important;
    color: #ffffff !important;
    border: 1px solid #4a5568 !important;
    border-radius: 4px;
    font-size: 1.2rem;
    padding: 0.5rem;
    transition: all 0.3s ease;
}

.filtro-input:focus {
    background-color: #374151 !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
    color: #ffffff !important;
}

.filtro-input::placeholder {
    color: #9ca3af !important;
    opacity: 0.7;
}

/* Estilos para los select del modal de Editar Entidad Crediticia */
#modalEditarEntidadCrediticia #cod_entidad_crediticia,
#modalEditarEntidadCrediticia #cod_tipo_simulacion_credito {
    background-color: white !important;
    color: #2d3748 !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 1.25rem !important;
    font-size: 1.6rem !important;
    height: auto !important;
    min-height: 60px !important;
    line-height: 1.5 !important;
    font-weight: 600 !important;
    width: 100% !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232d3748' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 1rem center !important;
    background-size: 1.5rem !important;
    padding-right: 3rem !important;
}

#modalEditarEntidadCrediticia #cod_entidad_crediticia option,
#modalEditarEntidadCrediticia #cod_tipo_simulacion_credito option {
    background-color: white !important;
    color: #2d3748 !important;
    padding: 1rem !important;
    font-size: 1.6rem !important;
    font-weight: 600 !important;
}

#modalEditarEntidadCrediticia #cod_entidad_crediticia:hover,
#modalEditarEntidadCrediticia #cod_tipo_simulacion_credito:hover {
    border-color: #0E112B !important;
    box-shadow: 0 2px 8px rgba(14, 17, 43, 0.1) !important;
}

#modalEditarEntidadCrediticia #cod_entidad_crediticia:focus,
#modalEditarEntidadCrediticia #cod_tipo_simulacion_credito:focus {
    outline: none !important;
    border-color: #0E112B !important;
    box-shadow: 0 0 0 0.2rem rgba(14, 17, 43, 0.15) !important;
    background-color: white !important;
    color: #2d3748 !important;
}

/* Estilos para los inputs del modal de Editar Entidad Crediticia */
#modalEditarEntidadCrediticia #precio_venta_producto,
#modalEditarEntidadCrediticia #precio_venta_producto_formateado,
#modalEditarEntidadCrediticia #numero_cuotas {
    background-color: white !important;
    color: #2d3748 !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 1.25rem !important;
    font-size: 1.6rem !important;
    font-weight: 600 !important;
    width: 100% !important;
    min-height: 60px !important;
}

#modalEditarEntidadCrediticia #precio_venta_producto:focus,
#modalEditarEntidadCrediticia #precio_venta_producto_formateado:focus,
#modalEditarEntidadCrediticia #numero_cuotas:focus {
    outline: none !important;
    border-color: #0E112B !important;
    box-shadow: 0 0 0 0.2rem rgba(14, 17, 43, 0.15) !important;
    background-color: white !important;
    color: #2d3748 !important;
}

#modalEditarEntidadCrediticia #precio_venta_producto::placeholder,
#modalEditarEntidadCrediticia #precio_venta_producto_formateado::placeholder,
#modalEditarEntidadCrediticia #numero_cuotas::placeholder {
    color: #a0aec0 !important;
    opacity: 0.8 !important;
    font-size: 1.4rem !important;
}
body {
    background-color: #0a0e27 !important;
    background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 50%, #0a0e27 100%) !important;
}

.right_col {
    background-color: transparent !important;
}

.x_panel, .x_content {
    background-color: rgba(15, 20, 40, 0.8) !important;
    border-color: #1a1f3a !important;
}

.form-control {
    background-color: rgba(15, 20, 40, 0.9) !important;
    border-color: #2a2f4a !important;
    color: #ffffff !important;
}

.form-control:focus {
    background-color: rgba(20, 25, 45, 0.9) !important;
    border-color: #3a4f7a !important;
    color: #ffffff !important;
}

/* Estilos específicos para inputs en modales de edición de valores */
#modalEditarValorCredito .form-control,
#modalEditarValorContado .form-control,
#modalEditarNumeroCuotas .form-control,
#modalEditarCuotaMensual .form-control {
    background: rgba(255,255,255,0.1) !important;
    border: 1px solid rgba(255,255,255,0.2) !important;
    color: white !important;
    font-size: 1.3rem !important;
    padding: 0.8rem !important;
    border-radius: 8px !important;
}

#modalEditarValorCredito .form-control:focus,
#modalEditarValorContado .form-control:focus,
#modalEditarNumeroCuotas .form-control:focus,
#modalEditarCuotaMensual .form-control:focus {
    background: rgba(255,255,255,0.15) !important;
    border-color: #81e6d9 !important;
    color: white !important;
}

.table {
    color: #ffffff !important;
}

.table thead th {
    background-color: rgba(15, 20, 40, 0.9) !important;
    color: #ffffff !important;
    border-color: #2a2f4a !important;
}

.table tbody td {
    background-color: rgba(10, 14, 39, 0.5) !important;
    border-color: #2a2f4a !important;
    color: #e0e0e0 !important;
}

.table tbody tr:hover {
    background-color: rgba(10, 14, 30, 0.95) !important;
}

.table tbody tr:hover td {
    background-color: rgba(10, 14, 30, 0.95) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(10, 14, 30, 0.95) !important;
}

.table-hover tbody tr:hover td {
    background-color: rgba(10, 14, 30, 0.95) !important;
}

.modal-content {
    background-color: #0f1428 !important;
    color: #ffffff !important;
    border-color: #2a2f4a !important;
}

.modal-header, .modal-footer {
    border-color: #2a2f4a !important;
}

.page-title {
    color: #ffffff !important;
}

h1, h2, h3, h4, h5, h6, p, span, label, div {
    color: inherit !important;
}

select.form-control option {
    background-color: #0f1428 !important;
    color: #ffffff !important;
}

/* ================================================== */
/* ESTILOS PARA GRID DE ALIADOS CON TIENDAS Y PRODUCTOS */
/* ================================================== */

/* Contenedor principal del grid de aliados */
.aliados-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
    padding: 1rem 0;
}

@media (max-width: 768px) {
    .aliados-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Tarjeta de Aliado */
.aliado-card {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.aliado-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(65, 105, 225, 0.3);
    border-color: rgba(0, 212, 255, 0.5);
}

/* Header de la tarjeta de aliado */
.aliado-card-header {
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
}

.aliado-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.aliado-avatar i {
    font-size: 1.5rem;
    color: white;
}

.aliado-info-header {
    flex: 1;
    min-width: 0;
}

.aliado-nombre {
    color: white !important;
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0 0 0.25rem 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.aliado-cedula {
    color: rgba(255, 255, 255, 0.85) !important;
    font-size: 0.85rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.aliado-cedula i {
    font-size: 0.8rem;
}

.aliado-estado {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    flex-shrink: 0;
}

.aliado-estado.activo {
    background: linear-gradient(135deg, #00d4ff 0%, #00b4d8 100%);
    color: white;
}

.aliado-estado.inactivo {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5253 100%);
    color: white;
}

/* Body de la tarjeta de aliado */
.aliado-card-body {
    padding: 1.25rem;
}

.aliado-detalles {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.aliado-detalle-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(65, 105, 225, 0.1);
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.9);
}

.aliado-detalle-item i {
    color: #5b7ce6;
    font-size: 0.9rem;
}

/* Sección de Tiendas */
.tiendas-section {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(65, 105, 225, 0.2);
    background: rgba(0, 0, 0, 0.2);
}

.tiendas-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.85rem 1rem;
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.2) 0%, rgba(0, 212, 255, 0.1) 100%);
    cursor: pointer;
    transition: all 0.3s ease;
}

.tiendas-header:hover {
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.3) 0%, rgba(0, 212, 255, 0.2) 100%);
}

.tiendas-titulo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #00d4ff;
    font-weight: 600;
    font-size: 0.95rem;
}

.tiendas-titulo i {
    font-size: 1.1rem;
}

.tiendas-badge {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 700;
}

.tiendas-toggle-icon {
    color: #00d4ff;
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

/* Lista de tiendas */
.tiendas-lista {
    padding: 0.75rem;
    background: rgba(0, 0, 0, 0.15);
}

.tiendas-lista.slide-in {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Item de tienda */
.tienda-item {
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.1) 0%, rgba(0, 0, 0, 0.2) 100%);
    border: 1px solid rgba(65, 105, 225, 0.2);
    border-radius: 10px;
    margin-bottom: 0.75rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.tienda-item:last-child {
    margin-bottom: 0;
}

.tienda-item:hover {
    border-color: rgba(0, 212, 255, 0.4);
}

.tienda-item-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem;
    cursor: pointer;
    transition: background 0.3s ease;
}

.tienda-item-header:hover {
    background: rgba(0, 212, 255, 0.1);
}

.tienda-icono {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
}

.tienda-icono img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tienda-icono i {
    font-size: 1.2rem;
    color: white;
}

.tienda-item-info {
    flex: 1;
    min-width: 0;
}

.tienda-item-nombre {
    color: #00d4ff !important;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
}

.tienda-item-direccion {
    color: rgba(255, 255, 255, 0.7) !important;
    font-size: 0.75rem;
    margin: 0 0 0.35rem 0;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.tienda-item-direccion i {
    color: #5b7ce6;
    font-size: 0.7rem;
}

.tienda-stats-mini {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.stat-mini {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.7);
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.stat-mini i {
    font-size: 0.65rem;
    color: #5b7ce6;
}

.stat-mini.activos {
    color: #48bb78;
}

.stat-mini.activos i {
    color: #48bb78;
}

.tienda-toggle-icon {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85rem;
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

/* Contenedor de productos */
.productos-container {
    background: rgba(0, 0, 0, 0.3);
    border-top: 1px solid rgba(65, 105, 225, 0.2);
    padding: 1rem;
}

.productos-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 2rem;
    color: #00d4ff;
    font-size: 0.9rem;
}

.productos-loading i {
    font-size: 1.2rem;
}

/* Grid de productos */
.productos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 0.75rem;
}

@media (max-width: 480px) {
    .productos-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Tarjeta de producto */
.producto-card {
    background: linear-gradient(135deg, #1a1d3a 0%, #0f1225 100%);
    border: 1px solid rgba(65, 105, 225, 0.2);
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.producto-card:hover {
    transform: translateY(-2px);
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.2);
}

.producto-imagen {
    width: 100%;
    height: 100px;
    background: #0a0e27;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.producto-imagen img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.producto-card:hover .producto-imagen img {
    transform: scale(1.05);
}

.producto-info {
    padding: 0.75rem;
}

.producto-nombre {
    color: #00d4ff !important;
    font-size: 0.8rem;
    font-weight: 600;
    margin: 0 0 0.35rem 0;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.2em;
}

.producto-categoria {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.65rem;
    color: rgba(255, 255, 255, 0.6);
    background: rgba(65, 105, 225, 0.15);
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    margin-bottom: 0.5rem;
}

.producto-categoria i {
    font-size: 0.55rem;
}

.producto-precios {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.precio-contado, .precio-credito {
    text-align: center;
    padding: 0.35rem;
    border-radius: 6px;
}

.precio-contado {
    background: rgba(91, 124, 230, 0.15);
}

.precio-credito {
    background: rgba(0, 212, 255, 0.15);
}

.precio-label {
    display: block;
    font-size: 0.55rem;
    color: rgba(255, 255, 255, 0.6);
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 0.1rem;
}

.precio-contado .precio-valor {
    color: #5b7ce6;
    font-size: 0.8rem;
    font-weight: 700;
}

.precio-credito .precio-valor {
    color: #00d4ff;
    font-size: 0.8rem;
    font-weight: 700;
}

.producto-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.5rem;
}

.producto-stock {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.producto-stock.stock-disponible {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
}

.producto-stock.stock-bajo {
    background: rgba(255, 152, 0, 0.15);
    color: #ff9800;
}

.producto-stock.stock-agotado {
    background: rgba(255, 107, 107, 0.15);
    color: #ff6b6b;
}

.producto-estado {
    font-size: 0.6rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
}

.producto-estado.estado-activo {
    background: rgba(72, 187, 120, 0.2);
    color: #48bb78;
}

.producto-estado.estado-inactivo {
    background: rgba(255, 107, 107, 0.2);
    color: #ff6b6b;
}

/* Estados vacíos y errores */
.empty-tiendas, .empty-productos, .error-productos {
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.6);
}

.empty-tiendas i, .empty-productos i, .error-productos i {
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
    opacity: 0.5;
    display: block;
}

.empty-tiendas i, .empty-productos i {
    color: #5b7ce6;
}

.error-productos i {
    color: #ff6b6b;
}

.empty-tiendas p, .empty-productos p, .error-productos p {
    margin: 0;
    font-size: 0.85rem;
}

/* Footer de la tarjeta de aliado */
.aliado-card-footer {
    padding: 0.85rem 1.25rem;
    border-top: 1px solid rgba(65, 105, 225, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0, 0, 0, 0.2);
}

.aliado-id {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.5);
    font-weight: 600;
}

.aliado-comision {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.8rem;
    color: #48bb78;
    font-weight: 600;
}

.aliado-comision i {
    font-size: 0.7rem;
}
</style>