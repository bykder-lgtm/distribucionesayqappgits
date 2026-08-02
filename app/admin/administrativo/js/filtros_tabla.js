/**
 * filtros_tabla.js - Componente reutilizable de filtros de tabla
 * Agrega inputs de filtro debajo de cada encabezado de columna
 * 
 * Uso: initFiltrosTabla('mi-tabla', { tipos: { 0: 'text', 1: 'select', 2: 'date' } })
 * 
 * @see plan/plan_completo_cambios_administrativo.md (REQ 9)
 */

(function() {
    'use strict';

    /**
     * Inicializa filtros en una tabla
     * @param {string} tableId - ID del elemento <table>
     * @param {object} config - Configuración opcional
     * @param {object} config.tipos - Mapa de índice de columna -> tipo ('text', 'select', 'date')
     * @param {object} config.opciones - Mapa de índice de columna -> array de opciones (para tipo 'select')
     * @param {string} config.urlBase - URL base para redirección con filtros
     * @param {function} config.onFilter - Callback personalizado al filtrar
     */
    window.initFiltrosTabla = function(tableId, config) {
        config = config || {};
        var table = document.getElementById(tableId);
        if (!table) return;

        var thead = table.querySelector('thead');
        if (!thead) return;

        var headerRow = thead.querySelector('tr');
        if (!headerRow) return;

        // Crear fila de filtros
        var filterRow = document.createElement('tr');
        filterRow.className = 'filtros-row';
        filterRow.style.background = 'transparent';

        var headers = headerRow.querySelectorAll('th');
        headers.forEach(function(th, index) {
            var td = document.createElement('td');
            td.style.padding = '4px 6px';
            td.style.verticalAlign = 'middle';

            var tipo = (config.tipos && config.tipos[index]) || 'text';
            var input;

            if (tipo === 'select') {
                input = document.createElement('select');
                input.style.cssText = 'width:100%;padding:4px 6px;background:var(--card2);border:1px solid var(--border);border-radius:4px;color:var(--text);font-size:10px;';
                
                var emptyOpt = document.createElement('option');
                emptyOpt.value = '';
                emptyOpt.textContent = 'Todos';
                input.appendChild(emptyOpt);
                
                var opciones = (config.opciones && config.opciones[index]) || [];
                opciones.forEach(function(opt) {
                    var option = document.createElement('option');
                    option.value = typeof opt === 'object' ? opt.value : opt;
                    option.textContent = typeof opt === 'object' ? opt.label : opt;
                    input.appendChild(option);
                });
            } else if (tipo === 'date') {
                input = document.createElement('input');
                input.type = 'date';
                input.style.cssText = 'width:100%;padding:4px 6px;background:var(--card2);border:1px solid var(--border);border-radius:4px;color:var(--text);font-size:10px;';
            } else {
                input = document.createElement('input');
                input.type = 'text';
                input.placeholder = 'Filtrar...';
                input.style.cssText = 'width:100%;padding:4px 6px;background:var(--card2);border:1px solid var(--border);border-radius:4px;color:var(--text);font-size:10px;box-sizing:border-box;';
            }

            input.setAttribute('data-col-index', index);

            // Evento de filtrado
            var timeout = null;
            input.addEventListener('input', function(e) {
                if (tipo === 'text') {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        filtrarTabla(tableId, config);
                    }, 300);
                }
            });
            input.addEventListener('change', function(e) {
                if (tipo !== 'text') {
                    filtrarTabla(tableId, config);
                }
            });

            td.appendChild(input);
            filterRow.appendChild(td);
        });

        // Insertar después del header row
        if (thead.querySelector('.filtros-row')) {
            thead.removeChild(thead.querySelector('.filtros-row'));
        }
        thead.appendChild(filterRow);

        // Agregar CSS
        if (!document.getElementById('filtros-tabla-style')) {
            var style = document.createElement('style');
            style.id = 'filtros-tabla-style';
            style.textContent = `
                .filtros-row td { border-bottom: 2px solid var(--border) !important; }
                .filtros-row input::placeholder { color: var(--text3); opacity: 0.6; }
                .filtro-activo { background: rgba(79,142,247,0.08) !important; }
            `;
            document.head.appendChild(style);
        }
    };

    /**
     * Filtra las filas de una tabla según los valores de los inputs
     */
    function filtrarTabla(tableId, config) {
        var table = document.getElementById(tableId);
        if (!table) return;

        var filterRow = table.querySelector('.filtros-row');
        if (!filterRow) return;

        var inputs = filterRow.querySelectorAll('input, select');
        var filters = {};
        inputs.forEach(function(inp) {
            var col = inp.getAttribute('data-col-index');
            if (col !== null) {
                filters[col] = inp.value.toLowerCase().trim();
            }
        });

        var tbody = table.querySelector('tbody');
        if (!tbody) return;

        var rows = tbody.querySelectorAll('tr');
        rows.forEach(function(row) {
            if (row.classList.contains('no-filtrar')) return;
            
            var visible = true;
            var cells = row.querySelectorAll('td');
            
            Object.keys(filters).forEach(function(colIndex) {
                var filterVal = filters[colIndex];
                if (!filterVal) return;
                
                var cell = cells[parseInt(colIndex)];
                if (!cell) {
                    visible = false;
                    return;
                }
                
                var cellText = cell.textContent.toLowerCase().trim();
                
                // Detectar si el filter es un select con valor
                var input = filterRow.querySelector('[data-col-index="' + colIndex + '"]');
                if (input && input.tagName === 'SELECT' && input.value) {
                    // Select filter - exact match or starts with
                    if (cellText !== input.value.toLowerCase() && 
                        !cellText.startsWith(input.value.toLowerCase())) {
                        visible = false;
                    }
                } else if (filterVal) {
                    // Text filter - contains match
                    if (cellText.indexOf(filterVal) === -1) {
                        visible = false;
                    }
                }
            });
            
            row.style.display = visible ? '' : 'none';
        });
    }
})();
