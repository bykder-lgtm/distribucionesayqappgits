<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<script type="text/javascript" src="js/jquery.number.js"></script>

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
<script>
function deshabilitar_url_doble_clic( link ){
    link.style.pointerEvents = 'none';
    link.style.color = '#bbb';

    setTimeout(function(){
        link.style.pointerEvents = null;
        link.style.color = 'blue';
    }, 6000);
}
</script>

<script>
    enviando = false; //Obligaremos a entrar el if en el primer submit
    
    function EvitarDobleClicAlVender() {
        if (!enviando) {
            enviando= true;
            return true;
            console.log("un clic");
        } else {
            //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            alert("La factura ya se esta enviando");
            return false;
            console.log("doble clic");
        }
    }
</script>

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_GET['modo_venta_por_defecto'])) { $modo_venta_por_defecto = addslashes($_GET['modo_venta_por_defecto']); } else { $modo_venta_por_defecto = $modo_venta_por_defecto_global; }
if (isset($_GET['cuenta'])) { $cuenta_actual = addslashes($_GET['cuenta']); } else { $cuenta_actual = $cuenta_actual; }
if (isset($_GET['cod_caja_virtual'])) { $cod_caja_virtual = addslashes($_GET['cod_caja_virtual']); } else { $cod_caja_virtual = $cod_caja_virtual; }
if (isset($_GET['cuenta'])) { $url_visit_user_extern = '?cuenta='.$cuenta_actual.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto; } else { $url_visit_user_extern = ""; }
if ($cod_estado_hotel_global == '1') { $filtro_estado_habitacion_hotel_libre = "AND (cod_estado_habitacion_hotel = '0')"; } else { $filtro_estado_habitacion_hotel_libre = ""; }
if ($cod_estado_forzar_dos_decimales_und_venta_step_html_global == '1') { $estado_step_und_venta = "0.01"; } else { $estado_step_und_venta = "any"; }
if ($cod_estado_sumar_producto_repetido_venta_temporal_global == '1') { $ordenamiento_venta_temp = 'fecha_modificacion DESC'; } else { $ordenamiento_venta_temp = 'cod_venta_producto_temporal DESC'; }

$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$incre                             = 0;
$tab                               = 'tbl15_venta_producto_temporal';
$campo                             = 'cod_venta_producto_temporal';
$tipo                              = 'eliminar';
$nombre_tipo_moneda                = "COP";
$nombre_tipo_factura               = $nombre_tipo_factura_defecto_global;
$cod_estado_vacuna                 = "0";

$time_seg                          = time();
$fecha                             = date("Ymd");
$hora                              = date("His");
$nombre_modulo_puc                 = 'VENTAS';
$calibrar_exclusion_de_si_mismo    = 1;

if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = 'busqueda'; }
if (isset($_GET['buscar_por'])) { $buscar_por = addslashes($_GET['buscar_por']); } else { $buscar_por = $nombre_buscar_por; }

$datos_factura = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta = mysqli_query($conectar, $datos_factura);
$total_datos = mysqli_num_rows($consulta);

$sql_info_factura_venta_abierta = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_venta_abierta = mysqli_query($conectar, $sql_info_factura_venta_abierta);
$data_info_factura_venta_abierta = mysqli_fetch_assoc($consulta_info_factura_venta_abierta);

$cod_info_factura_venta            = $data_info_factura_venta_abierta['cod_info_factura_venta'];
$pagina_local_redirect_tipo_pago   = $pagina_local.'?'.'cuenta='.$cuenta_actual.'&'.'cod_caja_virtual='.$cod_caja_virtual.'&'.'cod_info_factura_venta='.$cod_info_factura_venta.'&'.'modo_venta_por_defecto='.$modo_venta_por_defecto;
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

    var valor_buscar = document.getElementById('busqueda').value;
    var pagina = document.getElementById('pagina').value;
    var nombre_tipo_moneda = "COP";
    var nombre_tipo_factura = "<?php echo $nombre_tipo_factura_defecto_global ?>";
    var cod_estado_vacuna = "0";
    var tipo_busqueda = "parcial";
    var buscar_por = $("#buscar_por").val();
    var cuenta = "<?php echo $cuenta_actual ?>";
    var cod_caja_virtual = "<?php echo $cod_caja_virtual ?>";
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta ?>";
    var modo_venta_por_defecto = "<?php echo $modo_venta_por_defecto ?>";

    if(valor_buscar=='') { document.getElementById("logo_cargador").innerHTML=""; return; }

    if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) { document.getElementById("logo_cargador").innerHTML=xmlhttp.responseText; } else { document.getElementById("logo_cargador").innerHTML='<center><img src="../imagenes/loader.gif"/></center>'; }
    }
    xmlhttp.open("POST","../admin/busqueda_inmediata_venta_temporal_producto_php.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("buscar="+valor_buscar+"&buscar_por="+buscar_por+"&cod_info_factura_venta="+cod_info_factura_venta+"&nombre_tipo_moneda="+nombre_tipo_moneda+"&nombre_tipo_factura="+nombre_tipo_factura+"&tipo_busqueda="+tipo_busqueda+"&cod_estado_vacuna="+cod_estado_vacuna+"&cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&pagina="+pagina);
}
</script>

<script type="text/javascript">
$(function(){
    // Set up the number formatting.
    $('#vlr_cancelado_number').on('change',function(){
    //console.log('Change event.');
    var vlr_cancelado_number = $('#vlr_cancelado_number').val();
    $('#the_number').text( vlr_cancelado_number !== '' ? vlr_cancelado_number : '(empty)' );
    });
    //$('#vlr_cancelado').change(function(){ console.log('Second change event...'); });
    $('#vlr_cancelado_number').number( true, 0 );

    $("#vlr_cancelado_number").keyup(function () {
        var vlr_cancelado = $(this).val();
        $("#vlr_cancelado").val(vlr_cancelado);
    });

});
</script>

