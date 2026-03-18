<?php
session_start();
include("../conexiones/conexione.php");
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

$cod_usuario_responsable = $_SESSION['cod_administrador'];
$op = isset($_POST['op']) ? $_POST['op'] : '';

// Función auxiliar para determinar la jerarquía
function getJerarquia($cod_seguridad) {
    // 20 LIDER, 21 COORDINADOR, 22 ASESOR, 23 ALIADO
    if($cod_seguridad == '21') { return ['col_superior' => 'cod_lider', 'rol_superior' => 20]; }
    if($cod_seguridad == '22') { return ['col_superior' => 'cod_coordinador', 'rol_superior' => 21]; }
    if($cod_seguridad == '23') { return ['col_superior' => 'cod_asesor', 'rol_superior' => 22]; }
    // Caso por defecto o roles que dependan del lider directamente
    return ['col_superior' => 'cod_lider', 'rol_superior' => 20]; 
}

if ($op == 'cargar_usuarios') {
    $cod_seguridad = intval($_POST['cod_rol']);
    $cod_tipo_reasignacion_usuario = intval($_POST['cod_accion']);

    $jerarquia = getJerarquia($cod_seguridad);
    $col_superior = $jerarquia['col_superior'];

    // Para obtener el nombre del superior, hacemos JOIN si es reasignacion
    $sql = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.nombres_apellidos_tercero, a.cedula, a.identificacion_tercero, a.{$col_superior}, s.nombre_seguridad, a.departamento, a.ciudad, a.barrio_tercero ";
    $sql .= ", lid.nombres as lid_nom, lid.apellidos as lid_ape, lid.nombres_apellidos_tercero as lid_nom_terc ";
    $sql .= ", coord.nombres as coord_nom, coord.apellidos as coord_ape, coord.nombres_apellidos_tercero as coord_nom_terc ";
    $sql .= ", ase.nombres as ase_nom, ase.apellidos as ase_ape, ase.nombres_apellidos_tercero as ase_nom_terc ";
    $sql .= " FROM tbl15_administrador a LEFT JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad ";
    $sql .= "LEFT JOIN tbl15_administrador lid ON a.cod_lider = lid.cod_administrador And a.cod_lider != 0 ";
    $sql .= "LEFT JOIN tbl15_administrador coord ON a.cod_coordinador = coord.cod_administrador And a.cod_coordinador != 0 ";
    $sql .= "LEFT JOIN tbl15_administrador ase ON a.cod_asesor = ase.cod_administrador And a.cod_asesor != 0 ";
    $sql .= "WHERE a.cod_seguridad = '$cod_seguridad' AND a.cod_estado != '0' ORDER BY a.nombres_apellidos_tercero ASC";

    $res = mysqli_query($conectar, $sql);
    $data = [];
    if($res) {
        while($row = mysqli_fetch_assoc($res)) {
            $nombre_completo = trim($row['nombres'] . ' ' . $row['apellidos']);
            if(empty($nombre_completo)) $nombre_completo = $row['nombres_apellidos_tercero'];
            $cedula = !empty($row['cedula']) ? $row['cedula'] : $row['identificacion_tercero'];
            
            $item = [
                'cod_administrador' => $row['cod_administrador'], 
                'nombre_completo' => $nombre_completo, 
                'cedula' => $cedula, 
                'nombre_rol' => $row['nombre_seguridad'],
                'departamento' => !empty($row['departamento']) ? $row['departamento'] : 'No registrado',
                'ciudad' => !empty($row['ciudad']) ? $row['ciudad'] : 'No registrado',
                'barrio' => !empty($row['barrio_tercero']) ? $row['barrio_tercero'] : 'No registrado',
                'superiores' => []
            ];

            if (!empty($row['lid_nom']) || !empty($row['lid_nom_terc'])) {
                $nom = trim($row['lid_nom'] . ' ' . $row['lid_ape']);
                if(empty($nom)) $nom = $row['lid_nom_terc'];
                $item['superiores'][] = ['rol' => 'LÍDER', 'nombre' => $nom];
            }
            if (!empty($row['coord_nom']) || !empty($row['coord_nom_terc'])) {
                $nom = trim($row['coord_nom'] . ' ' . $row['coord_ape']);
                if(empty($nom)) $nom = $row['coord_nom_terc'];
                $item['superiores'][] = ['rol' => 'COORDINADOR', 'nombre' => $nom];
            }
            if (!empty($row['ase_nom']) || !empty($row['ase_nom_terc'])) {
                $nom = trim($row['ase_nom'] . ' ' . $row['ase_ape']);
                if(empty($nom)) $nom = $row['ase_nom_terc'];
                $item['superiores'][] = ['rol' => 'ASESOR', 'nombre' => $nom];
            }

            $data[] = $item;
        }
    }
    echo json_encode(['success' => true, 'data' => $data]);
    exit;
}

if ($op == 'obtener_superiores') {
    $cod_seguridad = intval($_POST['cod_rol']);
    $jerarquia = getJerarquia($cod_seguridad);
    $rol_superior = $jerarquia['rol_superior'];

    $sql = "SELECT cod_administrador, nombres, apellidos, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '$rol_superior' AND cod_estado != '0' ORDER BY nombres_apellidos_tercero ASC";
    $res = mysqli_query($conectar, $sql);
    $data = [];
    if($res) {
        while($row = mysqli_fetch_assoc($res)) {
            $nombre = trim($row['nombres'] . ' ' . $row['apellidos']);
            if(empty($nombre)) $nombre = $row['nombres_apellidos_tercero'];
            $data[] = ['cod_administrador' => $row['cod_administrador'], 'nombres' => $nombre];
        }
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al consultar superiores']);
    }
    exit;
}

