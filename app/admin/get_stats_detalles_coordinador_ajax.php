<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

$cod_coordinador = isset($_POST['cod_coordinador']) ? (int)$_POST['cod_coordinador'] : 0;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

if ($cod_coordinador <= 0 || empty($tipo)) { echo '<div style="text-align: center; color: rgba(255,255,255,0.5); padding: 2rem;">Parámetros insuficientes</div>'; exit; }

$html = '<div style="display: flex; flex-direction: column; gap: 0.75rem;">';

if ($tipo === 'asesores') {
    $sql = "SELECT cod_administrador, cedula, nombres, apellidos, nombres_apellidos_tercero, telefono FROM tbl15_administrador WHERE cod_coordinador = $cod_coordinador AND cod_seguridad = '22' ORDER BY nombres_apellidos_tercero ASC";
    $res = mysqli_query($conectar, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            $iniciales = strtoupper(substr($r['nombres'], 0, 1) . substr($r['apellidos'], 0, 1));
            $cod_administrador_asesor = $r['cod_administrador'];
            $html .= '
            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #3b82f6; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 0.85rem;">' . ($iniciales ?: 'AS') . '</div>
                <div style="flex: 1;">
                    <div style="color: white; font-weight: 600; font-size: 0.9rem;">' . $r['nombres_apellidos_tercero'] . '</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.75rem;"><i class="fa-solid fa-phone" style="font-size: 0.7rem;"></i> ' . ($r['telefono'] ?: 'No reg.') . '</div>
                </div>
                <button onclick="location.href=\'lista_asesor_lider_movil.php?busqueda=' . $cod_administrador_asesor . '&cod_coordinador=' . $cod_coordinador . '\'" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; border: none; padding: 0.4rem; border-radius: 8px; cursor: pointer;"><i class="fa-solid fa-eye"></i></button>
            </div>';
        }
    } else {
        $html .= '<div style="text-align: center; color: rgba(255,255,255,0.4); padding: 2rem;">No tienes asesores asignados</div>';
    }

} elseif ($tipo === 'aliados') {
    $sql = "SELECT cod_administrador, cedula, nombres, apellidos, nombres_apellidos_tercero, telefono FROM tbl15_administrador WHERE cod_coordinador = $cod_coordinador AND cod_seguridad = '23' ORDER BY nombres_apellidos_tercero ASC";
    $res = mysqli_query($conectar, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            $iniciales = strtoupper(substr($r['nombres'], 0, 1) . substr($r['apellidos'], 0, 1));
            $cod_administrador_aliado = $r['cod_administrador'];
            $html .= '
            <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.2); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #8b5cf6; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 0.85rem;">' . ($iniciales ?: 'AL') . '</div>
                <div style="flex: 1;">
                    <div style="color: white; font-weight: 600; font-size: 0.9rem;">' . $r['nombres_apellidos_tercero'] . '</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.75rem;"><i class="fa-solid fa-phone" style="font-size: 0.7rem;"></i> ' . ($r['telefono'] ?: 'No reg.') . '</div>
                </div>
                <button onclick="location.href=\'lista_aliado_lider_movil.php?cod_administrador=' . $cod_administrador_aliado . '&cod_coordinador=' . $cod_coordinador . '\'" style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6; border: none; padding: 0.4rem; border-radius: 8px; cursor: pointer;"><i class="fa-solid fa-eye"></i></button>
            </div>';
        }
    } else {
        $html .= '<div style="text-align: center; color: rgba(255,255,255,0.4); padding: 2rem;">No hay aliados asignados a este coordinador</div>';
    }

} elseif ($tipo === 'tiendas') {
    $sql = "SELECT t.cod_tienda, t.nombre_tienda, t.identificacion_tercero, t.telefono1_tercero, t.url_img_min_tienda 
            FROM tbl15_tienda t 
            WHERE t.cod_aliado_estrategico IN (SELECT cod_administrador FROM tbl15_administrador WHERE cod_coordinador = $cod_coordinador AND cod_seguridad = '23') 
            ORDER BY t.nombre_tienda ASC";
    $res = mysqli_query($conectar, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            $img = $r['url_img_min_tienda'] ?: '';
            $cod_tienda = $r['cod_tienda'];
            $avatar = $img ? '<img src="' . $img . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">' : '<i class="fa-solid fa-store" style="font-size: 1rem;"></i>';
            
            $html .= '
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 40px; height: 40px; border-radius: 50%; background: #10b981; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 0.85rem; overflow: hidden;">' . $avatar . '</div>
                <div style="flex: 1;">
                    <div style="color: white; font-weight: 600; font-size: 0.9rem;">' . $r['nombre_tienda'] . '</div>
                    <div style="color: rgba(255,255,255,0.5); font-size: 0.75rem;"><i class="fa-solid fa-phone" style="font-size: 0.7rem;"></i> ' . ($r['telefono1_tercero'] ?: 'No reg.') . '</div>
                </div>
                <button onclick="location.href=\'ver_detalle_tienda_lider_movil.php?cod_tienda=' . $cod_tienda . '\'" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border: none; padding: 0.4rem; border-radius: 8px; cursor: pointer;"><i class="fa-solid fa-eye"></i></button>
            </div>';
        }
    } else {
        $html .= '<div style="text-align: center; color: rgba(255,255,255,0.4); padding: 2rem;">No hay tiendas registradas para los aliados de este coordinador</div>';
    }
}
$html .= '</div>';
echo $html;
?>
