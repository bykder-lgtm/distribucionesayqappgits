<?php 
$nombre_pagina          = "Editar Perfil";
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
    <link rel="stylesheet" href="../estilo_css/sweetalert2.min_adm_tick.css" type="text/css" />
    <script src="../js/sweetalert2.min_adm_tick.js"></script>

    <style>
        /* ============================================ */
        /* EDIT PERFIL ASESOR - TEMA VERDE ESMERALDA */
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
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.4);
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

        /* Profile Photo Upload */
        .profile-upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .profile-image-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #10b981;
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.3);
            margin-bottom: 1rem;
            background: #1a1f2e;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn-upload {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-upload:hover {
            background: #10b981;
            color: white;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        /* Form Card */
        .form-card {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
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
            color: #10b981;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 0.9rem 1rem 0.9rem 2.75rem;
            color: white;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #10b981;
            background: rgba(16, 185, 129, 0.05);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-input::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .form-input[readonly] {
            background: rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.5);
            cursor: not-allowed;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border-top: 1px solid rgba(16, 185, 129, 0.2);
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
            color: #10b981;
            text-decoration: none;
        }

        .nav-item.active {
            background: rgba(16, 185, 129, 0.1);
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
            <button class="back-btn" onclick="window.location.href='config_asesor_movil.php'">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            Editar Perfil
        </h1>
    </div>

    <!-- Form -->
    <form id="formPerfil" enctype="multipart/form-data">
        <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
        
        <div class="profile-upload-container animate-in delay-1">
            <img class="profile-image-preview" id="preview" src="<?php echo $url_img_foto_prof_min_usuario; ?>" alt="Foto Perfil">
            <div class="upload-btn-wrapper">
                <span class="btn-upload"><i class="fa-solid fa-camera"></i> Cambiar Foto</span>
                <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" onchange="previewImage(this)">
            </div>
        </div>

        <div class="form-card animate-in delay-2">
            <div class="form-group">
                <label class="form-label">Nombres</label>
                <div class="form-input-container">
                    <i class="fa-solid fa-user form-input-icon"></i>
                    <input type="text" class="form-input" name="nombres" id="nombres" value="<?php echo $nombres_usuario; ?>" required placeholder="Tus nombres">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Apellidos</label>
                <div class="form-input-container">
                    <i class="fa-solid fa-user form-input-icon"></i>
                    <input type="text" class="form-input" name="apellidos" id="apellidos" value="<?php echo $apellidos_usuario; ?>" required placeholder="Tus apellidos">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Correo Electrónico (Usuario)</label>
                <div class="form-input-container">
                    <i class="fa-solid fa-envelope form-input-icon"></i>
                    <input type="email" class="form-input" name="correo" id="correo" value="<?php echo $correo_usuario; ?>" readonly placeholder="Tu correo">
                </div>
            </div>

            <!-- Removed Password field as there is a separate change password page -->
            
            <button type="submit" class="submit-btn" id="btnGuardar">
                <i class="fa-solid fa-save"></i> Guardar Cambios
            </button>
        </div>
    </form>
</main>

<!-- Bottom Navigation -->
<?php include_once("../menu/05_modulo_menu_asesor_movil.php"); ?>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('#formPerfil').on('submit', function(e) {
            e.preventDefault();
            
            var btn = $('#btnGuardar');
            var originalText = btn.html();
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Guardando...');

            var formData = new FormData(this);

            $.ajax({
                url: 'actualizar_perfil_asesor_ajax.php',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Perfil actualizado correctamente',
                            confirmButtonColor: '#10b981',
                            background: '#1a1f2e',
                            color: 'white'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'No se pudo actualizar el perfil',
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
                        text: 'Ocurrió un error al procesar la solicitud',
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
