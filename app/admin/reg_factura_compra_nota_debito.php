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
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4></a>
</div>
-->
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><font size='+1'><a href="../admin/buscar_info_factura_compra_nota_debito.php">Nota Debito Para Factura de Compra (Devolución Factura Compra)</a></font></th>
    </tr>
</table>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$cod_info_factura_compra            = intval($_GET['cod_info_factura_compra']);
$origen                            = 'PARACLINICOS';

$incre                             = 0;
$tab                               = 'tbl15_factura_compra_producto';
$campo                             = 'cod_factura_compra_producto';
$tipo                              = 'eliminar';
$tab2                              = 'tbl15_factura_compra_producto_eliminar_sin_devolucion';
$tab3                              = 'tbl15_info_factura_compra';
$campo3                            = 'cod_info_factura_compra';
$nombre_modulo_puc                 = 'COMPRAS';
$fecha_ymd                         = date("Y-m-d");

$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (nombre_tipo_resolucion_facturacion = 'NOTA DEBITO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion_nota_debito       = $matriz_resol_fact['cod_resolucion_facturacion'];
?>
<!-- ***************************************************************************************************************************** -->
<?php
$datos_factura = "SELECT cod_factura_compra_producto FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_compra_producto) As total_compra_producto, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_compra_producto                         = $matriz_temporal['total_compra_producto'];
$total_peso_producto                 = $matriz_temporal['total_peso_producto'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_compra                                     = $data_info_factura['cod_info_factura_compra'];
$cod_factura                                                 = $data_info_factura['cod_factura'];
$cod_tercero                                                 = $data_info_factura['cod_tercero'];
$cod_empresa                                                 = $data_info_factura['cod_empresa'];
$nombre_empresa                                              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                         = $data_info_factura['razonsocial_empresa'];
$fecha_ymdhis                                                = $data_info_factura['fecha_ymdhis'];
$cuenta                                                      = $data_info_factura['cuenta'];
$cod_estado_factura                                          = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                               = $data_info_factura['cod_base_caja'];
$descuento_ptj                                               = $data_info_factura['descuento_ptj'];
$iva_ptj                                                     = $data_info_factura['iva_ptj'];
$flete_ptj                                                   = $data_info_factura['flete_ptj'];
$cod_cliente                                                 = $data_info_factura['cod_cliente'];
$vlr_cancelado                                               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                                                   = $data_info_factura['fecha_dia'];
$fecha_mes                                                   = $data_info_factura['fecha_mes'];
$fecha_anyo                                                  = $data_info_factura['fecha_anyo'];
$anyo                                                        = $data_info_factura['anyo'];
$fecha_hora                                                  = $data_info_factura['fecha_hora'];
$fecha_remision                                              = $data_info_factura['fecha_remision'];
$nombre_ccosto                                               = $data_info_factura['nombre_ccosto'];
$garantia_meses                                              = $data_info_factura['garantia_meses'];
$observacion                                                 = $data_info_factura['observacion'];
$cod_tipo_pago                                               = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                         = $data_info_factura['total_precio_compra'];
$total_precio_venta                                          = $data_info_factura['total_precio_venta'];
$cod_dependencia                                             = $data_info_factura['cod_dependencia'];
$servicio                                                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                                      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                                 = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                              = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                          = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                                  = $data_info_factura['cod_resolucion_facturacion'];
$cod_cufe                                                    = $data_info_factura['cod_cufe'];
$fecha_entrega                                               = $data_info_factura['fecha_entrega'];
$url_img_orig_producto                                       = $data_info_factura['url_img_orig_producto'];
$tiempo_ejecucion                                            = $data_info_factura['tiempo_ejecucion'];
$tiempo_ejecucion_dian_dataico                               = $data_info_factura['tiempo_ejecucion_dian_dataico'];
$cod_puc                                                     = $data_info_factura['cod_puc'];
$cod_movimiento_contable_cuenta_personal                     = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
$cod_movimiento_caja                                         = $data_info_factura['cod_movimiento_caja'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['nombre2_tercero'].' '.$matriz_cliente['apellido1_tercero'].' '.$matriz_cliente['apellido2_tercero'].' - '.$matriz_cliente['identificacion_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }


$datos_info_cli = "SELECT * FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_info_cli = mysqli_query($conectar, $datos_info_cli);
$info_cli = mysqli_fetch_assoc($consulta_info_cli);

$razonsocial_empresa                 = $info_cli['razonsocial_empresa'];
$direccion_empresa                   = $info_cli['direccion_empresa'];
$telefono_empresa                    = $info_cli['telefono_empresa'];
$nit_empresa                         = $info_cli['nit_empresa'];
$cod_tipo_facturacion                = $info_cli['cod_tipo_facturacion'];

$datos_info_admin = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_info_admin = mysqli_query($conectar, $datos_info_admin);
$info_admin = mysqli_fetch_assoc($consulta_info_admin);

$cuenta                      = $info_admin['cuenta'];

$datos_info_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
$consulta_info_resolucion_facturacion = mysqli_query($conectar, $datos_info_resolucion_facturacion);
$info_resolucion_facturacion = mysqli_fetch_assoc($consulta_info_resolucion_facturacion);

$nombre_tipo_resolucion_facturacion = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$prefijo_resolucion_facturacion = $info_resolucion_facturacion['prefijo_resolucion_facturacion'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

$nombre_funcion_nota_debito   = "";
if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $cod_cufe <> '' && $nombre_tipo_factura == 'ELECTRONICA') {
    $nombre_funcion_nota_debito = 'EnviarFacturaNotaDebitoDevolucionDianDataico';
} else {
    $nombre_funcion_nota_debito = 'EnviarFacturaNotaDebitoDevolucion';
}
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="table-responsive">
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA DEVOLUCION</th>
    <th style="text-align:center;">FECHA COMPRA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FACTURA</th>
   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?><th style="text-align:center;">CUFE</th><?php } ?>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">CLIENTE</th>
    <th style="text-align:center;">TOTAL FACTURA</th>
    <th style="text-align:center;">COMENTARIO</th>
    <th style="text-align:center;">GENERAR NOTA DEBITO</th>
  </tr>
  <tr>
   <td style="text-align:center;"><?php echo $cod_info_factura_compra ?></td>
    <td style="text-align:center;"><input name="fecha_ymd" tYpe="date" id="fecha_ymd" class="input-block-level" value="<?php echo $fecha_ymd ?>"></td>

   <td style="text-align:center;"><?php echo $fecha_anyo ?><br>HORA: <?php echo $fecha_hora ?></td>
    <td style="text-align:center;">
        <?php echo $nombre_tipo_resolucion_facturacion ?>
        <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
            <br><strong>CREAR MOV CONTABLE:</strong><br>
            <select name="cod_sino_crear_mov_contable" id="cod_sino_crear_mov_contable" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 50px;" required>
                <?php if (isset($cod_sino_crear_mov_contable)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino ORDER BY cod_sino ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_sino_crear_mov_contable) AND $cod_sino_crear_mov_contable == $datos2['cod_sino']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_sino'];
                $nombre = $datos2['nombre_sino'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        <?php } ?>
    </td>
   <td style="text-align:center;"><?php echo $prefijo_resolucion_facturacion ?> | <?php echo $cod_factura ?></td>
   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?><td style="text-align:center;"><?php echo $cod_cufe;?></td><?php } ?>
   <td style="text-align:center;"><?php echo $cuenta ?></td>
    <td style="text-align:center;"><?php echo $nombre_tipo_forma_pago ?>
        <?php if ($cod_estado_modulo_puc_global == '1') { ?>
            <br>
            <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 300px;" tabindex="1">
                <?php if (isset($cod_puc)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE ((nombre_modulo_puc = '$nombre_modulo_puc')) ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_puc) AND $cod_puc == $datos2['cod_puc']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_puc'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        <?php } ?>
        <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
            <br><b>CUENTA PERSONAL:</b><br>
            <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 300px;" tabindex="1">
                <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'].' | '.$datos2['cod_movimiento_contable_cuenta_personal'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        <?php } ?>
        <br><?php echo $descripcion_tipo_forma_pago;?>
    </td>

    <td style="text-align:center;"><?php echo $nombre_tipo_pago ?><br></td>
    <td style="text-align:center;"><?php echo $cliente ?></td>
    <td style="text-align:center; font-size:30;" id="total_compra_producto"><?php echo number_format($total_compra_producto, 0, ",", "."); ?></td>
    <td style="text-align:center;"><textarea name="observacion" id="observacion" class="input-block-level" rows="3" cols="20" tabindex="1"></textarea></td>
    <td style="text-align:center;" id="apidian_nota_debito<?php echo $cod_info_factura_compra ?>" data="<?php echo $cod_info_factura_compra ?>"><a class="<?php echo $nombre_funcion_nota_debito ?>" style="cursor:pointer;"><img src="../imagenes/btn_nota_credito_devolucion_grand.png" class="img-polaroid" alt=""></a></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
    <tr>
        <th style="text-align:center;">CODIGO</th>
        <th style="text-align:center;">NOMBRE CONCEPTO</th>
        <th style="text-align:center;">CANTIDAD</th>
        <th style="text-align:center;">U/M</th>
        <th style="text-align:center;">PRECIO VENTA</th>
        <th style="text-align:center;">VALOR TOTAL</th>
    </tr>
</thead>
<tbody>
<?php
$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra') ORDER BY cod_factura_compra_producto DESC";
$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

    $cod_factura_compra_producto       = $datos_factura_compra_producto['cod_factura_compra_producto'];
    $cod_producto                      = $datos_factura_compra_producto['cod_producto'];
    $cod_producto_barra                = $datos_factura_compra_producto['cod_producto_barra'];
    $nombre_producto                   = $datos_factura_compra_producto['nombre_producto'];
    $cedula                            = $datos_factura_compra_producto['cedula'];
    $nombre_cliente                    = $datos_factura_compra_producto['nombre_cliente'];
    $und_compra                         = $datos_factura_compra_producto['und_compra'];
    $precio_compra_producto            = $datos_factura_compra_producto['precio_compra_producto'];
    $precio_costo_producto             = $datos_factura_compra_producto['precio_costo_producto'];
    $total_costo_producto              = $datos_factura_compra_producto['total_costo_producto'];
    $total_compra_producto             = $datos_factura_compra_producto['total_compra_producto'];
    $nombre_tipo_producto              = $datos_factura_compra_producto['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida         = $datos_factura_compra_producto['nombre_tipo_unidad_medida'];
    $posologia_cantidad                = $datos_factura_compra_producto['posologia_cantidad'];
    $posologia_peso                    = $datos_factura_compra_producto['posologia_peso'];
    $nombre_tipo_presentacion          = $datos_factura_compra_producto['nombre_tipo_presentacion'];
    $nombre_via_administracion         = $datos_factura_compra_producto['nombre_via_administracion'];
    $nombre_frec_duracion              = $datos_factura_compra_producto['nombre_frec_duracion'];
    $cod_tipo_cobrar                   = $datos_factura_compra_producto['cod_tipo_cobrar'];
    $cod_info_factura_compra           = $datos_factura_compra_producto['cod_info_factura_compra'];
    $nombre_tipo_precio_venta          = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
    $peso_producto                     = $datos_factura_compra_producto['peso_producto'];
    $unidad_medida_peso                = $datos_factura_compra_producto['unidad_medida_peso'];
?>
    <tr>
        <td style="text-align:center;"><?php echo $cod_producto_barra ?></td>
        <td style="text-align:left;" ><?php echo $nombre_producto ?></td>
        <td style="text-align:center;"><?php echo $und_compra;?></td>
        <td style="text-align:center;"><?php echo $nombre_tipo_unidad_medida;?></td>
        <td style="text-align:right;"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
        <td style="text-align:right;"><?php echo number_format($total_compra_producto, 0, ",", ".");?></td>
    </tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
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

<script type="text/javascript">
$(document).ready(function() {

    $('.EnviarFacturaNotaDebitoDevolucionDianDataico').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_compra = $(this).parent().attr('data');
        var tab = "tbl15_info_factura_compra";
        var campo = "cod_info_factura_compra";
        var tipo_ajax = "tbl15_info_factura_compra";
        var cod_resolucion_facturacion = "<?php echo $cod_resolucion_facturacion_nota_debito;?>";
        var pagina = "<?php echo $pagina;?>";
        var cod_estado_enviar_factura_venta_electronica_dian_api = "<?php echo $cod_estado_enviar_factura_venta_electronica_dian_api;?>";
        var nombre_tipo_factura = "<?php echo $nombre_tipo_factura;?>";
        var cod_cufe = "<?php echo $cod_cufe;?>";
        var cod_sino_crear_mov_contable = document.getElementById("cod_sino_crear_mov_contable").value;
        var cod_puc = document.getElementById("cod_puc").value;
        var cod_movimiento_contable_cuenta_personal = document.getElementById("cod_movimiento_contable_cuenta_personal").value;
        var observacion = document.getElementById("observacion").value;
        var fecha_ymd = document.getElementById("fecha_ymd").value;

        var url_ajax = "../admin/enviar_datos_devolucion_factura_compra_nota_debito_dian_json.php";
        var datos_url_ajax = 'id='+cod_info_factura_compra+'&'+'cod_info_factura_compra='+cod_info_factura_compra+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_sino_crear_mov_contable='+cod_sino_crear_mov_contable+'&'+'cod_puc='+cod_puc+'&'+'cod_movimiento_contable_cuenta_personal='+cod_movimiento_contable_cuenta_personal+'&'+'observacion='+observacion+'&'+'fecha_ymd='+fecha_ymd+'&'+'pagina='+pagina;
        
        $.ajax({
            type: "POST",
            url: url_ajax,
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                $('#apidian_nota_debito'+cod_info_factura_compra).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
            },
            success:function(respuesta){

                if(respuesta.errors) {
                    var dataico_dian_error = respuesta.errors[0].error;
                    var dataico_dian_path = respuesta.errors[0].path;
                    var error_respuesta = "Error";
                    var imagen_status_error = "../imagenes/error.jpg";
                    var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                    var imagen_status_dataico = "../imagenes/btn_dataico_gris.png";
                    var resultado_envio_dian = "No Enviado a la Dian";
                    var resultado_envio_dataico = "No Enviado a Dataico";
                    var imagen_status = "../imagenes/error.jpg";
                    //var datos_url_ajax = 'id='+cod_info_factura_compra+'&'+'cod_info_factura_compra='+cod_info_factura_compra+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina+'&'+'dataico_dian_error='+dataico_dian_error+'&'+'dataico_dian_path='+dataico_dian_path;
                    $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                    $('#apidian_nota_debito'+cod_info_factura_compra).html("Error: "+dataico_dian_error+"<br>"+dataico_dian_path);
                } else {
                    if (respuesta.number) { var cod_factura_prefijo = respuesta.number; } else { var cod_factura_prefijo = ''; }
                    if (respuesta.numbering.prefix) { var prefijo_resolucion_facturacion = respuesta.numbering.prefix; } else { var prefijo_resolucion_facturacion = ''; }
                    if (respuesta.numbering.resolution_number) { var numero_resolucion_facturacion = respuesta.numbering.resolution_number; } else { var numero_resolucion_facturacion = ''; }
                    if (respuesta.email_status) { var dataico_email_status = respuesta.email_status; } else { var dataico_email_status = ''; }
                    if (respuesta.uuid) { var dataico_uuid = respuesta.uuid; } else { var dataico_uuid = ''; }
                    if (respuesta.cufe) { var cod_cufe = respuesta.cufe; } else { var cod_cufe = ''; }
                    if (respuesta.issue_date) { var dataico_issue_date = respuesta.issue_date; } else { var dataico_issue_date = ''; }
                    if (respuesta.dian_messages) { var dataico_dian_messages = respuesta.dian_messages; } else { var dataico_dian_messages = ''; }
                    if (respuesta.customer_status) { var dataico_customer_status = respuesta.customer_status; } else { var dataico_customer_status = ''; }
                    if (respuesta.xml_url) { var dataico_xml_url = respuesta.xml_url; } else { var dataico_xml_url = ''; }
                    if (respuesta.validation_date) { var dataico_validation_date = respuesta.validation_date; } else { var dataico_validation_date = ''; }
                    if (respuesta.qrcode) { var dataico_qrcode = respuesta.qrcode; } else { var dataico_qrcode = ''; }
                    if (respuesta.xml) { var dataico_xml = respuesta.xml; } else { var dataico_xml = ''; }
                    if (respuesta.pdf_url) { var dataico_pdf_url = respuesta.pdf_url; } else { var dataico_pdf_url = ''; }
                    if (respuesta.dian_status) { var dataico_dian_status = respuesta.dian_status; } else { var dataico_dian_status = ''; }
                    if (respuesta.invoice) { var dataico_invoice_type_code = respuesta.invoice; } else { var dataico_invoice_type_code = ''; }
                    if (respuesta.reason) { var dataico_dian_reason = respuesta.reason; } else { var dataico_dian_reason = ''; }

                    if (dataico_dian_status == 'DIAN_ACEPTADO') {
                        var cod_estado_factura_electronica_enviado_dian = 1;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'cod_info_factura_compra='+cod_info_factura_compra+'&'+'cod_resolucion_facturacion='+cod_resolucion_facturacion+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_reason='+dataico_dian_reason+'&'+'dataico_dian_status='+dataico_dian_status;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_nota_debito_devolucion_enviada_dian_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                                $('#apidian_nota_debito'+cod_info_factura_compra).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_compra = respuesta.cod_info_factura_compra;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";

                                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                                $('#apidian_nota_debito'+cod_info_factura_compra).html('FACTURA ANULADA'+'<br>'+dataico_dian_status);
                            }
                        });
                    } 
                    if (dataico_dian_status == 'DIAN_NO_ENVIADO') {
                        var cod_estado_factura_electronica_enviado_dian = 0;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
                        
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                                $('#apidian_nota_debito'+cod_info_factura_compra).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_compra = respuesta.cod_info_factura_compra;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                                var longitud_cod_cufe = cod_cufe.length;
                                var mitad_longitud_cod_cufe = longitud_cod_cufe / 2;
                                var cod_cufe_parte1 = cod_cufe.substr(0, mitad_longitud_cod_cufe);
                                var cod_cufe_parte2 = cod_cufe.substr(mitad_longitud_cod_cufe + 1, longitud_cod_cufe);
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";

                                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                                $('#apidian_nota_debito'+cod_info_factura_compra).html(dataico_dian_status+"<br>"+dataico_dian_messages);
                            }
                        });
                    }
                }
            }
        });
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.EnviarFacturaNotaDebitoDevolucion').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_compra = $(this).parent().attr('data');
        var tab = "tbl15_info_factura_compra";
        var campo = "cod_info_factura_compra";
        var tipo_ajax = "tbl15_info_factura_compra";
        var cod_resolucion_facturacion = "<?php echo $cod_resolucion_facturacion_nota_debito;?>";
        var pagina = "<?php echo $pagina;?>";
        var cod_estado_enviar_factura_venta_electronica_dian_api = "<?php echo $cod_estado_enviar_factura_venta_electronica_dian_api;?>";
        var nombre_tipo_factura = "<?php echo $nombre_tipo_factura;?>";
        var cod_cufe = "<?php echo $cod_cufe;?>";
        var cod_sino_crear_mov_contable = document.getElementById("cod_sino_crear_mov_contable").value;
        var cod_puc = document.getElementById("cod_puc").value;
        var cod_movimiento_contable_cuenta_personal = document.getElementById("cod_movimiento_contable_cuenta_personal").value;
        var observacion = document.getElementById("observacion").value;
        var fecha_ymd = document.getElementById("fecha_ymd").value;

        var url_ajax = "../admin/guardar_devolucion_factura_compra_nota_debito_json_ajax.php";
        var datos_url_ajax = 'id='+cod_info_factura_compra+'&'+'cod_info_factura_compra='+cod_info_factura_compra+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_sino_crear_mov_contable='+cod_sino_crear_mov_contable+'&'+'cod_puc='+cod_puc+'&'+'cod_movimiento_contable_cuenta_personal='+cod_movimiento_contable_cuenta_personal+'&'+'observacion='+observacion+'&'+'fecha_ymd='+fecha_ymd+'&'+'pagina='+pagina;

        $.ajax({
            type: "POST",
            url: url_ajax,
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#apidian_nota_debito'+cod_info_factura_compra).html("");
                $('#apidian_nota_debito'+cod_info_factura_compra).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                if (afectado == 'SI') {
                    url_redirect ="../admin/lista_info_nota_debito.php";
                     window.location.href = url_redirect+"?cod_info_factura_compra="+cod_info_factura_compra;
                } else {
                    url_redirect ="../admin/lista_info_nota_debito.php";
                    $('#apidian_nota_debito'+cod_info_factura_compra).html("Error");
                }
            }
        });
    });
});
</script>