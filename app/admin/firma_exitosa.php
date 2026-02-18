<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Exitosa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 500px;
            width: 100%;
            background: rgba(26, 31, 46, 0.95);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            animation: scaleIn 0.5s ease-out;
        }
        
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .success-icon i {
            font-size: 3rem;
            color: white;
        }
        
        h1 {
            color: white;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .message {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .info-box {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: white;
        }
        
        .info-item:last-child {
            margin-bottom: 0;
        }
        
        .info-item i {
            color: #10b981;
        }
        
        .security-badge {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .security-badge i {
            color: #6366f1;
            font-size: 1.5rem;
        }
        
        .security-badge span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon"><i class="fa-solid fa-circle-check"></i></div>
        <h1>¡Firma Exitosa!</h1>
        <p class="message">Su documento ha sido firmado digitalmente de forma exitosa.<br>El proceso ha sido completado y registrado de forma segura.</p>
        <div class="info-box">
            <div class="info-item"><i class="fa-solid fa-clock"></i><span id="fecha-hora"></span></div>
            <div class="info-item"><i class="fa-solid fa-fingerprint"></i><span>Firma verificada y almacenada</span></div>
        </div>
        <div class="security-badge"><i class="fa-solid fa-shield-halved"></i><span>Documento protegido con encriptación de grado empresarial</span></div>
    </div>
    <script>
        // Mostrar fecha y hora actual
        const ahora = new Date();
        const opciones = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        document.getElementById('fecha-hora').textContent = ahora.toLocaleDateString('es-ES', opciones);
    </script>
</body>
</html>
