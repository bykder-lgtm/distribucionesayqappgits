<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('lista_caja_virtual_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>


<?php if ($cod_estado_posicion_mapa_gps_pedidos_info_venta_global=='1') { ?>
<style>#mostrar_mapa { height: 50%; width: 50%; }</style>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDZCPrONtmISsx6oRvVyxMtRdEVk7RHle0"></script>
<?php } ?>

</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<!--<div id="contentOuterSeparator"></div>-->
<div class="container">
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/facturacion_venta_temporal_producto_manual_pos.php"><h4><?php echo $nombre_concepto_multi_virtual; ?>S VIRTUALES</a>
</div>
<hr>
-->
<div class="row-fluid no-gutters">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<?php //include_once("../admin/ver_modal_mapa_domicilio.php"); ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_GET['modo_venta_por_defecto'])) { $modo_venta_por_defecto = addslashes($_GET['modo_venta_por_defecto']); } else { $modo_venta_por_defecto = $modo_venta_por_defecto_global; }
if (isset($_GET['caja_mesa']) && ($_GET['caja_mesa'] <> '')) {  $caja_mesa = ($_GET['caja_mesa']); $filtro_buscar_mesa = "AND (cod_base_caja = '$caja_mesa')"; } else { $caja_mesa = ''; $filtro_buscar_mesa = ""; }
$pagina_local        = $_SERVER['PHP_SELF'];

if ($cod_seguridad == "1") {
    $sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA')";
    $consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
    $datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

    $sql_domicilio = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2')";
    $consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
    $total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

    $sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal";
    $consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
    $datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
} else {
    $sql_mesa_caja_uso = "SELECT COUNT(cod_caja_virtual) AS total_caja_mesa_en_uso FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_administrador = '$cod_administrador')";
    $consulta_mesa_caja_uso = mysqli_query($conectar, $sql_mesa_caja_uso);
    $datos_mesa_caja_uso = mysqli_fetch_assoc($consulta_mesa_caja_uso);

    $sql_domicilio = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_tipo_metodo_envio = '2') AND (cod_administrador = '$cod_administrador')";
    $consulta_domicilio = mysqli_query($conectar, $sql_domicilio);
    $total_reg_domicilio = mysqli_num_rows($consulta_domicilio);

    $sql_datos_venta_temp_total_sup = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_administrador = '$cod_administrador')";
    $consulta_datos_venta_temp_total_sup = mysqli_query($conectar, $sql_datos_venta_temp_total_sup);
    $datos_venta_temp_total_sup = mysqli_fetch_assoc($consulta_datos_venta_temp_total_sup);
    }
    $total_caja_mesa_en_uso                 = $datos_mesa_caja_uso['total_caja_mesa_en_uso'];
    $total_venta_producto_sup               = $datos_venta_temp_total_sup['total_venta_producto'];

?>
<div class="table-responsive">
<form method="GET" name="formulario" action="">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="shop-cat-box">
                <a class="nav-item active" href="#"><input type="number" name="caja_mesa" id="caja_mesa" value="<?php echo $caja_mesa; ?>" style="height:26;" placeholder="<?php echo $nombre_concepto_multi_virtual; ?>" autofocus/><input type="submit" class="btn hvr-hover nav-item active jumbotron"  value="Buscar" /></a>
                <a class="btn hvr-hover nav-item active jumbotron" href="../admin/crear_caja_virtual_sesion.php?pagina=<?php echo $pagina ?>">CREAR NUEVA <?php echo $nombre_concepto_multi_virtual; ?></a>
                <a class="btn hvr-hover nav-item active jumbotron" href="../admin/facturacion_venta_temporal_producto_manual_pos.php"><?php echo $nombre_concepto_multi_virtual; ?>S VIRTUALES</a>
                <a class="btn hvr-hover nav-item active jumbotron" href="../admin/reporte_descargar_excel_caja_virtual_temporal.php">Descargar Excel</a>
            </div>
        </div>
    </div>
</div>
</form>



