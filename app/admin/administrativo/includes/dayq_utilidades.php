<?php
/**
 * Utilidades comunes de formato y funciones helper
 */

function dayq_formato_moneda($monto) {
    return number_format($monto, 2, '.', ',');
}

function dayq_formato_porcentaje($valor, $decimales = 2) {
    return number_format($valor, $decimales, '.', ',') . '%';
}

function dayq_formato_fecha($fecha) {
    if (!$fecha) return '-';
    $dt = new DateTime($fecha);
    return $dt->format('d/m/Y');
}

function dayq_formato_fecha_hora($fecha) {
    if (!$fecha) return '-';
    $dt = new DateTime($fecha);
    return $dt->format('d/m/Y H:i:s');
}

function dayq_get_estado_clase($estado) {
    $clases = [
        'ABIERTA' => 'badge-success',
        'CERRADA' => 'badge-secondary',
        'PENDIENTE' => 'badge-warning',
        'ANULADA' => 'badge-danger',
        'PAGADA' => 'badge-info'
    ];
    return isset($clases[$estado]) ? $clases[$estado] : 'badge-light';
}

function dayq_get_estado_texto($estado) {
    $textos = [
        'ABIERTA' => 'Abierta',
        'CERRADA' => 'Cerrada',
        'PENDIENTE' => 'Pendiente',
        'ANULADA' => 'Anulada',
        'PAGADA' => 'Pagada'
    ];
    return isset($textos[$estado]) ? $textos[$estado] : $estado;
}

function dayq_genera_badge_delta($delta) {
    if ($delta > 0) {
        return '<span class="badge badge-success">↑ ' . dayq_formato_porcentaje(abs($delta)) . '</span>';
    } elseif ($delta < 0) {
        return '<span class="badge badge-danger">↓ ' . dayq_formato_porcentaje(abs($delta)) . '</span>';
    }
    return '<span class="badge badge-secondary">→ 0%</span>';
}

function dayq_genera_badge_state($state) {
    if ($state >= 0.75) {
        return '<span class="badge badge-success">Excelente</span>';
    } elseif ($state >= 0.5) {
        return '<span class="badge badge-warning">Bueno</span>';
    } elseif ($state >= 0.25) {
        return '<span class="badge badge-warning">Regular</span>';
    }
    return '<span class="badge badge-danger">Bajo</span>';
}

?>
