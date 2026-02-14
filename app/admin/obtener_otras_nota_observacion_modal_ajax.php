<?php
// Endpoint que devuelve el HTML de las notas para un cod_info_factura_venta dado
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: text/html; charset=utf-8');

$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_info_factura_venta'])) : '';
if ($cod_info_factura_venta === '') { echo '<div class="col-12">Error: cod_info_factura_venta no especificado</div>'; exit; }

$sql_nota_observacion = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_estado_obligatorio2 = '1' OR url_img_orig_producto = '') ORDER BY cod_posicion ASC";
$consulta_nota_observacion = mysqli_query($conectar, $sql_nota_observacion);
if (!$consulta_nota_observacion) { echo '<div class="col-12">Error en consulta: ' . mysqli_error($conectar) . '</div>'; exit; }

$html = '';
while ($matriz_nota_observacion = mysqli_fetch_assoc($consulta_nota_observacion)) {


    $cod_nota_observacion                           = $matriz_nota_observacion['cod_nota_observacion'];
    $nombre_nota_observacion                        = $matriz_nota_observacion['nombre_nota_observacion'];
    $descripcion_nota_observacion                   = $matriz_nota_observacion['descripcion_nota_observacion'];
    $fecha_ymd                                      = $matriz_nota_observacion['fecha_ymd'];
    $fecha_hora                                     = $matriz_nota_observacion['fecha_hora'];
    $cuenta                                         = $matriz_nota_observacion['cuenta'];
    $cod_tipo_nota_observacion                      = $matriz_nota_observacion['cod_tipo_nota_observacion'];
    $cod_estado_obligatorio                         = $matriz_nota_observacion['cod_estado_obligatorio'];
    $cod_estado_obligatorio2                        = $matriz_nota_observacion['cod_estado_obligatorio2'];
    $cod_estado_obligatorio_revisor                 = $matriz_nota_observacion['cod_estado_obligatorio_revisor'];
    $url_img_orig_producto                          = $matriz_nota_observacion['url_img_orig_producto'];
    $url_img_min_producto                           = $matriz_nota_observacion['url_img_min_producto'];
    $cod_posicion                                   = $matriz_nota_observacion['cod_posicion'];
    $active                                         = $matriz_nota_observacion['active'];
    $codigo_estado_revision                         = $matriz_nota_observacion['codigo_estado_revision'];
    $notificacion_via_whatsapp                      = $matriz_nota_observacion['notificacion_via_whatsapp'];
    $notificacion_via_msj                           = $matriz_nota_observacion['notificacion_via_msj'];
    $notificacion_via_email                         = $matriz_nota_observacion['notificacion_via_email'];
    $notificacion_via_whatsapp                      = str_pad($notificacion_via_whatsapp, 3, '0', STR_PAD_LEFT);
    $notificacion_via_msj                           = str_pad($notificacion_via_msj, 3, '0', STR_PAD_LEFT);
    $notificacion_via_email                         = str_pad($notificacion_via_email, 3, '0', STR_PAD_LEFT);

    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
    $dato_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

    $nombre_estado_revision                         = $dato_estado_revision['nombre_estado_revision'];

    if ($cod_estado_obligatorio == '1') { 
        $imagen_obligatoria = '*'; 
        // Estilo sutil para imágenes obligatorias
        $container_style = "border: 2px solid #ffc107; border-radius: 8px; padding: 1.5rem; background-color: #fffbf0; border-left: 4px solid #ff6b35;";
        $titulo_style = "font-weight: 600; color: #d63384; margin-bottom: 1rem; text-align: center;";
    } else { 
        $imagen_obligatoria = ''; 
        // Estilo normal para imágenes opcionales
        $container_style = "border: 2px solid #e9ecef; border-radius: 8px; padding: 1.5rem; background-color: #f8f9fa;";
        $titulo_style = "font-weight: 600; color: #333; margin-bottom: 1rem; text-align: center;";
    }

    if ($cod_estado_obligatorio2 == '1') { 
        $imagen_obligatoria2 = '*'; 
        // Estilo sutil para imágenes obligatorias
        $container_style2 = "border: 2px solid #ffc107; border-radius: 8px; padding: 1.5rem; background-color: #fffbf0; border-left: 4px solid #ff6b35;";
        $titulo_style2 = "font-weight: 600; color: #d63384; margin-bottom: 1rem; text-align: center;";
    } else { 
        $imagen_obligatoria2 = ''; 
        // Estilo normal para imágenes opcionales
        $container_style2 = "border: 2px solid #e9ecef; border-radius: 8px; padding: 1.5rem; background-color: #f8f9fa;";
        $titulo_style2 = "font-weight: 600; color: #333; margin-bottom: 1rem; text-align: center;";
    }

    if ($cod_estado_obligatorio_revisor == '1') { $imagen_obligatoria_revisor = '*'; } else { $imagen_obligatoria_revisor = ''; }

    if (!empty($url_img_min_producto)) {
        $previsualizar_foto_min = "<img src=\"{$url_img_min_producto}\" style=\"max-width: 200px; max-height: 200px; border-radius: 8px; margin-top: 10px;\" alt=\"Foto tomada\">";
        // Si ya hay imagen, desactivar el botón de cámara y activar el botón de borrar
        $btn_camara_html = "<button type=\"button\" id=\"btn_activar_camara_{$cod_nota_observacion}\" class=\"btn_activar_camara btn flex-grow-1\" disabled style=\"background-color: #28a745 !important; color: white !important; border: 2px solid #28a745 !important; cursor: not-allowed !important; opacity: 0.8 !important;\"><i class=\"fa fa-check\" style=\"margin-right: 8px;\"></i>Foto Capturada</button>";
        
        // Si el estado de revisión es 2 (APROBADO), deshabilitar el botón de borrar
        if ($codigo_estado_revision == '2') {
            $btn_borrar_html = "<button type=\"button\" id=\"btn_borrar_foto_tomada_{$cod_nota_observacion}\" class=\"btn_cancelar_foto\" disabled style=\"opacity: 0.5; cursor: not-allowed;\" title=\"No se puede eliminar una imagen aprobada\"><i class=\"fa fa-times\"></i></button>";
        } else {
            $btn_borrar_html = "<button type=\"button\" id=\"btn_borrar_foto_tomada_{$cod_nota_observacion}\" class=\"btn_cancelar_foto\"><i class=\"fa fa-times\"></i></button>";
        }
    } else {
        $previsualizar_foto_min = "";
        // Si no hay imagen, botón normal de cámara y botón de borrar deshabilitado
        $btn_camara_html = "<button type=\"button\" id=\"btn_activar_camara_{$cod_nota_observacion}\" class=\"btn_activar_camara btn flex-grow-1\"><i class=\"fa fa-camera\" style=\"margin-right: 8px;\"></i>Cámara</button>";
        $btn_borrar_html = "<button type=\"button\" id=\"btn_borrar_foto_tomada_{$cod_nota_observacion}\" class=\"btn_cancelar_foto\" disabled style=\"opacity: 0.5; cursor: not-allowed;\"><i class=\"fa fa-times\"></i></button>";
    }
    
    // Determinar el color del badge según el estado
    $badge_color = '#e2e8f0';
    $badge_text_color = '#222';
    if ($codigo_estado_revision == '1') {
        $badge_color = '#718096'; // PENDIENTE - Gris
    } elseif ($codigo_estado_revision == '2') {
        $badge_color = '#38a169'; // APROBADO - Verde
    } elseif ($codigo_estado_revision == '3') {
        $badge_color = '#e53e3e'; // RECHAZADO - Rojo
        $badge_text_color = '#fff';
    }
    
    // Preparar notificación de rechazo si el estado es 3 (RECHAZADO)
    $notificacion_rechazo = '';
    if ($codigo_estado_revision == '3' && !empty($descripcion_nota_observacion)) {
        $notificacion_rechazo = "<div style=\"margin-top: 1rem; padding: 0.75rem; background: #fed7d7; border-left: 4px solid #e53e3e; border-radius: 4px;\">\n";
        $notificacion_rechazo .= "    <p style=\"margin: 0; color: #742a2a; font-size: 0.85rem; font-weight: 600;\">\n";
        $notificacion_rechazo .= "        <i class=\"fa fa-exclamation-triangle\" style=\"margin-right: 0.3rem;\"></i>Motivo del Rechazo: {$descripcion_nota_observacion}";
        $notificacion_rechazo .= "    </p>\n";
        $notificacion_rechazo .= "</div>\n";
    }
    
    $html .= "<div class=\"col-12\">\n";
    $html .= "    <div style=\"{$container_style2}\">\n";
    $html .= "        <h6 style=\"{$titulo_style2}\">{$nombre_nota_observacion} {$imagen_obligatoria2}</h6>\n";
    $html .= "        <div class=\"d-flex gap-2\">\n";
    $html .= "            {$btn_camara_html}\n";
    $html .= "            {$btn_borrar_html}\n";
    $html .= "        </div>\n";
    $html .= "        <div class=\"col-12 text-center\">\n";
    $html .= "            <span id=\"foto_tomada_{$cod_nota_observacion}\">{$previsualizar_foto_min}</span>\n";
    $html .= "            <div style=\"margin-top: 0.5rem;\">\n";
    $html .= "                <span style=\"display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 0.85rem; font-weight: 600; background: {$badge_color}; color: {$badge_text_color};\">\n";
    $html .= "                    <i class=\"fa fa-info-circle\" style=\"margin-right: 4px;\"></i>{$nombre_estado_revision}\n";
    $html .= "                </span>\n";
    $html .= "            </div>\n";
    $html .= "        </div>\n";
    $html .= "        {$notificacion_rechazo}\n";
    $html .= "    </div>\n";
    $html .= "</div>\n";
}

echo $html;
?>