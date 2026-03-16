<?php 
$nombre_pagina          = "Asignación Masiva";
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
<!-- Bootstrap CSS (Como en el demo) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* ============================================ */
/* ASIGNACION MASIVA - TEMA PÚRPURA              */
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
    padding-bottom: 100px; /* Espacio para el menu inferior */
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

/* Tabla oscura adaptada a Bootstrap */
.card-table {
    background: rgba(139, 92, 246, 0.05);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 15px;
    overflow: hidden;
}

.table {
    margin-bottom: 0;
    color: #ffffff !important;
}

.table-dark {
    background-color: rgba(139, 92, 246, 0.3) !important;
    --bs-table-bg: transparent;
    --bs-table-color: #ffffff;
    --bs-table-border-color: rgba(139, 92, 246, 0.2);
}

.table-hover tbody tr:hover td {
    background-color: rgba(139, 92, 246, 0.2) !important;
    color: #ffffff !important;
    cursor: pointer;
}

.table td, .table th {
    border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    padding: 1rem;
    vertical-align: middle;
    color: #ffffff !important; /* Force white text */
}

.table tbody td {
    background: transparent;
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
    margin-right: 15px;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-in { animation: fadeIn 0.4s ease-out; }
.delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }

/* Custom Checkbox */
.form-check-input {
    background-color: rgba(255,255,255,0.1);
    border-color: rgba(139, 92, 246, 0.5);
    width: 1.25em;
    height: 1.25em;
    cursor: pointer;
}
.form-check-input:checked {
    background-color: #8b5cf6;
    border-color: #8b5cf6;
}

.swal2-container {
    z-index: 9999 !important;
}

