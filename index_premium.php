<?php 
$nombre_pagina          = "Vibe Premium";
$cod_seguridad_pag      = "1";
$pagina_local           = $_SERVER['PHP_SELF'];
$cod_base_caja          = "1";
?>
<!-- **** MODULO DE SESION **** -->
<?php include_once("app/admin/01_modulo_diseno_superior_visitante_extnosesion_extern.php"); ?>
<!-- **** MODULO DE INFO EMPRESA **** -->
<?php include_once($nombre_carpeta_pagina."/admin/01_info_empresa_visitante_extnosesion.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $nombre ?> — Vibe Premium | <?php echo $keywords ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $nombre_carpeta_pagina ?>/imagenes/icono.ico" type="image/x-icon" rel="shortcut icon" />
    
    <!-- Base Styles -->
    <?php include_once($nombre_carpeta_pagina."/admin/03_modulo_css_visitante_extnosesion_extern.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Vibe Premium Styles -->
    <link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/sitio_nuevo.css">
    <link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/vibe_premium.css">
</head>

<body class="sitio-nuevo">

    <!-- ═══════════════ NAVBAR ═══════════════ -->
    <nav class="sn-navbar" id="sn-navbar">
        <div class="sn-container">
            <a href="index_premium.php" class="sn-navbar-brand">
                <img src="<?php echo ($nombre_carpeta_pagina) ?>/imagenes/logo.png" alt="<?php echo $nombre ?>">
                <span><?php echo $nombre ?></span>
            </a>
            <ul class="sn-nav-links" id="sn-nav-links">
                <li><a href="index_nuevo.php">Inicio</a></li>
                <li><a href="#arquitectura">Arquitectura</a></li>
                <li><a href="#canales">Canales</a></li>
                <li><a href="#centros">Sedes</a></li>
                <li><a href="#metricas">Métricas</a></li>
                <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/entrar_escoger_intern.php" class="sn-nav-cta">Ingresar</a></li>
            </ul>
        </div>
    </nav>

    <!-- ═══════════════ 1. ARQUITECTURA FINANCIAMIENTO ═══════════════ -->
    <section class="vp-architecture" id="arquitectura">
        <div class="sn-star-bg"></div>
        <div class="sn-container">
            <div class="vp-arch-header">
                <h2>Arquitectura de Financiamiento Integrado</h2>
                <p>Un solo ecosistema. Múltiples fuentes de capital.</p>
            </div>
            
            <div class="vp-arch-diagram">
                <!-- Rings -->
                <div class="vp-arch-rings">
                    <div class="vp-arch-ring vp-arch-ring-1"></div>
                    <div class="vp-arch-ring vp-arch-ring-2"></div>
                    <div class="vp-arch-ring vp-arch-ring-3"></div>
                </div>

                <!-- Center Logo -->
                <div class="vp-arch-center">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/logo_circular.png" alt="A&Q Logo Central">
                </div>

                <!-- Entity Nodes (Clockwise starting from Top) -->
                <!-- Brilla (12:00) -->
                <div class="vp-arch-node vpan-1" style="top: 0; left: 50%; transform: translateX(-50%);">
                    <h3>Brilla</h3>
                    <p>Financiación ágil para productos y servicios</p>
                </div>
                <!-- Sistecrédito (1:30) -->
                <div class="vp-arch-node vpan-2" style="top: 15%; right: 5%;">
                    <h3>sistecrédito</h3>
                    <p>Soluciones de crédito accesibles para compras</p>
                </div>
                <!-- Addi (4:00) -->
                <div class="vp-arch-node vpan-3" style="bottom: 25%; right: 0;">
                    <h3>Addi</h3>
                    <p>Crédito digital rápido en puntos de venta</p>
                </div>
                <!-- Banco de Bogotá (6:00) -->
                <div class="vp-arch-node vpan-4" style="bottom: 0; left: 50%; transform: translateX(-50%);">
                    <h3>Banco de Bogotá <i class="fas fa-landmark"></i></h3>
                    <p>Respaldo bancario y financiamiento integral</p>
                </div>
                <!-- SU+ Pay (7:30) -->
                <div class="vp-arch-node vpan-5" style="bottom: 25%; left: 0;">
                    <h3>SU+ Pay</h3>
                    <p>Pagos y financiamiento flexibles en cuotas</p>
                </div>
                <!-- Bancolombia / CeroPay (10:30) -->
                <div class="vp-arch-node vpan-6" style="top: 15%; left: 5%;">
                    <h3>Bancolombia <span style="font-size:0.7rem">/ CeroPay</span></h3>
                    <p>Plataforma para pagos y crédito Cero</p>
                </div>
                <!-- PayJoy (9:00 - extra to match the semi-circular spread) -->
                <div class="vp-arch-node vpan-7" style="top: 40%; left: -5%;">
                    <h3>PayJoy</h3>
                    <p>Financiamiento garantizado para tecnología</p>
                </div>
                
                <!-- Simple SVG Connections -->
                <svg style="position:absolute; inset:0; pointer-events:none; width:100%; height:100%; z-index:1;">
                    <line x1="50%" y1="50%" x2="50%" y2="60px" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="80%" y2="25%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="90%" y2="70%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="50%" y2="90%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="10%" y2="70%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="10%" y2="25%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                    <line x1="50%" y1="50%" x2="5%" y2="45%" stroke="var(--vp-gold)" stroke-width="1.5" stroke-dasharray="4" opacity="0.4" />
                </svg>
            </div>
        </div>
    </section>

    <!-- ═══════════════ 2. SOLICITA POR EL CANAL ═══════════════ -->
    <section class="vp-canales" id="canales">
        <div class="sn-container">
            <h2>Solicita por el Canal que Prefieras</h2>
            <div class="vp-canales-grid">
                <!-- WhatsApp -->
                <a href="#" class="vp-canal-card vp-cc-whatsapp-card">
                    <div class="vp-canal-icon-circle"><i class="fab fa-whatsapp vp-cc-whatsapp"></i></div>
                    <h3>WhatsApp</h3>
                    <p>Escríbenos y te asesoramos al instante</p>
                </a>
                <!-- Tienda Física -->
                <a href="#centros" class="vp-canal-card vp-cc-tienda-card">
                    <div class="vp-canal-icon-circle"><i class="fas fa-store vp-cc-tienda"></i></div>
                    <h3>Tienda Física</h3>
                    <p>Visítanos en nuestros centros de experiencia</p>
                </a>
                <!-- Web -->
                <a href="#" class="vp-canal-card vp-cc-web-card">
                    <div class="vp-canal-icon-circle"><i class="fas fa-laptop vp-cc-web"></i></div>
                    <h3>Simulador Web</h3>
                    <p>Simula tu crédito desde cualquier lugar</p>
                </a>
                <!-- Call -->
                <a href="#" class="vp-canal-card vp-cc-call-card">
                    <div class="vp-canal-icon-circle"><i class="fas fa-phone-alt vp-cc-call"></i></div>
                    <h3>Call Center</h3>
                    <p>Llámanos y un asesor te guiará</p>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════════ 3. CENTROS DE EXPERIENCIA ═══════════════ -->
    <section class="vp-centros" id="centros">
        <div class="sn-container">
            <h2>Nuestros Centros de Experiencia</h2>
            <div class="vp-centros-grid">
                <!-- Sincelejo -->
                <div class="vp-centro-glass-card">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/centro_sincelejo.jpg" alt="Sede Sincelejo" class="vp-centro-img">
                    <h3>Sincelejo</h3>
                    <p>Cl. 25 #20-30, Sincelejo</p>
                    <a href="#" class="vp-btn-gold">Cómo llegar</a>
                </div>
                <!-- Cartagena -->
                <div class="vp-centro-glass-card">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/centro_cartagena.jpg" alt="Sede Cartagena" class="vp-centro-img">
                    <h3>Cartagena</h3>
                    <p>Av. Santander #8-15, Cartagena</p>
                    <a href="#" class="vp-btn-gold">Cómo llegar</a>
                </div>
                <!-- Montería -->
                <div class="vp-centro-glass-card">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/centro_monteria.jpg" alt="Sede Montería" class="vp-centro-img">
                    <h3>Montería</h3>
                    <p>Cra. 2 #30-40, Montería</p>
                    <a href="#" class="vp-btn-gold">Cómo llegar</a>
                </div>
            </div>

            <!-- Map Illustration -->
            <div class="vp-map-container">
                <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/mapa_sedes.png" alt="Mapa Sedes Colombia Northern Coast">
            </div>
        </div>
    </section>

    <!-- ═══════════════ 4. METRICAS SPLIT ═══════════════ -->
    <section class="vp-metricas-split" id="metricas">
        <!-- Left Side: Starry -->
        <div class="vp-ms-dark">
            <div class="vp-metrica-glass-card">
                <h4>1,000+</h4>
                <div class="content">
                    <i class="fas fa-users"></i>
                    <label>Clientes<br>Satisfechos</label>
                </div>
            </div>
            <div class="vp-metrica-glass-card">
                <h4>300+</h4>
                <div class="content">
                    <i class="fas fa-box"></i>
                    <label>Productos<br>Disponibles</label>
                </div>
            </div>
        </div>
        <!-- Right Side: Gold -->
        <div class="vp-ms-gold">
            <div class="vp-metrica-glass-card">
                <h4>7+</h4>
                <div class="content">
                    <i class="fas fa-university"></i>
                    <label>Aliados<br>Financieros</label>
                </div>
            </div>
            <div class="vp-metrica-glass-card">
                <h4>3</h4>
                <div class="content">
                    <i class="fas fa-map-marked-alt"></i>
                    <label>Ciudades con<br>Presencia</label>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ FOOTER ═══════════════ -->
    <footer class="sn-footer">
        <div class="sn-container">
            <p>&copy; <?php echo date('Y') ?> <?php echo $nombre ?>. Vibe Premium Experience.</p>
        </div>
    </footer>

    <!-- ═══════════════ 5. STICKY & FLOATING ACTIONS ═══════════════ -->
    <div class="vp-sticky-bar" id="vp-sticky">
        <div class="vp-sticky-text">¿Listo para tu <span>crédito</span>?</div>
        <a href="#" class="vp-btn-gold">Simular Crédito</a>
        <a href="#" style="background:#25D366; color:#fff; padding:10px; border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <div class="vp-floating-actions">
        <!-- WhatsApp with badge -->
        <a href="#" class="vp-float-btn vp-fb-whatsapp">
            <i class="fab fa-whatsapp"></i>
            <span>WhatsApp</span>
            <div class="vp-badge">2</div>
        </a>
        <!-- Simulator -->
        <a href="#" class="vp-float-btn vp-fb-simular">
            <i class="fas fa-calculator"></i>
            <span>Simular</span>
        </a>
        <!-- Call -->
        <a href="#" class="vp-float-btn vp-fb-llamar">
            <i class="fas fa-phone"></i>
            <span>Llamar</span>
        </a>
    </div>

    <!-- Scripts -->
    <script>
        // Scroll interaction for Sticky Bar
        window.addEventListener('scroll', () => {
            const bar = document.getElementById('vp-sticky');
            if (window.scrollY > 400) {
                bar.classList.add('visible');
            } else {
                bar.classList.remove('visible');
            }
            
            // Navbar effect
            const nav = document.getElementById('sn-navbar');
            if (window.scrollY > 60) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // 3D Tilt Effect for cards (Optional but recommended for the vibe)
        document.querySelectorAll('.vp-arch-node, .vp-centro-glass-card, .vp-canal-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = ((y - centerY) / centerY) * -10;
                const rotateY = ((x - centerX) / centerX) * 10;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        });
    </script>
</body>
</html>
