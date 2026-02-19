<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');

date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){
} else { header("Location:../index.php"); }

$cod_administrador                                           = $_SESSION['cod_administrador'];
$cod_administrador_aliado_estrategico                        = $cod_administrador;

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if($action == 'ajax') {
    $busqueda_ajax                   = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['busqueda_ajax'], ENT_QUOTES)));
    $buscar_por                      = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['buscar_por'], ENT_QUOTES)));
    $numero_registro_por_pagina      = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['numero_registro_por_pagina'], ENT_QUOTES)));
    $cod_administrador               = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_administrador'], ENT_QUOTES)));
    $cod_seguridad                   = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['cod_seguridad'], ENT_QUOTES)));
    $tabla                           = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['tabla'], ENT_QUOTES)));
    $pagina                          = mysqli_real_escape_string($conectar,(strip_tags($_REQUEST['pagina'], ENT_QUOTES)));
}

if($action == 'ajax') {
    // Consulta para obtener facturas con comprobante de pago
    $sTable = "tbl15_info_factura_venta LEFT JOIN tbl15_tercero ON tbl15_info_factura_venta.cod_tercero = tbl15_tercero.cod_tercero";
    $sWhere = " WHERE (tbl15_info_factura_venta.cod_administrador_aliado_estrategico = '$cod_administrador_aliado_estrategico') AND (tbl15_info_factura_venta.url_img_orig_producto != '' AND tbl15_info_factura_venta.url_img_orig_producto IS NOT NULL)";
    if ($busqueda_ajax != "") { $sWhere .= " AND (tbl15_tercero.nombres_apellidos_tercero LIKE '%$busqueda_ajax%' OR tbl15_tercero.identificacion_tercero LIKE '%$busqueda_ajax%')"; }
    $sWhere .= " ORDER BY tbl15_info_factura_venta.fecha_modificacion DESC";

    // Paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 20;
    $registro_inicio = ($page - 1) * $per_page;
    
    // Contar registros
    $sql_cantidad_registros = "SELECT count(DISTINCT tbl15_info_factura_venta.cod_info_factura_venta) AS cantidad_registros FROM $sTable $sWhere";
    $consulta_cantidad_registros = mysqli_query($conectar, $sql_cantidad_registros);
    if (!$consulta_cantidad_registros) {
        $cantidad_registros = 0;
    } else {
        $datos_cantidad_registros = mysqli_fetch_array($consulta_cantidad_registros);
        $cantidad_registros = $datos_cantidad_registros['cantidad_registros'];
    }

    if ($cantidad_registros > 0) {
        // Consulta principal
        $sql_comprobantes = "SELECT DISTINCT 
        tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.monto_deuda, tbl15_info_factura_venta.subtotal_sin_interes, tbl15_info_factura_venta.nombre_estado_factura,
        tbl15_info_factura_venta.url_img_orig_producto, tbl15_info_factura_venta.url_img_min_producto, tbl15_info_factura_venta.fecha_creacion, tbl15_info_factura_venta.fecha_hora,
        tbl15_tercero.nombres_apellidos_tercero, tbl15_tercero.identificacion_tercero
        FROM $sTable $sWhere LIMIT $registro_inicio, $per_page";
        $consulta_comprobantes = mysqli_query($conectar, $sql_comprobantes) or die(mysqli_error($conectar));
        while ($datos = mysqli_fetch_assoc($consulta_comprobantes)) {

            $cod_info_factura_venta    = $datos['cod_info_factura_venta'];
            $cod_factura               = $datos['cod_factura'];
            $monto_deuda               = $datos['monto_deuda'];
            $subtotal_sin_interes      = $datos['subtotal_sin_interes'];
            $nombre_estado_factura     = $datos['nombre_estado_factura'];
            $nombres_apellidos_tercero = $datos['nombres_apellidos_tercero'] ?: 'Sin nombre';
            $identificacion_tercero    = $datos['identificacion_tercero'] ?: 'Sin identificación';
            $url_img_orig_producto     = $datos['url_img_orig_producto'];
            $url_img_min_producto      = $datos['url_img_min_producto'] ?: $url_img_orig_producto;
            $fecha_creacion            = $datos['fecha_creacion'];
            $fecha_hora                = $datos['fecha_hora'];
            // Formatear fecha
            $fecha_formateada = !empty($fecha_creacion) ? date('d M, Y', strtotime($fecha_creacion)) : '';
            $hora_formateada = $fecha_hora ?: '';
            // Determinar color del badge según estado
            $badge_color = ($nombre_estado_factura == 'CERRADA') ? '#3b82f6' : '#10b981';
?>
        <div class="card-comprobante" onclick="abrirModalComprobantePago('<?php echo $cod_info_factura_venta; ?>', '<?php echo $url_img_orig_producto; ?>')">
            <div class="comprobante-icono">
                <i class="fa fa-file-image-o"></i>
            </div>
            <div class="comprobante-info">
                <h6><?php echo htmlspecialchars($nombres_apellidos_tercero); ?></h6>
                <p><span class="comprobante-meta">CC: <?php echo htmlspecialchars($identificacion_tercero); ?></span> <span class="comprobante-meta"><i class="fa fa-calendar"></i> <?php echo $fecha_formateada; ?></span><?php if ($subtotal_sin_interes > 0) { ?> <span class="comprobante-monto">$<?php echo number_format($subtotal_sin_interes, 0, ',', '.'); ?></span><?php } ?></p>
            </div>
            <span class="comprobante-badge" style="background: <?php echo $badge_color; ?>;"><?php echo $nombre_estado_factura; ?></span>
            <div class="comprobante-ver-btn">
                <i class="fa fa-eye"></i>
            </div>
        </div>
<?php
        }
    } else {
?>
        <div class="alert alert-info" style="background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); border: 1px solid rgba(147, 51, 234, 0.3); color: #fff; border-radius: 15px; text-align: center; padding: 2rem;">
            <i class="fa fa-info-circle" style="font-size: 3rem; color: #9333ea; margin-bottom: 1rem; display: block;"></i>
            <h5 style="margin-bottom: 0.5rem;">No hay comprobantes de pago</h5>
            <p style="color: #a0aec0; margin: 0;">Aún no se han cargado comprobantes de pago para tus créditos.</p>
        </div>
<?php
    }
}
?>

<style>
/* Tarjeta compacta horizontal */
.card-comprobante {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border-radius: 12px;
    padding: 0.7rem 1rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(147, 51, 234, 0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    transition: all 0.25s ease;
}

.card-comprobante:hover {
    border-color: rgba(147, 51, 234, 0.5);
    box-shadow: 0 4px 15px rgba(147, 51, 234, 0.2);
    transform: translateX(3px);
}

.comprobante-icono {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(147, 51, 234, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}

.comprobante-icono i {
    font-size: 1.2rem;
    color: #9333ea;
}

.comprobante-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.comprobante-info h6 {
    color: #fff;
    font-weight: 600;
    font-size: 0.85rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.comprobante-info p {
    color: #718096;
    font-size: 0.75rem;
    margin: 0.15rem 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.comprobante-meta {
    margin-right: 0.5rem;
}

.comprobante-monto {
    color: #9333ea;
    font-weight: 700;
}

.comprobante-badge {
    flex-shrink: 0;
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    white-space: nowrap;
}

.comprobante-ver-btn {
    flex-shrink: 0;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: linear-gradient(135deg, #9333ea 0%, #f97316 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease;
}

.comprobante-ver-btn i {
    color: white;
    font-size: 0.85rem;
}

.card-comprobante:hover .comprobante-ver-btn {
    transform: scale(1.1);
}
</style>
