/**
 * guias_modulos.js - Sistema de guias contextuales para el modulo administrativo
 * 
 * Proporciona un boton de ayuda (?) reutilizable y contenido de guia para cada modulo.
 * 
 * Uso: showModuleGuide('dashboard') - muestra la guia del modulo especificado.
 * 
 * @see plan/plan_completo_cambios_administrativo.md (REQ 11)
 */

(function() {
    'use strict';

    /**
     * Contenido de las guias para cada modulo
     */
    var GUIAS = {
        dashboard: {
            titulo: 'Guia del Dashboard Ejecutivo',
            contenido: [
                {
                    titulo: 'KPIs principales',
                    texto: 'Los indicadores en la parte superior muestran: Ventas del dia (comparativo vs ayer), Creditos aprobados, Cartera por cobrar, Saldo bancario total, Utilidad acumulada del mes y Relacion gasto/ingreso. Use los filtros de fecha para cambiar el periodo de analisis.'
                },
                {
                    titulo: 'Grafica de Ventas por Linea',
                    texto: 'El grafico donut muestra la distribucion de ventas por linea de credito en los ultimos 6 meses. Pase el mouse sobre las porciones para ver los valores exactos.'
                },
                {
                    titulo: 'Grafica de Utilidad por Linea',
                    texto: 'El grafico de barras compara la utilidad estimada (30% margen) de cada linea de credito. Las barras mas altas indican mayor rentabilidad.'
                },
                {
                    titulo: 'Alertas operativas',
                    texto: 'La seccion de alertas muestra creditos sin documentos, sin voucher de pago, habilitadores sin girar y creditos potencialmente en perdida que requieren atencion.'
                },
                {
                    titulo: 'Secciones inferiores',
                    texto: 'El Dashboard tambien muestra: Flujo financiero del dia, Rentabilidad por linea detallada, Anulaciones del mes, Por cobrar a habilitadores, y la tabla de Ultimos Creditos con acceso rapido al detalle.'
                }
            ]
        },
        creditos_lista: {
            titulo: 'Guia del Modulo de Creditos',
            contenido: [
                {
                    titulo: 'Listado de creditos',
                    texto: 'Muestra todos los creditos registrados con informacion de cliente, comercio, linea, valores, abonos y estado. Use los filtros superiores para buscar por ID, cliente, comercio, linea de credito, fechas o estado.'
                },
                {
                    titulo: 'Filtros rapidos de fecha',
                    texto: 'Los botones Hoy, 7d, 30d y 3m permiten cambiar rapidamente el periodo de busqueda sin tener que escribir las fechas manualmente.'
                },
                {
                    titulo: 'Acciones por credito',
                    texto: 'Cada fila tiene botones para Ver detalle (informacion completa con 8 tabs) y Liquidar (calculo de margenes). Tambien puede cambiar el estado del credito haciendo clic en el lapiz junto al badge de estado.'
                },
                {
                    titulo: 'Columnas de la tabla',
                    texto: 'Valor Contado = precio original sin interes. Valor Cliente = monto financiado con interes. Abonado = total pagado hasta la fecha. Saldo se calcula automaticamente.'
                }
            ]
        },
        credito_detalle: {
            titulo: 'Guia del Detalle de Credito',
            contenido: [
                {
                    titulo: 'Tabs de navegacion',
                    texto: 'El detalle del credito esta organizado en 8 pestanas: Resumen (informacion general del cliente, comercio y finanzas), Solicitud (datos de la solicitud), Documentos (archivos adjuntos), Liquidaciones (calculo comercial e interno), Pagos (historial de abonos), Historial (cambios y notas), Anulaciones (impacto financiero) y Comunicacion (notas internas).'
                },
                {
                    titulo: 'Resumen Financiero',
                    texto: 'Muestra tres tarjetas: Valor Financiado (monto total con interes), Abonado (total pagado) y Saldo Pendiente. Tambien incluye botones de accion rapida para Liquidar o Anular el credito.'
                },
                {
                    titulo: 'Liquidaciones',
                    texto: 'La pestana Liquidaciones muestra dos calculos lado a lado: Liquidacion Comercial (lo que paga el cliente) y Liquidacion Interna (la utilidad de Flexitech). Incluye validacion de margen minimo del 15%.'
                }
            ]
        },
        liquidaciones: {
            titulo: 'Guia de Liquidaciones',
            contenido: [
                {
                    titulo: 'Liquidacion Comercial vs Interna',
                    texto: 'La Liquidacion Comercial calcula lo que el cliente debe pagar (valor contado + recargo administrativo). La Liquidacion Interna calcula la utilidad de Flexitech despues de descontar el porcentaje del habilitador y comisiones.'
                },
                {
                    titulo: 'Como liquidar un credito',
                    texto: 'Ingrese el ID del credito en el campo superior y haga clic en "Calcular". Tambien puede hacer clic en el boton "Liquidar" desde el listado de creditos o desde el detalle del credito.'
                },
                {
                    titulo: 'Validacion de margen',
                    texto: 'El sistema muestra si el margen de la operacion cumple con el minimo establecido (15%). Si el margen es inferior, se marca en rojo como advertencia.'
                }
            ]
        },
        habilitadores: {
            titulo: 'Guia de Lineas de Credito',
            contenido: [
                {
                    titulo: 'Gestion de lineas',
                    texto: 'Este modulo permite administrar las entidades crediticias (habilitadores/lineas). Puede crear nuevas lineas, editar existentes, activar o desactivar lineas, y ver el detalle de cada una con sus creditos asociados.'
                },
                {
                    titulo: 'Campos del formulario',
                    texto: 'Nombre (obligatorio), NIT, Telefono, Email, Nombre del contacto, Interes (%) y Comision (%). El interes y la comision son porcentajes que se aplican a los creditos de esa linea.'
                },
                {
                    titulo: 'Estados',
                    texto: 'Las lineas pueden estar Activas (visibles en los selectores de credito) o Inactivas (deshabilitadas). Use el filtro de estado para ver solo activas, inactivas o todas.'
                }
            ]
        },
        clientes: {
            titulo: 'Guia de Clientes',
            contenido: [
                {
                    titulo: 'Listado de clientes',
                    texto: 'Muestra todos los clientes registrados con su informacion de contacto, cantidad de creditos activos y valor total. Use la barra de busqueda para filtrar por nombre o identificacion.'
                },
                {
                    titulo: 'Editar cliente',
                    texto: 'Haga clic en el boton de lapiz para editar los datos del cliente: nombre, telefono, email y direccion. La identificacion no se puede modificar. Los cambios se guardan automaticamente.'
                },
                {
                    titulo: 'Detalle del cliente',
                    texto: 'Haga clic en "Ver detalle" para acceder a la informacion completa del cliente y la lista de todos sus creditos asociados con sus estados y valores.'
                }
            ]
        },
        comercios: {
            titulo: 'Guia de Comercios / Puntos de Venta',
            contenido: [
                {
                    titulo: 'Gestion de comercios',
                    texto: 'Este modulo lista todos los comercios (tiendas) afiliados al sistema. Muestra informacion como NIT, direccion, telefono, total de creditos procesados y el valor total de ventas.'
                },
                {
                    titulo: 'Detalle del comercio',
                    texto: 'Haga clic en "Ver Detalle" para acceder a la informacion completa del comercio y la lista de creditos asociados. Puede ver el estado de cada credito desde alli.'
                }
            ]
        },
        pagos_habilitadores: {
            titulo: 'Guia de Pagos de Habilitadores',
            contenido: [
                {
                    titulo: 'Que son los pagos de habilitadores?',
                    texto: 'Son los pagos que los habilitadores (entidades crediticias) realizan a Flexitech. Estos pagos se registran como entradas (debitos) en la tesoreria. El modulo permite dar seguimiento a los montos cobrados y pendientes.'
                },
                {
                    titulo: 'KPIs disponibles',
                    texto: 'Total cobros (cantidad de pagos en el periodo), Cobrado total (suma de montos), Cobrado hoy (pagos del dia), Pendiente por cobrar (saldo de cuentas activas), Promedio dias de pago y Habilitadores con atraso (>60 dias).'
                },
                {
                    titulo: 'Columna de estado',
                    texto: 'Recibido = pago procesado con fecha anterior, Hoy = pago del dia actual, Pendiente = programado para futuro.'
                }
            ]
        },
        pagos_comercios: {
            titulo: 'Guia de Pagos a Comercios',
            contenido: [
                {
                    titulo: 'Gestion de pagos a comercios',
                    texto: 'Este modulo registra los pagos realizados a los comercios (tiendas) por los creditos procesados. Los pagos se reflejan como salidas (creditos) en los movimientos de caja.'
                },
                {
                    titulo: 'KPIs disponibles',
                    texto: 'Total pagos (cantidad en el periodo), Monto pagado, Pagado hoy y Pendiente estimado. Use los filtros de fecha y busqueda para encontrar pagos especificos.'
                },
                {
                    titulo: 'Columnas informativas',
                    texto: 'Cada registro muestra: Fecha del pago, Comercio/Tercero, Credito relacionado (enlace al detalle), Concepto, Valor y Estado (Pagado o Pendiente segun la fecha).'
                }
            ]
        },
        gastos: {
            titulo: 'Guia de Gastos Operativos',
            contenido: [
                {
                    titulo: 'Registro y control de gastos',
                    texto: 'Este modulo permite registrar y dar seguimiento a los gastos operativos. Cada gasto se asocia a una cuenta contable y genera automaticamente un movimiento de salida en tesoreria.'
                },
                {
                    titulo: 'Categorias de gastos',
                    texto: 'Los gastos se clasifican segun el codigo de cuenta: Operativos (codigo 5xx), Ingresos (4xx) y Financieros (2xx). Use el filtro de categoria para ver un tipo especifico.'
                },
                {
                    titulo: 'Exportar a CSV',
                    texto: 'Use el boton "Exportar Excel" para descargar un archivo CSV con todos los gastos del periodo filtrado, incluyendo categoria y cuenta contable.'
                },
                {
                    titulo: 'Anular gastos',
                    texto: 'Los gastos pueden anularse, lo que revierte automaticamente el movimiento contable de salida. Los gastos anulados se muestran con opcion de "Mostrar anulados".'
                }
            ]
        },
        tesoreria: {
            titulo: 'Guia de Tesoreria',
            contenido: [
                {
                    titulo: 'Movimientos de caja',
                    texto: 'Este modulo muestra todos los movimientos (entradas y salidas) de las cuentas. Puede filtrar por fecha, tipo de movimiento y cuenta bancaria para analizar el flujo de caja.'
                },
                {
                    titulo: 'Saldo y conciliacion',
                    texto: 'Los saldos mostrados son en tiempo real basados en los movimientos registrados. Use los filtros para ver movimientos de un periodo especifico o de una cuenta en particular.'
                }
            ]
        },
        prestamos: {
            titulo: 'Guia de Prestamo Empleado',
            contenido: [
                {
                    titulo: 'Gestion de prestamos a empleados',
                    texto: 'Este modulo permite crear, gestionar y dar seguimiento a prestamos concedidos a empleados. Incluye calculo automatico de cuotas, registro de pagos y anulacion de prestamos.'
                },
                {
                    titulo: 'KPIs del modulo',
                    texto: 'Prestamos Activos (vigentes), Saldo Total por cobrar, Cuotas del Mes por vencer y Cuotas Vencidas (con atraso). Estos indicadores se actualizan automaticamente.'
                },
                {
                    titulo: 'Crear un prestamo',
                    texto: 'Seleccione el empleado, ingrese el monto, numero de cuotas e interes (%). El sistema calcula automaticamente el valor de cada cuota y el total a pagar. Las cuotas se generan automaticamente.'
                },
                {
                    titulo: 'Pago de cuotas',
                    texto: 'Desde el detalle del prestamo, puede pagar cuotas individualmente. Seleccione la forma de pago: Descuento de nomina (asociado a cuenta bancaria), Efectivo o Transferencia.'
                }
            ]
        },
        anulaciones: {
            titulo: 'Guia de Anulaciones',
            contenido: [
                {
                    titulo: 'Proceso de anulacion',
                    texto: 'Seleccione un credito disponible y calcule el impacto financiero de la anulacion. El sistema muestra el valor financiado, penalidad del habilitador, costos asociados y la perdida total estimada.'
                },
                {
                    titulo: 'Tipos de anulacion',
                    texto: 'Antes de aprobacion (penalidad menor), Despues de aprobacion (penalidad mayor) y Perdida total. Cada tipo afecta el calculo del impacto financiero.'
                },
                {
                    titulo: 'Confirmacion',
                    texto: 'La anulacion requiere un motivo obligatorio y una doble confirmacion. Una vez confirmada, el credito cambia a estado ANULADA y se registra el impacto financiero.'
                }
            ]
        },
        reportes: {
            titulo: 'Guia de Reportes',
            contenido: [
                {
                    titulo: 'Tabs de reportes',
                    texto: 'El modulo esta organizado en 4 pestanas: Rentabilidad (analisis de utilidad por linea), Cartera (estado de cuentas por cobrar), Por Comercio (top 10 comercios por volumen) y Por Linea (performance por linea de credito).'
                },
                {
                    titulo: 'Analisis de Rentabilidad',
                    texto: 'Muestra una tabla detallada con ventas, costos, utilidad bruta, gastos asociados, utilidad neta y margen real por cada linea de credito. Incluye un grafico donut de distribucion y un resumen del periodo.'
                },
                {
                    titulo: 'Exportacion',
                    texto: 'Use los filtros de fecha para ajustar el periodo de analisis. Los datos se actualizan automaticamente al cambiar de pestana o hacer clic en "Actualizar".'
                }
            ]
        },
        configuracion: {
            titulo: 'Guia de Configuracion',
            contenido: [
                {
                    titulo: 'Ajustes del sistema',
                    texto: 'Este modulo permite configurar parametros generales del sistema administrativo. Los cambios aqui afectan la operacion global del portal.'
                }
            ]
        },
        documentos: {
            titulo: 'Guia de Documentos',
            contenido: [
                {
                    titulo: 'Gestion documental',
                    texto: 'Este modulo permite gestionar los archivos adjuntos de los creditos. Desde el detalle de cada credito, en la pestana Documentos, puede ver y descargar los archivos asociados.'
                },
                {
                    titulo: 'Tipos de documentos',
                    texto: 'Los documentos incluyen: identificacion del cliente, comprobantes de pago, vouchers, facturas y cualquier otro soporte asociado al credito.'
                }
            ]
        }
    };

    /**
     * Cierra la guia contextual
     * @param {Event} e - Evento de clic (opcional)
     */
    window.cerrarGuia = function(e) {
        if (e && e.target !== e.currentTarget) return;
        var modal = document.getElementById('modal-guia');
        if (modal) modal.remove();
    };

    /**
     * Muestra la guia contextual de un modulo en un modal
     * @param {string} modulo - Identificador del modulo
     */
    window.showModuleGuide = function(modulo) {
        var guia = GUIAS[modulo];
        if (!guia) {
            guia = {
                titulo: 'Ayuda',
                contenido: [
                    { titulo: 'Modulo en desarrollo', texto: 'La guia para este modulo estara disponible proximamente.' }
                ]
            };
        }

        var html = '<div id="modal-guia" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:2000;display:flex;align-items:center;justify-content:center;" onclick="cerrarGuia(event)">';
        html += '<div style="background:#1e293b;border:1px solid #334155;border-radius:16px;width:640px;max-width:94%;max-height:85vh;overflow-y:auto;padding:0;box-shadow:0 25px 80px rgba(0,0,0,0.6);" onclick="event.stopPropagation()">';
        
        // Header
        html += '<div style="display:flex;align-items:center;gap:12px;padding:18px 22px;border-bottom:1px solid #334155;background:#0f172a;border-radius:16px 16px 0 0;position:sticky;top:0;z-index:1;">';
        html += '<div style="width:36px;height:36px;border-radius:10px;background:rgba(79,142,247,0.15);display:flex;align-items:center;justify-content:center;font-size:16px;color:#4f8ef7;"><i class="fa-solid fa-circle-info"></i></div>';
        html += '<div style="flex:1;"><h3 style="margin:0;font-size:15px;font-weight:700;color:#f1f5f9;">' + guia.titulo + '</h3>';
        html += '<p style="margin:1px 0 0;font-size:11px;color:#64748b;">Informacion contextual del modulo</p></div>';
        html += '<button onclick="cerrarGuia()" style="background:transparent;border:none;color:#64748b;cursor:pointer;font-size:20px;padding:4px;" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>';
        html += '</div>';
        
        // Body
        html += '<div style="padding:8px 22px 18px;">';
        
        for (var i = 0; i < guia.contenido.length; i++) {
            var item = guia.contenido[i];
            html += '<div style="margin-top:14px;background:#0f172a;border:1px solid #1e293b;border-radius:10px;padding:14px 16px;">';
            html += '<div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">';
            html += '<span style="width:22px;height:22px;border-radius:6px;background:rgba(79,142,247,0.12);display:flex;align-items:center;justify-content:center;color:#4f8ef7;font-size:10px;font-weight:700;flex-shrink:0;">' + (i + 1) + '</span>';
            html += '<h4 style="margin:0;font-size:12px;font-weight:700;color:#e2e8f0;">' + item.titulo + '</h4>';
            html += '</div>';
            html += '<p style="margin:0 0 0 30px;font-size:12px;color:#94a3b8;line-height:1.6;">' + item.texto + '</p>';
            html += '</div>';
        }
        
        html += '</div>';
        
        // Footer
        html += '<div style="display:flex;justify-content:flex-end;gap:8px;padding:12px 22px;border-top:1px solid #334155;background:#0f172a;border-radius:0 0 16px 16px;">';
        html += '<button onclick="cerrarGuia()" style="padding:8px 20px;background:#334155;border:none;border-radius:8px;color:#e2e8f0;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;">Cerrar</button>';
        html += '</div>';
        
        html += '</div></div>';

        var existing = document.getElementById('modal-guia');
        if (existing) existing.remove();
        
        var div = document.createElement('div');
        div.innerHTML = html;
        document.body.appendChild(div);
    };

    // Cerrar con tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarGuia();
        }
    });

    /**
     * Agrega el boton de ayuda (?) a un elemento contenedor
     * @param {string} modulo - Identificador del modulo
     * @param {HTMLElement} contenedor - Elemento donde agregar el boton
     */
    window.agregarBotonAyuda = function(modulo, contenedor) {
        if (!contenedor) return;
        var btn = document.createElement('button');
        btn.className = 'dayq-help-btn';
        btn.innerHTML = '<i class="fa-solid fa-circle-question"></i>';
        btn.title = 'Ayuda contextual';
        btn.onclick = function() { showModuleGuide(modulo); };
        contenedor.appendChild(btn);
    };

})();
