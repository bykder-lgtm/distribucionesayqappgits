<?php 
$nombre_pagina          = "Inicio";
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
    <title><?php echo $nombre ?> — Tu Aliado Financiero | <?php echo $keywords ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="author" content="<?php echo $author ?>">
    <meta property="og:url" content="<?php echo $pagina_local ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $nombre ?> — Tu Aliado Financiero" />
    <meta property="og:description" content="<?php echo $description ?>" />
    <meta property="og:image" content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/hero_background.png" />
    <meta property="og:site_name" content="<?php echo $nombre ?>"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $nombre ?> — Tu Aliado Financiero">
    <meta name="twitter:description" content="<?php echo $description ?>">
    <meta name="twitter:image" content="<?php echo ($url_pag) ?>/<?php echo ($nombre_carpeta_pagina) ?>/imagenes/hero_background.png">
    <link href="<?php echo $nombre_carpeta_pagina ?>/imagenes/icono.ico" type="image/x-icon" rel="shortcut icon" />
    <?php include_once($nombre_carpeta_pagina."/admin/03_modulo_css_visitante_extnosesion_extern.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/sitio_nuevo.css">
    <link rel="stylesheet" href="<?php echo $nombre_carpeta_pagina ?>/estilo_css/sitio_nuevo_secciones.css">
</head>

<body class="sitio-nuevo">

    <!-- ═══════════════ NAVBAR ═══════════════ -->
    <nav class="sn-navbar" id="sn-navbar">
        <div class="sn-container">
            <a href="index_nuevo.php" class="sn-navbar-brand">
                <img src="<?php echo ($nombre_carpeta_pagina) ?>/imagenes/logo.png" alt="<?php echo $nombre ?>">
                <span><?php echo $nombre ?></span>
            </a>
            <ul class="sn-nav-links" id="sn-nav-links">
                <button class="sn-nav-close" id="sn-nav-close" aria-label="Cerrar menú">&times;</button>
                <li><a href="index_nuevo.php">Inicio</a></li>
                <li><a href="#como-funciona">Cómo Funciona</a></li>
                <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/ver_catalogo_producto_visitante_extnosesion.php">Catálogo</a></li>
                <li><a href="#arquitectura">Aliados</a></li>
                <li><a href="#centros">Sedes</a></li>
                <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/contactanos_visitante_extnosesion.php">Contacto</a></li>
                <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/entrar_escoger_intern.php" class="sn-nav-cta">Ingresar</a></li>
            </ul>
            <button class="sn-nav-toggle" id="sn-nav-toggle" aria-label="Abrir menú">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ═══════════════ HERO SECTION (Enhanced #1) ═══════════════ -->
    <section class="sn-hero" id="hero">
        <canvas id="sn-particles-canvas"></canvas>
        <div class="sn-hero-bg">
            <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/hero_background.png" alt="Hero Background">
        </div>
        <div class="sn-hero-orb sn-hero-orb--gold"></div>
        <div class="sn-hero-orb sn-hero-orb--blue"></div>
        <div class="sn-container">
            <div class="sn-hero-content">
                <div class="sn-hero-text">
                    <div class="sn-hero-badge">
                        <span class="pulse-dot"></span>
                        <?php echo $eslogan ?>
                    </div>
                    <!-- #10 Trust Badges -->
                    <div class="sn-hero-trust-badges">
                        <span class="sn-trust-badge"><i class="fas fa-check-circle"></i> +7 Aliados financieros</span>
                        <span class="sn-trust-badge"><i class="fas fa-check-circle"></i> Aprobación rápida</span>
                        <span class="sn-trust-badge"><i class="fas fa-check-circle"></i> Sin papeleo</span>
                    </div>
                    <h1>Tu mejor aliado en <span class="sn-gradient-animate">soluciones financieras</span> y distribución</h1>
                    <p class="sn-hero-desc">Ofrecemos las mejores líneas de crédito con aliados financieros de confianza. Accede a nuestro catálogo y simula tu crédito al instante.</p>
                    <div class="sn-hero-actions">
                        <a href="simulador.php" class="sn-btn sn-btn-primary sn-glow-pulse"><i class="fas fa-calculator"></i> Simular Crédito</a>
                        <a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/ver_catalogo_producto_visitante_extnosesion.php" class="sn-btn sn-btn-outline"><i class="fas fa-store"></i> Ver Catálogo</a>
                    </div>
                    <div class="sn-hero-stats">
                        <?php
                        $sql_count_ent = "SELECT COUNT(*) as total FROM tbl15_entidad_crediticia WHERE (cod_estado = '1')";
                        $res_count_ent = mysqli_query($conectar, $sql_count_ent);
                        $data_count_ent = mysqli_fetch_assoc($res_count_ent);
                        $total_entidades = isset($data_count_ent['total']) ? $data_count_ent['total'] : '5';
                        $sql_count_prod = "SELECT COUNT(*) as total FROM tbl15_producto WHERE (cod_estado = '1')";
                        $res_count_prod = mysqli_query($conectar, $sql_count_prod);
                        $data_count_prod = mysqli_fetch_assoc($res_count_prod);
                        $total_productos = isset($data_count_prod['total']) ? $data_count_prod['total'] : '100';
                        $sql_count_cat = "SELECT COUNT(*) as total FROM tbl15_categoria WHERE (cod_estado = '1')";
                        $res_count_cat = mysqli_query($conectar, $sql_count_cat);
                        $data_count_cat = mysqli_fetch_assoc($res_count_cat);
                        $total_categorias = isset($data_count_cat['total']) ? $data_count_cat['total'] : '10';
                        ?>
                        <div class="sn-hero-stat"><div class="number"><?php echo $total_entidades ?>+</div><div class="label">Aliados Financieros</div></div>
                        <div class="sn-hero-stat"><div class="number"><?php echo $total_productos ?>+</div><div class="label">Productos</div></div>
                        <div class="sn-hero-stat"><div class="number"><?php echo $total_categorias ?>+</div><div class="label">Categorías</div></div>
                    </div>
                </div>
                <div class="sn-hero-visual">
                    <div class="sn-hero-card">
                        <h3><i class="fas fa-bolt" style="color:var(--color-secondary)"></i> Simulador Rápido</h3>
                        <form name="formulario_hero" method="POST" autocomplete="off" action="app/admin/simulador_libre_visitante_extnosesion_resultado.php">
                            <div class="sn-sim-input-group">
                                <label for="hero_precio_formateado">Valor del producto de contado</label>
                                <input type="text" name="precio_venta_producto_formateado" id="hero_precio_formateado" placeholder="Ej: 2,500,000" required>
                                <input type="hidden" name="precio_venta_producto" id="hero_precio_venta">
                            </div>
                            <input type="hidden" name="nombre_tipo_origen_simulacion" value="SIMULACION_VALOR_LIBRE">
                            <input type="hidden" name="cod_producto_codifcryp" value="">
                            <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
                            <input type="hidden" name="insertar_datos" value="formulario">
                            <button type="submit" class="sn-btn sn-btn-primary"><i class="fas fa-paper-plane"></i> Simular Ahora</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- #11 Wave Divider: Hero → Trust Strip -->
    <div class="sn-wave-divider" style="background:transparent">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path fill="#0A1628" d="M0,40 C360,80 720,0 1080,40 C1260,60 1380,20 1440,40 L1440,80 L0,80 Z" opacity="0.6"/>
            <path fill="#0A1628" d="M0,50 C240,10 480,70 720,30 C960,0 1200,60 1440,30 L1440,80 L0,80 Z" opacity="0.8"/>
            <path fill="#0A1628" d="M0,60 C180,40 360,70 540,50 C720,30 900,60 1080,40 C1260,20 1380,50 1440,40 L1440,80 L0,80 Z"/>
        </svg>
    </div>

    <!-- ═══════════════ TRUST STRIP ═══════════════ -->
    <section class="sn-trust-strip">
        <div class="sn-container">
            <p>Aliados Financieros de Confianza</p>
            <div class="sn-trust-logos">
                <?php
                $sql_aliados = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') ORDER BY cod_entidad_crediticia ASC LIMIT 8";
                $res_aliados = mysqli_query($conectar, $sql_aliados);
                if ($res_aliados && mysqli_num_rows($res_aliados) > 0) {
                    while ($aliado = mysqli_fetch_assoc($res_aliados)) {
                        $nombre_aliado = $aliado['nombre_entidad_crediticia'];
                        $img_aliado = isset($aliado['url_img_entidad_crediticia_orig']) ? $aliado['url_img_entidad_crediticia_orig'] : '';
                        if ($img_aliado != '') { ?>
                    <img src="<?php echo $nombre_carpeta_pagina ?>/<?php echo $nombre_carpeta_pagina ?>/<?php echo $img_aliado ?>" alt="<?php echo $nombre_aliado ?>" title="<?php echo $nombre_aliado ?>">
                <?php } } } else { ?>
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/aliado_financiero_bancolombia.png" alt="Bancolombia">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/imagenes/aliado_financiero_brilla.png" alt="Brilla">
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- ═══════════════ SECCIONES NUEVAS PARTE 1 ═══════════════ -->
    <?php include_once($nombre_carpeta_pagina."/admin/secciones_nuevas_1.php"); ?>

    <!-- ═══════════════ SERVICES (¿Por qué elegirnos?) ═══════════════ -->
    <section class="sn-section sn-services" id="servicios">
        <div class="sn-container">
            <div class="sn-section-title">
                <div class="sn-accent-line"></div>
                <h2>¿Por qué elegirnos?</h2>
                <p>Soluciones integrales que transforman tu experiencia de compra</p>
            </div>
            <div class="sn-services-grid">
                <div class="sn-service-card sn-fade-up">
                    <div class="sn-service-icon"><i class="fas fa-hand-holding-dollar" style="color:var(--color-secondary)"></i></div>
                    <h3>Financiamiento Flexible</h3>
                    <p>Múltiples líneas de crédito con las mejores entidades financieras. Tasas competitivas y plazos ajustados.</p>
                </div>
                <div class="sn-service-card sn-fade-up">
                    <div class="sn-service-icon"><i class="fas fa-shield-halved" style="color:var(--color-accent-light)"></i></div>
                    <h3>Proceso Seguro</h3>
                    <p>Tus datos y transacciones están protegidos con los más altos estándares de seguridad.</p>
                </div>
                <div class="sn-service-card sn-fade-up">
                    <div class="sn-service-icon"><i class="fas fa-clock" style="color:var(--color-success)"></i></div>
                    <h3>Aprobación Rápida</h3>
                    <p>Respuestas ágiles para que obtengas lo que necesitas sin demoras innecesarias.</p>
                </div>
                <div class="sn-service-card sn-fade-up">
                    <div class="sn-service-icon"><i class="fas fa-headset" style="color:var(--color-warning)"></i></div>
                    <h3>Atención Personalizada</h3>
                    <p>Un equipo de asesores dedicados a brindarte la mejor experiencia en todo momento.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ CATEGORIES ═══════════════ -->
    <section class="sn-section sn-categories" id="catalogo">
        <div class="sn-container">
            <div class="sn-section-title">
                <div class="sn-accent-line"></div>
                <h2>Nuestras Categorías</h2>
                <p>Explora nuestro amplio catálogo de productos</p>
            </div>
            <div class="sn-cat-grid">
                <?php
                $sql_cats = "SELECT * FROM tbl15_categoria WHERE (cod_estado = '1') ORDER BY cod_categoria ASC";
                $consulta_cats = mysqli_query($conectar, $sql_cats) or die(mysqli_error($conectar));
                while ($cat = mysqli_fetch_assoc($consulta_cats)) {
                    $nombre_cat = $cat['nombre_categoria'];
                    $nombre_cat_codif = DAXCODIFCRYPTOR::encodiftextodax($nombre_cat);
                    $nombre_cat_codifcryp = DAXCODIFCRYPTOR::encriptardax($nombre_cat_codif);
                    $desc_cat = $cat['descripcion_categoria'];
                    $url_cat_orig = $cat['url_categoria_orig'];
                ?>
                <a href="<?php echo $nombre_carpeta_pagina ?>/admin/ver_catalogo_producto_visitante_extnosesion.php?nombre_categoria_codifcryp=<?php echo $nombre_cat_codifcryp ?>" class="sn-cat-card sn-fade-up">
                    <img src="<?php echo $nombre_carpeta_pagina ?>/<?php echo $nombre_carpeta_pagina ?>/<?php echo $url_cat_orig ?>" alt="<?php echo $nombre_cat ?>">
                    <div class="sn-cat-card-overlay">
                        <h3><?php echo $nombre_cat ?></h3>
                        <p><?php echo substr($desc_cat, 0, 80) ?></p>
                        <span class="sn-cat-btn">Ver productos <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- #11 Wave Divider: Catálogo → Secciones 2 -->
    <div class="sn-wave-divider" style="background:var(--color-primary)">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path fill="var(--color-primary)" d="M0,40 C360,80 720,0 1080,40 C1260,60 1380,20 1440,40 L1440,80 L0,80 Z" opacity="0.4"/>
            <path fill="var(--color-primary)" d="M0,60 C480,20 960,80 1440,30 L1440,80 L0,80 Z" opacity="0.7"/>
        </svg>
    </div>

    <!-- ═══════════════ SECCIONES NUEVAS PARTE 2 ═══════════════ -->
    <?php include_once($nombre_carpeta_pagina."/admin/secciones_nuevas_2.php"); ?>

    <!-- ═══════════════ CTA FINAL ═══════════════ -->
    <section class="sn-section sn-cta">
        <div class="sn-container">
            <div class="sn-cta-content sn-fade-up">
                <h2>¿Listo para encontrar tu producto ideal?</h2>
                <p>Simula tu crédito en segundos y descubre cuánto puedes adquirir con nuestras opciones.</p>
                <div class="sn-cta-actions">
                    <a href="simulador.php" class="sn-btn sn-btn-primary"><i class="fas fa-calculator"></i> Simular Crédito</a>
                    <a href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>&text=Hola%2C%20me%20interesa%20información" target="_blank" class="sn-btn sn-btn-outline"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ FOOTER ═══════════════ -->
    <footer class="sn-footer">
        <div class="sn-container">
            <div class="sn-footer-grid">
                <div class="sn-footer-brand">
                    <a href="index_nuevo.php" class="sn-navbar-brand" style="margin-bottom:var(--space-sm)">
                        <img src="<?php echo ($nombre_carpeta_pagina) ?>/imagenes/logo.png" alt="<?php echo $nombre ?>" style="height:40px">
                        <span style="font-size:1.1rem"><?php echo $nombre ?></span>
                    </a>
                    <p><?php echo $description ?></p>
                    <div class="sn-footer-socials">
                        <?php if ($url_redsocial_facebook != '') { ?><a href="<?php echo $url_redsocial_facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php } ?>
                        <?php if ($url_redsocial_instagram != '') { ?><a href="<?php echo $url_redsocial_instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php } ?>
                        <?php if ($url_redsocial_tiktok != '') { ?><a href="<?php echo $url_redsocial_tiktok ?>" target="_blank"><i class="fab fa-tiktok"></i></a><?php } ?>
                        <?php if ($url_redsocial_youtube != '') { ?><a href="<?php echo $url_redsocial_youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a><?php } ?>
                        <?php if ($tel1 != '') { ?><a href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>" target="_blank"><i class="fab fa-whatsapp"></i></a><?php } ?>
                    </div>
                </div>
                <div class="sn-footer-col">
                    <h4>Navegación</h4>
                    <ul>
                        <li><a href="index_nuevo.php">Inicio</a></li>
                        <li><a href="#como-funciona">Cómo Funciona</a></li>
                        <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/ver_catalogo_producto_visitante_extnosesion.php">Catálogo</a></li>
                        <li><a href="simulador.php">Simulador</a></li>
                    </ul>
                </div>
                <div class="sn-footer-col">
                    <h4>Servicios</h4>
                    <ul>
                        <li><a href="#arquitectura">Aliados Financieros</a></li>
                        <li><a href="#centros">Centros de Experiencia</a></li>
                        <li><a href="<?php echo ($nombre_carpeta_pagina) ?>/admin/entrar_escoger_intern.php">Plataforma</a></li>
                    </ul>
                </div>
                <div class="sn-footer-col">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-map-marker-alt" style="margin-right:8px;color:var(--color-secondary)"></i><?php echo $direccion ?> — <?php echo $localidad ?></a></li>
                        <li><a href="tel:+57<?php echo $tel1 ?>"><i class="fas fa-phone" style="margin-right:8px;color:var(--color-secondary)"></i><?php echo $tel1 ?></a></li>
                        <li><a href="mailto:<?php echo $correo ?>"><i class="fas fa-envelope" style="margin-right:8px;color:var(--color-secondary)"></i><?php echo $correo ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="sn-footer-bottom">
                <p>&copy; <?php echo date('Y') ?> <?php echo $nombre ?>. Todos los derechos reservados.</p>
                <p>NIT: <?php echo $nit_empresa ?> | <?php echo $regimen ?></p>
            </div>
        </div>
    </footer>

    <!-- ═══════════════ #9. CTA STICKY + FLOATING ═══════════════ -->
    <div class="sn-sticky-bar" id="sn-sticky-bar">
        <div class="sn-container">
            <span class="sn-sticky-bar-text">¿Listo para tu <span>crédito</span>?</span>
            <div class="sn-sticky-bar-actions">
                <a href="simulador.php" class="sn-btn sn-btn-primary"><i class="fas fa-calculator"></i> Simular Crédito</a>
                <a href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>" target="_blank" class="sn-btn sn-btn-outline" style="border-color:#25D366;color:#25D366"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>
        </div>
    </div>
    <div class="sn-floating-side" id="sn-floating-side">
        <a href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>" target="_blank" class="sn-float-btn btn-whatsapp"><i class="fab fa-whatsapp"></i></a>
        <a href="simulador.php" class="sn-float-btn btn-simular"><i class="fas fa-calculator"></i></a>
        <a href="tel:+57<?php echo $tel1 ?>" class="sn-float-btn btn-llamar"><i class="fas fa-phone"></i></a>
    </div>

    <!-- ═══════════════ SCRIPTS ═══════════════ -->
    <script>
    // ── Navbar scroll ──
    const navbar = document.getElementById('sn-navbar');
    const stickyBar = document.getElementById('sn-sticky-bar');
    const floatingSide = document.getElementById('sn-floating-side');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 60);
        const show = window.scrollY > 400;
        stickyBar.classList.toggle('visible', show);
        floatingSide.classList.toggle('visible', show);
    });

    // ── Mobile nav ──
    document.getElementById('sn-nav-toggle').addEventListener('click', () => { document.getElementById('sn-nav-links').classList.add('active'); document.body.style.overflow='hidden'; });
    document.getElementById('sn-nav-close').addEventListener('click', () => { document.getElementById('sn-nav-links').classList.remove('active'); document.body.style.overflow=''; });
    document.querySelectorAll('#sn-nav-links a').forEach(l => l.addEventListener('click', () => { document.getElementById('sn-nav-links').classList.remove('active'); document.body.style.overflow=''; }));

    // ── Scroll Reveal ──
    const obs = new IntersectionObserver((entries) => { entries.forEach(e => { if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);} }); }, {threshold:0.1, rootMargin:'0px 0px -50px 0px'});
    document.querySelectorAll('.sn-fade-up').forEach(el => obs.observe(el));

    // ── Hero input format ──
    const hpf = document.getElementById('hero_precio_formateado');
    if(hpf) hpf.addEventListener('keyup', (e)=>{ const f=formatNum(e.target.value); e.target.value=f; document.getElementById('hero_precio_venta').value=f.replace(/[.,]/g,''); });
    function formatNum(n){ let v=String(n).replace(/\D/g,''); return v===''?v:Number(v).toLocaleString(); }

    // ── Counter Animation (#12) ──
    function animateMetricCounters(){
        document.querySelectorAll('.sn-metrica-number').forEach(c=>{
            const target=parseInt(c.dataset.target)||0;
            const suffix=c.querySelector('span')?c.querySelector('span').textContent:'';
            let cur=0; const dur=2000; const step=Math.ceil(target/(dur/16));
            const ani=()=>{ cur+=step; if(cur>=target){c.innerHTML=target.toLocaleString()+(suffix?'<span>'+suffix+'</span>':'');return;} c.innerHTML=cur.toLocaleString()+(suffix?'<span>'+suffix+'</span>':''); requestAnimationFrame(ani); };
            ani();
        });
    }
    const metObs = new IntersectionObserver((entries)=>{ entries.forEach(e=>{if(e.isIntersecting){animateMetricCounters();metObs.unobserve(e.target);}}); },{threshold:0.3});
    const metSec = document.getElementById('metricas');
    if(metSec) metObs.observe(metSec);

    // ── Hero counters ──
    function animateCounters(){
        document.querySelectorAll('.sn-hero-stat .number').forEach(c=>{
            const t=c.textContent; const n=parseInt(t.replace(/\D/g,'')); const s=t.replace(/[0-9]/g,'');
            let cur=0; const step=Math.ceil(n/(2000/16));
            const ani=()=>{cur+=step;if(cur>=n){c.textContent=n+s;return;}c.textContent=cur+s;requestAnimationFrame(ani);};ani();
        });
    }
    const hObs=new IntersectionObserver((e)=>{e.forEach(en=>{if(en.isIntersecting){animateCounters();hObs.unobserve(en.target);}});},{threshold:0.5});
    const hs=document.getElementById('hero'); if(hs) hObs.observe(hs);

    // ── FAQ Toggle (#13) ──
    function toggleFaq(btn){ const item=btn.parentNode; const wasActive=item.classList.contains('active'); document.querySelectorAll('.sn-faq-item').forEach(i=>i.classList.remove('active')); if(!wasActive) item.classList.add('active'); }

    // ── Simulator Sliders (#2) ──
    const simMonto=document.getElementById('sim-monto');
    const simCuotas=document.getElementById('sim-cuotas');
    function updateSimBreakdown(){
        if(!simMonto) return;
        const m=parseInt(simMonto.value); const c=parseInt(simCuotas.value);
        document.getElementById('sim-monto-display').textContent='$'+m.toLocaleString();
        document.getElementById('sim-cuotas-display').textContent=c+' Cuotas';
        const capital=Math.round(m/c); const interes=Math.round(m*0.02*c/c); const admin=Math.round(m*0.005);
        const total=capital+interes+admin;
        document.getElementById('sim-capital').textContent='$'+capital.toLocaleString();
        document.getElementById('sim-interes').textContent='$'+interes.toLocaleString();
        document.getElementById('sim-admin').textContent='$'+admin.toLocaleString();
        document.getElementById('sim-total').textContent='$'+total.toLocaleString();
    }
    if(simMonto){ simMonto.addEventListener('input',updateSimBreakdown); simCuotas.addEventListener('input',updateSimBreakdown); updateSimBreakdown(); }

    // ── Star Particles Canvas (#1 / #11) ──
    const canvas=document.getElementById('sn-particles-canvas');
    if(canvas){
        const ctx=canvas.getContext('2d');
        let stars=[];
        function resizeCanvas(){canvas.width=canvas.parentElement.offsetWidth;canvas.height=canvas.parentElement.offsetHeight;}
        resizeCanvas(); window.addEventListener('resize',resizeCanvas);
        function initStars(){stars=[];for(let i=0;i<120;i++){stars.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,r:Math.random()*1.8+0.3,a:Math.random(),da:Math.random()*0.02-0.01,dx:Math.random()*0.3-0.15,dy:Math.random()*0.3-0.15});}}
        initStars();
        function drawStars(){ctx.clearRect(0,0,canvas.width,canvas.height);stars.forEach(s=>{s.x+=s.dx;s.y+=s.dy;s.a+=s.da;if(s.a>1||s.a<0)s.da=-s.da;if(s.x<0)s.x=canvas.width;if(s.x>canvas.width)s.x=0;if(s.y<0)s.y=canvas.height;if(s.y>canvas.height)s.y=0;ctx.beginPath();ctx.arc(s.x,s.y,s.r,0,Math.PI*2);ctx.fillStyle='rgba(255,255,255,'+Math.abs(s.a)+')';ctx.fill();});requestAnimationFrame(drawStars);}
        drawStars();
    }

    // ── #11 Tilt 3D Effect on Cards ──
    document.querySelectorAll('.sn-tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -8;
            const rotateY = ((x - centerX) / centerX) * 8;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.03,1.03,1.03)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1,1,1)';
        });
    });

    // ── #11 Magnetic Button Effect ──
    document.querySelectorAll('.sn-magnetic').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0px, 0px)';
        });
    });

    // ── #11 Parallax on Scroll ──
    window.addEventListener('scroll', () => {
        const sy = window.scrollY;
        document.querySelectorAll('.sn-parallax-layer').forEach(el => {
            const speed = parseFloat(el.dataset.speed) || 0.05;
            el.style.transform = `translateY(${sy * speed}px)`;
        });
    });

    // ── #11 Extra Entrance Animations ──
    const entranceObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if(e.isIntersecting) {
                e.target.classList.add('visible');
                entranceObs.unobserve(e.target);
            }
        });
    }, {threshold: 0.1, rootMargin: '0px 0px -40px 0px'});
    document.querySelectorAll('.sn-slide-in-left, .sn-slide-in-right, .sn-scale-in').forEach(el => entranceObs.observe(el));

    // ── Smooth scroll ──
    document.querySelectorAll('a[href^="#"]').forEach(a=>{a.addEventListener('click',function(e){e.preventDefault();const t=document.querySelector(this.getAttribute('href'));if(t)t.scrollIntoView({behavior:'smooth',block:'start'});});});
    </script>
</body>
</html>
