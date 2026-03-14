<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 4 - Wizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .step { display: none; }
        .step.active { display: block; animation: fadeIn 0.5s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .progress-indicator { display: flex; justify-content: space-between; margin-bottom: 2rem; }
        .progress-step { flex: 1; text-align: center; border-bottom: 3px solid #dee2e6; padding-bottom: 10px; color: #6c757d; font-weight: bold; }
        .progress-step.active-step { border-bottom-color: #0d6efd; color: #0d6efd; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 700px;">
        <h2 class="text-center mb-4"><span class="badge bg-danger">Opción 4</span> Asistente de Reemplazo (Wizard)</h2>
        <p class="text-muted text-center">Ideal para transferir todos los clientes de una zona/persona a otra (Ej. por vacaciones o reemplazo definitivo).</p>
        
        <div class="card shadow border-0 mt-4 rounded-3">
            <div class="card-body p-4">
                
                <!-- Indicador de Progreso -->
                <div class="progress-indicator">
                    <div class="progress-step active-step" id="ind-1">1. Origen</div>
                    <div class="progress-step" id="ind-2">2. Revisión</div>
                    <div class="progress-step" id="ind-3">3. Destino</div>
                </div>

                <!-- Paso 1 -->
                <div class="step active" id="step1">
                    <h5 class="card-title text-primary"><i class="bi bi-box-arrow-right"></i> ¿Quién entrega la zona o ruta?</h5>
                    <p class="card-text text-muted mb-4">Seleccione al Asesor o Coordinador al que se le vaciará la asignación.</p>
                    <select class="form-select form-select-lg mb-4">
                        <option value="">Seleccione al empleado origen...</option>
                        <option value="1">Juan Pérez (Asesor - Zona Norte)</option>
                        <option value="2">Roberto Díaz (Coordinador - 2 Asesores)</option>
                    </select>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg next-step" data-target="step2" data-ind="ind-2">Siguiente Paso <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Paso 2 -->
                <div class="step" id="step2">
                    <h5 class="card-title text-primary"><i class="bi bi-search"></i> Resumen de Entidades Asignadas</h5>
                    <div class="alert alert-secondary mt-3">
                        Al seleccionar a <b>Juan Pérez</b>, el sistema ha detectado que tiene asignado: <br><br>
                        <ul class="mb-0 fs-5">
                            <li><i class="bi bi-people-fill text-info"></i> <b>0</b> Asesores a cargo</li>
                            <li><i class="bi bi-shop text-success"></i> <b>45</b> Aliados o Tiendas</li>
                        </ul>
                    </div>
                    <p class="text-muted small">Todos estos elementos serán transferidos en el siguiente paso.</p>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-outline-secondary prev-step" data-target="step1" data-ind="ind-1"><i class="bi bi-arrow-left"></i> Atrás</button>
                        <button class="btn btn-primary next-step" data-target="step3" data-ind="ind-3">Continuar <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Paso 3 -->
                <div class="step" id="step3">
                    <h5 class="card-title text-primary"><i class="bi bi-box-arrow-in-right"></i> ¿Quién recibe la ruta?</h5>
                    <p class="card-text text-muted">Selecciona al nuevo responsable que asumirá los 45 Aliados.</p>
                    <select class="form-select form-select-lg mt-3 mb-4">
                        <option value="">Seleccione al nuevo responsable...</option>
                        <option value="3">Elena Castro (Asesora Nueva)</option>
                        <option value="4">Pedro Ramírez (Asesor Backup)</option>
                    </select>

                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-outline-secondary prev-step" data-target="step2" data-ind="ind-2"><i class="bi bi-arrow-left"></i> Atrás</button>
                        <button class="btn btn-success" id="btn-finalizar"><i class="bi bi-check-circle"></i> Confirmar y Transferir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.next-step').click(function() {
                // Validaciones podrian ir aqui
                let targetId = $(this).data('target');
                let indId = $(this).data('ind');
                $('.step').removeClass('active');
                $('#' + targetId).addClass('active');
                
                $('.progress-step').removeClass('active-step');
                for(let i=1; i<=parseInt(indId.replace('ind-','')); i++){
                   $('#ind-'+i).addClass('active-step'); 
                }
            });
            
            $('.prev-step').click(function() {
                let targetId = $(this).data('target');
                let indId = $(this).data('ind');
                $('.step').removeClass('active');
                $('#' + targetId).addClass('active');
                
                $('.progress-step').removeClass('active-step');
                for(let i=1; i<=parseInt(indId.replace('ind-','')); i++){
                   $('#ind-'+i).addClass('active-step'); 
                }
            });

            $('#btn-finalizar').click(function() {
                Swal.fire({
                    title: '¿Confirmar transferencia?',
                    text: '45 Aliados pasarán a manos del nuevo asesor.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, transferir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Completado', 'Ruta transferida con éxito.', 'success').then(() => {
                            location.reload(); // Reiniciar demo
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
