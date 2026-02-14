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

    <!-- Form search -->
    <form class="form-horizontal" role="form" id="ingresos">
        <!--<label for="busqueda_ajax" class="col-md-2 control-label"></label>-->
        <div class="col-md-4">
            Buscar por:
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="load(1)" style="width: 180px;">
                <?php if (isset($buscar_por)) { echo ""; } else { echo  "<option value='' selected >Selecione</option>"; }
                $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_buscar_por'];
                $nombre = $datos2['titulo_buscar_por'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>

            <input type="text" class="form-control" id="busqueda_ajax" placeholder="Nombre del Producto" onkeyup='load(1);'><button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span></div>
        <input type="hidden" id="tabla" Value="tbl15_producto">
    </form>
    <!-- end Form search -->
            <div class="x_content">
                <div class="table-responsive">
                    <!-- ajax -->
                        <div id="resultados"></div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div><!-- Carga los datos ajax -->
                    <!-- /ajax -->
                </div>
            </div>
        </div><!-- /page content -->
    </div>
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
$(document).ready(function(){
    load(1);
});

function load(page){
    var busqueda_ajax = $("#busqueda_ajax").val();
    var buscar_por = $("#buscar_por").val();
    var tabla = $("#tabla").val();
    var tipo_ajax = "tbl15_producto_copia_inventario";
    var cod_info_producto_copia_inventario = "<?php echo $cod_info_producto_copia_inventario?>";

    $("#loader").fadeIn('slow');
    $.ajax({
        url:'../admin/producto_copia_inventario_con_existencia_no_cargados_masivo_busqueda_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&buscar_por='+buscar_por+'&tabla='+tabla+'&cod_info_producto_copia_inventario='+cod_info_producto_copia_inventario,
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}
</script>