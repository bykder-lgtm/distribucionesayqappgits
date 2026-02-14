<?php 
$nombre_pagina          = "Simulador de Crédito";
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $nombre_pagina ?>">
<meta name="author" content="<?php echo $author ?>">
<link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="../js/jquery-3.2.1.min_visitante.js"></script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

/* Animated Background */
.bg-animation {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
}

.bg-animation::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 40%);
    animation: bgFloat 15s ease-in-out infinite;
}

@keyframes bgFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(2%, 2%) rotate(1deg); }
    66% { transform: translate(-1%, 1%) rotate(-1deg); }
}

/* Floating Particles */
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 20s infinite;
}

.particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 25s; }
.particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 20s; }
.particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 28s; }
.particle:nth-child(4) { left: 40%; animation-delay: 1s; animation-duration: 22s; }
.particle:nth-child(5) { left: 50%; animation-delay: 3s; animation-duration: 24s; }
.particle:nth-child(6) { left: 60%; animation-delay: 5s; animation-duration: 26s; }
.particle:nth-child(7) { left: 70%; animation-delay: 2s; animation-duration: 21s; }
.particle:nth-child(8) { left: 80%; animation-delay: 4s; animation-duration: 23s; }
.particle:nth-child(9) { left: 90%; animation-delay: 1s; animation-duration: 27s; }

@keyframes float {
    0% { transform: translateY(100vh) scale(0); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100vh) scale(1); opacity: 0; }
}

/* Main Container */
.simulator-container {
    padding: 1rem;
    padding-bottom: 120px;
    max-width: 500px;
    margin: 0 auto;
}

/* Hero Header */
.simulator-hero {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.18);
    border-radius: 24px;
    padding: 2rem 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    animation: slideDown 0.6s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}

.simulator-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3, #ff6b6b);
    background-size: 200% 100%;
    animation: gradientMove 3s linear infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 0%; }
    100% { background-position: 200% 0%; }
}

.hero-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4); }
    50% { transform: scale(1.05); box-shadow: 0 15px 50px rgba(102, 126, 234, 0.6); }
}

.hero-icon i {
    font-size: 2rem;
    color: white;
}

.simulator-hero h1 {
    font-size: 1.75rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.simulator-hero p {
    color: rgba(255,255,255,0.8);
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Stats Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    animation: slideUp 0.6s ease 0.2s backwards;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 1rem 0.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.25);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.stat-card i {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    display: block;
}

.stat-card:nth-child(1) i { color: #48dbfb; }
.stat-card:nth-child(2) i { color: #feca57; }
.stat-card:nth-child(3) i { color: #ff6b6b; }

.stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.25rem;
}

/* Form Card */
.form-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 1.75rem 1.5rem;
    animation: slideUp 0.6s ease 0.3s backwards;
}

.form-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.form-card-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 20px rgba(56, 239, 125, 0.3);
}

.form-card-icon i {
    font-size: 1.2rem;
    color: white;
}

.form-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
}

.form-card-subtitle {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: rgba(255,255,255,0.9);
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.form-group label i {
    color: #48dbfb;
    font-size: 0.85rem;
}

.form-control-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    padding-left: 3rem;
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 14px;
    background: rgba(255,255,255,0.08);
    color: white;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    -webkit-appearance: none;
    appearance: none;
}

.form-control-modern:focus {
    outline: none;
    border-color: #667eea;
    background: rgba(255,255,255,0.12);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.2);
}

.form-control-modern::placeholder {
    color: rgba(255,255,255,0.4);
}

.input-icon {
    position: absolute;
    left: 1rem;
    bottom: 1rem;
    color: rgba(255,255,255,0.5);
    font-size: 1rem;
    transition: color 0.3s ease;
}

.form-group:focus-within .input-icon {
    color: #667eea;
}

select.form-control-modern {
    padding-left: 1.25rem;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
}

select.form-control-modern option {
    background: #1a1d3a;
    color: white;
    padding: 0.75rem;
}

/* Info Box */
.info-box {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.1) 100%);
    border: 1px solid rgba(102, 126, 234, 0.3);
    border-radius: 14px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.info-box i {
    color: #667eea;
    font-size: 1.1rem;
    margin-top: 0.1rem;
}

.info-box p {
    color: rgba(255,255,255,0.85);
    font-size: 0.85rem;
    line-height: 1.5;
    margin: 0;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 1.1rem;
    border: none;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
}

.btn-submit:active {
    transform: translateY(-1px);
}

.btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Bottom Features */
.features-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    margin-top: 1.5rem;
    animation: slideUp 0.6s ease 0.4s backwards;
}

.feature-item {
    background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.03) 100%);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.feature-item i {
    font-size: 1.25rem;
    color: #38ef7d;
}

.feature-item span {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
    font-weight: 500;
}

/* Bottom Navigation */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, rgba(15, 12, 41, 0.95) 0%, rgba(48, 43, 99, 0.95) 100%);
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255,255,255,0.1);
    display: flex;
    justify-content: space-around;
    padding: 0.75rem 0;
    z-index: 1000;
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
    color: #667eea;
}

