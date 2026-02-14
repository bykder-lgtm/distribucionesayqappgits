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
$cod_tercero            = intval($_GET['cod_tercero']);
$pagina_local           = $_SERVER['PHP_SELF'];
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = "../admin/cuentas_pagar_detalle_factura_directa_no_por_factura.php"; }

$calcular_datos_cuenta_pagar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_pagar, total_subtotal_cuenta_pagar, total_abonado_cuenta_pagar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

$total_monto_deuda_cuenta_pagar                   = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];
$total_subtotal_cuenta_pagar                      = intval($datos_cuenta_pagar['total_subtotal_cuenta_pagar']);
$total_abonado_cuenta_pagar                       = $datos_cuenta_pagar['total_abonado_cuenta_pagar'];
$identificacion_tercero                            = $datos_cuenta_pagar['identificacion_tercero'];
$nombre1_tercero                                   = $datos_cuenta_pagar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_pagar['apellido1_tercero'];
$nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;

$cod_tipo_forma_pago                               = 1;
$nombre_modulo_puc                                 = 'ABONOS CUENTAS POR PAGAR';
$cod_sino                                          = 2;
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_pagar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="6px">PROVEEDOR: <?php echo $cliente; ?></font></strong></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td nowrap align="left"><font size="6">TOTAL DEUDA:</font></td>
<td><font size="6"><?php echo number_format($total_monto_deuda_cuenta_pagar, 0, ",", "."); ?></font></td>
</tr>
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL PENDIENTE:</font></td>
<td><font size="6"><?php echo number_format($total_subtotal_cuenta_pagar, 0, ",", "."); ?></font></td>
</tr>
</table>

<br>

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/reg_abono_cuentas_pagar_directa_no_por_factura_reg.php">
<table class="table table-striped">
    <tr>
        <th style="text-align:center">VALOR ABONO</th>
        <th style="text-align:center">FORMA DE PAGO</th>
        <?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?><th style="text-align:center">CUENTA PERSONAL</th><?php } ?>
        <?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?><th style="text-align:center;">CREAR MOV CONTABLE</th><?php } ?>
        <?php if ($cod_estado_modulo_puc_global == '1') { ?><th style="text-align:center">CUENTA</th><?php } ?>
        <th style="text-align:center">COMENTARIO</th>
        <th style="text-align:center">DEPENDENCIA</th>
        <th style="text-align:center">FECHA PAGO</th>
        <th style="text-align:center">CARGAR SOPORTE</th>
    </tr>
    <tr>
        <td style="text-align:center"><input style="font-size:24px; width: 150px;" type="number" name="abonado" value="" max="<?php echo $total_subtotal_cuenta_pagar; ?>" required></td>
        <td style="text-align:center">
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
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
        <td style="text-align:center">
            <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                <?php if (isset($cod_dependencia)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_dependencia'];
                $nombre = $datos2['nombre_dependencia'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <td style="text-align:center"><input style="font-size:14px; width: 120px;" type="date" name="fecha_pago" value="<?php echo date("Y-m-d");?>" required></td>
        <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
    </tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">

<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
<input type="hidden" name="insertar_datos" value="formulario">
</tr>
</form>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong>ABONOS</strong></td>
<td style="text-align: center;"><strong>PAGO A</strong></td>
<td style="text-align: center;"><strong>MENSAJE</strong></td>
<td style="text-align: center;"><strong>FORMA PAGO</strong></td>
<td style="text-align: center;"><strong>FECHA</strong></td>
<td style="text-align: center;"><strong>HORA</strong></td>
<td style="text-align: center;"><strong>ID</strong></td>
</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_pagar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_pagar_abonos  = $datos['cod_cuentas_pagar_abonos'];
$abonado                    = $datos['abonado'];
$cuenta                     = $datos['cuenta'];
$mensaje                    = $datos['mensaje'];
$fecha_pago                 = $datos['fecha_pago'];
$hora                       = $datos['hora'];
$cod_dependencia            = $datos['cod_dependencia'];
$cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
?>
<tr>
<td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
<td style="text-align: left;"><font size="4px"><?php echo $mensaje; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $nombre_tipo_forma_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_pagar_abonos; ?></font></td>
</tr>
<?php } ?>
</table>

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
            var cod_cuentas_pagar = "";
            var cod_factura = "";
            var id = "<?php echo $cod_tercero;?>";
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
            var tipo_ajax = "tbl15_cuentas_pagar";
            var pagina_local = "<?php echo $pagina_local;?>";
            var cod_tercero = "<?php echo $cod_tercero;?>";
            var cod_cuentas_pagar = "";
            var cod_factura = "";
            var id = "<?php echo $cod_tercero;?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";

            var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'id='+id+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_tercero='+cod_tercero+'&'+'cod_cuentas_pagar='+cod_cuentas_pagar+'&'+'cod_factura='+cod_factura;

            $.ajax({
                type: "POST",
                url: "../admin/parametrizacion_puc_movimiento_contable_cuenta_personal_cuenta_pagar_ajax.php",
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