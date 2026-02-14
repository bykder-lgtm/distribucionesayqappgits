<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$suma_subtotal_venta = "SELECT Sum(total_venta_producto) As subtotal_venta FROM tbl15_venta_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (cod_producto_barra <> '$cod_servicio_propina' AND cod_producto_barra <> '$cod_servicio_descuento')";
$consulta_subtotal_venta = mysqli_query($conectar, $suma_subtotal_venta);
$matriz_subtotal_venta = mysqli_fetch_assoc($consulta_subtotal_venta);

$subtotal_venta                 = $matriz_subtotal_venta['subtotal_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta                               = $data_info_factura['cod_info_factura_venta'];
$cod_factura                                          = $data_info_factura['cod_factura'];
$cod_tercero                                          = $data_info_factura['cod_tercero'];
$cod_historia_clinica                                 = $data_info_factura['cod_historia_clinica'];
$fecha_ini                                            = $data_info_factura['fecha_ini'];
$fecha_fin                                            = $data_info_factura['fecha_fin'];
$cod_empresa                                          = $data_info_factura['cod_empresa'];
$nombre_empresa                                       = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                  = $data_info_factura['razonsocial_empresa'];
$total_motivo                                         = $data_info_factura['total_motivo'];
$total_muestra                                        = $data_info_factura['total_muestra'];
$fecha_ymdhis                                         = $data_info_factura['fecha_ymdhis'];
$cuenta                                               = $data_info_factura['cuenta'];
$cod_estado_factura                                   = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                        = $data_info_factura['cod_base_caja'];
$descuento_ptj                                        = $data_info_factura['descuento_ptj'];
$iva_ptj                                              = $data_info_factura['iva_ptj'];
$flete_ptj                                            = $data_info_factura['flete_ptj'];
$cod_cliente                                          = $data_info_factura['cod_cliente'];
$vlr_cancelado                                        = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                           = $data_info_factura['vlr_vuelto'];
$fecha_dia                                            = $data_info_factura['fecha_dia'];
$fecha_mes                                            = $data_info_factura['fecha_mes'];
$fecha_anyo                                           = $data_info_factura['fecha_anyo'];
$anyo                                                 = $data_info_factura['anyo'];
$fecha_hora                                           = $data_info_factura['fecha_hora'];
$fecha_remision                                       = $data_info_factura['fecha_remision'];
$nombre_ccosto                                        = $data_info_factura['nombre_ccosto'];
$garantia_meses                                       = $data_info_factura['garantia_meses'];
$observacion                                          = $data_info_factura['observacion'];
$cod_tipo_pago                                        = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                    = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                 = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                  = $data_info_factura['total_precio_compra'];
$total_precio_venta                                   = $data_info_factura['total_precio_venta'];
$cod_dependencia                                      = $data_info_factura['cod_dependencia'];
$servicio                                             = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                  = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                               = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                          = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                  = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                   = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                      = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                       = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                   = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                       = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                      = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                    = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                           = $data_info_factura['cod_resolucion_facturacion'];
$cod_prioridad                                        = $data_info_factura['cod_prioridad'];
$cod_puntos_redimibles_campanya                       = $data_info_factura['cod_puntos_redimibles_campanya'];
$cod_info_factura_strpad                              = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor                                     = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_tercero = mysqli_query($conectar, $sql_tercero);
$matriz_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombres_tercero                                      = $matriz_tercero['nombre1_tercero'].' '.$matriz_tercero['apellido1_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_venta_factura_temporal = "SELECT SUM(total_venta_producto) AS total_precio_factura_venta FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222')";
$consulta_venta_factura_temporal = mysqli_query($conectar, $sql_venta_factura_temporal) or die(mysqli_error($conectar));
$info_venta_factura_temporal = mysqli_fetch_assoc($consulta_venta_factura_temporal);

$total_precio_factura_venta                                  = $info_venta_factura_temporal['total_precio_factura_venta'];

$obtener_puntos_redimibles_campanya = "SELECT * FROM tbl15_puntos_redimibles_campanya WHERE (cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya')";
$resultado_puntos_redimibles_campanya = mysqli_query($conectar, $obtener_puntos_redimibles_campanya) or die(mysqli_error($conectar));
$info_puntos_redimibles_campanya = mysqli_fetch_assoc($resultado_puntos_redimibles_campanya);

$valor_puntos_redimibles_campanya                            = intval($info_puntos_redimibles_campanya['valor_puntos_redimibles_campanya']);
$cantidad_puntos_x_valor_redimibles_campanya                 = intval($info_puntos_redimibles_campanya['cantidad_puntos_x_valor_redimibles_campanya']);
$equivalencia_en_pesos_de_un_punto                           = intval($info_puntos_redimibles_campanya['equivalencia_en_pesos_de_un_punto']);
if ($valor_puntos_redimibles_campanya == '0') { $valor_puntos_redimibles_campanya = '1'; } else { $valor_puntos_redimibles_campanya = $valor_puntos_redimibles_campanya; }

$obtener_info_cliente = "SELECT total_puntos_redimibles_campanya_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

$total_puntos_redimibles_campanya_factura_actual             = ($total_precio_factura_venta / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;
$total_puntos_redimibles_campanya_tercero_acumulado          = $info_cliente['total_puntos_redimibles_campanya_tercero'];
$total_puntos_redimibles_campanya_factura_mas_acumulado      = intval($total_puntos_redimibles_campanya_factura_actual + $total_puntos_redimibles_campanya_tercero_acumulado);
$total_plata_puntos_redimibles_campanya_tercero_acumulado    = $total_puntos_redimibles_campanya_factura_mas_acumulado * $equivalencia_en_pesos_de_un_punto;
 //---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//   
$tab                         = 'tbl15_venta_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_moneda").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_administrador";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto_temporal";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<table class="table table-striped">
<tr>
<th style="text-align:center;">MODULO DE PREVENTA</th>
</tr>
</table>

<?php if ($tipo_dispositivo == 'PC') { ?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">REGRESAR</th>
    <?php if ($cod_estado_propina_global == '1') { ?>
    <th style="text-align:center;">PROPINA</th>
    <?php } ?>

    <?php if ($cod_estado_cupobrilla_global == '1') { ?>
    <th style="text-align:center;">CUPO BRILLA</th>
    <?php } ?>

    <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
    <th style="text-align:center;">DOMICILIO</th>
    <?php } ?>
    
    <?php if ($cod_estado_descuento_concepto_venta_neg_global == '1') { ?>
    <th style="text-align:center;">DESCUENTO</th>
    <?php } ?>

    <?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
    <th style="text-align:center;">APLICAR PUNTOS REDIMIBLES</th>
    <?php } ?>

    <th style="text-align:center;">ID</th>
    <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
    <th style="text-align:center;">FECHA</th>
<!--
    <th style="text-align:center;">MONEDA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
-->
    <th style="text-align:center;">VENDEDOR</th>
<!--
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">TERCERO</th>
-->
    <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
    <th style="text-align:center;">SUBTOTAL</th>
    <th style="text-align:center;">TOTAL</th>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <th style="text-align:center;">GUARDAR CAMBIOS</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_nav_global == '0') { ?>
    <th style="text-align:center;">IMP PREVENTA</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_nav_global == '0') { ?>
    <th style="text-align:center;">IMP COCINA (SELECIONADOS)</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_direct_driv_global == '0') { ?>
    <th style="text-align:center;">IMP PREVENTA</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_direct_driv_global == '0') { ?>
    <th style="text-align:center;">IMP COCINA (SELECIONADOS)</th>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <th style="text-align:center;">SEPARAR EN OTRA FACTURA (SELECIONADOS)</th>
    <?php } ?>

    <?php if ($cod_estado_servicio_cava_global == '1') { ?>
    <th style="text-align:center;">SERVICIO CAVA</th>
    <?php } ?>

    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"><a href="<?php echo $pagina_regresar ?><?php echo $url_visit_user_extern ?>"><img src="../imagenes/btn_regresar.png" alt="imprimir"></a></td>

    <?php if ($cod_estado_propina_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_servicio_propina_temporal_producto.php?cod_producto_auxiliar=1&cod_producto_barra=22222222&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_propina_servicio.png" alt="Listo"></a></td>
    <?php } ?>

    <?php if ($cod_estado_cupobrilla_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_servicio_cupobrilla_temporal_producto.php?cod_producto_auxiliar=1&cod_producto_barra=11114444&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_brilla.png" alt="Listo"></a></td>
    <?php } ?>

    <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_servicio_domicilio_temporal_producto.php?cod_producto_auxiliar=1&cod_producto_barra=44444444&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_propina_domicilio.png" alt="Listo"></a></td>
    <?php } ?>

    <?php if ($cod_estado_descuento_concepto_venta_neg_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_descuento_factura_temporal_producto.php?cod_producto_auxiliar=2&cod_producto_barra=<?php echo $cod_servicio_descuento ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_descuento.png" alt="Listo"></a></td>
    <?php } ?>

    <?php if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
    <td style="text-align:center;">
        <a href="../admin/actualizar_aplicar_puntos_redimibles_descuento_factura_temporal_producto.php?cod_producto_auxiliar=10&cod_producto_barra=11112222&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_descuento.png" alt="Listo"></a>
        <br>
        Total Puntos: <?php echo $total_puntos_redimibles_campanya_factura_mas_acumulado ?>
        <br>
        Total Puntos en Dinero: <?php echo number_format($total_plata_puntos_redimibles_campanya_tercero_acumulado, 0, ",", ".") ?>
    </td>
    <?php } ?>

   <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
   <td style="text-align:center;"><?php echo $cod_base_caja ?></td>
