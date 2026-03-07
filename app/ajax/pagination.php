<?php
function paginate($reload, $page, $tpages, $adjacents) {
    if ($tpages <= 1) return '';
    $prevlabel = '<i class="fa-solid fa-chevron-left"></i>';
    $nextlabel = '<i class="fa-solid fa-chevron-right"></i>';
    $out = '<div class="pagination-container animate-in">';
    // Botón Anterior
    if ($page == 1) { $out .= '<a class="pagination-btn disabled">' . $prevlabel . '</a>'; } else { $prev_page = $page - 1; $out .= '<a href="javascript:void(0);" onclick="load(' . $prev_page . ')" class="pagination-btn">' . $prevlabel . '</a>'; }
    // Información de página
    $out .= '<div class="pagination-info">Página <span>' . $page . '</span> de <span>' . $tpages . '</span></div>';
    // Botón Siguiente
    if ($page < $tpages) { $next_page = $page + 1; $out .= '<a href="javascript:void(0);" onclick="load(' . $next_page . ')" class="pagination-btn">' . $nextlabel . '</a>'; } else { $out .= '<a class="pagination-btn disabled">' . $nextlabel . '</a>'; }
    
    $out .= '</div>';
    return $out;
}
?>