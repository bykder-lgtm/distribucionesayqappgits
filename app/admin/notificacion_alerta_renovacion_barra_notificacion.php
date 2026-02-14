<?php
$archivo_info             = fopen('../cron/archivo_notificaciones_alerta_renovaciones.txt','r');
if (!$archivo_info) { echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit; }
 
$contador                 = 0; // contador de líneas
$datos_seleccionados      = '';

while (!feof($archivo_info)) { // contador hasta que se llegue al final del archivo
    $contador++;
    $datos_fila = fgets($archivo_info); // guardamos toda la línea en $datos_fila como un string
    // dividimos $datos_fila en sus celdas, separadas por el caracter |
    // e incorporamos la línea a la matriz $datos_archivo
    $datos_archivo[$contador] = explode ('|', $datos_fila);

    $nombre_estado            = utf8_encode($datos_archivo[$contador][0]);
    $nombre_noticia           = utf8_encode($datos_archivo[$contador][1]);
    $url_noticia              = utf8_encode($datos_archivo[$contador][2]);
    $tipo_noticia             = utf8_encode($datos_archivo[$contador][3]);
    $fuente_noticia           = utf8_encode($datos_archivo[$contador][4]);

    if ($nombre_estado==1) { $datos_seleccionados[] = array('nombre_noticia'=>$nombre_noticia,'url_noticia'=>$url_noticia,'tipo_noticia'=>$tipo_noticia,'fuente_noticia'=>$fuente_noticia); }

    $archivo_info++; // necesitamos llevar el puntero del archivo a la siguiente línea
}
fclose($archivo_info);

$escoger_aletorio = $datos_seleccionados[array_rand($datos_seleccionados, 1)]; 

$nombre_noticia           = $escoger_aletorio['nombre_noticia'];
$url_noticia              = $escoger_aletorio['url_noticia'];
$tipo_noticia             = $escoger_aletorio['tipo_noticia'];
$fuente_noticia           = $escoger_aletorio['fuente_noticia'];
?>
<link rel="stylesheet" href="../estilo_css/barra_notificacion.css" type="text/css" />

<div id="barra_notificacion_bar" class="regular closable">
    <div class="barra_notificacion-content-wrapper">
        <div class="barra_notificacion-text-wrapper">
            <div class="barra_notificacion-headline-text">
                <p><span><?php echo $nombre_noticia; ?></span></p>
            </div>
        </div>
        <a href="<?php echo $url_noticia; ?>" target="_blank" class="barra_notificacion-cta barra_notificacion-cta-button"><div class="barra_notificacion-text-holder"><p>Leer ahora</p></div></a>
    </div>
    <div class="barra_notificacion-close-wrapper">
        <a href="javascript:void(0);" class="icon-close" onClick="$('#barra_notificacion_bar').fadeOut()">&#10006;</a>
    </div>
</div>