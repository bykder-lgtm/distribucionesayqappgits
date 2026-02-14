<?php
/**
 * ============================================
 * MÓDULO: Modales de Formularios de Gestión
 * ============================================
 * Este archivo contiene todos los modales de formularios
 * para gestión de vendedores, cuentas bancarias, tiendas, etc.
 * 
 * Incluido desde: tabla_busqueda_paginacion_info_factura_venta_siscredito_visitante_intern_aliado_movil_ajax.php
 */
?>

<!-- Modal Cambiar Vendedor -->
<div class="modal fade" id="modalCambiarVendedor" tabindex="-1" aria-labelledby="modalCambiarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Cambiar Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarVendedor">
                    <input type="hidden" id="CambiarVendedorCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="CambiarVendedorCodActual" name="cod_vendedor_actual">
                    
                    <div class="mb-3">
                        <label for="CambiarVendedorSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Vendedor</label>
                        <select id="CambiarVendedorSelect" name="cod_vendedor" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando vendedores...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertCambiarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarVendedor" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Asignar Vendedor -->
<div class="modal fade" id="modalAsignarVendedor" tabindex="-1" aria-labelledby="modalAsignarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalAsignarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-user-plus" style="margin-right: 8px;"></i>Asignar Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formAsignarVendedor">
                    <input type="hidden" id="AsignarVendedorCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="AsignarVendedorCodActual" name="cod_vendedor_actual">
            
                    <div class="mb-3">
                        <label for="AsignarVendedorSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Vendedor</label>
                        <select id="AsignarVendedorSelect" name="cod_vendedor" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando vendedores...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertAsignarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarAsignarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarAsignarVendedor" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Asignación</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Vendedor -->
<div class="modal fade" id="modalRegistrarVendedor" tabindex="-1" aria-labelledby="modalRegistrarVendedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarVendedorLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-plus" style="margin-right: 8px;"></i>Registrar Nuevo Vendedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarVendedor">
                    <input type="hidden" id="registrarVendedorCodInfoFactura" name="cod_info_factura_venta">

                    <div class="mb-3">
                        <label for="registrarVendedorCedula" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Documento * </label>
                        <input type="number" id="registrarVendedorCedula" name="cedula" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarVendedorNombres" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombres *</label>
                            <input type="text" id="registrarVendedorNombres" name="nombres" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarVendedorApellidos" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Apellidos *</label>
                            <input type="text" id="registrarVendedorApellidos" name="apellidos" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>
                    <div class="alert" id="alertRegistrarVendedor" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarVendedor" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarVendedor" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Vendedor</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Banco Cuenta -->
<div class="modal fade" id="modalCambiarBancoCuenta" tabindex="-1" aria-labelledby="modalCambiarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-university" style="margin-right: 8px;"></i>Cambiar Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarBancoCuenta">
                    <input type="hidden" id="CambiarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="CambiarBancoCuentaCodActual" name="cod_banco_cuenta_actual">
                    
                    <div class="mb-3">
                        <label for="CambiarBancoCuentaSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Cuenta Bancaria</label>
                        <select id="CambiarBancoCuentaSelect" name="cod_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando cuentas bancarias...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertCambiarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Asignar Cuenta Banco -->
<div class="modal fade" id="modalAsignarBancoCuenta" tabindex="-1" aria-labelledby="modalAsignarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalAsignarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-university" style="margin-right: 8px;"></i>Asignar Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formAsignarBancoCuenta">
                    <input type="hidden" id="AsignarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    <input type="hidden" id="AsignarBancoCuentaCodActual" name="cod_banco_cuenta_actual">
                    
                    <div class="mb-3">
                        <label for="AsignarBancoCuentaSelect" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Seleccionar Cuenta Bancaria</label>
                        <select id="AsignarBancoCuentaSelect" name="cod_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto; min-height: 45px; line-height: 1.5; font-size: 1rem;" required>
                            <option value="" style="color: #000;">Cargando cuentas bancarias...</option>
                        </select>
                    </div>

                    <div class="alert" id="alertAsignarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarAsignarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarAsignarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Asignación</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Banco Cuenta -->
