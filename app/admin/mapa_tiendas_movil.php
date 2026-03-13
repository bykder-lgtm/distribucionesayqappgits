<?php
session_start();
include_once("../conexiones/conexione.php");

// Proteccion de ruta
if (!isset($_SESSION['cod_administrador'])) {
    header("Location: ../admin/entrar.php");
    exit();
}

$cod_administrador = $_SESSION['cod_administrador'];

// Fetch cod_seguridad and other info from DB since session might not have all labels
$sql_user = "SELECT cod_seguridad, nombres, apellidos, correo FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador' AND cod_estado != '0'";
$res_user = mysqli_query($conectar, $sql_user);
$user_data = mysqli_fetch_assoc($res_user);

$cod_seguridad = isset($user_data['cod_seguridad']) ? $user_data['cod_seguridad'] : '0';
$nombres_usuario = $user_data['nombres'] . ' ' . $user_data['apellidos'];

// Determinar el tema segun el rol (21: Lider, 22: Coordinador, 2: Asesor)
$theme_color = "#8b5cf6"; // Default Violet (Lider)
$bg_gradient = "linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%)";
$shadow_color = "rgba(139, 92, 246, 0.4)";
$rol_name = "Líder";

if ($cod_seguridad == "2") {
    $theme_color = "#10b981"; // Emerald Green
    $bg_gradient = "linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%)";
    $shadow_color = "rgba(16, 185, 129, 0.4)";
    $rol_name = "Asesor";
} else if ($cod_seguridad == "22") {
    $theme_color = "#3b82f6"; // Blue
    $bg_gradient = "linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%)";
    $shadow_color = "rgba(59, 130, 246, 0.4)";
    $rol_name = "Coordinador";
}

