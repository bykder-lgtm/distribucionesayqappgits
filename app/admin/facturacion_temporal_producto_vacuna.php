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
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$cod_estado_vacuna                 = '1';

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
?>
<input type="hidden" id="pagina" value="<?php echo $pagina_local ?>">

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>

<script type="text/javascript">
function hacer_busqueda() {
var xmlhttp;

var valor_buscar=document.getElementById('busqueda').value;
var pagina=document.getElementById('pagina').value;
var cod_estado_vacuna="1";

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_venta_temporal_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_estado_vacuna="+cod_estado_vacuna+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/reporte_vacuna_fechas.php">LISTA DE VACUNAS</a></strong></td>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/reporte_vacuna_alerta.php">ALERTAS DE VACUNAS</a></strong></td>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/edit_configuracion_alerta.php?pagina=<?php echo $pagina?>">CONFIGURAR ALERTAS</a></strong></td>

    </tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
    		<td bgcolor="#fff" align="center"><strong>BUSCAR VACUNAS: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
    	</tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php
$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_estado_vacuna = '$cod_estado_vacuna')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (cod_estado_vacuna = '$cod_estado_vacuna')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual') AND (cod_estado_vacuna = '$cod_estado_vacuna')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta            = $data_info_factura['cod_info_factura_venta'];
$cod_factura                 = $data_info_factura['cod_factura'];
$fecha_anyo                  = $data_info_factura['fecha_anyo'];
$cod_cliente                 = $data_info_factura['cod_cliente'];
$cod_empresa                 = $data_info_factura['cod_empresa'];
$nombre_empresa              = $data_info_factura['nombre_empresa'];
$vlr_cancelado               = $data_info_factura['vlr_cancelado'];
$descuento_ptj               = $data_info_factura['descuento_ptj'];
$cod_tipo_pago               = $data_info_factura['cod_tipo_pago'];
$nombre_tipo_producto        = $data_info_factura['nombre_tipo_producto'];
$cod_historia_clinica        = $data_info_factura['cod_historia_clinica'];


$datos_info_cli = "SELECT * FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_info_cli = mysqli_query($conectar, $datos_info_cli);
$info_cli = mysqli_fetch_assoc($consulta_info_cli);

$razonsocial_empresa         = $info_cli['razonsocial_empresa'];
$direccion_empresa           = $info_cli['direccion_empresa'];
$telefono_empresa            = $info_cli['telefono_empresa'];
$nit_empresa                 = $info_cli['nit_empresa'];
$cod_tipo_facturacion        = $info_cli['cod_tipo_facturacion'];

$tab                         = 'tbl15_venta_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';
?>
<script src="../js/jquery-3.2.1.min.js"></script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_historia_clinica").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_historia_clinica";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_factura";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_empresa").on('change', function () {
        $("#cod_empresa option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_empresa";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_cliente").on('change', function () {
        $("#cod_cliente option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_cliente";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_producto").on('change', function () {
        $("#nombre_tipo_producto option:selected").each(function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_producto";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
            });     
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto_temporal";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<?php if ($total_datos <> 0) { ?>

<form method="post" name="formulario" action="../admin/venta_producto_reg.php">

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">ID</th>
    <td style="text-align:center;">HC</td>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">CLIENTE</th>
    <td style="text-align:center;">PACIENTE</td>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">TOTAL FACTURA</th>
    <th style="text-align:center;">GUARDAR</th>
  </tr>
  <tr>
   <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
   <td style="text-align:center;"><input name="cod_historia_clinica" id="cod_historia_clinica" type="number" value="<?php echo $cod_historia_clinica ?>" style="width: 60px;"/></td>
   <input name="cod_factura" id="cod_factura" type="hidden" value="<?php echo $cod_factura ?>"/>

   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 110px;" required/></td>

    <td style="text-align:center;">
        <select name="cod_empresa" id="cod_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_empresa)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_empresa, nit_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_empresa) AND $cod_empresa == $datos2['cod_empresa']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_empresa'];
            $nombre = $datos2['nombre_empresa'];
            $nit_empresa = $datos2['nit_empresa'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre." - ".$nit_empresa."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_cliente" id="cod_cliente" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_cliente)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_cliente, nombres, nombre_raza FROM tbl15_cliente ORDER BY nombres ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_cliente) AND $cod_cliente == $datos2['cod_cliente']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_cliente'];
            $nombre = $datos2['nombres'].' | '.$datos2['nombre_raza'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_producto)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto ORDER BY nombre_tipo_producto ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_producto) AND $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_producto'];
            $nombre = $datos2['nombre_tipo_producto'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>

<input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
<input type="hidden" name="cod_venta_producto_temporal[]" value="<?php echo $datos['cod_venta_producto_temporal']; ?>" size="4">
<?php } ?>
<?php $pagina ='facturacion_venta_temporal_producto_manual_pos_vacuna.php'; ?>
<input type="hidden" name="pagina" value="<?php echo $pagina?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="1" size="15">

    <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" tabindex=3 name="vender" value="Guardar" /></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
<thead>
<tr>
<!--<th style="text-align:center;">ELM</th>-->
<!--<th style="text-align:center;">COBRAR</th>-->
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">FECHA ALERTA</th>
<th style="text-align:center;">TIPO</th>
<th style="text-align:center;">CANTIDAD</th>
<th style="text-align:center;">MED</th>
<th style="text-align:center;">VALOR UNITARIO</th>
<td align="center"></td>
<th style="text-align:center;">VALOR TOTAL</th>
<th style="text-align:center;">ELM</th>
</tr>
</thead>
<tbody>
<?php
$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_estado_vacuna = '$cod_estado_vacuna') ORDER BY cod_venta_producto_temporal DESC";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
$cod_producto                      = $datos_venta_producto_temporal['cod_producto'];
$cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                   = $datos_venta_producto_temporal['nombre_producto'];
$cedula                            = $datos_venta_producto_temporal['cedula'];
$nombre_cliente                    = $datos_venta_producto_temporal['nombre_cliente'];
$und_venta                         = $datos_venta_producto_temporal['und_venta'];
$precio_costo_producto             = $datos_venta_producto_temporal['precio_costo_producto'];
$total_costo_producto              = $datos_venta_producto_temporal['total_costo_producto'];
$precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto              = $datos_venta_producto_temporal['total_venta_producto'];
$nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_venta_producto_temporal['posologia_cantidad'];
$posologia_peso                    = $datos_venta_producto_temporal['posologia_peso'];
$nombre_tipo_presentacion          = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_venta_producto_temporal['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_venta_producto_temporal['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_venta_producto_temporal['cod_tipo_cobrar'];
$fecha_alerta                      = $datos_venta_producto_temporal['fecha_alerta'];


$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_venta_producto_temporal;?>" id="cod_tipo_cobrar_<?php echo $cod_venta_producto_temporal;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
<!--<td style="text-align:center;" id="cod_venta_producto_temporal_<?php echo $cod_venta_producto_temporal ?>" class="service_list" data="<?php echo $cod_venta_producto_temporal ?>"><a class="eliminar" id="cod_venta_producto_temporal<?php echo $cod_venta_producto_temporal ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><input name="cod_producto_barra" type="text" id="cod_producto_barra-<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $cod_producto_barra ?>" style="width: 100px;" /></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><input name="nombre_producto" type="text" id="nombre_producto-<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $nombre_producto ?>" style="width: 300px;" /></td>
<td style="text-align:left;" id="nombre_frec_duracion_<?php echo $incre;?>"><input name="fecha_alerta" type="date" id="fecha_alerta-<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $fecha_alerta ?>" style="width: 120px;" /></td>
<td style="text-align:right;" id="nombre_tipo_producto_<?php echo $incre;?>"><?php echo $nombre_tipo_producto;?></td>
<td style="text-align:right;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta-<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 70px;" /></td>
<td style="text-align:center;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto-<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
<td style="text-align:right;" id="mensaje_alerta_<?php echo $incre;?>"></td>
<td style="text-align:right;" id="total_venta_producto_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
<td align="center"><a href="../admin/eliminar.php?llave=<?php echo $cod_venta_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto_temporal;?>">
<?php } ?>
</tbody>
</table>

