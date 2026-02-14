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
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista Facturas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$seleccionado = 1;

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_factura                             = intval($_GET['cod_factura']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);
$fecha                                   = date("Y-m-d");

if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_mantenimiento_producto.cod_administrador = '$cod_administrador')";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
$filtro_consulta_tercero_rel = "AND (tbl15_mantenimiento_producto.cod_tercero = '$cod_tercero')";
}
if ($cod_tipo_pago==0) {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
} else {
$filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
$filtro_consulta_tipo_pago_rel = "AND (tbl15_mantenimiento_producto.cod_tipo_pago = '$cod_tipo_pago')";
}
if ($cod_tipo_forma_pago==0) {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
} else {
$filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_mantenimiento_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}
if ($cod_factura=='0' || $cod_factura=='') {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
} else {
$filtro_consulta_cod_factura = "AND (cod_factura = '$cod_factura')";
$filtro_consulta_cod_factura_rel = "AND (tbl15_mantenimiento_producto.cod_factura = '$cod_factura')";
}
if ($nombre_tipo_factura=='0') {
$filtro_consulta_nombre_tipo_factura = "";
$filtro_consulta_nombre_tipo_factura_rel = "";
} else {
$filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
$filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_mantenimiento_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
}

} else {
$fecha_ymd_venta_producto_ini            = date("Y-m-d");
$fecha_ymd_venta_producto_fin            = date("Y-m-d");
$cod_administrador                       = 0;
$cod_tercero                             = 0;
$cod_tipo_pago                           = 0;
$cod_tipo_forma_pago                     = 0;
$cod_factura                             = "";
$nombre_tipo_factura                     = "0";
$fecha                                   = date("Y-m-d");

if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
}
if ($cod_tercero==0) {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
} else {
$filtro_consulta_tercero = "";
$filtro_consulta_tercero_rel = "";
}
if ($cod_tipo_pago==0) {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
} else {
$filtro_consulta_tipo_pago = "";
$filtro_consulta_tipo_pago_rel = "";
}
if ($cod_tipo_forma_pago==0) {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
} else {
$filtro_consulta_tipo_forma_pago = "";
$filtro_consulta_tipo_forma_pago_rel = "";
}
if ($cod_factura=='0' || $cod_factura=='') {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
} else {
$filtro_consulta_cod_factura = "";
$filtro_consulta_cod_factura_rel = "";
}
if ($nombre_tipo_factura=='0') {
$filtro_consulta_nombre_tipo_factura = "";
$filtro_consulta_nombre_tipo_factura_rel = "";
} else {
$filtro_consulta_nombre_tipo_factura = "";
$filtro_consulta_nombre_tipo_factura_rel = "";
}

}
if ($cod_administrador==0) {
$cuenta_get                                  = 'TODOS';
} else {
$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta_get                                  = $datos_administrador['cuenta'];
}

if ($cod_tercero==0) {
$nombre_cliente                                  = 'TODOS';
} else {
$sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($cod_tipo_pago==0) {
$nombre_tipo_pago_get                             = 'TODOS';
} else {
$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago_get                             = $datos_tipo_pago['nombre_tipo_pago'];
}

if ($cod_tipo_forma_pago==0) {
$nombre_tipo_forma_pago_get                        = 'TODOS';
} else {
$sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago_get                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
}

if ($cod_factura=='0') {
$nombre_dependencia_get                             = 'TODOS';
} else {
$nombre_dependencia_get                             = $cod_factura;
}

if ($nombre_tipo_factura=='0') {
$nombre_tipo_factura_get                            = 'TODOS';
} else {
$sql_tipo_factura  = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura WHERE nombre_tipo_factura = '$nombre_tipo_factura'";
$consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
$datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

$nombre_tipo_factura_get                            = $datos_tipo_factura['nombre_tipo_factura'];
}

$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Facturas de Mantenimiento</font></a></th>
        <?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
        <th style="text-align:right"><a href="../admin/facturacion_mantenimiento_temporal_producto_manual_pos.php"><font size='+2'>Facturar Mantenimiento</font></a></th>
        <?php } ?>
    </tr>
