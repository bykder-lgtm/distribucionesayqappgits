<?php
/**
 * ============================================
 * MÓDULO: Modales de Notificaciones y Alertas
 * ============================================
 * Este archivo contiene todos los modales relacionados
 * con notificaciones, alertas y mensajes del sistema.
 * 
 * Incluido desde: tabla_busqueda_paginacion_info_factura_venta_siscredito_visitante_intern_aliado_movil_ajax.php
 */
?>

<!-- Modal Notificación Alerta -->
<div class="modal fade" id="modalNotificacionAlerta" tabindex="-1" aria-labelledby="modalNotificacionAlertaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 92, 92, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalNotificacionAlertaLabel" style="color: #ff5c5c; font-weight: 700; margin: 0;">
                    <i class="fa fa-bell" style="margin-right: 8px;"></i>Confirmacion de Notificación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <input type="hidden" id="modalNotificacionCodInfoFactura" value="">
                <input type="hidden" id="modalNotificacionCodNotificacion" value="">
                
                <!-- Área de respuesta del servidor -->
                <div id="modalNotificacionRespuesta" style="display: none; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; text-align: center;">
                    <i id="modalNotificacionRespuestaIcon" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <p id="modalNotificacionRespuestaMsg" style="margin: 0; font-weight: 500;"></p>
                </div>
                
                <div id="modalNotificacionContenido" style="background: rgba(255, 92, 92, 0.1); border-left: 4px solid #ff5c5c; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <h6 id="modalNotificacionNombre" style="color: #ff8787; font-weight: 600; margin-bottom: 0.5rem;"></h6>
                    <p id="modalNotificacionDescripcion" style="color: #cbd5e0; font-size: 0.95rem; margin: 0;"></p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 92, 92, 0.3); padding: 1rem; gap: 0.5rem;">
                <button type="button" id="btnCancelarNotificacionAlerta" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cancelar</button>
                <button type="button" id="btnConfirmarNotificacionAlerta" class="btn" style="background: #ff5c5c; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Sí, Entendido</button>
                <button type="button" id="btnCerrarNotificacionAlerta" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="display: none; background: #28a745; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Imágenes Faltantes -->
<div class="modal fade" id="modalImagenesFaltantes" tabindex="-1" aria-labelledby="modalImagenesFaltantesLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalImagenesFaltantesLabel" style="color: #00d4ff; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>Imágenes Obligatorias Faltantes
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p style="margin: 0; color: #ff8787; font-size: 0.95rem; font-weight: 500;">
                        <i class="fa fa-info-circle" style="margin-right: 6px;"></i>
                        Faltan las siguientes imágenes obligatorias:
                    </p>
                </div>
                
                <div id="listaImagenesFaltantes" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(102, 126, 234, 0.2); border-radius: 8px; padding: 1rem;">
                    <!-- La lista se llenará dinámicamente -->
                </div>

                <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(0, 212, 255, 0.1); border-radius: 8px; border-left: 4px solid #00d4ff;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem;">
                        <i class="fa fa-camera" style="margin-right: 6px; color: #00d4ff;"></i>
                        Por favor, capture todas las imágenes marcadas con <span style="color: #ff5757; font-weight: 700;">(*)</span> antes de continuar.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; justify-content: center;">
                <button type="button" id="btnCerrarModalImagenes" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 2rem; font-weight: 600;">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmación Eliminar Foto -->
<div class="modal fade" id="modalConfirmarEliminarFoto" tabindex="-1" aria-labelledby="modalConfirmarEliminarFotoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalConfirmarEliminarFotoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-trash" style="margin-right: 8px;"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p style="margin: 0; color: #fff; font-size: 1rem; font-weight: 500; text-align: center;">
                        ¿Está seguro de que desea eliminar esta foto?
                    </p>
                </div>

                <div style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem; text-align: center;">
                        <i class="fa fa-info-circle" style="margin-right: 6px; color: #00d4ff;"></i>
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; gap: 0.5rem; justify-content: center;">
                <button type="button" id="btnCancelarEliminarFoto" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: #6c757d; color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">
                    <i class="fa fa-times" style="margin-right: 6px;"></i>Cancelar
                </button>
                <button type="button" id="btnConfirmarEliminarFoto" class="btn" style="background: linear-gradient(90deg, #ff5757, #ff3838); color: white; border-radius: 8px; padding: 0.6rem 1.5rem; font-weight: 600;">
                    <i class="fa fa-trash" style="margin-right: 6px;"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Datos Requeridos -->
