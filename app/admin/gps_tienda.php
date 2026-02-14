<?php 
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$cod_tienda_codifcryp = isset($_GET['cod']) ? $_GET['cod'] : '';

if (empty($cod_tienda_codifcryp)) { die("Error: Código de tienda no válido"); }

// Desencriptar código de tienda
$cod_tienda_codif = DAXCODIFCRYPTOR::descriptardax($cod_tienda_codifcryp);
$cod_tienda = DAXCODIFCRYPTOR::descodifdax($cod_tienda_codif);

// Obtener información de la tienda
$sql = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$resultado = mysqli_query($conectar, $sql);
$tienda = mysqli_fetch_assoc($resultado);

if (!$tienda) { die("Error: Tienda no encontrada"); }

$nombre_tienda = $tienda['nombre_tienda'];
$ubicacion_gps_actual = $tienda['ubicacion_gps_tienda'];

// Si ya existe ubicación GPS
$gps_ya_registrado = !empty($ubicacion_gps_actual);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../imagenes/favicon.png" type="image/x-icon" rel="shortcut icon" />
    <title>Ubicación GPS - <?php echo $nombre_tienda; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 50%, #0d1117 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .container {
            background: linear-gradient(135deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(251, 191, 36, 0.3);
            border-radius: 24px;
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .header i {
            font-size: 4rem;
            color: #fbbf24;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .header h1 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        .info-box {
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .info-box h3 {
            color: #fbbf24;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .info-box p {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            line-height: 1.5;
        }
        .map-container {
            background: rgba(255,255,255,0.05);
            border: 2px dashed rgba(251, 191, 36, 0.3);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .map-container.with-map {
            padding: 0;
            overflow: hidden;
        }
        #map {
            width: 100%;
            height: 350px;
            border-radius: 12px;
            display: none;
            z-index: 1;
        }
        .gps-info {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            margin-top: 1rem;
        }
        .gps-info strong {
            color: #fbbf24;
        }
        .btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #1a1f2e;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
            margin-bottom: 1rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            display: none;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        }
        .status-message {
            text-align: center;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: none;
        }
        .status-message.success {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
        }
        .status-message.error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }
        .status-message.warning {
            background: rgba(251, 191, 36, 0.2);
            border: 1px solid rgba(251, 191, 36, 0.3);
            color: #fbbf24;
        }
        .loading {
            display: none;
            text-align: center;
            color: #fbbf24;
            margin: 1rem 0;
        }
        .loading i {
            font-size: 2rem;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fa-solid fa-map-marker-alt"></i>
            <h1>Ubicación GPS</h1>
            <p><?php echo $nombre_tienda; ?></p>
        </div>

        <?php if ($gps_ya_registrado): ?>
        <div class="status-message success" style="display: block;">
            <i class="fa-solid fa-check-circle"></i> La ubicación GPS ya ha sido registrada
        </div>
        <div class="gps-info" style="text-align: center; margin-bottom: 1rem;">
            <strong>Coordenadas actuales:</strong><br>
            <?php echo $ubicacion_gps_actual; ?>
        </div>
        <?php else: ?>
        <div class="info-box">
            <h3><i class="fa-solid fa-info-circle"></i> Importante</h3>
            <p>Para registrar la ubicación de su tienda, presione el botón y permita el acceso a su ubicación cuando el navegador lo solicite.</p>
        </div>
        <?php endif; ?>

        <div class="loading" id="loading">
            <i class="fa-solid fa-spinner"></i>
            <p>Obteniendo ubicación...</p>
        </div>

        <div class="status-message" id="statusMessage"></div>

        <div class="map-container" id="mapContainer">
            <div id="mapPlaceholder" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <i class="fa-solid fa-location-dot" style="font-size: 3rem; color: rgba(251, 191, 36, 0.5);"></i>
                <p style="color: rgba(255,255,255,0.5); margin-top: 1rem;">
                    <?php echo $gps_ya_registrado ? 'Ubicación registrada' : 'Presiona el botón para obtener tu ubicación'; ?>
                </p>
            </div>
            <div id="map"></div>
        </div>

        <div class="gps-info" id="coordsDisplay" style="display: none;">
            <strong>Latitud:</strong> <span id="latitud">-</span><br>
            <strong>Longitud:</strong> <span id="longitud">-</span>
        </div>

        <?php if (!$gps_ya_registrado): ?>
        <button class="btn btn-primary" id="btnObtenerUbicacion" onclick="obtenerUbicacion()">
            <i class="fa-solid fa-location-crosshairs"></i> Obtener Mi Ubicación
        </button>
        
        <button class="btn btn-success" id="btnGuardarUbicacion" onclick="guardarUbicacion()">
            <i class="fa-solid fa-save"></i> Confirmar y Guardar Ubicación
        </button>
        <?php else: ?>
        <button class="btn btn-primary" onclick="window.close()">
            <i class="fa-solid fa-check"></i> Cerrar
        </button>
        <?php endif; ?>
    </div>

    <script>
        let latitud = null;
        let longitud = null;
        let mapa = null;
        let marcador = null;
        const codTienda = '<?php echo $cod_tienda; ?>';

        // Si ya hay ubicación registrada, mostrar en el mapa
        <?php if ($gps_ya_registrado && !empty($ubicacion_gps_actual)): ?>
        window.addEventListener('DOMContentLoaded', function() {
            const coords = '<?php echo $ubicacion_gps_actual; ?>'.split(',');
            if (coords.length === 2) {
                const lat = parseFloat(coords[0]);
                const lng = parseFloat(coords[1]);
                mostrarMapa(lat, lng, false);
            }
        });
        <?php endif; ?>

        function mostrarMapa(lat, lng, editable = true) {
            // Ocultar placeholder
            const placeholder = document.getElementById('mapPlaceholder');
            if (placeholder) placeholder.style.display = 'none';
            
            // Mostrar mapa
            const mapDiv = document.getElementById('map');
            mapDiv.style.display = 'block';
            
            const mapContainer = document.getElementById('mapContainer');
            mapContainer.classList.add('with-map');

            // Crear mapa si no existe
            if (!mapa) {
                mapa = L.map('map').setView([lat, lng], 16);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(mapa);

                // Icono personalizado
                const iconoTienda = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background: #fbbf24; width: 40px; height: 40px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-store" style="transform: rotate(45deg); color: #1a1f2e; font-size: 18px;"></i></div>',
                    iconSize: [40, 40],
                    iconAnchor: [20, 40]
                });

                marcador = L.marker([lat, lng], { 
                    icon: iconoTienda,
                    draggable: editable 
                }).addTo(mapa);

                if (editable) {
                    marcador.on('dragend', function(e) {
                        const pos = marcador.getLatLng();
                        latitud = pos.lat;
                        longitud = pos.lng;
                        document.getElementById('latitud').textContent = latitud.toFixed(6);
                        document.getElementById('longitud').textContent = longitud.toFixed(6);
                        mapa.setView([latitud, longitud], 16);
                    });

                    // Agregar popup
                    marcador.bindPopup('<div style="text-align: center; padding: 5px;"><strong style="color: #fbbf24;">📍 Mi Tienda</strong><br><small>Arrastra el marcador para ajustar</small></div>').openPopup();
                } else {
                    marcador.bindPopup('<div style="text-align: center; padding: 5px;"><strong style="color: #fbbf24;">📍 Ubicación Registrada</strong></div>').openPopup();
                }

                // Ajustar tamaño del mapa después de mostrarlo
                setTimeout(() => mapa.invalidateSize(), 100);
            } else {
                mapa.setView([lat, lng], 16);
                if (marcador) {
                    marcador.setLatLng([lat, lng]);
                }
            }
        }

        function obtenerUbicacion() {
            if (!navigator.geolocation) {
                mostrarMensaje('Tu navegador no soporta geolocalización', 'error');
                return;
            }

            document.getElementById('loading').style.display = 'block';
            document.getElementById('btnObtenerUbicacion').style.display = 'none';

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    latitud = position.coords.latitude;
                    longitud = position.coords.longitude;

                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('coordsDisplay').style.display = 'block';
                    document.getElementById('latitud').textContent = latitud.toFixed(6);
                    document.getElementById('longitud').textContent = longitud.toFixed(6);
                    document.getElementById('btnGuardarUbicacion').style.display = 'flex';

                    mostrarMensaje('Ubicación obtenida correctamente. Puedes ajustar el marcador arrastrándolo.', 'success');

                    // Mostrar mapa con la ubicación
                    mostrarMapa(latitud, longitud, true);
                },
                function(error) {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('btnObtenerUbicacion').style.display = 'flex';

                    let mensaje = 'Error al obtener ubicación. ';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            mensaje += 'Por favor, permite el acceso a tu ubicación.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            mensaje += 'La ubicación no está disponible.';
                            break;
                        case error.TIMEOUT:
                            mensaje += 'La solicitud ha expirado. Intenta nuevamente.';
                            break;
                        default:
                            mensaje += 'Error desconocido.';
                    }
                    mostrarMensaje(mensaje, 'error');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }

        function guardarUbicacion() {
            if (!latitud || !longitud) {
                mostrarMensaje('Primero obtén tu ubicación', 'warning');
                return;
            }

            Swal.fire({
                title: '¿Confirmar ubicación?',
                text: 'Se guardará la ubicación GPS de tu tienda',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                background: '#1a1f2e',
                color: 'white'
            }).then((result) => {
                if (result.isConfirmed) {
                    procesarGuardado();
                }
            });
        }

        function procesarGuardado() {
            Swal.fire({
                title: 'Guardando...',
                text: 'Registrando ubicación GPS',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); },
                background: '#1a1f2e',
                color: 'white'
            });

            const formData = new FormData();
            formData.append('cod_tienda', codTienda);
            formData.append('ubicacion_gps', latitud + ',' + longitud);

            fetch('guardar_gps_tienda_ajax.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Guardado!',
                        text: 'La ubicación GPS ha sido registrada correctamente',
                        confirmButtonColor: '#10b981',
                        background: '#1a1f2e',
                        color: 'white'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'No se pudo guardar la ubicación',
                        confirmButtonColor: '#ef4444',
                        background: '#1a1f2e',
                        color: 'white'
                    });
                }
            })
            .catch(error => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error de conexión',
                    confirmButtonColor: '#ef4444',
                    background: '#1a1f2e',
                    color: 'white'
                });
            });
        }

        function mostrarMensaje(texto, tipo) {
            const mensaje = document.getElementById('statusMessage');
            mensaje.className = 'status-message ' + tipo;
            mensaje.innerHTML = '<i class="fa-solid fa-' + 
                (tipo === 'success' ? 'check-circle' : tipo === 'error' ? 'exclamation-circle' : 'info-circle') + 
                '"></i> ' + texto;
            mensaje.style.display = 'block';

            setTimeout(() => {
                mensaje.style.display = 'none';
            }, 5000);
        }
    </script>
</body>
</html>
