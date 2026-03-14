<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 5 - Inline Editing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .edit-row { cursor: pointer; color: #0d6efd; opacity: 0.5; transition: opacity 0.2s; }
        .edit-row:hover { opacity: 1; }
        .cell-asesor:hover { background-color: #f8f9fa; }
        .success-flash { animation: flashMsg 1.5s; }
        @keyframes flashMsg {
            0% { background-color: #d1e7dd; }
            100% { background-color: transparent; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2><span class="badge bg-info text-dark">Opción 5</span> Edición Rápida en Fila (In-line Editing)</h2>
        <p class="text-muted">Desarrollado sobre DataTables (o tus tablas en Bootstrap). Se cambia al asesor con un clic sin salir de la página.</p>
        
        <div class="card shadow-sm mt-4 border-0">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover align-middle mb-0" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">Aliado / Tienda</th>
                            <th>Zona</th>
                            <th style="width: 300px;">Asesor Asignado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3 fw-bold">Tienda XYZ</td>
                            <td>Norte</td>
                            <td class="cell-asesor">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="txt-asesor">Juan Pérez</span>
                                    <i class="bi bi-pencil-square edit-row" title="Cambiar Asesor"></i>
                                </div>
                                <select class="form-select form-select-sm select-asesor d-none">
                                    <option value="1">Juan Pérez</option>
                                    <option value="2">María Gómez</option>
                                    <option value="3">Carlos Ruiz</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3 fw-bold">Bodega Don Pepe</td>
                            <td>Sur</td>
                            <td class="cell-asesor">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="txt-asesor">María Gómez</span>
                                    <i class="bi bi-pencil-square edit-row" title="Cambiar Asesor"></i>
                                </div>
                                <select class="form-select form-select-sm select-asesor d-none">
                                    <option value="1">Juan Pérez</option>
                                    <option value="2" selected>María Gómez</option>
                                    <option value="3">Carlos Ruiz</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top-0 text-muted small">
                * Haz clic en el ícono de lápiz para habilitar el selector.
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Abrir modo edición
            $('.edit-row').click(function() {
                let cell = $(this).closest('td');
                cell.find('.d-flex').addClass('d-none');
                cell.find('.select-asesor').removeClass('d-none').focus();
            });

            // Al confirmar cambio en el select
            $('.select-asesor').change(function() {
                let cell = $(this).closest('td');
                let nuevoNombre = $(this).find("option:selected").text();
                
                // Mostrar alerta toast
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Asesor Actualizado'
                });

                // Simulación de delay AJAX
                setTimeout(() => {
                    cell.find('.txt-asesor').text(nuevoNombre);
                    cell.find('.d-flex').removeClass('d-none');
                    $(this).addClass('d-none');
                    
                    // Mostrar efecto flash verde en la fila
                    cell.closest('tr').addClass('success-flash');
                    setTimeout(() => { cell.closest('tr').removeClass('success-flash'); }, 1500);
                }, 200); 
            });

            // Si pierde el foco (blur) sin cambiar nada (cancela edición)
            $('.select-asesor').blur(function() {
                let cell = $(this).closest('td');
                cell.find('.d-flex').removeClass('d-none');
                $(this).addClass('d-none');
            });
        });
    </script>
</body>
</html>
