<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--
<script src="js/jquery-1.12.3.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery.dataTables.min.css">
-->
<!--<link href="../estilo_css/custom.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="../estilo_css/micss.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = $_SERVER['PHP_SELF']; ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a class="btn btn-info" href="#">Reporte Alquiler Pagado Inquilinos</a></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** --> 
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<?php
/* ******************************************************************************************************************************** */
/* ******************************************************************************************************************************** */
$fecha                                   = date("Y-m-d");
$fecha_hoy                               = date("Y-m-d");

if (isset($_GET['fecha_pago_reg_ini'])) {
    $fecha_pago_reg_ini                      = addslashes($_GET['fecha_pago_reg_ini']);
    $fecha_pago_reg_fin                      = addslashes($_GET['fecha_pago_reg_fin']);
    $cod_administrador                       = intval($_GET['cod_administrador']);
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
    $cod_estado                              = intval($_GET['cod_estado']);

    if ($cod_administrador==0) {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_cuentas_cobrar_alerta.cod_administrador = '$cod_administrador')";
    }


} else {
    $fecha_pago_reg_ini            = date("Y-m-d");
    $fecha_pago_reg_fin            = date("Y-m-d");
    $cod_administrador                       = 0;
    $cod_tercero                             = 0;
    $cod_tipo_forma_pago                     = 0;
    //$cod_estado                              = 1;
}
/* ******************************************************************************************************************************** */
/* ******************************************************************************************************************************** */
if ($cod_administrador==0) {
    $cuenta_get                                  = 'TODOS';
} else {
    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta_get                                  = $datos_administrador['cuenta'];
}
/* ******************************************************************************************************************************** */
if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'];
}
/* ******************************************************************************************************************************** */
if ($cod_tipo_forma_pago==0) {
    $nombre_tipo_forma_pago_get                        = 'TODOS';
} else {
    $sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

    $nombre_tipo_forma_pago_get                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
}
/* ******************************************************************************************************************************** */
?>
<form action="" id="" method="GET">

    <table class="table table-striped" cellspacing="0" cellpadding="20">
      <tr>
        <th style="text-align:center;">FECHA INICIAL</th>
        <th style="text-align:center;">FECHA FINAL</th>
        <th style="text-align:center;">FORMA PAGO</th>
      </tr>
      <tr>
        <td style="text-align:center;"><input class="input-block-level" name="fecha_pago_reg_ini" type="date" value="<?php echo $fecha_pago_reg_ini ?>" style="width: 140px;" required/></td>
        <td style="text-align:center;"><input class="input-block-level" name="fecha_pago_reg_fin" type="date" value="<?php echo $fecha_pago_reg_fin ?>" style="width: 140px;" required/></td>
        <td style="text-align:center;">
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
      </tr>
      <tr>
        <th style="text-align:center;">INQUILINO</th>
        <th style="text-align:center;">ESTADO</th>
        <th style="text-align:center;">USUARIO</th>
      </tr>
      <tr>
        <td style="text-align:left;">
            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'INQUILINO' ORDER BY nombre1_tercero ASC";
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
            <select name="cod_estado" id="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($cod_estado)) { echo "<option value='1' $seleccionado >TODOS</option>"; } else { echo "<option value='1' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT cod_estado_pago, nombre_estado_pago FROM tbl15_estado_pago WHERE (cod_estado = '1') ORDER BY nombre_estado_pago ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_estado) AND $cod_estado == $datos2['cod_estado_pago']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_estado_pago'];
                $nombre = $datos2['nombre_estado_pago'].' '.$datos2['apellido1_tercero'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
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
      </tr>
    </table>
    <div class="actions"><input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></div>
</form>

<?php if (isset($_GET['fecha_pago_reg_ini'])) { 
    if ($cod_administrador==0) {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_cuentas_cobrar_alerta.cod_administrador = '$cod_administrador')";
    }
    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_cuentas_cobrar_alerta.cod_tercero = '$cod_tercero')";
    }
    if ($cod_tipo_forma_pago==0) {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_cuentas_cobrar_alerta.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }
    if ($cod_estado==0) {
        $filtro_consulta_estado = "";
        $filtro_consulta_estado_rel = "";
    } else {
        $filtro_consulta_estado = "AND (cod_estado = '$cod_estado')";
        $filtro_consulta_estado_rel = "AND (tbl15_cuentas_cobrar_alerta.cod_estado = '$cod_estado')";
    }
