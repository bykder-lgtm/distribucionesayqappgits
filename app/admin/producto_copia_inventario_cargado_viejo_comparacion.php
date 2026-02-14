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
if (last != valor)
myajax.Link('guardar_producto_copia_inventario_comentario_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
$tipo                        = 'eliminar';
$tab                         = 'elim_productos_copia_inventario';

if (isset($_GET['cod_info_producto_copia_inventario'])) {
    $cod_info_producto_copia_inventario          = intval($_GET['cod_info_producto_copia_inventario']);
    //-------------------------------------------------------------------------------------------------------------//
    $sql_info_factura = "SELECT * FROM tbl15_info_producto_copia_inventario  WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    $info_info_factura = mysqli_fetch_assoc($resultado_info_factura);
    //-------------------------------------------------------------------------------------------------------------//
    $total_precio_compra_producto_inv_viejo      = $info_info_factura['total_precio_compra_producto_inv_viejo'];
    $total_precio_costo_producto_inv_viejo       = $info_info_factura['total_precio_costo_producto_inv_viejo'];
    $total_precio_venta_producto_inv_viejo       = $info_info_factura['total_precio_venta_producto_inv_viejo'];
    $total_precio_compra_producto_inv_nuevo      = $info_info_factura['total_precio_compra_producto_inv_nuevo'];
    $total_precio_costo_producto_inv_nuevo       = $info_info_factura['total_precio_costo_producto_inv_nuevo'];
    $total_precio_venta_producto_inv_nuevo       = $info_info_factura['total_precio_venta_producto_inv_nuevo'];
    $fecha_copia_inventario                      = $info_info_factura['fecha_copia_inventario'];
    $hora_copia_inventario                       = $info_info_factura['hora_copia_inventario'];
    $cod_administrador                           = $info_info_factura['cod_administrador'];
    $fecha_creacion                              = $info_info_factura['fecha_creacion'];
    $fecha_modificacion                          = $info_info_factura['fecha_modificacion'];
    $total_reg                                   = $info_info_factura['total_reg'];
    $cod_estado_inventario_a_cero                = $info_info_factura['cod_estado_inventario_a_cero'];
    $cod_estado                                  = $info_info_factura['cod_estado'];
    //-------------------------------------------------------------------------------------------------------------//
    $sql_copia_inventario_sobra = "SELECT SUM((und_producto_nuevo - und_producto_viejo)*precio_costo_producto) AS total_precio_costo_inv_sobra, 
    SUM((und_producto_nuevo - und_producto_viejo)*precio_compra_producto) AS total_precio_compra_inv_sobra, 
    SUM((und_producto_nuevo - und_producto_viejo)*precio_venta_producto) AS total_precio_venta_inv_sobra 
    FROM tbl15_producto_copia_inventario 
    WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
    AND ((und_producto_nuevo - und_producto_viejo) > 0) AND (fecha_actualizacion <> '') ORDER BY fecha_modificacion";
    $resultado_copia_inventario_sobra = mysqli_query($conectar, $sql_copia_inventario_sobra) or die(mysqli_error($conectar));
    $info_copia_inventario_sobra = mysqli_fetch_assoc($resultado_copia_inventario_sobra);

    $total_precio_costo_inv_sobra                = $info_copia_inventario_sobra['total_precio_costo_inv_sobra'];
    $total_precio_compra_inv_sobra               = $info_copia_inventario_sobra['total_precio_compra_inv_sobra'];
    $total_precio_venta_inv_sobra                = $info_copia_inventario_sobra['total_precio_venta_inv_sobra'];
    //-------------------------------------------------------------------------------------------------------------//
    $sql_copia_inventario_falta = "SELECT SUM((und_producto_nuevo - und_producto_viejo)*precio_costo_producto) AS total_precio_costo_inv_sobra, 
    SUM((und_producto_nuevo - und_producto_viejo)*precio_compra_producto) AS total_precio_compra_inv_sobra, 
    SUM((und_producto_nuevo - und_producto_viejo)*precio_venta_producto) AS total_precio_venta_inv_falta 
    FROM tbl15_producto_copia_inventario 
    WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
    AND ((und_producto_nuevo - und_producto_viejo) < 0) AND (fecha_actualizacion <> '') ORDER BY fecha_modificacion";
    $resultado_copia_inventario_falta = mysqli_query($conectar, $sql_copia_inventario_falta) or die(mysqli_error($conectar));
    $info_copia_inventario_falta = mysqli_fetch_assoc($resultado_copia_inventario_falta);

    $total_precio_venta_inv_falta                = $info_copia_inventario_falta['total_precio_venta_inv_falta'];
    //-------------------------------------------------------------------------------------------------------------//
    $total_precio_venta_desfase_inv_caja_fisica  = (($total_precio_venta_inv_falta * -1));
    //$total_precio_venta_desfase_inv_caja_fisica = (($total_precio_venta_inv_falta * -1) - $total_sobra_caja_fisica);
    $total_desfase_inv_caja_fisica_precio_venta_redondeado = round($total_precio_venta_desfase_inv_caja_fisica, 1, PHP_ROUND_HALF_DOWN) * -1;

    //-------------------------------------------------------------------------------------------------------------//
    //-------------------------------------------------------------------------------------------------------------//
    $calculos_inventario_copia = "SELECT SUM(und_producto_nuevo * precio_compra_producto) AS total_precio_compra_producto_inv_nuevo, SUM(und_producto_nuevo * precio_venta_producto) AS total_precio_venta_producto_inv_nuevo, 
    SUM(und_producto_viejo * precio_compra_producto) AS total_precio_compra_producto_inv_viejo, SUM(und_producto_viejo * precio_venta_producto) AS total_precio_venta_producto_inv_viejo 
    FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (fecha_actualizacion <> '')";
    $consulta_calculos_inventario_copia = mysqli_query($conectar, $calculos_inventario_copia) or die(mysqli_error($conectar));
    $matriz_inventario_copia = mysqli_fetch_assoc($consulta_calculos_inventario_copia);

    $total_precio_compra_producto_inv_nuevo        = $matriz_inventario_copia['total_precio_compra_producto_inv_nuevo'];
    $total_precio_venta_producto_inv_nuevo         = $matriz_inventario_copia['total_precio_venta_producto_inv_nuevo'];
    $total_precio_compra_producto_inv_viejo        = $matriz_inventario_copia['total_precio_compra_producto_inv_viejo'];
    $total_precio_venta_producto_inv_viejo         = $matriz_inventario_copia['total_precio_venta_producto_inv_viejo'];

    $total_desfase_precio_compra_inv               = $total_precio_compra_producto_inv_nuevo - $total_precio_compra_producto_inv_viejo;
    $total_desfase_precio_venta_inv                = $total_precio_venta_producto_inv_nuevo - $total_precio_venta_producto_inv_viejo;
    //-------------------------------------------------------------------------------------------------------------//
    //-------------------------------------------------------------------------------------------------------------//
    $calculos_inventario_venta_sobra = "SELECT SUM((und_producto_nuevo - und_producto_viejo) * precio_compra_producto) AS total_precio_compra_producto_inv_sobra, 
    SUM((und_producto_nuevo - und_producto_viejo) * precio_venta_producto) AS total_precio_venta_producto_inv_sobra
    FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
    AND (fecha_actualizacion <> '') AND ((und_producto_nuevo - und_producto_viejo) > '0')";
    $consulta_calculos_inventario_venta_sobra = mysqli_query($conectar, $calculos_inventario_venta_sobra) or die(mysqli_error($conectar));
    $matriz_inventario_venta_sobra = mysqli_fetch_assoc($consulta_calculos_inventario_venta_sobra);

    $total_precio_compra_producto_inv_sobra        = $matriz_inventario_venta_sobra['total_precio_compra_producto_inv_sobra'];
    $total_precio_venta_producto_inv_sobra         = $matriz_inventario_venta_sobra['total_precio_venta_producto_inv_sobra'];
    //-------------------------------------------------------------------------------------------------------------//
    //-------------------------------------------------------------------------------------------------------------//
    $calculos_inventario_venta_falta = "SELECT SUM((und_producto_nuevo - und_producto_viejo) * precio_compra_producto) AS total_precio_compra_producto_inv_falta, 
    SUM((und_producto_nuevo - und_producto_viejo) * precio_venta_producto) AS total_precio_venta_producto_inv_falta
    FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
    AND (fecha_actualizacion <> '') AND ((und_producto_nuevo - und_producto_viejo) < '0')";
    $consulta_calculos_inventario_venta_falta = mysqli_query($conectar, $calculos_inventario_venta_falta) or die(mysqli_error($conectar));
    $matriz_inventario_venta_falta = mysqli_fetch_assoc($consulta_calculos_inventario_venta_falta);

    $total_precio_compra_producto_inv_falta        = $matriz_inventario_venta_falta['total_precio_compra_producto_inv_falta'];
    $total_precio_venta_producto_inv_falta         = $matriz_inventario_venta_falta['total_precio_venta_producto_inv_falta'];
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
?>
    <table class="table table-striped">
        <tr>
            <th style="text-align:center"><font size='+2'>INVENTARIO DE PRODUCTOS COPIA <?php echo $cod_info_producto_copia_inventario ?></font></th>
        </tr>
        <?php if ($cod_estado == '0') { ?>
        <?php if ($cod_estado_inventario_a_cero == '0') { ?>
        <tr>
            <th style="text-align:center"><a href="../admin/pregunta_inventario_a_cero.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>"><font size='+2'>LLEVAR INVENTARIO A CERO</font></a></th>
        </tr>
        <?php } ?>
        <?php } ?>
    </table>

          
    <table class="table table-striped">
    <thead>
    <tr>
    <th style="text-align:center"><a href="../admin/producto_copia_inventario_con_existencia_no_cargados.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">CON EXISTENCIA NO CARGADO</a></th>
    <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_sobrantes.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">SOBRANTES</a></th>
    <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_faltantes.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">FALTANTES</a></th>
    <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_correctos.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">CORRECTOS</a></th>
    </tr>
    </thead>
    </table>

    <table class="table table-striped">
        <tbody>
        <tr>           
            <th style="text-align:center">ID INVENTARIO</th>
            <th style="text-align:center">TOTAL INV VIEJO (P.COMPRA)</th>
            <th style="text-align:center">TOTAL INV NUEVO (P.VENTA)</th>
            <th style="text-align:center">TOTAL INV VIEJO (P.VENTA)</th>
            <th style="text-align:center">SOBRAN INV (P.VENTA)</th>
            <th style="text-align:center">FALTAN INV (P.VENTA)</th>
            <th style="text-align:center">DESFASE TOTAL INV (P.VENTA)</th>
        </tr></tbody>
        <tr>
            <td style="text-align:center"><?php echo $cod_info_producto_copia_inventario; ?></td>
            <td style="text-align:center"><?php echo number_format($total_precio_compra_producto_inv_viejo, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_nuevo, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_viejo, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_sobra, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_falta, 0, ",", "."); ?></td>
            <td style="text-align:center"><?php echo number_format($total_desfase_precio_venta_inv, 0, ",", "."); ?></td>
        </tr>
    </table>
            
    <!--
    <table class="table table-striped">
    <thead>
    <tr>
    <th style="text-align:center">TOTAL INV NUEVO (P.COMPRA)</th>
    <th style="text-align:center">TOTAL COMPRAS (P.COSTO)</th>
    <th style="text-align:center">TOTAL VENTAS (P.VENTA)</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td style="text-align:center"><?php echo $total_reg?></td>
    <td style="text-align:center"><?php echo number_format($total_precio_compra_producto_inv_viejo, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_viejo, 0, ",", ".") ?></td>
    </tr>
    </tbody>
    </table>
    -->
    <div class="table-responsive">
    <table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center">CÓDIGO</th>
            <th style="text-align:center">PRODUCTO</th>
            <th style="text-align:center">INV NUEVO</th>
            <th style="text-align:center">INV VIEJO</th>
            <th style="text-align:center"></th>
            <th style="text-align:center">COMENTARIO</th>
            <th style="text-align:center"></th>
            <th style="text-align:center">P.COMPRA</th>
            <th style="text-align:center">P.VENTA</th>
            <th style="text-align:center">FECHA</th>
            <th style="text-align:center">CUENTA</th>
            <th style="text-align:center">ESTADO CONTEO</th>
            <th style="text-align:center">...</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_info_factura = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (fecha_actualizacion <> '')
    ORDER BY fecha_modificacion DESC";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

        $cod_producto_copia_inventario          = $info_info_factura['cod_producto_copia_inventario'];
        $cod_producto_barra                     = $info_info_factura['cod_producto_barra'];
        $nombre_producto                        = $info_info_factura['nombre_producto'];
        $und_producto_nuevo                     = $info_info_factura['und_producto_nuevo'];
        $und_producto_viejo                     = $info_info_factura['und_producto_viejo'];
        $precio_compra_producto                 = $info_info_factura['precio_compra_producto'];
        $precio_venta_producto                  = $info_info_factura['precio_venta_producto'];
        $comentario_copia_inventario            = $info_info_factura['comentario_copia_inventario'];
        $fecha_actualizacion                    = $info_info_factura['fecha_actualizacion'];
        $cod_administrador                      = $info_info_factura['cuenta'];
        $cod_estado                             = $info_info_factura['cod_estado'];
        $cod_estado_check                       = $info_info_factura['cod_estado_check'];

        $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
        $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
        $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

        $cuenta                                 = $datos_administrador['cuenta'];
        $resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
        if ($cod_estado == '1') { $imagen_estado = "../imagenes/check_escogido.png"; } else { $imagen_estado = "../imagenes/check_vacio.png"; }
        if (($resta < 0 && $cod_estado == '1') && ($cod_estado_check == '0')) { $titulo_resultado = abs($resta)." UNDS FALTAN"; } elseif (($resta > 0 && $cod_estado == '1') && ($cod_estado_check == '0')) { $titulo_resultado = abs($resta)." UNDS SOBRAN"; } elseif (($resta == 0 && $cod_estado == '1') && ($cod_estado_check == '0')) { $titulo_resultado = "BIEN"; } else { $titulo_resultado = ""; }
    ?>
        <tr>
            <td style="text-align:left"><?php echo $cod_producto_barra?></td>
            <td style="text-align:left"><?php echo $nombre_producto?></td>
            <td style="text-align:center"><?php echo $und_producto_nuevo?></td>
            <td style="text-align:center"><?php echo $und_producto_viejo?></td>
            <td style="text-align:left"><?php echo $titulo_resultado?></td>
            <td style="text-align:center"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'comentario_copia_inventario', <?php echo $cod_producto_copia_inventario;?>)" id="<?php echo $cod_producto_copia_inventario;?>" value="<?php echo $comentario_copia_inventario;?>" size="60"></td>
            <td style="text-align:center"></td>
            <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $fecha_actualizacion?></td>
            <td style="text-align:center"><?php echo $cuenta?></td>
            <td style="text-align:center;"><img src="<?php echo $imagen_estado?>"></td>
            <td style="text-align:center;"><?php echo $cod_estado_check?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_compra = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_compra+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_compra+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_compra).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_compra).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_compra).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_compra).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_compra).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_compra).fadeOut("slow");
                $('#edit'+cod_info_factura_compra).fadeOut("slow");
                $('#excel'+cod_info_factura_compra).fadeOut("slow");
                $('#imp'+cod_info_factura_compra).fadeOut("slow");
                $('#lista'+cod_info_factura_compra).fadeOut("slow");
                $('#tr'+cod_info_factura_compra).fadeOut("slow");
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