.nav-item.active {
    background: rgba(102, 126, 234, 0.15);
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

/* Responsive */
@media (max-width: 380px) {
    .simulator-hero h1 { font-size: 1.5rem; }
    .stats-row { gap: 0.5rem; }
    .stat-card { padding: 0.75rem 0.25rem; }
    .stat-value { font-size: 1rem; }
}
</style>
</head>
<body>

<!-- Animated Background -->
<div class="bg-animation"></div>
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<?php
$nombre_tipo_origen_simulacion = "SIMULACION_VALOR_LIBRE";
$cod_categoria = 2;
?>

<main class="simulator-container">
    <!-- Hero Header -->
    <div class="simulator-hero">
        <div class="hero-icon">
            <i class="fa-solid fa-calculator"></i>
        </div>
        <h1>Simulador de Crédito</h1>
        <p>Calcula tu cuota mensual y descubre las mejores opciones de financiamiento</p>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <i class="fa-solid fa-percent"></i>
            <div class="stat-value">0%</div>
            <div class="stat-label">Cuota Inicial</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-calendar-check"></i>
            <div class="stat-value">36</div>
            <div class="stat-label">Meses Máx</div>
        </div>
        <div class="stat-card">
            <i class="fa-solid fa-bolt"></i>
            <div class="stat-value">24h</div>
            <div class="stat-label">Aprobación</div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-card-icon">
                <i class="fa-solid fa-sliders"></i>
            </div>
            <div>
                <div class="form-card-title">Configura tu Crédito</div>
                <div class="form-card-subtitle">Completa los datos para simular</div>
            </div>
        </div>

        <div class="info-box">
            <i class="fa-solid fa-lightbulb"></i>
            <p>Ingresa el valor del producto y te mostraremos todas las opciones de financiamiento disponibles.</p>
        </div>

        <form name="formulario_de_actualizacion" method="POST" autocomplete="off" action="../admin/simulador_credito_producto_visitante_intern_interes_max_entidad_crediticia_resultado_get_movil.php">
            
            <div class="form-group">
                <label><i class="fa-solid fa-list-check"></i> Tipo de Simulación</label>
                <select id="cod_tipo_simulacion_credito" name="cod_tipo_simulacion_credito" class="form-control-modern" onchange="calcularValorCredito()">
                    <?php 
                    $consulta2_sql = "SELECT cod_tipo_simulacion_credito, nombre_tipo_simulacion_credito FROM tbl15_tipo_simulacion_credito WHERE (cod_estado = '1')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                        $seleccionado = (isset($cod_tipo_simulacion_credito) && $cod_tipo_simulacion_credito == $datos2['cod_tipo_simulacion_credito']) ? "selected" : "";
                        echo "<option value='".$datos2['cod_tipo_simulacion_credito']."' $seleccionado>".$datos2['nombre_tipo_simulacion_credito']."</option>";
                    } 
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fa-solid fa-dollar-sign"></i> Valor del Producto (Contado)</label>
                <i class="fa-solid fa-coins input-icon"></i>
                <input type="text" class="form-control-modern" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" placeholder="Ej: 1.000.000" inputmode="numeric" required>
                <input type="hidden" name="precio_venta_producto" id="precio_venta_producto" required>
            </div>

            <button class="btn-submit" id="submit" type="submit">
                <i class="fa-solid fa-calculator"></i>
                <span>Calcular Crédito</span>
            </button>

            <input type="hidden" name="nombre_tipo_origen_simulacion" value="<?php echo $nombre_tipo_origen_simulacion ?>">
            <input type="hidden" name="cod_producto_codifcryp" value="">
            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
            <input type="hidden" name="insertar_datos" value="formulario">
        </form>
    </div>

    <!-- Features -->
    <div class="features-row">
        <div class="feature-item">
            <i class="fa-solid fa-shield-halved"></i>
            <span>100% Seguro</span>
        </div>
        <div class="feature-item">
            <i class="fa-solid fa-clock"></i>
            <span>Respuesta Rápida</span>
        </div>
    </div>
</main>

<?php include_once("../menu/05_modulo_menu_aliado_movil.php"); ?>

<script>
// Formatear precio mientras se escribe
const precioInput = document.getElementById('precio_venta_producto_formateado');

precioInput.addEventListener('keyup', (e) => {
    const valorFormateado = formatearNumero(e.target.value);
    e.target.value = valorFormateado;
    const valorSinFormato = valorFormateado.replace(/\./g, "").replace(/,/g, "");
    document.getElementById('precio_venta_producto').value = valorSinFormato;
});

function formatearNumero(numero) {
    let valorNumerico = String(numero).replace(/\D/g, '');
    return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString('es-ES');
}

// Validación del formulario
document.querySelector('form[name="formulario_de_actualizacion"]').addEventListener('submit', function(e) {
    const precio = document.getElementById('precio_venta_producto').value;
    
    if (!precio || precio == '0') {
        e.preventDefault();
        alert('Por favor ingresa un valor válido para el producto');
        return false;
    }
    
    const btnSubmit = document.getElementById('submit');
    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Calculando...';
    btnSubmit.disabled = true;
});
</script>

</body>
</html>
