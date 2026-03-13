<?php
session_start();
include_once("../conexiones/conexione.php");

// Proteccion de ruta
if (!isset($_SESSION['cod_administrador'])) {
    header("Location: ../admin/entrar.php");
    exit();
}

$cod_administrador = $_SESSION['cod_administrador'];

// Info del usuario
$sql_user = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador' AND cod_estado != '0'";
$res_user = mysqli_query($conectar, $sql_user);
$user_data = mysqli_fetch_assoc($res_user);
$nombres_usuario = $user_data['nombres'] . ' ' . $user_data['apellidos'];

// Tema Violeta (Lider)
$theme_color = "#8b5cf6";
$bg_gradient = "linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%)";
$shadow_color = "rgba(139, 92, 246, 0.4)";

// Info empresa
$sql_info = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$res_info = mysqli_query($conectar, $sql_info);
$datos_empresa = mysqli_fetch_assoc($res_info);
$nombre_empresa = $datos_empresa['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mapa de Tiendas (Líder) - <?php echo $nombre_empresa; ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        :root {
            --theme-color: <?php echo $theme_color; ?>;
            --bg-gradient: <?php echo $bg_gradient; ?>;
            --shadow-color: <?php echo $shadow_color; ?>;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f1419;
            color: white;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .app-header {
            background: var(--bg-gradient);
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            z-index: 1000;
        }

        .back-btn {
            color: white;
            font-size: 1.25rem;
            text-decoration: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .header-title { flex: 1; }
        .header-title h1 { font-size: 1.1rem; font-weight: 700; margin: 0; }
        .header-title p { font-size: 0.75rem; opacity: 0.8; margin: 0; }

        #map { flex: 1; width: 100%; z-index: 1; }

        .map-stats {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
            background: rgba(26, 31, 46, 0.9); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 20px;
            padding: 0.75rem 1.5rem; display: flex; gap: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 1000; white-space: nowrap;
        }

        .stat-item { display: flex; flex-direction: column; align-items: center; }
        .stat-value { font-size: 1.1rem; font-weight: 800; color: var(--theme-color); }
        .stat-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6; }

        /* Leaflet Popup Styles */
        .leaflet-popup-content-wrapper { background: #1a1f2e; color: white; padding: 0; border-radius: 15px; overflow: hidden; }
        .leaflet-popup-content { margin: 0; width: 250px !important; }
        .leaflet-popup-tip { background: #1a1f2e; }

        .popup-header { background: var(--bg-gradient); padding: 12px 15px; }
        .popup-header h3 { margin: 0; font-size: 0.95rem; font-weight: 700; color: white; }
        .popup-body { padding: 15px; color: white; }
        .popup-info { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; font-size: 0.85rem; color: rgba(255,255,255,0.8); }
        .popup-info i { width: 16px; color: var(--theme-color); text-align: center; }
        .popup-actions { margin-top: 15px; display: flex; gap: 8px; }
        .btn-action { flex: 1; padding: 10px; border-radius: 8px; text-align: center; text-decoration: none; font-size: 0.75rem; font-weight: 600; transition: all 0.2s; display: block; }
        .btn-primary { background: var(--theme-color); color: white; }
        .btn-outline { border: 1px solid var(--theme-color); color: var(--theme-color); }

        /* Custom Marker */
        .custom-marker { display: flex; align-items: center; justify-content: center; }
        .marker-pin {
            width: 30px; height: 30px; border-radius: 50% 50% 50% 0; background: var(--theme-color);
            position: absolute; transform: rotate(-45deg); left: 50%; top: 50%; margin: -15px 0 0 -15px;
            border: 2px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .marker-pin::after { content: ''; width: 14px; height: 14px; margin: 8px 0 0 8px; background: white; position: absolute; border-radius: 50%; }

        .user-marker-pin {
            width: 20px; height: 20px; background: #3b82f6; border: 3px solid white; border-radius: 50%;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.8); animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        #loader {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: #0f1419; display: flex; flex-direction: column;
            align-items: center; justify-content: center; z-index: 9999;
        }
        .spinner {
            width: 50px; height: 50px; border: 5px solid rgba(255,255,255,0.1);
            border-top: 5px solid var(--theme-color); border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="loader">
        <div class="spinner"></div>
        <p style="margin-top: 20px; font-weight: 600; letter-spacing: 1px; opacity: 0.7;">CARGANDO MAPA...</p>
    </div>

    <header class="app-header">
        <a href="config_lider_movil.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="header-title">
            <h1>Mapa de Tiendas</h1>
            <p>Líder - OpenStreetMap</p>
        </div>
        <div class="header-actions">
            <button onclick="getUserLocation()" class="back-btn"><i class="fa-solid fa-location-crosshairs"></i></button>
        </div>
    </header>

    <div id="map"></div>

    <div class="map-stats">
        <div class="stat-item"><span class="stat-value" id="count-total">0</span><span class="stat-label">Tiendas</span></div>
        <div class="stat-item"><span class="stat-value" id="count-gps">0</span><span class="stat-label">Con GPS</span></div>
    </div>

    <script src="../js/jquery-3.2.1.min_visitante.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        var map, userMarker;
        var markers = [];
        var themeColor = '<?php echo $theme_color; ?>';

        $(document).ready(function() {
            initMap();
            loadStores();
        });

        function initMap() {
            map = L.map('map', { zoomControl: false, attributionControl: false }).setView([5.0689, -75.5174], 13);
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);
            L.control.zoom({ position: 'topright' }).addTo(map);
        }

        function loadStores() {
            $.ajax({
                url: 'obtener_tiendas_gps_lider_ajax.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#loader').fadeOut();
                    if (response.success) {
                        $('#count-total').text(response.total);
                        $('#count-gps').text(response.data.length);
                        renderMarkers(response.data);
                    }
                },
                error: function() { $('#loader').fadeOut(); alert('Error al cargar datos'); }
            });
        }

        function renderMarkers(tiendas) {
            markers.forEach(m => map.removeLayer(m));
            markers = [];
            var latLngs = [];
            tiendas.forEach(function(tienda) {
                var lat = parseFloat(tienda.lat);
                var lng = parseFloat(tienda.lng);
                if (!isNaN(lat) && !isNaN(lng)) {
                    var icon = L.divIcon({
                        className: 'custom-marker',
                        html: '<div class="marker-pin"></div>',
                        iconSize: [30, 30],
                        iconAnchor: [15, 30]
                    });
                    var popupContent = `
                        <div class="popup-header"><h3>${tienda.nombre}</h3></div>
                        <div class="popup-body">
                            <div class="popup-info"><i class="fa-solid fa-user"></i><span><b>Dueño:</b> ${tienda.dueno}</span></div>
                            <div class="popup-info"><i class="fa-solid fa-handshake"></i><span><b>Aliado:</b> ${tienda.aliado}</span></div>
                            <div class="popup-info"><i class="fa-solid fa-location-dot"></i><span>${tienda.direccion}</span></div>
                            <div class="popup-info"><i class="fa-solid fa-phone"></i><span>${tienda.telefono}</span></div>
                            <div class="popup-actions">
                                <a href="tel:${tienda.telefono}" class="btn-action btn-outline">Llamar</a>
                                <a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}" target="_blank" class="btn-action btn-primary">Ruta</a>
                            </div>
                        </div>
                    `;
                    var marker = L.marker([lat, lng], { icon: icon }).bindPopup(popupContent);
                    marker.addTo(map);
                    markers.push(marker);
                    latLngs.push([lat, lng]);
                }
            });
            if (latLngs.length > 0) {
                var bounds = L.latLngBounds(latLngs);
                map.fitBounds(bounds, { padding: [50, 50] });
            }
        }

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude, lng = position.coords.longitude;
                    if (userMarker) map.removeLayer(userMarker);
                    var userIcon = L.divIcon({ className: 'user-marker', html: '<div class="user-marker-pin"></div>', iconSize: [20, 20], iconAnchor: [10, 10] });
                    userMarker = L.marker([lat, lng], { icon: userIcon }).addTo(map);
                    map.setView([lat, lng], 16);
                }, () => alert("Ubicación no disponible"));
            }
        }
    </script>
</body>
</html>
