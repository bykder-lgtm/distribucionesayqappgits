<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<a class="btn btn-primary" href="#"><h6>Cuenta por cobrar manual</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                                   = $_SERVER['PHP_SELF'];
$pagina_local                             = $_SERVER['PHP_SELF'];
$tab                                      = 'tbl15_cuentas_cobrar';
$tipo                                     = 'eliminar';
$campo                                    = 'cod_cuentas_cobrar  ';
$fecha_pago                               = date("Y-m-d");
$origen                                   = 'PARACLINICOS';
$cod_sino                                 = 2;
$nombre_modulo_puc                        = 'CUENTAS POR COBRAR';
$cod_tipo_forma_pago                      = 1;
?>
<?php if ($cod_estado_modulo_puc_global == '1') { ?>
    <script language="javascript">
    $(document).ready(function(){
        $("#cod_tipo_forma_pago").on('change', function () {
            var id = "1";
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_cuentas_cobrar";
            var campo_incre = campo;
            var pagina = "<?php echo $pagina; ?>";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc; ?>";

            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'campo_incre='+campo_incre+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/tipo_forma_pago_puc_json_ajax.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    $("#cod_puc").html(respuesta);
                    //var ok_ajax = respuesta.ok_ajax;
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
            var cod_tercero = "0";
            var cod_cuentas_cobrar = "";
            var cod_factura = "";
            var id = "0";
            var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";

            var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'id='+id+'&'+'nombre_modulo_puc='+nombre_modulo_puc+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_tercero='+cod_tercero+'&'+'cod_cuentas_cobrar='+cod_cuentas_cobrar+'&'+'cod_factura='+cod_factura;

            $.ajax({
                type: "POST",
                url: "../admin/movimiento_contable_cuenta_personal_cuenta_cobrar_select_ajax.php",
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
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_cuentas_cobrar_directa_no_por_factura.php"><font size='+2'>REGRESAR</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_cuentas_cobrar_manual_directa_no_por_factura_reg.php">
<table class="table table-striped">
<thead>

<tr>
    <th style="text-align:right">COD FACTURA</th>
    <td style="text-align:left"><input class="input-block-level" name="cod_factura" type="text" value="" /></td>
</tr>

<tr>
    <th style="text-align:right">TERCERO</th>
    <th style="text-align:left">
    <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
        <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
        } else { echo  "<option value='' selected ></option>"; }
        $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
        FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_tercero'];
        $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
    </td>
</tr>

<tr>
    <th style="text-align:right">FORMA PAGO</th>
    <td style="text-align:left">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
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
</tr>

<tr>
    <th style="text-align:right">DEUDA</th>
    <td style="text-align:left"><input class="input-block-level" name="monto_deuda" type="text" value="" /></td>
</tr>

<tr>
    <th style="text-align:right">FECHA</th>
    <td style="text-align:left"><input class="input-block-level" name="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" /></td>
</tr>

<?php if ($cod_estado_generar_movimiento_contable_automatico_global == '1') { ?>
<tr>
    <th style="text-align:right">CREAR MOV CONTABLE</th>
    <td style="text-align:left">
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
</tr>
<?php } ?>

<?php if ($cod_estado_modulo_puc_global == '1') { ?>
<tr>
    <th style="text-align:right">PUC</th>
    <td style="text-align:left">
        <select name="cod_puc" id="cod_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" tabindex="1">
            <?php if (isset($cod_puc)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_parametrizacion_puc_movimiento_contable WHERE ((nombre_modulo_puc = '$nombre_modulo_puc') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')) ORDER BY nombre_puc ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_puc) AND $cod_puc == $datos2['cod_puc']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_puc'];
            $nombre = $datos2['codigo_puc'].' | '.$datos2['nombre_puc'].' | '.$datos2['tipo_puc'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
</tr>
<?php } ?>

<?php if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') { ?>
<tr>
    <th style="text-align:right">CUENTA PERSONAL</th>
    <td style="text-align:left">
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
</tr>
<?php } ?>
<tr>
    <th style="text-align:right">COMENTARIO</th>
    <td style="text-align:left"><input class="input-block-level" name="mensaje" type="text" value="" /></td>
</tr>

<tr>
    <th style="text-align:right">CARGAR SOPORTE</th>
    <td style="text-align:left"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
</tr>

</thead>
<tbody>
</tbody>
</table>

<hr>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-left" title="Click aqui para enviar" />
</div>

</form>
</div>

<script type="text/javascript">
$(function() {
$("#codigo_puc").autocomplete({
source: "../admin/autocompletar_codigo_puc_ajax.php?tipo_puc=NINGUNO",
minLength: 1,

select: function(event, ui) {
event.preventDefault();
let id = this.id;
var valor = $(this).val();
var campo = $(this).attr("name");
var jqui = "jqui";

$('#codigo_puc').val(ui.item.codigo_puc);
$('#nombre_puc').val(ui.item.nombre_puc);

}
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

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