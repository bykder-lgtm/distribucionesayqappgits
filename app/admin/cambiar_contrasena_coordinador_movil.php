<?php 
$nombre_pagina          = "Cambiar Contraseña";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_inicio_sesion_adm_coordinador.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_admin_modulo_info_empresa_adm_coordinador.php"); ?>

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
    <link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
    <script src="../js/sweetalert2.min_adm_tick.js"></script>

    <style>
        /* ============================================ */
        /* CAMBIAR PASSWORD COORDINADOR - TEMA AZUL INDIGO */
        /* ============================================ */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
        }

        .page-container {
            padding: 1rem;
            padding-bottom: 100px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.4);
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
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .back-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.1rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateX(-2px);
        }

        /* Form Card */
        .form-card {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Security Tips */
        .security-tip {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .security-tip i {
            color: #6366f1;
            font-size: 1.2rem;
            margin-top: 0.2rem;
        }

        .security-tip-content h4 {
            color: white;
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0 0 0.25rem 0;
        }

        .security-tip-content p {
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            margin: 0;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            display: block;
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }

        .form-input-container {
            position: relative;
        }

        .form-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6366f1;
            font-size: 1rem;
            z-index: 10;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            cursor: pointer;
            z-index: 10;
        }

        .toggle-password:hover {
            color: white;
        }

        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 0.9rem 2.5rem 0.9rem 2.75rem;
            color: white;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-input::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border-top: 1px solid rgba(99, 102, 241, 0.2);
            display: flex;
            justify-content: space-around;
            padding: 0.75rem 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: rgba(255,255,255,0.5);
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 12px;
        }

        .nav-item:hover, .nav-item.active {
            color: #6366f1;
            text-decoration: none;
        }

        .nav-item.active {
            background: rgba(99, 102, 241, 0.1);
        }

        .nav-item i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .nav-item span {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
    </style>
</head>
<body>

<main class="page-container">
    <!-- Header -->
    <div class="page-header animate-in">
        <h1>
            <button class="back-btn" onclick="window.location.href='config_coordinador_movil.php'">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            Cambiar Contraseña
        </h1>
    </div>

    <!-- Security Tip -->
    <div class="security-tip animate-in delay-1">
        <i class="fa-solid fa-shield-halved"></i>
        <div class="security-tip-content">
            <h4>Mantén tu cuenta segura</h4>
            <p>Usa una contraseña fuerte que incluya números y letras. No la compartas con nadie.</p>
        </div>
    </div>

    <!-- Form -->
    <form id="formPassword" class="form-card animate-in delay-2">
        <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
        
        <div class="form-group">
            <label class="form-label">Contraseña Actual *</label>
            <div class="form-input-container">
                <i class="fa-solid fa-lock form-input-icon"></i>
                <input type="password" class="form-input" name="current_password" id="current_password" required placeholder="Ingresa tu contraseña actual">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('current_password', this)"></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Nueva Contraseña *</label>
            <div class="form-input-container">
                <i class="fa-solid fa-key form-input-icon"></i>
                <input type="password" class="form-input" name="new_password" id="new_password" required placeholder="Nueva contraseña">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('new_password', this)"></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Confirmar Contraseña *</label>
            <div class="form-input-container">
                <i class="fa-solid fa-key form-input-icon"></i>
                <input type="password" class="form-input" name="confirm_password" id="confirm_password" required placeholder="Repite la nueva contraseña">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('confirm_password', this)"></i>
            </div>
        </div>
        
        <button type="submit" class="submit-btn" id="btnGuardar">
            <i class="fa-solid fa-save"></i> Actualizar Contraseña
        </button>
    </form>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_coordinador_movil.php"); ?>

<script>
    function togglePassword(inputId, icon) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    $(document).ready(function() {
        $('#formPassword').on('submit', function(e) {
            e.preventDefault();
            
            var current = $('#current_password').val();
            var newPass = $('#new_password').val();
            var confirm = $('#confirm_password').val();

            if (newPass !== confirm) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las nuevas contraseñas no coinciden',
                    confirmButtonColor: '#ef4444',
                    background: '#1a1f2e',
                    color: 'white'
                });
                return;
            }

            if (newPass.length < 4) { // Minimum length check, adjust as needed
                Swal.fire({
                    icon: 'warning',
                    title: 'Contraseña débil',
                    text: 'La nueva contraseña debe tener al menos 4 caracteres',
                    confirmButtonColor: '#f59e0b',
                    background: '#1a1f2e',
                    color: 'white'
                });
                return;
            }

            var btn = $('#btnGuardar');
            var originalText = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Procesando...');

            $.ajax({
                url: 'cambiar_contrasena_coordinador_ajax.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'Tu contraseña ha sido cambiada exitosamente',
                            confirmButtonColor: '#6366f1',
                            background: '#1a1f2e',
                            color: 'white'
                        }).then((result) => {
                            window.location.href = 'config_coordinador_movil.php';
                        });
                        $('#formPassword')[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'No se pudo actualizar la contraseña',
                            confirmButtonColor: '#ef4444',
                            background: '#1a1f2e',
                            color: 'white'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error de conexión',
                        confirmButtonColor: '#ef4444',
                        background: '#1a1f2e',
                        color: 'white'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
</script>

</body>
</html>
