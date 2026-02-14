<?php include_once('../admin/01_modulo_diseno_superior_aplicacion_tv.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once('../admin/02_modulo_estilo_css_aplicacion_tv.php'); ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
          <?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">

            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <h5 class="text-primary">App Tv</h5>
            </nav>
<?php
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; }
if (isset($_REQUEST['pagina_redirect'])) { $pagina_redirect = 'lista_caja_virtual_cocina_aplicacion_tv.php'; } else { $pagina_redirect = 'lista_caja_virtual_cocina_aplicacion_tv.php'; }
$ordenar_consulta = 'ORDER BY cod_prioridad';

$pagina_local        = $_SERVER['PHP_SELF'];

if (($cod_origen_produccion_user == '1') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //1 ES COCINA
    $condic_estado_info = "AND (cod_estado_cocina = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_cocina = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '2') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //2 ES BARTENDER
    $condic_estado_info = "AND (cod_estado_bartender = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_bartender = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
elseif (($cod_origen_produccion_user == '3') && ($cod_estado_filtro_aplicacion_chef_bartender_global == '1')) { //3 ES JUGUERIA
    $condic_estado_info = "AND (cod_estado_jugueria = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_jugueria = '0')"; 
    $condic_origen_produccion_user = "AND (cod_origen_produccion = '".$cod_origen_produccion_user."')"; 
} 
else { 
    $condic_estado_info = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_estado_venta_temp = "AND (cod_estado_revisado_universal = '0')"; 
    $condic_origen_produccion_user = ""; 
}
?>
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="text-primary"><?php echo $nombre_concepto_multi_virtual; ?>S POR ATENDER</h3>
                            <div class="table-responsive">

                                <div id="salida_tabla_caja_mesa_ajax">
                                    <table class="table table-dark table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
                                                <th style="text-align:center;">USUARIO</th>
                                                <th style="text-align:center;">DESCRIPCION</th>
                                                <th style="text-align:center;"></th>
                                                <th style="text-align:center;">FECHA HORA</th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><th style="text-align:center;">PRIORIDAD</th><?php } ?>
                                                <!--<th style="text-align:center;">FECHA | HORA</th>-->
                                                <th style="text-align:center;">ATENDIDO</th>
                                                <th style="text-align:center;">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$nombre_producto_concat             = '';
$nombre_producto_con                = '';
$salida_tra                         = '';
$increment                          = 0;