<div class="modal fade" id="modalErrorDatosRequeridos" tabindex="-1" aria-labelledby="modalErrorDatosRequeridosLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(102, 126, 234, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorDatosRequeridosLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-circle" style="margin-right: 8px;"></i>Error de Validación
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="display: inline-block; width: 80px; height: 80px; background: rgba(255, 87, 87, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fa fa-times-circle" style="font-size: 2.5rem; color: #ff5757;"></i>
                    </div>
                </div>
                
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 4px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p id="mensajeErrorDatosRequeridos" style="margin: 0; color: #fff; font-size: 1rem; font-weight: 500; text-align: center;">
                        Faltan datos requeridos para procesar las imágenes.
                    </p>
                </div>

                <div style="padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px;">
                    <p style="margin: 0; color: #cbd5e0; font-size: 0.9rem; text-align: center;">
                        <i class="fa fa-info-circle" style="margin-right: 6px; color: #00d4ff;"></i>
                        Por favor, verifica que todos los campos necesarios estén completos.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(102, 126, 234, 0.3); padding: 1rem; justify-content: center;">
                <button type="button" id="btnCerrarModalError" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #667eea, #764ba2); color: white; border-radius: 8px; padding: 0.6rem 2rem; font-weight: 600;">
                    <i class="fa fa-check" style="margin-right: 6px;"></i>Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Navegador Sin Soporte de Cámara -->
<div class="modal fade" id="modalErrorNavegadorCamara" tabindex="-1" aria-labelledby="modalErrorNavegadorCamaraLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorNavegadorCamaraLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>Navegador No Compatible
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-chrome" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center;">
                    Su navegador no soporta acceso a la cámara.
                </p>
                <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; text-align: center; margin-bottom: 1.5rem;">
                    Por favor, use un navegador más reciente como:
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1.5rem; color: #e0e0e0;">
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-chrome" style="margin-right: 8px; color: #00d4ff;"></i>Google Chrome</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-firefox" style="margin-right: 8px; color: #00d4ff;"></i>Mozilla Firefox</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fa fa-edge" style="margin-right: 8px; color: #00d4ff;"></i>Microsoft Edge</li>
                        <li><i class="fa fa-safari" style="margin-right: 8px; color: #00d4ff;"></i>Safari</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Motivo Rechazo Vacío -->
<div class="modal fade" id="modalErrorMotivoRechazoVacio" tabindex="-1" aria-labelledby="modalErrorMotivoRechazoVacioLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 193, 7, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorMotivoRechazoVacioLabel" style="color: #ffc107; font-weight: 700; margin: 0;">
                    <i class="fa fa-edit" style="margin-right: 8px;"></i>Campo Requerido
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-pencil-square-o" style="font-size: 4rem; color: #ffc107; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Por favor, ingrese el motivo del rechazo.
                </p>
                <div style="background: rgba(255, 193, 7, 0.1); border-left: 3px solid #ffc107; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Es necesario especificar el motivo del rechazo antes de continuar.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 193, 7, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" id="btnCerrarMotivoRechazoVacio" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Éxito Solicitud Rechazada -->
<div class="modal fade" id="modalExitoSolicitudRechazada" tabindex="-1" aria-labelledby="modalExitoSolicitudRechazadaLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(76, 175, 80, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalExitoSolicitudRechazadaLabel" style="color: #4caf50; font-weight: 700; margin: 0;">
                    <i class="fa fa-check-circle" style="margin-right: 8px;"></i>Éxito
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-check-circle" style="font-size: 4rem; color: #4caf50; opacity: 0.9;"></i>
                </div>
                <p id="mensajeExitoRechazo" style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Solicitud rechazada correctamente.
                </p>
                <div style="background: rgba(76, 175, 80, 0.1); border-left: 3px solid #4caf50; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        La solicitud ha sido rechazada exitosamente y se actualizará la lista.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(76, 175, 80, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" id="btnCerrarExitoRechazo" style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error al Rechazar Solicitud -->
<div class="modal fade" id="modalErrorRechazarSolicitud" tabindex="-1" aria-labelledby="modalErrorRechazarSolicitudLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorRechazarSolicitudLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Error
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-exclamation-triangle" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p id="mensajeErrorRechazo" style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    No se pudo rechazar la solicitud.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        Por favor, verifique la información e intente nuevamente.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error de Conexión al Rechazar -->
<div class="modal fade" id="modalErrorConexionRechazo" tabindex="-1" aria-labelledby="modalErrorConexionRechazoLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1d3a 100%); color: white; border-radius: 15px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 87, 87, 0.3); padding: 1.5rem;">
                <h5 class="modal-title" id="modalErrorConexionRechazoLabel" style="color: #ff5757; font-weight: 700; margin: 0;">
                    <i class="fa fa-wifi" style="margin-right: 8px;"></i>Error de Conexión
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; cursor: pointer;">
                    <span style="font-size: 1.5rem; line-height: 1; font-weight: 700; color: #fff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <i class="fa fa-plug" style="font-size: 4rem; color: #ff5757; opacity: 0.9;"></i>
                </div>
                <p style="color: #e0e0e0; font-size: 1.1rem; line-height: 1.6; margin-bottom: 1rem; text-align: center; font-weight: 500;">
                    Error al procesar el rechazo.
                </p>
                <div style="background: rgba(255, 87, 87, 0.1); border-left: 3px solid #ff5757; padding: 1rem; border-radius: 8px;">
                    <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        <i class="fa fa-info-circle" style="margin-right: 8px; color: #00d4ff;"></i>
                        No se pudo conectar con el servidor. Por favor, verifique su conexión e intente nuevamente.
                    </p>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255, 87, 87, 0.3); padding: 1rem 1.5rem; background: rgba(0, 0, 0, 0.2);">
                <button type="button" class="btn" data-dismiss="modal" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// ============================================