<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>
<!--
   <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>
-->
    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>

   <td style="text-align:center;"><?php echo $nombres_vendedor ?></td>

<!--
    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_administrador)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_moneda'];
            $nombre = $datos2['nombre_tipo_moneda'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_factura WHERE (nombre_tipo_factura='POS')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;"><br>
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a>
    </td>
-->
    <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
    <td style="text-align:center; font-size:30;" id="subtotal_venta"><?php echo number_format($subtotal_venta, 0, ",", "."); ?></td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
    <?php } ?>

    <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/preventa_facturacion_venta_temporal_producto_manual_pos.php?cuenta=<?php echo $cuenta_actual; ?>&cod_caja_virtual=<?php echo $cod_caja_virtual; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/guardar.png" alt="guardar"></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_nav_global == '0') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_nav_global == '0') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir2" onclick="printPageAreaCocina('area_imprimible_invisible_cocina')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimirPreventaTodo"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimirCocina"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/dividir_separar_factura_caja_mesa_reg.php?cuenta=<?php echo $cuenta_actual; ?>&cod_caja_virtual=<?php echo $cod_caja_virtual; ?>&cod_base_caja=<?php echo $cod_base_caja; ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/btn_separar_factura.png" alt="separar"></a></td>
    <?php } ?>


    <?php if ($cod_estado_servicio_cava_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_servicio_cava_temporal_producto.php?cod_producto_auxiliar=3&cod_producto_barra=<?php echo $cod_servicio_cava ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_cava_servicio.png" alt="Listo"></a></td>
    <?php } ?>

    <td style="text-align:center;"></td>
  </tr>