/* Fix Bootstrap forms inside Swal */
.swal2-html-container .form-select {
    padding: 0.75rem;
    font-size: 1rem;
    border-radius: 8px;
    margin-top: 15px;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>

<?php
// Consulta de Líderes activos para el Select Picker (cod_seguridad = 20)
$sql_lideres = "SELECT cod_administrador, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_seguridad = '20' AND cod_estado != '0' ORDER BY nombres_apellidos_tercero ASC";
$res_lideres = mysqli_query($conectar, $sql_lideres);
$lista_lideres = [];
while($row = mysqli_fetch_assoc($res_lideres)){ $lista_lideres[] = $row; }
// Opciones HTML para el select de SweetAlert
$opciones_lideres_html = '<option value="" selected disabled>-- Seleccione el nuevo líder --</option>';
$opciones_lideres_html .= '<option value="0">-- Desasignar Líder (Quitar asignación) --</option>';
foreach ($lista_lideres as $l) { $opciones_lideres_html .= '<option value="'.$l['cod_administrador'].'">'.$l['nombres_apellidos_tercero'].' (ID: '.$l['cod_administrador'].')</option>'; }
// Consulta de Coordinadores (cod_seguridad = 21)
// Hacemos un JOIN consigo misma para traer nombre del lider, si lo tiene.
$sql_coordinadores = "
SELECT c.cod_administrador, c.nombres, c.apellidos, c.nombres_apellidos_tercero, c.cod_lider, IFNULL(l.nombres_apellidos_tercero, 'Sin Asignar') as nombre_lider_actual
FROM tbl15_administrador c LEFT JOIN tbl15_administrador l ON c.cod_lider = l.cod_administrador WHERE c.cod_seguridad = '21' ORDER BY c.nombres_apellidos_tercero ASC";
$res_coordinadores = mysqli_query($conectar, $sql_coordinadores);
?>

<main class="page-container">
    <div class="page-header animate-in">
        <h1><i class="fa-solid fa-layer-group"></i> Asignación Masiva: Coord. a Líder</h1>
        <p>Selecciona varios coordinadores para asignarlos a un líder simultáneamente.</p>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-3 animate-in delay-1">
        <h4 class="mb-0 text-white" style="font-size: 1.25rem;"><i class="fa-solid fa-list-check"></i> Listado de Coordinadores</h4>
        <button class="btn btn-warning shadow-sm" id="btn-reasignar" disabled style="background: #f59e0b; border: none; color: white; font-weight: 600; border-radius: 10px; padding: 0.5rem 1.25rem; transition: all 0.2s;">
            <i class="fa-solid fa-bolt"></i> Asignar Seleccionados (<span id="count">0</span>)
        </button>
    </div>

    <div class="mb-3 animate-in delay-1">
        <div class="input-group">
            <span class="input-group-text" style="background: rgba(139, 92, 246, 0.2); border: 1px solid rgba(139, 92, 246, 0.4); border-right: none; color: #a78bfa;"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" id="buscador-coordinadores" class="form-control text-white shadow-none" placeholder="Buscar por nombre o ID del coordinador..." style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.4); border-left: none;">
        </div>
    </div>

    <div class="card-table animate-in delay-1">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tabla_coordinadores">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">
                            <input class="form-check-input" type="checkbox" id="check-all">
                        </th>
                        <th scope="col" style="min-width: 80px;">ID</th>
                        <th scope="col" style="min-width: 250px;">Coordinador</th>
                        <th scope="col" style="min-width: 250px;">Líder Actual</th>
                        <th scope="col" class="text-center" style="min-width: 100px;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while($co = mysqli_fetch_assoc($res_coordinadores)): 
                        $iniciales = '';
                        if (!empty($co['nombres'])) { $iniciales = strtoupper(substr($co['nombres'], 0, 1)); }
                        if (!empty($co['apellidos'])) { $iniciales .= strtoupper(substr($co['apellidos'], 0, 1)); }
                        if (empty($iniciales)) { $iniciales = 'CO'; }
                        
                        $sin_lider = ($co['cod_lider'] == '0' || empty($co['cod_lider']));
                    ?>
                    <tr data-id="<?php echo $co['cod_administrador']; ?>">
                        <td class="text-center">
                            <input class="form-check-input chk-item" type="checkbox" value="<?php echo $co['cod_administrador']; ?>">
                        </td>
                        <td style="color: rgba(255,255,255,0.7) !important; font-size: 0.9rem;">#<?php echo $co['cod_administrador']; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="item-avatar" style="<?php echo $sin_lider ? 'background: #ef4444;' : ''; ?>">
                                    <?php echo $iniciales; ?>
                                </div>
                                <div class="fw-bold" style="font-size: 0.95rem;"><?php 
                                    $nombre_completo = trim($co['nombres'] . ' ' . $co['apellidos']);
                                    if(empty($nombre_completo) && !empty($co['nombres_apellidos_tercero'])){ $nombre_completo = $co['nombres_apellidos_tercero']; }
                                    echo $nombre_completo; 
                                ?></div>
                            </div>
                        </td>
                        <td class="lider-actual">
                            <?php if($sin_lider): ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1"><i class="fa-solid fa-user-xmark"></i> Sin Asignar</span>
                            <?php else: ?>
                                <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-weight: 500; font-size: 0.85rem; padding: 0.4rem 0.6rem;">
                                    <i class="fa-solid fa-user-tie"></i> <?php echo $co['nombre_lider_actual']; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($sin_lider): ?>
                                <span style="color: #ef4444; font-size: 1.2rem;" title="Requiere asignación"><i class="fa-solid fa-circle-exclamation"></i></span>
                            <?php else: ?>
                                <span style="color: #10b981; font-size: 1.2rem;" title="Asignado"><i class="fa-solid fa-circle-check"></i></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_lider_movil.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        function updateCount() {
            let count = document.querySelectorAll('.chk-item:checked').length;
            document.getElementById('count').innerText = count;
            
            let btn = document.getElementById('btn-reasignar');
            if (count > 0) {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.transform = 'scale(1.05)';
                setTimeout(() => { btn.style.transform = 'scale(1)'; }, 200);
            } else {
                btn.disabled = true;
                btn.style.opacity = '0.7';
            }
        }

        document.getElementById('check-all').addEventListener('change', function() {
            let checked = this.checked;
            document.querySelectorAll('.chk-item').forEach(checkbox => {
                checkbox.checked = checked;
            });
            updateCount();
        });

        document.querySelectorAll('.chk-item').forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                updateCount();
                let allChecked = document.querySelectorAll('.chk-item:checked').length === document.querySelectorAll('.chk-item').length;
                document.getElementById('check-all').checked = allChecked;
            });
        });

        // Buscador en tiempo real
        document.getElementById('buscador-coordinadores').addEventListener('input', function() {
            let term = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tabla_coordinadores tbody tr');
            
            rows.forEach(row => {
                let textContent = row.innerText.toLowerCase();
                if(textContent.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Al hacer click en la fila se marca el checkbox (excepto si hizo click en el checkbox mismo u otro control)
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', function(e) {
                if(e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON') {
                    let checkbox = this.querySelector('.chk-item');
                    checkbox.checked = !checkbox.checked;
                    // Trigger custom
                    updateCount();
                    let allChecked = document.querySelectorAll('.chk-item:checked').length === document.querySelectorAll('.chk-item').length;
                    document.getElementById('check-all').checked = allChecked;
                }
            });
        });

        document.getElementById('btn-reasignar').addEventListener('click', function() {
            let checkedBoxes = document.querySelectorAll('.chk-item:checked');
            let arrayIds = Array.from(checkedBoxes).map(cb => cb.value);
            let cantidad = arrayIds.length;
            
            Swal.fire({
                title: 'Asignación Masiva',
                html: `<p style="color: #666; margin-bottom: 5px;">Vas a asignar <b>${cantidad}</b> coordinador(es).</p><p style="color: #888; font-size: 0.9rem; margin-bottom: 15px;">Selecciona el nuevo Líder de la lista:</p><select id="nuevo-lider" class="form-select border-primary shadow-none text-center"><?php echo $opciones_lideres_html; ?></select>`,
                showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-check"></i> Proceder con Asignación', cancelButtonText: 'Cancelar', confirmButtonColor: '#8b5cf6', background: '#fff', color: '#333', preConfirm: () => {
                    let selectList = document.getElementById('nuevo-lider');
                    let val = selectList.value;
                    let txt = selectList.options[selectList.selectedIndex].text;
                    if(val === "") {
                        Swal.showValidationMessage('Debes seleccionar un líder de la lista');
                        return false;
                    }
                    return { id_lider: val, nombre_lider: txt };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    let data = result.value;
                    Swal.fire({ title: 'Procesando...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

                    $.ajax({
                        url: 'procesar_asignar_coordinadores_a_lider_checkbox_lider_ajax.php', type: 'POST', dataType: 'json', data: { accion: 'asignar_coordinadores_lider_masivo', ids_coordinadores: arrayIds, id_lider: data.id_lider },
                        success: function(response) {
                            if(response.status === 'success') {
                                Swal.fire({ icon: 'success', title: '¡Operación Exitosa!', text: response.message, confirmButtonColor: '#10b981' }).then(() => { window.location.reload(); });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function() { Swal.fire('Error', 'Problema de conexión con el servidor', 'error'); }
                    });
                }
            });
        });
    });
</script>
</body>
</html>
