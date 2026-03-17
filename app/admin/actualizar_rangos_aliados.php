<?php
include_once(__DIR__ . '/../conexiones/conexione.php');
date_default_timezone_set("America/Bogota");

// Función auxiliar para evaluar condiciones como ">= 1 AND <= 3", "= 2", ">= 11"
function evaluarCondicion($valor, $condicion) {
    if (empty($condicion)) return false;
    $condicion = trim($condicion);
    
    // Convertir de DB formato a validacion de sintaxis estricta si es necesario
    // Si solo hay un número en BD (por ejemplo "2" en vez de "= 2"), considerarlo como igual
    if (is_numeric($condicion)) {
        return $valor == floatval($condicion);
    }
    
    // Separamos la condición por AND si existe un rango
    $partes = explode(' AND ', strtoupper($condicion));
    foreach ($partes as $parte) {
        $parte = trim($parte);
        // Expresión regular para detectar operadores permitidos (> | < | >= | <= | =)
        if (preg_match('/^(>=|<=|>|<|=)\s*(\d+(\.\d+)?)$/', $parte, $matches)) {
            $op = trim($matches[1]);
            $num = floatval($matches[2]);
            
            if ($op == '>=' && !($valor >= $num)) return false;
            if ($op == '<=' && !($valor <= $num)) return false;
            if ($op == '>'  && !($valor > $num))  return false;
            if ($op == '<'  && !($valor < $num))  return false;
            if ($op == '='  && !($valor == $num)) return false;
        } else {
            // Si la condición de base de datos no es procesable, lo damos por falso
            return false;
        }
    }
    return true; // Si ha superado todas las condiciones parciales
}

