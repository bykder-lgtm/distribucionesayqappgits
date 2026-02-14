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
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

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

    $sql_producto_con_existencia_no_cargado = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') ORDER BY cod_producto_copia_inventario DESC";
    $resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_producto_con_existencia_no_cargado) or die(mysqli_error($conectar));
    $total_producto_con_existencia_no_cargado = mysqlI_num_rows($resultado_producto_con_existencia_no_cargado);

    $sql_info_factura = "SELECT * FROM tbl15_info_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
    $resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
    $info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

    $total_reg                                   = $info_info_factura['total_reg'];
    $fecha_copia_inventario                      = $info_info_factura['fecha_copia_inventario'];
    $hora_copia_inventario                       = $info_info_factura['hora_copia_inventario'];
    $nombre_tipo_inventario                      = $info_info_factura['nombre_tipo_inventario'];
    $cod_administrador                           = $info_info_factura['cod_administrador'];
    $nombre_promocion                            = $info_info_factura['nombre_promocion'];
    $nombre_estado                               = $info_info_factura['nombre_estado'];
    $cod_estado                                  = $info_info_factura['cod_estado'];
?>
    <table class="table table-striped">
        <tbody>
            <tr>
            <th style="text-align:center"><a>INVENTARIO DE PRODUCTOS <?php echo $nombre_tipo_inventario ?></a></th>
        </tr>
    </tbody>
    </table>

    <form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/producto_copia_inventario_masivo_reg.php">
        <table class="table table-striped">
            <tr>
                <th style="text-align:center">ID INVENTARIO</th>
                <th style="text-align:center">TOTAL REG</th>
                <th style="text-align:center">FECHA CREACION</th>
                <th style="text-align:center">HORA CREACION</th>
                <th style="text-align:center">TIPO INVENTARIO</th>
                <th style="text-align:center">OBSERVACION</th>
                <th style="text-align:center">GUARDAR</th>
            </tr>
            <tr>
                <td style="text-align:center"><?php echo $cod_info_producto_copia_inventario?></td>
                <td style="text-align:center"><?php echo $total_reg?></td>
                <td style="text-align:center"><?php echo $fecha_copia_inventario?></td>
                <td style="text-align:center"><?php echo $hora_copia_inventario ?></td>
                <td style="text-align:center"><?php echo $nombre_tipo_inventario ?></td>
                <td style="text-align:center"><input type="text" name="nombre_promocion" value="<?php echo ($nombre_promocion) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" required/></td>
                <td style="text-align:center"><input type="submit" value="Guardar Inventario" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
                <input type="hidden" name="cod_info_producto_copia_inventario" value="<?php echo ($cod_info_producto_copia_inventario) ?>"/>
            </tr>
        </table>
    </form>

    <table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center">PRODUCTO</th>
            <th style="text-align:center">CÓDIGO</th>
            <th style="text-align:center">INV NUEVO</th>
            <th style="text-align:center">INV VIEJO</th>
            <th style="text-align:center">RESULTADO</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">P.COMPRA</th>
            <th style="text-align:center">P.VENTA</th>
            <th style="text-align:center">COPIA</th>
            <th style="text-align:center">...</th>
        </tr>
    </thead>
    <tbody>
    <?php

    while ($info_producto_con_existencia_no_cargado = mysqli_fetch_assoc($resultado_producto_con_existencia_no_cargado)) {

        $cod_producto_copia_inventario          = $info_producto_con_existencia_no_cargado['cod_producto_copia_inventario'];
        $cod_producto_barra                     = $info_producto_con_existencia_no_cargado['cod_producto_barra'];
        $nombre_producto                        = $info_producto_con_existencia_no_cargado['nombre_producto'];
        $und_producto_nuevo                     = $info_producto_con_existencia_no_cargado['und_producto_nuevo'];
        $und_producto_viejo                     = $info_producto_con_existencia_no_cargado['und_producto_viejo'];
        $precio_compra_producto                 = $info_producto_con_existencia_no_cargado['precio_compra_producto'];
        $precio_venta_producto                  = $info_producto_con_existencia_no_cargado['precio_venta_producto'];
        $comentario_copia_inventario            = $info_producto_con_existencia_no_cargado['comentario_copia_inventario'];
        $fecha_actualizacion                    = $info_producto_con_existencia_no_cargado['fecha_actualizacion'];
        $cod_administrador                      = $info_producto_con_existencia_no_cargado['cuenta'];
        $cod_estado                             = $info_producto_con_existencia_no_cargado['cod_estado'];

        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_nuevo = intval($und_producto_nuevo); } else { $und_producto_nuevo = $und_producto_nuevo; }
        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_viejo = intval($und_producto_viejo); } else { $und_producto_viejo = $und_producto_viejo; }
        if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
        if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
        if ($cod_estado == '1') { $imagen_estado = "../imagenes/spam_reg.png"; } else { $imagen_estado = "../imagenes/btn_revisado.gif"; }

        $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
        $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
        $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

        $cuenta                                 = $datos_administrador['cuenta'];
        $resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
        if ($resta < 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS FALTAN"; } elseif ($resta > 0 && $cod_estado == '1') { $titulo_resultado = abs($resta)." UNDS SOBRAN"; } elseif ($resta == 0 && $cod_estado == '1') { $titulo_resultado = "BIEN"; } else { $titulo_resultado = ""; }
    ?>
        <tr>
            <td style="text-align:left"><?php echo $cod_producto_barra?></td>
            <td style="text-align:left"><?php echo $nombre_producto?></td>
            <td style="text-align:center"><input type="text" name="und_producto_nuevo" value="<?php echo ($und_producto_nuevo) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" /></td>
            <td style="text-align:center"><?php echo $und_producto_viejo?></td>
            <td style="text-align:center" id="mensaje<?php echo $cod_producto_copia_inventario ?>"><?php echo $titulo_resultado?></td>
            <td style="text-align:left"><input type="text" name="comentario_copia_inventario" value="<?php echo ($comentario_copia_inventario) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" style="width: 200px"/></td>
            <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $cod_info_producto_copia_inventario?></td>
            <td style="text-align:center" id="resultado_transaccion<?php echo $cod_producto_copia_inventario ?>"><img src="<?php echo $imagen_estado?>"></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
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

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_producto_copia_inventario";
        let id = this.id;
        var campo_incre = id;

        var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_producto_copia_inventario_masivo_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#'+campo+''+id).html('<img src="../imagenes/loading.gif">');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var campo = respuesta.emisor;
                var mensaje = respuesta.mensaje;
                if ((afectado == 'SI' && (campo == 'und_producto_nuevo'))) {
                    $('#resultado_transaccion'+id).html('');
                    $('#resultado_transaccion'+id).html('<img src="../imagenes/spam_reg.png">');
                    $('#mensaje'+id).html(''+mensaje);
                } else {
                    $('#resultado_transaccion'+id).html('');
                    $('#resultado_transaccion'+id).html('Error');
                }
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