</table>

<?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
<form action="" id="" method="GET">
<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">FACTURA</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TIPO PAGO</th>
  </tr>
    <td style="text-align:center;"><input type="number" id="cod_factura" name="cod_factura" autofocus/></td>

  <td style="text-align:center;">
    <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_administrador)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>


    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
  </tr>
  <tr>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago ORDER BY cod_tipo_forma_pago ASC";
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
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_factura)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura ORDER BY nombre_tipo_factura ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
<th style="text-align:center">Edit</th>
<?php } ?>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Cliente</th>
<th style="text-align:center">Total</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Tipo Pago</th>
<th style="text-align:center">Forma Pago</th>
<th style="text-align:center">Tipo</th>
<?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
<th style="text-align:center">Imp</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_mantenimiento 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_cod_factura $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_venta DESC LIMIT 0, 800";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

$cod_info_factura_venta        = $datos_total_tipo_factura['cod_info_factura_venta'];
$cod_factura                   = $datos_total_tipo_factura['cod_factura'];
$cod_tercero                   = $datos_total_tipo_factura['cod_tercero'];
$vlr_cancelado                 = $datos_total_tipo_factura['vlr_cancelado'];
$vlr_vuelto                    = $datos_total_tipo_factura['vlr_vuelto'];
$fecha_anyo                    = $datos_total_tipo_factura['fecha_anyo'];
$fecha_hora                    = $datos_total_tipo_factura['fecha_hora'];
$cod_tipo_pago                 = $datos_total_tipo_factura['cod_tipo_pago'];
$cod_administrador             = $datos_total_tipo_factura['cod_administrador'];
$total_precio_compra           = $datos_total_tipo_factura['total_precio_compra'];
$total_precio_venta            = $datos_total_tipo_factura['total_precio_venta'];
$cod_dependencia               = $datos_total_tipo_factura['cod_dependencia'];
$cod_tipo_forma_pago           = $datos_total_tipo_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura           = $datos_total_tipo_factura['nombre_tipo_factura'];
$nombre_tipo_moneda            = $datos_total_tipo_factura['nombre_tipo_moneda'];
$total_datos_data              = $datos_total_tipo_factura['total_datos_data'];

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
?>
<tr id="<?php echo $cod_info_factura_venta;?>">
<?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
<td id="edit<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/edit_factura_mantenimiento.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<!--<td class="service_list" id="cod_info_factura_venta<?php echo $cod_info_factura_venta ?>" data="<?php echo $cod_info_factura_venta ?>"><a class="eliminar" id="cod_info_factura_venta<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center" id="cod_factura<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo str_pad($cod_factura, 8, "0", STR_PAD_LEFT)?></td>
<td style="text-align:left" id="nombre_empresa<?php echo $cod_info_factura_venta;?>" style="text-align:left"><?php echo $nombre_tercero?></td>
<td style="text-align:right" id="nombre_empresa<?php echo $cod_info_factura_venta;?>" style="text-align:left"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center" id="fecha_hora<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $nombre_tipo_pago?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $nombre_tipo_factura?></td>
<?php if ($cod_estado_prod_fecha_mantenimiento == '1') { ?>
<td style="text-align:center" id="edit<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/mantenimiento_productos_opcion_imprimir.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos_peq2.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<!--
<td id="excel<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
<td id="lista<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
-->
</tr id="<?php echo $cod_info_factura_venta;?>">
<?php } ?>
</tbody>
</table>
<?php } ?>

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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_venta).fadeOut("slow");
                $('#edit'+cod_info_factura_venta).fadeOut("slow");
                $('#excel'+cod_info_factura_venta).fadeOut("slow");
                $('#imp'+cod_info_factura_venta).fadeOut("slow");
                $('#lista'+cod_info_factura_venta).fadeOut("slow");
                $('#tr'+cod_info_factura_venta).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

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