// Esta función evalúa y actualiza los rangos de todos los aliados
function actualizarRangosAliados($conectar) {
    echo "Iniciando la actualización dinámica de rangos de aliados...<br>\n";
    $fecha_actual = date("Y-m-d H:i:s");
    
    // 1. Cargar reglas dinámicas de la base de datos (con cod_estado = 1)
    // Se ordena de forma descendente en el cod_tipo_aliado para dar prioridad a los estatus inactivos (por ejemplo Inactivo > Dormido)
    $sql_rangos = "SELECT cod_tipo_aliado, medida_condicional, condicional_tipo_aliado, nombre_tipo_aliado FROM tbl15_tipo_aliado WHERE cod_estado = '1' ORDER BY cod_tipo_aliado DESC";
    $res_rangos = mysqli_query($conectar, $sql_rangos);
    
    $reglas_meses = array();
    $reglas_ventas = array();
    
    while ($row = mysqli_fetch_assoc($res_rangos)) {
        $medida = strtoupper(trim($row['medida_condicional']));
        if ($medida == 'MESES') { $reglas_meses[] = $row; } elseif ($medida == 'VENTAS') { $reglas_ventas[] = $row; }
    }
    
    // 2. Obtenemos todos los aliados
    $sql_aliados = "SELECT cod_administrador, fecha_creacion, cod_tipo_aliado as rango_actual FROM tbl15_administrador WHERE cod_tipo_tercero = '13'"; // ALIADO_ESTRATEGICO
    $res_aliados = mysqli_query($conectar, $sql_aliados);
    
    $total_actualizados = 0;
    
    while ($aliado = mysqli_fetch_assoc($res_aliados)) {
        $cod_aliado = $aliado['cod_administrador'];
        $fecha_registro = $aliado['fecha_creacion'];
        if (empty($fecha_registro) || $fecha_registro == '0000-00-00 00:00:00') {
            $fecha_registro = date("Y-m-d 00:00:00", strtotime("-1 days"));
        }
        
        // Obtener la fecha de la última venta
        $sql_ultima_venta = "SELECT MAX(fecha_ymdhis) as ultima_fecha FROM tbl15_info_factura_venta WHERE cod_administrador_aliado_estrategico = '$cod_aliado' AND cod_estado_factura = 1";
        $res_ultima_venta = mysqli_query($conectar, $sql_ultima_venta);
        $data_ultima_venta = mysqli_fetch_assoc($res_ultima_venta);
        $fecha_ultima_venta = $data_ultima_venta['ultima_fecha'];
        
        // Obtener el número de ventas en los últimos 30 días
        $fecha_hace_un_mes = date("Y-m-d H:i:s", strtotime("-1 month"));
        $sql_ventas_mes = "SELECT COUNT(cod_info_factura_venta) as total_ventas_mes FROM tbl15_info_factura_venta WHERE cod_administrador_aliado_estrategico = '$cod_aliado' AND cod_estado_factura = 1 AND fecha_ymdhis >= '$fecha_hace_un_mes'";
        $res_ventas_mes = mysqli_query($conectar, $sql_ventas_mes);
        $data_ventas_mes = mysqli_fetch_assoc($res_ventas_mes);
        $ventas_mes_actual = intval($data_ventas_mes['total_ventas_mes']);
        
        // Calcular los meses sin vender
        $meses_sin_vender = 0;
        $meses_desde_registro = 0;
        
        // Calcular meses desde registro (aproximación)
        $d1_reg = new DateTime($fecha_registro);
        $d2_curr = new DateTime($fecha_actual);
        $interval_reg = $d1_reg->diff($d2_curr);
        $meses_desde_registro = ($interval_reg->y * 12) + $interval_reg->m;

        if (!empty($fecha_ultima_venta) && $fecha_ultima_venta != '0000-00-00 00:00:00') {
            $d1 = new DateTime($fecha_ultima_venta);
            $d2 = new DateTime($fecha_actual);
            $interval = $d1->diff($d2);
            $meses_sin_vender = ($interval->y * 12) + $interval->m;
        } else {
            // Si nunca ha vendido, asumimos que los "meses sin vender" son igual a los meses desde su registro
            $meses_sin_vender = $meses_desde_registro;
        }
        // 3. Evaluar reglas de negocio mediante BD
        $nuevo_rango = 0;
        $rango_encontrado = false;
        
        // Primero evaluar inactividad (Reglas de MESES)
        foreach ($reglas_meses as $regla) {
            if (evaluarCondicion($meses_sin_vender, $regla['condicional_tipo_aliado'])) {
                $nuevo_rango = $regla['cod_tipo_aliado'];
                $rango_encontrado = true;
                break; // Se detiene al encontrar uno, gracias al ORDER BY DESC, probaría primero Inactivo (7) que Dormido (6)
            }
        }
        // Si no cumple reglas de inactividad, evaluar volumen de ventas en el último mes (Reglas de VENTAS)
        if (!$rango_encontrado) {
            foreach ($reglas_ventas as $regla) {
                if (evaluarCondicion($ventas_mes_actual, $regla['condicional_tipo_aliado'])) {
                    $nuevo_rango = $regla['cod_tipo_aliado'];
                    $rango_encontrado = true;
                    break;
                }
            }
        }
        // 4. Fallbacks dinámicos en caso de que un usuario no corresponda estrictamente a parámetros registrados
        if (!$rango_encontrado) {
            if ($fecha_ultima_venta === null) {
                // Nuevo Prospecto: No ha vendido nunca, ni supera la marca de meses mínimos registrados (porque validó inactividad primero)
                $nuevo_rango = 1; 
            } else {
                // Nuevo / Recaída: Ha vendido en alguna ocasión, no llega al rango mínimo de ventas mensual exigido ni tampoco ha demorado los meses suficientes como para "DORMIDO"
                $nuevo_rango = 2; 
            }
        }
        // 5. Solo actualizar si el rango cambia, para mejorar performance
        if ($nuevo_rango != intval($aliado['rango_actual'])) {
            $sql_update = "UPDATE tbl15_administrador SET cod_tipo_aliado = '$nuevo_rango' WHERE cod_administrador = '$cod_aliado'";
            if (mysqli_query($conectar, $sql_update)) {
                $total_actualizados++;
            }
        }
    }
    echo "Actualización completada. Total de aliados actualizados: " . $total_actualizados . "<br>\n";
}
// Ejecutar si se llama directamente mediante GET o CLI
if ((isset($_GET['ejecutar']) && $_GET['ejecutar'] == 'si') || php_sapi_name() === 'cli') {
    actualizarRangosAliados($conectar);
} else {
    echo "Haga clic <a href='?ejecutar=si'>aquí</a> para actualizar los rangos de los aliados manualmente dinámicamente.<br>";
}
?>