// Handler para botón de notificación alerta
// ============================================
$(document).on('click', '#btn_notificacion_alerta, .btn_notificacion_alerta_estilo', function(e) {
    e.preventDefault();
    
    var codInfoFactura = $(this).data('cod_info_factura_venta');
    var codNotificacion = $(this).data('cod_notificacion_alerta_renovacion');
    var nombreNotificacion = $(this).data('nombre_notificacion');
    var descripcionNotificacion = $(this).data('descripcion_notificacion');
    
    // Resetear el modal a su estado inicial
    $('#modalNotificacionRespuesta').hide();
    $('#modalNotificacionContenido').show();
    $('#btnCancelarNotificacionAlerta').show();
    $('#btnConfirmarNotificacionAlerta').show().prop('disabled', false).html('Sí, Entendido');
    $('#btnCerrarNotificacionAlerta').hide();
    
    // Establecer valores en el modal
    $('#modalNotificacionCodInfoFactura').val(codInfoFactura);
    $('#modalNotificacionCodNotificacion').val(codNotificacion);
    $('#modalNotificacionNombre').text(nombreNotificacion);
    $('#modalNotificacionDescripcion').text(descripcionNotificacion);
    
    // Abrir el modal
    $('#modalNotificacionAlerta').modal('show');
});

// Handler para confirmar notificación leída
$(document).on('click', '#btnConfirmarNotificacionAlerta', function(e) {
    e.preventDefault();
    
    var $btn = $(this);
    var codInfoFactura = $('#modalNotificacionCodInfoFactura').val();
    var codNotificacion = $('#modalNotificacionCodNotificacion').val();
    
    // Deshabilitar botón mientras se procesa
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Procesando...');
    
    $.ajax({
        url: '../admin/marcar_notificacion_leida_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cod_info_factura_venta: codInfoFactura,
            cod_notificacion: codNotificacion,
            accion: 'marcar_notificacion_leida'
        },
        success: function(response) {
            // Ocultar contenido original
            $('#modalNotificacionContenido').hide();
            
            // Mostrar área de respuesta
            var $respuesta = $('#modalNotificacionRespuesta');
            var $icon = $('#modalNotificacionRespuestaIcon');
            var $msg = $('#modalNotificacionRespuestaMsg');
            
            if (response.success) {
                // Mostrar éxito
                $respuesta.css('background', 'rgba(40, 167, 69, 0.15)').show();
                $icon.removeClass().addClass('fa fa-check-circle').css('color', '#28a745');
                $msg.text(response.message || 'Notificación marcada como leída correctamente').css('color', '#28a745');
                
                // Ocultar botones originales y mostrar botón cerrar
                $('#btnCancelarNotificacionAlerta').hide();
                $btn.hide();
                $('#btnCerrarNotificacionAlerta').show();
                
                // Refrescar la lista después de 100ms
                setTimeout(function() {
                    $('#modalNotificacionAlerta').modal('hide');
                    if (typeof load === 'function') {
                        load(1);
                    } else {
                        location.reload();
                    }
                }, 100);
            } else {
                // Mostrar error
                $respuesta.css('background', 'rgba(220, 53, 69, 0.15)').show();
                $icon.removeClass().addClass('fa fa-times-circle').css('color', '#dc3545');
                $msg.text(response.message || 'Error al marcar la notificación como leída').css('color', '#dc3545');
                $btn.prop('disabled', false).html('Sí, Entendido');
            }
        },
        error: function(xhr, status, error) {
            // Ocultar contenido original
            $('#modalNotificacionContenido').hide();
            
            // Mostrar error de conexión
            var $respuesta = $('#modalNotificacionRespuesta');
            $respuesta.css('background', 'rgba(220, 53, 69, 0.15)').show();
            $('#modalNotificacionRespuestaIcon').removeClass().addClass('fa fa-exclamation-triangle').css('color', '#dc3545');
            $('#modalNotificacionRespuestaMsg').text('Error de conexión. Por favor intente nuevamente.').css('color', '#dc3545');
            $btn.prop('disabled', false).html('Sí, Entendido');
        }
    });
});

// Resetear modal al cerrarse
$('#modalNotificacionAlerta').on('hidden.bs.modal', function () {
    $('#modalNotificacionRespuesta').hide();
    $('#modalNotificacionContenido').show();
    $('#btnCancelarNotificacionAlerta').show();
    $('#btnConfirmarNotificacionAlerta').show().prop('disabled', false).html('Sí, Entendido');
    $('#btnCerrarNotificacionAlerta').hide();
});
</script>
