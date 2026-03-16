<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$op = isset($_POST['op']) ? $_POST['op'] : '';

if ($op == 'buscar_directorio') {
    $term       = isset($_POST['term']) ? trim(addslashes($_POST['term'])) : '';
    $cod_rol    = isset($_POST['cod_rol']) ? intval($_POST['cod_rol']) : 0;
    $cod_estado = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 0;
    $limit      = isset($_POST['limit']) ? intval($_POST['limit']) : 20;
    $offset     = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    
    // Solo mostramos roles que puedan estar en la red (excluyendo roles admin absolutos si es necesario, 
    // pero como el líder busca, le mostramos todos o según su jerarquía).
    // Aquí la búsqueda abarca todos por solicitud del usuario (directorio global).
    
    $where_clauses = ["1=1"];
    
    if ($term !== '') {
        $where_clauses[] = "(a.nombres_apellidos_tercero LIKE '%$term%' OR a.cedula LIKE '%$term%' OR a.correo_tercero LIKE '%$term%' OR a.telefono1_tercero LIKE '%$term%' OR a.cod_administrador = '$term')";
    }
    
    if ($cod_rol > 0) {  $where_clauses[] = "a.cod_seguridad = '$cod_rol'"; }
    if ($cod_estado > 0) { $where_clauses[] = "a.cod_estado_activacion_usuario = '$cod_estado'"; }
    
    $where_sql = implode(" AND ", $where_clauses);
    // Consulta principal
    // Traemos también información del nivel superior: Asesor (id), Coordinador (id), Lider (id) y cod_tienda
    $sql = "SELECT a.cod_administrador, a.nombres_apellidos_tercero, a.cedula, a.telefono1_tercero, a.correo_tercero, 
            a.cod_estado_activacion_usuario, a.cod_seguridad, s.nombre_seguridad, a.cod_asesor, a.cod_coordinador, a.cod_lider, a.cod_tienda
            FROM tbl15_administrador a LEFT JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad
            WHERE $where_sql ORDER BY a.nombres_apellidos_tercero ASC LIMIT $limit OFFSET $offset";
            
    $res = mysqli_query($conectar, $sql);
    $data = [];
    
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            // Determinar superior en función del rol
            $superior = "Sin Asignar";
            $nombre_rol = strtoupper($row['nombre_seguridad']);
            
            // Función rápida para obtener nombre de un superior
            $get_sup_name = function($cod) use ($conectar) {
                if($cod > 0) {
                    $res_sup = mysqli_query($conectar, "SELECT nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod'");
                    if($r = mysqli_fetch_assoc($res_sup)) return $r['nombres_apellidos_tercero'];
                }
                return "";
            };

            // Función para obtener el aliado basado en cod_tienda
            $get_aliado_by_tienda = function($cod_tienda) use ($conectar) {
                if($cod_tienda > 0) {
                    $res_al = mysqli_query($conectar, "SELECT a.nombres_apellidos_tercero FROM tbl15_administrador a INNER JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad WHERE a.cod_tienda = '$cod_tienda' AND s.nombre_seguridad LIKE '%ALIADO%' LIMIT 1");
                    if($r = mysqli_fetch_assoc($res_al)) return $r['nombres_apellidos_tercero'];
                }
                return "";
            };
            
            if (strpos($nombre_rol, 'VENDEDOR') !== false && $row['cod_tienda'] > 0) {
                $sup = $get_aliado_by_tienda($row['cod_tienda']);
                if($sup) $superior = $sup . " (Aliado)";
            } elseif (strpos($nombre_rol, 'ALIADO') !== false && $row['cod_asesor'] > 0) {
                $sup = $get_sup_name($row['cod_asesor']);
                if($sup) $superior = $sup . " (Asesor)";
            } elseif (strpos($nombre_rol, 'ASESOR') !== false && $row['cod_coordinador'] > 0) {
                $sup = $get_sup_name($row['cod_coordinador']);
                if($sup) $superior = $sup . " (Coordinador)";
            } elseif (strpos($nombre_rol, 'COORDINADOR') !== false && $row['cod_lider'] > 0) {
                $sup = $get_sup_name($row['cod_lider']);
                if($sup) $superior = $sup . " (Líder)";
            }
            
            $data[] = [
                'id' => $row['cod_administrador'],
                'nombre_completo' => $row['nombres_apellidos_tercero'],
                'cedula' => $row['cedula'],
                'telefono' => $row['telefono1_tercero'],
                'correo' => $row['correo_tercero'],
                'estado_numero' => $row['cod_estado_activacion_usuario'],
                'rol_id' => $row['cod_seguridad'],
                'rol_nombre' => $row['nombre_seguridad'],
                'superior' => $superior
            ];
        }
        
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error en consulta general: ' . mysqli_error($conectar)]);
    }
    exit;
}

