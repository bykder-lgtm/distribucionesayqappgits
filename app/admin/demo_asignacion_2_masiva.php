<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 2 - Asignación Masiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2><span class="badge bg-success">Opción 2</span> Asignación Masiva (Bulk Actions)</h2>
        <p class="text-muted">Selecciona varios Aliados usando las casillas y presiona el botón para reasignarlos a un solo Asesor nuevo simultáneamente.</p>
        
        <div class="d-flex justify-content-between align-items-end mb-3 mt-4">
            <h4 class="mb-0">Lista de Aliados</h4>
            <button class="btn btn-warning shadow-sm" id="btn-reasignar" disabled>
                Reasignar Seleccionados (<span id="count">0</span>)
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center" style="width: 50px;">
                                <input class="form-check-input" type="checkbox" id="check-all">
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col">Aliado / Tienda</th>
                            <th scope="col">Asesor Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td class="text-center"><input class="form-check-input chk-item" type="checkbox" value="101"></td><td>101</td><td>Tienda La Esquina</td><td>Juan Pérez</td></tr>
                        <tr><td class="text-center"><input class="form-check-input chk-item" type="checkbox" value="102"></td><td>102</td><td>Minimarket Sol</td><td>Juan Pérez</td></tr>
                        <tr><td class="text-center"><input class="form-check-input chk-item" type="checkbox" value="103"></td><td>103</td><td>Bodega Central</td><td>Carlos Ruiz</td></tr>
                        <tr><td class="text-center"><input class="form-check-input chk-item" type="checkbox" value="104"></td><td>104</td><td>Super Ahorro</td><td>María Gómez</td></tr>
                        <tr><td class="text-center"><input class="form-check-input chk-item" type="checkbox" value="105"></td><td>105</td><td>Ferretería El Maestro</td><td>Luis Sánchez</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            function updateCount() {
                var count = $('.chk-item:checked').length;
                $('#count').text(count);
                $('#btn-reasignar').prop('disabled', count === 0);
            }

            $('#check-all').change(function() {
                $('.chk-item').prop('checked', $(this).prop('checked'));
                updateCount();
            });

            $('.chk-item').change(function() {
                updateCount();
                if ($('.chk-item:checked').length === $('.chk-item').length) {
                    $('#check-all').prop('checked', true);
                } else {
                    $('#check-all').prop('checked', false);
                }
            });

            $('#btn-reasignar').click(function() {
                let cantidad = $('.chk-item:checked').length;
                Swal.fire({
                    title: 'Reasignación Masiva',
                    html: `
                        <p>Selecciona el nuevo Asesor para los <b>${cantidad}</b> aliados seleccionados:</p>
                        <select id="nuevo-asesor" class="form-select form-select-lg">
                            <option value="1">Luis Sánchez (Asesor Zona Norte)</option>
                            <option value="2">Pedro Ramírez (Asesor Zona Centro)</option>
                            <option value="3">Elena Castro (Asesora Nueva)</option>
                        </select>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar Cambios',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#ffc107',
                    preConfirm: () => {
                        return document.getElementById('nuevo-asesor').value;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: 'Los '+ cantidad +' aliados han sido reasignados (Simulación PHP).',
                            icon: 'success'
                        });
                        // Aquí iría el $.ajax
                        $('.chk-item:checked').closest('tr').find('td:last').text($('#nuevo-asesor option:selected').text());
                        $('.chk-item:checked').prop('checked', false);
                        $('#check-all').prop('checked', false);
                        updateCount();
                    }
                });
            });
        });
    </script>
</body>
</html>
