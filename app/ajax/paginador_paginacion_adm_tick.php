<?php
function paginador_clase($recargar_pagina, $pagina_paginacion, $total_paginas, $adyacentes) {
$etiqueta_anterior = "&lsaquo; Anterior";
$etiqueta_siguiente = "Siguiente &rsaquo;";
$out = '<ul id="lista_horizontal" class="pagination pagination-large">';

// previous label

if($pagina_paginacion==1) { $out.= "<li class='disabled'><span><a>$etiqueta_anterior</a></span></li>"; } 
else if($pagina_paginacion==2) { $out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$etiqueta_anterior </a></span></li>"; } 
else { $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($pagina_paginacion-1).")'>$etiqueta_anterior</a></span></li>"; }

// first label
if($pagina_paginacion>($adyacentes+1)) { $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>"; }
// interval
if($pagina_paginacion>($adyacentes+2)) { $out.= "<li><a>...</a></li>"; }

// pages

$pagina_min = ($pagina_paginacion>$adyacentes) ? ($pagina_paginacion-$adyacentes) : 1;
$pagina_max = ($pagina_paginacion<($total_paginas-$adyacentes)) ? ($pagina_paginacion+$adyacentes) : $total_paginas;
for($i=$pagina_min; $i<=$pagina_max; $i++) {
if($i==$pagina_paginacion) { $out.= "<li class='active'><a>$i</a></li>"; } 
else if($i==1) { $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>"; } 
else { $out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>"; }
}

// interval
if($pagina_paginacion<($total_paginas-$adyacentes-1)) { $out.= "<li><a>...</a></li>"; }
// last
if($pagina_paginacion<($total_paginas-$adyacentes)) { $out.= "<li><a href='javascript:void(0);' onclick='load($total_paginas)'>$total_paginas</a></li>"; }
// next
if($pagina_paginacion<$total_paginas) { $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($pagina_paginacion+1).")'>$etiqueta_siguiente</a></span></li>"; } 
else { $out.= "<li class='disabled'><span><a>$etiqueta_siguiente</a></span></li>"; }

$out.= "</ul>";
return $out;
}
?>