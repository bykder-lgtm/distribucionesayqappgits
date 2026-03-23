<?php 
$nombre_pagina          = "Mis Promotoras";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
    <meta http-equiv="Content-Type"        content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"     content="IE=edge">
    <meta name="viewport"                  content="width=device-width, initial-scale=1">
    <meta name="keywords"                  content="<?php echo $keywords ?>">
    <meta name="description"               content="<?php echo $nombre_pagina ?>">
    
    <?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
    <script src="../js/jquery-3.2.1.min_visitante.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .promotoras-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1rem;
            padding: 0;
        }
        .promotora-card {
            background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
            border: 1px solid rgba(65, 105, 225, 0.3);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
            position: relative;
        }
        .promotora-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .promotora-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .promotora-info h4 {
            color: #00d4ff;
            font-size: 1.1rem;
            margin: 0 0 0.25rem 0;
        }
        .promotora-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin: 0;
        }
        .btn-add-promotora {
            background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        /* Modal Styles */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); }
        .modal-content { background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%); margin: 10% auto; padding: 2rem; border: 1px solid rgba(65,105,225,0.3); border-radius: 16px; width: 90%; max-width: 500px; color: white; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { color: #00d4ff; display: block; margin-bottom: 0.5rem; font-size: 0.9rem; }
        .form-group input { width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(65,105,225,0.3); border-radius: 8px; color: white; }
        .btn-save { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; width: 100%; font-weight: bold; cursor: pointer; }
        .close-modal { float: right; cursor: pointer; color: white; font-size: 1.5rem; }
    </style>
</head>
<body>
<?php include_once("../admin/01_modulo_header_top_movil.php"); ?>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<main class="container py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #00d4ff; margin:0;"><i class="fa fa-users"></i> Promotoras</h2>
        <button class="btn-add-promotora" onclick="document.getElementById('modalReg').style.display='block'">
            <i class="fa fa-plus"></i> Nueva Promotora
        </button>
    </div>

    <div class="promotoras-grid">
        <?php
        $sql = "SELECT * FROM tbl15_administrador WHERE cod_aliado_estrategico = '$cod_administrador' AND cod_seguridad = '29' AND cod_estado != '0'";
        $res = mysqli_query($conectar, $sql);
        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="promotora-card">
                    <div class="promotora-card-header">
                        <div class="promotora-avatar">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="promotora-info">
                            <h4><?php echo $row['nombres'].' '.$row['apellidos']; ?></h4>
                            <p><i class="fa fa-id-card"></i> <?php echo $row['cedula']; ?></p>
                            <p><i class="fa fa-envelope"></i> <?php echo $row['correo']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div style='color: white; width: 100%; text-align: center;'><p>No tienes promotoras registradas aún.</p></div>";
        }
        ?>
    </div>
</main>

<!-- Modal Registro Promotora -->
<div id="modalReg" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="document.getElementById('modalReg').style.display='none'">&times;</span>
        <h3 style="color: #00d4ff; margin-bottom: 1.5rem;"><i class="fa fa-user-plus"></i> Registrar Promotora</h3>
        <form id="formRegPromotora">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label>Cédula</label>
                <input type="text" name="cedula" required>
            </div>
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="nombres" required>
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="apellidos" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico (Usuario)</label>
                <input type="email" name="correo" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="clave" required>
            </div>
            <button type="submit" class="btn-save">Guardar Promotora</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#formRegPromotora').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'act_promotora_modal_aliado_ajax_reg.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if(res.status == 'success') {
                    Swal.fire('Éxito', res.msg, 'success').then(() => { location.reload(); });
                } else {
                    Swal.fire('Error', res.msg, 'error');
                }
            }
        });
    });
});
</script>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>
