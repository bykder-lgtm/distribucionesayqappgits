<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_modulo_diseno_superior_libre.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_certificado_apoyo_emocional_codifcryp'])) {

    $cod_certificado_apoyo_emocional_codifcryp                         = ($_GET['cod_certificado_apoyo_emocional_codifcryp']);
    $cod_certificado_apoyo_emocional_codif                             = DAXCODIFCRYPTOR::descriptardax($cod_certificado_apoyo_emocional_codifcryp);
    $cod_certificado_apoyo_emocional                                   = intval(DAXCODIFCRYPTOR::descodifdax($cod_certificado_apoyo_emocional_codif));

    $sql_certificado_apoyo_emocional = "SELECT * FROM tbl15_certificado_apoyo_emocional WHERE (cod_certificado_apoyo_emocional = '$cod_certificado_apoyo_emocional')";
    $consulta_certificado_apoyo_emocional = mysqli_query($conectar, $sql_certificado_apoyo_emocional) or die(mysqli_error($conectar));
    $matriz_certificado_apoyo_emocional = mysqli_fetch_assoc($consulta_certificado_apoyo_emocional);

    $cod_certificado_apoyo_emocional                                             = $matriz_certificado_apoyo_emocional['cod_certificado_apoyo_emocional'];
    $nombre_certificado_apoyo_emocional                                          = $matriz_certificado_apoyo_emocional['nombre_certificado_apoyo_emocional'];
    $descripcion_certificado_apoyo_emocional                                     = $matriz_certificado_apoyo_emocional['descripcion_certificado_apoyo_emocional'];
    $estructura_todo_certificado_apoyo_emocional_esp                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_esp'];
    $estructura_todo_certificado_apoyo_emocional_eng                             = $matriz_certificado_apoyo_emocional['estructura_todo_certificado_apoyo_emocional_eng'];
    $estructura_titulo_certificado_apoyo_emocional_esp                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_esp'];
    $estructura_profesional_certificado_apoyo_emocional_esp                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_esp'];
    $estructura_propietario_diagnosti_certificado_apoyo_emocional_esp            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_esp'];
    $estructura_justificacion_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_esp'];
    $estructura_tabla_mascota_certificado_apoyo_emocional_esp                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_esp'];
    $estructura_vigencia_certificado_apoyo_emocional_esp                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_esp'];
    $estructura_titulo_certificado_apoyo_emocional_eng                           = $matriz_certificado_apoyo_emocional['estructura_titulo_certificado_apoyo_emocional_eng'];
    $estructura_profesional_certificado_apoyo_emocional_eng                      = $matriz_certificado_apoyo_emocional['estructura_profesional_certificado_apoyo_emocional_eng'];
    $estructura_propietario_diagnosti_certificado_apoyo_emocional_eng            = $matriz_certificado_apoyo_emocional['estructura_propietario_diagnosti_certificado_apoyo_emocional_eng'];
    $estructura_justificacion_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_justificacion_certificado_apoyo_emocional_eng'];
    $estructura_tabla_mascota_certificado_apoyo_emocional_eng                    = $matriz_certificado_apoyo_emocional['estructura_tabla_mascota_certificado_apoyo_emocional_eng'];
    $estructura_vigencia_certificado_apoyo_emocional_eng                         = $matriz_certificado_apoyo_emocional['estructura_vigencia_certificado_apoyo_emocional_eng'];
    $nombre_mascota                                                              = $matriz_certificado_apoyo_emocional['nombre_mascota'];
    $edad_mascota                                                                = $matriz_certificado_apoyo_emocional['edad_mascota'];
    $unidad_medida_edad_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_edad_mascota'];
    $nombre_raza_mascota                                                         = $matriz_certificado_apoyo_emocional['nombre_raza_mascota'];
    $color_mascota                                                               = $matriz_certificado_apoyo_emocional['color_mascota'];
    $peso_mascota                                                                = $matriz_certificado_apoyo_emocional['peso_mascota'];
    $unidad_medida_peso_mascota                                                  = $matriz_certificado_apoyo_emocional['unidad_medida_peso_mascota'];
    $talla_mascota                                                               = $matriz_certificado_apoyo_emocional['talla_mascota'];
    $nombre_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['nombre_propietario_mascota'];
    $documento_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['documento_propietario_mascota'];
    $direccion_propietario_mascota                                               = $matriz_certificado_apoyo_emocional['direccion_propietario_mascota'];
    $correo_propietario_mascota                                                  = $matriz_certificado_apoyo_emocional['correo_propietario_mascota'];
    $fecha_certificado_apoyo_emocional                                           = $matriz_certificado_apoyo_emocional['fecha_certificado_apoyo_emocional'];
    $hora_certificado_apoyo_emocional                                            = $matriz_certificado_apoyo_emocional['hora_certificado_apoyo_emocional'];
    $fecha_creacion_certificado_apoyo_emocional                                  = $matriz_certificado_apoyo_emocional['fecha_creacion_certificado_apoyo_emocional'];
    $fecha_modificacion_certificado_apoyo_emocional                              = $matriz_certificado_apoyo_emocional['fecha_modificacion_certificado_apoyo_emocional'];
    $cuenta                                                                      = $matriz_certificado_apoyo_emocional['cuenta'];
    $cod_administrador                                                           = $matriz_certificado_apoyo_emocional['cod_administrador'];
    $cod_estado                                                                  = $matriz_certificado_apoyo_emocional['cod_estado'];

    $enterbr                                      = '%0A';
    $negrita_abre                                 = "%0A*";
    $negrita_cierre                               = "*%0A";
    $info_pedido_producto_concat                  = "";
    $mensaje_whatsapp_formateado_confirm_compra   = '';
    $mensaje_whatsapp_formateado_acceso           = '';
    $mensaje_whatsapp_formateado_garantia         = '';

    $correo_correcion_soporte_tecnico             = '';
    $contrasena_correcion_soporte_tecnico         = '';
    $perfil_correcion_soporte_tecnico             = '';
    $pin_correcion_soporte_tecnico                = '';
    $cliente_correcion_soporte_tecnico            = '';
    $vence_correcion_soporte_tecnico              = '';
    $precio_correcion_soporte_tecnico             = '0';

    $mensaje_whatsapp_formateado_confirm_compra  .= '*👋 Confirmación de envio de información! 🐶😻*';
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Tipo de Solicitud*: Certificado de Apoyo Emocional';
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '🗓️ '.$fecha_certificado_apoyo_emocional.' ⏰ '.$hora_certificado_apoyo_emocional;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= 'Nombre'.'%3A '.trim($nombre_propietario_mascota).' - ID:'.$cod_certificado_apoyo_emocional;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Documento*: '.$documento_propietario_mascota;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Correo Electronico*: '.$correo_propietario_mascota;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Nombre de la Mascota*: '.$nombre_mascota;
    $mensaje_whatsapp_formateado_confirm_compra  .= $enterbr;
    $mensaje_whatsapp_formateado_confirm_compra  .= '*Raza de la Mascota*: '.$nombre_raza_mascota;

	$url_redir = "https://api.whatsapp.com/send?phone=57$telefono_emp&text=".$mensaje_whatsapp_formateado_confirm_compra;
	header("Location: $url_redir");
} 
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>