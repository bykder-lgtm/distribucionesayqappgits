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
<?php //$pagina = addslashes($_GET['pagina']); ?>
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
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, strip_tags($_POST['cuenta'])); } else { $cuenta = ''; }

$sql_info_empresa = "SELECT nombre_tipo_precio_venta, numero_precio FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_info_empresa = mysqli_query($conectar, $sql_info_empresa) or die(mysqli_error($conectar));
$info_info_empresa = mysqli_fetch_assoc($consultar_info_empresa);

$nombre_tipo_precio_venta_predet_user                 = $info_info_empresa['nombre_tipo_precio_venta'];
$numero_precio_user                                   = $info_info_empresa['numero_precio'];

$obtener_entidad = "SELECT cuenta FROM tbl15_administrador WHERE cuenta = '".($cuenta)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

if(mysqli_num_rows(@$consultar_entidad) > 0) 	{
	echo '<img src="../imagenes/advertencia.gif"><h4>EL USUARIO '. $cuenta.' YA ESTA REGISTRADO</h4></div>';
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="5; <?php echo $pagina_else ?>">
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
} else {

	if (isset($_POST['cedula']) <> '') { $cedula = mysqli_real_escape_string($conectar, ($_POST['cedula'])); } else { $cedula = ''; }
	if (isset($_POST['nombres']) <> '') { $nombres = mysqli_real_escape_string($conectar, ($_POST['nombres'])); } else { $nombres = ''; }
	if (isset($_POST['apellidos']) <> '') { $apellidos = mysqli_real_escape_string($conectar, ($_POST['apellidos'])); } else { $apellidos = ''; }
	if (isset($_POST['cod_seguridad']) <> '') { $cod_seguridad = mysqli_real_escape_string($conectar, ($_POST['cod_seguridad'])); } else { $cod_seguridad = ''; }
	if (isset($_POST['cod_tipo_historia_clinica']) <> '') { $cod_tipo_historia_clinica = mysqli_real_escape_string($conectar, ($_POST['cod_tipo_historia_clinica'])); } else { $cod_tipo_historia_clinica = ''; }
	if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar, ($_POST['nombre_sexo'])); } else { $nombre_sexo = ''; }
	if (isset($_POST['contrasena1']) <> '') { $contrasena1 = mysqli_real_escape_string($conectar, ($_POST['contrasena1'])); } else { $contrasena1 = ''; }
	if (isset($_POST['contrasena2']) <> '') { $contrasena2 = mysqli_real_escape_string($conectar, ($_POST['contrasena2'])); } else { $contrasena2 = ''; }
	if (isset($_POST['contrasena']) <> '') { $contrasena = mysqli_real_escape_string($conectar, ($_POST['contrasena'])); } else { $contrasena = ''; }
	if (isset($_POST['correo']) <> '') { $correo = mysqli_real_escape_string($conectar, ($_POST['correo'])); } else { $correo = ''; }
	if (isset($_POST['telefono']) <> '') { $telefono = mysqli_real_escape_string($conectar, ($_POST['telefono'])); } else { $telefono = ''; }
	if (isset($_POST['estilo_css']) <> '') { $estilo_css = mysqli_real_escape_string($conectar, ($_POST['estilo_css'])); } else { $estilo_css = ''; }
	if (isset($_POST['reg_medico']) <> '') { $reg_medico = mysqli_real_escape_string($conectar, ($_POST['reg_medico'])); } else { $reg_medico = ''; }
	if (isset($_POST['fecha_hora']) <> '') { $fecha_hora = mysqli_real_escape_string($conectar, ($_POST['fecha_hora'])); } else { $fecha_hora = ''; }
	if (isset($_POST['fecha']) <> '') { $fecha = mysqli_real_escape_string($conectar, ($_POST['fecha'])); } else { $fecha = ''; }
	if (isset($_POST['cuenta']) <> '') { $cuenta = mysqli_real_escape_string($conectar, ($_POST['cuenta'])); } else { $cuenta = ''; }

	if (isset($_POST['cod_tienda']) <> '') { $cod_tienda = intval($_POST['cod_tienda']); } else { $cod_tienda = ''; }
	if (isset($_POST['total_base_cierre_caja']) <> '') { $total_base_cierre_caja = mysqli_real_escape_string($conectar, ($_POST['total_base_cierre_caja'])); } else { $total_base_cierre_caja = ''; }
	if (isset($_POST['num_max_caja_mesa_usuario']) <> '') { $num_max_caja_mesa_usuario = mysqli_real_escape_string($conectar, ($_POST['num_max_caja_mesa_usuario'])); } else { $num_max_caja_mesa_usuario = ''; }
	if (isset($_POST['limite_max_venta_temp_por_caja_mesa_usuario']) <> '') { $limite_max_venta_temp_por_caja_mesa_usuario = mysqli_real_escape_string($conectar, ($_POST['limite_max_venta_temp_por_caja_mesa_usuario'])); } else { $limite_max_venta_temp_por_caja_mesa_usuario = ''; }
	if (isset($_POST['total_saldo_recarga']) <> '') { $total_saldo_recarga = mysqli_real_escape_string($conectar, ($_POST['total_saldo_recarga'])); } else { $total_saldo_recarga = ''; }
	if (isset($_POST['url_pag_redirec_ini_sesion']) <> '') { $url_pag_redirec_ini_sesion = mysqli_real_escape_string($conectar, ($_POST['url_pag_redirec_ini_sesion'])); } else { $url_pag_redirec_ini_sesion = ''; }

	$creador = $cuenta_actual;
	$identificacion_tercero = $cedula;
	$nombre1_tercero = $nombres;
	$apellido1_tercero = $apellidos;
	$telefono1_tercero = $telefono;
	$correo_tercero = $correo;

	$sql_datos_permiso_usuario = "SELECT * FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad'";
	$consulta_datos_permiso_usuario = mysqli_query($conectar, $sql_datos_permiso_usuario) or die(mysqli_error($conectar));
	$matriz_datos_permiso_usuario = mysqli_fetch_assoc($consulta_datos_permiso_usuario);

	$cod_estado_prod                                                     = $matriz_datos_permiso_usuario['cod_estado_prod'];
	$cod_estado_prod_reg_producto                                        = $matriz_datos_permiso_usuario['cod_estado_prod_reg_producto'];
	$cod_estado_prod_asig_subproducto                                    = $matriz_datos_permiso_usuario['cod_estado_prod_asig_subproducto'];
	$cod_estado_prod_cargar_factura_compra                               = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra'];
	$cod_estado_prod_cargar_factura_compra_soporte                       = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra_soporte'];
	$cod_estado_prod_cargar_factura_compra_observacion                   = $matriz_datos_permiso_usuario['cod_estado_prod_cargar_factura_compra_observacion'];
	$cod_estado_prod_transferencia                                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia'];
	$cod_estado_prod_auditoria                                           = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria'];
	$cod_estado_prod_nuevo_invenario                                     = $matriz_datos_permiso_usuario['cod_estado_prod_nuevo_invenario'];
	$cod_estado_prod_inventario_producto                                 = $matriz_datos_permiso_usuario['cod_estado_prod_inventario_producto'];
	$cod_estado_prod_registrar                                           = $matriz_datos_permiso_usuario['cod_estado_prod_registrar'];
	$cod_estado_prod_editar                                              = $matriz_datos_permiso_usuario['cod_estado_prod_editar'];
	$cod_estado_prod_eliminar                                            = $matriz_datos_permiso_usuario['cod_estado_prod_eliminar'];
	$cod_estado_prod_imprimir                                            = $matriz_datos_permiso_usuario['cod_estado_prod_imprimir'];
	$cod_estado_prod_exportar                                            = $matriz_datos_permiso_usuario['cod_estado_prod_exportar'];

	$cod_estado_prod_subproducto                                         = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto'];
	$cod_estado_prod_und_producto                                        = $matriz_datos_permiso_usuario['cod_estado_prod_und_producto'];
	$cod_estado_prod_und_producto_bodega                                 = $matriz_datos_permiso_usuario['cod_estado_prod_und_producto_bodega'];
	$cod_estado_prod_precio_compra_producto                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_compra_producto'];
	$cod_estado_prod_precio_costo_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_precio_costo_producto'];
	$cod_estado_prod_precio_venta_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto'];
	$cod_estado_prod_precio_venta_producto2                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto2'];
	$cod_estado_prod_precio_venta_producto3                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto3'];
	$cod_estado_prod_precio_venta_producto4                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto4'];
	$cod_estado_prod_precio_venta_producto5                              = $matriz_datos_permiso_usuario['cod_estado_prod_precio_venta_producto5'];
	$cod_estado_prod_nombre_tipo_unidad_medida                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_unidad_medida'];
	$cod_estado_prod_iva_ptj                                             = $matriz_datos_permiso_usuario['cod_estado_prod_iva_ptj'];
	$cod_estado_prod_nombre_tipo_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_producto'];
	$cod_estado_prod_cod_marca                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_marca'];
	$cod_estado_prod_cod_proveedor                                       = $matriz_datos_permiso_usuario['cod_estado_prod_cod_proveedor'];
	$cod_estado_prod_cod_tercero                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cod_tercero'];
	$cod_estado_prod_cod_estado                                          = $matriz_datos_permiso_usuario['cod_estado_prod_cod_estado'];
	$cod_estado_prod_cod_dependencia                                     = $matriz_datos_permiso_usuario['cod_estado_prod_cod_dependencia'];
	$cod_estado_prod_fecha_ult_compra                                    = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_ult_compra'];
	$cod_estado_prod_fecha_ult_venta                                     = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_ult_venta'];
	$cod_estado_prod_fecha_vencimiento                                   = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_vencimiento'];
	$cod_estado_prod_tope_min                                            = $matriz_datos_permiso_usuario['cod_estado_prod_tope_min'];
	$cod_estado_prod_fecha_creacion                                      = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_creacion'];
	$cod_estado_prod_fecha_modificacion                                  = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_modificacion'];
	$cod_estado_prod_nombre_tipo_precio_venta                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_precio_venta'];
	$cod_estado_prod_url_img_orig_producto                               = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_orig_producto'];
	$cod_estado_prod_url_img_min_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_min_producto'];
	$cod_estado_prod_comision_ptj                                        = $matriz_datos_permiso_usuario['cod_estado_prod_comision_ptj'];
	$cod_estado_prod_dto1                                                = $matriz_datos_permiso_usuario['cod_estado_prod_dto1'];
	$cod_estado_prod_dto2                                                = $matriz_datos_permiso_usuario['cod_estado_prod_dto2'];
	$cod_estado_prod_ipc_ptj                                             = $matriz_datos_permiso_usuario['cod_estado_prod_ipc_ptj'];
	$cod_estado_prod_precio_ipc                                          = $matriz_datos_permiso_usuario['cod_estado_prod_precio_ipc'];
	$cod_estado_prod_ret_ica_ptj                                         = $matriz_datos_permiso_usuario['cod_estado_prod_ret_ica_ptj'];
	$cod_estado_prod_iva_teorico_ptj                                     = $matriz_datos_permiso_usuario['cod_estado_prod_iva_teorico_ptj'];
	$cod_estado_prod_tarifa_rete_vigente_ptj                             = $matriz_datos_permiso_usuario['cod_estado_prod_tarifa_rete_vigente_ptj'];
	$cod_estado_prod_rete_iva_asumido_ptj                                = $matriz_datos_permiso_usuario['cod_estado_prod_rete_iva_asumido_ptj'];
	$cod_estado_prod_nombre_tipo_compra                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_compra'];
	$cod_estado_prod_nombre_tipo_cargue_factura                          = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_cargue_factura'];
	$cod_estado_prod_nombre_tipo_medida                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_medida'];
	$cod_estado_prod_cajas_sobre                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cajas_sobre'];
	$cod_estado_prod_und_sobre                                           = $matriz_datos_permiso_usuario['cod_estado_prod_und_sobre'];
	$cod_estado_prod_cod_interno                                         = $matriz_datos_permiso_usuario['cod_estado_prod_cod_interno'];
	$cod_estado_prod_cod_original                                        = $matriz_datos_permiso_usuario['cod_estado_prod_cod_original'];
	$cod_estado_prod_codificacion                                        = $matriz_datos_permiso_usuario['cod_estado_prod_codificacion'];
	$cod_estado_prod_cod_producto_serial                                 = $matriz_datos_permiso_usuario['cod_estado_prod_cod_producto_serial'];
	$cod_estado_prod_fecha_mantenimiento                                 = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_mantenimiento'];
	$cod_estado_prod_peso_producto                                       = $matriz_datos_permiso_usuario['cod_estado_prod_peso_producto'];

	$cod_estado_plan_separe                                              = $matriz_datos_permiso_usuario['cod_estado_plan_separe'];
	$cod_estado_plan_separe_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_plan_separe_registrar'];
	$cod_estado_plan_separe_editar                                       = $matriz_datos_permiso_usuario['cod_estado_plan_separe_editar'];
	$cod_estado_plan_separe_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_eliminar'];
	$cod_estado_plan_separe_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_imprimir'];
	$cod_estado_plan_separe_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_plan_separe_exportar'];

	$cod_estado_contabilidad                                             = $matriz_datos_permiso_usuario['cod_estado_contabilidad'];
	$cod_estado_contabilidad_mov_contable                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable'];
	$cod_estado_contabilidad_mov_contable_registrar                      = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_registrar'];
	$cod_estado_contabilidad_mov_contable_editar                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_editar'];
	$cod_estado_contabilidad_mov_contable_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_eliminar'];
	$cod_estado_contabilidad_mov_contable_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_imprimir'];
	$cod_estado_contabilidad_mov_contable_exportar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_mov_contable_exportar'];

	$cod_estado_contabilidad_pyg                                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg'];
	$cod_estado_contabilidad_pyg_registrar                               = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_registrar'];
	$cod_estado_contabilidad_pyg_editar                                  = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_editar'];
	$cod_estado_contabilidad_pyg_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_eliminar'];
	$cod_estado_contabilidad_pyg_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_imprimir'];
	$cod_estado_contabilidad_pyg_exportar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_pyg_exportar'];

	$cod_estado_contabilidad_balance                                     = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance'];
	$cod_estado_contabilidad_balance_pyg_registrar                       = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_registrar'];
	$cod_estado_contabilidad_balance_pyg_editar                          = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_editar'];
	$cod_estado_contabilidad_balance_pyg_eliminar                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_eliminar'];
	$cod_estado_contabilidad_balance_pyg_imprimir                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_imprimir'];
	$cod_estado_contabilidad_balance_pyg_exportar                        = $matriz_datos_permiso_usuario['cod_estado_contabilidad_balance_pyg_exportar'];

	$cod_estado_contabilidad_puc                                         = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc'];
	$cod_estado_contabilidad_puc_registrar                               = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_registrar'];
	$cod_estado_contabilidad_puc_editar                                  = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_editar'];
	$cod_estado_contabilidad_puc_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_eliminar'];
	$cod_estado_contabilidad_puc_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_imprimir'];
	$cod_estado_contabilidad_puc_exportar                                = $matriz_datos_permiso_usuario['cod_estado_contabilidad_puc_exportar'];

	$cod_estado_facturacion                                              = $matriz_datos_permiso_usuario['cod_estado_facturacion'];
	$cod_estado_facturacion_venta                                        = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta'];
	$cod_estado_facturacion_venta_registrar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_registrar'];
	$cod_estado_facturacion_venta_editar                                 = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_editar'];
	$cod_estado_facturacion_venta_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_eliminar'];
	$cod_estado_facturacion_venta_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_imprimir'];
	$cod_estado_facturacion_venta_exportar                               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_exportar'];
	$cod_estado_facturacion_venta_devol                                  = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_devol'];

	$cod_estado_facturacion_compra                                       = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra'];
	$cod_estado_facturacion_compra_registrar                             = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_registrar'];
	$cod_estado_facturacion_compra_editar                                = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_editar'];
	$cod_estado_facturacion_compra_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_eliminar'];
	$cod_estado_facturacion_compra_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_imprimir'];
	$cod_estado_facturacion_compra_exportar                              = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_exportar'];
	$cod_estado_facturacion_compra_devol                                 = $matriz_datos_permiso_usuario['cod_estado_facturacion_compra_devol'];

	$cod_estado_facturacion_devol_venta                                  = $matriz_datos_permiso_usuario['cod_estado_facturacion_devol_venta'];
	$cod_estado_facturacion_devol_inventario                             = $matriz_datos_permiso_usuario['cod_estado_facturacion_devol_inventario'];

	$cod_estado_cotizacion                                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion'];
	$cod_estado_cotizacion_venta                                         = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta'];
	$cod_estado_cotizacion_venta_registrar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_registrar'];
	$cod_estado_cotizacion_venta_editar                                  = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_editar'];
	$cod_estado_cotizacion_venta_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_eliminar'];
	$cod_estado_cotizacion_venta_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_imprimir'];
	$cod_estado_cotizacion_venta_exportar                                = $matriz_datos_permiso_usuario['cod_estado_cotizacion_venta_exportar'];

	$cod_estado_cotizacion_compra                                        = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra'];
	$cod_estado_cotizacion_compra_registrar                              = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_registrar'];
	$cod_estado_cotizacion_compra_editar                                 = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_editar'];
	$cod_estado_cotizacion_compra_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_eliminar'];
	$cod_estado_cotizacion_compra_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_imprimir'];
	$cod_estado_cotizacion_compra_exportar                               = $matriz_datos_permiso_usuario['cod_estado_cotizacion_compra_exportar'];

	$cod_estado_venta                                                    = $matriz_datos_permiso_usuario['cod_estado_venta'];
	$cod_estado_venta_manual                                             = $matriz_datos_permiso_usuario['cod_estado_venta_manual'];
	$cod_estado_venta_barras                                             = $matriz_datos_permiso_usuario['cod_estado_venta_barras'];
	$cod_estado_venta_fecha_venta                                        = $matriz_datos_permiso_usuario['cod_estado_venta_fecha_venta'];
	$cod_estado_venta_preventa                                           = $matriz_datos_permiso_usuario['cod_estado_venta_preventa'];
	$cod_estado_venta_propina                                            = $matriz_datos_permiso_usuario['cod_estado_venta_propina'];
	$cod_estado_venta_bolsa                                              = $matriz_datos_permiso_usuario['cod_estado_venta_bolsa'];
	$cod_estado_venta_observacion                                        = $matriz_datos_permiso_usuario['cod_estado_venta_observacion'];

	$cod_estado_tercero                                                  = $matriz_datos_permiso_usuario['cod_estado_tercero'];
	$cod_estado_tercero_registrar                                        = $matriz_datos_permiso_usuario['cod_estado_tercero_registrar'];
	$cod_estado_tercero_editar                                           = $matriz_datos_permiso_usuario['cod_estado_tercero_editar'];
	$cod_estado_tercero_eliminar                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_eliminar'];
	$cod_estado_tercero_imprimir                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_imprimir'];
	$cod_estado_tercero_exportar                                         = $matriz_datos_permiso_usuario['cod_estado_tercero_exportar'];

	$cod_estado_cita                                                     = $matriz_datos_permiso_usuario['cod_estado_cita'];
	$cod_estado_cita_registrar                                           = $matriz_datos_permiso_usuario['cod_estado_cita_registrar'];
	$cod_estado_cita_editar                                              = $matriz_datos_permiso_usuario['cod_estado_cita_editar'];
	$cod_estado_cita_eliminar                                            = $matriz_datos_permiso_usuario['cod_estado_cita_eliminar'];
	$cod_estado_cita_imprimir                                            = $matriz_datos_permiso_usuario['cod_estado_cita_imprimir'];
	$cod_estado_cita_exportar                                            = $matriz_datos_permiso_usuario['cod_estado_cita_exportar'];

	$cod_estado_cuenta                                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta'];
	$cod_estado_cuenta_cobrar                                            = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar'];
	$cod_estado_cuenta_cobrar_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_registrar'];
	$cod_estado_cuenta_cobrar_editar                                     = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_editar'];
	$cod_estado_cuenta_cobrar_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_eliminar'];
	$cod_estado_cuenta_cobrar_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_imprimir'];
	$cod_estado_cuenta_cobrar_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_cobrar_exportar'];

	$cod_estado_cuenta_pagar                                             = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar'];
	$cod_estado_cuenta_pagar_registrar                                   = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_registrar'];
	$cod_estado_cuenta_pagar_editar                                      = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_editar'];
	$cod_estado_cuenta_pagar_eliminar                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_eliminar'];
	$cod_estado_cuenta_pagar_imprimir                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_imprimir'];
	$cod_estado_cuenta_pagar_exportar                                    = $matriz_datos_permiso_usuario['cod_estado_cuenta_pagar_exportar'];

	$cod_estado_cierre_caja                                              = $matriz_datos_permiso_usuario['cod_estado_cierre_caja'];
	$cod_estado_cierre_caja_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_registrar'];
	$cod_estado_cierre_caja_editar                                       = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_editar'];
	$cod_estado_cierre_caja_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_eliminar'];
	$cod_estado_cierre_caja_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_imprimir'];
	$cod_estado_cierre_caja_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_cierre_caja_exportar'];

	$cod_estado_egreso                                                   = $matriz_datos_permiso_usuario['cod_estado_egreso'];
	$cod_estado_egreso_registrar                                         = $matriz_datos_permiso_usuario['cod_estado_egreso_registrar'];
	$cod_estado_egreso_editar                                            = $matriz_datos_permiso_usuario['cod_estado_egreso_editar'];
	$cod_estado_egreso_eliminar                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_eliminar'];
	$cod_estado_egreso_imprimir                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_imprimir'];
	$cod_estado_egreso_exportar                                          = $matriz_datos_permiso_usuario['cod_estado_egreso_exportar'];

	$cod_estado_sticker_barra                                            = $matriz_datos_permiso_usuario['cod_estado_sticker_barra'];
	$cod_estado_sticker_barra_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_registrar'];
	$cod_estado_sticker_barra_editar                                     = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_editar'];
	$cod_estado_sticker_barra_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_eliminar'];
	$cod_estado_sticker_barra_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_imprimir'];
	$cod_estado_sticker_barra_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_exportar'];
	$cod_estado_sticker_barra_observacion                                = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_observacion'];
	$cod_estado_sticker_barra_archivo_plano                              = $matriz_datos_permiso_usuario['cod_estado_sticker_barra_archivo_plano'];

	$cod_estado_reporte                                                  = $matriz_datos_permiso_usuario['cod_estado_reporte'];
	$cod_estado_reporte_venta                                            = $matriz_datos_permiso_usuario['cod_estado_reporte_venta'];
	$cod_estado_reporte_venta_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_registrar'];
	$cod_estado_reporte_venta_editar                                     = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_editar'];
	$cod_estado_reporte_venta_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_eliminar'];
	$cod_estado_reporte_venta_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_imprimir'];
	$cod_estado_reporte_venta_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_exportar'];

	$cod_estado_reporte_compra                                           = $matriz_datos_permiso_usuario['cod_estado_reporte_compra'];
	$cod_estado_reporte_compra_registrar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_registrar'];
	$cod_estado_reporte_compra_editar                                    = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_editar'];
	$cod_estado_reporte_compra_eliminar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_eliminar'];
	$cod_estado_reporte_compra_imprimir                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_imprimir'];
	$cod_estado_reporte_compra_exportar                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_compra_exportar'];

	$cod_estado_reporte_general                                          = $matriz_datos_permiso_usuario['cod_estado_reporte_general'];
	$cod_estado_reporte_general_registrar                                = $matriz_datos_permiso_usuario['cod_estado_reporte_general_registrar'];
	$cod_estado_reporte_general_editar                                   = $matriz_datos_permiso_usuario['cod_estado_reporte_general_editar'];
	$cod_estado_reporte_general_eliminar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_eliminar'];
	$cod_estado_reporte_general_imprimir                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_imprimir'];
	$cod_estado_reporte_general_exportar                                 = $matriz_datos_permiso_usuario['cod_estado_reporte_general_exportar'];

	$cod_estado_reporte_mov_contable                                     = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable'];
	$cod_estado_reporte_mov_contable_registrar                           = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_registrar'];
	$cod_estado_reporte_mov_contable_editar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_editar'];
	$cod_estado_reporte_mov_contable_eliminar                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_eliminar'];
	$cod_estado_reporte_mov_contable_imprimir                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_imprimir'];
	$cod_estado_reporte_mov_contable_exportar                            = $matriz_datos_permiso_usuario['cod_estado_reporte_mov_contable_exportar'];

	$cod_estado_reporte_venta_por_producto                               = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto'];
	$cod_estado_reporte_venta_por_producto_registrar                     = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_registrar'];
	$cod_estado_reporte_venta_por_producto_editar                        = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_editar'];
	$cod_estado_reporte_venta_por_producto_eliminar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_eliminar'];
	$cod_estado_reporte_venta_por_producto_imprimir                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_imprimir'];
	$cod_estado_reporte_venta_por_producto_exportar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_venta_por_producto_exportar'];

	$cod_estado_reporte_inventario                                       = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario'];
	$cod_estado_reporte_inventario_registrar                             = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_registrar'];
	$cod_estado_reporte_inventario_editar                                = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_editar'];
	$cod_estado_reporte_inventario_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_eliminar'];
	$cod_estado_reporte_inventario_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_imprimir'];
	$cod_estado_reporte_inventario_exportar                              = $matriz_datos_permiso_usuario['cod_estado_reporte_inventario_exportar'];

	$cod_estado_reporte_prodcuto_vencer                                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer'];
	$cod_estado_reporte_prodcuto_vencer_registrar                        = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_registrar'];
	$cod_estado_reporte_prodcuto_vencer_editar                           = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_editar'];
	$cod_estado_reporte_prodcuto_vencer_eliminar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_eliminar'];
	$cod_estado_reporte_prodcuto_vencer_imprimir                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_imprimir'];
	$cod_estado_reporte_prodcuto_vencer_exportar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_vencer_exportar'];

	$cod_estado_reporte_prodcuto_mantenimiento                           = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento'];
	$cod_estado_reporte_prodcuto_mantenimiento_registrar                 = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_registrar'];
	$cod_estado_reporte_prodcuto_mantenimiento_editar                    = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_editar'];
	$cod_estado_reporte_prodcuto_mantenimiento_eliminar                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_eliminar'];
	$cod_estado_reporte_prodcuto_mantenimiento_imprimir                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_imprimir'];
	$cod_estado_reporte_prodcuto_mantenimiento_exportar                  = $matriz_datos_permiso_usuario['cod_estado_reporte_prodcuto_mantenimiento_exportar'];

	$cod_estado_reporte_cumplanos_tercero                                = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero'];
	$cod_estado_reporte_cumplanos_tercero_registrar                      = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_registrar'];
	$cod_estado_reporte_cumplanos_tercero_editar                         = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_editar'];
	$cod_estado_reporte_cumplanos_tercero_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_eliminar'];
	$cod_estado_reporte_cumplanos_tercero_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_imprimir'];
	$cod_estado_reporte_cumplanos_tercero_exportar                       = $matriz_datos_permiso_usuario['cod_estado_reporte_cumplanos_tercero_exportar'];

	$cod_estado_admin                                                    = $matriz_datos_permiso_usuario['cod_estado_admin'];

	$cod_estado_info_empresa                                             = $matriz_datos_permiso_usuario['cod_estado_info_empresa'];
	$cod_estado_info_empresa_registrar                                   = $matriz_datos_permiso_usuario['cod_estado_info_empresa_registrar'];
	$cod_estado_info_empresa_editar                                      = $matriz_datos_permiso_usuario['cod_estado_info_empresa_editar'];
	$cod_estado_info_empresa_eliminar                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_eliminar'];
	$cod_estado_info_empresa_imprimir                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_imprimir'];
	$cod_estado_info_empresa_exportar                                    = $matriz_datos_permiso_usuario['cod_estado_info_empresa_exportar'];

	$cod_estado_usuario                                                  = $matriz_datos_permiso_usuario['cod_estado_usuario'];
	$cod_estado_usuario_registrar                                        = $matriz_datos_permiso_usuario['cod_estado_usuario_registrar'];
	$cod_estado_usuario_editar                                           = $matriz_datos_permiso_usuario['cod_estado_usuario_editar'];
	$cod_estado_usuario_eliminar                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_eliminar'];
	$cod_estado_usuario_imprimir                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_imprimir'];
	$cod_estado_usuario_exportar                                         = $matriz_datos_permiso_usuario['cod_estado_usuario_exportar'];

	$cod_estado_dependencia                                              = $matriz_datos_permiso_usuario['cod_estado_dependencia'];
	$cod_estado_dependencia_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_dependencia_registrar'];
	$cod_estado_dependencia_editar                                       = $matriz_datos_permiso_usuario['cod_estado_dependencia_editar'];
	$cod_estado_dependencia_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_eliminar'];
	$cod_estado_dependencia_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_imprimir'];
	$cod_estado_dependencia_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_dependencia_exportar'];

	$cod_estado_resol_facturacion                                        = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion'];
	$cod_estado_resol_facturacion_registrar                              = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_registrar'];
	$cod_estado_resol_facturacion_editar                                 = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_editar'];
	$cod_estado_resol_facturacion_eliminar                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_eliminar'];
	$cod_estado_resol_facturacion_imprimir                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_imprimir'];
	$cod_estado_resol_facturacion_exportar                               = $matriz_datos_permiso_usuario['cod_estado_resol_facturacion_exportar'];

	$cod_estado_numero_letras                                            = $matriz_datos_permiso_usuario['cod_estado_numero_letras'];
	$cod_estado_numero_letras_registrar                                  = $matriz_datos_permiso_usuario['cod_estado_numero_letras_registrar'];
	$cod_estado_numero_letras_editar                                     = $matriz_datos_permiso_usuario['cod_estado_numero_letras_editar'];
	$cod_estado_numero_letras_eliminar                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_eliminar'];
	$cod_estado_numero_letras_imprimir                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_imprimir'];
	$cod_estado_numero_letras_exportar                                   = $matriz_datos_permiso_usuario['cod_estado_numero_letras_exportar'];

	$cod_estado_eliminar                                                 = $matriz_datos_permiso_usuario['cod_estado_eliminar'];
	$cod_estado_eliminar_usuario                                         = $matriz_datos_permiso_usuario['cod_estado_eliminar_usuario'];
	$cod_estado_eliminar_tercero                                         = $matriz_datos_permiso_usuario['cod_estado_eliminar_tercero'];
	$cod_estado_eliminar_producto                                        = $matriz_datos_permiso_usuario['cod_estado_eliminar_producto'];

	$cod_estado_licencia                                                 = $matriz_datos_permiso_usuario['cod_estado_licencia'];
	$cod_estado_licencia_registrar                                       = $matriz_datos_permiso_usuario['cod_estado_licencia_registrar'];
	$cod_estado_licencia_editar                                          = $matriz_datos_permiso_usuario['cod_estado_licencia_editar'];
	$cod_estado_licencia_imprimir                                        = $matriz_datos_permiso_usuario['cod_estado_licencia_imprimir'];
	$cod_estado_licencia_exportar                                        = $matriz_datos_permiso_usuario['cod_estado_licencia_exportar'];

	$cod_estado_repositorio                                              = $matriz_datos_permiso_usuario['cod_estado_repositorio'];
	$cod_estado_repositorio_registrar                                    = $matriz_datos_permiso_usuario['cod_estado_repositorio_registrar'];
	$cod_estado_repositorio_editar                                       = $matriz_datos_permiso_usuario['cod_estado_repositorio_editar'];
	$cod_estado_repositorio_eliminar                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_eliminar'];
	$cod_estado_repositorio_imprimir                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_imprimir'];
	$cod_estado_repositorio_exportar                                     = $matriz_datos_permiso_usuario['cod_estado_repositorio_exportar'];

	$cod_estado_prod_cod_rodeo                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_rodeo'];
	$cod_estado_prod_nombre_rodeo                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_rodeo'];
	$cod_estado_prod_nombre_sexo                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_sexo'];
	$cod_estado_prod_de_monta                                            = $matriz_datos_permiso_usuario['cod_estado_prod_de_monta'];
	$cod_estado_prod_nombre_estatus                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_estatus'];
	$cod_estado_prod_nombre_condicion_corporal                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_condicion_corporal'];
	$cod_estado_prod_nombre_categoria_ingreso                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_ingreso'];
	$cod_estado_prod_nombre_categoria_actual                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_actual'];
	$cod_estado_prod_nombre_categoria_futura                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_futura'];
	$cod_estado_prod_nombre_procedencia                                  = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_procedencia'];
	$cod_estado_prod_nombre_tipo_monta                                   = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_monta'];
	$cod_estado_prod_nombre_lote_categoria                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_lote_categoria'];
	$cod_estado_prod_nombre_prog_reproductivo                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_prog_reproductivo'];
	$cod_estado_prod_nombre_potrero                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_potrero'];
	$cod_estado_prod_nombre_lote                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_lote'];
	$cod_estado_prod_nombre_calidad_animal                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_calidad_animal'];
	$cod_estado_prod_nombre_tipo_explotacion                             = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_explotacion'];
	$cod_estado_prod_peso_compra                                         = $matriz_datos_permiso_usuario['cod_estado_prod_peso_compra'];
	$cod_estado_prod_precio_compra                                       = $matriz_datos_permiso_usuario['cod_estado_prod_precio_compra'];
	$cod_estado_prod_fecha_nac                                           = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_nac'];
	$cod_estado_prod_fecha_compra                                        = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_compra'];
	$cod_estado_prod_fecha_castracion                                    = $matriz_datos_permiso_usuario['cod_estado_prod_fecha_castracion'];
	$cod_estado_prod_nro_hierros                                         = $matriz_datos_permiso_usuario['cod_estado_prod_nro_hierros'];
	$cod_estado_prod_hierro_animal                                       = $matriz_datos_permiso_usuario['cod_estado_prod_hierro_animal'];
	$cod_estado_prod_numero_partos                                       = $matriz_datos_permiso_usuario['cod_estado_prod_numero_partos'];
	$cod_estado_prod_id_electronica                                      = $matriz_datos_permiso_usuario['cod_estado_prod_id_electronica'];
	$cod_estado_prod_nombre_raza1                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza1'];
	$cod_estado_prod_nombre_raza2                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza2'];
	$cod_estado_prod_nombre_raza3                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza3'];
	$cod_estado_prod_nombre_raza4                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_raza4'];
	$cod_estado_prod_ptj_raza1                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza1'];
	$cod_estado_prod_ptj_raza2                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza2'];
	$cod_estado_prod_ptj_raza3                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza3'];
	$cod_estado_prod_ptj_raza4                                           = $matriz_datos_permiso_usuario['cod_estado_prod_ptj_raza4'];
	$cod_estado_prod_id_padre                                            = $matriz_datos_permiso_usuario['cod_estado_prod_id_padre'];
	$cod_estado_prod_raza_padre                                          = $matriz_datos_permiso_usuario['cod_estado_prod_raza_padre'];
	$cod_estado_prod_id_madre                                            = $matriz_datos_permiso_usuario['cod_estado_prod_id_madre'];
	$cod_estado_prod_raza_madre                                          = $matriz_datos_permiso_usuario['cod_estado_prod_raza_madre'];
	$cod_estado_prod_partos_madre                                        = $matriz_datos_permiso_usuario['cod_estado_prod_partos_madre'];
	$cod_estado_prod_id_abuelo_paterno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuelo_paterno'];
	$cod_estado_prod_id_abuelo_materno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuelo_materno'];
	$cod_estado_prod_nombre_abuelo_paterno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuelo_paterno'];
	$cod_estado_prod_nombre_abuelo_materno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuelo_materno'];
	$cod_estado_prod_raza_abuelo_paterno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuelo_paterno'];
	$cod_estado_prod_raza_abuelo_materno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuelo_materno'];
	$cod_estado_prod_id_abuela_paterno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuela_paterno'];
	$cod_estado_prod_id_abuela_materno                                   = $matriz_datos_permiso_usuario['cod_estado_prod_id_abuela_materno'];
	$cod_estado_prod_nombre_abuela_paterno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuela_paterno'];
	$cod_estado_prod_nombre_abuela_materno                               = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_abuela_materno'];
	$cod_estado_prod_raza_abuela_paterno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuela_paterno'];
	$cod_estado_prod_raza_abuela_materno                                 = $matriz_datos_permiso_usuario['cod_estado_prod_raza_abuela_materno'];
	$cod_estado_prod_nombre_tipo_concepcion                              = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_concepcion'];
	$cod_estado_prod_nombre_especie                                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_especie'];
	$cod_estado_prod_marcas_tatuado                                      = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_tatuado'];
	$cod_estado_prod_marcas_herrado                                      = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_herrado'];
	$cod_estado_prod_marcas_descornado                                   = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_descornado'];
	$cod_estado_prod_marcas_castrado                                     = $matriz_datos_permiso_usuario['cod_estado_prod_marcas_castrado'];
	$cod_estado_prod_nombre_color                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_color'];
	$cod_estado_prod_nombre_temperamento                                 = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_temperamento'];
	$cod_estado_prod_peso_nacer                                          = $matriz_datos_permiso_usuario['cod_estado_prod_peso_nacer'];
	$cod_estado_prod_aplomo_corvejon                                     = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_corvejon'];
	$cod_estado_prod_aplomo_cuartilla                                    = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_cuartilla'];
	$cod_estado_prod_aplomo_cascos                                       = $matriz_datos_permiso_usuario['cod_estado_prod_aplomo_cascos'];
	$cod_estado_prod_genital_circun_escrotal                             = $matriz_datos_permiso_usuario['cod_estado_prod_genital_circun_escrotal'];
	$cod_estado_prod_genital_prepusio                                    = $matriz_datos_permiso_usuario['cod_estado_prod_genital_prepusio'];
	$cod_estado_prod_genital_potencia                                    = $matriz_datos_permiso_usuario['cod_estado_prod_genital_potencia'];
	$cod_estado_prod_genital_semen                                       = $matriz_datos_permiso_usuario['cod_estado_prod_genital_semen'];
	$cod_estado_prod_observacion_animal                                  = $matriz_datos_permiso_usuario['cod_estado_prod_observacion_animal'];
	$cod_estado_prod_nombre_estado                                       = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_estado'];
	$cod_estado_prod_nombre_tipo_movimiento                              = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_movimiento'];
	$cod_estado_prod_nombre_categoria_animal_extern                      = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_animal_extern'];
	$cod_estado_prod_cod_finca                                           = $matriz_datos_permiso_usuario['cod_estado_prod_cod_finca'];
	$cod_estado_prod_nombre_finca                                        = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_finca'];
	$cod_estado_prod_nombre_categoria                                    = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria'];
	$cod_estado_prod_nombre_categoria_sub                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_categoria_sub'];
	$cod_estado_prod_und_inv                                             = $matriz_datos_permiso_usuario['cod_estado_prod_und_inv'];
	$cod_estado_prod_descripcion_producto                                = $matriz_datos_permiso_usuario['cod_estado_prod_descripcion_producto'];
	$cod_estado_prod_url_img_producto_min                                = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_producto_min'];
	$cod_estado_prod_url_img_producto_orig                               = $matriz_datos_permiso_usuario['cod_estado_prod_url_img_producto_orig'];

	$cod_estado_prod_nombre_promocion                                    = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_promocion'];
	$cod_estado_prod_nombre_promocion_ing                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_promocion_ing'];

	$cod_estado_prod_posologia_cantidad                                  = $matriz_datos_permiso_usuario['cod_estado_prod_posologia_cantidad'];
	$cod_estado_prod_posologia_peso                                      = $matriz_datos_permiso_usuario['cod_estado_prod_posologia_peso'];
	$cod_estado_prod_nombre_tipo_presentacion                            = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_tipo_presentacion'];
	$cod_estado_prod_nombre_via_administracion                           = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_via_administracion'];
	$cod_estado_prod_nombre_frec_duracion                                = $matriz_datos_permiso_usuario['cod_estado_prod_nombre_frec_duracion'];

	$cod_estado_prod_subproducto_registrar                               = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_registrar'];
	$cod_estado_prod_subproducto_editar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_editar'];
	$cod_estado_prod_subproducto_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_eliminar'];
	$cod_estado_prod_subproducto_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_imprimir'];
	$cod_estado_prod_subproducto_exportar                                = $matriz_datos_permiso_usuario['cod_estado_prod_subproducto_exportar'];

	$cod_estado_prod_transferencia_registrar                             = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_registrar'];
	$cod_estado_prod_transferencia_editar                                = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_editar'];
	$cod_estado_prod_transferencia_eliminar                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_eliminar'];
	$cod_estado_prod_transferencia_imprimir                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_imprimir'];
	$cod_estado_prod_transferencia_exportar                              = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_exportar'];

	$cod_estado_prod_auditoria_registrar                                 = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_registrar'];
	$cod_estado_prod_auditoria_editar                                    = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_editar'];
	$cod_estado_prod_auditoria_eliminar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_eliminar'];
	$cod_estado_prod_auditoria_imprimir                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_imprimir'];
	$cod_estado_prod_auditoria_exportar                                  = $matriz_datos_permiso_usuario['cod_estado_prod_auditoria_exportar'];

	$cod_estado_eliminar_caja_mesa_virtual                               = $matriz_datos_permiso_usuario['cod_estado_eliminar_caja_mesa_virtual'];
	$cod_estado_precio_compra_mod_venta                                  = $matriz_datos_permiso_usuario['cod_estado_precio_compra_mod_venta'];
	$cod_estado_deshabilitar_opc_eliminar_ventatemp                      = $matriz_datos_permiso_usuario['cod_estado_deshabilitar_opc_eliminar_ventatemp'];
	$cod_estado_habilitar_btn_facturar_mod_venta                         = $matriz_datos_permiso_usuario['cod_estado_habilitar_btn_facturar_mod_venta'];


	$cod_estado_habilitar_ver_todas_facturas_vendedores                  = $matriz_datos_permiso_usuario['cod_estado_habilitar_ver_todas_facturas_vendedores'];

	$cod_estado_seguridad                                                = $matriz_datos_permiso_usuario['cod_estado_seguridad'];
	$cod_estado_seguridad_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_seguridad_registrar'];
	$cod_estado_seguridad_editar                                         = $matriz_datos_permiso_usuario['cod_estado_seguridad_editar'];
	$cod_estado_seguridad_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_eliminar'];
	$cod_estado_seguridad_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_imprimir'];
	$cod_estado_seguridad_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_seguridad_exportar'];

	$cod_estado_grafico_estadistico                                      = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico'];
	$cod_estado_grafico_estadistico_registrar                            = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_registrar'];
	$cod_estado_grafico_estadistico_editar                               = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_editar'];
	$cod_estado_grafico_estadistico_eliminar                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_eliminar'];
	$cod_estado_grafico_estadistico_imprimir                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_imprimir'];
	$cod_estado_grafico_estadistico_exportar                             = $matriz_datos_permiso_usuario['cod_estado_grafico_estadistico_exportar'];

	$cod_estado_nota_observacion                                         = $matriz_datos_permiso_usuario['cod_estado_nota_observacion'];
	$cod_estado_nota_observacion_registrar                               = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_registrar'];
	$cod_estado_nota_observacion_editar                                  = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_editar'];
	$cod_estado_nota_observacion_eliminar                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_eliminar'];
	$cod_estado_nota_observacion_imprimir                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_imprimir'];
	$cod_estado_nota_observacion_exportar                                = $matriz_datos_permiso_usuario['cod_estado_nota_observacion_exportar'];

	$cod_estado_tipo_roles                                               = $matriz_datos_permiso_usuario['cod_estado_tipo_roles'];
	$cod_estado_tipo_roles_registrar                                     = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_registrar'];
	$cod_estado_tipo_roles_editar                                        = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_editar'];
	$cod_estado_tipo_roles_eliminar                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_eliminar'];
	$cod_estado_tipo_roles_imprimir                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_imprimir'];
	$cod_estado_tipo_roles_exportar                                      = $matriz_datos_permiso_usuario['cod_estado_tipo_roles_exportar'];

	$cod_estado_agregar_productos_a_venta_facturada                      = $matriz_datos_permiso_usuario['cod_estado_agregar_productos_a_venta_facturada'];
	$cod_estado_eliminar_productos_a_venta_facturada                     = $matriz_datos_permiso_usuario['cod_estado_eliminar_productos_a_venta_facturada'];
	$cod_estado_habilitar_total_venta_ventatemp                          = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_ventatemp'];
	$cod_estado_habilitar_total_venta_caja_mesa_virtual                  = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual'];
	$cod_estado_habilitar_caja_mesa_virtual_en_uso                       = $matriz_datos_permiso_usuario['cod_estado_habilitar_caja_mesa_virtual_en_uso'];
	$cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso           = $matriz_datos_permiso_usuario['cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso'];

	$cod_estado_prod_inventario_producto_masivo                          = $matriz_datos_permiso_usuario['cod_estado_prod_inventario_producto_masivo'];
	$cod_estado_prod_transferencia_extern                                = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern'];
	$cod_estado_prod_transferencia_extern_registrar                      = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_registrar'];
	$cod_estado_prod_transferencia_extern_editar                         = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_editar'];
	$cod_estado_prod_transferencia_extern_eliminar                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_eliminar'];
	$cod_estado_prod_transferencia_extern_imprimir                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_imprimir'];
	$cod_estado_prod_transferencia_extern_exportar                       = $matriz_datos_permiso_usuario['cod_estado_prod_transferencia_extern_exportar'];

	$cod_estado_categoria                                                = $matriz_datos_permiso_usuario['cod_estado_categoria'];
	$cod_estado_categoria_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_categoria_registrar'];
	$cod_estado_categoria_editar                                         = $matriz_datos_permiso_usuario['cod_estado_categoria_editar'];
	$cod_estado_categoria_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_eliminar'];
	$cod_estado_categoria_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_imprimir'];
	$cod_estado_categoria_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_categoria_exportar'];

	$cod_estado_caja_mesa                                                = $matriz_datos_permiso_usuario['cod_estado_caja_mesa'];
	$cod_estado_caja_mesa_registrar                                      = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_registrar'];
	$cod_estado_caja_mesa_editar                                         = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_editar'];
	$cod_estado_caja_mesa_eliminar                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_eliminar'];
	$cod_estado_caja_mesa_imprimir                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_imprimir'];
	$cod_estado_caja_mesa_exportar                                       = $matriz_datos_permiso_usuario['cod_estado_caja_mesa_exportar'];

	$cod_estado_usuario_cambiar_contrasena                               = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_contrasena'];
	$cod_estado_usuario_cambiar_firma                                    = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_firma'];
	$cod_estado_usuario_permisos_personalizados                          = $matriz_datos_permiso_usuario['cod_estado_usuario_permisos_personalizados'];
	$cod_estado_usuario_permisos_asignar_matriz                          = $matriz_datos_permiso_usuario['cod_estado_usuario_permisos_asignar_matriz'];
	$cod_estado_usuario_cambiar_tipo_rol                                 = $matriz_datos_permiso_usuario['cod_estado_usuario_cambiar_tipo_rol'];

	$cod_estado_facturacion_venta_dependencia_user                       = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_dependencia_user'];
	$cod_estado_facturacion_venta_precio_venta_predet_user               = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_precio_venta_predet_user'];
	$cod_estado_facturacion_venta_acceso_facturas_otros_user             = $matriz_datos_permiso_usuario['cod_estado_facturacion_venta_acceso_facturas_otros_user'];

	if ($contrasena1 == $contrasena2) {
		$contrasena = sha1($contrasena1);

		$agreg = "INSERT INTO tbl15_administrador (cedula, nombres, apellidos, nombre_sexo, cuenta, contrasena, correo, cod_seguridad, cod_tipo_historia_clinica, telefono, 
		estilo_css, creador, fecha_hora, fecha, reg_medico, 
		cod_estado_prod, cod_estado_prod_reg_producto, cod_estado_prod_asig_subproducto, cod_estado_prod_cargar_factura_compra, 
		cod_estado_prod_cargar_factura_compra_soporte, cod_estado_prod_cargar_factura_compra_observacion, cod_estado_prod_transferencia, 
		cod_estado_prod_auditoria, cod_estado_prod_nuevo_invenario, cod_estado_prod_inventario_producto, cod_estado_prod_registrar, 
		cod_estado_prod_editar, cod_estado_prod_eliminar, cod_estado_prod_imprimir, cod_estado_prod_exportar, 
		cod_estado_prod_subproducto, cod_estado_prod_und_producto, cod_estado_prod_und_producto_bodega, cod_estado_prod_precio_compra_producto, 
		cod_estado_prod_precio_costo_producto, cod_estado_prod_precio_venta_producto, cod_estado_prod_precio_venta_producto2, cod_estado_prod_precio_venta_producto3, 
		cod_estado_prod_precio_venta_producto4, cod_estado_prod_precio_venta_producto5, cod_estado_prod_nombre_tipo_unidad_medida, cod_estado_prod_iva_ptj, 
		cod_estado_prod_nombre_tipo_producto, cod_estado_prod_cod_marca, cod_estado_prod_cod_proveedor, cod_estado_prod_cod_tercero, 
		cod_estado_prod_cod_estado, cod_estado_prod_cod_dependencia, cod_estado_prod_fecha_ult_compra, cod_estado_prod_fecha_ult_venta, 
		cod_estado_prod_fecha_vencimiento, cod_estado_prod_tope_min, cod_estado_prod_fecha_creacion, cod_estado_prod_fecha_modificacion, 
		cod_estado_prod_nombre_tipo_precio_venta, cod_estado_prod_url_img_orig_producto, cod_estado_prod_url_img_min_producto, cod_estado_prod_comision_ptj, 
		cod_estado_prod_dto1, cod_estado_prod_dto2, cod_estado_prod_ipc_ptj, cod_estado_prod_precio_ipc, 
		cod_estado_prod_ret_ica_ptj, cod_estado_prod_iva_teorico_ptj, cod_estado_prod_tarifa_rete_vigente_ptj, cod_estado_prod_rete_iva_asumido_ptj, 
		cod_estado_prod_nombre_tipo_compra, cod_estado_prod_nombre_tipo_cargue_factura, cod_estado_prod_nombre_tipo_medida, cod_estado_prod_cajas_sobre, 
		cod_estado_prod_und_sobre, cod_estado_prod_cod_interno, cod_estado_prod_cod_original, cod_estado_prod_codificacion, 
		cod_estado_prod_cod_producto_serial, cod_estado_prod_fecha_mantenimiento, cod_estado_prod_peso_producto,
		cod_estado_plan_separe, cod_estado_plan_separe_registrar, cod_estado_plan_separe_editar, 
		cod_estado_plan_separe_eliminar, cod_estado_plan_separe_imprimir, cod_estado_plan_separe_exportar, 
		cod_estado_contabilidad, cod_estado_contabilidad_mov_contable, cod_estado_contabilidad_mov_contable_registrar, 
		cod_estado_contabilidad_mov_contable_editar, cod_estado_contabilidad_mov_contable_eliminar, cod_estado_contabilidad_mov_contable_imprimir, 
		cod_estado_contabilidad_mov_contable_exportar, cod_estado_contabilidad_pyg, cod_estado_contabilidad_pyg_registrar, 
		cod_estado_contabilidad_pyg_editar, cod_estado_contabilidad_pyg_eliminar, cod_estado_contabilidad_pyg_imprimir, 
		cod_estado_contabilidad_pyg_exportar, cod_estado_contabilidad_balance, cod_estado_contabilidad_balance_pyg_registrar, 
		cod_estado_contabilidad_balance_pyg_editar, cod_estado_contabilidad_balance_pyg_eliminar, cod_estado_contabilidad_balance_pyg_imprimir, 
		cod_estado_contabilidad_balance_pyg_exportar, cod_estado_contabilidad_puc, cod_estado_contabilidad_puc_registrar, 
		cod_estado_contabilidad_puc_editar, cod_estado_contabilidad_puc_eliminar, cod_estado_contabilidad_puc_imprimir, 
		cod_estado_contabilidad_puc_exportar, cod_estado_facturacion, cod_estado_facturacion_venta, 
		cod_estado_facturacion_venta_registrar, cod_estado_facturacion_venta_editar, cod_estado_facturacion_venta_eliminar, 
		cod_estado_facturacion_venta_imprimir, cod_estado_facturacion_venta_exportar, cod_estado_facturacion_venta_devol, 
		cod_estado_facturacion_compra, cod_estado_facturacion_compra_registrar, cod_estado_facturacion_compra_editar, 
		cod_estado_facturacion_compra_eliminar, cod_estado_facturacion_compra_imprimir, cod_estado_facturacion_compra_exportar, 
		cod_estado_facturacion_compra_devol, cod_estado_facturacion_devol_venta, cod_estado_facturacion_devol_inventario, 
		cod_estado_cotizacion, cod_estado_cotizacion_venta, cod_estado_cotizacion_venta_registrar, 
		cod_estado_cotizacion_venta_editar, cod_estado_cotizacion_venta_eliminar, cod_estado_cotizacion_venta_imprimir, 
		cod_estado_cotizacion_venta_exportar, cod_estado_cotizacion_compra, cod_estado_cotizacion_compra_registrar, 
		cod_estado_cotizacion_compra_editar, cod_estado_cotizacion_compra_eliminar, cod_estado_cotizacion_compra_imprimir, 
		cod_estado_cotizacion_compra_exportar, cod_estado_venta, cod_estado_venta_manual, 
		cod_estado_venta_barras, cod_estado_venta_fecha_venta, cod_estado_venta_preventa, 
		cod_estado_venta_propina, cod_estado_venta_bolsa, cod_estado_venta_observacion, 
		cod_estado_tercero, cod_estado_tercero_registrar, cod_estado_tercero_editar, 
		cod_estado_tercero_eliminar, cod_estado_tercero_imprimir, cod_estado_tercero_exportar, 
		cod_estado_cita, cod_estado_cita_registrar, cod_estado_cita_editar, 
		cod_estado_cita_eliminar, cod_estado_cita_imprimir, cod_estado_cita_exportar, 
		cod_estado_cuenta, cod_estado_cuenta_cobrar, cod_estado_cuenta_cobrar_registrar, 
		cod_estado_cuenta_cobrar_editar, cod_estado_cuenta_cobrar_eliminar, cod_estado_cuenta_cobrar_imprimir, 
		cod_estado_cuenta_cobrar_exportar, cod_estado_cuenta_pagar, cod_estado_cuenta_pagar_registrar, 
		cod_estado_cuenta_pagar_editar, cod_estado_cuenta_pagar_eliminar, cod_estado_cuenta_pagar_imprimir, 
		cod_estado_cuenta_pagar_exportar, cod_estado_cierre_caja, cod_estado_cierre_caja_registrar, 
		cod_estado_cierre_caja_editar, cod_estado_cierre_caja_eliminar, cod_estado_cierre_caja_imprimir, 
		cod_estado_cierre_caja_exportar, cod_estado_egreso, cod_estado_egreso_registrar, 
		cod_estado_egreso_editar, cod_estado_egreso_eliminar, cod_estado_egreso_imprimir, 
		cod_estado_egreso_exportar, cod_estado_sticker_barra, cod_estado_sticker_barra_registrar, 
		cod_estado_sticker_barra_editar, cod_estado_sticker_barra_eliminar, cod_estado_sticker_barra_imprimir, 
		cod_estado_sticker_barra_exportar, cod_estado_sticker_barra_observacion, cod_estado_sticker_barra_archivo_plano, 
		cod_estado_reporte, cod_estado_reporte_venta, cod_estado_reporte_venta_registrar, 
		cod_estado_reporte_venta_editar, cod_estado_reporte_venta_eliminar, cod_estado_reporte_venta_imprimir, 
		cod_estado_reporte_venta_exportar, cod_estado_reporte_compra, cod_estado_reporte_compra_registrar, 
		cod_estado_reporte_compra_editar, cod_estado_reporte_compra_eliminar, cod_estado_reporte_compra_imprimir, 
		cod_estado_reporte_compra_exportar, cod_estado_reporte_general, cod_estado_reporte_general_registrar, 
		cod_estado_reporte_general_editar, cod_estado_reporte_general_eliminar, cod_estado_reporte_general_imprimir, 
		cod_estado_reporte_general_exportar, cod_estado_reporte_mov_contable, cod_estado_reporte_mov_contable_registrar, 
		cod_estado_reporte_mov_contable_editar, cod_estado_reporte_mov_contable_eliminar, cod_estado_reporte_mov_contable_imprimir, 
		cod_estado_reporte_mov_contable_exportar, cod_estado_reporte_venta_por_producto, cod_estado_reporte_venta_por_producto_registrar, 
		cod_estado_reporte_venta_por_producto_editar, cod_estado_reporte_venta_por_producto_eliminar, cod_estado_reporte_venta_por_producto_imprimir, 
		cod_estado_reporte_venta_por_producto_exportar, cod_estado_reporte_inventario, cod_estado_reporte_inventario_registrar, 
		cod_estado_reporte_inventario_editar, cod_estado_reporte_inventario_eliminar, cod_estado_reporte_inventario_imprimir, 
		cod_estado_reporte_inventario_exportar, cod_estado_reporte_prodcuto_vencer, cod_estado_reporte_prodcuto_vencer_registrar, 
		cod_estado_reporte_prodcuto_vencer_editar, cod_estado_reporte_prodcuto_vencer_eliminar, cod_estado_reporte_prodcuto_vencer_imprimir, 
		cod_estado_reporte_prodcuto_vencer_exportar, cod_estado_reporte_prodcuto_mantenimiento, cod_estado_reporte_prodcuto_mantenimiento_registrar, 
		cod_estado_reporte_prodcuto_mantenimiento_editar, cod_estado_reporte_prodcuto_mantenimiento_eliminar, cod_estado_reporte_prodcuto_mantenimiento_imprimir, 
		cod_estado_reporte_prodcuto_mantenimiento_exportar, cod_estado_reporte_cumplanos_tercero, cod_estado_reporte_cumplanos_tercero_registrar, 
		cod_estado_reporte_cumplanos_tercero_editar, cod_estado_reporte_cumplanos_tercero_eliminar, cod_estado_reporte_cumplanos_tercero_imprimir, 
		cod_estado_reporte_cumplanos_tercero_exportar, cod_estado_admin, cod_estado_info_empresa, 
		cod_estado_info_empresa_registrar, cod_estado_info_empresa_editar, cod_estado_info_empresa_eliminar, 
		cod_estado_info_empresa_imprimir, cod_estado_info_empresa_exportar, cod_estado_usuario, 
		cod_estado_usuario_registrar, cod_estado_usuario_editar, cod_estado_usuario_eliminar, 
		cod_estado_usuario_imprimir, cod_estado_usuario_exportar, cod_estado_dependencia, 
		cod_estado_dependencia_registrar, cod_estado_dependencia_editar, cod_estado_dependencia_eliminar, 
		cod_estado_dependencia_imprimir, cod_estado_dependencia_exportar, cod_estado_resol_facturacion, 
		cod_estado_resol_facturacion_registrar, cod_estado_resol_facturacion_editar, cod_estado_resol_facturacion_eliminar, 
		cod_estado_resol_facturacion_imprimir, cod_estado_resol_facturacion_exportar, cod_estado_numero_letras, 
		cod_estado_numero_letras_registrar, cod_estado_numero_letras_editar, cod_estado_numero_letras_eliminar, 
		cod_estado_numero_letras_imprimir, cod_estado_numero_letras_exportar, cod_estado_eliminar, 
		cod_estado_eliminar_usuario, cod_estado_eliminar_tercero, cod_estado_eliminar_producto, 
		cod_estado_licencia, cod_estado_licencia_registrar, cod_estado_licencia_editar, 
		cod_estado_licencia_imprimir, cod_estado_licencia_exportar, cod_estado_repositorio, 
		cod_estado_repositorio_registrar, cod_estado_repositorio_editar, cod_estado_repositorio_eliminar, 
		cod_estado_repositorio_imprimir, cod_estado_repositorio_exportar, cod_estado_prod_cod_rodeo, 
		cod_estado_prod_nombre_rodeo, cod_estado_prod_nombre_sexo, cod_estado_prod_de_monta, 
		cod_estado_prod_nombre_estatus, cod_estado_prod_nombre_condicion_corporal, cod_estado_prod_nombre_categoria_ingreso, 
		cod_estado_prod_nombre_categoria_actual, cod_estado_prod_nombre_categoria_futura, cod_estado_prod_nombre_procedencia, 
		cod_estado_prod_nombre_tipo_monta, cod_estado_prod_nombre_lote_categoria, cod_estado_prod_nombre_prog_reproductivo, 
		cod_estado_prod_nombre_potrero, cod_estado_prod_nombre_lote, cod_estado_prod_nombre_calidad_animal, 
		cod_estado_prod_nombre_tipo_explotacion, cod_estado_prod_peso_compra, cod_estado_prod_precio_compra, 
		cod_estado_prod_fecha_nac, cod_estado_prod_fecha_compra, cod_estado_prod_fecha_castracion, 
		cod_estado_prod_nro_hierros, cod_estado_prod_hierro_animal, cod_estado_prod_numero_partos, 
		cod_estado_prod_id_electronica, cod_estado_prod_nombre_raza1, cod_estado_prod_nombre_raza2, 
		cod_estado_prod_nombre_raza3, cod_estado_prod_nombre_raza4, cod_estado_prod_ptj_raza1, 
		cod_estado_prod_ptj_raza2, cod_estado_prod_ptj_raza3, cod_estado_prod_ptj_raza4, 
		cod_estado_prod_id_padre, cod_estado_prod_raza_padre, cod_estado_prod_id_madre, 
		cod_estado_prod_raza_madre, cod_estado_prod_partos_madre, cod_estado_prod_id_abuelo_paterno, 
		cod_estado_prod_id_abuelo_materno, cod_estado_prod_nombre_abuelo_paterno, cod_estado_prod_nombre_abuelo_materno, 
		cod_estado_prod_raza_abuelo_paterno, cod_estado_prod_raza_abuelo_materno, cod_estado_prod_id_abuela_paterno, 
		cod_estado_prod_id_abuela_materno, cod_estado_prod_nombre_abuela_paterno, cod_estado_prod_nombre_abuela_materno, 
		cod_estado_prod_raza_abuela_paterno, cod_estado_prod_raza_abuela_materno, cod_estado_prod_nombre_tipo_concepcion, 
		cod_estado_prod_nombre_especie, cod_estado_prod_marcas_tatuado, cod_estado_prod_marcas_herrado, 
		cod_estado_prod_marcas_descornado, cod_estado_prod_marcas_castrado, cod_estado_prod_nombre_color, 
		cod_estado_prod_nombre_temperamento, cod_estado_prod_peso_nacer, cod_estado_prod_aplomo_corvejon, 
		cod_estado_prod_aplomo_cuartilla, cod_estado_prod_aplomo_cascos, cod_estado_prod_genital_circun_escrotal, 
		cod_estado_prod_genital_prepusio, cod_estado_prod_genital_potencia, cod_estado_prod_genital_semen, 
		cod_estado_prod_observacion_animal, cod_estado_prod_nombre_estado, cod_estado_prod_nombre_tipo_movimiento, 
		cod_estado_prod_nombre_categoria_animal_extern, cod_estado_prod_cod_finca, cod_estado_prod_nombre_finca, 
		cod_estado_prod_nombre_categoria, cod_estado_prod_nombre_categoria_sub, cod_estado_prod_und_inv, 
		cod_estado_prod_descripcion_producto, cod_estado_prod_url_img_producto_min, cod_estado_prod_url_img_producto_orig, 
		cod_estado_prod_nombre_promocion, cod_estado_prod_nombre_promocion_ing, cod_estado_prod_posologia_cantidad, 
		cod_estado_prod_posologia_peso, cod_estado_prod_nombre_tipo_presentacion, cod_estado_prod_nombre_via_administracion, 
		cod_estado_prod_nombre_frec_duracion, cod_estado_prod_subproducto_registrar, cod_estado_prod_subproducto_editar, 
		cod_estado_prod_subproducto_eliminar, cod_estado_prod_subproducto_imprimir, cod_estado_prod_subproducto_exportar, 
		cod_estado_prod_transferencia_registrar, cod_estado_prod_transferencia_editar, cod_estado_prod_transferencia_eliminar, 
		cod_estado_prod_transferencia_imprimir, cod_estado_prod_transferencia_exportar, cod_estado_prod_auditoria_registrar, 
		cod_estado_prod_auditoria_editar, cod_estado_prod_auditoria_eliminar, cod_estado_prod_auditoria_imprimir, cod_estado_prod_auditoria_exportar, 
		cod_estado_eliminar_caja_mesa_virtual, cod_estado_precio_compra_mod_venta, cod_estado_deshabilitar_opc_eliminar_ventatemp, cod_estado_habilitar_btn_facturar_mod_venta,
		cod_estado_habilitar_ver_todas_facturas_vendedores, cod_estado_seguridad, 
		cod_estado_seguridad_registrar, cod_estado_seguridad_editar, 
		cod_estado_seguridad_eliminar, cod_estado_seguridad_imprimir, 
		cod_estado_seguridad_exportar, cod_estado_grafico_estadistico, 
		cod_estado_grafico_estadistico_registrar, cod_estado_grafico_estadistico_editar, 
		cod_estado_grafico_estadistico_eliminar, cod_estado_grafico_estadistico_imprimir, 
		cod_estado_grafico_estadistico_exportar, cod_estado_nota_observacion, 
		cod_estado_nota_observacion_registrar, cod_estado_nota_observacion_editar, 
		cod_estado_nota_observacion_eliminar, cod_estado_nota_observacion_imprimir, 
		cod_estado_nota_observacion_exportar, cod_estado_tipo_roles, 
		cod_estado_tipo_roles_registrar, cod_estado_tipo_roles_editar, 
		cod_estado_tipo_roles_eliminar, cod_estado_tipo_roles_imprimir, 
		cod_estado_tipo_roles_exportar, cod_estado_agregar_productos_a_venta_facturada, 
		cod_estado_eliminar_productos_a_venta_facturada, cod_estado_habilitar_total_venta_ventatemp, 
		cod_estado_habilitar_total_venta_caja_mesa_virtual, cod_estado_habilitar_caja_mesa_virtual_en_uso, 
		cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso, cod_estado_prod_inventario_producto_masivo, 
		cod_estado_prod_transferencia_extern, cod_estado_prod_transferencia_extern_registrar, 
		cod_estado_prod_transferencia_extern_editar, cod_estado_prod_transferencia_extern_eliminar, 
		cod_estado_prod_transferencia_extern_imprimir, cod_estado_prod_transferencia_extern_exportar, 
		cod_estado_categoria, cod_estado_categoria_registrar, 
		cod_estado_categoria_editar, cod_estado_categoria_eliminar, 
		cod_estado_categoria_imprimir, cod_estado_categoria_exportar, 
		cod_estado_caja_mesa, cod_estado_caja_mesa_registrar, 
		cod_estado_caja_mesa_editar, cod_estado_caja_mesa_eliminar, 
		cod_estado_caja_mesa_imprimir, cod_estado_caja_mesa_exportar, 
		cod_estado_usuario_cambiar_contrasena, cod_estado_usuario_cambiar_firma, 
		cod_estado_usuario_permisos_personalizados, cod_estado_usuario_permisos_asignar_matriz, 
		cod_estado_usuario_cambiar_tipo_rol, cod_estado_facturacion_venta_dependencia_user, 
		cod_estado_facturacion_venta_precio_venta_predet_user, cod_estado_facturacion_venta_acceso_facturas_otros_user,
		nombre_tipo_precio_venta_predet_user, numero_precio_user, identificacion_tercero, nombre1_tercero, apellido1_tercero, telefono1_tercero, correo_tercero, 
		total_base_cierre_caja, num_max_caja_mesa_usuario, limite_max_venta_temp_por_caja_mesa_usuario, total_saldo_recarga, url_pag_redirec_ini_sesion, cod_tienda) 
		VALUES ('$cedula', '$nombres', '$apellidos', '$nombre_sexo', '$cuenta', '$contrasena', '$correo', '$cod_seguridad', '$cod_tipo_historia_clinica', '$telefono', 
		'$estilo_css', '$creador', '$fecha_hora', '$fecha', '$reg_medico', 
		'$cod_estado_prod', '$cod_estado_prod_reg_producto', '$cod_estado_prod_asig_subproducto', '$cod_estado_prod_cargar_factura_compra', 
		'$cod_estado_prod_cargar_factura_compra_soporte', '$cod_estado_prod_cargar_factura_compra_observacion', '$cod_estado_prod_transferencia', 
		'$cod_estado_prod_auditoria', '$cod_estado_prod_nuevo_invenario', '$cod_estado_prod_inventario_producto', '$cod_estado_prod_registrar', 
		'$cod_estado_prod_editar', '$cod_estado_prod_eliminar', '$cod_estado_prod_imprimir', '$cod_estado_prod_exportar', 
		'$cod_estado_prod_subproducto', '$cod_estado_prod_und_producto', '$cod_estado_prod_und_producto_bodega', '$cod_estado_prod_precio_compra_producto', 
		'$cod_estado_prod_precio_costo_producto', '$cod_estado_prod_precio_venta_producto', '$cod_estado_prod_precio_venta_producto2', '$cod_estado_prod_precio_venta_producto3', 
		'$cod_estado_prod_precio_venta_producto4', '$cod_estado_prod_precio_venta_producto5', '$cod_estado_prod_nombre_tipo_unidad_medida', '$cod_estado_prod_iva_ptj', 
		'$cod_estado_prod_nombre_tipo_producto', '$cod_estado_prod_cod_marca', '$cod_estado_prod_cod_proveedor', '$cod_estado_prod_cod_tercero', 
		'$cod_estado_prod_cod_estado', '$cod_estado_prod_cod_dependencia', '$cod_estado_prod_fecha_ult_compra', '$cod_estado_prod_fecha_ult_venta', 
		'$cod_estado_prod_fecha_vencimiento', '$cod_estado_prod_tope_min', '$cod_estado_prod_fecha_creacion', '$cod_estado_prod_fecha_modificacion', 
		'$cod_estado_prod_nombre_tipo_precio_venta', '$cod_estado_prod_url_img_orig_producto', '$cod_estado_prod_url_img_min_producto', '$cod_estado_prod_comision_ptj', 
		'$cod_estado_prod_dto1', '$cod_estado_prod_dto2', '$cod_estado_prod_ipc_ptj', '$cod_estado_prod_precio_ipc', 
		'$cod_estado_prod_ret_ica_ptj', '$cod_estado_prod_iva_teorico_ptj', '$cod_estado_prod_tarifa_rete_vigente_ptj', '$cod_estado_prod_rete_iva_asumido_ptj', 
		'$cod_estado_prod_nombre_tipo_compra', '$cod_estado_prod_nombre_tipo_cargue_factura', '$cod_estado_prod_nombre_tipo_medida', '$cod_estado_prod_cajas_sobre', 
		'$cod_estado_prod_und_sobre', '$cod_estado_prod_cod_interno', '$cod_estado_prod_cod_original', '$cod_estado_prod_codificacion', 
		'$cod_estado_prod_cod_producto_serial', '$cod_estado_prod_fecha_mantenimiento', '$cod_estado_prod_peso_producto', 
		'$cod_estado_plan_separe', '$cod_estado_plan_separe_registrar', '$cod_estado_plan_separe_editar', 
		'$cod_estado_plan_separe_eliminar', '$cod_estado_plan_separe_imprimir', '$cod_estado_plan_separe_exportar', 
		'$cod_estado_contabilidad', '$cod_estado_contabilidad_mov_contable', '$cod_estado_contabilidad_mov_contable_registrar', 
		'$cod_estado_contabilidad_mov_contable_editar', '$cod_estado_contabilidad_mov_contable_eliminar', '$cod_estado_contabilidad_mov_contable_imprimir', 
		'$cod_estado_contabilidad_mov_contable_exportar', '$cod_estado_contabilidad_pyg', '$cod_estado_contabilidad_pyg_registrar', 
		'$cod_estado_contabilidad_pyg_editar', '$cod_estado_contabilidad_pyg_eliminar', '$cod_estado_contabilidad_pyg_imprimir', 
		'$cod_estado_contabilidad_pyg_exportar', '$cod_estado_contabilidad_balance', '$cod_estado_contabilidad_balance_pyg_registrar', 
		'$cod_estado_contabilidad_balance_pyg_editar', '$cod_estado_contabilidad_balance_pyg_eliminar', '$cod_estado_contabilidad_balance_pyg_imprimir', 
		'$cod_estado_contabilidad_balance_pyg_exportar', '$cod_estado_contabilidad_puc', '$cod_estado_contabilidad_puc_registrar', 
		'$cod_estado_contabilidad_puc_editar', '$cod_estado_contabilidad_puc_eliminar', '$cod_estado_contabilidad_puc_imprimir', 
		'$cod_estado_contabilidad_puc_exportar', '$cod_estado_facturacion', '$cod_estado_facturacion_venta', 
		'$cod_estado_facturacion_venta_registrar', '$cod_estado_facturacion_venta_editar', '$cod_estado_facturacion_venta_eliminar', 
		'$cod_estado_facturacion_venta_imprimir', '$cod_estado_facturacion_venta_exportar', '$cod_estado_facturacion_venta_devol', 
		'$cod_estado_facturacion_compra', '$cod_estado_facturacion_compra_registrar', '$cod_estado_facturacion_compra_editar', 
		'$cod_estado_facturacion_compra_eliminar', '$cod_estado_facturacion_compra_imprimir', '$cod_estado_facturacion_compra_exportar', 
		'$cod_estado_facturacion_compra_devol', '$cod_estado_facturacion_devol_venta', '$cod_estado_facturacion_devol_inventario', 
		'$cod_estado_cotizacion', '$cod_estado_cotizacion_venta', '$cod_estado_cotizacion_venta_registrar', 
		'$cod_estado_cotizacion_venta_editar', '$cod_estado_cotizacion_venta_eliminar', '$cod_estado_cotizacion_venta_imprimir', 
		'$cod_estado_cotizacion_venta_exportar', '$cod_estado_cotizacion_compra', '$cod_estado_cotizacion_compra_registrar', 
		'$cod_estado_cotizacion_compra_editar', '$cod_estado_cotizacion_compra_eliminar', '$cod_estado_cotizacion_compra_imprimir', 
		'$cod_estado_cotizacion_compra_exportar', '$cod_estado_venta', '$cod_estado_venta_manual', 
		'$cod_estado_venta_barras', '$cod_estado_venta_fecha_venta', '$cod_estado_venta_preventa', 
		'$cod_estado_venta_propina', '$cod_estado_venta_bolsa', '$cod_estado_venta_observacion', 
		'$cod_estado_tercero', '$cod_estado_tercero_registrar', '$cod_estado_tercero_editar', 
		'$cod_estado_tercero_eliminar', '$cod_estado_tercero_imprimir', '$cod_estado_tercero_exportar', 
		'$cod_estado_cita', '$cod_estado_cita_registrar', '$cod_estado_cita_editar', 
		'$cod_estado_cita_eliminar', '$cod_estado_cita_imprimir', '$cod_estado_cita_exportar', 
		'$cod_estado_cuenta', '$cod_estado_cuenta_cobrar', '$cod_estado_cuenta_cobrar_registrar', 
		'$cod_estado_cuenta_cobrar_editar', '$cod_estado_cuenta_cobrar_eliminar', '$cod_estado_cuenta_cobrar_imprimir', 
		'$cod_estado_cuenta_cobrar_exportar', '$cod_estado_cuenta_pagar', '$cod_estado_cuenta_pagar_registrar', 
		'$cod_estado_cuenta_pagar_editar', '$cod_estado_cuenta_pagar_eliminar', '$cod_estado_cuenta_pagar_imprimir', 
		'$cod_estado_cuenta_pagar_exportar', '$cod_estado_cierre_caja', '$cod_estado_cierre_caja_registrar', 
		'$cod_estado_cierre_caja_editar', '$cod_estado_cierre_caja_eliminar', '$cod_estado_cierre_caja_imprimir', 
		'$cod_estado_cierre_caja_exportar', '$cod_estado_egreso', '$cod_estado_egreso_registrar', 
		'$cod_estado_egreso_editar', '$cod_estado_egreso_eliminar', '$cod_estado_egreso_imprimir', 
		'$cod_estado_egreso_exportar', '$cod_estado_sticker_barra', '$cod_estado_sticker_barra_registrar', 
		'$cod_estado_sticker_barra_editar', '$cod_estado_sticker_barra_eliminar', '$cod_estado_sticker_barra_imprimir', 
		'$cod_estado_sticker_barra_exportar', '$cod_estado_sticker_barra_observacion', '$cod_estado_sticker_barra_archivo_plano', 
		'$cod_estado_reporte', '$cod_estado_reporte_venta', '$cod_estado_reporte_venta_registrar', 
		'$cod_estado_reporte_venta_editar', '$cod_estado_reporte_venta_eliminar', '$cod_estado_reporte_venta_imprimir', 
		'$cod_estado_reporte_venta_exportar', '$cod_estado_reporte_compra', '$cod_estado_reporte_compra_registrar', 
		'$cod_estado_reporte_compra_editar', '$cod_estado_reporte_compra_eliminar', '$cod_estado_reporte_compra_imprimir', 
		'$cod_estado_reporte_compra_exportar', '$cod_estado_reporte_general', '$cod_estado_reporte_general_registrar', 
		'$cod_estado_reporte_general_editar', '$cod_estado_reporte_general_eliminar', '$cod_estado_reporte_general_imprimir', 
		'$cod_estado_reporte_general_exportar', '$cod_estado_reporte_mov_contable', '$cod_estado_reporte_mov_contable_registrar', 
		'$cod_estado_reporte_mov_contable_editar', '$cod_estado_reporte_mov_contable_eliminar', '$cod_estado_reporte_mov_contable_imprimir', 
		'$cod_estado_reporte_mov_contable_exportar', '$cod_estado_reporte_venta_por_producto', '$cod_estado_reporte_venta_por_producto_registrar', 
		'$cod_estado_reporte_venta_por_producto_editar', '$cod_estado_reporte_venta_por_producto_eliminar', '$cod_estado_reporte_venta_por_producto_imprimir', 
		'$cod_estado_reporte_venta_por_producto_exportar', '$cod_estado_reporte_inventario', '$cod_estado_reporte_inventario_registrar', 
		'$cod_estado_reporte_inventario_editar', '$cod_estado_reporte_inventario_eliminar', '$cod_estado_reporte_inventario_imprimir', 
		'$cod_estado_reporte_inventario_exportar', '$cod_estado_reporte_prodcuto_vencer', '$cod_estado_reporte_prodcuto_vencer_registrar', 
		'$cod_estado_reporte_prodcuto_vencer_editar', '$cod_estado_reporte_prodcuto_vencer_eliminar', '$cod_estado_reporte_prodcuto_vencer_imprimir', 
		'$cod_estado_reporte_prodcuto_vencer_exportar', '$cod_estado_reporte_prodcuto_mantenimiento', '$cod_estado_reporte_prodcuto_mantenimiento_registrar', 
		'$cod_estado_reporte_prodcuto_mantenimiento_editar', '$cod_estado_reporte_prodcuto_mantenimiento_eliminar', '$cod_estado_reporte_prodcuto_mantenimiento_imprimir', 
		'$cod_estado_reporte_prodcuto_mantenimiento_exportar', '$cod_estado_reporte_cumplanos_tercero', '$cod_estado_reporte_cumplanos_tercero_registrar', 
		'$cod_estado_reporte_cumplanos_tercero_editar', '$cod_estado_reporte_cumplanos_tercero_eliminar', '$cod_estado_reporte_cumplanos_tercero_imprimir', 
		'$cod_estado_reporte_cumplanos_tercero_exportar', '$cod_estado_admin', '$cod_estado_info_empresa', 
		'$cod_estado_info_empresa_registrar', '$cod_estado_info_empresa_editar', '$cod_estado_info_empresa_eliminar', 
		'$cod_estado_info_empresa_imprimir', '$cod_estado_info_empresa_exportar', '$cod_estado_usuario', 
		'$cod_estado_usuario_registrar', '$cod_estado_usuario_editar', '$cod_estado_usuario_eliminar', 
		'$cod_estado_usuario_imprimir', '$cod_estado_usuario_exportar', '$cod_estado_dependencia', 
		'$cod_estado_dependencia_registrar', '$cod_estado_dependencia_editar', '$cod_estado_dependencia_eliminar', 
		'$cod_estado_dependencia_imprimir', '$cod_estado_dependencia_exportar', '$cod_estado_resol_facturacion', 
		'$cod_estado_resol_facturacion_registrar', '$cod_estado_resol_facturacion_editar', '$cod_estado_resol_facturacion_eliminar', 
		'$cod_estado_resol_facturacion_imprimir', '$cod_estado_resol_facturacion_exportar', '$cod_estado_numero_letras', 
		'$cod_estado_numero_letras_registrar', '$cod_estado_numero_letras_editar', '$cod_estado_numero_letras_eliminar', 
		'$cod_estado_numero_letras_imprimir', '$cod_estado_numero_letras_exportar', '$cod_estado_eliminar', 
		'$cod_estado_eliminar_usuario', '$cod_estado_eliminar_tercero', '$cod_estado_eliminar_producto', 
		'$cod_estado_licencia', '$cod_estado_licencia_registrar', '$cod_estado_licencia_editar', 
		'$cod_estado_licencia_imprimir', '$cod_estado_licencia_exportar', '$cod_estado_repositorio', 
		'$cod_estado_repositorio_registrar', '$cod_estado_repositorio_editar', '$cod_estado_repositorio_eliminar', 
		'$cod_estado_repositorio_imprimir', '$cod_estado_repositorio_exportar', '$cod_estado_prod_cod_rodeo', 
		'$cod_estado_prod_nombre_rodeo', '$cod_estado_prod_nombre_sexo', '$cod_estado_prod_de_monta', 
		'$cod_estado_prod_nombre_estatus', '$cod_estado_prod_nombre_condicion_corporal', '$cod_estado_prod_nombre_categoria_ingreso', 
		'$cod_estado_prod_nombre_categoria_actual', '$cod_estado_prod_nombre_categoria_futura', '$cod_estado_prod_nombre_procedencia', 
		'$cod_estado_prod_nombre_tipo_monta', '$cod_estado_prod_nombre_lote_categoria', '$cod_estado_prod_nombre_prog_reproductivo', 
		'$cod_estado_prod_nombre_potrero', '$cod_estado_prod_nombre_lote', '$cod_estado_prod_nombre_calidad_animal', 
		'$cod_estado_prod_nombre_tipo_explotacion', '$cod_estado_prod_peso_compra', '$cod_estado_prod_precio_compra', 
		'$cod_estado_prod_fecha_nac', '$cod_estado_prod_fecha_compra', '$cod_estado_prod_fecha_castracion', 
		'$cod_estado_prod_nro_hierros', '$cod_estado_prod_hierro_animal', '$cod_estado_prod_numero_partos', 
		'$cod_estado_prod_id_electronica', '$cod_estado_prod_nombre_raza1', '$cod_estado_prod_nombre_raza2', 
		'$cod_estado_prod_nombre_raza3', '$cod_estado_prod_nombre_raza4', '$cod_estado_prod_ptj_raza1', 
		'$cod_estado_prod_ptj_raza2', '$cod_estado_prod_ptj_raza3', '$cod_estado_prod_ptj_raza4', 
		'$cod_estado_prod_id_padre', '$cod_estado_prod_raza_padre', '$cod_estado_prod_id_madre', 
		'$cod_estado_prod_raza_madre', '$cod_estado_prod_partos_madre', '$cod_estado_prod_id_abuelo_paterno', 
		'$cod_estado_prod_id_abuelo_materno', '$cod_estado_prod_nombre_abuelo_paterno', '$cod_estado_prod_nombre_abuelo_materno', 
		'$cod_estado_prod_raza_abuelo_paterno', '$cod_estado_prod_raza_abuelo_materno', '$cod_estado_prod_id_abuela_paterno', 
		'$cod_estado_prod_id_abuela_materno', '$cod_estado_prod_nombre_abuela_paterno', '$cod_estado_prod_nombre_abuela_materno', 
		'$cod_estado_prod_raza_abuela_paterno', '$cod_estado_prod_raza_abuela_materno', '$cod_estado_prod_nombre_tipo_concepcion', 
		'$cod_estado_prod_nombre_especie', '$cod_estado_prod_marcas_tatuado', '$cod_estado_prod_marcas_herrado', 
		'$cod_estado_prod_marcas_descornado', '$cod_estado_prod_marcas_castrado', '$cod_estado_prod_nombre_color', 
		'$cod_estado_prod_nombre_temperamento', '$cod_estado_prod_peso_nacer', '$cod_estado_prod_aplomo_corvejon', 
		'$cod_estado_prod_aplomo_cuartilla', '$cod_estado_prod_aplomo_cascos', '$cod_estado_prod_genital_circun_escrotal', 
		'$cod_estado_prod_genital_prepusio', '$cod_estado_prod_genital_potencia', '$cod_estado_prod_genital_semen', 
		'$cod_estado_prod_observacion_animal', '$cod_estado_prod_nombre_estado', '$cod_estado_prod_nombre_tipo_movimiento', 
		'$cod_estado_prod_nombre_categoria_animal_extern', '$cod_estado_prod_cod_finca', '$cod_estado_prod_nombre_finca', 
		'$cod_estado_prod_nombre_categoria', '$cod_estado_prod_nombre_categoria_sub', '$cod_estado_prod_und_inv', 
		'$cod_estado_prod_descripcion_producto', '$cod_estado_prod_url_img_producto_min', '$cod_estado_prod_url_img_producto_orig', 
		'$cod_estado_prod_nombre_promocion', '$cod_estado_prod_nombre_promocion_ing', '$cod_estado_prod_posologia_cantidad', 
		'$cod_estado_prod_posologia_peso', '$cod_estado_prod_nombre_tipo_presentacion', '$cod_estado_prod_nombre_via_administracion', 
		'$cod_estado_prod_nombre_frec_duracion', '$cod_estado_prod_subproducto_registrar', '$cod_estado_prod_subproducto_editar', 
		'$cod_estado_prod_subproducto_eliminar', '$cod_estado_prod_subproducto_imprimir', '$cod_estado_prod_subproducto_exportar', 
		'$cod_estado_prod_transferencia_registrar', '$cod_estado_prod_transferencia_editar', '$cod_estado_prod_transferencia_eliminar', 
		'$cod_estado_prod_transferencia_imprimir', '$cod_estado_prod_transferencia_exportar', '$cod_estado_prod_auditoria_registrar', 
		'$cod_estado_prod_auditoria_editar', '$cod_estado_prod_auditoria_eliminar', '$cod_estado_prod_auditoria_imprimir', '$cod_estado_prod_auditoria_exportar', 
		'$cod_estado_eliminar_caja_mesa_virtual', '$cod_estado_precio_compra_mod_venta', '$cod_estado_deshabilitar_opc_eliminar_ventatemp', '$cod_estado_habilitar_btn_facturar_mod_venta',
		'$cod_estado_habilitar_ver_todas_facturas_vendedores', '$cod_estado_seguridad', 
		'$cod_estado_seguridad_registrar', '$cod_estado_seguridad_editar', 
		'$cod_estado_seguridad_eliminar', '$cod_estado_seguridad_imprimir', 
		'$cod_estado_seguridad_exportar', '$cod_estado_grafico_estadistico', 
		'$cod_estado_grafico_estadistico_registrar', '$cod_estado_grafico_estadistico_editar', 
		'$cod_estado_grafico_estadistico_eliminar', '$cod_estado_grafico_estadistico_imprimir', 
		'$cod_estado_grafico_estadistico_exportar', '$cod_estado_nota_observacion', 
		'$cod_estado_nota_observacion_registrar', '$cod_estado_nota_observacion_editar', 
		'$cod_estado_nota_observacion_eliminar', '$cod_estado_nota_observacion_imprimir', 
		'$cod_estado_nota_observacion_exportar', '$cod_estado_tipo_roles', 
		'$cod_estado_tipo_roles_registrar', '$cod_estado_tipo_roles_editar', 
		'$cod_estado_tipo_roles_eliminar', '$cod_estado_tipo_roles_imprimir', 
		'$cod_estado_tipo_roles_exportar', '$cod_estado_agregar_productos_a_venta_facturada', 
		'$cod_estado_eliminar_productos_a_venta_facturada', '$cod_estado_habilitar_total_venta_ventatemp', 
		'$cod_estado_habilitar_total_venta_caja_mesa_virtual', '$cod_estado_habilitar_caja_mesa_virtual_en_uso', 
		'$cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso', '$cod_estado_prod_inventario_producto_masivo', 
		'$cod_estado_prod_transferencia_extern', '$cod_estado_prod_transferencia_extern_registrar', 
		'$cod_estado_prod_transferencia_extern_editar', '$cod_estado_prod_transferencia_extern_eliminar', 
		'$cod_estado_prod_transferencia_extern_imprimir', '$cod_estado_prod_transferencia_extern_exportar', 
		'$cod_estado_categoria', '$cod_estado_categoria_registrar', 
		'$cod_estado_categoria_editar', '$cod_estado_categoria_eliminar', 
		'$cod_estado_categoria_imprimir', '$cod_estado_categoria_exportar', 
		'$cod_estado_caja_mesa', '$cod_estado_caja_mesa_registrar', 
		'$cod_estado_caja_mesa_editar', '$cod_estado_caja_mesa_eliminar', 
		'$cod_estado_caja_mesa_imprimir', '$cod_estado_caja_mesa_exportar', 
		'$cod_estado_usuario_cambiar_contrasena', '$cod_estado_usuario_cambiar_firma', 
		'$cod_estado_usuario_permisos_personalizados', '$cod_estado_usuario_permisos_asignar_matriz', 
		'$cod_estado_usuario_cambiar_tipo_rol', '$cod_estado_facturacion_venta_dependencia_user', 
		'$cod_estado_facturacion_venta_precio_venta_predet_user', '$cod_estado_facturacion_venta_acceso_facturas_otros_user',
		'$nombre_tipo_precio_venta_predet_user', '$numero_precio_user', '$identificacion_tercero', '$nombre1_tercero', '$apellido1_tercero', '$telefono1_tercero', '$correo_tercero', 
		'$total_base_cierre_caja', '$num_max_caja_mesa_usuario', '$limite_max_venta_temp_por_caja_mesa_usuario', '$total_saldo_recarga', '$url_pag_redirec_ini_sesion', '$cod_tienda')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_usuario.php">
<?php } } } ?>
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