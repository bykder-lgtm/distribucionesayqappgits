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
<!--<div class="container">-->
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
$cod_info_plan_accion_correctiva_preventiva_mejora            = intval($_GET['cod_info_plan_accion_correctiva_preventiva_mejora']);
$origen                            = 'PARACLINICOS';

$sql_profesional = "SELECT cod_factura FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_factura                       = $info_profesional['cod_factura'];

$incre                             = 0;
$tab                               = 'tbl15_info_plan_accion_correctiva_preventiva_mejora';
$campo                             = 'cod_info_plan_accion_correctiva_preventiva_mejora';
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
var cod_info_plan_accion_correctiva_preventiva_mejora=document.getElementById('cod_info_plan_accion_correctiva_preventiva_mejora').value;

if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
}
xmlhttp.open("POST","../admin/busqueda_inmediata_plan_accion_correctiva_preventiva_mejora_php.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("buscar="+valor_buscar+"&cod_info_plan_accion_correctiva_preventiva_mejora="+cod_info_plan_accion_correctiva_preventiva_mejora+"&pagina="+pagina);
}
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_plan_accion_correctiva_preventiva_mejora_venta.php">LISTA PLAN DE ACCIONES CORRECTIVAS</a></strong></td></tr></tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr><td bgcolor="#fff" align="center"><strong>EDICION PLAN DE ACCIONES CORRECTIVAS</strong></td></tr></tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
        <tr>
            <td bgcolor="#fff" align="center"><strong>BUSCAR PRODUCTOS: <input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div></td>
        </tr>
    </tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<?php
