
<!-- ═══════════════ 5. PASO A PASO ═══════════════ -->
<section class="sn-section sn-steps-section" id="como-funciona">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>¿Cómo Funciona?</h2>
            <p>Obtén tu crédito en 4 sencillos pasos</p>
        </div>
        <div class="sn-steps-container">
            <div class="sn-step-card sn-fade-up">
                <div class="sn-step-number">1</div>
                <div class="sn-step-icon"><i class="fas fa-shopping-bag"></i></div>
                <h3>Escoge tu Producto</h3>
                <p>Navega nuestro catálogo y elige el producto que deseas adquirir.</p>
            </div>
            <div class="sn-step-card sn-fade-up">
                <div class="sn-step-number">2</div>
                <div class="sn-step-icon"><i class="fas fa-university"></i></div>
                <h3>Elige tu Línea de Crédito</h3>
                <p>Selecciona entre nuestros aliados financieros el que mejor se adapte.</p>
            </div>
            <div class="sn-step-card sn-fade-up">
                <div class="sn-step-number">3</div>
                <div class="sn-step-icon"><i class="fas fa-calculator"></i></div>
                <h3>Simula y Compara</h3>
                <p>Usa nuestro simulador para ver cuotas y condiciones en tiempo real.</p>
            </div>
            <div class="sn-step-card sn-fade-up">
                <div class="sn-step-number">4</div>
                <div class="sn-step-icon"><i class="fas fa-check-circle"></i></div>
                <h3>Aprobación y Entrega</h3>
                <p>Recibe respuesta rápida y disfruta tu producto con financiación.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ 3. ARQUITECTURA FINANCIAMIENTO ═══════════════ -->
