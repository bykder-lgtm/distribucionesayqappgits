<?php 
$nombre_pagina          = "Registros Archivados";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_asesor.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_asesor.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($nombre) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ============================================ */
/* LISTA ARCHIVADOS ASESOR - EMERALD/GREEN     */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

.page-container {
    padding: 1rem;
    padding-bottom: 100px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.page-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}

.page-header h1 {
    color: white;
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: rgba(255,255,255,0.7);
    font-size: 0.95rem;
}

.search-bar {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.search-bar i { color: #9ca3af; }
.search-bar input {
    background: transparent;
    border: none;
    outline: none;
    color: white;
    width: 100%;
}

.tabs-container { display: flex; gap: 10px; margin-bottom: 1.5rem; background: rgba(255,255,255,0.05); padding: 5px; border-radius: 15px; }
.tab-btn { flex: 1; padding: 0.75rem; border: none; border-radius: 12px; background: transparent; color: rgba(255,255,255,0.6); font-weight: 700; cursor: pointer; transition: all 0.3s ease; }
.tab-btn.active { background: #10b981; color: white; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }

.archivados-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.archived-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 1.25rem;
    transition: all 0.3s ease;
    opacity: 0.8;
}

.archived-card:hover { opacity: 1; transform: translateY(-2px); background: rgba(255, 255, 255, 0.05); border-color: rgba(16, 185, 129, 0.3); }

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.card-info { flex: 1; }
.card-name { color: white; font-weight: 700; font-size: 1.1rem; }
.card-role { 
    font-size: 0.75rem; 
    color: rgba(255,255,255,0.5); 
    background: rgba(255,255,255,0.1); 
    padding: 0.2rem 0.5rem; 
    border-radius: 6px;
    text-transform: uppercase;
    font-weight: 800;
}

.card-status {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    padding: 0.3rem 0.6rem;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
}

.card-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1rem;
    font-size: 0.85rem;
}

.detail-item { color: rgba(255,255,255,0.6); }
.detail-item span { color: white; font-weight: 600; display: block; margin-top: 0.1rem; }

.card-actions {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    flex: 1;
    padding: 0.75rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin: 0;
}

.action-btn.restore { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
.action-btn.restore:hover { background: rgba(16, 185, 129, 0.2); transform: translateY(-2px); }

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: rgba(255,255,255,0.4);
}

.empty-state i { font-size: 4rem; margin-bottom: 1rem; }

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
}
.pagination-btn {
    background: rgba(255,255,255,0.05);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
}
.pagination-btn.active { background: #10b981; }

/* Role Colors */
.role-23 { border-left: 4px solid #8b5cf6; } /* Aliado */
.role-22 { border-left: 4px solid #3b82f6; } /* Asesor */
.role-21 { border-left: 4px solid #10b981; } /* Coordinador */
.role-2 { border-left: 4px solid #f59e0b; } /* Vendedor */
.role-27 { border-left: 4px solid #6366f1; } /* Revisor */

</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<main class="page-container">
    <div class="page-header">
        <h1><i class="fa-solid fa-box-archive"></i> Archivo</h1>
        <p>Registros archivados bajo tu gestión</p>
    </div>

    <?php
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'personas';
    $busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
    ?>

    <div class="tabs-container">
        <button class="tab-btn <?php echo ($tab == 'personas') ? 'active' : ''; ?>" onclick="window.location.href='?tab=personas&busqueda=<?php echo $busqueda; ?>'">
            <i class="fa-solid fa-users"></i> Personas
        </button>
        <button class="tab-btn <?php echo ($tab == 'tiendas') ? 'active' : ''; ?>" onclick="window.location.href='?tab=tiendas&busqueda=<?php echo $busqueda; ?>'">
            <i class="fa-solid fa-store"></i> Tiendas
        </button>
    </div>

    <div class="search-bar">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="searchInput" placeholder="Buscar..." value="<?php echo htmlspecialchars($busqueda); ?>" onkeyup="filtrar(this.value)">
    </div>

    <?php
    $registros_por_pagina = 15;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina <= 0) $pagina = 1;
    $inicio = ($pagina - 1) * $registros_por_pagina;

    if ($tab == 'personas') {
        // Personas (tbl15_administrador)
        $where = "WHERE (a.cod_estado = 0 OR a.cod_estado_activacion_usuario = 3) AND (a.cod_aliado_estrategico = '$cod_administrador')";
        if (!empty($busqueda)) { $where .= " AND (a.nombres_apellidos_tercero LIKE '%$busqueda%' OR a.cedula LIKE '%$busqueda%' OR a.nombres LIKE '%$busqueda%' OR a.apellidos LIKE '%$busqueda%')"; }
        
        $sql_total = "SELECT COUNT(*) as total FROM tbl15_administrador a $where";
        $res_total = mysqli_query($conectar, $sql_total);
        $total_reg = mysqli_fetch_assoc($res_total)['total'];
        
        $sql = "SELECT a.* FROM tbl15_administrador a $where ORDER BY a.fecha_creacion DESC LIMIT $inicio, $registros_por_pagina";
    } else {
        // Tiendas (tbl15_tienda)
        $where = "WHERE t.cod_estado = 0 AND t.cod_aliado_estrategico = '$cod_administrador'";
        if (!empty($busqueda)) { $where .= " AND (t.nombre_tienda LIKE '%$busqueda%' OR t.identificacion_tercero LIKE '%$busqueda%' OR t.nombre1_tercero LIKE '%$busqueda%')"; }
        
        $sql_total = "SELECT COUNT(*) as total FROM tbl15_tienda t $where";
        $res_total = mysqli_query($conectar, $sql_total);
        $total_reg = mysqli_fetch_assoc($res_total)['total'];
        
        $sql = "SELECT t.* FROM tbl15_tienda t $where ORDER BY t.fecha_creacion DESC LIMIT $inicio, $registros_por_pagina";
    }
    
    $total_paginas = ceil($total_reg / $registros_por_pagina);
    $resultado = mysqli_query($conectar, $sql);
    ?>

    <div class="archivados-list">
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($resultado)): 
                if ($tab == 'personas') {
                    $role_name = "Desconocido";
                    if ($row['cod_seguridad'] == '23') $role_name = "Aliado";
                    elseif ($row['cod_seguridad'] == '22') $role_name = "Asesor";
                    elseif ($row['cod_seguridad'] == '21') $role_name = "Coordinador";
                    elseif ($row['cod_seguridad'] == '2') $role_name = "Vendedor";
                    elseif ($row['cod_seguridad'] == '27') $role_name = "Revisor";
                    elseif ($row['cod_seguridad'] == '20') $role_name = "Líder";
                    
                    $display_name = $row['nombres_apellidos_tercero'] ?: ($row['nombres'].' '.$row['apellidos']);
                    $display_id = $row['cedula'];
                    $display_sub = $role_name;
                    $cod_item = $row['cod_administrador'];
                    $type_restore = 'persona';
                } else {
                    $display_name = $row['nombre_tienda'];
                    $display_id = $row['identificacion_tercero'];
                    $display_sub = "Tienda";
                    $cod_item = $row['cod_tienda'];
                    $type_restore = 'tienda';
                }
            ?>
            <div class="archived-card <?php echo $tab == 'personas' ? 'role-'.$row['cod_seguridad'] : 'role-23'; ?>">
                <div class="card-header">
                    <div class="card-info">
                        <div class="card-name"><?php echo ucwords(strtolower($display_name)); ?></div>
                        <span class="card-role"><?php echo $display_sub; ?></span>
                    </div>
                    <span class="card-status">Archivado</span>
                </div>
                
                <div class="card-details">
                    <div class="detail-item"><?php echo ($tab == 'personas' ? 'Cédula:' : 'NIT/ID:'); ?> <span><?php echo $display_id; ?></span></div>
                    <?php if ($tab == 'personas'): ?>
                        <div class="detail-item">Teléfono: <span><?php echo $row['telefono'] ?: 'N/A'; ?></span></div>
                        <div class="detail-item">Usuario: <span><?php echo $row['cuenta']; ?></span></div>
                    <?php else: ?>
                        <div class="detail-item">Teléfono: <span><?php echo $row['telefono1_tercero'] ?: 'N/A'; ?></span></div>
                        <div class="detail-item">Correo: <span style="font-size: 0.7rem;"><?php echo strtolower($row['correo_tercero']); ?></span></div>
                    <?php endif; ?>
                    <div class="detail-item">Creación: <span><?php echo !empty($row['fecha_creacion']) ? date('d/m/Y', strtotime($row['fecha_creacion'])) : 'N/A'; ?></span></div>
                </div>

                <div class="card-actions">
                    <button class="action-btn restore" onclick="recuperarEntidad(<?php echo $cod_item; ?>, '<?php echo addslashes($display_name); ?>', '<?php echo $type_restore; ?>')">
                        <i class="fa-solid fa-rotate-left"></i> Recuperar
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-box-open"></i>
                <h3>No hay <?php echo ($tab == 'personas' ? 'personas' : 'tiendas'); ?> archivadas</h3>
                <p>No se encontraron resultados para tu búsqueda</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($total_paginas > 1): ?>
    <div class="pagination-container">
        <?php for($i=1; $i<=$total_paginas; $i++): ?>
            <a href="?tab=<?php echo $tab; ?>&pagina=<?php echo $i; ?>&busqueda=<?php echo $busqueda; ?>" class="pagination-btn <?php echo ($i == $pagina) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</main>

<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
function filtrar(val) {
    if (val.length > 2 || val.length == 0) {
        window.location.href = 'lista_archivados_asesor_movil.php?tab=<?php echo $tab; ?>&busqueda=' + val;
    }
}

function recuperarEntidad(cod, nombre, tipo) {
    Swal.fire({
        title: '¿Recuperar ' + (tipo == 'tienda' ? 'tienda' : 'persona') + '?', text: "El registro de " + nombre + " volverá a estar activo en el sistema.", icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#374151', confirmButtonText: 'Sí, recuperar', cancelButtonText: 'Cancelar', background: '#1a1f2e', color: 'white'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'proceso_recuperar_entidad_lider_movil_ajax.php', type: 'POST', data: { cod_administrador: cod, tipo_entidad: tipo }, dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: 'Recuperado', text: response.message, background: '#1a1f2e', color: 'white' }).then(() => { location.reload(); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message, background: '#1a1f2e', color: 'white' });
                    }
                }
            });
        }
    });
}
</script>
</body>
</html>
