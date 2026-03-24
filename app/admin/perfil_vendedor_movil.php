<?php 
$nombre_pagina          = "Mi Perfil";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_modulo_diseno_superior_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE SESION ******************************************** -->
<?php include_once("../admin/01_info_empresa_visitante_intern_movil.php"); ?>
<!-- **************************************************** MODULO DE INFO EMPRESA ******************************************** -->
<?php
// Obtener datos completos del usuario/aliado actual
$datos_usuario                                                  = array();
// Inicializar variables con valores vacíos
$cedula                                                         = '';
$nombres                                                        = '';
$apellidos                                                      = '';
$correo                                                         = '';
$telefono                                                       = '';
$direccion_tercero                                              = '';
$ciudad                                                         = '';
$departamento                                                   = '';
$fecha_nac_tercero                                              = '';
$nombre_sexo                                                    = '';
$url_img_foto_prof_min                                          = '';
$url_img_foto_prof_orig                                         = '';

if (isset($cod_administrador) && !empty($cod_administrador)) {
    $cod_administrador = intval($cod_administrador);
    $sql_usuario = "SELECT cod_administrador, cedula, nombres, apellidos, correo, telefono, direccion_tercero, ciudad, departamento, fecha_nac_tercero,
    nombre_sexo, url_img_foto_prof_min, url_img_foto_prof_orig, cod_estado_usuario_prueba, url_documentacion_cedula_aliado, url_documentacion_rut_aliado, url_documentacion_camaracomercio_aliado FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $resultado_usuario = mysqli_query($conectar, $sql_usuario);
    if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) { 
        $datos_usuario = mysqli_fetch_assoc($resultado_usuario);
        // Asignar variables solo si existen en el resultado
        $cedula                                                         = isset($datos_usuario['cedula']) ? $datos_usuario['cedula'] : '';
        $nombres                                                        = isset($datos_usuario['nombres']) ? $datos_usuario['nombres'] : '';
        $apellidos                                                      = isset($datos_usuario['apellidos']) ? $datos_usuario['apellidos'] : '';
        $correo                                                         = isset($datos_usuario['correo']) ? $datos_usuario['correo'] : '';
        $telefono                                                       = isset($datos_usuario['telefono']) ? $datos_usuario['telefono'] : '';
        $direccion_tercero                                              = isset($datos_usuario['direccion_tercero']) ? $datos_usuario['direccion_tercero'] : '';
        $ciudad                                                         = isset($datos_usuario['ciudad']) ? $datos_usuario['ciudad'] : '';
        $departamento                                                   = isset($datos_usuario['departamento']) ? $datos_usuario['departamento'] : '';
        $fecha_nac_tercero                                              = isset($datos_usuario['fecha_nac_tercero']) ? $datos_usuario['fecha_nac_tercero'] : '';
        $nombre_sexo                                                    = isset($datos_usuario['nombre_sexo']) ? $datos_usuario['nombre_sexo'] : '';
        $url_img_foto_prof_min                                          = isset($datos_usuario['url_img_foto_prof_min']) ? $datos_usuario['url_img_foto_prof_min'] : '';
        $url_img_foto_prof_orig                                         = isset($datos_usuario['url_img_foto_prof_orig']) ? $datos_usuario['url_img_foto_prof_orig'] : '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo ($nombre_pagina) ?> - <?php echo ($keywords) ?> - <?php echo ($titulo) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $nombre_pagina ?>">
<meta name="author" content="<?php echo $author ?>">

<?php include_once("../admin/03_modulo_css_visitante_intern_movil.php"); ?>
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
/* ===================== ESTILOS PÁGINA DE PERFIL ===================== */
.perfil-container {
    padding: 1rem;
    max-width: 800px;
    margin: 0 auto;
    padding-bottom: 100px;
}

.page-header-perfil {
    padding: 1.25rem;
    background: linear-gradient(135deg, rgba(65, 105, 225, 0.2) 0%, rgba(0, 212, 255, 0.1) 100%);
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
    margin-bottom: 1.5rem;
    border-radius: 12px;
}

.page-header-perfil h2 {
    color: white;
    margin: 0;
    font-size: 1.35rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-header-perfil h2 i {
    color: #00d4ff;
    font-size: 1.5rem;
}

/* Avatar y nombre principal */
.perfil-avatar-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border-radius: 16px;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(65, 105, 225, 0.3);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.avatar-container {
    position: relative;
    margin-bottom: 1rem;
}

.avatar-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4169e1 0%, #5b7ce6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 4px solid rgba(0, 212, 255, 0.5);
    box-shadow: 0 0 30px rgba(0, 212, 255, 0.3);
}

.avatar-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-img i {
    font-size: 3rem;
    color: white;
}

.avatar-edit-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.avatar-edit-btn:hover {
    transform: scale(1.1);
}

.perfil-nombre-principal {
    color: white;
    font-size: 1.4rem;
    font-weight: 700;
    margin: 0 0 0.25rem 0;
    text-align: center;
}

.perfil-id-badge {
    background: rgba(0, 212, 255, 0.2);
    color: #00d4ff;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Cards de información */
.perfil-card {
    background: linear-gradient(135deg, #1a1d3a 0%, #0a0e27 100%);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
}

.perfil-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(65, 105, 225, 0.3);
}

.perfil-card-header-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.perfil-card-header i {
    font-size: 1.25rem;
    color: #00d4ff;
}

.perfil-card-header h3 {
    color: white;
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
}

.btn-edit-section {
    background: rgba(0, 212, 255, 0.15);
    border: 1px solid rgba(0, 212, 255, 0.3);
    color: #00d4ff;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.btn-edit-section:hover {
    background: rgba(0, 212, 255, 0.25);
    transform: translateY(-1px);
}

/* Campos de información (modo visualización) */
.info-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.info-row:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.info-label {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.35rem;
}

.info-value {
    color: white;
    font-size: 1rem;
    font-weight: 500;
}

.info-value.empty {
    color: rgba(255, 255, 255, 0.3);
    font-style: italic;
}

/* Formularios de edición */
.form-group-perfil {
    margin-bottom: 1.25rem;
}

.form-group-perfil label {
    display: block;
    color: #00d4ff;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-group-perfil input,
.form-group-perfil select,
.form-group-perfil textarea {
    width: 100%;
    padding: 0.85rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(65, 105, 225, 0.3);
    border-radius: 10px;
    color: white;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-group-perfil input:focus,
.form-group-perfil select:focus,
.form-group-perfil textarea:focus {
    outline: none;
    border-color: #00d4ff;
    box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.15);
}

.form-group-perfil input::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.form-group-perfil select option {
    background: #1a1d3a;
    color: white;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 500px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

/* Botones */
.btn-perfil {
    width: 100%;
    padding: 0.95rem 1.5rem;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-perfil-primary {
    background: linear-gradient(135deg, #00d4ff 0%, #5b7ce6 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
}

.btn-perfil-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
}

.btn-perfil-primary:disabled {
    background: rgba(255, 255, 255, 0.2);
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-perfil-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-perfil-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
}

.btn-group-perfil {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
}

.btn-group-perfil .btn-perfil {
    flex: 1;
}

/* Alertas */
.alert-perfil {
    padding: 0.85rem 1rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    display: none;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-perfil.success {
    background: rgba(72, 187, 120, 0.2);
    border: 1px solid #48bb78;
    color: #48bb78;
}

.alert-perfil.error {
    background: rgba(255, 111, 0, 0.2);
    border: 1px solid #ff6f00;
    color: #ff6f00;
}

/* Modo visualización vs edición */
.view-mode {
    display: block;
}

.edit-mode {
    display: none;
}

.perfil-card.editing .view-mode {
    display: none;
}

.perfil-card.editing .edit-mode {
    display: block;
}

/* Input de foto oculto */
.input-foto-hidden {
    display: none;
}

/* Animación de carga */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-overlay.active {
    display: flex;
}

.loading-spinner {
    text-align: center;
    color: white;
}

.loading-spinner i {
    font-size: 3rem;
    color: #00d4ff;
    margin-bottom: 1rem;
}

.loading-spinner p {
    font-size: 1rem;
    margin: 0;
}
</style>
</head>
<body>
<?php include_once("../admin/01_modulo_encabezado_superior_visitante_intern_movil.php"); ?>

<!-- Overlay de carga -->
<div class="loading-overlay" id="loadingOverlay"><div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i><p>Guardando cambios...</p></div></div>

<main class="container py-4 mb-5">
    <!-- Encabezado de la página -->
    <div class="page-header-perfil"><h2><i class="fa fa-user-circle"></i> Mi Perfil</h2></div>

    <div class="perfil-container">
        <!-- Alerta general -->
        <div id="alertPerfil" class="alert-perfil"></div>
        <!-- Sección Avatar y Nombre -->
        <div class="perfil-avatar-section">
            <div class="avatar-container">
                <div class="avatar-img" id="avatarPreview">
                    <?php if (!empty($url_img_foto_prof_min) && file_exists($url_img_foto_prof_min)) { ?><img src="<?php echo $url_img_foto_prof_min; ?>" alt="Foto de perfil" id="avatarImg"><?php } else { ?><i class="fa fa-user" id="avatarIcon"></i><?php } ?>
                </div>
                <button type="button" class="avatar-edit-btn" id="btnCambiarFoto" title="Cambiar foto"><i class="fa fa-camera"></i></button>
                <input type="file" id="inputFotoPerfil" class="input-foto-hidden" accept="image/*">
            </div>
            <h3 class="perfil-nombre-principal"><?php echo isset($nombres) ? ucwords(strtolower($nombres.' '.$apellidos)) : 'Usuario'; ?> </h3>
            <span class="perfil-id-badge">ID: <?php echo $cod_administrador; ?></span>
        </div>
        <!-- Card: Información Personal -->
        <div class="perfil-card" id="cardInfoPersonal">
            <div class="perfil-card-header">
                <div class="perfil-card-header-left"><i class="fa fa-id-card"></i><h3>Información Personal</h3></div>
                <button type="button" class="btn-edit-section view-mode" onclick="toggleEditMode('cardInfoPersonal')"><i class="fa fa-edit"></i> Editar</button>
            </div>
            <!-- Modo Visualización -->
            <div class="view-mode">
                <div class="info-row">
                    <span class="info-label">Cédula / Documento</span>
                    <span class="info-value <?php echo empty($cedula) ? 'empty' : ''; ?>"><?php echo !empty($cedula) ? $cedula : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nombres</span>
                    <span class="info-value <?php echo empty($nombres) ? 'empty' : ''; ?>"><?php echo !empty($nombres) ? ucwords(strtolower($nombres)) : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Apellidos</span>
                    <span class="info-value <?php echo empty($apellidos) ? 'empty' : ''; ?>"><?php echo !empty($apellidos) ? ucwords(strtolower($apellidos)) : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha de Nacimiento</span>
                    <span class="info-value <?php echo empty($fecha_nac_tercero) ? 'empty' : ''; ?>"><?php echo !empty($fecha_nac_tercero) ? date('d/m/Y', strtotime($fecha_nac_tercero)) : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Género</span>
                    <span class="info-value <?php echo empty($nombre_sexo) ? 'empty' : ''; ?>"><?php echo !empty($nombre_sexo) ? ucfirst(strtolower($nombre_sexo)) : 'No especificado'; ?></span>
                </div>
            </div>
            <!-- Modo Edición -->
            <div class="edit-mode">
                <form id="formInfoPersonal">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                    <input type="hidden" name="seccion" value="info_personal">
                    
                    <div class="form-group-perfil">
                        <label for="cedula"><i class="fa fa-id-badge"></i> Cédula / Documento</label>
                        <input type="text" id="cedula" name="cedula" value="<?php echo isset($cedula) ? $cedula : ''; ?>" placeholder="Ingrese su documento">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group-perfil">
                            <label for="nombres"><i class="fa fa-user"></i> Nombres</label>
                            <input type="text" id="nombres" name="nombres" value="<?php echo isset($nombres) ? $nombres : ''; ?>" placeholder="Sus nombres">
                        </div>
                        <div class="form-group-perfil">
                            <label for="apellidos"><i class="fa fa-user"></i> Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? $apellidos : ''; ?>" placeholder="Sus apellidos">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group-perfil">
                            <label for="fecha_nac_tercero"><i class="fa fa-calendar"></i> Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nac_tercero" name="fecha_nac_tercero" value="<?php echo isset($fecha_nac_tercero) ? $fecha_nac_tercero : ''; ?>">
                        </div>
                        <div class="form-group-perfil">
                            <label for="nombre_sexo"><i class="fa fa-venus-mars"></i> Género</label>
                            <select id="nombre_sexo" name="nombre_sexo">
                                <option value="">Seleccione...</option>
                                <option value="O" <?php echo (isset($nombre_sexo) && $nombre_sexo == 'O') ? 'selected' : ''; ?>>Masculino</option>
                                <option value="A" <?php echo (isset($nombre_sexo) && $nombre_sexo == 'A') ? 'selected' : ''; ?>>Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="btn-group-perfil">
                        <button type="button" class="btn-perfil btn-perfil-secondary" onclick="toggleEditMode('cardInfoPersonal')"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn-perfil btn-perfil-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Card: Información de Contacto -->
        <div class="perfil-card" id="cardContacto">
            <div class="perfil-card-header">
                <div class="perfil-card-header-left"><i class="fa fa-phone-alt"></i><h3>Información de Contacto</h3></div>
                <button type="button" class="btn-edit-section view-mode" onclick="toggleEditMode('cardContacto')"><i class="fa fa-edit"></i> Editar</button>
            </div>
            <!-- Modo Visualización -->
            <div class="view-mode">
                <div class="info-row">
                    <span class="info-label">Correo Electrónico</span>
                    <span class="info-value <?php echo empty($correo) ? 'empty' : ''; ?>"><?php echo !empty($correo) ? $correo : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono</span>
                    <span class="info-value <?php echo empty($telefono) ? 'empty' : ''; ?>"><?php echo !empty($telefono) ? $telefono : 'No especificado'; ?></span>
                </div>
            </div>
            <!-- Modo Edición -->
            <div class="edit-mode">
                <form id="formContacto">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                    <input type="hidden" name="seccion" value="contacto">
                    
                    <div class="form-row">
                        <div class="form-group-perfil">
                            <label for="correo"><i class="fa fa-envelope"></i> Correo Electrónico</label>
                            <input type="email" id="correo" name="correo" value="<?php echo isset($correo) ? $correo : ''; ?>" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="form-group-perfil">
                            <label for="telefono"><i class="fa fa-phone"></i> Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="btn-group-perfil">
                        <button type="button" class="btn-perfil btn-perfil-secondary" onclick="toggleEditMode('cardContacto')"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn-perfil btn-perfil-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Card: Ubicación -->
        <div class="perfil-card" id="cardUbicacion">
            <div class="perfil-card-header">
                <div class="perfil-card-header-left"><i class="fa fa-map-marker-alt"></i><h3>Ubicación</h3></div>
                <button type="button" class="btn-edit-section view-mode" onclick="toggleEditMode('cardUbicacion')"><i class="fa fa-edit"></i> Editar</button>
            </div>

            <!-- Modo Visualización -->
            <div class="view-mode">
                <div class="info-row">
                    <span class="info-label">Dirección</span>
                    <span class="info-value <?php echo empty($direccion_tercero) ? 'empty' : ''; ?>"><?php echo !empty($direccion_tercero) ? $direccion_tercero : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ciudad</span>
                    <span class="info-value <?php echo empty($ciudad) ? 'empty' : ''; ?>"><?php echo !empty($ciudad) ? ucwords(strtolower($ciudad)) : 'No especificado'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Departamento</span>
                    <span class="info-value <?php echo empty($departamento) ? 'empty' : ''; ?>"><?php echo !empty($departamento) ? ucwords(strtolower($departamento)) : 'No especificado'; ?></span>
                </div>
            </div>

            <!-- Modo Edición -->
            <div class="edit-mode">
                <form id="formUbicacion">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                    <input type="hidden" name="seccion" value="ubicacion">
                    
                    <div class="form-group-perfil">
                        <label for="direccion"><i class="fa fa-home"></i> Dirección</label>
                        <input type="text" id="direccion_tercero" name="direccion_tercero" value="<?php echo isset($direccion_tercero) ? $direccion_tercero : ''; ?>" placeholder="Dirección completa">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group-perfil">
                            <label for="ciudad"><i class="fa fa-city"></i> Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" value="<?php echo isset($ciudad) ? $ciudad : ''; ?>" placeholder="Ciudad">
                        </div>
                        <div class="form-group-perfil">
                            <label for="departamento"><i class="fa fa-map"></i> Departamento</label>
                            <input type="text" id="departamento" name="departamento" value="<?php echo isset($departamento) ? $departamento : ''; ?>" placeholder="Departamento">
                        </div>
                    </div>
                    
                    <div class="btn-group-perfil">
                        <button type="button" class="btn-perfil btn-perfil-secondary" onclick="toggleEditMode('cardUbicacion')"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn-perfil btn-perfil-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Card: Documentación -->
        <div class="perfil-card" id="cardDocumentacion">
            <div class="perfil-card-header">
                <div class="perfil-card-header-left"><i class="fa fa-file-contract"></i><h3>Documentación Legal</h3></div>
                <button type="button" class="btn-edit-section view-mode" onclick="toggleEditMode('cardDocumentacion')"><i class="fa fa-upload"></i> Subir</button>
            </div>

            <!-- Modo Visualización -->
            <div class="view-mode">
                <?php 
                $docs = [
                    ['label' => 'Cédula', 'path' => $datos_usuario['url_documentacion_cedula_aliado'], 'icon' => 'id-card'],
                    ['label' => 'RUT', 'path' => $datos_usuario['url_documentacion_rut_aliado'], 'icon' => 'file-pdf'],
                    ['label' => 'Cámara de Comercio', 'path' => $datos_usuario['url_documentacion_camaracomercio_aliado'], 'icon' => 'building']
                ];
                foreach ($docs as $doc):
                ?>
                <div class="info-row">
                    <span class="info-label"><?php echo $doc['label']; ?></span>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 0.25rem;">
                        <span class="info-value <?php echo empty($doc['path']) ? 'empty' : ''; ?>">
                            <?php echo !empty($doc['path']) ? '<i class="fa fa-check-circle" style="color: #10b981;"></i> Cargado' : 'Pendiente'; ?>
                        </span>
                        <?php if(!empty($doc['path'])): ?>
                        <a href="<?php echo $doc['path']; ?>" target="_blank" style="color: #00d4ff; font-size: 0.8rem; text-decoration: none;"><i class="fa fa-external-link"></i> Ver documento</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Modo Edición -->
            <div class="edit-mode">
                <form id="formDocumentacion" enctype="multipart/form-data">
                    <input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador; ?>">
                    <input type="hidden" name="seccion" value="documentacion">
                    
                    <div class="form-group-perfil">
                        <label for="doc_cedula"><i class="fa fa-id-card"></i> Cédula (Imagen o PDF)</label>
                        <input type="file" id="doc_cedula" name="url_documentacion_cedula_aliado" accept="image/*,.pdf">
                    </div>
                    <div class="form-group-perfil">
                        <label for="doc_rut"><i class="fa fa-file-pdf"></i> RUT</label>
                        <input type="file" id="doc_rut" name="url_documentacion_rut_aliado" accept="image/*,.pdf">
                    </div>
                    <div class="form-group-perfil">
                        <label for="doc_camara"><i class="fa fa-building"></i> Cámara de Comercio</label>
                        <input type="file" id="doc_camara" name="url_documentacion_camaracomercio_aliado" accept="image/*,.pdf">
                    </div>
                    
                    <div class="btn-group-perfil">
                        <button type="button" class="btn-perfil btn-perfil-secondary" onclick="toggleEditMode('cardDocumentacion')"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn-perfil btn-perfil-primary"><i class="fa fa-save"></i> Subir Documentos</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Card: Seguridad -->
        <div class="perfil-card" id="cardSeguridad">
            <div class="perfil-card-header">
                <div class="perfil-card-header-left"><i class="fa fa-shield-alt"></i><h3>Seguridad</h3></div>
            </div>
            <div class="view-mode">
                <div class="info-row" style="margin-bottom: 0; padding-bottom: 0; border: none;">
                    <span class="info-label">Contraseña</span>
                    <span class="info-value">********</span>
                </div>
                <div class="btn-group-perfil" style="margin-top: 1rem;">
                    <button type="button" class="btn-perfil btn-perfil-primary" onclick="window.location.href='cambiar_contrasena_vendedor_movil.php'"><i class="fa fa-key"></i> Cambiar Contraseña</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// ===================== TOGGLE EDIT MODE =====================
function toggleEditMode(cardId) {
    var card = document.getElementById(cardId);
    card.classList.toggle('editing');
}
// ===================== MOSTRAR ALERTAS =====================
function showAlert(message, type) {
    var alertEl = document.getElementById('alertPerfil');
    alertEl.className = 'alert-perfil ' + type;
    alertEl.innerHTML = '<i class="fa fa-' + (type === 'success' ? 'check-circle' : 'exclamation-circle') + '"></i> ' + message;
    alertEl.style.display = 'block';
    // Scroll hacia arriba para ver la alerta
    window.scrollTo({top: 0, behavior: 'smooth'});
    // Ocultar después de 5 segundos
    setTimeout(function() { alertEl.style.display = 'none'; }, 5000);
}
// ===================== CAMBIAR FOTO DE PERFIL =====================
document.getElementById('btnCambiarFoto').addEventListener('click', function() { document.getElementById('inputFotoPerfil').click(); });

document.getElementById('inputFotoPerfil').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        // Pre-visualizar
        var reader = new FileReader();
        reader.onload = function(e) {
            var avatarPreview = document.getElementById('avatarPreview');
            avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Foto de perfil" id="avatarImg">';
        };
        reader.readAsDataURL(file);
        // Subir foto
        var formData = new FormData();
        formData.append('foto_perfil', file);
        formData.append('cod_administrador', '<?php echo $cod_administrador; ?>');
        
        document.getElementById('loadingOverlay').classList.add('active');
        
        $.ajax({
            url: 'actualizar_foto_perfil_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
            success: function(response) {
                if (response.success) { showAlert(response.message, 'success'); } else { showAlert(response.message, 'error'); }
            },
            error: function() { showAlert('Error de conexión al subir la foto', 'error'); }, complete: function() { document.getElementById('loadingOverlay').classList.remove('active'); }
        });
    }
});

// ===================== SUBMIT FORMULARIOS =====================
function submitForm(formId, cardId) {
    var form = document.getElementById(formId);
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var submitBtn = this.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
        
        $.ajax({
            url: 'actualizar_perfil_ajax.php', type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    // Cerrar modo edición
                    toggleEditMode(cardId);
                    // Recargar página para mostrar los nuevos datos
                    setTimeout(function() { location.reload(); }, 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function() { showAlert('Error de conexión al guardar los datos', 'error'); },
            complete: function() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    });
}

// Inicializar formularios
submitForm('formInfoPersonal', 'cardInfoPersonal');
submitForm('formContacto', 'cardContacto');
submitForm('formUbicacion', 'cardUbicacion');
submitForm('formDocumentacion', 'cardDocumentacion');
</script>

<?php include_once("../menu/05_modulo_menu_vendedor_movil.php"); ?>
<?php include_once("../admin/10_modulo_sin_js_visitante_intern_movil.php"); ?>
</body>
</html>