?>
    <table class="table table-bordered table-hover table-sm">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">CONTRATO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">INQUILINO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">MES</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">TOTAL PAGAR</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">TOTAL RECIBIDO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">INTERESES</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">INGRESO JURIDICA (ARRIENDO)</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">REG PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">FORMA PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ESTADO PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ARCH</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; font-size: 15px">ID</th>
        </tr>
    <?php
    $total_pagar_inquilino                             = 0;
    $total_recibido_pago_inquilino                     = 0;
    $total_ingreso_por_interes_inquilino               = 0;
    $total_otros_ingresos_juridica_arriendo            = 0;

    $calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_estado ORDER BY fecha_pago DESC";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
    $total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
    while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

        $cod_cuentas_cobrar_alerta                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
        $cod_cuentas_cobrar                            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
        $numero_alerta                                 = $datos_cuenta_cobrar['numero_alerta'];
        $cod_factura                                   = $datos_cuenta_cobrar['cod_factura'];
        $monto_deuda                                   = $datos_cuenta_cobrar['monto_deuda'];
        $abonado                                       = $datos_cuenta_cobrar['abonado'];
        $subtotal                                      = $datos_cuenta_cobrar['subtotal'];
        $mensaje                                       = $datos_cuenta_cobrar['mensaje'];
        $fecha_pago                                    = $datos_cuenta_cobrar['fecha_pago'];
        $vendedor                                      = $datos_cuenta_cobrar['vendedor'];
        $monto_cuota                                   = $datos_cuenta_cobrar['monto_cuota'];
        $cod_estado                                    = $datos_cuenta_cobrar['cod_estado'];
        $fecha_pago_reg                                = $datos_cuenta_cobrar['fecha_pago_reg'];
        $hora_pago_reg                                 = $datos_cuenta_cobrar['hora_pago_reg'];
        $cod_cuentas_cobrar_abonos                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
        $url_img_orig_producto                         = $datos_cuenta_cobrar['url_img_orig_producto'];
        $total_recibido                                = $datos_cuenta_cobrar['total_recibido'];
        $total_pendiente                               = $datos_cuenta_cobrar['total_pendiente'];
        $cod_renovacion_contrato                       = $datos_cuenta_cobrar['cod_renovacion_contrato'];
        $cod_tercero                                   = $datos_cuenta_cobrar['cod_tercero'];
        $cod_tipo_forma_pago                           = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
        $total_pagar                                   = $datos_cuenta_cobrar['total_pagar'];
        $monto_cuota_interes                           = $datos_cuenta_cobrar['monto_cuota_interes'];
        $cod_estado_archivado                          = $datos_cuenta_cobrar['cod_estado_archivado'];
        $ingreso_gasto_juridica                        = $datos_cuenta_cobrar['ingreso_gasto_juridica'];
        $nombre_producto                               = $datos_cuenta_cobrar['nombre_producto'];

        $fecha_mes                                     = $datos_cuenta_cobrar['fecha_mes'];
        $nombre_tabla_anyo                             = $datos_cuenta_cobrar['anyo'];
        $cod_estado_envio_correo_cuenta_cobro          = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
        $cod_estado_envio_correo_comprobante_ingreso   = $datos_cuenta_cobrar['cod_estado_envio_correo_comprobante_ingreso'];
        $fecha_mes_complet                             = $fecha_mes.'-01';

        $cod_estado_pago                               = 1;
        $fecha_pago_dmy                                = date("d-m-Y", strtotime($fecha_pago));
        if ($fecha_pago_reg <> '') { $fecha_pago_reg_dmy = date("d-m-Y", strtotime($fecha_pago_reg)); } else { $fecha_pago_reg_dmy = ""; }

        $nombre_tabla_mes                              = date("m", strtotime($fecha_mes_complet));

        $mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        $matriz_consulta = mysqli_fetch_assoc($consulta);

        $nombre_letra_tabla_mes                   = $matriz_consulta['nombre_letra_tabla_mes'];

        $sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
        $consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
        $matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

        $nombre_estado_pago             = $matriz_estado_pago['nombre_estado_pago'];
        $color_fondo_celda_estado_pago  = $matriz_estado_pago['color_fondo_celda_estado_pago'];
        $color_letra_celda_estado_pago  = $matriz_estado_pago['color_letra_celda_estado_pago'];

        $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
        $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
        $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

        $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

        $sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
        $total_inquilino = mysqli_fetch_assoc($consulta_inquilino);

        $identificacion_tercero_inquilino         = $total_inquilino['identificacion_tercero'];
        $nombre1_tercero_inquilino                = $total_inquilino['nombre1_tercero'];
        $nombre2_tercero_inquilino                = $total_inquilino['nombre2_tercero'];
        $apellido1_tercero_inquilino              = $total_inquilino['apellido1_tercero'];
        $apellido2_tercero_inquilino              = $total_inquilino['apellido2_tercero'];

        $total_pagar_inquilino                   += $total_pagar;
        $total_recibido_pago_inquilino           += $total_recibido;
        $total_ingreso_por_interes_inquilino     += $monto_cuota_interes;
        $total_otros_ingresos_juridica_arriendo  += $ingreso_gasto_juridica;
    ?>
        <tr>
            <td style="text-align: center;"><?php echo $cod_factura ;?></td>
            <td style="text-align: left;"><?php echo $nombre1_tercero_inquilino ;?></td>
            <td style="text-align: center;"><?php echo $nombre_letra_tabla_mes ;?></td>
            <td style="text-align: center;"><?php echo number_format($total_pagar, 0, ",", ".") ?></a></td>
            <td style="text-align: center;"><?php echo number_format($total_recibido, 0, ",", ".") ?></a></td>
            <td style="text-align: center;"><?php echo number_format($monto_cuota_interes, 0, ",", ".") ?></a></td>
            <td style="text-align: center;"><?php echo number_format($ingreso_gasto_juridica, 0, ",", ".") ?></a></td>
            <td style="text-align: center;"><?php echo $fecha_pago_reg_dmy;?></td>
            <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago;?></td>
            <td style="text-align: center;"><?php echo $nombre_estado_pago;?></td>
            <td style="text-align: center;"><?php echo $cod_estado_archivado;?></td>
            <td style="text-align: center;"><?php echo $cod_cuentas_cobrar_alerta;?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_pagar_inquilino, 0, ",", ".") ?></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_recibido_pago_inquilino, 0, ",", ".") ?></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_interes_inquilino, 0, ",", ".") ?></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_otros_ingresos_juridica_arriendo, 0, ",", ".") ?></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>
<?php } ?>
    </div><!-- /page content -->
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->