<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="shop-cat-box">
                <?php if ($cod_estado_habilitar_caja_mesa_virtual_en_uso == '0') { ?>
                <a class="btn nav-item active" href="../admin/lista_caja_virtual_mesa_vendedor.php" class="nav-link"><?php echo $nombre_concepto_multi_virtual; ?>S EN USO</a>
                <?php } ?>
                <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
                <a class="btn nav-item active" href="#" class="nav-link">TOTAL VENTA</a>
                <?php } ?>
                <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
                <a class="btn nav-item active" href="#" class="nav-link">DOMICILIOS</a>
                <?php } ?>
            </div>

            <div class="shop-cat-box">
                <?php if ($cod_estado_habilitar_caja_mesa_virtual_en_uso == '0') { ?>
                <a class="btn nav-item active nav-link" href="#"><div id="total_caja_mesa_en_uso_ajax"><?php echo str_pad($total_caja_mesa_en_uso, 12, "_", STR_PAD_BOTH); ?></div></a>
                <?php } ?>
                <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
                <a class="btn nav-item active nav-link" href="#"><div id="total_venta_producto_sup_ajax"><?php echo str_pad(number_format($total_venta_producto_sup, 0, ",", "."), 12, "_", STR_PAD_BOTH); ?></div></a>
                <?php } ?>
                <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
                <a class="btn nav-item active nav-link" href="#"><div id="total_reg_domicilio_ajax"><?php echo str_pad($total_reg_domicilio, 12, "_", STR_PAD_BOTH); ?></div></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<div id="salida_tabla_caja_mesa_ajax">
<table class="table table-hover">
<tr>
<?php if ($cod_seguridad == '1') { ?>
    <?php if ($cod_estado_revisado_venta_temporal_global == '1') { ?>
        <th style="text-align:center;">.......</th>
    <?php } ?>
<?php } ?>

<?php if ($cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global=='1') { ?>
    <th style="text-align:center;">....</th>
<?php } ?>

<th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
<th style="text-align:center;">USUARIO</th>
<th style="text-align:center;">DESCRIPCION</th>
<th style="text-align:center;"></th>
<th style="text-align:center;"></th>

<?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?>
    <th style="text-align:center;">PRIORIDAD</th>
<?php } ?>

<?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual == '0') { ?>
    <th style="text-align:center;">TOTAL VENTA</th>
<?php } ?>

<?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
    <th style="text-align:center;">ENVIO</th>
<?php } ?>

<th style="text-align:center;">CLIENTE</th>
<th style="text-align:center;">FECHA | HORA</th>
<th style="text-align:center;">APP</th>

<?php if ($cod_estado_posicion_mapa_gps_pedidos_info_venta_global == '1') { ?>
    <th style="text-align:center;">MAPA</th>
<?php } ?>

<th style="text-align:center;">TVV</th>
<th style="text-align:center;">ID</th>

<?php if ($cod_estado_eliminar_caja_mesa_virtual=='1') { ?>
    <th style="text-align:center;">ELIM</th>
<?php } ?>

</tr>
<?php
if ($cod_estado_ordenar_por_fecha_modificacion_caja_mesa_global == '1') { $ordenar_consulta = 'ORDER BY fecha_modificacion DESC'; } else { $ordenar_consulta = 'ORDER BY cod_prioridad'; }
if ($limite_mostrar_producto_lista_caja_virtual == '0') { $limite_mostrar_registro = ''; } else { $limite_mostrar_registro = 'LIMIT 0,'.$limite_mostrar_producto_lista_caja_virtual; }

$nombre_producto_concat             = '';

