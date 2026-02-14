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
$cod_info_factura_venta                  = intval($_GET['cod_info_factura_venta']);

$sql_profesional = "SELECT cod_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_factura                       = $info_profesional['cod_factura'];

$incre                             = 0;
$tab                               = 'tbl15_venta_producto';
$campo                             = 'cod_venta_producto';
$tipo                              = 'eliminar';
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
?>
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
var cod_info_factura_venta=document.getElementById('cod_info_factura_venta').value;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_venta_producto_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_info_factura_venta="+cod_info_factura_venta+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_venta.php">LISTA DE FACTURAS</a></strong></td></tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong>EDICION DE FACTURA</strong></td></tr></tbody>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>BUSCAR PRODUCTOS: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
        </tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php
$datos_factura = "SELECT cod_venta_producto FROM tbl15_venta_producto WHERE (cod_factura = '$cod_factura')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto WHERE (cod_factura = '$cod_factura')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_factura = '$cod_factura')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_venta            = $data_info_factura['cod_info_factura_venta'];
$cod_factura                 = $data_info_factura['cod_factura'];
$fecha_anyo                  = $data_info_factura['fecha_anyo'];
$nombre_empresa              = $data_info_factura['nombre_empresa'];
$vlr_cancelado               = $data_info_factura['vlr_cancelado'];
$descuento_ptj               = $data_info_factura['descuento_ptj'];
$cod_tipo_pago               = $data_info_factura['cod_tipo_pago'];
$nombre_tipo_producto        = $data_info_factura['nombre_tipo_producto'];


$datos_info_cli = "SELECT * FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
$consulta_info_cli = mysqli_query($conectar, $datos_info_cli);
$info_cli = mysqli_fetch_assoc($consulta_info_cli);

$razonsocial_empresa         = $info_cli['razonsocial_empresa'];
$direccion_empresa           = $info_cli['direccion_empresa'];
$telefono_empresa            = $info_cli['telefono_empresa'];
$nit_empresa                 = $info_cli['nit_empresa'];
$cod_tipo_facturacion        = $info_cli['cod_tipo_facturacion'];
?>
<script src="../js/jquery-3.2.1.min.js"></script>

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
    $("#nombre_empresa").on('change', function () {
        $("#nombre_empresa option:selected").each(function () {
            var valor = $(this).val();
            var campo = "nombre_empresa";
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

<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_venta_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">FACTURA</th>
    <td style="text-align:center;">FECHA VENTA</td>
    <td style="text-align:center;">EMPRESA</td>
    <th style="text-align:center;">TIPO FACTURA</th>
    <td style="text-align:center;">TOTAL VENTA</td>
  </tr>
  <tr>
   <input name="cod_info_factura_venta" id="cod_info_factura_venta" type="hidden" value="<?php echo $cod_info_factura_venta ?>"/>
   <td style="text-align:center;"><input name="cod_factura" id="cod_factura" type="number" value="<?php echo $cod_factura ?>" required/></td>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="text" value="<?php echo $fecha_anyo ?>" required/></td>
    <td style="text-align:center;">
<select name="nombre_empresa" id="nombre_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa)) { echo "<option value='' >...</option>";
} else { echo  "<option value='' selected ></option>"; }
$consulta2_sql = "SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa) AND $nombre_empresa == $datos2['nombre_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa'];
$nombre = $datos2['nombre_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
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
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>

  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th style="text-align:center;">ELM</th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE</th>
<th style="text-align:center;">AUDIOM</th>
<th style="text-align:center;">OPTOM</th>
<th style="text-align:center;">ELECTROC</th>
<!--<th style="text-align:center;">CANTIDAD</th>-->
<th style="text-align:center;">VALOR UNITARIO</th>
<td align="center"></td>
<th style="text-align:center;">VALOR TOTAL</th>
</tr>
</thead>
<tbody>
<?php
$sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_factura = '$cod_factura') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {
  	 	 	 	 	 	
$cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
$cod_producto                      = $datos_venta_producto['cod_producto'];
$cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
$nombre_producto                   = $datos_venta_producto['nombre_producto'];
$und_venta                         = $datos_venta_producto['und_venta'];
$precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
$total_costo_producto              = $datos_venta_producto['total_costo_producto'];
$precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
$total_venta_producto              = $datos_venta_producto['total_venta_producto'];
$nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
$und_audiometria                   = $datos_venta_producto['und_audiometria'];
$precio_venta_audiometria          = $datos_venta_producto['precio_venta_audiometria'];
$total_venta_audiometria           = $datos_venta_producto['total_venta_audiometria'];
$und_optometria                    = $datos_venta_producto['und_optometria'];
$precio_venta_optometria           = $datos_venta_producto['precio_venta_optometria'];
$total_venta_optometria            = $datos_venta_producto['total_venta_optometria'];
$und_electrocardiograma            = $datos_venta_producto['und_electrocardiograma'];
$precio_venta_electrocardiograma   = $datos_venta_producto['precio_venta_electrocardiograma'];
$total_venta_electrocardiograma    = $datos_venta_producto['total_venta_electrocardiograma'];
$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto;?>">
<td style="text-align:center;" id="cod_venta_producto<?php echo $cod_venta_producto ?>" class="service_list" data="<?php echo $cod_venta_producto ?>"><a class="eliminar" id="cod_venta_producto<?php echo $cod_venta_producto ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><input name="cod_producto_barra" type="number" id="cod_producto_barra-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $cod_producto_barra ?>" style="width: 70px;" /></td>
<td style="text-align:left;"   id="nombre_producto_<?php echo $incre;?>"><input name="nombre_producto" type="text" id="nombre_producto-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $nombre_producto ?>" style="width: 500px;" /></td>
<td style="text-align:left;"   id="und_audiometria_<?php echo $incre;?>"><input name="und_audiometria" type="number" id="und_audiometria-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $und_audiometria ?>" style="width: 50px;" /></td>
<td style="text-align:left;"   id="und_optometria_<?php echo $incre;?>"><input name="und_optometria" type="number" id="und_optometria-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $und_optometria ?>" style="width: 50px;" /></td>
<td style="text-align:left;"   id="und_electrocardiograma_<?php echo $incre;?>"><input name="und_electrocardiograma" type="number" id="und_electrocardiograma-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" value="<?php echo $und_electrocardiograma ?>" style="width: 50px;" /></td>
<!--<td style="text-align:right;"  id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="number" id="und_venta-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" style="width: 50px;" /></td>-->
<td style="text-align:right;"  id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="number" id="precio_venta_producto-<?php echo $incre;?>" class="<?php echo $cod_venta_producto;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" style="width: 100px;" /></td>
<td style="text-align:right;"  id="mensaje_alerta_<?php echo $incre;?>"></td>
<td style="text-align:right;"  id="total_venta_producto_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto;?>">
<?php } ?>
</tbody>
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
        var cod_venta_producto = $(this).parent().attr('data');
        var dataString = 'llave='+cod_venta_producto+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_venta_producto+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_producto_barra_'+cod_venta_producto).fadeOut("slow");
                $('#nombre_producto_'+cod_venta_producto).fadeOut("slow");
                $('#und_audiometria_'+cod_venta_producto).fadeOut("slow");
                $('#und_optometria_'+cod_venta_producto).fadeOut("slow");
                $('#und_electrocardiograma_'+cod_venta_producto).fadeOut("slow");
                $('#und_venta_'+cod_venta_producto).fadeOut("slow");
                $('#precio_venta_producto_'+cod_venta_producto).fadeOut("slow");
                $('#total_venta_producto_'+cod_venta_producto).fadeOut("slow");
                $('#tr'+cod_venta_producto).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>