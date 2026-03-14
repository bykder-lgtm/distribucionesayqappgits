<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 1 - Drag & Drop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .list-group-item { cursor: grab; }
        .list-group-item:active { cursor: grabbing; }
        .zona-drop { min-height: 200px; background-color: #f8f9fa; border: 2px dashed #dee2e6; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2><span class="badge bg-primary">Opción 1</span> Asignación por Arrastrar y Soltar (Drag & Drop)</h2>
        <p class="text-muted">Mueve a los Asesores de la lista de "No Asignados" hacia un "Coordinador" para asignarlos usando SortableJS.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">Asesores No Asignados</div>
                    <ul class="list-group list-group-flush zona-drop" id="no-asignados">
                        <li class="list-group-item" data-id="1">👨‍💼 Juan Pérez (Asesor)</li>
                        <li class="list-group-item" data-id="2">👩‍💼 María Gómez (Asesor)</li>
                        <li class="list-group-item" data-id="3">👨‍💼 Carlos Ruiz (Asesor)</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-header bg-primary text-white">Coordinador: Roberto (Zona Norte)</div>
                    <ul class="list-group list-group-flush zona-drop" id="coord-roberto">
                        <li class="list-group-item" data-id="4">👨‍💼 Luis Sánchez (Asesor)</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-success">
                    <div class="card-header bg-success text-white">Coordinador: Ana (Zona Sur)</div>
                    <ul class="list-group list-group-flush zona-drop" id="coord-ana">
                        <!-- Vacio inicialmente -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts necesarios para esta vista -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const config = {
            group: 'shared', // Permite arrastrar entre contenedores con el mismo grupo
            animation: 150,
            onEnd: function (evt) {
                var itemEl = evt.item;  // Elemento arrastrado
                var toList = evt.to;    // Lista destino
                
                if (evt.from !== evt.to) {
                    Swal.fire({
                        title: '¡Asignación Actualizada!',
                        text: 'El asesor ha sido reasignado correctamente (Simulación AJAX a PHP).',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                }
            }
        };
        // Inicializar zonas de drop
        new Sortable(document.getElementById('no-asignados'), config);
        new Sortable(document.getElementById('coord-roberto'), config);
        new Sortable(document.getElementById('coord-ana'), config);
    </script>
</body>
</html>
