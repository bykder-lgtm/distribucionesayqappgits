
<!-- ═══════════════ 6. CENTROS DE EXPERIENCIA ═══════════════ -->
<section class="sn-section sn-centros" id="centros">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Nuestros Centros de Experiencia</h2>
            <p>Visítanos en nuestras sedes y vive la experiencia de compra</p>
        </div>
        <div class="sn-centros-grid">
            <?php
            $centros = [
                ['ciudad'=>'Sincelejo','desc'=>'Sucre — Centro comercial y punto de venta principal','img'=>'centro_sincelejo.jpg'],
                ['ciudad'=>'Cartagena','desc'=>'Bolívar — Sede de experiencia y distribución costera','img'=>'centro_cartagena.jpg'],
                ['ciudad'=>'Montería','desc'=>'Córdoba — Centro de operaciones y atención al cliente','img'=>'centro_monteria.jpg']
            ];
            foreach($centros as $centro) {
                $imgPath = $nombre_carpeta_pagina.'/imagenes/'.$centro['img'];
            ?>
            <div class="sn-centro-card sn-fade-up">
                <img src="<?php echo $imgPath ?>" alt="<?php echo $centro['ciudad'] ?>" onerror="this.src='<?php echo $nombre_carpeta_pagina ?>/imagenes/quienes_somos.jpg'">
                <div class="sn-centro-overlay">
                    <h3><?php echo $centro['ciudad'] ?></h3>
                    <p><?php echo $centro['desc'] ?></p>
                    <span class="sn-centro-btn"><i class="fas fa-map-marker-alt"></i> Cómo llegar</span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ═══════════════ 7. ECOSISTEMA DISTRIBUCIONES ═══════════════ -->
<section class="sn-section sn-ecosistema" id="ecosistema">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Ecosistema Distribuciones A&Q</h2>
            <p>Una operación integral que cubre cada eslabón de la cadena</p>
        </div>
        <div class="sn-eco-grid">
            <?php
            $eco_items = [
                ['titulo'=>'Call Center y Soporte','badge'=>'SOPORTE','desc'=>'Gestión de cartera y atención al cliente personalizada','icon'=>'fas fa-headset','img'=>'eco_callcenter.jpg'],
                ['titulo'=>'Venta Online','badge'=>'DIGITAL','desc'=>'Plataforma de ventas digitales y catálogo en línea','icon'=>'fas fa-laptop','img'=>'eco_venta_online.jpg'],
                ['titulo'=>'Promotores TAT','badge'=>'CAMPO','desc'=>'Acompañamiento y visitas puerta a puerta','icon'=>'fas fa-walking','img'=>'eco_promotores.jpg'],
                ['titulo'=>'Tiendas Físicas','badge'=>'RETAIL','desc'=>'Puntos de venta y distribución mayorista','icon'=>'fas fa-store','img'=>'eco_tiendas.jpg'],
                ['titulo'=>'Logística','badge'=>'OPERACIONES','desc'=>'Infraestructura de distribución y entregas','icon'=>'fas fa-truck','img'=>'eco_logistica.jpg'],
                ['titulo'=>'Eventos Comerciales','badge'=>'MARKETING','desc'=>'Tropas de venta, ferias y activaciones de marca','icon'=>'fas fa-calendar-check','img'=>'eco_eventos.jpg']
            ];
            foreach($eco_items as $eco) {
                $ecoImg = $nombre_carpeta_pagina.'/imagenes/'.$eco['img'];
            ?>
            <div class="sn-eco-card sn-fade-up sn-shimmer sn-hover-lift">
                <img src="<?php echo $ecoImg ?>" alt="<?php echo $eco['titulo'] ?>" onerror="this.style.display='none';this.parentNode.style.background='linear-gradient(135deg,#132241,#1B2D50)'">
                <div class="sn-eco-card-overlay">
                    <span class="sn-eco-badge"><i class="<?php echo $eco['icon'] ?>"></i> <?php echo $eco['badge'] ?></span>
                    <h3><?php echo $eco['titulo'] ?></h3>
                    <p><?php echo $eco['desc'] ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ═══════════════ 14. CANALES DE ACCESO ═══════════════ -->
<section class="sn-section sn-canales" id="canales">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Solicita por el Canal que Prefieras</h2>
            <p>Te ofrecemos múltiples formas de acceder a nuestros servicios</p>
        </div>
        <div class="sn-canales-grid">
            <a href="https://api.whatsapp.com/send?phone=57<?php echo $tel1 ?>&text=Hola%2C%20me%20interesa%20información" target="_blank" class="sn-canal-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-canal-icon"><i class="fab fa-whatsapp"></i></div>
                <h3>WhatsApp</h3>
                <p>Escríbenos y un asesor te atenderá al instante</p>
            </a>
            <a href="#centros" class="sn-canal-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-canal-icon"><i class="fas fa-store"></i></div>
                <h3>Tienda Física</h3>
                <p>Visítanos en nuestros centros de experiencia</p>
            </a>
            <a href="simulador.php" class="sn-canal-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-canal-icon"><i class="fas fa-laptop"></i></div>
                <h3>Simulador Web</h3>
                <p>Simula tu crédito desde cualquier lugar</p>
            </a>
            <a href="tel:+57<?php echo $tel1 ?>" class="sn-canal-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-canal-icon"><i class="fas fa-headset"></i></div>
                <h3>Call Center</h3>
                <p>Llámanos y un asesor te guiará en el proceso</p>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════ 10. REQUISITOS ═══════════════ -->
<section class="sn-section sn-requisitos" id="requisitos">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>¿Qué Necesitas para Solicitar?</h2>
            <p>Requisitos simples para acceder a tu crédito</p>
        </div>
        <div class="sn-requisitos-grid">
            <div class="sn-requisito-card sn-fade-up sn-hover-lift">
                <div class="sn-requisito-icon"><i class="fas fa-id-card"></i></div>
                <h3>Cédula de Ciudadanía</h3>
                <p>Ser colombiano mayor de edad (18 años)</p>
            </div>
            <div class="sn-requisito-card sn-fade-up sn-hover-lift">
                <div class="sn-requisito-icon"><i class="fas fa-file-invoice"></i></div>
                <h3>Factura de Servicio</h3>
                <p>Recibo de servicio público reciente a tu nombre</p>
            </div>
            <div class="sn-requisito-card sn-fade-up sn-hover-lift">
                <div class="sn-requisito-icon"><i class="fas fa-credit-card"></i></div>
                <h3>Medio de Pago</h3>
                <p>Cuenta bancaria o medio de pago autorizado</p>
            </div>
            <div class="sn-requisito-card sn-fade-up sn-hover-lift">
                <div class="sn-requisito-icon"><i class="fas fa-file-signature"></i></div>
                <h3>Firma del Contrato</h3>
                <p>Aceptación de términos y condiciones</p>
            </div>
        </div>
        <div style="text-align:center">
            <a href="simulador.php" class="sn-btn sn-btn-primary sn-glow-pulse sn-magnetic"><i class="fas fa-calculator"></i> Solicita Ahora</a>
        </div>
    </div>
</section>

<!-- #11 Wave Divider: Requisitos → Testimonios -->
<div class="sn-wave-divider wave-flip" style="background:var(--section-light-bg)">
    <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
        <path fill="var(--section-light-bg)" d="M0,40 C360,80 720,0 1080,40 C1260,60 1380,20 1440,40 L1440,80 L0,80 Z" opacity="0.5"/>
        <path fill="var(--section-light-bg)" d="M0,55 C480,15 960,75 1440,35 L1440,80 L0,80 Z" opacity="0.8"/>
    </svg>
</div>

<!-- ═══════════════ 8. TESTIMONIOS ═══════════════ -->
<section class="sn-section sn-testimonios" id="testimonios">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Lo que Dicen Nuestros Clientes</h2>
            <p>Experiencias reales de quienes ya confiaron en nosotros</p>
        </div>
        <div class="sn-testimonios-grid">
            <?php
            $testimonios = [
                ['nombre'=>'María Rodríguez','ciudad'=>'Sincelejo','texto'=>'Excelente servicio, la aprobación fue muy rápida y las cuotas se ajustaron a mi presupuesto. ¡Quedé encantada con mi nuevo televisor!','iniciales'=>'MR'],
                ['nombre'=>'Carlos Pérez','ciudad'=>'Cartagena','texto'=>'Nunca fue tan fácil comprar a crédito. El equipo de Distribuciones A&Q me asesoró en todo el proceso. Totalmente recomendado.','iniciales'=>'CP'],
                ['nombre'=>'Ana Martínez','ciudad'=>'Montería','texto'=>'La variedad de líneas de crédito me permitió elegir la opción perfecta. Proceso transparente y sin complicaciones.','iniciales'=>'AM']
            ];
            foreach($testimonios as $test) { ?>
            <div class="sn-testimonio-card sn-fade-up">
                <div class="sn-testimonio-quote">"</div>
                <p><?php echo $test['texto'] ?></p>
                <div class="sn-testimonio-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <div class="sn-testimonio-author">
                    <div class="sn-testimonio-avatar"><?php echo $test['iniciales'] ?></div>
                    <div class="sn-testimonio-info">
                        <strong><?php echo $test['nombre'] ?></strong>
                        <span><?php echo $test['ciudad'] ?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ═══════════════ 12. CONTADORES MÉTRICAS ═══════════════ -->
<section class="sn-section sn-metricas" id="metricas">
    <div class="sn-container">
        <div class="sn-metricas-grid">
            <div class="sn-metrica-item sn-fade-up">
                <div class="sn-metrica-icon"><i class="fas fa-users"></i></div>
                <div class="sn-metrica-number" data-target="1000">0<span>+</span></div>
                <div class="sn-metrica-label">Clientes Satisfechos</div>
            </div>
            <div class="sn-metrica-item sn-fade-up">
                <div class="sn-metrica-icon"><i class="fas fa-handshake"></i></div>
                <div class="sn-metrica-number" data-target="<?php echo $total_entidades ?>">0<span>+</span></div>
                <div class="sn-metrica-label">Aliados Financieros</div>
            </div>
            <div class="sn-metrica-item sn-fade-up">
                <div class="sn-metrica-icon"><i class="fas fa-box-open"></i></div>
                <div class="sn-metrica-number" data-target="<?php echo $total_productos ?>">0<span>+</span></div>
                <div class="sn-metrica-label">Productos Disponibles</div>
            </div>
            <div class="sn-metrica-item sn-fade-up">
                <div class="sn-metrica-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="sn-metrica-number" data-target="3">0</div>
                <div class="sn-metrica-label">Ciudades con Presencia</div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ 13. FAQ ═══════════════ -->
<section class="sn-section sn-faq" id="faq">
    <!-- #11 Floating Particles -->
    <div class="sn-particles-deco">
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
    </div>
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Preguntas Frecuentes</h2>
            <p>Resolvemos tus dudas más comunes</p>
        </div>
        <div class="sn-faq-container">
            <?php
            $faqs = [
                ['q'=>'¿Cómo solicito un crédito?','a'=>'Puedes solicitar tu crédito a través de nuestro simulador web, visitando nuestras tiendas físicas, o contactándonos por WhatsApp. Un asesor te guiará en todo el proceso.'],
                ['q'=>'¿Cuáles son las entidades financieras aliadas?','a'=>'Contamos con aliados como Brilla, Sistecrédito, Addi, Banco de Bogotá, SU+ Pay, Bancolombia/CeroPay y PayJoy, cada uno con condiciones y beneficios diferentes.'],
                ['q'=>'¿Cuánto demora la aprobación del crédito?','a'=>'La mayoría de nuestros aliados financieros ofrecen respuesta en minutos. Dependiendo de la entidad, puedes recibir aprobación el mismo día.'],
                ['q'=>'¿Qué requisitos necesito para solicitar?','a'=>'Necesitas tu cédula de ciudadanía, una factura de servicio público reciente, un medio de pago y firmar el contrato de crédito.'],
                ['q'=>'¿Puedo realizar pagos anticipados?','a'=>'Sí, la mayoría de nuestras líneas de crédito permiten pagos anticipados sin penalidad. Consulta las condiciones específicas de cada entidad.']
            ];
            foreach($faqs as $i => $faq) { ?>
            <div class="sn-faq-item<?php echo $i===0?' active':'' ?>">
                <button class="sn-faq-question" onclick="toggleFaq(this)">
                    <span><?php echo $faq['q'] ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="sn-faq-answer"><p><?php echo $faq['a'] ?></p></div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
