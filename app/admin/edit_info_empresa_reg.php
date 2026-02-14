<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_info_empresa                            = intval($_POST['cod_info_empresa']);
$titulo                                      = addslashes($_POST['titulo']);
$nombre                                      = addslashes($_POST['nombre']);
$eslogan                                     = addslashes($_POST['eslogan']);
$res                                         = addslashes($_POST['res']);
$res1                                        = addslashes($_POST['res1']);
$res2                                        = addslashes($_POST['res2']);
$fecha_res                                   = addslashes($_POST['fecha_res']);
$pais                                        = addslashes($_POST['pais']);
$departamento                                = addslashes($_POST['departamento']);
$ciudad                                      = addslashes($_POST['ciudad']);
$localidad                                   = addslashes($_POST['localidad']);
$direccion                                   = addslashes($_POST['direccion']);
$correo                                      = addslashes($_POST['correo']);
$cabecera                                    = addslashes($_POST['cabecera']);
$img_cabecera                                = addslashes($_POST['img_cabecera']);
$telefono                                    = addslashes($_POST['telefono']);
$nit_empresa                                 = addslashes($_POST['nit_empresa']);
$regimen                                     = addslashes($_POST['regimen']);
$logotipo                                    = addslashes($_POST['logotipo']);
$icono                                       = '../imagenes/'.addslashes($_POST['icono']);
$nombre_font                                 = addslashes($_POST['nombre_font']);
$tamano_font_hc                              = intval($_POST['tamano_font_hc']);
$tamano_font_aptlab                          = intval($_POST['tamano_font_aptlab']);
$tamano_font_trabaltu                        = intval($_POST['tamano_font_trabaltu']);
$tamano_font_manaliment                      = intval($_POST['tamano_font_manaliment']);
$tamano_font_informe                         = intval($_POST['tamano_font_informe']);
$tamano_font_remision                        = intval($_POST['tamano_font_remision']);
$tamano_font_factura                         = intval($_POST['tamano_font_factura']);
$propietario_nombres_apellidos               = addslashes($_POST['propietario_nombres_apellidos']);
$propietario_nit                             = addslashes($_POST['propietario_nit']);
//$propietario_url_firma                       = addslashes($_POST['propietario_url_firma']);
$info_legal                                  = addslashes($_POST['info_legal']);
$reg_medico                                  = addslashes($_POST['reg_medico']);
$licencia                                    = addslashes($_POST['licencia']);
$smtp_correo_host                            = addslashes($_POST['smtp_correo_host']);
$smtp_correo_auth                            = addslashes($_POST['smtp_correo_auth']);
$smtp_correo_username                        = addslashes($_POST['smtp_correo_username']);
$smtp_correo_password                        = addslashes($_POST['smtp_correo_password']);
$smtp_correo_secure                          = addslashes($_POST['smtp_correo_secure']);
$smtp_correo_port                            = addslashes($_POST['smtp_correo_port']);
//$info_histclinic                                         = addslashes($_POST['info_histclinic']);
$info_aptlaboral                                           = addslashes($_POST['info_aptlaboral']);
$dia_ini_facturacion                                       = addslashes($_POST['dia_ini_facturacion']);
$dia_fin_facturacion                                      = addslashes($_POST['dia_fin_facturacion']);
$dia_fin_facturacion                                      = addslashes($_POST['dia_fin_facturacion']);
$pagina                                                    = addslashes($_POST['pagina']);
$numero_precio                                             = addslashes($_POST['numero_precio']);
$nombre_tipo_precio_venta                                  = addslashes($_POST['nombre_tipo_precio_venta']);
$nombre_concepto_multi_virtual                             = addslashes($_POST['nombre_concepto_multi_virtual']);
$ptj_servicio_propina                                      = addslashes($_POST['ptj_servicio_propina']);
$cod_servicio_propina                                      = addslashes($_POST['cod_servicio_propina']);
$nombre_servicio_propina                                   = addslashes($_POST['nombre_servicio_propina']);
$precio_servicio_propina                                   = addslashes($_POST['precio_servicio_propina']);
$ptj_bolsa                                                 = addslashes($_POST['ptj_bolsa']);
$cod_bolsa                                                 = addslashes($_POST['cod_bolsa']);
$nombre_bolsa                                              = addslashes($_POST['nombre_bolsa']);
$precio_bolsa                                              = addslashes($_POST['precio_bolsa']);
$nombre_tipo_empresa                                       = addslashes($_POST['nombre_tipo_empresa']);
//$dias_vencimiento_producto_alerta                          = intval($_POST['dias_vencimiento_producto_alerta']);
$url_encuesta_experiencia_compra                           = addslashes($_POST['url_encuesta_experiencia_compra']);
$nombre_operador_factura_electronica                       = addslashes($_POST['nombre_operador_factura_electronica']);
$nombre_tipo_impresora_zebra_ticket                        = addslashes($_POST['nombre_tipo_impresora_zebra_ticket']);
$nombre_empresa_sticker                                    = addslashes($_POST['nombre_empresa_sticker']);
$nombre_buscar_por                                         = addslashes($_POST['nombre_buscar_por']);
$correo_notificacion_alerta                                = addslashes($_POST['correo_notificacion_alerta']);
$nombre_tipo_cliente_defec_global                          = addslashes($_POST['nombre_tipo_cliente_defec_global']);
$nombre_tipo_regimen_defec_global                          = addslashes($_POST['nombre_tipo_regimen_defec_global']);
$nombre_tipo_impuesto_defec_global                         = addslashes($_POST['nombre_tipo_impuesto_defec_global']);
$nombre_concepto_egreso_defec_global                       = addslashes($_POST['nombre_concepto_egreso_defec_global']);
$nombre_cod_tercero_defec_global                           = addslashes($_POST['nombre_cod_tercero_defec_global']);
$nombre_cod_tipo_pago_defec_global                         = addslashes($_POST['nombre_cod_tipo_pago_defec_global']);
$nombre_cod_tipo_forma_pago_defec_global                   = addslashes($_POST['nombre_cod_tipo_forma_pago_defec_global']);
$nombre_cod_dependencia_defec_global                       = addslashes($_POST['nombre_cod_dependencia_defec_global']);
$nombre_nombre_tipo_factura_defec_global                   = addslashes($_POST['nombre_nombre_tipo_factura_defec_global']);
$leyenda1_defec_global                                     = addslashes($_POST['leyenda1_defec_global']);
$leyenda2_defec_global                                     = addslashes($_POST['leyenda2_defec_global']);
$leyenda3_defec_global                                     = addslashes($_POST['leyenda3_defec_global']);
$leyenda4_defec_global                                     = addslashes($_POST['leyenda4_defec_global']);
$leyenda5_defec_global                                     = addslashes($_POST['leyenda5_defec_global']);
$leyenda_envio_correo_defec_global                         = addslashes($_POST['leyenda_envio_correo_defec_global']);
$cod_estado_tipo_nominacion_moneda_cierre_caja_global      = intval($_POST['cod_estado_tipo_nominacion_moneda_cierre_caja_global']);
$nombre_pais_defec_global                                  = addslashes($_POST['nombre_pais_defec_global']);
$nombre_departamento_defec_global                          = addslashes($_POST['nombre_departamento_defec_global']);
$nombre_ciudad_defec_global                                = addslashes($_POST['nombre_ciudad_defec_global']);