<section class="sn-section sn-arquitectura" id="arquitectura">
    <!-- #11 Floating Particles -->
    <div class="sn-particles-deco">
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
    </div>
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Arquitectura de Financiamiento Integrado</h2>
        </div>
        <p class="sn-arq-subtitle">Un solo ecosistema. Múltiples fuentes de capital. Una sola operación.</p>
        <div class="sn-arq-center-text sn-fade-up">
            <p><strong>ESTRUCTURA</strong> unificada de aliados financieros, integrada en un solo modelo operativo, que permite activar ventas financiadas, acelerar la colocación comercial y garantizar conversión inmediata de ingresos.</p>
        </div>
        <div class="sn-arq-grid" style="margin-top:var(--space-3xl)">
            <?php
            $aliados_arq = [
                ['nombre'=>'Brilla','desc'=>'Financiación vinculada a servicio público, con alta penetración en hogares y comercios.','icon'=>'fas fa-bolt','color'=>'#F5C518'],
                ['nombre'=>'Sistecrédito','desc'=>'Crédito digital de rápida activación para conversión masiva de ventas.','icon'=>'fas fa-credit-card','color'=>'#25D366'],
                ['nombre'=>'Addi','desc'=>'Colocación estructurada en mercado popular y crédito digital ágil para consumo inmediato.','icon'=>'fas fa-mobile-alt','color'=>'#0066FF'],
                ['nombre'=>'Banco de Bogotá','desc'=>'Línea para operaciones de mayor valor y estructura de crédito formal.','icon'=>'fas fa-landmark','color'=>'#2E86DE'],
                ['nombre'=>'SU+ Pay','desc'=>'Fintech de financiamiento, pagos y habilitación de crédito en punto de venta.','icon'=>'fas fa-wallet','color'=>'#8B5FC8'],
                ['nombre'=>'Bancolombia / CeroPay','desc'=>'Financiación inmediata 0% intereses para el cliente, con conversión directa.','icon'=>'fas fa-hand-holding-usd','color'=>'#FDCB6E'],
                ['nombre'=>'PayJoy','desc'=>'Financiación tecnológica especializada en dispositivos móviles.','icon'=>'fas fa-mobile-screen','color'=>'#EF4444']
            ];
            foreach($aliados_arq as $al) { ?>
            <div class="sn-arq-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-arq-card-logo">
                    <i class="<?php echo $al['icon'] ?>" style="color:<?php echo $al['color'] ?>"></i>
                </div>
                <h3><?php echo $al['nombre'] ?></h3>
                <p><?php echo $al['desc'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ═══════════════ 4. LIQUIDEZ INMEDIATA ═══════════════ -->
<section class="sn-section sn-liquidez" id="liquidez">
    <!-- #11 Floating Particles -->
    <div class="sn-particles-deco">
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
        <div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div><div class="sn-particle"></div>
    </div>
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Modelo de Liquidez Inmediata</h2>
        </div>
        <p class="sn-liquidez-subtitle">Venta financiada. Ingreso inmediato.</p>
        <div class="sn-arq-center-text sn-fade-up" style="margin-bottom:var(--space-3xl)">
            <p><strong>DISTRIBUCIONES A&Q</strong> permite que nuestros asociados transformen su portafolio de productos en ventas financiadas al cliente final en ingresos inmediatos, sin afectar su flujo de caja ni su capacidad operativa.</p>
        </div>
        <div class="sn-liquidez-grid">
            <?php
            $liquidez_items = [
                ['icon'=>'fas fa-sync-alt','titulo'=>'Rotación de Inventario','desc'=>'Mantenga su inventario en movimiento constante con ventas financiadas.','color'=>'#4ECDC4'],
                ['icon'=>'fas fa-project-diagram','titulo'=>'Red Comercial','desc'=>'Acceda a una red de distribución amplia y consolidada.','color'=>'#2E86DE'],
                ['icon'=>'fas fa-university','titulo'=>'Líneas Financieras','desc'=>'Múltiples opciones de crédito para todo tipo de cliente.','color'=>'#D4A843'],
                ['icon'=>'fas fa-chart-line','titulo'=>'Ingreso Inmediato','desc'=>'Reciba el pago de forma inmediata sin esperar cuotas.','color'=>'#10B981'],
                ['icon'=>'fas fa-coins','titulo'=>'Flujo de Caja','desc'=>'Aumente su capacidad de crecimiento y flujo operativo.','color'=>'#8B5FC8']
            ];
            foreach($liquidez_items as $li) { ?>
            <div class="sn-liquidez-card sn-fade-up sn-tilt-card sn-shimmer">
                <div class="sn-liquidez-icon"><i class="<?php echo $li['icon'] ?>" style="color:<?php echo $li['color'] ?>"></i></div>
                <h3><?php echo $li['titulo'] ?></h3>
                <p><?php echo $li['desc'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ═══════════════ 2. SIMULADOR VISUAL ═══════════════ -->
<section class="sn-section sn-simulador-section" id="simulador-visual">
    <div class="sn-container">
        <div class="sn-section-title">
            <div class="sn-accent-line"></div>
            <h2>Simulador de Crédito</h2>
            <p>Calcula tu cuota en tiempo real con nuestras entidades aliadas</p>
        </div>
        <div class="sn-simulador-card sn-fade-up">
            <div class="sn-sim-row">
                <div class="sn-sim-field">
                    <label>Valor del producto</label>
                    <div class="sn-sim-value" id="sim-monto-display">$1,500,000</div>
                    <input type="range" id="sim-monto" min="200000" max="10000000" step="100000" value="1500000">
                    <div class="sn-sim-range-labels"><span>$200,000</span><span>$10,000,000</span></div>
                </div>
                <div class="sn-sim-field">
                    <label>Número de cuotas</label>
                    <div class="sn-sim-value" id="sim-cuotas-display">12 Cuotas</div>
                    <input type="range" id="sim-cuotas" min="1" max="48" step="1" value="12">
                    <div class="sn-sim-range-labels"><span>1</span><span>48</span></div>
                </div>
            </div>
            <div class="sn-sim-entities">
                <label>Entidad crediticia</label>
                <div class="sn-sim-entity-pills">
                    <?php
                    $sql_sim_ent = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_estado = '1') ORDER BY cod_entidad_crediticia ASC LIMIT 8";
                    $res_sim_ent = mysqli_query($conectar, $sql_sim_ent);
                    if ($res_sim_ent && mysqli_num_rows($res_sim_ent) > 0) {
                        $first = true;
                        while ($ent_sim = mysqli_fetch_assoc($res_sim_ent)) {
                            $activeClass = $first ? ' active' : '';
                            $first = false;
                    ?>
                    <div class="sn-sim-entity-pill<?php echo $activeClass ?>" onclick="this.parentNode.querySelectorAll('.sn-sim-entity-pill').forEach(p=>p.classList.remove('active'));this.classList.add('active');updateSimBreakdown();">
                        <i class="fas fa-university"></i> <?php echo $ent_sim['nombre_entidad_crediticia'] ?>
                    </div>
                    <?php } } else { ?>
                    <div class="sn-sim-entity-pill active" onclick="this.parentNode.querySelectorAll('.sn-sim-entity-pill').forEach(p=>p.classList.remove('active'));this.classList.add('active');"><i class="fas fa-university"></i> Brilla</div>
                    <div class="sn-sim-entity-pill" onclick="this.parentNode.querySelectorAll('.sn-sim-entity-pill').forEach(p=>p.classList.remove('active'));this.classList.add('active');"><i class="fas fa-credit-card"></i> Sistecrédito</div>
                    <div class="sn-sim-entity-pill" onclick="this.parentNode.querySelectorAll('.sn-sim-entity-pill').forEach(p=>p.classList.remove('active'));this.classList.add('active');"><i class="fas fa-mobile-alt"></i> Addi</div>
                    <?php } ?>
                </div>
            </div>
            <div class="sn-sim-breakdown" id="sim-breakdown">
                <h4>Desglose Estimado</h4>
                <div class="sn-sim-breakdown-row"><span class="label">Capital</span><span class="value" id="sim-capital">$125,000</span></div>
                <div class="sn-sim-breakdown-row"><span class="label">Interés estimado</span><span class="value" id="sim-interes">$25,000</span></div>
                <div class="sn-sim-breakdown-row"><span class="label">Administración</span><span class="value" id="sim-admin">$8,333</span></div>
                <div class="sn-sim-breakdown-row total"><span class="label">Cuota mensual aprox.</span><span class="value" id="sim-total">$158,333</span></div>
            </div>
            <a href="simulador.php" class="sn-btn sn-btn-primary sn-glow-pulse sn-magnetic" style="width:100%;margin-top:var(--space-xl)">
                <i class="fas fa-paper-plane"></i> Ir al Simulador Completo
            </a>
        </div>
    </div>
</section>
