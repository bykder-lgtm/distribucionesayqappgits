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

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="row-fluid">
<div class="span12" id="divMain">

<?php 
$pagina = $_SERVER['PHP_SELF']; 
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }
if (isset($_GET['foco_check'])) { $foco_check = $_GET['foco_check']; } else { $foco_check = ''; }
if (isset($_GET['cod_producto_copia_inventario_get'])) { $cod_producto_copia_inventario_get = intval($_GET['cod_producto_copia_inventario_get']); } else { $cod_producto_copia_inventario_get = ''; }
?>
<div class="container body">
    <div class="right_col" role="main"> <!-- page content -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php //include_once("../modal/modal_registrar_producto.php"); ?>
<?php //include_once("../modal/modal_actualizar_producto.php"); ?>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->   
<?php    

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
            <th style="text-align:center">ID INV</th>
            <th style="text-align:center">ID</th>
            <th style="text-align:center">...</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_consulta = "SELECT * FROM tbl15_producto_copia_inventario WHERE ((cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (cod_estado = '0'))";
    $resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_consulta);
    while ($info_producto_con_existencia_no_cargado = mysqli_fetch_array($resultado_producto_con_existencia_no_cargado)) {

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
        $cod_estado_check                       = $info_producto_con_existencia_no_cargado['cod_estado_check'];

        $sql_estado = "SELECT * FROM tbl15_estado WHERE cod_estado = '$cod_estado'";
        $resultado_estado = mysqli_query($conectar, $sql_estado);
        $info_estado = mysqli_fetch_assoc($resultado_estado);

        $nombre_estado                          = $info_estado['nombre_estado'];
        $color_fondo_celda_estado               = $info_estado['color_fondo_celda_estado'];
        $color_letra_celda_estado               = $info_estado['color_letra_celda_estado'];

        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_nuevo = intval($und_producto_nuevo); } else { $und_producto_nuevo = $und_producto_nuevo; }
        if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_viejo = intval($und_producto_viejo); } else { $und_producto_viejo = $und_producto_viejo; }
        if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
        if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
        if ($cod_estado == '1') { $imagen_estado = "../imagenes/check_escogido.png"; } else { $imagen_estado = "../imagenes/check_vacio.png"; }

        $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
        $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
        $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

        $cuenta                                 = $datos_administrador['cuenta'];
        $resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
        if (($resta < 0 && $cod_estado == '1') && ($cod_estado_check == '0')) { $titulo_resultado = abs($resta)." UNDS FALTAN"; } elseif (($resta > 0 && $cod_estado == '0') && ($cod_estado_check == '1')) { $titulo_resultado = abs($resta)." UNDS SOBRAN"; } elseif (($resta == 0 && $cod_estado == '1') && ($cod_estado_check == '0')) { $titulo_resultado = "BIEN"; } else { $titulo_resultado = ""; }
    ?>
        <tr>
            <td style="text-align:left; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="cod_producto_barra<?php echo $cod_producto_copia_inventario?>"><?php echo $cod_producto_barra?></td>
            <td style="text-align:left; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="nombre_producto<?php echo $cod_producto_copia_inventario?>"><?php echo $nombre_producto?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="und_producto_nuevo<?php echo $cod_producto_copia_inventario?>"><input type="text" name="und_producto_nuevo" value="<?php echo ($und_producto_nuevo) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" /></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="und_producto_viejo<?php echo $cod_producto_copia_inventario?>"><?php echo $und_producto_viejo?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="mensaje<?php echo $cod_producto_copia_inventario ?>"><?php echo $titulo_resultado?></td>
            <td style="text-align:left; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="comentario_copia_inventario<?php echo $cod_producto_copia_inventario?>"><input type="text" name="comentario_copia_inventario" value="<?php echo ($comentario_copia_inventario) ?>" id="<?php echo $cod_producto_copia_inventario ?>" class="input-block-level" style="width: 200px"/></td>
            <td style="text-align:right; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="precio_compra_producto<?php echo $cod_producto_copia_inventario?>"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="precio_venta_producto<?php echo $cod_producto_copia_inventario?>"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="cod_info_producto_copia_inventario<?php echo $cod_producto_copia_inventario?>"><?php echo $cod_info_producto_copia_inventario?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="cod_producto_copia_inventario<?php echo $cod_producto_copia_inventario?>"><?php echo $cod_producto_copia_inventario?></td>
            <td style="text-align:center; <?php echo $color_fondo_celda_estado;?>; <?php echo $color_letra_celda_estado;?>;" id="resultado_transaccion<?php echo $cod_producto_copia_inventario ?>"><button onclick="Funcion_Check(<?php echo $cod_producto_copia_inventario ?>)"><img src="<?php echo $imagen_estado?>"></button></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
<?php } ?>
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
<script src="../js/custom.min.js"></script>
</body>
</html>

<script>
function Funcion_Check(cod_producto_copia_inventario) {
    var valor = "";
    var campo = "cod_estado_check";
    var id = cod_producto_copia_inventario;
    var tipo_ajax = "tbl15_producto_copia_inventario";
    var campo_incre = id;

    var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'campo_incre='+campo_incre;
    console.log("id = "+id); 

    $.ajax({
        type: "POST",
        url: "../admin/guardar_producto_copia_inventario_completo_version2_check_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            //$('#'+cargador+''+id).html('<img src="../imagenes/loading.gif">');
        },
        success:function(respuesta){
            var afectado = respuesta.afectado;
            var campo = respuesta.emisor;
            var color_fondo_celda_estado = respuesta.color_fondo_celda_estado;
            var color_letra_celda_estado = respuesta.color_letra_celda_estado;
            var color_fondo_celda = respuesta.color_fondo_celda;
            var color_letra_celda = respuesta.color_letra_celda;

            var mensaje = respuesta.mensaje;
            var foco = respuesta.foco;
            var imagen_check = '<img id=imagen_estado'+id+' src=../imagenes/check_escogido.png>';

            if ((afectado == 'SI' && (campo == 'cod_estado_check'))) {
                $('#mensaje'+id).html(''+mensaje);
                $("#cod_producto_barra"+id).css("background-color", color_fondo_celda);
                $("#nombre_producto"+id).css("background-color", color_fondo_celda);
                $("#und_producto_nuevo"+id).css("background-color", color_fondo_celda);
                $("#und_producto_viejo"+id).css("background-color", color_fondo_celda);
                $("#mensaje"+id).css("background-color", color_fondo_celda);
                $("#comentario_copia_inventario"+id).css("background-color", color_fondo_celda);
                $("#precio_compra_producto"+id).css("background-color", color_fondo_celda);
                $("#precio_venta_producto"+id).css("background-color", color_fondo_celda);
                $("#cod_info_producto_copia_inventario"+id).css("background-color", color_fondo_celda);
                $("#cod_producto_copia_inventario"+id).css("background-color", color_fondo_celda);
                $("#resultado_transaccion"+id).css("background-color", color_fondo_celda);
            } else if ((afectado == 'SI' && (campo == 'comentario_copia_inventario'))) {
            } else {
                $('#resultado_transaccion'+id).html('');
                $('#resultado_transaccion'+id).html('Error');
            }

        }
    });
}
</script>