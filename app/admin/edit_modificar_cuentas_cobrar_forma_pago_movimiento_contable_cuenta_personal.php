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

<div class="breadcrumbs"></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['cod_cuentas_cobrar_abonos'])) {
    $cod_cuentas_cobrar_abonos                         = intval($_GET['cod_cuentas_cobrar_abonos']);
    $cod_movimiento_contable_cuenta_personal           = intval($_GET['cod_movimiento_contable_cuenta_personal']);
    $cod_tercero                                       = intval($_GET['cod_tercero']);
    $cod_cuentas_cobrar                                = intval($_GET['cod_cuentas_cobrar']);
    $cliente                                           = addslashes($_GET['cliente']);
    $pagina                                            = addslashes($_GET['pagina']);
    $pagina_local                                      = $_SERVER['PHP_SELF'];

    $calcular_datos_cuenta_cobrar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar 
    FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $total_monto_deuda_cuenta_cobrar                   = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
    $total_subtotal_cuenta_cobrar                      = intval($datos_cuenta_cobrar['total_subtotal_cuenta_cobrar']);
    $total_abonado_cuenta_cobrar                       = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];
    $identificacion_tercero                            = $datos_cuenta_cobrar['identificacion_tercero'];
    $nombre1_tercero                                   = $datos_cuenta_cobrar['nombre1_tercero'];
    $apellido1_tercero                                 = $datos_cuenta_cobrar['apellido1_tercero'];
    $nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
    $cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

    $sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
    $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    $total_datos = mysqli_num_rows($consulta);
    $datos = mysqli_fetch_assoc($consulta);

    $cod_cuentas_cobrar_abonos                         = $datos['cod_cuentas_cobrar_abonos'];
    $abonado                                           = $datos['abonado'];
    $cuenta                                            = $datos['cuenta'];
    $mensaje                                           = $datos['mensaje'];
    $fecha_pago                                        = $datos['fecha_pago'];
    $hora                                              = $datos['hora'];
    $cod_dependencia                                   = $datos['cod_dependencia'];
    $cod_tipo_forma_pago                               = $datos['cod_tipo_forma_pago'];

    $sql_datos_movimiento_contable_cuenta_personal = "SELECT nombre_puc, cod_tipo_forma_pago FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
    $consulta_datos_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal);
    $datos_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal);

    $nombre_puc                                        = $datos_movimiento_contable_cuenta_personal['nombre_puc'];
    $cod_tipo_forma_pago                               = $datos_movimiento_contable_cuenta_personal['cod_tipo_forma_pago'];

    $sql_datos_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $consulta_datos_tipo_forma_pago = mysqli_query($conectar, $sql_datos_tipo_forma_pago);
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_datos_tipo_forma_pago);

    $nombre_tipo_forma_pago                            = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];

    $sql_datos_cuenta_cobrar = "SELECT cod_factura FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $cod_factura                                       = $datos_cuenta_cobrar['cod_factura'];
    ?>
    <div class="table-responsive">

    <table class="table table-striped">
    <tr>
    <td style="text-align:center"><strong><a href="../admin/modificar_cuentas_cobrar.php?cod_tercero=<?php echo $cod_tercero;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cliente=<?php echo $cliente;?>"><font size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
    <td style="text-align:center"><strong><font size="6px">CLIENTE: <?php echo $cliente; ?></font></strong></td>
    </tr>
    </table>

    <br>

    <form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/edit_modificar_cuentas_cobrar_forma_pago_movimiento_contable_cuenta_personal_reg.php">
    <table class="table table-striped">
        <tr>
            <th style="text-align:center">VALOR ABONO</th>
            <th style="text-align:center">FORMA DE PAGO ANTERIOR</th>
            <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?><th style="text-align:center">FORMA DE PAGO NUEVO Y CUENTA PERSONAL</th><?php } ?>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo number_format($abonado, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo $nombre_puc.' | '.$nombre_tipo_forma_pago.' | '.$cod_movimiento_contable_cuenta_personal; ?></td>

        <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
            <td style="text-align:center">
                <select name="cod_movimiento_contable_cuenta_personal_nuevo" id="cod_movimiento_contable_cuenta_personal_nuevo" style="width: 300px;" required>
                    <?php echo "<option value='' >Selecione</option>";
                    $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc, cod_tipo_forma_pago FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal <> '$cod_movimiento_contable_cuenta_personal')ORDER BY nombre_puc ASC";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {

                        $cod_tipo_forma_pago = $datos2['cod_tipo_forma_pago'];

                        $sql_datos_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
                        $consulta_datos_tipo_forma_pago = mysqli_query($conectar, $sql_datos_tipo_forma_pago);
                        $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_datos_tipo_forma_pago);

                        $nombre_tipo_forma_pago                            = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];

                        $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
                        $nombre = $datos2['nombre_puc'].' | '.$nombre_tipo_forma_pago.' | '.$codigo;
                        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } 
                    ?>
                </select>
            </td>
        <?php } ?>
        </tr>
    </table>
    <input type="hidden" name="MM_update" value="formulario_de_actualizacion">
    <input type="hidden" name="cod_cuentas_cobrar_abonos" value="<?php echo $cod_cuentas_cobrar_abonos; ?>">
    <input type="hidden" name="cod_movimiento_contable_cuenta_personal_viejo" value="<?php echo $cod_movimiento_contable_cuenta_personal; ?>">
    <input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
    <input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar; ?>">
    <input type="hidden" name="cliente" value="<?php echo $cliente; ?>">
    <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">

    <tr valign="baseline">
    <td nowrap align="right">&nbsp;</td>
    <td bordercolor="1"><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
    <input type="hidden" name="insertar_datos" value="formulario">
    </tr>
    </form>

    </div>

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