if ($op == 'obtener_detalle') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    $sql = "SELECT a.cod_administrador, a.nombres_apellidos_tercero, a.nombres, a.apellidos, a.cedula, a.telefono1_tercero, a.telefono2_tercero, a.correo_tercero, a.cod_estado_activacion_usuario, a.cod_seguridad, s.nombre_seguridad,
    a.cuenta, a.cod_asesor, a.cod_coordinador, a.cod_lider, a.fecha_creacion, a.cod_tienda, a.direccion_tercero, a.barrio_tercero, a.nombre_tipo_identificacion, a.nombre_sexo, a.fecha_nac_tercero, a.departamento, a.ciudad, a.url_redsocial_facebook, a.url_redsocial_twitter, a.url_redsocial_linkedin, a.url_redsocial_skype
    FROM tbl15_administrador a LEFT JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad WHERE a.cod_administrador = '$id'";
    $res = mysqli_query($conectar, $sql);
    if($res && mysqli_num_rows($res) > 0) {
        $data = mysqli_fetch_assoc($res);
        
        // Superior
        $superior = "Sin Asignar";
        $get_sup_name = function($cod) use ($conectar) {
            if($cod > 0) {
                $res_sup = mysqli_query($conectar, "SELECT nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod'");
                if($r = mysqli_fetch_assoc($res_sup)) return $r['nombres_apellidos_tercero'];
            }
            return "";
        };

        $get_aliado_by_tienda = function($cod_tienda) use ($conectar) {
            if($cod_tienda > 0) {
                $res_al = mysqli_query($conectar, "SELECT a.nombres_apellidos_tercero FROM tbl15_administrador a INNER JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad WHERE a.cod_tienda = '$cod_tienda' AND s.nombre_seguridad LIKE '%ALIADO%' LIMIT 1");
                if($r = mysqli_fetch_assoc($res_al)) return $r['nombres_apellidos_tercero'];
            }
            return "";
        };

        $nombre_rol = strtoupper($data['nombre_seguridad']);
        if (strpos($nombre_rol, 'VENDEDOR') !== false && $data['cod_tienda'] > 0) {
            $sup = $get_aliado_by_tienda($data['cod_tienda']); if($sup) $superior = $sup . " (Aliado)";
        } elseif (strpos($nombre_rol, 'ALIADO') !== false && $data['cod_asesor'] > 0) {
            $sup = $get_sup_name($data['cod_asesor']); if($sup) $superior = $sup . " (Asesor)";
        } elseif (strpos($nombre_rol, 'ASESOR') !== false && $data['cod_coordinador'] > 0) {
            $sup = $get_sup_name($data['cod_coordinador']); if($sup) $superior = $sup . " (Coordinador)";
        } elseif (strpos($nombre_rol, 'COORDINADOR') !== false && $data['cod_lider'] > 0) {
            $sup = $get_sup_name($data['cod_lider']); if($sup) $superior = $sup . " (Líder)";
        }
        $data['superior'] = $superior;

        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Usuario no encontrado']);
    }
    exit;
}

if ($op == 'editar_usuario') {
    $cod_administrador = isset($_POST['cod_administrador']) ? intval($_POST['cod_administrador']) : 0;
    if($cod_administrador <= 0) { echo json_encode(['success' => false, 'mensaje' => 'ID no válido']); exit; }

    $nombres_apellidos_tercero  = trim(addslashes($_POST['nombres_apellidos_tercero']));
    $cedula                     = trim(addslashes($_POST['cedula']));
    $telefono1_tercero          = trim(addslashes($_POST['telefono1_tercero']));
    $correo_tercero             = trim(addslashes($_POST['correo_tercero']));
    $cod_seguridad              = intval($_POST['cod_seguridad']);
    $cod_estado                 = intval($_POST['cod_estado_activacion_usuario']);

    // Separa primer nombre y primer apellido asumiendo formato básico,
    // o simplemente actualizamos las columnas básicas comunes.
    $partes = explode(' ', $nombres_apellidos_tercero);
    $nombre1 = isset($partes[0]) ? $partes[0] : '';
    $apellido1 = isset($partes[1]) ? $partes[1] : '';

    $cuenta                     = isset($_POST['cuenta']) ? trim(addslashes($_POST['cuenta'])) : '';
    $direccion_tercero          = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio_tercero             = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $nombre_tipo_identificacion = isset($_POST['nombre_tipo_identificacion']) ? trim(addslashes($_POST['nombre_tipo_identificacion'])) : '';

    $sql = "UPDATE tbl15_administrador SET 
    nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'),
    nombres = UPPER('$nombre1'),
    nombre1_tercero = UPPER('$nombre1'),
    apellidos = UPPER('$apellido1'),
    apellido1_tercero = UPPER('$apellido1'),
    cedula = '$cedula',
    identificacion_tercero = '$cedula',
    telefono = '$telefono1_tercero',
    telefono1_tercero = '$telefono1_tercero',
    correo = '$correo_tercero',
    correo_tercero = '$correo_tercero',
    cod_seguridad = '$cod_seguridad',
    cod_estado_activacion_usuario = '$cod_estado',
    cuenta = '$cuenta',
    direccion_tercero = UPPER('$direccion_tercero'),
    barrio_tercero = UPPER('$barrio_tercero'),
    nombre_tipo_identificacion = UPPER('$nombre_tipo_identificacion')
    WHERE cod_administrador = '$cod_administrador'";
    if(mysqli_query($conectar, $sql)){
        echo json_encode(['success' => true, 'mensaje' => 'Información actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar base de datos: ' . mysqli_error($conectar)]);
    }
    exit;
}
?>
