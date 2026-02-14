// Configuración y variables
let particles = [];
const maxParticles = 50;

// Inicialización cuando la página se carga
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    animateElements();
    setupButtonInteraction();
});

// Crear partículas flotantes
function createParticles() {
    const particlesContainer = document.querySelector('.particles');
    
    for (let i = 0; i < maxParticles; i++) {
        createParticle();
    }
    
    // Crear nuevas partículas continuamente
    setInterval(createParticle, 300);
}

function createParticle() {
    const particlesContainer = document.querySelector('.particles');
    const particle = document.createElement('div');
    particle.className = 'particle';
    
    // Propiedades aleatorias para cada partícula
    const size = Math.random() * 4 + 1; // 1-5px
    const leftPosition = Math.random() * 100; // 0-100%
    const animationDuration = Math.random() * 4 + 4; // 4-8 segundos
    const opacity = Math.random() * 0.6 + 0.2; // 0.2-0.8
    
    particle.style.cssText = `
        width: ${size}px;
        height: ${size}px;
        left: ${leftPosition}%;
        animation-duration: ${animationDuration}s;
        opacity: ${opacity};
    `;
    
    particlesContainer.appendChild(particle);
    
    // Remover partícula después de la animación
    setTimeout(() => {
        if (particle.parentNode) {
            particle.parentNode.removeChild(particle);
        }
    }, animationDuration * 1000);
}

// Animaciones de elementos principales
function animateElements() {
    // Animar letras del texto "Bienvenida"
    const letters = document.querySelectorAll('.letter');
    letters.forEach((letter, index) => {
        letter.style.animationDelay = `${2 + index * 0.1}s`;
    });
    
    // Efectos de hover para las letras
    letters.forEach(letter => {
        letter.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.2)';
            this.style.textShadow = `
                0 0 30px rgba(0, 212, 255, 1),
                0 0 60px rgba(0, 212, 255, 0.8),
                0 0 90px rgba(0, 212, 255, 0.6)
            `;
        });
        
        letter.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.textShadow = '';
        });
    });
}

// Configurar interacciones del botón
function setupButtonInteraction() {
    const button = document.querySelector('.start-button');
    const buttonGlow = document.querySelector('.button-glow');
    
    // Efecto de click
    button.addEventListener('click', function(e) {
        // Crear efecto de onda
        createRippleEffect(e, this);
        
        // Animación de éxito
        setTimeout(() => {
            showSuccessAnimation();
        }, 500);
    });
    
    // Efecto de hover mejorado
    button.addEventListener('mouseenter', function() {
        this.style.boxShadow = `
            0 0 40px rgba(0, 212, 255, 0.8),
            inset 0 0 40px rgba(0, 212, 255, 0.3)
        `;
    });
    
    button.addEventListener('mouseleave', function() {
        this.style.boxShadow = `
            0 0 20px rgba(0, 212, 255, 0.3),
            inset 0 0 20px rgba(0, 212, 255, 0.1)
        `;
    });
}

// Crear efecto de onda al hacer click
function createRippleEffect(event, element) {
    const ripple = document.createElement('div');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.6) 0%, transparent 70%);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
        z-index: 1;
    `;
    
    element.appendChild(ripple);
    
    // Crear la animación de ripple
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Remover el elemento después de la animación
    setTimeout(() => {
        ripple.remove();
        style.remove();
    }, 600);
}

// Animación de éxito al hacer click en el botón
function showSuccessAnimation() {
    // Crear partículas de éxito
    for (let i = 0; i < 20; i++) {
        createSuccessParticle();
    }
    
    // Efecto de flash
    const flash = document.createElement('div');
    flash.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 212, 255, 0.2);
        pointer-events: none;
        z-index: 9999;
        animation: flash 0.3s ease-out;
    `;
    
    document.body.appendChild(flash);
    
    // Crear animación de flash
    const style = document.createElement('style');
    style.textContent = `
        @keyframes flash {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
    `;
    document.head.appendChild(style);
    
    setTimeout(() => {
        flash.remove();
        style.remove();
    }, 300);
}

// Crear partículas de éxito
function createSuccessParticle() {
    const particle = document.createElement('div');
    const container = document.querySelector('.container');
    
    const size = Math.random() * 6 + 2;
    const startX = 50; // Centro de la pantalla
    const startY = 70; // Cerca del botón
    const endX = Math.random() * 100;
    const endY = Math.random() * 100;
    const duration = Math.random() * 2 + 1;
    
    particle.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        background: #00d4ff;
        border-radius: 50%;
        left: ${startX}%;
        top: ${startY}%;
        pointer-events: none;
        z-index: 1000;
        box-shadow: 0 0 10px rgba(0, 212, 255, 0.8);
    `;
    
    container.appendChild(particle);
    
    // Animar la partícula
    particle.animate([
        {
            transform: 'translate(0, 0) scale(1)',
            opacity: 1
        },
        {
            transform: `translate(${(endX - startX) * 5}px, ${(endY - startY) * 5}px) scale(0)`,
            opacity: 0
        }
    ], {
        duration: duration * 1000,
        easing: 'ease-out'
    });
    
    setTimeout(() => {
        if (particle.parentNode) {
            particle.parentNode.removeChild(particle);
        }
    }, duration * 1000);
}

// Efectos de movimiento del mouse
document.addEventListener('mousemove', function(e) {
    const cursor = { x: e.clientX, y: e.clientY };
    
    // Efecto parallax sutil en los elementos de luz
    const lights = document.querySelectorAll('.light-effect');
    lights.forEach((light, index) => {
        const speed = (index + 1) * 0.02;
        const x = (cursor.x - window.innerWidth / 2) * speed;
        const y = (cursor.y - window.innerHeight / 2) * speed;
        
        light.style.transform = `translate(${x}px, ${y}px)`;
    });
    
    // Efecto sutil en el logo
    const logo = document.querySelector('.logo-symbol');
    const logoSpeed = 0.01;
    const logoX = (cursor.x - window.innerWidth / 2) * logoSpeed;
    const logoY = (cursor.y - window.innerHeight / 2) * logoSpeed;
    
    logo.style.transform = `translate(${logoX}px, ${logoY}px)`;
});

// Optimización de rendimiento: throttle para eventos de mouse
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Aplicar throttle a eventos costosos
document.addEventListener('mousemove', throttle(function(e) {
    // Código de mousemove optimizado aquí si es necesario
}, 16)); // ~60fps

// Animación de carga inicial
window.addEventListener('load', function() {
    document.body.style.opacity = '1';
    
    // Secuencia de animación inicial
    setTimeout(() => {
        document.querySelector('.logo-container').style.opacity = '1';
    }, 500);
    
    setTimeout(() => {
        document.querySelector('.welcome-text').style.opacity = '1';
    }, 1500);
    
    setTimeout(() => {
        document.querySelector('.button-container').style.opacity = '1';
    }, 3000);
});