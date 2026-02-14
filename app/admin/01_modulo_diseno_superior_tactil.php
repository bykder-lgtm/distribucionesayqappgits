<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin_tactil.php");

$cuenta_actual                         = ($_SESSION['cuenta_actual']);
$nombres_des                           = ($_SESSION['nombres_cryp']);
$apellidos_des                         = ($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = ($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);
$cod_seguridad                         = ($_SESSION['cod_seguridad']);
$cod_caja_virtual                      = ($_SESSION['cod_caja_virtual']);
$token                                 = ($_SESSION['token']);
$cuenta                                = $cuenta_actual;
$vendedor_usuario                      = $cuenta_actual;
$vendedor                              = $cuenta_actual;
$usuario_cryp                          = $cuenta_actual;
$cs_cryp                               = $_SESSION['cs_cryp'];
$ca_cryp                               = $_SESSION['ca_cryp'];
$tokn_cryp                             = $_SESSION['token'];
$pag_redirec_sesion_cryp               = $_SESSION['pag_redirec_sesion_cryp'];
$estilo_css                            = $_SESSION['estilo_css'];
$tipo_usuario                          = $_SESSION['tipo_usuario'];
$tipo_menu                             = $_SESSION['tipo_menu'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$cod_seguridad                         = $_SESSION['cod_seguridad'];
$vendedor_codifcryp                    = $_SESSION['vendedor_codifcryp'];
$token                                 = $_SESSION['token'];
$inicio_sesion                         = $_SESSION['inicio_sesion'];
$tipo_menu                             = $_SESSION['tipo_menu'];
$pagina_salir_visitante                = $_SESSION['pagina_salir_visitante'];
$descripcion_producto                  = "";
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);
$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_administrador_des = DAXCRYPTOR::descriptardax($_SESSION['ca_cryp']);
$cod_administrador_codif = ($cod_administrador_des);
$frag2 = str_split($cod_administrador_codif);
$numero_de_digitos2 = $frag2[0];
if ($numero_de_digitos2 == 1) { $cod_administrador = $frag2[5]; } 
if ($numero_de_digitos2 == 2) { $cod_administrador = $frag2[5].$frag2[6]; } 
if ($numero_de_digitos2 == 3) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7]; } 
if ($numero_de_digitos2 == 4) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8]; } 
if ($numero_de_digitos2 == 5) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9]; } 
if ($numero_de_digitos2 == 6) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10]; } 
if ($numero_de_digitos2 == 7) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11]; }
if ($numero_de_digitos2 == 8) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11].$frag2[12]; }
if ($numero_de_digitos2 == 9) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11].$frag2[12].$frag2[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$tokn_des = DAXCRYPTOR::descriptardax($_SESSION['tokn_cryp']);
$cod_sesion_codif = ($tokn_des);
$frag3 = str_split($cod_sesion_codif);
$numero_de_digitos3 = $frag3[0];
if ($numero_de_digitos3 == 1) { $cod_sesion = $frag3[5]; } 
if ($numero_de_digitos3 == 2) { $cod_sesion = $frag3[5].$frag3[6]; } 
if ($numero_de_digitos3 == 3) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7]; } 
if ($numero_de_digitos3 == 4) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8]; } 
if ($numero_de_digitos3 == 5) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9]; } 
if ($numero_de_digitos3 == 6) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10]; } 
if ($numero_de_digitos3 == 7) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11]; }
if ($numero_de_digitos3 == 8) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11].$frag3[12]; }
if ($numero_de_digitos3 == 9) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11].$frag3[12].$frag3[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_tipo_historia_clinica_des = DAXCRYPTOR::descriptardax($_SESSION['cod_tipo_historia_clinica_cryp']);
$cod_tipo_historia_clinica_codif = ($cod_tipo_historia_clinica_des);
$frag4 = str_split($cod_tipo_historia_clinica_codif);
$numero_de_digitos4 = $frag4[0];
if ($numero_de_digitos4 == 1) { $cod_tipo_historia_clinica = $frag4[5]; } 
if ($numero_de_digitos4 == 2) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6]; } 
if ($numero_de_digitos4 == 3) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7]; } 
if ($numero_de_digitos4 == 4) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8]; } 
if ($numero_de_digitos4 == 5) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9]; } 
if ($numero_de_digitos4 == 6) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10]; } 
if ($numero_de_digitos4 == 7) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11]; }
if ($numero_de_digitos4 == 8) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11].$frag4[12]; }
if ($numero_de_digitos4 == 9) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11].$frag4[12].$frag4[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$pag_redirec_sesion = DAXCRYPTOR::descriptardax($_SESSION['pag_redirec_sesion_cryp']);
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                          = $info_empresa_data['anyo'];
$url_pag                                                           = $info_empresa_data['url_pag'];
$nombre_font                                                       = $info_empresa_data['nombre_font'];
$res_emp                                                           = $info_empresa_data['res'];
$res1_emp                                                          = $info_empresa_data['res1'];
$res2_emp                                                          = $info_empresa_data['res2'];
$departamento_emp                                                  = $info_empresa_data['departamento'];
$localidad_emp                                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                                       = $info_empresa_data['regimen'];
$version_emp                                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                                           = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                                           = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                                              = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                                              = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                                          = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                                          = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                                            = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                                              = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual                                     = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                          = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                                                     = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                                               = $info_empresa_data['nombre_tipo_empresa'];

$tamano_font_sticker_barra_pdf                                     = $info_empresa_data['tamano_font_sticker_barra_pdf'];
$ancho_sticker_barra_pdf                                           = $info_empresa_data['ancho_sticker_barra_pdf'];
$alto_sticker_barra_pdf                                            = $info_empresa_data['alto_sticker_barra_pdf'];
$columnas_sticker_barra_pdf                                        = $info_empresa_data['columnas_sticker_barra_pdf'];
$nombre_estandar_sticker_barra_pdf                                 = $info_empresa_data['nombre_estandar_sticker_barra_pdf'];
$tipo_hoja_sticker_barra_pdf                                       = $info_empresa_data['tipo_hoja_sticker_barra_pdf'];

$titulo                                                            = $info_empresa_data['titulo'];
$dir_oficiana1                                                     = $info_empresa_data['dir_oficiana1'];
$dir_oficiana2                                                     = $info_empresa_data['dir_oficiana2'];
$dir_oficiana3                                                     = $info_empresa_data['dir_oficiana3'];
$dir_oficiana4                                                     = $info_empresa_data['dir_oficiana4'];
$tel1                                                              = $info_empresa_data['tel1'];
$tel2                                                              = $info_empresa_data['tel2'];
$tel3                                                              = $info_empresa_data['tel3'];
$tel4                                                              = $info_empresa_data['tel4'];
$resena_info_empresa                                               = $info_empresa_data['resena_info_empresa'];
$mision_info_empresa                                               = $info_empresa_data['mision_info_empresa'];
$vision_info_empresa                                               = $info_empresa_data['vision_info_empresa'];
$declaracion_privacidad_info_empresa                               = $info_empresa_data['declaracion_privacidad_info_empresa'];
$politica_devolucion_info_empresa                                  = $info_empresa_data['politica_devolucion_info_empresa'];
$info_entrega_info_empresa                                         = $info_empresa_data['info_entrega_info_empresa'];
$keywords                                                          = $info_empresa_data['keywords'];
$description                                                       = $info_empresa_data['description'];
$author                                                            = $info_empresa_data['author'];
$longitud                                                          = $info_empresa_data['longitud'];
$latitud                                                           = $info_empresa_data['latitud'];
$url_mapa1                                                         = $info_empresa_data['url_mapa1'];
$url_mapa2                                                         = $info_empresa_data['url_mapa2'];
$cod_estado_reg_veterinaria                                        = $info_empresa_data['cod_estado_reg_veterinaria'];
$frag_icono                                                        = explode('../', $icono_emp);
$pos_icono                                                         = $frag_icono[1];

$dias_vencimiento_producto_alerta                                  = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global                               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global                             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra                                   = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global                     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global                             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global                              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
$cod_estado_inventario_bodega_global                               = $info_empresa_data['cod_estado_inventario_bodega_global'];
$cod_estado_sticker_barras_global                                  = $info_empresa_data['cod_estado_sticker_barras_global'];

$cod_estado_modulo_contabilidad_global                             = $info_empresa_data['cod_estado_modulo_contabilidad_global'];
$cod_estado_modulo_cotizacion_global                               = $info_empresa_data['cod_estado_modulo_cotizacion_global'];
$nombre_operador_factura_electronica                               = $info_empresa_data['nombre_operador_factura_electronica'];
$cod_estado_producto_consumo_global                                = $info_empresa_data['cod_estado_producto_consumo_global'];
$cod_estado_compra_caja_global                                     = $info_empresa_data['cod_estado_compra_caja_global'];
$nombre_tipo_impresora_zebra_ticket                                = $info_empresa_data['nombre_tipo_impresora_zebra_ticket'];
$cod_estado_cuenta_cobrar_global                                   = $info_empresa_data['cod_estado_cuenta_cobrar_global'];
$cod_estado_cuenta_pagar_global                                    = $info_empresa_data['cod_estado_cuenta_pagar_global'];
$cod_estado_egreso_global                                          = $info_empresa_data['cod_estado_egreso_global'];
$cod_estado_usuario_global                                         = $info_empresa_data['cod_estado_usuario_global'];
$cod_estado_dependencia_global                                     = $info_empresa_data['cod_estado_dependencia_global'];
$cod_estado_numero_letra_global                                    = $info_empresa_data['cod_estado_numero_letra_global'];
$cod_estado_resolucion_factura_global                              = $info_empresa_data['cod_estado_resolucion_factura_global'];
$cod_estado_cita_global                                            = $info_empresa_data['cod_estado_cita_global'];
$cod_estado_factura_compra_global                                  = $info_empresa_data['cod_estado_factura_compra_global'];

$cod_estado_modulo_producto_global                                 = $info_empresa_data['cod_estado_modulo_producto_global'];
$cod_estado_modulo_facturacion_global                              = $info_empresa_data['cod_estado_modulo_facturacion_global'];
$cod_estado_modulo_venta_global                                    = $info_empresa_data['cod_estado_modulo_venta_global'];
$cod_estado_modulo_tercero_global                                  = $info_empresa_data['cod_estado_modulo_tercero_global'];
$cod_estado_modulo_cuenta_global                                   = $info_empresa_data['cod_estado_modulo_cuenta_global'];
$cod_estado_modulo_reporte_global                                  = $info_empresa_data['cod_estado_modulo_reporte_global'];
$cod_estado_modulo_admin_global                                    = $info_empresa_data['cod_estado_modulo_admin_global'];
$cod_estado_pyg_global                                             = $info_empresa_data['cod_estado_pyg_global'];
$cod_estado_balance_global                                         = $info_empresa_data['cod_estado_balance_global'];
$cod_estado_mov_contable_global                                    = $info_empresa_data['cod_estado_mov_contable_global'];
$cod_estado_ganancia_ptj_global                                    = $info_empresa_data['cod_estado_ganancia_ptj_global'];
$cod_estado_modulo_orden_produccion_global                         = $info_empresa_data['cod_estado_modulo_orden_produccion_global'];
$cod_estado_comentario_venta_global                                = $info_empresa_data['cod_estado_comentario_venta_global'];
$cod_estado_envio_sms_global                                       = $info_empresa_data['cod_estado_envio_sms_global'];
$cod_estado_envio_correo_global                                    = $info_empresa_data['cod_estado_envio_correo_global'];
$cod_estado_ordenamiento_alfabetico_venta_global                   = $info_empresa_data['cod_estado_ordenamiento_alfabetico_venta_global'];

$cod_estado_nocodif_precio_compra_sticker_global                   = $info_empresa_data['cod_estado_nocodif_precio_compra_sticker_global'];
$cod_estado_nocodif_precio_venta_sticker_global                    = $info_empresa_data['cod_estado_nocodif_precio_venta_sticker_global'];
$cod_estado_nombre_empresa_sticker_global                          = $info_empresa_data['cod_estado_nombre_empresa_sticker_global'];
$cod_estado_fecha_compra_sticker_global                            = $info_empresa_data['cod_estado_fecha_compra_sticker_global'];
$cod_estado_cod_tercero_sticker_global                             = $info_empresa_data['cod_estado_cod_tercero_sticker_global'];
$cod_estado_url_pagina_sticker_global                              = $info_empresa_data['cod_estado_url_pagina_sticker_global'];
$cod_estado_nombre_desarrollador_sticker_global                    = $info_empresa_data['cod_estado_nombre_desarrollador_sticker_global'];
$cod_estado_qr_sticker_global                                      = $info_empresa_data['cod_estado_qr_sticker_global'];
$nombre_empresa_sticker                                            = $info_empresa_data['nombre_empresa_sticker'];
$buscar_por                                                        = $info_empresa_data['nombre_buscar_por'];

$cod_estado_img_producto_global                                    = $info_empresa_data['cod_estado_img_producto_global'];
$cod_estado_fecha_mantenimiento_global                             = $info_empresa_data['cod_estado_fecha_mantenimiento_global'];
$cod_estado_animal_global                                          = $info_empresa_data['cod_estado_animal_global'];
$cod_estado_producto_serial_global                                 = $info_empresa_data['cod_estado_producto_serial_global'];
$cod_estado_venta_prod_en_cero_global                              = $info_empresa_data['cod_estado_venta_prod_en_cero_global'];
$dias_prenes_parto                                                 = $info_empresa_data['dias_prenes_parto'];
$cod_estado_habilitar_tercero_por_usuario_global                   = $info_empresa_data['cod_estado_habilitar_tercero_por_usuario_global'];
$nombre_tipo_componente                                            = $info_empresa_data['nombre_tipo_componente'];
$cod_estado_subproducto_global                                     = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_nuevo_inventario_global                                = $info_empresa_data['cod_estado_nuevo_inventario_global'];
$cod_estado_auditoria_global                                       = $info_empresa_data['cod_estado_auditoria_global'];
$cod_estado_cierre_caja_global                                     = $info_empresa_data['cod_estado_cierre_caja_global'];
$cod_estado_observacion_tercero_venta_global                       = $info_empresa_data['cod_estado_observacion_tercero_venta_global'];

$cod_estado_alerta_fecha_nac_global                                = $info_empresa_data['cod_estado_alerta_fecha_nac_global'];
$cod_estado_categoria_global                                       = $info_empresa_data['cod_estado_categoria_global'];
$cod_estado_peso_producto_global                                   = $info_empresa_data['cod_estado_peso_producto_global'];
$cod_estado_estante_producto_global                                = $info_empresa_data['cod_estado_estante_producto_global'];
$dias_fecha_cumpleanos                                             = $info_empresa_data['dias_fecha_cumpleanos'];
$cod_estado_devolucion_btn_verde_global                            = $info_empresa_data['cod_estado_devolucion_btn_verde_global'];
$nombre_tipo_producto_predef                                       = $info_empresa_data['nombre_tipo_producto_predef'];
$cod_estado_plan_separe_global                                     = $info_empresa_data['cod_estado_plan_separe_global'];
$cod_estado_admin_global                                           = $info_empresa_data['cod_estado_admin_global'];
$cod_estado_prodcuto_mantenimiento_global                          = $info_empresa_data['cod_estado_prodcuto_mantenimiento_global'];
$cod_estado_eliminar_global                                        = $info_empresa_data['cod_estado_eliminar_global'];
$cod_estado_soporte_factura_compra_global                          = $info_empresa_data['cod_estado_soporte_factura_compra_global'];
$cod_estado_observacion_factura_compra_global                      = $info_empresa_data['cod_estado_observacion_factura_compra_global'];
$cod_estado_venta_precio_min_venta_global                          = $info_empresa_data['cod_estado_venta_precio_min_venta_global'];

$nombre_tipo_cobro_parqueo                                         = $info_empresa_data['nombre_tipo_cobro_parqueo'];
$costo_parqueo                                                     = $info_empresa_data['costo_parqueo'];
$nombre_tipo_cobro_hotel                                           = $info_empresa_data['nombre_tipo_cobro_hotel'];
$costo_hotel                                                       = $info_empresa_data['costo_hotel'];
$cod_estado_parqueo_hotel_global                                   = $info_empresa_data['cod_estado_parqueo_hotel_global'];
$cod_estado_hotel_global                                           = $info_empresa_data['cod_estado_hotel_global'];
$cod_estado_parqueo_global                                         = $info_empresa_data['cod_estado_parqueo_global'];

$cod_estado_plan_accion_correcion_global                           = $info_empresa_data['cod_estado_plan_accion_correcion_global'];

$cod_estado_modal_tercero_nombre_tipo_tercero_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_identificacion_global        = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_identificacion_global'];
$cod_estado_modal_tercero_nombre_sino_global                       = $info_empresa_data['cod_estado_modal_tercero_nombre_sino_global'];
$cod_estado_modal_tercero_identificacion_tercero_global            = $info_empresa_data['cod_estado_modal_tercero_identificacion_tercero_global'];
$cod_estado_modal_tercero_digito_tercero_global                    = $info_empresa_data['cod_estado_modal_tercero_digito_tercero_global'];
$cod_estado_modal_tercero_nombre1_tercero_global                   = $info_empresa_data['cod_estado_modal_tercero_nombre1_tercero_global'];
$cod_estado_modal_tercero_nombre2_tercero_global                   = $info_empresa_data['cod_estado_modal_tercero_nombre2_tercero_global'];
$cod_estado_modal_tercero_apellido1_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_apellido1_tercero_global'];
$cod_estado_modal_tercero_apellido2_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_apellido2_tercero_global'];
$cod_estado_modal_tercero_fecha_nac_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_fecha_nac_tercero_global'];
$cod_estado_modal_tercero_nombre_tipo_cliente_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_cliente_global'];
$cod_estado_modal_tercero_nombre_tipo_regimen_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_regimen_global'];
$cod_estado_modal_tercero_nombre_tipo_impuesto_global              = $info_empresa_data['cod_estado_modal_tercero_nombre_tipo_impuesto_global'];
$cod_estado_modal_tercero_nombre_pais_global                       = $info_empresa_data['cod_estado_modal_tercero_nombre_pais_global'];
$cod_estado_modal_tercero_nombre_departamento_global               = $info_empresa_data['cod_estado_modal_tercero_nombre_departamento_global'];
$cod_estado_modal_tercero_nombre_ciudad_global                     = $info_empresa_data['cod_estado_modal_tercero_nombre_ciudad_global'];
$cod_estado_modal_tercero_direccion_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_direccion_tercero_global'];
$cod_estado_modal_tercero_telefono1_tercero_global                 = $info_empresa_data['cod_estado_modal_tercero_telefono1_tercero_global'];
$cod_estado_modal_tercero_correo_tercero_global                    = $info_empresa_data['cod_estado_modal_tercero_correo_tercero_global'];
$cod_estado_modal_tercero_fax_tercero_global                       = $info_empresa_data['cod_estado_modal_tercero_fax_tercero_global'];
$cod_estado_cocina_global                                          = $info_empresa_data['cod_estado_cocina_global'];

$cod_estado_cajas_sobre_global                                     = $info_empresa_data['cod_estado_cajas_sobre_global'];
$cod_estado_und_sobre_global                                       = $info_empresa_data['cod_estado_und_sobre_global'];

$cod_estado_meses_garantia_global                                  = $info_empresa_data['cod_estado_meses_garantia_global'];
$cod_estado_marca_global                                           = $info_empresa_data['cod_estado_marca_global'];
$cod_estado_proveedor_global                                       = $info_empresa_data['cod_estado_proveedor_global'];
$cod_estado_archivo_adjunto_global                                 = $info_empresa_data['cod_estado_archivo_adjunto_global'];
$cod_estado_precio_compra_mod_venta_global                         = $info_empresa_data['cod_estado_precio_compra_mod_venta_global'];

$cod_estado_timbre_entrada_pedido_temporal_cocina_global           = $info_empresa_data['cod_estado_timbre_entrada_pedido_temporal_cocina_global'];
$cod_estado_timbre_salida_pedido_temporal_cocina_global            = $info_empresa_data['cod_estado_timbre_salida_pedido_temporal_cocina_global'];
$cod_estado_subproducto_mostrar_imprimir_global                    = $info_empresa_data['cod_estado_subproducto_mostrar_imprimir_global'];

$cod_estado_diferencia_ganancia_inventario_global                  = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_global'];
$cod_estado_diferencia_ganancia_inventario_ptj_promedio_global     = $info_empresa_data['cod_estado_diferencia_ganancia_inventario_ptj_promedio_global'];
$cod_estado_opcion_descontable_inv_global                          = $info_empresa_data['cod_estado_opcion_descontable_inv_global'];
$cod_estado_hora_reporte_venta_global                              = $info_empresa_data['cod_estado_hora_reporte_venta_global'];


$cod_estado_descuento_automatico_por_cambio_precio_venta_global    = $info_empresa_data['cod_estado_descuento_automatico_por_cambio_precio_venta_global'];
$cod_estado_btn_categoria_desplegable_global                       = $info_empresa_data['cod_estado_btn_categoria_desplegable_global'];

$cod_estado_consultar_precios_extern_global                        = $info_empresa_data['cod_estado_consultar_precios_extern_global'];
$cod_estado_marcado_revisado_caja_mesa_venta_temporal_global       = $info_empresa_data['cod_estado_marcado_revisado_caja_mesa_venta_temporal_global'];
$cod_estado_nombre_producto_editable_factura_compra_global         = $info_empresa_data['cod_estado_nombre_producto_editable_factura_compra_global'];
$cod_estado_tipo_compra_global                                     = $info_empresa_data['cod_estado_tipo_compra_global'];

$nombre_campo_undidades_inv1                                       = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_estado_nota_observacion_global                                = $info_empresa_data['cod_estado_nota_observacion_global'];
$cod_estado_grafico_estadistico_global                             = $info_empresa_data['cod_estado_grafico_estadistico_global'];
$cod_estado_inventario_bodega2_global                              = $info_empresa_data['cod_estado_inventario_bodega2_global'];
$cod_estado_tipo_roles_global                                      = $info_empresa_data['cod_estado_tipo_roles_global'];

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];

