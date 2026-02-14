<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$tipo_equipo_gestion = isset($_POST['tipo_equipo_gestion']) ? $_POST['tipo_equipo_gestion'] : '';
$valor_actual = isset($_POST['valor_actual']) ? $_POST['valor_actual'] : '';

if ($tipo_equipo_gestion == 'selectNuevoLider') {
    $cod_seguridad = '20';
} elseif ($tipo_equipo_gestion == 'selectNuevoCoordinador') {
    $cod_seguridad = '21';
} elseif ($tipo_equipo_gestion == 'selectNuevoAsesor') {
    $cod_seguridad = '22';
} elseif ($tipo_equipo_gestion == 'selectNuevoAliadoEstrategico') {
    $cod_seguridad = '23';
} elseif ($tipo_equipo_gestion == 'selectNuevoRevisor') {
    $cod_seguridad = '27';
} else {
    $cod_seguridad = '';
}
// Inicializar respuesta
$response = array('ok_ajax' => 'NO', 'administradores' => array());

if (!empty($cod_seguridad)) {
    // Consultar administradores según cod_seguridad
    $consulta_sql = "SELECT cod_administrador, cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_seguridad = '$cod_seguridad') ORDER BY nombres ASC";
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $response['administradores'][] = array(
                'cod_administrador' => $row['cod_administrador'],
                'cuenta' => $row['cuenta'],
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos']
            );
        }
        $response['ok_ajax'] = 'SI';
    }
}
// Cerrar conexión
mysqli_close($conectar);
// Enviar respuesta JSON
echo json_encode($response);
?>