if ($op == 'ejecutar_accion') {
    $cod_tipo_reasignacion_usuario = intval($_POST['cod_accion']); // 1: Reasignar Sup, 2: Cambio Rol
    $ids = isset($_POST['ids_usuarios']) ? $_POST['ids_usuarios'] : [];
    $nuevo_valor = intval($_POST['nuevo_valor']);
    $nombre_tipo_motivo_reasignacion_superior_gerarquico = mysqli_real_escape_string($conectar, $_POST['motivo']);
    $descripcion_tipo_motivo_reasignacion_superior_gerarquico = mysqli_real_escape_string($conectar, $_POST['descripcion']);
    
    if(empty($ids) || count($ids) == 0) { echo json_encode(['success' => false, 'message' => 'No hay usuarios seleccionados']); exit; }

    // Obtener nombres de accion
    $sql_accion = "SELECT nombre_tipo_reasignacion_usuario FROM tbl15_tipo_reasignacion_usuario WHERE cod_tipo_reasignacion_usuario = '$cod_tipo_reasignacion_usuario'";
    $res_accion = mysqli_query($conectar, $sql_accion);
    $row_accion = mysqli_fetch_assoc($res_accion);
    $nombre_tipo_reasignacion_usuario = $row_accion ? $row_accion['nombre_tipo_reasignacion_usuario'] : 'DESCONOCIDA';
    
    $fecha_creacion = date('Y-m-d H:i:s');
    $exitos = 0;

    foreach($ids as $cod_usuario_afectado) {
        $cod_usuario_afectado = intval($cod_usuario_afectado);
        // Consultar el estado actual del usuario
        $sql_usr = "SELECT cod_seguridad, cod_lider, cod_coordinador, cod_asesor FROM tbl15_administrador WHERE cod_administrador = '$cod_usuario_afectado'";
        $res_usr = mysqli_query($conectar, $sql_usr);
        if($res_usr && mysqli_num_rows($res_usr) > 0) {
            $usr_data = mysqli_fetch_assoc($res_usr);
            $cod_rol_actual = intval($usr_data['cod_seguridad']);
            
            $cod_rol_anterior = 'NULL';
            $cod_rol_nuevo = 'NULL';
            $cod_superior_anterior = 'NULL';
            $cod_superior_nuevo = 'NULL';

            if($cod_tipo_reasignacion_usuario == 1) { // REASIGNACION
                $jerarquia = getJerarquia($cod_rol_actual);
                $col_superior = $jerarquia['col_superior'];
                $superior_actual = intval($usr_data[$col_superior]);
                
                $cod_superior_anterior = $superior_actual > 0 ? $superior_actual : 'NULL';
                $cod_superior_nuevo = $nuevo_valor > 0 ? $nuevo_valor : 'NULL';

                // Realizar el UPDATE en el administrador
                $nval_sql = $nuevo_valor > 0 ? "'$nuevo_valor'" : "0";
                mysqli_query($conectar, "UPDATE tbl15_administrador SET {$col_superior} = $nval_sql WHERE cod_administrador = '$cod_usuario_afectado'");

            } else if($cod_tipo_reasignacion_usuario == 2) { // CAMBIO DE ROL
                $cod_rol_anterior = $cod_rol_actual > 0 ? $cod_rol_actual : 'NULL';
                $cod_rol_nuevo = $nuevo_valor > 0 ? $nuevo_valor : 'NULL';
                
                // Obtener url_pag_redirec_ini_sesion dinamica
                $sql_url_seg = "SELECT url_pag_redirec_ini_sesion FROM tbl15_seguridad WHERE cod_seguridad = '$nuevo_valor'";
                $res_url_seg = mysqli_query($conectar, $sql_url_seg);
                $url_nueva = '';
                if($res_url_seg && $row_url = mysqli_fetch_assoc($res_url_seg)){ $url_nueva = $row_url['url_pag_redirec_ini_sesion']; }
                // Realizar el UPDATE
                mysqli_query($conectar, "UPDATE tbl15_administrador SET cod_seguridad = '$nuevo_valor', url_pag_redirec_ini_sesion = '$url_nueva' WHERE cod_administrador = '$cod_usuario_afectado'");
            }
            // Insertar en el historial
            $sql_historial = "INSERT INTO tbl15_historial_reasignacion_superior_gerarquico_cambio_rol (
            cod_tipo_reasignacion_usuario, nombre_tipo_reasignacion_usuario, nombre_tipo_motivo_reasignacion_superior_gerarquico, 
            descripcion_tipo_motivo_reasignacion_superior_gerarquico, cod_usuario_afectado, cod_usuario_responsable,
            cod_rol_anterior, cod_rol_nuevo, cod_superior_anterior, cod_superior_nuevo, fecha_creacion) 
            VALUES ('$cod_tipo_reasignacion_usuario', '$nombre_tipo_reasignacion_usuario', '$nombre_tipo_motivo_reasignacion_superior_gerarquico',
            '$descripcion_tipo_motivo_reasignacion_superior_gerarquico', '$cod_usuario_afectado', '$cod_usuario_responsable',
            $cod_rol_anterior, $cod_rol_nuevo, $cod_superior_anterior, $cod_superior_nuevo, '$fecha_creacion')";
            mysqli_query($conectar, $sql_historial);
            $exitos++;
        }
    }
    echo json_encode(['success' => true, 'message' => 'Se procesaron correctamente '.$exitos.' registros.']);
    exit;
}
echo json_encode(['success' => false, 'message' => 'Operación desconocida']);
?>
