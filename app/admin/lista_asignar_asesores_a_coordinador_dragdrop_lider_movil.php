<?php 
$nombre_pagina          = "Asignación Drag & Drop";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_lider.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_lider.php"); ?>

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
/* ASIGNACION DRAG & DROP - TEMA PÚRPURA        */
/* ============================================ */

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
    min-height: 100vh;
    color: white;
}

.page-container {
    padding: 1.5rem;
    padding-bottom: 100px;
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

/* Header */
.page-header {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(139, 92, 246, 0.4);
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.page-header h1 {
    color: white;
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.page-header p {
    color: rgba(255,255,255,0.8);
    font-size: 0.95rem;
    position: relative;
    z-index: 1;
}

/* Franjas Drag & Drop */
.franja-sin-asignar {
    background: rgba(239, 68, 68, 0.05);
    border: 2px dashed rgba(239, 68, 68, 0.3);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2.5rem;
}

.franja-coordinadores {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    align-items: flex-start;
}

@media (max-width: 1200px) {
    .franja-coordinadores {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .franja-coordinadores {
        grid-template-columns: 1fr;
    }
}

.card-lista {
    background: rgba(139, 92, 246, 0.05);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 15px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.card-header-lista {
    padding: 1rem;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(139, 92, 246, 0.2);
}

.header-coordinator {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border-bottom-color: rgba(16, 185, 129, 0.2);
}

.zona-drop {
    padding: 1rem;
    min-height: 120px;
    background: rgba(0, 0, 0, 0.2);
    flex-grow: 1;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: flex-start;
    gap: 1rem;
}

.zona-drop-horizontal {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 1rem;
    min-height: 100px;
    padding: 0;
    background: transparent;
}

.item-dragg {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(79, 70, 229, 0.1) 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    padding: 0.75rem 1rem;
    border-radius: 10px;
    cursor: grab;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: transform 0.2s, box-shadow 0.2s;
    min-width: 250px;
    flex-grow: 1;
    max-width: 350px;
}

.item-dragg:active {
    cursor: grabbing;
}

.item-dragg:hover {
    box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    transform: translateY(-2px);
    border-color: #8b5cf6;
}

.item-movido {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(217, 119, 6, 0.1) 100%) !important;
    border-color: #f59e0b !important;
}
.item-movido .item-avatar {
    background: #f59e0b !important;
}

.item-avatar {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #8b5cf6;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
}

.item-info {
    flex: 1;
}

.item-name {
    font-weight: 600;
    font-size: 0.95rem;
    display: block;
}

.item-role {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.5);
    display: block;
}

.badge-count {
    background: rgba(255,255,255,0.2);
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.8rem;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-in { animation: fadeIn 0.4s ease-out; }
.delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }

</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Consulta de Asesores activos
// cod_seguridad = 22 (Asesor)
$sql_asesores = "SELECT cod_administrador, nombres, apellidos, nombres_apellidos_tercero, cod_coordinador FROM tbl15_administrador WHERE cod_seguridad = '22' ORDER BY nombres_apellidos_tercero ASC";
$res_asesores = mysqli_query($conectar, $sql_asesores);

$asesores_por_coordinador = [];
$asesores_no_asignados = [];

while($asesor = mysqli_fetch_assoc($res_asesores)) {
    $iniciales = '';
    if (!empty($asesor['nombres'])) { $iniciales = strtoupper(substr($asesor['nombres'], 0, 1)); }
    if (!empty($asesor['apellidos'])) { $iniciales .= strtoupper(substr($asesor['apellidos'], 0, 1)); }
    if (empty($iniciales)) { $iniciales = 'AS'; }
    $asesor['iniciales'] = $iniciales;

    $coord_id = $asesor['cod_coordinador'];
    if(empty($coord_id) || $coord_id == 0 || $coord_id == '') {
        $asesores_no_asignados[] = $asesor;
    } else {
        if(!isset($asesores_por_coordinador[$coord_id])) { $asesores_por_coordinador[$coord_id] = []; }
        $asesores_por_coordinador[$coord_id][] = $asesor;
    }
}
// Consulta de Coordinadores activos (cod_seguridad = 21)
// Si el sistema requiere filtrar por el líder logueado, se agregaría a la consulta. Asumo que el Lider ve a los Coordinadores activos.
$sql_coordinadores = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '21' ORDER BY nombres_apellidos_tercero ASC";
$res_coordinadores = mysqli_query($conectar, $sql_coordinadores);
?>

<main class="page-container">
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-arrows-up-down-left-right"></i> Asignación Interactiva</h1>
        <p>Arrastra y suelta a los asesores para asignarlos a un coordinador.</p>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;" class="animate-in">
        <h3 style="color: #ef4444; font-size: 1.3rem; margin: 0;"><i class="fa-solid fa-user-xmark"></i> Asesores Sin Coordinador Asignado</h3>
        <span class="badge-count" id="count-0" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; font-weight: bold; font-size: 1rem; padding: 0.3rem 1rem;"><?php echo count($asesores_no_asignados); ?></span>
    </div>
    
    <div class="franja-sin-asignar animate-in">
        <div class="zona-drop zona-drop-horizontal" data-id="0" id="lista-0">
            <?php foreach($asesores_no_asignados as $as): ?>
            <div class="item-dragg" data-user="<?php echo $as['cod_administrador']; ?>">
                <div class="item-avatar" style="background: #ef4444;"><?php echo $as['iniciales']; ?></div>
                <div class="item-info">
                    <span class="item-name"><?php echo utf8_encode($as['nombres_apellidos_tercero']); ?></span>
                    <span class="item-role">ID: <?php echo $as['cod_administrador']; ?></span>
                </div>
                <i class="fa-solid fa-grip-vertical" style="color: rgba(255,255,255,0.3);"></i>
            </div>
            <?php endforeach; ?>
            
            <div class="empty-msg" style="width: 100%; text-align: center; color: rgba(255,255,255,0.4); font-style: italic; padding: 1rem; <?php echo (count($asesores_no_asignados) > 0) ? 'display:none;' : ''; ?>">Todos los asesores están asignados. Arrastra aquí para quitar asignación.</div>
        </div>
    </div>

    <div style="margin-bottom: 1.5rem;" class="animate-in delay-1">
        <h3 style="color: #10b981; font-size: 1.3rem; margin: 0;"><i class="fa-solid fa-users-gear"></i> Coordinadores</h3>
        <p style="color: rgba(255,255,255,0.5); font-size: 0.9rem;">Arrastra aquí a los asesores para asignarlos al equipo del coordinador.</p>
    </div>

    <div class="franja-coordinadores animate-in delay-1">
        <?php while($coord = mysqli_fetch_assoc($res_coordinadores)): 
            $c_id = $coord['cod_administrador'];
            $asesores_esta_lista = isset($asesores_por_coordinador[$c_id]) ? $asesores_por_coordinador[$c_id] : [];
        ?>
        <div class="card-lista">
            <div class="card-header-lista header-coordinator">
                <div>
                    <i class="fa-solid fa-user-tie"></i> <?php echo utf8_encode($coord['nombres_apellidos_tercero']); ?>
                    <span style="font-size: 0.8rem; opacity: 0.7; margin-left: 0.5rem;">(ID: <?php echo $coord['cod_administrador']; ?>)</span>
                </div>
                <!-- El ID count-$c_id es usado en JS para actualizar el número -->
                <span class="badge-count" id="count-<?php echo $c_id; ?>" style="background: rgba(16, 185, 129, 0.2); color: #10b981; font-weight: bold;"><?php echo count($asesores_esta_lista); ?></span>
            </div>
            <div style="padding: 0.5rem 1rem; border-bottom: 1px solid rgba(139, 92, 246, 0.2); background: rgba(0,0,0,0.1);">
                <input type="text" class="buscador-asesor" data-target="lista-<?php echo $c_id; ?>" placeholder="Buscar asesor en equipo..." style="width: 100%; padding: 0.5rem; border-radius: 6px; border: 1px solid rgba(139, 92, 246, 0.3); background: rgba(255,255,255,0.05); color: white; outline: none; font-size: 0.85rem;">
            </div>
            <div class="zona-drop" data-id="<?php echo $c_id; ?>" id="lista-<?php echo $c_id; ?>">
                <?php foreach($asesores_esta_lista as $as): ?>
                <div class="item-dragg" data-user="<?php echo $as['cod_administrador']; ?>">
                    <div class="item-avatar"><?php echo $as['iniciales']; ?></div>
                    <div class="item-info">
                        <span class="item-name"><?php echo utf8_encode($as['nombres_apellidos_tercero']); ?></span>
                        <span class="item-role">ID: <?php echo $as['cod_administrador']; ?></span>
                    </div>
                    <i class="fa-solid fa-grip-vertical" style="color: rgba(255,255,255,0.3);"></i>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lógica del buscador de asesores por coordinador
        document.querySelectorAll('.buscador-asesor').forEach(input => {
            input.addEventListener('input', function(e) {
                let term = e.target.value.toLowerCase();
                let targetId = e.target.getAttribute('data-target');
                let targetZone = document.getElementById(targetId);
                let items = targetZone.querySelectorAll('.item-dragg');
                
                items.forEach(item => {
                    let name = item.querySelector('.item-name').innerText.toLowerCase();
                    if(name.indexOf(term) > -1) {
                        // Importante usar flex para que no se rompa la tarjeta
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        const zonasDrop = document.querySelectorAll('.zona-drop');
        
        zonasDrop.forEach(zona => {
            new Sortable(zona, {
                group: 'shared', animation: 150, ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    var itemEl = evt.item;  // El elemento que se acaba de arrastrar
                    
                    var toList = evt.to;    // Zona Drop a la que llegó
                    var fromList = evt.from; // Zona Drop de la que salió
                    
                    if (fromList !== toList) {
                        let id_asesor = itemEl.getAttribute('data-user');
                        let id_coordinador_nuevo = toList.getAttribute('data-id'); // 0 si es No Asignados
                        
                        // Actualizar contadores
                        document.getElementById('count-' + fromList.getAttribute('data-id')).innerText = fromList.querySelectorAll('.item-dragg').length;
                        document.getElementById('count-' + id_coordinador_nuevo).innerText = toList.querySelectorAll('.item-dragg').length;

                        // Además limpiar o mostrar msj de vacio si es la lista 0
                        let msgEmpty = document.querySelector('.empty-msg');
                        if (msgEmpty) {
                            if (document.getElementById('lista-0').querySelectorAll('.item-dragg').length == 0) { msgEmpty.style.display = 'block'; } else { msgEmpty.style.display = 'none'; }
                        }
                        // Petición AJAX (SweetAlert estilo loading)
                        /* Swal.fire({ title: 'Actualizando asignación...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); */
                        $.ajax({
                            url: 'procesar_asignar_asesores_a_coordinador_dragdrop_lider_ajax.php', type: 'POST', data: { accion: 'asignar_asesor_coordinador', id_asesor: id_asesor, id_coordinador: id_coordinador_nuevo }, dataType: 'json',
                            success: function(response) {
                                if(response.status == 'success') {
                                    itemEl.classList.add('item-movido'); // Resalta visualmente los elementos que fueron movidos
                                    Swal.fire({ title: '¡Asignación Exitosa!', text: response.message, icon: 'success', timer: 1500, showConfirmButton: false, toast: true, position: 'top-end' });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                    // Revert movimimento si hay error:
                                    // evt.from.appendChild(evt.item);
                                }
                            },
                            error: function() {
                                Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                            }
                        });
                    }
                }
            });
        });
    });
</script>
</body>
</html>