if (isset($_POST['tamano_font_sticker_barra_pdf'])) { $tamano_font_sticker_barra_pdf = intval($_POST['tamano_font_sticker_barra_pdf']); } else { $tamano_font_sticker_barra_pdf = '0'; }
if (isset($_POST['ancho_sticker_barra_pdf'])) { $ancho_sticker_barra_pdf = intval($_POST['ancho_sticker_barra_pdf']); } else { $ancho_sticker_barra_pdf = '0'; }
if (isset($_POST['alto_sticker_barra_pdf'])) { $alto_sticker_barra_pdf = intval($_POST['alto_sticker_barra_pdf']); } else { $alto_sticker_barra_pdf = '0'; }
if (isset($_POST['columnas_sticker_barra_pdf'])) { $columnas_sticker_barra_pdf = intval($_POST['columnas_sticker_barra_pdf']); } else { $columnas_sticker_barra_pdf = '0'; }
if (isset($_POST['nombre_estandar_sticker_barra_pdf'])) { $nombre_estandar_sticker_barra_pdf = addslashes($_POST['nombre_estandar_sticker_barra_pdf']); } else { $nombre_estandar_sticker_barra_pdf = ''; }
if (isset($_POST['tipo_hoja_sticker_barra_pdf'])) { $tipo_hoja_sticker_barra_pdf = addslashes($_POST['tipo_hoja_sticker_barra_pdf']); } else { $tipo_hoja_sticker_barra_pdf = ''; }