<div class="table-responsive">

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_caja_virtual.php?pagina=<?php echo $pagina ?>&modo_venta_por_defecto=<?php echo $modo_venta_por_defecto ?>"><?php echo $nombre_concepto_multi_virtual; ?>S VIRTUALES VENTA | </a></strong></td>
        <?php if ($cod_seguridad==1) { ?>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_venta.php">LISTA DE FACTURAS VENTA</a></strong></td>
        <?php } else { ?>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_info_factura_venta_vendedor.php">LISTA DE FACTURAS VENTA</a></strong></td>
        <?php } ?>
    </tr></tbody>
</table>
<br>

<?php if ($cod_estado_venta_manual == '1') { ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody>
    	<tr>
            <?php if ($cod_estado_venta_barras==1) { ?>
            <td bgcolor="#fff" align="center"><a href="../admin/facturacion_venta_temporal_producto_barras_pos.php<?php echo $url_visit_user_extern ?>"><strong>Venta Barras</strong></a></td>
            <?php } ?>
            <td bgcolor="#fff" align="center"><strong>Buscar por:</strong>
            <select class="form-control" name="buscar_por" id="buscar_por" onchange="hacer_busqueda()" style="width: 180px;">
            <?php if (isset($buscar_por)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
            $consulta2_sql = ("SELECT cod_buscar_por, nombre_buscar_por, titulo_buscar_por FROM tbl15_buscar_por WHERE (cod_tipo_busqueda = '1') ORDER BY cod_buscar_por ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($buscar_por) and $buscar_por == $datos2['nombre_buscar_por']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_buscar_por'];
            $nombre = $datos2['titulo_buscar_por'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            <strong>Venta Manual:<input type="text" id="busqueda" name="busqueda" onkeyup="hacer_busqueda()" style="height:40" placeholder="Buscar"/><input type="hidden" id="pagina" name="pagina" value="<?php echo $pagina_local ?>"/></strong><div id="logo_cargador"></div>
            </td>
    	</tr>
    </tbody>
</table>
<?php } ?>

<?php if ($cod_estado_venta_por_categoria_mod_venta_global == 1) { ?>

<?php if ($cod_estado_btn_categoria_desplegable_global == 1) { ?>
<table class="table table-striped">
    <th style="text-align:center"><a class="btn btn-success" data-toggle="collapse" href="#categorias_collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Ver Categorias</a></th>
</table>
<div id="categorias_collapse" class="collapse">
<?php } ?>

    <table class="table table-striped">
        <tr>
        <?php 
        $smtr = 0;
        $mostrar_datos_sql = "SELECT * FROM tbl15_categoria ORDER BY cod_categoria ASC";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

            $cod_categoria        = $matriz_consulta['cod_categoria'];
            $nombre_categoria     = $matriz_consulta['nombre_categoria'];
            $url_categoria_min    = $matriz_consulta['url_categoria_min'];
            $url_categoria_orig   = $matriz_consulta['url_categoria_orig'];

            if ($url_categoria_orig == '') { $url_categoria_orig = '../imagenes/categoria_producto.png'; } else { $url_categoria_orig = $url_categoria_orig; }
                        
            if ($smtr % 4 == 0) { echo "<tr></tr>"; }
            $smtr++; ?>
            <th style="text-align:center; width:50px;"><a href="<?php echo $pagina_local ?>?cod_categoria=<?php echo $cod_categoria?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>"><img src="<?php echo $url_categoria_orig?>"><br><span style="font-family:verdana,geneva,sans-serif; font-size:12px"><?php echo $nombre_categoria; ?></span></a></th>
        <?php } ?>
        </tr>
    </table>
<?php if ($cod_estado_btn_categoria_desplegable_global == 1) { ?>
</div>
<?php } ?>


<?php if (isset($_GET['cod_categoria'])) { 

    $cod_categoria                    = intval($_GET['cod_categoria']);

    $sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE (cod_categoria = '$cod_categoria') ORDER BY cod_categoria ASC";
    $consulta_categoria = mysqli_query($conectar, $sql_categoria) or die(mysqli_error($conectar));
    $matriz_categoria = mysqli_fetch_assoc($consulta_categoria);

    $nombre_categoria                 = $matriz_categoria['nombre_categoria'];
?>
    <table class="table table-striped">
    <th style="text-align:center"><?php echo $nombre_categoria?></th>
    </table>

    <div class="row">
        <table class="table table-striped">
            <tr>
        <?php
        $smtr = 0;
        $mostrar_datos_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_categoria, precio_venta_producto, url_img_orig_producto, url_img_min_producto, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel
        FROM tbl15_producto WHERE (cod_categoria = '$cod_categoria') AND (nombre_tipo_producto <> 'SUBPRODUCTO') ORDER BY cod_producto ASC";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

            $cod_producto                  = $matriz_consulta['cod_producto'];
            $cod_producto_barra            = $matriz_consulta['cod_producto_barra'];
            $nombre_producto               = $matriz_consulta['nombre_producto'];
            $cod_categoria                 = $matriz_consulta['cod_categoria'];
            $precio_venta_producto         = $matriz_consulta['precio_venta_producto'];
            $url_img_orig_producto         = $matriz_consulta['url_img_orig_producto'];
            $url_img_min_producto          = $matriz_consulta['url_img_min_producto'];
            $cod_estado_habitacion_hotel   = $matriz_consulta['cod_estado_habitacion_hotel'];
            $cod_tipo_habitacion_hotel     = $matriz_consulta['cod_tipo_habitacion_hotel'];

            if ($cod_estado_habitacion_hotel_global == 1) {
                $sql_estado_habitacion_hotel = "SELECT nombre_estado_habitacion_hotel FROM tbl15_estado_habitacion_hotel WHERE (cod_estado_habitacion_hotel = '$cod_estado_habitacion_hotel')";
                $consulta_estado_habitacion_hotel = mysqli_query($conectar, $sql_estado_habitacion_hotel) or die(mysqli_error($conectar));
                $matriz_estado_habitacion_hotel = mysqli_fetch_assoc($consulta_estado_habitacion_hotel);

                $nombre_estado_habitacion_hotel = $matriz_estado_habitacion_hotel['nombre_estado_habitacion_hotel'];

                $texto_nombre_estado_habitacion_hotel = "<br>".$nombre_estado_habitacion_hotel;
            } else {
                $texto_nombre_estado_habitacion_hotel = "";            
            }

            if ($cod_estado_tipo_habitacion_hotel_global == 1) {
                $sql_tipo_habitacion_hotel = "SELECT nombre_tipo_habitacion_hotel FROM tbl15_tipo_habitacion_hotel WHERE (cod_tipo_habitacion_hotel = '$cod_tipo_habitacion_hotel')";
                $consulta_tipo_habitacion_hotel = mysqli_query($conectar, $sql_tipo_habitacion_hotel) or die(mysqli_error($conectar));
                $matriz_tipo_habitacion_hotel = mysqli_fetch_assoc($consulta_tipo_habitacion_hotel);

                $nombre_tipo_habitacion_hotel = $matriz_tipo_habitacion_hotel['nombre_tipo_habitacion_hotel'];

                $texto_nombre_tipo_habitacion_hotel = "<br>".$nombre_tipo_habitacion_hotel;
            } else {
                $texto_nombre_tipo_habitacion_hotel = "";            
            }

            if ($url_img_min_producto == '') { $url_img_min_producto = '../imagenes/producto_sin_img.png'; } else { $url_img_min_producto = $url_img_min_producto; }

            if ($smtr % 4 == 0) { echo "<tr></tr>"; }
            $smtr++;
        ?>
            <div class="col-lg-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                <?php if ($cod_estado_habitacion_hotel == '0') { ?>
                <td style="text-align:center; height:40px"><a href="../admin/reg_venta_temporal_producto_reg.php?cod_producto_barra=<?php echo $cod_producto_barra?>&buscar_por=<?php echo $buscar_por?>&nombre_tipo_moneda=<?php echo $nombre_tipo_moneda?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>&foco=<?php echo $foco?>&cod_estado_vacuna=<?php echo $cod_estado_vacuna?>&cuenta=<?php echo $cuenta_actual?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&cod_categoria=<?php echo $cod_categoria?>&pagina=<?php echo $pagina?>"><img src="<?php echo $url_img_min_producto?>" class="img-responsive imgesp d-none d-md-block" style="height:200%;"><br><?php echo $nombre_producto.''.$texto_nombre_estado_habitacion_hotel.''.$texto_nombre_tipo_habitacion_hotel.'<br>'.number_format($precio_venta_producto, 0, ",", "."); ?></a></td>
                <?php } else { ?>
                <td style="text-align:center; height:40px"><img src="<?php echo $url_img_min_producto?>" class="img-responsive imgesp d-none d-md-block" style="height:200%;">
                    <br>
                    <?php echo $nombre_producto.''.$texto_nombre_estado_habitacion_hotel.''.$texto_nombre_tipo_habitacion_hotel.'<br>'.number_format($precio_venta_producto, 0, ",", "."); ?></td>
                <?php } ?>
            </div>
        <?php } ?>
            </tr>
        </table>
    </div>
    <?php } ?>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<?php include_once('../admin/info_factura_venta_temporal_pos.php'); ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { include_once("../admin/modal_registrar_tercero.php"); } ?>
<!-- ***************************************************************************************************************************** -->
<?php if ($total_datos <> 0) { ?>

<table <table class="table table-hover" border="" cellspacing="0" cellpadding="0">
<thead>
	<tr>
		<td style="text-align:center;"></td>
        <?php if ($cod_seguridad == '1') { ?>
        <?php if ($cod_estado_revisado_venta_temporal_global == '1') { ?>
        <td style="text-align:center;"></td>
        <?php } ?>
        <?php } ?>

		<?php if ($cod_estado_deshabilitar_opc_eliminar_ventatemp == '0') { ?><th style="text-align:center;">ELM</th><?php } ?>
		<!--<th style="text-align:center;">COBRAR</th>-->
		<th style="text-align:center;">CODIGO</th>

        <?php if ($nombre_tipo_producto == 'LABORATORIOS' || $nombre_tipo_producto == 'MEDICAMENTOS' || $nombre_tipo_producto == 'PARACLINICOS') { ?>
            <th style="text-align:center;">NOMBRE PACIENTE</th>
        <?php } ?>

		<th style="text-align:center;">NOMBRE CONCEPTO</th>
		<th style="text-align:center;">CANTIDAD</th>
		<th style="text-align:center;">MED</th>

        <?php if ($cod_estado_und_inv_ventatemp == '1') { ?><th style="text-align:center;">INV</th><?php } ?>

        <?php if ($cod_estado_bascula_balanza_cod_barras_pesar_producto_global == '1') { ?><th style="text-align:center;">PESAR</th><?php } ?>

        <?php if ($cod_estado_habilitar_hora_venta_temporal_global == '1') { ?><th style="text-align:center;">HORA</th><?php } ?>

		<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>

        <?php if ($cod_estado_origen_produccion == '1') { ?><th style="text-align:center;">ORIGEN</th><?php } ?>

        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?><th style="text-align:center;">UND</th><?php } ?>
        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?><th style="text-align:center;">CAJA</th><?php } ?>
        <?php if ($cod_estado_und_sobre_global  == '1') { ?><th style="text-align:center;">SOBRE</th><?php } ?>

        <?php if ($cod_estado_comision_ventatemp == '1') { ?><th style="text-align:center;">COMISION</th><?php } ?>

		<?php if ($cod_estado_parqueo_hotel_global == '1') { ?>
		<!--<th style="text-align:center;"></th>-->
		<th style="text-align:center;">FECHA - HORA INGRESO</th>
		<th style="text-align:center;">FECHA - HORA SALIDA</th>
        <th style="text-align:center;"></th>
		<?php } else { ?>
		<th style="text-align:center;"></th>
		<th style="text-align:center;"></th>
        <th style="text-align:center;"></th>
		<?php } ?>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <th style="text-align:center">PESO (KG)</th>
        <?php } ?>

		<?php if ($cod_estado_precio_compra_mod_venta==1) { ?>
		<th style="text-align:center;">PRECIO COMPRA</th>
		<?php } ?>

		<th style="text-align:center;">T.P</th>
		<th style="text-align:center;">PRECIO VENTA UNITARIO</th>
		<th align="center"></th>
		<th style="text-align:center;">PRECIO VENTA TOTAL</th>
		<th style="text-align:center;">OK</th>
        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?>
        <th style="text-align:center;">ALERTA COBRO</th>
        <?php } ?>
		<th style="text-align:center;"></th>
	</tr>