$datos_factura = "SELECT cod_plan_accion_correctiva_preventiva_mejora FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$suma_temporal = "SELECT  Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_plan_accion_correctiva_preventiva_mejora      = $data_info_factura['cod_info_plan_accion_correctiva_preventiva_mejora'];
$cod_factura                                            = $data_info_factura['cod_factura'];
$cod_version                                            = $data_info_factura['cod_version'];
$cod_tercero                                            = $data_info_factura['cod_tercero'];
$cod_historia_clinica                                   = $data_info_factura['cod_historia_clinica'];
$fecha_ini                                              = $data_info_factura['fecha_ini'];
$fecha_fin                                              = $data_info_factura['fecha_fin'];
$cod_empresa                                            = $data_info_factura['cod_empresa'];
$nombre_empresa                                         = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                    = $data_info_factura['razonsocial_empresa'];
$total_motivo                                           = $data_info_factura['total_motivo'];
$total_muestra                                          = $data_info_factura['total_muestra'];
$fecha_ymdhis                                           = $data_info_factura['fecha_ymdhis'];
$cuenta                                                 = $data_info_factura['cuenta'];
$cod_estado_factura                                     = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                          = $data_info_factura['cod_base_caja'];
$descuento_ptj                                          = $data_info_factura['descuento_ptj'];
$iva_ptj                                                = $data_info_factura['iva_ptj'];
$flete_ptj                                              = $data_info_factura['flete_ptj'];
$cod_cliente                                            = $data_info_factura['cod_cliente'];
$vlr_cancelado                                          = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                             = $data_info_factura['vlr_vuelto'];
$fecha_dia                                              = $data_info_factura['fecha_dia'];
$fecha_mes                                              = $data_info_factura['fecha_mes'];
$fecha_anyo                                             = $data_info_factura['fecha_anyo'];
$anyo                                                   = $data_info_factura['anyo'];
$fecha_hora                                             = $data_info_factura['fecha_hora'];
$fecha_remision                                         = $data_info_factura['fecha_remision'];
$nombre_ccosto                                          = $data_info_factura['nombre_ccosto'];
$garantia_meses                                         = $data_info_factura['garantia_meses'];
$observacion                                            = $data_info_factura['observacion'];
$cod_tipo_pago                                          = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                      = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                                   = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                    = $data_info_factura['total_precio_compra'];
$total_precio_venta                                     = $data_info_factura['total_precio_venta'];
$cod_dependencia                                        = $data_info_factura['cod_dependencia'];
$servicio                                               = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                    = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                                 = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                            = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                    = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                     = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                        = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                         = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                     = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                         = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                        = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                      = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                             = $data_info_factura['cod_resolucion_facturacion'];
$nombre_comentario                                      = $data_info_factura['nombre_comentario'];
$nombre_factura_remision                                = $data_info_factura['nombre_factura_remision'];
$nombre_tipo_pendiente                                  = $data_info_factura['nombre_tipo_pendiente'];
$descripcion_tipo_pendiente                             = $data_info_factura['descripcion_tipo_pendiente'];
$fecha_entrega                                          = $data_info_factura['fecha_entrega'];
$hora_entrega                                           = $data_info_factura['hora_entrega'];
$nombre_elaboro                                         = $data_info_factura['nombre_elaboro'];

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
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_moneda").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_factura";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_version").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_version";
            var tipo_ajax = "tbl15_info_plan_accion_correctiva_preventiva_mejora";
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora; ?> }, function(data){
                $("#modelo").html(data);
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
            var tipo_ajax = "tbl15_plan_accion_correctiva_preventiva_mejora";
            var idclass = $(this).attr("class");
            var id = $(this).attr("llave");
            //let id = this.id;
            $.post("guardar_info_factura_y_plan_accion_correctiva_preventiva_mejora_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>


<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">FECHA</th>
<!--
    <th style="text-align:center;">MONEDA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
-->
    <th style="text-align:center;">CODIGO</th>
    <th style="text-align:center;">VERSION</th>
<!--
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
-->
    <th style="text-align:center;">COMENTARIO</th>
<!--
    <th style="text-align:center;">CLIENTE</th>
    <th style="text-align:center;">PENDIENTE</th>
    <th style="text-align:center;"></th>
    <th style="text-align:center;">FECHA - HORA ENTREGA</th>
    <th style="text-align:center;">TOTAL</th>
    <th style="text-align:center;">ANTICIPO</th>
-->
    <th style="text-align:center;">ELABORO</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 110px;" required/></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>
<!--
   <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>
-->
    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>

   <td style="text-align:center;"><input name="cod_factura" id="cod_factura" type="text" value="<?php echo $cod_factura ?>" style="width: 150px;" /></td>
   <td style="text-align:center;"><input name="cod_version" id="cod_version" type="text" value="<?php echo $cod_version ?>" style="width: 150px;" /></td>
   <td style="text-align:center;"><input name="nombre_comentario" id="nombre_comentario" type="text" value="<?php echo $nombre_comentario ?>" style="width: 150px;" /></td>
   
   <td style="text-align:center;">
    <select name="cod_administrador" id="cod_administrador" class="selectpicker" style="width: 150px;" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_administrador'];
        $nombre = $datos2['cuenta'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>  
<!--
    <td style="text-align:center;">
        <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_moneda'];
            $nombre = $datos2['nombre_tipo_moneda'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_factura WHERE (nombre_tipo_factura='POS')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" style="width: 200px;" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
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

    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" style="width: 100px;" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:left; width:300px">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <p><a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a></p>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_pendiente" id="nombre_tipo_pendiente" class="selectpicker" style="width: 100px;" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_pendiente)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT nombre_tipo_pendiente FROM tbl15_tipo_pendiente ORDER BY nombre_tipo_pendiente ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_pendiente) AND $nombre_tipo_pendiente == $datos2['nombre_tipo_pendiente']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_pendiente'];
            $nombre = $datos2['nombre_tipo_pendiente'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
   <td style="text-align:center;"><input name="descripcion_tipo_pendiente" id="descripcion_tipo_pendiente" type="text" value="<?php echo $descripcion_tipo_pendiente ?>" style="width: 100px;"/></td>

   <td style="text-align:center;"><input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 110px;" required/><input name="hora_entrega" id="hora_entrega" type="time" value="<?php echo $hora_entrega ?>" style="width: 110px;" required/></td>

    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
    <input name="vlr_cancelado_number" id="vlr_cancelado_number" type="hidden" value="<?php echo $total_venta ?>" style="width: 110px;" required/>

   <td style="text-align:center;"><input name="vlr_cancelado" id="vlr_cancelado" type="number" value="<?php echo $vlr_cancelado ?>" style="width: 100px;" required/></td>
-->
    <td style="text-align:center;"></td>
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;" colspan="9"></th>
    <th style="text-align:center;" colspan="3">RECURSOS</th>
    <th style="text-align:center;" colspan="4"></th>
    <th style="text-align:center;" colspan="3">SEGUIMIENTO</th>
  </tr>
  <tr>
    <th style="text-align:center;">ELIM</th>
    <th style="text-align:center;">#</th>
    <th style="text-align:center;">TIPO DE ACCIÓN</th>
    <th style="text-align:center;">FUENTE</th>
    <th style="text-align:center;">ACTIVIDAD</th>
    <th style="text-align:center;" colspan="3">DESCRIPCION HALLAZGO</th>
    <th style="text-align:center;" colspan="2">ACCION TOMADA</th>
    <th style="text-align:center;">HUMANO</th>
    <th style="text-align:center;">FINANCIERO</th>
    <th style="text-align:center;">TECNOLOGICO</th>
    <th style="text-align:center;" colspan="2">RESPONSABLE DE IMPLANTAR LA ACCION</th>
    <th style="text-align:center;" colspan="2">FECHA PREVISTA</th>
    <th style="text-align:center;">CUMPLIMIENTO</th>
    <th style="text-align:center;">EFICACIA</th>
    <th style="text-align:center;">SOPORTES</th>
  </tr>
<thead>
<?php
$sql_plan_accion_correctiva_preventiva_mejora_temporal = "SELECT * FROM tbl15_plan_accion_correctiva_preventiva_mejora 
WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora') ORDER BY cod_plan_accion_correctiva_preventiva_mejora DESC";
$consulta_plan_accion_correctiva_preventiva_mejora_temporal = mysqli_query($conectar, $sql_plan_accion_correctiva_preventiva_mejora_temporal);
while ($datos_plan_accion_correctiva_preventiva_mejora_temporal = mysqli_fetch_assoc($consulta_plan_accion_correctiva_preventiva_mejora_temporal)) {

$cod_plan_accion_correctiva_preventiva_mejora                = $datos_plan_accion_correctiva_preventiva_mejora_temporal['cod_plan_accion_correctiva_preventiva_mejora'];
$nombre_tipo_accion                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_accion'];
$nombre_tipo_fuente                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_fuente'];
$nombre_tipo_actividad                                       = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_actividad'];
$descripcion_hallazgo                                        = $datos_plan_accion_correctiva_preventiva_mejora_temporal['descripcion_hallazgo'];
$nombre_tipo_accion_tomada                                   = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_tipo_accion_tomada'];
$recurso_humano                                              = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_humano'];
$recurso_financiero                                          = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_financiero'];
$recurso_tecnologico                                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['recurso_tecnologico'];
$nombre_responsable_implantar_accion                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['nombre_responsable_implantar_accion'];
$fecha_prevista                                              = $datos_plan_accion_correctiva_preventiva_mejora_temporal['fecha_prevista'];
$seguimiento_cumplimiento                                    = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_cumplimiento'];
$seguimiento_eficacia                                        = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_eficacia'];
$seguimiento_soporte                                         = $datos_plan_accion_correctiva_preventiva_mejora_temporal['seguimiento_soporte'];

$incre++;
?>
<tbody>
  <tr style="text-align:center;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>">
    <td  style="text-align:center;"><a href="../admin/eliminar.php?llave=<?php echo $cod_plan_accion_correctiva_preventiva_mejora?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><?php echo $incre;?></td>
    <td style="text-align:center;" id="nombre_tipo_accion_<?php echo $incre;?>"><input name="nombre_tipo_accion" type="text" id="nombre_tipo_accion<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $nombre_tipo_accion;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_fuente_<?php echo $incre;?>"><input name="nombre_tipo_fuente" type="text" id="nombre_tipo_fuente<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $nombre_tipo_fuente;?>"/></td>
    <td style="text-align:center;" id="nombre_tipo_actividad_<?php echo $incre;?>"><input name="nombre_tipo_actividad" type="text" id="nombre_tipo_actividad<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $nombre_tipo_actividad;?>"/></td>
    <td style="text-align:center;" colspan="3" id="descripcion_hallazgo_<?php echo $incre;?>"><input name="descripcion_hallazgo" type="text" id="descripcion_hallazgo<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $descripcion_hallazgo;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_tipo_accion_tomada_<?php echo $incre;?>"><input name="nombre_tipo_accion_tomada" type="text" id="nombre_tipo_accion_tomada<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $nombre_tipo_accion_tomada;?>"/></td>
    <td style="text-align:center;" id="recurso_humano_<?php echo $incre;?>"><input name="recurso_humano" type="text" id="recurso_humano<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $recurso_humano;?>"/></td>
    <td style="text-align:center;" id="recurso_financiero_<?php echo $incre;?>"><input name="recurso_financiero" type="text" id="recurso_financiero<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $recurso_financiero;?>"/></td>
    <td style="text-align:center;" id="recurso_tecnologico_<?php echo $incre;?>"><input name="recurso_tecnologico" type="text" id="recurso_tecnologico<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $recurso_tecnologico;?>"/></td>
    <td style="text-align:center;" colspan="2" id="nombre_responsable_implantar_accion_<?php echo $incre;?>"><input name="nombre_responsable_implantar_accion" type="text" id="nombre_responsable_implantar_accion<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $nombre_responsable_implantar_accion;?>"/></td>
    <td style="text-align:center;" colspan="2" id="fecha_prevista_<?php echo $incre;?>"><input name="fecha_prevista" type="date" id="fecha_prevista<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $fecha_prevista;?>"/></td>
    <td style="text-align:center;" id="seguimiento_cumplimiento_<?php echo $incre;?>"><input name="seguimiento_cumplimiento" type="text" id="seguimiento_cumplimiento<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $seguimiento_cumplimiento;?>"/></td>
    <td style="text-align:center;" id="seguimiento_eficacia_<?php echo $incre;?>"><input name="seguimiento_eficacia" type="text" id="seguimiento_eficacia<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $seguimiento_eficacia;?>"/></td>
    <td style="text-align:center;" id="seguimiento_soporte_<?php echo $incre;?>"><input name="seguimiento_soporte" type="text" id="seguimiento_soporte<?php echo $incre;?>" llave="<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>" class="input-block-level" value="<?php echo $seguimiento_soporte;?>"/></td>
  </tr style="text-align:right;" id="tr<?php echo $cod_plan_accion_correctiva_preventiva_mejora;?>">
</tbody>
<?php } ?>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
<!--
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=FACTURA&cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center;"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
-->
    <td style="text-align:center;"><a href="../admin/plan_accion_correctiva_preventiva_mejora_venta_productos_opcion_imprimir.php?cod_info_plan_accion_correctiva_preventiva_mejora=<?php echo $cod_info_plan_accion_correctiva_preventiva_mejora ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos.png" class="img-polaroid" alt=""></a></td>
  </tr>
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
<!--</div>-->
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
        var cod_plan_accion_correctiva_preventiva_mejora = $(this).parent().attr('data');
        var dataString = 'llave='+cod_plan_accion_correctiva_preventiva_mejora+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_plan_accion_correctiva_preventiva_mejora+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_producto_barra_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_cliente_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#nombre_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#und_venta_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#precio_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#total_venta_producto_'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
                $('#tr'+cod_plan_accion_correctiva_preventiva_mejora).fadeOut("slow");
            }
        });

    });

});
</script>
</body>
</html>