if (($cod_seguridad == '1') || ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1')) {
    $mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
    nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
    cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud, cod_estado_revisado_notificacion_vendedor, observacion_tercero, 
    cod_domiciliario, descripcion_tipo_forma_pago FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') $filtro_buscar_mesa $ordenar_consulta";
} else {
    $mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, cod_estado_revisado, 
    nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, fecha_modificacion, 
    cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, observacion, latitud, longitud, latitud_longitud, cod_estado_revisado_notificacion_vendedor, observacion_tercero, 
    cod_domiciliario, descripcion_tipo_forma_pago FROM tbl15_info_factura_venta WHERE (cuenta = '$cuenta_actual') AND (nombre_estado_factura = 'ABIERTA') $filtro_buscar_mesa $ordenar_consulta";
}
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $nombre_producto_concat                            = '';
    $cod_info_factura_venta                            = $datos['cod_info_factura_venta'];
    $cod_caja_virtual                                  = $datos['cod_caja_virtual'];
    $cuenta                                            = $datos['cuenta'];
    $cod_tercero                                       = $datos['cod_tercero'];
    $fecha_anyo                                        = $datos['fecha_anyo'];
    $fecha_hora                                        = $datos['fecha_hora'];
    $cod_administrador                                 = $datos['cod_administrador'];
    $cod_prioridad                                     = $datos['cod_prioridad'];
    $cod_base_caja                                     = $datos['cod_base_caja'];
    $nombre1_tercero                                   = $datos['nombre1_tercero'];
    $nombre2_tercero                                   = $datos['nombre2_tercero'];
    $apellido1_tercero                                 = $datos['apellido1_tercero'];
    $apellido2_tercero                                 = $datos['apellido2_tercero'];
    $identificacion_tercero                            = $datos['identificacion_tercero'];
    $fecha_nac_tercero                                 = $datos['fecha_nac_tercero'];
    $direccion_tercero                                 = $datos['direccion_tercero'];
    $telefono1_tercero                                 = $datos['telefono1_tercero'];
    $correo_tercero                                    = $datos['correo_tercero'];
    $cod_estado_revisado                               = $datos['cod_estado_revisado'];
    $cod_tipo_metodo_envio                             = $datos['cod_tipo_metodo_envio'];
    $cod_tipo_aplicacion                               = $datos['cod_tipo_aplicacion'];
    $cod_zona_envio                                    = $datos['cod_zona_envio'];
    $observacion_db                                    = $datos['observacion'];
    $latitud                                           = $datos['latitud'];
    $longitud                                          = $datos['longitud'];
    $latitud_longitud                                  = $datos['latitud_longitud'];
    $cod_estado_revisado_notificacion_vendedor         = $datos['cod_estado_revisado_notificacion_vendedor'];
    $observacion_tercero                               = $datos['observacion_tercero'];
    $cod_domiciliario                                  = $datos['cod_domiciliario'];
    $descripcion_tipo_forma_pago                       = $datos['descripcion_tipo_forma_pago'];

    if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
    if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }
    if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

    $sql_info_factura_venta = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $nombre1_tercero                    = $datos_info_factura_venta['nombre1_tercero'];
    $nombre2_tercero                    = $datos_info_factura_venta['nombre2_tercero'];
    $apellido1_tercero                  = $datos_info_factura_venta['apellido1_tercero'];
    $apellido2_tercero                  = $datos_info_factura_venta['apellido2_tercero'];

    $cliente                            = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

    $sql_info_usuario = "SELECT cuenta, nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $consulta_info_usuario = mysqli_query($conectar, $sql_info_usuario);
    $datos_info_usuario = mysqli_fetch_assoc($consulta_info_usuario);

    $nombres                            = $datos_info_usuario['nombres'];
    $apellidos                          = $datos_info_usuario['apellidos'];
    $nombre_usuario                     = $nombres.' '.$apellidos;
    $cuenta_usuario                     = $datos_info_usuario['cuenta'];

    $sql_datos_venta_temp = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, nombre_producto, cod_estado_revisado, comentario_producto 
    FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto_temporal DESC $limite_mostrar_registro";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_venta_con                       = $datos_venta_temp['und_venta'];
        $cod_estado_revisado_con             = $datos_venta_temp['cod_estado_revisado'];
        $comentario_producto_con             = $datos_venta_temp['comentario_producto'];

        if ($cod_estado_marcado_revisado_caja_mesa_venta_temporal_global == '1') {
            if ($cod_estado_revisado_con == '0') { $nombre_producto_concat .= "<mark>".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.' |*| </mark><br>'; } else { $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.' |*| <br>'; }
        } else { $nombre_producto_concat .= "".intval($und_venta_con)." | ".$nombre_producto_con.' | '.$comentario_producto_con.' |*| <br>'; }

    }
    if ($tipo_dispositivo_encontrado <> 'PC') { $nombre_producto_concat = substr($nombre_producto_concat, 0, 20); }

    $sql_datos_venta_temp_total = "SELECT SUM(total_venta_producto) AS total_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_datos_venta_temp_total = mysqli_query($conectar, $sql_datos_venta_temp_total);
    $datos_venta_temp_total = mysqli_fetch_assoc($consulta_datos_venta_temp_total);

    $total_venta_producto_ciclo                = $datos_venta_temp_total['total_venta_producto'];


    $sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    $consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio);
    $datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio                  = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];


    $sql_tipo_aplicacion = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE (cod_tipo_aplicacion = '$cod_tipo_aplicacion')";
    $consulta_tipo_aplicacion = mysqli_query($conectar, $sql_tipo_aplicacion);
    $datos_tipo_aplicacion = mysqli_fetch_assoc($consulta_tipo_aplicacion);

    $nombre_tipo_aplicacion                    = $datos_tipo_aplicacion['nombre_tipo_aplicacion'];


    $sql_zona_envio = "SELECT nombre_zona_envio FROM tbl15_zona_envio WHERE (cod_zona_envio = '$cod_zona_envio')";
    $consulta_zona_envio = mysqli_query($conectar, $sql_zona_envio);
    $datos_zona_envio = mysqli_fetch_assoc($consulta_zona_envio);

    $nombre_zona_envio                         = $datos_zona_envio['nombre_zona_envio'];

    $sql_vendedor_domiciliario = "SELECT nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE cod_domiciliario = '$cod_domiciliario'";
    $consulta_vendedor_domiciliario = mysqli_query($conectar, $sql_vendedor_domiciliario) or die(mysqli_error($conectar));
    $datos_vendedor_domiciliario = mysqli_fetch_assoc($consulta_vendedor_domiciliario);

    $nombres_domiciliario                  = $datos_vendedor_domiciliario['nombres_domiciliario'].' '.$datos_vendedor_domiciliario['apellidos_domiciliario'];

    if ($cod_base_caja == '0') { $cod_base_caja = 'DOMICILIO'; } else { $cod_base_caja = $cod_base_caja; }