<?php } else { } ?>

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
<!--
<script type="text/javascript">
$(document).ready(function() {
    var cod_tipo_cobrar = $('#cod_tipo_cobrar').val();
    if (cod_tipo_cobrar=='1') { $('#cod_tipo_cobrar').val('1'); $('#cod_tipo_cobrar').prop('checked',true); } else { $('#cod_tipo_cobrar').val('0'); $('#cod_tipo_cobrar').prop('checked',false); } 
    $(".cod_tipo_cobrar").change(function(){ if( $(this).is(':checked') ){ $(".cod_tipo_cobrar").val("1"); } else { $(".cod_tipo_cobrar").val("0"); } });
});
</script>
-->
<script>
function calc_total_venta(){

var i=0;
var incre = <?php echo $total_datos;?>;
var und_venta_text = "";
var precio_venta_producto_text = "";
var total_venta_producto_text = "";
var smtr_total_venta = 0;
var total_venta = 0;
var Max_Length = 4;
var length = 0;

for (i=1; i<=incre; i++){

und_venta_text = "und_venta-"+i;
precio_venta_producto_text = "precio_venta_producto-"+i;
total_venta_producto_text = "total_venta_producto_"+i;
mensaje_alerta_text = "mensaje_alerta_"+i;

mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
und_venta = document.getElementById(und_venta_text).value;
precio_venta_producto = document.getElementById(precio_venta_producto_text).value;
total_venta_producto = (und_venta * precio_venta_producto);
smtr_total_venta = smtr_total_venta + total_venta_producto;

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
length = document.getElementById(und_venta_text).value.length;
if (length > Max_Length) {
var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
//  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
console.log(length);
} else {  }
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->

document.getElementById(total_venta_producto_text).innerHTML=total_venta_producto.toLocaleString("es-ES");
}
total_venta = smtr_total_venta;
document.getElementById("total_venta").innerHTML=total_venta.toLocaleString("es-ES");
}
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){

        var parent = $(this).parent().attr('id');
        var cod_venta_producto_temporal = $(this).parent().attr('data');
        var dataString = 'llave='+cod_venta_producto_temporal+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_venta_producto_temporal+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_venta_producto_temporal'+cod_venta_producto_temporal).fadeOut("slow");
                $('#cod_producto_barra_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#nombre_cliente_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#nombre_producto_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#und_venta_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#precio_venta_producto_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#mensaje_alerta_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#total_venta_producto_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#nombre_tipo_unidad_medida_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#nombre_frec_duracion_'+cod_venta_producto_temporal).fadeOut("slow");
                $('#tr'+cod_venta_producto_temporal).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>