</thead>
<tbody>
<?php
$sql_venta_producto_temporal = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') ORDER BY $ordenamiento_venta_temp";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

    $cod_venta_producto_temporal                  = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
    $cod_producto                                 = $datos_venta_producto_temporal['cod_producto'];
    $cod_producto_barra                           = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                              = $datos_venta_producto_temporal['nombre_producto'];
    $cedula                                       = $datos_venta_producto_temporal['cedula'];
    $nombre_cliente                               = $datos_venta_producto_temporal['nombre_cliente'];
    $und_venta                                    = $datos_venta_producto_temporal['und_venta'];
    $precio_costo_producto                        = $datos_venta_producto_temporal['precio_costo_producto'];
    $precio_compra_producto                       = $datos_venta_producto_temporal['precio_compra_producto'];
    $total_costo_producto                         = $datos_venta_producto_temporal['total_costo_producto'];
    $precio_venta_producto                        = $datos_venta_producto_temporal['precio_venta_producto'];
    $total_venta_producto                         = $datos_venta_producto_temporal['total_venta_producto'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $total_venta_producto = intval($total_venta_producto); } else { $total_venta_producto = $total_venta_producto; }
    //$nombre_tipo_producto              = $datos_venta_producto_temporal['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida                    = $datos_venta_producto_temporal['nombre_tipo_unidad_medida'];
    $posologia_cantidad                           = $datos_venta_producto_temporal['posologia_cantidad'];
    $posologia_peso                               = $datos_venta_producto_temporal['posologia_peso'];
    $nombre_tipo_presentacion                     = $datos_venta_producto_temporal['nombre_tipo_presentacion'];
    $nombre_via_administracion                    = $datos_venta_producto_temporal['nombre_via_administracion'];
    $nombre_frec_duracion                         = $datos_venta_producto_temporal['nombre_frec_duracion'];
    $cod_tipo_cobrar                              = $datos_venta_producto_temporal['cod_tipo_cobrar'];
    $cod_info_factura_venta                       = $datos_venta_producto_temporal['cod_info_factura_venta'];
    $nombre_tipo_precio_venta                     = $datos_venta_producto_temporal['nombre_tipo_precio_venta'];
    $cod_estado_permitir_venta                    = $datos_venta_producto_temporal['cod_estado_permitir_venta'];
    //$und_producto                                 = $datos_venta_producto_temporal['und_producto'];
    //$cajas_sobre                                  = $datos_venta_producto_temporal['cajas_sobre'];
    //$und_sobre                                    = $datos_venta_producto_temporal['und_sobre'];
    $fecha_seg_venta_producto                     = $datos_venta_producto_temporal['fecha_seg_venta_producto'];
    $hora_cargue                                  = date("H:i:s", $fecha_seg_venta_producto);
    $comentario_producto                          = $datos_venta_producto_temporal['comentario_producto'];
    $placa_producto                               = $datos_venta_producto_temporal['placa_producto'];
    $fecha_ymd_parqueo_ini                        = $datos_venta_producto_temporal['fecha_ymd_parqueo_ini'];
    $fecha_hora_parqueo_ini                       = $datos_venta_producto_temporal['fecha_hora_parqueo_ini'];
    $fecha_ymd_parqueo_fin                        = $datos_venta_producto_temporal['fecha_ymd_parqueo_fin'];
    $fecha_hora_parqueo_fin                       = $datos_venta_producto_temporal['fecha_hora_parqueo_fin'];
    $cod_estado_componente_und_venta              = $datos_venta_producto_temporal['cod_estado_componente_und_venta'];
    $cod_estado_revisado                          = $datos_venta_producto_temporal['cod_estado_revisado'];
    $peso_producto                                = $datos_venta_producto_temporal['peso_producto'];
    $unidad_medida_peso                           = $datos_venta_producto_temporal['unidad_medida_peso'];
    $cod_origen_produccion                        = $datos_venta_producto_temporal['cod_origen_produccion'];
    $und_caja_sobre                               = $datos_venta_producto_temporal['und_caja_sobre'];
    $nombre_tipo_und_caja_sobre                   = $datos_venta_producto_temporal['nombre_tipo_und_caja_sobre'];
    $total_dias                                   = $datos_venta_producto_temporal['total_dias'];
    $total_horas                                  = $datos_venta_producto_temporal['total_horas'];
    $nombre_tipo_cobro                            = $datos_venta_producto_temporal['nombre_tipo_cobro'];
    $comision_ptj                                 = $datos_venta_producto_temporal['comision_ptj'];
    $total_cajas_disponibles                      = $datos_venta_producto_temporal['total_cajas_disponibles'];
    $total_sobres_disponibles                     = $datos_venta_producto_temporal['total_sobres_disponibles'];
    $cod_estado_prod_repet_max_und_venta_aumentar = $datos_venta_producto_temporal['cod_estado_prod_repet_max_und_venta_aumentar'];
    //$max_und_venta                                 = $datos_venta_producto_temporal['max_und_venta'];

    $sqlr_consulta = "SELECT und_producto, cajas_sobre, und_sobre FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
    $modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
    $datos_prod = mysqli_fetch_assoc($modificar_consulta);

    $und_producto                                 = $datos_prod['und_producto'];
    $cajas_sobre                                  = $datos_prod['cajas_sobre'];
    $und_sobre                                    = $datos_prod['und_sobre'];
    $und_venta_propia                             = $und_venta;
    $und_venta_max_disponible                     = $und_producto;

    $sql_conteo_reg_prod_repetido_temporal = "SELECT Count(cod_producto_barra) AS total_conteo_reg_prod_repetido FROM tbl15_venta_producto_temporal WHERE (cod_producto_barra = '$cod_producto_barra')";
    $resultado_conteo_reg_prod_repetido_temporal = mysqli_query($conectar, $sql_conteo_reg_prod_repetido_temporal) or die(mysqli_error($conectar));
    $info_conteo_reg_prod_repetido_temporal = mysqli_fetch_assoc($resultado_conteo_reg_prod_repetido_temporal);

    $total_conteo_reg_prod_repetido_temporal      = $info_conteo_reg_prod_repetido_temporal['total_conteo_reg_prod_repetido'];

    $sql_total_und_venta_producto_temporal = "SELECT SUM(und_venta) AS total_und_venta_temporal FROM tbl15_venta_producto_temporal WHERE (cod_producto_barra = '$cod_producto_barra')";
    $resultado_total_und_venta_producto_temporal = mysqli_query($conectar, $sql_total_und_venta_producto_temporal) or die(mysqli_error($conectar));
    $info_total_und_venta_producto_temporal = mysqli_fetch_assoc($resultado_total_und_venta_producto_temporal);

    $total_und_venta_temporal                     = $info_total_und_venta_producto_temporal['total_und_venta_temporal'];

    if (($total_conteo_reg_prod_repetido_temporal > 1) && ($und_venta_max_disponible <> $total_und_venta_temporal) && ($cod_estado_prod_repet_max_und_venta_aumentar == 1)) {
        $max_und_venta_temp = ($und_venta_max_disponible + $calibrar_exclusion_de_si_mismo) - $total_und_venta_temporal;
    } elseif (($total_conteo_reg_prod_repetido_temporal == 1) && ($und_venta_max_disponible <> $total_und_venta_temporal) && ($cod_estado_prod_repet_max_und_venta_aumentar == 1)) {
        $max_und_venta_temp = $und_producto;
    } else {
        $max_und_venta_temp = $und_venta;
    }

    if ($cajas_sobre == 0) { $cajas_sobre = 1; } else { $cajas_sobre =  $cajas_sobre; }
    if ($cod_estado_permitir_venta == 1) { $imagen = '<img src=../imagenes/incorrecto.png alt="Listo">'; } else { $imagen = '<img src=../imagenes/correctok.png alt="Listo">'; }
    if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta = "max=".$max_und_venta_temp; } else { $max_und_venta = ""; }
    if ($cod_estado_venta_prod_en_cero_global == '1') { $max_und_venta_caja = "max=".$und_producto/$cajas_sobre; } else { $max_und_venta_caja = ""; }
    if ($cod_estado_venta_precio_min_venta_global == '1') { $min_precio_venta = "min=".$precio_compra_producto; } else { $min_precio_venta = ""; }
    if ($cod_estado_revisado == '0') { $img_estado_revisado = "<img src=../imagenes/btn_revisado_no.gif>"; } else { $img_estado_revisado = "<img src=../imagenes/btn_revisado.gif>"; }

    if ($nombre_tipo_und_caja_sobre == 'CAJA') { $img_caja = "../imagenes/und_caja_R.png"; } else { $img_caja = "../imagenes/und_caja.png"; }
    if ($nombre_tipo_und_caja_sobre == 'SOBRE') { $img_sobre = "../imagenes/und_sobre_R.png"; } else { $img_sobre = "../imagenes/und_sobre.png"; }
    if (($nombre_tipo_und_caja_sobre=='UND') || ($nombre_tipo_und_caja_sobre=='')) { $img_und = "../imagenes/und_und_R.png"; } else { $img_und = "../imagenes/und_und.png"; }
    if ($cod_estado_mostrar_venta_por_caja_global == '1') { $nombre_tipo_unidad_medida_contidad  = '<br>('.$und_caja_sobre.')'; } else { $nombre_tipo_unidad_medida_contidad  = ""; }

    $incre++;
