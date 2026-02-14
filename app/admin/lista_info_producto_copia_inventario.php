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
<!--<a class="btn btn-primary" href="#"><h6>Lista Compra</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
$tipo                        = 'eliminar';
$tab                         = 'tbl15_info_producto_copia_inventario';
$campo                       = 'cod_info_producto_copia_inventario';
$si                          = 'si';

$sql_cod_factura_exportacion = "SELECT MAX(cod_info_producto_copia_inventario) AS cod_info_producto_copia_inventario FROM tbl15_info_producto_copia_inventario WHERE (cod_estado = '0')";
$consulta_cod_factura = mysqli_query($conectar, $sql_cod_factura_exportacion) or die(mysqli_error($conectar));
$cod_factura_exportacion = mysqli_fetch_assoc($consulta_cod_factura);

$cod_info_producto_copia_inventario_info = $cod_factura_exportacion['cod_info_producto_copia_inventario'];

$sql_cod_factura_exportacion = "SELECT cod_info_producto_copia_inventario FROM tbl15_info_producto_copia_inventario WHERE (cod_estado = '1')";
$consulta_cod_factura = mysqli_query($conectar, $sql_cod_factura_exportacion) or die(mysqli_error($conectar));
$existe_inv_inicial = mysqli_num_rows($consulta_cod_factura);
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#">LISTA DE INVENTARIOS</a></th>

        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_inicial.php?si=<?php echo $si ?>&pagina=<?php echo $pagina ?>">CREAR INVENTARIO INICIAL</a></th>

        <?php if ($cod_estado_nuevo_inventario_por_letra_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_alfabetico_por_letra.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO POR LETRA</a></th>
        <?php } ?>

        <?php if ($cod_estado_nuevo_inventario_con_existencia_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_con_existencia.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO CON UND EN EXISTENCIA</a></th>
        <?php } ?>

        <?php if ($cod_estado_nuevo_inventario_por_letra_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_alfabetico_por_letra.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO POR LETRA</a></th>
        <?php } ?>

        <?php if ($cod_estado_nuevo_inventario_por_dependencia_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_por_dependencia.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO POR DEPENDENCIA</a></th>
        <?php } ?>

        <?php if ($cod_estado_prod_nuevo_invenario == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_completo_version2.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO COMPLETO VERSION 2</a></th>
        <?php } ?>

        <?php if ($cod_estado_nuevo_inventario_imediato_venta_simultanea_global == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario_imediato_venta_simultanea.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO INMEDIATO VENTA SIMULTANEA</a></th>
        <?php } ?>
        
        <?php if ($cod_estado_prod_nuevo_invenario == '1') { ?>
        <th style="text-align:center"><a href="../admin/pregunta_producto_copia_inventario.php?pagina=<?php echo $pagina ?>">NUEVO INVENTARIO COMPLETO</a></th>
        <?php } ?>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if ($cod_estado_prod_nuevo_invenario == '1') { ?>
<table class="table table-striped">
<thead>
    <tr>
        <!--<th style="text-align:center">Elm</th>-->
        <th style="text-align:center">ELIM</th>
        <th style="text-align:center">TIPO</th>
        <th style="text-align:center">COPIA</th>
        <th style="text-align:center">DEPENDENCIA</th>
        <th style="text-align:center">FECHA - HORA</th>
        <th style="text-align:center">TOTAL P.COMPRA INV (VIEJO)</th>
        <th style="text-align:center">TOTAL P.VENTA INV (VIEJO)</th>
        <th style="text-align:center">CUENTA</th>
        <th style="text-align:center">VER</th>
        <th style="text-align:center">CARGAR</th>
    </tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_producto_copia_inventario ORDER BY cod_info_producto_copia_inventario DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

    $cod_info_producto_copia_inventario          = $info_info_factura['cod_info_producto_copia_inventario'];
    $cod_factura                                 = $info_info_factura['cod_factura'];
    $total_precio_compra_producto_inv_viejo      = $info_info_factura['total_precio_compra_producto_inv_viejo'];
    $total_precio_costo_producto_inv_viejo       = $info_info_factura['total_precio_costo_producto_inv_viejo'];
    $total_precio_venta_producto_inv_viejo       = $info_info_factura['total_precio_venta_producto_inv_viejo'];
    $fecha_copia_inventario                      = $info_info_factura['fecha_copia_inventario'];
    $hora_copia_inventario                       = $info_info_factura['hora_copia_inventario'];
    $cod_administrador                           = $info_info_factura['cod_administrador'];
    $fecha_creacion                              = $info_info_factura['fecha_creacion'];
    $fecha_modificacion                          = $info_info_factura['fecha_modificacion'];
    $total_reg                                   = $info_info_factura['total_reg'];
    $nombre_tipo_inventario                      = $info_info_factura['nombre_tipo_inventario'];
    $cod_estado                                  = $info_info_factura['cod_estado'];
    $cod_dependencia                             = $info_info_factura['cod_factura'];

    if ($cod_dependencia <> '0') {
        $sql_dependencia = "SELECT * FROM tbl15_dependencia  WHERE (cod_dependencia = '$cod_dependencia')";
        $resultado_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
        $info_dependencia = mysqli_fetch_assoc($resultado_dependencia);

        $nombre_dependencia                          = $info_dependencia['nombre_dependencia'];
    } else {
        $nombre_dependencia                          = 'TODAS';
    }

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                                 = $datos_administrador['cuenta'];

    if ($nombre_tipo_inventario == 'COMPLETO') {
        $url_tipo_inventario = "../admin/cargar_producto_copia_inventario.php";
    } elseif ($nombre_tipo_inventario == 'CON_EXISTENCIA') {
        $url_tipo_inventario = "../admin/producto_copia_inventario_con_existencia_no_cargados_masivo.php";
    } elseif ($nombre_tipo_inventario == 'COMPLETO_VERSION') {
        $url_tipo_inventario = "../admin/producto_copia_inventario_completo_version2.php";
    } else {
        $url_tipo_inventario = "../admin/cargar_producto_copia_inventario.php";
    }


?>
    <tr>
        <td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_info_producto_copia_inventario?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>&tab=<?php echo $tab?>&pagina=<?php echo $pagina?>"><img src=../imagenes/eliminar.png alt="eliminar"></a></td>
        <td style="text-align:center"><?php echo $nombre_tipo_inventario?></td>
        <td style="text-align:center"><?php echo $cod_info_producto_copia_inventario?></td>
        <td style="text-align:center"><?php echo $nombre_dependencia?></td>
        <td style="text-align:center"><?php echo $fecha_copia_inventario.' | '.$hora_copia_inventario?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_compra_producto_inv_viejo, 0, ",", ".") ?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_viejo, 0, ",", ".") ?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><a href="../admin/producto_copia_inventario_cargado_viejo_comparacion.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario?>&pagina=<?php echo $pagina?>"><img src=../imagenes/ver.png alt="Ver"></a></td>
        <?php if ($cod_estado == '0') { ?>
        <?php if ($cod_info_producto_copia_inventario == $cod_info_producto_copia_inventario_info) { ?>
        <td style="text-align:center"><a href="<?php echo $url_tipo_inventario?>?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario?>&pagina=<?php echo $pagina?>"><img src=../imagenes/mas2.png alt="mas"></a></td>
        <?php } ?>
        <?php } else  { ?>
        <td style="text-align:center">INVENTARIO INICIAL</td>
        <?php } ?>
    </tr>
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