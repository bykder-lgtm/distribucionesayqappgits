<?php
session_start();
include("../conexiones/conexione.php");

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { 
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']); 
    exit; 
}

$op = isset($_POST['op']) ? $_POST['op'] : '';

if ($op == 'cargar_historial') {
    // Consulta para traer los datos del historial con INNER/LEFT JOIN para cruzar con administrador y seguridad
    $sql = "SELECT 
                h.cod_historial_reasignacion_superior_gerarquico_cambio_rol AS id_historial,
                h.cod_tipo_reasignacion_usuario,
                h.nombre_tipo_reasignacion_usuario,
                h.nombre_tipo_motivo_reasignacion_superior_gerarquico AS motivo,
                h.descripcion_tipo_motivo_reasignacion_superior_gerarquico AS descripcion,
                h.fecha_creacion,
                
                -- Responsable
                resp.nombres AS resp_nom, resp.apellidos AS resp_ape, resp.nombres_apellidos_tercero AS resp_terc,
                
                -- Afectado
                afec.nombres AS afec_nom, afec.apellidos AS afec_ape, afec.nombres_apellidos_tercero AS afec_terc,
                COALESCE(afec.cedula, afec.identificacion_tercero) AS afec_doc,
                
                -- Roles
                rol_ant.nombre_seguridad AS rol_anterior_desc,
                rol_nue.nombre_seguridad AS rol_nuevo_desc,
                
                -- Superior Anterior
                sup_ant.nombres AS sup_ant_nom, sup_ant.apellidos AS sup_ant_ape, sup_ant.nombres_apellidos_tercero AS sup_ant_terc,
                
                -- Superior Nuevo
                sup_nue.nombres AS sup_nue_nom, sup_nue.apellidos AS sup_nue_ape, sup_nue.nombres_apellidos_tercero AS sup_nue_terc

            FROM tbl15_historial_reasignacion_superior_gerarquico_cambio_rol h
            LEFT JOIN tbl15_administrador resp ON h.cod_usuario_responsable = resp.cod_administrador
            LEFT JOIN tbl15_administrador afec ON h.cod_usuario_afectado = afec.cod_administrador
            
            LEFT JOIN tbl15_seguridad rol_ant ON h.cod_rol_anterior = rol_ant.cod_seguridad
            LEFT JOIN tbl15_seguridad rol_nue ON h.cod_rol_nuevo = rol_nue.cod_seguridad
            
            LEFT JOIN tbl15_administrador sup_ant ON h.cod_superior_anterior = sup_ant.cod_administrador
            LEFT JOIN tbl15_administrador sup_nue ON h.cod_superior_nuevo = sup_nue.cod_administrador
            
            ORDER BY h.cod_historial_reasignacion_superior_gerarquico_cambio_rol DESC
            LIMIT 1000";

    $res = mysqli_query($conectar, $sql);
    $data = [];
    
    if($res) {
        while($row = mysqli_fetch_assoc($res)) {
            // Dar formato a responsable
            $responsable = trim($row['resp_nom'] . ' ' . $row['resp_ape']);
            if(empty($responsable)) $responsable = $row['resp_terc'];
            
            // Dar formato a afectado
            $afectado = trim($row['afec_nom'] . ' ' . $row['afec_ape']);
            if(empty($afectado)) $afectado = $row['afec_terc'];
            
            // Dar formato a superior anterior
            $superior_anterior = 'Ninguno';
            if(!empty($row['sup_ant_nom']) || !empty($row['sup_ant_terc'])) {
                $superior_anterior = trim($row['sup_ant_nom'] . ' ' . $row['sup_ant_ape']);
                if(empty($superior_anterior)) $superior_anterior = $row['sup_ant_terc'];
            }
            
            // Dar formato a superior nuevo
            $superior_nuevo = 'Ninguno';
            if(!empty($row['sup_nue_nom']) || !empty($row['sup_nue_terc'])) {
                $superior_nuevo = trim($row['sup_nue_nom'] . ' ' . $row['sup_nue_ape']);
                if(empty($superior_nuevo)) $superior_nuevo = $row['sup_nue_terc'];
            }
            
            $data[] = [
                'id_historial' => $row['id_historial'],
                'accion' => $row['nombre_tipo_reasignacion_usuario'],
                'cod_accion' => $row['cod_tipo_reasignacion_usuario'],
                'motivo' => !empty($row['motivo']) ? $row['motivo'] : 'Sin especificar',
                'descripcion' => $row['descripcion'],
                'fecha' => date("d/m/Y h:i A", strtotime($row['fecha_creacion'])),
                'responsable' => $responsable,
                'afectado' => $afectado,
                'afectado_doc' => !empty($row['afec_doc']) ? $row['afec_doc'] : 'Sin documento',
                'detalle_cambios' => [
                    'rol_anterior' => $row['rol_anterior_desc'],
                    'rol_nuevo' => $row['rol_nuevo_desc'],
                    'superior_anterior' => $superior_anterior,
                    'superior_nuevo' => $superior_nuevo
                ]
            ];
        }
    }
    
    echo json_encode(['success' => true, 'data' => $data]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Operación no válida']);
exit;
?>