<div class="modal fade" id="modalRegistrarBancoCuenta" tabindex="-1" aria-labelledby="modalRegistrarBancoCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarBancoCuentaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-plus-circle" style="margin-right: 8px;"></i>Registrar Nueva Cuenta Bancaria
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: white; font-size: 1.5rem; opacity: 0.7;">×</button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarBancoCuenta">
                    <input type="hidden" id="registrarBancoCuentaCodInfoFactura" name="cod_info_factura_venta">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaNombre" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombre del Banco *</label>
                            <input type="text" id="registrarBancoCuentaNombre" name="nombre_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaNumero" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Número de Cuenta *</label>
                            <input type="text" id="registrarBancoCuentaNumero" name="numero_banco_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaTitular" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Nombre del Titular de la Cuenta</label>
                            <input type="text" id="registrarBancoCuentaTitular" name="nombre_titular_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registrarBancoCuentaIdentificacion" style="color: #a0aec0; font-size: 0.85rem; margin-bottom: 0.5rem; display: block;">Documento del titular de la cuenta</label>
                            <input type="text" id="registrarBancoCuentaIdentificacion" name="identificacion_titular_cuenta" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;" required>
                        </div>
                    </div>  

                    <div class="alert" id="alertRegistrarBancoCuenta" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarBancoCuenta" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarBancoCuenta" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Cuenta</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Tienda -->
<div class="modal fade" id="modalCambiarTienda" tabindex="-1" aria-labelledby="modalCambiarTiendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalCambiarTiendaLabel" style="font-weight: 700; color: #00d4ff;">
                    <i class="fa fa-store" style="margin-right: 8px;"></i>Cambiar Tienda
                </h5>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formCambiarTienda">
                    <div class="form-group mb-3">
                        <label for="CambiarTiendaSelect" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Seleccione la Tienda</label>
                        <select class="form-control" id="CambiarTiendaSelect" name="cod_tienda" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; height: auto !important; min-height: 45px !important; line-height: 1.5 !important; font-size: 1rem !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important;">
                            <option value="" style="background: #1a1d3a; color: white;">Cargando...</option>
                        </select>
                    </div>
                    <div class="alert" id="alertCambiarTienda" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarCambiarTienda" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarCambiarTienda" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Tienda -->
<div class="modal fade" id="modalRegistrarTienda" tabindex="-1" aria-labelledby="modalRegistrarTiendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalRegistrarTiendaLabel" style="font-weight: 700; color: #10b981;">
                    <i class="fa fa-plus-circle" style="margin-right: 8px;"></i>Registrar Nueva Tienda
                </h5>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <form id="formRegistrarTienda">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="registrarTiendaNombre" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Nombre de la Tienda *</label>
                            <input type="text" class="form-control" id="registrarTiendaNombre" name="nombre_tienda" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="registrarTiendaDireccion" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Dirección</label>
                            <input type="text" class="form-control" id="registrarTiendaDireccion" name="direccion_tienda" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="registrarTiendaTelefono" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Teléfono</label>
                            <input type="text" class="form-control" id="registrarTiendaTelefono" name="telefono_tienda" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem;">
                        </div>
                    </div>  

                    <div class="alert" id="alertRegistrarTienda" style="display: none; border-radius: 8px; padding: 0.75rem; margin-top: 1rem;"></div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarRegistrarTienda" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarRegistrarTienda" class="btn" style="background: linear-gradient(90deg, #10b981, #059669); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Registrar Tienda</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Observación -->
<div class="modal fade" id="modalEditarObservacion" tabindex="-1" aria-labelledby="modalEditarObservacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalEditarObservacionLabel" style="color: #00d4ff; font-weight: 700; margin: 0;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Editar Observación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="display: none;" id="alertEditarObservacion" class="alert" role="alert"></div>
                
                <input type="hidden" id="editarObservacionCodInfoFactura" value="">
                
                <div style="margin-bottom: 1rem;">
                    <label for="editarObservacionTexto" style="color: #cbd5e0; font-size: 0.9rem; margin-bottom: 0.5rem; display: block;">Observación</label>
                    <textarea class="form-control" id="editarObservacionTexto" rows="5" 
                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(102, 126, 234, 0.3); color: white; border-radius: 8px; padding: 0.75rem; resize: vertical; font-size: 1rem;"
                        placeholder="Escriba la observación..."></textarea>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarEditarObservacion" class="btn" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnGuardarEditarObservacion" class="btn" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