</table>

<?php } else { ?>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ATRAS</th>

    <?php if ($cod_estado_propina_global == '1') { ?>
    <th style="text-align:center;">PROPINA</th>
    <?php } ?>

    <?php if ($cod_estado_descuento_concepto_venta_neg_global == '1') { ?>
    <th style="text-align:center;">DESCUENTO</th>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <th style="text-align:center;">GUARDAR CAMBIOS</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_nav_global == '0') { ?>
    <th style="text-align:center;">IMP PREVENTA</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_nav_global == '0') { ?>
    <th style="text-align:center;">IMP COCINA (SELECIONADOS)</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_direct_driv_global == '0') { ?>
    <th style="text-align:center;">IMP PREVENTA</th>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_direct_driv_global == '0') { ?>
    <th style="text-align:center;">IMP COCINA (SELECIONADOS)</th>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <th style="text-align:center;">SEPARAR EN OTRA FACTURA (SELECIONADOS)</th>
    <?php } ?>
    
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"><a href="<?php echo $pagina_regresar ?><?php echo $url_visit_user_extern ?>"><img src="../imagenes/btn_regresar.png" alt="imprimir"></a></td>
    <?php if ($cod_estado_propina_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_servicio_propina_temporal_producto.php?cod_producto_auxiliar=1&cod_producto_barra=<?php echo $cod_servicio_propina ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_propina_servicio.png" alt="Listo"></a></td>
    <?php } ?>

    <?php if ($cod_estado_descuento_concepto_venta_neg_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/actualizar_descuento_factura_temporal_producto.php?cod_producto_auxiliar=2&cod_producto_barra=<?php echo $cod_servicio_descuento ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cuenta=<?php echo $cuenta_actual ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_regresar ?>&pagina_local=<?php echo $pagina ?>"><img src="../imagenes/btn_descuento.png" alt="Listo"></a></td>
    <?php } ?>
<!--
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a>
    </td>
-->

    <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/preventa_facturacion_venta_temporal_producto_manual_pos.php?cuenta=<?php echo $cuenta_actual; ?>&cod_caja_virtual=<?php echo $cod_caja_virtual; ?>&pagina=<?php echo $pagina; ?>"><img src="../imagenes/guardar.png" alt="guardar"></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_nav_global == '0') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_nav_global == '0') { ?>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir2" onclick="printPageAreaCocina('area_imprimible_invisible_cocina')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_preventodo_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimirPreventaTodo"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>

    <?php if ($cod_estado_habilitar_btn_imp_cocina_direct_driv_global == '0') { ?>
    <td style="text-align:center;"><button id="btnImprimirCocina"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <?php } ?>

    <?php if ($cod_estado_dividir_factura_caja_mesa_global == '1') { ?>
    <td style="text-align:center;"><a href="../admin/dividir_separar_factura_caja_mesa_reg.php?cuenta=<?php echo $cuenta_actual; ?>&cod_caja_virtual=<?php echo $cod_caja_virtual; ?>&cod_base_caja=<?php echo $cod_base_caja; ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/btn_separar_factura.png" alt="separar"></a></td>
    <?php } ?>
    <td style="text-align:center;"></td>
  </tr>
</table>


<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>

    <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
    <th style="text-align:center;">SUBTOTAL</th>
    <th style="text-align:center;">TOTAL</th>
    <?php } ?>