// Incluir info empresa
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
    <title>Mapa de Tiendas - <?php echo $nombre_empresa; ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    
    <style>
        :root {
            --theme-color: <?php echo $theme_color; ?>;
            --theme-color-rgb: <?php 
                if ($cod_seguridad == "2") echo "16, 185, 129";
                else if ($cod_seguridad == "22") echo "59, 130, 246";
                else echo "139, 92, 246";
            ?>;
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

        /* Header */
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

        .back-btn:active { transform: scale(0.9); background: rgba(255,255,255,0.3); }

        .header-title {
            flex: 1;
        }

        .header-title h1 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .header-title p {
            font-size: 0.75rem;
            opacity: 0.8;
            margin: 0;
        }

        /* Map Container */
        #map {
            flex: 1;
            width: 100%;
            z-index: 1;
        }

        /* Floating Info Card */
        .map-stats {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(26, 31, 46, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 0.75rem 1.5rem;
            display: flex;
            gap: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            z-index: 1000;
            white-space: nowrap;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--theme-color);
        }

        .stat-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
        }

        /* Leaflet Popup Styles */
        .leaflet-popup-content-wrapper {
            background: #1a1f2e;
            color: white;
            padding: 0;
            border-radius: 15px;
            overflow: hidden;
        }

        .leaflet-popup-content {
            margin: 0;
            width: 250px !important;
        }

        .leaflet-popup-tip {
            background: #1a1f2e;
        }

        .popup-header {
            background: var(--bg-gradient);
            padding: 12px 15px;
        }

        .popup-header h3 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: white;
        }

        .popup-body {
            padding: 15px;
            color: white;
        }

        .popup-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        .popup-info i {
            width: 16px;
            color: var(--theme-color);
            text-align: center;
        }

        .popup-actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
        }

        .btn-action {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s;
            display: block;
        }

        .btn-primary {
            background: var(--theme-color);
            color: white;
        }

        .btn-outline {
            border: 1px solid var(--theme-color);
            color: var(--theme-color);
        }

        /* Custom Marker */
        .custom-marker {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .marker-pin {
            width: 30px;
            height: 30px;
            border-radius: 50% 50% 50% 0;
            background: var(--theme-color);
            position: absolute;
            transform: rotate(-45deg);
            left: 50%;
            top: 50%;
            margin: -15px 0 0 -15px;
            border: 2px solid white;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .marker-pin::after {
            content: '';
            width: 14px;
            height: 14px;
            margin: 8px 0 0 8px;
            background: white;
            position: absolute;
            border-radius: 50%;
        }

        .user-marker-pin {
            width: 20px;
            height: 20px;
            background: #3b82f6;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.8);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        /* Loader */
        #loader {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #0f1419;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255,255,255,0.1);
            border-top: 5px solid var(--theme-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

    /* Estilos Tooltip Permanente */
    .leaflet-tooltip.marker-tooltip {
        background: rgba(15, 20, 25, 0.85);
        border: 1px solid var(--theme-color);
        border-radius: 8px;
        color: white;
        padding: 5px 10px;
        font-size: 0.75rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        backdrop-filter: blur(4px);
        font-family: 'Inter', sans-serif;
        text-align: center;
    }
    .leaflet-tooltip-top.marker-tooltip::before { border-top-color: var(--theme-color); }
    .tooltip-name { font-weight: 700; color: var(--theme-color); display: block; margin-bottom: 2px; }
    .tooltip-address { font-size: 0.65rem; opacity: 0.9; }

    /* Clustering Custom Styles */
    .marker-cluster-small { background-color: rgba(var(--theme-color-rgb, 139, 92, 246), 0.4) !important; }
    .marker-cluster-small div { background-color: var(--theme-color) !important; color: white !important; font-weight: 700; }
    .marker-cluster-medium { background-color: rgba(var(--theme-color-rgb, 124, 58, 237), 0.6) !important; }
    .marker-cluster-medium div { background-color: var(--theme-color) !important; filter: brightness(0.9); color: white !important; font-weight: 700; }
    .marker-cluster-large { background-color: var(--theme-color) !important; filter: opacity(0.4); }
    .marker-cluster-large div { background-color: var(--theme-color) !important; filter: brightness(0.8); color: white !important; font-weight: 700; }

    /* Filter Panel Styles */
    .filter-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
        z-index: 10000; display: none; opacity: 0; transition: opacity 0.3s;
    }
    .filter-drawer {
        position: fixed; top: 0; right: -320px; width: 320px; height: 100%;
        background: #1a1f2e; z-index: 10001; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex; flex-direction: column; box-shadow: -10px 0 30px rgba(0,0,0,0.5);
        border-left: 1px solid rgba(255,255,255,0.1);
    }
    .filter-drawer.open { right: 0; }
    .filter-overlay.active { display: block; opacity: 1; }

    .filter-header {
        padding: 1.5rem; background: var(--bg-gradient);
        display: flex; align-items: center; justify-content: space-between;
    }
    .filter-header h2 { font-size: 1.1rem; font-weight: 700; margin: 0; }
    .close-filter { color: white; opacity: 0.8; font-size: 1.5rem; cursor: pointer; }

    .filter-content { padding: 1.5rem; flex: 1; overflow-y: auto; }
    .filter-group { margin-bottom: 1.5rem; }
    .filter-group label { display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6; margin-bottom: 8px; font-weight: 600; }
    .filter-input {
        width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px; padding: 12px 15px; color: white; font-family: inherit; font-size: 0.9rem;
        transition: all 0.3s;
    }
    .filter-input:focus { outline: none; border-color: var(--theme-color); background: rgba(255,255,255,0.05); box-shadow: 0 0 10px rgba(var(--theme-color-rgb), 0.2); }
    .filter-input option { background: #1a1f2e; color: white; }

    .filter-footer { padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); display: flex; gap: 10px; }
    .btn-apply { background: var(--theme-color); color: white; border: none; flex: 2; padding: 12px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
    .btn-reset { background: rgba(255,255,255,0.05); color: white; border: 1px solid rgba(255,255,255,0.1); flex: 1; padding: 12px; border-radius: 12px; cursor: pointer; }
    .btn-apply:hover { transform: scale(1.02); filter: brightness(1.1); box-shadow: 0 5px 15px var(--shadow-color); }
    </style>
</head>
<body>

    <div id="loader">
        <div class="spinner"></div>
        <p style="margin-top: 20px; font-weight: 600; letter-spacing: 1px; opacity: 0.7;">CARGANDO MAPA...</p>
    </div>

    <header class="app-header">
        <?php
            $back_url = "config_lider_movil.php";
            if ($cod_seguridad == "2") $back_url = "config_asesor_movil.php";
            if ($cod_seguridad == "22") $back_url = "config_coordinador_movil.php";
        ?>
        <a href="<?php echo $back_url; ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="header-title">
            <h1>Mapa de Tiendas</h1>
            <p><?php echo $rol_name; ?></p>
        </div>
        <div class="header-actions">
            <button onclick="toggleFilter()" class="back-btn"><i class="fa-solid fa-filter"></i></button>
            <button onclick="getUserLocation()" class="back-btn">
                <i class="fa-solid fa-location-crosshairs"></i>
            </button>
        </div>
    </header>

    <div class="filter-overlay" onclick="toggleFilter()"></div>
    <div class="filter-drawer" id="filterDrawer">
        <div class="filter-header">
            <h2>Filtros de Mapa</h2>
            <span class="close-filter" onclick="toggleFilter()">&times;</span>
        </div>
        <div class="filter-content">
            <div class="filter-group">
                <label>Departamento</label>
                <select id="filter-dept" class="filter-input" onchange="loadMunicipios()">
                    <option value="">Seleccione Departamento</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Municipio</label>
                <select id="filter-muni" class="filter-input">
                    <option value="">Seleccione Municipio</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Barrio</label>
                <input type="text" id="filter-barrio" class="filter-input" placeholder="Nombre del barrio...">
            </div>
        </div>
        <div class="filter-footer">
            <button class="btn-reset" onclick="resetFilters()">Limpiar</button>
            <button class="btn-apply" onclick="applyFilters()">Aplicar Filtros</button>
        </div>
    </div>

    <div id="map"></div>

    <div class="map-stats">
        <div class="stat-item">
            <span class="stat-value" id="count-total">0</span>
            <span class="stat-label">Tiendas</span>
        </div>
        <div class="stat-item">
            <span class="stat-value" id="count-gps">0</span>
            <span class="stat-label">Con GPS</span>
        </div>
    </div>

    <!-- JS -->
    <script src="../js/jquery-3.2.1.min_visitante.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    
    <script>
        var map, userMarker;
        var markerClusterGroup;
        var themeColor = '<?php echo $theme_color; ?>';

        $(document).ready(function() {
            initMap();
            loadStores();
            loadDepartments();
        });

        function toggleFilter() {
            $('.filter-overlay').toggleClass('active');
            $('#filterDrawer').toggleClass('open');
        }

        function loadDepartments() {
            $.get('obtener_departamentos_ajax.php', function(res) {
                if(res.success) {
                    var html = '<option value="">Todos los Departamentos</option>';
                    res.departamentos.forEach(d => {
                        html += `<option value="${d.cod_departamento}">${d.nombre_departamento}</option>`;
                    });
                    $('#filter-dept').html(html);
                }
            });
        }

        function loadMunicipios() {
            var cod_depto = $('#filter-dept').val();
            if(!cod_depto) {
                $('#filter-muni').html('<option value="">Seleccione Municipio</option>');
                return;
            }
            $.get('obtener_municipios_ajax.php', { cod_departamento: cod_depto }, function(res) {
                if(res.success) {
                    var html = '<option value="">Todos los Municipios</option>';
                    res.municipios.forEach(m => {
                        html += `<option value="${m.cod_municipio}">${m.nombre_municipio}</option>`;
                    });
                    $('#filter-muni').html(html);
                }
            });
        }

        function applyFilters() {
            var params = {
                cod_departamento: $('#filter-dept').val(),
                cod_municipio: $('#filter-muni').val(),
                barrio: $('#filter-barrio').val()
            };
            loadStores(params);
            toggleFilter();
        }

        function resetFilters() {
            $('#filter-dept').val('');
            $('#filter-muni').html('<option value="">Seleccione Municipio</option>');
            $('#filter-barrio').val('');
            loadStores();
            toggleFilter();
        }

        function initMap() {
            // Inicializar mapa centrado en Manizales por defecto
            map = L.map('map', {
                zoomControl: false,
                attributionControl: false
            }).setView([5.0689, -75.5174], 13);

            // Agregar capa oscura (CartoDB Dark Matter)
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19
            }).addTo(map);

            // Reactivar control de zoom en una posición específica si se desea
            L.control.zoom({
                position: 'topright'
            }).addTo(map);

            // Inicializar el grupo de clusters
            markerClusterGroup = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                maxClusterRadius: 80
            });
            map.addLayer(markerClusterGroup);
        }

        function loadStores(filters = {}) {
            $('#loader').fadeIn();
            $.ajax({
                url: 'obtener_tiendas_gps_ajax.php', 
                type: 'GET', 
                dataType: 'json',
                data: filters,
                success: function(response) {
                    $('#loader').fadeOut();
                    if (response.success) {
                        $('#count-total').text(response.total);
                        $('#count-gps').text(response.data.length);
                        renderMarkers(response.data);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) { 
                    $('#loader').fadeOut(); 
                    console.error(xhr.responseText);
                    alert('Error crítico al cargar datos. Ver consola.'); 
                }
            });
        }

        function renderMarkers(tiendas) {
            markerClusterGroup.clearLayers();
            var latLngs = [];
            var tooltipDirections = ['top', 'bottom', 'right', 'left'];

            tiendas.forEach(function(tienda, index) {
                var lat = parseFloat(tienda.lat);
                var lng = parseFloat(tienda.lng);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    var icon = L.divIcon({ 
                        className: 'custom-marker', 
                        html: '<div class="marker-pin"></div>', 
                        iconSize: [30, 30], 
                        iconAnchor: [15, 30] 
                    });

                    // Escapar comillas simples para el JS inline si fuera necesario
                    var nombreEscapado = tienda.nombre.replace(/'/g, "\\'");

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
                    
                    var chosenDir = tooltipDirections[index % 4];
                    var offset = [0, 0];
                    if (chosenDir === 'top') offset = [0, -32];
                    else if (chosenDir === 'bottom') offset = [0, 5];
                    else if (chosenDir === 'right') offset = [15, -15];
                    else if (chosenDir === 'left') offset = [-15, -15];

                    marker.bindTooltip(`<span class="tooltip-name">${tienda.nombre}</span><span class="tooltip-address">${tienda.direccion}</span>`, {
                        permanent: true,
                        direction: chosenDir,
                        offset: offset,
                        className: 'marker-tooltip'
                    });

                    markerClusterGroup.addLayer(marker);
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
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    
                    if (userMarker) map.removeLayer(userMarker);
                    
                    var userIcon = L.divIcon({
                        className: 'user-marker',
                        html: '<div class="user-marker-pin"></div>',
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });

                    userMarker = L.marker([lat, lng], { icon: userIcon }).addTo(map);
                    map.setView([lat, lng], 16);
                }, function() {
                    alert("No se pudo obtener la ubicación actual");
                });
            } else {
                alert("Geolocalización no soportada");
            }
        }
    </script>
</body>
</html>