?>
<tr>
<?php if ($cod_seguridad == '1') { ?>
    <?php if ($cod_estado_revisado_venta_temporal_global == '1') { ?>
        <td style="text-align:center;"><?php echo $img_estado_revisado ?></td>
    <?php } ?>
<?php } ?>

<?php if ($cod_estado_aviso_alerta_timbre_vendedor_pedido_cocina_global=='1') { 
    if ($cod_estado_revisado_notificacion_vendedor == '1') {
        $url_desactivar_timbre_aviso = '../admin/desactivar_timbre_aviso_reg.php?cod_info_factura_venta='.$cod_info_factura_venta.'&pagina='.$pagina_local;
        $imagen_desactivar_timbre_aviso = '../imagenes/desactivar_timbre_aviso.gif';
        $mostrar_objeto_desactivar_timbre_aviso = '<a href="'.$url_desactivar_timbre_aviso.'"><img src='.$imagen_desactivar_timbre_aviso.'></a>';
    } else {
        $url_desactivar_timbre_aviso = '';
        $imagen_desactivar_timbre_aviso = '';
        $mostrar_objeto_desactivar_timbre_aviso = '';
    }
    ?>
    <th style="text-align:center;"><?php echo $mostrar_objeto_desactivar_timbre_aviso ?></th>
<?php } ?>

<td style="text-align:center;"><h3><?php echo $cod_base_caja;?></h3></td>

<td style="text-align:left;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $cuenta_usuario; ?></a></td>
<td style="text-align:left;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $nombre_producto_concat.$observacion; ?></a></td>
<td style="text-align:left;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $nombres_domiciliario; ?></a></td>
<td style="text-align:left;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $observacion_tercero; ?></a></td>

<?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?>
    <td style="text-align:center;"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_prioridad', <?php echo $cod_info_factura_venta;?>)" id="<?php echo $cod_info_factura_venta;?>" value="<?php echo $cod_prioridad;?>" class="input-block-level" style="width: 60px;"></td>
<?php } ?>

<?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual == '0') { ?>
    <td style="text-align:center;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo number_format($total_venta_producto_ciclo, 0, ",", "."); ?></a></td>
<?php } ?>

<?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $nombre_tipo_metodo_envio; ?></a></td>
<?php } ?>

<td style="text-align:left;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $cliente.$nombre_cliente_visitante; ?></a></td>
<td style="text-align:center;"><a href="../admin/entrar_sesion_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>&pagina=<?php echo $pagina ?>"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></a></td>
<td style="text-align:center;"><?php echo $nombre_tipo_aplicacion ?></td>

<?php if ($cod_estado_posicion_mapa_gps_pedidos_info_venta_global == '1') { ?>
    <td style="text-align:center"><a href="#" class='' title='Editar' onclick="obtener_datos_mapa_modal('<?php echo $cod_info_factura_venta;?>');" data-toggle="modal" data-target=".abrir_modal_mapa_visita"><img src="../imagenes/btn_mapa.png" class="img-polaroid" alt=""></a></td>
<?php } ?>

<td style="text-align:center;"><?php echo $descripcion_tipo_forma_pago ?></td>
<td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>

<?php if ($cod_estado_eliminar_caja_mesa_virtual=='1') { ?>
    <td style="text-align:center;"><a href="../admin/eliminar_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>&pagina_remota=<?php echo $pagina ?>"><img src=../imagenes/eliminar.png alt="eliminar"></td>
<?php } ?>

</tr>
<?php } ?>
</table>
</div>
</div>
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

<script language="javascript">
setInterval("refrescar_pagina_ajax()",5000);

