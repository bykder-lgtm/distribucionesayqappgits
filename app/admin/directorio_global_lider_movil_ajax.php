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
    
    $sql = "SELECT a.cod_administrador, a.nombres_apellidos_tercero, a.nombres, a.apellidos, a.cedula, a.telefono1_tercero, a.correo_tercero, a.cod_estado_activacion_usuario, a.cod_seguridad, s.nombre_seguridad,
    a.cuenta, a.cod_asesor, a.cod_coordinador, a.cod_lider, a.fecha_creacion, a.cod_tienda, a.direccion_tercero, a.barrio_tercero, a.nombre_tipo_identificacion, a.nombre_sexo, a.cod_departamento, a.cod_municipio,
    d.nombre_departamento as departamento, m.nombre_municipio as ciudad
    FROM tbl15_administrador a LEFT JOIN tbl15_seguridad s ON a.cod_seguridad = s.cod_seguridad 
    LEFT JOIN tbl15_departamento d ON a.cod_departamento = d.cod_departamento 
    LEFT JOIN tbl15_municipio m ON a.cod_municipio = m.cod_municipio 
    WHERE a.cod_administrador = '$id'";
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

if ($op == 'cargar_municipios') {
    $cod_dep = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $html = '<option value="">Seleccione Ciudad</option>';
    if($cod_dep > 0) {
        $sql_mun = "SELECT cod_municipio, nombre_municipio FROM tbl15_municipio WHERE cod_departamento = '$cod_dep' AND cod_estado = '1' ORDER BY nombre_municipio ASC";
        $res_mun = mysqli_query($conectar, $sql_mun);
        while($m = mysqli_fetch_assoc($res_mun)){
            $html .= '<option value="'.$m['cod_municipio'].'">'.$m['nombre_municipio'].'</option>';
        }
    }
    echo json_encode(['success' => true, 'html' => $html]);
    exit;
}

if ($op == 'editar_usuario') {
    $id = isset($_POST['edit_id']) ? intval($_POST['edit_id']) : 0;
    if($id <= 0) { echo json_encode(['success' => false, 'mensaje' => 'ID no válido']); exit; }
    
    // Obtenemos todos los campos del formulario
    $nombres_apellidos = isset($_POST['edit_nombre_completo']) ? mysqli_real_escape_string($conectar, $_POST['edit_nombre_completo']) : '';
    $nombres = isset($_POST['edit_nombres']) ? mysqli_real_escape_string($conectar, $_POST['edit_nombres']) : '';
    $apellidos = isset($_POST['edit_apellidos']) ? mysqli_real_escape_string($conectar, $_POST['edit_apellidos']) : '';
    
    $tipo_identificacion = isset($_POST['edit_tipo_identificacion']) ? mysqli_real_escape_string($conectar, $_POST['edit_tipo_identificacion']) : '';
    $cedula = isset($_POST['edit_cedula']) ? mysqli_real_escape_string($conectar, $_POST['edit_cedula']) : '';
    
    $telefono1 = isset($_POST['edit_telefono']) ? mysqli_real_escape_string($conectar, $_POST['edit_telefono']) : '';
    
    $correo = isset($_POST['edit_correo']) ? mysqli_real_escape_string($conectar, $_POST['edit_correo']) : '';
    $direccion = isset($_POST['edit_direccion']) ? mysqli_real_escape_string($conectar, $_POST['edit_direccion']) : '';
    $barrio = isset($_POST['edit_barrio']) ? mysqli_real_escape_string($conectar, $_POST['edit_barrio']) : '';
    $cod_departamento = isset($_POST['edit_departamento']) ? intval($_POST['edit_departamento']) : 0;
    $cod_municipio = isset($_POST['edit_ciudad']) ? intval($_POST['edit_ciudad']) : 0;
    
    $nombre_sexo = isset($_POST['edit_nombre_sexo']) ? mysqli_real_escape_string($conectar, $_POST['edit_nombre_sexo']) : '';
    
    $cuenta = isset($_POST['edit_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['edit_cuenta']) : '';
    $contrasena_nueva = isset($_POST['edit_contrasena']) ? mysqli_real_escape_string($conectar, $_POST['edit_contrasena']) : '';
    
    $rol = isset($_POST['edit_rol']) ? intval($_POST['edit_rol']) : 0;
    $estado = isset($_POST['edit_estado']) ? intval($_POST['edit_estado']) : 0;
    
    // Nombres en texto de dep y mun
    $nom_dep = ""; $nom_mun = "";
    if($cod_departamento > 0) {
        $rd = mysqli_query($conectar, "SELECT nombre_departamento FROM tbl15_departamento WHERE cod_departamento = '$cod_departamento'");
        if($f = mysqli_fetch_assoc($rd)) $nom_dep = $f['nombre_departamento'];
    }
    if($cod_municipio > 0) {
        $rm = mysqli_query($conectar, "SELECT nombre_municipio FROM tbl15_municipio WHERE cod_municipio = '$cod_municipio'");
        if($f = mysqli_fetch_assoc($rm)) $nom_mun = $f['nombre_municipio'];
    }

    // Preparar campos de actualización
    $update_fields = [
        "nombres_apellidos_tercero = UPPER('$nombres_apellidos')",
        "nombres = UPPER('$nombres')",
        "nombre1_tercero = UPPER('$nombres')",
        "apellidos = UPPER('$apellidos')",
        "apellido1_tercero = UPPER('$apellidos')",
        "nombre_tipo_identificacion = '$tipo_identificacion'",
        "cedula = '$cedula'",
        "identificacion_tercero = '$cedula'",
        "telefono1_tercero = '$telefono1'",
        "telefono = '$telefono1'",
        "correo_tercero = '$correo'",
        "correo = '$correo'",
        "direccion_tercero = UPPER('$direccion')",
        "barrio_tercero = UPPER('$barrio')",
        "cod_departamento = '$cod_departamento'",
        "cod_municipio = '$cod_municipio'",
        "departamento = UPPER('$nom_dep')",
        "ciudad = UPPER('$nom_mun')",
        "nombre_sexo = '$nombre_sexo'",
        "cuenta = '$cuenta'"
    ];
    
    if ($rol > 0) { $update_fields[] = "cod_seguridad = '$rol'"; }
    if ($estado > 0) { $update_fields[] = "cod_estado_activacion_usuario = '$estado'"; }
    
    if (!empty($contrasena_nueva)) {
        $contrasena_hash = sha1(strip_tags(stripslashes($contrasena_nueva)));
        $update_fields[] = "contrasena = '$contrasena_hash'";
    }

    $update_sql = implode(", ", $update_fields);
    
    $sql = "UPDATE tbl15_administrador SET $update_sql WHERE cod_administrador = '$id'";
    if(mysqli_query($conectar, $sql)){
        echo json_encode(['success' => true, 'mensaje' => 'Información actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar: ' . mysqli_error($conectar)]);
    }
    exit;
}
?>