<!--
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
-->
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
   <td style="text-align:center;"><?php echo $cod_base_caja ?></td>
<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>
    <td style="text-align:center;"><?php echo $nombres_vendedor ?></td>
    <td style="text-align:center;"><?php echo $nombres_tercero ?></td>

    <?php if ($cod_estado_habilitar_total_venta_caja_mesa_virtual_en_uso == '0') { ?>
    <td style="text-align:center; font-size:30;" id="subtotal_venta"><?php echo number_format($subtotal_venta, 0, ",", "."); ?></td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
    <?php } ?>

<!--
    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
-->
    <td style="text-align:center;"></td>
  </tr>
</table>
<?php } ?>

<?php } else { } ?>

<script>  
$(document).ready(function(){  
  $('#btnImprimirPreventaTodo').click(function(){
  var cuenta = "<?php echo $cuenta_actual ?>";
  var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
  var cod_info_factura_venta = "<?php echo $cod_info_factura_venta ?>";
  var cod_base_caja = "<?php echo $cod_base_caja ?>";

    $.ajax({ url:"imprimir_factura_preventatodo_ticket_pos.php", method:"GET", data:{cuenta:cuenta, cod_caja_virtual:cod_caja_virtual, cod_info_factura_venta:cod_info_factura_venta, cod_base_caja:cod_base_caja, campo:"cod_info_factura_venta" }, 
     success: function(response){
         if(response==1){
             alert('Imprimiendo....');
         }else{
             alert('Error');
         }
     }
    });  
  });
});  
</script>


<script>  
$(document).ready(function(){  
  $('#btnImprimirCocina').click(function(){
  var cuenta = "<?php echo $cuenta_actual ?>";
  var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
  var cod_info_factura_venta = "<?php echo $cod_info_factura_venta ?>";

    $.ajax({ url:"imprimir_factura_preventacocina_ticket_pos.php", method:"GET", data:{cuenta:cuenta, cod_caja_virtual:cod_caja_virtual, cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta" }, 
     success: function(response){
         if(response==1){
             alert('Imprimiendo....');
         }else{
             alert('Error');
         }
     }
    });  
  });
});  
</script>