function refrescar_pagina_ajax(){

	var nombre_estado_factura = 'ABIERTA';
	var cod_estado_cocina = '0';
	var tipo_ajax = 'refrescar';
    var pagina = '<?php echo $pagina_local ?>';
    var pagina_redirect = '<?php echo $pagina ?>';
    var caja_mesa = $('#caja_mesa').val();
    var cod_administrador = '<?php echo $cod_administrador ?>';
    var cuenta_actual = '<?php echo $cuenta_actual ?>';
    var modo_venta_por_defecto = '<?php echo $modo_venta_por_defecto ?>';

    var datos_url_ajax = 'nombre_estado_factura='+nombre_estado_factura+'&'+'cod_estado_cocina='+cod_estado_cocina+'&'+'tipo_ajax='+tipo_ajax+'&'+'caja_mesa='+caja_mesa+'&'+'cuenta_actual='+cuenta_actual+'&'+'cod_administrador='+cod_administrador+'&'+'modo_venta_por_defecto='+modo_venta_por_defecto+'&'+'pagina='+pagina+'&'+'pagina_redirect='+pagina_redirect;

    $.ajax({
        type: "POST",
        url: "../admin/refrescar_pagina_caja_virtual_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            //var carrito_compra_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
            var salida_tabla_caja_mesa_ajax = respuesta.salida_tabla_caja_mesa_ajax;
            var total_caja_mesa_en_uso_ajax = respuesta.total_caja_mesa_en_uso_ajax;
            var total_venta_producto_sup_ajax = respuesta.total_venta_producto_sup_ajax;
            var total_reg_domicilio_ajax = respuesta.total_reg_domicilio_ajax;

            $('#total_caja_mesa_en_uso_ajax').html(total_caja_mesa_en_uso_ajax);
            $('#total_venta_producto_sup_ajax').html(total_venta_producto_sup_ajax);
            $('#salida_tabla_caja_mesa_ajax').html(salida_tabla_caja_mesa_ajax);
            $('#total_reg_domicilio_ajax').html(total_reg_domicilio_ajax);

        }
    });

}
</script>
<!-- *********************************************************************************************** -->
<!-- *********************************************************************************************** -->
<?php if ($cod_estado_posicion_mapa_gps_pedidos_info_venta_global=='1') { ?>
<script>
function obtener_datos_mapa_modal(id){

    var cod_info_factura_venta = id;
    var tipo_ajax = 'consultar';
    var pagina = '<?php echo $pagina_local ?>';
    var pagina_redirect = '<?php echo $pagina ?>';
    var datos_url_ajax = 'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina+'&'+'pagina_redirect='+pagina_redirect;

    $.ajax({
        type: "POST",
        url: "../admin/consultar_posicion_gps_domicilio_info_factura_venta_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            //var carrito_compra_temporal_total_reg = respuesta.salida_info_actualizada_carrito_compra_menu_total_reg_ajax;
            var cod_info_factura_venta = respuesta.cod_info_factura_venta;
            var nombre1_tercero = respuesta.nombre1_tercero;
            var telefono1_tercero = respuesta.telefono1_tercero;
            var direccion_tercero = respuesta.direccion_tercero;
            var correo_tercero = respuesta.correo_tercero;
            var latitud = respuesta.latitud;
            var longitud = respuesta.longitud;
            var latitud_longitud = respuesta.latitud_longitud;
            var nombre_pais = "";
            var region = "";
            var nombre_ubicacion = 'Ubicacion de: ('+nombre1_tercero+')'+' - '+'('+direccion_tercero+')';
            var url_mapa_ext = '<a href="https://www.google.com/maps/search/?api=1&query='+latitud_longitud+'" target="_blank">Ver ubicacion en el mapa</a>';

            $('#url_mapa_ext').html(url_mapa_ext);
            //$('#cod_info_factura_venta').html(cod_info_factura_venta);
            //$('#telefono1_tercero').html(telefono1_tercero);
            //$('#correo_tercero').html(correo_tercero);
            //$("#mod_"+"cod_info_factura_venta").val(id);

            function showGoogleMaps() {
                var coordenadas_mapa = new google.maps.LatLng(latitud, longitud);
                var myOptions = { zoom: 15,  center: coordenadas_mapa,  mapTypeId: google.maps.MapTypeId.ROADMAP };
                var mapa_crear = new google.maps.Map(document.getElementById("mostrar_mapa"),  myOptions);
                var marker = new google.maps.Marker({ position:coordenadas_mapa, map: mapa_crear, title: nombre_ubicacion });
            }
            showGoogleMaps();

        }
    });
}
</script>
<?php } ?>
