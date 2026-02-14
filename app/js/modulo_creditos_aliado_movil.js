/**
 * ============================================
 * MÓDULO JAVASCRIPT: Gestión de Créditos - Aliado Móvil
 * ============================================
 * Este archivo contiene todas las funciones JavaScript
 * organizadas por módulos para la gestión de créditos.
 * 
 * ESTRUCTURA:
 * 1. Namespace Global
 * 2. Utilidades
 * 3. Gestión de Vendedores
 * 4. Gestión de Cuentas Bancarias
 * 5. Gestión de Tiendas
 * 6. Gestión de Observaciones
 * 7. Cálculos de Crédito
 * 8. Configuración de Eventos
 */

// ============================================
// 1. NAMESPACE GLOBAL
// ============================================
var ModuloCreditos = window.ModuloCreditos || {};

// ============================================
// 2. UTILIDADES
// ============================================
ModuloCreditos.Utilidades = {
    /**
     * Formatea un número con separadores de miles
     * @param {number|string} numero - Número a formatear
     * @returns {string} Número formateado
     */
    formatearNumero: function(numero) {
        if (typeof numero === 'number') {
            return numero.toLocaleString('es-CO', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }
        return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    /**
     * Formatea número agregando puntos cada 3 dígitos
     * @param {string} valor - Valor a formatear
     * @returns {string} Valor formateado
     */
    formatearNumeroConMiles: function(valor) {
        var numero = valor.replace(/\./g, '').replace(/\D/g, '');
        return numero.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    /**
     * Limpia el formato de miles de un valor
     * @param {string} valor - Valor con formato
     * @returns {number} Valor numérico
     */
    limpiarFormato: function(valor) {
        return parseInt(valor.replace(/\./g, '').replace(/\D/g, '')) || 0;
    },

    /**
     * Muestra una notificación flotante
     * @param {string} mensaje - Mensaje a mostrar
     * @param {string} tipo - Tipo de notificación (success, error, warning, info)
     * @param {number} duracion - Duración en milisegundos
     */
    mostrarNotificacion: function(mensaje, tipo, duracion) {
        tipo = tipo || 'info';
        duracion = duracion || 3000;
        
        var existente = document.querySelector('.toast-notification');
        if (existente) {
            existente.remove();
        }
        
        var toast = document.createElement('div');
        toast.className = 'toast-notification toast-' + tipo;
        toast.innerHTML = mensaje;
        document.body.appendChild(toast);
        
        setTimeout(function() {
            toast.classList.add('show');
        }, 100);
        
        setTimeout(function() {
            toast.classList.remove('show');
            setTimeout(function() {
                toast.remove();
            }, 300);
        }, duracion);
    },

    /**
     * Muestra un modal de error
     * @param {string} modalId - ID del modal a mostrar
     * @param {string} mensaje - Mensaje de error (opcional)
     */
    mostrarModalError: function(modalId, mensaje) {
        if (mensaje) {
            var msgElement = document.getElementById('mensaje' + modalId.replace('#', '').replace('modal', ''));
            if (msgElement) {
                msgElement.textContent = mensaje;
            }
        }
        $(modalId).modal('show');
    }
};

// ============================================
// 3. GESTIÓN DE VENDEDORES
// ============================================
ModuloCreditos.Vendedores = {
    /**
     * Abre el modal de cambiar vendedor
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codVendedor - Código del vendedor actual
     */
    abrirModalCambiar: function(codInfoFacturaVenta, codVendedor) {
        console.log('Abriendo modal editar vendedor:', { codInfoFacturaVenta, codVendedor });
        
        $('#modalDetalleCredito').modal('hide');
        
        document.getElementById('CambiarVendedorCodInfoFactura').value = codInfoFacturaVenta;
        document.getElementById('CambiarVendedorCodActual').value = codVendedor;
        
        this.cargarVendedores(codInfoFacturaVenta, codVendedor, 'CambiarVendedorSelect');
        
        setTimeout(function() {
            $('#modalCambiarVendedor').modal('show');
        }, 300);
    },

    /**
     * Abre el modal de registrar vendedor
     * @param {string} codInfoFacturaVenta - Código de la factura
     */
    abrirModalRegistrar: function(codInfoFacturaVenta) {
        console.log('Abriendo modal registrar vendedor:', { codInfoFacturaVenta });
        
        $('#modalDetalleCredito').modal('hide');
        
        document.getElementById('registrarVendedorCodInfoFactura').value = codInfoFacturaVenta;
        document.getElementById('formRegistrarVendedor').reset();
        document.getElementById('alertRegistrarVendedor').style.display = 'none';
        
        setTimeout(function() {
            $('#modalRegistrarVendedor').modal('show');
        }, 300);
    },

    /**
     * Carga los vendedores en un select
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codVendedorActual - Código del vendedor actual
     * @param {string} selectId - ID del select a llenar
     */
    cargarVendedores: function(codInfoFacturaVenta, codVendedorActual, selectId) {
        var targetSelectId = selectId || 'CambiarVendedorSelect';

        $.ajax({
            url: '../admin/obtener_vendedores_modal_ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta
            },
            success: function(response) {
                if (response && response.success && response.vendedores) {
                    var select = document.getElementById(targetSelectId);
                    if (!select) {
                        console.error('Select no encontrado:', targetSelectId);
                        return;
                    }
                    
                    select.innerHTML = '<option value="">Seleccionar vendedor...</option>';

                    response.vendedores.forEach(function(vendedor) {
                        var option = document.createElement('option');
                        option.value = vendedor.cod_vendedor;
                        option.textContent = vendedor.nombres + ' ' + vendedor.apellidos;

                        if (codVendedorActual && vendedor.cod_vendedor == codVendedorActual) {
                            option.selected = true;
                        }

                        select.appendChild(option);
                    });
                    
                    if (codVendedorActual) {
                        try { select.value = codVendedorActual; } catch (e) { }
                    }
                } else {
                    console.error('Error al cargar vendedores');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error cargando vendedores:', error);
                var sel = document.getElementById(targetSelectId);
                if (sel) sel.innerHTML = '<option value="">Error al cargar vendedores</option>';
            }
        });
    },

    /**
     * Guarda los cambios de vendedor
     * @param {string} url - URL del endpoint
     * @param {object} datos - Datos a enviar
     * @param {function} callback - Callback de éxito
     */
    guardarCambios: function(url, datos, callback) {
        $.ajax({
            url: url,
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function(response) {
                if (callback) callback(response);
            },
            error: function(xhr, status, error) {
                console.error('Error al guardar vendedor:', error);
                ModuloCreditos.Utilidades.mostrarNotificacion('Error al guardar los cambios', 'error');
            }
        });
    }
};

// ============================================
// 4. GESTIÓN DE CUENTAS BANCARIAS
// ============================================
ModuloCreditos.CuentasBancarias = {
    /**
     * Abre el modal de cambiar cuenta bancaria
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codBancoCuenta - Código de la cuenta actual
     */
    abrirModalCambiar: function(codInfoFacturaVenta, codBancoCuenta) {
        console.log('Abriendo modal cambiar cuenta banco:', { codInfoFacturaVenta, codBancoCuenta });
        
        $('#modalDetalleCredito').modal('hide');
        
        document.getElementById('CambiarBancoCuentaCodInfoFactura').value = codInfoFacturaVenta;
        document.getElementById('CambiarBancoCuentaCodActual').value = codBancoCuenta;
        
        this.cargarCuentas(codInfoFacturaVenta, codBancoCuenta, 'CambiarBancoCuentaSelect');
        
        setTimeout(function() {
            $('#modalCambiarBancoCuenta').modal('show');
        }, 300);
    },

    /**
     * Abre el modal de registrar cuenta bancaria
     * @param {string} codInfoFacturaVenta - Código de la factura
     */
    abrirModalRegistrar: function(codInfoFacturaVenta) {
        console.log('Abriendo modal registrar cuenta banco:', { codInfoFacturaVenta });
        
        $('#modalDetalleCredito').modal('hide');
        
        document.getElementById('registrarBancoCuentaCodInfoFactura').value = codInfoFacturaVenta;
        document.getElementById('formRegistrarBancoCuenta').reset();
        document.getElementById('alertRegistrarBancoCuenta').style.display = 'none';
        
        setTimeout(function() {
            $('#modalRegistrarBancoCuenta').modal('show');
        }, 300);
    },

    /**
     * Carga las cuentas bancarias en un select
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codBancoCuentaActual - Código de la cuenta actual
     * @param {string} selectId - ID del select a llenar
     */
    cargarCuentas: function(codInfoFacturaVenta, codBancoCuentaActual, selectId) {
        var targetSelectId = selectId || 'CambiarBancoCuentaSelect';

        $.ajax({
            url: '../admin/obtener_banco_cuenta_modal_ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta
            },
            success: function(response) {
                if (response && response.success && response.cuentas) {
                    var select = document.getElementById(targetSelectId);
                    if (!select) {
                        console.error('Select no encontrado:', targetSelectId);
                        return;
                    }
                    
                    select.innerHTML = '<option value="">Seleccionar cuenta bancaria...</option>';

                    response.cuentas.forEach(function(cuenta) {
                        var option = document.createElement('option');
                        option.value = cuenta.cod_banco_cuenta;
                        option.textContent = cuenta.nombre_banco_cuenta + ' - ' + cuenta.numero_banco_cuenta;

                        if (codBancoCuentaActual && cuenta.cod_banco_cuenta == codBancoCuentaActual) {
                            option.selected = true;
                        }

                        select.appendChild(option);
                    });
                    
                    if (codBancoCuentaActual) {
                        try { select.value = codBancoCuentaActual; } catch (e) { }
                    }
                } else {
                    console.error('Error al cargar cuentas bancarias');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error cargando cuentas:', error);
                var sel = document.getElementById(targetSelectId);
                if (sel) sel.innerHTML = '<option value="">Error al cargar cuentas</option>';
            }
        });
    }
};

// ============================================
// 5. GESTIÓN DE TIENDAS
// ============================================
ModuloCreditos.Tiendas = {
    /**
     * Abre el modal de cambiar tienda
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codTienda - Código de la tienda actual
     */
    abrirModalCambiar: function(codInfoFacturaVenta, codTienda) {
        console.log('Abriendo modal cambiar tienda:', { codInfoFacturaVenta, codTienda });
        
        $('#modalDetalleCredito').modal('hide');
        $('#modalCambiarTienda').data('codInfoFacturaVenta', codInfoFacturaVenta);
        
        this.cargarTiendas(codInfoFacturaVenta, codTienda);
        
        setTimeout(function() {
            $('#modalCambiarTienda').modal('show');
        }, 300);
    },

    /**
     * Abre el modal de registrar tienda
     * @param {string} codInfoFacturaVenta - Código de la factura
     */
    abrirModalRegistrar: function(codInfoFacturaVenta) {
        console.log('Abriendo modal registrar tienda:', { codInfoFacturaVenta });
        
        $('#modalDetalleCredito').modal('hide');
        $('#modalRegistrarTienda').data('codInfoFacturaVenta', codInfoFacturaVenta);
        
        document.getElementById('formRegistrarTienda').reset();
        document.getElementById('alertRegistrarTienda').style.display = 'none';
        
        setTimeout(function() {
            $('#modalRegistrarTienda').modal('show');
        }, 300);
    },

    /**
     * Carga las tiendas en un select
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} codTiendaActual - Código de la tienda actual
     */
    cargarTiendas: function(codInfoFacturaVenta, codTiendaActual) {
        $.ajax({
            url: '../admin/obtener_tienda_modal_ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                cod_info_factura_venta: codInfoFacturaVenta
            },
            success: function(response) {
                if (response && response.success && response.tiendas) {
                    var select = document.getElementById('CambiarTiendaSelect');
                    
                    select.innerHTML = '<option value="" style="background: #1a1d3a; color: white;">Seleccione...</option>';

                    response.tiendas.forEach(function(tienda) {
                        var option = document.createElement('option');
                        option.value = tienda.cod_tienda;
                        option.textContent = tienda.nombre_tienda;
                        option.style.background = '#1a1d3a';
                        option.style.color = 'white';

                        if (codTiendaActual && tienda.cod_tienda == codTiendaActual) {
                            option.selected = true;
                        }

                        select.appendChild(option);
                    });
                } else {
                    console.error('Error al cargar tiendas');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error cargando tiendas:', error);
            }
        });
    }
};

// ============================================
// 6. GESTIÓN DE OBSERVACIONES
// ============================================
ModuloCreditos.Observaciones = {
    /**
     * Abre el modal de editar observación
     * @param {string} codInfoFacturaVenta - Código de la factura
     * @param {string} observacionActual - Observación actual
     */
    abrirModalEditar: function(codInfoFacturaVenta, observacionActual) {
        console.log('Abriendo modal editar observación:', { codInfoFacturaVenta });
        
        $('#modalDetalleCredito').modal('hide');
        
        document.getElementById('editarObservacionCodInfoFactura').value = codInfoFacturaVenta;
        document.getElementById('editarObservacionTexto').value = observacionActual || '';
        document.getElementById('alertEditarObservacion').style.display = 'none';
        
        setTimeout(function() {
            $('#modalEditarObservacion').modal('show');
        }, 300);
    }
};

// ============================================
// 7. CÁLCULOS DE CRÉDITO
// ============================================
ModuloCreditos.Calculos = {
    /**
     * Calcula el valor del crédito
     */
    calcularValorCredito: function() {
        var precioVentaProducto = parseFloat(document.getElementById('precio_venta_producto').value) || 0;
        var numeroCuotas = parseInt(document.getElementById('numero_cuotas').value) || 0;

        var selectEntidad = document.getElementById('cod_entidad_crediticia');
        var codEntidadCrediticia = selectEntidad.options[selectEntidad.selectedIndex].value;

        var selectSimulacion = document.getElementById('cod_tipo_simulacion_credito');
        var codTipoSimulacionCredito = selectSimulacion.options[selectSimulacion.selectedIndex].value;

        // Actualizar etiquetas según tipo de simulación
        if (codTipoSimulacionCredito == '1') { 
            document.getElementById('text_label_valor').textContent = "Valor de Contado";
            document.getElementById('text_label_valor_calc').textContent = "Valor Total a Crédito";
        } else {
            document.getElementById('text_label_valor').textContent = "Valor a Crédito";
            document.getElementById('text_label_valor_calc').textContent = "Valor Total de Contado";
        }

        if (precioVentaProducto > 0 && numeroCuotas > 0 && codEntidadCrediticia) {
            var self = this;
            $.ajax({
                url: '../admin/calcular_valor_credito_tipo_simulacion_ajax.php',
                type: 'POST',
                data: { 
                    precio_venta_producto: precioVentaProducto, 
                    numero_cuotas: numeroCuotas, 
                    cod_entidad_crediticia: codEntidadCrediticia, 
                    cod_tipo_simulacion_credito: codTipoSimulacionCredito 
                },
                dataType: 'json',
                success: function(response) {
                    if (response && response.success) {
                        var valorMostrar = response.cod_tipo_simulacion_credito == '1' || response.cod_tipo_simulacion_credito == '0' 
                            ? response.valor_credito_calculado 
                            : response.valor_contado;
                        
                        document.getElementById('valorTotalCredito').textContent = ModuloCreditos.Utilidades.formatearNumero(valorMostrar);
                        document.getElementById('valorPorCuota').textContent = ModuloCreditos.Utilidades.formatearNumero(response.cuota_credito);
                        document.getElementById('interesesGenerados').textContent = ModuloCreditos.Utilidades.formatearNumero(response.total_interes);
                        document.getElementById('resultadosCalculo').style.display = 'block';     
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al calcular:', error);
                    ModuloCreditos.Utilidades.mostrarNotificacion('Error al calcular el crédito', 'error');
                }
            });
        } else {
            this.ocultarResultados();
        }    
    },

    /**
     * Oculta los resultados del cálculo
     */
    ocultarResultados: function() {
        var resultados = document.getElementById('resultadosCalculo');
        if (resultados) {
            resultados.style.display = 'none';
        }
    }
};

// ============================================
// 8. CONFIGURACIÓN DE EVENTOS
// ============================================
ModuloCreditos.configurarEventos = function() {
    console.log('🔧 Configurando eventos del módulo de créditos...');
    
    // Delegación para botones de asignar vendedor
    $(document).off('click', '.btn-asignar-vendedor').on('click', '.btn-asignar-vendedor', function(e) {
        e.preventDefault();
        var codInfo = $(this).data('cod_info_factura_venta');
        var codVendedor = $(this).data('cod_vendedor') || '';

        $('#AsignarVendedorCodInfoFactura').val(codInfo);
        ModuloCreditos.Vendedores.cargarVendedores(codInfo, codVendedor, 'AsignarVendedorSelect');
        
        setTimeout(function() {
            $('#modalAsignarVendedor').modal('show');
        }, 100);
    });

    // Delegación para botones de asignar cuenta banco
    $(document).off('click', '.btn-asignar-banco-cuenta').on('click', '.btn-asignar-banco-cuenta', function(e) {
        e.preventDefault();
        var codInfo = $(this).data('cod_info_factura_venta');
        var codBancoCuenta = $(this).data('cod_banco_cuenta') || '';

        $('#AsignarBancoCuentaCodInfoFactura').val(codInfo);
        ModuloCreditos.CuentasBancarias.cargarCuentas(codInfo, codBancoCuenta, 'AsignarBancoCuentaSelect');
        
        setTimeout(function() {
            $('#modalAsignarBancoCuenta').modal('show');
        }, 100);
    });

    // Botón cancelar cambiar vendedor
    $(document).off('click', '#btnCancelarCambiarVendedor').on('click', '#btnCancelarCambiarVendedor', function(e) {
        e.preventDefault();
        $('#modalCambiarVendedor').modal('hide');
        $('#modalCambiarVendedor').on('hidden.bs.modal', function(e) {
            $(this).off('hidden.bs.modal');
            $('#modalDetalleCredito').modal('show');
        });
    });

    // Botón cancelar asignar vendedor
    $(document).off('click', '#btnCancelarAsignarVendedor').on('click', '#btnCancelarAsignarVendedor', function(e) {
        e.preventDefault();
        $('#modalAsignarVendedor').modal('hide');
    });

    // Botón cancelar cambiar banco cuenta
    $(document).off('click', '#btnCancelarCambiarBancoCuenta').on('click', '#btnCancelarCambiarBancoCuenta', function(e) {
        e.preventDefault();
        $('#modalCambiarBancoCuenta').modal('hide');
        $('#modalCambiarBancoCuenta').on('hidden.bs.modal', function(e) {
            $(this).off('hidden.bs.modal');
            $('#modalDetalleCredito').modal('show');
        });
    });

    // Botón cancelar asignar banco cuenta
    $(document).off('click', '#btnCancelarAsignarBancoCuenta').on('click', '#btnCancelarAsignarBancoCuenta', function(e) {
        e.preventDefault();
        $('#modalAsignarBancoCuenta').modal('hide');
    });

    // Botón cancelar cambiar tienda
    $(document).off('click', '#btnCancelarCambiarTienda').on('click', '#btnCancelarCambiarTienda', function(e) {
        e.preventDefault();
        $('#modalCambiarTienda').modal('hide');
        $('#modalCambiarTienda').on('hidden.bs.modal', function(e) {
            $(this).off('hidden.bs.modal');
            $('#modalDetalleCredito').modal('show');
        });
    });

    // Botón cancelar registrar tienda
    $(document).off('click', '#btnCancelarRegistrarTienda').on('click', '#btnCancelarRegistrarTienda', function(e) {
        e.preventDefault();
        $('#modalRegistrarTienda').modal('hide');
        $('#modalRegistrarTienda').on('hidden.bs.modal', function(e) {
            $(this).off('hidden.bs.modal');
            $('#modalDetalleCredito').modal('show');
        });
    });

    // Botón cancelar editar observación
    $(document).off('click', '#btnCancelarEditarObservacion').on('click', '#btnCancelarEditarObservacion', function(e) {
        e.preventDefault();
        $('#modalEditarObservacion').modal('hide');
        $('#modalEditarObservacion').on('hidden.bs.modal', function(e) {
            $(this).off('hidden.bs.modal');
            $('#modalDetalleCredito').modal('show');
        });
    });

    console.log('✅ Eventos del módulo de créditos configurados');
};

// Exponer función globalmente para configurarModalEventos
window.configurarModalEventos = ModuloCreditos.configurarEventos;

// Exponer funciones globales para compatibilidad con código existente
window.abrirModalCambiarVendedor = function(cod, ven) { ModuloCreditos.Vendedores.abrirModalCambiar(cod, ven); };
window.abrirModalRegistrarVendedor = function(cod) { ModuloCreditos.Vendedores.abrirModalRegistrar(cod); };
window.cargarVendedores = function(cod, ven, sel) { ModuloCreditos.Vendedores.cargarVendedores(cod, ven, sel); };
window.abrirModalCambiarBancoCuenta = function(cod, ban) { ModuloCreditos.CuentasBancarias.abrirModalCambiar(cod, ban); };
window.abrirModalRegistrarBancoCuenta = function(cod) { ModuloCreditos.CuentasBancarias.abrirModalRegistrar(cod); };
window.cargarBancoCuentas = function(cod, ban, sel) { ModuloCreditos.CuentasBancarias.cargarCuentas(cod, ban, sel); };
window.abrirModalCambiarTienda = function(cod, tie) { ModuloCreditos.Tiendas.abrirModalCambiar(cod, tie); };
window.abrirModalRegistrarTienda = function(cod) { ModuloCreditos.Tiendas.abrirModalRegistrar(cod); };
window.cargarTiendas = function(cod, tie) { ModuloCreditos.Tiendas.cargarTiendas(cod, tie); };
window.abrirModalEditarObservacion = function(cod, obs) { ModuloCreditos.Observaciones.abrirModalEditar(cod, obs); };
window.calcularValorCredito = function() { ModuloCreditos.Calculos.calcularValorCredito(); };
window.formatearNumero = function(num) { return ModuloCreditos.Utilidades.formatearNumero(num); };
window.formatearNumeroConMiles = function(val) { return ModuloCreditos.Utilidades.formatearNumeroConMiles(val); };
window.showFloatingNotification = function(msg, tipo) { ModuloCreditos.Utilidades.mostrarNotificacion(msg, tipo); };

// Inicializar cuando el documento esté listo
$(document).ready(function() {
    ModuloCreditos.configurarEventos();
});