?>
	<tr id="tr<?php echo $cod_venta_producto_temporal;?>">
		<td style="text-align:center;"></td>

        <?php if ($cod_seguridad == '1') { ?>
            <?php if ($cod_estado_revisado_venta_temporal_global == '1') { ?>
                <td style="text-align:center;"><?php echo $img_estado_revisado ?></td>
            <?php } ?>
        <?php } ?>

		<?php if ($cod_estado_deshabilitar_opc_eliminar_ventatemp == '0') { ?><td style="text-align:center;"><a id="eliminar<?php echo $incre;?>" href="../admin/eliminar.php?llave=<?php echo $cod_venta_producto_temporal?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td><?php } ?>
		<!--<td style="text-align:center"><input name="cod_tipo_cobrar" class="cod_tipo_cobrar__<?php echo $cod_venta_producto_temporal;?>" id="cod_tipo_cobrar_<?php echo $cod_venta_producto_temporal;?>" type="checkbox" value="1" <?php if($cod_tipo_cobrar=='1'){ echo "checked"; } ?>></td>-->
		<!--<td style="text-align:center;" id="cod_venta_producto_temporal_<?php echo $cod_venta_producto_temporal ?>" class="service_list" data="<?php echo $cod_venta_producto_temporal ?>"><a class="eliminar" id="cod_venta_producto_temporal<?php echo $cod_venta_producto_temporal ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>-->
		<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>

        <?php if ($nombre_tipo_producto == 'LABORATORIOS' || $nombre_tipo_producto == 'MEDICAMENTOS' || $nombre_tipo_producto == 'PARACLINICOS') { ?>
            <td style="text-align:center;"><input name="nombre_cliente" type="text" id="nombre_cliente<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $nombre_cliente;?>" style="width: 300px; height: 29px;" /></td>
        <?php } ?>

		<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>

        <?php if (($nombre_tipo_und_caja_sobre=='CAJA') || ($nombre_tipo_und_caja_sobre=='SOBRE')) { ?>
            <td style="text-align:center;" id="und_caja_sobre_<?php echo $incre;?>"><input name="und_caja_sobre" type="number" id="und_caja_sobre<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_caja_sobre;?>" step="any" lang="en" min=0 <?php echo $max_und_venta_caja;?> oninput="validity.valid||(value='');" style="width: 70px;" /></td>
            <input name="und_venta" type="hidden" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $und_venta;?>" />
        <?php } else { ?>
            <?php if ($cod_estado_deshabilitar_und_venta_temp == '0') { ?>
    		<td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" step="<?php echo $estado_step_und_venta;?>" lang="en" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px; height: 29px;" /></td>
            <?php } else { 
                if ($cod_estado_componente_und_venta == '0') { ?>
                    <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><input name="und_venta" type="<?php echo $nombre_tipo_campo_componente_html_und_venta;?>" id="und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $und_venta;?>" step="<?php echo $estado_step_und_venta;?>" lang="en" min=0 <?php echo $max_und_venta;?> oninput="validity.valid||(value='');" style="width: 70px; height: 29px;" /></td>
                <?php } else { ?>
                    <td style="text-align:center;" id="und_venta_<?php echo $incre;?>"><?php echo $und_venta;?></td>
             <?php } ?>
            <?php } ?>
        <?php } ?>

        <td style="text-align:center;" id="nombre_tipo_unidad_medida_<?php echo $incre;?>"><?php echo $nombre_tipo_unidad_medida;?></td>

        <?php if ($cod_estado_und_inv_ventatemp == '1') { ?><td style="text-align:center;"><?php echo $und_producto;?></td><?php } ?>

        <?php if ($cod_estado_bascula_balanza_cod_barras_pesar_producto_global == '1') { ?><td style="text-align:center;"><button type="button" id="btn_pesar_producto<?php echo $incre;?>" class="btn_pesar_producto">PESAR</button><input name="pesar_producto_input" type="text" id="pesar_producto_input<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="" step="any" style="width: 80px; height: 29px;" /></td><?php } ?>

        <?php if ($cod_estado_habilitar_hora_venta_temporal_global == '1') { ?><td style="text-align:center;"><?php echo $hora_cargue;?></td><?php } ?>

		<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align:center;"><input name="comentario_producto" type="text" id="comentario_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $comentario_producto;?>" style="width: 150px; height: 29px;" /></td><?php } ?>

        <?php if ($cod_estado_origen_produccion == '1') { ?>
        <td style="text-align:center">
            <select name="cod_origen_produccion" id="cod_origen_produccion<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" data-show-subtext="true" data-live-search="true" style="width: 90px;" required>
                <?php if (isset($cod_origen_produccion)) { echo ""; } else { echo ""; }
                $consulta2_sql = ("SELECT cod_origen_produccion, nombre_origen_produccion FROM tbl15_origen_produccion WHERE (cod_estado = '1') ORDER BY cod_origen_produccion ASC");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($cod_origen_produccion) and $cod_origen_produccion == $datos2['cod_origen_produccion']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['cod_origen_produccion'];
                $nombre = $datos2['nombre_origen_produccion'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
        <td style="text-align:center;"><a href="../admin/actualizar_caja_sobre_temporal_producto.php?tipo_caja_sobre=UND&cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>"><img src="<?php echo $img_und ?>"><div id="div_und_caja_sobre<?php echo $incre;?>"><?php echo $und_venta?></div></a></td>
        <?php } ?>

        <?php if ($cod_estado_cajas_sobre_global  == '1') { ?>
            <?php if ($total_cajas_disponibles >= '1') { ?>
                <td style="text-align:center;"><a href="../admin/actualizar_caja_sobre_temporal_producto.php?tipo_caja_sobre=CAJA&cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>"><img src="<?php echo $img_caja ?>"><?php echo $cajas_sobre?></a></td>
            <?php } else { ?>
                <td style="text-align:center;"><img src="../imagenes/und_caja_gris.png"><?php echo $cajas_sobre?></td>
            <?php } ?>
        <?php } ?>

        <?php if ($cod_estado_und_sobre_global  == '1') { ?>
            <?php if ($total_sobres_disponibles >= '1') { ?>
                <td style="text-align:center;"><a href="../admin/actualizar_caja_sobre_temporal_producto.php?tipo_caja_sobre=SOBRE&cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>"><img src="<?php echo $img_sobre ?>"><?php echo $und_sobre?></a></td>
            <?php } else { ?>
                <td style="text-align:center;"><img src="../imagenes/und_sobre_gris.png"><?php echo $und_sobre?></td>
            <?php } ?>
        <?php } ?>

        <?php if ($cod_estado_comision_ventatemp == '1') { ?><td style="text-align:center;"><?php echo $comision_ptj;?>%</td><?php } ?>

		<?php if (($cod_estado_parqueo_hotel_global == '1') && (($nombre_tipo_producto == 'SERVICIO PARQUEO') || ($nombre_tipo_producto == 'HABITACION'))) { ?>
		<!--<td style="text-align:right;" id="placa_producto_<?php echo $incre;?>"><input name="placa_producto" type="text" id="placa_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $placa_producto;?>" style="width: 100px;" /></td>-->
		<td style="text-align:center;" id="fecha_ymd_parqueo_ini_<?php echo $incre;?>"><input name="fecha_ymd_parqueo_ini" type="date" id="fecha_ymd_parqueo_ini<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $fecha_ymd_parqueo_ini;?>" style="width: 120px; height: 29px;" />-<input name="fecha_hora_parqueo_ini" type="time" id="fecha_hora_parqueo_ini<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $fecha_hora_parqueo_ini;?>" style="width: 90px; height: 29px;" /></td>
		<td style="text-align:center;" id="fecha_ymd_parqueo_fin_<?php echo $incre;?>"><input name="fecha_ymd_parqueo_fin" type="date" id="fecha_ymd_parqueo_fin<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $fecha_ymd_parqueo_fin;?>" style="width: 120px; height: 29px;" />-<input name="fecha_hora_parqueo_fin" type="time" id="fecha_hora_parqueo_fin<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $fecha_hora_parqueo_fin;?>" style="width: 90px; height: 29px;" /></td>
        <td style="text-align:center;" id="fecha_ymd_parqueo_ini_<?php echo $incre;?>"><?php echo $total_dias."D"." | ".$total_horas."H";?></td>
        <?php } else { ?>
		<!--<td style="text-align:right;" id="placa_producto_<?php echo $incre;?>"></td>-->
		<td style="text-align:center;" id="fecha_ymd_parqueo_ini_<?php echo $incre;?>"></td>
		<td style="text-align:center;" id="fecha_ymd_parqueo_fin_<?php echo $incre;?>"></td>
        <td style="text-align:center;" id="fecha_ymd_parqueo_fin_<?php echo $incre;?>"></td>
		<?php } ?>

        <?php if ($cod_estado_peso_producto_global == '1') { ?>
        <td style="text-align:center;" id="peso_producto_<?php echo $incre;?>"><input name="peso_producto" type="number" id="peso_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $peso_producto;?>" step="any" min=0 style="width: 70px; height: 29px;" /></td>
        <?php } ?>

		<?php if ($cod_estado_precio_compra_mod_venta==1) { ?>
		<td style="text-align:right;" id="precio_compra_producto_<?php echo $incre;?>"><?php echo number_format($precio_compra_producto, 0, ",", "."); ?></td>
		<?php } ?>

        <?php if ($cod_estado_precio_venta_variable_disponible=='1') { ?>
    		<?php if ($nombre_tipo_precio_venta=='PVAR') { ?>
        	   <td style="text-align:center;"><img src="../imagenes/PVAR.png"></td> 
        	   <td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px; height: 29px;" /></td>
    		  <?php } else { ?>
    		  <td style="text-align:center;">
        		<?php for ($i=1; $i <= $numero_precio_user; $i++) { ?>
        		<a href="../admin/actualizar_precio_venta_temporal_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>"><img src="<?php if ($nombre_tipo_precio_venta=="PV$i") { echo "../imagenes/PV".$i."_R.png"; } else { echo "../imagenes/PV$i.png"; } ?>"></a>
        		<?php } ?>
    		  </td>
    		<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px; height: 29px;" /></td>
    		<?php } ?>
		<?php } else { ?>
    		<?php if ($nombre_tipo_precio_venta=='PVAR') { ?>
    		  <td style="text-align:center;"><img src="../imagenes/PVAR.png"></td>
    		  <td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><input name="precio_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="precio_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $precio_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px; height: 29px;" /></td>
    		<?php } else { ?>
    		  <td style="text-align:center;">
    		<?php for ($i=1; $i <= $numero_precio_user; $i++) { ?>
    		  <a href="../admin/actualizar_precio_venta_temporal_producto.php?nombre_tipo_precio_venta=PV<?php echo $i?>&cod_venta_producto_temporal=<?php echo $cod_venta_producto_temporal?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta?>&cuenta=<?php echo $cuenta?>&cod_caja_virtual=<?php echo $cod_caja_virtual?>&pagina=<?php echo $pagina_local?>"><img src="<?php if ($nombre_tipo_precio_venta=="PV$i") { echo "../imagenes/PV".$i."_R.png"; } else { echo "../imagenes/PV$i.png"; } ?>"></a>
    		<?php } ?>
    		<input type="hidden" id="precio_venta_producto<?php echo $incre;?>" value="<?php echo $precio_venta_producto;?>">
    		</td>
    		<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
    		<?php } ?>
		<?php } ?>

        <input name="cod_estado_componente_und_venta" type="hidden" id="cod_estado_componente_und_venta<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" value="<?php echo $cod_estado_componente_und_venta;?>"/>

		<td style="text-align:right;" id="mensaje_alerta<?php echo $incre;?>"></td>

        <?php if ($cod_estado_editable_precio_total_venta_temp=='1') { ?>
        <td style="text-align:right;" id="total_venta_producto_<?php echo $incre;?>"><input name="total_venta_producto" type="<?php echo $nombre_tipo_campo_componente_html_precio_venta;?>" id="total_venta_producto<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" onChange="calc_total_venta();" value="<?php echo $total_venta_producto;?>" step="any" <?php echo $min_precio_venta;?> style="width: 100px; height: 29px;" /></td>
        <?php } else { ?>
        <td style="text-align:right;" id="total_venta_producto<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
        <?php } ?>

		<td style="text-align:center;" id="btn_listo<?php echo $incre;?>"><a href="<?php $_SERVER['PHP_SELF']?>"><?php echo $imagen;?></a></td>


        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?>
            <td style="text-align:center">
                <select name="nombre_tipo_cobro" id="nombre_tipo_cobro<?php echo $incre;?>" class="<?php echo $cod_venta_producto_temporal;?>" data-show-subtext="true" data-live-search="true" style="width: 100px;" required>
                <?php if (isset($nombre_tipo_cobro)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
                $consulta2_sql = ("SELECT * FROM tbl15_tipo_cobro WHERE (cod_estado = '1')");
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_cobro) and $nombre_tipo_cobro == $datos2['nombre_tipo_cobro']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_cobro'];
                $nombre = $datos2['nombre_tipo_cobro'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
            </td>
        <?php } ?>

		<td style="text-align:center;"></td>
	</tr id="tr<?php echo $cod_venta_producto_temporal;?>">
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
<!--</div>-->
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php
$cod_estado_revisado              = "1";
$cuenta_actual_sesion             = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if (strtolower($cuenta_actual) <> strtolower($cuenta_actual_sesion)) {

    $sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET cod_estado_revisado = '$cod_estado_revisado' WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')");
    $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

    $sql_data = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_revisado = '$cod_estado_revisado' WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')");
    $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<!--
<script type="text/javascript">
$(document).ready(function() {
    var cod_tipo_cobrar = $('#cod_tipo_cobrar').val();
    if (cod_tipo_cobrar=='1') { $('#cod_tipo_cobrar').val('1'); $('#cod_tipo_cobrar').prop('checked',true); } else { $('#cod_tipo_cobrar').val('0'); $('#cod_tipo_cobrar').prop('checked',false); } 
    $(".cod_tipo_cobrar").change(function(){ if( $(this).is(':checked') ){ $(".cod_tipo_cobrar").val("1"); } else { $(".cod_tipo_cobrar").val("0"); } });
});
</script>
-->
<script type="text/javascript">
function calc_total_venta(){

    var i=0;
    var incre = <?php echo $total_datos;?>;
    var und_venta_text = "";
    var precio_venta_producto_text = "";
    var total_venta_producto_text = "";

    var total_venta = 0;
    var und_venta = 0;
    var precio_venta_producto = 0;
    var total_venta_producto = 0;
    var smtr_total_venta = 0;
    var Max_Length = 4;
    var length = 0;

    for (i=1; i<=incre; i++){

        und_venta_text = "und_venta"+i;
        precio_venta_producto_text = "precio_venta_producto"+i;
        total_venta_producto_text = "total_venta_producto"+i;
        //mensaje_alerta_text = "mensaje_alerta"+i;

        //mensaje_alerta = document.getElementById(mensaje_alerta_text).value;
        und_venta = document.getElementById(und_venta_text).value;
        precio_venta_producto = document.getElementById(precio_venta_producto_text).value;

        total_venta_producto = (und_venta * precio_venta_producto);
        smtr_total_venta = smtr_total_venta + total_venta_producto;

        //console.log("und_venta = "+und_venta);
        //console.log("precio_venta_producto = "+precio_venta_producto);
        //console.log("total_venta_producto = "+total_venta_producto);
        //console.log("smtr_total_venta = "+smtr_total_venta);
        //console.log("und_venta_text = "+und_venta_text);
        //console.log("precio_venta_producto_text = "+precio_venta_producto_text);
        //console.log("total_venta_producto_text = "+total_venta_producto_text);
        //console.log("------------------------------");
        <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
        length = document.getElementById(und_venta_text).value.length;
        if (length > Max_Length) {
            //var objeto_mostrar_mensaje = document.getElementById("mensaje_alerta_"+i);
            //objeto_mostrar_mensaje.parentNode.innerHTML = objeto_mostrar_mensaje.parentNode.innerHTML + "<p style='color:yellow'>Verificar</p>";
            //  address1.parentNode.innerHTML = address1.parentNode.innerHTML + "<p style='color:red'>the max length of "+Max_Length + " characters is reached, you typed in  " + length + "characters</p>";
            //console.log(length);
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


<?php if ($cod_estado_bascula_balanza_electronica_pesar_producto_global == '1') { ?>
    <script type="text/javascript">
        document.getElementById("<?php echo $foco ?>").select();
    </script>
<?php } ?>


<?php if ($cod_estado_bascula_balanza_cod_barras_pesar_producto_global == '1') { ?>
    <script type="text/javascript">
    $(document).ready(function() {

        var incrent = <?php echo $total_datos;?>;
        var pesar_producto_input_text = "";

        for (i=1; i<=incrent; i++){
            pesar_producto_input_text = "pesar_producto_input"+i;
            document.getElementById(pesar_producto_input_text).style.display = 'none';
        }

        $('.btn_pesar_producto').click(function(){
            var nombre_incre = $(this).attr("id");
            var frag = nombre_incre.split("btn_pesar_producto");
            var id_incre = frag[1];

            document.getElementById("btn_pesar_producto"+id_incre).style.display = 'none';
            document.getElementById("pesar_producto_input"+id_incre).style.display = 'block';
            document.getElementById("pesar_producto_input"+id_incre).focus();
        });

        $("input[name='pesar_producto_input']").change(function(){
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto_temporal";
            var id = $(this).attr("class");
            var foco = '';
            var pagina = '';
            var cod_venta_producto_temporal = id;
            var datos_url_ajax = 'id='+id+'&'+'valor='+valor+'&'+'campo='+campo+'&'+'tipo='+tipo_ajax+'foco='+foco+'&'+'pagina='+pagina;

            $.ajax({
                type: "POST",
                url: "../admin/reg_venta_temporal_pesar_producto_ajax_reg.php",
                data: datos_url_ajax,
                //dataType: 'json',
                beforeSend: function(objeto){
                    $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
                },
                success:function(respuesta){
                    var ok_ajax = respuesta.ok_ajax;
                    //window.location.href = window.location.href;
                    window.location.reload();
                }
            });

        });

    });
    </script>
<?php } ?>

</body>
</html>