$sql_data = sprintf("UPDATE tbl15_info_empresa SET titulo = '$titulo', nombre = '$nombre', eslogan = '$eslogan', res = '$res', res1 = '$res1', 
res2 = '$res2', fecha_res = '$fecha_res', pais = '$pais', departamento = '$departamento', ciudad = '$ciudad', localidad = '$localidad', direccion = '$direccion', 
correo = '$correo', cabecera = '$cabecera', img_cabecera = '$img_cabecera', telefono = '$telefono', nit_empresa = '$nit_empresa', 
logotipo = '$logotipo', icono = '$icono', nombre_font = '$nombre_font', tamano_font_hc = '$tamano_font_hc', tamano_font_aptlab = '$tamano_font_aptlab', 
tamano_font_trabaltu = '$tamano_font_trabaltu', tamano_font_manaliment = '$tamano_font_manaliment', tamano_font_informe = '$tamano_font_informe', 
tamano_font_remision = '$tamano_font_remision', tamano_font_factura = '$tamano_font_factura', 
propietario_nombres_apellidos = '$propietario_nombres_apellidos', propietario_nit = '$propietario_nit', 
info_legal = '$info_legal', reg_medico = '$reg_medico', licencia = '$licencia', 
regimen = '$regimen', smtp_correo_host = '$smtp_correo_host', smtp_correo_auth = '$smtp_correo_auth', smtp_correo_username = '$smtp_correo_username', 
smtp_correo_password = '$smtp_correo_password', smtp_correo_secure = '$smtp_correo_secure', smtp_correo_port = '$smtp_correo_port', 
info_aptlaboral = '$info_aptlaboral', dia_ini_facturacion = '$dia_ini_facturacion', dia_fin_facturacion = '$dia_fin_facturacion', 
numero_precio = '$numero_precio', nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_concepto_multi_virtual = '$nombre_concepto_multi_virtual', 
ptj_servicio_propina = '$ptj_servicio_propina', cod_servicio_propina = '$cod_servicio_propina', nombre_servicio_propina = '$nombre_servicio_propina', 
precio_servicio_propina = '$precio_servicio_propina', ptj_bolsa = '$ptj_bolsa', cod_bolsa = '$cod_bolsa', 
nombre_bolsa = '$nombre_bolsa', precio_bolsa = '$precio_bolsa', nombre_tipo_empresa = '$nombre_tipo_empresa', 
nombre_operador_factura_electronica = '$nombre_operador_factura_electronica',
nombre_tipo_impresora_zebra_ticket = '$nombre_tipo_impresora_zebra_ticket', 
tamano_font_sticker_barra_pdf = '$tamano_font_sticker_barra_pdf', ancho_sticker_barra_pdf = '$ancho_sticker_barra_pdf', alto_sticker_barra_pdf = '$alto_sticker_barra_pdf', 
columnas_sticker_barra_pdf = '$columnas_sticker_barra_pdf', nombre_estandar_sticker_barra_pdf = '$nombre_estandar_sticker_barra_pdf', tipo_hoja_sticker_barra_pdf = '$tipo_hoja_sticker_barra_pdf', 
nombre_buscar_por = '$nombre_buscar_por', correo_notificacion_alerta = '$correo_notificacion_alerta', 
nombre_pais_defec_global = '$nombre_pais_defec_global', nombre_departamento_defec_global = '$nombre_departamento_defec_global', 
nombre_ciudad_defec_global = '$nombre_ciudad_defec_global', nombre_tipo_cliente_defec_global = '$nombre_tipo_cliente_defec_global', 
nombre_tipo_regimen_defec_global = '$nombre_tipo_regimen_defec_global', nombre_tipo_impuesto_defec_global = '$nombre_tipo_impuesto_defec_global', 
nombre_concepto_egreso_defec_global = '$nombre_concepto_egreso_defec_global', nombre_cod_tercero_defec_global = '$nombre_cod_tercero_defec_global', 
nombre_ccosto_defec_global = '$nombre_ccosto_defec_global', nombre_cod_tipo_pago_defec_global = '$nombre_cod_tipo_pago_defec_global', 
nombre_cod_tipo_forma_pago_defec_global = '$nombre_cod_tipo_forma_pago_defec_global', nombre_cod_dependencia_defec_global = '$nombre_cod_dependencia_defec_global', 
nombre_nombre_tipo_factura_defec_global = '$nombre_nombre_tipo_factura_defec_global', leyenda1_defec_global = '$leyenda1_defec_global', 
leyenda2_defec_global = '$leyenda2_defec_global', leyenda3_defec_global = '$leyenda3_defec_global', 
leyenda4_defec_global = '$leyenda4_defec_global', leyenda5_defec_global = '$leyenda5_defec_global', 
leyenda_envio_correo_defec_global = '$leyenda_envio_correo_defec_global', 
cod_estado_tipo_nominacion_moneda_cierre_caja_global = '$cod_estado_tipo_nominacion_moneda_cierre_caja_global'
WHERE cod_info_empresa = '$cod_info_empresa'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>