$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_estado_lote_compra_global                                     = $info_empresa_data['cod_estado_lote_compra_global'];
$cod_estado_tipo_metodo_envio_global                               = $info_empresa_data['cod_estado_tipo_metodo_envio_global'];
$cod_estado_mod_domicilio_y_estado_habilitado_producto_global      = $info_empresa_data['cod_estado_mod_domicilio_y_estado_habilitado_producto_global'];
$cod_estado_promocion_global                                       = $info_empresa_data['cod_estado_promocion_global'];

$cod_estado_notificacion_alerta_correo_global                      = $info_empresa_data['cod_estado_notificacion_alerta_correo_global'];
$cod_estado_notificacion_alerta_correo_copia_seguridad_global      = $info_empresa_data['cod_estado_notificacion_alerta_correo_copia_seguridad_global'];
$cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_cumpleanos_tercero_global'];
$cod_estado_notificacion_alerta_correo_productos_a_vencer_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_a_vencer_global'];
$cod_estado_notificacion_alerta_correo_productos_agotados_global   = $info_empresa_data['cod_estado_notificacion_alerta_correo_productos_agotados_global'];
$cod_estado_notificacion_alerta_correo_venta_diaria_global         = $info_empresa_data['cod_estado_notificacion_alerta_correo_venta_diaria_global'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];

if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }

$cod_estado_venta_dependencia_de_usuario_global                    = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
$nombre_carpeta_pagina                                             = $info_empresa_data['nombre_carpeta_pagina'];
//include_once('../admin/01_modulo_permisos.php');
?>
<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />