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
<a href="#"><h4>Cuentas por Pagar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_pagar              = intval($_GET['cod_cuentas_pagar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = addslashes($_GET['cod_factura']);
$pagina                         = $_SERVER['PHP_SELF'];
$pagina_local                   = $_SERVER['PHP_SELF'];

$calcular_datos_cuenta_pagar = "SELECT tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, 
tbl15_cuentas_pagar.monto_deuda  AS total_venta, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, Sum(tbl15_cuentas_pagar_abonos.abonado) AS total_abonado
FROM tbl15_cuentas_pagar_abonos RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_cuentas_pagar ON tbl15_tercero.cod_tercero = tbl15_cuentas_pagar.cod_tercero) 
ON tbl15_cuentas_pagar_abonos.cod_factura = tbl15_cuentas_pagar.cod_factura
GROUP BY tbl15_cuentas_pagar.cod_cuentas_pagar, tbl15_cuentas_pagar.cod_factura, tbl15_cuentas_pagar.cod_tercero, tbl15_cuentas_pagar.monto_deuda, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero HAVING (((tbl15_cuentas_pagar.cod_cuentas_pagar)='$cod_cuentas_pagar'))";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

//$total_venta                       = $datos_cuenta_pagar['total_venta'];
//$total_abonado                     = $datos_cuenta_pagar['total_abonado'];
//$total_deuda                       = $total_venta - $total_abonado;
$cliente                           = $datos_cuenta_pagar['nombre1_tercero']." ".$datos_cuenta_pagar['apellido1_tercero'];

$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_pagar WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                    = $sum_monto_deuda['total_venta'];
$total_abonado                  = $sum_abonos['total_abonado'];
$total_deuda                    = $total_venta - $total_abonado;

$cod_tipo_forma_pago               = 1;
$nombre_modulo_puc                 = 'ABONOS CUENTAS POR PAGAR';

$sql_parametrizacion_puc_movimiento_contable = "SELECT cod_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE (nombre_modulo_puc = '$nombre_modulo_puc' AND cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado_puc = '1')";
$resultado_parametrizacion_puc_movimiento_contable = mysqli_query($conectar, $sql_parametrizacion_puc_movimiento_contable);
$total_reg = mysqli_num_rows($resultado_parametrizacion_puc_movimiento_contable);
$info_parametrizacion_puc_movimiento_contable = mysqli_fetch_assoc($resultado_parametrizacion_puc_movimiento_contable);

$cod_puc                           = $info_parametrizacion_puc_movimiento_contable['cod_puc'];
$cod_sino                          = 2;
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_pagar_abonos.php?cod_cuentas_pagar=<?php echo $cod_cuentas_pagar;?>&cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="6px">CLIENTE: <?php echo $cliente; ?></font></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="6px">FACTURA: <?php echo $cod_factura; ?></font></strong></td>
</tr>
<!--
<td><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER PRODUCTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></strong></center></a></td>
<td><a href="../admin/cuentas_pagar_abonos.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER ABONOS</font></strong></center></a></td>
-->
</table>

<table class="table table-striped">
<tr>
<td nowrap align="left"><font size="6">TOTAL DEUDA:</font></td>
<td><font size="6"><?php echo number_format($total_venta, 0, ",", "."); ?></font></td>
</tr>
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL PENDIENTE:</font></td>
<td><font size="6"><?php echo number_format($total_deuda, 0, ",", "."); ?></font></td>
</tr>
</table>

<br>

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/modificar_cuentas_pagar_reg.php">
<table class="table table-striped">
<tr>
    <td style="text-align:center"><strong>VALOR ABONO</strong></td>
    <td style="text-align:center"><strong>FORMA DE PAGO</strong></td>
    <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?><th style="text-align:center">CUENTA PERSONAL</th><?php } ?>
    <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?><th style="text-align:center;">CREAR MOV CONTABLE</th><?php } ?>
    <?php if ($cod_estado_modulo_puc_global == '1') { ?><th style="text-align:center">CUENTA</th><?php } ?>
    <td style="text-align:center"><strong>COMENTARIO</strong></td>
    <td style="text-align:center"><strong>FECHA PAGO</strong></td>
    <th style="text-align:center">CARGAR SOPORTE</th>
<tr>
<tr>
    <td style="text-align:center"><input style="font-size:24px" type="number" name="abonado" value="" max="<?php echo $total_deuda; ?>" size="10"  required></td>
    <td style="text-align:center">
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

    <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
        <td style="text-align:center">
            <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="cod_movimiento_contable_cuenta_personal" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
                <?php if (isset($cod_movimiento_contable_cuenta_personal)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_movimiento_contable_cuenta_personal, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago') AND (cod_estado = '1') ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_movimiento_contable_cuenta_personal) AND $cod_movimiento_contable_cuenta_personal == $datos2['cod_movimiento_contable_cuenta_personal']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'].' | '.$codigo;
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
    <?php } ?>

    <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
        <td style="text-align:center;">
            <select name="cod_sino" id="cod_sino" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
                <?php if (isset($cod_sino)) { echo ""; } else { echo ""; }
                $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino ORDER BY cod_sino ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_sino) AND $cod_sino == $datos2['cod_sino']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_sino'];
                $nombre = $datos2['nombre_sino'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
    <?php } ?>

    <?php if ($cod_estado_modulo_puc_global == '1') { ?>
        <td style="text-align:center">
            <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" tabindex="1">
                <?php if (isset($cod_puc)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
                $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE ((nombre_modulo_puc = '$nombre_modulo_puc') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')) ORDER BY nombre_puc ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_puc) AND $cod_puc == $datos2['cod_puc']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_puc'];
                $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'].' | '.$codigo;
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
    <?php } ?>

    <td style="text-align:center"><input style="font-size:24px" type="text" name="mensaje" value="" size="50"></td>
    <td style="text-align:center"><input style="font-size:14px; width: 120px;" type="date" name="fecha_pago" value="<?php echo date("Y-m-d");?>" size="10" required></td>
    <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_factura" value="<?php echo $cod_factura; ?>">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="cod_cuentas_pagar" value="<?php echo $cod_cuentas_pagar; ?>">
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
<input type="hidden" name="insertar_datos" value="formulario">
</tr>
</form>

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

<?php if ($cod_estado_modulo_puc_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_cuentas_pagar";
            var pagina_local = "<?php echo $pagina_local;?>";
            var cod_tercero = "<?php echo $cod_tercero;?>";
            var cod_cuentas_pagar = "<?php echo $cod_cuentas_pagar;?>";
            var cod_factura = "<?php echo $cod_factura;?>";
            var id = "<?php echo $cod_cuentas_pagar;?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";

            var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'id='+id+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_tercero='+cod_tercero+'&'+'cod_cuentas_pagar='+cod_cuentas_pagar+'&'+'cod_factura='+cod_factura;

            $.ajax({
                type: "POST",
                url: "../admin/parametrizacion_puc_movimiento_contable_cuenta_pagar_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    //var und_venta = respuesta.und_venta;
                    //var und_caja_sobre = respuesta.und_caja_sobre;
                    //var total_venta = respuesta.total_venta;
                    //var total_venta_producto = respuesta.total_venta_producto;
                    //var incre = respuesta.incre;
                    //var ok_ajax = respuesta.ok_ajax;

                    $("#cod_puc").html(respuesta);
                }
            });
        });
    });
    </script>
<?php } ?>

<?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_cuentas_cobrar";
            var pagina_local = "<?php echo $pagina_local;?>";
            var cod_tercero = "<?php echo $cod_tercero;?>";
            var cod_cuentas_cobrar = "";
            var cod_factura = "";
            var id = "<?php echo $cod_tercero;?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";

            var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'id='+id+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_tercero='+cod_tercero+'&'+'cod_cuentas_cobrar='+cod_cuentas_cobrar+'&'+'cod_factura='+cod_factura;

            $.ajax({
                type: "POST",
                url: "../admin/parametrizacion_puc_movimiento_contable_cuenta_personal_cuenta_cobrar_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    //var und_venta = respuesta.und_venta;
                    //var und_caja_sobre = respuesta.und_caja_sobre;
                    //var total_venta = respuesta.total_venta;
                    //var total_venta_producto = respuesta.total_venta_producto;
                    //var incre = respuesta.incre;
                    //var ok_ajax = respuesta.ok_ajax;
                    $("#cod_movimiento_contable_cuenta_personal").html(respuesta);
                }
            });
        });
    });
    </script>
<?php } ?>

<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>