$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE ('1'='1') $condic_origen_produccion_user $condic_estado_venta_temp ORDER BY cod_venta_producto_temporal ASC";
$resul_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
$existen_reg = mysqli_num_rows($resul_venta_producto_temporal);
while ($venta_producto_temporal = mysqli_fetch_assoc($resul_venta_producto_temporal)) {

    $cod_venta_producto_temporal                    = $venta_producto_temporal['cod_venta_producto_temporal'];
    $cod_info_factura_venta                         = $venta_producto_temporal['cod_info_factura_venta'];
    $cod_caja_virtual                               = $venta_producto_temporal['cod_caja_virtual'];
    $cuenta                                         = $venta_producto_temporal['cuenta'];
    $cod_administrador                              = $venta_producto_temporal['cod_administrador'];

    $nombre_producto                                = $venta_producto_temporal['nombre_producto'];
    $und_venta                                      = $venta_producto_temporal['und_venta'];
    $comentario_producto                            = $venta_producto_temporal['comentario_producto'];
    $cod_origen_produccion                          = $venta_producto_temporal['cod_origen_produccion'];
    $cod_estado_revisado                            = $venta_producto_temporal['cod_estado_revisado'];
    $cod_estado_revisado_cocina                     = $venta_producto_temporal['cod_estado_revisado_cocina'];
    $cod_estado_revisado_bartender                  = $venta_producto_temporal['cod_estado_revisado_bartender'];
    $cod_estado_revisado_jugueria                   = $venta_producto_temporal['cod_estado_revisado_jugueria'];
    $fecha_seg_venta_producto                       = $venta_producto_temporal['fecha_seg_venta_producto'];
    $fecha_hora_cargue                              = date("Y-m-d H:i:s", $fecha_seg_venta_producto);

    $mostrar_datos_sql = "SELECT cod_caja_virtual, cuenta, cod_info_factura_venta, cod_tercero, fecha_anyo, cod_administrador, fecha_hora, cod_prioridad, cod_base_caja, observacion, 
    nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, correo_tercero, 
    cod_estado_revisado, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, latitud, longitud, latitud_longitud, 
    cod_estado_revisado_cocina, cod_estado_revisado_bartender, cod_estado_revisado_jugueria
    FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta = mysqli_query($conectar, $mostrar_datos_sql);
    $datos = mysqli_fetch_assoc($consulta);

    $cod_tercero                                    = $datos['cod_tercero'];
    $fecha_anyo                                     = $datos['fecha_anyo'];
    $fecha_hora                                     = $datos['fecha_hora'];
    $cod_prioridad                                  = $datos['cod_prioridad'];
    $cod_base_caja                                  = $datos['cod_base_caja'];

    $nombre1_tercero                                = $datos['nombre1_tercero'];
    $nombre2_tercero                                = $datos['nombre2_tercero'];
    $apellido1_tercero                              = $datos['apellido1_tercero'];
    $apellido2_tercero                              = $datos['apellido2_tercero'];
    $identificacion_tercero                         = $datos['identificacion_tercero'];
    $fecha_nac_tercero                              = $datos['fecha_nac_tercero'];
    $direccion_tercero                              = $datos['direccion_tercero'];
    $telefono1_tercero                              = $datos['telefono1_tercero'];
    $correo_tercero                                 = $datos['correo_tercero'];
    $cod_estado_revisado                            = $datos['cod_estado_revisado'];
    $cod_tipo_metodo_envio                          = $datos['cod_tipo_metodo_envio'];
    $cod_tipo_aplicacion                            = $datos['cod_tipo_aplicacion'];
    $cod_zona_envio                                 = $datos['cod_zona_envio'];
    $observacion_db                                 = $datos['observacion'];
    $latitud                                        = $datos['latitud'];
    $longitud                                       = $datos['longitud'];
    $latitud_longitud                               = $datos['latitud_longitud'];

    if ($observacion_db == '') { $observacion = ""; } else { $observacion = "<br>[".$observacion_db."]"; }
    if ($nombre1_tercero == '') { $nombre_cliente_visitante = ""; } else { $nombre_cliente_visitante = " (".$nombre1_tercero.")"; }

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
    $cuenta_usuario                     = $datos_info_usuario['cuenta'];
    $nombre_usuario                     = $cuenta_usuario;

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
?>
                                            <tr>
                                                <th style="text-align:center;"><mark><?php echo $cod_base_caja; ?></mark></th>
                                                <th style="text-align:left;"><mark><?php echo $nombre_usuario; ?></mark></th>
                                                <th style="text-align:left;"><mark><?php echo intval($und_venta)." | ".$nombre_producto." | ".$comentario_producto; ?></mark></th>
                                                <th style="text-align:left;"><mark><?php echo $observacion; ?></mark></th>
                                                <th style="text-align:center;"><mark><?php echo $fecha_hora_cargue; ?></mark></th>
                                                <?php if ($cod_estado_prioridad_caja_mesa_global == '1') { ?><mark><th style="text-align:center;"><?php echo $cod_prioridad; ?></th></mark><?php } ?>
                                                <!--<th style="text-align:center;"><?php echo $fecha_anyo.' | '.$fecha_hora; ?></th>-->
                                                <th style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual_venta_producto_temporal_reg.php?cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></th>
                                                <th style="text-align:center;"><?php echo $cod_info_factura_venta; ?></th>
                                            </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
<?php include_once('../admin/04_modulo_footer_aplicacion_tv.php'); ?>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
    </div>
<?php include_once('../admin/05_modulo_js_aplicacion_tv.php'); ?>
</body>
</html>

<script language="javascript">
setInterval("refrescar_pagina_aplicacion_tv_ajax()",5000);

function refrescar_pagina_aplicacion_tv_ajax(){

    var nombre_estado_factura = 'ABIERTA';
    var cod_estado_cocina = '0';
    var tipo_ajax = 'refrescar';
    var caja_mesa = '';
    var pagina = '';
    var pagina_redirect = '<?php echo $pagina_redirect; ?>';

    var datos_url_ajax = 'nombre_estado_factura='+nombre_estado_factura+'&'+'cod_estado_cocina='+cod_estado_cocina+'&'+'tipo_ajax='+tipo_ajax+'&'+'caja_mesa='+caja_mesa+'&'+'pagina='+pagina+'&'+'pagina_redirect='+pagina_redirect;

    $.ajax({
        type: "POST",
        url: "../admin/refrescar_pagina_caja_virtual_cocina_aplicacion_tv_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            var salida_tabla_caja_mesa_ajax = respuesta.salida_tabla_caja_mesa_ajax;
            $('#salida_tabla_caja_mesa_ajax').html(salida_tabla_caja_mesa_ajax);
        }
    });

//console.log("refresco div")
}
</script>